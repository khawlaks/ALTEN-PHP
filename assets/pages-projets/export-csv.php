<?php
include '../../db/connexion.php';

header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=projects.csv');
header('Content-Type: application/vnd.ms-excel'); // Type de fichier Excel


$output = fopen('php://output', 'w');
fputcsv($output, array('ID     ','   Nom de Projet    ', '    Description    ', '  Date de Début  ', '  Date de Fin  ', '  Status  ', ' CreatedAt ', ' UpdatedAt '));

$sql = "SELECT * FROM projects";
//print($sql);die;
$result = $conn->query($sql);


if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        fputcsv($output, $row);
    }
}

fclose($output);
$conn->close();
?>
