<?php
session_start();
function Zip($source, $destination)
{
    // Get real path for our folder
    $rootPath = realpath($source);

    // Initialize archive object
    $zip = new ZipArchive();
    $zip->open($destination, ZipArchive::CREATE | ZipArchive::OVERWRITE);

    $files = new RecursiveIteratorIterator(
        new RecursiveDirectoryIterator($rootPath),
        RecursiveIteratorIterator::LEAVES_ONLY
    );

    foreach ($files as $name => $file)
    {
        // Skip directories (they would be added automatically)
        if (!$file->isDir())
        {
            // Get real and relative path for current file
            $filePath = $file->getRealPath();
            $relativePath = substr($filePath, strlen($rootPath) + 1);

            // Add current file to archive
            $zip->addFile($filePath, $relativePath);
        }
    }

    return $zip->close();
}
$message = "";
if(Zip('imageLibrary/', './backup/imagelibrary.zip')){
    $message .= "Image Library and ";
}
if(Zip('background/', './backup/background.zip')){
    $message .= "Background images backup are successful";
}
else{
    $_SESSION['message'] = "Backup Failed !! something went wrong";
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    return 0;
}
setcookie("backupAvl", "yes", time()+2*24*60*60,'/');
$_SESSION['success'] =  $message;
header('Location: ' . $_SERVER['HTTP_REFERER']);
?>