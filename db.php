<?php


$db = mysql_connect('localhost', 'name', 'password') or die(mysql_error());
mysql_select_db('nameDB', $db) or die(mysql_error($db));


?>
