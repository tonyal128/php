<?php
    $servername = "**********.*********.us-east-2.rds.amazonaws.com";
    $username = "admin";
    $password = "********";

    // Create connection
    $conn = new mysqli($servername, $username, $password);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } 
    echo "Connected successfully";
?>