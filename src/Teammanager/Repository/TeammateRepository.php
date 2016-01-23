<?php

namespace Teammanager\Repository;


use Doctrine\DBAL\Connection;
use Teammanager\Model\Teammate;

class TeammateRepository implements RepositoryInterface {

    /**
     * @var Connection
     */
    protected $db;

    public function __construct(Connection $db)
    {
        $this->db = $db;
    }

    /**
     * Save the teammate
     * @param Teammate $teammate
     */
    public function save($teammate)
    {
        $teammateData = array(
            'firstname' => $teammate->getFirstname(),
            'lastname' => $teammate->getLastname(),
            'email' => $teammate->getEmail(),
            'phone' => $teammate->getPhone(),
            'image' => $teammate->getImage(),
        );

        if ($teammate->getId()) {
            $this->db->update('teammate', $teammateData, array('id' => $teammate->getId()));
        }
        else {
            $this->db->insert('teammate', $teammateData);
            // Get the id of the newly created artist and set it on the entity.
            $id = $this->db->lastInsertId();
            $teammate->setId($id);
        }

        return $teammate;
    }

    /**
     * Return the number of teammates
     */
    public function getCount()
    {

    }

    /**
     * Delete a teammate
     * @param int $id
     */
    public function delete($id)
    {

    }

    /**
     * Return a collection of teammates
     *
     */
    public function findAll()
    {
        $orderBy = array('firstname' => 'ASC');

        $queryBuilder = $this->db->createQueryBuilder();
        $queryBuilder
            ->select('tm.*')
            ->from('teammate', 'tm')
            ->orderBy('tm.' . key($orderBy), current($orderBy));
        $statement = $queryBuilder->execute();
        $teammatesData = $statement->fetchAll();

        $teammates = array();
        foreach ($teammatesData as $teammateData) {
            $teammateId = $teammateData['id'];
            $teammates[$teammateId] = $this->hydrateTeammate($teammateData);
        }

        return $teammates;
    }

    /**
     * Return a teammate based on its id
     * @param int $id
     * @return bool|void
     */
    public function find($id)
    {
        $teammateData = $this->db->fetchAssoc('SELECT * FROM teammate WHERE id = ?', array($id));
        return $teammateData ? $this->hydrateTeammate($teammateData) : false;
    }

    public function hydrateTeammate($teamData)
    {
        $teammate = new Teammate();
        $teammate->setId($teamData['id']);
        $teammate->setFirstname($teamData['firstname']);
        $teammate->setLastname($teamData['lastname']);
        $teammate->setEmail($teamData['email']);
        $teammate->setPhone($teamData['phone']);
        $teammate->setImage($teamData['image']);

        return $teammate;
    }
}