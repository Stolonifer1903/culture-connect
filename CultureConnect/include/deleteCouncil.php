<?php
    include 'config.php';
    if (isset($_GET["councilIdPk"])){
        $council_id_pk = $_GET["councilIdPk"];
        $stmt = $connection->prepare("DELETE FROM council WHERE councilIdPk = ?");
        $stmt->bind_param("i", $council_id_pk);
        
        if ($stmt->execute()) {
            header("Location: ../97ManageCouncilAdmin.php");
            exit;
        } else {
            throw new Exception("Error deleting council ID: $council_id_pk - " . $stmt->error);
        }
    } else {
        throw new Exception("Error - councilIdPk not provided for deletion");
    }
?>