<?php
    include 'config.php';
    if (isset($_POST["register"])) {

        // --- Collect base user fields ---
        $user_type       = $_POST["user_type"] ?? '';
        $user_firstname  = $_POST["firstname"] ?? '';
        $user_lastname   = $_POST["lastname"] ?? '';
        $user_title      = $_POST["title_select"] ?? '';
        $user_email      = $_POST["email"] ?? '';
        $user_pwd        = $_POST["password"] ?? '';

        // Helper: redirect back to the registration page with an error message
        function redirectWithError(string $msg, string $page = '../02RegisterUser.php'): void {
            $type = $_POST["user_type"] ?? '';
            $registerAs = match($type) {
                '2' => 'business',
                '3' => 'council',
                default => 'resident',
            };
            header('Location: ' . $page . '?register_as=' . $registerAs . '&error=' . urlencode($msg), TRUE, 303);
            exit;
        }

        // --- Pre-validation: role-specific required fields ---
        if ($user_type == '2') {  // Business
            $bus_name     = trim($_POST["bus_name"] ?? '');
            $user_council = trim($_POST["council_select"] ?? '');
            if ($bus_name === '') {
                redirectWithError('Please enter a Business Name.');
            }
            if ($user_council === '') {
                redirectWithError('Please select a Council.');
            }
        } elseif ($user_type == '3') {  // Council rep
            $user_council = trim($_POST["council_select"] ?? '');
            if ($user_council === '') {
                redirectWithError('Please select a Council.');
            }
        }

        // --- Begin transaction ---
        $connection->begin_transaction();

        try {
            // Check if email already exists
            $check = $connection->prepare("SELECT userIdPk FROM user WHERE userEmail = ?");
            $check->bind_param("s", $user_email);
            $check->execute();
            $check->store_result();

            if ($check->num_rows > 0) {
                $connection->rollback();
                redirectWithError('An account with that email address already exists.');
            }

            // Insert base user row
            $stmt1 = $connection->prepare("INSERT INTO user(userEmail, userFirstName, userLastName, userTitle, userPassword, userRole, roleId) VALUES (?, ?, ?, ?, ?, ?, -1)");
            $stmt1->bind_param("sssssi", $user_email, $user_firstname, $user_lastname, $user_title, $user_pwd, $user_type);
            $stmt1->execute();

            if ($stmt1->affected_rows <= 0) {
                throw new Exception("Failed to create user account.");
            }

            $last_id = $connection->insert_id;

            // --- Role-specific inserts ---
            if ($user_type == '1') {  // Resident

                $res_gender   = $_POST["gender_select"] ?? '';
                $res_yob      = $_POST["yob"] ?? '';
                $res_location = $_POST["location_select"] ?? '';

                // Look up location id
                $stmt = $connection->prepare("SELECT locationIdPk FROM location WHERE locationName = ?");
                $stmt->bind_param("s", $res_location);
                $stmt->execute();
                $result = $stmt->get_result();
                $row = $result->fetch_assoc();
                $location_id = $row["locationIdPk"] ?? null;

                if (!$location_id) {
                    throw new Exception("Selected location was not found. Please try again.");
                }

                // Insert resident row
                $stmt2 = $connection->prepare("INSERT INTO resident(userIdPk, locationIdPk, residentBirthYear, residentGender) VALUES (?, ?, ?, ?)");
                $stmt2->bind_param("ssss", $last_id, $location_id, $res_yob, $res_gender);
                $stmt2->execute();
                $res_id = $connection->insert_id;

                // Update roleId on user
                $stmt2 = $connection->prepare("UPDATE user SET roleId = ? WHERE userIdPk = ?");
                $stmt2->bind_param("ii", $res_id, $last_id);
                $stmt2->execute();

                // Insert interests
                $interestareas = $_POST["servicesandproducts"] ?? [];
                foreach ($interestareas as $interestarea) {
                    $stmt = $connection->prepare("SELECT interestAreaIdPk FROM interestarea WHERE interestAreaName = ?");
                    $stmt->bind_param("s", $interestarea);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    $row = $result->fetch_assoc();
                    $int_id = $row["interestAreaIdPk"] ?? null;

                    if ($int_id) {
                        $stmt = $connection->prepare("INSERT INTO residentinterests(residentIdPk, interestAreaIdPk) VALUES (?, ?)");
                        $stmt->bind_param("ii", $res_id, $int_id);
                        $stmt->execute();
                    }
                }

            } elseif ($user_type == '2') {  // Business

                // Resolve council id
                $stmtC = $connection->prepare("SELECT councilIdPk FROM council WHERE councilName = ?");
                $stmtC->bind_param("s", $user_council);
                $stmtC->execute();
                $resultC = $stmtC->get_result();
                $rowC = $resultC->fetch_assoc();
                if (!$rowC) {
                    throw new Exception("The selected council was not found. Please try again.");
                }
                $council_id = $rowC["councilIdPk"];

                // Check if business name already exists
                $check = $connection->prepare("SELECT businessIdPk FROM business WHERE businessName = ?");
                $check->bind_param("s", $bus_name);
                $check->execute();
                $check->store_result();

                if ($check->num_rows > 0) {
                    // Business already exists – fetch its id
                    $check->bind_result($bus_id);
                    $check->fetch();
                } else {
                    // Insert new business
                    $stmt3 = $connection->prepare("INSERT INTO business(businessName, councilIdPk) VALUES (?, ?)");
                    $stmt3->bind_param("si", $bus_name, $council_id);
                    $stmt3->execute();
                    $bus_id = $connection->insert_id;
                }

                // Update roleId on user
                $stmt2 = $connection->prepare("UPDATE user SET roleId = ? WHERE userIdPk = ?");
                $stmt2->bind_param("ii", $bus_id, $last_id);
                $stmt2->execute();

            } elseif ($user_type == '3') {  // Council representative

                // Resolve council id
                $stmtC = $connection->prepare("SELECT councilIdPk FROM council WHERE councilName = ?");
                $stmtC->bind_param("s", $user_council);
                $stmtC->execute();
                $resultC = $stmtC->get_result();
                $rowC = $resultC->fetch_assoc();
                if (!$rowC) {
                    throw new Exception("The selected council was not found. Please try again.");
                }
                $council_id = $rowC["councilIdPk"];

                // Update roleId on user
                $stmt2 = $connection->prepare("UPDATE user SET roleId = ? WHERE userIdPk = ?");
                $stmt2->bind_param("ii", $council_id, $last_id);
                $stmt2->execute();
            }

            // All queries succeeded — commit the transaction
            $connection->commit();

        } catch (Exception $e) {
            $connection->rollback();
            redirectWithError('Registration failed: ' . $e->getMessage());
        }

        // --- Post-registration: log in and redirect ---
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        include 'login.php';

        if (!isset($_SESSION['role']) || $_SESSION['role'] != 4) {
            header('Location: ../00Home.php', TRUE, 303);
        } else {
            header('Location: ../97ManageUsersAdmin.php', TRUE, 303);
        }
        exit;
    }
?>