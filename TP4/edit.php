<?php

require_once('init_pdo.php');


    $id_edit=$_GET['id'];
    $sql1 = "SELECT login FROM Users WHERE id=$id_edit";
    $sql2 = "SELECT email FROM Users WHERE id=$id_edit";
    $request1 = $pdo->prepare($sql1);
    $request2 = $pdo->prepare($sql2);
    $request1->execute();
    $request2->execute();
    $resultat1 = $request1->fetch(PDO::FETCH_ASSOC);
    $resultat2 = $request2->fetch(PDO::FETCH_ASSOC);


require_once('affichage_user.php');



echo'  
    <h3> Modifier un utilisateur :</h3>
    <form id="edit_form" method="POST">
        <table>
            <tr>
                <th>Login :</th>
                <td><input type="text" id="editlogin" name="editlogin" value=' . $resultat1['login'] . '></td>
            </tr><tr>
                <th>Email :</th>
                <td><input type="email" id="editemail" name="editemail" value=' . $resultat2['email'] . '></td>
            </tr><tr>
                <th></th>
                <td><input type="submit" name="edit" value="Modifier" /></td>
            </tr>
        </table>
    </form>';

    if(isset($_POST['edit'])){
        $newlogin = $_POST['editlogin'];
        $newemail = $_POST['editemail'];
        $sql_edit = "UPDATE users SET login = '" . $newlogin . "' , email = '" . $newemail . "' WHERE id = $id_edit";
        $edit_user = $pdo->prepare($sql_edit);
        $edit_user->execute();
    }

    $pdo = null;

    ?>