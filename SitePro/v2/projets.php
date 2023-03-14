<?php
    require_once('template_header.php');
?>
<?php
    require_once('template_menu.php');
    renderMenuToHTML('projets');
?>
    <header>
        <h1 class="police"> Compétences</h1>
    </header>
        <div class="conteneur-flexible">
        <h4 class="police"> Langages informatiques </h4> 
        <pre class="police">
            Python                     Niveau Confirmé 
            SQL                        Niveau Débutant 
            Java                       Niveau Débutant 
            Dart/Flutter               Niveau Débutant 
            Swift                      Niveau Débutant 
            HTML/CSS/PHP               Niveau Débutant
            Javascript, C              Niveau Découverte
        </pre>
        </div>
        <div class="pause"></div>
        <div class="conteneur-flexible">
        <h4 class="police"> Compétences humaines </h4> 
        <pre class="police">
            Travail en équipe
            Communication
            Sens de l'effort
            A l'aise dans les relations clients
            Sens des responsabilités
        </pre>
        </div>
<?php
    require_once('template_footer.php');
?>