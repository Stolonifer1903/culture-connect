<?php
    include 'config.php';
    include 'getUserInfo.php';

    $main_query = "SELECT offeringIdPk FROM vote WHERE residentIdPk = ?";  
    
    $stmt = $connection->prepare($main_query);
    $stmt->bind_param("i", $role_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result) {
        $liked_offerings = array();
        while ($row = $result->fetch_assoc()) {
            $liked_offerings[] = $row['offeringIdPk'];
        }
    } else {
        throw new Exception("Error fetching liked offerings - " . $stmt->error);
    }
    //echo $close_locations;
?>