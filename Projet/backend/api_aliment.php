<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require_once('aliment.php');

$method = $_SERVER['REQUEST_METHOD'];

//create aliment
if ($method == 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    //var_dump($data); // Point de débogage pour afficher les données reçues
    $aliment = createAliment($data['LIBELLE'], $data['TYPE_ALIMENT'], $data['LIPIDES'], $data['GLUCIDES'], $data['PROTEINES'], $data['FIBRES'], $data['SEL'], $data['VITAMINES']);
    //var_dump($aliment); // Point de débogage pour afficher le résultat de la création de repas
    if ($aliment) {
        header('HTTP/1.1 201 Created');
        // var_dump($aliment);
        echo json_encode(mb_convert_encoding($aliment, "UTF-8"));
    } else {
        header('HTTP/1.1 400 Bad Request');
        echo json_encode(['error' => 'Could not create alimnent']);
    }
}