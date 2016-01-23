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
        }
        else {
            $this->db->insert('team', $teamData);
            // Get the id of the newly created artist and set it on the entity.
            $id = $this->db->lastInsertId();
            $team->setId($id);
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

    }

    /**
     * Return a collection of teams
     * @param int $limit
     * @param int $offset
     * @param array $orderBy
     */
    public function findAll($limit, $offset = 0, $orderBy = array())
    {

    }

    /**
     * Return a team based on its id
     * @param int $id
     * @return bool|void
     */
    public function find($id)
    {
        $teamData = $this->db->fetchAssoc('SELECT * FROM team WHERE id = ?', array($id));
        return $teamData ? $this->hydrateTeam($teamData) : false;
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