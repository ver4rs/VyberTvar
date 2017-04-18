<?php

$db = mysql_connect('localhost', 'ver4rs', 'jebnutyclovek')or die(mysql_error());
mysql_select_db('veremail', $db)or die(mysql_error());



/*
$email = mysql_query('SELECT email_meno, email_id, email_poslane FROM email WHERE email_poslane = 0 ORDER BY rand()  LIMIT 0,95');
if (mysql_num_rows($email) != '0') {
	# ODOSIELAME
	while ($riadok  = mysql_fetch_array($email)) {
		$komu_email = $riadok['email_meno'];  //komu
		$od_koho_email = 'martin5611@azet.sk';  //od koho


	$hlavicka_email = array();
	$hlavicka_email[] = 'MIME-Version: 1.0';
	$hlavicka_email[] = 'Content-type: text/html; charset="window-1250"';
	$hlavicka_email[] = 'Content-Transfer-Encoding: 7bit';
	$hlavicka_email[] = 'From: ' . $od_koho_email; //odosle kazdemu zakaznik@srv6.endora.cz

	//$text_email = '<html><h2>Ahoj, dnes mÃ¡Å¡ skvelÃ½ deÅ&#65533;.</h2> </br> <a href="http://vybertvar.6f.sk"/><img src="http://cms.6f.sk/pozadie.png"/></a> </br> <h3><a href="http://vybertvar.6f.sk"/>Vyber si dievÄa ktorÃ© sa k tebe hodÃ­.</a></h3> </br> <p>MÃ´Å¾eÅ¡ vyberaÅ¥ krajÅ¡ie dievÄa, prezrieÅ¥ profil, aktuÃ¡lny stav TOP 10 dievÄat a Poradie kde sa nachÃ¡dzajÃº vÅ¡etky dievÄatÃ¡. <a href="http://vybertvar.6f.sk"/>viac...</a></p><p>Potrebujete pomoc, neviete si s niečim radi napíšte mi. Máte nápad s vylepšením. Môžete mi napísať na email sysmono@gmail.com. </br>Na tento email neodpovedajte!</p></html>';

	$text_email = '<html><h2>Ahoj, dnes máš skvelý deň.</h2> </br> <a href="http://vybertvar.6f.sk"/><img src="http://cms.6f.sk/pozadie.png"/></a> </br> <h3><a href="http://vybertvar.6f.sk"/>Vyber si dievča ktoré sa k tebe hodí.</a></h3> </br> <p>Môžeš vyberať krajšie dievča, prezerať profil, aktuálny stav TOP 10 dievčat a Poradie kde sa nachádzajú všetky dievÄčatá¡. <a href="http://vybertvar.6f.sk"/>viac...</a></p><p>Potrebujete pomoc, neviete si s niečim radi napíšte mi. Máte nápad s vylepšením. Môžete mi napísať na email ver4rs@gmail.com. </br>Na tento email neodpovedajte!</p></html>';


	$predmet_email = 'Pekné slovenské dievčatá';



	$odosli_email = mail($komu_email, $predmet_email, $text_email, join("\r\n", $hlavicka_email));

	if ($odosli_email) {
		echo 'Email bol odoslany.';
	}

	$zmen = mysql_query('UPDATE email SET email_poslane =1 WHERE email_id="' . mysql_real_escape_string($riadok['email_id']) . '" ');
}
}
else {
	# KONIEC UZ KAZDY DOSTAL POSLEM SEBE
	$komu_email = 'ver4rs@gmail.com';  //komu
	$od_koho_email = 'martin5611@azet.sk';  //od koho


	$hlavicka_email = array();
	$hlavicka_email[] = 'MIME-Version: 1.0';
	$hlavicka_email[] = 'Content-type: text/html; charset="window-1250"';
	$hlavicka_email[] = 'Content-Transfer-Encoding: 7bit';
	$hlavicka_email[] = 'From: ' . $od_koho_email;

	$text_email = '<html><h2>Ahoj, dnes máš skvelý deň.</h2> </br> <a href="http://vybertvar.6f.sk"/><img src="http://cms.6f.sk/pozadie.png"/></a> </br> <h3><a href="http://vybertvar.6f.sk"/>Vyber si dievča ktoré sa k tebe hodí.</a></h3> </br> <p>Môžeš vyberať krajšie dievča, prezerať profil, aktuálny stav TOP 10 dievčat a Poradie kde sa nachádzajú všetky dievÄčatá¡. <a href="http://vybertvar.6f.sk"/>viac...</a></p><p>Potrebujete pomoc, neviete si s niečim radi napíšte mi. Máte nápad s vylepšením. Môžete mi napísať na email ver4rs@gmail.com. </br>Na tento email neodpovedajte!</p></html>';


	$predmet_email = 'Vyber tvár, koniec';



	$odosli_email = mail($komu_email, $predmet_email, $text_email, join("\r\n", $hlavicka_email));

	if ($odosli_email) {
		echo 'Email bol odoslany.';
	}
}
mysql_free_result($email);



/*
echo 'poslanie emialu.';

for ($i=0; $i <= 100; $i++) {

	$to_adress = 'ver4rs@gmail.com';
	$from_adress = 'martin5611@azet.sk';
	$subject = 'Predmet spravy a nic ine';
	$message = 'Text spravy emailu a nic ine co tu malo byt';

	$headers = 'From: ' . $from_adress . "\r\n";
	$headers .= 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/plain; charset="window-1250"' . "\r\n";
	$headers .= 'Content-Transfer-Encoding: 7bit' . "\r\n";

	$sussess = mail($to_adress, $subject, $message, $headers);

	if ($sussess) {
		echo 'Email bol odoslany.';
	}

}
*/





