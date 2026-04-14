<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Locations</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link href="css/style.css" rel="stylesheet">
</head>
<body>
    <?php
        session_start();
        include ('include/config.php')
    ?>
    <!-- Gets the header from a central location -->
    <!-- <div id="header"><?php //include('templates/template_navbar.php'); ?></div> -->
    <!-- Main content -->
    <!-- Get header based on council or admin. Show error page if other user type navigated there by accident-->
     <?php
        include ('include/config.php');
        $user_role = $_SESSION['role'];
        $role_id = $_SESSION['role_id'];
        $text = '';
        
        if ($user_role == '3') {
            $sql = "SELECT councilName FROM council WHERE councilIdPk = $role_id";
            $result = $connection->query($sql);
            if (!$result) {
                throw new Exception("Invalid query: ". $connection->error);
            }
            $row = $result->fetch_assoc();
            $text = $row['councilName'];
        } else if ($user_role == '4') {
            $text = 'Admin';
        } else {
        // Throw an exception which will be caught by config.php
        throw new Exception("Unauthorized access attempt - Invalid role: " . $user_role);
    }
        echo "<section class = 'text-left py-5' style='background-color:#ACC8A2;'><h1 style='margin-left: 150px;'>Locations - " . $text . "</h1></section>" 
    ?>
     
    <section class = "text-left py-5"style="margin-left: 150px;" > 
        <div id="locations">
            <br>
            <!-- Add location -->    
            <form id="AddLoc" name="AddLoc" action="include/addLocation.php" method="post">
                <table class="table">
                    <tr>
                        <td>
                            <label for="addLocation">Add a location:</label>
                            <input type="text" id="addLocation" name="addLocation" required size="40%">
                            <input class="btn btn-success btn-sm" type="submit" value="Add" name="Add">
                        </td>
                    </tr>
                </table>
            </form>
            <br>
            <!-- Display and edit locations -->  
            <table class = "table" style="width: 60%;">
                    <?php
                        include 'include/config.php';
                        $role_id = $_SESSION['role_id'];
                        $user_role = $_SESSION['role'];
                        if ($user_role == 3) {
                            $sql = "SELECT * FROM location WHERE councilIdPk = $role_id";
                            $council_header = "<th style='display: none; '>Council</th>";
                        } else if ($user_role == 4) {
                            $sql = "SELECT locationIdPk, councilName, locationName FROM location l, council c WHERE c.councilIdPk = l.councilIdPk";
                            $council_header = "<th>Council</th>";
                        } 
                        
                        echo    "<thead style='border-bottom-width: 3px; border-bottom-color: black'>
                                    <tr>
                                        <th style='display: none; '>ID</th>" 
                                        . $council_header . 
                                        "<th>Location</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>";

                        $result = $connection->query($sql);
                        if (!$result) {
                            throw new Exception("Invalid query: ". $connection->error);
                        }
                        while($row = $result->fetch_assoc()){
                            if ($user_role == 3) {$council_display ="<td style='display: none; '>" . $row["councilIdPk"] . "</td>";} else {$council_display ="<td>" . $row["councilName"] . "</td>";}
                            echo    "<tr>
                                        <td style='display: none; '>" . $row["locationIdPk"] . "</td>"
                                        . $council_display . 
                                        "<td>" . $row["locationName"] . "</td>
                                        <td>
                                            <button type='button' class='btn btn-primary btn-sm' data-bs-toggle='modal' data-bs-target='#updaterModal' data-value='$row[locationIdPk]'>Update</button>
                                            <a class='btn btn-danger btn-sm' href='include/deleteLocation.php?locationIdPk=$row[locationIdPk]'>Delete</a>
                                        </td>
                                    </tr>
                                </tbody> ";
                        }  
                    ?> 
                  
            </table>
        </div>
    </section>
    <div class="modal fade" id="updaterModal" tabindex="-1" aria-labelledby="updaterModalTitle" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="updaterModalTitle">Update Location Name</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form id="RenameLocation" name="RenameLocation" action="include/updateLocation.php" method="post">
      <div class="modal-body">
            <input type="text" id="locationName" name="locationName" required size="40%">
            <input type='hidden' id='locationIdPk' name='locationIdPk'>
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
        });
    </script>
    <!-- Gets the footer from a central location -->
    <!-- <div id="footer"><?//php include('templates/template_footer.php'); ?></div> -->
</body>
</html>