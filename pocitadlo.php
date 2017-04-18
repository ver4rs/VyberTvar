<?php

$datab = 'db.php';
require $datab;
$datab = '';


/*
pocitadlo

*/


//echo $_SERVER['REMOTE_ADDR'] . '<br>' . $_SERVER['SERVER_ADDR'] . '<br>' . $_SERVER['HTTP_USER_AGENT'] . '<br>';

$ipAdresa = $_SERVER['REMOTE_ADDR'];



/*  ***************************************** algoritmus overenie, pocitanie navstev a zobrazeny ************************************  */
$over = 'SELECT pocitadlo_ip FROM pocitadlo WHERE pocitadlo_ip ="' . $ipAdresa . '"';
$over1 = mysql_query($over)or die(mysql_error());

if (mysql_num_rows($over1) == FALSE) {
  //zapis
  $pocet_navstev = '1';

  $zapis = 'INSERT INTO pocitadlo (pocitadlo_id, pocitadlo_ip, pocitadlo_navstev, pocitadlo_ip_pocet, pocitadlo_celkovo, pocitadlo_datum)
            VALUES (NULL,
                    "' . $ipAdresa . '",
                    "' . $pocet_navstev . '",
                    "' . $pocet_navstev . '",
                    "' . $pocet_navstev . '",
                    "' . date('Y-m-d H:i:s') . '")';
$zapis1 = mysql_query($zapis)or die(mysql_error());


}
else {
  //uz bol tu
  $nacitaj = 'SELECT pocitadlo_id, pocitadlo_ip, pocitadlo_navstev, pocitadlo_ip_pocet, pocitadlo_celkovo, pocitadlo_datum
                FROM pocitadlo
               WHERE pocitadlo_ip = "' .  $ipAdresa . '"';
  $nacitaj1 = mysql_query($nacitaj)or die(mysql_error());

  if (mysql_num_rows($nacitaj1) != '0') {
    $riadok = mysql_fetch_array($nacitaj1);
    //cas nastaveny +30minnut na odstranenie starych zaznamov
    $datum_a = strtotime($riadok['pocitadlo_datum']);
    $datum_zmena = $datum_a +(60*30);
    $datum = date("Y-m-d H:i:s", $datum_zmena);

    if (date('Y-m-d H:i:s') > $datum ) {
      //preslo 30 minut
      $prikaz = 'UPDATE pocitadlo SET
                  pocitadlo_navstev = "' . mysql_real_escape_string($riadok['pocitadlo_navstev'] + 1) . '",
                  pocitadlo_ip_pocet = "' . mysql_real_escape_string($riadok['pocitadlo_ip_pocet'] + 1) . '",
                  pocitadlo_datum = "' . mysql_real_escape_string(date("Y-m-d H:i:s")) . '"
                WHERE pocitadlo_ip = "' . $ipAdresa . '"';
      $prikaz1 = mysql_query($prikaz)or die(mysql_error());

      //tlacenie

    }
    else {
      //nepreslo 30
      $prikaz = 'UPDATE pocitadlo SET pocitadlo_navstev ="' . mysql_real_escape_string($riadok['pocitadlo_navstev'] +1) . '",
                                      pocitadlo_datum = "' . mysql_real_escape_string(date("Y-m-d H:i:s")) . '"
                  WHERE pocitadlo_ip = "' . $ipAdresa . '"';
      $prikaz1 = mysql_query($prikaz)or die(mysql_error());

      //tlacenie

    }
  }
  mysql_free_result($nacitaj1);
}

mysql_free_result($over1);
/*  ****************************************************************************************************************  */








/*  ****************************************************************************************************************  */
    //tlacenie pre jedneho uzivatela, pocet navstev a zobrazeny
