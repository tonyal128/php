<?php
    session_start();
    unset($_SESSION["username"]);
    unset($_SESSION["password"]);
    session_destroy();
    header('Location: ../final/login.php');
?>