<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit council</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <script src="js/formValidation.js"></script>
</head>

<body>
    <!--Session start-->
    <?php
    session_start();
    include 'include/config.php';
    include 'include/getCouncilInfo.php';
    if (isset($_SESSION['role'])){
        $role = $_SESSION['role'];
        // $council is already set by include/getCouncilInfo.php
    }
    ?>
    <!-- Gets the header from a central location -->
    <div id="header"><?php include('templates/template_navbar.php'); ?></div>

    <!-- Success Toast Container -->
    <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
        <?php
            if (isset($_GET['councilUpdateSuccess']) && $_GET['councilUpdateSuccess'] == 'true') {
                echo '<div class="toast align-items-center text-bg-success border-0" role="alert" aria-live="assertive" aria-atomic="true" id="councilSuccessToast">
                        <div class="d-flex">
                            <div class="toast-body">
                                ✓ Council updated successfully!
                            </div>
                            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                        </div>
                    </div>';
            }
            if (isset($_GET['locationAddSuccess']) && $_GET['locationAddSuccess'] == 'true') {
                echo '<div class="toast align-items-center text-bg-success border-0" role="alert" aria-live="assertive" aria-atomic="true" id="locationAddSuccessToast">
                        <div class="d-flex">
                            <div class="toast-body">
                                ✓ Location added successfully!
                            </div>
                            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                        </div>
                    </div>';
            }
            if (isset($_GET['locationUpdateSuccess']) && $_GET['locationUpdateSuccess'] == 'true') {
                echo '<div class="toast align-items-center text-bg-success border-0" role="alert" aria-live="assertive" aria-atomic="true" id="locationUpdateSuccessToast">
                        <div class="d-flex">
                            <div class="toast-body">
                                ✓ Location updated successfully!
                            </div>
                            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                        </div>
                    </div>';
            }
            if (isset($_GET['deleteError']) && $_GET['deleteError'] == 'hasDependencies') {
                echo '<div class="toast align-items-center text-bg-danger border-0" role="alert" aria-live="assertive" aria-atomic="true" id="deleteErrorToast">
                        <div class="d-flex">
                            <div class="toast-body">
                                ⚠ Cannot delete: This item has associated data (e.g., offerings or locations).
                            </div>
                             <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                        </div>
                    </div>';
            }
            if (isset($_GET['updateError'])) {
                echo '<div class="toast align-items-center text-bg-danger border-0" role="alert" aria-live="assertive" aria-atomic="true" id="updateErrorToast">
                        <div class="d-flex">
                            <div class="toast-body">
                                ⚠ ' . htmlspecialchars($_GET['updateError']) . '
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
            const councilToast = document.getElementById('councilSuccessToast');
            const addLocationToast = document.getElementById('locationAddSuccessToast');
            const updateLocationToast = document.getElementById('locationUpdateSuccessToast');
            const deleteErrorToast = document.getElementById('deleteErrorToast');
            
            if (councilToast) {
                const toast = new bootstrap.Toast(councilToast, { delay: 4000 });
                toast.show();
            }
            
            if (addLocationToast) {
                const toast = new bootstrap.Toast(addLocationToast, { delay: 4000 });
                toast.show();
            }
            
            if (updateLocationToast) {
                const toast = new bootstrap.Toast(updateLocationToast, { delay: 4000 });
                toast.show();
            }

            if (deleteErrorToast) {
                const toast = new bootstrap.Toast(deleteErrorToast, { delay: 6000 });
                toast.show();
            }

            const updateErrorToast = document.getElementById('updateErrorToast');
            if (updateErrorToast) {
                const toast = new bootstrap.Toast(updateErrorToast, { delay: 6000 });
                toast.show();
            }

            // Clear the URL parameters after showing the toasts to prevent re-display on refresh
            if (window.history.replaceState) {
                const url = new URL(window.location);
                const paramsToClear = ['councilUpdateSuccess', 'locationAddSuccess', 'locationUpdateSuccess', 'deleteError', 'updateError'];
                paramsToClear.forEach(param => url.searchParams.delete(param));
                window.history.replaceState({}, document.title, url.pathname + url.search);
            }
        });
    </script>

    <!--Page heading-->
    <section class="text-left py-5" style="background-color:#ACC8A2;">
        <h1><div class="container"> Edit council details</div></h1>
    </section>
    <!-- Main content -->
    <section class="text-left py-3">
        <div class="container">
            <!-- Table containing council details -->
            <form id="edit_council" name="edit_bus" action="include/updateCouncil.php" method="post" novalidate>
                <table class="table">
                    <!-- council name -->
                    <tr>
                        <td><label for="councilname">Council Name:</label></td>
                        <?php echo"<td><input type='text' id='councilname' name='councilname' required size='65%' value='" . $name . "'></td>";?>
                    </tr>

                    <!-- Contact email -->
                    <tr>
                        <td><label for="email">Contact:</label></td>
                        <?php echo"<td><input type='text' id='email' name='email' required size='65%' value='" . $email . "'></td>";?>
                    </tr>
                    <!-- council website -->
                    <tr>
                        <td><label for="website">Web site:</label></td>
                        <?php echo"<td><input type='text' id='website' name='website' required size='65%' value='" . $link . "'></td>";?>
                    </tr>

                    <!-- Submit or cancel-->
                    <tr>
                        <td><label for=""></label></td>
                        <td>
                            <table>
                                <tr>
                                    <td>
                                        <?php echo "<input type='hidden' name='councilIdPk' value='" . $council . "'>"; ?>
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
                </table>
            </form>
        </div>
    </section>
    <section class="text-left py-2" style="background-color:#ACC8A2;">
        <h1><div class="container"> Edit locations</div></h1>
    </section>
    <section class="text-left py-3">
        <div class="container">
            <form id="AddLoc" name="AddLoc" action="include/addLocation.php" method="post" novalidate>
                <table class="table">
                    <tr>
                        <td>
                            <label for="addLocation">Add a location:</label>
                            <input type="text" id="addLocation" name="addLocation" required size="40%">
                            <input class="btn btn-success btn-sm" type="submit" value="Add" name="Add">
                        </td>
                    </tr>
                </table>
                <?php 
                if ($role==4) {
                    echo "<input type='hidden' id='councilIdPk' name='councilIdPk' value = '" . $council . "'>";
                }
                ?>
            </form>
        </div>
        <div class="container">
            <table class="table" width=40%>
                <thead style='border-bottom-width: 3px; border-bottom-color: black'>
                    <tr>
                        <th style='display: none; '>ID</th>
                        <th style='display: none; '>Council</th> 
                        <th>Location</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    $stmt = $connection->prepare("SELECT * FROM location WHERE councilIdPk = ?");
                    $stmt->bind_param("i", $council);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>
                                    <td style='display: none; '>" . $row["locationIdPk"] . "</td>
                                    <td style='display: none; '>" . $row["councilIdPk"] . "</td>
                                    <td>" . $row["locationName"] . "</td>
                                    <td>
                                        <button type='button' class='btn btn-primary btn-sm' data-bs-toggle='modal' data-bs-target='#updaterModal' data-value='$row[locationIdPk]' data-value2='$row[locationName]'>Update</button>
                                        <a class='btn btn-danger btn-sm' href='include/deleteLocation.php?locationIdPk=$row[locationIdPk]&councilIdPk=$row[councilIdPk]'>Delete</a>
                                    </td>
                                </tr>";
                        }
                    } else {
                        echo "<tr><td>No locations added yet</td><tr>";
                    }

                ?>
                </tbody> 
            </table>
        </div>
    </section>
    <!--Modal dialog logic-->
    <div class="modal fade" id="updaterModal" tabindex="-1" aria-labelledby="updaterModalTitle" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updaterModalTitle">Update Location Name</h5>
                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="RenameLocation" name="RenameLocation" action="include/updateLocation.php" method="post" novalidate>
            <div class="modal-body">
                    <input type="text" id="locationName" name="locationName" required size="40%">
                    <input type='hidden' id='locationIdPk' name='locationIdPk'>
                    <input type='hidden' id='councilIdPk' name='councilIdPk' value=<?php echo "'". $council . "'" ?>>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <input class="btn btn-primary" type="submit" value="Update" name="Update">
            </div>
            </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const updaterModal = document.getElementById('updaterModal');
        updaterModal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget;
            document.getElementById('locationIdPk').value = button.getAttribute('data-value');
            document.getElementById('locationName').value = button.getAttribute('data-value2');
            FormValidation.clearError(document.getElementById('locationName'));
        });

        // Council form validation
        document.getElementById('edit_council').addEventListener('submit', function(e) {
            let isValid = true;
            if (!FormValidation.validateRequired(document.getElementById('councilname'), 'Council name is required.')) isValid = false;
            if (!FormValidation.validateEmail(document.getElementById('email'))) isValid = false;
            if (!FormValidation.validateUrl(document.getElementById('website'))) isValid = false;
            
            if (!isValid) e.preventDefault();
        });

        // Add location form validation
        document.getElementById('AddLoc').addEventListener('submit', function(e) {
            if (!FormValidation.validateMinLength(document.getElementById('addLocation'), 2, 'Location name must be at least 2 characters.')) {
                e.preventDefault();
            }
        });

        // Rename location modal validation
        document.getElementById('RenameLocation').addEventListener('submit', function(e) {
            if (!FormValidation.validateMinLength(document.getElementById('locationName'), 2, 'Location name must be at least 2 characters.')) {
                e.preventDefault();
            }
        });
    </script>
    <!-- Gets the footer from a central location -->
    <div id="footer"><?php include('templates/template_footer.php'); ?></div>
</body>

</html>