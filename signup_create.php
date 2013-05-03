<?php
        include_once './eva/rei.php';
        $username = $_POST["username"];
        $firstname = $_POST["firstname"];
        $lastname = $_POST["lastname"];
        $email = $_POST["email"];
        $password = $_POST["password"];
        
        $con = mysql_connect("localhost","root", "");
        if (!$con){ die('Could not connect: ' . mysql_error());}

        mysql_select_db("user") or die("Unable to connected to Database." . mysql_error());
        //$query = mysql_query("SELECT max( id ) FROM main ORDER BY id LIMIT 100");
        $query = "SELECT id, MAX(id) FROM main";
        $result = mysql_query($query) or die(mysql_error());
        while($row = mysql_fetch_array($result)){
            $max = $row['MAX(id)'];
        }
        $topicID = $max + 1;
        $rename = $topicID.".jpg";
        mysql_query("INSERT INTO `user`.`main` (`id`, `username`, `password`, `firstname`, `lastname`, `email`, `ranking`, `trolling`) VALUES ('".$topicID."', '".$username."', '".$password."', '".$firstname."', '".$lastname."', '".$email."', '0', '0');");     
        mysql_query("INSERT INTO `user`.`cipher` (`id`, `username`, `password`, `numberOfLogins`) VALUES ('".$topicID."', '".$username."', '".$password."', '1');");
        
        if ($_FILES["filename"]["error"] > 0)
        {
            echo "Error: " . $_FILES["filename"]["error"] . "<br />";
            header("location:signup.php");
        }else{
            $con = mysql_connect($db_hostname,$db_username,$db_password);
            if (!$con){ die('Could not connect: ' . mysql_error());}
            $size = $_FILES['filename']['size']/1024;
            //mysql_query("INSERT INTO `topics`.`images` (`id`, `creatorID`, `articleID`, `dateCreated`, `commentID`, `size`) VALUES ('".$newID."', '".$rename."', '".$artID."', CURRENT_TIMESTAMP, '".$commentID."', '".$_FILES['filename']['size']."'");
            $name = $_FILES['filename']['name'];
            //$rename = "0".$newID.".jpg";
            move_uploaded_file($_FILES['filename']['tmp_name'], 'c:\Program Files (x86)/EasyPHP-5.3.5.0/www/Lyfactuality/images/userimages/'.$rename);
            header("location:signin.php");
        }
        mysql_close($con);
        
        //header("location:signin.php");
?>