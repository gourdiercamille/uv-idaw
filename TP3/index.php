<?php
    session_start(); 
    $users = array(
        'camille' => '1234' );
    $errorText = "";
    $username = $_POST['login'];
    $password = $_POST['password'];
    if(isset($_POST['login']) && isset($_POST['password'])){
        if ($username === $users[$username] && $password === $users[$password]) {
            $_SESSION['login'] = $username;
        } else {
            $errorText = 'Identifiants incorrects';
        }
    }

    $style='stylepardefaut';
    if (isset($_GET['css'])){
        $style=$_GET['css'];
        setcookie('style', $style);
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Programme</title>
        <meta charset="utf8">
        <link rel="stylesheet" href='<?php echo $style; ?>.css' type="text/css" media="screen" title="default" charset="utf-8" />
    </head>
    <body>
        <h1> Bonsoir à toutes et à tous !</h1>
        <h3> Ce soir au programme :</h3>
        <ul>
            <li>21h-23h:Soirée Capa</li>
            <li>23h:Départ au WEBDA</li>
        </ul>
        <br>
        <br>
        <div>
            <h3> Connexion </h3>
            <form id="login_form" action="" method="POST">
                <table>
                    <tr>
                        <th>Login :</th>
                        <td><input type="text" name="login"></td>
                    </tr>
                    <tr>
                        <th>Mot de passe :</th>
                        <td><input type="password" name="password"></td>
                    </tr>
                    <tr>
                        <th></th>
                        <td><input type="submit" value="Se connecter" /></td>
                    </tr>
                </table>
            </form>
        </div>
        <h3> Changement du style de la page :</h3>
        <form id="style_form" action="index.php" method="GET">
            <select name="css">
                <option value="style1">Style 1</option>
                <option value="style2">Style 2</option>
            </select>
            <input type="submit" value="Appliquer" />
        </form>
    </body>
</html>