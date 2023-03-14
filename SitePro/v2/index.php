<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="habillage.css">
    <!-- <meta http-equiv="refresh" content="1"> -->
</head>
<body>
<header>
    <h1 class="police">
        Camille Gourdier
    </h1>
</header>
<!--<div class="a_droite police">
    ?php 
        date_default_timezone_set('Europe/Paris');
        echo "Il est " . date('H:i:s'); 
    ?  il manque juste les <> aux points d'interrogation
</div>-->
<h3 class="police">
    Site Professionnel
</h3>
<?php
    require_once('template_menu.php');
    renderMenuToHTML('index');
?>
<?php
    require_once('template_footer.php');
?>