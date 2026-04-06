<?php
    include 'config.php';
    //get list of councils from council table
    $main_query = "SELECT * FROM view_locations";  
    
    $stmt = $connection->prepare($main_query);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result && $result->num_rows > 0) {
    } else {
        throw new Exception("Error - " . $stmt->error);
    }
?>