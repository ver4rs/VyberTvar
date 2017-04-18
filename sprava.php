<?php

session_start();

if (!isset($_SESSION['user_id']) && $_SESSION['user_id'] == '') {
	echo '<h2>Neautorizovany pristup</h2>';
	header('Refresh: 1; url=http://vybertvar.6f.sk/prihlas');
	exit();
}

require 'db.php';



$aktivovane = 0; // nebudeme robit to iste 2-krat

# DB ULOZENIE
if (isset($_POST['odoslat']) AND $_POST['odoslat'] == 'aktivovat') {
	#ULOZ OVERUJEM
	$vyhladaj = mysql_query('SELECT anketa_id, obrazok_id, aktivacia FROM anketa WHERE obrazok_id = "' . mysql_real_escape_string($_GET['aktiv']) . '" AND aktivacia = "' . mysql_real_escape_string($aktivovane) . '"  ORDER BY anketa_id DESC');
	if (mysql_num_rows($vyhladaj) != '0') {
		# EXISTUJE
		$riadok = mysql_fetch_array($vyhladaj);

		$cesta_original = 'http://www.vybertvar.6f.sk/fotky/original/' . $riadok['obrazok_id'] . '.jpg';
		$cesta_velke = 'http://www.vybertvar.6f.sk/fotky/velke/' . $riadok['obrazok_id'] . '.jpg';
		$cesta_male = 'http://www.vybertvar.6f.sk/fotky/male/' . $riadok['obrazok_id'] . '.jpg';

		$aktivacia =1;
		$oprav = mysql_query('UPDATE anketa SET aktivacia ="' . mysql_real_escape_string($aktivacia) . '" WHERE anketa_id = "' . mysql_real_escape_string($riadok['anketa_id']) . '" ');

		die('Obrazok Aktivovany');
		die(' do 3 sekund budete premerovany, inak zavrite list');
		exit();
		header('REFRASH:3; url=http://vybertvar.6f.sk/');
		exit();

	}
	else {
		# NIEJE, FALOSNY POPLACH
		die(' do 3 sekund budete premerovany, inak zavrite list');
		header('Refresh: 3; url=http://vybertvar.6f.sk/');
		exit();
	}
	mysql_free_result($vyhladaj);


}


if (isset($_POST['odoslat']) AND $_POST['odoslat'] == 'vymazat') {
	#VYMAZ
	$vymaz = mysql_query('SELECT anketa_id, obrazok_id, aktivacia FROM anketa WHERE obrazok_id = "' . mysql_real_escape_string($_GET['vymaz']) . '" ORDER BY anketa_id DESC');
	if (mysql_num_rows($vymaz) != '0') {
		# EXISTUJE
		$riadok = mysql_fetch_array($vymaz);

		$cesta_original = 'fotky/original/' . $riadok['obrazok_id'] . '.jpg';
		$cesta_velke = 'fotky/velke/' . $riadok['obrazok_id'] . '.jpg';
		$cesta_male = 'fotky/male/' . $riadok['obrazok_id'] . '.jpg';

		unlink($cesta_original);
		unlink($cesta_velke);
		unlink($cesta_male);

		$vymaz1 = mysql_query('DELETE FROM anketa WHERE anketa_id = "' . mysql_real_escape_string($riadok['anketa_id']) . '" ');

		?>
		<!--
		<img src="<?php //echo $cesta_original; ?>" alt="obrazok original" title="obrazok original">
		<img src="<?php //echo $cesta_velke; ?>" alt="obrazok velke" title="obrazok velke">
		<img src="<?php //echo $cesta_male; ?>" alt="obrazok male" title="obrazok male">  -->
		<?php
		die('Obrazok vymazany');
		die(' do 3 sekund budete premerovany, inak zavrite list');
		exit();
		header('REFRASH:3; url=http://vybertvar.6f.sk/');
		exit();

	}
	else {
		# NIEJE, FALOSNY POPLACH
		die(' do 3 sekund budete premerovany, inak zavrite list');
		header('Refresh: 3; url=http://vybertvar.6f.sk/');
		exit();
	}
	mysql_free_result($vymaz);
}





