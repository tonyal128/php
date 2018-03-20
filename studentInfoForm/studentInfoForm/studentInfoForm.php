<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <title>DMACC Portfolio Day Bio Form</title>
  <meta name="author" content="">
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link href="css/normalize.css" rel="stylesheet">
  <link href="css/style.css" rel="stylesheet">
  
  <!-- css3-mediaqueries.js for IE less than 9 -->

<script src="css3-mediaqueries.js"></script>
<script src="jquery-3.2.1.js"></script>
<script>

	$(document).ready(function(){
		if( $("select[name=program]	option:selected").val() == "webDevelopment")
		{
			$(".secondWeb").css("display", "inline");
		}
		else
		{
			$(".secondWeb").css("display", "none");
		}
		
		$("select#program").change(function(){
			if( $("select#program option:checked").val() == "webDevelopment")
			{
				$(".secondWeb").css("display", "inline");
			}
			else
			{
				$(".secondWeb").css("display", "none");
			}
		});
		
		function resetForm(){
			$("#firstName").val("");
			$("#lastName").val("");
			$("#program").val("default");
			$("#websiteAddress").val("");
			$("#websiteAddress2").val("");
			$("#email").val("");
			$("#hometown").val("");
			$("#careerGoals").val("");
			$("#threeWords").val("");
		}
	});
	
	
	</script>
  
  <style>
	img{
		display: block;
		margin: 0 auto;
	}
	.frame{
		background-image: url("orange popsicle.jpg");
		padding: 1em;	
	}
	.frame2{
		background-image: url("citrus.jpg");
		padding: 1.3em;	
	}	
	body{
		background-image: url("bodacious.png");
		margin: 1.5em;
	}
	
	.main {
		padding: 1em;
		background-color: white;
	}
	form{
		text-align: center;
	}
	h2 {
		text-align: center;
	}
	.robotic{
		display: none;
	}

	.form {
		background-color:white;
		padding-left: 5em;
	}
	p {
		align:left;
	}	
	.citrus{
		margin: auto;
		background-image: url("raspberry.jpg");
		padding: 1.3em;	
		width: 70%;
	}
	.bamboo{
		background-image: url("bamboo.jpg");
		padding: 1em;	
	}	
	.violet{
		background-image: url("ultra violet.png");
		padding: .5em;	
	}	
	.secondWeb{
		display: none;
	}
	table{
		margin: auto;
	}
	table td{
		padding-bottom: .75em;
	}
	.error{
		font-style: italic;
		color: #d42a58;
		font-weight: bold;
	}

