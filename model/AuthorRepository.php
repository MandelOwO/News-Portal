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

    protected function getTableName()
    {
        return 'author';
    }
}