#AKTIVACIA
if (isset($_GET['aktiv']) AND $_GET['aktiv'] != FALSE) {
	#AKTIVACIA
	$vyhladaj = mysql_query('SELECT anketa_id, obrazok_id, aktivacia FROM anketa WHERE obrazok_id = "' . mysql_real_escape_string($_GET['aktiv']) . '" AND aktivacia = "' . mysql_real_escape_string($aktivovane) . '"  ORDER BY anketa_id DESC');
	if (mysql_num_rows($vyhladaj) != '0') {
		# EXISTUJE
		$riadok = mysql_fetch_array($vyhladaj);

		$cesta_original = 'http://www.vybertvar.6f.sk/fotky/original/' . $riadok['obrazok_id'] . '.jpg';
		$cesta_velke = 'http://www.vybertvar.6f.sk/fotky/velke/' . $riadok['obrazok_id'] . '.jpg';
		$cesta_male = 'http://www.vybertvar.6f.sk/fotky/male/' . $riadok['obrazok_id'] . '.jpg';
		?>
		<img src="<?php echo htmlspecialchars($cesta_male); ?>">
		<form method="post" action="sprava.php?aktiv=<?php echo $_GET['aktiv'] ?>">
		<label for="text">Naozaj chces aktivovat?</label>
		<input type="submit" name="odoslat" value="aktivovat" id="aktivovat">
		</form>
		<?php

	}
	else {
		# NIEJE, FALOSNY POPLACH
		header('Refresh: 3; url=http://vybertvar.6f.sk');
		exit();
	}
	mysql_free_result($vyhladaj);
}
elseif (isset($_GET['vymaz']) AND $_GET['vymaz'] != FALSE) {
	#VYMAZ
	$vymaz = mysql_query('SELECT anketa_id, obrazok_id, aktivacia FROM anketa WHERE obrazok_id = "' . mysql_real_escape_string($_GET['vymaz']) . '" ORDER BY anketa_id DESC');
	if (mysql_num_rows($vymaz) != '0') {
		# EXISTUJE
		$riadok = mysql_fetch_array($vymaz);

		$cesta_original = 'http://www.vybertvar.6f.sk/fotky/original/' . $riadok['obrazok_id'] . '.jpg';
		$cesta_velke = 'http://www.vybertvar.6f.sk/fotky/velke/' . $riadok['obrazok_id'] . '.jpg';
		$cesta_male = 'http://www.vybertvar.6f.sk/fotky/male/' . $riadok['obrazok_id'] . '.jpg';
		

	$vymaz = mysql_query('SELECT anketa_id, obrazok_id, aktivacia FROM anketa WHERE obrazok_id = "' . mysql_real_escape_string($_GET['vymaz']) . '" ORDER BY anketa_id DESC');
	if (mysql_num_rows($vymaz) != '0') {
		# EXISTUJE
		$riadok = mysql_fetch_array($vymaz);

		$cesta_original = 'fotky/original/' . $riadok['obrazok_id'] . '.jpg';
		$cesta_velke = 'fotky/velke/' . $riadok['obrazok_id'] . '.jpg';
		$cesta_male = 'fotky/male/' . $riadok['obrazok_id'] . '.jpg';

		unlink($cesta_original);
		unlink($cesta_velke);
		unlink($cesta_male);

		$vymaz1 = mysql_query('DELETE FROM anketa WHERE anketa_id = "' . mysql_real_escape_string($riadok['anketa_id']) . '" ');

		echo 'VYMAZANE.';
	}



		/*?>
		<img src="<?php echo htmlspecialchars($cesta_male); ?>">
		<form method="post" action="sprava.php?vymaz=<?php echo $_GET['vymaz'] ?>">
		<label for="text">Naozaj chces vymazat?</label>
		<input type="submit" name="odoslat" value="vymazat" id="vymazat">
		</form>
		<?php*/

	}
	else {
		# NIEJE, FALOSNY POPLACH
		header('Refresh: 3; url=http://vybertvar.6f.sk/');
		exit();
	}
	mysql_free_result($vymaz);
}
else {
	header('Refresh: 3; url=http://vybertvar.6f.sk');
	exit();
}





?>
