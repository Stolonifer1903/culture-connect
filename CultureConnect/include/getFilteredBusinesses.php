<?php
include 'config.php';

$selected_council = $_POST['council'] ?? null;
$selected_orderby = $_POST['orderby'] ?? 'popular';

include 'buildFilterQueryBusinesses.php';                     //get the correct query string

$result_offerings = $connection->query($filter_query); //get the results from the database based on the query string

//fill the html grid
if ($result_offerings->num_rows == 0){              //if there are no results
    echo "<p>Oops - nothing available at the moment</p>"; //return text string in the grid
} else {                                            //if there are results
    while ($row = $result_offerings->fetch_assoc()) { //loop through the results and fill the grid
        // $picture = ($row['offeringImage']) ? $row['offeringImage'] : 'placeholder.jpg';
         //get council info
        $stmt = $connection->prepare("SELECT * FROM council WHERE councilIdPk = ?");
        $stmt->bind_param("i", $row['councilIdPk']);
        $stmt->execute();
        $resultC = $stmt->get_result();
        
        if ($resultC && $resultC->num_rows > 0) {
            $rowC = $resultC->fetch_assoc();
            $counc_name = $rowC["councilName"];
        } else {
            $counc_name = "";
        }
         echo "
            <div class='col-12 col-sm-6 col-lg-3'>
                <div class='card listing-card h-100 border-0 shadow-sm' onclick=\"window.location.href='07ViewBusiness.php?businessIdPk=" . $row['businessIdPk'] . "'\" style='cursor: pointer;'>
                    <div class='card-body d-flex flex-column gap-2'>

                    <!-- Title + location -->
                    <h5 class='card-title fw-bold mb-0'>" . $row['businessName']  . "</h5>
                    <span class= 'small align-self-start'><i class='bi bi-geo-alt-fill me-1'></i>" .  $counc_name  . "</span>

                    <!-- Business Info -->
                    <span class='meta-item small'>
                        <i class='bi bi-envelope-fill me-1'></i>
                        <a href='mailto:" .  $row['businessEmail']  . "' id='vendor-email' class='text-decoration-none'>
                        " .  $row['businessEmail']  . "
                        </a>
                    </span>

                    <span class='meta-item small'>
                        <i class='bi bi-telephone-fill me-1'></i>
                        <span id='vendor-phone'>" .  $row['businessPhone']  . "</span>
                    </span>

                    <!-- Description (clamped) -->

                    <span class='meta-item small'>
                        <i class='bi bi-info-circle-fill'></i>
                        <span class='small text-secondary fst-italic mb-0' id='vendor-phone'>" .  $row['businessDescription']  . "</span>
                    </span>

                    <!-- Go to business page -->
                    <a href='07ViewBusiness.php?businessIdPk=" . $row['businessIdPk']  . "' class='btn btn-vote btn-sm mt-1'>See more</a>
                </div>
            </div>
        </div>" ;
        
    }
}
?>
