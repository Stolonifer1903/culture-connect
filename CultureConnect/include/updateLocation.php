
<?php
    // var_dump($_POST);
    // exit;
    
    include 'config.php';
    if (isset($_POST["loc_id_pk"])){
        if (isset($_POST["loc_name"])){
            $loc_id_pk = $_POST["loc_id_pk"];
            $loc_name = $_POST["loc_name"];
            $edit_query = "UPDATE council SET loc_name = '$loc_name' WHERE loc_id_pk = $loc_id_pk";
            $result = $connection->query($edit_query);
            if ($result) {
                echo "Location updated";
                header("Location: /cultureconnect/EditLocations.php");
                exit;
            }
            else {
                echo "Error";
            }
        }
    }
?>



