
<?php
    session_start();
    include 'config.php';
    if (isset($_POST["Add"])){
        $addLocation=$_POST["addLocation"];
    } else {
        throw new Exception("Error - Location name not provided for addition");
    }

    if (isset($_SESSION['role']) || isset($_SESSION['role_id'])){
        if ($_SESSION['role'] == 3) {
        $council = $_SESSION['role_id'];
        } else if (isset($_POST["councilIdPk"]) && $_SESSION['role'] == 4){
            $council = $_POST["councilIdPk"];
        } else {
            throw new Exception("Error - Unauthorized attempt to add location (Role: " . ($_SESSION['role'] ?? 'None') . ")");
        }
        
        $stmt = $connection->prepare("INSERT INTO location(councilIdPk, locationName) VALUES (?, ?)");
        $stmt->bind_param("is", $council, $addLocation);

        if ($stmt->execute()) {
            if ($_SESSION['role'] == 3) {
            header('Location: ../03EditCouncil.php?locationAddSuccess=true', TRUE, 303);
            } else if ($_SESSION['role'] == 4) {
            header('Location: ../03EditCouncil.php?councilIdPk=' . $council . '&locationAddSuccess=true', TRUE, 303); 
            }
        } else {
            throw new Exception("Error inserting location '$addLocation' for council ID: $council - " . $stmt->error);
        }
    } else {
            throw new Exception("Error - Session not established or user not logged in during location addition");
    }
?>