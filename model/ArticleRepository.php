<?php

class ArticleRepository extends BaseRepository
{

    public function getLastFiveArticles()
    {
        $query = '
            SELECT * FROM article
                INNER JOIN author ON author.id = article.author_id
            WHERE published = 1
            ORDER BY created_at DESC
 
            LIMIT 5

        ';
        $stmt = $this->dbConn->selectAll($query);

        return $stmt;
    }

    public function getAllArticles()
    {
        $query = '
            SELECT 
                ar.id as article_id,
                ar.title as title,
                ar.created_at as date,
                ar.published as published,
                au.name as author_name,
                au.surname as author_surname
            FROM article ar
                LEFT JOIN author au ON au.id = ar.author_id
            ORDER BY created_at DESC
        ';

        return $this->dbConn->selectAll($query);
    }

    public function getArticleById($id)
    {
        $query = '
            SELECT * FROM article
                INNER JOIN author ON author.id = article.author_id
            WHERE article.id = :id AND published = 1

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
            WHERE ac.category_id = :id AND published = 1
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
            WHERE ar.author_id = :id AND published = 1
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