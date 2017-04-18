<?php

require_once('includes/hlava.php');
require_once('db.php');

require 'pocitaj.php';

?>

<div class="pocitadlo">

  <h2>Štatistika stránky</h2>
    <p>
    	<h3 id="pocitadlo_typ">Ip adresa: </h3>
    	<span id="pocitadlo_pocet"><?php echo $ipAdresa; ?></span>
	</p>
    <p>
    	<h3 id="pocitadlo_typ">Počet návštev: </h3>
    	<span id="pocitadlo_pocet"><?php echo $pocet_navstevnikov_dokopy; ?></span>
    </p>
    <p>
    	<h3 id="pocitadlo_typ">Počet zobrazení: </h3>
    	<span id="pocitadlo_pocet"><?php echo $pocet_navstev_dokopy; ?></span>
    </p>

    <p>
    	<h3 id="pocitadlo_typ">Online: </h3>
    	<span id="pocitadlo_pocet"><?php echo $online_hosti; ?></span>
    </p>

</div>


<div class="pocitadlo">

  <h2>Dnes</h2>
    <p>
        <h3 id="pocitadlo_typ">Počet zobrazení: </h3>
        <span id="pocitadlo_pocet"><?php echo $skuska_ip_pocet; ?></span>
    </p>
    <p>
        <h3 id="pocitadlo_typ">Počet návštev: </h3>
        <span id="pocitadlo_pocet"><?php echo $dnes_navstevaIp; ?></span>
    </p>

</div>

<?php
include_once('includes/spod.php');
?>
