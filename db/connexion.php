<?php 
  // session_start();
   $db_username = 'root';
   $db_password ='';
   $db_name     = 'pmt';
   $db_host     = 'localhost';
    $conn = mysqli_connect($db_host, $db_username, $db_password,$db_name)
           or die('could not connect to database');

           if (!$conn) {
            die("<script>alert('Connection Failed.')</script>");
        }
        
?>