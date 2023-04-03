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
    <button onclick="window.location.href='profil.php'">Voir Profil</button>

    <script>
        URL_API = "<?php require_once('config.php'); echo URL_API ; ?>";
        // Fonction pour récupérer la liste des repas via l'API
        function getRepas() {
            $.ajax({
                url: URL_API , 
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
                            item.micronutriment_1,
                            item.micronutriment_2,
                            item.micronutriment_3,
                            item.micronutriment_4,
                            item.micronutriment_5,
                            item.micronutriment_6,
                            item.calculKcal,
                            '<button class="btn btn-sm btn-primary edit-btn" data-id="' + item.ID_ALIMENT + '">Modifier</button> ' +
                            '<button class="btn btn-sm btn-danger delete-btn" data-id="' + item.ID_ALIMENT + '">Supprimer</button>'
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
        function addRepas(date, id_aliment, quantite) {
            $.ajax({
                url: URL_API, 
                type: 'POST',
                data: { DATE: date, ID_ALIMENT: id_aliment, QUANTITE: quantite },
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
    function editUser(date, id_aliment, quantite) {
        $.ajax({
            url: URL_API, 
            type: 'PUT',
            data: JSON.stringify({ DATE : date, ID_ALIMENT: id_aliment, QUANTITE: quantite }),
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
            url: URL_API + '?LOGIN=' + login + '&ID_ALIMENT=' + id_aliment, // URL de l'API avec le login de l'utilisateur et l'id de l'aliment à supprimer
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
            addRepas(date, id_aliment, quantite);
        });
        // Modification d'un repas
        $('#myTable tbody').on('click', '.edit-btn', function() {
            var login = $(this).data('login');
            var id_aliment = prompt('Entrez le nouvel aliment :');
            var quantité = prompt('Entrez la nouvelle quantité :');
            editUser(login, id_aliment, quantite);
        });
        // Suppression d'un repas
        $('#myTable tbody').on('click', '.delete-btn', function() {
            console.log($(this).data);
            var login = $(this).data('login');
            var id_aliment = $(this).data('id_aliment');
            if (confirm('Voulez-vous vraiment supprimer ce repas ?')) {
                deleteRepas(login, id_aliment);
            }
        });
    });
</script>


