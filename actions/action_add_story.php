<?php

  include_once('../database/dbUsers.php');
  include_once('../database/dbQueries.php');
  include_once('../includes/session.php');


    $title = $_POST['title'];
    $story = $_POST['story'];


    
    if($title == "" || $title == null || $story == null){
        echo"<script language='javascript' type='text/javascript'>alert('username field must not be empty');</script>";
        header('Location: ../pages/create_post.php');
    }

    else{
        if(isset($_SESSION['username'])){
            $username = $_SESSION['username'];
          }
          else{
            $username = null;
        }
        $user = getUser($username);
        insertStory($title,$story,$user['idUser']);
        header('Location: ../pages/home.php');
    }

?>