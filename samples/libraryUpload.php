<?php
$target_dir = "imageLibrary/";
$target_file = $target_dir . basename($_FILES["image"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
$imageName = "";

//check if key provided or not
if(isset($_POST["imgkey"])){
    $imageName = $target_dir.$_POST["imgkey"].".jpg";
}else{
    $uploadOk = 0;
}

// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}
// Check if file already exists
if (file_exists($imageName)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}

// Allow certain file formats
if($imageFileType != "jpg") {
    echo "Sorry, only JPG files are allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["image"]["tmp_name"],$imageName)) {
        echo "The file ". basename( $_FILES["image"]["name"]). " has been uploaded.";
        header('Location: ' . $_SERVER['HTTP_REFERER']);

    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
echo '<a href="/Gojs/samples/productionEditor.html"> Go Back</a>';
?>