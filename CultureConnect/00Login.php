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

    <nav class="navbar navbar-expand-lg navbar-custom">
        <div class="container">
            <a class="navbar-brand" href="00Home.php">CULTURE CONNECT</a>
        </div>
    </nav>

    <!-- Login box -->
    <section class="text-center py-2 d-flex align-items-center justify-content-center" style="min-height: 80vh;">
        <div id="login" class="container">
            <br><br><br><br>
            <h2> Log in to view our initiatives </h2>
            <form name="login" method="post" action="include/login.php">
                <table class="table" height="140" style="width: 35%;">
                    <tr>
                        <td>Email Address: * </td>
                        <td><input type="text" name="email" /></td>
                    </tr>
                    <tr>
                        <td>Password: * </td>
                        <td><input type="password" name="password" /></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><input class='btn btn-custom' style="margin-right:25px;margin-top:20px" type="submit"
                                value="Log in" id="login" name="login"></td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <a href="02RegisterUser.php" class='link-dark' style="margin-left: 80px;">Register</a>
                            <a href="99FeatureComing.html" class='link-dark' style="margin-left: 50px">Reset
                                password</a>
                        </td>
                </table>
            </form>
            <?php
            //session_start();
            include('include/config.php');
            //var_dump($_SESSION);
            if (isset($_SESSION['error'])) {
                echo "<p color: red>" . $_SESSION['error'] . "</p>";
                unset($_SESSION['error']);
            } else {
                echo "<p></p>";
            }
            ?>
        </div>
    </section>
    </br>
    <!-- Gets the footer from a central location -->
    <div id="footer"><?php include('templates/template_footer.php'); ?></div>
</body>

</html>