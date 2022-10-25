<?php

class Database
{
    const HOST = 'localhost';
    const DBNAME = 'nekonews';
    const USER = 'root';
    const PASS = '';

    private $conn;

    public function __construct()
    {
//        $connString = sprintf('mysql:host=%s;dbname=%s', self::HOST, self::DBNAME);

        $this->conn = new PDO('mysql:host=' . self::HOST . ';dbname=' . self::DBNAME ,
            self::USER,
            self::PASS, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            ]);
        $this->conn->query('SET NAMES utf8');
    }

    // select

    public function selectAll($sql, $params = [])
    {
        $stmt = $this->execute($sql, $params);

        return $stmt->fetchAll();
    }

    public function selectOne($sql, $params)
    {
        $stmt = $this->execute($sql, $params);

        return $stmt->fetch();
    }

    // insert
    public function insert($sql, $params)
    {
        $stmt = $this->execute($sql, $params);

        return $this->conn->lastInsertId();
    }

    // update
    public function update($sql, $params)
    {
        $stmt = $this->execute($sql, $params);

        return $stmt->rowCount();
    }

    // delete
    public function delete($sql, $params)
    {
        $stmt = $this->execute($sql, $params);

        return $stmt->rowCount();
    }

    protected function execute($sql, $params)
    {
        $stmt = $this->conn->prepare($sql);
        $stmt->execute($params);

        return $stmt;
    }
}