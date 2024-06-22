<?php
include '../../db/connexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Check if 'id' is set and is a valid number
    if (isset($_POST['id']) && is_numeric($_POST['id'])) {
        $id = $_POST['id'];

        // Prepare a delete statement
        $stmt = $conn->prepare("DELETE FROM projects WHERE id = ?");
        if ($stmt) {
            // Bind the parameter
            $stmt->bind_param("i", $id);
            
            // Execute the statement
            if ($stmt->execute()) {
                echo "Record deleted successfully";
            } else {
                echo "Error deleting record: " . $stmt->error;
            }
            
            // Close the statement
            $stmt->close();
        } else {
            echo "Error preparing statement: " . $conn->error;
        }
    } else {
        echo "Invalid ID";
    }
}
?>
