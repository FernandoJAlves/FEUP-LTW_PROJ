<?php 
  include_once('../database/dbUsers.php');
  include_once('../includes/session.php');
  include_once('action_upload.php');
    $username = $_SESSION['username'];
    $age = $_POST['age'];
    $description = $_POST['description'];
    $email = $_POST['email'];


    updateUser($username,$email,$age,$description);

    //If an image was uploaded
if($_FILES['image']['name'])
{
    //No errors detected
    if((!$_FILES['image']['error']) && ($_FILES['image']['size'] != FALSE))
    {
        // Generate filenames for original, small and medium files
        $profileFileName = "../img/profiles/$currUser.jpg";
        $profileThumbnail = "../img/profiles_thumbnail/$currUser.jpg";
        // Create an image representation of the original image
        if ( !($original = createImageFromType($_FILES['image'])) ) {
            //Error message here and go on - $message = 'Received wrong file type. Please use jpeg or png'
            return FALSE;
        }
        $width = imagesx($original);     // width of the original image
        $height = imagesy($original);    // height of the original image
        $square = min($width, $height);  // size length of the maximum square
        addThumbnail($original, $profileFileName, 300, $width, $height, $square);
        addThumbnail($original, $profileThumbnail, 30, $width, $height, $square);
        //$message = 'File succesfully loaded';
    }

}
    
    
    header('Location: ../pages/profile.php?username='.$username);

?>