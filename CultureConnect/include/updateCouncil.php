<?php
    session_start();
    include 'config.php';
    if (isset($_POST["update"])){
        $id = $_SESSION["role_id"];
        $name = $_POST["councilname"];
        $bio = $_POST["councilbio"] ;
        $email = $_POST["email"] ;
        $phone = $_POST["phone"] ;
        $link = $_POST["website"] ;
   
        $stmt = $connection->prepare("UPDATE council SET councilName = ?, councilContact = ?, councilLink = ? WHERE councilIdPk = ?");
        $stmt->bind_param("sssi", $name, $email, $link, $id);

        if ($stmt->execute()) {
            echo "Update successful!";
            echo "Council id: " . $id;
            // Check how many rows were affected
            if ($stmt->affected_rows > 0) {
                echo " $stmt->affected_rows row(s) updated.";
            } else {
                echo " No rows were updated (maybe ID doesn't exist or values are the same).";
            }
        } else {
            echo "Error: " . $stmt->error;
        }

    }
?>

            