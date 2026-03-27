 <!-- NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-custom">
    <div class="container">
        <a class="navbar-brand" href="00Home.php">CULTURE CONNECT</a>
        <?php
            //session_start();
            //var_dump($_SESSION);
            if (isset($_SESSION['name'])) {
            echo "<span class='navbar-text me-auto'>Welcome " . $_SESSION['name'] . "</span>";
            } else {
               echo "<span class='navbar-text me-auto'>Not logged in </span>"; 
            }
        ?>
        <div>
        <a id="home" class="nav-link d-inline" href="00Home.php">Home</a>
        <a id="edit_profile" class="nav-link d-inline" href="02RegisterUser.php">Edit profile</a>
        <a id="edit_busines" class="nav-link d-inline" href="03EditBusiness.php">Edit business</a>
        <a id="manage_offerings"class="nav-link d-inline" href="04ManageOfferings.php">Manage offerings</a>
        <a id="log_out" class="nav-link d-inline" href="include/logout.php">Log out</a>
        </div>
    </div>
</nav>
