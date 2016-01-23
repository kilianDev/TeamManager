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
     * @param int $limit
     * @param int $offset
     * @param array $orderBy
     */
    public function findAll($limit, $offset = 0, $orderBy = array())
    {

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