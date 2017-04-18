<?php

//require '../db.php';


#ID OBRAZKA
$vyber = '123456789';
$vybrateId = '';
for ($i=1; $i <=5 ; $i++) {
    $vybrateId .= substr($vyber, mt_rand(0, strlen($vyber) -1), 1);
}

//echo $vybrateId;

$clanokId = mysql_query('SELECT anketa_id, obrazok_id
                          FROM anketa
                          WHERE obrazok_id ="' . mysql_real_escape_string($vybrateId) . '"');
if (mysql_num_rows($clanokId) != '0') {
    # UZ EXISTUJE
    #ID OBRAZKA
    $vyber = '123456789';
    $vybrateId = '';
    for ($i=1; $i <=5 ; $i++) {
        $vybrateId .= substr($vyber, mt_rand(0, strlen($vyber) -1), 1);
    }
    $clanokId1 = mysql_query('SELECT anketa_id, obrazok_id
                          FROM anketa
                          WHERE obrazok_id ="' . mysql_real_escape_string($vybrateId) . '"');
    if (mysql_num_rows($clanokId1) != '0') {
        # EXISTUJE
        #ID OBRAZKA
      	$vyber = '123456789';
      	$vybrateId = '';
      	for ($i=1; $i <=5 ; $i++) {
         	$vybrateId .= substr($vyber, mt_rand(0, strlen($vyber) -1), 1);
      	}
      	$clanokId2 = mysql_query('SELECT anketa_id, obrazok_id
                            FROM anketa
                            WHERE obrazok_id ="' . mysql_real_escape_string($vybrateId) . '"');
      	if (mysql_num_rows($clanokId3) != '0') {
            #ID OBRAZKA
	      	$vyber = '123456789';
	      	$vybrateId = '';
	      	for ($i=1; $i <=5 ; $i++) {
	        	$vybrateId .= substr($vyber, mt_rand(0, strlen($vyber) -1), 1);
	      	}
      	}

    }

}


$last_id = $vybrateId;



?>
