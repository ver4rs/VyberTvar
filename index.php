<?php

require_once('db.php');
require_once('includes/hlava.php');

session_start();

if (isset($_SESSION['user_id']) && $_SESSION['user_id'] != '') {
    $prihlas = 1;
}

echo '<h2 style="color: #565656; text-align: center; margin-top: -5px; font-weight: bold;">Nevyberáš! Nechávaš to na nich?</h2>';
echo '<h3 style="color: #565656; text-align: center; margin: 0px; font-weight: bold;">Vyber si jednu, klikom daš hlas. Možno práve Ty vyberieš tú pravú</h3>';
echo '<h3 style="color: #565656; text-align: center; margin-bottom: -25px; font-weight: bold;">VS.</h3>';
$aktivacia =1;
$prikaz = mysql_query('SELECT anketa_id, obrazok_id, obrazok_nazov, obrazok_popis, obrazok_ano, obrazok_nie, obrazok_skore, aktivacia FROM anketa
    WHERE aktivacia = "' . mysql_real_escape_string($aktivacia) . '" ORDER BY rand() LIMIT 0,2');


//$prikaz = mysql_query('SELECT anketa_id, obrazok_id, obrazok_nazov, obrazok_popis FROM anketa ORDER BY rand() LIMIT 2');


if (mysql_num_rows($prikaz) != '0') {
    $obrazok_key = array();
    $obrazok_nazov = array();
    $obrazok_popis = array();
    $obrazok_ano = array();
    $obrazok_nie = array();
    $obrazok_skore = array();
?>

<?php
	while ($riadok = mysql_fetch_array($prikaz)) {
        $obrazok_key[] = $riadok['obrazok_id'];
        $obrazok_nazov[] = $riadok['obrazok_nazov'];
        $obrazok_popis[] = $riadok['obrazok_popis'];
        $obrazok_ano[] = $riadok['obrazok_ano'];
        $obrazok_nie[] = $riadok['obrazok_nie'];
        $obrazok_skore[] = $riadok['obrazok_skore'];

/*
        $cesta = imagecreatefromjpeg('fotky/' . $riadok['obrazok_id'] . '.jpg');
        $obrazok_velkostx = imagesx($cesta) * 0.4;
        $obrazok_velkosty = imagesy($cesta) * 0.4;
*/
    }
    //echo $obrazok_key[0] . ' - ' . $obrazok_key[1];
    # Da sa vypocitat aj percentualnu sancu kto ma vacsiu vyhrat
?>
<div id="hodnot">
  <center>
  <table id="tabula_vyber">
    <tr>
        <td><a href="http://vybertvar.6f.sk/overenie/<?php echo $obrazok_key[0] . '/' . $obrazok_key[1]; ?>"><img style="" src="http://vybertvar.6f.sk/fotky/male/<?php  echo $obrazok_key[0]; ?>.jpg" alt="<?php echo $obrazok_nazov[0]; ?>"></a></td>
        <td><a href="http://vybertvar.6f.sk/overenie/<?php echo $obrazok_key[1] . '/' . $obrazok_key[0]; ?>"><img style="" src="http://vybertvar.6f.sk/fotky/male/<?php  echo $obrazok_key[1]; ?>.jpg" alt="<?php echo $obrazok_nazov[1]; ?>"></a></td>
    </tr>
    <tr>
        <td><a href="profil/<?php echo $obrazok_key[0]; ?>"><span id="atext1">Ukázať profil</span></a><?php //echo $obrazok_nazov[0]; ?> &nbsp;  <a href="https://facebook.com/sharer.php?u=http://vybertvar.6f.sk/profil/<?php echo $obrazok_key[0]; ?>/" target="t_blank"><span id="atext2">Zdieľaj ma na FB</span></a></td>

        <td><a href="profil/<?php echo $obrazok_key[1]; ?>"><span id="atext1">Ukázať profil</span></a><?php //echo $obrazok_nazov[1]; ?> &nbsp;  <a href="https://facebook.com/sharer.php?u=http://vybertvar.6f.sk/profil/<?php echo $obrazok_key[1]; ?>/" target="t_blank"><span id="atext2">Zdieľaj ma na FB</span></a></td>
    </tr>
    <tr>
        <td>Skóre: <?php echo $obrazok_skore[0]; ?></td>
        <td>Skóre: <?php echo $obrazok_skore[1]; ?></td>
    </tr>
    <tr>
        <td><?php echo 'Výhra: ' . $obrazok_ano[0] . '    Prehra: ' . $obrazok_nie[0]; ?></td>
        <td><?php echo 'Výhra: ' . $obrazok_ano[1] . '    Prehra: ' . $obrazok_nie[1]; ?></td>
    </tr>
    <?php
    if ($prihlas == '1') {
        ?>
        <tr>
            <td><a href="http://vybertvar.6f.sk/sprava.php?vymaz=<?php echo $obrazok_key[0]; ?>" target="_blank">Vymaz</a></td>
            <td><a href="http://vybertvar.6f.sk/sprava.php?vymaz=<?php echo $obrazok_key[1]; ?>" target="_blank">Vymaz</a></td>
        </tr>
        <?php
    }

    ?>
  </table>
    <span id="Preskoc"><a href="http://vybertvar.6f.sk/">Preskočiť</a></span>

</center>
</div>
<?php
}
else {
    echo 'Prepáčte nám to.';
}
mysql_free_result($prikaz);



/*
$toto = mysql_query('SELECT anketa_id FROM anketa ORDER BY anketa_id DESC');
echo mysql_num_rows($toto);
*/

include_once('includes/spod.php');

?>

