<?php
  include_once('../templates/page_templates.php');
  include_once('../templates/story_templates.php');
  include_once('../database/dbQueries.php');
  
  if(isset($_SESSION['username'])){
      $username = $_SESSION['username'];
  }
  else{
    $username = null;
  }

  draw_header($username);
  $id = $_GET['id'];
  $story = getStory($id);
  draw_story($story);
  $comments = getComments($id);
 
  draw_comments($comments);
  draw_aside();
  draw_footer();

?>