<?php

class verbe {

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

    /*
     * Renvoie le verbe associer à l'animale
     */
    function getVerbe($nom){

        $mot = $this->pdo->prepare("SELECT VERBE, DOMAINE, SENS FROM VERBE");
        $mot->execute(array($id));
        $mot = $mot->fetch(PDO::FETCH_ASSOC);
        if($mot == FALSE)
            return FALSE;
        if($nom != $mot[VERBE])
        {
            return FALSE;
        }
        $retour = array('verbe' => $mot['VERBE'], 'sens' => $mot['SENS']);
        return $retour;
    }

}