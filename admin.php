<?php

$data = '';
$data = 'includes/hlava.php';
require $data;
$data = '';
require 'db.php';

session_start();

if (!isset($_SESSION['user_id']) && $_SESSION['user_id'] == '') {
	echo '<h2>Neautorizovany pristup</h2>';
	header('Refresh: 1; url=http://vybertvar.6f.sk/prihlas');
	exit();
}




echo ' a si tu Meno : ' . $_SESSION['user_meno'] . ' a id = ' . $_SESSION['user_id'];
echo ' <a href="http://vybertvar.6f.sk/odhlas"> odhlasit</a></br>';

# ----------------------------------------------- NOVE FOTO -------------------------------------------------------
echo '<h3>NOVÉ FOTO</h3>';
$aktivacia =0;
$foto = mysql_query('SELECT anketa_id, obrazok_id, aktivacia FROM anketa WHERE aktivacia ="' . mysql_real_escape_string($aktivacia) . '" ORDER BY anketa_id DESC');
if (mysql_num_rows($foto) != '0') {
	$foto_riadok_pocet =7;
	$foto_riadok_cislo =1;
	?>
	<table>
		<tr>
		<?php
		# SU NOVE
		while ($riadok = mysql_fetch_array($foto)) {
			$cesta_original = 'http://www.vybertvar.6f.sk/fotky/original/' . $riadok['obrazok_id'] . '.jpg';
			$cesta_velke = 'http://www.vybertvar.6f.sk/fotky/velke/' . $riadok['obrazok_id'] . '.jpg';
			$cesta_male = 'http://www.vybertvar.6f.sk/fotky/male/' . $riadok['obrazok_id'] . '.jpg';


			?>
			<td><a href="<?php echo htmlspecialchars('http://vybertvar.6f.sk/profil/' . $riadok['obrazok_id'] . '/'); ?>" target="t_blank"><img src="<?php echo htmlspecialchars($cesta_male); ?>" alt="" title="" style="width: 150px;"></a></br><a href="http://www.vybertvar.6f.sk/sprava.php?aktiv=<?php echo htmlspecialchars($riadok['obrazok_id']); ?>" target="_blank">Aktivuj</a></td>
			<?php

			$foto_riadok_cislo +=1;
			if ($foto_riadok_cislo >= $foto_riadok_pocet) {
				$foto_riadok_cislo =1;
				?></tr><tr><?php
			}

		}
		?>
		</tr>
	</table>
	<?php
}
else {
	# ZIADNE NOVE FOTO
	echo 'Žiadne nové foto!';
}
mysql_free_result($foto);


# ----------------------------------------------- KONIEC NOVE FOTO -------------------------------------------------------




# ---------------------------------------------------- ONLINE --------------------------------------------------------------

$id2 = 0;

#online
$ukaz_on = mysql_query('SELECT online_id, online_ip, online_cas, online_vyber FROM online ORDER BY online_id ASC');

if (mysql_num_rows($ukaz_on) != '0') {
	?>
	<div id="ukaz_online">
		<table>
			<tr>
				<td>Poradie</td>
				<td>IP adresa</td>
				<td>Datum a cas</td>
				<td>typ</td>
			</tr>
	<?php
	while ($riadok = mysql_fetch_array($ukaz_on)) {
		$id2 = $id2 + 1;

		if ($riadok['online_vyber'] == '1') {  //prihlaseny
			$vyber = 'prihlaseny';
		}
		elseif ($riadok['online_vyber'] == '2') {  //host
			$vyber = 'hosť';
		}
		else {
			$vyber = 'neviem';
		}

		?>
			<tr>
				<td><?php echo htmlspecialchars($id2); ?></td>
				<td><?php echo htmlspecialchars($riadok['online_ip']); ?></td>
				<td><?php echo htmlspecialchars($riadok['online_cas']); ?></td>
				<td><?php echo htmlspecialchars($vyber); ?></td>
			</tr>
		<?php
	}
	?>
		</table>
	</div>
	<?php
}
mysql_free_result($ukaz_on);

