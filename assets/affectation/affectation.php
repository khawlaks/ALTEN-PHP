<?php include '../../db/connexion.php';  // connexion de la base de donnees 
//affectation dans la base de donnees 
$sql = "SELECT a.id, w.WorkOrderNumber, r.nameressource
FROM affectation a
JOIN workorders w ON w.id = a.WorkOrderID
JOIN ressouce r ON r.id = a.RessourceID";

$result = $conn->query($sql);
if (!$result) {
    die("Erreur de requête: " . $conn->error);
}
?>

<!doctype html>
<html lang="en">

<head>
    <!-- Meta tags -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Title -->
    <title>Webkit | Affectation </title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="../../assets/image/favicon.ico" />
    <link rel="stylesheet" href="../../assets/css/backend-plugin.min.css">
    <!-- CSS files -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/fontawesome.min.css">
    <link rel="stylesheet" href="../../assets/css/backend.css?v=1.0.0">
    <link rel="stylesheet" href="../../assets/vendor/remixicon/fonts/remixicon.css">
    <link rel="stylesheet" href="../../assets/vendor/line-awesome/dist/line-awesome/css/line-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.7.1/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="../../assets/vendor/remixicon/fonts/remixicon.css">
    <!-- Calendar -->
    <link rel="stylesheet" href="../../assets/vendor/tui-calendar/tui-calendar/dist/tui-calendar.css">
    <link rel="stylesheet" href="../../assets/vendor/tui-calendar/tui-date-picker/dist/tui-date-picker.css">
    <link rel="stylesheet" href="../../assets/vendor/tui-calendar/tui-time-picker/dist/tui-time-picker.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <!-- sweetalert2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

    <!-- JavaScript files -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/js/fontawesome.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script src="./vanillaSelectBox.js"></script>
    <script src="../../assets/js/backend-bundle.min.js"></script>
</head>

