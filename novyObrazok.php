<?php
/*
*********************
*********************************** upload image
***********************************
*********************
*/

require 'db.php';


error_reporting(0);
require 'admin/captchaId.php';

$change="";
$abc="";

define('UPLOAD_DIR_MINI', 'fotky/male/'); //horny panel mini
define('UPLOAD_DIR_NORMAL', 'fotky/velke/'); // na komentare stredny
define('UPLOAD_DIR_ORIGINAL', 'fotky/original/'); // original
//velkost
 define ("MAX_SIZE","1000");
 //funkcia na premenu nazvu name obrazku
 function getExtension($str) {
         $i = strrpos($str,".");
         if (!$i) { return ""; }
         $l = strlen($str) - $i;
         $ext = substr($str,$i+1,$l);
         return $ext;
 }

 $errors=0;




  $image =$_FILES["obrazokUloz"]["name"];
  $uploadedfile = $_FILES['obrazokUloz']['tmp_name'];


  if ($image)
  {

    $filename = stripslashes($_FILES['obrazokUloz']['name']);

      $extension = getExtension($filename);
    $extension = strtolower($extension);


 if (($extension != "jpg") && ($extension != "jpeg") && ($extension != "png") && ($extension != "gif"))
    {

      $change='<div class="msgdiv">Obrazok ma zly format.</div> ';
      $errors=1;
    }
    else
    {

 $size = filesize($_FILES['obrazokUloz']['tmp_name'])/ 1000;


if ($size > MAX_SIZE*1024)
{
  $change='<div class="msgdiv">Maximalna velkost je ' . MAX_SIZE . '</div>';
  $errors=1;
}
$size = $size /1000;

if($extension=="jpg" || $extension=="jpeg" )
{
$uploadedfile = $_FILES['obrazokUloz']['tmp_name'];
$src = imagecreatefromjpeg($uploadedfile);

}
else if($extension=="png")
{
$uploadedfile = $_FILES['obrazokUloz']['tmp_name'];
$src = imagecreatefrompng($uploadedfile);

}
else
{
$src = imagecreatefromgif($uploadedfile);
}

//$src = imagecreatefromjpg, gif, png, jpeg($uploadedfile); ----- original suboru

//echo $scr;

list($width,$height)=getimagesize($uploadedfile);

//$filenam = UPLOAD_DIR_ORIGINAL . $_FILES['obrazokUloz']['name'];  //original
//$filenam = UPLOAD_DIR_ORIGINAL . $user_id . '.' . $extension;  //original
$filenam = UPLOAD_DIR_ORIGINAL . $last_id . '.jpg';  //original



imagejpeg($src,$filenam,100);

$normal = UPLOAD_DIR_NORMAL . $last_id . '.jpg';  //mensi
$mini = UPLOAD_DIR_MINI . $last_id . '.jpg';   //mini
//--------------------------------------------------------------------------------------
//------------------------ nove ------------------
include 'admin/resize-class.php';

// *** 1) Initialise / load image
  $resizeObj = new resize($filenam);

  // *** 2) Resize image (options: exact, portrait, landscape, auto, crop)
  $resizeObj -> resizeImage(480, 720, 'crop');

  // *** 3) Save image
  $resizeObj -> saveImage($normal , 98);


//===-=-=-=-=-=

  $resize = new resize($filenam);
  // *** 2) Resize image (options: exact, portrait, landscape, auto, crop)
  $resize -> resizeImage(300, 400, 'crop');

  // *** 3) Save image
  $resize -> saveImage($mini , 98);
//----------------------------------------------------------------------------------

imagedestroy($src);  //original
imagedestroy($normal);
imagedestroy($mini);
imagedestroy($filenam);


echo '<b>Fotka bola uložená. Bola odoslaná adminovi sa posúdenie.</br> ĎAKUJEME</b></br>';
echo '<img src="../fotky/male/' . urlencode($last_id) . '.jpg" title="Vyber tvár" alt="Vyber tvár">';


$jedna = 1;
$pocet = 0;
$skore = 800;
$aktivacia = 0;

$zapis = mysql_query('INSERT INTO anketa (anketa_id, obrazok_id, obrazok_ano, obrazok_nie, obrazok_skore, obrazok_male, obrazok_velke, aktivacia)
             VALUES (NULL,
                    "' . mysql_real_escape_string($last_id) . '",
                    "' . mysql_real_escape_string($pocet) . '",
                    "' . mysql_real_escape_string($pocet) . '",
                    "' . mysql_real_escape_string($skore) . '",
                    "' . mysql_real_escape_string($jedna) . '",
                    "' . mysql_real_escape_string($jedna) . '",
                    "' . mysql_real_escape_string($aktivacia) .'") ');



}
}


?>
