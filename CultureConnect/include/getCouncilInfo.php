<?php
    include 'config.php';
    if (isset($_SESSION['role']) || isset($_SESSION['role_id'])){
        if ($_SESSION['role'] == 3) {
            $counc_id = $_SESSION['role_id'];
            //get offering info from the view_offerings view
            $stmt = $connection->prepare("SELECT * FROM council WHERE councilIdPk = ?");
            $stmt->bind_param("i", $counc_id);
            $stmt->execute();
            $result = $stmt->get_result();
        }
        
        if ($result) {
            $row = $result->fetch_assoc();
            $name = $row["councilName"];
            //$bio = $row["businessDescription"] ;
            $email = $row["councilContact"] ;
            //$phone = $row["businessPhone"] ;
            $link = $row["councilLink"] ;
        }
        else {
            echo "Error";
        }
    }
?>