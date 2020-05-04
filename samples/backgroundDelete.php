<?php
$target_dir = "background/";
$imageName = $target_dir.$_POST["bacDelete"].".png";

// Check if file already exists
if (file_exists($imageName)) {
    unlink($imageName);
    header('Location: ' . $_SERVER['HTTP_REFERER']);
}else{
    echo "Image doesn't exist .";
    echo '<a href="/Gojs/samples/productionEditor.html"> Go Back</a>';
}

?>