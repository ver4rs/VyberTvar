<?php

#STATISTIKA    statistika_cas automaticky dava
$statistikaUloz = mysql_query('INSERT INTO statistika (statistika_id, statistika_ip)
                                VALUES (NULL,
                                        "' . $_SERVER['REMOTE_ADDR'] . '") ');


include_once('pocitadlo.php');
//include_once('admin/reklama.php');
?>




<div id="lista">
	&nbsp;
</div>


<div class="dolna_lista">
	<h5>Copyright © 2012 - <?php echo htmlspecialchars(date('Y')); ?> <a href="/">Vyber tvár</a>  - Všetky práva vyhradené. &nbsp; Kontakt: ver4rs@gmail.com <a href="http://vybertvar.6f.sk/pravidla/">Podmienky používania</a>
		<br>
		Tento projekt a autor nenesie žiadnu zodpovednosť, za prípadne vzniknuté škody. Poďakovanie <a href="http://en.wikipedia.org/wiki/Elo_rating_system">ELO rating</a>.  <a href="http://vybertvar.6f.sk/statistika">Štatistika</a>, Online:<?php echo htmlspecialchars($online_hosti); ?>, <a href="http://vybertvar.6f.sk/prihlas">admin</a>


	</h5>
</div>



</body>
</html>
