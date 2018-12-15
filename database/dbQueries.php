<?php
  include_once('../includes/database.php');
  /**
   * Verifies if a certain username, password combination
   * exists in the database. Use the sha1 hashing function.
   */
  function recentStories() {
    $db = Database::instance()->db();
    $cmd = 'SELECT Story.idStory as id, Story.title as title, c1.textC as textC, c1.dateC as dateC, count(Comment.idComment) AS N_Comments, (c1.n_upvotes - c1.n_downvotes) as votes, GameItUser.username as username
            FROM Story 
            LEFT JOIN Commentable as c1 ON Story.idStory = c1.idCommentable 
            LEFT JOIN Comment ON Comment.idParent = Story.idStory 
            LEFT JOIN Commentable as c2 ON Comment.idComment = c2.idCommentable
            LEFT JOIN GameItUser ON c1.idUser = GameItUser.idUser
            GROUP BY Story.idStory
            ORDER BY c1.dateC DESC';
    $stmt = $db->prepare($cmd);
    $stmt->execute();
    return $stmt->fetchAll();
  }

  function hotStories() {
    $db = Database::instance()->db();
    $cmd = 'SELECT Story.idStory as id, Story.title as title, c1.textC as textC, c1.dateC as dateC, count(Comment.idComment) AS N_Comments, (c1.n_upvotes - c1.n_downvotes) as votes, GameItUser.username as username
    FROM Story 
    LEFT JOIN Commentable as c1 ON Story.idStory = c1.idCommentable 
    LEFT JOIN Comment ON Comment.idParent = Story.idStory 
    LEFT JOIN Commentable as c2 ON Comment.idComment = c2.idCommentable
    LEFT JOIN GameItUser ON c1.idUser = GameItUser.idUser
    GROUP BY Story.idStory
    ORDER BY votes DESC';
    $stmt = $db->prepare($cmd);
    $stmt->execute();
    return $stmt->fetchAll();
  }


  function controversialStories() {
    $db = Database::instance()->db();
    $cmd = 'SELECT Story.idStory as id, Story.title as title, c1.textC as textC, c1.dateC as dateC, count(Comment.idComment) AS N_Comments, (c1.n_upvotes - c1.n_downvotes) as votes, GameItUser.username as username
    FROM Story 
    LEFT JOIN Commentable as c1 ON Story.idStory = c1.idCommentable 
    LEFT JOIN Comment ON Comment.idParent = Story.idStory 
    LEFT JOIN Commentable as c2 ON Comment.idComment = c2.idCommentable
    LEFT JOIN GameItUser ON c1.idUser = GameItUser.idUser
    WHERE abs(c1.n_upvotes - c1.n_downvotes) < 10 AND c1.n_upvotes > 10 
    GROUP BY Story.idStory
    ORDER BY c1.n_upvotes DESC';
    $stmt = $db->prepare($cmd);
    $stmt->execute();
    return $stmt->fetchAll();
  }

  function searchStories($pattern) {
    $db = Database::instance()->db();
    $cmd = 'SELECT Story.idStory as id, Story.title as title, c1.textC as textC, c1.dateC as dateC, count(Comment.idComment) AS N_Comments, (c1.n_upvotes - c1.n_downvotes) as votes, GameItUser.username as username
            FROM Story 
            LEFT JOIN Commentable as c1 ON Story.idStory = c1.idCommentable 
            LEFT JOIN Comment ON Comment.idParent = Story.idStory 
            LEFT JOIN Commentable as c2 ON Comment.idComment = c2.idCommentable
            LEFT JOIN GameItUser ON c1.idUser = GameItUser.idUser
            WHERE Story.title like ? OR c1.textC like ?
            GROUP BY Story.idStory
            ORDER BY c1.dateC DESC';
    $stmt = $db->prepare($cmd);
    $stmt->execute(array("%".$pattern."%","%".$pattern."%"));
    return $stmt->fetchAll();
  }

  function getStory($id) {
    $db = Database::instance()->db();
    $cmd = 'SELECT Story.idStory as id, Story.title as title, c1.textC as textC, c1.dateC as dateC, count(Comment.idComment) AS N_Comments, (c1.n_upvotes - c1.n_downvotes) as votes, GameItUser.username as username
    FROM Story 
    LEFT JOIN Commentable as c1 ON Story.idStory = c1.idCommentable 
    LEFT JOIN Comment ON Comment.idParent = Story.idStory 
    LEFT JOIN Commentable as c2 ON Comment.idComment = c2.idCommentable
    LEFT JOIN GameItUser ON c1.idUser = GameItUser.idUser
    WHERE Story.idStory = ?
    GROUP BY Story.idStory';
    $stmt = $db->prepare($cmd);
    $stmt->execute(array($id));
    return $stmt->fetch();
  }

  function getComments($storyId) {
    $db = Database::instance()->db();
    $cmd = 'SELECT Comment.idComment as id, Commentable.textC as textC, Commentable.dateC as dateC, GameItUser.username as username
    FROM Comment 
    LEFT JOIN Commentable ON Comment.idComment = Commentable.idCommentable
    LEFT JOIN GameItUser ON Commentable.idUser = GameItUser.idUser
    WHERE Comment.idParent = ? 
    GROUP BY Comment.idComment
    ORDER BY Commentable.dateC DESC';
    $stmt = $db->prepare($cmd);
    $stmt->execute(array($storyId));
    return $stmt->fetchAll();
  }

  function getComment($commentId) {
    $db = Database::instance()->db();
    $cmd = 'SELECT Comment.idComment as id, Commentable.textC as textC, Commentable.dateC as dateC, GameItUser.username as username
    FROM Comment 
    LEFT JOIN Commentable ON Comment.idComment = Commentable.idCommentable
    LEFT JOIN GameItUser ON Commentable.idUser = GameItUser.idUser
    WHERE Comment.idComment = ? 
    GROUP BY Comment.idComment
    ORDER BY Commentable.dateC DESC';
    $stmt = $db->prepare($cmd);
    $stmt->execute(array($storyId));
    return $stmt->fetch();
  }

  function getCommentables($userId){
    $db = Database::instance()->db();
    $cmd = 'SELECT Commentable.idCommentable as id, Commentable.dateC
    FROM Commentable
    WHERE Commentable.idUser = ? 
    ORDER BY Commentable.dateC DESC';
    $stmt = $db->prepare($cmd);
    $stmt->execute(array($storyId));
    return $stmt->fetchAll();
  }

  function getPoints($commentableId){
    $db = Database::instance()->db();
    $cmd = 'SELECT (Commentable.n_upvotes - Commentable.n_downvotes) as points
    FROM Commentable
    WHERE Commentable.idCommentable = ?';
    $stmt = $db->prepare($cmd);
    $stmt->execute(array($commentableId));
    return $stmt->fetch();
  }

  function insertStory($title, $text,$userId) {
    $db = Database::instance()->db();
    $date = date("Y-m-d H:i");
    $stmt = $db->prepare('INSERT INTO Commentable(textC,dateC,idUser,n_upvotes,n_downvotes) VALUES(?, Datetime(?), ?, 0,0)');
    $value = $stmt->execute(array($text,$date,$userId));
    if($value == false){
      return $value;
    }
    $stmt2 = $db->prepare('SELECT last_insert_rowid()');
    $value2 = $stmt2->execute();
    $storyId = $stmt2->fetchColumn();
    if($value2 == false){
      return $value2;
    }
    $stmt3 = $db->prepare('INSERT INTO Story(idStory,title) VALUES(?, ?)');
    $value3 = $stmt3->execute(array($storyId,$title));
    if($value3 == false){
      return $value3;
    }
    return $storyId;
  }

  function insertComment($text,$userId,$parentId) {
    $db = Database::instance()->db();
    $date = gmdate("Y-m-d H:i:s");
    $stmt = $db->prepare('INSERT INTO Commentable(textC,dateC,idUser,n_upvotes,n_downvotes) VALUES(?, Datetime(?), ?, 0,0)');
    $value = $stmt->execute(array($text,$date,$userId));
    if($value == false){
      return $value;
    }
    $stmt2 = $db->prepare('SELECT last_insert_rowid()');
    $value2 = $stmt2->execute();
    $commentId = $stmt2->fetchColumn();
    if($value2 == false){
      return $value2;
    }
    $stmt3 = $db->prepare('INSERT INTO Comment(idParent,idComment) VALUES(?, ?)');
    $value3 = $stmt3->execute(array($parentId,$commentId));
    return $value3;
    
  }

  function insertVote($id,$userId,$value) {
    $db = Database::instance()->db();
    $stmt = $db->prepare('INSERT INTO UserVote(voteVal,idUser,IdCommentable) VALUES(?,?,?)');
    $ret = $stmt->execute(array($value,$userId,$id));
    return $ret;
  }

  function deleteVote($id,$userId) {
    $db = Database::instance()->db();
    $stmt = $db->prepare('DELETE FROM UserVote WHERE idUser = ? AND idCommentable = ?');
    $ret = $stmt->execute(array($userId,$id));
    return $ret;
  }

  function getVote($id,$userId) {
    $db = Database::instance()->db();
    $stmt = $db->prepare('SELECT voteVal FROM UserVote WHERE idUser = ? AND idCommentable = ?');
    $value = $stmt->execute(array($userId,$id));
    $ret = $stmt->fetch();
    return $ret;
  }

  function updateVote($id,$userId,$value) {
    $db = Database::instance()->db();
    $stmt = $db->prepare('UPDATE UserVote SET voteVal = ? WHERE idUser = ? AND idCommentable = ?');
    $ret = $stmt->execute(array($value,$userId,$id));
    return $ret;
  }

?>