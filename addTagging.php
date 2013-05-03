<?php
        include_once 'unit00.php';
        include_once './eva/rei.php';
        
        $con = mysql_connect($db_hostname,$db_username,$db_password);
        if (!$con){ die('Could not connect: ' . mysql_error());}
        $artID = $_SESSION['articleID'];
        $addTagging = $_GET['addTags'];
        mysql_select_db("topics") or die("Unable to connected to Database." . mysql_error());
        $query = "SELECT tagging FROM main WHERE id='".$artID."'";
        $result = mysql_query($query) or die(mysql_error());
        while($row = mysql_fetch_array($result)){
            $currentTagging = $row['tagging'];
        }
        
        mysql_query("UPDATE main SET tagging='".$currentTagging." ".$addTagging."' WHERE id='".$artID."'");
      
        header("location:articleView.php?artID=".$artID."")
?>
