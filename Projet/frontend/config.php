<?php

    if($_SERVER['DOCUMENT_ROOT'] == '/Applications/MAMP/htdocs') {
        //for ben
        define('URL_API','http://localhost:8888/IDAW_PROJET/Projet/backend/');
        }

    else if($_SERVER['SERVER_NAME']=='io') {
        // for prof
        define('URL_API', '');
    }
    
    else {
        // for cam
        define('URL_API','http://localhost/IDAW/Projet/backend/');
    }
    

    
