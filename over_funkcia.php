<?php

if (!isset($_GET['img1']) && !isset($_GET['img2'])) {
	echo 'Neautorizovany pristup';
	exit();
}

######################################################################
#    ulozime hodnoty

#   $win_obrazok
#   $lost_obrazok


/*
	zakladne skore pri registracii    800
	skore nad 1701  faktor K = 10
	skore od 1401 do 1700 faktor K =  16
	skore  od  1101 do  1400  faktor K = 24
	skore od 800 do 1100 faktor K= 32
	skore pod 799 faktor K = 38

	30,15,10      25,15,10

	$win_obrazok['obrazok_skore']
	$lost_obrazok['obrazok_skore']
*/
#vitaz
$faktorA = $win_obrazok['obrazok_skore'];

if ($faktorA < '800') {
	$Ka = '38';
}
elseif ($faktorA >= '800' && $faktorA < '1100') {
	$Ka = '32';
}
elseif ($faktorA >= '1100' && $faktorA < '1400') {
	$Ka = '24';
}
elseif ($faktorA >= '1400' && $faktorA < '1700') {
	$Ka = '16';
}
elseif ($faktorA >= '1700') {
	$Ka = '10';
}

#prehral
$faktorB = $lost_obrazok['obrazok_skore'];

if ($faktorB < '800') {
	$Kb = '38';
}
elseif ($faktorB >= '800' && $faktorB < '1100') {
	$Kb = '32';
}
elseif ($faktorB >= '1100' && $faktorB < '1400') {
	$Kb = '24';
}
elseif ($faktorB >= '1400' && $faktorB < '1700') {
	$Kb = '16';
}
elseif ($faktorB >= '1700') {
	$Kb = '10';
}


# $Ea = skore vitaz
# $Eb = skore porazeny
# $Ra  a $Rb  skore jednotlivych obrazkov

/*
				(Rb - Ra)/400
 $Ea = 1/(1+ 10odmocnina       )
*/

#vitaz
$Ea = 1/(1 + pow(10, ($faktorB - $faktorA)/400));
$Ea = $faktorA + $Ka * (1 - $Ea);

#prehral
$Eb = 1/(1 + pow(10, ($faktorA - $faktorB)/400));
$Eb = $faktorB + $Kb * (0 - $Eb);


//$Ea = $Ra + $K * (1 - (1/(1 + pow(10, ($Rb - $Ra)/400))))

?>


