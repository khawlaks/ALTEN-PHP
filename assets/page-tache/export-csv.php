<?php
include '../../db/connexion.php';

header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=projects.csv');
header('Content-Type: application/vnd.ms-excel');


$output = fopen('php://output', 'w');

fputcsv($output, array(
    'ID','WorkOrderNumber','TaskName', 'Description', 'Status', 'Priority','Start Date', 'End Date',
    'Created At', 'Updated At'
));
$sql = "SELECT t.id, w.WorkOrderNumber,t.TaskName, t.Description, t.Status, t.Priority, t.StartDate, t.EndDate, t.CreatedAt, t.UpdatedAt FROM tasks t JOIN workorders w ON w.id = t.WorkOrderID";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        fputcsv($output, $row);
    }
}

fclose($output);
$conn->close();
