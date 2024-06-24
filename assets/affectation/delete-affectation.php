<?php
include '../../db/connexion.php'; // Include your database connection

// Check if workOrderID is provided
if (isset($_POST['workOrderID'])) {
    $workOrderID = $_POST['workOrderID'];
    $sql = "DELETE FROM affectation WHERE WorkOrderID = ?";
    $stmt = $conn->prepare($sql);
     $stmt->bind_param("i", $workOrderID);
        if ($stmt->execute()) {
            echo "Affectation supprimée avec succès.";
        } else {
           
            echo "Erreur lors de la suppression de l'affectation: " . $stmt->error;
        }
        $stmt->close();
    }

$conn->close();
