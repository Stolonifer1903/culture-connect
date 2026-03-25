<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Culture Connect</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link href = "css/style.css" rel="stylesheet">
</head>
<body>
    <!-- Gets the header from a central location -->
    <div id="header"><?php include('templates\template_navbar.php'); ?></div>
    <!-- Welcome message -->
    <section class="text-center py-5" style="background-color:#ACC8A2;">
        <div class="container">
            <h1>Welcome to Culture Connect</h1>
            <p>CultureConnect”, is a web-based cultural development initiative supported by local 
            councils and creative industry partners. The goal of the web-based project is to 
            develop an efficient, user-friendly digital platform that promotes local arts, culture
            , and innovative businesses by connecting residents with cultural experiences, products,
            and services available in their community. The platform encourages cultural participation, 
            supports local creative SMEs, and helps councils understand which cultural offerings 
            residents value most. By collecting community feedback through a structured voting system,
            councils and cultural organisations can make informed decisions about funding, programming,
            and local cultural development.</p>
        </div>
    </section>
    </br>
    <!-- Login box - should only be visible if session is logged in - TODO -->
    <section class="text-center py-2" >
        <div id="login" class="container">
        <h2> Log in to view our initiatives </h2>
            <form name="admin_post" method="post" action="index.php">
                <table class = "table" height="140" style="width: 35%;" >
                    <tr>
                        <td >Email Address: * </td>
                        <td ><input type="text" name="email" /></td>
                    </tr>
                    <tr>
                        <td >Password: * </td>
                        <td ><input type="password" name="admin_pass" /></td>
                    </tr>
                    <tr>
                        <td ></td>
                        <td><input class='btn btn-custom' style="margin-right:25px;margin-top:20px" type="submit" value="Log in"></td>
                    </tr>
                    <tr>
                        <td colspan="2" >
                            <a href="02RegisterUser.php" class='link-dark' style="margin-left: 80px;">Register</a> 
                            <a href="99FeatureComing.html" class='link-dark' style="margin-left: 50px">Reset password</a>
                        </td>
                </table>
            </form>
        </div>
    </section>
    </br>
    <!-- Gets the footer from a central location -->
    <div id="footer"><?php include('templates\template_footer.php'); ?></div>
</body>
</html>
