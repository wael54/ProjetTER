<?php
header('Content-Type: text/html; charset=UTF-8');

if (($handle = fopen("source_mots.csv", "r")) !== FALSE) {
	$mots_animaux = array();
	$current_class;
	
	$classe = array("MAM" => "Mammifère", "MAMf" => "Mammifère", 
	"REP" => "Reptile", "AVI" => "Oiseau", "MOL" => "Mollusque", "PIS" => "Poisson", 
	"ART" => "Insecte", "ENT" => "Insecte", "OMB" => "Insecte");
	
	while (($data = fgetcsv($handle, 0, ";")) !== FALSE) {
		if(array_key_exists($data[4], $classe) && ($data[8] == '-8' || $data[8] == '-9' || $data[8] == '-7') ) {
			$current_class = $classe[$data[4]];
			$mots_animaux[$current_class][] = array("nom" => $data[0], "classe" => $current_class, "famille" => $data[5], "desc" => $data[6], "classe_verbe"=>$data[7]);
		}
	}
	
	$fp = fopen('file.csv', 'w');
	foreach($mots_animaux as $classe) {
		foreach ($classe as $fields) {
		  fputcsv($fp, $fields);
		}
	}

	fclose($handle);
	echo "Ok!";
}
else {
	echo "Erreur ouverture";
}

?>