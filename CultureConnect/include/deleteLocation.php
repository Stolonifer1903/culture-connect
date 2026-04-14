<?php
    session_start();
    include 'config.php';
    if (isset($_GET["locationIdPk"])){
        $loc_id_pk = $_GET["locationIdPk"];
        $council_id_pk = $_GET['councilIdPk'];
        $stmt = $connection->prepare("DELETE FROM location WHERE locationIdPk = ?");
        $stmt->bind_param("i", $loc_id_pk);
        
        if ($stmt->execute()) {
            if ($_SESSION['role'] == 3) {
                header('Location: ../03EditCouncil.php', TRUE, 303);
                exit;
            } else if ($_SESSION['role'] == 4) {
                header('Location: ../03EditCouncil.php?councilIdPk=' .$council_id_pk, TRUE, 303); 
                exit;
            }
        }
        else {
            throw new Exception("Error deleting location ID: $loc_id_pk - " . $stmt->error);
        }
    }

    //TODO: DECIDE ON WHAT HAPPENS TO OFFERINGS AND RESIDENTS WHOSE LOCATION IS NO LONGER VALID//
?>