<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit products and services</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link href="css/offeringItemStyle.css" rel="stylesheet">
</head>
<body>
    <!--Session start-->
    <?php
        session_start();
        include ('include/getOfferingInfo.php');
        $role = $_SESSION['role'];
    ?>
    <!-- Gets the header from a central location -->
    <div id="header"><?php include('templates/template_navbar.php'); ?></div>

    <!-- Offering header -->
    <header class="profile-header py-4">
      <div class="container">
        <div
          class="d-flex flex-column flex-md-row align-items-center align-items-md-start gap-4">
            <!-- Avatar -->
            <div class="avatar-circle flex-shrink-0"></div>
            <!-- Info -->
            <div class="text-center text-md-start">
                <h1 class="fw-bold mb-1 text-white" id="vendor-name">
                <?php echo $of_name ?>
                </h1>
                <p class="text-white mb-3 opacity-75" id="vendor-tagline">
                <?php echo $of_description ?>
                </p>

            <!-- badges / details -->
            <div class="d-flex flex-wrap justify-content-center justify-content-md-start gap-3 mb-3">
              <span class="badge badge-category fs-6" id="vendor-category"><?php echo $of_int_name ?></span>
              <span class="meta-item text-white small">
                <i class="bi bi-geo-alt-fill me-1"></i>
                <span id="vendor-location"><?php echo $of_loc_name ?></span>
              </span>
            <span class="meta-item text-white small">
                <i class="bi bi-person-fill me-1"></i>
                <a href="#" id="business_name" class="text-white text-decoration-none">
                  <?php echo $of_bus_name ?>
                </a>
            </span>
            <span class="meta-item text-white small">
                <a class="btn btn-portfolio btn-sm px-3" id="vendor-portfolio" href="07ViewBusiness.php?businessIdPk=<?php echo $bus_id?>" target="_blank">
                <i class="bi bi-link-45deg me-1"></i> View Portfolio
                </a>
            </span>
          </div>
        </div>
      </div>
    </header>

    <div class="container my-1"><a href="javascript:history.back()" style="color: inherit;">Back to list<a></div>

    <!-- ===== ABOUT ===== -->
    <div class="container my-4">
      <h2 class="section-title mb-3">About</h2>
      <p class="text-muted" id="offering-details">
        <?php echo $of_details ?>
      </p>

        <h2 class="section-title mb-3">Details</h2>
        <div class="d-flex gap-3 flex-wrap align-items-stretch">
            <div style='height: 400px; width: 400px; overflow: hidden;'>
                <?php echo "<img src='images/offerings/" .$of_picture . "' class='object-fit-contain' style='height: 100%; width: 100%'>"?>
            </div>

            <div class="card cred-card h-100 border-0 shadow-sm p-3 d-flex flex-row align-items-start gap-3">
                <div class="d-flex flex-column gap-3 w-100">
                    <div class="p-3 rounded mb-3 benefits-box w-100 ">
                        <strong class="small text-uppercase text-muted"
                        >Description</strong
                        >
                        <p class="mb-0 mt-1 small" id="cultural-benefits"><strong class="text-muted">By:&nbsp&nbsp&nbsp&nbsp</strong><?php echo $of_bus_name ?></p>
                        <p class="mb-0 mt-1 small" id="cultural-benefits"><strong class="text-muted">Price:&nbsp&nbsp&nbsp&nbsp</strong><?php echo $of_price_range_description ?></p>
                        <p class="mb-0 mt-1 small" id="cultural-benefits"><strong class="text-muted">Location:&nbsp&nbsp&nbsp&nbsp</strong><?php echo $of_loc_name ?></p>
                    </div>
                    <div class="p-3 rounded mb-3 benefits-box">
                        <strong class="small text-uppercase text-muted"
                        >Cultural Benefits</strong
                        >
                        <p class="mb-0 mt-1 small" id="cultural-benefits"><?php echo $of_cultural_benefits ?></p>
                    </div>
                    <div class="p-3 rounded mb-3 benefits-box">
                        <strong class="small text-uppercase text-muted"
                        >Awards, Memberships and Exhibitions</strong
                        >
                        <p class="mb-0 mt-1 small" id="cultural-benefits"><?php echo $of_awards ?></p>
                    </div>
                </div>
            </div>
        </div>
        <div>
            <hr />
            <p class="text-center fw-semibold mb-3">
            Is this beneficial to the community?
            </p>

            <?php if ($role == 1): ?>
            <div class="d-flex justify-content-center gap-3 mb-3">
                <button class="btn btn-success px-4" onclick="setVote('yes')">
                    👍 Yes
                </button>
                <button class="btn btn-danger px-4" onclick="setVote('no')">
                    👎 No
                </button>
                <button class="btn btn-outline-secondary px-4" onclick="setVote('clear')">
                    ✖️ Remove vote
                </button>
            </div>
            <?php else: ?>
            <p class="text-muted text-center">You must be logged in as a resident to vote.  <a href="00Login.php">Login</a> or <a href="02RegisterUser.php">Register</a></p>
            <?php endif; ?>

            <div class="d-flex justify-content-center gap-4">
            <span class="text-success fw-semibold"
                >✅ <strong id="modal-yes"><?php echo $of_yes_votes ? $of_yes_votes : 0 ?></strong> Yes</span
            >
            <span class="text-danger fw-semibold"
                >❌ <strong id="modal-no"><?php echo $of_no_votes ? $of_no_votes : 0 ?></strong> No</span
            >
            </div>
        </div>
    </div>
    <form id="of_vote" name="of_vote" action="include/voteOffering.php" method="post">
        <input type="hidden" id="vote_type" name="vote_type" value="">
        <input type="hidden" id="of_id" name="of_id" value=<?php echo $_GET["offeringIdPk"] ?>>
    </form>
    <script>
        function setVote(input){
            document.getElementById('vote_type').value = input;
            document.getElementById('of_vote').submit();
        }
    </script>
    <!-- Gets the footer from a central location -->
    <div id="footer"><?php include('templates/template_footer.php'); ?></div>
</body>
</html>