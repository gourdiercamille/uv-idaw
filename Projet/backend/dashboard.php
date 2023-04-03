<?php
    require_once('config.php');
    require_once('init_pdo.php');

    function getAllRepas() {
        global $pdo;
        $request = $pdo->prepare("SELECT manger.ID_ALIMENT, manger.QUANTITE, manger.DATE, contenir.RATIO 
        FROM manger 
        INNER JOIN contenir ON manger.ID_ALIMENT = contenir.ID_ALIMENT
        ORDER BY manger.DATE DESC;
        ");
        $request->execute();
        $repas = $request->fetchAll(PDO::FETCH_ASSOC);
        return $repas;
    }

    function getRepasByLogin($login) {
        global $pdo;
        $request = $pdo->prepare("select * from manger where login = $login");
        $request->execute();
        $repas = $request->fetch(PDO::FETCH_ASSOC);
        return $repas;
    }

    function createRepas($login, $id_aliment, $quantite) {
        global $pdo;
        $request = $pdo->prepare("insert into manger (login, id_aliment, quantité) values ('$login', '$id_aliment', '$quantite')");
        $result = $request->execute();
        if ($result) {
            $login = $pdo->lastInsertId();
            getRepasByLogin($login);
        } else {
            return false;
        }
    }

    function deleteRepasByLogin($login) {
        global $pdo;
        $request = $pdo->prepare("delete from users where login = $login");
        $result = $request->execute();
        return $result;
    }

    function updateRepasByLogin($login, $id_aliment, $quantite) {
        global $pdo;
        $request = $pdo->prepare("update manger set quantité = '$quantite', id_aliment = '$id_aliment' where login = $login");
        $result = $request->execute();
        return $result;
    }
?>