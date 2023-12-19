<?php

include("../model/category.php");

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


if (isset($_POST["addCategory"])) {
    $nameC = $_POST["categoryName"];
    $l3ayba = new category($dbconn->pdo);
    $Result = $l3ayba->addC($nameC);
    if ($Result ) {
      header('location: ../views/dashboard.php');
      exit; 
  } else {
      echo 'Registration failed';
  }  


}else if (isset($_POST["deleteCategory"])) {
    $id =  $_POST["category_id"];
    $l3ayba = new category($dbconn->pdo);
    $Result = $l3ayba->deleteC($id);
    if ($Result ) {
      header('location: ../views/dashboard.php');
      exit; 
  } else {
      echo 'Registration failed';
  } 
 
} else if(isset($_POST["updateCategoryName"])) {
  $nameC = $_POST["newCategoryName"]; 
  $id =  $_POST["updatedCategoryID"]; 
  $l3ayba = new category($dbconn->pdo);
  $Result = $l3ayba->updateC($id, $nameC);
  if ($Result) {
      header('location: ../views/dashboard.php');
      exit;
  } else {
      echo 'Update failed';
  }
}
