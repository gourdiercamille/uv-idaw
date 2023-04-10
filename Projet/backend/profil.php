<?php
        //session_start();
        //if (!isset($_SESSION['login'])) {
            //header('Location: index.php');
        //}

        require_once('config.php');
        require_once('init_pdo.php');

        function getUserByLogin($login) {
            global $pdo;
            $request = $pdo->prepare("select * from utilisateur where LOGIN = '$login'");
            $request->execute();
            $user = $request->fetch(PDO::FETCH_ASSOC);
            return $user;
        }

        function getInfosUser($login, $categorie) {
            global $pdo;
            $user = getUserByLogin($login);
            if ($categorie == 'age') {
                $request1 = $pdo->prepare("select AGE_MIN from tranche_age where ID_TRANCHE_AGE = " . $user['ID_TRANCHE_AGE']);
                $request1->execute();
                $age_min = $request1->fetch(PDO::FETCH_ASSOC);
                $request2 = $pdo->prepare("select AGE_MAX from tranche_age where ID_TRANCHE_AGE = " .$user['ID_TRANCHE_AGE']);
                $request2->execute();
                $age_max = $request2->fetch(PDO::FETCH_ASSOC);
                return $age_min['AGE_MIN'] . ' - ' . $age_max['AGE_MAX'] . ' ans';
            }
            if ($categorie == 'sexe') {
                $request = $pdo->prepare("select LIBELLE from sexe where ID_SEXE = " . $user['ID_SEXE']);
                $request->execute();
                $sexe = $request->fetch(PDO::FETCH_ASSOC);
                return $sexe['LIBELLE'];
            }
            if ($categorie == 'sport') {
                $request = $pdo->prepare("select LIBELLE from intensite_sport where ID_SPORT = " . $user['ID_SPORT']);
                $request->execute();
                $sport = $request->fetch(PDO::FETCH_ASSOC);
                return $sport['LIBELLE'];
            }
        }

        // function updateUserByLogin($login, $age, $sport, $poids, $taille) {
        //     global $pdo;
        //     $request = $pdo->prepare("update utilisateur set ID_TRANCHE_AGE = '$age' , ID_SPORT = '$sport' , POIDS = '$poids' , TAILLE = '$taille' where LOGIN = $login");
        //     $result = $request->execute();
        //     return $result;
        // }

        // function updateUserByLogin($login, $age, $sport, $poids, $taille) {
        //     global $pdo;
        //     $request = $pdo->prepare("UPDATE utilisateur SET ID_TRANCHE_AGE = $age , ID_SPORT = $sport, POIDS = $poids, TAILLE = $taille WHERE LOGIN = '$login'");
        //     $request->execute();
        // }

        function updateUserByLogin($login, $age, $sport, $poids, $taille) {
            global $pdo;
            $request = $pdo->prepare("UPDATE utilisateur SET ID_TRANCHE_AGE = $age, ID_SPORT = $sport, POIDS = $poids, TAILLE = $taille WHERE login = '$login'");
            $request->execute();
        }
?>