<div class="wrapper">
    <!--   SIDEBAR  -->
    <?php include '../../frames/sidebar_frame.php'; ?>
    <!--        TOPBAR -->
    <?php include '../../frames/topbar_frame.php'; ?>

    <div class="content-page mt-5">
        <div class="container-fluid">
            <div class="row"></div>
            <div class="container-fluid  text-center">
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
                                                <th>Nom de Ressource</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $sqlworkorders = "SELECT * FROM workorders"; // afficher orde de travail=> workorders
                                            $resultworkorders = $conn->query($sqlworkorders);
                                            if (!$resultworkorders) {
                                                die("Erreur de requête: " . $conn->error);
                                            }

                                            $workorders = [];
                                            while ($workordersRow = $resultworkorders->fetch_assoc()) {
                                                $workorders[] = $workordersRow;
                                            }
                                            ?>

                                            <?php
                                            $sqlressource = "SELECT * FROM ressouce";
                                            $resultressource = $conn->query($sqlressource);
                                            if (!$resultressource) {
                                                die("Erreur de requête: " . $conn->error);
                                            }

                                            $ressources = [];
                                            while ($ressourcesRow = $resultressource->fetch_assoc()) {
                                                $ressources[] = $ressourcesRow;
                                            }
                                            ?>
                                            <?php while ($row = $result->fetch_assoc()) : ?>
                                                <tr data-id="<?php echo $row['id']; ?>">
                                                    <td>
                                                        <select>
                                                            <?php foreach ($workorders as $workorder) : ?>
                                                                <option value="<?php echo $workorder['id']; ?>" <?php echo $workorder['WorkOrderNumber'] === $row['WorkOrderNumber'] ? 'selected' : ''; ?>>
                                                                    <?php echo htmlspecialchars($workorder['WorkOrderNumber']); ?>
                                                                </option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                    </td>

                                                    <td>
                                                        <select>
                                                            <?php foreach ($ressources as $ressource) : ?>
                                                                <option value="<?php echo $ressource['id']; ?>" <?php echo $ressource['nameressource'] === $row['nameressource'] ? 'selected' : ''; ?>>
                                                                    <?php echo htmlspecialchars($ressource['nameressource']); ?>
                                                                </option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                        <button class="plus-btns btn btn-sm px-0 py-0"><i class="fas fa-plus"></i></button>
                                                        <!-- buttons plus +ressource -->

                                                    </td>

                                                    <td>
                                                        <button class="add-row-btn  btn btn-sm px-0 py-0"><i class="fas fa-save"></i></button><!-- add affectation-->
                                                        <button class="save-btn btn btn btn-sm px-0 py-0"><i class="fas fa-check"></i></button><!-- modifier affectation et affichage -->
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
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <!-- <link rel="stylesheet" href="./vanillaSelectBox.css">
    <script src="./vanillaSelectBox.js"></script> -->

    <script type="text/javascript">
        $(document).ready(function() {
            // let mySelect = new vanillaSelectBox("#ressource", {
            //     placeHolder: 'Select Ressources',
            //     multiple: true
            // });

            $('#actionsTable').DataTable({
                scrollCollapse: true,
                paging: true,
                info: true
            });

            $('.add-row-btn').on('click', function() { //la function pour ajouter 
                var newRow = `<tr data-id="">
                <td>
                    <select class="form-control">
                        <?php foreach ($workorders as $workorder) : ?>
                            <option value="<?php echo $workorder['id']; ?>"><?php echo htmlspecialchars($workorder['WorkOrderNumber']); ?></option>
                        <?php endforeach; ?>
                    </select>
                </td>
                <td>
                   <select>
                        <?php foreach ($ressources as $ressource) : ?>
                            <option value="<?php echo $ressource['id']; ?>"><?php echo htmlspecialchars($ressource['nameressource']); ?></option>
                        <?php endforeach; ?>
                    </select>
                      <button class="plus-btns btn btn-sm px-0 py-0"><i class="fas fa-plus"></i></button>
                </td>
                <td>
                <button class="add-row-btn btn btn-sm px-0 py-0"><i class="fas fa-save"></i></button>
                    <button class="save-btn btn btn btn-sm px-0 py-0"><i class="fas fa-check"></i></button>
                </td>
              </tr>`;

                $('#actionsTable tbody').append(newRow);
            });

            $('.plus-btns').on('click', function() {
                var newRow = `<tr data-id="">
                <td>
                   <select> 
                        <?php foreach ($ressources as $ressource) : ?>
                            <option value="<?php echo $ressource['id']; ?>"><?php echo htmlspecialchars($ressource['nameressource']); ?></option>
                        <?php endforeach; ?>
                    </select>
                      <button class="plus-btns btn btn-sm px-0 py-0"><i class="fas fa-plus"></i></button>
                </td>
                
          
              </tr>`;
                $('#actionsTable tbody').append(newRow);
            });

            function saveRow(row) {
                var id = row.data('id');
                var data = {
                    WorkOrderID: row.find('td:eq(0) select').val(),
                    RessourceID: row.find('td:eq(1) select').val()
                };

                $.ajax({
                    url: id ? 'update-affectation.php' : 'add-affectation.php',
                    type: 'POST',
                    data: {
                        id: id,
                        data: data
                    },
                    success: function(response) {
                        Swal.fire({
                            title: "Do you want to save the changes?",
                            showDenyButton: true,
                            showCancelButton: true,
                            confirmButtonText: "Save",
                            denyButtonText: `
                Don 't save`
                        }).then((result) => {
                            if (result.isConfirmed) {
                                Swal.fire("Saved!", "", "success");
                                if (!id) {
                                    row.attr('data-id', response);
                                }
                            } else if (result.isDenied) {
                                Swal.fire("Changes are not saved", "", "info");
                            }
                        });
                    },
                    error: function(xhr, status, error) {
                        Swal.fire({
                            title: "Error!",
                            text: "Failed to " + (id ? "update" : "add") + " record. Error: " + error,
                            icon: "error",
                            button: "OK",
                        });
                    }
                });
            }

            $('#actionsTable tbody').on('click', '.save-btn', function() {
                var row = $(this).closest('tr');
                saveRow(row);
            });
        });
    </script>

    <?php include '../../frames/footer_frame.php'; ?>

    <!-- Table Treeview JavaScript -->
    <script src="../../assets/js/table-treeview.js"></script>
    <script src="../../assets/js/customizer.js"></script>
    <!-- Chart Custom JavaScript -->
    <script async src="../../assets/js/chart-custom.js"></script>
    <script async src="../../assets/js/slider.js"></script>
    <script src="../../assets/vendor/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />
    <link rel="stylesheet" href="https:////cdn.datatables.net/buttons/3.0.2/css/buttons.bootstrap.css" />
</div>

</html>