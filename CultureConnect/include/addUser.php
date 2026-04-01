<?php
    //var_dump($_POST);
    //exit;
    include 'config.php';
    if (isset($_POST["register"])){
        //get variables
        $user_type = $_POST["user_type"];
        $user_firstname = $_POST["firstname"];
        $user_lastname = $_POST["lastname"];
        $user_title = $_POST["title_select"];
        $user_email = $_POST["email"];
        $user_pwd = $_POST["password"];


        // Check if email already exists
            $check = $connection->prepare("SELECT userIdPk FROM user WHERE userEmail = ?");
            $check->bind_param("s", $user_email);
            $check->execute();
            $check->store_result();

            if ($check->num_rows > 0) {
                // Business already exists, don't insert
                echo "User email already exists";
            } else {
                //update new user in the table
                $stmt1 = $connection->prepare("INSERT INTO user(userEmail, userFirstName, userLastName, userTitle, userPassword, userRole) VALUES (?, ?, ?, ?, ?, ?)");
                $stmt1->bind_param("sssssi", $user_email, $user_firstname, $user_lastname, $user_title, $user_pwd, $user_type);
                $stmt1->execute();
            }

        //get last record number for next operations
        $last_id = $connection->insert_id;

        //perform additional actions based on user type
        if ($user_type == '1') { //if the user is a resident
            //get resident variables
            $res_gender = $_POST["gender_select"];
            $res_yob = $_POST["yob"];
            $res_location = $_POST["location_select"];

            //get location id from the location table based on the name
            $stmt = $connection->prepare("SELECT locationIdPk FROM location WHERE locationName = ?");
            $stmt->bind_param("s", $res_location);
            $stmt->execute();
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();
            $location_id = $row["locationIdPk"];

            //insert variables into 'resident' table
            $stmt2 = $connection->prepare("INSERT INTO resident(userIdPk, locationIdPk, residentBirthYear, residentGender) VALUES (?, ?, ?, ?)");
            $stmt2->bind_param("ssss", $last_id, $location_id, $res_yob, $res_gender);
            $stmt2->execute();

            //get last record number for next operations
            $res_id = $connection->insert_id;

            //insert res_id_pk into user table
            $stmt2 = $connection->prepare("UPDATE user SET roleId = ? WHERE userIdPk = ?");
            $stmt2->bind_param("ii", $res_id, $last_id);
            $stmt2->execute();

            //update interests
            $interestareas = $_POST["servicesandproducts"]; //gets list of services

            foreach ($interestareas as $interestarea) {
                $stmt = $connection->prepare("SELECT interestAreaIdPk FROM interestarea WHERE interestAreaName = ?");
                $stmt->bind_param("s", $interestarea);
                $stmt->execute();
                $result = $stmt->get_result();
                $row = $result->fetch_assoc();
                $int_id = $row["interestAreaIdPk"];

                $stmt = $connection->prepare("INSERT INTO residentinterests(residentIdPk, interestAreaIdPk) VALUES (?, ?)");
                $stmt->bind_param("ii", $res_id, $int_id);
                $stmt->execute();
            }

        } else if ($user_type == '2'){ //otherwise if the user has a business
            //get business variables
            //TODO - decide if we need to include email and url
            $bus_name = $_POST["bus_name"];
            $user_council = $_POST["council_select"];

            //get council id from the council table based on council name
            // TODO fix against SQL injection
            $sql = "SELECT councilIdPk  FROM council WHERE councilName  = '$user_council' ";
            $result = $connection->query($sql);
            $row = $result->fetch_assoc();
            $council_id = $row["councilIdPk"];

            // Check if business name already exists
            $check = $connection->prepare("SELECT businessIdPk FROM business WHERE businessName = ?");
            $check->bind_param("s", $bus_name);
            $check->execute();
            $check->store_result();

            if ($check->num_rows > 0) {
                // Business already exists, don't insert
                echo "Business already exists";
            } else {
                // Business doesn't exist, safe to insert
                $stmt3 = $connection->prepare("INSERT INTO business(businessName, councilIdPk) VALUES (?, ?)");
                $stmt3->bind_param("si", $bus_name, $council_id);
                $stmt3->execute();
            }

            //get last record number for next operations
            $bus_id = $connection->insert_id;

            //insert bus_id_pk into user table
            $stmt2 = $connection->prepare("UPDATE user SET roleId = ? WHERE userIdPk = ?");
            $stmt2->bind_param("ii", $bus_id, $last_id);
            $stmt2->execute();

        } else if ($user_type == '3'){ //otherwise if the user is from the council
            $user_council = $_POST["council_select"];

            //get council id from the council table based on council name
            // TODO fix against SQL injection
            $sql = "SELECT councilIdPk FROM council WHERE councilName = '$user_council' ";
            $result = $connection->query($sql);
            $row = $result->fetch_assoc();
            $council_id = $row["councilIdPk"];

            //insert counc_id_pk into user table
            $stmt2 = $connection->prepare("UPDATE user SET roleId = ? WHERE userIdPk = ?");
            $stmt2->bind_param("ii", $council_id, $last_id);
            $stmt2->execute();
        }

        if ($stmt1->affected_rows > 0) { //TODO - update to include 
            header('Location: /culture-connect/CultureConnect/00Home.php', TRUE, 303);
            exit;
        } else {
            die("Error - " . $stmt->error);
        }
    }
?>