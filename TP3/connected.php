<?php
    // on simule une base de données
    $users = array(
    // login => password
    'riri' => 'fifi',
    'yoda' => 'maitrejedi',
    'camille' => '1234' );
    $login = "anonymous";
    $errorText = "";
    $successfullyLogged = false;
    if(isset($_POST['login']) && isset($_POST['password'])) {
        $tryLogin=$_POST['login'];
        $tryPwd=$_POST['password'];
        // si login existe et password correspond
        if( array_key_exists($tryLogin,$users) && $users[$tryLogin]==$tryPwd ) {
            $successfullyLogged = true;
            $login = $tryLogin;
            $password = $tryPwd;
        } else
            $errorText = "Erreur de login/password";
    } else
        $errorText = "Merci d'utiliser le formulaire de login";
        if(!$successfullyLogged) {
            echo $errorText;
        } else {
        echo "<h1>Bienvenue ".$login."</h1>";
        echo "Nom d'utilisateur: " . $login . "<br>";
        echo "Mot de passe: " . $password . "<br>";
    }
?>
