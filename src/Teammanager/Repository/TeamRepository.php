<?php

namespace Teammanager\Repository;


use Doctrine\DBAL\Connection;
use Teammanager\Model\Team;

class TeamRepository implements RepositoryInterface
{

    /**
     * @var Connection
     */
    protected $db;

    public function __construct(Connection $db)
    {
        $this->db = $db;
    }

    /**
     * Save the team
     * @param Team $team
     */
    public function save($team)
    {
        $teamData = array(
            'name' => $team->getName(),
            'description' => $team->getDescription(),
            'image' => $team->getImage(),
        );

        if ($team->getId()) {
            $this->db->update('team', $teamData, array('id' => $team->getId()));
            $this->db->delete('team_has_teammate',array('team_id'=>$team->getId()));
        }
        else {
            $this->db->insert('team', $teamData);
            // Get the id of the newly created artist and set it on the entity.
            $id = $this->db->lastInsertId();

            $team->setId($id);
        }

        $teammates = $team->getTeammates();

        foreach($teammates as $idTeammate) {
            $this->db->insert('team_has_teammate',array('team_id' => $team->getId(), 'teammate_id' => $idTeammate));
        }

        return $team;
    }

    /**
     * Return the number of teams
     */
    public function getCount()
    {

    }

    /**
     * Delete a team
     * @param int $id
     */
    public function delete($id)
    {
        $this->db->delete('team', array('id' => $id));
    }

    /**
     * Return a collection of teams
     *
     */
    public function findAll()
    {
        $orderBy = array('name' => 'ASC');

        $queryBuilder = $this->db->createQueryBuilder();
        $queryBuilder
            ->select('t.*')
            ->from('team', 't')
            ->orderBy('t.' . key($orderBy), current($orderBy));
        $statement = $queryBuilder->execute();
        $teamsData = $statement->fetchAll();

        $teams = array();
        foreach ($teamsData as $teamData) {
            $teamId = $teamData['id'];
            $team = $this->hydrateTeam($teamData);

            $teammates = $this->db->fetchAll('SELECT * FROM team_has_teammate INNER JOIN teammate WHERE team_id = ?', array($teamId));
            $team->setTeammates($teammates);
            $teams[$teamId] = $team;
        }

        return $teams;
    }

    /**
     * Return a team based on its id
     * @param int $id
     * @return bool|void
     */
    public function find($id)
    {
        $teamData = $this->db->fetchAssoc('SELECT * FROM team WHERE id = ?', array($id));

        if (!$teamData) {
            return false;
        }
        $team = $this->hydrateTeam($teamData);
        $teammates = $this->db->fetchAll('SELECT * FROM team_has_teammate WHERE team_id = ?', array($id));
        $team->setTeammates($teammates);

        return $team;
    }

    public function hydrateTeam($teamData)
    {
        $team = new Team();
        $team->setId($teamData['id']);
        $team->setName($teamData['name']);
        $team->setDescription($teamData['description']);
        $team->setImage($teamData['image']);

        return $team;
    }

}