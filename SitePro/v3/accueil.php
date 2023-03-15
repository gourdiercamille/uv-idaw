<?php
    require_once('template_header.php');
?>
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
    renderMenuToHTML('accueil');
    require_once('template_footer.php');
?>