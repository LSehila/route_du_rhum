<?php

include 'fonctions.php';
session_start();
?>


<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="style.css">

</head>
<body>
<div class="wrapper">
    <div class="accueil">
        <h2> RESULTATS </h2>
        <ul class="menu">
            <li><a href='Accueil.html'>Accueil</a></li>
            <li><a href='Skippers.php'>Skippers</a></li>
            <li><a href="Bateaux.php">Bateaux</a></li>
            <li><a  href="Resultats.php">Resultats</a></li>
        </ul>

    </div>

</div>
<div class ="image">
</div>

<h2 class="head1">Liste des Resultats</h2>

<div style="margin-left:17%;padding:10px 16px;height:100px;">
    <form method="get" action="updateRes.php" >
        <input type="hidden" id="skipper_id" name="bateau_nom" value="bateau_nom">

        <?php
        $afficheTabResultat = getAllResultat();
        echo $afficheTabResultat;
        ?>
        <input name="supprimer" type="submit" value="SUPPRIMER" />
    </form>
</div>
</body>
</html>
