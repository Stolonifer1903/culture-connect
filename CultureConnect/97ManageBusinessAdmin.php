<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Businesses - Admin Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <!--Session start-->
    <?php
    session_start();
    include('include/config.php');
    requireAdminRole();
        ?>
    <!-- Gets the header from a central location -->
    <div id="header"><?php include('templates/template_navbar.php'); ?></div>

    <!-- Toast Container -->
    <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
        <?php
            if (isset($_GET['deleteError']) && $_GET['deleteError'] == 'hasDependencies') {
                echo '<div class="toast align-items-center text-bg-danger border-0" role="alert" aria-live="assertive" aria-atomic="true" id="deleteErrorToast">
                        <div class="d-flex">
                            <div class="toast-body">
                                ⚠ Cannot delete: This business has associated offerings or other data.
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
            const deleteErrorToast = document.getElementById('deleteErrorToast');
            if (deleteErrorToast) {
                const toast = new bootstrap.Toast(deleteErrorToast, { delay: 6000 });
                toast.show();

                // Clear the URL parameter after showing the toast to prevent re-display on refresh
                if (window.history.replaceState) {
                    const url = new URL(window.location);
                    url.searchParams.delete('deleteError');
                    window.history.replaceState({}, document.title, url.pathname + url.search);
                }
            }
        });
    </script>
    <!--Page heading-->
    <section class="text-left py-5" style="background-color:#ACC8A2;">
        <h1>
            <div class="container"> Businesses - Admin Page
        </h1>
        </div>
    </section>
    <!-- Main content -->
    <section class="text-left py-3">
        <div style="margin-left: 100px; margin-right: 30px;">
            <!-- Add a new product or service -->
            <form id="addoffering" name="addoffering" action="03EditBusiness.php" method="post"
                style="margin-left:200px">
                <label for="addOffering"></label>
                <input type="hidden" value="yes" id="create-new" name="create-new">
                <input class="btn btn-success btn-sm" type="submit" value="Add a new business"
                    name="addBusiness">
            </form>
            <br>
            <table class="table" width=80%>
                <thead style="border-bottom-width: 3px; border-bottom-color: white;">
                    <tr>
                    <th>ID</th>
                    <th>Business name</th>
                    <th width=25%>Business description</th>
                    <th>Business email</th>
                    <th>Business phone</th>
                    <th>Business link</th>
                    <th>Council ID</th>
                    <th>Offerings</th>
                    <th>Actions</th>
                    </tr>
                </thead>
                <tbody style="color: white; background-color: #527558;">
                    <!-- TODO: UPDATE PHP -->
                    <?php
                    include 'include/config.php';
                    $sql = "SELECT b.*, COUNT(o.offeringIdPk) AS offerings FROM business b LEFT JOIN offering o ON b.businessIdPk=o.businessIdPK GROUP BY businessIdPk";
                    $result = $connection->query($sql);
                    if (!$result) {
                        throw new Exception("Invalid query: " . $connection->error);
                    }
                    while ($row = $result->fetch_assoc()) {
                        echo 
                        "<tr>
                            <td>" . $row["businessIdPk"] . "</td>
                            <td>" . $row["businessName"] . "</td>
                            <td>" . $row["businessDescription"] . "</td>
                            <td>" . $row["businessEmail"] . "</td>
                            <td>" . $row["businessPhone"] . "</td>
                            <td>" . $row["businessLink"] . "</td>
                            <td>" . $row["councilIdPk"] . "</td>
                            <td>" . $row["offerings"] . "</td>
                            <td>
                                <a class='btn btn-primary btn-sm' href='03EditBusiness.php?businessIdPk=$row[businessIdPk]'>Update</a>
                                <a class='btn btn-danger btn-sm' href='include/deleteBusiness.php?businessIdPk=$row[businessIdPk]'>Delete</a>
                            </td>
                        </tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Gets the footer from a central location -->
    <div id="footer"><?php include('templates/template_footer.php'); ?></div>
</body>

</html>