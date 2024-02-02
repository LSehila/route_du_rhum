<?php

include 'fonctions.php';

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

    </div>
    <div class="left-col">
        <div class ="image">
        </div>

    <div style="margin-left:15%;padding:1px 16px;height:100px;">

        <form method="get"  action="addBateau.php">
            <table>
                <tr><td> <H1> Ajouter un Bateau </H1></td></tr>
                <tr><td> Nom du bateau *:</td><td><input type=text required="required"  name=nom   ></td></tr> <br>
                <tr><td> Date de création *:</td><td><input type="number" required="required" name=date min="1950"></td></tr> <br>
                <tr><td> Architecte *:</td><td><input type=text required="required"  name=architecte></td></tr> <br>
                <tr>
                    <td>Classe du bateau *:</td>
                    <td>
                        <select name="classe" required="required">
                            <option value="Class40">Class40</option>
                            <option value="Ultim 32/23">Ultim 32/23</option>
                            <option value="Ocean Fifty">Ocean Fifty</option>
                            <option value="IMOCA">IMOCA</option>
                            <option value="Rhum Multi">Rhum Multi</option>
                            <option value="Rhum Mono">Rhum Mono</option>
                        </select>
                    </td>
                </tr>

            </table>
            <input type="submit" value="AJOUTER" name="AJOUTER">
<?php
/*
if ( isset($_GET["AJOUTER"])){
    addBateau($_GET["nom"],$_GET["date"],$_GET["architecte"],$_GET["classe"]);
}
*/

if (isset($_GET["AJOUTER"])) {
    $bateau_id = addBateau($_GET["nom"], $_GET["date"], $_GET["architecte"], $_GET["classe"]);
    if ($bateau_id) {
        header("location: addedBateau.php?id=" . $bateau_id);
    } else {
        header("location: erreur.php?code=5");
    }
}
?>