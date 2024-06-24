<?php
require_once "../../db/connexion.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = $_POST['data'];
    $Email = $data['Email'];
    $Password = $data['Password'];
    $Role = $data['Role'];
    $RessourceID=$data['RessourceID'];
 


    $sql = "INSERT INTO users (Email, Password, Role,RessourceID) 
            VALUES ('$Email', '$Password', '$Role', '$RessourceID')";
    //print($sql);die;
    if ($conn->query($sql) === TRUE) {
        echo $conn->insert_id; // Return the new record ID
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
