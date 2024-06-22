<?php
require_once("../../db/connexion.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $data = $_POST['data'];

    $WorkOrderID  = $data['WorkOrderID']; //2
    $TaskName = $data['TaskName'];
    $Description = $data['Description']; //4
    $Status = $data['Status']; //7
    $Priority = $data['Priority']; //18
    $StartDate = $data['StartDate']; //5
    $EndDate = $data['EndDate']; //6


    // Préparation de la requête SQL
    $sql = "UPDATE tasks SET 
            WorkOrderID = '$WorkOrderID',
            TaskName = '$TaskName',
            Description = '$Description',
            Status = '$Status',
            Priority = '$Priority',
            StartDate = '$StartDate',
            EndDate = '$EndDate'
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
