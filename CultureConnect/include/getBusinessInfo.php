<?php
    include 'config.php';
    if (isset($_SESSION['role']) || isset($_SESSION['role_id'])){
        if ($_SESSION['role'] == 2) {
            $bus_id = $_SESSION['role_id'];
            //get offering info from the view_offerings view
            $stmt = $connection->prepare("SELECT * FROM business WHERE businessIdPk = ?");
            $stmt->bind_param("i", $bus_id);
            $stmt->execute();
            $result = $stmt->get_result();
        }
        
        if ($result) {
            $row = $result->fetch_assoc();
            $bus_name = $row["businessName"];
            $bus_bio = $row["businessDescription"] ;
            $bus_email = $row["businessEmail"] ;
            $bus_phone = $row["businessPhone"] ;
            $bus_link = $row["businessLink"] ;
            $counc_id = $row["councilIdPk"] ;
            //get council name based on council id
            $stmt = $connection->prepare("SELECT councilName FROM council WHERE councilIdPk = ?");
            $stmt->bind_param("i", $counc_id);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result) {
                $row = $result->fetch_assoc();
                $counc_name = $row["councilName"];
            }
        }
        else {
            throw new Exception("Error - " . $stmt->error);
        }
    }
?>