<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View business</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link href="css/offeringItemStyle.css" rel="stylesheet">
</head>
<body>
    <!--Session start-->
    <?php
        session_start();
        include ('include/config.php');
        //include ('include/getBusinessInfo.php');
        $role = $_SESSION['role'] ? $_SESSION['role'] : -1;
        //getBusinessInfo
        $stmt = $connection->prepare("SELECT * FROM business WHERE businessIdPk = ?");
        $stmt->bind_param("i", $_GET['businessIdPk']);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $bus_name = $row["businessName"];
            $bus_bio = $row["businessDescription"] ;
            $bus_email = $row["businessEmail"] ;
            $bus_phone = $row["businessPhone"] ;
            $bus_link = $row["businessLink"] ;
            $counc_id = $row["councilIdPk"] ;
            //get council name based on council id
            $stmt = $connection->prepare("SELECT councilName FROM council WHERE councilIdPk = ?");
            $stmt->bind_param("i", $counc_id);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result) {
                $row = $result->fetch_assoc();
                $counc_name = $row["councilName"];
            }
        } else {
            throw new Exception("Error - " . $stmt->error);
        }
    ?>
    <!-- Gets the header from a central location -->
    <div id="header"><?php include('templates/template_navbar.php'); ?></div>

    <!-- ===== PROFILE HEADER ===== -->
    <header class="profile-header py-5">
      <div class="container">
        <div
          class="d-flex flex-column flex-md-row align-items-center align-items-md-start gap-4"
        >
          <!-- Avatar -->
          <div class="avatar-circle flex-shrink-0"></div>

          <!-- Info -->
          <div class="text-center text-md-start">
            <h1 class="fw-bold mb-1 text-white" id="vendor-name">
              <?php echo $bus_name ?>
            </h1>
            <!-- <p class="text-white mb-3 opacity-75" id="vendor-tagline">
              <?php echo $bus_bio ?>
            </p> -->

            <!-- Meta badges / details -->
            <div
              class="d-flex flex-wrap justify-content-center justify-content-md-start gap-3 mb-3"
            >
              <span class="meta-item text-white small">
                <i class="bi bi-geo-alt-fill me-1"></i>
                <span id="vendor-location"><?php echo $counc_name ?></span>
              </span>

              <span class="meta-item text-white small">
                <i class="bi bi-envelope-fill me-1"></i>
                <a
                  href="mailto:hello@adunola.art"
                  id="vendor-email"
                  class="text-white text-decoration-none"
                >
                  <?php echo $bus_email ?>
                </a>
              </span>

              <span class="meta-item text-white small">
                <i class="bi bi-telephone-fill me-1"></i>
                <span id="vendor-phone"><?php echo $bus_phone ?></span>
              </span>
            </div>

            <a
              class="btn btn-portfolio btn-sm px-3"
              id="vendor-portfolio"
              href="https://<?php echo $bus_link ?>"
              target="_blank"
            >
              <i class="bi bi-link-45deg me-1"></i> View Website
            </a>
          </div>
        </div>
      </div>
    </header>
    
    <div class="container my-1"><a href="javascript:history.back()" style="color: inherit;">Back to list<a></div>

    <!-- ===== ABOUT ===== -->
    <div class="container my-5">
      <h2 class="section-title mb-3">About</h2>
      <p class="text-muted" id="vendor-about">
        <?php echo $bus_bio ?>
      </p>
    </div>

        <!-- ===== PRODUCTS & SERVICES ===== -->
    <div class="container my-5">
      <h2 class="section-title mb-3">Products &amp; Services</h2>
        <div class="row g-1 mb-4" id="product-grid">
            <?php
            include 'include/getFilteredBusinessOfferings.php';
            ?>
        </div>
    </div>

    <!-- Gets the footer from a central location -->
    <div id="footer"><?php include('templates/template_footer.php'); ?></div>
</body>
</html>