<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Councils - Admin Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <!--Session start-->
    <?php
    session_start();
    include('include/config.php')
        ?>
    <!-- Gets the header from a central location -->
    <div id="header"><?php include('templates/template_navbar.php'); ?></div>
    <!--Page heading-->
    <section class="text-left py-5" style="background-color:#ACC8A2;">
        <h1>
            <div class="container"> Councils - Admin Page
        </h1>
        </div>
    </section>
    <!-- Main content -->
    <section class="text-left py-3">
        <div style="margin-left: 100px; margin-right: 30px;">
            <!-- Add a new product or service -->
            <form id="addoffering" name="addoffering" action="03EditCouncil.php" method="post"
                style="margin-left:200px">
                <label for="addOffering"></label>
                <input type="hidden" value="yes" id="create-new" name="create-new">
                <input class="btn btn-success btn-sm" type="submit" value="Add a new council"
                    name="addBusiness">
            </form>
            <br>
            <table class="table" width=80%>
                <thead style="border-bottom-width: 3px; border-bottom-color: white;">
                    <tr>
                    <th>ID</th>
                    <th>Council name</th>
                    <th>Council contact</th>
                    <th>Council link</th>
                    <th>Locations</th>
                    <th>Actions</th>
                    </tr>
                </thead>
                <tbody style="color: white; background-color: #527558;">
                    <?php
                    include 'include/config.php';
                    $sql = "SELECT * FROM council";
                    $result = $connection->query($sql);
                    if (!$result) {
                        throw new Exception("Invalid query: " . $connection->error);
                    }
                    while ($row = $result->fetch_assoc()) {
                        $sql2 = "SELECT COUNT(locationName) AS numLocs FROM view_locations WHERE councilName = '" . $row['councilName'] . "'";
                        $result_l = $connection->query($sql2);
                        if ($result_l && $result_l->num_rows > 0) {
                                $row_l = $result_l->fetch_assoc();
                                $num_locs = $row_l['numLocs'];
                        }
                        echo 
                        "<tr>
                            <td>" . $row["councilIdPk"] . "</td>
                            <td>" . $row["councilName"] . "</td>
                            <td>" . $row["councilContact"] . "</td>
                            <td>" . $row["councilLink"] . "</td>
                            <td>" . $num_locs . "</td>

                            <td>
                                <a class='btn btn-primary btn-sm' href='03EditCouncil.php?councilIdPk=$row[councilIdPk]'>Update</a>
                                <a class='btn btn-danger btn-sm' href='include/deleteCouncil.php?councilIdPk=$row[councilIdPk]'>Delete</a>
                            </td>
                        </tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </section>
    <!-- Gets the footer from a central location -->
    <div id="footer"><?php include('templates/template_footer.php'); ?></div>
</body>

</html>