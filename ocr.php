<?php

include "connection.php";
require_once __DIR__ . '/vendor/autoload.php';
use thiagoalessio\TesseractOCR\TesseractOCR;


if(isset($_POST['submit']))
{
    extract($_POST);
    $error=array();
    $extension=array("jpeg","jpg","png","gif");
    foreach($_FILES["files"]["tmp_name"] as $key=>$tmp_name) {
        $file_name=$_FILES["files"]["name"][$key];
        $file_tmp=$_FILES["files"]["tmp_name"][$key];
        $ext=pathinfo($file_name,PATHINFO_EXTENSION);
    
    


    
        $ocr = new TesseractOCR($file_name);
        $text = $ocr->run();

        $text = str_replace("'","",$text);

        $text = str_replace('"',"",$text);

        $query = "INSERT INTO ocr(text) VALUES('$text')";
        $result = mysqli_query($con,$query);

        if(!$result)
        {
            echo mysqli_error($con);
        }


        //Opening File to Write

        // $myfile = file_put_contents('ocr.txt', $text.PHP_EOL , FILE_APPEND | LOCK_EX);
    

        //Showing the textfile

        
    }
    // $read = fopen("ocr.txt", "r");
    // echo fread($read,filesize("ocr.txt"));
    // fclose($read);
}





?>


<html>
<body>

<center>
<h3>PHP OCR Test</h3>
<form action="" method="POST" enctype="multipart/form-data">
    <input type="file" name="files[]" multiple/>
    <input type="submit" name="submit"/>
</form>
</center>

</body>