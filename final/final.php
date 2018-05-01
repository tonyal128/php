<?php
    $conn = require("../models/connection.php");

    $name = "";
    $flavor = "";
    $quantity = "";
    $query = "";
    $rowCount = "";
    $sku = "";
    
    try{
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch(PDOException $e){
        echo "Connection failed: " . $e->getMessage();
    }
    $query = "SELECT sku, drink_name, flavor, quantity FROM drinks";
    $stmt = $conn->prepare($query);
    $stmt->execute();
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Display Drinks</title>
    <title>Login</title>
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
                <a class="navbar-brand" href="../index.php"><img src="../img/Home.png" id="logo"></a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li><a href="contact.php">Contact</a></li>
                    <li><a href="login.php">Login<span class="sr-only">(current)</span></a></li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
        </nav>
        <!-- End of nav -->
    <h1>Inventory</h1> 
    <h3> <?php echo $stmt->rowCount(); ?> Different Drinks in Inventory.</h3>
    <table class="table table-bordered">
    <thead>
            <tr>
            <th scope="col">#</th>
            <th scope="col">Drink Name</th>
            <th scope="col">Drink Flavor</th>
            <th scope="col">Quantity</th>
            </tr>
        </thead>
<?php
	//Display each row as formatted output
	while( $result = $stmt->fetch() )		
	//Turn each row of the result into an associative array 
  	{
        $sku = $result['sku'] . "\t";
        $name = $result['drink_name'] . "\t";
        $flavor = $result['flavor'] . "\t";
        $quantity = $result['quantity'] . "\n";
?>

        
        <tbody>
            <tr>
            <th scope="row"><?php echo $sku ?></th>
            <td><?php echo $name ?></td>
            <td><?php echo $flavor ?></td>
            <td><?php echo $quantity ?></td>
            </tr>
        </tbody>
        
<?php
      }//close while loop
    $query = null;
    $conn = null;	//Close the database connection	
?>
</table>
</div>	
</body>
</html>