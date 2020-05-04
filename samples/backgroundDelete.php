<?php
session_start();

$target_dir = "background/";
$imageName = $target_dir.$_POST["bacDelete"].".png";

// Check if file already exists
if (file_exists($imageName)) {
    unlink($imageName);
    $_SESSION['success'] = "background {$_POST["bacDelete"]} has been deleted.";
    header('Location: ' . $_SERVER['HTTP_REFERER']);
}else{
    $_SESSION['message'] = "Sorry, background {$_POST["bacDelete"]} doesn't exist !.";
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    return 0;
    echo '<a href="/Gojs/samples/productionEditor.php"> Go Back</a>';
}

?>