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
        <button onclick="window.location.href='dashboard.php'">Retour</button>
        <script>
        URL_API = '<?php require_once('config.php'); echo URL_API_PROFIL; ?>';

        // Fonction pour récupérer les infos de l'utilisateur via l'API
        function getInfos() {
            $.ajax({
                url: URL_API , 
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    var user = JSON.parse(response);
                    var infos = {
                        nom : user.NOM,
                        prenom : user.PRENOM,
                        age : user.age,
                        sexe : user.sexe,
                        taille : user.TAILLE,
                        poids : user.POIDS,
                        sport : user.sport,
                    };
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
                "<li>Nom : " + user.nom + "</li>" +
                "<li>Prénom : " + user.prenom + "</li>" +
                "<li>Tranche d'âge : " + user.age + "</li>" +
                "<li>Sexe : " + user.sexe + "</li>" +
                "<li>Taille : " + user.taille + "</li>" +
                "<li>Poids : " + user.poids + "</li>" +
                "<li>Sport : " + user.sport + "</li>"
            );
        }

        // Fonction pour modifier les infos de l'utilisateur via l'API
        function editUser(login, age, sport, poids, taille) {
            $.ajax({
                url: URL_API, 
                type: 'PUT',
                data: JSON.stringify({  login: login, age: age, sport: sport, poids: poids, taille: taille }),
                dataType: 'json',
                success: function(response) {
                    // Si la requête réussit, on récupère les nouvelles donées de l'utilisateur et on les affiche
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
            <h3> Informations </h3>
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
                            <td><input type="text" id="editPoids" name="editlogin" value=""></td>
                        </tr><tr>
                            <th>Taille :</th>
                            <td><input type="email" id="editTaille" name="editemail" value=""></td>
                        </tr><tr>
                            <th></th>
                            <td><input type="submit" name="edit" value="Valider les Modifications" onclick="toggleForm()"/></td>
                        </tr>
                    </table>
                </form>
        </div>
    </body>
</html>