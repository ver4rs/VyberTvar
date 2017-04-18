<?php

if (!isset($_GET['img1']) && !isset($_GET['img2'])) {
	echo 'Neautorizovany pristup';
	exit();
}
/*
#####################################################################################
	if (!isset($_COOKIE['overenie'])) {
		#nieje zapisane
		# cookies je vypnute
		//setcookie('overenie', null, $cas_koniec); // vymazeme cookies
		echo 'Zapnite cookies';
		exit();
	}
	$cas_koniec = time() - 100;
	setcookie('overenie', null, $cas_koniec); // vymazeme cookies
#####################################################################################
*/
$obrazok_win = $_GET['img1'];
$obrazok_lost = $_GET['img2'];

//require_once('includes/hlava.php');
require_once('db.php');

$aktivacia =1;
$win = mysql_query('SELECT anketa_id, obrazok_ano, obrazok_nie, obrazok_id, obrazok_skore, aktivacia FROM anketa WHERE aktivacia = "' . mysql_real_escape_string($aktivacia) . '" AND obrazok_id = "' . mysql_real_escape_string($obrazok_win) . '"');
$lost = mysql_query('SELECT anketa_id, obrazok_ano, obrazok_nie, obrazok_id, obrazok_skore, aktivacia FROM anketa WHERE aktivacia = "' . mysql_real_escape_string($aktivacia) . '" AND obrazok_id = "' . mysql_real_escape_string($obrazok_lost) . '"');

if (mysql_num_rows($win) != '0' && mysql_num_rows($lost) != '0') {

	$win_obrazok = mysql_fetch_array($win);
	$lost_obrazok = mysql_fetch_array($lost);
	#pokracujeme dalej


	#require over_funkcia.php

	if (isset($_GET['img1']) && isset($_GET['img2'])) {

		require 'over_funkcia.php';

		//$win_pocet = $win_obrazok['obrazok_ano']+1;
		//$lost_pocet = $lost_obrazok['obrazok_nie']+1;

	#win
		$vitaz = mysql_query('UPDATE anketa SET obrazok_ano = obrazok_ano+1, obrazok_skore = "' . mysql_real_escape_string($Ea) . '" WHERE obrazok_id = "' . mysql_real_escape_string($win_obrazok['obrazok_id']) . '"');


	#lost
		$prehral = mysql_query('UPDATE anketa SET obrazok_nie = obrazok_nie+1, obrazok_skore = "' . mysql_real_escape_string($Eb) . '" WHERE obrazok_id = "' . mysql_real_escape_string($lost_obrazok['obrazok_id']) . '"');



		header('Location: /');


	}


	//echo 'obrazok';
	//echo '<img style="width: 300px; height: 400px; "  src="fotky/' . $win_obrazok['obrazok_id']. '.jpg">';
	//echo 'Faktor  ' . $faktorA . '  ---  ' . $faktorB;
	//echo 'skore  ' . $Ea . '  ---   ' . $Eb;

	# koniec over_funkcia.php


	mysql_free_result($win);
	mysql_free_result($lost);
}
else {
	#obrazok sa nenasiel
	echo 'Neautorizovany pristup';
	exit();
}


//include_once('includes/spod.php');
?>

