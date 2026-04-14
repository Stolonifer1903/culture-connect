<?php
session_start();
include ('config.php');
if (isset($_POST['vote_type'])) {
    $vote_type = $_POST['vote_type'];
    $res_id = $_SESSION['role_id'];
    $of_id = $_POST['of_id'];

    $stmt = $connection->prepare("SELECT vote FROM vote WHERE residentIdPk = ? AND offeringIdPk = ?");
    $stmt->bind_param("ii", $res_id, $of_id);
    $stmt->execute();
    $result = $stmt->get_result();
    if($result && $result->num_rows > 0) {
        $has_voted = true;
    } else {
        $has_voted = false;
    }

    if ($vote_type == 'clear'){
        $stmt = $connection->prepare("DELETE FROM vote WHERE residentIdPk = ? AND offeringIdPk = ?");
        $stmt->bind_param("ii", $res_id, $of_id);
    } else if ($has_voted) {
        $input = $vote_type == 'yes' ? 1 : 0;
        $stmt = $connection->prepare("UPDATE vote SET  vote = ? WHERE residentIdPk = ? AND offeringIdPk = ?");
        $stmt->bind_param("iii", $input, $res_id, $of_id);
    } else {
        $input = $vote_type == 'yes' ? 1 : 0;
        $stmt = $connection->prepare("INSERT INTO vote(vote, residentIdPk, offeringIdPk) VALUES (?, ?, ?)");
        $stmt->bind_param("iii", $input, $res_id, $of_id);
    }
   

    if ($stmt->execute()) {
            header('Location: ../06ViewOffering.php?offeringIdPk=' . $of_id, TRUE, 303);
            exit;
    } else {
        throw new Exception("Error - " . $stmt->error);
    }

} else {
    throw new Exception("Error - " . $stmt->error);
}

?>