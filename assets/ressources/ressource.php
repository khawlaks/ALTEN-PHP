<?php include '../../db/connexion.php';  // connexion  de la base de donnees 

$sql = "SELECT r.id, w.WorkOrderNumber, r.nameressource,r.email,r.description,r.adresse,  r.CreatedAt, r.UpdatedAt FROM ressouce r JOIN workorders w ON w.id = r.WorkOrderID     ;
";
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
    <title>Webkit | Ressource </title>

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

    <script src="../../assets/js/backend-bundle.min.js"></script>

</head>

<div class="wrapper">
    <!--   SIDEBAR  -->
    <!-- ########################## -->
    <?php include '../../frames/sidebar_frame.php'; ?>

    <!--        TOPBAR -->
    <!-- ########################## -->

    <?php include '../../frames/topbar_frame.php'; ?>


    <div class="content-page">
        <div class="container-fuild">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="header-title">
                            <button id="add-row-btn" class="btn btn-warning mr-3 " type="button">Add New Ressource+ </button>



                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="actionsTable" class="table data-table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>WorkOrderNumber</th>
                                            <th>Nom de Ressource </th>
                                            <th> Email </th>
                                            <th>Description </th>
                                            <th>Adresse </th>
                                            <th>CreatedAt</th>
                                            <th>UpdatedAt</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $sqlworkorders = "SELECT * FROM workorders";
                                        $resultworkorders = $conn->query($sqlworkorders);
                                        if (!$resultworkorders) {
                                            die("Erreur de requête: " . $conn->error);
                                        }

                                        $workorders = [];
                                        while ($workordersRow = $resultworkorders->fetch_assoc()) {
                                            $workorders[] = $workordersRow;
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
                                                <td contenteditable="true"><?php echo htmlspecialchars($row['nameressource']); ?></td>
                                                <td contenteditable="true"><?php echo htmlspecialchars($row['email']); ?></td>

                                                <td contenteditable="true"><?php echo htmlspecialchars($row['description']); ?></td>
                                                <td contenteditable="true"><?php echo htmlspecialchars($row['adresse']); ?></td>
                                                <td><?php echo htmlspecialchars($row['CreatedAt']); ?> </td>
                                                <td><?php echo htmlspecialchars($row['UpdatedAt']); ?></td>
                                                <td>
                                                    <button class="save-btn btn btn-sm px-0 py-0"><i class=" fas fa-save"></i></button>
                                                    <button class="delete-btn btn btn-sm px-0 py-0"><i class="fas fa-trash"></i></button>
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



<!-- Include jQuery and DataTables JS -->

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

<script src="https://cdn.datatables.net/buttons/2.1.0/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.1.0/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.1.0/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.1.0/js/buttons.print.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>


<script type="text/javascript">
    $(document).ready(function() {


        $('#actionsTable').DataTable({


            scrollCollapse: true,
            paging: true,
            info: true

        });




        // Function to handle saving
        function saveRow(row) {
            var id = row.data('id');
            var data = {
                WorkOrderID: row.find('td:eq(0) select').val(),
                nameressource: row.find('td:eq(1)').text(),
                email: row.find('td:eq(2)').text(),
                description: row.find('td:eq(3)').text(),
                adresse: row.find('td:eq(4) ').text(),


            };

            $.ajax({
                url: id ? 'update-ressource.php' : 'add-ressource.php',
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
                        denyButtonText: `Don't save`
                    }).then((result) => {
                        if (result.isConfirmed) {
                            Swal.fire("Saved!", "", "success");
                            if (!id) {
                                row.attr('data-id', response); // Set the new ID from the response
                            }
                            //window.location.href = 'page-tache.php';
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


        function deleteRow(row) {
            var id = row.data('id');
            if (id) {
                Swal.fire({
                    title: "Are you sure?",
                    text: "You won't be able to revert this!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonText: "Yes, delete it!",
                    cancelButtonText: "No, cancel!",
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: 'delete-ressource.php',
                            type: 'POST',
                            data: {
                                id: id
                            },
                            success: function(response) {
                                row.remove();
                                Swal.fire("Deleted!", "Your project has been deleted.", "success");
                                window.location.href = 'ressource.php';
                            },
                            error: function(xhr, status, error) {
                                Swal.fire({
                                    title: "Error!",
                                    text: "Failed to delete record. Error: " + error,
                                    icon: "error",
                                    button: "OK",
                                });
                            }
                        });
                    } else if (result.dismiss === Swal.DismissReason.cancel) {
                        Swal.fire("Cancelled", "Your project is safe :)", "error");
                    }
                });
            } else {
                row.remove();
            }
        }

        // Handle add new row button click
        $('#add-row-btn').on('click', function() {
            var newRow = `<tr data-id="">
                    <td>
                        <select class="form-control">
                            <?php foreach ($workorders as $workorder) : ?>
                                <option value="<?php echo $workorder['id']; ?>"><?php echo htmlspecialchars($workorder['WorkOrderNumber']); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </td>
                    <td contenteditable="true"></td>
                    <td contenteditable="true"></td>
                
                    <td contenteditable="true"></td>
                    <td contenteditable="true"></td>
                    <td></td>
                    <td></td>
                    <td>
                        <button class="save-btn btn  btn-sm px-0 py-0"><i class="fas fa-save"></i></button>
                        <button class="delete-btn btn btn-sm px-0 py-0"><i class="fas fa-trash"></i></button>
                    </td>
             </tr>`;

            $('#actionsTable tbody').append(newRow);
        });


        // // Attach save and delete button handlers to dynamically added rows
        $('#actionsTable tbody').on('click', '.save-btn', function() {
            var row = $(this).closest('tr');
            saveRow(row);
        });

        $('#actionsTable tbody').on('click', '.delete-btn', function() {
            var row = $(this).closest('tr');
            deleteRow(row);
        });
        // document.getElementById('export-csv-btn').addEventListener('click', function() {
        //     window.location.href = 'export-csv.php';
        // });

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


<script src="../../assets/vendor/moment.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />


<link rel="stylesheet" href="https:////cdn.datatables.net/buttons/3.0.2/css/buttons.bootstrap.css" />