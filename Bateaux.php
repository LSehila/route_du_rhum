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

<h2 class="head1"> Liste des Bateaux</h2>
<div style="margin-left:20%;padding:1px 16px;height:100px;">

    <form method="get" action="updateBat.php"  >
        <input type="hidden" id="bateau_id" name="bateau_id" value="bateau_id">

        <?php
        $afficheTabBat = getAllBateau();
        echo $afficheTabBat;

        ?>
        <input name="supprimer" type="submit" value="SUPPRIMER" />
    </form>





</div>
</body>
</html>