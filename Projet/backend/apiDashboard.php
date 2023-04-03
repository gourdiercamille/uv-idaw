<?php
require_once('dashboard.php');

$method = $_SERVER['REQUEST_METHOD'];

//get repas
if ($method == 'GET') {
    if (isset($_GET['login'])) {
        $user = getRepasByLogin($_GET['login']);
        if ($repas) {
            echo json_encode($repas);
        } else {
            header('HTTP/1.1 404 Not Found');
            echo json_encode(['error' => 'Repas not found']);
        }
    } else {
        $repas = getAllRepas();
        echo json_encode($repas);
    }
}

//create repas
if ($method == 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    $user = createRepas($data['login'], $data['quantite'], $data['id_aliment']);
    if ($repas) {
        header('HTTP/1.1 201 Created');
        echo json_encode($repas);
    } else {
        header('HTTP/1.1 400 Bad Request');
        echo json_encode(['error' => 'Could not create repas']);
    }
}

//delete repas
if ($method == 'DELETE') {
    if (isset($_GET['id'])) {
        $result = deleteRepasByLogin($_GET['login']);
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
    $result = updateRepasByLogin($data['login'], $data['quantite'], $data['id_aliment']);
    if ($result) {
        echo json_encode(['success' => 'Repas updated successfully']);
    } else {
        header('HTTP/1.1 404 Not Found');
        echo json_encode(['error' => 'Repas not found']);
    }
}

?>