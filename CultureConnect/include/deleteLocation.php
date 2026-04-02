<?php
    include 'config.php';
    if (isset($_GET["locationIdPk"])){
        $loc_id_pk = $_GET["locationIdPk"];
        $delete_query = "DELETE FROM location WHERE locationIdPk = $loc_id_pk";
        $result = $connection->query($delete_query);
        if ($result) {
            echo "Location deleted";
            header("Location: ../03EditCouncil.php");
        }
        else {
            echo "Error";
        }
    }

    //TODO: DECIDE ON WHAT HAPPENS TO OFFERINGS AND RESIDENTS WHOSE LOCATION IS NO LONGER VALID//
?>