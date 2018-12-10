<?php 
  include_once('../database/dbUsers.php');
  include_once('../includes/session.php');

    $username = $_SESSION['username'];
    $age = $_POST['age'];
    $description = $_POST['description'];
    $email = $_POST['email'];

    updateUser($username,$email,$age,$description);
    header('Location: ../pages/profile.php');

?>