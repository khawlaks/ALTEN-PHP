<?php
require_once "../../db/connexion.php" ;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = $_POST['data'];//1
    $ProjectID = $data['ProjectID'];//2
    $WorkOrderNumber = $data['WorkOrderNumber'];//3
    $Description = $data['Description'];//4
    $StartDate = $data['StartDate'];//5
    $EndDate = $data['EndDate'];//6
    $Status = $data['Status'];//7
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


    $sql = "INSERT INTO workorders (ProjectID,WorkOrderNumber, Description, StartDate, EndDate, Status,
    Country,Plant,STELLANTISRequester,ALTENPilot,DeadlineSTELLANTISWO,StartOfProductionALTEN,DeliveryDate,ValidationCriteria
    ,Priority,NumberOfDeliverables,NumberOfValidatedDeliverablesRFT,RFT,NumberOfValidatedDeliverablesOTD,OTD) 
            VALUES ('$ProjectID', '$WorkOrderNumber','$Description', '$StartDate', '$EndDate', '$Status', 
            '$Country','$Plant','$STELLANTISRequester','$ALTENPilot','$DeadlineSTELLANTISWO','$StartOfProductionALTEN','$DeliveryDate','$ValidationCriteria',
            '$Priority','$NumberOfDeliverables','$NumberOfValidatedDeliverablesRFT','$RFT','$NumberOfValidatedDeliverablesOTD','$OTD')";
    //print($sql);die;
    if ($conn->query($sql) === TRUE) {
        echo $conn->insert_id; // Return the new record ID
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}



?>
