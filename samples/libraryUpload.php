<?php
session_start();
$message = "";
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

// // Check if image file is a actual image or fake image
// if(isset($_POST["submit"])) {
//     $check = getimagesize($_FILES["image"]["tmp_name"]);
//     if($check !== false) {
//         echo "File is an image - " . $check["mime"] . ".";
//         $uploadOk = 1;
//     } else {
//         echo "File is not an image.";
//         $uploadOk = 0;
//     }
// }
// Check if file already exists
if (file_exists($imageName)) {
    $_SESSION['message'] = "Sorry, file already exists with slug {$_POST["imgkey"]}. ";
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    return 0;
}

// Allow certain file formats
if($imageFileType != "jpg") {
    $_SESSION['message'] = "Sorry, only JPG files is allowed.";
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    return 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    $_SESSION['message'] = "Sorry, your file was not uploaded.";
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    return 0;
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["image"]["tmp_name"],$imageName)) {

        $_SESSION['success'] = "The file ". basename( $_FILES["image"]["name"]). " has been uploaded. with slug = {$_POST["imgkey"]}";
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        return 0;
        
    } else {
        $_SESSION['message'] = "Sorry, there was an error uploading your file.";
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
}
echo '<a href="/Gojs/samples/productionEditor.php"> Go Back</a>';
?>