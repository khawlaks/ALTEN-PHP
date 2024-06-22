      
      <?php
        include '../../db/connexion.php';
        $sql = "SELECT ProjectName, Description ,StartDate, EndDate FROM projects";
        $result = $conn->query($sql);

        $data = array();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
        } else {
            echo "0 results";
        }
        $conn->close();

        // Convertir les données en JSON
        echo json_encode($data);
        ?>