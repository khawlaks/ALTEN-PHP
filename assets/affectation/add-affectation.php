<?php
include '../../db/connexion.php';  // Connexion à la base de données

if (isset($_POST['workOrderID']) && isset($_POST['ressourceID'])) {
    $workOrderID = $_POST['workOrderID'];
    $ressourceID = $_POST['ressourceID'];


    $insertSQL = "INSERT INTO affectation (WorkOrderID, RessourceID) VALUES (?, ?)";
    $insertStmt = $conn->prepare($insertSQL);
    $insertStmt->bind_param("ii", $workOrderID, $ressourceID);
    $insertStmt->execute();
    $insertStmt->close();

    echo "Affectation ajoutée avec succès!";
} else {
   
    echo "Erreur: Données manquantes pour l'ajout d'affectation.";
}


$conn->close();