@media only screen and (max-width:620px) {
  /* For mobile phones: */
  img {
    width:100%;
  }
  .form {
	width:100%; 
	padding-left: .1em;
	padding-top: .1em;
  }
  .citrus {
	background-image:none;  
  }
  .bamboo {
	background-image:none;  
  } 
  .violet {
	background-image:none;  
  }  
  .secondWeb{
		display: none;
	}  
  table{
		margin: auto;
	}
  table td{
		padding-bottom: .5em;
	}
}
	
  </style>
  
  
  <?php
        $firstName = "";
        $lastName = "";
        $program = "";
        $websiteAddress = "";
        $websiteAddress2 = "";
        $linkedIn = "";
        $hometown = "";
        $careerGoals = "";
        $threeWords = "";
        $email = "";
        $firstNameErr = "";
        $lastNameErr = "";
        $programErr = "";
        $websiteAddressErr = "";
        $websiteAddressErr2 = "";
        $linkedinErr = "";
        $emailErr = "";
        $hometownErr = "";
        $careerGoalsErr = "";
        $threewordsErr = "";
		$honeyPot = "";
        $validForm = false;
    
        function validateFirstName($firstName){
            global $validForm, $firstNameErr;
            if(!strlen($firstName) > 0){
                $validForm = false;
                $firstNameErr .= "First name cannot be blank. ";
            }
            if(!preg_match('^[a-zA-Z0-9]^',$firstName)){
                $validForm = false;
                $firstNameErr .="First name must only consist of letters and numbers. ";
            }
        }
    
        function validateLastName($lastName){
            global $validForm, $lastNameErr;
            
            if(!strlen($lastName) > 0){
                $validForm = false;
                $lastNameErr .= "Last name cannot be blank";
            }
            if(!preg_match('^[a-zA-Z0-9]^',$lastName)){
                $validForm = false;
                $lastNameErr .= "Last name must only consist of letters and numbers.";
            }
        }
    
        function validateProgram($program){
            global $validForm, $programErr;
            
            if($program == ""){
                $programErr = "You must select a program.";
                $validForm = false;
            }
        }
    
        function validateWebsiteAddress($websiteAddress){
            global $validForm, $websiteAddressErr;
            
            if(!preg_match("@^(http\:\/\/|https\:\/\/)?([a-z0-9][a-z0-9\-]*\.)+[a-z0-9][a-z0-9\-]*$@i", $websiteAddress)){
                $validForm = false;
                $websiteAddressErr = "Invalid Website Address!";
            }
        }
    
        function validateWebsiteAddress2($websiteAddress2){
            global $validForm, $websiteAddressErr2;
            
            if(!filter_var($websiteAddress2, FILTER_VALIDATE_URL)){
                $validForm = false;
                $websiteAddressErr2 = "Invalid Website Address!";
            }
        }
        
        function validateLinkedIn($linkedin){
            global $validForm, $linkedinErr;
            
            if(!strlen(strstr($linkedin, "linkedin.com/")) > 0){
                $validForm = false;
                $linkedinErr = "Invalid LinkedIn Address";
            }
        }
        
        function validateEmail($email){
            global $validForm, $emailErr;
            
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $validForm = false;
                $emailErr = "Invalid Email Address.";
            }
        }
    
        function validateHometown($hometown){
            global $validForm, $hometownErr;
            
            if(!strlen($hometown) > 0){
                $validForm = false;
                $hometownErr .= "Last name cannot be blank";
            }
            
            if(!preg_match('^[a-zA-Z0-9,]^',$hometown)){
                $validForm = false;
                $hometownErr .= "Hometown must be alpha numeric";
            }
		}
    
        function validateCareerGoals($careerGoals){
            global $validForm,$careerGoalsErr;
            
            if(!preg_match('^[a-zA-Z0-9,!?&/$#@+.]^',$careerGoals)){
                $validForm = false;
                $careerGoalsErr = "Career goals must be alpha numeric";
            }
        }
    
        function validateThreeWords($threeWords){
            global $validForm,$threewordsErr;
			
            if(!preg_match('^[a-zA-Z0-9,!?&/$#@+.]^',$threeWords)){
                $validForm = false;
                $threewordsErr = "Three words must be alpha numeric $threeWords";
            }
        }
		
		function honeyPot($honeyPot){
			if(strlen($honeyPot) > 0){
				$validForm = false;
			}
		}
            
    if(isset($_POST["submitBio"]))
    {
        if(isset($_POST["email"])){
            $email = $_POST["email"];
        }
        
        if(isset($_POST["firstName"])){
            $firstName = $_POST["firstName"];
        }
        
        if(isset($_POST["lastName"])){
            $lastName = $_POST["lastName"];
        }
        
        if(isset($_POST["program"])){
            $program = $_POST["program"];
        }
        
        if(isset($_POST["websiteAddress"])){
            $websiteAddress = $_POST["websiteAddress"];
        }
        
        if(isset($_POST["linkedIn"])){
            $linkedIn = $_POST["linkedIn"];
        }
        
        if(isset($_POST["websiteAddress2"])){
            $websiteAddress2 = $_POST["websiteAddress2"];
        }		
        
        if(isset($_POST["hometown"])){
            $hometown = $_POST["hometown"];
        }
        
        if(isset($_POST["careerGoals"])){
            $careerGoals = $_POST["careerGoals"];
        }
        
        if(isset($_POST["threeWords"])){
            $threeWords = $_POST["threeWords"];
        }
		
		if(isset($_POST["honeyPot"])){
            $honeyPot = $_POST["honeyPot"];
        }
		else{
			$honeyPot = "";
		}

        $validForm = true;
        validateFirstName($firstName);
        validateLastName($lastName);
        validateProgram($program);
		validateWebsiteAddress($websiteAddress);
		if(isset($_POST["websiteAddress2"])){
			validateWebsiteAddress2($websiteAddress2);
		}
		validateLinkedIn($linkedIn);
		validateEmail($email);
		validateHometown($hometown);
		validateCareerGoals($careerGoals);
		validateThreeWords($threeWords);
		honeyPot($honeyPot);
        
        if($validForm){
            $message = "All good! ";
        }
        else{
            $message = "Something went wrong";
        }
    }
   ?>
