
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Webkit | Resources Management</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="../../assets/image/favicon.ico" />
    <link rel="stylesheet" href="../../assets/css/backend-plugin.min.css">
    <link rel="stylesheet" href="../../assets/css/backend.css?v=1.0.0">
    <link rel="stylesheet" href="../../assets/vendor/line-awesome/dist/line-awesome/css/line-awesome.min.css">
    <link rel="stylesheet" href="../../assets/vendor/remixicon/fonts/remixicon.css">
    <link rel="stylesheet" href="../../assets/vendor/tui-calendar/tui-calendar/dist/tui-calendar.css">
    <link rel="stylesheet" href="../../assets/vendor/tui-calendar/tui-date-picker/dist/tui-date-picker.css">
    <link rel="stylesheet" href="../../assets/vendor/tui-calendar/tui-time-picker/dist/tui-time-picker.css">
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', { packages: ["orgchart"] });
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var data = new google.visualization.DataTable();
            data.addColumn('string', 'Name');
            data.addColumn('string', 'Manager');
            data.addColumn('string', 'ToolTip');

            data.addRows([
                [{'v': 'S.Hamdane', 'f': 'S.Hamdane<div style="color:blue; font-style:italic">CP1 Prismatic</div>'}, '', 'CP1'],
                [{'v': 'A.ElBrini', 'f': 'A.ElBrini<div style="color:blue; font-style:italic">TL Codification</div>'}, 'S.Hamdane', 'TL'],
                [{'v': 'codif', 'f': 'A.Lamghari</br>F.Mhamdi</br>H. Zarkti</br>K.Bakkali</br>O.El Fenni</br>Z.Asri</br>Z.Wadi</br>M.ElAssali</br>S.Nayem</br>W.Boulahrouf</br>Y.Bouzine</br>A.Batsi</br>Fz.Baziou'}, 'A.ElBrini', ''],

                [{'v': 'K.Lakhda', 'f': 'K.Lakhda<div style="color:blue; font-style:italic">TL GME T4</div>'}, 'S.Hamdane', 'TL'],
                [{'v': 'GME', 'f': 'A.Himdi</br>B.Jarir</br>I.Dkhissen</br>I.ElMokit</br>I.Afazaz</br>F.Fouadah</br>F.Nicola</br>S.Occhionero'}, 'K.Lakhda', ''],

                [{'v': 'W.Guezzi', 'f': 'W.Guezzi<div style="color:blue; font-style:italic">TL Prismatic</div>'}, 'S.Hamdane', 'TL'],
            ]);

            var chart = new google.visualization.OrgChart(document.getElementById('chart_div'));
            chart.draw(data, { 'allowHtml': true });
        }
    </script>
</head>
<body class="  ">
<!-- loader Start -->
<div id="loading">
    <div id="loading-center"></div>
