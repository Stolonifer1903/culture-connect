
<?php
    session_start();
    include 'config.php';
    if (isset($_POST["Add"])){
        $addLocation=$_POST["addLocation"];
        $council = $_SESSION['role_id'];
        
        $stmt = $connection->prepare("INSERT INTO location(councilIdPk, locationName) VALUES (?, ?)");
        $stmt->bind_param("is", $council, $addLocation);

        if ($stmt->execute()) {
            header('Location: ../03EditCouncil.php', TRUE, 303);
            exit;
        } else {
            echo "Error - " . $stmt->error;
        }
    }
?>