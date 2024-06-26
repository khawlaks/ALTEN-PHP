<?php
include '../../db/connexion.php'; // Connexion à la base de données

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $workOrderID = $_POST['workOrderID'];
    $ressourceName = $_POST['ressourceName'];

    $ressourceQuery = "SELECT id FROM ressouce WHERE nameressource = ?";
    $stmt = $conn->prepare($ressourceQuery);
    $stmt->bind_param("s", $ressourceName);
    $stmt->execute();
    $stmt->bind_result($ressourceID);
    $stmt->fetch();
    $stmt->close();

    if ($ressourceID) {
        
        $deleteQuery = "DELETE FROM affectations WHERE WorkOrderID = ? AND RessourceID = ?";
        $stmt = $conn->prepare($deleteQuery);
        $stmt->bind_param("ii", $workOrderID, $ressourceID);
        if ($stmt->execute()) {
            echo "Affectation supprimée avec succès.";
        } else {

            echo "Erreur lors de la suppression de l'affectation: " . $stmt->error;
        }
    }
        $stmt->close();
}
