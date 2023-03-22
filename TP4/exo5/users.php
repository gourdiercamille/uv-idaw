
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
        
        // Renvoi de la réponse HTTP avec le code 201 Created et l'URL de la nouvelle ressource
        header('HTTP/1.1 201 Created');
        echo "{ \"Location\" : \"".API_URL_PREFIX."/users.php/' . $user['id']\" }";

        $pdo = null;

        // Renvoi des informations de l'utilisateur créé au format JSON dans le corps de la réponse
        header('Content-Type: application/json');
        echo json_encode($user);

    } else {

        $pdo = null;

        // Erreur : méthode HTTP non prise en charge
        http_response_code(405); // Method Not Allowed
        exit("Méthode HTTP non autorisée.");
    }

?>