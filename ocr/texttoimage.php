<?php
// (A) OPEN IMAGE
include "connection.php";




if(isset($_FILES['image']))
{

    header('Content-type: image/jpeg');

    $query = "SELECT * FROM ocr";
    $result = mysqli_query($con,$query);
    $n = 1;
    // $row = mysqli_fetch_assoc($result);
    while($row = mysqli_fetch_assoc($result))
    {
        
        $txt = $row['text'];
        $file_name = $_FILES['image']['name'];
        $file_tmp =$_FILES['image']['tmp_name'];    
        $ext = pathinfo($file_name, PATHINFO_EXTENSION);

        $font_size = $_POST['font'];
        
        //$size = getimagesize($file_name);
        //print_r($size);
        
        
        //move_uploaded_file($file_tmp,"images/".$file_name);
        
        if($ext == 'jpg' || $ext == 'jpeg')
            $img = imagecreatefromjpeg($file_name);
        else if($ext == 'png')
            $img = imagecreatefrompng($file_name);
        
            

        // $myfile = fopen("occr.txt", "r") or die("Unable to open file!");
        // $txt = fread($myfile,filesize("occr.txt"));
        // fclose($myfile);

        // (B) WRITE TEXT
        
        //$txt = "THIS IS SOME RANDOM TEXT";
        $font = "C:\Windows\Fonts\impact.ttf"; 

        // THE IMAGE SIZE
            
        $width = imagesx($img);
        $height = imagesy($img);

        // THE TEXT SIZE
        $text_size = imagettfbbox($font_size, 0, $font, $txt);
        $text_width = max([$text_size[2], $text_size[4]]) - min([$text_size[0], $text_size[6]]);
        $text_height = max([$text_size[5], $text_size[7]]) - min([$text_size[1], $text_size[3]]);
        // CENTERING THE TEXT BLOCK
        $x = (($width-$text_width)/2)-50;
        $y = (($heigth-$text_height)/2);
        // echo $text_width;
        



        //$centerX = CEIL((($width) / 2)-$text_width);
        //$centerX = $centerX<0 ? 0 : $centerX;
        
        $centerY = CEIL((($height-$text_height) / 2)-80);
        //$centerY = $centerY<0 ? 0 : $centerY;
        imagettftext($img, 40, 0, $x, 300, imagecolorallocate($img, 0, 0, 0), $font, $txt);

        // (C) OUTPUT IMAGE
        $output = "newimages/new$file_name-$n.jpg";

        imagejpeg($img);
        imagejpeg($img,$output);
        
        $n++;
}

imagedestroy($jpg_image);

}
?>


<html>
<body>

<center>
<h3>PHP OCR Test</h3>
<form action="" method="POST" enctype="multipart/form-data">
<input type="file" name="image"/>
<select name="font" required>
    
    <option value="" selected="selected">SELECT FONT SIZE</option>
    <option value="5">5</option>
    <option value="6">6</option>
    <option value="7">7</option>
    <option value="8">8</option>
    <option value="9">9</option>
    <option value="10">10</option>
    <option value="11">11</option>
    <option value="12">12</option>
    <option value="13">13</option>
    <option value="14">14</option>
    <option value="15">15</option>
    <option value="16">16</option>
    <option value="17">17</option>
    <option value="18">18</option>
    <option value="19">19</option>
    <option value="20">20</option>
    <option value="21">21</option>
</select>
<input type="submit"/>
</form>
</center>

</body>
</html>