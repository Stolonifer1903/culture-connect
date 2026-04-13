
<?php
    session_start();
    include 'config.php';
    if (isset($_POST["Add"])){
        $addLocation=$_POST["addLocation"];
    } else {
        throw new Exception("Error - location not added" );
    }

    if (isset($_SESSION['role']) || isset($_SESSION['role_id'])){
        if ($_SESSION['role'] == 3) {
        $council = $_SESSION['role_id'];
        } else if (isset($_POST["councilIdPk"]) && $_SESSION['role'] == 4){
            $council = $_POST["councilIdPk"];
        } else {
            throw new Exception("Error - not authorised" );
        }
        
        $stmt = $connection->prepare("INSERT INTO location(councilIdPk, locationName) VALUES (?, ?)");
        $stmt->bind_param("is", $council, $addLocation);

        if ($stmt->execute()) {
            if ($_SESSION['role'] == 3) {
            header('Location: ../03EditCouncil.php', TRUE, 303);
            } else if ($_SESSION['role'] == 4) {
            header('Location: ../03EditCouncil.php?councilIdPk=' .$council, TRUE, 303); 
            }
        } else {
            throw new Exception("Error - " . $stmt->error);
        }
    } else {
            throw new Exception("Error - " . $stmt->error);
    }
?>