<?php
    include 'config.php';
    if (isset($_SESSION['role']) || isset($_SESSION['role_id'])){
        $user_id = $_SESSION['user_id'];
        $role_id = $_SESSION['role_id'];
        //get user info from the user table
        $stmt = $connection->prepare("SELECT * FROM user WHERE userIdPk = ?");
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $first_name = $row["userFirstName"];
            $last_name = $row["userLastName"] ;
            $title = $row["userTitle"] ;
            $email = $row["userEmail"] ;
        } else {
            echo "Error";
        }
    
        if ($_SESSION['role'] == 1) {
            //get resident details from the resident table
            $stmt = $connection->prepare("SELECT * FROM resident WHERE residentIdPk = ?");
            $stmt->bind_param("i", $role_id);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $gender = $row["residentGender"];
                $yob = $row["residentBirthYear"] ;
                $location_id = $row["locationIdPk"] ;
                //get location name based on location id
                $stmt = $connection->prepare("SELECT locationName FROM location WHERE locationIdPk = ?");
                $stmt->bind_param("i", $location_id);
                $stmt->execute();
                $result = $stmt->get_result();
                if ($result) {
                    $row = $result->fetch_assoc();
                    $location_name = $row["locationName"];
                } else {
                    throw new Exception("Error fetching location name for location ID: $location_id - " . $stmt->error);
                }
            } else {
                throw new Exception("Error fetching resident details for role ID: $role_id - " . $stmt->error);
            }
            //get interests from the interest table
            $stmt = $connection->prepare("SELECT interestAreaName FROM interestarea INNER JOIN residentinterests ON residentinterests.interestAreaIdPk = interestarea.interestAreaIdPk WHERE residentIdPk = ?");
            $stmt->bind_param("i", $role_id);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result->num_rows > 0) {
                $interests = array();
                while ($row = $result->fetch_assoc()) {
                    $interests[] = $row['interestAreaName'];
                }
            }
        } else {
            $gender="";
            $yob = "";
            $location_name = "";
            $interests = array();
        }
        
    } else {
        throw new Exception("Error - Session not established or user not logged in");
    }
?>