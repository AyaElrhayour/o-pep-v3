<?php
require_once('./app/config/db.php');

class Plant
{
  private $db;
  private $plantId;
  private $plantName;
  private $plantImg;
  private $plantPrice;
  private $categoryId;

  public function __construct()
  {
    $this->db = new db();
  }

  public function getPlantId()
  {
    return $this->plantId;
  }

  public function setPlantId($plantId)
  {
    $this->plantId = $plantId;
  }

  public function getPlantName()
  {
    return $this->plantName;
  }

  public function setPlantName($plantName)
  {
    $this->plantName = $plantName;
  }

  public function getPlantImg()
  {
    return $this->plantImg;
  }

  public function setPlantImg($plantImg)
  {
    $this->plantImg = $plantImg;
  }

  public function getPlantPrice()
  {
    return $this->plantPrice;
  }

  public function setPlantPrice($plantPrice)
  {
    $this->plantPrice = $plantPrice;
  }

  public function getCategoryId()
  {
    return $this->categoryId;
  }

  public function setCategoryId($categoryId)
  {
    $this->categoryId = $categoryId;
  }

  public function addPlant()
  {
    $file = $_FILES['plant_img']['name'];
    $folder = './assets/imgs/' . $file;
    $fileTmp = $_FILES['plant_img']['tmp_name'];
    $query = "INSERT INTO plants(plant_name, plant_img, plant_price, category_id) VALUES(:plant_name, :plant_img, :plant_price, :category_id)";
    $stmt = $this->db->con()->prepare($query);

    $stmt->bindParam(':plant_name', $this->plantName);
    $stmt->bindParam(':plant_img', $this->plantImg);
    $stmt->bindParam(':plant_price', $this->plantPrice);
    $stmt->bindParam(':category_id', $this->categoryId);

    if ($stmt->execute()) {
      move_uploaded_file($fileTmp, $folder);
      return true;
    } else {
      return false;
    }
  }

  public function getAllPlants()
  {
    $query = "SELECT plants.*, category.category_name FROM plants JOIN category ON plants.category_id = category.category_id";
    $stmt = $this->db->con()->prepare($query);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  public function deletePlant()
  {
    $query = "DELETE FROM plants WHERE plant_id = :plant_id";
    $stmt = $this->db->con()->prepare($query);
    $stmt->bindParam(':plant_id', $this->plantId);
    $stmt->execute();
  }

  public function getCategoryfilter($id)
  {
    try {
      $stmt = $this->db->con()->prepare("SELECT * FROM plants WHERE category_id = :id");
      $stmt->bindParam(":id", $id, PDO::PARAM_INT);

      $stmt->execute();
      $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);

      return $categories;
    } catch (PDOException $e) {
      echo $e->getMessage();
      return false;
    }
  }

  public function search($plant_name)
  {
    $stmt = $this->db->con()->prepare("SELECT * FROM plants WHERE plant_name LIKE :name");
    $param = '%' . $plant_name . '%';
    $stmt->bindParam(":name", $param, PDO::PARAM_STR);
    $success = $stmt->execute();
    if ($success) {
      return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
  }
}
