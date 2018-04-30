<?php

    $name = "";
    $ssn = "";
    $selection = "";
    $validForm = true;
    $nameErrMsg = "";
    $ssnErrMsg = "";
    $selectionErrMsg = "";
    $validForm = false;

    function validateName($name){
        global $validForm, $nameErrMsg;
        
        if($name == ""){
                $nameErrMsg = "Name cannot be empty";
                $validForm = false;
        }
    }

    function validateSSN($ssn){
        global $validForm, $ssnErrMsg;
        
        if($ssn == ""){
                $ssnErrMsg = "Social security number cannot be empty";
                $validForm = false;
        }
    }

    function validateSelection($selection){
        global $validForm, $selectionErrMsg;
        
        if($selection == ""){
            $selectionErrMsg = "You must select a contact preference.";
            $validForm = false;
        }
    }

    if(isset($_POST["submit"]))
    {
        if(isset($_POST["inName"])){
            $name = $_POST["inName"];
        }
        else {
            echo('Name cannot be blank');
        }
        
        if(isset($_POST["ssn"])){
            $ssn = $_POST["ssn"];
        }
        else {
            echo('Social security number cannot be blank');
        }
        
        if(isset($_POST["selection"])){
            $selection = $_POST["selection"];
        }
        else {
            echo('Selection cannot be blank');
        }

        $validForm = true;
        validateName($name);
        validateSSN($ssn);
        validateSelection($selection);
        
        if($validForm){
            $message = "All good! . <br /> name: $name <br /> ssn: $ssn <br /> selection: $selection";
        }
        else{
            $message = "Something went wrong";
        }
    }
?>



<!DOCTYPE html>
<html >
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>WDV341 Intro PHP - Form Validation Example</title>
<style>

#orderArea	{
	width:600px;
	background-color:#CF9;
}

.error	{
	color:red;
	font-style:italic;	
}
</style>
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
                    <li class="active"><a href="wdv341.php">PHP<span class="sr-only">(current)</span></a></li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>
<h1>WDV341 Intro PHP</h1>
    
<?php
    if($validForm){
?>
    <h1><?php if(isset($message)){echo($message);} ?></h1>
<?php }
    else{
?>
<h2>Form Validation Assignment

</h2>
<div id="orderArea">
  <form id="frmValid" name="selfPost" method="post" action="formValidationAssignment.php">
  <h3>Customer Registration Form</h3>
  <table width="587" border="0">
    <tr>
      <td width="117">Name:</td>
      <td width="246"><input type="text" name="inName" id="tbName" size="40" value=""/></td>
      <td width="210" class="error"><?php echo($nameErrMsg); ?></td>
    </tr>
    <tr>
      <td>Social Security</td>
      <td><input type="text" name="ssn" id="tbSocial" size="40" value="" /></td>
      <td class="error"><?php echo($ssnErrMsg); ?></td>
    </tr>
    <tr>
      <td>Choose a Response</td>
      <td><p>
        <label>
          <input type="radio" name="selection" id="rbPhone" value="phone">
          Phone</label>
        <br>
        <label>
          <input type="radio" name="selection" id="rbEmail" value="email">
          Email</label>
        <br>
        <label>
          <input type="radio" name="selection" id="rbMail" value="mail">
          US Mail</label>
        <br>
      </p></td>
      <td class="error"><?php echo($selectionErrMsg); ?></td>
    </tr>
  </table>
  <p>
    <input type="submit" name="submit" id="button" value="Register" />
    <input type="reset" name="reset" id="btnReset" value="Clear Form" />
  </p>
</form>
    <?php } ?>
</div>

</body>
</html>