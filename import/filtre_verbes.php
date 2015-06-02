<?php

/* Filtre pour les verbes depuis le DEM */

header('Content-Type: text/html; charset=UTF-8');

if (($handle = fopen("source.csv", "r")) !== FALSE) {

	$verbes = array();
	// Verbes qu'on veut garder pour le moment
	$verbes_op1 = array('S3j1', 'C1a1', 'M1a1', 'H1c1', 'U1a2', 'U2a1', 'U2b1', 'M1c1', 'U3a1', 'C1A1', 'F1d1', 'L1a1', 'HIc1', 'c1a1');
	$classes = array("MAM", "MAMf", "REP", "AVI", "MOL", "PIS", "ART", "ENT", "OMB", "ZOO");

	while (($data = fgetcsv($handle, 0, ";")) !== FALSE) {
		if(in_array($data[7], $verbes_op1) && in_array($data[4], $classes) && ($data[8] === 'Vt' || $data[8] === 'Vp' || $data[8] === 'Vi')) {
			$verbes[] = array("verbe" => $data[0], "cont"=>$data[2], "desc" => $data[6], "op1"=>$data[7], "classe"=> $data[4], "sujet"=> $data[5]);
		}
	}

	$fp = fopen('verbes.csv', 'w');
	foreach($verbes as $verbe) {
		$verbe = array_map("utf8_encode", $verbe);
		fputcsv($fp, $verbe);
	}

	fclose($handle);
	echo "Ok!";
}
else {
	echo "Erreur ouverture";
}

?>