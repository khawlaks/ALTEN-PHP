<?php
require_once("../../db/connexion.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $data = $_POST['data'];

    $WorkOrderID  = $data['WorkOrderID'];
    $RessourceID = $data['RessourceID'];



    // Préparation de la requête SQL
    $sql = "UPDATE affectation SET 
            WorkOrderID = '$WorkOrderID',
            RessourceID = '$RessourceID'
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
