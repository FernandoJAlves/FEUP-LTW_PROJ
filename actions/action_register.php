<?php

  include_once('../database/dbUsers.php');
  include_once('../includes/session.php');


    $name = $_POST['name'];
    $email = $_POST['email'];
    $pass = $_POST['pass'];
    $conf = $_POST['conf'];
    $age = $_POST['age'];

    if ( !preg_match ("/^[a-zA-Z0-9]+$/", $name)) {
      die(header('Location: ../pages/register.html'));
    }

    
    if($name == "" || $name == null){
        echo"<script language='javascript' type='text/javascript'>alert('username field must not be empty');</script>";
        header('Location: ../pages/register.html');
    }
    else if($pass != $conf){
        echo"<script language='javascript' type='text/javascript'>alert('the value of password is different');</script>";
        header('Location: ../pages/register.html');
    }

    else{
      if(!checkUser($name)){

        $insert = insertUser($name,$pass,$email,$age);
         
        if($insert){
          $_SESSION['username'] = $username;
          $_SESSION['messages'][] = array('type' => 'success', 'content' => 'Signed up and logged in!');
        }else{
          $_SESSION['messages'][] = array('type' => 'error', 'content' => 'Failed to signup!');
        }
        header('Location: ../pages/home.html');
 
      }
      else{
        echo"<script language='javascript' type='text/javascript'>alert('That username already exists');</script>";
        header('Location: ../pages/register.html');
      }
    }

?>