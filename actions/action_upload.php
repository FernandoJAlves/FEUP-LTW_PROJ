<?php
include_once('../includes/session.php');
$currUser = $_SESSION['username'];
function addThumbnail($original, $newFileName, $newSize, $width, $height, $square) {
    
    $thumbnail = imagecreatetruecolor($newSize, $newSize);
    imagecopyresized($thumbnail, $original, 0, 0,
                    ($width > $square)? ($width - $square)/2 : 0,
                    ($height > $square)? ($height - $square)/2 : 0,
                    $newSize, $newSize, $square, $square);
    imagejpeg($thumbnail, $newFileName);
}
function createImageFromType($image) {
    switch ($image['type']) {
        case 'image/jpg':
        case 'image/jpeg':
            return imagecreatefromjpeg($image['tmp_name']);
        case 'image/png':
            return imagecreatefrompng($image['tmp_name']);
        default:
            return FALSE;
    }
}
header("Location: ../pages/profile.php"); 
?>