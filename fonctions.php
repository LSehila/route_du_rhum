<?php
include 'connexion.php';
function connexion(){
    $strConnex = "host=".$_ENV['dbHost']. " dbname=".$_ENV['dbName']. " user=" .$_ENV['dbUser']. " password=" .$_ENV['dbPassword'];
    $cnx = pg_connect($strConnex);
    if (!$cnx){
        header("location: erreur.php?code=6");
    }
    return $cnx;
}

//ajouter un skipper
function addSkipper($nom, $prenom, $age, $sexe, $natio) {
    $cnx = connexion();
    $sql1 = "INSERT INTO p02_skipper(skipper_nom, skipper_prenom, skipper_age, skipper_sexe, skipper_nationnalite) VALUES($1, $2, $3, $4, $5) RETURNING skipper_id";
    pg_prepare($cnx, "add_skipper", $sql1);
    $ptrQuery = pg_execute($cnx, "add_skipper", array($nom, $prenom, $age, $sexe, $natio));
    if (isset($ptrQuery)) {
        $row = pg_fetch_row($ptrQuery);
        $skipper_id = $row[0];
        pg_free_result($ptrQuery);
        pg_close($cnx);
        return $skipper_id;
    } else {
        pg_free_result($ptrQuery);
        pg_close($cnx);
        header("location: erreur.php?code=5");
    }
}

//modifier un skipper
function updateSkipper( $idAModifier, $nom ,$prenom , $age, $sexe, $natio){
    $cnx = connexion();
    $requete = "SELECT * FROM p02_skipper WHERE skipper_id = '$idAModifier'";
    $result = pg_query($cnx, $requete);
    if($result){
        $requeteModifiee = "UPDATE p02_skipper SET skipper_nom = '$nom',skipper_prenom = '$prenom' ,skipper_age = '$age', skipper_sexe = '$sexe', skipper_nationnalite='$natio' WHERE skipper_id='$idAModifier'";
        $resultat = pg_query($cnx, $requeteModifiee);
        if ($resultat){
            header("location:Skippers.php");
        }

    }else{
        echo"Requete impossible";
    }
}

//supprimer un skipper
function deleteSkipper($skip_id){
    $cnx = connexion();
    // Supprimer les résultats associés au skipper car
    $sql = "DELETE FROM p02_resultat WHERE skipper_id=$1";
    $prepared_sql = pg_prepare($cnx, "", $sql);
    $result = pg_execute($cnx, "", array($skip_id));
    pg_free_result($result);

    // Supprimer le skipper
    $sql1 = "DELETE FROM p02_skipper WHERE skipper_id=$1";
    $prepared_sql1 = pg_prepare($cnx, "", $sql1);
    $exec = pg_execute($cnx, "", array($skip_id));
    pg_free_result($exec);

    pg_close($cnx);

    header("location:Skippers.php");
    exit();
}


//ajouter un bateau
function addBateau($nom, $date, $archi, $classe) {
    $cnx = connexion();
    $compar = 0;
    $query = "SELECT * FROM p02_bateau";
    pg_prepare($cnx, "reqPrep", $query);
    $ptrQuery = pg_execute($cnx, "reqPrep", array());

    if (isset($ptrQuery)) {
        while ($row = pg_fetch_assoc($ptrQuery)) {
            if (strcasecmp($row['bateau_nom'], $nom) == 0 && strcasecmp($row['bateau_date'], $date) == 0 && strcasecmp($row['bateau_architecte'], $archi) == 0 && strcasecmp($row['bateau_classe'], $classe) == 0) {
                $compar = 1;
                break;
                /* On vérifie si les informations inserés existe déjà dans notre table bateau */
            }
        }
        pg_free_result($ptrQuery);
    }

    if ($compar != -1) {
        /* on ajoute les informations insérer dans la table bateau de notre base de données */
        $query = "INSERT INTO p02_bateau(bateau_id, bateau_nom, bateau_date, bateau_architecte, bateau_classe) VALUES (DEFAULT, $1, $2, $3, $4) RETURNING bateau_id";
        pg_prepare($cnx, "reqPrepAddBateau", $query);
        $ptrQuery2 = pg_execute($cnx, "reqPrepAddBateau", array($nom, $date, $archi, $classe));

        if (isset($ptrQuery2)) {
            $row = pg_fetch_row($ptrQuery2);
            $bateau_id = $row[0];
            pg_free_result($ptrQuery2);
            pg_close($cnx);
            return $bateau_id;        }
    } else {
        pg_close($cnx);
        header("location: erreur.php?code=5");
    }
}


