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

    protected function getTableName()
    {
        return 'author';
    }
}