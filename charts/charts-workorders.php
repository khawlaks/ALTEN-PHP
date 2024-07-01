<?php
include '../../db/connexion.php';
//Status
$query = "SELECT Status, COUNT(*) as count FROM workorders GROUP BY Status";
$result = $conn->query($query);


$Status = [];
$data = [];


while ($row = $result->fetch_assoc()) {

    $Status[] = $row['Status']; 
    $data[] = $row['count'];

}

// Convertir les tableaux en chaînes JSON
$labelsJSON = json_encode($Status);
$dataJSON = json_encode($data);


// Country


$query = "SELECT Country, COUNT(*) as country FROM workorders GROUP BY Country";
$result = $conn->query($query);

$Country = [];
$datas = [];

while ($row = $result->fetch_assoc()) {
    $Country[] = $row['Country'];
    $datas[] = $row['country'];
}

// Convert arrays to JSON
$countriesJSON = json_encode($Country);
$datasJSON = json_encode($datas);


