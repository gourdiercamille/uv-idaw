<!DOCTYPE html>
<html>
<head>
    <title>Repas</title>
    <meta charset="utf8">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
</head>
<body>
    <div class="container">
        <h1>Liste des repas</h1>
        <table id="myTable" class="table table-striped">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Repas</th>
                    <th>Quantité</th>
                    <th>Quantité de glucides</th>
                    <th>Quantité de lipides</th>
                    <th>Quantité de protéïnes</th>
                    <th>Quantité de fibres</th>
                    <th>Quantité de sel</th>
                    <th>Quantité de vitamines</th>
                    <th>Kcal ingérées</th>
                    <th>Pour la suite...</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>

    <button type="submit">Voir mon profil</button>

    <h2>Ajouter un repas:</h2><br>

    <form id="add-form">
        <label for="login-input">Login du mangeur:</label>
        <input type="text" id="login-input" name="login-input"><br>

        <label for="id_aliment-input">ID de l'aliment:</label>
        <input type="text" id="id_aliment-input" name="id_aliment-input"><br>

        <label for="quantite-input">Quantité:</label>
        <input type="text" id="quantite-input" name="quantite-input"><br>

        <label for="date-input">Date:</label>
        <input type="text" id="date-input" name="date-input"><br>

        <button type="submit">Ajouter</button>
    </form>


    <script>
        URL_API = "<?php require_once('config.php'); echo URL_API ; ?>";
        // Fonction pour récupérer la liste des repas via l'API
        function getRepas() {
            $.ajax({
                url: URL_API + 'api_dashboard.php', 
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    // Si la requête réussit, on met à jour le tableau des repas
                    var table = $('#myTable').DataTable();
                    table.clear();
                    $.each(response, function(i, item) {
                        table.row.add([
                            item.DATE,
                            item.NOM,
                            item.QUANTITE,
                            item.micronutriment_1,
                            item.micronutriment_2,
                            item.micronutriment_3,
                            item.micronutriment_4,
                            item.micronutriment_5,
                            item.micronutriment_6,
                            item.calculKcal,
                            '<button class="btn btn-sm btn-primary edit-btn" data-LOGIN="' + item.LOGIN + '" data-ID_ALIMENT="' + item.ID_ALIMENT + '" data-DATE="' + item.DATE + '" data-QUANTITE="' + item.QUANTITE + '" onclick="toggleForm()">Modifier</button> ' +
                            '<button class="btn btn-sm btn-danger delete-btn" data-LOGIN="' + item.LOGIN + '" data-ID_ALIMENT="' + item.ID_ALIMENT + '" data-DATE="' + item.DATE + '" data-QUANTITE="' + item.QUANTITE + '">Supprimer</button>'
                        ]).draw();
                    });
                },
                error: function() {
                    // Si la requête échoue, on affiche une erreur
                    alert('Erreur lors de la récupération des repas');
                }
            });
        }
        // Fonction pour ajouter un repas via l'API
        function addRepas(login, date, id_aliment, quantite) {
            $.ajax({
                url: URL_API + 'api_dashboard.php', 
                type: 'POST',
                data: JSON.stringify({ LOGIN: login, DATE: date, ID_ALIMENT: id_aliment, QUANTITE: quantite }),
                dataType: 'json',
                success: function(response) {
                    // Si la requête réussit, on met à jour le tableau des repas
                    getRepas();
                },
                error: function() {
                    // Si la requête échoue,
                    alert('Erreur lors de l\'ajout du repas');
            }
        });
    }
    // Fonction pour modifier un repas via l'API
    function editRepas(date, id_aliment, quantite) {
        $.ajax({
            url: URL_API + 'api_dashboard.php', 
            type: 'PUT',
            data: JSON.stringify({ DATE: date, ID_ALIMENT: id_aliment, QUANTITE: quantite }),
            dataType: 'json',
            success: function(response) {
                // Si la requête réussit, on met à jour le tableau des repas
                getRepas();
            },
            error: function() {
                // Si la requête échoue, on affiche une erreur
                alert('Erreur lors de la modification du repas');
            }
        });
    }
    // Fonction pour supprimer un repas via l'API
    function deleteRepas(login, id_aliment) {
        $.ajax({
            url: URL_API + 'api_dashboard.php' + '?LOGIN=' + login + '&ID_ALIMENT=' + id_aliment, // URL de l'API avec le login de l'utilisateur et l'id de l'aliment à supprimer
            type: 'DELETE',
            dataType: 'json',
            success: function(response) {
                // Si la requête réussit, on met à jour le tableau des repas
                getRepas();
            },
            error: function() {
                // Si la requête échoue, on affiche une erreur
                alert('Erreur lors de la suppression du repas');
            }
        });
    }
    $(document).ready(function() {
        // Initialisation du tableau DataTable
        $('#myTable').DataTable();
        // Récupération de la liste des repas au chargement de la page
        getRepas();
        // Ajout d'un repas
        $('#add-form').submit(function(e) {
            e.preventDefault();
            var login = $('#login-input').val();
            var id_aliment = $('#id_aliment-input').val();
            var quantite = $('#quantite-input').val();
            var date = $('#date-input').val();
            addRepas(login, date, id_aliment, quantite);
        });
        // Modification d'un repas
        $('#myTable tbody').on('click', '.edit-btn', function(e) {
            e.preventDefault();
            var login = $(this).data('login');
            var date = $('#editDate').val();
            var id_aliment = $('#editRepas').val();;
            var quantite = $('#editQuantite').val();
            editRepas(date, id_aliment, quantite);
        });
        // Suppression d'un repas
        $('#myTable tbody').on('click', '.delete-btn', function() {
        var login = $(this).data('login');
        var id_aliment = $(this).data('id_aliment');
        if (confirm('Voulez-vous vraiment supprimer ce repas ?')) {
            deleteRepas(login, id_aliment);
        }
        });

    });

    function toggleForm(form) {
        var form = document.getElementById(form);
        if (form.style.display === "none") {
            form.style.display = "block";
        } else {
            form.style.display = "none";
        }
    }
