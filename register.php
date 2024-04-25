<?php
    include 'connection.php';

    if (isset($_POST['submit-btn'])) {
        $filter_name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
        $name = mysqli_real_escape_string($conn, $filter_name);

        $filter_email = filter_var($_POST['email'], FILTER_SANITIZE_STRING);
        $email = mysqli_real_escape_string($conn, $filter_email);

        $filter_password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);
        $password = password_hash($filter_password, PASSWORD_BCRYPT);

        $filter_cpassword = filter_var($_POST['cpassword'], FILTER_SANITIZE_STRING);
        $cpassword = mysqli_real_escape_string($conn, $filter_cpassword);

        $query = "SELECT * FROM 'users' WHERE 'email' =?";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($result)>0) {
            $message[] = 'user already exist';
        }
        else{
            if ($password != $cpassword) {
                $message[] = 'wrong password';
            }
            else{
                $query = "INSERT INTO 'users'('name', 'email', 'password') VALUES (?, ?, ?)";
                $stmt = mysqli_prepare($conn, $query);
                mysqli_stmt_bind_param($stmt, "sss", $name, $email, $password);
                mysqli_stmt_execute($stmt);
                $message[] = 'registered successfully';
                header('location:index.php');
                exit;
            }
        }
    }
?>