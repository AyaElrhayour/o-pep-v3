<?php
require_once('../config/db.php');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);



class USER
{
  private $db;

  public function __construct()
  {
    $this->db = new db();
  }


  public function register($name, $mail, $pass)
  {
    try {
      $password = password_hash($pass, PASSWORD_BCRYPT);

      $stmt = $this->db->con()->prepare("INSERT INTO users(user_name,user_email,user_password) 
                                                       VALUES(:name, :gmail, :pass)");

      $stmt->bindparam(":name", $name);
      $stmt->bindparam(":gmail", $mail);
      $stmt->bindparam(":pass", $password);
      $stmt->execute();


      return $stmt;
    } catch (PDOException $e) {
      echo $e->getMessage();
    }
  }

  public function updateRole($role, $user_email)
  {
    try {
      $stmt = $this->db->con()->prepare("UPDATE users SET role_id = :role WHERE user_email = :user_email");
      $stmt->bindParam(':role', $role, PDO::PARAM_INT);
      $stmt->bindParam(':user_email', $user_email, PDO::PARAM_STR);

      return $stmt->execute();
    } catch (PDOException $e) {
      echo $e->getMessage();
      return false;
    }
  }

  public function login($email, $pwd)
  {

    if ($this->notEmptyLogin($email, $pwd)) {
      $loggedUser = $this->findUserByEmail($email);
      if ($loggedUser) {

        if (password_verify($pwd, $loggedUser->user_password)) {

          $_SESSION["logged"] = true;
          $_SESSION["user_id"] = $loggedUser->user_id;
          $_SESSION["role_id"] = $loggedUser->role_id;
          if ($loggedUser->role_id == 1) {
            header("Location: ../../home.php");
          } else if ($loggedUser->role_id == 2) {
            header('Location: ../../dashboard.php');
          }
        } else {
          $invalidInputsErr = "Your email or password is incorrect!!";
          header("Location: ../index.php?error=" . $invalidInputsErr);
        }
      } else {
        $invalidInputsErr = "Your email or password is incorrect!!";
        header("Location: ../index.php?error=" . $invalidInputsErr);
      }
    } else {
      $emptyInputsErr = "Please fill out all the fields first!!";
      header("Location: ../index.php?error=" . $emptyInputsErr);
    }
  }




  public function logout()
  {
    unset($_SESSION['logged']);
    unset($_SESSION['user_id']);
    unset($_SESSION['role_id']);

    return true;
  }

  public function notEmptyLogin($email, $pwd)
  {
    if (empty($email) || empty($pwd)) {
      return false;
    }
    return true;
  }

  public function findUserByEmail($email)
  {
    $query = "SELECT * FROM users WHERE user_email = :email";
    $stmt = $this->db->con()->prepare($query);

    $stmt->bindParam(":email", $email);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_OBJ);
    return $result;
  }
}
