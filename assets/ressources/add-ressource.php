<?php
require_once "../../db/connexion.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = $_POST['data'];
    $WorkOrderID   = $data['WorkOrderID'];
    $nameressource= $data['nameressource'];
    $email = $data['email'];
    $description = $data['description'];
    $adresse = $data['adresse']; 


    $sql = "INSERT INTO ressouce (WorkOrderID,nameressource,email, description,adresse) 
            VALUES ('$WorkOrderID', '$nameressource','$email', '$Description', '$adresse')";


    //print($sql);die;
    if ($conn->query($sql) === TRUE) {
        echo $conn->insert_id; // Return the new record ID
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}





?>

