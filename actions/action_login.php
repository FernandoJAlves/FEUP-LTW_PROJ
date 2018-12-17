<?php
  include_once('../database/dbUsers.php');
  include_once('../includes/session.php');
  $username = $_POST['name'];
  $password = $_POST['pass'];
  if ($ret = checkUserPassword($username, $password)) {
    $_SESSION['username'] = $username;
    $_SESSION['messages'] = null;
    header('Location: ../pages/home.php');
  } else {
    $_SESSION['messages'] = 'Login failed!';
    header('Location: ../pages/login.php');
  }
?>