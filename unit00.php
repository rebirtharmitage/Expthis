<?php
        session_start();// Allows the artID or article identificaiton number to be passed to this .php file
        if (isset($_COOKIE["user"])) $userCookie = $_COOKIE["user"]; else{ $userCookie = "Guest";}// checks and insures the user cookie is available
?>
