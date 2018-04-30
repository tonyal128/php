<?php

session_start();
    if(!$_SESSION['valid']) {
      header("location:login.php"); 
      die(); 
    }
    else{
        $conn = require("../models/connectionSkills.php");

        $name = "";
        $description = "";
        $presenter = "";
        $day = "";
        $time = "";
        $query = "";
        $rowCount = "";
        
        try{
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch(PDOException $e){
            echo "Connection failed: " . $e->getMessage();
        }
        $query = "SELECT event_name,event_description,event_presenter,event_day,event_time FROM wdv341_events";
        $stmt = $conn->prepare($query);
        $stmt->execute();
    }
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>WDV341 Intro PHP  - Display Events Example</title>
    <style>
		.eventBlock{
			width:500px;
			margin-left:auto;
			margin-right:auto;
			background-color:#CCC;	
		}
		
		.displayEvent{
			text_align:left;
			font-size:18px;	
		}
		
		.displayDescription {
			margin-left:100px;
		}
	</style>
</head>

<body>
    <h1>WDV341 Intro PHP</h1>
    <h2>Example Code - Display Events as formatted output blocks</h2>   
    <h3> <?php echo $stmt->rowCount(); ?> Events are available today.</h3>

<?php
	//Display each row as formatted output
	while( $result = $stmt->fetch() )		
	//Turn each row of the result into an associative array 
  	{
        $name = $result['event_name'] . "\t";
        $description = $result['event_description'] . "\t";
        $presenter = $result['event_presenter'] . "\t";
        $day = $result['event_day'] . "\t";
        $time = $result['event_time'] . "\n";
?>
	<p>
        <div class="eventBlock">	
            <div>
            	<span class="displayEvent">Event:<?php echo $name ?></span>
            	<span class="displayDescription">Description: <?php echo $description ?></span>
            </div>
            <div>
            	Presenter: <?php echo $presenter ?>
            </div>
            <div>
            	<span class="displayTime">Time: <?php echo $time ?></span>
            </div>
            <div>
            	<span class="displayDate">Date: <?php echo $day ?></span>
            </div>
        </div>
    </p>

<?php
      }//close while loop
    $query = null;
	$conn = null;	//Close the database connection	
?>
</div>	
</body>
</html>