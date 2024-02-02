
# La Route du Rhum

Ce projet PHP a pour objectif de mettre en place un système de gestion de la 12éme édition de la Transat Jacques Vabre la route du rhum. Il permet d'effectuer différentes opérations liées aux participants et aux classements, telles que l'ajout, la modification et la suppression des données.

## Contenu du projet

Le projet est composé des fichiers suivants :


## connexion.php :

Ce fichier établit la connexion à la base de données PostgreSQL en utilisant les paramètres de connexion tels que l'hôte, le nom de la base de données, le nom d'utilisateur et le mot de passe.


## skippers.php :

Ce fichier contient la page principale de gestion des participants. Il affiche la liste des skippers.


## Bateau.php :

Ce fichier contient la page principale de gestion des bateaux. Il affiche la liste des bateaux.


## Resultats.php :

Ce fichier représente la page de gestion des classements. Il affiche la liste des classements existants, avec le temps de chaque skipper et offre la possibilité d'ajouter, de modifier et de supprimer des classements.


## addBateau , addRes , addSkipper (.php) :

Ces fichiers contiennent les scripts pour ajouter respectivement un bateau , un résultat, un Skipper.


## addedBateau , addedSkipper (.php) :

ces fichiers contiennent les scripts qui affichent le bateau ou le skipper ajouté.


## updateBat , updateRes , updateSkipper (.php) :

Ces fichiers contiennent les scripts pour modifier respectivement un bateau, un résultat, un Skipper.


## updatedBateau , updatedSkipper (.php) :

ces fichiers contiennent les scripts qui affichent le bateau ou le skipper modifié.


## fonctions. php :

Ce fichier contient des fonctions utilitaires utilisées dans les scripts de traitement pour effectuer les opérations sur la base de données.


## Fonctionnalités du projet :

Le projet permet de réaliser les fonctionnalités suivantes :

- Affichage de la liste des participants existants avec leurs données  : " identifiant, nom, prénom, âge, sexe, nationalité , bateau , résultat ".

- Possibilité d'ajouter un nouveau participant en remplissant un formulaire.

- Possibilité de modifier les informations d'un participant existant en accédant à un formulaire de modification spécifique.

- Suppression d'un participant de la base de données, entraînant également la suppression de ses classements associés.

- Affichage de la liste des résultats existants avec la date, les points et l'identifiant du participant associé.

- Possibilité d'ajouter un nouveau résultat en remplissant un formulaire avec la date, les points et l'identifiant du participant correspondant.

- Possibilité de modifier un résultat existant en accédant à un formulaire de modification spécifique.

- Suppression d'un résultat de la base de données.


## Technologies utilisées

Le projet utilise les technologies suivantes :

- `PHP` : Utilisé pour le développement du backend et l'interfaçage avec la base de données.

- `PostgreSQL` : Système de gestion de bases de données relationnelles utilisé pour stocker les données des participants, des

   bateaux et des résultats.

- `HTML` : utilisé pour structurer les pages web et afficher les informations.

- `CSS` : utilisé pour la mise en forme et la présentation visuelle des pages web.
