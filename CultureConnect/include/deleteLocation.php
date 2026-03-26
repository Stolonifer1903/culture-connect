<?php
    include 'config.php';
    if (isset($_GET["loc_id_pk"])){
        $loc_id_pk = $_GET["loc_id_pk"];
        $delete_query = "DELETE FROM council WHERE loc_id_pk = $loc_id_pk";
        $result = $connection->query($delete_query);
        if ($result) {
            echo "Location deleted";
            header("Location: ../EditLocations.php");
        }
        else {
            echo "Error";
        }
    }
?>