<!-- Input Field validations. 

validateFirstName
	// valid first name should only include letters, numbers, and spaces
	// ... must be present


validateLastName
	// valid last name should only include letters, numbers and spaces
	// ... must be present

validateProgram
	//valid program must not be default options

validateWebsiteAddress
	//valid URL format

validateWebsiteAddress2
	//valid URL format	

validateLinkedIn
	//valid URL to linkedin.com

validateEmail
	//valid email should be in a proper format  
	//Matches: bob@aol.com | bob@wrox.co.uk | bob@domain.info |123@123.123
	//Non-Matches: a@b | notanemail | bob@@.

validateHometown
	// valid name should only include letters, numbers, spaces, and commas
	// ... must be present

validateCareerGoals
	//valid career goals should include only numbers, letters, spaces, and basic punctuation

validateThreeWords
	//valid three-words should include only numbers, letters, spaces, and basic punctuation

-->
  
</head>

<section class="orange">
<body>

<div class="frame2">
<div class="frame">

  <div class="main">
  <div><img src="madonna.gif" alt="Mix gif" ></div>
  <br>

<!--<a href = 'dmaccPortfolioDayLogout.php'>Log Out</a>-->

<section class="citrus">
<section class="bamboo">
<section class="violet">


	<div class="main form">
	<?php
    if($validForm){
?>
    <h1><?php if(isset($message)){echo($message);} ?></h1>
<?php }
    else{
?>
	<h2></h2>
	</table>
	<form id="portfolioBioForm" method="post" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>">
		
		<table>
		<tr>
		<td>Login Email:<br> <input type="text" id="emailToLogin" name="emailToLogin" value=""/></td>
		</tr>
		<tr>
		<td>First Name:<br> <input type="text" id="firstName" name="firstName" value="<?php echo($firstName) ?>"/><br><span class="error" id="firstNameError"><?php echo($firstNameErr); ?></span></td>
		</tr>
		<tr>
		<td>Last Name:<br> <input type="text" id="lastName" name="lastName" value="<?php echo($lastName) ?>" /><br><span class="error" id="lastNameError"><?= $lastNameErr ?></span></td>
		</tr>
		<tr>
		<td >Program:<br> <select id="program" name="program">
				<option value="default" <?php if ($_POST['program'] == 'default') echo 'selected="selected"'; ?>>---Select Your Program---</option>
				<option value="animation" <?php if ($_POST['program'] == 'animation') echo 'selected="selected"'; ?>>Animation</option>
				<option value="graphicDesign" <?php if ($_POST['program'] == 'graphicDesign') echo 'selected="selected"'; ?>>Graphic Design</option>
				<option value="photography" <?php if ($_POST['program'] == 'photography') echo 'selected="selected"'; ?>>Photography</option>
				<option value="videoProduction" <?php if ($_POST['program'] == 'videoProduction') echo 'selected="selected"'; ?>>Video Production</option>
				<option value="webDevelopment" <?php if ($_POST['program'] == 'webDevelopment') echo 'selected="selected"'; ?>>Web Development</option>
			</select><br><span class="error" id="programError"><?= $programErr ?></span><td>
		</tr>
		<tr>
		<td >Secondary Program:<br> <select id="program2" name="program2">
				<option value="none" <?php if ($_POST['program2'] == 'none') echo 'selected="selected"'; ?>>---No Secondary Program---</option>
				<option value="animation" <?php if ($_POST['program2'] == 'animation') echo 'selected="selected"'; ?>>Animation</option>
				<option value="graphicDesign" <?php if ($_POST['program2'] == 'graphicDesign') echo 'selected="selected"'; ?>>Graphic Design</option>
				<option value="photography" <?php if ($_POST['program2'] == 'photography') echo 'selected="selected"'; ?>>Photography</option>
				<option value="videoProduction" <?php if ($_POST['program2'] == 'videoProduction') echo 'selected="selected"'; ?>>Video Production</option>
				<option value="webDevelopment" <?php if ($_POST['program2'] == 'webDevelopment') echo 'selected="selected"'; ?>>Web Development</option>
			</select><br><span class="error" id="program2Error"><?= $programErr ?></span><td>
		</tr>
		<tr>
		<td>Website Address:<br> <input type="text" id="websiteAddress" name="websiteAddress" value="<?php echo($websiteAddress) ?>"/><br><span class="error" id="websiteAddressError"><?= $websiteAddressErr ?></span></td>
		</tr>
		<tr>
		<td>Personal Email:<br><input type="text" id="email" name="email" value="<?php echo($email) ?>" /><br><span class="error" id="emailError" ><?= $emailErr ?></span></td>
		</tr>
		<tr>
		<td>LinkedIn Profile:<br><input type="text" id="linkedIn" name="linkedIn" value="<?php echo($linkedIn) ?>" /><br><span class="error" id="linkedInError"><?= $linkedinErr ?></span></td>
		<tr>
		<td><span class="secondWeb">Secondary Website Address (git repository, etc.):<br> <input type="text" id="websiteAddress2" name="websiteAddress2" value="<?php echo($websiteAddress2) ?>"/><br><span class="error" id="websiteAddress2Error"><?= $websiteAddressErr2 ?></span></span></td>
		</tr>
		<tr>
		<td>Hometown:<br> <input type="text" id="hometown" name="hometown" value="<?php echo($hometown) ?>"/><br><span class="error" id="hometownError"><?= $hometownErr ?></span></td>
		</tr>
		<tr>
		<td>Career Goals:<br> <textarea id="careerGoals" name="careerGoals" value="<?php echo($careerGoals) ?>"> </textarea><br><span class="error" id="careerGoalsError"><?= $careerGoalsErr ?></span></td>
		</tr>
		<tr>
		<td>3 Words that Describe You:<br> <input type="text" id="threeWords" name="threeWords" value="<?php echo($threeWords) ?>"/><br><span class="error" id="threeWordsError"><?php echo($threewordsErr) ?></span></td>
		<p class="robotic" id="pot">
			<label>Leave Blank</label>
			<input type="hidden" name="honeyPot" id="inRobotest" class="inRobotest" value="" />
		</p>
		<input type="hidden" id="submitConfirm" name="submitConfirm" value="submitConfirm"/>
		</tr>
		<tr>
		<td><input type="submit" id="submitBio" name="submitBio" value="Submit Bio" /></td>
		</tr>
		<tr>
		<td><input type="reset" id="resetBio" name="resetBio" value="Reset Bio"/></td>
		</tr>
		</table>
	</form>
<?php } ?>
	</div>
	

</section>	
</section>
</section>
  
</div>

</body>
</section>

</html>
