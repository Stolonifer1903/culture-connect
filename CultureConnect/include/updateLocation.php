
<?php
    include 'config.php';
    if (isset($_POST["locationIdPk"])){
        if (isset($_POST["locationName"])){
            $loc_id_pk = $_POST["locationIdPk"];
            $loc_name = $_POST["locationName"];

            $stmt = $connection->prepare("UPDATE location SET locationName = ? WHERE locationIdPk = ?");
            $stmt->bind_param("si", $loc_name, $loc_id_pk);

            if ($stmt->execute()) {
                header("Location: ../03EditCouncil.php", TRUE, 303);
                exit;
            }
            else {
                echo "Error" . $stmt->error;
            }
        }
    }
?>



