<?php
    include 'config.php';
    if (isset($_GET["councilIdPk"])){
        $council_id_pk = $_GET["councilIdPk"];
        $stmt = $connection->prepare("DELETE FROM council WHERE councilIdPk = ?");
        $stmt->bind_param("i", $council_id_pk);
        
        try {
            if ($stmt->execute()) {
                header("Location: ../97ManageCouncilAdmin.php");
                exit;
            }
        } catch (mysqli_sql_exception $e) {
            if ($e->getCode() == 1451) {
                header("Location: ../97ManageCouncilAdmin.php?deleteError=hasDependencies");
                exit;
            } else {
                throw $e;
            }
        }
    } else {
        throw new Exception("Error - councilIdPk not provided for deletion");
    }
?>