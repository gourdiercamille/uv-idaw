<?php

require_once('config.php');
require_once('init_pdo.php');

// Vérification du login dans la base de données
function checkLogin($login) {
    global $pdo;
    $request = $pdo->prepare("SELECT * FROM utilisateur WHERE LOGIN = '$login'");
    $result = $request->execute();
    return $result && $request->rowCount() > 0;
}
if (isset($_GET['login'])) {
    $login = $_GET['login'];
    $request = $pdo->prepare("SELECT * FROM utilisateur WHERE LOGIN = '$login'");
    $result = $request->execute();

    if ($result && $request->rowCount() > 0) {
        // Login trouvé, démarrer la session et rediriger vers le dashboard
        session_start();
        $_SESSION['LOGIN'] = $login;
        header('Location: ../frontend/dashboard.php');
    } else {
        // Login non trouvé, afficher un message d'erreur
        echo "Login incorrect.";
    }
}
?>