<?php

# obrazok titul fb
if ($_SERVER['PHP_SELF'] == '/profil.php') {
    $obrazok = 'fotky/male/' . $_GET['obraz'] . '.jpg';
    $popis = ' Prezerajte profily, top 10, zoznamy dievčat. Pridajte Vašu fotku, zdieľajte, komentujte píšte a zabávajte sa.';
}
else {
    # DAME NAHODNY OBRAZOK
    require 'db.php';
    $aktivacia =1;
    $nahod = mysql_query('SELECT anketa_id, obrazok_id, obrazok_ano, obrazok_nie, obrazok_skore, aktivacia FROM anketa WHERE aktivacia ="' . mysql_real_escape_string($aktivacia) . '" ORDER BY rand() LIMIT 0,1');
    if (mysql_num_rows($nahod) !='0') {
        # JE JEDEN
        $riadok = mysql_fetch_array($nahod);
        $obrazok = 'fotky/male/' . $riadok['obrazok_id'] . '.jpg';
        $popis = 'Prezerajte profily, top 10, zoznamy dievčat. Pridajte Vašu fotku, zdieľajte, komentujte píšte a zabávajte sa. Snažíme sa o to aby ste na nás nezabudli. . Moje skóre je ' . $riadok['obrazok_skore'] . ', počet vyhratí: ' . $riadok['obrazok_ano'] . '-krát a počet prehratí: ' . $riadok['obrazok_nie'] . '-krát. ';
    }
    else {
        $obrazok = 'images/vybertvar.jpg';
        $popis = ' Prezerajte profily, top 10, zoznamy dievčat. Pridajte Vašu fotku, zdieľajte, komentujte píšte a zabávajte sa.';
    }
    mysql_free_result($nahod);
}

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
  <head prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb#
                  profile: http://ogp.me/ns/profile#">

      <title>Najkrajšie slovenské dievčatá - Vyberte tú najkrajšiu tvár</title>
      <meta name="keywords" content="vyberte, tvár, tvar, pekna, najkrasia, postava, top, poradie, stav, postava, komentar">
      <meta name="description" content="Vyberte tú najkrajšiu tvár - <?php echo htmlspecialchars($popis); ?>">
      <META NAME="robots" CONTENT="index,follow, all">
      <!-- <link rel="shortcut icon" href="images/favicon.ico">  -->
      <link rel="shortcut icon" href="http://vybertvar.6f.sk/<?php echo htmlspecialchars($obrazok); ?>">
      <link rel="icon" type="image/jpg" href="http://www.vybertvar.6f.sk/<?php echo htmlspecialchars($obrazok); ?>">
      <link rel="stylesheet" type="text/css" href="http://vybertvar.6f.sk/style.css">
      <meta http-equiv="content-type" content="text/html" charset="UTF-8">



     <meta property="og:image" content="http://www.vybertvar.6f.sk/<?php echo htmlspecialchars($obrazok); ?>">



<meta property="fb:admins" content="100000098615652"/>
<meta property="fb:app_id" content="487245217996233"/>

<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/sk_SK/all.js#xfbml=1&appId=487245217996233";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<script type="text/javascript" src="http://vybertvar.6f.sk/js/jquery.min.js"></script>
<script type="text/javascript" src="http://vybertvar.6f.sk/js/jquery.form.js"></script>

<script type="text/javascript" >
 $(document).ready(function() {

            $('#obrazokUloz').live('change', function()     {
                 $("#preview").html('');
          $("#preview").html('<img src="http://vybertvar.6f.sk/images/loader.gif" alt="Ukladám...."/>');
      $("#imageform").ajaxForm({
            target: '#preview'
    }).submit();

      });
        });



</script>


<script type="text/javascript">
/*
$(document).ready(function () {
    var interval = 2000;   //number of mili seconds between each call
    var refresh = function() {
        $.ajax({
            url: "pocitaj/",
            cache: false,
            success: function(html) {
                $('.pocitadlo1').html(html);
                setTimeout(function() {
                    refresh();
                }, interval);
            }
        });
    };
    refresh();
});*/
</script>

<!--
<meta property="og:title" content="Vyber t&#xfa; najkraj&#x161;iu tv&#xe1;r" />
<meta property="og:type" content="" />
<meta property="og:url" content="http://vybertvar.6f.sk" />
<meta property="og:image" content="http://www.vybertvar.6f.sk/images/vybertvar.jpg" />
<meta property="og:site_name" content="http://facebook.com/Vybertvar" />
<meta property="fb:admins" content="100000098615652" />
-->

<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-37679136-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>

  </head>
  <body>




<!-- FB like -->

<?php

#STATISTIKA JE V SPOD

include_once('horna_lista.php');

?>
