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
        if (!empty($_POST["offeringIdPk"])){ //if offering id exists update the entry that is already there
            $of_id_pk = $_POST["offeringIdPk"];
            $stmt = $connection->prepare("UPDATE offering SET businessIdPk = ?, offeringCategory = ?, locationIdPk = ?, offeringName = ?, 
                                        offeringDescription = ?, offeringDetails = ?, offeringCulturalBenefits = ?, offeringPriceRange = ?
                                            WHERE offeringIdPk = ?");
            $stmt->bind_param("iiissssii", $business, $category_id, $location_id, $name, $description, $details, $cultural_benefit,$price_id, $of_id_pk);
            
        } else { //otherwise insert a new entry into the table
            $stmt = $connection->prepare("INSERT INTO offering(businessIdPk, offeringCategory, locationIdPk, offeringName, offeringDescription, offeringDetails, 
                                        offeringCulturalBenefits, offeringPriceRange) 
                                        VALUES (?, ?, ?, ?, ?, ?, ?, ? )");
            $stmt->bind_param("iiissssi", $business, $category_id, $location_id, $name, $description, $details, $cultural_benefit, $price_id);
        }
        $stmt->execute();

        if ($stmt-> errno )  { //TODO - update to include 
            throw new Exception("Error during offering persistence (ID: $of_id_pk) - " . $stmt->error);
        }

        //sets of_id_pk for new offerings
        if (empty($_POST["offeringIdPk"])) {
            $of_id_pk = $connection->insert_id;
        }

        //validate the image
        if (!empty($_FILES['image']['name'])){
            $upload_directory = '../images/offerings/';
            $file_name = basename($_FILES['image']['name']);
            $file_tmp = $_FILES['image']['tmp_name'];
            $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

            $allowed = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
            if (!in_array($file_ext, $allowed)) {
                throw new Exception("Invalid file type");
            }
            $upload_file_name = $of_id_pk . '.' . $file_ext;

            if (!move_uploaded_file($file_tmp, $upload_directory . $upload_file_name)) {
                throw new Exception("Failed to upload image");
            }
            $result = move_uploaded_file($file_tmp, $upload_directory . $upload_file_name);
            
            // update the image filename in the db
            $stmt = $connection->prepare("UPDATE offering SET offeringImage = ? WHERE offeringIdPk = ?");
            $stmt->bind_param("si", $upload_file_name, $of_id_pk);
            $stmt->execute();

            if ($stmt->errno)  { //if any errors saving to db, throw error
                throw new Exception("Error updating image filename for offering ID: $of_id_pk - " . $stmt->error);
            }
        }
        $redirect_page = ($_SESSION['role'] == 4) ? '97ManageOfferingsAdmin.php' : '04ManageOfferings.php';
        header("Location: ../$redirect_page?offeringUpdateSuccess=true", TRUE, 303);
        exit;
    }
?>