/*    $tlac = 'SELECT pocitadlo_ip, pocitadlo_navstev, pocitadlo_ip_pocet
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
/*    $zobraz = 'SELECT pocitadlo_ip, pocitadlo_navstev, pocitadlo_ip_pocet, pocitadlo_datum FROM pocitadlo ORDER BY pocitadlo_id';
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
    //uzivatelia, pocet registrovanych uzivatelov
/*    $uziv = 'SELECT user_id, meno, user_cas FROM user ORDER BY user_id';
    $uziv1 = mysql_query($uziv)or die(mysql_error());

    if (mysql_num_rows($uziv1) != '0') {
      $pocet_register = mysql_num_rows($uziv1);
      $datum_dnes = date('d');
      $uziv_dnes_pocet = '0';
      $uziv_dnes_nazov = '';
      while ($uzivatel_dnes = mysql_fetch_array($uziv1)) {
        $vyber_dna = date('d', strtotime($uzivatel_dnes['user_cas']));

        if ($vyber_dna == $datum_dnes) {
          $uziv_dnes_pocet = $uziv_dnes_pocet + 1;
          $uziv_dnes_nazov.= $uzivatel_dnes['meno'] . ', ';
        }
      }
    }
    mysql_free_result($uziv1);
    //koniec pocet registrovanych uzivatelov

    /*
    //dnes registrovanych
    $uziv_dnes = mysql_query('SELECT meno, user_cas FROM user ORDER BY user_cas');

    if (mysql_num_rows($uziv_dnes) > '0') {
      $datum_dnes = date('d');
      $uziv_dnes_pocet = '0';
      $uziv_dnes_nazov = '';
      while ($uzivatel_dnes = mysql_fetch_array($uziv_dnes)) {
        $vyber_dna = date('d', strtotime($uzivatel_dnes['user_cas']));

        if ($vyber_dna == $datum_dnes) {
          $uziv_dnes_pocet = $uziv_dnes_pocet + 1;
          $uziv_dnes_nazov.= $uzivatel_dnes['meno'] . ', ';
        }
      }
    }
    */
    //mysql_free_result($uziv_dnes);
    //koniec dnes registrovanych
/*  ****************************************************************************************************************  */



