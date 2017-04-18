<?php

require 'db.php';


$ipAdresa = $_SERVER['REMOTE_ADDR'];


/*  ****************************************************************************************************************  */
    //tlacenie pre jedneho uzivatela, pocet navstev a zobrazeny
    $tlac = 'SELECT pocitadlo_ip, pocitadlo_navstev, pocitadlo_ip_pocet
              FROM pocitadlo
              WHERE pocitadlo_ip = "' . $ipAdresa . '"';
    $tlac1 = mysql_query($tlac)or die(mysql_error());

    if (mysql_num_rows($tlac1) != '0') {
      $tlacme = mysql_fetch_array($tlac1);

      //echo 'Ip adresa: ' . $tlacme['pocitadlo_ip'] . '  Navstevy : ' . $tlacme['pocitadlo_ip_pocet'] . ' Stranka: ' . $tlacme['pocitadlo_navstev'] . ' ';

    }
    mysql_free_result($tlac1);
/*  ****************************************************************************************************************  */





/*  ****************************************************************************************************************  */
    //pocitadlo dokopy navsteva a zobrazenie stranky
    $zobraz = 'SELECT pocitadlo_ip, pocitadlo_navstev, pocitadlo_ip_pocet, pocitadlo_datum FROM pocitadlo ORDER BY pocitadlo_id';
    $zobraz1 = mysql_query($zobraz)or die(mysql_error());

    //vynulovanie premennych
    $pocet_navstev_dokopy = '0';
    $pocet_navstevnikov_dokopy = '0';

    while ($spolu = mysql_fetch_array($zobraz1)) {
      //dokopy spolu
      $pocet_navstev_dokopy = $spolu['pocitadlo_navstev'] + $pocet_navstev_dokopy;
      $pocet_navstevnikov_dokopy = $spolu['pocitadlo_ip_pocet'] + $pocet_navstevnikov_dokopy;
    }
    mysql_free_result($zobraz1);
/*  ****************************************************************************************************************  */




/*  ****************************************************************************************************************  */
 //tlacenie online uzivatelov neprihlasenych, hosti
    $tlac_uz2 = mysql_query('SELECT online_id FROM online WHERE online_vyber=2 ORDER BY online_id')or die(mysql_error());
    $online_hosti = mysql_num_rows($tlac_uz2);
    mysql_free_result($tlac_uz2);
    //koniec online uzivatel, hosti
/*  ****************************************************************************************************************  */


    //  $tlacme['pocitadlo_ip_pocet'] = pocet navstev podla ip adresy
    //  $tlacme['pocitadlo_navstev'] = pocet zobrazeny podla ip adresy


/*  ****************************************************************************************************************  */
#dnes
#vcera
/*
$dnes_tlac = mysql_query('SELECT pocitadlo_ip, pocitadlo_ip_pocet, pocitadlo_navstev
                            FROM pocitadlo
                            WHERE DATE(pocitadlo_datum) ="' . mysql_real_escape_string(date("Y-m-d")) . '" ');
$dnes_navsteva = 0;
$dnes_zobrazeni = 0;

if (mysql_num_rows($dnes_tlac) != '0') {
    while ($riadok = mysql_fetch_array($dnes_tlac)) {
        #exituje pristup
        #navsetevy a zobrazenia
        //$dnes_navsteva = $riadok['pocitadlo_ip_pocet'] + $dnes_navsteva;
        $dnes_zobrazeni = $riadok['pocitadlo_navstev'] + $dnes_zobrazeni;
    }
    $dnes_navsteva = mysql_num_rows($dnes_tlac);
}
mysql_free_result($dnes_tlac);

/*  ****************************************************************************************************************  */

#DNES
    #POCET CELKOVO
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
    $statistika2 = mysql_query('SELECT statistika_id, DAYOFMONTH(statistika_cas), COUNT(statistika_ip) as ipPocet, statistika_cas, statistika_ip
                                FROM statistika
                                WHERE DAYOFMONTH(statistika_cas) = "' . mysql_real_escape_string(date('d')) . '" AND MONTH(statistika_cas) = "' . mysql_real_escape_string(date('m')) . '" GROUP BY statistika_ip');
    if (mysql_num_rows($statistika2) != '0') {
        $dnes_navstevaIp = mysql_num_rows($statistika2);  // dnes pocet ip unikatne
        $skuska_ip_pocet = 0; // dnes dokopy zobrazeni
        while ($riadok11 = mysql_fetch_array($statistika2)) {
            //echo $riadok11['statistika_ip'] . '  -  ' . $riadok11['statistika_cas'] . '  -  ' . $riadok11['ipPocet'] . '</br>'; // vypise setky ip adresy za dnes unikat a cas a..
            $skuska_ip_pocet += $riadok11['ipPocet'];
        }
    }
    else {
        $dnes_navstevaIp = 0;
        $skuska_ip_pocet = 0;
    }
    mysql_free_result($statistika2);


?>