</div>
<!-- loader END -->
<!-- Wrapper Start -->
<div class="wrapper">

    <!-- ########################## -->
    <!--        SIDEBAR -->
    <!-- ########################## -->

    <?php include '../../frames/sidebar_frame.php'; ?>

    <!-- ########################## -->

    <!-- ########################## -->
    <!--        TOPBAR -->
    <!-- ########################## -->

    <?php include '../../frames/topbar_frame.php'; ?>

    <!-- ########################## -->
    <div class="content-page">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6 col-lg-2">
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
                                <p class="mb-0">Last Month</p>
                                <span class="text-primary">92</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-2">
                    <div class="card card-block card-stretch card-height">
                        <div class="card-body">
                            <div class="top-block d-flex align-items-center justify-content-between">
                                <h5>Headcount Evolution</h5>
                            </div>
                            <canvas id="headcount_evolution" width="90" height="90"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-2">
                    <div class="card card-block card-stretch card-height">
                        <div class="card-body">
                            <div class="top-block d-flex align-items-center justify-content-between">
                                <h5>Countries</h5>
                            </div>
                            <canvas id="countries" width="90" height="90"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-2">
                    <div class="card card-block card-stretch card-height">
                        <div class="card-body">
                            <div class="top-block d-flex align-items-center justify-content-between">
                                <h5>Genders</h5>
                            </div>
                            <canvas id="gender_chart" width="90" height="90"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex flex-wrap align-items-center justify-content-between breadcrumb-content">
                                <h5>My Team</h5>
                                <div class="d-flex align-items-center">
                                    <div class="list-grid-toggle d-flex align-items-center mr-3">
                                        <div data-toggle-extra="tab" data-target-extra="#grid">
                                            <div class="grid-icon mr-3">
                                                <svg width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                    <rect x="3" y="3" width="7" height="7"></rect>
                                                    <rect x="14" y="3" width="7" height="7"></rect>
                                                    <rect x="14" y="14" width="7" height="7"></rect>
                                                    <rect x="3" y="14" width="7" height="7"></rect>
                                                </svg>
                                            </div>
                                        </div>
                                        <div data-toggle-extra="tab" data-target-extra="#list" class="active">
                                            <div class="grid-icon">
                                                <svg width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                    <line x1="21" y1="10" x2="3" y2="10"></line>
                                                    <line x1="21" y1="6" x2="3" y2="6"></line>
                                                    <line x1="21" y1="14" x2="3" y2="14"></line>
                                                    <line x1="21" y1="18" x2="3" y2="18"></line>
                                                </svg>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="pl-3 border-left btn-new">
                                        <a href="#" class="btn btn-primary" data-target="#new-user-modal" data-toggle="modal">New Resource</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div id="chart_div"></div>
                    </div>
                </div>
            </div>
            <div id="grid" class="item-content animate__animated animate__fadeIn" data-toggle-extra="tab-content">
                <div class="row">
                    <?php foreach ($resources as $resource): ?>
                    <div class="col-md-6 col-lg-2">
                        <div class="card card-block card-stretch card-height">
                            <div class="card-body">
                                <div class="top-block d-block align-items-center ">
                                    <?php
                                    if (!empty($resource['ProfilePicture'])) {
                                        $profilePic = 'data:image/jpeg;base64,' . base64_encode($resource['ProfilePicture']);
                                    } else {
                                        $profilePic = 'assets/images/Default_profile_picture.png';
                                    }
                                    ?>
                                    <div class="d-inline-block">
                                        <img src="<?= htmlspecialchars($profilePic) ?>" class="img-fluid rounded-circle avatar-40 ml-0" alt="image">
                                        <h6 class="mb-0 font-size-12 "><?= htmlspecialchars($resource['FirstName']) ?> <?= htmlspecialchars($resource['LastName']) ?></h6>
                                        <p class="m-1 font-size-12 "><?= htmlspecialchars($resource['Profil']) ?></p>
                                    </div>
                                    <?php
                                    $seniority = (int)$resource['Seniority'];
                                    $maxStars = min($seniority, 5);
                                    if ($maxStars === 0) {
                                        echo '<svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" fill="gray" class="bi bi-star-fill mr-0 p-0" viewBox="0 0 16 16">
                                            <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                                            </svg>';
                                    } else {
                                        for ($i = 0; $i < $maxStars; $i++) {
                                            echo '<svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" fill="gold" class="bi bi-star-fill mr-0 p-0" viewBox="0 0 16 16">
                                            <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                                            </svg>';
                                        }
                                    }
                                    ?>
                                    <div class="pt-3 border-top">
                                        <a href="#" class="text-body"><i class="las la-eye"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer"></div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <div id="list" class="item-content animate__animated animate__fadeIn active" data-toggle-extra="tab-content">
                <div class="table-responsive rounded bg-white mb-4">
                    <!-- <table class="table mb-0 table-borderless tbl-server-info">
                        <tbody>
                           
                            <tr>
                                <td>
                                    <!-- <div class="media align-items-center">
                                        <img src="<?= !empty($resource['ProfilePicture']) ? 'data:image/jpeg;base64,' . base64_encode($resource['ProfilePicture']) : 'assets/images/Default_profile_picture.png' ?>" class="img-fluid rounded-circle avatar-40" alt="image">
                                        <h5 class="ml-3"><?= htmlspecialchars($resource['FirstName']) ?> <?= htmlspecialchars($resource['LastName']) ?></h5>
                                    </div> -->
                                    <!-- <p class="ml-3">></p> -->
                                <!-- </td>
                                <td>
                                    <a href="#" class="text-body"><i class="las la-eye"></i></a>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <a href="#" class="text-body"><i class="las la-pen mr-3"></i></a>
                                        <a href="#" class="text-body"><i class="las la-trash-alt mr-0"></i></a>
                                    </div>
                                </td> -->
                            <!-- </tr> -->
                         
                        <!-- </tbody> -->
                    <!-- </table>  -->
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Wrapper End-->

<!-- Modal list start -->

