<?php
        $username = $_POST["username"];
        $password = $_POST["password"];
        
        $con = mysql_connect("localhost","root", "");
        if (!$con){ die('Could not connect: ' . mysql_error());}

        mysql_select_db("user") or die("Unable to connected to Database." . mysql_error());
        //$query = mysql_query("SELECT max( id ) FROM main ORDER BY id LIMIT 100");
        $query = "SELECT * FROM cipher WHERE username='".$username."'";
        $result = mysql_query($query) or die(mysql_error());
        while($row = mysql_fetch_array($result)){
            $userID = $row['id'];
            $user = $row['username'];
            $pass = $row['password'];
            $logins = $row['numberOfLogins'];
        }
        
        $num = $logins+1;
        mysql_query("UPDATE cipher SET numberOfLogins='".$num."' WHERE id='".$userID."'");
        
        if($password == $pass){
            setcookie("user", $userID, time()+3600);
            header("location:index.php");
        }else
            header("location:index.php");
        
        mysql_close($con);
        
        
?>