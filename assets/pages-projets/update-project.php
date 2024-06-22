
    <?php

    require_once("../../db/connexion.php");

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $id = $_POST['id'];
        $data = $_POST['data'];

        $ProjectName = $data['ProjectName'];
        $Description = $data['Description'];
        $StartDate = $data['StartDate'];
        $EndDate = $data['EndDate'];
        $Status = $data['Status'];
        // $CreatedAt = $data['CreatedAt'];
        // $UpdatedAt = $data['UpdatedAt'];

        $sql = "UPDATE projects SET 
        ProjectName = '$ProjectName', 
        Description = '$Description', 
        StartDate = '$StartDate', 
        EndDate = '$EndDate', 
        Status = '$Status' 
        -- CreatedAt = '$CreatedAt', 
        -- UpdatedAt = '$UpdatedAt' 
        WHERE id = $id";

        if ($conn->query($sql) === TRUE) {
            echo "Record updated successfully";exit();
        } else {
            echo "Error updating record: " . $conn->error;
        }
    }
    ?>