<!-- New User Modal -->
<div class="modal fade bd-example-modal-lg" role="dialog" aria-modal="true" id="new-user-modal">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header d-block text-center pb-3 border-bottom">
                <h3 class="modal-title" id="exampleModalCenterTitle02">New Resource</h3>
            </div>
            <div class="modal-body">
                <form id="new-user-form" action="assets/php/resources_add.php" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group mb-3 custom-file-small">
                                <label for="profilePicture" class="h5">Upload Profile Picture</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="profilePicture" name="profilePicture">
                                    <label class="custom-file-label" for="profilePicture">Choose file</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-3">
                                <label for="matricule" class="h5">Matricule</label>
                                <input type="text" class="form-control" id="matricule" name="matricule" placeholder="Enter Matricule" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-3">
                                <label for="firstName" class="h5">First Name</label>
                                <input type="text" class="form-control" id="firstName" name="firstName" placeholder="Enter First Name" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-3">
                                <label for="lastName" class="h5">Last Name</label>
                                <input type="text" class="form-control" id="lastName" name="lastName" placeholder="Enter Last Name" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-3">
                                <label for="birthday" class="h5">Birthday</label>
                                <input type="date" class="form-control" id="birthday" name="birthday" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-3">
                                <label for="startDate" class="h5">Start Date</label>
                                <input type="date" class="form-control" id="startDate" name="startDate" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-3">
                                <label for="gender" class="h5">Gender</label>
                                <select name="gender" id="gender" class="selectpicker form-control" data-style="py-0" required>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-3">
                                <label for="grade" class="h5">Grade</label>
                                <select name="grade" id="grade" class="selectpicker form-control" data-style="py-0" required>
                                    <?php foreach ($grades as $grade): ?>
                                    <option value="<?= htmlspecialchars($grade['Grade']) ?>"><?= htmlspecialchars($grade['Grade']) ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-3">
                                <label for="profil" class="h5">Profil</label>
                                <select name="profil" id="profil" class="selectpicker form-control" data-style="py-0" required>
                                    <?php foreach ($profiles as $profile): ?>
                                    <option value="<?= htmlspecialchars($profile['Name']) ?>"><?= htmlspecialchars($profile['Name']) ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-3">
                                <label for="team" class="h5">Team</label>
                                <select name="team" id="team" class="selectpicker form-control" data-style="py-0" required>
                                    <?php foreach ($teams as $team): ?>
                                    <option value="<?= htmlspecialchars($team['Name']) ?>"><?= htmlspecialchars($team['Name']) ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-3">
                                <label for="country" class="h5">Country</label>
                                <select name="country" id="country" class="selectpicker form-control" data-style="py-0" required>
                                    <?php foreach ($countries as $country): ?>
                                    <option value="<?= htmlspecialchars($country['Country']) ?>"><?= htmlspecialchars($country['Country']) ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-3">
                                <label for="site" class="h5">Site</label>
                                <select name="site" id="site" class="selectpicker form-control" data-style="py-0" required>
                                    <?php foreach ($sites as $site): ?>
                                    <option value="<?= htmlspecialchars($site['Site']) ?>"><?= htmlspecialchars($site['Site']) ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="d-flex flex-wrap align-items-center justify-content-center mt-2">
                                <button type="submit" class="btn btn-primary mr-3">Save</button>
                                <button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Success/Error Modal -->
<?php if (isset($_GET['status'])): ?>
<div class="modal fade" id="statusModal" tabindex="-1" role="dialog" aria-labelledby="statusModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="statusModalLabel"><?= htmlspecialchars($_GET['status']) == 'success' ? 'Success' : 'Error' ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?= htmlspecialchars($_GET['message']) ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">OK</button>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        $('#statusModal').modal('show');
        setTimeout(function () {
            $('#statusModal').modal('hide');
            window.location.href = 'page-employee.php';
        }, 3000); // Adjust the timeout duration as needed
    });
</script>
<?php endif; ?>

<footer class="iq-footer">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6">
                <ul class="list-inline mb-0">
                    <li class="list-inline-item"><a href="privacy-policy.html">Privacy Policy</a></li>
                    <li class="list-inline-item"><a href="terms-of-service.html">Terms of Use</a></li>
                </ul>
            </div>
            <div class="col-lg-6 text-right">
                <span class="mr-1"><script>document.write(new Date().getFullYear())</script>©</span> <a href="#" class="">Webkit</a>.
            </div>
        </div>
    </div>
