<?php
    $conn = mysqli_connect('localhost', 'username', 'password', 'shop_db');

    if (!$conn) {
        die("connection failed: " . mysqli_connect_error());
    }
?>