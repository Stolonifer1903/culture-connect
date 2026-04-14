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

<body>
    <!--Session start-->
    <?php
    session_start();
    include('include/config.php');
    $of_id = $_GET['offeringIdPk'] ?? "" ;
    include('include/getOfferingInfo.php');
    if (isset($_SESSION['role']) && isset($_SESSION['role_id'])){
        $role = $_SESSION['role'];
        if ($role == 2){
            $business = $_SESSION['role_id'];
            if ($of_id != ""){
                include('include/getBusinessInfo.php');
                if ($of_bus_name != $bus_name){
                    throw new Exception("Not your business");
                }
            }
        }
    }
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
            <form id="editoffering" name="editoffering" action="include/updateOffering.php?offeringIdPk=<?php echo $of_id;?>" method="post" enctype="multipart/form-data">
                <table class="table">
                    <?php
                    if ($role ==4){
                        echo "
                    <tr id='business'>
                        <td><label for='business_select'>Business:</label></td>
                        <td>
                            <select id='business_select' name='business_select' width=50%>
                                <option value=''>Select location</option>";
                                $sql = "SELECT businessIdPk, businessName FROM business";
                                $result = $connection->query($sql);
                                if (!$result) {
                                    throw new Exception("Invalid query: " . $connection->error);
                                }
                                while ($row = $result->fetch_assoc()) {
                                    $is_selected = ($row['businessName'] == $of_bus_name) ? 'selected' : '' ;
                                    echo "<option id='" . $row['businessName'] . "' value='" . $row['businessIdPk'] . "' " . $is_selected . ">" . $row['businessName'] . "</option>";
                                }
                        echo "
                            </select>
                        </td>
                    </tr>";
                    } else {
                        echo "<input type='hidden' id='business_select' name='business_select' value='" .$business."'>";
                    }
                    ?>
                    <tr id="location">
                        <td><label for="location_select">Location:</label></td>
                        <td>
                            <select id="location_select" name="location_select" width=50%>
                                <option value="">Select location</option>
                                <?php
                                $sql = "SELECT locationName FROM location";
                                $result = $connection->query($sql);
                                if (!$result) {
                                    throw new Exception("Invalid query: " . $connection->error);
                                }
                                while ($row = $result->fetch_assoc()) {
                                    $is_selected = ($row['locationName'] == $of_loc_name) ? 'selected' : '' ;
                                    echo "<option id='" . $row['locationName'] . "' value='" . $row['locationName'] . "' " . $is_selected . ">" . $row['locationName'] . "</option>";
                                }
                                ?>
                            </select>
                        </td>
                    </tr>
                    <!--Offering category-->
                    <!--Location TODO: Update list to remove unavailable options-->
                    <tr>
                        <td><label for="category">Category:</label></td>
                        <td>
                            <select id="category" name="category">
                                <option value="">Select category</option>
                                <?php
                                $sql = "SELECT interestAreaName FROM interestarea";
                                $result = $connection->query($sql);
                                if (!$result) {
                                    throw new Exception("Invalid query: " . $connection->error);
                                }
                                while ($row = $result->fetch_assoc()) {
                                    $is_selected = ($row['interestAreaName'] == $of_int_name) ? 'selected' : '' ;
                                    echo "<option id='" . $row['interestAreaName'] . "' value='" . $row['interestAreaName'] . "' " . $is_selected . ">" . $row['interestAreaName'] . "</option>";
                                }
                                ?>
                            </select>
                            If a category is not shown, another business already has a product or service for offer
                                in the location
                        </td>
                    </tr>
                    <!-- Offering name -->
                    <tr>
                        <td><label for="offering_name">Name:</label></td>
                        <td><input type="text" id="offering_name" name="offering_name" required size="65%" value="<?php echo (($of_name) ?  $of_name: '' );?>"></td>
                    </tr>
                    <!-- Offering description -->
                    <tr>
                        <td><label for="description">Description:</label></td>
                        <td><textarea id="description" name="description" rows="4" cols="68" maxlength="300"><?php echo (($of_description) ?  $of_description: '' );?></textarea>
                        </td>
                    </tr>
                    <!-- Details -->
                    <tr id="details">
                        <td><label for="details">Details:</label></td>
                        <td><textarea id="details" name="details" rows="4" cols="68" maxlength="300"
                                placeholder="Enter size and quantity options for products and dates and times for services"><?php echo (($of_details) ?  $of_details: '' );?></textarea>
                        </td>
                    </tr>
                    <!-- Cultural benefits -->
                    <tr>
                        <td><label for="cultural_benefit">Cultural benefit:</label></td>
                        <td><textarea id="cultural_benefit" name="cultural_benefit" rows="4" cols="68"
                                maxlength="300"><?php echo (($of_cultural_benefits) ?  $of_cultural_benefits : "" );?></textarea></td>
                    </tr>
                    <!-- Cultural benefits -->
                    <tr>
                        <td><label for="awards">Awards:</label></td>
                        <td><textarea id="awards" name="awards" rows="4" cols="68"
                                maxlength="300"><?php echo (($of_awards) ?  $of_awards : "" );?></textarea></td>
                    </tr>
                    <tr>
                        <td><label for="price_range">Price range:</label></td>
                        <td>
                            <select id="price_range" name="price_range">
                                <?php
                                $sql = "SELECT offeringPriceRangeDescription FROM offeringpricing";
                                $result = $connection->query($sql);
                                if (!$result) {
                                    throw new Exception("Invalid query: " . $connection->error);
                                }
                                while ($row = $result->fetch_assoc()) {
                                    $is_selected = ($row['offeringPriceRangeDescription'] == $of_price_range_description) ? 'selected' : '' ;
                                    echo "<option id='" . $row['offeringPriceRangeDescription'] . "' value='" . $row['offeringPriceRangeDescription'] . "' " . $is_selected . ">" . $row['offeringPriceRangeDescription'] . "</option>";
                                }
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td><label for="image">Image:</label></td>
                        <td>
                            <input type="file" name="image" id="image" accept="image/*">
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
                </table> 
                <input type="hidden" id="offeringIdPk" name="offeringIdPk" value="<?php echo $of_id; ?>">
            </form>
        </div>
    </section>
    <!-- Gets the footer from a central location -->
    <div id="footer"><?php include('templates/template_footer.php'); ?></div>
</body>
</html>