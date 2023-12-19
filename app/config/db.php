<?php
 class db {
  private $host = "localhost";
  private $user ="root";
  private $password = "";
  private $dbName = "o-pep-v2";

 public function con()
 {
    $dns = 'mysql:host=' .$this->host. ';dbname=' .$this->dbName;
    $pdo = new PDO($dns , $this->user , $this->password);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    return $pdo;
 }



}

?>