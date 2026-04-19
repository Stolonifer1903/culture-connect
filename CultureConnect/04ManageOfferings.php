<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My business products and services</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <!--Session start-->
    <?php
    session_start();
    include('include/config.php');
    if (isset($_SESSION['role'])){
        $role = $_SESSION['role'];
        if ($role == 2 && isset($_SESSION['role_id'])){
        $business = $_SESSION['role_id'];
        $sql2 = " WHERE businessName = (SELECT businessName FROM business WHERE businessIdPk = " .$business. ")" ;
        } else if ($role == 4) {
        $sql2 = "";
        } else {
             throw new Exception("Access not authorised");
        }
    }
        ?>
    <!-- Gets the header from a central location -->
    <div id="header"><?php include('templates/template_navbar.php'); ?></div>
    <!--Page heading-->
    <section class="text-left py-5" style="background-color:#ACC8A2;">
        <h1>
            <div class="container"> Product and service details
        </h1>
        </div>
    </section>
    <!-- Main content -->
    <section class="text-left py-3">
        <div style="margin-left: 10px; margin-right: 10px;">
            <!-- Add a new product or service -->
            <form id="addoffering" name="addoffering" action="05EditOffering.php" method="post"
                style="margin-left:150px">
                <label for="addOffering"></label>
                <input class="btn btn-success btn-sm" type="submit" value="Add a new product or service"
                    name="addoffering">
            </form>
            <br>
            <table class="table">
                <thead style="border-bottom-width: 3px; border-bottom-color: white;">
                    <tr>
                        <th style=" display:none">ID</th>
                    <th>Business name</th>
                    <th>Name</th>
                    <th>Interest area</th>
                    <th>Location</th>
                    <th width=15%>Description</th>
                    <th width=15%>Details</th>
                    <th width=15%>Cultural benefit</th>
                    <th>Awards</th>
                    <th>Price range</th>
                    <th>Thumbnail</th>
                    <th width=10%>Actions</th>
                    </tr>
                </thead>
                <tbody style="color: white; background-color: #527558;">
                    <!-- TODO: UPDATE PHP -->
                    <?php
                    $sql = "SELECT * FROM view_offerings" . $sql2;
                    $result = $connection->query($sql);
                    if (!$result) {
                        throw new Exception("Invalid query: " . $connection->error);
                    }
                    while ($row = $result->fetch_assoc()) {
                        $picture = ($row['offeringImage']) ? $row['offeringImage'] : 'placeholder.jpg';
                        echo 
                        "<tr>
                            <td style='display: none; '>" . $row["offeringIdPk"] . "</td>
                            <td>" . $row["businessName"] . "</td>
                            <td>" . $row["offeringName"] . "</td>
                            <td>" . $row["interestAreaName"] . "</td>
                            <td>" . $row["locationName"] . "</td>
                            <td>" . $row["offeringDescription"] . "</td>
                            <td>" . $row["offeringDetails"] . "</td>
                            <td>" . $row["offeringCulturalBenefits"] . "</td>
                            <td>" . $row["offeringAwards"] . "</td>
                            <td>" . $row["offeringPriceRangeDescription"] . "</td>
                            <td>
                                <div style='height: 50px; overflow: hidden;'>
                                    <img src='images/offerings/" .$picture. "' class='object-fit-contain border rounded' style='height: 100%; width: 100%'>
                                </div>
                            </td>
                            <td>
                                <a class='btn btn-primary btn-sm' href='05EditOffering.php?offeringIdPk=$row[offeringIdPk]'>Update</a>
                                <a class='btn btn-danger btn-sm' href='include/deleteOffering.php?offeringIdPk=$row[offeringIdPk]'>Delete</a>
                            </td>
                        </tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </section>
    <!-- Success Modal -->
    <div class="modal fade" id="offeringSuccessModal" tabindex="-1" aria-labelledby="offeringSuccessModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title" id="offeringSuccessModalLabel">Success</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    ✓ Offering updated successfully!
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Error Modal -->
    <div class="modal fade" id="offeringErrorModal" tabindex="-1" aria-labelledby="offeringErrorModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="offeringErrorModalLabel">Error</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="offeringErrorMessage">
                    <!-- Error message injected here -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const urlParams = new URLSearchParams(window.location.search);
             if (urlParams.has('offeringUpdateSuccess')) {
                const modalEl = document.getElementById('offeringSuccessModal');
                const successModal = new bootstrap.Modal(modalEl);
                successModal.show();
            }
            
            if (urlParams.has('error')) {
                const modalEl = document.getElementById('offeringErrorModal');
                document.getElementById('offeringErrorMessage').innerText = '⚠ ' + urlParams.get('error');
                const errorModal = new bootstrap.Modal(modalEl);
                errorModal.show();
            }

            // Clean up the URL
            if (urlParams.has('offeringUpdateSuccess') || urlParams.has('error')) {
                const newUrl = window.location.pathname;
                window.history.replaceState({}, document.title, newUrl);
            }
        });
    </script>
    
    <!-- Gets the footer from a central location -->
    <div id="footer"><?php include('templates/template_footer.php'); ?></div>
</body>

</html>