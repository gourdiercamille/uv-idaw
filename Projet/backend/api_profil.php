<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require_once('profil.php');

$method = $_SERVER['REQUEST_METHOD'];

//get user
if ($method == 'GET') {
    if (isset($_GET['login'])) {
        $user = getUserByLogin($_GET['login']);
        if ($user) {
            echo json_encode($user);
            $age=getInfosUser($_GET['login'],'age');
            $sexe=getInfosUser($_GET['login'],'sexe');
            $sport=getInfosUser($_GET['login'],'sport');
        } else {
            header('HTTP/1.1 404 Not Found');
            echo json_encode(['error' => 'User not found']);
        }
    } else {
        header('HTTP/1.1 404 Not Found');
        echo json_encode(['error' => 'User not found']);
    }
}

//update user
if ($method == 'PUT') {
    $data = json_decode(file_get_contents('php://input'), true);
    $result = updateUserByLogin($data['LOGIN'], $data['ID_TRANCHE_AGE'], $data['ID_SPORT'], $data['POIDS'], $data['TAILLE']);
    if ($result) {
        echo json_encode(['success' => 'User updated successfully']);
    } else {
        header('HTTP/1.1 404 Not Found');
        echo json_encode(['error' => 'User not found']);
    }
}

?>
