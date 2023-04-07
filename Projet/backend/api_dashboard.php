<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require_once('dashboard.php');

$method = $_SERVER['REQUEST_METHOD'];

//get repas
if ($method == 'GET') {
    if (isset($_GET['menuDeroulant'])) {
        $repasMenu = getAllNameAliment();
        if ($repasMenu) {
            echo json_encode(mb_convert_encoding($repasMenu, "UTF-8"));
        } else {
            header('HTTP/1.1 404 Not Found');
            echo json_encode(['error' => 'Repas not found']);
        }
    }

    if (isset($_GET['Kcal']) && isset($_GET['LOGIN']) && $_GET['LOGIN'] != 'menu' && isset($_GET['Besoins'])) {
        $besoins = besoinsApresRepas($_GET['LOGIN']);
        if ($besoins) {
            echo json_encode(mb_convert_encoding($besoins, "UTF-8"));
        } else {
            header('HTTP/1.1 404 Not Found');
            echo json_encode(['error' => 'Besoins not found']);
        }
    }

    if (isset($_GET['Kcal']) && isset($_GET['LOGIN']) && $_GET['LOGIN'] != 'menu' && !isset($_GET['Besoins'])) {
        $besoins = calculBesoinsKcal($_GET['LOGIN']);
        if ($besoins) {
            echo json_encode(mb_convert_encoding($besoins, "UTF-8"));
        } else {
            header('HTTP/1.1 404 Not Found');
            echo json_encode(['error' => 'Besoins not found']);
        }
    }
    
    else if (!isset($_GET['Kcal']) && isset($_GET['LOGIN']) && $_GET['LOGIN'] != 'menu') {
        $repas = getRepasByLogin($_GET['LOGIN']);
        if ($repas) {
            echo json_encode(mb_convert_encoding($repas, "UTF-8"));
        } else {
            header('HTTP/1.1 404 Not Found');
            echo json_encode(['error' => 'Repas not found1']);
        }
    }
    
    else if (!isset($_GET['Kcal']) && isset($_GET['LOGIN']) && $_GET['LOGIN'] == 'menu') {
            $repas = getAllRepas();
            if ($repas) {
                echo json_encode(mb_convert_encoding($repas, "UTF-8"));
            } else {
                header('HTTP/1.1 404 Not Found');
                echo json_encode(['error' => 'Repas not found2']);
            }
    }
}

//create repas
if ($method == 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    // var_dump($data); // Point de débogage pour afficher les données reçues
    $repas = createRepas($data['LOGIN'], $data['ID_ALIMENT'], $data['QUANTITE'], $data['DATE'], $data['NOM']);
    // var_dump($repas); // Point de débogage pour afficher le résultat de la création de repas
    if ($repas) {
        header('HTTP/1.1 201 Created');
        // var_dump($repas);
        echo json_encode(mb_convert_encoding($repas, "UTF-8"));
    } else {
        header('HTTP/1.1 400 Bad Request');
        echo json_encode(['error' => 'Could not create repas']);
    }
}


//delete repas
if ($method == 'DELETE') {
    if (isset($_GET['LOGIN'])&&isset($_GET['ID_ALIMENT'])) {
        $result = deleteRepasByLogin($_GET['LOGIN'], $_GET['ID_ALIMENT']);
        if ($result) {
            header('HTTP/1.1 204 No Content');
        } else {
            header('HTTP/1.1 404 Not Found');
            echo json_encode(['error' => 'Repas not found']);
        }
    } else {
        header('HTTP/1.1 400 Bad Request');
        echo json_encode(['error' => 'Missing login parameter']);
    }
}

//update repas
if ($method == 'PUT') {
    $data = json_decode(file_get_contents('php://input'), true);
    $result = updateRepasByLogin($data['LOGIN'],  $data['ID_ALIMENT'], $data['QUANTITE'], $data['DATE']);
    if ($result) {
        echo json_encode(['success' => 'Repas updated successfully']);
    } else {
        header('HTTP/1.1 404 Not Found');
        echo json_encode(['error' => 'Repas not found']);
    }
}