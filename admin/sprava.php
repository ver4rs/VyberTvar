<?php

session_start();

if (!isset($_SESSION['user_id']) && $_SESSION['user_id'] == '') {
	echo '<h2>Neautorizovany pristup</h2>';
	header('Refresh: 1; url=http://vybertvar.6f.sk/prihlas');
	exit();
}

require 'db.php';


#AKTIVACIA
if (isset($_GET['aktiv']) AND $_GET['aktiv'] != FALSE) {
	#AKTIVACIA
	$vyhladaj = mysql_query('SELECT anketa_id, obrazok_id FROM anketa WHERE obrazok_id = "' . mysql_real_escape_string($_GET['aktiv']) . '"  ORDER BY anketa_id DESC');
	if (mysql_num_rows($vyhladaj) != '0') {
		# EXISTUJE
		$riadok = mysql_fetch_array($vyhladaj);

		$cesta_original = 'http://www.vybertvar.6f.sk/fotky/original/' . $riadok['obrazok_id'] . '.jpg';
		$cesta_velke = 'http://www.vybertvar.6f.sk/fotky/velke/' . $riadok['obrazok_id'] . '.jpg';
		$cesta_male = 'http://www.vybertvar.6f.sk/fotky/male/' . $riadok['obrazok_id'] . '.jpg';
		?>
		<img src="<?php echo htmlspecialchars($cesta_male); ?>">
		<form method="post" action="">
		<label for="text">Naozaj chces vymazat?</label>
		<input type="submit" name="vymazat" value="vymazat" id="vymazat">
		</form>
		<?php

	}
	else {
		# NIEJE, FALOSNY POPLACH
		header('Refresh: 1; url=http://vybertvar.6f.sk/prihlas');
		exit();
	}
}
elseif (isset($_GET['vymaz']) AND $_GET['vymaz'] != FALSE) {
	#VYMAZ
}
else {
	header('Refresh: 1; url=http://vybertvar.6f.sk/prihlas');
	exit();
}





?>
