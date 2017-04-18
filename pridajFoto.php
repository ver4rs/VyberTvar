<?php

$data = '';
$data = 'includes/hlava.php';
require $data;
$data = '';
require 'db.php';




?>
<div class="pridaj_form">
	<span id="pridajText">Pridajte fotku na náš portál</span>

	<form id="imageform" method="post" enctype="multipart/form-data" action='../novyObrazok.php'>
		<span id="formText">Ulož fotku</span> <input type="file" name="obrazokUloz" id="obrazokUloz" />
	</form>
	<div id='preview'>
	</div>


</div>
<?php




# SPOD + POCITADLO + REKLAMA + TEXT
include_once('includes/spod.php');

?>
