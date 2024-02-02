<?php

include 'fonctions.php';

session_start();
$cnx = connexion();

// on récupère l'id déjà enregistré dans la session idets
$id = $_SESSION["idetb"];
$requete1 = "SELECT * FROM p02_bateau WHERE bateau_id = '$id'";
$result1 = pg_query($cnx, $requete1);


if ($result1) {
    while ($ligne = pg_fetch_array($result1)) {
        // récupérer chaque ligne du tableau et les enregistrer dans des sessions
        $_SESSION["bateau_nom"] = $ligne["bateau_nom"];
        $_SESSION["bateau_date"] = $ligne["bateau_date"];
        $_SESSION["bateau_architecte"] = $ligne["bateau_architecte"];
        $_SESSION["bateau-classe"] = $ligne["bateau_classe"];
    }
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
        <h2> SKIPPER  </h2>
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

    <form method="post" action="deletedBateau.php">
        <table>
            <tr><td><H1> Supprimer le bateau suivant :  </H1></td></tr>

            <?php
            echo "<tr><td> Nom du bateau  * :</td></tr><tr><td>". $_SESSION["bateau_nom"] . "  </td></tr>";
            echo "<tr><td> Date de création  * :</td></tr><tr><td>". $_SESSION["bateau_date"] . "  </td></tr>";
            echo "<tr><td> Architecte du bateau  * :</td></tr><tr><td>". $_SESSION["bateau_architecte"] . "  </td></tr>";
            echo "<tr><td> Classe * :</td></tr><tr><td>". $_SESSION["bateau_classe"] . "  </td></tr>";

            ?>

        </table>
        <h2>Voulez-vous vraiment supprimer ce bateau ?</h2>
        <input type="submit" value="Supprimer" name="supprimer">
        <a href="Bateaux.php">Retour à la liste des bateaux</a>

    </form>
    <?php

    $i1=$_SESSION["idetb"];

    if(isset($_POST["supprimer"]) && isset($_SESSION["idetb"])){
        $bat_id = $_SESSION["idetb"];
        if ($bat_id) { // Vérifier si un skipper a été sélectionné
            deleteBateau($bat_id);
            header("location: Bateaux.php");
        }
    }

    ?>
</div>
</body>
</html>