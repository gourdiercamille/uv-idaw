<?php

require_once('init_pdo.php');


$id_delete=$_GET['id'];
    $sql = "DELETE FROM Users WHERE id=$id_delete";
    $sth = $pdo->prepare($sql);
    $sth->execute();

require_once('affichage_user.php');


$pdo = null;

?>