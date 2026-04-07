<?php
    include 'config.php';
    if (isset($_SESSION['role']) || isset($_SESSION['role_id'])){
        if ($_SESSION['role'] == 3) {
            $counc_id = $_SESSION['role_id'];
        } else if (isset($_POST['create-new']) && ($_SESSION['role'] == 4)){
            $stmt = $connection->prepare("INSERT INTO council(CouncilName) VALUES ('New council')");
            $stmt->execute();
            $counc_id = $connection->insert_id;
        } else if (isset($_GET['councilIdPk'])) {
            $counc_id = $_GET['councilIdPk'];
        } else {
            throw new Exception("Error - " . $stmt->error);
        }
        //get council info
        $stmt = $connection->prepare("SELECT * FROM council WHERE councilIdPk = ?");
        $stmt->bind_param("i", $counc_id);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $name = $row["councilName"];
            //$bio = $row["businessDescription"] ;
            $email = $row["councilContact"] ;
            //$phone = $row["businessPhone"] ;
            $link = $row["councilLink"] ;
        } else {
            throw new Exception("Error - " . $stmt->error);
        }
    } else {
            throw new Exception("Error - " . $stmt->error);
        }
?>

