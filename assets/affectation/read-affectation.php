<?php include '../../db/connexion.php';  // connexion  de la base de donnees 

$sql = "SELECT a.id, w.WorkOrderNumber, r.nameressource
FROM affectation a
JOIN workorders w ON w.id = a.WorkOrderID
JOIN ressouce r ON r.id = a.RessourceID";
$result = $conn->query($sql);
if (!$result) {
    die("Erreur de requête: " . $conn->error);
}


echo json_encode($ressources);
