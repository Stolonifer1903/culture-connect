<?php
    include 'config.php';
    include 'getUserInfo.php';

    $main_query = "SELECT offeringIdPk FROM vote WHERE residentIdPk = ?";  
    
    $stmt = $connection->prepare($main_query);
    $stmt->bind_param("i", $role_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result && $result->num_rows > 0) {
        $liked_offerings = array();
        while ($row = $result->fetch_assoc()) {
            $liked_offerings[] = $row['offeringIdPk'];
        }
    } else {
        throw new Exception("Error - " . $stmt->error);
    }
    //echo $close_locations;
?>