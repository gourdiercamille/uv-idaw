<?php
    if($_ENV['SERVER_NAME']='io') {
        // for prof
        define('URL_API', '');
    }

    if($_ENV['DOCUMENT_ROOT']= '/Applications/MAMP/htdocs') {
        // param de la machine ben
        define('URL_API','http://localhost:8888/IDAW_PROJET/Projet/backend/');
    }
    
    if($_ENV['USERNAME']='ORDI_CAMILLE$ ') {
        // param de la machine cam
        define('URL_API','http://localhost/IDAW_PROJET/Projet/backend/');
    }
?>
    
