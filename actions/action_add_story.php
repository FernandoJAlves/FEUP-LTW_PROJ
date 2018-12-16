<?php

  include_once('../database/dbUsers.php');
  include_once('../database/dbQueries.php');
  include_once('../includes/session.php');
  include_once('action_upload.php');


    $title = $_POST['title'];
    $story = $_POST['story'];


    
    if($title == "" || $title == null || $story == null){
        $_SESSION['messages'] = 'Text fields must not be empty';
        header('Location: ../pages/create_post.php');
    }

        if(isset($_SESSION['username'])){
            $username = $_SESSION['username'];
          }
          else{
            $username = null;
        }
        $user = getUser($username);
        $storyId = insertStory($title,$story,$user['idUser']);
        
//If an image was uploaded
if($_FILES['image']['name'])
{
    //No errors detected
    if((!$_FILES['image']['error']) && ($_FILES['image']['size'] != FALSE))
    {
        // Generate filenames for original, small and medium files
        $profileFileName = "../img/stories/$storyId.jpg";
        $smallFileName = "../img/thumbnails/$storyId.jpg";
        // Create an image representation of the original image
        if ( !($original = createImageFromType($_FILES['image'])) ) {
            //Error message here and go on - $message = 'Received wrong file type. Please use jpeg or png'
            return FALSE;
        }
        $width = imagesx($original);     // width of the original image
        $height = imagesy($original);    // height of the original image
        $square = min($width, $height);  // size length of the maximum square
        addThumbnail($original, $profileFileName, 300, $width, $height, $square);
        addThumbnail($original, $smallFileName, 90, $width, $height, $square);
        //$message = 'File succesfully loaded';
    }

}
header('Location: ../pages/story.php?id='.$storyId);
?>