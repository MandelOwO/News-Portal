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
            $string .= '<a href="' . $category['category_id'] . '">' . $category['category_name'] . ' </a>'; /* TODO link */
        }

        return $string;

    }

    protected function getTableName()
    {
        return 'category';
    }
}