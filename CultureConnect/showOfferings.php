<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View products and services</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <!-- <link href="css/styleOfferings.css" rel="stylesheet"> -->
    <link href="css/offeringItemStyle.css" rel="stylesheet">
</head>
<body onload="userVisibility()">
    <?php
    session_start();
    include ('include/config.php');
    $selected_locations = $_GET['locations'] ?? [];
    $selected_prices = $_GET['prices'] ?? [];
    $selected_services = $_GET['services'] ?? [];
    $selected_products = $_GET['products'] ?? [];
    $selected_orderby = $_GET['orderby'] ?? 'popular';

    include('include/buildFilterQuery.php');
    //echo "<br>Full query is: " . $filter_query;
    if (isset($_SESSION['role'])) {
        if ($_SESSION['role'] == 1) {
        include 'include/getUserInfo.php'; 
        include 'include/getCloseLocationInfo.php'; 
        //
        }
    } else {
        //
    }
    ?>
    
     <!-- Gets the header from a central location -->
    <div id="header"><?php include('templates/template_navbar.php'); ?></div>
    <section class="text-center py-4" style="background-color:#3A5A40;">
        <div class="container">
            <h1 style="color:white">Browse cultural events and products</h1>
            <p style="color:white">See what's on offer locally or a bit further away</p>
        </div>
    </section>
    <section class="py-3">
        <div class="container">
            <div class="input-group mb-2">
                <input type="text" class="form-control" id="search_input" placeholder="Search offerings">
                <button class="btn btn-light" type="button" onclick="doSearch()">Search</button>
                <br>
            </div>
            <div style="margin-top:5px; margin-right:5px;">
                <span style="margin-left:10px; margin-right:30px">Quick filters:</span>
                <button type="button" class="btn btn-dark btn-sm" data-bs-toggle="button" style="margin-right:5px;" onclick="toggleAll('products', this, false)" id="allProducts">Show all products</button>
                <button type="button" class="btn btn-dark btn-sm" data-bs-toggle="button" style="margin-right:5px;" onclick="toggleAll('services', this, false)" id="allServices">Show all services</button>
                <button type="button" class="btn btn-dark btn-sm" data-bs-toggle="button" style="margin-right:5px;" onclick="toggleCloseToMe(this)" id="closeToMe">Close to me</button>
                <button type="button" class="btn btn-dark btn-sm" data-bs-toggle="button" style="margin-right:5px;" onclick="toggleABitFurtherAway(this)" id="furtherAway">A bit further away</button>
                <button type="button" class="btn btn-dark btn-sm" data-bs-toggle="button" style="margin-right:5px;" onclick="toggleMyInterests(this)" id="myInterests">My interests</button>
                <button type="button" class="btn btn-dark btn-sm" data-bs-toggle="button" style="margin-right:5px;" onclick="togglemyVoted(this)" id="myVoted">My voted items</button>
            </div>
            <div style="margin-top:5px; margin-right:5px;">
                <span style="margin-left:10px; margin-right:30px">Sort:</span>
                <button type="button" class="btn btn-dark btn-sm" data-bs-toggle="button" style="margin-right:5px;" onclick="setOrderBy(this.id, this)" id="popular">Popular</button>
                <button type="button" class="btn btn-dark btn-sm" data-bs-toggle="button" style="margin-right:5px;" onclick="setOrderBy(this.id, this)" id="az">A -> Z</button>
                <button type="button" class="btn btn-dark btn-sm" data-bs-toggle="button" style="margin-right:5px;" onclick="setOrderBy(this.id, this)" id="za">Z -> A</button>
                <button type="button" class="btn btn-dark btn-sm" data-bs-toggle="button" style="margin-right:5px;" onclick="setOrderBy(this.id, this)" id="1-9">Price (ascending)</button>
                <button type="button" class="btn btn-dark btn-sm" data-bs-toggle="button" style="margin-right:5px;" onclick="setOrderBy(this.id, this)" id="9-1">Price (descending)</button>
            </div>
        </div>
    </section>
    <section class="row flex-xl-nowrap mx-0">
        <div class="col-12 col-md-2 bd-sidebar">
            <form id="filters" name="filters" action="showOfferings.php" method="get">
                <div class='d-flex justify-content-between align-items-center'>
                    <h2 class='mb-0'>Filters</h2>
                    <button type="button" class="btn btn-danger btn-sm" onclick="window.location.href='showOfferings.php';">Clear all filters</button>
                </div>
                <hr>
                <?php
                $location_open = !empty($selected_locations) ? 'true' : 'false';
                $location_show = !empty($selected_locations) ? 'show' : '';
                ?>
                <a class='collapse-heading text-dark text-decoration-none d-flex justify-content-between align-items-center' data-bs-toggle='collapse' href='#location_select' role='button' aria-expanded='<?php echo $location_open;?>' aria-controls='location_select'>
                    <b>Locations</b><i class="bi bi-chevron-down"></i></a>
                <div class="row">
                    <div class="col">
                        <div class="collapse multi-collapse <?php echo $location_show; ?>" id="location_select"> 
                        <?php
                        include ('include/getLocationInfo.php');
                        $prev_council = '';
                        while ($row = $result->fetch_assoc()) {
                            $council = $row['councilName'];
                            $location = $row['locationName'];
                            $location_id = $row['locationIdPk'];
                            $checked = '';
                            if (isset ($selected_locations) && in_array($location, $selected_locations)) {
                                $checked = 'checked';
                            }
                            if ($council == $prev_council) {
                                echo "<input type='checkbox' id='" . $location . "' name='locations[]' value='" . $location . "' " . $checked . "  onChange='applyFilters()';>
                                    <label for='" . $location . "'>" . $location . "</label><br>";  
                            } else {
                                echo "<h6 style='margin-top:5px; margin-bottom:5px;'>" . $council . "</h6>
                                    <input type='checkbox' id='" . $location . "' name='locations[]' value='" . $location . "' " . $checked . "  onChange='applyFilters()'>
                                    <label for='" . $location . "'>" . $location . "</label><br>";                           
                            }
                            $prev_council=$council;
                        }
                        ?>
                        </div>
                    </div>
                </div>
                <hr>
                <?php
                $price_open = !empty($selected_prices) ? 'true' : 'false';
                $price_show = !empty($selected_prices) ? 'show' : '';
                ?>
                <a class='collapse-heading text-dark text-decoration-none d-flex justify-content-between align-items-center' data-bs-toggle='collapse' href='#price_select' role='button' aria-expanded='<?php echo $location_open;?>' aria-controls='location_select'>
                    <b>Price range</b><i class="bi bi-chevron-down"></i></a>
                <div class="row">
                    <div class="col">
                        <div class="collapse multi-collapse <?php echo $price_show; ?>" id="price_select">
                            <?php
                            $query = "SELECT * FROM offeringpricing";  
                            $stmt = $connection->prepare($query);
                            $stmt->execute();
                            $result = $stmt->get_result();

                            if($result && $result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    $price_cat = $row['offeringPriceRangeDescription'];
                                    $price_id = $row['offeringPriceRange'];
                                    $checked = '';
                                    if (isset ($selected_prices) && in_array($price_cat, $selected_prices)) {
                                            $checked = 'checked';
                                        }
                                    echo "<input type='checkbox' id='" . $price_cat . "' name='prices[]' value='" . $price_cat . "' " . $checked . "  onChange='applyFilters()'>
                                    <label for='" . $price_cat . "'>" . $price_cat . "</label><br>";
                                }
                            } else {
                                throw new Exception("Error - " . $stmt->error);
                            }
                            ?>
                            
                        </div>
                    </div>
                </div>
                <hr>
                <?php
                $services_open = !empty($selected_services) ? 'true' : 'false';
                $services_show = !empty($selected_services) ? 'show' : '';
                ?>
                <a class='collapse-heading text-dark text-decoration-none d-flex justify-content-between align-items-center' data-bs-toggle='collapse' href='#services_select' role='button' aria-expanded='<?php echo $location_open;?>' aria-controls='location_select'>
                    <b>Services</b><i class="bi bi-chevron-down"></i></a>
                <div class="row">
                    <div class="col">
                        <div class="collapse multi-collapse <?php echo $services_show; ?>" id="services_select">
                            <?php
                            $query = "SELECT * FROM interestarea WHERE InterestAreaProductOrService=2";  
                            
                            $stmt = $connection->prepare($query);
                            $stmt->execute();
                            $result = $stmt->get_result();

                            if($result && $result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    $interest_area = $row['interestAreaName'];
                                    $checked = '';
                                    if (isset ($selected_services) && in_array($interest_area, $selected_services)) {
                                            $checked = 'checked';
                                        }
                                    echo "<input type='checkbox' id='" . $interest_area . "' name='services[]' value='" . $interest_area . "' " . $checked . "  onChange='applyFilters()'>
                                    <label for='" . $interest_area . "'>" . $interest_area . "</label><br>";
                                }
                            } else {
                                throw new Exception("Error - " . $stmt->error);
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <hr>
                <?php
                $products_open = !empty($selected_products) ? 'true' : 'false';
                $products_show = !empty($selected_products) ? 'show' : '';
                ?>
                <a class='collapse-heading text-dark text-decoration-none d-flex justify-content-between align-items-center' data-bs-toggle='collapse' href='#products_select' role='button' aria-expanded='<?php echo $location_open;?>' aria-controls='location_select'>
                    <b>Products</b><i class="bi bi-chevron-down"></i></a>
                <div class="row">
                    <div class="col">
                        <div class="collapse multi-collapse <?php echo $products_show; ?>" id="products_select">
                            <?php
                            $query = "SELECT * FROM interestarea WHERE InterestAreaProductOrService=1";  
                            
                            $stmt = $connection->prepare($query);
                            $stmt->execute();
                            $result = $stmt->get_result();

                            if($result && $result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    $interest_area = $row['interestAreaName'];
                                    $checked = '';
                                    if (isset ($selected_products) && in_array($interest_area, $selected_products)) {
                                            $checked = 'checked';
                                        }
                                    echo "<input type='checkbox' id='" . $interest_area . "' name='products[]' value='" . $interest_area . "' " . $checked . "  onChange='applyFilters()'>
                                    <label for='" . $interest_area . "'>" . $interest_area . "</label><br>";
                                }
                            } else {
                                throw new Exception("Error - " . $stmt->error);
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <input type="hidden" id="orderby" name="orderby" value="popular"> <!-- order by search terms -->
                <input type="hidden" id="search_term" name="search_term" value=""> <!-- search bar input -->
            </form>
            <hr>
        </div>
        <!-- get all available offerings-->
        <div class="col-12 col-md-8 py-md-1 ">
            <div class="row g-1 mb-4" id="product-grid">
                <?php
                include 'include/getFilteredOfferings.php';
                ?>
            </div>
        </div>
    </section>
    <!-- Gets the footer from a central location -->
    <div id="footer"><?php include('templates/template_footer.php'); ?></div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script>
    // set variables needed in applyFiltersViewOfferings.js that need PHP
    const role = <?php echo json_encode($_SESSION['role'] ?? null); ?>;
    const myLocation = "<?php echo $location_name ?? ''; ?>";
    const myLocations = <?php echo json_encode($close_locations ?? []); ?>;
    const myInterests = <?php echo json_encode($interests ?? []); ?>;
    const councilLocations = <?php echo json_encode($council_locations ?? []); ?>;
    </script>
    <script src="js/applyFiltersViewOfferings.js"></script>
    
</body>
</html>