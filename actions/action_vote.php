<?php 
    include_once('../includes/session.php');
    include_once('../database/dbQueries.php');
    include_once('../database/dbUsers.php');
    header('Content-Type: application/json');
    if(isset($_SESSION['username'])){
        $value = $_POST['value'];
        $storyId = $_POST['storyId'];
        $username = $_SESSION['username'];
        $user = getUser($username);
        //$ret = insertVote($storyId,$user['idUser'],$value);
        echo json_encode(array($storyId,$value));
        
        
    
       
    }
?>