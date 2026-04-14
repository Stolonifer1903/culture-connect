<?php
    include 'config.php';
    if (isset($_POST["update"])){
        session_start();
        //get variables
        $user_type = $_SESSION["role"];
        $user_id = $_SESSION["user_id"];
        $role_id = $_SESSION["role_id"];
        $user_firstname = $_POST["firstname"];
        $user_lastname = $_POST["lastname"];
        $user_title = $_POST["title_select"];
        $user_email = $_POST["email"];

        //update user information (password is now handled separately via changePassword.php)
        $stmt = $connection->prepare("UPDATE user SET userEmail = ?, userFirstName = ?, userLastName = ?, userTitle = ? WHERE userIdPk = ?");
        $stmt->bind_param("ssssi", $user_email, $user_firstname, $user_lastname, $user_title, $user_id);
        $stmt->execute();

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

            //update variables into 'resident' table
            $stmt = $connection->prepare("UPDATE resident SET locationIdPk = ?, residentBirthYear = ?, residentGender = ? WHERE residentIdPk = ?");
            $stmt->bind_param("sssi", $location_id, $res_yob, $res_gender, $role_id);
            $stmt->execute();

            //update interests
            //delete old interests
            $stmt = $connection->prepare("DELETE FROM residentinterests WHERE residentIdPk = ?");
            $stmt->bind_param("i", $role_id);
            $stmt->execute();
            
            //add new interests
            $interestareas = $_POST["servicesandproducts"]; //gets list of offering
            foreach ($interestareas as $interestarea) {
                //get interest id
                $stmt = $connection->prepare("SELECT interestAreaIdPk FROM interestarea WHERE interestAreaName = ?");
                $stmt->bind_param("s", $interestarea);
                $stmt->execute();
                $result = $stmt->get_result();
                $row = $result->fetch_assoc();
                $int_id = $row["interestAreaIdPk"];
                //add interest to residentinterests table
                $stmt = $connection->prepare("INSERT INTO residentinterests(residentIdPk, interestAreaIdPk) VALUES (?, ?)");
                $stmt->bind_param("ii", $role_id, $int_id);
                $stmt->execute();
            }
        } 

        if (!$stmt->error) { 
            header('Location: ../02ManageUser.php?profileUpdateSuccess=true', TRUE, 303);
            exit;
        } else {
            throw new Exception("Error updating user profile for ID: $user_id - " . $stmt->error);
        }
        
    }
?>