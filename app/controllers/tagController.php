<?php

require_once('./app/models/Tag.php');

class TagController
{
  private $tagModel;

  public function __construct()
  {
    $this->tagModel = new Tag();
  }

  public function getAllTags()
  {
    return $this->tagModel->getAllTags();
  }

  public function handleTag()
  {
    if (isset($_POST["addTag"])) {
      $this->tagModel->setTagName($_POST["tagName"]);
      $this->tagModel->setThemeId($_POST["theme_id"]);
      if ($this->tagModel->addTag()) {
        header('Location: dashboard.php');
      }
    } else if (isset($_POST["deleteTag"])) {
      $this->tagModel->setTagId($_POST["tag_id"]);
      if ($this->tagModel->deleteTag()) {
        header('Location: dashboard.php');
      }
    }
  }
}
