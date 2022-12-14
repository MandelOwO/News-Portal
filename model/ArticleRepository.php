<?php

class ArticleRepository extends BaseRepository
{

    public function getLastFiveArticles()
    {
        $query = '
            SELECT                 
                article.*,
                name,
                surname
            FROM article
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

    public function getAllArticlesForAuthor($authorId)
    {
        $query = '
            SELECT 
                ar.id as article_id,
                ar.title as title,
                ar.created_at as date,
                ar.published as published,
                au.id as author_id,
                au.name as author_name,
                au.surname as author_surname
            FROM article ar
                LEFT JOIN author au ON au.id = ar.author_id
            WHERE author_id = :authorId
            ORDER BY created_at 
        ';

        $params = [
          ':authorId' => $authorId
        ];

        return $this->dbConn->selectAll($query, $params);
    }

    public function getArticleById($id)
    {
        $query = '
            SELECT 
                article.*,
                name,
                surname
            FROM article
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
            SELECT                 
                ar.*,
                name,
                surname
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
            SELECT 
                ar.*,
                name,
                surname
            FROM article ar
                INNER JOIN author au ON au.id = ar.author_id
            WHERE ar.author_id = :id AND published = 1
        ';
        $data = [
            ':id' => $authorId,
        ];

        return $this->dbConn->selectAll($query, $data);
    }

    public function insert($title, $perex, $text, $image, $author_id, $published)
    {
        $query = '
            INSERT INTO article SET
                title = :title,
                perex = :perex,
                text = :text,
                image = :image,
                author_id = :author_id,
                published = :published
        ';

        $data = [
            ':title' => $title,
            ':perex' => $perex,
            ':text' => $text,
            ':image' => $image,
            ':author_id' => $author_id,
            ':published' => $published,
        ];

        return $this->dbConn->insert($query, $data);
    }

    public function update($id, $title, $perex, $text, $image, $author_id, $published)
    {
        $query = '
            UPDATE article SET
                title = :title,
                perex = :perex,
                text = :text,
                image = :image,
                author_id = :author_id,
                published = :published
            WHERE id = :id
        ';

        $data = [
            ':title' => $title,
            ':perex' => $perex,
            ':text' => $text,
            ':image' => $image,
            ':author_id' => $author_id,
            ':published' => $published,
            ':id' => $id,
        ];

        return $this->dbConn->update($query, $data);
    }

    protected function getTableName()
    {
        return 'article';
    }
}