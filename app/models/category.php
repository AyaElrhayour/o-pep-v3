<?php

require_once('./app/config/db.php');

class Category
{
    private $db;
    private $categoryId;
    private $categoryName;

    public function __construct()
    {
        $this->db = new db();
    }

    public function getCategoryId()
    {
        return $this->categoryId;
    }

    public function setCategoryId($categoryId)
    {
        $this->categoryId = $categoryId;
    }

    public function getCategoryName()
    {
        return $this->categoryName;
    }

    public function setCategoryName($categoryName)
    {
        $this->categoryName = $categoryName;
    }

    public function addCategory()
    {
        $query = "INSERT INTO category(category_name) VALUES(:categoryName)";
        $stmt = $this->db->con()->prepare($query);
        if ($stmt) {
            $stmt->bindParam(":categoryName", $this->categoryName);
            $stmt->execute();
            return $stmt->rowCount() > 0;
        } else {
            return false;
        }
    }

    public function getAllCategories()
    {
        $query = "SELECT * FROM category";
        $stmt = $this->db->con()->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function updateCategory()
    {
        $query = "UPDATE category SET category_name = :categoryName WHERE category_id = :categoryId";
        $stmt = $this->db->con()->prepare($query);
        $stmt->bindParam(":categoryName", $this->categoryName);
        $stmt->bindParam(":categoryId", $this->categoryId);
        return $stmt->execute();
    }

    public function deleteCategory()
    {
        $query = "DELETE FROM category WHERE category_id = :categoryId";
        $stmt = $this->db->con()->prepare($query);
        $stmt->bindParam(":categoryId", $this->categoryId);
        $stmt->execute();
        return $stmt->rowCount() > 0;
    }
}
