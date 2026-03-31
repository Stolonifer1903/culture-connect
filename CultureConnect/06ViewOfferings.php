<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View products and services</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link href="css\style.css" rel="stylesheet">
</head>

<body style="margin: 100px;">
    <h1>Products and services for *Location*</h1>
    <br>
    <h2>Products</h2>
    <table class="table">
        <thead style="border-bottom-width: 3px; border-bottom-color: black">
            <tr>
                <th style="display:none">ID</th>
                <th>Type</th>
                <th>Name</th>
                <th>Description</th>
                <th>Details</th>
                <th>Cultural benefit</th>
                <th>Price</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <!-- TODO: UPDATE PHP -->
            <?php
            include 'include/config.php';
            // Retrieve location ID from URL safely, falling back to 1 if not provided
            $loc_id = isset($_GET['loc_id_pk']) ? intval($_GET['loc_id_pk']) : (isset($_GET['loc_id']) ? intval($_GET['loc_id']) : 1);
            $sql = "SELECT * FROM offering WHERE loc_id_pk = " . $loc_id;
            $result = $connection->query($sql);
            if (!$result) {
                die("Invalid query: " . $connection->error);
            }
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td style='display:none'>" . $row["loc_id_pk"] . "</td>
                        <td>" . $row["of_category"] . "</td>
                        <td>" . $row["of_name"] . "</td>
                        <td>" . $row["of_description"] . "</td>
                        <td>" . $row["of_details"] . "</td>
                        <td>" . $row["of_cultural_benefits"] . "</td>
                        <td>" . $row["of_price_range"] . "</td>
                        <td>
                            <a class='btn btn-success btn-sm' href='/cultureconnect/include/deleteLocation.php?loc_id_pk=" . $row["loc_id_pk"] . "'>Vote Yes</a>
                            <a class='btn btn-danger btn-sm' href='/cultureconnect/include/deleteLocation.php?loc_id_pk=" . $row["loc_id_pk"] . "'>Vote No</a>
                            <a class='btn btn-secondary btn-sm' href='/cultureconnect/include/deleteLocation.php?loc_id_pk=" . $row["loc_id_pk"] . "'>Clear Vote</a>
                        </td>
                    </tr>";
            }
            ?>
        </tbody>
    </table>
    <div class="modal fade" id="updaterModal" tabindex="-1" aria-labelledby="updaterModalTitle" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updaterModalTitle">Update Location Name</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <!-- TODO  -->
                <form id="RenameLocation" name="RenameLocation" action="include/updateLocation.php" method="post">
                    <div class="modal-body">
                        <input type="text" id="loc_name" name="loc_name" required size="40%">
                        <input type='hidden' id='loc_id_pk' name='loc_id_pk'>
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
            document.getElementById('loc_id_pk').value = button.getAttribute('data-value');
        });
    </script>
</body>

</html>