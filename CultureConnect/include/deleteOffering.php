<?php
    include 'config.php';
    session_start();
    if (isset($_GET["offeringIdPk"])){
        $of_id_pk = $_GET["offeringIdPk"];
        $stmt = $connection->prepare("DELETE FROM offering WHERE offeringIdPk = ?");
        $stmt->bind_param("i", $of_id_pk);
        
        if ($stmt->execute()) {
            $redirect_page = ($_SESSION['role'] == 4) ? '97ManageOfferingsAdmin.php' : '04ManageOfferings.php';
            header("Location: ../$redirect_page");
            exit;
        } else {
            throw new Exception("Error deleting offering ID: $of_id_pk - " . $stmt->error);
        }
    }
?>