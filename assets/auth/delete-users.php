<?php
include '../../db/connexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   
    if (isset($_POST['id']) && is_numeric($_POST['id'])) {
        $id = $_POST['id'];

        
        $stmt = $conn->prepare("DELETE FROM users WHERE id = ?");
        if ($stmt) {
          
            $stmt->bind_param("i", $id);

          
            if ($stmt->execute()) {
                echo "Record deleted successfully";
            
                exit();
            } else {
                echo "Error deleting record: " . $stmt->error;
            }


        
            $stmt->close();
        } else {
            echo "Error preparing statement: " . $conn->error;
        }
    } else {
        echo "Invalid ID";
    }
}
