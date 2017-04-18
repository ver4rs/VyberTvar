<?php


session_unset();
session_destroy();

$_SESSION['user_id'] = '';
$_SESSION['user_meno'] = '';
$_SESSION['user_heslo'] = '';

header('Location: http://vybertvar.6f.sk/odhlas');

?>
