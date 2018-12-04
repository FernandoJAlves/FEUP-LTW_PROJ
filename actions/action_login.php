<?php
  include_once('../database/dbUsers.php');
  include_once('../includes/session.php');
  $username = $_POST['name'];
  $password = $_POST['pass'];
  if (checkUserPassword($username, $password)) {
    $_SESSION['username'] = $username;
    $_SESSION['messages'][] = array('type' => 'success', 'content' => 'Logged in successfully!');
    header('Location: ../pages/home.php');
  } else {
    $_SESSION['messages'][] = array('type' => 'error', 'content' => 'Login failed!');
    header('Location: ../pages/login.php');
  }
?>