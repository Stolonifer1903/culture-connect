<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit council</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
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
            <div class="container"> Edit council details
        </h1>
        </div>
    </section>
    <!-- Main content -->
    <section class="text-left py-3">
        <div class="container">
            <!-- Table containing council details -->
            <form id="edit_bus" name="edit_bus" action="include/editcouncil.php" method="post">
                <table class="table">
                    <!-- council name -->
                    <tr>
                        <td><label for="councilname">Council Name:</label></td>
                        <td><input type="text" id="councilname" name="councilname" required size="65%"></td>
                    </tr>
                    <!-- Contact phone number -->
                    <tr>
                        <td><label for="phone">Phone number:</label></td>
                        <td><input type="text" id="phone" name="phone" required size="65%"></td>
                    </tr>
                    <!-- Contact email -->
                    <tr>
                        <td><label for="email">Contact email:</label></td>
                        <td><input type="text" id="email" name="email" required size="65%"></td>
                    </tr>
                    <!-- council website -->
                    <tr>
                        <td><label for="website">Web site:</label></td>
                        <td><input type="text" id="website" name="website" required size="65%"></td>
                    </tr>
                    <!-- council biography -->
                    <tr>
                        <td><label for="councilbio">Council biography:</label></td>
                        <td><textarea id="councilbio" name="Councilbio" rows="4" cols="68"></textarea></td>
                    </tr>
                    <!-- Submit or cancel-->
                    <tr>
                        <td><label for=""></label></td>
                        <td>
                            <table>
                                <tr>
                                    <td>
                                        <input class='btn btn-custom btn-sm' style="margin-right:25px;" type="submit"
                                            value="Update" name="update">
                                        <input class='btn btn-secondary btn-sm' style="margin-right:25px"
                                            action="action" type="button" value="Cancel"
                                            onclick="window.history.go(-1); return false;">
                                    </td>
                                </tr>
                        </td>
                </table>
                </tr>
                <!-- TODO: Add PHP to update existing details -->
                <?php
                include 'include/config.php';
                ?>
                </table>
            </form>
        </div>
    </section>
    <section>
        <?php
        include '01EditLocations.php';
        ?>
    </section>
    <!-- Gets the footer from a central location -->
    <div id="footer"><?php include('templates/template_footer.php'); ?></div>
</body>

</html>