/*
if (isset($_GET['strana']) or !empty($_GET['strana'])) {
    $strana = $_GET['strana'];
}
else {
    $strana = 1;
}


$limit = 100;


$pocet = mysql_query('SELECT email_id FROM email ORDER BY email_id DESC');
$pocetRiadkov = mysql_num_rows($pocet);
mysql_free_result($pocet);

#STRANY VYPOCITANIE
$pocetStran = ceil($pocetRiadkov / $limit);
$zaciatok = ($strana * $limit) - $limit;
*/


/*
$zaciatok = 20000;
$limit = 2001;
*/
/*
$duplicit = 0;


# NACITAJ EMAILY
$email = mysql_query('SELECT email_id, email_meno FROM email ORDER BY email_id DESC LIMIT ' . $zaciatok . ', ' . $limit . ' ');
while ($riadok = mysql_fetch_array($email)) {

	# EMAIL 2 DUPLICIT
	$email2 = mysql_query('SELECT email_id, email_meno FROM email ORDER BY email_id DESC');
	while ($riadok2 = mysql_fetch_array($email2)) {
		if ($riadok['email_meno'] == $riadok2['email_meno']) {
			$vymaz = mysql_query('DELETE * FROM email WHERE email_meno="' . mysql_real_escape_string($riadok2['email_meno']) . '" ');
			$duplicit = $duplicit +1;
		}
	}
	mysql_free_result($email2);

}
mysql_free_result($email);

echo 'HOTOVO ' . $duplicit . '<br>';
$strana = $strana+1;
echo $strana . '<br>';
$a = $zaciatok + $limit;
echo $a;

header('Location: email.php?strana=' . $strana);
exit();
*/

$komu_email = 'ver4rs@gmail.com';  //komu
	$od_koho_email = 'ver4ddrs@gmail.com';  //od koho


	$hlavicka_email = array();
	$hlavicka_email[] = 'MIME-Version: 1.0';
	$hlavicka_email[] = 'Content-type: text/html; charset="window-1250"';
	$hlavicka_email[] = 'Content-Transfer-Encoding: 7bit';
	$hlavicka_email[] = 'From: ' . $od_koho_email;

	$text_email = '<html><h2>Ahoj, dnes máš skvelý deň.</h2> </br> <a href="http://vybertvar.6f.sk"/><img src="http://cms.6f.sk/pozadie.png"/></a> </br> <h3><a href="http://vybertvar.6f.sk"/>Vyber si dievča ktoré sa k tebe hodí.</a></h3> </br> <p>Môžeš vyberať krajšie dievča, prezerať profil, aktuálny stav TOP 10 dievčat a Poradie kde sa nachádzajú všetky dievÄčatá¡. <a href="http://vybertvar.6f.sk"/>viac...</a></p><p>Potrebujete pomoc, neviete si s niečim radi napíšte mi. Máte nápad s vylepšením. Môžete mi napísať na email ver4rs@gmail.com. </br>Na tento email neodpovedajte!</p></html>';


	$predmet_email = 'Vyber tvár, koniec';



	$odosli_email = mail($komu_email, $predmet_email, $text_email, join("\r\n", $hlavicka_email));

	if ($odosli_email) {
		echo 'Email bol odoslany.';
	}




?>
