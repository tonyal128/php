<?php

class update{
    private $_sku = '';
    private $_name = '';
    private  $_flavor = '';
    private $_quantity = '';

    public function __construct(){ //default constructor
        $this->sku = '';
        $this->name = '';
        $this->flavor = '';
        $this->quantity = '';
    }

    public function setSku($_sku){
        $this->sku = $_sku;
    }

    public function setName($_name){
        $this->name = $_name;
    }

    public function setFlavor($_flavor){
        $this->flavor = $_flavor;
    }

    public function setQuantity($_quantity){
        $this->quantity = $_quantity;
    }

    public function getSku(){
        return $this->sku;
    }

    public function getName(){
        return $this->name;
    }

    public function getFlavor(){
        return $this->flavor;
    }

    public function getQuantity(){
        return $this->quantity;
    }
}


    $update = new update();
   
    session_start();
    if(!$_SESSION['valid']) {
      header("location:login.php"); 
      die(); 
    }

    $dbError = "";
    $name = "";
    $quantity = "";
    $flavor = "";
    $validForm = true;
    $nameErr = "";
    $quantityErr = "";
    $flavorErr = "";

    require("../models/connection.php");
    // Create connection
    if(isset($_POST["submit"])){
        try{
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            if(isset($_POST["drink-name"])){
                $update->setName($_POST["drink-name"]);
                validateName($update->getName());
            }
            if(isset($_POST["quantity"])){
                $update->setQuantity($_POST["quantity"]);
                validateQuantity($update->getQuantity());
            }
            if(isset($_POST["flavor"])){
                $update->setFlavor($_POST["flavor"]);
                validateFlavor($update->getFlavor());
            }
            if(isset($_POST["sku"])){
                $update->setSku($_POST["sku"]);
            }
            
            $name = $update->getName();
            $quantity = $update->getQuantity();
            $flavor = $update->getFlavor();
            $sku = $update->getSku();

            $stmt = $conn->prepare("UPDATE drinks SET 
            drink_name = :name, 
            quantity = :quantity, 
            flavor = :flavor 
            WHERE sku = :sku");

            $stmt->execute(array(
            ":name" => $name,
            ":quantity" => $quantity,
            ":flavor" => $flavor,
            ":sku" => $sku));


            $validForm = true;
            validateQuantity($quantity);
            validateName($name);
            validateFlavor($flavor);
            
            if($validForm){
                $message = "Record successfully updated".$sku;
            }
            else{
                $message = "Record update failed, please validate the information entered and try again";
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
            $nameErr = "The drink name cannot be empty";
            $validForm = false;
        }
    }
    function validateQuantity($quantity){
        global $quantityErr, $validForm;

        if($quantity == null){
            $quantityErr = "Quantity is a required field";
            $validForm = false;
        }
        if($quantity < 0){
            $quantityErr = "Quantity cannot be negative";
            $validForm = false;
        }
    }
    function validateFlavor($flavor){
        global $flavorErr, $validForm;
       
        if($flavor == null){
            $flavorErr .= "Every drink has a flavor!";
            $validForm = false;
        }
    }

    $validForm = true;
    validateName($name);
    validateFlavor($flavor);
    validateQuantity($quantity);

    if($validForm){
        header('Location: display.php');
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
                    <li class="active"><a href="final.php">PHP<span class="sr-only">(current)</span></a></li>
                    <li><a href="contact.php">Contact</a></li>
                    <li><a href="../models/logout.php">Logout<span class="sr-only">(current)</span></a></li>
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
            <h1 class="success"><?php if(isset($message)){echo($message);} ?></h1>
        <?php }
            else{
        ?>
        <div id="container">
            <form action="insert.php" method="post">
                <div class="form-group">
                    <label for="drink-name">Drink Name: </label>
                    <input type="text" class="form-control" id="drink-name"  name="drink-name" required="true" value="<?php echo $name ?>">
                    <span><?php $nameErr ?></span>
                </div>
                <div class="form-group">
                    <label for="flavor">Drink Flavor:  </label>
                    <input type="text" class="form-control" id="flavor" name="flavor" value="<?php echo $flavor ?>">
                    <span class = "danger"><?php $flavorErr ?></span>
                </div>
                <div class="form-group">
                    <label for="quantity">Quantity: </label>
                    <input type="number" class="form-control col" id="quantity" name="quantity" required="true" value="<?php echo $quantity ?>">
                    <span><?php $quantityErr ?></span>
                    <input type="number" disabled="true" value="<?php echo $_GET['sku'] ?>" display="none">
                    <input type="submit" name="submit" value="Submit" class="btn btn-submit">
                </div>
            </form>
        </div>
        <?php } ?>
    </body>
</html>