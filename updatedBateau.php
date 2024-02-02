<?php

include 'fonctions.php';

if (isset($_GET["id"])){
    $cnx = connexion();
    $id = $_GET["id"];
    $sql = "SELECT * FROM p02_bateau WHERE bateau_id=$id";
    $result = pg_query($cnx,$sql);
    $bateau = pg_fetch_assoc($result);
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

    <table>
        <th> Le bateau suivant a été modifier</th>
        <tr>
            <th>Nom du bateau :</th>
            <th>Date de création :</th>
            <th>Architecte du bateau :</th>
            <th>Classe du bateau :</th>
        </tr>
        <tr>
            <td><?php echo $bateau['bateau_nom']; ?></td>
            <td><?php echo $bateau['bateau_date']; ?></td>
            <td><?php echo $bateau['bateau_architecte']; ?></td>
            <td><?php echo $bateau['bateau_classe']; ?></td>


        </tr>
    </table>
    <br>
    <a href="Bateaux.php" class="btn">Retour</a>
</div>

</body>
</html>