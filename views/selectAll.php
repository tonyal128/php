<?php
	
    $conn = require("../models/connectionSkills.php");		//connects to the database
    
    try{
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch(PDOException $e){
        echo "Connection failed: " . $e->getMessage();
    }

	$stmt = $conn->prepare("SELECT event_id,event_name,event_description FROM wdv341_event");
	$stmt->execute();
?>
<table border='1'>
	<tr>
		<td>ID</td>
		<td>Name</td>
		<td>Description</td>
<?php 
    if($stmt->rowCount() == 0){
        echo "No rows returned";
    }

	while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
	{
		echo "<tr>";
			echo "<td>" . $row['event_id'] . "</td>";
			echo "<td>" . $row['event_name'] . "</td>";	
			echo "<td>" . $row['event_description'] . "</td>";
			echo "<td><a href='updateEvent.php?eventID=" . $row['event_id'] . "'>Update</a></td>"; 
			echo "<td><a href='../models/deleteEvent.php?eventID=" . $row['event_id'] . "'>Delete</a></td>"; 		
		echo "</tr>";
	}

	if(isset($_GET['message'])){
		echo $_GET['message'];
	}
?>
</table>