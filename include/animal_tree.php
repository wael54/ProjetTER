<?php
	/* Classe pour manipuler la table animal_tree */
	
	class animal_tree
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

		/* Insère un tuple dans l'arbre sous le père en paramètre
		** Paramètres : borne droite du père et tuple (array)
		** tuple[0]= nom, tuple[1] = description
		*/
		public function insert($borne_droite, $tuple)
		{
			try
			{
				$this->pdo->beginTransaction();
				$this->pdo->query("UPDATE ANIMAL_TREE SET BD = BD + 2 WHERE BD >= ".$borne_droite);
				$this->pdo->query("UPDATE ANIMAL_TREE SET BG = BG + 2 WHERE BG >= ".$borne_droite);
				$this->pdo->query("INSERT INTO ANIMAL_TREE (BG, BD, NOM, DESCRIPTION) VALUES (".$borne_droite.", ".($borne_droite+1).", \"".$tuple[0]."\", \"".$tuple[1]."\")");
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

		/* Recupère la borne droite du mot en paramètre dans l'arbre
		** Paramètres : id du mot recherché
		** Retour : Borne droite OU FALSE en cas d'échec
		**/
		public function getBorneDroite($id) 
		{
			$query=$this->pdo->prepare("SELECT BD from ANIMAL_TREE WHERE ID = ?");
			$query->execute(array($id));
			$result = $query->fetch(PDO::FETCH_ASSOC);
			return ($result == FALSE) ? FALSE : $result['BD'];
		}

		/* ATTENTION : Fonction test /!\
		** Renvoie l'id du premier tuple avec le nom donné en paramètre (on part ici du principe qu'il est unique) 
		**/
		public function getId($nom) {
			$query=$this->pdo->prepare("SELECT ID from ANIMAL_TREE WHERE NOM = ?");
			$query->execute(array($nom));
			$result = $query->fetch(PDO::FETCH_ASSOC);
			return ($result == FALSE) ? FALSE : $result['ID'];
		}

		/* Renvoie le nom, la description et les parents de l'element d'id donné en paramètre */
		public function getInfosOn($id) {

			$mot = $this->pdo->prepare("SELECT BG, BD, NOM, DESCRIPTION FROM ANIMAL_TREE WHERE ID= ?");
			$mot->execute(array($id));
			$mot = $mot->fetch(PDO::FETCH_ASSOC);
			if($mot == FALSE) 
				return FALSE;

			$parents = $this->pdo->prepare("SELECT NOM FROM ANIMAL_TREE WHERE BG < ? AND BD > ?");
			$parents->execute(array($mot['BG'], $mot['BD']));
			$parents = $parents->fetchAll(PDO::FETCH_COLUMN, 0);
			
			$retour = array('nom' => $mot['NOM'], 'description' => $mot['DESCRIPTION'], 'parents'=> $parents);
			return $retour;
		}

	}
?>