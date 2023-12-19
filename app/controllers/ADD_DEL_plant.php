<?php
include("../model/plant.php");
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (isset($_POST["addPlant"])) {
    $nameP = $_POST['plant_name'];
    $imgP = $_FILES['plant_img']['name'];
    $priceP = $_POST['plant_price'];
    $categoryP = $_POST['category_id'];
    
    $l3ayba = new plant($dbconn->pdo);
    $Result = $l3ayba->addP($nameP, $imgP, $priceP, $categoryP);

    if ($Result) {
        header('location: ../views/dashboard.php');
        exit;
    } else {
        echo 'Registration failed';
    }
}else if (isset($_POST["deletePlant"])) {
    $id = $_POST["plant_id"];
    $l3ayba = new plant($dbconn->pdo);
    $Result = $l3ayba->deleteP($id);
    if ($Result ) {
      header('location: ../views/dashboard.php');
      exit; 
  } else {
      echo 'Registration failed';
  } 
  }
