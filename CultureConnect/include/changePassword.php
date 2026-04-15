<?php
    include 'config.php';
    session_start();
    
    if (isset($_POST["current_password"]) && isset($_POST["new_password"]) && isset($_POST["confirm_password"])) {
        // Validate user is logged in
        if (!isset($_SESSION['user_id'])) {
            throw new Exception("User not logged in - cannot change password");
        }
        
        $user_id = $POST['user_id'];
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
            throw new Exception("User not found in database");
        }
        
        $existing_password = $row["userPassword"];
        
        // Verify current password matches
        if ($current_password != $existing_password) {
            throw new Exception("Current password is incorrect");
        }
        
        // Validate new password matches confirm password
        if ($new_password != $confirm_password) {
            throw new Exception("New passwords do not match");
        }
        
        // Validate new password is not empty
        if (empty($new_password)) {
            throw new Exception("New password cannot be empty");
        }
        
        // Validate new password is different from current password
        if ($new_password == $existing_password) {
            throw new Exception("New password must be different from current password");
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
            throw new Exception("Failed to update password in database");
        }
    } else {
        throw new Exception("Missing required fields for password change");
    }
?>
