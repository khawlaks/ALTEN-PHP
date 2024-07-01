<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Webkit | Responsive Bootstrap 4 Admin Dashboard Template</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="../../assets/image/favicon.ico" />
    <link rel="stylesheet" href="../../assets/css/backend-plugin.min.css">
    <link rel="stylesheet" href="../../assets/css/backend.css?v=1.0.0">
    <link rel="stylesheet" href="../../assets/vendor/line-awesome/dist/line-awesome/css/line-awesome.min.css">
    <link rel="stylesheet" href="../../assets/vendor/remixicon/fonts/remixicon.css">

    <link rel="stylesheet" href="../../assets/vendor/tui-calendar/tui-calendar/dist/tui-calendar.css">
    <link rel="stylesheet" href="../../assets/vendor/tui-calendar/tui-date-picker/dist/tui-date-picker.css">
    <link rel="stylesheet" href="../../assets/vendor/tui-calendar/tui-time-picker/dist/tui-time-picker.css">
    <style>
        .success {
            color: green;
            font-weight: bold;
            padding: 10px;
            border: 1px solid green;
            border-radius: 5px;
            margin-bottom: 10px;
        }

        .error {
            color: red;
            font-weight: bold;
            padding: 10px;
            border: 1px solid red;
            border-radius: 5px;
            margin-bottom: 10px;
        }
    </style>
</head>

<body class=" ">
    <!-- loader Start -->
    <div id="loading">
        <div id="loading-center">
        </div>
    </div>
    <!-- loader END -->

    <body class="bg-gradient-white ">
        <div class="container">
            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <div class="row">
                        <div class="col-lg-5 d-none d-lg-block">
                            <img src="alten.jpg" width="500" alt="ALTEN Logo">
                        </div>
                        <div class="col-lg-7">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                                    <div id="error" class="error"></div>
                                    <div id="success" class="success"></div>
                                </div>

                                <form id="loginForm" method="POST">
                                    <div class="form-group">
                                        <label for="exampleInputEmail">Email :</label>
                                        <input type="email" class="form-control form-control-user" id="exampleInputEmail" placeholder="Votre adresse email" name="Email">
                                        <!-- <h5 id="emailcheck" style="color:red;">**Email is missing </h5> -->
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputPassword">Mot de Passe :</label>
                                        <input type="password" class="form-control form-control-user" id="exampleInputPassword" placeholder="Créez un mot de passe sécurisé" name="Password">

                                    </div>


                                    <button type="submit" class="btn btn-primary btn-user btn-block">Login</button>
                                    <hr>
                                    <!-- <div class="text-center">
                                        <a class="small" href="">Déjà inscrit(e) ? Inscription</a>
                                    </div> -->
                                </form>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

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
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.1/dist/js/adminlte.min.js"></script>

        <script>
            $(document).ready(function() {
                $("#success").hide(); //hide : qui va nous permettre de cacher des elements sur une page
                $("#error").hide();

                $('#loginForm').on('submit', function(e) {
                    e.preventDefault();
                    var formData = $(this).serialize();
                    $.ajax({
                        type: 'POST',
                        url: 'auth.sign.php',
                        data: formData,
                        dataType: 'json',
                        success: function(response) {
                            if (response.success) {
                                $('#success').text(response.message).show();
                                $('#error').hide();
                                setTimeout(function() {
                                    window.location.href = response.redirect_url;
                                }, 2000);
                            } else {
                                $('#error').text(response.message).show();
                                $('#success').hide();
                            }
                        }
                    });
                });
            });
        </script>
    </body>

</html>