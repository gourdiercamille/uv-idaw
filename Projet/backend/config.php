<?php

    if($_ENV['DOCUMENT_ROOT']= '/Applications/MAMP/htdocs') {
        // param de la machine ben
            define('_MYSQL_HOST','127.0.0.1'); 
            define('_MYSQL_PORT',8889); 
            define('_MYSQL_DBNAME','projet_idaw');
            define('_MYSQL_USER','root');
            define('_MYSQL_PASSWORD','root'); 
        }

    else if($_ENV['USERNAME']='ORDI_CAMILLE$ ') {
        // param de la machine cam
            define('_MYSQL_HOST','127.0.0.1');
            define('_MYSQL_PORT', 3306);
            define('_MYSQL_DBNAME','projet_idaw');
            define('_MYSQL_USER','root');
            define('_MYSQL_PASSWORD','');
    }
    
    else if($_ENV['SERVER_NAME']='io') {
        // param de la machine prof
            define('_MYSQL_HOST','mysql');
            define('_MYSQL_PORT',3306);
            define('_MYSQL_DBNAME','FABRESSE-Luc');
            define('_MYSQL_USER','root');
            define('_MYSQL_PASSWORD','root');
    }
?>