<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View businesses</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <!-- <link href="css/styleOfferings.css" rel="stylesheet"> -->
    <link href="css/offeringItemStyle.css" rel="stylesheet">
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
    if (isset($_SESSION['role'])) {
        if ($_SESSION['role'] == 1) {
        include 'include/getUserInfo.php'; 
        include 'include/getCloseLocationInfo.php'; 
        //
        }
    } else {
        //
    }

    $council_locations = [];
    $sql = "SELECT c.councilIdPk, l.locationName FROM council c JOIN location l ON c.councilIdPk = l.councilIdPk";
    $result = $connection->query($sql);
    while ($row = $result->fetch_assoc()) {
        $council_locations[$row['councilIdPk']][] = $row['locationName'];
    }
    ?>
    
     <!-- Gets the header from a central location -->
    <div id="header"><?php include('templates/template_navbar.php'); ?></div>
    <section class="text-center py-4" style="background-color:#3A5A40;">
        <div class="container">
            <h1 style="color:white">Browse cultural businesses</h1>
            <p style="color:white">See local artisans and their offerings</p>
        </div>
    </section>
    <section class="py-3">
        <div class="container">
            <div class="input-group mb-2">
                <input type="text" class="form-control" placeholder="Search businesses">
                <button class="btn btn-light" type="button">Search</button>
                <br>
            </div>
            <div style="margin-top:5px; margin-right:5px;">
                <span style="margin-left:10px; margin-right:30px">Quick filters:</span>
                <?php
                $sql = "SELECT councilIdPk, councilName FROM council";
                $result = $connection->query($sql);
                while ($row = $result->fetch_assoc()) {
                    echo "<button type='button' class='btn btn-dark btn-sm' data-bs-toggle='button' style='margin-right:5px; margin-bottom:5px' 
                        onclick='toggleCouncil(" . $row['councilIdPk'] . ", this)' 
                        id='council-" . $row['councilIdPk'] . "'>" . $row['councilName'] . "</button>";
                }
                ?>
            </div>
            <div style="margin-top:5px; margin-right:5px;">
                <span style="margin-left:10px; margin-right:30px">Sort:</span>
                <button type="button" class="btn btn-dark btn-sm" data-bs-toggle="button" style="margin-right:5px;" onclick="setOrderBy(this.id, this)" id="az">A -> Z</button>
                <button type="button" class="btn btn-dark btn-sm" data-bs-toggle="button" style="margin-right:5px;" onclick="setOrderBy(this.id, this)" id="za">Z -> A</button>
            </div>
        </div>
    </section>
    <section class="row flex-xl-nowrap mx-0">
        <div class="col-12 col-md-2 bd-sidebar">
        </div>
        <!-- get all available offerings-->
        <div class="col-12 col-md-10 col-xl-8 py-md-1 ">
            <div class="row g-1 mb-4" id="product-grid">
                <?php
                include 'include/getFilteredBusinesses.php';
                ?>
            </div>
        </div>
    </section>
    <!-- Gets the footer from a central location -->
    <div id="footer"><?php include('templates/template_footer.php'); ?></div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script>
    //<!-- declare script constants
        const councilLocations = <?php echo json_encode($council_locations); ?>;
    
    
    //<!-- filter on council -->
        function toggleCouncil(councilId, btn) {
            const isToggled = btn.classList.contains('active');
            
            // untoggle all other council buttons
            document.querySelectorAll('[id^="council-"]').forEach(b => {
                if (b !== btn) b.classList.remove('active');
            });
            
            const body = new URLSearchParams();
            if (isToggled) {
                body.append('council', councilId);
            }
            
            history.pushState(null, '', 'showBusinesses.php?council=' + (isToggled ? '' : councilId));
            
            fetch('include/getFilteredBusinesses.php', {
                method: 'POST',
                body: body
            })
            .then(r => r.text())
            .then(html => {
                document.getElementById('product-grid').innerHTML = html;
            });
        }


    //<!-- set the order by input -->
        function setOrderBy(input, btn) {
            const azButton = document.getElementById('az');
            const zaButton = document.getElementById('za');

            // untoggle all buttons
            azButton.classList.toggle('active', false);
            zaButton.classList.toggle('active', false);
            btn.classList.toggle('active', true);

            // get current council if one is selected
            const activeCouncil = document.querySelector('[id^="council-"].active');
            const body = new URLSearchParams();
            body.append('orderby', input);
            if (activeCouncil) {
                const councilId = activeCouncil.id.replace('council-', '');
                body.append('council', councilId);
            }

            history.pushState(null, '', 'showBusinesses.php?orderby=' + input);

            fetch('include/getFilteredBusinesses.php', {
                method: 'POST',
                body: body
            })
            .then(r => r.text())
            .then(html => {
                document.getElementById('product-grid').innerHTML = html;
            });
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
            fetch('include/getFilteredBusinesses.php', {     //gets the filtered offerings from the db without reloading the page
                method: 'POST',
                body: params
            })
            .then(r => r.text())                            //when the query completes, gets the response and converts it to text
            .then(html => {                                 //then inserts the text as html into the grid
                document.getElementById('product-grid').innerHTML = html;
            });
        });
    
    </script>
    
</body>
</html>