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
        // connexion temporaire pour table animaux.sql /////
        $db_host = "localhost";
        $db_name = "animaux";
        $db_user = "root";
        $db_pass = "";
        $db = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_pass);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // -------------------------------------------- //
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

                    $decomposition_text = explode(' ', $text);

                    foreach ($decomposition_text As $elements) {
                        $query = $db->prepare("SELECT * FROM animaux WHERE nom = '$elements' ");
                        $query->execute();
                        $result = $query->fetch(PDO::FETCH_ASSOC);
                        if ((strcasecmp($elements, $result["nom"])) < 1) {
                            $id = $result["id"];
                            echo " <span style='background-color:lightgreen' id='analyse' data-id='$id'> " . $elements . "</span> ";
                        } 
                        else
                            echo $elements . " ";
                    }
                    ?>
                </div>

                <div class="col_5">
                    <h6>Résultat</h6>
                    <p id="nom" class="nom"></p>
                    <p id="type" class="type"></p>
                    <p id="classe" class="classe"></p>
                    <p id="description" class="description"></p>
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

            <script>
                
                $('#analyse').on("click", function () {
                    var plus = 'aaaaa';
                    $(plus).insertAfter($('#nom'));
                    $(plus).insertAfter($('#type'));
                    $(plus).insertAfter($('#classe'));
                    $(plus).insertAfter($('#description'));
                });
            </script>

    </body>

</html>










