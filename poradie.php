<?php

require_once ('db.php');
require_once ('includes/hlava.php');

session_start();

if (isset($_SESSION['user_id']) && $_SESSION['user_id'] != '') {
	$prihlas = 1;
}



#strana z URL adresy, ak je zadana
if (isset($strana) or !empty($_GET['strana'])) {
	$strana = $_GET['strana'];
}
else {
	$strana = '1';
}

$limit = '24';
if (isset($_GET['limit']) AND $_GET['limit'] != FALSE) {
	$limit = $_GET['limit'];
}



#pocet vysledkov
$aktivacia =1;
$pocet = mysql_query('SELECT anketa_id, aktivacia FROM anketa WHERE aktivacia = "' . mysql_real_escape_string($aktivacia) . '" ORDER BY anketa_id DESC');
$celkovy_pocet = mysql_num_rows($pocet);
mysql_free_result($pocet);

$pocet_stran = ceil($celkovy_pocet / $limit);
$pociatok = ($strana * $limit) - $limit;

#zobrazenie vysledkov
$zobraz = mysql_query("SELECT anketa_id, obrazok_id, obrazok_skore, obrazok_ano, obrazok_nie, aktivacia FROM anketa WHERE aktivacia ='" . mysql_real_escape_string($aktivacia) . "' ORDER BY obrazok_skore DESC LIMIT $pociatok, $limit ");

if (mysql_num_rows($zobraz) != 0) {
	while ($riadok = mysql_fetch_array($zobraz)) {
		//echo $riadok['obrazok_id'] . '<br>';
		$obrazok_id[] = $riadok['obrazok_id'];
		$obrazok_skore[] = $riadok['obrazok_skore'];
		$obrazok_ano[] = $riadok['obrazok_ano'];
		$obrazok_nie[] = $riadok['obrazok_nie'];
	}
}
else {
	echo 'Takato strana neexistuje.';
}
mysql_free_result($zobraz);

#zobrazenie pola
?>
<div class="celokPoradie">
<a href="http://vybertvar.6f.sk/poradie/?limit=24">24</a>&nbsp;<a href="http://vybertvar.6f.sk/poradie/?limit=36">36</a>&nbsp;<a href="http://vybertvar.6f.sk/poradie/?limit=48">48</a>&nbsp;<a href="http://vybertvar.6f.sk/poradie/?limit=60">60</a></br>



	<div id="dievca-banner-2">
		<script type="text/javascript"><!--
		google_ad_client = "ca-pub-9567823677125251";
		/* tvar-5 */ /* odkaz poradie + too  */
		google_ad_slot = "4071137975";
		google_ad_width = 728;
		google_ad_height = 15;
		//-->
		</script>
		<script type="text/javascript"
		src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
		</script>
	</div>



<div id="poradie">
<p class="riadok">
<?php
$zo_poc = 0;
$id_poc = -1;
$po_rek = 0;
foreach ($obrazok_id as $key) {
	$zo_poc = $zo_poc +1;
	$id_poc += +1;
	?>


			<div id="stlpec">
			<a href="http://vybertvar.6f.sk/profil/<?php echo $obrazok_id[$id_poc]; ?>">
				<img src="http://vybertvar.6f.sk/fotky/male/<?php echo $obrazok_id[$id_poc]; ?>.jpg" title="videl si už aj iné foto">
				<span id="skore">Skóre: <?php echo $obrazok_skore[$id_poc]; ?></span>
				<span id="skore1">Výhra: <?php echo $obrazok_ano[$id_poc]; ?>&nbsp; Prehra: <?php echo $obrazok_nie[$id_poc]; ?></span></a>
				<?php
			if ($prihlas == '1') {
				?><a href="http://vybertvar.6f.sk/sprava.php?vymaz=<?php echo $obrazok_id[$id_poc]; ?>" target="_blank">vymaž</a><?php
			}
			?>
			</div>
	<?php
	if ($zo_poc == 6) {
		$zo_poc = 0;
		$po_rek +=1;
		if ($po_rek == 2) {
			$po_rek =-1;
			?>
			</p>
					<div id="reklammm">
						<script type="text/javascript"><!--
						google_ad_client = "ca-pub-9567823677125251";
						/* tvar-3 */
						google_ad_slot = "5048343576";
						google_ad_width = 336;
						google_ad_height = 280;
						//-->
						</script>
						<script type="text/javascript"
						src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
						</script>

						&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;

						<script type="text/javascript"><!--
						google_ad_client = "ca-pub-9567823677125251";
						/* tvar-3 */
						google_ad_slot = "5048343576";
						google_ad_width = 336;
						google_ad_height = 280;
						//-->
						</script>
						<script type="text/javascript"
						src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
						</script>
					</div>

			<p class="riadok">
			<?php
		}
		else {
			?>
			</p>
			<p class="riadok">
			<?php
		}

	}

}

?>
</p>
</div>
<?php
#koniec zobrazenie pola




#zobrazenie stran
$pocet_zobrazenych_stran = 31;  //nacita z DB
$pocet_zobrazenych_stran1 = ceil(($pocet_zobrazenych_stran-1)/2);

$zaciatok = 0+ $pocet_zobrazenych_stran1;

#zaciatok
if ($zaciatok >= $strana) {   //  4          else  7
	$zac_strana = $strana - 1;  //   4-1= 3
	$zacinajuca_strana = $strana - $zac_strana;
}
else {
	$zacinajuca_strana = $strana - $pocet_zobrazenych_stran1;
}

#koniec
if (($pocet_stran - $pocet_zobrazenych_stran1) <= $strana) {  //    (100-5=95)     96          else 93
	$kon_strana = $pocet_stran - $strana;                      //     100-96= 4
	$konecna_strana = $strana + $kon_strana;
	$zacinajuca_strana = $zacinajuca_strana - ($pocet_zobrazenych_stran1 - $kon_strana);
}
else {
	$konecna_strana = $strana + $pocet_zobrazenych_stran1;
}
?>
<div class="strankovanie">
<?php
$i = $zacinajuca_strana;
if ($i <=1) {
	$i=1;
}
for ($i; $i <= $konecna_strana; $i++) {
	if ($strana != $i) {
		//neaktualna strana
		?>
		<a href="http://vybertvar.6f.sk/poradie/<?php echo $i; ?>/"><?php echo $i; ?></a>
		<?php
	}
	else {
		//aktualna strana
		?>
		<font color="#FF0000"><?php echo $i; ?></font>
		<?php
	}
}
?>
</div>
<?php

include 'includes/spod.php';

?>


