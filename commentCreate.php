<?php
        session_start();// Allows the artID or article identificaiton number to be passed to this .php file
        if (isset($_COOKIE["user"])) $userCookie = $_COOKIE["user"]; else{ $userCookie = "Guest";}// checks and insures the user cookie is available
        include_once './eva/rei.php';
        
        //Get Sessioned variables re-assigned
        $artID = $_SESSION['articleID'];
        
        //Establish Database connection under credential Rei
        $con = mysql_connect($db_hostname,$db_username,$db_password);
        if (!$con){ die('Could not connect: ' . mysql_error());}
        
        //Get variables from Post Method in previous page
        $comment = $_POST['comment'];
        $rating = $_POST['amount'];

        //Access table topics database to get the max id for the images to increment the next id used
        mysql_select_db("topics") or die("Unable to connected to Database." . mysql_error());
        $query = "SELECT id, MAX(id) FROM images";
        $result = mysql_query($query) or die(mysql_error());
        while($row = mysql_fetch_array($result)){
            $max = $row['MAX(id)'];
        }
        $newID = $max + 1;
        
        //Access the commentary table in topics to record the increment of the comment by the user.
        $query1 = "SELECT commentID, MAX(commentID) FROM commentary WHERE author='".$userCookie."'";
        $result1 = mysql_query($query1) or die(mysql_error());
        while($row = mysql_fetch_array($result1)){
            $maxa = $row['MAX(commentID)'];
        }
        $commentID = $maxa + 1;
        
        //Insert into commentary
        mysql_query("INSERT INTO `topics`.`commentary` (`id`, `author`, `commentID`, `comment`, `img`, `video`, `audio`, `comORdec`, `rating`, `trolling`) VALUES ('".$artID."', '".$userCookie."', '".$commentID."','".$comment."', '".$newID."', '', '', '', '".$rating."', '');");
        if($_FILES["filename"] != ""){
            mysql_query("INSERT INTO `topics`.`images` (`id`, `creatorID`, `articleID`, `dateCreated`, `commentID`, `size`) VALUES ('".$newID."', '".$userCookie."', '".$artID."', CURRENT_TIMESTAMP, '".$commentID."', '".$_FILES['filename']['size']."');");
        }
        //File Upload Section
        if ($_FILES["filename"]["error"] > 0)
        {
            echo "Error: " . $_FILES["filename"]["error"] . "<br />";
            header("location:articleView.php?artID=".$artID."");
        }elseif($file == ""){
            header("location:articleView.php?artID=".$artID."");
        }     
        else{
            $con = mysql_connect($db_hostname,$db_username,$db_password);
            if (!$con){ die('Could not connect: ' . mysql_error());}
            $size = $_FILES['filename']['size']/1024;
            mysql_query("INSERT INTO `topics`.`images` (`id`, `creatorID`, `articleID`, `dateCreated`, `commentID`, `size`) VALUES ('".$newID."', '".$userCookie."', '".$artID."', CURRENT_TIMESTAMP, '".$commentID."', '".$_FILES['filename']['size']."'");
            $name = $_FILES['filename']['name'];
            $rename = "0".$newID.".jpg";
            move_uploaded_file($_FILES['filename']['tmp_name'], 'c:\Program Files (x86)/EasyPHP-5.3.5.0/www/Lyfactuality/images/'.$rename);
            header("location:articleView.php?artID=".$artID."");
        }
        
        mysql_close($con);
?>
