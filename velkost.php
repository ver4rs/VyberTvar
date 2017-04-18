<?php

require 'db.php';

/*  vycistenie v DB ak su rovnake obrazok_id

$prikaz = mysql_query('SELECT anketa_id, obrazok_id FROM anketa ORDER BY anketa_id DESC LIMIT 1800,2000');

if (mysql_num_rows($prikaz) != '0') {
	while ($riadok = mysql_fetch_assoc($prikaz)) {
		extract($riadok);

		$prik = mysql_query('SELECT anketa_id, obrazok_id FROM anketa ORDER BY anketa_id ASC LIMIT 1800,2000');

		while ($riad = mysql_fetch_array($prik)) {

			if ($obrazok_id == $riad['obrazok_id'] && $anketa_id != $riad['anketa_id']) {
				echo $anketa_id . ' a ' . $riad['anketa_id'] . ' potom obrazok ' . $obrazok_id . ' a ' . $riad['obrazok_id'] . '<br>';
				$vymaz = mysql_query('DELETE FROM anketa WHERE anketa_id="' . mysql_real_escape_string($riad['anketa_id']) . '"');
			}
		}
	}
	mysql_free_result($prikaz);
	mysql_free_result($prik);
}
echo '<h1> ' . mysql_num_rows($prikaz) . ' a ' . mysql_num_rows($prik);
*/




/*
$nula = '0';
$jedna = '1';

$prikaz = mysql_query('SELECT anketa_id, obrazok_id, obrazok_male, obrazok_velke
						FROM anketa
						WHERE obrazok_male ="' . mysql_real_escape_string($nula) . '"
						  or obrazok_velke ="' . mysql_real_escape_string($nula) . '"
						ORDER BY anketa_id LIMIT 5');

echo mysql_num_rows($prikaz);
if (mysql_num_rows($prikaz) != '0') {
	include 'resize-class.php';
	// existuje
	while ($riadok = mysql_fetch_array($prikaz)) {

		$cesta = 'fotky/original/' . $riadok['obrazok_id'] . '.jpg';
		$male = 'fotky/male/' . $riadok['obrazok_id'] . '.jpg';
		$velke = 'fotky/velke/' . $riadok['obrazok_id'] . '.jpg';

		#1
		$resizeObj = new resize($cesta);

 					//  2) Resize image (options: exact, portrait, landscape, auto, crop)
 		$resizeObj -> resizeImage(300, 400, 'crop');

 					// *** 3) Save image
 		$resizeObj -> saveImage($male , 95);

 		#2
 		$resizeObj = new resize($cesta);

 					//  2) Resize image (options: exact, portrait, landscape, auto, crop)
 		$resizeObj -> resizeImage(480, 720, 'crop');

 					// *** 3) Save image
 		$resizeObj -> saveImage($velke , 99);

 		#zapiseme

 		$zapis = mysql_query('UPDATE anketa SET obrazok_male = "' . mysql_real_escape_string($jedna) . '",
 												obrazok_velke = "' . mysql_real_escape_string($jedna) . '"
 								WHERE obrazok_id = "' . mysql_real_escape_string($riadok['obrazok_id']) . '"');

 		//imagedestroy($male);
 		//imagedestroy($velke);
	}
	header('Refresh: 1; url: velkost');
}
else {
	echo '<h1>uz nemusite ziaden obrazok zmensovat</h1>';
}
*/

?>
