<?php
    include 'connection.php';
    session_start();

    if (isset($_POST['submit-btn'])) {

        //$password=trim(filter_input(INPUT_POST,'password'));
        //$email=trim(filter_input(INPUT_POST,'email'));

        //echo $email;
       
        $filter_email = filter_var($_POST['email'], FILTER_SANITIZE_STRING);
        $email = mysqli_real_escape_string($conn, $filter_email);

        $filter_password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);
        $password = mysqli_real_escape_string($conn, $filter_password);

        $query = "SELECT * FROM users WHERE email =?";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($result)>0) {
            $row = mysqli_fetch_assoc($result);
            if (password_verify($password, $row['password'])) {
                if ($row['user_type']== 'admin') {
                    $_SESSION['admin_name'] = $row['name'];
                    $_SESSION['admin_email'] = $row['email'];
                    $_SESSION['admin_id'] = $row['id'];
                    header('location:admin_pannel.php');
                    exit;
                }
                elseif ($row['user_type']== 'user') {
                    $_SESSION['user_name'] = $row['name'];
                    $_SESSION['user_email'] = $row['email'];
                    $_SESSION['user_id'] = $row['id'];
                    header('location:index.php');
                    exit;
                }
                else {
                    $message[] = 'incorrect email or password';
                }
            }
            else {
                $message[] = 'incorrect email or password';
            }
        }
        else {
            $message[] = 'incorrect email or password';
        }
    }
?>