<?php

include 'fonctions.php';

session_start();
$cnx = connexion();

/*quand lutilisateur appuie sur modifier, on recupere le nom du bateau puis on ouvre une session pour le recuperer */
if (isset($_GET["modifier"])) {
    if (isset($_GET["id"]) && !empty($_GET["id"])) {
        $_SESSION["idetb"]  = $_GET["id"];
        header("location:updateBat.php");
        exit();
    } else {
        header("location: erreur.php?code=2");
    }
}

//on recupere lid deja enregistré dans la session idetb
$id2 = $_SESSION["idetb"];
$requete2 = "SELECT * FROM p02_Bateau WHERE bateau_id = '$id2'";
$result2 = pg_query($cnx, $requete2);

if($result2){
    while($ligne2 = pg_fetch_array($result2)){
        // recuperer chaque ligne du tableau et les enregistrer dans des sessions
        $_SESSION["bateau_nom"] = $ligne2["bateau_nom"];
        $_SESSION["bateau_date"] = $ligne2["bateau_date"];
        $_SESSION["bateau_architecte"] = $ligne2["bateau_architecte"];
        $_SESSION["bateau_classe"] = $ligne2["bateau_classe"];
    }
}


/* quand l'utilisateur appuie sur modifier, on récupère l'id du skipper puis on ouvre une session pour le récupérer */
if (isset($_GET["supprimer"])) {
    if (isset($_GET["id"]) && !empty($_GET["id"])) {
        $_SESSION["idetb"]  = $_GET["id"];
        header("location:deletedBateau.php");
        exit();
    } else {
        header("location: erreur.php?code=2");
    }
}



/* si l'utilisateur appuie sur "AJOUTER" on le redirige vers la page addBateau */
if(isset($_GET["AJOUTER"])){
    header("location:addBateau.php");
}
?>

<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Projet PHP</title>
    <link rel="stylesheet" href="style.css">

</head>
<body style="background:#C1CFC0" >

<div class="wrapper">
    <div class="accueil">
        <h2>BATEAUX</h2>
        <ul class="menu">
            <li><a href='Accueil.html'>Accueil</a></li>
            <li><a href='Skippers.php'>Skippers</a></li>
            <li><a href="Bateaux.php">Bateaux</a></li>
            <li><a  href="Resultats.php">Resultats</a></li>
        </ul>
    </div>
    <div class ="image">
    </div>
</div>


<div style="margin-left:15%;padding:1px 16px;height:100px;">

    <form method="post" action="updateBat.php"  >
        <table>
            <tr><td><H1> Modifier les Bateaux </H1></td></tr>

            <?php
            echo "<tr><td> Nom du bateau * :</td></tr><tr><td><input type='text' required='required' name='bateau_nom' value='".$_SESSION["bateau_nom"]."'></td></tr>";
            echo"	<tr><td> Date du bateau * :</td></tr><tr><td><input type=number required='required' name=bateau_date value=".$_SESSION["bateau_date"]."  ></td></tr>";
            echo"	<tr><td> Architecte * :</td></tr><tr><td><input type='text' required='required' name='bateau_architecte' value='". $_SESSION["bateau_architecte"]."' ></td></tr>";
            // Liste des classes de bateaux disponibles
            $classes = array("Ultim 32/23", "Ocean Fifty", "IMOCA", "Class40", "Rhum Mono", "Rhum Multi");

            echo "<tr><td> Classe *:</td></tr>";
            foreach ($classes as $classe) {
                $checked = "";
                if ($_SESSION["bateau_classe"] == $classe) {
                    $checked = "checked";
                }
                echo "<tr><td><input type='radio' name='bateau_classe' value='$classe' $checked> $classe</td></tr>";
            }
            ?>


        </table>

        <input type="submit" value="MODIFIER" name="MODIFIER">
    </form>


    <?php

    $i2=$_SESSION["idetb"];

    if(isset($_POST["MODIFIER"]) && isset($_SESSION["idetb"])) {
        $bat_id = $_SESSION["idetb"];
        if ($bat_id) { // Vérifier si un skipper a été sélectionné
            updateBateau($i2, $_POST["bateau_nom"], $_POST["bateau_date"], $_POST["bateau_architecte"], $_POST["bateau_classe"]);
            header("Location: updatedBateau.php?id=$i2");
        }
    }

    ?>

</div>
</body>
</html>