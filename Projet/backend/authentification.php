<?php

require_once('config.php');
require_once('init_pdo.php');

function checkLogin($login) {
    global $pdo;
    $request = $pdo->prepare("SELECT * FROM utilisateur WHERE LOGIN = '$login' ");
    $result = $request->execute();
    $data = $request->fetchAll();
    return !empty($data);
}

?>