# ---------------------------------------------------- ONLINE --------------------------------------------------------------


/*       DNES CELKOVO                                               */
#DNES
    #POCET CELKOVO
echo '<div id="ukaz_dnes"><h3>DNES POCITADLO</h3>';
    $statistika1 = mysql_query('SELECT statistika_id, DAYOFMONTH(statistika_cas), statistika_ip
                                FROM statistika
                                WHERE DAYOFMONTH(statistika_cas) = "' . mysql_real_escape_string(date('d')) . '" ');
    if (mysql_num_rows($statistika1) != '0') {
        $dnes_navsteva = mysql_num_rows($statistika1);
    }
    else {
        $dnes_navsteva = 0;
    }
    mysql_free_result($statistika1);


    #POCET IP ADRIES
    echo 'Dnes pocet ip unikatne navstevy: </br>';
    $statistika2 = mysql_query('SELECT statistika_id, DAYOFMONTH(statistika_cas), COUNT(statistika_ip) as ipPocet, statistika_cas, statistika_ip
                                FROM statistika
                                WHERE DAYOFMONTH(statistika_cas) = "' . mysql_real_escape_string(date('d')) . '" AND MONTH(statistika_cas) = "' . mysql_real_escape_string(date('m')) . '" GROUP BY statistika_ip');
    if (mysql_num_rows($statistika2) != '0') {
        $dnes_navstevaIp = mysql_num_rows($statistika2);
        $skuska_ip_pocet = 0;
        while ($riadok11 = mysql_fetch_array($statistika2)) {
        	echo $riadok11['statistika_ip'] . '  -  ' . $riadok11['statistika_cas'] . '  -  ' . $riadok11['ipPocet'] . '</br>';
        	$skuska_ip_pocet += $riadok11['ipPocet'];
        }
    }
    else {
        $dnes_navstevaIp = 0;
    }
    mysql_free_result($statistika2);
echo '<h3>DNES</h3></br>Počet zobrazení dnes: ' . $dnes_navsteva . '  skuska: ' . $skuska_ip_pocet . '</br>Počet návštev IP dnes: ' . $dnes_navstevaIp . '</br></div>';

/*       KONIEC DNES CELKOVO                                               */



# ------------------------------------------  POCITADLO NOVE  ------------------------


$id1 = 0;

if (isset($_GET['strana']) AND !empty($_GET['strana'])) {
	$strana = $_GET['strana'];
}
else {
	$strana = 1;
}

if (!is_numeric($strana)) {
	$strana = 1;
}


$zisti = mysql_query('SELECT statistika_id FROM statistika ');
if (mysql_num_rows($zisti) != '0') {
	$pocet = mysql_num_rows($zisti);
}
else {
	$pocet = 0;
}
mysql_free_result($zisti);

$start = 0;
$limit = 20;

#STRANY VYPOCITANIE
$pocetStran = ceil($pocet / $limit);
if ($pocetStran < $strana) {
	$strana = 1;
}
$start = ($strana * $limit) - $limit;


$ukaz_poc = mysql_query('SELECT statistika_id, statistika_ip, statistika_cas
						FROM statistika
						ORDER BY statistika_id ASC LIMIT ' . $start . ', ' . $limit . ' ');
if (mysql_num_rows($ukaz_poc) != '0') {
	?>
	<div id="ukaz_pocitadlo_nove">
		<h3>Počitadlo NOVE</h3>
		<table>
			<tr>
				<td>Poradie</td>
				<td>IP adresa</td>
				<td></td>
				<td>Datum a cas</td>
			</tr>
	<?php
	#vytlacime
	#a pobavime sa dame do pola
	#nemam nato cas
	while ($riadok = mysql_fetch_array($ukaz_poc)) {
		$id1 = $id1 + 1;
		?>
			<tr>
				<td><?php echo $riadok['statistika_id']; /*$id1;*/ ?></td>
				<td><?php echo $riadok['statistika_ip']; ?></td>
				<td>   </td>
				<td><?php echo $riadok['statistika_cas']; ?></td>
			</tr>
		<?php
	}
	?>
		</table>
		<span>Strana
		<?php
		$jedenRiadok1 = 0;
		$jedenRiadok = 30;
		for ($i=1; $i <= $pocetStran ; $i++) {
			$jedenRiadok1 += 1;
			if ($jedenRiadok1 == $jedenRiadok) {
				$jedenRiadok1 = 0;
				echo '</br>';
			}

			if ($strana == $i) { //aktualna strana
				?>
				<font color="#666666" style=" font-weight:bold; "><?php echo htmlspecialchars($i); ?></font>
				<?php
			}
			else {
				?>
				<a href="?strana=<?php echo urlencode($i); ?>"><?php echo htmlspecialchars($i); ?></a>
				<?php
			}
		}
		?>
		</span>
	</div>
	<?php
}
mysql_num_rows($ukaz_poc);


# ------------------------------------------  POCITADLO NOVE  ------------------






# ----------------------------------------------------- POCITADLO STARE  ----------------------------------------------------------------

$id1 = 0;

if (isset($_GET['strana']) or !empty($_GET['strana'])) {
	$strana = $_GET['strana'];
}
else {
	$strana = 1;
}

if (!is_numeric($strana)) {
	$strana = 1;
}


$zisti = mysql_query('SELECT pocitadlo_id FROM pocitadlo ');
if (mysql_num_rows($zisti) != '0') {
	$pocet = mysql_num_rows($zisti);
}
else {
	$pocet = 0;
}

$start = 0;
$limit = 20; //pocet


#STRANY VYPOCITANIE
$pocetStran = ceil($pocet / $limit);
if ($pocetStran < $strana) {
	$strana = 1;
}
$start = ($strana * $limit) - $limit;


$ukaz_poc = mysql_query('SELECT pocitadlo_id, pocitadlo_navstev, pocitadlo_ip, pocitadlo_ip_pocet, pocitadlo_celkovo, pocitadlo_datum
						FROM pocitadlo
						ORDER BY pocitadlo_id ASC LIMIT ' . $start . ', ' . $limit . ' ');
if (mysql_num_rows($ukaz_poc) != '0') {
	?>
	<div id="ukaz_pocitadlo">
		<h3>Počitadlo staré</h3>
		<table>
			<tr>
				<td>Poradie</td>
				<td>IP adresa</td>
				<td>Pocet navstev</td>
				<td>Pocet zobrazeni</td>
				<td>Datum a cas</td>
			</tr>
	<?php
	#vytlacime
	#a pobavime sa dame do pola
	#nemam nato cas
	while ($riadok = mysql_fetch_array($ukaz_poc)) {
		$id1 = $id1 + 1;
		?>
			<tr>
				<td><?php echo $riadok['pocitadlo_id']; /*$id1;*/ ?></td>
				<td><?php echo $riadok['pocitadlo_ip']; ?></td>
				<td><?php echo $riadok['pocitadlo_ip_pocet']; ?></td>
				<td><?php echo $riadok['pocitadlo_navstev']; ?></td>
				<td><?php echo $riadok['pocitadlo_datum']; ?></td>
			</tr>
		<?php
	}
	?>
		</table>
		<span>Strana
		<?php
		$jedenRiadok1 = 0;
		$jedenRiadok = 30;
		for ($i=1; $i <= $pocetStran ; $i++) {
			$jedenRiadok1 += 1;
			if ($jedenRiadok1 == $jedenRiadok) {
				$jedenRiadok1 = 0;
				echo '</br>';
			}

			if ($strana == $i) { //aktualna strana
				?>
				<font color="#666666" style=" font-weight:bold; "><?php echo htmlspecialchars($i); ?></font>
				<?php
			}
			else {
				?>
				<a href="?strana=<?php echo urlencode($i); ?>"><?php echo htmlspecialchars($i); ?></a>
				<?php
			}
		}
		?>
		</span>
	</div>
	<?php
}
mysql_num_rows($ukaz_poc);





?>

