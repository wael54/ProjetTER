<?php
header('Content-Type: text/html; charset=UTF-8');

if (($handle = fopen("source_mots.csv", "r")) !== FALSE) {

	$verbes = array();
	// classes Verbes qu'on veut garder pour le moment
	$array_classes = array('S3j1', 'C1a1', 'M1a1', 'H1c1', 'U1a2', 'U2a1', 'U2b1', 'M1c1', 'U3a1', 'C1A1', 'F1d1', 'L1a1', 'HIc1', 'c1a1');
	while (($data = fgetcsv($handle, 0, ";")) !== FALSE) {
		if(in_array($data[7], $array_classes) && ($data[8] === 'Vt' || $data[8] === 'Vp' || $data[8] === 'Vi')) {
			$verbes[] = array("verbe" => $data[0], "desc" => $data[6], "classe_verbe"=>$data[7]);
		}
	}
	
	$fp = fopen('verbes.csv', 'w');
	foreach($verbes as $verbe) {
		  fputcsv($fp, $verbe);
	}

	fclose($handle);
	echo "Ok!";
}
else {
	echo "Erreur ouverture";
}

?>