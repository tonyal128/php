<html>
    <head>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <link rel="stylesheet" href="main.css" type="text/css">
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
                <a class="navbar-brand" href="index.php"><img src="Home.png" id="logo"></a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li class="active"><a href="wdv341.php">PHP<span class="sr-only">(current)</span></a></li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>
        <?php
            function formatDate()
            {
                $dateInput = date('m/d/Y',strtotime($_POST["date"]));
                echo($dateInput);
            }
            function internationalDate()
            {
                $dateInput = date('m/d/Y',strtotime($_POST["date"]));
                echo($dateInput);
            }
            function getLength()
            {
                $stringInput = $_POST["contentString"];
                echo strlen($stringInput);
            }
            function trimString()
            {
                $stringInput = $_POST["contentString"];
                ltrim($stringInput);
                rtrim($stringInput);
                echo($stringInput);
            }
            function toLower()
            {
                $stringInput = $_POST["contentString"];
                echo(strtolower($stringInput));
            }
            function searchString()
            {
                $containsDMACC = 'false';
                $stringInput = strtolower($_POST["contentString"]);
                $comparisonString = "dmacc";
                if(strpos($stringInput,$comparisonString) >= 0)
                {
                    $containsDMACC = 'true';
                }
                echo($containsDMACC);
            }
            function formatNumber()
            {
                $numberInput = $_POST["formatNumber"];
                $numberInput = number_format($numberInput);
                echo($numberInput);
            }
            function toCurrency()
            {
                $currencyInput = number_format($_POST["currency"],2);
                echo("$".$currencyInput);
            }
        ?>
        <form action="form.php" method="post">
            <div class="form-group">
                <label for="date">Date: </label>
                <input type="date" class="form-control" id="date"  name="date" >
            </div>
            <div class="form-group">
                <label for="contentString">Enter String: </label>
                <input type="text" class="form-control" id="contentString" name="contentString">
            </div>
            <div class="form-group">
                <label for="contentString">Enter number to be formatted: </label>
                <input type="number" class="form-control col" id="formatNumber" name="formatNumber">
            </div>
            <div class="form-group">
                <label for="contentString">Enter number to be converted to currency: </label>
                <input type="number" class="form-control col" id="currency" name="currency">
                <input type="submit" name="submit" value="Submit" class="btn btn-submit">
            </div>
            <div class="form-group">
                <p>Date: </p>
                <?php
                    if(isset($_POST["date"]))
                    {
                        formatDate();
                    }
                ?>
            </div>
            <div class="form-group">
                <p>International Date: </p>
                <?php
                    if(isset($_POST["date"]))
                    {
                        internationalDate();
                    }
                ?>
            </div>
            <div class="form-group">
                <p>Length of string: </p>
                <?php
                    if(isset($_POST["contentString"]))
                    {
                        getLength();
                    }
                ?>
            </div>
            <div class="form-group">
                <p>Trimmed string: </p>
                <?php
                    if(isset($_POST["contentString"]))
                    {
                        trimString();
                    }
                ?>
            </div>
            <div class="form-group">
                <p>Lowercase string: </p>
                <?php
                    if(isset($_POST["contentString"]))
                    {
                        toLower();
                    }
                ?>
            </div>
            <div class="form-group">
                <p>Contains DMACC?</p>
                <?php
                    if(isset($_POST["contentString"]))
                    {
                        searchString();
                    }
                ?>
            </div>
            <div class="form-group">
                <p>Formatted Number</p>
                <?php
                    if(isset($_POST["formatNumber"]))
                    {
                        formatNumber();
                    }
                ?>
            </div>
            <div class="form-group">
                <p>Currency Number</p>
                <?php
                    if(isset($_POST["currency"]))
                    {
                        toCurrency();
                    }
                ?>
            </div>
        </form>
    </body>
</html>