//modifier un bateau
function updateBateau($idAModifier2, $nom, $date, $archi, $classe) {
    $cnx = connexion();

    $requete2 = "SELECT * FROM p02_bateau WHERE bateau_id = $1";
    pg_prepare($cnx, "reqPrepSelectById", $requete2);
    $ptrQuery = pg_execute($cnx, "reqPrepSelectById", array($idAModifier2));

    if($ptrQuery){
        $requeteModifiee2 = "UPDATE p02_bateau SET bateau_nom = $1, bateau_date = $2, bateau_architecte = $3, bateau_classe = $4 WHERE bateau_id=$5";
        pg_prepare($cnx, "reqPrepUpdate", $requeteModifiee2);
        $ptrQuery = pg_execute($cnx, "reqPrepUpdate", array($nom, $date, $archi, $classe, $idAModifier2));

        if ($ptrQuery) {
            header("location:Bateaux.php");
        } else {
            echo "Requete impossible";
        }
        pg_free_result($ptrQuery);
    } else {
        echo "Requete impossible";
    }
    pg_close($cnx);
}

//supprimer un bateau
function deleteBateau($bat_id2) {
    $cnx = connexion();

    // Préparer la requête de suppression des résultats associés au bateau
    $query1 = "DELETE FROM p02_resultat WHERE bateau_id = $1";
    $stmt1 = pg_prepare($cnx, "deleteResultatById", $query1);
    $result1 = pg_execute($cnx, "deleteResultatById", array($bat_id2));
    pg_free_result($result1);

    // Préparer la requête de suppression du bateau
    $query2 = "DELETE FROM p02_bateau WHERE bateau_id = $1";
    $stmt2 = pg_prepare($cnx, "deleteBateauById", $query2);
    $result2 = pg_execute($cnx, "deleteBateauById", array($bat_id2));
    pg_free_result($result2);

    // Fermer la connexion à la base de données
    pg_close($cnx);

    header("Location: Bateaux.php");
    exit();
}


//ajouter un resultat
function addResultat($skipper_id, $bateau_id, $position, $jours, $temps) {
    $cnx = connexion();
// Préparer la requête d'insertion d'un nouveau résultat
    $query = "INSERT INTO p02_resultat (skipper_id, bateau_id, resultat_pos, resultat_jours, resultat_temps) VALUES ($1, $2, $3, $4, $5)";
    $stmt = pg_prepare($cnx, "insertResultat", $query);
    $result = pg_execute($cnx, "insertResultat", array($skipper_id, $bateau_id, $position, $jours, $temps));
    pg_free_result($result);

// Fermer la connexion à la base de données
    pg_close($cnx);

    header("Location: Resultats.php");
    exit();
}


//modifier un resultat
function updateRes($idmod, $position, $jours, $temps) {
    $cnx = connexion();

    // Vérifier si l'entrée existe
    $query1 = "SELECT * FROM p02_resultat WHERE skipper_id = $1";
    $stmt1 = pg_prepare($cnx, "checkResultatById", $query1);
    $result1 = pg_execute($cnx, "checkResultatById", array($idmod));
    if (isset($result1)) {
        // Préparer la requête de modification
        $query2 = "UPDATE p02_resultat SET resultat_pos = $1, resultat_jours = $2, resultat_temps = $3 WHERE skipper_id = $4";
        $stmt2 = pg_prepare($cnx, "updateResultatById", $query2);
        $result2 = pg_execute($cnx, "updateResultatById", array($position, $jours, $temps, $idmod));
        pg_free_result($result2);
    }

    // Fermer la connexion à la base de données
    pg_free_result($result1);
    pg_close($cnx);

    header("Location: Resultats.php");
    exit();
}


//supprimer un resultat
function deleteResultat($skip_id){
    $cnx = connexion();
    $sql = "DELETE FROM p02_resultat WHERE skipper_id=$1";
    $stmt = pg_prepare($cnx, "", $sql);
    $result = pg_execute($cnx, "", array($skip_id));

    if ($result){
        header("Location: Resultats.php");
        exit();
    }
    pg_free_result($result);
    pg_close($cnx);
}



