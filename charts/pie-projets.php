<?php
include '../../db/connexion.php';

$query = "SELECT Status, COUNT(*) as count FROM projects GROUP BY Status";
$result = $conn->query($query);

$Status = [];
$data = [];

while ($row = $result->fetch_assoc()) {
    $Status[] = $row['Status'];
    $data[] = $row['count'];
}

// Convertir les tableaux en chaînes JSON
$StatusJSON = json_encode($Status);
$dataJSON = json_encode($data);
?>