<?php
    include 'config.php';
    if (isset($_GET["businessIdPk"])){
        $bus_id_pk = $_GET["businessIdPk"];
        $delete_query = "DELETE FROM business WHERE businessIdPk = $bus_id_pk";
        $result = $connection->query($delete_query);
        if ($result) {
            header("Location: ../97ManageBusinessAdmin.php");
        }
        else {
            throw new Exception("Error - " . $stmt->error);
        }
    } else {
        throw new Exception("Error - " . $stmt->error);
    }
?>