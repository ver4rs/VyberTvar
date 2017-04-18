<?php

session_start();

session_unset();
session_destroy();

$_SESSION['user_id'] = '';
$_SESSION['user_meno'] = '';


header('Location: http://vybertvar.6f.sk/prihlas');

?>
