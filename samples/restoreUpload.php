<?php
session_start();

// Count # of uploaded files in array
$total = count($_FILES['upload']['name']);
$message = "";
// Loop through each file
for( $i=0 ; $i < $total ; $i++ ) {

  //Get the temp file path
  $tmpFilePath = $_FILES['upload']['tmp_name'][$i];
  //Make sure we have a file path
  if ($tmpFilePath != ""){
    //Setup our new file path
    $newFilePath = "./restore/" . $_FILES['upload']['name'][$i];

    //Upload the file into the temp dir
    if(move_uploaded_file($tmpFilePath, $newFilePath)) {
        $message .= "{$_FILES['upload']['name'][$i]} Upload successful <br>";
    }
  }
}

if($message !=""){
    $_SESSION['success'] =  $message;
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    return 0;
}else{
    $_SESSION['message'] = "Sorry, there was an error uploading your file.";
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    return 0;
}
