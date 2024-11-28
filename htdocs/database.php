<?php
    $servername = "127.0.0.1";
    $username = "mariadb";
    $password = "mariadb";
    $dbname = "mariadb";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        error_log("Connection failed: " . $conn->connect_error);
            die("Failed to Connect LMAO");
    }
    else {
        //echo "Connection Established";
    }
?>