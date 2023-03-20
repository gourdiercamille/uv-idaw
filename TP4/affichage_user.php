<?php

catch (PDOException $erreur) {
    echo 'Erreur : '.$erreur->getMessage();
}
       
    if (isset($_POST['add'])) {
        $login = $_POST['login'];
        $email = $_POST['email'];

        $sql = "INSERT INTO users(login ,email) VALUES('$login' , '$email');";
         
        $pdo->exec($sql);
    }


    $request = $pdo->prepare("select * from users");

    $request->execute();

    $resultat = $request->fetchAll(PDO::FETCH_ASSOC);

    echo '<!DOCTYPE html> 
        <html>
        <body>
            <h1> Liste des utilisateurs </h1>
        <table> 
            <tr>
                <td> Id </td> 
                <td> Login </td> 
                <td> Email </td>
                <td>  </td>
                <td>  </td>
            </tr>' ;
    
    foreach ($resultat as $row) {
        echo '<tr> 
                <td> ' . $row['id'] . ' </td> 
                <td> ' . $row['login'] . ' </td> 
                <td> ' . $row['email'] . ' </td> 
                <td> <a href="edit.php?id='. $row['id'].'">Modifier</a> </td>
                <td> <a href="delete.php?id='. $row['id'].'">Supprimer</a> </td> 
            </tr>';
    }

    echo'  
    </table>
    <br>
    <h3> Ajouter un utilisateur :</h3>
    <form id="add_form" method="POST">
        <table>
            <tr>
                <th>Login :</th>
                <td><input type="text" id="login" name="login"></td>
            </tr><tr>
                <th>Email :</th>
                <td><input type="email" id="email" name="email"></td>
            </tr><tr>
                <th></th>
                <td><input type="submit" name="add" value="Ajouter" /></td>
            </tr>
        </table>
    </form> 
    </body>';

    $pdo = null;
?>