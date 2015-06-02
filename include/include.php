<?php 

// Base de données # Fichier de configuration
define('DATABASE', 'mysql:host=localhost;dbname=animaux'); 
define('LOGIN', 'root'); 
define('PASSWORD', '');

// Fonction pour charger les différentes classes nécessaires à l'application
function __autoload($class)
{
  require_once(get_include_path().'/include/'.$class.'.php');
  return;
} // __autoload($class)


?>