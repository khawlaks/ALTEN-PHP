<?php
include '../../db/connexion.php';  // SOT require_once "../../db/connexion.php";


$sql =
    "SELECT 
    w.id,
    p.ProjectName, 
    w.WorkOrderNumber, 
    w.Description,
    w.StartDate, 
    w.EndDate, 
    w.Status, 
    w.CreatedAt,
    w.UpdatedAt, 
    w.Country, 
    w.Plant, 
    w.STELLANTISRequester, 
    w.ALTENPilot, 
    w.ReceptionDateWO, 
    w.DeadlineSTELLANTISWO,
    w.StartOfProductionALTEN, 
    w.DeliveryDate, 
    w.ValidationCriteria, 
    w.Priority, 
    w.NumberOfDeliverables, 
    w.NumberOfValidatedDeliverablesRFT, 
    FORMAT((w.NumberOfValidatedDeliverablesRFT / w.NumberOfDeliverables) * 100, 0) AS RFT,
    w.NumberOfValidatedDeliverablesOTD, 
    Format((w.NumberOfValidatedDeliverablesOTD / w.NumberOfDeliverables) * 100,0) AS OTD
FROM 
    workorders w 
JOIN 
    projects p ON p.id = w.ProjectID";

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
    <link rel="stylesheet" href="../../assets/css/backend.css?v=1.0.0">
    <link rel="stylesheet" href="../../assets/vendor/remixicon/fonts/remixicon.css">
    <link rel="stylesheet" href="../../assets/vendor/line-awesome/dist/line-awesome/css/line-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.7.1/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">

    <link rel="stylesheet" href="../../assets/vendor/remixicon/fonts/remixicon.css">
    <!-- Calendar -->
    <link rel="stylesheet" href="../../assets/vendor/tui-calendar/tui-calendar/dist/tui-calendar.css">
    <link rel="stylesheet" href="../../assets/vendor/tui-calendar/tui-date-picker/dist/tui-date-picker.css">
    <link rel="stylesheet" href="../../assets/vendor/tui-calendar/tui-time-picker/dist/tui-time-picker.css">




    <!-- sweetalert2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <!--  Style CSS -->
    <link rel="stylesheet" href="../css/style.css">


    <!-- JavaScript files -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/js/fontawesome.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="../../assets/js/backend-bundle.min.js"></script>



    <script src="https://cdn.datatables.net/buttons/2.1.0/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.1.0/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.1.0/js/buttons.print.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>

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
                                <h5>Diagramme de Gantt</h5>
                            </div>
                            <div class="chart-container pie-chart">
                                <div id="chart_div" width="400px">
                                </div>
                            </div>

                        </div>

                    </div>
                </div>

                <div class="col-md-5 col-lg-6">
                    <div class="card card-block card-stretch card-height">
                        <div class="card-body">
                            <div class="top-block d-flex align-items-center justify-content-between">

                            </div>
                            <div class="chart-container pie-chart">
                                <div id="piechart" width="400px">

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
                            <div class="header-title ">


                                <button id="add-row-btn" class="btn btn-warning mr-2" type="button"> Add New Workorders+</button>

                                <button id="export-csv-btn" class="btn btn-success mr-2">Export CSV</button>

                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <script>

                                    </script>
                                    <table id="actionsTable" class="table data-table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>ProjectName</th>
                                                <th>WorkOrderNumber</th>
                                                <th>DescriptionOfWorkOrders</th>
                                                <th>StartDate</th>
                                                <th>EndDate</th>
                                                <th>Status</th>
                                                <th>WorkOrderCreatedAt </th>
                                                <th> WorkOrderUpdatedAt</th>
                                                <th>Country</th>
                                                <th>Plant</th>
                                                <th>STELLANTISRequester </th>
                                                <th>ALTENPilot</th>
                                                <th>ReceptionDateWO</th>
                                                <th>DeadlineSTELLANTISWO</th>
                                                <th>StartOfProductionALTEN</th>
                                                <th>DeliveryDate</th>
                                                <th>ValidationCriteria</th>
                                                <th>Priority</th>
                                                <th>NumberOfDeliverables</th>
                                                <th>NumberOfValidatedDeliverablesRFT</th>
                                                <th>RFT</th>
                                                <th>NumberOfValidatedDeliverablesOTD</th>
                                                <th>OTD</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $sqlProjects = "SELECT * FROM projects";
                                            $resultProjects = $conn->query($sqlProjects);
                                            if (!$resultProjects) {
                                                die("Erreur de requête: " . $conn->error);
                                            }

                                            $projects = [];
                                            while ($projectRow = $resultProjects->fetch_assoc()) {
                                                $projects[] = $projectRow;
                                            }
                                            ?>
                                            <?php while ($row = $result->fetch_assoc()) : ?>
                                                <tr data-id="<?php echo $row['id']; ?>">
                                                    <td>
                                                        <select>
                                                            <?php foreach ($projects as $project) : ?>
                                                                <option value="<?php echo $project['id']; ?>" <?php echo $project['ProjectName'] === $row['ProjectName'] ? 'selected' : ''; ?>>
                                                                    <?php echo htmlspecialchars($project['ProjectName']); ?>
                                                                </option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                    </td>
                                                    <td contenteditable="true"><?php echo htmlspecialchars($row['WorkOrderNumber']); ?></td>
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
                                                    <td style="padding: 100px;"> <?php echo htmlspecialchars($row['CreatedAt']); ?> </td>
                                                    <td> <?php echo htmlspecialchars($row['UpdatedAt']); ?> </td>
                                                    <td contenteditable="true"><?php echo htmlspecialchars($row['Country']); ?></td>
                                                    <td contenteditable="true"><?php echo htmlspecialchars($row['Plant']); ?></td>
                                                    <td contenteditable="true"><?php echo htmlspecialchars($row['STELLANTISRequester']); ?></td>
                                                    <td contenteditable="true"><?php echo htmlspecialchars($row['ALTENPilot']); ?></td>
                                                    <td><input type="date" value="<?php echo htmlspecialchars($row['ReceptionDateWO']); ?>"></td>
                                                    <td><input type="date" value="<?php echo htmlspecialchars($row['DeadlineSTELLANTISWO']); ?>"></td>

                                                    <td><input type="date" value="<?php echo htmlspecialchars($row['StartOfProductionALTEN']); ?>"></td>
                                                    <td><input type="date" value="<?php echo htmlspecialchars($row['DeliveryDate']); ?>"></td>

                                                    <td contenteditable="true"><?php echo htmlspecialchars($row['ValidationCriteria']); ?></td>

                                                    <td>
                                                        <select>
                                                            <option value="High" <?php echo ($row['Priority'] == 'High') ? 'selected' : ''; ?>>High</option>
                                                            <option value="Medium" <?php echo ($row['Priority'] == 'Medium') ? 'selected' : ''; ?>>Medium</option>
                                                            <option value="Low" <?php echo ($row['Priority'] == 'Low') ? 'selected' : ''; ?>>Low</option>
                                                        </select>
                                                    </td>
                                                    <td><input type="text" value="<?php echo htmlspecialchars($row['NumberOfDeliverables']); ?>"></td>
                                                    <td><input type="text" value="<?php echo htmlspecialchars($row['NumberOfValidatedDeliverablesRFT']); ?>"></td>
                                                    <td><?php echo htmlspecialchars($row['RFT']) . '%'; ?></td>
                                                    <td><input type="text" value="<?php echo htmlspecialchars($row['NumberOfValidatedDeliverablesOTD']); ?>"></td>
                                                    <td><?php echo htmlspecialchars($row['OTD']) . '%'; ?></td>
                                                    <td>
                                                        <button class="save-btn btn btn-sm px-0  py-0"><i class="fas fa-save"></i></button>
                                                        <button class="delete-btn btn  btn-sm px-0 py-0"><i class="fas fa-trash"></i></button>
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

            <!-- Tables  -->


            <!-- Include jQuery and DataTables JS -->

            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
            <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

            <!--  END Include jQuery and DataTables JS -->
            <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

            <script type="text/javascript">
                $(document).ready(function() {

                    $('#actionsTable').DataTable({

                        scrollCollapse: true,
                        paging: true,
                        info: true
                    });

                    function saveRow(row) {
                        var id = row.data('id');
                        var data = {
                            ProjectID: row.find('td:eq(0) select').val(),
                            WorkOrderNumber: row.find('td:eq(1)').text(),
                            Description: row.find('td:eq(2)').text(),
                            StartDate: row.find('td:eq(3)  input').val(),
                            EndDate: row.find('td:eq(4)  input').val(),
                            Status: row.find('td:eq(5) select').val(),
                            // CreatedAt: row.find('td:eq(6) input').val(),
                            // UpdatedAt: row.find('td:eq(7) input').val(),
                            Country: row.find('td:eq(8)').text(),
                            Plant: row.find('td:eq(9)').text(),
                            STELLANTISRequester: row.find('td:eq(10)').text(),
                            ALTENPilot: row.find('td:eq(11)').text(),
                            ReceptionDateWO: row.find('td:eq(12) input').val(),
                            DeadlineSTELLANTISWO: row.find('td:eq(13) input ').val(),
                            StartOfProductionALTEN: row.find('td:eq(14) input').val(),
                            DeliveryDate: row.find('td:eq(15) input').val(),
                            ValidationCriteria: row.find('td:eq(16)').text(),
                            Priority: row.find('td:eq(17) select').val(),
                            NumberOfDeliverables: row.find('td:eq(18) input').val(),
                            NumberOfValidatedDeliverablesRFT: row.find('td:eq(19) input').val(),
                            RFT: row.find('td:eq(20)').text(),
                            NumberOfValidatedDeliverablesOTD: row.find('td:eq(21) input').val(),
                            OTD: row.find('td:eq(22)').text()
                        };

                        $.ajax({
                            url: id ? 'update-workoders.php' : 'add-workorders.php',
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
                                        window.location.href = 'page_workorders.php';
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
                                        url: 'delete-workorders.php',
                                        type: 'POST',
                                        data: {
                                            id: id
                                        },
                                        success: function(response) {
                                            row.remove();
                                            Swal.fire("Deleted!", "Your project has been deleted.", "success");
                                            window.location.href = 'page_workorders.php';
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
                        alert("Ajouter ca ");
                        var newRow = `<tr data-id="">
                            <td>
                                <select class="form-control">
                                    <?php foreach ($projects as $project) : ?>
                                        <option value="<?php echo $project['id']; ?>"><?php echo htmlspecialchars($project['ProjectName']); ?></option>
                                    <?php endforeach; ?>
                                </select>
                             </td>
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
                             <td contenteditable="true"></td>
                            <td contenteditable="true"></td>
                             <td contenteditable="true"></td>
                            <td contenteditable="true"></td>
                            <td><input type="date"></td>
                            <td><input type="date"></td>
                            <td><input type="date"></td>
                            <td><input type="date"></td>
                            <td contenteditable="true"></td>
                             <td>
                                <select class="form-control">
                                    <option value="High">High</option>
                                    <option value="Medium">Medium</option>
                                    <option value="Low">Low</option>
                                </select>
                             </td>
                            <td><input type="text"></td>
                            <td><input type="text"></td>
                            <td></td>
                             </td>
                            <td><input type="text"></td>
                            <td></td>
                            <td>
                                <button class="save-btn btn btn-sm px-0  py-0"><i class="fas fa-save"></i></button>
                                <button class="delete-btn btn  btn-sm px-0 py-0"><i class="fas fa-trash"></i></button>
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

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />


<link rel="stylesheet" href="https:////cdn.datatables.net/buttons/3.0.2/css/buttons.bootstrap.css" />

<!-- Table Treeview JavaScript -->
<script src="../../assets/js/table-treeview.js"></script>


<script src="../../assets/js/customizer.js"></script>

<!-- Chart Custom JavaScript -->
<script async src="../../assets/js/chart-custom.js"></script>

<script async src="../../assets/js/slider.js"></script>



<script src="../../assets/vendor/moment.min.js"></script>


<script src="../../assets/vendor/moment.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>