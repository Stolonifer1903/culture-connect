<?php
    session_start();
    include 'config.php';
    if (isset($_GET["locationIdPk"])){
        $loc_id_pk = $_GET["locationIdPk"];
        $council_id_pk = $_GET['councilIdPk'];
        $delete_query = "DELETE FROM location WHERE locationIdPk = $loc_id_pk";
        $result = $connection->query($delete_query);
        if ($result) {
            if ($_SESSION['role'] == 3) {
                header('Location: ../03EditCouncil.php', TRUE, 303);
            } else if ($_SESSION['role'] == 4) {
                header('Location: ../03EditCouncil.php?councilIdPk=' .$council_id_pk, TRUE, 303); 
            }
        }
        else {
            throw new Exception("Error - " . $stmt->error);
        }
    }

    //TODO: DECIDE ON WHAT HAPPENS TO OFFERINGS AND RESIDENTS WHOSE LOCATION IS NO LONGER VALID//
?>