/*  ****************************************************************************************************************  */
  //online uzivatelia

    //prihlaseny uzivatelia, online
    if (isset($_SESSION['user_id']) AND !empty($_SESSION['user_id'])) {
      //vymazeme ip adresu lebo navstivil stranku a bol host
      $vymaz_ho = mysql_query('DELETE FROM online WHERE online_ip ="' . $ipAdresa . '" AND online_vyber =2');



      //ci je zapisany a surfuje
      $on = 'SELECT user_id FROM online WHERE user_id ="' . $_SESSION['user_id'] . '" AND online_vyber = 1';
      $on1 = mysql_query($on)or die(mysql_error());
      if (mysql_num_rows($on1) != '0') {
        //naslo ho tam
        //prve treba z hosti vymazat tohto uzivatela
        //pre pre
        $onli = mysql_query('UPDATE online SET online_cas = "' . date('Y-m-d H:i:s') . '"
                                    WHERE user_id = "' . $_SESSION['user_id'] . '"');

      }
      else {
        //nenaslo ho tam
        $onl = 'INSERT INTO online (online_id, online_ip, online_cas, user_id, online_vyber)
                VALUES (NULL,
                        "' . $ipAdresa . '",
                        "' . date('Y-m-d H:i:s') . '",
                        "' . $_SESSION['user_id'] . '",
                        1)';
        $onl1 = mysql_query($onl)or die(mysql_error());

      }



    }
    else {
      //neprihlaseny uzivatelia, hostia
      //nacitanie, ci len obnovuje stranku
      $hos = mysql_query('SELECT online_ip FROM online WHERE online_ip ="' . $ipAdresa . '" AND online_vyber = 2');

      if (mysql_num_rows($hos) != '0') {
        //naslo, obnovuje stranku
        $host = mysql_query('UPDATE online SET online_cas= "' . date('Y-m-d H:i:s') . '"
                                    WHERE online_ip ="' . $ipAdresa . '"');

      }
      else {
        //nenaslo je tu novy, presiel cas, takze znova zapiseme
        $hostia = mysql_query('INSERT INTO online (online_id, online_cas, online_ip, online_vyber)
                                      VALUES (NULL,
                                              "' . date('Y-m-d H:i:s') . '",
                                              "' . $ipAdresa . '",
                                              2)');

      }

    }
    //cas nastaveny na -5minut
    $datum_u = strtotime(date('Y-m-d H:i:s'));
    $datum_zmena_u = $datum_u -(60*5);   // -(5 minut)
    $cas_uziv = date("Y-m-d H:i:s", $datum_zmena_u);


    //vymazeme vsetko 5 minut prihlasenych uzivatelov
//    $vymaz_uzivatel = mysql_query('DELETE FROM online WHERE online_cas <"' . $cas_uziv . '" AND online_vyber =1');
    //vymazeme vsetko 5 minut neprihlasenych uzivatelov, hosti
    $vymaz_hostia = mysql_query('DELETE FROM online WHERE online_cas <"' . $cas_uziv . '" AND online_vyber =2');
/*  ****************************************************************************************************************  */




/*  ****************************************************************************************************************  */
    //tlacenie online uzivatelov prihlasenych
/*    $tlac_uz1 = mysql_query('SELECT online_id, o.user_id, u.user_id, u.meno
                              FROM online o JOIN user u ON o.user_id = u.user_id
                              WHERE online_vyber=1 ORDER BY online_id')or die(mysql_error());
    $online_uzivatel = mysql_num_rows($tlac_uz1);
    $online_uziv_meno = '';
    while ($tlac_on_meno = mysql_fetch_array($tlac_uz1)) {
      $online_uziv_meno .= $tlac_on_meno['meno'] . ', ';
    }
    mysql_free_result($tlac_uz1);
*/    //koniec online uzivatel

    //tlacenie online uzivatelov neprihlasenych, hosti
    $tlac_uz2 = mysql_query('SELECT online_id FROM online WHERE online_vyber=2 ORDER BY online_id')or die(mysql_error());
    $online_hosti = mysql_num_rows($tlac_uz2);
    mysql_free_result($tlac_uz2);
    //koniec online uzivatel, hosti
/*  ****************************************************************************************************************  */


/*  ****************************************************************************************************************

      $ipAdresa = ipadresa
      $pocet_navstevnikov_dokopy = pocet navstev stranky dokopy
      $pocet_navstev_dokopy =   pocet zobrazeny stranky dokopy
   *   $tlacme['pocitadlo_ip_pocet'] = pocet navstev podla ip adresy
   *   $tlacme['pocitadlo_navstev'] = pocet zobrazeny podla ip adresy
      $pocet_register = pocet registrovanych uzivateliov
      $online_uzivatel = online prihlaeny uzivatelia po nastaveny cas dlzky
      $online_hosti = online hosti, navstevnikov stranky, odhlaseny, po nastaveny cas dlzky
      $uziv_dnes_pocet = pocet registrovanych dnes pocet cislo
      $uziv_dnes_nazov = pocet registrovanych dnes mena zaradom
      $online_uziv_meno = online prihlasenych uzivatelov mena zaradom

******************************************************************************************************************  */

    //echo '   ' .  $pocet_navstevnikov_dokopy . '   ' . $pocet_navstev_dokopy;
?>
<!--

<div class="pocitadlo">

  <span class="pocitadlo_titul">Štatistika stránky</span>
    <span id="pocitadlo_rozdel"><span id="pocitadlo_typ">Ip adresa: </span><span id="pocitadlo_pocet"><?php //echo $ipAdresa; ?></span></span>
    <span id="pocitadlo_rozdel"><span id="pocitadlo_typ">Počet návštev: </span><span id="pocitadlo_pocet"><?php //echo $pocet_navstevnikov_dokopy; ?></span></span>
    <span id="pocitadlo_rozdel"><span id="pocitadlo_typ">Počet zobrazení: </span><span id="pocitadlo_pocet"><?php //echo $pocet_navstev_dokopy; ?></span></span>

    <span id="pocitadlo_rozdel"><span id="pocitadlo_typ">Online: </span><span id="pocitadlo_pocet"><?php //echo $online_hosti; ?></span></span>

</div>

-->

