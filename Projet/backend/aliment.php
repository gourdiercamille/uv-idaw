<?php
    require_once('config.php');
    require_once('init_pdo.php');


    function createAliment($nom, $type, $lipides, $glucides, $prot, $fibres, $sel, $vitamines) {
        global $pdo;
        $kcal100g = $lipides*9 + $glucides*4 + $prot*4;
        $request = $pdo->prepare("INSERT INTO aliment (NOM, ID_TYPE_ALIMENT, KCALORIES_100G) VALUES (?, ?, ?)");
        $request->execute([$nom, $type, $kcal100g]);
        if($request->rowCount() > 0) {
            // Insertion réussie, continuer avec les autres requêtes
            $id_aliment = $pdo->lastInsertId();
            $request2 = $pdo->prepare("INSERT INTO contenir (ID_ALIMENT, ID_MICRONUTRIMENT, RATIO) VALUES (?, ?, ?)");
            $request2->execute([$id_aliment, 1, $lipides]);
            $request2->execute([$id_aliment, 2, $glucides]);
            $request2->execute([$id_aliment, 3, $prot]);
            $request2->execute([$id_aliment, 4, $fibres]);
            $request2->execute([$id_aliment, 5, $sel]);
            $request2->execute([$id_aliment, 6, $vitamines]);
            return true;
        } else {
            // Insertion échouée, retourner une valeur ou afficher un message d'erreur
            return false;
        }
    }

    function getAllAliments() {
        global $pdo;
        $request = $pdo->prepare("SELECT * FROM aliment");
        $request->execute();
        $aliments = $request->fetchAll(PDO::FETCH_ASSOC);
        return $aliments;
    }