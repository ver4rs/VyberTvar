<div class="horna_lista">
	<h1>Vyber tvár
		<small>
			<a href="/">Domov</a>
			<a href="http://vybertvar.6f.sk/top/">Top 10</a>
			<a href="http://vybertvar.6f.sk/poradie/1/">Zoznam dievčat</a>
		</small>
	</h1>
</div>

<?php
if (isset($_SERVER['PHP_SELF'])) {
	if ($_SERVER['PHP_SELF'] == '/index.php') {
		# LEN TU

		# URL ADRESA
		$host = $_SERVER['HTTP_HOST'];
		$self = $_SERVER['PHP_SELF'];
		$query = !empty($_SERVER['QUERY_STRING']) ? $_SERVER['QUERY_STRING'] : null;
		$url = !empty($query) ? "http://$host$self?$query" : "http://$host$self";

		?>
		<div class="prepojenie">

			<!-- <div id="prepoj">
				<div class="fb-like" data-href="http://vybertvar.6f.sk" img="http://vybertvar.6f.sk/images/vybertvar.jpg" data-send="true" data-layout="button_count" data-width="500" data-show-faces="true"></div>
			</div>  -->

			<div id="prepoj"> <!--  NAJDI NAS NA -->
				<a href="https://facebook.com/Vybertvar" target="t_blank"><img src="images/fbnajdicele.gif" style="width: 150px;" title="Najdi nás na Facebooku" alt="fb"></a>

				<a href="https://facebook.com/sharer.php?u=http://vybertvar.6f.sk" target="t_blank"><img src="images/fbzdielajcele.gif" style="width: 150px;" title="Zdieľaj nás na Facebooku" alt="fb"></a>
			</div>



			<div id="prepoj"> <!--  ZDIELAJ NAS NA -->
				<a href="https://twitter.com/intent/tweet?url=<?php echo urlencode($url); ?>&via= http://vybertvar.6f.sk @ Vyberte tú najkrajšiu tvár. Vyberáte z dvoch, klikom na obrázok" target="t_blank"><img src="images/twzdielajcele.gif" style="width: 150px;" title="Zdieľaj nás cez Twitter" alt="tw"></a>

				<!--  PRIDAJ FOTO -->
				<a href="http://vybertvar.6f.sk/pridaj/"><img src="images/vybertvarAvatar.gif" style="width: 150px;" title="vt" alt="vt"></a>
			</div>

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

		</div>
		<?php
	}
}
?>
