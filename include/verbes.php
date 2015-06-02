<?php

	class verbes
	{
		private $pdo; 	// connexion à la Base de Données
		private $value; // tableau de récupération d'un tuple ou de gestion de données

		public function __construct()
		{
			$this->pdo = new PDO(DATABASE, LOGIN, PASSWORD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8")) or die("Impossible de se connecter"); // cf include/include.php
		} // __construct ()
		  
		public function __destruct()
		{
			return;
		} // __destruct()

		/* Insère un verbe dans la BD + ses liens avec les animaux
		** Paramètres : Array verbe, id_animal (ou id noeud père)
		*/
		public function insert($verbe, $ida)
		{
			try
			{
				$this->pdo->beginTransaction();

				$query=$this->pdo->prepare("INSERT INTO VERBE(VERBE, CONT, DESCRIPTION, OP1) VALUES(?, ?, ? , ?)");
				$query->execute(array($verbe[0], $verbe[1], $verbe[2], $verbe[3]));
				$idv = $this->pdo->lastInsertId(); 

				$query=$this->pdo->prepare("INSERT INTO LIENS_VERBES(ID_ANIMAL, ID_VERBE) VALUES(?, ?)");
				$query->execute(array($ida, $idv));

    			$this->pdo->commit();
    			return TRUE;
			}
			catch(Exception $e) // En cas d'erreur
			{
				//on annule la transation
				$this->pdo->rollback();
				return FALSE;
			}
		}

		public function getId($verbe) {
			$query=$this->pdo->prepare("SELECT ID from VERBE WHERE VERBE = ?");
			$query->execute(array($verbe));
			$result = $query->fetch(PDO::FETCH_ASSOC);
			return ($result == FALSE) ? FALSE : $result['ID'];
		}

		/* "est ce que le lien verbe/animal est valide" 
		** Renvoie vrai ou une suggestion (ou FALSE si aucune suggestion)
		*/
		public function validate($id_verbe, $id_animal) {

			$query=$this->pdo->prepare("SELECT BG, BD from ANIMAL_TREE WHERE ID = ?");
			$query->execute(array($id_animal));
			$bornes = $query->fetch(PDO::FETCH_ASSOC);


			$query=$this->pdo->prepare("SELECT * FROM LIENS_VERBES WHERE ID_VERBE = ?
										AND ID_ANIMAL IN (SELECT ID FROM ANIMAL_TREE WHERE BG < ? AND BD > ?)");
			$query->execute(array($id_verbe, $bornes['BG'], $bornes['BD']));
			$result = $query->fetch(PDO::FETCH_ASSOC);
			
			if($result != FALSE)
			{
				return TRUE;
			}
			else {
				$query=$this->pdo->prepare("SELECT V.ID FROM VERBE V, LIENS_VERBES LV
				WHERE CONT IN (SELECT CONT FROM VERBE WHERE ID = ?)
				AND v.id = lv.id_verbe AND LV.ID_ANIMAL IN (SELECT MAX(ID) FROM ANIMAL_TREE WHERE BG < ? AND BD > ?)");
				$query->execute(array($id_verbe, $bornes['BG'], $bornes['BD']));

				$result = $query->fetch(PDO::FETCH_ASSOC);

				return ($result == FALSE) ? FALSE : $result['ID'];
			}
		}

		/* Renvoie le verbe et la description de l'element d'id donné en paramètre 
		** OPTIONNEL : Renvoie en plus le verbe suggéré
		*/
		public function getInfosOn($id, $suggestion = NULL) {
			$query=$this->pdo->prepare("SELECT VERBE, DESCRIPTION from VERBE WHERE ID = ?");
			$query->execute(array($id));
			$result = $query->fetch(PDO::FETCH_ASSOC);
			if($suggestion != NULL) {
				$query=$this->pdo->prepare("SELECT VERBE from VERBE WHERE ID = ?");
				$query->execute(array($suggestion));
				$suggestion = $query->fetch(PDO::FETCH_ASSOC);
				$retour['suggestion'] = $suggestion['VERBE'];
			}

			$retour['verbe'] = $result['VERBE'];
			$retour['description'] = $result['DESCRIPTION'];
			$retour['validite'] = ($suggestion == NULL) ? "oui" : "non";

			return $retour;
		}
	}
?>