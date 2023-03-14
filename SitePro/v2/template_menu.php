<nav class="menu">
    <ul>
        <li><a href="index.php" class="police">Menu</a></li>
        <li><a href="cv.php" class="police">CV</a></li>
        <li><a href="hobbies.php" class="police">Hobbies</a></li>
        <li><a href="projets.php" class="police">Skills</a></li>
    </ul>
</nav>

<?php
        function renderMenuToHTML($currentPageId) {
            echo '<nav class="menu rouge"><ul>';
            $mymenu = array(
                // idPage titre
                'index' => array('Menu'),
                'cv' => array('Cv'),
                'projets' => array('Skills'),
                'hobbies' => array('Hobbies')
            );
        
            foreach($mymenu as $pageId => $pageParameters) {
                // Vérifie si la page en cours correspond à l'ID de la page en cours de la boucle.
                if ($pageId == $currentPageId) {
                    // Si c'est le cas, on ajoute l'identifiant "currentPage" à l'élément <a>.
                    echo '<a id="currentPage" href="' . $pageId . '.php">' . $pageParameters[0] . '</a><br>';
                } else {
                    // Sinon, on génère un lien normal.
                    echo '<a href="' . $pageId . '.php">' . $pageParameters[0] . '</a><br>';
                }
            }
            echo"</ul></nav>";
        } 
?>