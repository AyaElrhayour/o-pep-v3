<?php

require_once('./app/models/Theme.php');

class ThemeController
{
  private $themeModel;

  public function __construct()
  {
    $this->themeModel = new Theme();
  }

  public function getAllThemes()
  {
    return $this->themeModel->getAllThemes();
  }

  public function handleTheme()
  {
    if (isset($_POST["addTheme"])) {
      $this->themeModel->setThemeName($_POST["themeName"]);
      $this->themeModel->setThemeImg($_FILES["theme_img"]['name']);
      if ($this->themeModel->addTheme()) {
        header('Location: dashboard.php');
      }
    } else if (isset($_POST["deleteTheme"])) {
      $this->themeModel->setThemeId($_POST["theme_id"]);
      if ($this->themeModel->deleteTheme()) {
        header('Location: dashboard.php');
      }
    } else if (isset($_POST["updateThemeName"])) {
      $this->themeModel->setThemeId($_POST["updatedThemeID"]);
      $this->themeModel->setThemeName($_POST["newThemeName"]);
      if ($this->themeModel->updateTheme()) {
        header('Location: dashboard.php');
      }
    }
  }
}
