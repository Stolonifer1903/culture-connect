<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Site map</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link href = "css/style.css" rel="stylesheet">
</head>
<body>
    <?php
        session_start();
        include ('include/config.php')
    ?>
     <!-- Gets the header from a central location -->
    <div id="header"><?php include('templates\template_navbar.php'); ?></div>
    <!-- Header-->
     <section class = "text-left py-5" style="background-color:#ACC8A2;"><h1 style="margin-left: 150px;">Site map</h1></section>
    <!-- Main content -->
    <section class = "text-left py-5"style="margin-left: 150px;" >  
        <ul>
            <a href="00Home.php">Home</a>
        </ul>
        <ul>
            <a href="02RegisterUser.php">Register</a>
        </ul>
        <ul>
            <a href="03EditBusiness.php">Edit business</a>
        </ul>
        <ul>
            <a href="04ManageOfferings.html">Manage offerings</a>
        </ul>
        <ul>
            <a href="05EditOffering.php">Offering details</a>
        </ul>
        <ul>
            <a href="01EditLocations.php">Manage locations</a>
        </ul>
        <ul>
            <a href="99FeatureComing.html">Edit user profile</a>
        </ul>
        <ul>
            <a href="99FeatureComing.html">Admin pages</a>
        </ul>
    </section>
    <!-- Gets the footer from a central location -->
    <div id="footer"><?php include('templates\template_footer.php'); ?></div>    
</body>
</html>