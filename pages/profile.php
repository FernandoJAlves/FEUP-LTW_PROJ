<?php
  include_once('../templates/page_templates.php');
  include_once('../templates/story_templates.php');
  include_once('../database/dbUsers.php');
  
  if(isset($_SESSION['username'])){
    $username = $_SESSION['username'];
  }
  else{
    $username = null;
  }

  draw_header($username);
  $user = getUser($_GET['username']);
  draw_profile($user);
  draw_footer();

?>