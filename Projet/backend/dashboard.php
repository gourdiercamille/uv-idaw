<?php
    require_once('config.php');
    require_once('init_pdo.php');

    function getAllRepas() {
        global $pdo;
        $request = $pdo->prepare("SELECT utilisateur.LOGIN, aliment.ID_ALIMENT, aliment.NOM, manger.QUANTITE, manger.DATE, 
        MAX(CASE WHEN contenir.ID_MICRONUTRIMENT = 1 THEN contenir.RATIO ELSE 0 END) AS micronutriment_1,
        MAX(CASE WHEN contenir.ID_MICRONUTRIMENT = 2 THEN contenir.RATIO ELSE 0 END) AS micronutriment_2,
        MAX(CASE WHEN contenir.ID_MICRONUTRIMENT = 3 THEN contenir.RATIO ELSE 0 END) AS micronutriment_3,
        MAX(CASE WHEN contenir.ID_MICRONUTRIMENT = 4 THEN contenir.RATIO ELSE 0 END) AS micronutriment_4,
        MAX(CASE WHEN contenir.ID_MICRONUTRIMENT = 5 THEN contenir.RATIO ELSE 0 END) AS micronutriment_5,
        MAX(CASE WHEN contenir.ID_MICRONUTRIMENT = 6 THEN contenir.RATIO ELSE 0 END) AS micronutriment_6,
        9*MAX(CASE WHEN contenir.ID_MICRONUTRIMENT = 2 THEN contenir.RATIO ELSE 0 END) +
        4*(MAX(CASE WHEN contenir.ID_MICRONUTRIMENT = 1 THEN contenir.RATIO ELSE 0 END) +
        MAX(CASE WHEN contenir.ID_MICRONUTRIMENT = 3 THEN contenir.RATIO ELSE 0 END)) AS calculKcal
        FROM manger
        JOIN contenir ON manger.ID_ALIMENT = contenir.ID_ALIMENT
        JOIN aliment ON manger.ID_ALIMENT = aliment.ID_ALIMENT
        JOIN utilisateur ON manger.LOGIN = utilisateur.LOGIN
        GROUP BY aliment.NOM, manger.QUANTITE, manger.DATE, utilisateur.LOGIN, aliment.ID_ALIMENT
        ORDER BY manger.DATE DESC
        ");
        $request->execute();
        $repas = $request->fetchAll(PDO::FETCH_ASSOC);
        return $repas;
    }

    function getRepasByLogin($login) {
        global $pdo;
        $request = $pdo->prepare("select * from manger where LOGIN = $login");
        $request->execute();
        $repas = $request->fetch(PDO::FETCH_ASSOC);
        return $repas;
    }

    function createRepas($login, $id_aliment, $quantite) {
        global $pdo;
        $request = $pdo->prepare("insert into manger (LOGIN, ID_ALIMENT, QUANTITE) values ('$login', '$id_aliment', '$quantite')");
        $result = $request->execute();
        if ($result) {
            $login = $pdo->lastInsertId();
            getRepasByLogin($login);
        } else {
            return false;
        }
    }

    function deleteRepasByLogin($login, $id_aliment) {
        global $pdo;
        $request = $pdo->prepare("DELETE from manger where LOGIN = '$login' AND ID_ALIMENT = '$id_aliment'");
        $result = $request->execute();
        return $result;
    }

    function updateRepasByLogin($login, $id_aliment, $quantite) {
        global $pdo;
        $request = $pdo->prepare("UPDATE manger SET QUANTITE = $quantite, ID_ALIMENT = $id_aliment WHERE LOGIN = '$login'");
        $result = $request->execute();
        return $result;
    }
?>