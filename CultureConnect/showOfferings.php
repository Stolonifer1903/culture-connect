<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View products and services</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link href="css/styleOfferings.css" rel="stylesheet">
</head>
<body>
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
    include 'include/getUserInfo.php'; 
    include 'include/getCloseLocationInfo.php'; 
    ?>
    
     <!-- Gets the header from a central location -->
    <div id="header"><?php include('templates/template_navbar.php'); ?></div>
    <section class="text-center py-4">
        <h1>Browse cultural events and products</h1>
    </section>
    <section class="py-3">
        <div class="container">
            <div class="input-group mb-2">
                <input type="text" class="form-control" placeholder="Search offerings">
                <button class="btn btn-light" type="button">Search</button>
                <br>
            </div>
            <div style="margin-top:5px; margin-right:5px;">
                <span style="margin-left:10px; margin-right:30px">Quick filters:</span>
                <button type="button" class="btn btn-dark btn-sm" data-bs-toggle="button" style="margin-right:5px;" onclick="toggleAll('products', this)" id="allProducts">Show all products</button>
                <button type="button" class="btn btn-dark btn-sm" data-bs-toggle="button" style="margin-right:5px;" onclick="toggleAll('services', this)" id="allServices">Show all services</button>
                <button type="button" class="btn btn-dark btn-sm" data-bs-toggle="button" style="margin-right:5px;" onclick="toggleCloseToMe(this)" id="closeToMe">Close to me</button>
                <button type="button" class="btn btn-dark btn-sm" data-bs-toggle="button" style="margin-right:5px;" onclick="toggleABitFurtherAway(this)" id="furtherAway">A bit further away</button>
                <button type="button" class="btn btn-dark btn-sm" data-bs-toggle="button" style="margin-right:5px;" onclick="toggleMyInterests(this)" id="myInterests">My interests</button>
                <button type="button" class="btn btn-dark btn-sm" data-bs-toggle="button" style="margin-right:5px;" onclick="toggleMyInterests(this)" id="myLiked">My liked items</button>
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
                <h2><span>Filters<button type="button" class="btn btn-danger btn-sm" style="margin-left:20px" onclick="window.location.href='showOfferings.php';">Clear all filters</button></span></h2>
                <hr>
                <?php
                $location_open = !empty($selected_locations) ? 'true' : 'false';
                $location_show = !empty($selected_locations) ? 'show' : '';
                ?>
                <a class='collapse-heading' data-bs-toggle='collapse' href='#location_select' role='button' aria-expanded='<?php echo $location_open;?>' aria-controls='location_select'>
                    <h4>Locations<img src=images/expand.svg height="30px" width="30px" style="float: right;"></h4></a>
                </p>
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
                                echo "<br><h6>" . $council . "</h6>
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
                <p>
                <?php
                $price_open = !empty($selected_prices) ? 'true' : 'false';
                $price_show = !empty($selected_prices) ? 'show' : '';
                ?>
                <a class="collapse-heading" data-bs-toggle="collapse" href="#price_select" role="button" aria-expanded="<?php echo $price_open; ?>" aria-controls="price_select">
                    <h4>Price range<img src=images/expand.svg height="30px" width="30px" style="float: right;"></h4></a>
                </p>
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
                <p>
                <?php
                $services_open = !empty($selected_services) ? 'true' : 'false';
                $services_show = !empty($selected_services) ? 'show' : '';
                ?>
                <a class="collapse-heading" data-bs-toggle="collapse" href="#services_select" role="button" aria-expanded="<?php echo $services_open; ?>" aria-controls="services_select">
                    <h4>Services<img src=images/expand.svg height="30px" width="30px" style="float: right;"></h4></a>
                </p>
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
                <p>
                <?php
                $products_open = !empty($selected_products) ? 'true' : 'false';
                $products_show = !empty($selected_products) ? 'show' : '';
                ?>
                <a class="collapse-heading" data-bs-toggle="collapse" href="#products_select" role="button" aria-expanded="<?php echo $products_open; ?>" aria-controls="products_select">
                    <h4>Products<img src=images/expand.svg height="30px" width="30px" style="float: right;"></h4></a>
                </p>
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
                <input type="hidden" id="orderby" name="orderby" value="popular">
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
    //<!-- declare script constants
        const closeToMeButton = document.getElementById('closeToMe');
        const furtherAwayButton = document.getElementById('furtherAway');
        const allProductsButton = document.getElementById('allProducts');
        const allServicesButton = document.getElementById('allServices');
        const myInterestsButton = document.getElementById('myInterests');
        const myLikedButton = document.getElementById('myLiked');

    
    //<!--get the toggle filter state and call getFilteredOfferings.php -->
        function applyFilters() {
            const form = document.getElementById('filters'); //gets the filters form 
            const formData = new FormData(form);            //gets the info from the form

            console.log('orderby value:', document.getElementById('orderby').value);
            console.log('formData orderby:', formData.get('orderby'));
            
            const params = new URLSearchParams(formData);   //converts the form data to URLSearchParams query string
            history.pushState(null, '', 'showOfferings.php?' + params.toString()); //creates a weblink

            fetch('include/getFilteredOfferings.php', {     //gets the filtered offerings from the db without reloading the page
                method: 'POST',
                body: formData
            })
            .then(r => r.text())                            //when the query completes, gets the response and converts it to text
            .then(html => {                                 //then inserts the text as html into the grid
                document.getElementById('product-grid').innerHTML = html;
            });
        }
    
    //<!-- toggle show all products / show all services buttons -->
        function toggleAll(name, btn) {
        const checkboxes = document.querySelectorAll('input[name="' + name + '[]"]');   //get all the products or services checkboxes
        const allChecked = Array.from(checkboxes).every(cb => cb.checked);              //returns true if all of the boxes are checked
        checkboxes.forEach(cb => cb.checked = !allChecked);                             //checks or unchecks every box depending on allChecked state (does the opposite)
        btn.classList.toggle('active', !allChecked);                                    //toggles the button depending on allChecked state (does the opposite)
        myInterestsButton.classList.toggle('active',false); 
        myLikedButton.classList.toggle('active',false); 
        applyFilters();                                                                 //fills the grid
        }

    //<!-- toggle close to me button -->
        function toggleCloseToMe(btn) {
        const checkboxes = document.querySelectorAll('input[name="locations[]"]'); //gets all the locations checkboxes
        checkboxes.forEach(cb => cb.checked = false);                               //uncheck all the boxes
        const myLocation = "<?php echo "" . $location_name . ""; ?>"; //get the location from the database
        const checkbox = document.querySelector('input[name="locations[]"][value="' + myLocation + '"]');             //finds the checkbox of the location                        
        const isToggled = btn.classList.contains('active');
        if (isToggled) {
            if (checkbox) checkbox.checked = true;
            furtherAwayButton.classList.toggle('active',false);
        }
        applyFilters();
        }

    //<!-- toggle a bit further away button -->
        function toggleABitFurtherAway(btn) {
        const checkboxes = document.querySelectorAll('input[name="locations[]"]'); //gets all the locations checkboxes
        checkboxes.forEach(cb => cb.checked = false);                               //uncheck all the boxes
        const myLocations = <?php echo json_encode($close_locations); ?>; //get the close locations from the database                   
        const isToggled = btn.classList.contains('active');
        if (isToggled) {
            myLocations.forEach(location => {
                const checkbox = document.querySelector('input[name="locations[]"][value="' + location + '"]');
                if (checkbox) checkbox.checked = true;   
            })
            closeToMeButton.classList.toggle('active',false); 
        }
        applyFilters();
        }

    //<!-- toggle my interests button -->
        function toggleMyInterests(btn) {
        const checkboxes = document.querySelectorAll('input[name="products[]"], input[name="services[]"]'); //gets all the products and services checkboxes
        checkboxes.forEach(cb => cb.checked = false);                           //uncheck all the boxes
        const myInterests = <?php echo json_encode($interests); ?>; //get the user interests from the database                   
        const isToggled = btn.classList.contains('active');
        if (isToggled) {
            myInterests.forEach(interest => {
                const productsCheckbox = document.querySelector('input[name="products[]"][value="' + interest + '"]');
                if (productsCheckbox) productsCheckbox.checked = true;   
                const servicesCheckbox = document.querySelector('input[name="services[]"][value="' + interest + '"]');
                if (servicesCheckbox) servicesCheckbox.checked = true; 
            })
            allProducts.classList.toggle('active',false); 
            allServices.classList.toggle('active',false); 
        }
        applyFilters();
        }

    //<!-- set the order by input -->
        function setOrderBy(input, btn){
            const popularButton = document.getElementById('popular');
            const azButton = document.getElementById('az');
            const zaButton = document.getElementById('za');
            const prAscButton = document.getElementById('1-9');
            const prDsButton = document.getElementById('9-1');

            //untoggle all buttons
            popularButton.classList.toggle('active',false); 
            azButton.classList.toggle('active',false); 
            zaButton.classList.toggle('active',false); 
            prAscButton.classList.toggle('active',false); 
            prDsButton.classList.toggle('active',false); 

            btn.classList.toggle('active', true)                //toggle the clicked button

            document.getElementById('orderby').value = input;   //set the input value

            applyFilters();                                     //fill the grid
        }

    //<!-- add event listener to handle backwards and forwards browsing -->
        window.addEventListener('popstate', function(){                                     //whenever the user hits the back button
            const params = new URLSearchParams(window.location.search);                     //gets the URL search params from the current page

            document.querySelectorAll('#filters input[type="checkbox"]').forEach(cb=> {     //uncheck every checkbox in the filters form
                cb.checked = false;
            });

            for (const [key, value] of params) {                                            //for each parameter and value in the params string, 
                const checkbox = document.querySelector('input[name="' + key + '"][value="' + value + '"]');             //find a checkbox with the key and value                          
                if (checkbox) checkbox.checked = true;                                      //if there is a matching checkbox, check it
            }

            //get the filtered offerings again from the url
            fetch('include/getFilteredOfferings.php', {     //gets the filtered offerings from the db without reloading the page
                method: 'POST',
                body: params
            })
            .then(r => r.text())                            //when the query completes, gets the response and converts it to text
            .then(html => {                                 //then inserts the text as html into the grid
                document.getElementById('product-grid').innerHTML = html;
            });

        })
    </script>
    
</body>
</html>