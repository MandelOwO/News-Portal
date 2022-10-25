<?php

class ArticleRepository extends BaseRepository
{

    public function getLastFiveArticles()
    {
        $query = '
            SELECT * FROM article
                INNER JOIN author ON author.id = article.author_id
            ORDER BY created_at
            LIMIT 5
        ';
        $stmt = $this->dbConn->selectAll($query);

        return $stmt;
    }


    protected function getTableName()
    {
        return 'article';
    }
}