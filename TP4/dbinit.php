<?php
    $sql = "DROP TABLE Users";
    $pdo->exec($sql);

    $createDB = file_getcontents('createDB.sql')
    $pdo->exec($createDB);
?>