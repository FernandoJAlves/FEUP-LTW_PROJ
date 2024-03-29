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
  if($story == null){
    header('Location: ../pages/not_found.php');
  }
  draw_story($story);
  $comments = getComments($id);
  draw_comments($id,$comments);
  draw_aside();
  draw_footer();

?>