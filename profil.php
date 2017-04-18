<?php

session_start();

if (isset($_SESSION['user_id']) && $_SESSION['user_id'] != '') {
	$prihlas = 1;
}

if (!isset($_GET['obraz']) or strlen($_GET['obraz']) != '5') {
	echo 'Neautorizovany pristup';
	exit();
}

$obrazok_id = $_GET['obraz'];

require_once('includes/hlava.php');
require_once('db.php');

$zobraz = mysql_query('SELECT anketa_id, obrazok_id, obrazok_nazov, obrazok_popis, obrazok_ano, obrazok_nie, obrazok_skore, aktivacia FROM anketa WHERE obrazok_id ="' . mysql_real_escape_string($obrazok_id) . '"');


if (mysql_num_rows($zobraz) != '0') {
	$ukaz = mysql_fetch_array($zobraz);

	$obrazok_cesta = 'http://vybertvar.6f.sk/fotky/velke/' . htmlspecialchars($ukaz['obrazok_id']) . '.jpg';

	?>
	<div class="ukaz-profil">
		<div id="profil-lavo">
			<img src="<?php echo $obrazok_cesta; ?>" alt="Pekná dievčina" title="Pekná dievčina" id="obrazok_img">
			<p>Skóre: <?php echo htmlspecialchars($ukaz['obrazok_skore']); ?></p>
			<p>Výhra: <?php echo htmlspecialchars($ukaz['obrazok_ano']); ?> &nbsp  Prehra: <?php echo htmlspecialchars($ukaz['obrazok_nie']); ?></p>
		</div>
		<div id="profil-pravo">

			<p id="stahuj"><a href="http://vybertvar.6f.sk/stahuj.php?filename=<?php echo htmlspecialchars($ukaz['obrazok_id']); ?>.jpg">Stiahnuť <img src="http://vybertvar.6f.sk/images/download.gif" title="Stiahnuť" alt="foto"></a> &nbsp; &nbsp; <a href="https://facebook.com/sharer.php?u=http://vybertvar.6f.sk/profil/<?php echo htmlspecialchars($ukaz['obrazok_id']); ?>/" target="t_blank">Zdieľaj na FB <img src="http://vybertvar.6f.sk/images/fb.jpeg" title="Zdieľaj na FB" alt="foto"></a>
			<?php
			if ($prihlas == '1') {
				?><a href="http://vybertvar.6f.sk/sprava.php?vymaz=<?php echo $_GET['obraz']; ?>" target="_blank">vymaž</a><?php
			}
			?>
			</p>

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

			<?php
			# NAHODNE OBRAZKY
			$aktivacia = 1;
			$nac = mysql_query('SELECT anketa_id, obrazok_id, obrazok_nazov, obrazok_popis, obrazok_ano, obrazok_nie, obrazok_skore, aktivacia FROM anketa WHERE aktivacia = "' . mysql_real_escape_string($aktivacia) . '" ORDER BY rand() LIMIT 6');
			if (mysql_num_rows($nac) != '0') {
				$pocetRiadok = 3;
				$pocetRiadokPocitaj = 0;
				?>
			 	<div id="galeria">
			 		<div id="galeria-obrazok">
			 	<?php
			 	while ($riad = mysql_fetch_array($nac)) {
			 		$nahod_cesta = 'http://vybertvar.6f.sk/fotky/male/' . htmlspecialchars($riad['obrazok_id']) . '.jpg';

			 		$pocetRiadokPocitaj +=1;

				 	?>
				 		<a href="http://vybertvar.6f.sk/profil/<?php echo htmlspecialchars($riad['obrazok_id'] . '/'); ?>"><img src="<?php echo htmlspecialchars($nahod_cesta); ?>" alt="" title="" style="width: 120px;"></a>
				 	<?php

				 	if ($pocetRiadokPocitaj == $pocetRiadok) {
			 			$pocetRiadokPocitaj =0;
			 			?>
			 			</div>
			 			<div id="galeria-obrazok">
			 			<?php
			 		}

			 	}
			 	?>
			 	</div>
			 	<?php
			}
			mysql_free_result($nac);
			?>




			<span>&nbsp;</br></span>

<?php
	# URL ADRESA
	$host = $_SERVER['HTTP_HOST'];
	$self = $_SERVER['PHP_SELF'];
	$query = !empty($_SERVER['QUERY_STRING']) ? $_SERVER['QUERY_STRING'] : null;
	$url = !empty($query) ? "http://$host$self?$query" : "http://$host$self";
?>

<!-- FB koment -->
<div class="fb-comments" data-href="<?php echo $_SERVER['SERVER_NAME'] . '/profil/' . $_GET['obraz'] . '/'; ?>" data-width="470" data-num-posts="6"></div>



		</div>
	</div>
	<?php
}
else {
	echo 'Neautorizovany pristup';
	exit();
}
mysql_free_result($zobraz);


include_once('includes/spod.php');

?>

