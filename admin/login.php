<?php
/*
$data = '';
$data = '../includes/hlava.php';
require $data;
$data = '';






if (isset($_POST['odoslat']) && $_POST['odoslat'] == 'Prihlásiť :P') {
	#upravime hodnoty
	$login_meno = (isset($_POST['login_meno'])) ? trim($_POST['login_meno']) : '';
	$login_heslo = (isset($_POST['login_heslo'])) ? trim($_POST['login_heslo']) : '';

	#databaza
	$data = '../db.php';
	require_once($data);

	if (empty($login_meno) or empty($login_heslo)) {
		echo '<p style="color: red; font-style:20px; ">Nezadali ste udaje.</p>';
	}
	else {
		#ideme nato
		$login_heslo = md5($login_heslo);

		$prikaz = mysql_query('SELECT user_id, user_meno, user_heslo
								FROM user
								WHERE user_meno="' . mysql_real_escape_string($login_meno) . '"
									 AND user_heslo="' . mysql_real_escape_string($login_heslo) . '" ');

		if (mysql_num_rows($prikaz) == '0') {
			#nenaslo
			echo '<p style="color: red; font-style:20px; ">Nezadali ste udaje.</p>';
		}
		else {
			#naslo ho
			$riadok = mysql_fetch_array($prikaz);

			session_start();

			$_SESSION['user_id'] = $riadok['user_id'];
			$_SESSION['user_meno'] = $riadok['user_meno'];
			$_SESSION['user_heslo'] = $riadok['user_heslo'];

			mysql_free_result($prikaz);

			header('Location: http://vybertvar.6f.sk/admin');

		}

	}


}

*/



?>
<div class="login_form">
	<form action="login.php" method="post">
		<p>
			<label for="prihlas_meno">Meno: </label>
			<input type="text" name="login_meno" id="login_meno" maxlength="40" placeholder="Nick :P">
		</p>
		<p>
			<label for="prihlas_heslo">Heslo:</label>
			<input type="password" id="login_heslo" maxlength="40" placeholder="****" name="login_heslo" >
		</p>
		<p>
			<input type="submit" name="odoslat" value="Prihlásiť :P" id="odoslat">
		</p>
	</form>
</div>
<?php

include '../includes/spod.php';


?>
