<!DOCTYPE html>
<html><head>
        <title>Projet TER</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <meta name="description" content="" />
        <meta name="copyright" content="" />
        <link rel="stylesheet" type="text/css" href="css/kickstart.css" media="all" />                  <!-- KICKSTART -->
        <link rel="stylesheet" type="text/css" href="style.css" media="all" />                          <!-- CUSTOM STYLES -->
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
        <script type="text/javascript" src="js/kickstart.js"></script>                                  <!-- KICKSTART -->

     <!--CONNEXION A LA BASE DE DONNEES ANIMAUX-->
        <?php
        session_start();
        require_once('include/include.php'); // Objet PDO
        ?>
        <!------------------------------------------>
        
    </head>
    <body>

        <!-- Menu Horizontal -->
        <ul class="menu">
            <li class="current"><a href="index.php">Accueil</a></li>
            <li><a href="analyse.php"><span class="icon" data-icon="R"></span>Projet</a>
                <ul>
                    <li><a href=""><i class="fa fa-download"></i><span> Docs</span></a>
                        <ul>
                            <li><a href="approche.php"><i class="fa fa-file-text"></i> Description</a></li>
                            <li><a href="annexes.php"><i class="fa fa-file-text"></i> Annexes</a></li>
                        </ul>
                    </li>
                    <li class="divider"><a href="analyse.php"><i class="fa fa-file"></i> Application</a></li>
                </ul>
            </li>
            <li><a href="contact.php">Membres</a></li>
        </ul>

        <div class="grid">

            <!-- ===================================== END HEADER ===================================== -->



            <div class="col_12">
                <h5>Analyse du texte :</h5>

                <div class="col_6">     
                        <h6>Texte analysé :</h6>
                        <?php
                        $text = $_POST['text'];
                        
                        echo "$text <br><br>";

                        $decomposition_text = explode(' ', $text);

//                        $res = $pdo->query("SELECT * FROM animaux WHERE nom='alapaga' ");
//                        $res->execute();
//                        var_dump($res);

//            foreach ($decomposition_text As $elements) {
//                echo $elements . "<BR>";
//                if ($elements == )
//                
//            }
//            $res = $pdo->query("SELECT * FROM ani WHERE name=$elements");
//            while ($resultat = $resultats->fetch(PDO::FETCH_OBJ)) {
//                echo 'Nom de l\'animal : ' . $ress->name . '<br>';
//            }
                        ?>
                </div>

                <div class="col_5">
                    <h4>Résultat</h4>
                    <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore 
                        magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis</p>
                </div>
            </div>
            <div class="col_12">
            </div>




            <!-- ===================================== START FOOTER ===================================== -->
            <div class="clear">
            </div>
            <div id="footer">
                Aix Marseille Université - Faculté des sciences de Luminy<br>
                Master informatique
            </div>

    </body></html>










