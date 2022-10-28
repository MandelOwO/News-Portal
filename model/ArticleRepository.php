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

    public function getArticlesByCategory($categoryId)
    {
        $query = '
            SELECT *
            FROM article ar
                INNER JOIN article_category ac ON ac.article_id = ar.id
                INNER JOIN author au ON au.id = ar.author_id
            WHERE ac.category_id = :id
        ';
        $data = [
            ':id' => $categoryId,
        ];

        return $this->dbConn->selectAll($query, $data);
    }

    public function getArticlesByAuthor($authorId)
    {
        $query = '
            SELECT *
            FROM article ar
                INNER JOIN author au ON au.id = ar.author_id
            WHERE ar.author_id = :id
        ';
        $data = [
            ':id' => $authorId,
        ];

        return $this->dbConn->selectAll($query, $data);
    }


    protected function getTableName()
    {
        return 'article';
    }
}