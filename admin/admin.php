<?php

$data = '';
$data = '../includes/hlava.php';
require $data;
$data = '';

if (!isset($_SESSION['user_id']) && empty($_SESSION['user_id'])) {
	echo '<h2>Neautorizovany pristup</h2>';
	header('Refresh: 1; url=http://vybertvar.6f.sk/prihlas');
	exit();
}

echo ' a si tu ';
echo '<a href="http://vybertvar.6f.sk/odhlas"> odhlasit</a>';





?>
