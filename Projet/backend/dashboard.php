<?php

    require_once('config.php');
    require_once('init_pdo.php');

    function getAllRepas() {
        global $pdo;
        $request = $pdo->prepare("SELECT utilisateur.LOGIN, aliment.ID_ALIMENT, aliment.NOM, manger.QUANTITE, manger.DATE, 
        (manger.QUANTITE)*MAX(CASE WHEN contenir.ID_MICRONUTRIMENT = 1 THEN contenir.RATIO ELSE 0 END) AS micronutriment_1,
        (manger.QUANTITE)*MAX(CASE WHEN contenir.ID_MICRONUTRIMENT = 2 THEN contenir.RATIO ELSE 0 END) AS micronutriment_2,
        (manger.QUANTITE)*MAX(CASE WHEN contenir.ID_MICRONUTRIMENT = 3 THEN contenir.RATIO ELSE 0 END) AS micronutriment_3,
        (manger.QUANTITE)*MAX(CASE WHEN contenir.ID_MICRONUTRIMENT = 4 THEN contenir.RATIO ELSE 0 END) AS micronutriment_4,
        (manger.QUANTITE)*MAX(CASE WHEN contenir.ID_MICRONUTRIMENT = 5 THEN contenir.RATIO ELSE 0 END) AS micronutriment_5,
        (manger.QUANTITE)*MAX(CASE WHEN contenir.ID_MICRONUTRIMENT = 6 THEN contenir.RATIO ELSE 0 END) AS micronutriment_6,
        (manger.QUANTITE)*(9*MAX(CASE WHEN contenir.ID_MICRONUTRIMENT = 2 THEN contenir.RATIO ELSE 0 END) +
        4*(MAX(CASE WHEN contenir.ID_MICRONUTRIMENT = 1 THEN contenir.RATIO ELSE 0 END) +
        MAX(CASE WHEN contenir.ID_MICRONUTRIMENT = 3 THEN contenir.RATIO ELSE 0 END))) AS calculKcal
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
        $request = $pdo->prepare("SELECT utilisateur.LOGIN, aliment.ID_ALIMENT, aliment.NOM, manger.QUANTITE, manger.DATE, 
        (manger.QUANTITE)*MAX(CASE WHEN contenir.ID_MICRONUTRIMENT = 1 THEN contenir.RATIO ELSE 0 END) AS micronutriment_1,
        (manger.QUANTITE)*MAX(CASE WHEN contenir.ID_MICRONUTRIMENT = 2 THEN contenir.RATIO ELSE 0 END) AS micronutriment_2,
        (manger.QUANTITE)*MAX(CASE WHEN contenir.ID_MICRONUTRIMENT = 3 THEN contenir.RATIO ELSE 0 END) AS micronutriment_3,
        (manger.QUANTITE)*MAX(CASE WHEN contenir.ID_MICRONUTRIMENT = 4 THEN contenir.RATIO ELSE 0 END) AS micronutriment_4,
        (manger.QUANTITE)*MAX(CASE WHEN contenir.ID_MICRONUTRIMENT = 5 THEN contenir.RATIO ELSE 0 END) AS micronutriment_5,
        (manger.QUANTITE)*MAX(CASE WHEN contenir.ID_MICRONUTRIMENT = 6 THEN contenir.RATIO ELSE 0 END) AS micronutriment_6,
        (manger.QUANTITE)*(9*MAX(CASE WHEN contenir.ID_MICRONUTRIMENT = 2 THEN contenir.RATIO ELSE 0 END) +
        4*(MAX(CASE WHEN contenir.ID_MICRONUTRIMENT = 1 THEN contenir.RATIO ELSE 0 END) +
        MAX(CASE WHEN contenir.ID_MICRONUTRIMENT = 3 THEN contenir.RATIO ELSE 0 END))) AS calculKcal
        FROM manger
        JOIN contenir ON manger.ID_ALIMENT = contenir.ID_ALIMENT
        JOIN aliment ON manger.ID_ALIMENT = aliment.ID_ALIMENT
        JOIN utilisateur ON manger.LOGIN = utilisateur.LOGIN
        WHERE utilisateur.LOGIN = '$login'
        GROUP BY aliment.NOM, manger.QUANTITE, manger.DATE, utilisateur.LOGIN, aliment.ID_ALIMENT
        ORDER BY manger.DATE DESC
        ");
        $request->execute();
        $repas = $request->fetchAll(PDO::FETCH_ASSOC);
        return $repas;
    }

    function createRepas($login, $id_aliment, $quantite, $date, $nom_aliment) {
        global $pdo;
        $request = $pdo->prepare("insert into manger (LOGIN, DATE, ID_ALIMENT, QUANTITE) values ('$login', '$date', '$id_aliment', '$quantite')");
        $result = $request->execute();
        if ($result && $request->rowCount() > 0) {
            return true;
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

    function updateRepasByLogin($login, $id_aliment, $quantite, $date) {
        global $pdo;
        $request = $pdo->prepare("UPDATE manger SET QUANTITE = $quantite, ID_ALIMENT = $id_aliment, DATE = $date WHERE LOGIN = '$login'");
        $result = $request->execute();
        return $result;
    }

    function getAllNameAliment() {
        global $pdo;
        $request = $pdo->prepare("SELECT aliment.NOM, aliment.ID_ALIMENT
        FROM aliment
        ORDER BY aliment.NOM ASC
        ");
        $request->execute();
        $repas = $request->fetchAll(PDO::FETCH_ASSOC);
        return $repas;
    }

    function calculBesoinsKcal($login){
        global $pdo;
        $request = $pdo->prepare("SELECT
        utilisateur.LOGIN,
        utilisateur.TAILLE,
        utilisateur.POIDS,
        ((tranche_age.AGE_MIN + tranche_age.AGE_MAX) / 2) AS AGE_MOYENNE,
        sexe.LIBELLE AS LIBELLE_SEXE,
        intensite_sport.LIBELLE AS LIBELLE_SPORT
        FROM
        utilisateur
        JOIN
        tranche_age ON utilisateur.ID_TRANCHE_AGE = tranche_age.ID_TRANCHE_AGE
        JOIN
        sexe ON utilisateur.ID_SEXE = sexe.ID_SEXE
        JOIN
        intensite_sport ON utilisateur.ID_SPORT = intensite_sport.ID_SPORT
        WHERE utilisateur.LOGIN = '$login';
        ");
        $request->execute();
        $besoins = $request->fetchAll(PDO::FETCH_ASSOC);
        return $besoins;
    }

    function besoinsApresRepas($login) {
        global $pdo;
        $request = $pdo->prepare("SELECT
        (manger.QUANTITE) *
        (
            9 * MAX(CASE WHEN contenir.ID_MICRONUTRIMENT = 2 THEN contenir.RATIO ELSE 0 END) +
            4 * (
                MAX(CASE WHEN contenir.ID_MICRONUTRIMENT = 1 THEN contenir.RATIO ELSE 0 END) +
                MAX(CASE WHEN contenir.ID_MICRONUTRIMENT = 3 THEN contenir.RATIO ELSE 0 END)
            )
        ) AS calculKcal
    FROM
        manger
    JOIN
        contenir ON manger.ID_ALIMENT = contenir.ID_ALIMENT
    JOIN
        aliment ON manger.ID_ALIMENT = aliment.ID_ALIMENT
    JOIN
        utilisateur ON manger.LOGIN = utilisateur.LOGIN
    WHERE
        utilisateur.LOGIN = '$login' AND
        manger.DATE = CURDATE()
    GROUP BY
        manger.ID_ALIMENT, manger.QUANTITE
    ORDER BY
        manger.QUANTITE DESC;");
        $request->execute();
        if ($request->rowCount() > 0) {
            $besoins = $request->fetchAll(PDO::FETCH_ASSOC);
            return $besoins;
        } else {
            $request = $pdo->prepare("SELECT RATIO AS calculKcal FROM contenir WHERE ID_ALIMENT = 1 AND ID_MICRONUTRIMENT = 6;");
            $request->execute();
            $besoins = $request->fetchAll(PDO::FETCH_ASSOC);
            return $besoins;
        }       
    }
?>