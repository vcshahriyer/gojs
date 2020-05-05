<?php
session_start();

$file1 = "./restore/imagelibrary.zip";
$file2 = "./restore/background.zip";
$message = "";
$error ="";
if(file_exists($file1)){
    $zip = new ZipArchive;
    $res = $zip->open('./restore/imagelibrary.zip');
    if ($res === TRUE) {
    $zip->extractTo('imageLibrary/');
        if($zip->close()){
            $message .=  "Imagelibrary restore complete <br>";
        }
    } else {
        $error .= "Imagelibrary resoter Failed !! <br>";
    }
    
}
if( file_exists($file2)){
    // second zip extract
    $zip2 = new ZipArchive;
    $res2 = $zip2->open('./restore/background.zip');
    if ($res2 === TRUE) {
    $zip2->extractTo('background/');
    if($zip2->close()){
        $message .=  "Background restore complete <br>";
    }
    } else {
        $error .= "Background restore Failed !! <br>";
    }
}

if($error !=""){
    $_SESSION['message'] = $error;
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    return 0;
}elseif($message !=""){
    $_SESSION['success'] = $message;
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    return 0;
}else{
    $_SESSION['message'] = "Something went wrong !";
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    return 0;
}

?>