</footer>
<!-- Backend Bundle JavaScript -->
<script src="../../assets/js/backend-bundle.min.js"></script>

<!-- Table Treeview JavaScript -->
<script src="../../assets/js/table-treeview.js"></script>

<!-- Chart Custom JavaScript -->
<script src="../../assets/js/customizer.js"></script>

<!-- Chart Custom JavaScript -->
<script async src="../../assets/js/chart-custom.js"></script>
<!-- Chart Custom JavaScript -->
<script async src="../../assets/js/slider.js"></script>

<!-- app JavaScript -->
<script src="../../assets/js/app.js"></script>

<script src="../../assets/vendor/moment.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    // HEADCOUNT EVOLUTION CHART
    // =========================

    const labels_headcount = ['Nov', 'Dec', 'Jan', 'Feb', 'Mar', 'Apr', 'May'];
    const data_headcount = {
        labels: labels_headcount,
        datasets: [{
            label: '',
            data: [65, 67, 80, 81, 86, 89, 95],
            fill: false,
            borderColor: 'rgb(75, 192, 192)',
            tension: 0.1
        }]
    };


    
    const config_headcount = {
        type: 'line',
        data: data_headcount,
        options: {
            plugins: {
                legend:{
                    display:false
                }
            }
        }
    };
    const ctx_headcount = document.getElementById('headcount_evolution');
    new Chart(ctx_headcount, config_headcount);
   //=========================
   
   
    //COUNTRIES CHART
   //=========================
    // Fetch the PHP data and parse it

    
    
    // // Extract labels and data from the countriesData array
    // const countries_labels = countriesData.map(item => item.country);
    // // const countries_data = countriesData.map(item => item.count);
    // const percentages = countriesData.map(item => (item.count / headcount * 100).toFixed(2));
    
    // const data_countries = {
    //     labels: countries_labels,
    //     datasets: [{
    //         label: '# Resources ',
    //         data: "",
    //         backgroundColor: [
    //             'rgb(255, 99, 132)',
    //             'rgb(54, 162, 235)',
    //             'rgb(255, 205, 86)'
    //         ],
    //         hoverOffset: 4
    //     }]
    // };
    // const config_countries = {
    //     type: 'doughnut',
    //     data: data_countries,
    //     options: {
    //         plugins: {
    //             tooltip: {
    //                 callbacks: {
    //                     label: function(context) {
    //                         const label = context.label || '';
    //                         const value = context.raw;
    //                         const percentage = percentages[context.dataIndex] || 0;
    //                         return `${label}: ${value} (${percentage}%)`;
    //                     }
    //                 }
    //             }
    //         }
    //     }
    // };
        
        
    // const ctx_pie = document.getElementById('countries');
    // new Chart(ctx_pie, config_countries);
//=========================
</script>
<!-- <script>
    // GENDER CHART
    // =========================

    const genderData = <?php echo $gender_json; ?>;
    const gender_labels = genderData.map(item => item.gender);
    const gender_counts = genderData.map(item => item.count);
    const totalGenderCount = gender_counts.reduce((a, b) => a + b, 0);
    const gender_percentages = gender_counts.map(count => ((count / totalGenderCount) * 100).toFixed(2));

    const data_gender = {
        labels: gender_labels,
        datasets: [{
            label: '# Gender Distribution',
            data: gender_counts,
            backgroundColor: [
                'rgb(75, 192, 192)',
                'rgb(255, 99, 132)'
            ],
            hoverOffset: 4
        }]
    };

    const config_gender = {
        type: 'pie',
        data: data_gender,
        options: {
            plugins: {
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            const label = context.label || '';
                            const value = context.raw;
                            const percentage = gender_percentages[context.dataIndex] || 0;
                            return `${label}: ${value} (${percentage}%)`;
                        }
                    }
                }
            }
        }
    };

    const ctx_gender = document.getElementById('gender_chart');
    new Chart(ctx_gender, config_gender);
</script> -->

<?php
$filesToCheck = [
    // 'assets/php/resources_fetch.php',
    // 'frames/sidebar_frame.php',
    // 'frames/topbar_frame.php',
    // 'assets/php/resources_add.php'
];

foreach ($filesToCheck as $file) {
    if (!file_exists($file)) {
        die("Error: The required file $file was not found.");
    }else{
        echo "good";
    }
}

// include 'assets/php/resources_fetch.php';
?>

  </body>
</html>
