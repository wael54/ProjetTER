<?php
	set_include_path('.');
    require_once('./include/include.php');
    
    if(isset($_POST['id'])) {
        if($_POST['mode'] == "noun") { //  MODE NOM ANIMAL 
        	$connexion = new animal_tree();
        	$infos = $connexion->getInfosOn(mysql_real_escape_string($_POST['id']));
        	$str_parents = "";
        	foreach($infos['parents'] as $p)
        	{
        		$str_parents .= $p." > ";
        	}
        	$infos['parents'] = substr($str_parents, 0, -3);

        	echo json_encode($infos);
        }
        else if($_POST['mode'] == "verb") { // MODE VERBE
            $connexion = new verbes();
            if (isset($_POST['suggest']))
                echo json_encode($connexion->getInfosOn(mysql_real_escape_string($_POST['id']), mysql_real_escape_string($_POST['suggest'])));
            else
                echo json_encode($connexion->getInfosOn(mysql_real_escape_string($_POST['id'])));
        }
    }
    else {
    	return;
    }

?>