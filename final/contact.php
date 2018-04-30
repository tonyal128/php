<?php 
    require('../views/email.php');

    $to = 'anthony.r.larson@gmail.com';

    if(isset($_POST['submit'])){
        $contactEmail = new email();

        if(isset($_POST["email"])){
            $contactEmail->setSender($_POST["email"]);
        }

        if(isset($_POST["subject"])){
            $contactEmail->setSubject($_POST["subject"]);
        }

        if(isset($_POST["message"])){
            $contactEmail->setMessage($_POST["message"]);
        }

        $contactEmail->setSendTo($to);

        $contactEmail->sendEmail();
    }

    function sendConfirmation(){
        $confirmation = new email();

        if(isset($_POST["email"])){
            $contactEmail->setSender($to);
        }

        if(isset($_POST["subject"])){
            $contactEmail->setSubject($_POST["subject"]);
        }

        if(isset($_POST["message"])){
            $contactEmail->setMessage($_POST["message"]);
        }

        $contactEmail->setSendTo($_POST["email"]);

        $contactEmail->sendEmail();
    }
?>

<!DOCTYPE html>
<html>
    <head>
            <meta charset="utf-8" />
            <title>Contact Us</title>
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
                    <li><a href="final.php">PHP</a></li>
                    <li class="active"><a href="contact.php">Contact<span class="sr-only">(current)</span></a></li>
                    <li><a href="login.php">Login</a></li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
        </nav>
        <!-- End of nav -->
        <form method="post" action="contact.php">
        <div class="form-group">
            <label for="tbEmail">Email Address</label>
            <input type="email" class="form-control" id="tbEmail"placeholder="Enter Email" required="true" name="email" autocomplete="off">
        </div>
        <div class="form-group">
            <label for="tbSubject">Subject</label>
            <input type="text" class="form-control" id="tbSubject"placeholder="Enter Subject" required="true" name="subject" autocomplete="off">
        </div>
        <div class="form-group">
            <label for="tbMessage">Enter Message Here</label>
            <textarea class="form-control" id="tbMessage" placeholder="Send us a message!" required="true" name="message" rows="5"></textarea>
        </div>
        <button type="submit" class="btn btn-primary" name="submit" id="btnSubmit">Submit</button>
        </form>
    </body>
</html>