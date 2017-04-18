<pre>
<?php
 //require_once 'facebook_sdk/src/facebook.php';
 require_once 'facebook.php';

#####################################

# obrazok titul fb
$obrazok = 'fotky/male/' . $_GET['obraz'] . '.jpg';
$popis = ' Prezerajte profily, top 10, zoznamy dievčat. Pridajte Vašu fotku, zdieľajte, komentujte píšte a zabávajte sa.';

# DAME NAHODNY OBRAZOK
require '../../db.php';
$zverejni =1;
$nahod = mysql_query('SELECT anketa_id, obrazok_id, obrazok_ano, obrazok_nie, obrazok_skore, aktivacia, zverejni FROM anketa WHERE zverejni ="' . mysql_real_escape_string($zverejni) . '" ORDER BY anketa_id DESC LIMIT 0,1');

if (mysql_num_rows($nahod) !='0') {
    # JE JEDEN
    $riadok = mysql_fetch_array($nahod);
    $obrazok = 'http://vybertvar.6f.sk/fotky/male/' . $riadok['obrazok_id'] . '.jpg';
    $popis = 'Na dnes máme túto dievčinu. Je ' . mt_rand('142','192') . 'cm vysoká,... Moje skóre je ' . $riadok['obrazok_skore'] . ', vyhrala som ' . $riadok['obrazok_ano'] . '-krát a nevišlo mi to ' . $riadok['obrazok_nie'] . '-krát. ';
    $url_Adresa = 'http://vybertvar.6f.sk/profil/' . $riadok['obrazok_id'] . '/';

    $zmen = 2;
    $uloz = mysql_query('UPDATE anketa SET zverejni = "' . mysql_real_escape_string($zmen) . '" WHERE anketa_id = "' . mysql_real_escape_string($riadok['anketa_id']) . '" ');
}
else {
    $obrazok = 'http://vybertvar.6f.sk/images/vybertvar.jpg';
    $popis = ' Prezerajte profily, top 10, zoznamy dievčat. Pridajte Vašu fotku, zdieľajte, komentujte píšte a zabávajte sa.';
}
mysql_free_result($nahod);

#####################################

$predmet = array('1' => 'No a nelajkovať, je hriech... :D',
				'2' => 'Táto určite je naša.',
				'3' => 'Krása čo viac dodať ',
				'4' => 'Lajkujte, vyhlasíme súťaž',
				'5' => 'Koľko like-ov dostane ? ',
				'6' => 'Zdieľajte prosím...' );







// configuration
 $appid = '487245217996233';
 $appsecret = '2687990abe39667415e96550381ab486';
 $pageId = 'Vybertvar';  // stranka nazov
 $msg =  $predmet[mt_rand('1','6')]; //'Krása čo viac dodať...'; //'Pozri si toto fotky.'; // popis k clanku nieco fb
 $title = 'vybertvar.6f.sk';  // titul hore
 $uri = $url_Adresa; //'http://vybertvar.6f.sk/fb/src/';
 $desc = $popis; //'Pozri si toto'; // perex v clanku v obrazku co sa zobrazy na pravo
 $pic = $obrazok; //'http://vybertvar.6f.sk/images/vybertvar.jpg';  //image
 $action_name = 'Vyber tvár'; //'ver4rs';
 $action_link = $url_Adresa; //'http://www.vybertvar.6f.sk'; // titul dole

$facebook = new Facebook(array(
 'appId' => $appid,
 'secret' => $appsecret,
 'cookie' => false,
 ));

$user = $facebook->getUser();

// Contact Facebook and get token
 if ($user) {
 // you're logged in, and we'll get user acces token for posting on the wall
 try {
 $page_info = $facebook->api("/$pageId?fields=access_token");
 if (!empty($page_info['access_token'])) {
 $attachment = array(
 'access_token' => $page_info['access_token'],
 'message' => $msg,
 'name' => $title,
 'link' => $uri,
 'description' => $desc,
 'picture'=>$pic,
 'actions' => json_encode(array('name' => $action_name,'link' => $action_link))
 );

$status = $facebook->api("/$pageId/feed", "post", $attachment);
 } else {
 $status = 'No access token recieved';
 }
 } catch (FacebookApiException $e) {
 error_log($e);
 $user = null;
 }
 } else {
 // you're not logged in, the application will try to log in to get a access token
 header("Location:{$facebook->getLoginUrl(array('scope' => 'photo_upload,user_status,publish_stream,user_photos,manage_pages'))}");
 }

echo $status;
 ?>
