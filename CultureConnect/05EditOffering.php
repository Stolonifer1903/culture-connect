<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit products and services</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link href="css/style.css" rel="stylesheet">
</head>

<body onload="toggleFieldsEditOffering('product')">
    <!--Session start-->
    <?php
    session_start();
    include('include/config.php')
        ?>
    <!-- Gets the header from a central location -->
    <div id="header"><?php include('templates/template_navbar.php'); ?></div>
    <!--Page heading-->
    <section class="text-left py-5" style="background-color:#ACC8A2;">
        <div class="container">
            <h1>Product or service details</h1>
        </div>
    </section>
    <!-- Main content -->
    <section class="text-left py-3">
        <div class="container">
            <!-- Table containing offering -->
            <form id="editoffering" name="editoffering" action="include/updateOffering.php" method="post">
                <table class="table">
                    <!--Product or service-->
                    <tr>
                        <td width="20%"><label for="offering_type" style="margin-right:25px">Offering type:</label></td>
                        <!--TODO: FIND BETTER NAME-->
                        <td>
                            <input type="radio" id="product" name="offering_type" value="1"
                                onclick="toggleFieldsEditOffering(this.id)" checked>
                            <label for="product" style="margin-right:25px">Product </label>
                            <input type="radio" id="service" name="offering_type" value="2"
                                onclick="toggleFieldsEditOffering(this.id)">
                            <label for="service" style="margin-right:25px">Service </label>
                        </td>
                    </tr>
                    <!--Location TODO: Update list to remove unavailable options-->
                    <tr id="location">
                        <td><label for="location_select">Location:</label></td>
                        <td>
                            <select id="location_select" name="location_select" width=50%>
                                <option value="">Select location</option>
                                <?php
                                include 'include/config.php';
                                $sql = "SELECT locationName from location";
                                $result = $connection->query($sql);
                                if (!$result) {
                                    throw new Exception("Invalid query: " . $connection->error);
                                }
                                while ($row = $result->fetch_assoc()) {
                                    echo "<option value='" . $row['locationName'] . "'>" . $row["locationName"] . "</option>";
                                }
                                ?>
                            </select>
                        </td>
                    </tr>
                    <!--Offering category-->
                    <tr>
                        <td><label for="category">Category:</label></td>
                        <td>
                            <select id="category" name="category">
                                <option value="">Select category</option>
                                <!--TODO: UPDATE PHP TO ONLY SHOW AVAILABLE OPTIONS-->
                                <?php
                                include 'include/config.php';
                                $sql = "SELECT interestAreaName from interestarea";
                                $result = $connection->query($sql);
                                if (!$result) {
                                    throw new Exception("Invalid query: " . $connection->error);
                                }
                                while ($row = $result->fetch_assoc()) {
                                    echo "<option value='" . $row["interestAreaName"] . "'>" . $row["interestAreaName"] . "</option>";
                                }
                                ?>
                            </select>
                            <p>If a category is not shown, another business already has a product or service for offer
                                in the location</p>
                        </td>
                    </tr>
                    <!-- Offering name -->
                    <tr>
                        <td><label for="offering_name">Name:</label></td>
                        <td><input type="text" id="offering_name" name="offering_name" required size="65%"></td>
                    </tr>
                    <!-- Offering description -->
                    <tr>
                        <td><label for="description">Description:</label></td>
                        <td><textarea id="description" name="description" rows="4" cols="68" maxlength="300"></textarea>
                        </td>
                    </tr>
                    <!-- Details -->
                    <tr id="details">
                        <td><label for="details">Details:</label></td>
                        <td><textarea id="details" name="details" rows="4" cols="68" maxlength="300"
                                placeholder="Enter size and quantity options for products and dates and times for services"></textarea>
                        </td>
                    </tr>
                    <!-- Cultural benefits -->
                    <tr>
                        <td><label for="cultural_benefit">Cultural benefit:</label></td>
                        <td><textarea id="cultural_benefit" name="cultural_benefit" rows="4" cols="68"
                                maxlength="300"></textarea></td>
                    </tr>
                    <!-- Price range TODO: GET LIST FROM SERVER-->
                    <tr>
                        <td><label for="price_range">Price range:</label></td>
                        <td>
                            <select id="price_range" name="price_range">
                                <option value="">Select price range</option>
                                <option value="1">Affordable (less than £50) </option>
                                <option value="2">Moderate (£50-£200)</option>
                                <option value="3">Premium (more than £200)</option>
                            </select>
                        </td>
                    </tr>
                    <!-- Submit or cancel-->
                    <tr>
                        <td><label for=""></label></td>
                        <td>
                            <table>
                                <tr>
                                    <td>
                                        <input class='btn btn-custom btn-sm' style="margin-right:25px;" type="submit"
                                            value="Submit" name="submit">
                                        <input class='btn btn-secondary btn-sm' style="margin-right:25px"
                                            action="action" type="button" value="Cancel"
                                            onclick="window.history.go(-1); return false;">
                                    </td>
                                </tr>
                        </td>
                </table>
                </tr>
                <!-- TODO: Add PHP to update existing details -->
                <?php
                include 'include/config.php';
                if (isset($_GET["offeringIdPk"])) {
                    $of_id_pk = $_GET["offeringIdPk"];


                }
                ?>
                </table>
            </form>
        </div>
    </section>
    <script src="js/toggleFieldsEditOffering.js"></script>
    <!-- Gets the footer from a central location -->
    <div id="footer"><?php include('templates/template_footer.php'); ?></div>
</body>

</html>