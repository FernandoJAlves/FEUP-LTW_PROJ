<?php
  include_once('../templates/page_templates.php');
  include_once('../templates/story_templates.php');
  include_once('../database/dbUsers.php');
  
  draw_header($_SESSION['username']);
  $user = getUser($_SESSION['username']);
  draw_edit_profile($user);
  draw_aside();
  draw_footer();

?>