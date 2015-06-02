<?php

/* Si problème de limite de temps d'execution */
set_time_limit(0);
/* Debug */
ini_set('display_errors', 'On');
error_reporting(E_ALL);
/* Encodage UTF-8 */
header('Content-Type: text/html; charset=UTF-8');

// Récupération des fichiers de l'application
set_include_path('..');
require (get_include_path().'/include/include.php');

/* Connexions BD */
$conn = new animal_tree();
$conn_verbes = new verbes();

/*Insertion des mots du fichier CSV */
if (($handle = fopen("verbes.csv", "r")) !== FALSE) {

	$classe = array("MAM" => "Mammifère", "MAMf" => "Mammifère", 
	"REP" => "Reptile", "AVI" => "Oiseau", "MOL" => "Mollusque", "PIS" => "Poisson", 
	"ART" => "Insecte", "ENT" => "Insecte", "OMB" => "Insecte");

	$id_categories = array();
	$id_categories["insecte"] = $conn->getId("insecte");
	$id_categories["mammifère"] = $conn->getId("mammifère");
	$id_categories["mollusque"] = $conn->getId("mollusque");
	$id_categories["oiseau"] = $conn->getId("oiseau");
	$id_categories["poisson"] = $conn->getId("poisson");
	$id_categories["reptile"] = $conn->getId("reptile");

	$id_mammiferes = array("bovi" => $conn->getId("bovidé"),
					"camé" => $conn->getId("camélidé"),
					"cani" => $conn->getId("canidé"),
					"équi" => $conn->getId("équidé"),
					"féli" => $conn->getId("félidé"),
					"simi" => $conn->getId("simien"),
					"suid" => $conn->getId("suidé"),
					"ursi" => $conn->getId("ursidé"),
					"céta" => $conn->getId("cétacé"),
					"ongu" => $conn->getId("ongulé"),
					"ovin" => $conn->getId("ovin"),
					"rhin" => $conn->getId("rhinocérotidé"),
					"cerv" => $conn->getId("cervidé"),
					"carn" => $conn->getId("carnassier"),
					"herb" => $conn->getId("herbivore"),
					"végé" => $conn->getId("herbivore"),
					"omni" => $conn->getId("omnivore"),
					"mars" => $conn->getId("marsupial"),
					"hyén" => $conn->getId("hyénidé"),
					"mono" => $conn->getId("monotrème"));

	$id_reptiles = array("amph" => $conn->getId("amphibien"));

	while (($mot = fgetcsv($handle, 0, ",")) !== FALSE) {
		$id = 1; // Par défaut
		if (isset($classe[$mot[4]])) {
			switch($classe[ $mot[4] ]) {
				case "Insecte":
					$id = $id_categories["insecte"];
				break;
				case "Mammifère":
					if(array_key_exists($mot[5], $id_mammiferes))
						$id = $id_mammiferes[$mot[5]];
					else
						$id = $id_categories["mammifère"];
				break;
			    case "Mollusque":
					$id = $id_categories["mollusque"];
				break;
				case "Oiseau":
					$id = $id_categories["oiseau"];
				break;
				case "Poisson":
					$id = $id_categories["poisson"];
				break;
				case "Reptile":
					if($mot[5] == "amph")
						$id = $id_reptiles["amph"];
					else
						$id = $id_categories["reptile"];
				break;
			}
		}

		$conn_verbes->insert(array($mot[0], $mot[1], $mot[2], $mot[3]), $id);
	}
	echo "Insertions réussies.";
}
else {
	echo "Fail.";
}
?>




