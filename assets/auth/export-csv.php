<?php
include '../../db/connexion.php';

header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=projects.csv');
header('Content-Type: application/vnd.ms-excel');


$output = fopen('php://output', 'w');

fputcsv($output, array(
    'ID','Email','Password', 'Role', 'Name de ressource'
));
$sql = "SELECT  u.id,u.Email,u.Password,u.Role,r.nameressource FROM users u JOIN ressouce r ON r.id = u.RessourceID";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        fputcsv($output, $row);
    }
}

fclose($output);
$conn->close();
