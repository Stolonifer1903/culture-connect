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
        $counc_name = $_POST["council_select"];

        //get council id from the council table based on council name
        // TODO fix against SQL injection
        $sql = "SELECT councilIdPk FROM council WHERE councilName = '$counc_name' ";
        $result = $connection->query($sql);
        $row = $result->fetch_assoc();
        $council_id = $row["councilIdPk"];
   
        $stmt = $connection->prepare("UPDATE business SET businessName = ?, businessDescription = ?, businessEmail = ?, businessPhone = ?, businessLink = ?, councilIdPk = ? WHERE businessIdPk = ?");
        $stmt->bind_param("sssssii", $bus_name, $bus_bio, $bus_email, $bus_phone, $bus_link, $council_id, $bus_id);

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
            throw new Exception("Error - " . $stmt->error);
        }

    }
?>

            