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
                    FROM affectations a 
                    JOIN workorders w ON w.id = a.WorkOrderID 
                    JOIN ressouce r ON r.id = a.RessourceID 
                    GROUP BY w.id 
                    ORDER BY r.nameressource DESC";

$resultAffectations = $conn->query($sqlAffectations);
if (!$resultAffectations) {
    die("Erreur de requête: " . $conn->error);
}

$affectations = [];
while ($row = $resultAffectations->fetch_assoc()) {
    $affectations[] = $row;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Webkit | Affectation</title>
    <!-- Include CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-beta.1/css/select2.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="../../assets/css/backend-plugin.min.css">
    <link rel="stylesheet" href="../../assets/css/backend.css?v=1.0.0">
    <link rel="stylesheet" href="../../assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.15/css/bootstrap-multiselect.css" />
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
                            <div class="header-title">
                                <button id="add-row-btn" class="btn btn-warning mr-3">Add New Affectation+</button>
                                <button id="export-csv-btn" class="btn btn-secondary mr-3">Export CSV</button>
                            </div>
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
                                            <?php foreach ($affectations as $affectation) : ?>
                                                <tr data-workorder-id="<?php echo $affectation['workorder_id']; ?>">
                                                    <td class="">

                                                   
                                                            <?php echo htmlspecialchars($affectation['WorkOrderNumber']); ?>
                                                 
                                                       
                                                    </td>
                                                    <td class="ressource-select">
                                                        <?php
                                                        $assignedRessources = explode(', ', $affectation['ressources']);
                                                        foreach ($assignedRessources as $ressource) {
                                                            echo '<span class="ressource-item" data-ressource-name="' . htmlspecialchars($ressource) . '">' . htmlspecialchars($ressource) . ' <button class="moins-btns btn btn-sm px-0 py-0"><i class="fas fa-minus"></i></button></span>';
                                                        }
                                                        ?>
                                                        <button class="plus-btns btn btn-sm px-0 py-0" data-workorder-id="<?php echo $affectation['workorder_id']; ?>"><i class="fas fa-plus"></i></button>
                                                    </td>
                                                    <td>
                                                        <button class="delete-btn btn btn-sm px-0 py-0" data-workorder-id="<?php echo $affectation['workorder_id']; ?>">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Include JavaScript -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.15/js/bootstrap-multiselect.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>

        <script>
            $(document).ready(function() {
                // Initialiser DataTable
                $('#actionsTable').DataTable({
                    scrollCollapse: true,
                    paging: true,
                    info: true
                });

                function createRessourceSelect(selectRessources = []) {
                    var select = '<select class="form-control ressource-select" multiple="multiple">';
                    <?php foreach ($ressources as $ressource) : ?>
                        var selected = selectRessources.includes("<?php echo $ressource['id']; ?>") ? "selected" : "";

                        select += `<option value="<?php echo $ressource['id']; ?>" ${selected}><?php echo htmlspecialchars($ressource['nameressource']); ?></option>`;
                    <?php endforeach; ?>
                    select += '</select>';
                    return select;



                }


                function createWorkOrderSelect() {
                    var select = '<select class="form-control workorder-select">';
                    <?php foreach ($workorders as $workorder) : ?>
                        select += `<option value="<?php echo $workorder['id']; ?>"><?php echo htmlspecialchars($workorder['WorkOrderNumber']); ?></option>`;
                    <?php endforeach; ?>
                    select += '</select>';
                    return select;
                }


                // Gestion de l'ajout de ligne (+) de ressource
                $('#actionsTable').on('click', '.plus-btns', function() {
                    var row = $(this).closest('tr');
                    var WorkorderID = $(this).data('workorder-id');
                    var ressourcesSelect = createRessourceSelect();
                    row.after(`<tr id="new-ressource-row">
                        <td></td>
                        <td>${ressourcesSelect}</td>
                        <td>
                        <button class="save-ressource-btn btn btn-sm px-0 py-0"><i class="fas fa-save"></i></button>
                        </td>
                    </tr>`);




                });

                //Gestion de l'ajout de ligne (-) de ressource 
                $('#actionsTable').on('click', '.moins-btns', function() {
                    var ressourceItem = $(this).closest('.ressource-item');
                    var ressourceName = ressourceItem.data('ressource-name');
                    var workOrderID = $(this).closest('tr').data('workorder-id');


                    Swal.fire({
                        title: 'Êtes-vous sûr(e) de vouloir supprimer cette ressource?',
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
                                url: 'delete-ressource.php',
                                type: 'POST',
                                data: {
                                    workOrderID: workOrderID,
                                    ressourceName: ressourceName
                                },
                                success: function(response) {
                                    Swal.fire({
                                        title: "Ressource supprimée!",
                                        icon: "success",
                                        button: "OK"
                                    }).then(() => {
                                        location.reload(); // Recharger la page après la suppression
                                    });
                                },
                                error: function(xhr, status, error) {
                                    Swal.fire({
                                        title: "Erreur!",
                                        text: "Échec de la suppression de la ressource. Erreur: " + error,
                                        icon: "error",
                                        button: "OK"
                                    });
                                }
                            });
                        }
                    });
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

                // Gestion du bouton de sauvegarde de nouvelle affectation
                $('#actionsTable').on('click', '.save-affectation-btn', function() {
                    alert("ca marche")
                    var row = $(this).closest('tr');
                    var workOrderID = row.find('.workorder-select').val();
                    var ressourceIDs = row.find('.ressource-select').val();



                    $.ajax({
                        url: 'add-affectation.php',
                        type: 'POST',
                        data: {
                            workOrderID: workOrderID,
                            ressourceIDs: ressourceIDs
                        },
                        success: function(response) {
                            Swal.fire({
                                title: "Nouvelle affectation ajoutée!",
                                icon: "success",
                                button: "OK"
                            }).then(() => {
                                location.reload();
                            });
                        },
                        error: function(xhr, status, error) {
                            Swal.fire({
                                title: "Erreur!",
                                text: "Échec de l'ajout de l'affectation. Erreur: " + error,
                                icon: "error",
                                button: "OK"
                            });
                        }
                    });
                })

                // Gestion du bouton de sauvegarde de ressource
                $('#actionsTable').on('click', '.save-ressource-btn', function() {
                    var newRow = $(this).closest('tr');

                    var workOrderID = newRow.prev().data('workorder-id'); //prev: est une fonction integree dans jquery qui est utilise pour renvoyer l element precedent de l element selectionnee
                    var ressourceIDs = newRow.find('.ressource-select').val();

                    $.ajax({
                        url: 'add-affectation.php',
                        type: 'POST',
                        data: {
                            workOrderID: workOrderID,
                            ressourceIDs: ressourceIDs
                        },
                        success: function(response) {
                            Swal.fire({
                                title: "Ressources ajoutées!",
                                icon: "success",
                                button: "OK"
                            }).then(() => {
                                location.reload(); // Reload the page after success
                            });

                        },
                        error: function(xhr, status, error) {
                            Swal.fire({
                                title: "Erreur!",
                                icon: "error",
                                text: "Une erreur est survenue lors de l'ajout des ressources",
                                button: "OK"
                            });
                        }

                    });
                });

                //Boutton d'ajouter de nouvelle affectation
                $('#add-row-btn').on('click', function() {

                    var row = $(this).closest('tr');
                    var workOrderSelectID = createWorkOrderSelect();
                    var ressourceSelectID = createRessourceSelect();
                    //ajouter une nouvelle affectation 
                    $('#actionsTable tbody').append(`<tr id="new-affectation-row">
                            
                                <td>${workOrderSelectID}</td>
                                <td>${ressourceSelectID}</td>
                                <td>
                                    <button class="save-affectation-btn btn btn-sm px-0 py-0"><i class="fas fa-save"></i></button>
                                </td>
                                    </tr>');

                                $('.ressource-select').multiselect({
                                    nonSelectedText: 'Sélectionner des ressources',
                                    enableFiltering: true,
                                    enableCaseInsensitiveFiltering: true,
                                    buttonWidth: '100%'
                                });

                                $('.workorder-select').select2({
                                    placeholder: 'Sélectionner un workorder',
                                    allowClear: true
                                });
                </tr>`);


                });
            });
        </script>

        <!-- Include footer -->
        <?php include '../../frames/footer_frame.php'; ?>
    </div>
</body>

</html>