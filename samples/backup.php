<?php

$images_dir = 'imageLibrary/';
//this folder must be writeable by the server
$backup = 'backup';
$zip_file = $backup.'/backup.zip';

if ($handle = opendir($images_dir))  
{
    $zip = new ZipArchive();

    if ($zip->open($zip_file, ZipArchive::CREATE)!==TRUE) 
    {
        exit("cannot open <$zip_file>\n");
    }

    while (false !== ($file = readdir($handle))) 
    {
        $zip->addFile($images_dir.'/'.$file);
        echo "$file\n";
    }
    closedir($handle);
    echo "numfiles: " . $zip->numFiles . "\n";
    echo "status:" . $zip->status . "\n";
    $zip->close();
    echo 'Zip File:'.$zip_file . "\n";
}

?>