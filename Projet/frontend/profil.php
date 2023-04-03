<!DOCTYPE html>
<html>
    <header>
        <title>Profil</title>
        <meta charset="utf8">
        <link rel="stylesheet" href="style.css" type="text/css" media="screen" title="default" charset="utf-8" />
    </header>
    <body>
        <h1>Profil Utilisateur</h1>
        <button onclick="window.location.href='dashboard.php'">Retour</button>
        <script>
        URL_API = <?php require_once('config.php'); echo URL_API_PROFIL ; ?>;
        // Fonction pour récupérer les infos de l'utilisateur via l'API
        function getInfos() {
            $.ajax({
                url: $url_api , 
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    var user = JSON.parse(response);
                    var infos = {
                        nom: user.NOM,
                        prenom: user.PRENOM,
                        age: user.AGE,
                        sexe: user.sexe,
                        taille: user.TAILLE,
                        poids: user.POIDS,
                        sport: user.sport,
                    };
                },
                error: function() {
                    // Si la requête échoue, on affiche une erreur
                    alert('Erreur lors de la récupération des informations');
                }
            });
        }

        // Fonction pour afficher les infos de l'utilisateur
        function showUserInfos(user) {
            $("li:nth-child(1)").text("Nom : " + user.nom );
            $("li:nth-child(2)").text("Prénom : " + user.prenom );                
            $("li:nth-child(3)").text("Tranche d'âge : " + user.age );
            $("li:nth-child(4)").text("Sexe : " + user.sexe );
            $("li:nth-child(5)").text("Taille : " + user.taille );
            $("li:nth-child(6)").text("Poids : " + user.poids );
            $("li:nth-child(7)").text("Sport : " + user.sport );
        }

        // Fonction pour modifier les infos de l'utilisateur via l'API
        function editUser(login, tranche_age, intensite_sport, poids, taille) {
            $.ajax({
                url: URL_API, 
                type: 'PUT',
                data: JSON.stringify({ /*id : id, login: login, email: email*/ }),
                dataType: 'json',
                success: function(response) {
                    // Si la requête réussit, on récupère les nouvelles donées de l'utilisateur et on les affiche
                    getInfos();
                    showUserInfos(infos);
                },
                error: function() {
                    // Si la requête échoue, on affiche une erreur
                    alert('Erreur lors de la modification de l\'utilisateur');
                }
            });
        }

        //On appelle les fonctions
        $(document).ready(function() {
            // On récupère les utilisateurs
            getInfos();
            // On affiche les utilisateurs
            showUserInfos(infos);
            // On modifie les infos de l'utilisateur
            $('#edit_form').on('click', '.edit', function() {
                var login = $(this).data('login');
                var tranche_age = ;
                var intensite_sport = ;
                var poids = ;
                var taille = ;
                editUser(login, tranche_age, intensite_sport, poids, taille);
            });
        });

        </script>
        <div>
            <h3> Informations </h3>
            <ul>
                <script> showUserInfos(infos); </script>
                <button class="btn-edit">Edit</button>
                <form id="edit_form" method="POST">
                    <table>
                        <tr>
                            <th>Age :</th>
                            <td></label><select id="sexe" name="sexe"><option value="1">Femme</option><option value="2">Homme</option><option value="3">Ne souhaite pas répondre</option></select></td>
                        </tr><tr>
                            <th>Intensité de Pratique Sportive :</th>
                            <td></label><select id="sexe" name="sexe"><option value="1">Faible</option><option value="2">Modérée</option><option value="3">Elevée</option></select></td>
                        </tr><tr>
                            <th>Poids :</th>
                            <td><input type="text" id="editpoids" name="editlogin" value=></td>
                        </tr><tr>
                            <th>Taille :</th>
                            <td><input type="email" id="editemail" name="editemail" value=></td>
                        </tr><tr>
                            <th></th>
                            <td><input type="submit" name="edit" value="Valider les Modifications" /></td>
                        </tr>
                    </table>
                </form>
            </ul>
        </div>
    </body>
</html>