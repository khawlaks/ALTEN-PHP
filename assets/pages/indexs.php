<?php session_start();
if (!isset($_SESSION['id']) || $_SESSION['Role'] != 'user') {
    header('Location: ../../assets/auth/auth-sign-in.php');
    exit();
} ?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Webkit | Management</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="../../assets/image/favicon.ico" />
    <link rel="stylesheet" href="../../assets/css/backend-plugin.min.css">
    <link rel="stylesheet" href="../../assets/css/backend.css?v=1.0.0">
    <link rel="stylesheet" href="../../assets/vendor/line-awesome/dist/line-awesome/css/line-awesome.min.css">
    <link rel="stylesheet" href="../../assets/vendor/remixicon/fonts/remixicon.css">
    <link rel="stylesheet" href="../../assets/vendor/tui-calendar/tui-calendar/dist/tui-calendar.css">
    <link rel="stylesheet" href="../../assets/vendor/tui-calendar/tui-date-picker/dist/tui-date-picker.css">
    <link rel="stylesheet" href="../../assets/vendor/tui-calendar/tui-time-picker/dist/tui-time-picker.css">


</head>


<div class="wrapper">



    <?php include '../../frames/sidebar_frame.php'; ?>



    <?php include '../../frames/topbar_frame.php';

    ?>
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

        </div>
    </div>

</div>