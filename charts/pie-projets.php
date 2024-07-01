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

// Convert the arrays to JSON strings
$labelsJSON = json_encode($Status);
$dataJSON = json_encode($data);

echo "<script>console.log('labelsJSON: " . addslashes($labelsJSON) . "');</script>";
echo "<script>console.log('dataJSON: " . addslashes($dataJSON) . "');</script>";



// Gantt


$sql = "SELECT ProjectName, Description, StartDate, EndDate FROM projects";
$result = $conn->query($sql);

$projects = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $projects[] = $row;
    }
}
$conn->close();

$projectsJSON = json_encode($projects);
?>
