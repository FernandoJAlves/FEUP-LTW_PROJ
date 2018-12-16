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
        $userId = $user['idUser'];
        $ret = getVote($storyId,$userId);
        if($ret != false){
            if($ret['voteVal'] == $value){
                deleteVote($storyId,$userId);
                $value = 0;
            }
            else {
                updateVote($storyId,$userId,$value);
            }
        }
        else{
            
            insertVote($storyId,$userId,$value);
        }
        
        $votes = getStory($storyId);
        
        echo json_encode(array($storyId,$votes['votes'],$value));
        
        
    
       
    }
?>