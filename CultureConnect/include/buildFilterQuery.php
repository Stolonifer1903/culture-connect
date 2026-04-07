<?php
        // include ('getLikedOfferingsInfo.php');
        //get offering info from the view_offerings view
        $main_query = "SELECT * FROM view_offerings ";

        $location_filter = null ;
        $price_filter = null;
        $offerings_filter = null;
        
        if (!empty($selected_locations)) {
            $locations = $selected_locations;
            $locs = "";
            foreach ($locations as $location) {
                $locs = "'" . $location . "', " . $locs;
            }
            $location_filter = " locationName IN (" . substr($locs, 0, -2) . ")";
        }

        if (!empty($selected_prices)) {
            $prices = $selected_prices;
            $pr = "";
            foreach ($prices as $price) {
                $pr = "'" . $price . "', " . $pr;
            }
            $price_filter = " offeringPriceRangeDescription IN (" . substr($pr, 0, -2)  . ")";
        }

        $selected_offerings = array_merge($selected_services,$selected_products);
        if (!empty($selected_offerings)) {
            $offerings = $selected_offerings;
            $off = "";
            foreach ($offerings as $offering) {
                $off = "'" . $offering . "', " . $off;
            }
            $offerings_filter = " interestAreaName IN (" . substr($off, 0, -2)  . ")";
        }
        
        $order_by = " ORDER BY ";
        if (!empty($selected_orderby)) {
            switch ($selected_orderby) {
                case 'popular':
                    $order_by .= "displayVotes DESC";
                    break;
                case 'az':
                    $order_by .= "offeringName ASC";
                    break;
                case 'za':
                    $order_by .= "offeringName DESC";
                    break;
                case '1-9':
                    $order_by .= "offeringPriceRangeDescription ASC";
                    break;
                case '9-1':
                    $order_by .= "offeringPriceRangeDescription DESC";
                    break;
                default:
                    $order_by .= "offeringIdPk";
    }
}

        $conditions = array_filter([$price_filter, $location_filter, $offerings_filter]);
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