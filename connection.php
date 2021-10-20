<?php 

$host = "localhost";
$db = "ocr";
$password = "";
$user = "root";

$con =  mysqli_connect($host,$user,$password,$db);

if(!$con)
{
    die("Connection failed: " . mysqli_connect_error());
}


?>