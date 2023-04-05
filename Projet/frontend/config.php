<?php

    if($_ENV['DOCUMENT_ROOT']= '/Applications/MAMP/htdocs') {
        // param de la machine ben
        define('URLAPI','http://localhost:8888/IDAW_PROJET/Projet/backend/');
    }
    
    else if($_ENV['USERNAME']='ORDI_CAMILLE$ ') {
        // param de la machine cam
        define('URLAPI','http://localhost/IDAW_PROJET/Projet/backend/');
    }

    else if($_ENV['SERVER_NAME']='io') {
        // for prof
        define('URLAPI', '');
    }
?>
    
