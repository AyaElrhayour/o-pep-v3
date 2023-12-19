<?php 
require_once('./app/models/plant.php');

class PlantController
{
    private $plantModel;

    public function __construct()
    {
        $this->plantModel = new plant();
    }

    public function getAllPlants()
    {
        return $this->plantModel->getAllPlants();
    }

    public function handlePlant()
    {
      if (isset($_POST["addPlant"])) {
        $this->plantModel->setPlantName($_POST["plant_name"]);
        $this->plantModel->setPlantImg($_FILES["plant_img"]['name']);
        $this->plantModel->setPlantPrice($_POST["plant_price"]);
        $this->plantModel->setCategoryId($_POST["category_id"]);
        if($this->plantModel->addPlant()) {
          header('Location: dashboard.php');
        }
        
      } else if (isset($_POST["deletePlant"])) {
        $this->plantModel->setPlantId($_POST["plant_id"]);
        if($this->plantModel->deletePlant()) {
          header('Location: dashboard.php');
        }
        
      }
    }

  }

?>