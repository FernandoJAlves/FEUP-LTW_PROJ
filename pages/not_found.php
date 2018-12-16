<?php
  include_once('../templates/page_templates.php');
  include_once('../includes/session.php');
  if(isset($_SESSION['username'])){
    $username = $_SESSION['username'];
  }
  else{
    $username = null;
  }

  draw_header($username);
  draw_not_found();
  draw_footer();

?>