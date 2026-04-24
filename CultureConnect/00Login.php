<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Culture Connect</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link href="css/style.css" rel="stylesheet">
    <script src="js/formValidation.js"></script>
</head>

<body>
    <?php
    session_start();
    include('include/config.php')
    ?>

    <nav class="navbar navbar-expand-lg navbar-custom">
        <div class="container">
            <a class="navbar-brand" href="00Home.php">CULTURE CONNECT</a>
            <a id='home' class='nav-link d-inline' href='00Home.php'>Home</a>
        </div>
    </nav>
    <hr class="m-0">
    <!-- Login box -->
    <section class="text-center py-2 d-flex align-items-center justify-content-center" style="min-height: 80vh;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-5">
                    <h2 class="mb-4">Log in to view our initiatives</h2>
                    <div class="card no-hover border-0 shadow-sm p-4">
                        <div class="card-body">
                            
                            <form id="loginForm" name="login" method="post" action="include/login.php" novalidate>
                                <table class="table table-borderless" style="width: 100%;">
                                    <tr>
                                        <td class="text-start">Email Address: *</td>
                                        <td><input type="email" name="email" id="email" class="form-control"/></td>
                                    </tr>
                                    <tr>
                                        <td class="text-start">Password: *</td>
                                        <td><input type="password" name="password" id="password" class="form-control"/></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td class="text-start"><input class='btn btn-custom' style="margin-top:20px" type="submit" value="Log in" name="login">
                                        <input class='btn btn-secondary' style="margin-top:20px; margin-left:25px" action="action" type="button" value="Cancel" onclick="window.history.go(-1); return false;"></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <a href="02RegisterUser.php?register_as=resident" class='link-dark'>Register</a>
                                            <a href="99FeatureComing.php" class='link-dark' style="margin-left: 50px">Reset password</a>
                                        </td>
                                    </tr>
                                </table>
                            </form>
                        </div>
                        <?php
                        if (isset($_SESSION['error'])) {
                            echo '<div class="alert alert-danger mt-3" role="alert">' . htmlspecialchars($_SESSION['error']) . '</div>';
                            unset($_SESSION['error']);
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Gets the footer from a central location -->
    <div id="footer"><?php include('templates/template_footer.php'); ?></div>

    <script>
        document.getElementById('loginForm').addEventListener('submit', function(e) {
            let isValid = true;
            
            const email = document.getElementById('email');
            const password = document.getElementById('password');
            
            if (!FormValidation.validateEmail(email)) isValid = false;
            if (!FormValidation.validateRequired(password, 'Password is required.')) isValid = false;
            
            if (!isValid) {
                e.preventDefault();
            }
        });
    </script>
</body>

</html>