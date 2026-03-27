<?php
    session_start();
    include 'config.php';
    if(isset($_POST['login'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];

        //get user info from the database
        $stmt = $connection->prepare("SELECT * FROM user WHERE user_email = ? AND user_password = ?");
        $stmt->bind_param("ss", $email, $password);
        $stmt->execute();
        $result = $stmt->get_result();
        if($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $_SESSION['user_id'] = $row["user_id_pk"];
            $_SESSION['role'] = $row["user_role"];
            $_SESSION['name'] = $row["user_first_name"];
        } else {
            $_SESSION['error'] = "Username or password error";
        }
        header("Location: ../00Home.php");

    }
    var_dump($_POST, $_SESSION);
?>