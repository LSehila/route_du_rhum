<?php

include 'fonctions.php';

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
    <title>Projet PHP</title>
    <link rel="stylesheet" href="style.css">
</head>
<body style="background:#C1CFC0" >

<nav>

    <div class="wrapper">
        <div class="accueil">
            <h2> SKIPPER </h2>
            <ul class="accueil">
                <li><a href='Accueil.html'>Accueil</a></li>
                <li><a href='Skippers.php'>Skippers</a></li>
                <li><a href="Bateaux.php">Bateaux</a></li>
                <li><a href="Resultats.php">Resultats</a></li>
            </ul>

        </div>

    </div>

</nav>
<div class="left-col">
    <div class ="image">
    </div>

<div style="margin-left:15%;padding:1px 16px;height:100px;">

    <table>
        <th>Le skipper suivant a été modifier</th>
        <tr>
            <th>Nom :</th>
            <th>Prénom :</th>
            <th>Âge :</th>
            <th>Sexe :</th>
            <th>Nationalité :</th>
        </tr>
        <tr>
            <td><?php echo $skipper['skipper_nom']; ?></td>
            <td><?php echo $skipper['skipper_prenom']; ?></td>
            <td><?php echo $skipper['skipper_age']; ?></td>
            <td><?php echo $skipper['skipper_sexe']; ?></td>
            <td><?php echo $skipper['skipper_nationnalite']; ?></td>
        </tr>
    </table>
    <br>
    <a href="Skippers.php" class="btn">Retour à la liste des skippers</a>
</div>

</body>
</html>
