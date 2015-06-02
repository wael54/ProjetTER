<?php
	set_include_path('.');
    require_once('./include/include.php');
    
    if(isset($_POST['id'])) {
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
    else {
    	return;
    }

?>