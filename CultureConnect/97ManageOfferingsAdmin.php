<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage offerings - Admin</title>
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
            <div class="container"> Manage offerings - Admin
        </h1>
        </div>
    </section>
    <section class="text-left py-3">
        <div style="margin-left: 100px; margin-right: 30px;">
            <!-- Add a new product or service -->
            <form id="addoffering" name="addoffering" action="05EditOffering.php" method="post"
                style="margin-left:200px">
                <label for="addOffering"></label>
                <input class="btn btn-success btn-sm" type="submit" value="Add a new product or service"
                    name="addoffering">
            </form>
        </div>
    </section>
    <!-- Main content -->
    <?php include('include/manageOfferingsSection.php');?>

    <!-- Gets the footer from a central location -->
    <div id="footer"><?php include('templates/template_footer.php'); ?></div>
</body>

</html>