<?php

require_once('init_pdo.php');

try{
    $pdo = new PDO($connectionString,_MYSQL_USER,_MYSQL_PASSWORD,$options);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $id_delete=$_GET['id'];
    $sql = "DELETE FROM Users WHERE id=$id_delete";
    $sth = $pdo->prepare($sql);
    $sth->execute();
}

require_once('affichage_user.php');
