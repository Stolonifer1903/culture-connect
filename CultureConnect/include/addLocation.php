
<?php
    include 'config.php';
    if (isset($_POST["Add"])){
        $addLocation=$_POST["addLocation"];
        $insert_query="INSERT INTO council(loc_id_pk, counc_id_pk, loc_name) VALUES ('','Welwyn and Hatfield', '$addLocation')";
        $result = $connection->query($insert_query);
        if ($result) {
            echo "Location added successfully";
            header('Location: /cultureconnect/EditLocations.php',TRUE, 303);
            exit;
            }
        else {
            echo "Error - " . $connection->error;
            }
    }
?>