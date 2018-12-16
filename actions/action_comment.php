<?php
ob_start();
include_once('../includes/session.php');
include_once('../database/dbQueries.php');
include_once('../database/dbUsers.php');
include_once('../templates/story_templates.php');
header('Content-Type: application/json');

    $text = $_POST['text'];
    $parentId = $_POST['id'];


    
    if($text == null){
        $_SESSION['messages'][] = array('type' => 'error', 'content' => 'comment text field must not be empty');
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
        $comments = getComments($parentId);
        $num = count($comments);
        
        draw_comments_recursive($parentId,$comments);
        $output = ob_get_clean();
        echo json_encode(array($output,$num));

    }

?>