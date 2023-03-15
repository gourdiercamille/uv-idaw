
<?php
        function renderMenuToHTML($currentPageId) {
            echo '<nav class="menu"><ul>';
            $mymenu = array(
                // idPage titre
                'accueil' => array('Accueil'),
                'cv' => array('CV'),
                'projets' => array('Skills'),
                'hobbies' => array('Hobbies')
            );
        
            foreach($mymenu as $pageId => $pageParameters) {
                // Vérifie si la page en cours correspond à l'ID de la page en cours de la boucle.
                if ($pageId == $currentPageId) {
                    // Si c'est le cas, on ajoute l'identifiant "currentPage" à l'élément <a>.
                    echo '<li><a id="currentPage" href="index.php?page=' . $pageId . '">' . $pageParameters[0] . '</a></li>';
                } else {
                    // Sinon, on génère un lien normal.
                    echo '<li><a href="index.php?page=' . $pageId . '">' . $pageParameters[0] . '</a></li>';
                }
            }
            echo"</ul></nav>";
        } 
?>