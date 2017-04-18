<?php

//require_once('includes/hlava.php');
require_once('db.php');

//if (!opendir('fotky/nove')) {
	header('Refresh: 5; URL=obrazok_dir.php');
	//exit();
//}
if ($handle = opendir('fotky/nove')) {
$poc = -1;
$opakovanie = 0;
	/* This is the correct way to loop over the directory. */
	while (false !== ($file = readdir($handle))) {
						#################################
					$opakovanie = $opakovanie+1;
					$koniec_opakovanie = 4;
					if ($opakovanie > $koniec_opakovanie) {
						//echo '<h1>KONIEC</h1>';
						header('Refresh: 1; URL=obrazok_dir.php');
						exit();
					}


				#################################
		// id
		$pool = '123456789';
		$captcha = '';
		for ($i=0; $i < 5; $i++)
		 {  $captcha .= substr($pool, mt_rand(0, strlen($pool) -1), 1);   }
		//echo $captcha;
		$captcha = md5(time());

		// meno
		$pool1 = 'QWERTY UIOPA SDFGHJK LZXCVBNMq wertyuio pasdfgh jklzx cvbnm';
		$captcha1 = '';
		for ($i=0; $i < 11; $i++)
		  {  $captcha1 .= substr($pool1, mt_rand(0, strlen($pool1) -1), 1);   }
		//echo $captcha1;


		$aa = strrpos($file, '.');
		$aa = is_numeric($aa);

		//echo $file . '  ' . $aa . '<br>';
		if($file!='.' && $file!='..' && $aa == TRUE) {

			$cesta = 'fotky/nove/' . $file;

			if (file_exists($cesta)) {
				//echo 'existuje';


				$obr = imagecreatefromjpeg($cesta);

				$nova_sirka = imagesx($obr);
				$nova_vyska = imagesy($obr);

				$novy_obr = imagecreatetruecolor($nova_sirka, $nova_vyska);

				imagecopyresampled($novy_obr, $obr, 0, 0, 0, 0, $nova_sirka, $nova_vyska, imagesx($obr), imagesy($obr));

				imagejpeg($novy_obr, 'fotky/original/' . $captcha . '.jpg', 80);

				$filenam = 'fotky/original/' . $captcha . '.jpg';
				$normal = 'fotky/male/' . $captcha . '.jpg';
				$velke = 'fotky/velke/' . $captcha . '.jpg';

				include 'admin/resize-class.php';

				// *** 1) Initialise / load image
				  $resizeObj = new resize($filenam);

				  // *** 2) Resize image (options: exact, portrait, landscape, auto, crop)
				  $resizeObj -> resizeImage(300, 400, 'crop');

				  // *** 3) Save image
				  $resizeObj -> saveImage($normal , 70);


				//===-=-=-=-=-=

				  $resize = new resize($filenam);
				  // *** 2) Resize image (options: exact, portrait, landscape, auto, crop)
				  $resize -> resizeImage(480, 640, 'crop');

				  // *** 3) Save imag
				  $resize -> saveImage($velke , 70);
				//----------------------------------------------------------------------------------

				//imagedestroy($src);  //original
				imagedestroy($normal);
				imagedestroy($velke);
				imagedestroy($filenam);

				##################################################

				//$filea = substr($file, 0,-4);
				//echo $file . '<br>';

				//echo 'ano<br>';

				$obrazok_ano1 = mt_rand(0,5);
				$obrazok_ano = $obrazok_ano1 *(32*0.5);
				$obrazok_nie1 =  mt_rand(0,5);
				$obrazok_nie = $obrazok_nie1 *(32*0.5);
				$skore = 800 + ($obrazok_ano - $obrazok_nie);

				$zapis = mysql_query('INSERT INTO anketa (anketa_id, obrazok_id, obrazok_ano, obrazok_nie, obrazok_skore)
												VALUES (NULL,"' . $captcha . '","' . $obrazok_ano1 . '","' . $obrazok_nie1 . '",
													"' . $skore . '") ');
				###################################################
				unlink($cesta);


			}
			else {
				echo 'Uz nieje ziadny obrazok';
			}

		}


	  //header ('install_images.php');
	  //header ('index.php');
	}
	closedir($handle);
}
else {
	echo 'nic';
}


						//echo '<h1>KONIEC</h1>';


/*

$toto = mysql_query('SELECT anketa_id FROM anketa ORDER BY anketa_id DESC');
echo mysql_num_rows($toto);


*/



?>
