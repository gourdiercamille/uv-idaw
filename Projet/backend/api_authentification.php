<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require_once('authentification.php');

$method = $_SERVER['REQUEST_METHOD'];

//get user
if ($method == 'POST') {
    // Vérification du login dans la base de données
    if (isset($_GET['login'])) {
        $login = $_GET['login'];
        checkLogin($login);
        echo json_encode(['success' => 'User is connected']);
    } else {
        header('HTTP/1.1 404 Not Found');
        echo json_encode(['error' => 'User not found']);
    }
}
