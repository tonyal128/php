<?php
    $servername = "larsonwebdev-rds.c2vxuhoxx2io.us-east-2.rds.amazonaws.com";
    $dbname = "wdv341";
    $username = "appUser";
    $password = "Empire19";

    // Create connection
    try{
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch(PDOException $e)
        {
            echo "Connection failed: " . $e->getMessage();
        }
    $conn = null;
?>