<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enter your details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"> 
    <link href="css/style.css" rel="stylesheet">
    <script src ="js/toggleFieldsRegisterUser.js"></script>
</head>

<body>
    <?php
        session_start();
        include ('include/config.php');
    ?>
    <!-- Gets the header from a central location -->
    <div id="header"><?php include('templates/template_navbar.php'); ?></div>
    <!
    <!--Page heading-->
    <section class = "text-left py-5" style="background-color:#ACC8A2;"><div class="container"><h1>Enter your details</h1></div></section>
    <!-- Select which user type to register as -->
   <!--  <section class = "text-left py-3"> 
        <div class = "container" id="register_as_"> 
            <table>
                <tr>
                    <td><h3><label for="register_as" style="margin-right:25px">Register as:</label></h3></td>
                    <td><h3>
                        <input type="radio" id="resident" name="register_as" value="1" onclick="toggleFieldsRegisterUser(this.id)" checked >
                        <label for="resident" style="margin-right:25px">Resident </label>
                        <input type="radio" id="business" name="register_as" value="2" onclick="toggleFieldsRegisterUser(this.id)">
                        <label for="business" style="margin-right:25px">Business </label>
                        <input type="radio" id="council_rep" name="register_as" value="3" onclick="toggleFieldsRegisterUser(this.id)">
                        <label for="council_rep" style="margin-right:25px">Council representative</label>
                    </h3></td>
                </tr>
            </table>
        </div>
    </section> -->
    <!-- Enter registration details -->
    <section class = "text-left py-2">
        <div class = "container" id="register_user_" >
            <form id="AddUser" name="AddUser" action="include/addUser.php" method="post" width=65%>
                <table class="table">
                    <tr>
                        <td><label for="title_select">Title:</label></td>
                        <td><select id="title_select" name="title_select" width = 50%>
                                <option value="">Select title (optional)</option>
                                <option value="Mr">Mr</option>
                                <option value="Mrs">Mrs</option>
                                <option value="Miss">Miss</option>
                                <option value="Ms">Ms</option>
                                <option value="Mx">Mx</option>
                            </select></td>
                    </tr>
                    <tr>
                        <td><label for="firstname">First Name:</label></td>
                        <td><input type="text" id="firstname" name="firstname" required size="65%"></td>
                    </tr>
                    <tr>
                        <td><label for="lastname">Last Name:</label></td>
                        <td><input type="text" id="lastname" name="lastname" required size="65%"></td>
                    </tr>
                    <tr id="business_name">
                        <td><label for="bus_name">Business Name:</label></td>
                        <td><input type="text" id="bus_name" name="bus_name" size="65%"></td>
                    </tr>
                    <tr>
                        <td><label for="email">Email:</label></td>
                        <td><input type="email" id="email" name="email" required size="65%"></td>
                    </tr>
                    <tr>
                        <td><label for="password">Password:</label></td>
                        <td><input type="password" id="password" name="password" required size="65%"></td>
                    </tr>
                    <tr id="birth_year">
                        <td><label for="YOB">Year of birth:</label></td>
                        <td><select id="yob" name="yob">
                            <option>Select year of birth</option>
                        </select></td>
                        
                        <!-- <td><input type="date" id="yob" name="yob" min="1925" max="2020"></td> -->
                        <script>
                            let yy = document.getElementById('yob');
                            let yymin = 1926;
                            let year = 2015;
                            while (year >= yymin) {
                                let opt = document.createElement('option');
                                opt.text = year;
                                opt.value = year;
                                yy.add(opt);
                                year -= 1;
                            } 
                        </script>
                    </tr>
                    <tr id="gender">
                        <td><label>Gender:</label></td>
                        <td>
                            <input type="radio" id="male" name="gender_select" value="Male" checked>
                            <label for="male"style="margin-right:25px">Male </label>
                            <input type="radio" id="female" name="gender_select" value="Female">
                            <label for="female" style="margin-right:25px">Female </label>
                            <input type="radio" id="preferNotToSay" name="gender_select" value="Prefer not to say">
                            <label for="preferNotToSay" style="margin-right:25px">Prefer not to say </label>
                        </td>
                    </tr>
                    <tr id="interests">
                        <td><label>Interests:</label></td>
                        <td>
                            <table>
                                <tr><td><b>Services:<b></td></tr>
                                <tr>
                                    <td>
                                        <input type="checkbox" id="artClasses" name="servicesandproducts[]" value="Art classes">
                                        <label for="artClasses">Art classes</label>
                                    </td>
                                    <td>
                                        <input type="checkbox" id="music" name="servicesandproducts[]" value="Music lessons">
                                        <label for="music">Music lessons</label>
                                    </td>
                                    <td>
                                        <input type="checkbox" id="liveTheatre" name="servicesandproducts[]" value="Live theatre performances">
                                        <label for="liveTheatre">Live theatre performances</label>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <input type="checkbox" id="concerts" name="servicesandproducts[]" value="Concerts">
                                        <label for="concerts">Concerts</label>
                                    </td>
                                    <td>
                                        <input type="checkbox" id="openMic" name="servicesandproducts[]" value="Open mic nights">
                                        <label for="openMic">Open mic nights</label>
                                    </td>
                                                                
                                    <td>
                                        <input type="checkbox" id="tours" name="servicesandproducts[]" value="Guided cultural tours">
                                        <label for="tours">Guided cultural tours</label>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <input type="checkbox" id="museums" name="servicesandproducts[]" value="Museum visits">
                                        <label for="museums">Museum visits</label>
                                    </td>
                                    <td>                                        
                                        <input type="checkbox" id="gallerys" name="servicesandproducts[]" value="Gallery visits">
                                        <label for="gallerys">Gallery visits</label>
                                    </td>
                                    <td>
                                        <input type="checkbox" id="photography" name="servicesandproducts[]" value="Photography services">
                                        <label for="photography">Photography services</label>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <input type="checkbox" id="videography" name="servicesandproducts[]" value="Videography services">
                                        <label for="videography">Videography services</label>
                                    </td>
                                    <td>
                                        <input type="checkbox" id="graphicDesign" name="servicesandproducts[]" value="Graphic design">
                                        <label for="graphicDesign">Graphic design</label>
                                    </td>
                                    <td>
                                        <input type="checkbox" id="digitalDesign" name="servicesandproducts[]" value="Digital design">
                                        <label for="digitalDesign">Digital design</label>
                                    </td>
                                </tr>
                                <tr><td style="margin-top: '10px'"><b>Products:<b></td></tr>
                                <tr>
                                    <td>
                                        <input type="checkbox" id="artwork" name="servicesandproducts[]" value="Original artwork">
                                        <label for="artwork">Original artwork</label>
                                    </td>
                                    <td>
                                        <input type="checkbox" id="ceramics" name="servicesandproducts[]" value="Handmade ceramics">
                                        <label for="ceramics">Handmade ceramics</label>
                                    </td>
                                    <td>
                                        <input type="checkbox" id="books" name="servicesandproducts[]" value="Independent books">
                                        <label for="books">Independent books</label>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <input type="checkbox" id="zines" name="servicesandproducts[]" value="Local zines and magazines">
                                        <label for="zines">Local zines and magazines</label>
                                    </td>
                                    <td>
                                        <input type="checkbox" id="posters" name="servicesandproducts[]" value="Limited edition posters">
                                        <label for="posters">Limited edition posters</label>
                                    </td>
                                    <td>
                                        <input type="checkbox" id="stationery" name="servicesandproducts[]" value="Artisan stationery">
                                        <label for="stationery">Artisan stationery</label>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr id="council">
                        <td><label for="council_select">Council:</label></td>
                        <td>
                            <select id="council_select" name="council_select">
                                <option value="">Select council</option>
                                <?php
                                    include 'include/config.php';
                                    $sql = "SELECT councilName from council";
                                    $result = $connection->query($sql);
                                    if (!$result) {
                                        die("Invalid query: ". $connection->error);
                                    }
                                    while($row = $result->fetch_assoc()){
                                        $name = htmlspecialchars($row['councilName'], ENT_QUOTES, 'UTF-8');
                                        echo "<option value='" . $name . "'>" . $name . "</option>";
                                    }  
                                ?> 
                            </select>
                        </td>
                    </tr>
                    <tr id="location">
                        <td><label for="location_select">Location:</label></td>
                        <td>
                            <select id="location_select" name="location_select" width = 50%>
                                <option value="">Select location</option>
                                 <?php
                                    include 'include/config.php';
                                    $sql = "SELECT locationName FROM location";
                                    $result = $connection->query($sql);
                                    if (!$result) {
                                        die("Invalid query: " . $connection->error);
                                    }
                                    while ($row = $result->fetch_assoc()) {
                                        $name = htmlspecialchars($row['locationName'], ENT_QUOTES, 'UTF-8');
                                        echo "<option value='" . $name . "'>" . $name . "</option>";
                                    }
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td><label for=""></label></td>
                        <td><table>
                            <tr>
                                <td>
                                <input class='btn btn-custom btn-sm' style="margin-right:25px;" type="submit" value="Register" name="register">
                                <input class='btn btn-secondary btn-sm' style="margin-right:25px"action="action" type="button" value="Cancel" 
                                        onclick="window.history.go(-1); return false;">
                                </td>
                            </tr>
                        </td></table>
                    </tr>
                </table>
                <input type= "hidden" id="user_type" name="user_type" value=''>
            </form>
        </div>
    </section>

    <script>
        // Get the registration type from the url
        const urlParams = new URLSearchParams(window.location.search);
        const registerAs = urlParams.get('register_as');
        if (registerAs==='business' || registerAs == 'council') {
            toggleFieldsRegisterUser(registerAs);
        } else {
            toggleFieldsRegisterUser('resident')
        }
         console.log("user_type value:", document.getElementById("user_type").value);
    </script>

    <?php
    echo "<pre>";
    print_r($_POST);
    echo "</pre>";
    ?>
    
</body>
</html>
        