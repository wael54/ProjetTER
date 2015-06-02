<?php

ini_set('display_errors', 'On');
error_reporting(E_ALL);
header('Content-Type: text/html; charset=UTF-8');

// Récupération des fichiers de l'application
set_include_path('..');
require (get_include_path().'/include/include.php');

$conn = new animal_tree();
// Insertion de la base de l'arbre animal (division vertébrés/invertébrés)
$conn->insert(1, array("animal", "être vivant,bête", "M1a1"));
$conn->insert(2, array("invertébré", "animal ss vertèbre", "H1a1"));
$conn->insert(4, array("vertébré", "pourvu de vertèbres", "cn"));

/* Insertion dans l'arbre des sous-classes directes */
$invertebres = array("insecte"	=> array("animal invertébré", "S3j1"), 
					 "mollusque"=> array("animal à corps mou", "M1a1"));
$vertebres = array("mammifère"	=> array("av mamelles,vivipare", "S3j1"), 
					"oiseau"	=> array("vertébré ovipare", "C1a1"), 
					"poisson"	=> array("vertébré aquatiq", "M1a1"), 
					"reptile"	=> array("tétrapode amniote", "M1a1"));

foreach($invertebres as $key=>$value)
{
	$borne_droite = $conn->getBorneDroite(2);
	$conn->insert($borne_droite, array($key, $value[0], $value[1]));
}

foreach ($vertebres as $key => $value) 
{
	$borne_droite = $conn->getBorneDroite(3);
	$conn->insert($borne_droite, array($key, $value[0], $value[1]));
}

/* Insertion des familles de mammifères */
$sub_mammifere = array("bovidé" => array("tel bovin,ovin,antilope", "C1a1"),
				"camélidé" 		=> array("tel chameau,lama","C1a1"),
				"canidé" 		=> array("tel chien,loup","C1a1"),
				"équidé" 		=> array("tel cheval,âne,zèbre", "C1a1"),
				"félidé" 		=> array("tel chat,tigre,félin", "C1a1"),
				"simien" 		=> array("colobidé,singe", "C1a1"),
				"suidé" 		=> array("tel porc,sanglier", "C1a1"),
				"ursidé" 		=> array("plantigrade tel ours", "C1a1"),
				"cétacé" 		=> array("tel baleine,cachalot", "M1a1"),
				"ongulé" 		=> array("q a sabots,cheval,rhino", "M1a1"),
				"ovin" 			=> array("ovidé,tel mouton,brebis", "C1a1"),
				"rhinocérotidé" => array("rhinocéros", "C1a1"),
				"cervidé" 		=> array("cervidé tel cerf", "C1a1"),
				"carnassier" 	=> array("animal q ali viande", "S3j1"),
				"herbivore"		=> array("q ali végétaux", "S3j1"),
				"omnivore" 		=> array("q mange tt aliment", "S3j1"),
				"marsupial" 	=> array("métathérien,tel koala", "H1c1"),
				"hyénidé" 		=> array("tel hyène,protèle", "C1a1"), 
				"monotrème" 	=> array("an tel ornithorynque", "H1c1"));

$id_mam = $conn->getId('mammifère');
foreach ($sub_mammifere as $key => $value) 
{
	$borne_droite = $conn->getBorneDroite($id_mam);
	$conn->insert($borne_droite, array($key, $value[0], $value[1]));
}

/* Insertion des familles de reptiles */
$sub_reptile = array("amphibien" => array("vertébré tétrapode ds eau et air", "M1a1"));

$id_rep = $conn->getId('reptile');
foreach ($sub_reptile as $key => $value) 
{
	$borne_droite = $conn->getBorneDroite($id_rep);
	$conn->insert($borne_droite, array($key, $value[0], $value[1]));
}

/*Insertion des mots du fichier CSV */
if (($handle = fopen("animaux.csv", "r")) !== FALSE) {

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
	/* Si problème de limite de temps d'execution */
	set_time_limit(0);

	while (($mot = fgetcsv($handle, 0, ";")) !== FALSE) {
		$id = NULL;
		switch($mot[1]) {
			case "Insecte":
				$id = $id_categories["insecte"];
			break;
			case "Mammifère":
				if(array_key_exists($mot[2], $id_mammiferes))
					$id = $id_mammiferes[$mot[2]];
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
				if($mot[2] == "amph")
					$id = $id_reptiles["amph"];
				else
					$id = $id_categories["reptile"];
			break;
		}

		$borne_droite =  $conn->getBorneDroite($id);
		$conn->insert($borne_droite, array($mot[0], $mot[3], $mot[4]));
	}
	echo "Insertions réussies.";
}
else {
	echo "Fail.";
}
?>




