<?php
  include_once('../templates/page_templates.php');
  if(isset($_SESSION['username'])){
    $username = $_SESSION['username'];
  }
  else{
    $username = null;
  }
  
  draw_header($username);
  draw_create_post();
  draw_footer();

?>