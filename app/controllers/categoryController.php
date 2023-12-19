<?php 
require_once('./app/models/Category.php');

class CategoryController
{
    private $categoryModel;

    public function __construct()
    {
        $this->categoryModel = new Category();
    }

   
    public function getAllCategories()
    {
        return $this->categoryModel->getAllCategories();
    }
    public function handleCategory()
    {
        if (isset($_POST["addCategory"])) {
            $this->categoryModel->setCategoryName($_POST["categoryName"]);
            $this->categoryModel->addCategory();
        } else if (isset($_POST["deleteCategory"])) {
            $this->categoryModel->setCategoryId($_POST["category_id"]);
            // die(print_r($_POST["category_id"]));
           if($this->categoryModel->deleteCategory()) {
              header('Location: dashboard.php');
            }
        } else if (isset($_POST["updateCategoryName"])) {
            $this->categoryModel->setCategoryId($_POST["updatedCategoryID"]);
            $this->categoryModel->setCategoryName($_POST["newCategoryName"]);
            if($this->categoryModel->updateCategory()) {
              header('Location: dashboard.php');
            }
            
        }
    }
}

?>