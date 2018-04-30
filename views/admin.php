<?php 
    session_start();
    if(!$_SESSION['valid']) {
      header("location:login.php"); 
      die(); 
    }
    else{
?>

<!DOCTYPE html>
<html>
    <head>
            <meta charset="utf-8" />
            <title>Login</title>
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <link rel="stylesheet" type="text/css" media="screen" href="../styles/main.css" />
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
            <script src="../scripts/main.js"></script>
    </head>
    <body>
        <h2>Admin Page </h2>

        <a href="eventsForm.php">Add Event </a>
        <br />
        <a href="selectAll.php">Update/Delete Event</a>
        <br />
        <a href="../models/logout.php">Logout </a>
    </body>
    <?php } ?>
</html>