<?php
    session_start();
    // error_reporting(E_ALL);
    // ini_set('display_errors', 1);

    // echo "<pre>";
    // print_r($_POST);
    // echo "</pre>";
    // die();
    include ('config.php');
    if (isset($_POST["submit"])){
        //get variables
        $location = $_POST["location_select"];
        $category = $_POST["category"];
        $name = $_POST["offering_name"];
        $description = $_POST["description"];
        $details = $_POST["details"];
        $cultural_benefit = $_POST["cultural_benefit"];
        $price_range = $_POST["price_range"];
        $business = $_POST["business_select"];; //TODO: Update when session variables in place

        //get location id from the location table based on the name
        $stmt = $connection->prepare("SELECT locationIdPk FROM location WHERE locationName = ?");
        $stmt->bind_param("s", $location);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $location_id = $row["locationIdPk"];

        //get category id from the interests table based on the name
        $stmt = $connection->prepare("SELECT interestAreaIdPk FROM interestarea WHERE interestAreaName = ?");
        $stmt->bind_param("s", $category);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $category_id = $row["interestAreaIdPk"];

        //get price id from the offeringpricing table based on the name
        $stmt = $connection->prepare("SELECT offeringPriceRange FROM offeringpricing WHERE offeringPriceRangeDescription = ?");
        $stmt->bind_param("s", $price_range);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $price_id = $row["offeringPriceRange"];
    

        //update the table
        if (isset($_POST["offeringIdPk"])){ //if offering id exists update the entry that is already there
            $of_id_pk = $_POST["offeringIdPk"];
            $stmt = $connection->prepare("UPDATE offering SET businessIdPk = ?, offeringCategory = ?, locationIdPk = ?, offeringName = ?, 
                                        offeringDescription = ?, offeringDetails = ?, offeringCulturalBenefits = ?, offeringPriceRange = ?  
                                            WHERE offeringIdPk = ?");
            $stmt->bind_param("iiissssii", $business, $category_id, $location_id, $name, $description, $details, $cultural_benefit,$price_id, $of_id_pk);
            
        } else { //otherwise insert a new entry into the table
            $stmt = $connection->prepare("INSERT INTO offering(businessIdPk, offeringCategory, locationIdPk, offeringName, offeringDescription, offeringDetails, offeringCulturalBenefits, offeringPriceRange) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("iiissssi", $business, $category_id, $location_id, $name, $description, $details, $cultural_benefit,$price_id);
        }
        $stmt->execute();

        if ($stmt->affected_rows > 0)  { //TODO - update to include 
                header('Location: ../04ManageOfferings.php', TRUE, 303);
                exit;
            } else {
                throw new Exception("Error - " . $stmt->error);
            }
    }
?>