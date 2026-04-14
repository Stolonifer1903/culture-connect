<?php
    session_start();
    include 'config.php';
    if (isset($_POST["update"])){
        // Determine which ID to update
        if (isset($_POST["councilIdPk"]) && $_SESSION['role'] == 4) {
            // Admin can update any council
            $id = $_POST["councilIdPk"];
        } else {
            // Regular users can only update their own council
            $id = $_SESSION["role_id"];
        }

        $name = $_POST["councilname"];
        $email = $_POST["email"] ;
        $link = $_POST["website"] ;
   
        $stmt = $connection->prepare("UPDATE council SET councilName = ?, councilContact = ?, councilLink = ? WHERE councilIdPk = ?");
        $stmt->bind_param("sssi", $name, $email, $link, $id);

        if ($stmt->execute()) {
            header('Location: ../03EditCouncil.php?councilIdPk=' . $id . '&councilUpdateSuccess=true', TRUE, 303);
            exit;
        } else {
            throw new Exception("Error updating council details for ID: $id - " . $stmt->error);
        }

    }
?>

            