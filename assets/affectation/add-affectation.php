<?php
include '../../db/connexion.php';  // Connexion à la base de données 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $workOrderID = $_POST['workOrderID'];
    $ressourceIDs = $_POST['ressourceIDs'];

    if (!empty($workOrderID) && !empty($ressourceIDs)) {
        foreach ($ressourceIDs as $ressourceID) {
            $sql = "INSERT INTO affectations (WorkOrderID, RessourceID) VALUES (?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ii", $workOrderID, $ressourceID);
            if (!$stmt->execute()) {
                echo "Erreur: " . $conn->error;
                exit;
            }
        }
        echo "Success";
    } else {
        echo "Invalid input";
    }
}
?>
