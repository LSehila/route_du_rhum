<?php

include 'fonctions.php';

//recuperation de l'id
if (isset($_GET["id"])){
    $cnx = connexion();
    $id = $_GET["id"];
    $sql = "SELECT * FROM p02_skipper WHERE skipper_id=$id";
    $result = pg_query($cnx,$sql);
    $skipper = pg_fetch_assoc($result);
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
            <h2> LES SKIPPERS </h2>
            <ul class="accueil">
                <li><a href='Accueil.html'>Accueil</a></li>
                <li><a href='Skippers.php'>Skippers</a></li>
                <li><a href="Bateaux.php">Bateaux</a></li>
                <li><a href="Resultats.php">Resultats</a></li>
            </ul>

        </div>

    </div>
    <div class="left-col">
        <div class ="image">
        </div>

</nav>

<div style="margin-left:15%;padding:1px 16px;height:100px;">
    <?php
    if(isset($skipper)){

        ?>

        <table>
            <th>Le skipper suivant a été ajouté avec succès:</th>
            <tr>
                <td>Nom:</td>
                <td><?php echo $skipper["skipper_nom"] ?></td>
            </tr>
            <tr>
                <td>Prénom:</td>
                <td><?php echo $skipper["skipper_prenom"] ?></td>
            </tr>
            <tr>
                <td>Âge:</td>
                <td><?php echo $skipper["skipper_age"] ?></td>
            </tr>
            <tr>
                <td>Sexe:</td>
                <td><?php echo $skipper["skipper_sexe"] ?></td>
            </tr>
            <tr>
                <td>Nationalité:</td>
                <td><?php echo $skipper["skipper_nationnalite"] ?></td>
            </tr>
        </table>

        <a href="Skippers.php">Retour à la liste des skippers</a>
        <?php
    }

    ?>


</div>

</body>
</html>



