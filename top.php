<?php


# TOP 20
require_once ('db.php');
require_once ('includes/hlava.php');




$aktivacia =1;
$top1 = mysql_query('SELECT anketa_id, obrazok_id, aktivacia, ROUND(obrazok_skore/(1+(obrazok_nie/obrazok_ano))) AS topa FROM anketa WHERE aktivacia ="' . mysql_real_escape_string($aktivacia) . '" ORDER BY ROUND(obrazok_skore/(1+(obrazok_nie/obrazok_ano))) DESC LIMIT 0,10');


if (mysql_num_rows($top1) != '0') {
	$miesto = 0;
	$pocet_riadkov = -1;
	while ($top = mysql_fetch_array($top1)) {
		$obrazok_id[] = $top['obrazok_id'];

	}
}
mysql_free_result($top1);
?>
<div class="top">

	<div id="dievca-banner-2">
		<script type="text/javascript"><!--
		google_ad_client = "ca-pub-9567823677125251";
		/* tvar-5 */ /* odkaz poradie  */
		google_ad_slot = "4071137975";
		google_ad_width = 728;
		google_ad_height = 15;
		//-->
		</script>
		<script type="text/javascript"
		src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
		</script>
	</div>

	<table>
	<tr>
<?php
foreach ($obrazok_id as $obrazok_id_z) {
	$miesto += +1;
	$pocet_riadkov += +1;

	if ($pocet_riadkov == 5) {
		$pocet_riadkov = 0;
		?>
		</tr>
		<tr>
		<?php
	}
	?>
		<td><span id="miesto"><?php //echo $miesto; ?></span><a href="http://vybertvar.6f.sk/profil/<?php echo $obrazok_id_z; ?>"><img src="http://vybertvar.6f.sk/fotky/male/<?php echo $obrazok_id_z; ?>.jpg" style="width: 180px; height: 240px;"></a></td>
	<?php

}
?>
</tr>
</table>

</div>
<?php



include 'includes/spod.php';

?>
