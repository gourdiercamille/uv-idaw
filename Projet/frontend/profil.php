<!DOCTYPE html>
<html>
    <header>
        <title>Profil</title>
        <meta charset="utf8">
        <link rel="stylesheet" type="text/css" media="screen" title="default" charset="utf-8" />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    </header>
    <body>
        <h1>Profil Utilisateur</h1>
        <h3> Informations </h3>
        <button onclick="window.location.href='dashboard.php?login='+ login">Retour</button>
        <script>
        URL_API = '<?php require_once('config.php'); echo URL_API; ?>';
        let login = '<?php echo $_GET['login']; ?>';

        // Fonction pour récupérer les infos de l'utilisateur via l'API
        function getInfos() {
            $.ajax({
                url: URL_API + 'api_profil.php'+ '?login='+login, 
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    console.log(response);
                    var user = response;
                    console.log(user);
                    var infos = {
                        nom : user.NOM,
                        prenom : user.PRENOM,
                        age : user.ID_TRANCHE_AGE,
                        sexe : user.ID_SEXE,
                        taille : user.TAILLE,
                        poids : user.POIDS,
                        sport : user.ID_SPORT,
                    };
                    console.log(infos);
                    console.log(infos.nom);
                    showUserInfos(infos);
                },
                error: function() {
                    // Si la requête échoue, on affiche une erreur
                    alert('Erreur lors de la récupération des informations');
                }
            });
        }

        // Fonction pour afficher les infos de l'utilisateur
        function showUserInfos(user) {
            $("ul").html(
                </script>
                <li>Nom : user.NOM  </li>
                <li>Prénom :   user.PRENOM  </li>
                <li>Tranche d'âge : user.ID_TRANCHE_AGE </li>
                <li>Sexe :  user.ID_SEXE </li>
                <li>Taille : user.TAILLE  cm</li>
                <li>Poids :  user.POIDS  kg</li>
                <li>Intensité Sportive Pratiquée :  user.ID_SPORT </li>
                <script>
            );
        }

        // Fonction pour modifier les infos de l'utilisateur via l'API
        function editUser(login, age, sport, poids, taille) {
            $.ajax({
                url: URL_API + 'api_profil.php', 
                type: 'PUT',
                data: JSON.stringify({  login: login, age: age, sport: sport, poids: poids, taille: taille }),
                dataType: 'json',
                success: function(response) {
                    // Si la requête réussit, on récupère les nouvelles données de l'utilisateur et on les affiche
                    getInfos();
                },
                error: function() {
                    // Si la requête échoue, on affiche une erreur
                    alert('Erreur lors de la modification de l\'utilisateur');
                }
            });
        }

        //On appelle les fonctions
        $(document).ready(function() {
            // On récupère les infos de l'utilisateur
            getInfos();
            // On modifie les infos de l'utilisateur
            $('#edit_form').on('click', '.edit', function() {
                var login = $(this).data('login');
                var age = $('#editAge').val();
                var sport = $('#editSport').val();
                var poids = $('#editPoids').val();
                var taille = $('#editTaille').val();
                editUser(login, age, sport, poids, taille);
                getInfos();
            });
        });
        
        
        function toggleForm() {
                var form = document.getElementById("edit_form");
                if (form.style.display === "none") {
                    form.style.display = "block";
                } else {
                    form.style.display = "none";
                }
        }

        </script>
        <div>
                <button class="btn-edit" onclick="toggleForm()">Edit</button>
                <form id="edit_form" method="POST" style="display:none;">
                    <table>
                        <tr>
                            <th>Age :</th>
                            <td></label><select id="editAge" name="sexe">
                                <option value="1">18-25ans</option>
                                <option value="2">26-40ans</option>
                                <option value="3">41-60ans</option>
                                <option value="4">61-80ans</option>
                            </select></td>
                        </tr><tr>
                            <th>Intensité de Pratique Sportive :</th>
                            <td></label><select id="editSport" name="sexe">
                                <option value="1">Faible</option>
                                <option value="2">Modérée</option>
                                <option value="3">Elevée</option>
                            </select></td>
                        </tr><tr>
                            <th>Poids :</th>
                            <td><input type="text" id="editPoids" name="editPoids" value=""></td>
                        </tr><tr>
                            <th>Taille :</th>
                            <td><input type="email" id="editTaille" name="editTaille" value=""></td>
                        </tr><tr>
                            <th></th>
                            <td><input type="submit" name="edit" value="Valider les Modifications" onclick="toggleForm()"/></td>
                        </tr>
                    </table>
                </form>
        </div>
    </body>
</html>