<?php
    session_start();
    if(!$_SESSION['valid']) {
      header("location:login.php"); 
      die(); 
    }
    
    $dbError = "";
    $name = "";
    $description = "";
    $presenter = "";
    $date = "";
    $time = "";
    $validForm = true;
    $nameErr = "";
    $descriptionErr = "";
    $presenterErr = "";
    $dateErr = "";
    $timeErr = "";

    require("../models/connection.php");
    // Create connection
    if(isset($_POST["submit"])){
        try{
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            if(isset($_POST["event-name"])){
                $name = $_POST["event-name"];
                validateName($name);
            }
            if(isset($_POST["event-description"])){
                $description = $_POST["event-description"];
            }
            if(isset($_POST["event-presenter"])){
                $presenter = $_POST["event-presenter"];
                validatePresenter($presenter);
            }
            if(isset($_POST["event-date"])){
                $date = $_POST["event-date"];
                validateDate($date);
            }
            if(isset($_POST["event-time"])){
                $time = $_POST["event-time"];
                validateTime($time);
            }
        

            $sql = "INSERT INTO wdv341_event(event_name,event_description,event_presenter,event_date,event_time)
        VALUES('$name','$description','$presenter','$date','$time')";

            $validForm = true;
            validateDate($date);
            validateName($name);
            validatePresenter($presenter);
            validateTime($time);
            
            if($validForm){
               // $stmt = $conn->prepare($sql);
                $conn->exec($sql);
                $message = "Record successfully added";
            }
            else{
                $message = "Record add failed, please validate the information entered and try again";
            }
        }
        catch(PDOException $e)
        {
            echo "Connection failed: " . $e->getMessage();
        }
        $conn = null;
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


    $validForm = true;
    validateDate($date);
    validateName($name);
    validatePresenter($presenter);
    validateTime($time);

    if($validForm){
        $message = "Record Added!";
    }
    else{
        $message = "Something went wrong";
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Events Form</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" media="screen" href="../styles/main.css" />
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
        <script src="../scripts/main.js"></script>
    </head>
    <body>
        <!-- start of nav -->
        <nav class="navbar navbar-default">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php"><img src="../img/Home.png" id="logo"></a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li class="active"><a href="../views/wdv341.php">PHP<span class="sr-only">(current)</span></a></li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
        </nav>
        <!-- End of nav -->

        <?php
            if($validForm){
        ?>
            <h1><?php if(isset($message)){echo($message);} ?></h1>
        <?php }
            else{
        ?>
        <div id="container">
            <form action="eventsForm.php" method="post">
                <div class="form-group">
                    <label for="event-name">Event Name: </label>
                    <input type="text" class="form-control" id="event-name"  name="event-name" required="true" value="<?php echo $name ?>">
                    <span><?php $nameErr ?></span>
                </div>
                <div class="form-group">
                    <label for="event-description">Event Description: </label>
                    <input type="text" class="form-control" id="event-description" name="event-description" value="<?php echo $description ?>">
                </div>
                <div class="form-group">
                    <label for="event-presenter">Presenter Name: </label>
                    <input type="text" class="form-control col" id="event-presenter" name="event-presenter" required="true" value="<?php echo $presenter ?>">
                    <span><?php $presenterErr ?></span>
                </div>
                <div class="form-group">
                    <label for="event-date">Date of Event: </label>
                    <input type="date" class="form-control col" id="event-date" name="event-date" required="true" value="<?php echo $date ?>">
                    <span><?php $dateErr ?></span>
                </div>
                <div class="form-group">
                    <label for="event-time">Time of Event: </label>
                    <input type="time" class="form-control col" id="event-time" name="event-time" required="true" value="<?php echo $time ?>">
                    <span><?php $timeErr ?></span>
                    <input type="submit" name="submit" value="Submit" class="btn btn-submit">
                </div>
            </form>
        </div>
        <?php } ?>
    </body>
</html>