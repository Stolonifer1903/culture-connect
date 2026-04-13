
<?php
    session_start();
    include 'config.php';
    if (isset($_POST["locationIdPk"])){
        if (isset($_POST["locationName"])){
            $loc_id_pk = $_POST["locationIdPk"];
            $loc_name = $_POST["locationName"];
            $councilIdPk = $_POST["councilIdPk"];

            $stmt = $connection->prepare("UPDATE location SET locationName = ? WHERE locationIdPk = ?");
            $stmt->bind_param("si", $loc_name, $loc_id_pk);

            if ($stmt->execute()) {
                if (isset($_SESSION['role']) && isset($_SESSION['role_id'])){
                     if ($_SESSION['role'] == 3) {
                        header("Location: ../03EditCouncil.php", TRUE, 303);
                     } else if ($_SESSION['role'] == 4) {
                        header("Location: ../03EditCouncil.php?councilIdPk=" . $councilIdPk , TRUE, 303);
                     }
                }
            }
            else {
                throw new Exception("Error - " . $stmt->error);
            }
        }
    }
?>
