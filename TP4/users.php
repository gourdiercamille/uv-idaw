<?php
    require_once('config.php');
    $connectionString = "mysql:host=". _MYSQL_HOST;
    if(defined('_MYSQL_PORT')){
        $connectionString .= ";port=". _MYSQL_PORT;
    }
    $connectionString .= ";dbname=" . _MYSQL_DBNAME;
    $options = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8' );
    $pdo = NULL;
    try {
        $pdo = new PDO($connectionString,_MYSQL_USER,_MYSQL_PASSWORD,$options);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch (PDOException $erreur) {
        echo 'Erreur : '.$erreur->getMessage();
    }

    $request = $pdo->prepare("select * from users");

    $request -> execute() ;

    echo '<html>
    <h1> Liste des utilisateurs </h1>
    <table> <tr> <td> Id </td> <td> Login </td> <td> Email </td> </tr>' ;

    $resultat = $request->fetchAll(PDO::FETCH_ASSOC);
    
    foreach ($resultat as $row) {
        echo '<tr> <td> ' . $row['id'] . ' </td> <td> ' . $row['login'] . ' </td> <td> ' . $row['email'] . '</td> </tr>';
    }
    
    echo '</table>';

    /*echo '<pre>';
    print_r($resultat);
    echo '</pre>';
    */

    echo'  
    <br>
    <h3> Ajouter un utilisateur :</h3>
    <form id="add_form" method="POST">
        <table>
            <tr>
                <th>Login :</th>
                <td><input type="text" id="login" name="login"></td>
            </tr>
            <tr>
                <th>Email :</th>
                <td><input type="email" id="email" name="email"></td>
            </tr>
            <tr>
                <th></th>
                <td><input type="submit" value="Ajouter" /></td>
            </tr>
        </table>
    </form> ';

    if (isset($_POST['submit'])) {
        $login = $_POST['login'];
        $email = $_POST['email'];

        $sql = "INSERT INTO users(login, email)
        VALUES($login , $email)";

        $pdo->exec($sql);
    }

    // TODO: add your code here
    // retrieve data from database using fetch(PDO::FETCH_OBJ) and
    // display them in HTML array

    $pdo = null;
?>