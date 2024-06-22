<?php
require_once("../../db/connexion.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $data = $_POST['data'];


    $ProjectID = $data['ProjectID'];//2
    $WorkOrderNumber = $data['WorkOrderNumber'];//3
    $Description = $data['Description'];//4
    $StartDate = $data['StartDate'];//5
    $EndDate = $data['EndDate'];//6
    $Status = $data['Status'];//7
    // $CreatedAt = $data['CreatedAt'];//8
    // $UpdatedAt = $data['UpdatedAt'];//9
    $Country = $data['Country'];//10
    $Plant = $data['Plant'];//11
    $STELLANTISRequester = $data['STELLANTISRequester'];//12
    $ALTENPilot = $data['ALTENPilot'];//13
    $ReceptionDateWO = $data['ReceptionDateWO'];//14
    $DeadlineSTELLANTISWO = $data['DeadlineSTELLANTISWO'];//14
    $StartOfProductionALTEN = $data['StartOfProductionALTEN'];//15
    $DeliveryDate = $data['DeliveryDate'];//16
    $ValidationCriteria	 = $data['ValidationCriteria']; //17
    $Priority	 = $data['Priority']; //18
    $NumberOfDeliverables= $data['NumberOfDeliverables']; //19
    $NumberOfValidatedDeliverablesRFT= $data['NumberOfValidatedDeliverablesRFT']; //20
    $RFT= $data['RFT']; //21
    $NumberOfValidatedDeliverablesOTD= $data['NumberOfValidatedDeliverablesOTD']; //22
    $OTD= $data['OTD']; //23

    // Préparation de la requête SQL
    $sql = "UPDATE workorders SET 
            ProjectID = '$ProjectID',
            WorkOrderNumber = '$WorkOrderNumber',
            Description = '$Description',
            StartDate = '$StartDate',
            EndDate = '$EndDate',
            Status = '$Status',
            Country = '$Country',
            Plant = '$Plant',
            STELLANTISRequester = '$STELLANTISRequester',
            ALTENPilot = '$ALTENPilot',
            ReceptionDateWO = '$ReceptionDateWO',
            DeadlineSTELLANTISWO = '$DeadlineSTELLANTISWO',
            StartOfProductionALTEN = '$StartOfProductionALTEN',
            DeliveryDate = '$DeliveryDate',
            ValidationCriteria = '$ValidationCriteria',
            Priority = '$Priority',
            NumberOfDeliverables = '$NumberOfDeliverables',
            NumberOfValidatedDeliverablesRFT = '$NumberOfValidatedDeliverablesRFT',
            RFT = '$RFT',
            NumberOfValidatedDeliverablesOTD = '$NumberOfValidatedDeliverablesOTD',
            OTD = '$OTD'
            WHERE id = $id";

    // Exécution de la requête SQL
    if ($conn->query($sql) === TRUE) {
        echo "Record updated successfully";
        exit();
    } else {
        echo "Error updating record: " . $conn->error;
    }
}
?>
