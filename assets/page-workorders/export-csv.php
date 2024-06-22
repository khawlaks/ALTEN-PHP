<?php
include '../../db/connexion.php';

header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=projects.csv');
header('Content-Type: application/vnd.ms-excel'); 


$output = fopen('php://output', 'w');

fputcsv($output, array(
    'ID', 'Project Name', 'WorkOrderNumber', 'Description', 'Start Date', 'End Date', 'Status',
    'Created At', 'Updated At', 'Country', 'Plant', 'STELLANTIS Requester', 'ALTENPilot',
    'ReceptionDate', 'DeadlineSTELLANTISWO', 'StartOfProductionALTEN','Delivery Date', 'Validation Criteria',
    'Priority', 'NumberOfDeliverables','NumberOfValidatedDeliverablesRFT', 'RFT',
    'NumberOfValidatedDeliverablesOTD', 'OTD'
));
$sql =
"SELECT 
    w.id,
    p.ProjectName, 
    w.WorkOrderNumber, 
    w.Description,
    w.StartDate, 
    w.EndDate, 
    w.Status, 
    w.CreatedAt,
    w.UpdatedAt, 
    w.Country, 
    w.Plant, 
    w.STELLANTISRequester, 
    w.ALTENPilot, 
    w.ReceptionDateWO, 
    w.DeadlineSTELLANTISWO,
    w.StartOfProductionALTEN, 
    w.DeliveryDate, 
    w.ValidationCriteria, 
    w.Priority, 
    w.NumberOfDeliverables, 
    w.NumberOfValidatedDeliverablesRFT, 
    FORMAT((w.NumberOfValidatedDeliverablesRFT / w.NumberOfDeliverables) * 100, 0) AS RFT,
    w.NumberOfValidatedDeliverablesOTD, 
    Format((w.NumberOfValidatedDeliverablesOTD / w.NumberOfDeliverables) * 100,0) AS OTD
FROM 
    workorders w 
JOIN 
    projects p ON p.id = w.ProjectID";
$result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            fputcsv($output, $row);
        }
    }

fclose($output);
$conn->close();
