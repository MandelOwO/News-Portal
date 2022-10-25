<?php

abstract class BaseRepository
{
    protected $dbConn;

    public function __construct(Database $db)
    {
        $this->dbConn = $db;
    }

    public function getAll()
    {
        $sql = 'SELECT * FROM ' . $this->getTableName();

        return $this->dbConn->selectAll($sql);
    }

    public function getById($id)
    {
        $sql = 'SELECT * FROM ' . $this->getTableName() . ' WHERE id = :id';

        return $this->dbConn->selectOne($sql, [
            ':id' => $id,
        ]);
    }

    public function delete($id)
    {
        $sql = 'DELETE FROM ' . $this->getTableName() . ' WHERE id = :id';

        $this->dbConn->delete($sql, [
            ':id' => $id,
        ]);

    }

    abstract protected function getTableName();
}