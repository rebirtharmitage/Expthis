<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Lyfactuality: Carpe Diem!</title>
    </head>
    <body>
        <?php
        if (isset($_COOKIE["user"])) $userCookie = $_COOKIE["user"]; else{ $userCookie = "Guest";}
        ?>
        <div id="container" style="width:998px; position: relative; height: 100%; margin: 0px auto 0 auto; text-align: left;  padding-left: 1px; cursor: default;">
                    <div id="upperheader" 
                 style="margin-top:1px;
                        margin-bottom: 8px;
                        text-align: right;
                        margin-right: 8px;
                        font-family: 'PT Sans';
                        font-size: 10pt;
                        z-index:2">
                
                <a href="index.php"><img id="topBar" src="./geometry/topbar.png" alt="Whoa, our bad man.    Please reload this page..."></a>
            </div>
            
            <div id="header" 
                 style="margin-top:-100px;
                        margin-bottom: 85px;
                        text-align: right;
                        margin-right: 8px;
                        font-family: 'PT Sans';
                        font-size: 10pt;
                        z-index:2">
                <?PHP
                if($userCookie == "Guest"){
                    echo "<a href='signup.php'>Sign Up</a>  | <a href='signin.php'>Sign In</a>";
                }
                else{
                    $connect = mysql_connect("localhost","root", "");
                    if (!$connect){ die('Could not connect: ' . mysql_error());}
                    mysql_select_db("user") or die("Unable to connected to Database." . mysql_error());
                    $userQuery = mysql_query("SELECT * FROM main WHERE id='".$userCookie."'");
                    while($row = mysql_fetch_array($userQuery)){
                       $usernameDefinedFirstname = $row['firstname'];
                       $usernameDefinedLastname = $row['lastname'];
                    }
                    
                    echo "<text>Welcome Back ".$usernameDefinedFirstname."</text><a>   </a><text>".$usernameDefinedLastname."</text><a>   </a><a href='accountView.php'>View Account</a>";
                }
                
                ?>
                
            </div>
            
            <div id="header" 
                 style="margin-top:-72px;
                        margin-bottom: 50px;
                        text-align: right;
                        margin-right: 25px;
                        font-family: 'PT Sans';
                        font-size: 10pt;
                        z-index:2">
                 <input type="textbox" height="25" text="Search"/>
                 <input style="text-align: center" type="button" height="25" size="10" value="Search"/>
            </div>
        <div id="leftBorder" style="height:1100px; width:330px; float:left; color:white">the</div>
        <div id="mainArea" style="height:1100px; width:330px; float:left;">
            <form action="entry.php" method="post">
            <div>Title</div>
            <div id="title"><input type="textbox" name="title" id=title width="100%" size="51" height="50px"/></div>
             <div>Title Image *required</div>
             <div id="titleImage"><input type="file" name="filename" id="file" size="39" /></div>
             <div>Article</div>
             <div id="post"><textarea  rows="10" cols="37" name="post"></textarea></div>
             <div>Add Video</div>
             <div id="addVideo1"><input type="file" name="addVideo1" id="file" size="39" /></div>
             <div id="addVideo2"><input type="file" name="addVideo2" id="file" size="39" /></div>
             <div id="addVideo3"><input type="file" name="addVideo3" id="file" size="39" /></div>
             <div>Add Images</div>
             <div id="addImg1"><input type="file" name="addImg1" id="file" size="39" /></div>
             <div id="addImg2"><input type="file" name="addImg2" id="file" size="39" /></div>
             <div id="addImg3"><input type="file" name="addImg3" id="file" size="39" /></div>
             <div id="addImg4"><input type="file" name="addImg4" id="file" size="39" /></div>
             <div id="addImg5"><input type="file" name="addImg5" id="file" size="39" /></div>
             <div id="addImg6"><input type="file" name="addImg6" id="file" size="39" /></div>
             <div id="addImg7"><input type="file" name="addImg7" id="file" size="39" /></div>
             <div id="addImg8"><input type="file" name="addImg8" id="file" size="39" /></div>
             <div id="addImg9"><input type="file" name="addImg9" id="file" size="39" /></div>
             <div id="addImg10"><input type="file" name="addImg10" id="file" size="39" /></div>
             <div>Add Audio</div>
             <div id="addAudio1"><input type="file" name="addAudio1" id="file" size="39" /></div>
             <div id="addAudio2"><input type="file" name="addAudio2" id="file" size="39" /></div>
             <div id="addAudio3"><input type="file" name="addAudio3" id="file" size="39" /></div>
             <div>Tagging</div>
             <div id="tagging"><textarea  rows="10" cols="37" name="tagging"></textarea></div>
            <input type="submit" value="Create Petition"  style="margin-left:215px; text-align:right"/>
            </form>
        </div>
        <div id="rightBorder" style="height:1100px; width:330px; float:left; color:white">the</div>
        
            <div id="footer" style="background-color:#FFA500;clear:both;text-align:center;font-family:'PT Sans'; font-size:8pt;">Carpe Diem!</div>
            <div id="underfooter" style="clear:both;text-align:center;font-family:'PT Sans'; font-size:8pt; text-align:center">This is where the legal disclaimer and all that junk goes.</div>
        </div>
    </body>
</html>
