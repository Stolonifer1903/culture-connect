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
    <!-- Gets the header from a central location -->
    <div id="header"><?php include('templates\template_navbar.php'); ?></div>
    <!-- Main content -->
    <section class = "text-left py-5" style="background-color:#ACC8A2;"><h1 style="margin-left: 150px;">Locations</h1></section>
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
            <table class = "table" style="width: 97%;">
                <thead style="border-bottom-width: 3px; border-bottom-color: black">
                    <tr>
                        <th style="display: none; ">ID</th> <!-- TODO: Hide column -->
                        <th>Council</th>
                        <th>Location</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        include 'include/config.php';
                        $sql = "SELECT * FROM location";
                        $result = $connection->query($sql);
                        if (!$result) {
                            die("Invalid query: ". $connection->error);
                        }
                        while($row = $result->fetch_assoc()){
                            echo "<tr>
                                <td style='display: none; '>" . $row["loc_id_pk"] . "</td>
                                <td>" . $row["counc_id_pk"] . "</td>
                                <td>" . $row["loc_name"] . "</td>
                                <td>
                                    <button type='button' class='btn btn-primary btn-sm' data-bs-toggle='modal' data-bs-target='#updaterModal' data-value='$row[loc_id_pk]'>Update</button>
                                    <a class='btn btn-danger btn-sm' href='/cultureconnect/include/deleteLocation.php?loc_id_pk=$row[loc_id_pk]'>Delete</a>
                                </td>
                            </tr>";
                        }  
                    ?> 
                </tbody>   
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
    <script> 
            $(function(){
            $("navbar").load("templates/template_navbar.html"); 
            $("#included_footer").load("template/footer.html"); 
            });
    </script> 
    <!-- Gets the footer from a central location -->
    <div id="footer"><?php include('templates\template_footer.php'); ?></div>
</body>
</html>