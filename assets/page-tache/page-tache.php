<?php
include '../../db/connexion.php'; //require_once "../../db/connexion.php";

$sql = "SELECT t.id,t.TaskName, w.WorkOrderNumber, t.Description, t.Status, t.Priority, t.StartDate, t.EndDate, t.CreatedAt, t.UpdatedAt FROM tasks t JOIN workorders w ON w.id = t.WorkOrderID;
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
    <title>Webkit | Taches </title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="../../assets/image/favicon.ico" />
    <link rel="stylesheet" href="../../assets/css/backend-plugin.min.css">
    <!-- CSS files -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/fontawesome.min.css">
    <link rel="stylesheet" href="../../assets/css/backend.css?v=1.0.0">
    <link rel="stylesheet" href="../../assets/vendor/remixicon/fonts/remixicon.css">
    <link rel="stylesheet" href="../../assets/vendor/line-awesome/dist/line-awesome/css/line-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.7.1/css/buttons.dataTables.min.css">

    <link rel="stylesheet" href="../../assets/vendor/tui-calendar/tui-calendar/dist/tui-calendar.css">
    <link rel="stylesheet" href="../../assets/vendor/tui-calendar/tui-date-picker/dist/tui-date-picker.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="../css/style.css">


    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">


    <!-- JavaScript files -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/js/fontawesome.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>

    <script src="../../assets/js/backend-bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />


    <link rel="stylesheet" href="https:////cdn.datatables.net/buttons/3.0.2/css/buttons.bootstrap.css" />

</head>
<div class="wrapper">
    <!--   SIDEBAR  -->
    <!-- ########################## -->
    <?php include '../../frames/sidebar_frame.php'; ?>

    <!--        TOPBAR -->
    <!-- ########################## -->

    <?php include '../../frames/topbar_frame.php'; ?>


    <div class="content-page">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-5 col-lg-4">
                    <div class="card card-block card-stretch card-height">
                        <div class="card-body">
                            <div class="top-block d-flex align-items-center justify-content-between">
                                <h5>Headcount</h5>
                                <span class="badge badge-primary">YTD</span>
                            </div>
                            <h3><span class="counter" style="visibility: visible;"></span></h3>
                            <div class="d-flex align-items-center justify-content-between mt-1">
                                <p class="mb-0">Last Week</p>
                                <span class="text-primary">93</span>
                            </div>
                            <div class="d-flex align-items-center justify-content-between mt-1">
                                <p class="mb0">Last Month</p>
                                <span class="text-primary">92</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-5 col-lg-6">
                    <div class="card card-block card-stretch card-height">
                        <div class="card-body">
                            <div class="top-block d-flex align-items-center justify-content-between">
                                <h5>Status</h5>
                            </div>
                            <div class="chart-container pie-chart">
                                <div id="piechart" width="400px">
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
            </div>

        </div>


        <div class="container-fuild">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="header-title">
                            <button id="add-row-btn" class="btn btn-warning mr-3 " type="button">Add New Task+ </button>
                            <button id="export-csv-btn" class="btn btn-secondary mr-3">Export CSV</button>


                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="actionsTable" class="table data-table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>WorkOrderNumber</th>
                                            <th>TaskName</th>
                                            <th> Description</th>
                                            <th>Status</th>
                                            <th>Priority</th>
                                            <th>StartDate</th>
                                            <th>EndDate</th>
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
                                                <td contenteditable="true"><?php echo htmlspecialchars($row['TaskName']); ?></td>

                                                <td contenteditable="true"><?php echo htmlspecialchars($row['Description']); ?></td>
                                                <td>
                                                    <select>
                                                        <option value="Planned" <?php echo ($row['Status'] == 'Planned') ? 'selected' : ''; ?>>Planned</option>
                                                        <option value="Ongoing" <?php echo ($row['Status'] == 'Ongoing') ? 'selected' : ''; ?>>Ongoing</option>
                                                        <option value="Completed" <?php echo ($row['Status'] == 'Completed') ? 'selected' : ''; ?>>Completed</option>
                                                    </select>
                                                </td>
                                                <td>
                                                    <select>
                                                        <option value="High" <?php echo ($row['Priority'] == 'High') ? 'selected' : ''; ?>>High</option>
                                                        <option value="Medium" <?php echo ($row['Priority'] == 'Medium') ? 'selected' : ''; ?>>Medium</option>
                                                        <option value="Low" <?php echo ($row['Priority'] == 'Low') ? 'selected' : ''; ?>>Low</option>
                                                    </select>
                                                </td>
                                                <td><input type="date" value="<?php echo htmlspecialchars($row['StartDate']); ?>"></td>
                                                <td><input type="date" value="<?php echo htmlspecialchars($row['EndDate']); ?>"></td>

                                                <td><?php echo htmlspecialchars($row['CreatedAt']); ?> </td>
                                                <td><?php echo htmlspecialchars($row['UpdatedAt']); ?></td>
                                                <td>
                                                    <button class="save-btn btn btn-sm px-0 py-0"><i class=" fas fa-save"></i></button>
                                                    <button class="delete-btn btn btn-sm px-0 py-0"><i class="fas fa-trash"></i></button>
                                                </td>
                                            </tr>
                                        <?php endwhile; ?>
                                    </tbody>
                                    <!-- Vos données ici -->
                                </table>
                            </div>
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

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>


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
                TaskName: row.find('td:eq(1)').text(), // Index 3 pour TaskName (corrigé)

                Description: row.find('td:eq(2)').text(), // Index 2 pour Description
                Status: row.find('td:eq(3) select').val(), // Index 4 pour Status
                Priority: row.find('td:eq(4) select').val(), // Index 5 pour Priority (corrigé)
                StartDate: row.find('td:eq(5) input').val(), // Index 6 pour StartDate
                EndDate: row.find('td:eq(6) input').val(), // Index 7 pour EndDate

            };

            $.ajax({
                url: id ? 'update-taches.php' : 'add-taches.php',
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
                            url: 'delete-tache.php',
                            type: 'POST',
                            data: {
                                id: id
                            },
                            success: function(response) {
                                row.remove();
                                Swal.fire("Deleted!", "Your project has been deleted.", "success");
                                window.location.href = 'page-tache.php';
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
                    <td>
                        <select class="form-control">
                            <option value="Planned">Planned</option>
                            <option value="Ongoing">Ongoing</option>
                            <option value="Completed">Completed</option>
                        </select>
                    </td>
                    <td>
                        <select class="form-control">
                            <option value="High">High</option>
                            <option value="Medium">Medium</option>
                            <option value="Low">Low</option>
                        </select>
                    </td>
                    <td><input type="date"></td>
                    <td><input type="date"></td>
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
        document.getElementById('export-csv-btn').addEventListener('click', function() {
            window.location.href = 'export-csv.php';
        });
        // document.getElementById('pdf-btn').addEventListener('click', function() {
        //     window.location.href = 'export-pdf.php';
        // });
    });
</script>




</body>


</html>
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