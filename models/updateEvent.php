<?php
    session_start();
    if(!$_SESSION['valid']) {
      header("location:login.php"); 
      die(); 
    }
    $eventId = $_GET["eventID"];
    $conn = require("connectionSkills.php");//connects to the database
    
    try{
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch(PDOException $e){
        echo "Connection failed: " . $e->getMessage();
    }

    $name = "";
    $description = "";
    $date = "";
    $time = "";
    $presenter = "";
    

    function getData(){
        global $conn, $name,$presenter,$description,$date,$time,$eventId;
        $eventId = $_GET["eventID"];
        try{
            $stmt = $conn->prepare("SELECT event_name, event_description, event_date, event_time, event_presenter FROM wdv341_event WHERE event_id = :id");
            $stmt->bindParam(':id', $eventId, PDO::PARAM_INT);
            $stmt->execute();
        }
        catch(PDOException $e){
            echo $e->getMessage();
        }

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            echo "<tr>";
                $presenter = $row['event_presenter'];
                $name = $row['event_name'];	
                $description = $row['event_description'];
                $date = $row['event_date'];
                $time = $row['event_time'];
	    }
    }

    function validateName($name){
        global $nameErr, $validForm;

        if($name == null){
            $nameErr = "The event name cannot be empty";
            $validForm = false;
        }
    }
    function validatePresenter($presenter){
        global $presenterErr, $validForm;

        if($presenter == null){
            $presenterErr = "Presenter is a required field";
            $validForm = false;
        }
    }
    function validateDate($date){
        global $dateErr, $validForm;
        $format = 'Y-m-d';

        $d = DateTime::createFromFormat($format, $date);
        if($d && $d->format($format) != $date){
            $dateErr .= "Invalid Date Format ";
            $validForm = false;
        }
        
        if($date == null){
            $dateErr .= "Date cannot be empty ";
            $validForm = false;
        }
    }
    function validateTime($time){
        global $timeErr, $validForm;
        if(!strtotime($time)) {
            $timeErr .= "Invalid Time ";
            $validForm = false;
        }

        if($time == null){
            $timeErr .= "Time cannot be empty ";
            $validForm = false;
        }
    }
    getData();
    validateDate($date);
    validateName($name);
    validatePresenter($presenter);
    validateTime($time);

    if(isset($_POST['submit'])){
        if(isset($_POST["event-name"])){
            global $name;
            $name = $_POST["event-name"];
            validateName($name);
        }
        if(isset($_POST["event-description"])){
            global $description;
            $description2 = $_POST["event-description"];
        }
        if(isset($_POST["event-presenter"])){
            global $presenter;
            $presenter = $_POST["event-presenter"];
            validatePresenter($presenter);
        }
        if(isset($_POST["event-date"])){
            global $date;
            $date = $_POST["event-date"];
            validateDate($date);
        }
        if(isset($_POST["event-time"])){
            global $time;
            $time2 = $_POST["event-time"];
            validateTime($time);
        }
        try{
            $stmt = $conn->prepare("UPDATE wdv341_event SET event_name = :eventName, event_description = :eventdesc, event_presenter = :presenter, event_date = :dt, event_time = :eventtime WHERE event_id = :id");
            $stmt->bindParam(':id', $eventId, PDO::PARAM_INT);
            $stmt->bindParam(':eventName', $name, PDO::PARAM_STR);
            $stmt->bindParam(':eventdesc', $description2, PDO::PARAM_STR);
            $stmt->bindParam(':presenter', $presenter, PDO::PARAM_STR);
            $stmt->bindParam(':dt', $date, PDO::PARAM_STR);
            $stmt->bindParam(':eventtime', $time2, PDO::PARAM_STR);
            $stmt->execute();
            header('Location: ../views/selectAll.php?message=Successfully Updated id '. $eventId); 
        }
        catch(PDOException $e){
            echo $e->getMessage();
        }
    }

    
    
    function updateEvent(){
        global $conn, $eventId, $name, $description, $presenter, $date, $time;
        $eventId = $_GET["eventID"];
        
    }
?>

<html>
    <head>
        <meta charset="utf-8" />
        <title>Update</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" media="screen" href="../styles/main.css" />
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
        <script src="../scripts/main.js"></script>
    </head>
    <body>
        <form action="updateEvent.php" method="post">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" id="name" value="<?php echo $name ?>" name="name" />
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <input type="text" id="description" value="<?php echo $description ?>" name="description" />
            </div>
            <div class="form-group">
                <label for="presenter">Presenter</label>
                <input type="text" id="presenter" value="<?php echo $presenter ?>" name="presenter" />
            </div>
            <div class="form-group">
                <label for="date">Date</label>
                <input type="date" id="date" value="<?php echo $date ?>" name="date" />
            </div>
            <div class="form-group">
                <label for="time">Time</label>
                <input type="time" id="time" value="<?php echo $time ?>" name="time" />
                <input type="submit" name="submit" value="Submit" class="btn btn-submit">
            </div>
        </form>
    </body>
</html>
