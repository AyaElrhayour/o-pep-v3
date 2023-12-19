<?php

// require_once('../config/db.php');
require_once('../models/user.php');


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST["updateRole"])) {
    $role = isset($_POST["role_id"]) ? $_POST["role_id"] : null;
    $user_email = isset($_SESSION["user_email"]) ? $_SESSION["user_email"] : null;

    if ($role !== null && $user_email !== null) {
        $user = new USER();
        $updateResult = $user->updateRole($role, $user_email);
        if ($updateResult) {      
            if ($_POST["role_id"] == 1) {
                header("Location: ../../home.php");
              }else{
                header("Location: ../../index.php");
              }
          
        } else {
            echo "Role update failed!";
        }
    } else {
        echo "Invalid role or user email.";
    }
}
