<?php

include_once('../includes/session.php');
include_once('../database/dbQueries.php');
include_once('../database/dbUsers.php');
include_once('../templates/story_templates.php');

    $text = $_POST['text'];
    $parentId = $_POST['id'];


    
    if($text == null){
        echo"<script language='javascript' type='text/javascript'>alert('username field must not be empty');</script>";
    }

    else{
        if(isset($_SESSION['username'])){
            $username = $_SESSION['username'];
          }
          else{
            $username = null;
        }
        $user = getUser($username);
        insertComment($text,$user['idUser'],$parentId);
        draw_comments(getComments($parentId));
    }

?>