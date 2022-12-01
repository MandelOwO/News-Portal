<?php

class AuthorRepository extends BaseRepository
{

    public function getLastFiveAuthors()
    {
        $query = '
            SELECT DISTINCT *
            FROM
            (
                SELECT 
                    au.id,
                    au.name,
                    au.surname
                FROM article ar
                    INNER JOIN author au ON au.id = ar.author_id
                ORDER BY ar.created_at DESC
                LIMIT 5
            ) AS a
        ';

        return $this->dbConn->selectAll($query);
    }

    public function getAuthorTableData()
    {
        $query = '
            SELECT 
                au.id as id,
                au.surname as surname,
                au.name as name,
                COUNT(ar.id) as article_count
            FROM author au
                LEFT JOIN article ar on ar.author_id = au.id
            GROUP BY au.surname, au.name
            ORDER BY au.surname
        ';

        return $this->dbConn->selectAll($query);
    }

    public function checkDelete($id)
    {
        $query = '
            SELECT 
                COUNT(ar.id) as article_count
            FROM author au
                LEFT JOIN article ar on ar.author_id = au.id
            WHERE ar.id = :id
        ';

        $data = [
            ':id' => $id,
        ];

        $result = $this->dbConn->selectOne($query, $data);

        if ($result['article_count'] == 0) {
            return true;
        } else {
            return false;
        }
    }

    public function insert($name, $surname, $profile_photo)
    {
        $query = '
            INSERT INTO author SET
               name = :name,
               surname = :surname,
               profile_photo = :profile_photo
        ';

        $data = [
          ':name' => $name,
          ':surname' => $surname,
          ':profile_photo' => $profile_photo,
        ];

        return $this->dbConn->insert($query, $data);
    }

    public function update($id, $name, $surname, $profile_photo)
    {
        $query = '
            UPDATE author SET
               name = :name,
               surname = :surname,
               profile_photo = :profile_photo
            WHERE id = :id
        ';

        $data = [
            ':name' => $name,
            ':surname' => $surname,
            ':profile_photo' => $profile_photo,
            ':id' => $id
        ];

        return $this->dbConn->update($query, $data);
    }

    protected function getTableName()
    {
        return 'author';
    }
}