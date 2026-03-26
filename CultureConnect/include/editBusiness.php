<?php
    var_dump($_POST);
    //exit;
    include 'config.php';
    if (isset($_POST["register"])){
        //get variables
        $user_type = $_POST["user_type"];
        $user_name = $_POST["fullName"];
        $user_email = $_POST["email"];
        $user_pwd = $_POST["password"];
        $user_council = $_POST["council"];

        //get council id from the council table based on council name
        // TODO fix against SQL injection
        $sql = "SELECT council_id_pk FROM council WHERE council_name = '$user_council' ";
        $result = $connection->query($sql);
        $row = $result->fetch_assoc();
        $council_id = $row["council_id_pk"];
        
        //update new user in the table
        $stmt1 = $connection->prepare("INSERT INTO user(user_email, user_name, user_pwd, user_type, council_id_pk) VALUES (?, ?, ?, ?, ?)");
        $stmt1->bind_param("sssii", $user_email, $user_name, $user_pwd, $user_type, $council_id);
        $stmt1->execute();

        //get last record number for next operations
        $last_id = $connection->insert_id;

        //perform additional actions based on user type
        if ($user_type == '1') { //if the user is a resident
            //get resident variables
            $res_gender = $_POST["gender_select"];
            $res_yob = $_POST["yob"];
            $res_location = $_POST["location_select"];

            //get location id from the location table based on the name
            $sql = "SELECT loc_id_pk FROM location WHERE loc_name = '$res_location' ";
            $result = $connection->query($sql);
            $row = $result->fetch_assoc();
            $location_id = $row["loc_id_pk"];

            //insert variables into 'resident' table
            $stmt2 = $connection->prepare("INSERT INTO resident(user_id_pk, loc_id_pk, res_yob, res_gender) VALUES (?, ?, ?, ?)");
            $stmt2->bind_param("ssss", $last_id, $location_id, $res_yob, $res_gender);
            $stmt2->execute();

        } else if ($user_type == '2'){ //otherwise if the user has a business
            //get business variables
            //TODO - decide if we need to include email and url
            $bus_name = $_POST["bus_name"];

            //insert into 'business table'
            $stmt3 = $connection->prepare("INSERT INTO business(bus_name) VALUES (?)");
            $stmt3->bind_param("s", $bus_name);
            $stmt3->execute();

        } else if ($user_type == '3'){ //otherwise if the user is from the council
            //nothing to do right now
        }

        if ($stmt1->affected_rows > 0) { //TODO - update to include 
            header('Location: /cultureconnect/00Home.php', TRUE, 303);
            exit;
        } else {
            die("Error - " . $stmt->error);
        }
    }
?>