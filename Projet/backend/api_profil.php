<?php

header("Access-Control-Allow-Origin: http://localhost:3306/IDAW_PROJET/Projet/frontend/profil.php");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");

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
    $result = updateUserByLogin($data['login'], $data['age'], $data['sport'], $data['poids'], $data['taille']);
    if ($result) {
        echo json_encode(['success' => 'User updated successfully']);
    } else {
        header('HTTP/1.1 404 Not Found');
        echo json_encode(['error' => 'User not found']);
    }
}

?>
