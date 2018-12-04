<?php
  include_once('../includes/database.php');
  /**
   * Verifies if a certain username, password combination
   * exists in the database. Use the sha1 hashing function.
   */
  function recentStories() {
    $db = Database::instance()->db();
    $cmd = 'SELECT * FROM Story,Commentable where Commentable.idCommentable = Story.idStory ORDER BY Commentable.dateC DESC';
    $stmt = $db->prepare($cmd);
    $stmt->execute();
    return $stmt->fetch();
  }

  function hotStories() {
    $db = Database::instance()->db();
    $cmd = 'SELECT * FROM Story,Commentable where Commentable.idCommentable = Story.idStory ORDER BY Commentable.dateC DESC';
    $stmt = $db->prepare($cmd);
    $stmt->execute();
    return $stmt->fetch();
  }


  function controversialStories() {
    $db = Database::instance()->db();
    $cmd = 'SELECT * FROM Story,Commentable where Commentable.idCommentable = Story.idStory ORDER BY Commentable.dateC DESC';
    $stmt = $db->prepare($cmd);
    $stmt->execute();
    return $stmt->fetch();
  }

?>