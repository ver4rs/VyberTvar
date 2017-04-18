<?php
if ($_SERVER['PHP_SELF'] == '/index.php') {
	# PRIDAME CSS A HTML DOPLNOK NA DOBRE ZOBRAZENIE
	$styl = ' margin-top: -640px; ';
	$stylDole = ' margin-top: 0px; ';
}
elseif ($_SERVER['PHP_SELF'] == '/top.php') {
	# PRIDAME CSS A HTML DOPLNOK NA DOBRE ZOBRAZENIE
	$styl = ' margin-top: -630px; ';
	$stylDole = ' margin-top: 0px; ';
}
elseif ($_SERVER['PHP_SELF'] == '/poradie.php') {
	# PRIDAME CSS A HTML DOPLNOK NA DOBRE ZOBRAZENIE
	$styl = ' margin-top: -630px; ';
	$stylDole = ' margin-top: 0px; ';
}
elseif ($_SERVER['PHP_SELF'] == '/podmienky.php') {
	# PRIDAME CSS A HTML DOPLNOK NA DOBRE ZOBRAZENIE
	$styl = ' margin-top: -570px; ';
	$stylDole = ' margin-top: 0px; ';
}
elseif ($_SERVER['PHP_SELF'] == '/pridajFoto.php') {
	# PRIDAME CSS A HTML DOPLNOK NA DOBRE ZOBRAZENIE
	$styl = ' margin-top: -360px; ';
	$stylDole = ' margin-top: 100px; ';
}
elseif ($_SERVER['PHP_SELF'] == '/profil.php') {
	# PRIDAME CSS A HTML DOPLNOK NA DOBRE ZOBRAZENIE
	$styl = ' margin-top: -900px; display: none; ';
	$stylDole = ' margin-top: 0px; ';
}
elseif ($_SERVER['PHP_SELF'] == '/statistika.php') {
	# PRIDAME CSS A HTML DOPLNOK NA DOBRE ZOBRAZENIE
	$styl = ' margin-top: -480px; ';
	$stylDole = ' margin-top: 0px; ';
}
else {
	$styl = '';
}

/*
<!-- dole -->
<div id="rekl" style="text-align: center;<?php echo $stylDole; ?>">
	<script type="text/javascript"><!--
google_ad_client = "ca-pub-9567823677125251";
/* tvar-1 *//*
google_ad_slot = "2099054127";
google_ad_width = 728;
google_ad_height = 90;
//-->
</script>
<script type="text/javascript"
src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script>

</div>
*/
/*
?>

<!-- v pravo  -->
<div id="rekl" style="<?php echo $styl; ?>position:relative; float: right; margin-right: 10px;">

    <script type="text/javascript"><!--
google_ad_client = "ca-pub-9567823677125251";
/* tvar-2 *//*
google_ad_slot = "2777164450";
google_ad_width = 160;
google_ad_height = 600;
//-->
</script>
<script type="text/javascript"
src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script>

</div>

<?php
*/
/*
<!-- v lavo
<div id="rekl" style="float: left;  margin-top: -640px; margin-left: 10px;">

    <script type="text/javascript">
google_ad_client = "ca-pub-9567823677125251";
/* tvar-2 *//*
google_ad_slot = "2777164450";
google_ad_width = 160;
google_ad_height = 600;
//
</script>
<script type="text/javascript"
src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script>]
</div>
-->
*/
?>



