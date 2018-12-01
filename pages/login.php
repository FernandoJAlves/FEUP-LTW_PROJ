<?php
  include_once('../database/dbUsers.php');
  $username = $_POST['name'];
  $password = $_POST['pass'];
  if (checkUserPassword($username, $password)) {
    header('Location: ../pages/home.html');
  } else {
    header('Location: ../pages/login.html');
  }
?>