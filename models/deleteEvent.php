<?php
    $conn = require("connectionSkills.php");		//connects to the database
    
    try{
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch(PDOException $e){
        echo "Connection failed: " . $e->getMessage();
    }


    $eventId = $_GET["eventID"];
    deleteEvent();

    function deleteEvent(){
        global $conn, $eventId;
        try{
            $stmt = $conn->prepare("DELETE FROM wdv341_event WHERE event_id = :id");
            $stmt->bindParam(':id', $eventId, PDO::PARAM_INT);
            $stmt->execute();
            header('Location: ../views/selectAll.php?message=Successfully deleted id '. $eventId);
        }
        catch(PDOException $e){
            echo $e->getMessage();
        }
    }
?>