//renvoyer toute la table skipper
function getAllSkipper() {
    $cnx = connexion();
    $html = "<table border='1'>";
    $requete = "SELECT * from p02_skipper ORDER BY skipper_id";
    $stmt = pg_prepare($cnx, "getAllSkipper", $requete);
    $ptrQuery = pg_execute($cnx, "getAllSkipper", array());

    if ($ptrQuery) {
        $html .= "<tr><th>SELECT</th> <th>SKIPPER ID</th> <th>SKIPPER NOM</th> <th>SKIPPER PRENOM</th> <th>SKIPPER AGE</th> <th>SKIPPER SEXE</th>  <th>SKIPPER Nationalite</tr></th> ";

        while($ligne = pg_fetch_assoc($ptrQuery)) {
            $intg = $ligne['skipper_id'];
            $html .= "<tr><td> <input type=radio name=id value= $intg> </td><td>".$ligne['skipper_id']." </td><td> ".$ligne['skipper_nom']."</td><td>".$ligne['skipper_prenom']." </td><td> ".$ligne['skipper_age']." ans"." </td><td> ".$ligne['skipper_sexe']." </td><td> ".$ligne['skipper_nationnalite']."</td></tr>";
        }
        pg_free_result($ptrQuery);
        $html .= "</table><input  type =submit name=AJOUTER value= AJOUTER> ";
        $html .= "</table><input  type =submit name=modifier value= MODIFIER> ";
    }
    pg_close($cnx);
    return $html;
}


//renvoyer toute la table bateau
function getAllBateau(){
    $cnx = connexion();
    $tableauHTML = "<table border='1'>";
    $requete2 = "SELECT * from p02_bateau ORDER BY bateau_id";
    $ptrQuery2 = pg_prepare($cnx, "requete2", $requete2);
    $ptrQuery2 = pg_execute($cnx, "requete2", array());
    if ($ptrQuery2) {
        $tableauHTML .= "<tr><th>SELECT</th> <th>BATEAU ID</th> <th>BATEAU NOM</th> <th>BATEAU DATE</th> <th>BATEAU ARCHITECTE</th> <th>BATEAU CLASSE</tr></th> ";
        while ($ligne2 = pg_fetch_assoc($ptrQuery2)) {
            $intg2 = $ligne2['bateau_id'];
            $tableauHTML .= "<tr><td> <input type=radio name=id value= $intg2> </td><td>" . $ligne2['bateau_id'] . " </td><td> " . $ligne2['bateau_nom'] . " </td><td> " . $ligne2['bateau_date'] . "</td><td>" . $ligne2['bateau_architecte'] . " </td><td> " . $ligne2['bateau_classe'] . " </td></tr>";
        }
        pg_free_result($ptrQuery2);
        pg_close($cnx);
        $tableauHTML .= "</table><input  type=submit name=AJOUTER value=AJOUTER> ";
        $tableauHTML .= "</table><input  type=submit name=modifier value=MODIFIER> ";
    }
    return $tableauHTML;
}


//renvoyer toute la table resultat
function getAllResultat(){
    $cnx = connexion();
    echo "<table border='1'>";
    $requete3 = "SELECT r.*, s.skipper_nom, s.skipper_prenom, b.bateau_nom
FROM p02_resultat r
JOIN p02_skipper s ON r.skipper_id = s.skipper_id
JOIN p02_bateau b ON r.bateau_id = b.bateau_id
ORDER BY r.resultat_pos";
    $ptrQuery3 = pg_prepare($cnx, "", $requete3);
    $ptrQuery3 = pg_execute($cnx, "", array());
    if ($ptrQuery3) {
        echo "<tr><th>SELECT</th> <th>SKIPPER ID</th> <th>BATEAU ID</th> <th>Nom du skipper</th> <th>Prenom du skipper</th> <th>Nom du bateau</th><th>Position</th><th>Nombres de jours</th><th>Temps</th></tr>";
        while ($ligne = pg_fetch_assoc($ptrQuery3)) {
            $skipper_prenom = $ligne['skipper_prenom'];
            $skipper_nom = $ligne['skipper_nom'];
            $bateau_nom = $ligne['bateau_nom'];
            $skipper_id = $ligne['skipper_id'];
            $bateau_id = $ligne['bateau_id'];
            echo "<tr>
                <td><input type='radio' name='id' value='$skipper_id'></td>
                <td>$skipper_id</td>
                <td>$bateau_id</td>
                <td>$skipper_prenom</td>
                <td>$skipper_nom</td>
                <td>$bateau_nom</td>
                <td>" . $ligne['resultat_pos'] . "</td>
                <td>" . $ligne['resultat_jours'] . "</td>
                <td>" . $ligne['resultat_temps'] . "</td>
             </tr>";
        }
        pg_free_result($ptrQuery3);
        pg_close($cnx);
        echo "</table><input type='submit' name='AJOUTER' value='AJOUTER'> ";
        echo "<input type='submit' name='modifier' value='MODIFIER'> ";
    }
}