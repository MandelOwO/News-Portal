<?php

class CategoryRepository extends BaseRepository
{

    public function getCategoriesForArticle($articleId)
    {
        $query = '
            SELECT 
                ca.id AS category_id,
                ca.name AS category_name
            FROM article_category ac
                INNER JOIN article ar ON ar.id = ac.article_id
                INNER JOIN category ca ON ca.id = ac.category_id
            WHERE ar.id = :articleId;
        ';

        $data = [
            ':articleId' => $articleId,
        ];

        return $this->dbConn->selectAll($query, $data);
    }

    public function writeCategories($articleId)
    {
        $categories = $this->getCategoriesForArticle($articleId);

        $string = '';
        foreach ($categories as $category) {
            $string .= '<a href="../category/articles.php?category_id=' . $category['category_id'] . '">#' . $category['category_name'] . ' </a>';
        }

        return $string;
    }

    public function getCategoriesFirstLetter()
    {
        $query = '
            SELECT 
                LEFT(name, 1) AS first_letter
            FROM `category`
                GROUP BY LEFT(name, 1)
                ORDER BY LEFT(name, 1)
        ';

        return $this->dbConn->selectAll($query);
    }

    public function getCategoriesByLetter($letter)
    {
        $query = '
            SELECT 
                id,
                name,
                LEFT(name, 1) AS first_letter
            FROM `category`
                WHERE  LEFT(name, 1) = :letter
                ORDER BY name
        ';

        $data = [
            ':letter' => $letter,
        ];

        return $this->dbConn->selectAll($query, $data);
    }

    public function getLastFiveCategories()
    {
        $query = '
            SELECT DISTINCT *
            FROM
            (
            SELECT 
                    ca.id as category_id,
                    ca.name as category_name
                FROM article ar
                    INNER JOIN article_category ac ON ac.article_id = ar.id
                    INNER JOIN category ca ON ca.id = ac.category_id
                ORDER BY ar.created_at DESC
                LIMIT 5 
            ) AS a 
        ';

        return $this->dbConn->selectAll($query);
    }


    protected function getTableName()
    {
        return 'category';
    }
}