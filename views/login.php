<?php
    class login{
        private $_username = '';
        private $_password = '';

        public function __construct($username,$password){
            $this->username = $username;
            $this->password = $password;
        }

        public function getUserName(){
            return $this->username;
        }

        public function getPassword(){
            return $this->password;
        }

        public function validateUser(){
            require("../models/connection.php");

            try{
                $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                    
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }
            catch(PDOException $e){
                echo "Connection failed: " . $e->getMessage();
            }
        
            $stmt = $conn->prepare("SELECT event_user_name, event_user_password FROM event_user WHERE event_user_name = :usr AND event_user_password = :pwd");
            $stmt->bindParam(':usr', $this->username, PDO::PARAM_STR);
            $stmt->bindParam(':pwd', $this->password, PDO::PARAM_STR);
            $stmt->execute();
    
            if($stmt->rowCount() == 0){
                return false;
            }
            else{
                return true;
            }
        }
    }

   session_start();
    
    $loginErr = '';

    if(isset($_POST['submit'])){
        $userLogin = new login($_POST['username'],$_POST['password']);

        if($userLogin->validateUser()){
            $_SESSION['valid'] = true;
            $_SESSION['timeout'] = time();
            $_SESSION['username'] = $userLogin->getUserName();
            header("location:admin.php"); 
        }
        else if(!$userLogin->validateUser()){
            global $loginErr;
            $loginErr = "Invalid UserName or Password";
            unset($userLogin);
        }
    }
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
        <form method="post" action="login.php">
        <div class="form-group bg-danger">
            <?php echo $loginErr; ?>
        </div>
        <div class="form-group">
            <label for="tbUserName">User Name</label>
            <input type="text" class="form-control" id="tbUserName"placeholder="Enter User Name" required="true" name="username" autocomplete="off">
        </div>
        <div class="form-group">
            <label for="tbPassword">Password</label>
            <input type="password" class="form-control" id="tbPassword" placeholder="Password" required="true" name="password">
        </div>
        <button type="submit" class="btn btn-primary" name="submit" id="btnSubmit">Submit</button>
        </form>
    </body>
</html>