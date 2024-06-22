<?php
require_once "../../db/connexion.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = $_POST['data']; //

    $WorkOrderID  = $data['WorkOrderID'];
    $RessourceID = $data['RessourceID'];


    $sql = "INSERT INTO affectation (WorkOrderID,RessourceID) 
            VALUES ('$WorkOrderID', '$RessourceID')";


    //print($sql);die;
    if ($conn->query($sql) === TRUE) {
        echo $conn->insert_id; // Return the new record ID
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}





?>

