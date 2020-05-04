<?php
session_start();
$target_dir = "background/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
$backgroundName = "";
// Check if option selected
if(isset($_POST["background"])){
    $backgroundName = $target_dir.$_POST["background"].".png";
}else{
    $uploadOk = 0;
}


// // Check if image file is a actual image or fake image
// if(isset($_POST["submit"])) {
//     $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
//     if($check !== false) {
//         echo "File is an image - " . $check["mime"] . ".";
//         $uploadOk = 1;
//     } else {
//         echo "File is not an image.";
//         $uploadOk = 0;
//     }
// }
// Check if file already exists
if (file_exists($backgroundName)) {
    $_SESSION['message'] = "Sorry, background {$_POST["background"]} already exists. ";
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    return 0;
}

// Allow certain file formats
if($imageFileType != "png") {
    $_SESSION['message'] = "Sorry, only PNG files is allowed.";
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
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"],$backgroundName)) {
        $_SESSION['success'] = "The background {$_POST["background"]} has been uploaded.";
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        return 0;
    } else {
        $_SESSION['message'] = "Sorry, there was an error uploading your file.";
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
}
echo '<a href="/Gojs/samples/productionEditor.php"> Go Back</a>';
?>