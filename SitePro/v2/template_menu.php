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
        $mymenu = array(
            'index' => array( 'Menu' ),
            'cv' => array( 'CV' ),
            'hobbies' => array( 'Hobbies' ),
            'projets' => array('Skills')
        );
        foreach($mymenu as $pageId => $pageParameters) {
            if $currentPageId==$pageId{
                
            }
            echo "...";
        }

    }
?>