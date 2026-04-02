<?php
    //var_dump($_POST);
    //exit;
    include 'config.php';
    if (isset($_POST["submit"])){
        //get variables
        $location = $_POST["location_select"];
        $category = $_POST["category"];
        $name = $_POST["offering_name"];
        $description = $_POST["description"];
        $details = $_POST["details"];
        $cultural_benefit = $_POST["cultural_benefit"];
        $price_range = $_POST["price_range"];
        $business = "1"; //TODO: Update when session variables in place

        //get location id from the location table based on the name
        $stmt = $connection->prepare("SELECT loc_id_pk FROM location WHERE loc_name = ?");
        $stmt->bind_param("s", $location);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $location_id = $row["loc_id_pk"];

        //get category id from the interests table based on the name
        $stmt = $connection->prepare("SELECT int_id_pk FROM interests WHERE int_name = ?");
        $stmt->bind_param("s", $category);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $category_id = $row["int_id_pk"];
    

        //update the table
        if (isset($_GET["of_id_pk"])){ //if offering id exists update the entry that is already there
            $of_id_pk = $_GET["of_id_pk"];
            $stmt = $connection->prepare("UPDATE offering SET bus_id_pk = ?, of_category = ?, loc_id_pk = ?, of_name = ?, of_description = ?, of_details = ?, of_cultural_benefits = ?, of_price_range = ?  
                                            WHERE of_id_pk = ?");
            $stmt->bind_param("iiissssis", $business, $category_id, $location_id, $name, $description, $details, $cultural_benefit,$price_range, $of_id_pk);
            
        } else { //otherwise insert a new entry into the table
            $stmt = $connection->prepare("INSERT INTO offering(bus_id_pk, of_category, loc_id_pk, of_name, of_description, of_details, of_cultural_benefits, of_price_range) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("iiissssi", $business, $category_id, $location_id, $name, $description, $details, $cultural_benefit,$price_range);
        }
        $stmt->execute();

        if ($stmt->affected_rows > 0) { //TODO - update to include 
                header('Location: ../04ManageOfferings.php', TRUE, 303);
                exit;
            } else {
                die("Error - " . $stmt->error);
            }
    }
?>