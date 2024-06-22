<?php
require_once("../../db/connexion.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $data = $_POST['data'];

    $WorkOrderID   = $data['WorkOrderID'];
    $nameressource = $data['nameressource'];
    $email = $data['email'];
    $description = $data['description'];
    $adresse = $data['adresse']; 
 


    // Préparation de la requête SQL
    $sql = "UPDATE ressouce SET 
            WorkOrderID = '$WorkOrderID',
            nameressource = '$nameressource',
            email = '$email',
            description = '$description',
            adresse = '$adresse'
            WHERE id = $id";
    // print($sql);die;

    // Exécution de la requête SQL
    if ($conn->query($sql) === TRUE) {
        echo "Record updated successfully";

        exit();
    } else {
        echo "Error updating record: " . $conn->error;
    }
}
