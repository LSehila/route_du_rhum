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
		<h2> SKIPPERS </h2>
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
	<div class="table-wrapper">
		<form method="get"  action="addSkipper.php">
			<table>
				<th colspan="2"> <h1> Ajouter un nouveau skipper à la liste </h1></th>
				<tr><td> Nom :</td><td><input type=text required="required"  name=nom   ></td></tr> <br>
				<tr><td> Prénom :</td><td><input type=text required="required"  name=prenom   ></td></tr> <br>
				<tr><td> Age :</td><td><input type="number" required="required" name=age min="2" max="100" ></td></tr> <br>
				<tr><td> Sexe :</td><td>Homme <input type="radio" name=sexe value="Homme"/></td><td>Femme <input type="radio" name=sexe value="Femme"/></td></tr> <br>
				<tr><td> Nationalité :</td><td><input type=text required="required"  name=natio   ></td></tr> <br>

			</table>
			<input type="submit" value="AJOUTER" name="AJOUTER">

	</div>
	<?php

	if (isset($_GET["AJOUTER"])){
		$skipper_id = addSkipper($_GET["nom"],$_GET["prenom"],$_GET["age"],$_GET["sexe"],$_GET["natio"]);
		if($skipper_id){
			// renvois vers le fichier addedSkipper ou on voit que le skipper modifier
			header("location: addedSkipper.php?id=".$skipper_id);
		}else{
			//si l'ajoute s'est mal passer
			header("location: erreur.php?code=5");
		}
	}
	?>
