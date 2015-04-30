<?PHP
try
      {
       $bdd = new PDO('mysql:host=localhost;dbname=animaux', 'root', '');
       $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      }
    catch(Exception $e)
     {
      die('Erreur : impossible de se connecter '.$e->getMessage());
     }
?>