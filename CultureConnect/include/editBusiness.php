<?php
    session_start();
    include 'config.php';
    if (isset($_POST["update"])){
        if (isset($_POST['businessIdPk']) && $_SESSION['role'] == 4) {
            $bus_id = $_POST['businessIdPk'];
        } else {
            $bus_id = $_SESSION["role_id"];
        }

        $bus_name = trim($_POST["businessname"] ?? '');
        $bus_bio = trim($_POST["businessbio"] ?? '');
        $bus_email = trim($_POST["email"] ?? '');
        $bus_phone = trim($_POST["phone"] ?? '');
        $bus_link = trim($_POST["website"] ?? '');
        $counc_name = trim($_POST["council_select"] ?? '');

        if (empty($bus_name) || empty($bus_email) || empty($bus_phone) || empty($bus_link) || empty($counc_name)) {
            header('Location: ../03EditBusiness.php?businessIdPk=' . $bus_id . '&updateError=' . urlencode('Please fill in all required fields.'), TRUE, 303);
            exit;
        }

        //get council id from the council table based on council name using prepared statement
        $stmt_council = $connection->prepare("SELECT councilIdPk FROM council WHERE councilName = ?");
        $stmt_council->bind_param("s", $counc_name);
        $stmt_council->execute();
        $result = $stmt_council->get_result();
        $row = $result->fetch_assoc();
        $council_id = $row["councilIdPk"];
   
        $stmt = $connection->prepare("UPDATE business SET businessName = ?, businessDescription = ?, businessEmail = ?, businessPhone = ?, businessLink = ?, councilIdPk = ? WHERE businessIdPk = ?");
        $stmt->bind_param("sssssii", $bus_name, $bus_bio, $bus_email, $bus_phone, $bus_link, $council_id, $bus_id);

        if ($stmt->execute()) {
            header('Location: ../03EditBusiness.php?businessIdPk=' . $bus_id . '&businessUpdateSuccess=true', TRUE, 303);
            exit;
        } else {
            throw new Exception("Error updating business details for ID: $bus_id - " . $stmt->error);
        }

    }
?>

            