<?php
    include 'config.php';
    if (isset($_GET["offeringIdPk"])){
        $of_id_pk = $_GET["offeringIdPk"];
        //get offering info from the view_offerings view
        $stmt = $connection->prepare("SELECT * FROM view_offerings WHERE offeringIdPk = ?");
        $stmt->bind_param("i", $of_id_pk);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result) {
            $row = $result->fetch_assoc();
            $bus_name = $row["businessName"];
            $of_name = $row["offeringName"] ;
            $int_name = $row["interestAreaName"] ;
            $loc_name = $row["locationName"] ;
            $of_description = $row["offeringDescription"] ;
            $of_details = $row["offeringDetails"] ;
            $of_cultural_benefits = $row["offeringCulturalBenefits"] ;
            $of_awards = $row["offeringAwards"] ; 
            $of_price_range_description = $row["offeringPriceRangeDescription"] ; 
            $of_yes_votes = $row["yesVotes"];
            $of_no_votes = $row["noVotes"];
            $votes = $of_yes_votes - $of_no_votes;
            
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
            throw new Exception("Error - " . $stmt->error);
        }
    } else {
        $bus_name = "";
        $of_name = "";
        $int_name = "";
        $loc_name = "";
        $of_description = "";
        $of_details = "";
        $of_cultural_benefit = "";
        $of_awards = "";
        $of_price_range_description = "";
        $of_yes_votes = 0;
        $of_no_votes = 0;
        $votes = $of_yes_votes - $of_no_votes;
    }
?>