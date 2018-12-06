<?php
  include_once('../includes/database.php');
  /**
   * Verifies if a certain username, password combination
   * exists in the database. Use the sha1 hashing function.
   */
  function recentStories() {
    $db = Database::instance()->db();
    $cmd = 'SELECT Story.idStory as id, Story.title as title, Commentable.textC as textC, Commentable.dateC as dateC, count(Comment.idComment) AS N_Comments
            FROM Story,Commentable, Comment
            WHERE Commentable.idCommentable = Story.idStory AND Comment.idParent = Commentable.idCommentable
            GROUP BY Story.idStory
            ORDER BY Commentable.dateC DESC';
    $stmt = $db->prepare($cmd);
    $stmt->execute();
    return $stmt->fetchAll();
  }

  function hotStories() {
    $db = Database::instance()->db();
    $cmd = 'SELECT * FROM Story,Commentable where Commentable.idCommentable = Story.idStory ORDER BY Commentable.dateC DESC';
    $stmt = $db->prepare($cmd);
    $stmt->execute();
    return $stmt->fetchAll();
  }


  function controversialStories() {
    $db = Database::instance()->db();
    $cmd = 'SELECT * FROM Story,Commentable where Commentable.idCommentable = Story.idStory ORDER BY Commentable.dateC DESC';
    $stmt = $db->prepare($cmd);
    $stmt->execute();
    return $stmt->fetchAll();
  }

  function addStory() {
    $db = Database::instance()->db();
    $cmd = 'SELECT * FROM Story,Commentable where Commentable.idCommentable = Story.idStory ORDER BY Commentable.dateC DESC';
    $stmt = $db->prepare($cmd);
    $stmt->execute();
    return $stmt->fetchAll();
  }

?>