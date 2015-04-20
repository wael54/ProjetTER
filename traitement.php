<?php
session_start();
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Projet_TER</title>

        <!-- Bootstrap core CSS -->
        <link href="css/bootstrap.min.css" rel="stylesheet">

    </head>

    <body>

        <div class="container">
            <div class="jumbotron">
                <div class="container">
                    <h1 class="text-center"><a href="index.php">Analyse Sémantique et Langue naturelle</a></h1>
                </div>
            </div>

            <?php
            $text = $_POST['text'];

            echo "Texte analysé :  <input type='text' value='$text' disabled><br><br>";


            $result = explode(' ', $text);
            echo "$result[0] : Pronom <br><br>";
            echo "$result[1] : Animal vertébré de type félin <br><br>";
            echo "$result[2] : Verbe <br><br>";