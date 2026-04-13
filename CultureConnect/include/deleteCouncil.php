<?php
    include 'config.php';
    if (isset($_GET["councilIdPk"])){
        $council_id_pk = $_GET["councilIdPk"];
        $delete_query = "DELETE FROM council WHERE councilIdPk = $council_id_pk";
        $result = $connection->query($delete_query);
        if ($result) {
            header("Location: ../97ManageCouncilAdmin.php");
        }
        else {
            throw new Exception("Error - " . $stmt->error);
        }
    } else {
        throw new Exception("Error - " . $stmt->error);
    }
?>