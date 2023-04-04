<!DOCTYPE html>
<html>
<head>
    <title>Connexion</title>
    <meta charset="utf8">
    <link rel="stylesheet">
</head>
<body>
    <h1> Connexion </h1>
    <div>
        <h3> Entrez votre login : </h3>
        <script>
        URL = "<?php require_once('config.php'); echo URL_API ; ?>" + "authentification.php";
        var form = document.getElementById("myForm");
        form.action = URL ;
        </script>
        <form method='GET' id="myForm">
            <input type="text" name="LOGIN" id="LOGIN">
            <input type="submit" value="Valider">
        </form>
    </div>
</body>
</html>