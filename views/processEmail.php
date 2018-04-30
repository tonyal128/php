<html>
    <head>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <link rel="stylesheet" href="../styles/main.css" type="text/css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    </head>
    
    <body>
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
                <a class="navbar-brand" href="../index.php"><img src="../img/Home.png" id="logo"></a>
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
        
        <form action="email.php" method="post">
            <div class="form-group">
                    <label for="from">From: </label>
                    <input type="text" class="form-control" id="from"  name="from" >
                </div>
                <div class="form-group">
                    <label for="to">To: </label>
                    <input type="text" class="form-control" id="to" name="to">
                </div>
                <div class="form-group">
                    <label for="subject">Subject: </label>
                    <input type="text" class="form-control col" id="subject" name="subject">
                </div>
                <div class="form-group">
                    <label for="message">Message: </label>
                    <input type="text" class="form-control col" id="message" name="message">
                    <input type="submit" name="submit" value="Submit" class="btn btn-submit">
                </div>
            </form>
    </body>
</html>