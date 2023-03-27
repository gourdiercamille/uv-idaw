<?php
require_once('functions_api.php');

$method = $_SERVER['REQUEST_METHOD'];

//get user
if ($method == 'GET') {
    if (isset($_GET['id'])) {
        $user = getUserById($_GET['id']);
        if ($user) {
            echo json_encode($user);
        } else {
            header('HTTP/1.1 404 Not Found');
            echo json_encode(['error' => 'User not found']);
        }
    } else {
        $users = getAllUsers();
        echo json_encode($users);
    }
}

//create user
if ($method == 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    $user = createUser($data['login'], $data['email']);
    if ($user) {
        header('HTTP/1.1 201 Created');
        echo json_encode($user);
    } else {
        header('HTTP/1.1 400 Bad Request');
        echo json_encode(['error' => 'Could not create user']);
    }
}

//delete user
if ($method == 'DELETE') {
    if (isset($_GET['id'])) {
        $result = deleteUserById($_GET['id']);
        if ($result) {
            header('HTTP/1.1 204 No Content');
        } else {
            header('HTTP/1.1 404 Not Found');
            echo json_encode(['error' => 'User not found']);
        }
    } else {
        header('HTTP/1.1 400 Bad Request');
        echo json_encode(['error' => 'Missing ID parameter']);
    }
}

//update user
if ($method == 'PUT') {
    $data = json_decode(file_get_contents('php://input'), true);
    $result = updateUserById($data['id'], $data['login'], $data['email']);
    if ($result) {
        echo json_encode(['success' => 'User updated successfully']);
    } else {
        header('HTTP/1.1 404 Not Found');
        echo json_encode(['error' => 'User not found']);
    }
}

?>