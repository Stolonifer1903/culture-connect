<!DOCTYPE html>
<html lang='en'>

<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Edit business</title>
    <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css' rel='stylesheet'>
    <link href='css/style.css' rel='stylesheet'>
</head>

<body>
    <!--Session start-->
    <?php
    session_start();
    include('include/config.php')
        ?>
    <!-- Gets the header from a central location -->
    <div id='header'><?php include('templates/template_navbar.php'); ?></div>
    <!--Page heading-->
    <section class='text-left py-5' style='background-color:#ACC8A2;'>
        <h1>
            <div class='container'> Edit business details
        </h1>
        </div>
    </section>
    <!-- Main content -->
    <section class='text-left py-3'>
        <div class='container'>
            <!-- Table containing business details -->
            <form id='edit_bus' name='edit_bus' action='include/editBusiness.php' method='post'>
                <table class='table'>
                    <?php
                    include 'include/config.php';
                    include 'include/getBusinessInfo.php';

                    echo "<!-- Business name -->
                    <tr>
                        <td><label for='businessname'>Business Name:</label></td>
                        <td><input type='text' id='businessname' name='businessname' required size='65%' value='" . $bus_name .  "'></td>
                    </tr>
                    <!-- Contact phone number -->
                    <tr>
                        <td><label for='phone'>Phone number:</label></td>
                        <td><input type='text' id='phone' name='phone' required size='65%' value='" . $bus_phone .  "'></td>
                    </tr>
                    <!-- Contact email -->
                    <tr>
                        <td><label for='email'>Contact email:</label></td>
                        <td><input type='text' id='email' name='email' required size='65%' value='" . $bus_email .  "'></td>
                    </tr>
                    <!-- Business website -->
                    <tr>
                        <td><label for='website'>Web site:</label></td>
                        <td><input type='text' id='website' name='website' required size='65%' value='" . $bus_link .  "'></td>
                    </tr>
                    <!-- Business biography -->
                    <tr>
                        <td><label for='businessbio'>Business biography:</label></td>
                        <td><textarea id='businessbio' name='businessbio' rows='4' cols='68'>" . $bus_bio . "</textarea></td>
                    </tr>
                    <!-- Submit or cancel-->
                    <tr>
                        <td><label for=''></label></td>
                        <td>
                            <table>
                                <tr>
                                    <td>
                                        <input class='btn btn-custom btn-sm' style='margin-right:25px;' type='submit'
                                            value='Update' name='update'>
                                        <input class='btn btn-secondary btn-sm' style='margin-right:25px'
                                            action='action' type='button' value='Cancel'
                                            onclick='window.history.go(-1); return false;'>
                                    </td>
                                </tr>
                        </td>
                </table>
                </tr>"
                ?>
                </table>
            </form>
        </div>
    </section>
    <!-- Gets the footer from a central location -->
    <div id='footer'><?php include('templates/template_footer.php'); ?></div>
</body>

</html>