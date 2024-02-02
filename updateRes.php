<?php

include 'fonctions.php';

session_start();
$cnx = connexion();
/* quand l'utilisateur appuie sur modifier, on récupère l'id du skipper puis on ouvre une session pour le récupérer */
if (isset($_GET["modifier"])) {
    if (isset($_GET["id"]) && !empty($_GET["id"])) {
        $_SESSION["idetr"]  = $_GET["id"];
        header("location:updateRes.php");
        exit();
    } else {
        header("location: erreur.php?code=3");
    }
}


// on récupère l'id déjà enregistré dans la session idets
$id3 = $_SESSION["idetr"];
$requete3 = "SELECT s.skipper_id, s.skipper_nom, b.bateau_id, b.bateau_nom, r.resultat_pos, r.resultat_jours, r.resultat_temps FROM P02_resultat r
INNER JOIN P02_skipper s ON r.skipper_id = s.skipper_id
INNER JOIN P02_bateau b ON r.bateau_id = b.bateau_id
WHERE r.skipper_id = $id3";


$result3 = pg_query($cnx, $requete3);

if ($result3) {
    while ($ligne3 = pg_fetch_array($result3)) {
// récupérer chaque ligne du tableau et les enregistrer dans des sessions
        $_SESSION["skipper_id"] = $ligne3["skipper_id"];
        $_SESSION["bateau_id"] = $ligne3["bateau_id"];
        $_SESSION["skipper_nom"] = $ligne3["skipper_nom"];
        $_SESSION["bateau_nom"] = $ligne3["bateau_nom"];
        $_SESSION["resultat_pos"] = $ligne3["resultat_pos"];
        $_SESSION["resultat_jours"] = $ligne3["resultat_jours"];
        $_SESSION["resultat_temps"] = $ligne3["resultat_temps"];
    }
}



/* si l'utilisateur appuie sur "supprimer " alors on supprime toutes les informations*/
if (isset($_GET["supprimer"])) {
    if (isset($_GET["id"]) && !empty($_GET["id"])) {
        $res_id3 = $_GET["id"];
        deleteResultat($res_id3);
        header("location: Resutats.php");
        exit();
    } else {
        header("location: erreur.php?code=3");

    }
}


/* si l'utilisateur appuie sur "AJOUTER" on le redirige vers la page addSkipper */
if (isset($_GET["AJOUTER"])) {
    header("location:addRes.php");
    exit();
}
?>

<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="style.css">

</head>
<body style="background:#C1CFC0" >

<div class="wrapper">
    <div class="accueil">
        <h2> RESULTATS </h2>
        <ul class="accueil">
            <li><a href='Accueil.html'>Accueil</a></li>
            <li><a href='Skippers.php'>Skippers</a></li>
            <li><a href="Bateaux.php">Bateaux</a></li>
            <li><a  href="Resultats.php">Resultats</a></li>
        </ul>

    </div>

</div>
<div class="left-col">
    <div class ="image">
    </div>
<div style="margin-left:15%;padding:1px 16px;height:100px;">

    <form method="post" action="updateRes.php">
        <table>
            <tr><td><H1> Modifier un résultat </H1></td></tr>
            <?php
            echo "<tr><td> skipper ID :</td></tr><tr><td>" . $_SESSION["skipper_id"] . "</td></tr>";
            echo "<tr><td> Bateau ID * :</td></tr><tr><td>" . $_SESSION["bateau_id"] . "</td></tr>";
            echo "<tr><td> Nom du skipper * :</td></tr><tr><td>" . $_SESSION["skipper_nom"] . "</td></tr>";
            echo "<tr><td> Nom du bateau * :</td></tr><tr><td>" . $_SESSION["bateau_nom"] . "</td></tr>";
            echo "<tr><td> Position * :</td></tr><tr><td><input type=number required='required' name=resultat_pos value=" . $_SESSION["resultat_pos"] . " ></td></tr>";
            echo "<tr><td> Nombres de jours * :</td></tr><tr><td><input type=number required='required' name=resultat_jours value=" . $_SESSION["resultat_jours"] . " ></td></tr>";
            echo "<tr><td> Temps * :</td></tr><tr><td><input type='time' required='required' name='resultat_temps' value='" . $_SESSION["resultat_temps"] . "'></td></tr>";
            ?>

        </table>
        <input type="submit" value="MODIFIER" name="MODIFIER">

    </form>
    <?php
// recuperation de la session
    $i3=$_SESSION["idetr"];
// quand l'utilisateur appuie sur modifier
    if(isset($_POST["MODIFIER"]) && isset($_SESSION["idetr"])){
        $res_id = $_SESSION["idetr"];
        if ($res_id) { // Vérifier si un skipper a été sélectionné
            updateRes($i3, $_POST["resultat_pos"],$_POST["resultat_jours"],$_POST["resultat_temps"]);
        }
    }

    ?>
</div>

</body>
</html>