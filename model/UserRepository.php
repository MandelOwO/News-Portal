<?php

class UserRepository extends BaseRepository
{
    public function RegisterUser($mail, $pass, $name, $surname)
    {
        $sql = '
            INSERT INTO users SET
                              mail = :mail,
                              password = :pass,
                              name = :name,
                              surname = :surname,
                              role = "user",
                              active = 1
        ';

        $params = [
            ':mail' => $mail,
            ':pass' => $pass,
            ':name' => $name,
            ':surname' => $surname,
        ];

        return $this->dbConn->insert($sql, $params);
    }

    public function CheckEmail($mail): bool
    {
        if (!filter_var($mail,FILTER_VALIDATE_EMAIL)) {
            return false;
        }

        $sql = '
            SELECT * FROM users
            WHERE mail = :mail
        ';
        $params = [
            ':mail' => $mail,
        ];

        $mail = $this->dbConn->selectOne($sql, $params);

        if ($mail) {
            return false;
        }

        return true;
    }

    public function GetUserLogin($mail)
    {
        $sql ='
            SELECT * FROM users
            WHERE mail = :mail
        ';

        $params = [
          ':mail' => $mail,
        ];

        return $this->dbConn->selectOne($sql, $params);
    }

    public function insert(string $mail, string $name, string $surname, $role, $active)
    {

    }

    public function update($id, string $mail, string $name, string $surname, $role, $active)
    {
        $sql = '
            UPDATE users SET
                              mail = :mail,
                              name = :name,
                              surname = :surname,
                              role = :role,
                              active = :active
            WHERE id = :id
        ';

        $params = [
            ':mail' => $mail,
            ':name' => $name,
            ':surname' => $surname,
            ':role' => $role,
            ':active' => $active,
            ':id' => $id
        ];

        $this->dbConn->update($sql, $params);

    }


    protected function getTableName(): string
    {
        return 'users';
    }
}