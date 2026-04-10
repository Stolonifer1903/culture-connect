<?php
        // include ('getLikedOfferingsInfo.php');
        //get offering info from the view_offerings view
        $main_query = "SELECT * FROM business ";

        $location_filter = null;

        if (!empty($selected_council)) {
            $council_id = intval($selected_council);
            $location_filter = " councilIdPk = " . $council_id;
        }
        
        $order_by = " ORDER BY LOWER (";
        if (!empty($selected_orderby)) {
            switch ($selected_orderby) {
                // case 'popular':
                //     $order_by = "ORDER BY CAST(displayVotes AS SIGNED) DESC";
                //     break;
                case 'az':
                    $order_by .= "businessName) ASC";
                    break;
                case 'za':
                    $order_by .= "businessName) DESC";
                    break;
                // case '1-9':
                //     $order_by .= "offeringPriceRangeDescription) ASC";
                //     break;
                // case '9-1':
                //     $order_by .= "offeringPriceRangeDescription) DESC";
                //     break;
                default:
                    $order_by .= "businessIdPk)";
    }
}

        $conditions = array_filter([$location_filter]);
        if (!empty($conditions)) {
            $filter_query = $main_query . " WHERE " . implode(" AND ", $conditions) . " " . $order_by;
        // } else if (!empty($liked_offerings)) {
        //     $filter_query = $main_query . " WHERE offeringIdPk IN (" . implode("," , $liked_offerings) . ")" . $order_by;
        }else {
            $filter_query = $main_query . $order_by;
        }
        
        //echo "Price filter is:" . $price_filter;
        //echo "<br>Location filter is: " . $location_filter;
        //echo "<br>Full query is: " . $filter_query . "<br>";
        //error_log("Query: " . $filter_query);
?>