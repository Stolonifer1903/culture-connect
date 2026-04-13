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
        $votes = $row['yesVotes'] - $row['noVotes'];
        $picture = ($row['offeringImage']) ? $row['offeringImage'] : 'placeholder.jpg';
         echo "
            <div class='col-12 col-sm-6 col-lg-4 col-xl-3'>
                <div class='card listing-card h-100 border-0 shadow-sm' onclick=\"window.location.href='06ViewOffering.php?offeringIdPk=" . $row['offeringIdPk'] . "'\" style='cursor: pointer;'>
                    <div class='card-body d-flex flex-column gap-2'>

                    <!-- Title + image -->
                    <h5 class='card-title fw-bold mb-0'>" . $row['offeringName']  . "</h5>
                    <p class='fs-6 text-muted mb-0 text-end'>by " . $row['businessName']  . "</p>

                    <!-- Price and type badge -->
                    <div class='d-flex gap-2'>
                        <span class='badge price-moderate align-self-start'>" . $row['offeringPriceRangeDescription']  . "</span>
                        <span class='type-badge align-self-start'>" .  $row['interestAreaName']  . "</span>
                        
                    </div>
                    <span class= 'small align-self-start'><i class='bi bi-geo-alt-fill me-1'></i>" .  $row['locationName']  . "</span>

                    <div style='height: 200px; overflow: hidden;'>
                        <img src='images/offerings/" .$picture. "' class='object-fit-contain border rounded' style='height: 100%; width: 100%'>
                    </div>

                    

                    <!-- Description (clamped) -->
                    <p class='card-text text-muted small clamp-2'>" .  $row['offeringDescription']  . "</p>

                    <!-- Cultural benefits -->
                    <p class='small text-secondary fst-italic mb-0'>
                    🌍 " .  $row['offeringCulturalBenefits']  . "
                    </p>

                    <!-- Vote counts -->
                    <div class='d-flex gap-3 mt-auto pt-2 border-top'>
                    <span class='small text-success fw-semibold'>👍" . $row['yesVotes'] . " Yes</span>
                    <span class='small text-danger  fw-semibold'>👎" .  $row['noVotes'] . " No</span>
                    </div>

                    <!-- Vote button -->
                    <a href='06ViewOffering.php?offeringIdPk=" . $row['offeringIdPk']  . "' class='btn btn-vote btn-sm mt-1'>See more</a>
                </div>
            </div>
        </div>" ;
        
    }
}
?>



<!-- "<div class='col-6 col-md-3' >
    <div class='d-grid gap-2 col-11 mx-auto'>
        <div style='height: 200px; overflow: hidden;'>
            <img src='images/offerings/" .$picture. "' class='object-fit-cover border rounded' style='height: 100%; width: 100%'>
        </div>
        <span><b>" . $row['offeringName']  . "<br>
        </b> by " . $row['businessName']  . "<br>
        <img src='images/thumbs-up-solid-full.svg' height=20px>(" . $votes . ")&nbsp<strong>・</strong>&nbsp" .  $row['interestAreaName']  . "<br>
        Pricing: " . $row['offeringPriceRangeDescription']  . "<br>
        Based in: " . $row['locationName']  . "</span>
        <div class='d-grid col-12'><a href='06ViewOffering.php?offeringIdPk=" . $row['offeringIdPk']  . "' class='btn btn-light'>See more</a></div>
    </div>
</div>"; -->