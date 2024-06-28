<?php include '../../db/connexion.php';


$output=fopen('php://output','w');
header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=export-affectation.csv');
header('Cache-Control: no-cache, no-store, must-revalidate'); 

fputcsv($output,array('Identification d affectation','WorkOrderNumber','Nom de Ressource'));

$sql= "SELECT w.id as workorder_id, w.WorkOrderNumber, GROUP_CONCAT(r.nameressource SEPARATOR ', ') AS ressources 
                    FROM affectations a 
                    JOIN workorders w ON w.id = a.WorkOrderID 
                    JOIN ressouce r ON r.id = a.RessourceID 
                    GROUP BY w.id 
                    ORDER BY r.nameressource DESC";
$result=$conn->query($sql);
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        fputcsv($output,$row);
    }
}
fclose($output);
$conn->close();




?>
