<?php

require_once('init_pdo.php');

try{
    $pdo = new PDO($connectionString,_MYSQL_USER,_MYSQL_PASSWORD,$options);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $id_edit=$_GET['id'];
    $sql1 = "SELECT login FROM Users WHERE id=$id_edit";
    $sql1 = "SELECT email FROM Users WHERE id=$id_edit";
    $login_toEdit = $pdo->prepare($sql1);
    $email_toEdit = $pdo->prepare($sql1);
}

require_once('affichage_user.php');

echo'  
    <h3> Modifier un utilisateur :</h3>
    <form id="edit_form" method="POST">
        <table>
            <tr>
                <th>Login :</th>
                <td><input type="text" id="login" name="login" value='$login_toEdit'"></td>
            </tr><tr>
                <th>Email :</th>
                <td><input type="email" id="email" name="email" value='$email_toEdit'></td>
            </tr><tr>
                <th></th>
                <td><input type="submit" name="add" value="Modifier" /></td>
            </tr>
        </table>
    </form>'