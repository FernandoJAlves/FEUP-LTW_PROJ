<?php

  include_once('../database/dbUsers.php');
  include_once('../includes/session.php');


    $name = $_POST['name'];
    $email = $_POST['email'];
    $pass = $_POST['pass'];
    $conf = $_POST['conf'];
    $age = $_POST['age'];

    if ( !preg_match ("/^[a-zA-Z0-9]+$/", $name)) {
      die(header('Location: ../pages/register.php'));
    }

    
    if($name == "" || $name == null){
        $_SESSION['messages'][] = array('type' => 'error', 'content' => 'username field must not be empty');
        header('Location: ../pages/register.php');
    }
    else if($pass != $conf || $pass == null  || $pass = ""){
        $_SESSION['messages'][] = array('type' => 'error', 'content' => 'the value of password is different');
        header('Location: ../pages/register.php');
    }

    else{
      if(!checkUser($name)){

        $insert = insertUser($name,$pass,$email,$age);
         
        if($insert){
          $_SESSION['username'] = $name;
          $_SESSION['messages'][] = array('type' => 'success', 'content' => 'Signed up and logged in!');
        }else{
          $_SESSION['messages'][] = array('type' => 'error', 'content' => 'Failed to signup!');
        }
        header('Location: ../pages/home.php');
 
      }
      else{
        $_SESSION['messages'][] = array('type' => 'error', 'content' => 'That username already exists');
        header('Location: ../pages/register.php');
      }
    }

?>