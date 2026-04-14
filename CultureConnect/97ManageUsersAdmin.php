<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users - Admin Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <!--Session start-->
    <?php
    session_start();
    include('include/config.php');
    requireAdminRole();
        ?>
    <!-- Gets the header from a central location -->
    <div id="header"><?php include('templates/template_navbar.php'); ?></div>
    <!--Page heading-->
    <section class="text-left py-5" style="background-color:#ACC8A2;">
        <h1>
            <div class="container"> Users - Admin Page
        </h1>
        </div>
    </section>
    <!-- Main content -->
    <section class="text-left py-3">
        <h3 style="margin-left: 150px;">Residents    <a class="btn btn-success btn-sm" type="submit" href="02RegisterUser.php?register_as=resident" name="addResident">Add a new resident</a></h3>
        <table class="table">
            <thead style="border-bottom-width: 3px; border-bottom-color: white;">
                <tr>
                <th width=5%>User ID</th>
                <th width=4%>Title</th>
                <th width=7%>First name</th>
                <th width=12%>Last name</th>
                <th width=10%>Email</th>
                <th width=7%>Password</th>
                <th>Resident ID</th>
                <th>Gender</th>
                <th>Age</th>
                <th>Location</th>
                <th>Interests</th>
                <th width=10%>Actions</th>
                </tr>
            </thead>
            <tbody style="color: white; background-color: #527558;">
                <?php
                include 'include/config.php';
                $sql = "SELECT u.*, r.*, l.*, COUNT(ri.residentInterestIdPk) AS interestCount
                        FROM ((user u 
                        JOIN resident r ON u.userIdPk = r.userIdPk) 
                        JOIN location l ON l.locationIdPk = r.locationIdPk)
                        LEFT JOIN residentInterests ri ON ri.residentIdPk = r.residentIdPk
                        GROUP BY u.userIdPk";
                $result = $connection->query($sql);
                if (!$result) {
                    throw new Exception("Invalid query: " . $connection->error);
                }
                while ($row = $result->fetch_assoc()) {
                    echo 
                    "<tr>
                        <td>" . $row["userIdPk"] . "</td>
                        <td>" . $row["userTitle"] . "</td>
                        <td>" . $row["userFirstName"] . "</td>
                        <td>" . $row["userLastName"] . "</td>
                        <td>" . $row["userEmail"] . "</td>
                        <td>" . $row["userPassword"] . "</td>
                        <td>" . $row["residentIdPk"] . "</td>
                        <td>" . $row["residentGender"] . "</td>
                        <td>" . date("Y") - $row["residentBirthYear"] . "</td>
                        <td>" . $row["locationName"] . "</td>
                        <td>" . $row["interestCount"] . "</td>
                        <td>
                            <a class='btn btn-primary btn-sm' href='02ManageUser.php?uId=$row[userIdPk]&rId=$row[residentIdPk]&role=1'>Update</a>
                            <a class='btn btn-danger btn-sm' href='include/deleteUser.php?uId=$row[userIdPk]&rId=$row[residentIdPk]&role=1'>Delete</a>
                        </td>
                    </tr>";
                }
                ?>
            </tbody>
        </table>
        <h3 style="margin-left: 150px;">Business users    <a class="btn btn-success btn-sm" type="submit" href="02RegisterUser.php?register_as=business" name="addBusinessUser">Add a new business user</a></h3>
        <table class="table">
            <thead style="border-bottom-width: 3px; border-bottom-color: white;">
                <tr>
                <th width=5%>User ID</th>
                <th width=4%>Title</th>
                <th width=7%>First name</th>
                <th width=12%>Last name</th>
                <th width=10%>Email</th>
                <th width=7%>Password</th>
                <th>Business ID</th>
                <th>Business name</th>
                <th>Council</th>
                <th width=10%>Actions</th>
                </tr>
            </thead>
            <tbody style="color: white; background-color: #527558;">
                <?php
                $sql = "SELECT u.*, b.*, c.*
                        FROM ((user u 
                        JOIN business b ON u.roleId = b.businessIdPk) 
                        JOIN council c ON c.councilIdPk = b.councilIdPk)
                        WHERE userRole=2";
                $result = $connection->query($sql);
                if (!$result) {
                    throw new Exception("Invalid query: " . $connection->error);
                }
                while ($row = $result->fetch_assoc()) {
                    echo 
                    "<tr>
                        <td>" . $row["userIdPk"] . "</td>
                        <td>" . $row["userTitle"] . "</td>
                        <td>" . $row["userFirstName"] . "</td>
                        <td>" . $row["userLastName"] . "</td>
                        <td>" . $row["userEmail"] . "</td>
                        <td>" . $row["userPassword"] . "</td>
                        <td>" . $row["businessIdPk"] . "</td>
                        <td>" . $row["businessName"] . "</td>
                        <td>" . $row["councilName"] . "</td>
                        <td>
                            <a class='btn btn-primary btn-sm' href='02ManageUser.php?uId=$row[userIdPk]&rId=$row[businessIdPk]&role=2'>Update</a>
                            <a class='btn btn-danger btn-sm' href='include/deleteUser.php?uId=$row[userIdPk]&rId=$row[businessIdPk]&role=2'>Delete</a>
                        </td>
                    </tr>";
                }
                ?>
            </tbody>
        </table>
        <h3 style="margin-left: 150px;">Council users    <a class="btn btn-success btn-sm" type="submit" href="02RegisterUser.php?register_as=council" name="addCouncil">Add a new council user</a></h3>
        <table class="table">
            <thead style="border-bottom-width: 3px; border-bottom-color: white;">
                <tr>
                <th width=5%>User ID</th>
                <th width=4%>Title</th>
                <th width=7%>First name</th>
                <th width=12%>Last name</th>
                <th width=10%>Email</th>
                <th width=7%>Password</th>
                <th>Council ID</th>
                <th>Council name</th>
                <th width=10%>Actions</th>
                </tr>
            </thead>
            <tbody style="color: white; background-color: #527558;">
                <?php
                $sql = "SELECT u.*,  c.*
                        FROM user u JOIN council c ON c.councilIdPk = u.roleId
                        WHERE userRole=3";
                $result = $connection->query($sql);
                if (!$result) {
                    throw new Exception("Invalid query: " . $connection->error);
                }
                while ($row = $result->fetch_assoc()) {
                    echo 
                    "<tr>
                        <td>" . $row["userIdPk"] . "</td>
                        <td>" . $row["userTitle"] . "</td>
                        <td>" . $row["userFirstName"] . "</td>
                        <td>" . $row["userLastName"] . "</td>
                        <td>" . $row["userEmail"] . "</td>
                        <td>" . $row["userPassword"] . "</td>
                        <td>" . $row["councilIdPk"] . "</td>
                        <td>" . $row["councilName"] . "</td>
                        <td>
                            <a class='btn btn-primary btn-sm' href='02ManageUser.php?uId=$row[userIdPk]&rId=$row[councilIdPk]&role=3'>Update</a>
                            <a class='btn btn-danger btn-sm' href='include/deleteUser.php?uId=$row[userIdPk]&rId=$row[councilIdPk]&role=3'>Delete</a>
                        </td>
                    </tr>";
                }
                ?>
            </tbody>
        </table>
        <h3 style="margin-left: 150px;">Super admin users</h3>
        <table class="table">
            <thead style="border-bottom-width: 3px; border-bottom-color: white;">
                <tr>
                <th width=5%>User ID</th>
                <th width=4%>Title</th>
                <th width=7%>First name</th>
                <th width=12%>Last name</th>
                <th width=10%>Email</th>
                <th >Password</th>
                <th width=10%>Actions</th>
                </tr>
            </thead>
            <tbody style="color: white; background-color: #527558;">
                <?php
                $sql = "SELECT *
                        FROM user u 
                        WHERE userRole=4";
                $result = $connection->query($sql);
                if (!$result) {
                    throw new Exception("Invalid query: " . $connection->error);
                }
                while ($row = $result->fetch_assoc()) {
                    echo 
                    "<tr>
                        <td>" . $row["userIdPk"] . "</td>
                        <td>" . $row["userTitle"] . "</td>
                        <td>" . $row["userFirstName"] . "</td>
                        <td>" . $row["userLastName"] . "</td>
                        <td>" . $row["userEmail"] . "</td>
                        <td>" . $row["userPassword"] . "</td>
                        <td>
                            <a class='btn btn-primary btn-sm' href='02ManageUser.php?uId=$row[userIdPk]&rId=$row[roleId]&role=4'>Update</a>
                            <a class='btn btn-danger btn-sm' href='include/deleteUser.php?uId=$row[userIdPk]&rId=$row[roleId]&role=4'>Delete</a>
                        </td>
                    </tr>";
                }
                ?>
            </tbody>
        </table>
    </section>
    <!-- Gets the footer from a central location -->
    <div id="footer"><?php include('templates/template_footer.php'); ?></div>
</body>

</html>