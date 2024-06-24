<?php
include '../../db/connexion.php';  // Connexion à la base de données 

// Récupérer les ressources 
$sqlRessources = "SELECT * FROM ressouce";
$resultRessources = $conn->query($sqlRessources);
if (!$resultRessources) {
    die("Erreur de requête: " . $conn->error);
}

$ressources = [];
while ($row = $resultRessources->fetch_assoc()) {
    $ressources[] = $row;
}

// Récupérer les workorders 
$sqlWorkorders = "SELECT * FROM workorders";
$resultWorkorders = $conn->query($sqlWorkorders);
if (!$resultWorkorders) {
    die("Erreur de requête: " . $conn->error);
}

$workorders = [];
while ($row = $resultWorkorders->fetch_assoc()) {
    $workorders[] = $row;
}

// Récupérer les affectations par workorder
$sqlAffectations = "SELECT w.id as workorder_id, w.WorkOrderNumber, GROUP_CONCAT(r.nameressource SEPARATOR ', ') AS ressources
                    FROM affectation a
                    JOIN workorders w ON w.id = a.WorkOrderID
                    JOIN ressouce r ON r.id = a.RessourceID
                    GROUP BY w.id, w.WorkOrderNumber";

$resultAffectations = $conn->query($sqlAffectations);
if (!$resultAffectations) {
    die("Erreur de requête: " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Webkit | Affectation</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-beta.1/css/select2.min.css">
    <link rel="stylesheet" href="../../assets/css/backend-plugin.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

    <!-- Include DataTables -->
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <link rel="stylesheet" href="../../assets/css/backend-plugin.min.css">
    <link rel="stylesheet" href="../../assets/css/backend.css?v=1.0.0">
    <link rel="stylesheet" href="../../assets/css/style.css">
    <script src="../../assets/js/backend-bundle.min.js"></script>

</head>

<body>
    <div class="wrapper">
        <!-- SIDEBAR -->
        <?php include '../../frames/sidebar_frame.php'; ?>
        <!-- TOPBAR -->
        <?php include '../../frames/topbar_frame.php'; ?>

        <div class="content-page mt-5">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="header-title"></div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="actionsTable" class="table data-table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>WorkOrderNumber</th>
                                                <th>Ressources</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php while ($row = $resultAffectations->fetch_assoc()) : ?>
                                                <tr data-workorder-id="<?php echo $row['workorder_id']; ?>">
                                                    <td>
                                                        <?php echo htmlspecialchars($row['WorkOrderNumber']); ?>
                                                    </td>
                                                    <td class="ressource-select">
                                                        <?php echo htmlspecialchars($row['ressources']); ?>
                                                        <button class="plus-btns btn btn-sm px-0 py-0"><i class="fas fa-plus"></i></button>
                                                        <!--button plus -->
                                                    </td>
                                                    <td>
                                                        <button class="save-btn btn btn-sm px-0 py-0"><i class="fas fa-save"></i></button>
                                                        <button class="delete-btn btn btn-sm px-0 py-0" data-workorder-id="<?php echo $row['workorder_id']; ?>">
                                                            <i class="fas fa-trash"></i>
                                                        </button>

                                                    </td>
                                                </tr>
                                            <?php endwhile; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <!-- Include DataTables -->
        <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-beta.1/css/select2.min.css" rel="stylesheet">

        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-beta.1/js/select2.min.js"></script>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>

        <script>
            $(document).ready(function() {
                // Initialiser DataTable
                $('#actionsTable').DataTable({
                    scrollCollapse: true,
                    paging: true,
                    info: true
                });

                // Fonction pour créer un menu déroulant Select2 de ressources
                function createRessourceSelect() {
                    var selectHtml = '<select class="form-control ressource-select">';
                    <?php foreach ($ressources as $ressource) : ?>
                        selectHtml += '<option value="<?php echo $ressource['id']; ?>"><?php echo htmlspecialchars($ressource['nameressource']); ?></option>';
                    <?php endforeach; ?>
                    selectHtml += '</select>';
                    return selectHtml;
                }

                // Fonction pour créer un menu déroulant Select2 de workorders
                function createWorkorderSelect() {
                    var selectHtml = '<select class="form-control workorder-select">';
                    <?php foreach ($workorders as $workorder) : ?>
                        selectHtml += '<option value="<?php echo $workorder['id']; ?>"><?php echo htmlspecialchars($workorder['WorkOrderNumber']); ?></option>';
                    <?php endforeach; ?>
                    selectHtml += '</select>';
                    return selectHtml;
                }

                // Gestion de l'ajout de ligne de ressource
                $('#actionsTable').on('click', '.plus-btns', function() {
                    var row = $(this).closest('tr');
                    var ressourceSelect = createRessourceSelect();
                    var workorderSelect = createWorkorderSelect();
                    row.after(`<tr id="new-ressource-row">
                        <td>${workorderSelect}</td>
                        <td>${ressourceSelect}</td>
                <td>
                    <button class="save-ressource-btn btn btn-sm px-0 py-0"><i class="fas fa-save"></i></button>
                </td>
            </tr>`);

                    $('new-ressource-row ressource-select').select2({
                        placeholder: 'Sélectionner une ressource',
                        allowClear: true
                    });

                    $('.new-ressource-row .workorder-select').select2({
                        placeholder: 'Sélectionner un workorder',
                        allowClear: true
                    });

                });

                // Gestion du bouton de sauvegarde de ressource
                $('#actionsTable').on('click', '.save-ressource-btn', function() {
                    var newRow = $(this).closest('tr');
                    var workOrderID = newRow.find('.workorder-select').val();
                    var ressourceID = newRow.find('.ressource-select').val();

                    // Exemple d'envoi de données par AJAX à add-affectation.php
                    $.ajax({
                        url: 'add-affectation.php',
                        type: 'POST',
                        data: {
                            workOrderID: workOrderID,
                            ressourceID: ressourceID
                        },
                        success: function(response) {
                            Swal.fire({
                                title: "Ressource ajoutée!",
                                icon: "success",
                                button: "OK"
                            }).then(() => {
                                location.reload();
                            });
                        },
                        error: function(xhr, status, error) {
                            Swal.fire({
                                title: "Erreur!",
                                text: "Échec de l'ajout de la ressource. Erreur: " + error,
                                icon: "error",
                                button: "OK"
                            });
                        }
                    });
                });

                // Gestion du bouton de sauvegarde de ressources 
                $('#actionsTable').on('click', '.save-btn', function() {
                    var row = $(this).closest('tr');
                    var workOrderID = $(this).data('workorder-id');
                    var RessourceID = row.find('td:nth-child(2)').text(); // Récupérer les nouvelles ressources (colonne 2)


                });

                // Gestion du bouton de suppression d'une affectation
                $('#actionsTable').on('click', '.delete-btn', function() {
                    var row = $(this).closest('tr');
                    var workOrderID = row.data('workorder-id');


                    Swal.fire({
                        title: 'Êtes-vous sûr(e) de vouloir supprimer cette affectation?',
                        text: "Cette action est irréversible!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Oui, supprimer!',
                        cancelButtonText: 'Annuler'
                    }).then((result) => {
                        if (result.isConfirmed) {

                            $.ajax({
                                url: 'delete-affectation.php',
                                type: 'POST',
                                data: {
                                    workOrderID: workOrderID
                                },
                                success: function(response) {
                                    Swal.fire({
                                        title: "Affectation supprimée!",
                                        icon: "success",
                                        button: "OK"
                                    }).then(() => {
                                        location.reload(); // Recharger la page après la suppression
                                    });
                                },
                                error: function(xhr, status, error) {
                                    Swal.fire({
                                        title: "Erreur!",
                                        text: "Échec de la suppression de l'affectation. Erreur: " + error,
                                        icon: "error",
                                        button: "OK"
                                    });
                                }
                            });
                        }
                    });
                });

            });
        </script>


        <!-- Inclure le pied de page -->
        <?php include '../../frames/footer_frame.php'; ?>
        <script src="../../assets/js/table-treeview.js"></script>


        <script src="../../assets/js/customizer.js"></script>

        <!-- Chart Custom JavaScript -->
        <script async src="../../assets/js/chart-custom.js"></script>


        <script async src="../../assets/js/slider.js"></script>



        <script src="../../assets/vendor/moment.min.js"></script>


        <script src="../../assets/vendor/moment.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />


        <link rel="stylesheet" href="https:////cdn.datatables.net/buttons/3.0.2/css/buttons.bootstrap.css" />
    </div>
</body>

</html>