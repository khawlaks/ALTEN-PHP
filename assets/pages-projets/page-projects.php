<?php
include '../../db/connexion.php'; //require_once "../../db/connexion.php";
$sql = "SELECT * FROM projects";
//print($sql);die;
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
    <title>Webkit | Project Management</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="../../assets/image/favicon.ico" />

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
    <!-- Diagramme de Gantt !-->



    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

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
                <div class="col-md-5 col-lg-6">
                    <div class="card card-block card-stretch card-height">
                        <div class="card-body">
                            <div class="top-block d-flex align-items-center justify-content-between">
                                <h5>Diagramme de Gant : </h5>
                            </div>
                            <div class="chart-container pie-chart">
                                <div id="chart_div">
                                </div>


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
                                <div id="piechart">
                                </div>


                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>


        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="header-title">
                            <button id="add-row-btn" class="btn btn-info  mr-3" type="button">Add New Workorders+</button>
                            <button id="export-csv-btn" class="btn btn-success mr-3 ">Export CSV</button>

                        </div>


                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="actionsTable" class="table data-table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Nom de Projet</th>
                                            <th>Description of Projects</th>
                                            <th>Start Date</th>
                                            <th>End Date</th>
                                            <th>Status</th>
                                            <th>CreateAt</th>
                                            <th>UpdatedAt</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php while ($row = $result->fetch_assoc()) : ?>
                                            <tr data-id="<?php echo $row['id']; ?>">
                                                <td contenteditable="true"><?php echo htmlspecialchars($row['ProjectName']); ?></td>
                                                <td contenteditable="true"><?php echo htmlspecialchars($row['Description']); ?></td>
                                                <td><input type="date" value="<?php echo htmlspecialchars($row['StartDate']); ?>"></td>
                                                <td><input type="date" value="<?php echo htmlspecialchars($row['EndDate']); ?>"></td>
                                                <td>
                                                    <select>
                                                        <option value="Planned" <?php echo ($row['Status'] == 'Planned') ? 'selected' : ''; ?>>Planned</option>
                                                        <option value="Ongoing" <?php echo ($row['Status'] == 'Ongoing') ? 'selected' : ''; ?>>Ongoing</option>
                                                        <option value="Completed" <?php echo ($row['Status'] == 'Completed') ? 'selected' : ''; ?>>Completed</option>
                                                    </select>
                                                </td>
                                                <td><?php echo htmlspecialchars($row['CreatedAt']); ?></td>
                                                <td><?php echo htmlspecialchars($row['UpdatedAt']); ?></td>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <?php include '../../charts/pie-projets.php'; ?>
    <script type="text/javascript">
        $(document).ready(function() {
            google.charts.load('current', {
                'packages': ['corechart', 'gantt']
            });
            google.charts.setOnLoadCallback(drawChart);

            function drawChart() {
                var data = google.visualization.arrayToDataTable([
                    ['Status', 'Count'],
                    <?php foreach ($Status as $index => $status) : ?>['<?php echo $status; ?>', <?php echo $data[$index]; ?>],
                    <?php endforeach; ?>
                ]);

                var options = {
                    title: 'Nombre de Status',
                    style: 'arial',
                    //  pieHole: 0.4, // For a donut chart
                };

                var chart = new google.visualization.PieChart(document.getElementById('piechart'));
                chart.draw(data, options);

                $.ajax({
                    url: 'gant_chart.php',
                    dataType: 'json',
                    success: function(jsonData) {
                        var data = new google.visualization.DataTable();
                        data.addColumn('string', 'Task ID');
                        data.addColumn('string', 'Task Name');
                        data.addColumn('date', 'Start Date');
                        data.addColumn('date', 'End Date');
                        data.addColumn('number', 'Duration');
                        data.addColumn('number', 'Percent Complete');
                        data.addColumn('string', 'Dependencies');

                        jsonData.forEach(row => {
                            data.addRow([
                                row.ProjectName,
                                row.Description,
                                new Date(row.StartDate),
                                new Date(row.EndDate),
                                null,
                                0,
                                null
                            ]);
                        });

                        var options = {
                            height: 400,
                            gantt: {
                                trackHeight: 30
                            }
                        };

                        var chart = new google.visualization.Gantt(document.getElementById('chart_div'));
                        chart.draw(data, options);
                    },
                    error: function(xhr, status, error) {
                        console.error('Error:', error);
                    }
                });
            }

            $('#actionsTable').DataTable({
                scrollCollapse: true,
                paging: true,


            });

            function saveRow(row) {
                var id = row.data('id');
                var data = {
                    ProjectName: row.find('td:eq(0)').text(),
                    Description: row.find('td:eq(1)').text(),
                    StartDate: row.find('td:eq(2) input').val(),
                    EndDate: row.find('td:eq(3) input').val(),
                    Status: row.find('td:eq(4)').find('select').val(),
                };

                $.ajax({
                    url: id ? 'update-project.php' : 'add-project.php',
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
                                window.location.href = 'page-projects.php';
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
                                url: 'delete-project.php',
                                type: 'POST',
                                data: {
                                    id: id
                                },
                                success: function(response) {
                                    row.remove();
                                    Swal.fire("Deleted!", "Your project has been deleted.", "success");
                                    window.location.href = 'page-projects.php';
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
                            <td><input type="date"></td>
                            <td><input type="date"></td>
                            <td>
                                <select class="form-control">
                                    <option value="Planned">Planned</option>
                                    <option value="Ongoing">Ongoing</option>
                                    <option value="Completed">Completed</option>
                                </select>
                            </td>
                            <td></td>
                            <td></td>
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

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />


<link rel="stylesheet" href="https:////cdn.datatables.net/buttons/3.0.2/css/buttons.bootstrap.css"/>
