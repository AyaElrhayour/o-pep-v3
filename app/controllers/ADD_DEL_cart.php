<?php

require_once('../models/cart.php');

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();


if (isset($_SESSION["user_id"])) {
    $user_id = $_SESSION["user_id"];

    if (isset($_POST['add'])) {
        $plant_id = $_POST['plant_id'];
        $cart = new Cart();
        $success = $cart->addToCart($plant_id);
        if ($success) {
            header("location: http://localhost/o-pep-v3/home.php");
        }
    }

    if (isset($_POST["order"])) {
        $cart = new Cart();
        $success = $cart->order();
        if ($success) {
            echo "Order successful!";
        } else {
            echo "Error processing the order.";
        }
    } else if (isset($_POST["clear"])) {
        $cart = new Cart();
        $sucess = $cart->clearCart();
        if ($sucess) {
            header("Location: ../home.php");
        } else {
            echo "error";
        }
    }
} else {
    echo "Error: user_id is not set in the session.";
}
