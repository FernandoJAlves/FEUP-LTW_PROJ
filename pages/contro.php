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
  $stories = controversialStories();
  draw_stories($stories);
  draw_aside();
  draw_footer();

?>