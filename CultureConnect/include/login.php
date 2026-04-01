<?php
    session_start();
    include 'config.php';
    if(isset($_POST['login']) or isset($_POST["register"])) {
        $email = $_POST['email'];
        $password = $_POST['password'];

        //get user info from the database
        $stmt = $connection->prepare("SELECT * FROM user WHERE userEmail = ? AND userPassword = ?");
        $stmt->bind_param("ss", $email, $password);
        $stmt->execute();
        $result = $stmt->get_result();
        if($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $_SESSION['user_id'] = $row["userIdPk"];
            $_SESSION['role'] = $row["userRole"];
            $_SESSION['name'] = $row["userFirstName"];
            $_SESSION['role_id'] = $row["roleId"];
            header("Location: ../00Home.php");
        } else {
            $_SESSION['error'] = "Username or password error";
            header("Location: ../00Login.php");
        }

    }
?>