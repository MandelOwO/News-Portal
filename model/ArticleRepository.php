<?php

class ArticleRepository extends BaseRepository
{

    public function getLastFiveArticles()
    {
        $query = '
            SELECT * FROM article
                INNER JOIN author ON author.id = article.author_id
            ORDER BY created_at DESC
            LIMIT 5
        ';
        $stmt = $this->dbConn->selectAll($query);

        return $stmt;
    }

    public function getArticleById($id)
    {
        $query = '
            SELECT * FROM article
                INNER JOIN author ON author.id = article.author_id
            WHERE article.id = :id

        ';
        $data = [
            ':id' => $id,
        ];

        $stmt = $this->dbConn->selectOne($query, $data);

        return $stmt;
    }


    protected function getTableName()
    {
        return 'article';
    }
}