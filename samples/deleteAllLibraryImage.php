<?php

    if(isset($_POST["alldelete"]) && $_POST["alldelete"] == "delete") {
        $dir = "imageLibrary";
        $handle=opendir($dir);
        while (($file = readdir($handle))!==false) {
        echo "$file <br>";
        @unlink($dir.'/'.$file);
        
        }
        closedir($handle);
        echo '<a href="/Gojs/samples/productionEditor.html"> Go Back</a>';
    }
    
    
?>