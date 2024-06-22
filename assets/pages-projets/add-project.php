<?php
require_once "../../db/connexion.php" ;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = $_POST['data'];
    $ProjectName = $data['ProjectName'];
    $Description = $data['Description'];
    $StartDate = $data['StartDate'];
    $EndDate = $data['EndDate'];
    $Status = $data['Status'];


    $sql = "INSERT INTO projects (ProjectName, Description, StartDate, EndDate, Status) 
            VALUES ('$ProjectName', '$Description', '$StartDate', '$EndDate', '$Status')";
    //print($sql);die;
    if ($conn->query($sql) === TRUE) {
        echo $conn->insert_id; // Return the new record ID
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}



?>
