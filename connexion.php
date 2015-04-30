<?php
try
      {
       $pdo = new PDO('mysql:host=localhost;dbname=animaux', 'root', '');
       $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
       echo 'OK';
      }
    catch(Exception $e)
     {
      die('Erreur : impossible de se connecter '.$e->getMessage());
     }
