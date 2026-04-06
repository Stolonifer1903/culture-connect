<?php
    include 'config.php';
    if (isset($_GET["of_id_pk"])){
        $of_id_pk = $_GET["of_id_pk"];
        $delete_query = "DELETE FROM offering WHERE of_id_pk = $of_id_pk";
        $result = $connection->query($delete_query);
        if ($result) {
            echo "Offering deleted";
            header("Location: ../04ManageOfferings.php");
        }
        else {
            throw new Exception("Error - " . $stmt->error);
        }
    }
?>