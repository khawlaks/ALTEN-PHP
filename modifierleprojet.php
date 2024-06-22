<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Webkit | Resources Management</title>

    <link rel="shortcut icon" href="assets/images/favicon.ico" />
    <link rel="stylesheet" href="assets/css/backend-plugin.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/fontawesome.min.css">
    <link rel="stylesheet" href="assets/css/backend.css?v=1.0.0">
    <link rel="stylesheet" href="assets/vendor/remixicon/fonts/remixicon.css">
    <link rel="stylesheet" href="assets/vendor/tui-calendar/tui-calendar/dist/tui-calendar.css">
    <link rel="stylesheet" href="assets/vendor/tui-calendar/tui-date-picker/dist/tui-date-picker.css">
    <link rel="stylesheet" href="assets/vendor/tui-calendar/tui-time-picker/dist/tui-time-picker.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>   
</head>
<body class="">
<!-- loader Start -->
<!-- <div id="loading">
    <div id="loading-center"></div>
</div> -->
<!-- loader END -->
<!-- Wrapper Start -->
    <div class="wrapper">

        <!-- ########################## -->
        <!--        SIDEBAR -->
        <!-- ########################## -->

        <?php include 'frames/sidebar_frame.php'; ?>

        <?php include 'frames/topbar_frame.php'; ?>

    <div class="content-page">
        <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
      
        <div class="row">
            <div class="col-12">
            <div class="container">
            <div class="card card"> 
              <div class="card-header">
               
                <div class="panel panel-primary">
                   <div class="panel-heading mb-5" align="center" style="font-size:20px;"> Modifier le Projet</div>
               <div class="panel-body">
                 <form method="post" action="" id="quickForm">
                <input type="hidden" name="id_sta" value="">

                   <div class="row">
                    <div class="col-sm-6">
                    <div class="form-group">
                    <label for="ProjectName" class="control-label"> ProjectName:  </label>
             
                        <input  type="text" name="ProjectName" id="ProjectName" class="form-control" required>
                    </div>

                  <div class="form-group">
                    <label for="Description" class="control-label "> Description : </label>
                  
                        <input  type="text" name="Description"  id="Description" class="form-control">
                  
                  </div>

            
                  <div class="form-group">
                    <label for="StartDate" class="control-label "> Date de debut : </label>
                  
                        <input  type="date" name="StartDate" id="StartDate" class="form-control ">
                 
                    </div>
                    
                    
                  <div class="form-group">
                        <label  aria-label="Default select example" for="Status"   required>Le Status:</label>
                            <select  class="form-control" aria-label="Default select example"  name="Status" id="Status" required><option selected disabled>Choisir Le Status </option>
                               <option value="planned">Planned</option>
                                <option value="ongoing">On going</option>
                                <option value="completed">Completed</option>
                                <option value="autres">Autres</option>
                             </select>
                        </div>
                  
                    </div>
                        <div class="col-sm-6">
             
                            <div class="form-group">
                                <label for="CreatedAt" class="control-label "> CreatedAt : </label>
                        
                                <input type="datetime-local" name="CreatedAt" id="CreatedAt" class="form-control">
                            </div>
             
           
                            <div class="form-group">
                                <label for="UpdatedAt" class="control-label col-sm-6"> UpdatedAt </label>
                            
                                <input required type="datetime-local" name="UpdatedAt" id="UpdatedAt" class="form-control" >
                    
                            </div>   
                            
                            <div class="form-group">
                                <label for="EndDate" class="control-label "> Date de fin : </label>
                            
                                    <input  type="date" name="EndDate" id="EndDate" class="form-control ">
                            
                                </div>
                            </div>
                    </div>
                <div class="form-group my-2">
                    <button  name="submit" class="btn btn-info" type="submit" style="float:left;">Enregistrer</button>
                </div>

                <div class="form-group my-2">
                    <input type="button" value="Retour" class="btn btn-success"  style="float:right; "onclick="history.go(-1)">
                </div>

            </form>
             </div>
          
            </div>
     
          </div>
  
        </div>
     
      </div>
   
    </section>

</div>
<?php

    // include ('db/connexion.php');
    // if(isset($_POST['submit']))
    // {
    //     $ProjectName = $_POST['ProjectName'];
    //     $Description = $_POST['Description'];
    //     $StartDate = $_POST['StartDate'];
    //     $EndDate = $_POST['EndDate'];
    //     $Status = $_POST['Status'];
    //     $CreatedAt = $_POST['CreatedAt'];
    //     $UpdatedAt = $_POST['UpdatedAt'];
    //     $id = $_POST['id'];
    //     $sql="UPDATE projects SET ProjectName='$ProjectName',Description='$Description',StartDate='$StartDate',EndDate='$EndDate',Status='$Status',CreatedAt='$CreatedAt',UpdatedAt='$UpdatedAt' WHERE id=$id";
    //     print($sql);
    //     $result = mysqli_query($conn,$sql);
    //     if($result){
    //         echo "Data inserted successfully";
    //          // header('Location: page-workorders.php');
    //         } else {
    //             echo "Failed to insert data";
    //         }
    //     header('Location: page-workorders.php');
  //  }
        
?>
