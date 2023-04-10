------- Camille Gourdier & Benjamin Puzenat --------- Projet IDAW ------ 09/05/2023


-- DOCUMENTATION DE NOTRE API --

Notre API comporte 4 endpoints:

    - api_aliment.php
    - api_authentification.php
    - api_dashboard.php
    - api_profil.php


Pour chacun de ces endpoints, dans notre dossier "backend" du projet, il existe:

    - le fichier "api_XXX.php" qui contient le CRUD
    - le fichier "XXX.php" qui contient les méthodes et fonctions appelées par le fichier "api_XXX.php"

En clair, ce sont les différents fichiers du frontend, via des requêtes AJAX, qui questionnent les fichiers "api_XXX.php" qui eux mêmes questionnent, en fonction du type de requête utilisé dans la requête AJAX (GET, POST, DELETE, PUT), les fichiers "XXX.php" du backend qui vont, eux, interagir avec notre base de données via des requêtes SQL.


