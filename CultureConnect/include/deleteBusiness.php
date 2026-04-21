<?php
    include 'config.php';
    if (isset($_GET["businessIdPk"])){
        $bus_id_pk = $_GET["businessIdPk"];
        $stmt = $connection->prepare("DELETE FROM business WHERE businessIdPk = ?");
        $stmt->bind_param("i", $bus_id_pk);
        
        try {
            if ($stmt->execute()) {
                header("Location: ../97ManageBusinessAdmin.php");
                exit;
            }
        } catch (mysqli_sql_exception $e) {
            if ($e->getCode() == 1451) {
                header("Location: ../97ManageBusinessAdmin.php?deleteError=hasDependencies");
                exit;
            } else {
                throw $e;
            }
        }
    } else {
        throw new Exception("Error - businessIdPk not provided for deletion");
    }
?>