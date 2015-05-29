<?php
    /* Fichier appele uniquement par un appel ajax depuis traitement.php
    ** Renvoie les details de l'annotation sur le mot d'ID en parametre
    */

    set_include_path('.');
    require_once('./include/include.php');

    if(isset($_POST['id'])) {
        $connexion = new verbe();
        $infos = $connexion->getVerbe($("#nom").text(data.nom)));
        echo json_encode($infos);
    }
    else {
        return;
    }

?>