</script>
        <!--Form d'ajout d'un aliment-->
        <button class="btn-add" onclick="toggleForm('add-aliment-form')">Ajouter un Aliment</button>
        <form id="add-aliment-form" method="POST" style="display:none;">
            <fieldset>
                <legend>Ajouter un Aliment</legend>
            </fieldset>
            <table>
                <tr>
                    <th>Libellé :</th>
                    <td><input type="text" id="addAliment" name="addAliment" value=""></td>
                </tr><tr>
                    <th>Quantité de Lipide :</th>
                    <td><input type="float" id="quanLipide" name="quanLipide" value=""></td>
                </tr><tr>
                    <th>Quantité de Glucide :</th>
                    <td><input type="float" id="quanGlucide" name="quanGlucide" value=""></td>
                </tr><tr>
                    <th>Quantité de Protéine :</th>
                    <td><input type="float" id="quanProteine" name="quanProteine" value=""></td>
                </tr><tr>
                    <th>Quantité de Fibre :</th>
                    <td><input type="float" id="quanFibre" name="quanFibre" value=""></td>
                </tr><tr>
                    <th>Quantité de Sel :</th>
                    <td><input type="float" id="quanSel" name="quanSel" value=""></td>
                </tr><tr>
                    <th>Quantité de Vitamines :</th>
                    <td><input type="float" id="quanVitamines" name="quanVitamines" value=""></td>
                </tr><tr>
                    <th></th>
                    <td><input type="submit" name="edit" value="Ajouter cet Aliment" onclick="toggleForm('add-aliment-form')"/></td>
                </tr>
            </table>
        </form>

        <!--Form de modif d'un repas-->
        <form id="edit_repas_form" method="PUT" style="display:none;">
            <fieldset>
                <legend>Modifier un repas</legend>
            </fieldset>
            <table>
                <tr>
                    <th>Date :</th>
                    <td><input type="date" id="editDate" name="editDate" value=""></td>
                </tr><tr>
                    <th>Repas :</th>
                    <td><input type="text" id="editRepas" name="editRepas" value=""></td>
                </tr><tr>
                    <th>Quantité :</th>
                    <td><input type="float" id="editQuantite" name="editQuantite" value=""></td>
                </tr><tr>
                    <th></th>
                    <td><input type="submit" name="edit" value="Valider les Modifications" onclick="toggleForm('edit_repas_form')"/></td>
                </tr>
            </table>
        </form>




</body>
</html>


