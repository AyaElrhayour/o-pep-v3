<?php

require_once('./app/config/db.php');

class Theme
{
  private $db;
  private $themeId;
  private $themeName;
  private $themeImg;

  public function __construct()
  {
    $this->db = new db();
  }

  public function getThemeId()
  {
    return $this->themeId;
  }

  public function setThemeId($themeId)
  {
    $this->themeId = $themeId;
  }

  public function getThemeName()
  {
    return $this->themeName;
  }

  public function setThemeName($themeName)
  {
    $this->themeName = $themeName;
  }

  public function getThemeImg()
  {
    return $this->themeImg;
  }

  public function setThemeImg($themeImg)
  {
    $this->themeImg = $themeImg;
  }

  public function addTheme()
  {
    $file = $_FILES['theme_img']['name'];
    $folder = './assets/imgs/' . $file;
    $fileTmp = $_FILES['theme_img']['tmp_name'];
    $query = "INSERT INTO theme(theme_name, theme_img) VALUES(:theme_name, :theme_img)";
    $stmt = $this->db->con()->prepare($query);

    $stmt->bindParam(':theme_name', $this->themeName);
    $stmt->bindParam(':theme_img', $file);

    if ($stmt->execute()) {
      move_uploaded_file($fileTmp, $folder);
      return true;
    } else {
      return false;
    }
  }

  public function getAllThemes()
  {
    $query = "SELECT * FROM theme";
    $stmt = $this->db->con()->prepare($query);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  public function updateTheme()
  {
    $query = "UPDATE theme SET theme_name = :theme_name WHERE theme_id = :theme_id";
    $stmt = $this->db->con()->prepare($query);
    $stmt->bindParam(':theme_name', $this->themeName);
    $stmt->bindParam(':theme_id', $this->themeId);

    return $stmt->execute();
  }

  public function deleteTheme()
  {
    $query = "DELETE FROM theme WHERE theme_id = :theme_id";
    $stmt = $this->db->con()->prepare($query);
    $stmt->bindParam(':theme_id', $this->themeId);

    return $stmt->execute();
  }
}
