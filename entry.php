<?php
session_start();
        if (isset($_COOKIE["user"])) $userCookie = $_COOKIE["user"]; else{ $userCookie = "Guest";}
        include_once './eva/rei.php';
        $id = $_COOKIE;
        $title = $_POST["title"];
        $userID = $_COOKIE;
        $post = $_POST["post"];
        $tagging = $_POST["tagging"];
        $summary = $post;
        
        $con = mysql_connect("localhost","root", "");
        if (!$con){ die('Could not connect: ' . mysql_error());}

        mysql_select_db("topics") or die("Unable to connected to Database." . mysql_error());
        $query = "SELECT id, MAX(id) FROM main";
        $result = mysql_query($query) or die(mysql_error());
        while($row = mysql_fetch_array($result)){
            $max = $row['MAX(id)'];
        }
        $topicID = $max + 1;
        
        mysql_query("INSERT INTO `topics`.`main` (`id`, `title`, `titleImage`, `author`, `post`, `summaryPost`, `img1`, `img2`, `img3`, `img4`, `img5`, `img6`, `img7`, `img8`, `img9`, `img10`, `video1`, `video2`, `video3`, `audio1`, `audio2`, `audio3`, `tagging`, `Status`) VALUES ('".$topicID."', '".$title."', '', '".$userCookie."', '".$post."', '".$summary."', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '".$tagging."','1')");
        $artID=$topicID;
     
        mysql_select_db("topics") or die("Unable to connected to Database." . mysql_error());
        $query1 = "SELECT id, MAX(id) FROM images";
        $result1 = mysql_query($query1) or die(mysql_error());
        while($row = mysql_fetch_array($result1)){
            $maxa = $row['MAX(id)'];
        }
        $newID = $maxa + 1;
        
        $userQuery1 = mysql_query("SELECT * FROM cipher WHERE id='".$userCookie."'");
                    while($row = mysql_fetch_array($userQuery1)){
                       $userArticles = $row['numberOfArticles'];
                    }
                    $art = $userArticles+1;
                    mysql_query("UPDATE cipher SET numberOfArticles='".$art."' WHERE id='".$userCookie."'");
        
        if ($_FILES["filename"]["error"] > 0){
            echo "Error: " . $_FILES["filename"]["error"] . "<br />";
            header("location:articleView.php?artID=".$artID."");
        }
        else{
            $con = mysql_connect($db_hostname,$db_username,$db_password);
            if (!$con){ die('Could not connect: ' . mysql_error());}
            $size = $_FILES['filename']['size']/1024;
            mysql_query("INSERT INTO `topics`.`images` (`id`, `creatorID`, `articleID`, `dateCreated`, `commentID`, `size`) VALUES ('".$newID."', '".$userCookie."', '".$topicID."', CURRENT_TIMESTAMP, '".$commentID."', '".$_FILES['filename']['size']."'");
            $name = $_FILES['filename']['name'];
            $rename = "0".$newID.".jpg";
            move_uploaded_file($_FILES['filename']['tmp_name'], 'c:\Program Files (x86)/EasyPHP-5.3.5.0/www/Lyfactuality/images/'.$rename);
            header("location:articleView.php?artID=".$artID."");
        }
      
        mysql_close($con);
        
        header("location:index.php");
?>
