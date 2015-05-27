<?php

/*
** Script reprenant le fichier généré par csv_filter.php et important toutes les données dans une table de notre BD
** On ne soucie pas de la procédure pour créer la représentation intervallaire, 
** la fonction insert() de include/animal_tree.php s'occupe de faire les transactions adéquates.
*/

ini_set('display_errors', 'On');
error_reporting(E_ALL);
header('Content-Type: text/html; charset=UTF-8');

// Récupération des fichiers de l'application
set_include_path('..');
require (get_include_path().'/include/include.php');

$conn = new animal_tree();
// Insertion de la base de l'arbre animal (division vertébrés/invertébrés)
$conn->insert(1, array("animal", "être vivant,bête"));
$conn->insert(2, array("invertébré", "animal ss vertèbre"));
$conn->insert(4, array("vertébré", "pourvu de vertèbres"));

/* Insertion dans l'arbre des sous-classes directes */
$invertebres = array("insecte"=> "animal invertébré", "mollusque"=>"animal à corps mou");
$vertebres = array("mammifère"=>"av mamelles,vivipare", "oiseau"=>"vertébré ovipare", "poisson" => "vertébré aquatiq", "reptile"=>"tétrapode amniote");

foreach($invertebres as $key=>$value)
{
	$borne_droite = $conn->getBorneDroite(2);
	$conn->insert($borne_droite, array($key, $value));
}

foreach ($vertebres as $key => $value) 
{
	$borne_droite = $conn->getBorneDroite(3);
	$conn->insert($borne_droite, array($key, $value));
}

/* Insertion des familles de mammifères */
$sub_mammifere = array("bovidé" => "tel bovin,ovin,antilope",
				"camélidé" => "tel chameau,lama",
				"canidé" => "tel chien,loup",
				"équidé" => "tel cheval,âne,zèbre",
				"félidé" => "tel chat,tigre,félin",
				"simien" => "colobidé,singe",
				"suidé" => "tel porc,sanglier",
				"ursidé" => "plantigrade tel ours",
				"cétacé" => "tel baleine,cachalot",
				"ongulé" => "q a sabots,cheval,rhino",
				"ovin" => "ovidé,tel mouton,brebis",
				"rhinocérotidé" => "rhinocéros",
				"cervidé" => "cervidé tel cerf",
				"carnassier" => "animal q ali viande",
				"herbivore" => "q ali végétaux",
				"omnivore" => "q mange tt aliment",
				"marsupial" => "métathérien,tel koala",
				"hyénidé" => "tel hyène,protèle", 
				"monotrème" => "an tel ornithorynque");

$id_mam = $conn->getId('mammifère');
foreach ($sub_mammifere as $key => $value) 
{
	$borne_droite = $conn->getBorneDroite($id_mam);
	$conn->insert($borne_droite, array($key, $value));
}

/* Insertion des familles de reptiles */
$sub_reptile = array("amphibien" => "vertébré tétrapode ds eau et air");

$id_rep = $conn->getId('reptile');
foreach ($sub_reptile as $key => $value) 
{
	$borne_droite = $conn->getBorneDroite($id_rep);
	$conn->insert($borne_droite, array($key, $value));
}

/*Insertion des mots du fichier CSV */
if (($handle = fopen("file_2.csv", "r")) !== FALSE) {

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
		$conn->insert($borne_droite, array($mot[0], $mot[3]));
		/* Si problème de limite de temps d'execution */
		set_time_limit(30);
	}
	echo "Insertions réussies.";
}
else {
	echo "Fail.";
}
?>




