<?php
try
      {
       $pdo = new PDO('mysql:host=localhost;dbname=test', 'root', '');
       $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      }
    catch(Exception $e)
     {
      die('Erreur : impossible de se connecter '.$e->getMessage());
     }
?>