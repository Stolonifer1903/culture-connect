<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enter your details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"> 
    <link href="css/style.css" rel="stylesheet">
    <script src ="js/toggleFieldsManageUser.js"></script>
</head>

<body>
    <?php
        session_start();
        include ('include/config.php');
        include ('include/getUserInfo.php');
    ?>
    <!-- Gets the header from a central location -->
    <div id="header"><?php include('templates/template_navbar.php'); ?></div>

    <!-- Success Toast Container -->
    <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
        <?php
            if (isset($_GET['profileUpdateSuccess']) && $_GET['profileUpdateSuccess'] == 'true') {
                echo '<div class="toast align-items-center text-bg-success border-0" role="alert" aria-live="assertive" aria-atomic="true" id="profileSuccessToast">
                        <div class="d-flex">
                            <div class="toast-body">
                                ✓ Profile updated successfully!
                            </div>
                            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                        </div>
                    </div>';
            }
            if (isset($_GET['passwordChangeSuccess']) && $_GET['passwordChangeSuccess'] == 'true') {
                echo '<div class="toast align-items-center text-bg-success border-0" role="alert" aria-live="assertive" aria-atomic="true" id="passwordSuccessToast">
                        <div class="d-flex">
                            <div class="toast-body">
                                ✓ Password changed successfully!
                            </div>
                            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                        </div>
                    </div>';
            }
        ?>
    </div>

    <script>
        // Show and auto-dismiss toasts
        document.addEventListener('DOMContentLoaded', function() {
            const profileToast = document.getElementById('profileSuccessToast');
            const passwordToast = document.getElementById('passwordSuccessToast');
            
            if (profileToast) {
                const toast = new bootstrap.Toast(profileToast, { delay: 4000 });
                toast.show();
            }
            
            if (passwordToast) {
                const toast = new bootstrap.Toast(passwordToast, { delay: 4000 });
                toast.show();
            }
        });
    </script>

    <!--Page heading-->
    <section class = "text-left py-5" style="background-color:#ACC8A2;"><div class="container"><h1>Enter your details</h1></div></section>
    <!-- Enter registration details -->
    <section class = "text-left py-2">
        <div class = "container" id="register_user_" >
            <form id="AddUser" name="AddUser" action="include/updateUser.php" method="post" width=65%>
                <table class="table">
                    
                    <tr>
                        <td><label for='title_select'>Title:</label></td>
                        <td><select id='title_select' name='title_select' width = 50%>
                                <option value=''>Select title (optional)</option>
                    <?php
                                if ($title == 'Mr') {echo "<option value='Mr' selected>Mr</option>";} else {echo "<option value='Mr'>Mr</option>";}
                                if ($title == 'Mrs') {echo "<option value='Mrs' selected>Mrs</option>";} else {echo "<option value='Mrs'>Mrs</option>";}
                                if ($title == 'Miss') {echo "<option value='Miss' selected>Miss</option>";} else {echo "<option value='Miss'>Miss</option>";}
                                if ($title == 'Ms') {echo "<option value='Ms' selected>Ms</option>";} else {echo "<option value='Ms'>Ms</option>";}
                                if ($title == 'Mx') {echo "<option value='Mx' selected>Mx</option>";} else {echo "<option value='Mx'>Mx</option>";}
                    ?>
                            </select></td>
                    </tr>
                    
                    <tr>
                        <td><label for='firstname'>First Name:</label></td>
                        <?php echo "<td><input type='text' id='firstname' name='firstname' required size='65%' value='" . $first_name . "'></td>";?>
                    </tr>
                    <tr>
                        <td><label for='lastname'>Last Name:</label></td>
                        <?php echo "<td><input type='text' id='lastname' name='lastname' required size='65%' value='" . $last_name . "'></td>";?>
                    </tr>
                    <tr>
                        <td><label for='email'>Email:</label></td>
                        <?php echo "<td><input type='email' id='email' name='email' required size='65%' value='" . $email . "'></td>";?>
                    </tr>
                    <tr id="birth_year">
                        <td><label for="YOB">Year of birth:</label></td>
                        <td><select id="yob" name="yob">
                            <option>Select year of birth</option>
                        </select></td>
                        
                        <script>
                            let yy = document.getElementById('yob');
                            let yymin = 1926;
                            let year = 2015;
                            let selectedYear = <?php echo isset($yob) ? $yob : 'null' ?>;
                            while (year >= yymin) {
                                let opt = document.createElement('option');
                                opt.text = year;
                                opt.value = year;
                                if (year == selectedYear) {
                                    opt.selected = true;
                                }
                                yy.add(opt);
                                year -= 1;
                            } 
                        </script>
                    </tr>
                    <tr id="gender">
                        <td><label>Gender:</label></td>
                        <td>
                            <?php
                                if ($gender == 'Male') {echo "<input type='radio' id='male' name='gender_select' value='Male' checked>";} else {echo "<input type='radio' id='male' name='gender_select' value='Male'>";}
                                echo "<label for='male' style='margin-right:25px'>Male </label>";
                                if ($gender == 'Female') {echo "<input type='radio' id='female' name='gender_select' value='Female' checked>";} else {echo "<input type='radio' id='female' name='gender_select' value='Female'>";}
                                echo "<label for='female' style='margin-right:25px'>Female </label>";
                                if ($gender == 'Prefer not to say') {echo "<input type='radio' id='preferNotToSay' name='gender_select' value='Prefer not to say' checked>";} else {echo "<input type='radio' id='preferNotToSay' name='gender_select' value='Prefer not to say'>";}
                                echo "<label for='preferNotToSay' style='margin-right:25px'>Prefer not to say </label>";
                            ?>
                        </td>
                    </tr>
                    <tr id="interests">
                        <td><label>Interests:</label></td>
                        <td>
                            <table>
                                <tr><td><b>Services:</b></td></tr>
                                <tr>
                                    <td>
                                        <?php
                                        if (in_array('Art classes', $interests)) {echo "<input type='checkbox' id='artClasses' name='servicesandproducts[]' value='Art classes' checked>";} 
                                        else {echo "<input type='checkbox' id='artClasses' name='servicesandproducts[]' value='Art classes'>";}
                                        ?>
                                        <label for='artClasses'>Art classes</label>
                                    </td>
                                    <td>
                                        <?php
                                        if (in_array('Music lessons', $interests)) {echo "<input type='checkbox' id='music' name='servicesandproducts[]' value='Music lessons' checked>";} 
                                        else {echo "<input type='checkbox' id='music' name='servicesandproducts[]' value='Music lessons'>";}
                                        ?>
                                        <label for='music'>Music lessons</label>
                                    </td>
                                    <td>
                                        <?php
                                        if (in_array('Live theatre performances', $interests)) {echo "<input type='checkbox' id='liveTheatre' name='servicesandproducts[]' value='Live theatre performances' checked>";}
                                        else {echo "<input type='checkbox' id='liveTheatre' name='servicesandproducts[]' value='Live theatre performances'>";}
                                        ?><label for='liveTheatre'>Live theatre performances</label>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <?php
                                        if (in_array('Concerts', $interests)) {echo "<input type='checkbox' id='concerts' name='servicesandproducts[]' value='Concerts' checked>";}
                                        else {echo "<input type='checkbox' id='concerts' name='servicesandproducts[]' value='Concerts'>";}
                                        ?>
                                        <label for='concerts'>Concerts</label>
                                    </td>
                                    <td>
                                        <?php
                                        if (in_array('Open mic nights', $interests)) {echo "<input type='checkbox' id='openMic' name='servicesandproducts[]' value='Open mic nights' checked>";}
                                        else {echo "<input type='checkbox' id='openMic' name='servicesandproducts[]' value='Open mic nights'>";}
                                        ?>
                                        <label for='openMic'>Open mic nights</label>
                                    </td>
                                                                
                                    <td>
                                        <?php
                                        if (in_array('Guided cultural tours', $interests)) {echo "<input type='checkbox' id='tours' name='servicesandproducts[]' value='Guided cultural tours' checked>";}
                                        else {echo "<input type='checkbox' id='tours' name='servicesandproducts[]' value='Guided cultural tours'>";}
                                        ?>
                                        <label for='tours'>Guided cultural tours</label>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <?php
                                        if (in_array('Museum visits', $interests)) {echo "<input type='checkbox' id='museums' name='servicesandproducts[]' value='Museum visits' checked>";}
                                        else {echo "<input type='checkbox' id='museums' name='servicesandproducts[]' value='Museum visits'>";}
                                        ?>
                                        <label for='museums'>Museum visits</label>
                                    </td>
                                    <td>
                                        <?php                                      
                                        if (in_array('Gallery visits', $interests)) {echo "<input type='checkbox' id='gallerys' name='servicesandproducts[]' value='Gallery visits' checked>";}
                                        else {echo "<input type='checkbox' id='gallerys' name='servicesandproducts[]' value='Gallery visits'>";}
                                        ?>
                                        <label for='gallerys'>Gallery visits</label>
                                    </td>
                                    <td>
                                        <?php
                                        if (in_array('Photography services', $interests)) {echo "<input type='checkbox' id='photography' name='servicesandproducts[]' value='Photography services' checked>";}
                                        else {echo "<input type='checkbox' id='photography' name='servicesandproducts[]' value='Photography services'>";}
                                        ?>
                                        <label for='photography'>Photography services</label>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <?php
                                        if (in_array('Videography services', $interests)) {echo "<input type='checkbox' id='videography' name='servicesandproducts[]' value='Videography services' checked>";}
                                        else {echo "<input type='checkbox' id='videography' name='servicesandproducts[]' value='Videography services'>";}
                                        ?>
                                        <label for='videography'>Videography services</label>
                                    </td>
                                    <td>
                                        <?php
                                        if (in_array('Graphic design', $interests)) {echo "<input type='checkbox' id='graphicDesign' name='servicesandproducts[]' value='Graphic design' checked>";}
                                        else {echo "<input type='checkbox' id='graphicDesign' name='servicesandproducts[]' value='Graphic design'>";}
                                        ?>
                                        <label for='graphicDesign'>Graphic design</label>
                                    </td>
                                    <td>
                                        <?php
                                        if (in_array('Digital design', $interests)) {echo "<input type='checkbox' id='digitalDesign' name='servicesandproducts[]' value='Digital design' checked>";}
                                        else {echo "<input type='checkbox' id='digitalDesign' name='servicesandproducts[]' value='Digital design'>";}
                                        ?>
                                        <label for='digitalDesign'>Digital design</label>
                                    </td>
                                </tr>
                                <tr><td style='margin-top: '10px''><b>Products:</b></td></tr>
                                <tr>
                                    <td>
                                        <?php
                                        if (in_array('Original artwork', $interests)) {echo "<input type='checkbox' id='artwork' name='servicesandproducts[]' value='Original artwork' checked>";}
                                        else {echo "<input type='checkbox' id='artwork' name='servicesandproducts[]' value='Original artwork'>";}
                                        ?>
                                        <label for='artwork'>Original artwork</label>
                                    </td>
                                    <td>
                                        <?php
                                        if (in_array('Handmade ceramics', $interests)) {echo "<input type='checkbox' id='ceramics' name='servicesandproducts[]' value='Handmade ceramics' checked>";}
                                        else {echo "<input type='checkbox' id='ceramics' name='servicesandproducts[]' value='Handmade ceramics'>";}
                                        ?>
                                        <label for='ceramics'>Handmade ceramics</label>
                                    </td>
                                    <td>
                                        <?php
                                        if (in_array('Independent books', $interests)) {echo "<input type='checkbox' id='books' name='servicesandproducts[]' value='Independent books' checked>";}
                                        else {echo "<input type='checkbox' id='books' name='servicesandproducts[]' value='Independent books'>";}
                                        ?>
                                        <label for='books'>Independent books</label>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <?php
                                        if (in_array('Local zines and magazines', $interests)) {echo "<input type='checkbox' id='zines' name='servicesandproducts[]' value='Local zines and magazines' checked>";}
                                        else {echo "<input type='checkbox' id='zines' name='servicesandproducts[]' value='Local zines and magazines'>";}
                                        ?>
                                        <label for='zines'>Local zines and magazines</label>
                                    </td>
                                    <td>
                                    <?php
                                        if (in_array('Limited edition posters', $interests)) {echo "<input type='checkbox' id='posters' name='servicesandproducts[]' value='Limited edition posters' checked>";}
                                        else {echo "<input type='checkbox' id='posters' name='servicesandproducts[]' value='Limited edition posters'>";}
                                        ?>
                                        <label for='posters'>Limited edition posters</label>
                                    </td>
                                    <td>
                                        <?php
                                        if (in_array('Artisan stationery', $interests)) {echo "<input type='checkbox' id='stationery' name='servicesandproducts[]' value='Artisan stationery' checked>";}
                                        else {echo "<input type='checkbox' id='stationery' name='servicesandproducts[]' value='Artisan stationery'>";}
                                        ?>
                                        <label for='stationery'>Artisan stationery</label>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    
                    <tr id="location">
                        <td><label for="location_select">Location:</label></td>
                        <td>
                            <select id="location_select" name="location_select" width = 50%>
                                <option value="">Select location</option>
                                 <?php
                                    $sql = "SELECT locationName FROM location";
                                    $result = $connection->query($sql);
                                    if (!$result) {
                                        throw new Exception("Invalid query: " . $connection->error);
                                    }
                                    while ($row = $result->fetch_assoc()) {
                                        $name = $row['locationName'];
                                        if ($location_name == $name) {
                                            $name = htmlspecialchars($row['locationName'], ENT_QUOTES, 'UTF-8');
                                            echo "<option value='" . $name . "' selected>" . $name . "</option>";
                                        } else {
                                            echo "<option value='" . $name . "'>" . $name . "</option>";
                                        }
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
                                <input class='btn btn-custom btn-sm' style="margin-right:25px;" type="submit" value="Update" name="update">
                                <button type='button' class='btn btn-info btn-sm' style="margin-right:25px;" data-bs-toggle='modal' data-bs-target='#changePasswordModal'>Change Password</button>
                                <input class='btn btn-secondary btn-sm' style="margin-right:25px"action="action" type="button" value="Cancel" 
                                        onclick="window.history.go(-1); return false;">
                                </td>
                            </tr>
                        </td></table>
                    </tr>
                </table>
            </form>
        </div>
    </section>

    <!-- Change Password Modal -->
    <div class="modal fade" id="changePasswordModal" tabindex="-1" aria-labelledby="changePasswordLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="changePasswordLabel">Change Password</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="changePasswordForm" action="include/changePassword.php" method="post">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="currentPassword" class="form-label">Current Password <span style="color: red;">*</span></label>
                            <input type="password" class="form-control" id="currentPassword" name="current_password" required>
                        </div>
                        <div class="mb-3">
                            <label for="newPassword" class="form-label">New Password <span style="color: red;">*</span></label>
                            <input type="password" class="form-control" id="newPassword" name="new_password" required>
                        </div>
                        <div class="mb-3">
                            <label for="confirmPassword" class="form-label">Confirm Password <span style="color: red;">*</span></label>
                            <input type="password" class="form-control" id="confirmPassword" name="confirm_password" required>
                        </div>
                        <div id="passwordError" class="alert alert-danger" style="display: none;"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Update Password</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded',function(){
            // Get the user type from the session variable
            let user_type = <?php echo isset($_SESSION['role']) ? $_SESSION['role'] : 1 ?>;
            console.log("toggleFieldsManageUser called with: " + user_type);
            if (user_type===2) {
                toggleFieldsManageUser('business');
            } else if (user_type===3) {
                toggleFieldsManageUser('council');
            } else if (user_type===4) {
                toggleFieldsManageUser('admin');
            } else {
                toggleFieldsManageUser('resident')
            }
            console.log("user_type value:", user_type);
            
            // Password change form validation
            const changePasswordForm = document.getElementById('changePasswordForm');
            if (changePasswordForm) {
                changePasswordForm.addEventListener('submit', function(e) {
                    const newPassword = document.getElementById('newPassword').value;
                    const confirmPassword = document.getElementById('confirmPassword').value;
                    const passwordError = document.getElementById('passwordError');
                    
                    if (newPassword !== confirmPassword) {
                        e.preventDefault();
                        passwordError.textContent = 'New passwords do not match!';
                        passwordError.style.display = 'block';
                        return false;
                    }
                    
                    if (newPassword.length === 0) {
                        e.preventDefault();
                        passwordError.textContent = 'New password cannot be empty!';
                        passwordError.style.display = 'block';
                        return false;
                    }
                    
                    passwordError.style.display = 'none';
                });
            }
            
            // Clear password fields when modal is closed
            const changePasswordModal = document.getElementById('changePasswordModal');
            if (changePasswordModal) {
                changePasswordModal.addEventListener('hidden.bs.modal', function() {
                    document.getElementById('currentPassword').value = '';
                    document.getElementById('newPassword').value = '';
                    document.getElementById('confirmPassword').value = '';
                    document.getElementById('passwordError').style.display = 'none';
                });
            }
        });
    </script>

</body>
</html>
        