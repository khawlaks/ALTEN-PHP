<?php
require('../pages-projets/fpdf/fpdf.php');
include '../../db/connexion.php';

class PDF extends FPDF {
    function Header() {
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(0, 10, 'Projects Report', 0, 1, 'C');
        $this->Ln(10);
    }

    function Footer() {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, 'Page ' . $this->PageNo(), 0, 0, 'C');
    }

    function BasicTable($header, $data) {
        // Header
        foreach($header as $col)
            $this->Cell(40, 7, $col, 1);
        $this->Ln();
        
        // Data
        foreach($data as $row) {
            foreach($row as $col)
                $this->Cell(40, 6, $col, 1);
            $this->Ln();
        }
    }
}

$pdf = new PDF();
$pdf->AddPage();
$pdf->SetFont('Arial', '', 10);

$sql = "SELECT 
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
(w.NumberOfValidatedDeliverablesRFT / w.NumberOfDeliverables) * 100 AS RFT,
w.NumberOfValidatedDeliverablesOTD, 
(w.NumberOfValidatedDeliverablesOTD /w.NumberOfDeliverables) * 100 AS OTD
FROM 
workorders w 
JOIN 
projects p ON p.id = w.ProjectID";
$result = $conn->query($sql);

$header = ['ID', 'Project Name', 'Work Order No.', 'Description', 'Start Date', 'End Date', 'Status', 'Created At', 'Updated At', 'Country', 'Plant', 'STELLANTIS Requester', 'ALTEN Pilot', 'Reception Date', 'Deadline', 'Start of Production', 'Delivery Date', 'Validation Criteria', 'Priority', 'No. of Deliverables', 'Validated Deliverables RFT', 'RFT %', 'Validated Deliverables OTD', 'OTD %'];

$data = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = [
            $row['id'], 
            $row['ProjectName'], 
            $row['WorkOrderNumber'], 
            $row['Description'], 
            $row['StartDate'], 
            $row['EndDate'], 
            $row['Status'], 
            $row['CreatedAt'], 
            $row['UpdatedAt'], 
            $row['Country'], 
            $row['Plant'], 
            $row['STELLANTISRequester'], 
            $row['ALTENPilot'], 
            $row['ReceptionDateWO'], 
            $row['DeadlineSTELLANTISWO'], 
            $row['StartOfProductionALTEN'], 
            $row['DeliveryDate'], 
            $row['ValidationCriteria'], 
            $row['Priority'], 
            $row['NumberOfDeliverables'], 
            $row['NumberOfValidatedDeliverablesRFT'], 
            number_format($row['RFT'], 2), 
            $row['NumberOfValidatedDeliverablesOTD'], 
            number_format($row['OTD'], 2)
        ];
    }
}

if (!empty($data)) {
    $pdf->BasicTable($header, $data);
} else {
    $pdf->Cell(0, 10, 'No projects found', 0, 1);
}

$pdf->Output('D', 'projects.pdf');
$conn->close();
?>
