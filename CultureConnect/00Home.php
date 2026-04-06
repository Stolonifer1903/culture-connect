<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Culture Connect</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <?php
    session_start();
    include('include/config.php')
        ?>
    <!-- Gets the header from a central location -->
    <div id="header"><?php include('templates/template_navbar.php'); ?></div>

    <!-- Welcome message -->
    <section class="text-center py-4" style="background-color:#3A5A40;">
        <div class="container">
            <h1 style="color:white">Welcome to Culture Connect</h1>
            <p style="color:white">Discover, celebrate, and shape the culture on your doorstep. <br> Your voice helps
                local councils and creative businesses build a thriving cultural scene that truly reflects what your
                community loves.</p>
        </div>
    </section>

    <!-- Banner -->
    <div style="width:100%; height:350px; background-image: url('images/banner2.jpg'); background-size: cover;"></div>

    <!-- HERO -->
    <section class="text-center py-4" style="background-color:#ACC8A2;">
        <div class="container">
            <h1>Discover Local Culture</h1>
            <p>Find art, events and businesses near you</p>
            <a class="btn btn-custom" href="showOfferings.php">Explore</a>
        </div>
    </section>

    <!-- CARDS -->
    <section class="py-5">
        <div class="container">
            <div class="row g-4">

                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h5>Local Artists</h5>
                            <p>Support creatives in your area.</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h5>Events</h5>
                            <p>Discover cultural experiences.</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h5>Businesses</h5>
                            <p>Explore innovative local shops.</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!-- HERO -->
    <section class="text-center py-3" style="background-color:#ACC8A2;">
        <div class="container">
            <h1>Get involved</h1>
            <p>Register an account for your council or business here
            <p>
            <div class="row g-3 justify-content-center">
                <div class="col-md-3">
                    <div class="card" style="background-color:#73916E;" onclick="window.location.href='02RegisterUser.php?register_as=council';">
                        <div class="card-body" style="color:white;">
                            <h5>Councils</h5>
                            <p style="color:white;">Register an account for your council area to showcase local offerings</p>
                            <br>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card" style="background-color:#73916E;" onclick="window.location.href='02RegisterUser.php?register_as=business';">
                        <div class="card-body" style="color:white;">
                            <h5>Businesses</h5>
                            <p style="color:white;">Register an account for your business to share your products or services with the
                                community</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Gets the footer from a central location -->
    <div id="footer"><?php include('templates/template_footer.php'); ?></div>
</body>

</html>