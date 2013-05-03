<?php
        include_once 'unit00.php';
        include_once './eva/rei.php';
        //if (isset($_COOKIE["user"])) $userCookie = $_COOKIE["user"]; else{ $userCookie = "Guest";}// checks and insures the user cookie is available
        $con = mysql_connect($db_hostname,$db_username,$db_password);
        if (!$con){ die('Could not connect: ' . mysql_error());}
        $artID = $_SESSION['articleID'];
        $commentID = $_GET['commentID'];
        $userID = $_GET['authorID'];
        mysql_select_db("topics") or die("Unable to connected to Database." . mysql_error());
        $query = "SELECT * FROM commentary WHERE commentID='".$commentID."' AND author='".$userID."'";
        $result = mysql_query($query) or die(mysql_error());
        while($row = mysql_fetch_assoc($result)){
            $currentTagging = $row['thumbUp'];
        }
        $currentTaggingFinal = ($currentTagging + 1);
        echo $currentTaggingFinal;
            
        mysql_query("UPDATE commentary SET thumbUp='".$currentTaggingFinal."' WHERE commentID='".$commentID."' AND author='".$userID."'");
      
        header("location:articleView.php?artID=".$artID."")
?>