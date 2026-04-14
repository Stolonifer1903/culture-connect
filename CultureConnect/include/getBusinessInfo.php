<?php
    include 'config.php';
    if (isset($_SESSION['role']) || isset($_SESSION['role_id'])){
        if ($_SESSION['role'] == 2) {
            $bus_id = $_SESSION['role_id'];
        } else if (isset($_POST['create-new']) && ($_SESSION['role'] == 4)){
            $stmt = $connection->prepare("INSERT INTO business(businessName, councilIdPk) VALUES ('New business', 1)");
            $stmt->execute();
            $bus_id = $stmt->insert_id;
        } else if (isset($_GET['businessIdPk']) && ($_SESSION['role'] == 4)) {
            $bus_id = $_GET['businessIdPk'];
        } else {
            throw new Exception("Unauthorized access - Cannot edit business info");
        }

        $stmt = $connection->prepare("SELECT * FROM business WHERE businessIdPk = ?");
        $stmt->bind_param("i", $bus_id);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result && $result->num_rows > 0) {
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
        } else {
            throw new Exception("Error fetching business info for ID: $bus_id - " . $stmt->error);
        }
    }
?>