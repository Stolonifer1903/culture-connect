 <!-- NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-custom">
    <?php
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        include ('include/config.php')
    ?>
    <div class="container">
        <a class="navbar-brand" href="00Home.php">CULTURE CONNECT</a>
        <?php
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }
            if (isset($_SESSION['role'])) {
            echo "<span class='navbar-text me-auto'>Welcome " . $_SESSION['name'] . "</span>";
            } 
        ?>
        <div>
            <?php
                if (isset($_SESSION['role'])) {
                    if ($_SESSION['role'] == 1) {
                        echo "  <a id='home' class='nav-link d-inline' href='00Home.php'>Home</a>
                                <a id='edit_profile' class='nav-link d-inline' href='02ManageUser.php'>Edit profile</a>
                                <a id='log_out' class='nav-link d-inline' href='include/logout.php'>Log out</a>";
                    } else if ($_SESSION['role'] == 2) {
                        echo "  <a id='home' class='nav-link d-inline' href='00Home.php'>Home</a>
                                <a id='edit_profile' class='nav-link d-inline' href='02ManageUser.php'>Edit profile</a>
                                <a id='edit_busines' class='nav-link d-inline' href='03EditBusiness.php'>Edit business details</a>
                                <a id='manage_offerings'class='nav-link d-inline' href='04ManageOfferings.php'>Manage offerings</a>
                                <a id='log_out' class='nav-link d-inline' href='include/logout.php'>Log out</a>";
                    } else if ($_SESSION['role'] == 3) {
                        echo "  <a id='home' class='nav-link d-inline' href='00Home.php'>Home</a>
                                <a id='edit_profile' class='nav-link d-inline' href='02ManageUser.php'>Edit profile</a>
                                <a id='edit_busines' class='nav-link d-inline' href='03EditCouncil.php'>Edit council details</a>
                                <a id='manage_offerings'class='nav-link d-inline' href='#'>Manage offerings</a>
                                <a id='log_out' class='nav-link d-inline' href='include/logout.php'>Log out</a>";
                    } else if ($_SESSION['role'] == 4) {
                        echo "  <a id='home' class='nav-link d-inline' href='00Home.php'>Home</a>
                                <a id='edit_profile' class='nav-link d-inline' href='02ManageUser.php'>Edit profile</a>
                                <a id='edit_users' class='nav-link d-inline' href='97ManageUsersAdmin.php'>Manage users</a>
                                <a id='edit_busines' class='nav-link d-inline' href='97ManageBusinessAdmin.php'>Manage businesses</a>
                                <a id='edit_councils' class='nav-link d-inline' href='97ManageCouncilAdmin.php'>Manage locations</a>
                                <a id='manage_offerings'class='nav-link d-inline' href='97ManageOfferingsAdmin.php'>Manage offerings</a>
                                <a id='log_out' class='nav-link d-inline' href='include/logout.php'>Log out</a>";

                    } else {
                    echo "  <a id='home' class='nav-link d-inline' href='00Home.php'>Home</a>" ;
                    echo "<a id='log_out' class='nav-link d-inline' href='include/logout.php'>Log out</a>";
                    }
                } else {
                    echo "  <a id='home' class='nav-link d-inline' href='00Home.php'>Home</a>" ;
                    echo "<span class='nav-link d-inline'><a id='log_in' class='btn btn-custom' style='color:white' href='00Login.php'>Log in</a></span>"; 
                }
            ?>
        </div>
    </div>
</nav>
