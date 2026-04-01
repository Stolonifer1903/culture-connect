<?php
    session_start();
    include 'config.php';
    if (isset($_POST["update"])){
        $bus_id = $_SESSION["role_id"];
        $bus_name = $_POST["businessname"];
        $bus_bio = $_POST["businessbio"] ;
        $bus_email = $_POST["email"] ;
        $bus_phone = $_POST["phone"] ;
        $bus_link = $_POST["website"] ;
        //$counc_id = $_POST["update"];
   
        $stmt = $connection->prepare("UPDATE business SET businessName = ?, businessDescription = ?, businessEmail = ?, businessPhone = ?, businessLink = ? WHERE businessIdPk = ?");
        $stmt->bind_param("sssssi", $bus_name, $bus_bio, $bus_email, $bus_phone, $bus_link, $bus_id);
        //$stmt->execute();

        if ($stmt->execute()) {
            echo "Update successful!";
            echo "Business id: " . $bus_id;
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

            