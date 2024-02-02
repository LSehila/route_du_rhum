<?php

include 'fonctions.php';

session_start();
$cnx = connexion();


// on récupère l'id déjà enregistré dans la session idets
$id = $_SESSION["idets"];
$requete1 = "SELECT * FROM p02_skipper WHERE skipper_id = '$id'";
$result1 = pg_query($cnx, $requete1);


if ($result1) {
    while ($ligne = pg_fetch_array($result1)) {
        // récupérer chaque ligne du tableau et les enregistrer dans des sessions
        $_SESSION["skipper_nom"] = $ligne["skipper_nom"];
        $_SESSION["skipper_prenom"] = $ligne["skipper_prenom"];
        $_SESSION["skipper_age"] = $ligne["skipper_age"];
        $_SESSION["skipper_sexe"] = $ligne["skipper_sexe"];
        $_SESSION["skipper_nationnalite"] = $ligne["skipper_nationnalite"];
    }
}

?>

<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="style.css">

</head>
<body style="background:#C1CFC0" >

<nav>

    <div class="wrapper">
        <div class="accueil">
            <h2> SKIPPERS </h2>
            <ul class="accueil">
                <li><a href='Accueil.html'>Accueil</a></li>
                <li><a href='Skippers.php'>Skippers</a></li>
                <li><a href="Bateaux.php">Bateaux</a></li>
                <li><a  href="Resultats.php">Resultats</a></li>
            </ul>

        </div>

    </div>

</nav>
<div class="left-col">
    <div class ="image">
    </div>
<div style="margin-left:15%;padding:1px 16px;height:100px;">

    <form method="post" action="deletedSkipper.php">

        <tr><td><H1> Supprimer le skipper </H1></td></tr>

        <table>
            <tr>
                <td>Nom:</td>
                <td><?php echo $_SESSION["skipper_nom"] ?></td>
            </tr>
            <tr>
                <td>Prénom:</td>
                <td><?php echo $_SESSION["skipper_prenom"] ?></td>
            </tr>
            <tr>
                <td>Âge:</td>
                <td><?php echo $_SESSION["skipper_age"] ?></td>
            </tr>
            <tr>
                <td>Sexe:</td>
                <td><?php echo $_SESSION["skipper_sexe"] ?></td>
            </tr>
            <tr>
                <td>Nationalité:</td>
                <td><?php echo $_SESSION["skipper_nationnalite"] ?></td>
            </tr>
        </table>
        <h2>Voulez-vous vraiment supprimer ce skipper ?</h2>
        <input type="submit" value="Supprimer" name="supprimer">
        <a href="Skippers.php">Retour à la liste des skippers</a>

    </form>
    <?php

    $i1=$_SESSION["idets"];

    if(isset($_POST["supprimer"]) && isset($_SESSION["idets"])){
        $skip_id = $_SESSION["idets"];
        if ($skip_id) { // Vérifier si un skipper a été sélectionné
            deleteSkipper($skip_id);
            header("location: Skippers.php");
        }
    }

    ?>
</div>
</body>
</html>