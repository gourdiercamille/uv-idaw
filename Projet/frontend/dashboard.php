<!DOCTYPE html>
<html>
<head>
    <title>Repas</title>
    <meta charset="utf8">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script>function menuDeroulantRepas() {
            $.ajax({
                url: URL_API + 'api_dashboard.php?menuDeroulant=1',
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    var select = document.createElement("select");
                    select.id = "nom_aliment-input";
                    select.name = "nom_aliment-input";
                    var option = document.createElement("option");
                    option.value = "";
                    option.text = "Sélectionnez un repas";
                    select.add(option);
                    response.forEach(function(item) {
                        var option = document.createElement("option");
                        option.value = item.NOM;
                        option.text = item.NOM;
                        option.setAttribute('data-id-aliment', item.ID_ALIMENT); // Stocker l'ID_ALIMENT comme attribut data
                        option.setAttribute('data-nom-aliment', item.NOM);
                        select.add(option);
                    });
                    document.getElementById("menu-deroulant-repas").appendChild(select);
                },
                error: function() {
                    // Si la requête échoue, on affiche une erreur
                    alert('Erreur lors de la récupération des repas');
                }
            });
    }
    </script>
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

    <script>let login = '<?php echo $_GET['login']; ?>';</script>
    <button onclick="window.location.href = 'profil.php?login=' + login">Voir mon profil</button>

    <h2>Ajouter un repas:</h2><br>

    <form id="add-form">

        <div id="menu-deroulant-repas"></div>

        <label for="quantite-input">Quantité:</label>
        <input type="text" id="quantite-input" name="quantite-input"><br>

        <label for="date-input">Date:</label>
        <input type="date" id="date-input" name="date-input"><br>

        <button type="submit">Ajouter</button>
    </form>

    <script>

        URL_API = "<?php require_once('config.php'); echo URL_API ; ?>";

        // Fonction pour récupérer la liste des repas via l'API
        function getRepas() {
            $.ajax({
                url: URL_API + 'api_dashboard.php?LOGIN=menu', 
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
                            // '<button class="btn btn-sm btn-primary edit-btn" data-LOGIN="' + item.LOGIN + '" data-ID_ALIMENT="' + item.ID_ALIMENT + '" data-DATE="' + item.DATE + '" data-QUANTITE="' + item.QUANTITE + '" onclick="toggleForm("edit_repas_form")">Modifier</button> ' +
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

        function getRepasByLogin(login) {
            $.ajax({
                url: URL_API + 'api_dashboard.php?LOGIN=' + login, 
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
                            // '<button class="btn btn-sm btn-primary edit-btn" data-LOGIN="' + item.LOGIN + '" data-ID_ALIMENT="' + item.ID_ALIMENT + '" data-DATE="' + item.DATE + '" data-QUANTITE="' + item.QUANTITE + '" onclick="toggleForm("edit_repas_form")">Modifier</button> ' +
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
        function addRepas(login, date, id_aliment, quantite, nom_aliment) {
            $.ajax({
                url: URL_API + 'api_dashboard.php?login=' + login, 
                type: 'POST',
                data: JSON.stringify({ LOGIN: login, DATE: date, ID_ALIMENT: id_aliment, QUANTITE: quantite, NOM: nom_aliment }),
                dataType: 'json',
                success: function(response) {
                    // Si la requête réussit, on met à jour le tableau des repas
                    getRepasByLogin(login);
                },
                error: function() {
                    // Si la requête échoue,
                    alert('Erreur lors de l\'ajout du repas');
                }
            });
        }
    // Fonction pour modifier un repas via l'API
    function editRepas(login, date, id_aliment, quantite) {
        $.ajax({
            url: URL_API + 'api_dashboard.php', 
            type: 'PUT',
            data: JSON.stringify({ LOGIN: login, DATE: date, ID_ALIMENT: id_aliment, QUANTITE: quantite }),
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
                getRepasByLogin(login);
            },
            error: function() {
                // Si la requête échoue, on affiche une erreur
                alert('Erreur lors de la suppression du repas');
            }
        });
    }
    // Fonction pour ajouter un aliment
    function addAliment(libelle, type_aliment, lipides, glucides, proteines, fibres, sel, vitamines) {
        $.ajax({
                url: URL_API + 'api_aliment.php', 
                type: 'POST',
                data: JSON.stringify({ LIBELLE: libelle, TYPE_ALIMENT: type_aliment, LIPIDES: lipides, GLUCIDES: glucides, PROTEINES: proteines, FIBRES: fibres, SEL: sel, VITAMINES: vitamines }),
                dataType: 'json',
                success: function(response) {
                    // Si la requête réussit, 
                    alert("Aliment ajouté avec succès !");
                },
                error: function() {
                    // Si la requête échoue,
                    alert('Erreur lors de l\'ajout de l\'aliment');
                }
            });
    }

    $(document).ready(function() {
        // Initialisation du tableau DataTable
        $('#myTable').DataTable();
        // Récupération de la liste des repas au chargement de la page
        var login = '<?php $login = isset($_GET['login']) ? $_GET['login'] : 'null'; echo htmlspecialchars($login, ENT_QUOTES, 'UTF-8'); ?>';
        if (login != 'null') {
            getRepasByLogin(login);
        }
        else {
            getRepas();
        }
        // Ajout d'un repas
        $('#add-form').submit(function(e) {
            e.preventDefault();
            var login = '<?php $login = isset($_GET['login']) ? $_GET['login'] : 'null'; echo htmlspecialchars($login, ENT_QUOTES, 'UTF-8'); ?>';
            var quantite = $('#quantite-input').val();
            var date = $('#date-input').val();
            var id_aliment = $(this).find('option:selected').data('id-aliment'); // Obtenir la valeur de data-id-aliment de l'option sélectionnée
            var nom_aliment = $(this).find('option:selected').data('nom-aliment');
            addRepas(login, date, id_aliment, quantite, nom_aliment);
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
        // Ajout d'un aliment
        $('#add-aliment-form').submit(function(e) {
            e.preventDefault();
            var libelle = $('#addAliment').val();
            var type_aliment = $('#type_aliment').val();
            var lipides = $('#quanLipide').val();
            var glucides = $('#quanGlucide').val();
            var proteines = $('#quanProteine').val();
            var fibres = $('#quanFibre').val();
            var sel = $('#quanSel').val();
            var vitamines = $('#quanVitamine').val();
            addAliment(libelle, type_aliment, lipides, glucides, proteines, fibres, sel, vitamines);
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

    menuDeroulantRepas();

</script>
        <!--Form d'ajout d'un aliment-->
        <button class="btn-add" onclick="toggleForm('add-aliment-form')">Ajouter un Aliment</button>
        <form id="add-aliment-form" method="POST" style="display:none;">
            <h2>Ajouter un aliment</h2>
            <table>
                <tr>
                    <th>Libellé :</th>
                    <td><input type="text" id="addAliment" name="addAliment" value=""></td>
                </tr><tr>
                    <th>Type d'Aliment:</th>
                    <td></label><select id="type_aliment" name="type_aliment">
                        <option value="1">Plat Composé</option>
                        <option value="2">Viande, Oeuf, Poisson, Fruit de Mer</option>
                        <option value="4">Fruit, Légume, Légumineuse</option>
                        <option value="7">Produit laitier</option>
                        <option value="8">Produit Céréalier</option>
                        <option value="9">Produit Sucré</option>
                        <option value="10">Boisson</option>
                    </select></td>
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
                    <th>Quantité de Vitamine :</th>
                    <td><input type="float" id="quanVitamine" name="quanVitamine" value=""></td>
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
                    <td><input type="submit" name="edit" value="Valider les Modifications"/></td> <!--onclick="toggleForm('edit_repas_form')"-->
                </tr>
            </table>
        </form>