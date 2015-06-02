<?php
set_include_path('.');
require_once('./include/include.php');
$connexion = new animal_tree();

if (!isset($_POST['text'])) {
    header('Location:analyse.php');
}

$text = htmlspecialchars($_POST['text']);

$retour = "";
$last_id_found = NULL;
$decomposition_text = preg_split('/((\p{P}*\s+\p{P}*)|(^\p{P}+)|(\p{P}+$))/', strtolower($text), -1, PREG_SPLIT_NO_EMPTY);

foreach ($decomposition_text as $mot) {
    if (($result = $connexion->getId($mot)) !== FALSE) { // Le mot est présent dans animal_tree
        $retour .= "<span class=\"highlighted\" data-id=\"" . $result . "\">" . htmlspecialchars($mot, ENT_NOQUOTES, 'utf-8') . "</span> ";
        $last_id_found = $result;
    }
    else { // On reporte le mot sans le souligner
        $retour .= htmlspecialchars($mot, ENT_NOQUOTES, 'utf-8') . " ";
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Projet TER</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <meta name="description" content="" />
        <meta name="copyright" content="" />
        <link rel="stylesheet" type="text/css" href="css/kickstart.css" media="all" />                  <!-- KICKSTART -->
        <link rel="stylesheet" type="text/css" href="css/style.css" media="all" />                          <!-- CUSTOM STYLES -->
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
        <script type="text/javascript" src="js/kickstart.js"></script>                                  <!-- KICKSTART -->
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

            <div class="col_12">
                <h5 class="strong">Analyse du texte :</h5>
                <p style='font-style:italic'>Cliquez sur un mot pour obtenir une annotation détaillée.<br>
                    Les mots surlignés en <span class="highlighted">vert</span> concerne le domaine animal.</p>
                    
               <hr class="alt2" /> 
               <div class="col_8">                   
               <div class="center">
                  <ul class="button-bar">
                    <li><a href="analyse.php"><i class="fa fa-pencil"></i> Modifier</a></li>
                    <li><a href="analyse.php"><i class="fa fa-file-text"></i> Nouveau traitement</a></li>
                   </ul>
               </div>
				</div>

                <div class="col_6 barredroite">     
                  <h6 class="strong">Texte analysé :</h6>
                    <?= $retour ?>
                </div>

                <div class="col_5" id="container_result">
                    <h6 class="strong">Résultat :</h6>
                        <div id="nodetails">
                            <i class="fa fa-hand-o-up"></i> Cliquez sur un élément pour afficher plus de détails
                        </div>
                        <div id="loading_icon" style="display: none">
                            <img src="img/ajax-loader.gif" alt="Chargement."/>
                        </div>
                        <div id="details" style="display: none">
                            <h5 id="nom"></h5>
                            <p>Type : <span id="type"></span></p>
                            <p>Description : <span id="description"></span></p>
                        </div>

                </div>
            </div>

            <div class="col_12">
            </div>

            <div class="clear">
            </div>
            <div id="footer">
                Aix Marseille Université - Faculté des sciences de Luminy<br>
                Master informatique
            </div>

            <script type="text/javascript">
                $(document).ready(function () {

                    $('.barredroite > .highlighted ').click(function () {

                        if ($("#nodetails").is(":visible")) {
                            $("#nodetails").css("display", "none");
                        }

                        $.ajax({
                            url: "getWord.php",
                            data: {
                                id: $(this).data("id")
                            },
                            type: 'POST',
                            dataType: 'json',
                            beforeSend: function (xhr) {
                                $("#details").hide();
                                $("#loading_icon").show();
                            },
                            success: function (data) {
                                $("#loading_icon").hide();
                                if (data) {
                                    $("#nom").text(data.nom);
                                    $("#description").text(data.description);
                                    $("#type").text(data.parents);
                                }
                                $("#details").show();
                            },
                            complete: function (xhr, textStatus) {

                            }
                        });

                    });
                });
            </script>

    </body>

</html>










