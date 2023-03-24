
<?php
    require_once('init_pdo.php');
       
    header('Content-Type: application/json');

     //méthode GET
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {

        $request = "SELECT * FROM users";

        $result = $pdo->query($request);
        $users = $result->fetchAll(PDO::FETCH_OBJ);
 
        $pdo = null;
        echo json_encode($users);

      //méthode POST
    } elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
        
        $user = [
            'login' => $_POST['login'],
            'email' => $_POST['email']
        ];

        $user_id = $pdo->lastInsertId();

        require_once('add.php');
        
        http_response_code(201);
        header('Location: '._API_URL.'/users.php/' .$user_id);

        $pdo = null;

        echo json_encode($user);

    } else {

        $pdo = null;

        // Erreur : méthode HTTP non prise en charge
        http_response_code(405); // Method Not Allowed
        exit("Méthode HTTP non autorisée.");
    }

?>