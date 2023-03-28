

<?php

require_once('init_pdo.php');

try {
    // Connexion à la base de données
    $pdo = new PDO($connectionString,_MYSQL_USER,_MYSQL_PASSWORD,$options);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Suppression de toutes les tables de la base de données
    $pdo->exec("SET FOREIGN_KEY_CHECKS = 0");
    $stmt = $pdo->query("SHOW TABLES");
    while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
        $pdo->exec("DROP TABLE IF EXISTS $row[0]");
    }
    $pdo->exec( "SET FOREIGN_KEY_CHECKS = 1");

    // Importation de la structure et des données de test
    $sql = file_get_contents('projet_idaw.sql');
    $pdo->exec($sql);

} 
catch (PDOException $erreur) {
    echo "Erreur : " . $erreur->getMessage();
}

?>