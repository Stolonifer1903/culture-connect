<?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $database = "CultureConnect";

        $connection = new mysqli($servername, $username,$password,$database);

        if ($connection->connect_error) {
            die("Connection failed: " . $connection->connect_error);
        }
?>
