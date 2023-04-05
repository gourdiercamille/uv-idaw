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
        <form id="connect-form">
            <input type="text" name="login" id="login-input">
            <input type="submit" value="Valider">
        </form>
    </div>
    <script>
    URL_API = '<?php require_once('config.php'); echo URL_API; ?>';

    function verifLogin(login) {
            $.ajax({
                url: URL_API + 'authentification.php', 
                type: 'GET',
                data: JSON.stringify({ LOGIN: login}),
                dataType: 'json',
                success: function(response) {
                    // Si la requête réussit, on redirige vers le dashboard
                    window.location.href = 'dashboard.php?login=' + login;
                },
                error: function() {
                    // Si la requête échoue,
                    alert('Login incorrect');
            }
        });
    }

    $(document).ready(function() {
        $('#connect-form').submit(function(e) {
            e.preventDefault();
            var login = $('#login-input').val();
            verifLogin(login);
        });
    });
    </script>
</body>
</html>