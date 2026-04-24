<?php
    include 'config.php';
    session_start();
    
    if (isset($_POST["current_password"]) && isset($_POST["new_password"]) && isset($_POST["confirm_password"])) {
        // Validate user is logged in
        if (!isset($_SESSION['user_id'])) {
            header('Location: ../02ManageUser.php?passwordError=' . urlencode('Session expired. Please log in again.'), TRUE, 303);
            exit;
        }
        
        $user_id = $_POST['user_id'];
        $current_password = $_POST["current_password"];
        $new_password = $_POST["new_password"];
        $confirm_password = $_POST["confirm_password"];
        
        // Get current password from database
        $stmt = $connection->prepare("SELECT userPassword FROM user WHERE userIdPk = ?");
        $stmt->bind_param("s", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        
        if (!$row) {
            header('Location: ../02ManageUser.php?passwordError=' . urlencode('User not found.'), TRUE, 303);
            exit;
        }
        
        $existing_password = $row["userPassword"];
        
        // Verify current password matches
        if ($current_password != $existing_password) {
            header('Location: ../02ManageUser.php?passwordError=' . urlencode('Current password is incorrect.'), TRUE, 303);
            exit;
        }
        
        // Validate new password matches confirm password
        if ($new_password != $confirm_password) {
            header('Location: ../02ManageUser.php?passwordError=' . urlencode('New passwords do not match.'), TRUE, 303);
            exit;
        }
        
        // Validate new password is not empty
        if (empty($new_password)) {
            header('Location: ../02ManageUser.php?passwordError=' . urlencode('New password cannot be empty.'), TRUE, 303);
            exit;
        }
        
        // Validate new password is different from current password
        if ($new_password == $existing_password) {
            header('Location: ../02ManageUser.php?passwordError=' . urlencode('New password must be different from current password.'), TRUE, 303);
            exit;
        }
        
        // Update password in database
        $stmt = $connection->prepare("UPDATE user SET userPassword = ? WHERE userIdPk = ?");
        $stmt->bind_param("ss", $new_password, $user_id);
        $stmt->execute();
        
        if ($stmt->affected_rows > 0) {
            // Redirect back to manage user page with success
            header('Location: ../02ManageUser.php?passwordChangeSuccess=true', TRUE, 303);
            exit;
        } else {
            header('Location: ../02ManageUser.php?passwordError=' . urlencode('Failed to update password.'), TRUE, 303);
            exit;
        }
    } else {
        header('Location: ../02ManageUser.php?passwordError=' . urlencode('Missing required fields.'), TRUE, 303);
        exit;
    }
?>
