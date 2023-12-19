<?php

require_once('./app/config/db.php');

class Tag
{
  private $db;
  private $tagId;
  private $tagName;
  private $themeId;

  public function __construct()
  {
    $this->db = new db();
  }

  public function getTagId()
  {
    return $this->tagId;
  }

  public function setTagId($tagId)
  {
    $this->tagId = $tagId;
  }

  public function getTagName()
  {
    return $this->tagName;
  }

  public function setTagName($tagName)
  {
    $this->tagName = $tagName;
  }

  public function setThemeId($themeId)
  {
    $this->themeId = $themeId;
  }

  public function addTag()
  {
    $query1 = "INSERT INTO tag(tag_name) VALUES(:tag_name)";
    $stmt1 = $this->db->con()->prepare($query1);
    $stmt1->bindParam(':tag_name', $this->tagName);

    if ($stmt1->execute()) {
      $query3 = "SELECT * FROM tag ORDER BY tag_id DESC LIMIT 1";
      $stmt3 = $this->db->con()->prepare($query3);
      $stmt3->execute();
      $latestTag = $stmt3->fetch(PDO::FETCH_OBJ);
      if ($latestTag) {
        $query2 = "INSERT INTO theme_tag(theme_id, tag_id) VALUES(:theme_id, :tag_id)";
        $stmt2 = $this->db->con()->prepare($query2);
        $stmt2->bindParam(':theme_id', $this->themeId);
        $stmt2->bindParam(':tag_id', $latestTag->tag_id);

        return $stmt2->execute();
      }
    } else {
      return false;
    }
  }

  public function getAllTags()
  {
    $query = "SELECT * FROM tag t JOIN theme_tag tt on t.tag_id = tt.tag_id JOIN theme th ON tt.theme_id = th.theme_id";
    $stmt = $this->db->con()->prepare($query);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  public function deleteTag()
  {
    $query = "DELETE FROM tag WHERE tag_id = :tag_id";
    $stmt = $this->db->con()->prepare($query);
    $stmt->bindParam(':tag_id', $this->tagId);

    return $stmt->execute();
  }
}
