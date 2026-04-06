<?php
include 'config.php';

$selected_locations = $_POST['locations'] ?? [];    //return selected locations or an empty array
$selected_prices = $_POST['prices'] ?? [];          //return selected prices or an empty array
$selected_products = $_POST['products'] ?? [];      //return selected products or an empty array
$selected_services = $_POST['services'] ?? [];      //return selected services or an empty array
$selected_orderby = $_POST['orderby'] ?? 'popular';

include 'buildFilterQuery.php';                     //get the correct query string

$result_offerings = $connection->query($filter_query); //get the results from the database based on the query string

//fill the html grid
if ($result_offerings->num_rows == 0){              //if there are no results
    echo "<p>Oops - nothing available at the moment</p>"; //return text string in the grid
} else {                                            //if there are results
    while ($row = $result_offerings->fetch_assoc()) { //loop through the results and fill the grid
         echo 
        "<div class='col-6 col-md-3' >
            <div class='d-grid gap-2 col-11 mx-auto'>
                <p>
                <div style='height: 250px; overflow: hidden;'>
                    <img src='images/placeholder.jpg' class='object-fit-cover border rounded' style='height: 90%; width: 90%'>
                </div>
                <h5>" . $row['offeringName']  . "</h5>
                <span>" . $row['interestAreaName']  . "</span>
                <h6><a href=''>" . $row['businessName']  . "</a></h6>
                <span>Based in <a href=''>" . $row['locationName']  . "</a></span>
                <p>Pricing: " . $row['offeringPriceRangeDescription']  . "</p>
                <table width='50%'>
                    <tr>
                        <td width='40%'>Vote:</td>
                        <td width='20%'><a href=''><img src='images/upvote.svg'></a></td>
                        <td width='20%'><a href=''><img src='images/downvote.svg'></a></td>
                        <td width='20%'><a href=''><img src='images/clearvote.svg'></a></td>
                    </tr>
                    <tr>
                        <td width='40%'></td>
                        <td width='20%'>10</td>
                        <td width='20%'>5</a></td>
                        <td width='20%'></td>
                    </tr>
                </table>
                <div class='d-grid col-10'><a href='06ViewOffering.php?offeringIdPk=" . $row['offeringIdPk']  . "' class='btn btn-light'>See more</a></div>
                <p>
            </div>
        </div>";
    }
}
?>