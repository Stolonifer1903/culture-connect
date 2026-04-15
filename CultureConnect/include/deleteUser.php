<?php
    include 'config.php';
    if (isset($_GET["uId"])){
        $user_id = $_GET['uId'];
        $role_id = $_GET['rId'];
        $role = $_GET['role'];
        if ($role == 1) {
            $stmt = $connection->prepare("DELETE FROM vote WHERE residentIdPk = ?");
            $stmt->bind_param("i", $role_id);
            if (!$stmt->execute()) {
                throw new Exception("Error deleting user ID: $user_id - " . $stmt->error);
            }
            $stmt = $connection->prepare("DELETE FROM residentinterests WHERE residentIdPk = ?");
            $stmt->bind_param("i", $role_id);
            if (!$stmt->execute()) {
                throw new Exception("Error deleting user ID: $user_id - " . $stmt->error);
            }
            $stmt = $connection->prepare("DELETE FROM resident WHERE residentIdPk = ?");
            $stmt->bind_param("i", $role_id);
            if (!$stmt->execute()) {
                throw new Exception("Error deleting user ID: $user_id - " . $stmt->error);
            }
        } 

        $stmt = $connection->prepare("DELETE FROM user WHERE userIdPk = ?");
        $stmt->bind_param("i", $user_id);
        
        if ($stmt->execute()) {
            header("Location: ../97ManageUsersAdmin.php");
            exit;
        } else {
            throw new Exception("Error deleting user ID: $user_id - " . $stmt->error);
        }
    } else {
        throw new Exception("Error - userIdPk not provided for deletion");
    }
?>