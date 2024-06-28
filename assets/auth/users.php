<?php
include '../../db/connexion.php';   //require_once "../../db/connexion.php";
session_start(); 


$sql = "SELECT  u.id,u.Email,u.Password,u.Role,r.nameressource FROM users u JOIN ressouce r ON r.id = u.RessourceID";

//print($sql);die;
$result = $conn->query($sql);
if (!$result) {
    die("Erreur de requête: " . $conn->error);
}
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

?>



<!doctype html>
<html lang="en">

<head>
    <!-- Meta tags -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Title -->
    <title>Webkit | Project Management</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="../../assets/image/favicon.ico" />

    <!-- CSS files -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/fontawesome.min.css">
    <link rel="stylesheet" href="../../assets/css/backend.css?v=1.0.0">
    <link rel="stylesheet" href="../../assets/vendor/remixicon/fonts/remixicon.css">
    <link rel="stylesheet" href="../../assets/vendor/line-awesome/dist/line-awesome/css/line-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.7.1/css/buttons.dataTables.min.css">

    <!-- Calendar -->
    <link rel="stylesheet" href="../../assets/vendor/tui-calendar/tui-calendar/dist/tui-calendar.css">
    <link rel="stylesheet" href="../../assets/vendor/tui-calendar/tui-date-picker/dist/tui-date-picker.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="../css/style.css">

    <!-- sweetalert2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />


    <link rel="stylesheet" href="https:////cdn.datatables.net/buttons/3.0.2/css/buttons.bootstrap.css" />

    <!-- JavaScript files -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/js/fontawesome.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script src="../../assets/js/backend-bundle.min.js"></script>

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

</head>


<div class="wrapper">
    <!--   SIDEBAR  -->
    <!-- ########################## -->
    <?php include '../../frames/sidebar_frame.php'; ?>

    <!--        TOPBAR -->
    <!-- ########################## -->

    <?php include '../../frames/topbar_frame.php'; ?>


    <div class="content-page mt-5">



        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="header-title">
                            <button id="add-row-btn" class="btn btn-info  mr-3" type="button">Add New Users+</button>
                            <button id="export-csv-btn" class="btn btn-success mr-3 ">Export CSV</button>

                        </div>


                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="actionsTable" class="table data-table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Email </th>
                                            <th>Password </th>
                                            <th>Role </th>
                                            <th>RessourceID</th>
                                            <th> Actions </th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php while ($row = $result->fetch_assoc()) : ?>
                                            <tr data-id="<?php echo $row['id']; ?>">
                                                <td contenteditable="true"><?php echo htmlspecialchars($row['Email']); ?></td>
                                                <td contenteditable="true"><?php echo htmlspecialchars($row['Password']); ?></td>
                                                <td>
                                                    <select>
                                                        <option value="admin" <?php echo ($row['Role'] == 'admin') ? 'selected' : ''; ?>>Admin</option>
                                                        <option value="user" <?php echo ($row['Role'] == 'user') ? 'selected' : ''; ?>>User</option>
                                                        <option value="niveau3" <?php echo ($row['Role'] == 'niveau3') ? 'selected' : ''; ?>>Niveau3</option>
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

                                                </td>
                                                <td>
                                                    <button class="save-btn btn btn-sm px-0 py-0"><i class="fas fa-save"></i></button>
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

    <!-- Tables  -->


    <!-- Include jQuery and DataTables JS -->

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

    <script src="https://cdn.datatables.net/buttons/2.1.0/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.1.0/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.1.0/js/buttons.print.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

    <?php include '../../charts/pie-projets.php'; ?>
    <script type="text/javascript">
        $(document).ready(function() {


            $('#actionsTable').DataTable({
                scrollCollapse: true,
                paging: true,


            });

            function saveRow(row) {
                var id = row.data('id');
                var data = {
                    Email: row.find('td:eq(0)').text(),
                    Password: row.find('td:eq(1)').text(),
                    Role: row.find('td:eq(2) select').val(),
                    RessourceID: row.find('td:eq(3) select').val(),

                };

                $.ajax({
                    url: id ? 'update-users.php' : 'add-users.php',
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
                                window.location.href = 'users.php';
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
                                url: 'delete-users.php',
                                type: 'POST',
                                data: {
                                    id: id
                                },
                                success: function(response) {
                                    row.remove();
                                    Swal.fire("Deleted!", "Your project has been deleted.", "success");
                                    window.location.href = 'users.php';
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

            $('#add-row-btn').on('click', function() {
                var newRow = `<tr data-id="">
                            <td contenteditable="true"></td>
                            <td contenteditable="true"></td>
                                <td>
                                <select class="form-control">
                                    <option value="admin">admin</option>
                                    <option value="user">user</option>
                                    <option value="Niveau3">Niveau3</option>
                                </select>
                            </td>
                          <td>
                                <select class="form-control">
                                    <?php foreach ($ressources as $ressource) : ?>
                                        <option value="<?php echo $ressource['id']; ?>"><?php echo htmlspecialchars($ressource['nameressource']); ?></option>
                                    <?php endforeach; ?>
                                </select>
                             </td>
                            <td>
                                <button class="save-btn btn btn-sm px-0 py-0"><i class="fas fa-save"></i></button>
                                <button class="delete-btn btn btn-sm px-0 py-0"><i class="fas fa-trash"></i></button>
                            </td>
                        </tr>`;

                $('#actionsTable tbody').append(newRow);
            });

            $('#actionsTable tbody').on('click', '.save-btn', function() {
                var row = $(this).closest('tr');
                saveRow(row);
            });

            $('#actionsTable tbody').on('click', '.delete-btn', function() {
                var row = $(this).closest('tr');
                deleteRow(row);
            });

            document.getElementById('export-csv-btn').addEventListener('click', function() {
                window.location.href = 'export-csv.php';
            });

        });
    </script>





    </body>
</div>
</div>

</html>
<?php include '../../frames/footer_frame.php'; ?>




<!-- Table Treeview JavaScript -->
<script src="../../assets/js/table-treeview.js"></script>

<!-- Chart Custom JavaScript -->
<script src="../../assets/js/customizer.js"></script>

<!-- Chart Custom JavaScript -->
<script async src="../../assets/js/chart-custom.js"></script>
<!-- Chart Custom JavaScript -->
<script async src="../../assets/js/slider.js"></script>

<!-- app JavaScript -->
<!-- <script src="../../assets/js/app.js"></script> -->

<script src="../../assets/vendor/moment.min.js"></script>


<script src="../../assets/vendor/moment.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>