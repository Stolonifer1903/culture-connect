<?php
    include 'config.php';
    include 'getUserInfo.php';
    //get list of councils from council table

    $main_query = "SELECT locationName FROM view_locations WHERE councilName = (SELECT councilName from view_Locations WHERE locationName = ?)";  
    
    $stmt = $connection->prepare($main_query);
    $stmt->bind_param("s", $location_name);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result && $result->num_rows > 0) {
        $close_locations = array();
        while ($row = $result->fetch_assoc()) {
            $close_locations[] = $row['locationName'];
        }
    } else {
        throw new Exception("Error - " . $stmt->error);
    }
    //echo $close_locations;
?>