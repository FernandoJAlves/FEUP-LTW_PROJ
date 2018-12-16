<?php
  include_once('../includes/session.php');
  
  session_destroy();
  session_start();
  $_SESSION['messages'] = null;
  header('Location: ../pages/home.php');
?>