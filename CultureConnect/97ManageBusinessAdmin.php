<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Businesses - Admin Page</title>
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
            <div class="container"> Businesses - Admin Page
        </h1>
        </div>
    </section>
    <!-- Main content -->
    <section class="text-left py-3">
        <div style="margin-left: 100px; margin-right: 30px;">
            <!-- Add a new product or service -->
            <form id="addoffering" name="addoffering" action="03EditBusiness.php" method="post"
                style="margin-left:200px">
                <label for="addOffering"></label>
                <input type="hidden" value="yes" id="create-new" name="create-new">
                <input class="btn btn-success btn-sm" type="submit" value="Add a new business"
                    name="addBusiness">
            </form>
            <br>
            <table class="table" width=80%>
                <thead style="border-bottom-width: 3px; border-bottom-color: white;">
                    <tr>
                    <th>ID</th>
                    <th>Business name</th>
                    <th>Business description</th>
                    <th>Business email</th>
                    <th>Business phone</th>
                    <th>Business link</th>
                    <th>Council ID</th>
                    <th>Actions</th>
                    </tr>
                </thead>
                <tbody style="color: white; background-color: #527558;">
                    <!-- TODO: UPDATE PHP -->
                    <?php
                    include 'include/config.php';
                    $sql = "SELECT * FROM business";
                    $result = $connection->query($sql);
                    if (!$result) {
                        throw new Exception("Invalid query: " . $connection->error);
                    }
                    while ($row = $result->fetch_assoc()) {
                        echo 
                        "<tr>
                            <td>" . $row["businessIdPk"] . "</td>
                            <td>" . $row["businessName"] . "</td>
                            <td>" . $row["businessDescription"] . "</td>
                            <td>" . $row["businessEmail"] . "</td>
                            <td>" . $row["businessPhone"] . "</td>
                            <td>" . $row["businessLink"] . "</td>
                            <td>" . $row["councilIdPk"] . "</td>
                            <td>
                                <a class='btn btn-primary btn-sm' href='03EditBusiness.php?businessIdPk=$row[businessIdPk]'>Update</a>
                                <a class='btn btn-danger btn-sm' href='include/deleteBusiness.php?businessIdPk=$row[businessIdPk]'>Delete</a>
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