<?php
require_once "../../db/connexion.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = $_POST['data']; //

    $WorkOrderID  = $data['WorkOrderID'];
    $TaskName= $data['TaskName'];
    $Description = $data['Description']; //4
    $Status = $data['Status']; //7
    $Priority = $data['Priority']; //18
    $StartDate = $data['StartDate']; //5
    $EndDate = $data['EndDate']; //6

    $sql = "INSERT INTO tasks (WorkOrderID,TaskName, Description, Status,Priority, StartDate, EndDate) 
            VALUES ('$WorkOrderID', '$TaskName','$Description', '$Status', '$Priority', '$StartDate','$EndDate')";


    //print($sql);die;
    if ($conn->query($sql) === TRUE) {
        echo $conn->insert_id; // Return the new record ID
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}





?>

?>