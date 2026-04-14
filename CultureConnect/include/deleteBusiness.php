<?php
    include 'config.php';
    if (isset($_GET["businessIdPk"])){
        $bus_id_pk = $_GET["businessIdPk"];
        $stmt = $connection->prepare("DELETE FROM business WHERE businessIdPk = ?");
        $stmt->bind_param("i", $bus_id_pk);
        
        if ($stmt->execute()) {
            header("Location: ../97ManageBusinessAdmin.php");
            exit;
        } else {
            throw new Exception("Error deleting business ID: $bus_id_pk - " . $stmt->error);
        }
    } else {
        throw new Exception("Error - businessIdPk not provided for deletion");
    }
?>