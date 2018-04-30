<?php
    session_start();
    if(!$_SESSION['valid']) {
      header("location:login.php"); 
      die(); 
    }
    
    $conn = require("../models/connection.php");		//connects to the database
    
    try{
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch(PDOException $e){
        echo "Connection failed: " . $e->getMessage();
    }


    $sku = $_GET["sku"];
    delete();

    function delete(){
        global $conn, $sku;
        try{
            $stmt = $conn->prepare("DELETE FROM drinks WHERE sku = :sku");
            $stmt->bindParam(':sku', $sku, PDO::PARAM_INT);
            $stmt->execute();
            $_SESSION['deletedSku'] = $sku;
            header('Location: display.php');
        }
        catch(PDOException $e){
            echo $e->getMessage();
        }
    }
?>