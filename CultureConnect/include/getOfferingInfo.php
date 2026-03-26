<?php
    include 'config.php';
    if (isset($_GET["of_id_pk"])){
        $of_id_pk = $_GET["of_id_pk"];
        //get offering info from the view_offerings view
        $stmt = $connection->prepare("SELECT * FROM view_offerings WHERE of_id_pk = ?");
        $stmt->bind_param("i", $of_id_pk);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result) {
            $row = $result->fetch_assoc();
            $bus_name = $row["bus_name"];
            $of_name = $row["of_name"] ;
            $int_name = $row["int_name"] ;
            $loc_name = $row["loc_name"] ;
            $of_description = $row["of_description"] ;
            $of_details = $row["of_details"] ;
            $of_cultural_benefits = $row["of_cultural_benefits"] ;
            $of_price_range_description = $row["of_price_range_description"] ; 
            
            // echo $bus_name;
            // echo $of_name;
            // echo $int_name;
            // echo $loc_name;
            // echo $of_description;
            // echo $of_details;
            // echo $of_cultural_benefits;
            // echo $of_price_range_description;

        }
        else {
            echo "Error";
        }
    }
?>