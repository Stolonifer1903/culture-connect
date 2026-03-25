<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My business products and services</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link href="css/style.css" rel="stylesheet">
</head>
<body>
    <!-- Gets the header from a central location -->
    <div id="header"><?php include('templates\template_navbar.php'); ?></div>
    <!--Page heading-->
    <section class = "text-left py-5" style="background-color:#ACC8A2;"><h1><div class="container"> Product and service details</h1></div></section>
    <!-- Main content -->
    <section class = "text-left py-3">
        <div style="margin-left: 100px; margin-right: 30px;"> 
            <!-- Add a new product or service -->
            <form id="addoffering" name="addoffering" action="05EditOffering.php" method="post">
                <table class="table" max-width=80% >
                    <tr>
                        <td>
                            <label for="addOffering"></label>
                            <input class="btn btn-success btn-sm" type="submit" value="Add a new product or service" name="addoffering">
                        </td>
                    </tr>
                </table>
            </form>
            <br>
            <table class = "table" width=80% >
                <thead style="border-bottom-width: 3px; border-bottom-color: black">
                    <tr>
                        <th style="display:none">ID</th>
                        <th>Business name</th>
                        <th>Name</th>
                        <th>Interest area</th>
                        <th>Location</th>
                        <th>Description</th>
                        <th>Details</th>
                        <th>Cultural benefit</th>
                        <th>Price range</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- TODO: UPDATE PHP -->
                    <?php
                        include 'include/config.php';
                        $sql = "SELECT * FROM view_offerings";
                        $result = $connection->query($sql);
                        if (!$result) {
                            die("Invalid query: ". $connection->error);
                        }
                        while($row = $result->fetch_assoc()){
                            echo "<tr>
                                <td style='display: none; '>" . $row["of_id_pk"] . "</td>
                                <td>" . $row["bus_name"] . "</td>
                                <td>" . $row["of_name"] . "</td>
                                <td>" . $row["int_name"] . "</td>
                                <td>" . $row["loc_name"] . "</td>
                                <td>" . $row["of_description"] . "</td>
                                <td>" . $row["of_details"] . "</td>
                                <td>" . $row["of_cultural_benefits"] . "</td>
                                <td>" . $row["of_price_range_description"] . "</td>
                                <td>
                                    <a class='btn btn-primary btn-sm' href='/cultureconnect/05EditOffering.php?of_id_pk=$row[of_id_pk]'>Update</button>
                                    <a class='btn btn-danger btn-sm' href='/cultureconnect/include/deleteOffering.php?of_id_pk=$row[of_id_pk]'>Delete</a>
                                </td>
                            </tr>";
                        }  
                    ?> 
                </tbody>   
            </table>
        </div>
    </section>
    <!-- Gets the footer from a central location -->
    <div id="footer"><?php include('templates\template_footer.php'); ?></div>
</body>
</html>