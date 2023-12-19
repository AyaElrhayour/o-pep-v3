<?php
require_once('../models/user.php');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


session_start();

if (isset($_POST["signup"])) {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $l3ayba = new USER();
    $registrationResult = $l3ayba->register($name, $email, $password);

    if ($registrationResult) {

        $_SESSION["user_email"] = $email;
        // die(print_r(here));
        header('location: ../../role.php');
        exit;
    } else {
        echo 'Registration failed';
    }
} else if (isset($_POST["login"])) {

    $email = $_POST["email"];
    $password = $_POST["password"];

    $l3ayba = new USER();
    $l3ayba->login($email, $password);

    if ($l3ayba) {
        if ($_SESSION["role_id"] == 1) {
            header("Location: http://localhost/o-pep-v3/home.php");
        } else if ($_SESSION["role_id"] == 2) {
            header("Location: http://localhost/o-pep-v3/dashboard.php");
        }
    } else {
        die("not valid");
    }
}
