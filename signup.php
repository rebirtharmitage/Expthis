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
    
    <script type="text/javascript">
        document.getElementById("arrow").style.display = 'none';    
            
        function showResult(str)
        {
        if (str.length==0)
          { 
          document.getElementById("livesearch").innerHTML="";
          document.getElementById("livesearch").style.border="0px";
          return;
          }
        if (window.XMLHttpRequest)
          {
          xmlhttp=new XMLHttpRequest();
          }
        else
          {// Backwards compatibility to IE 7, 6
          xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
          }
        xmlhttp.onreadystatechange=function()
          {
          if (xmlhttp.readyState==4 && xmlhttp.status==200)
            {
            document.getElementById("livesearch").innerHTML=xmlhttp.responseText;
            //document.getElementById("livesearch").style.border="1px solid #A5ACB2";
            document.getElementById("livesearch").style.background=".white";
            
            }
          }
        xmlhttp.open("GET","ajax_signup.php?q="+str,true);
        xmlhttp.send();
        }
        </script> 
    
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
        <div id="mainArea" style="height:1100px; width:330px; float:left; font-family:'PT Sans'; font-size: 12pt">
            <form action="signup_create.php" method="post" enctype="multipart/form-data">
            <div>Username</div>
            <div id="username"><input type="text" name="username" id="username" width="100%" size="51" height="50px" onkeyup="showResult(this.value)"/></div>
            <div>Firstname</div>
            <div id="firstname"><input type="textbox" name="firstname" id="firstname" width="100%" size="51" height="50px"/></div>
            <div>Lastname</div>
            <div id="lastname"><input type="textbox" name="lastname" id="lastname" width="100%" size="51" height="50px"/></div>
            <div>Email Address</div>
            <div id="email"><input type="textbox" name="email" id="email" width="100%" size="51" height="50px"/></div>
            <div>Password</div>
            <div id="password"><input type="password" name="password" id="password" width="100%" size="51" height="50px"/></div>
            <div>Upload Profile Pic</div>
            <div id="filename"><input type="file" name="filename" id="file" size="39" /></div>
            <input type="submit" value="Sign Up"  style="margin-left:215px; text-align:right; margin-top: 5px"/>
            </form>
        </div>
        <div id="rightBorder" style="height:1100px; width:330px; float:left;"><div id="livesearch" style="font-family:'PT Sans'; font-size:16pt; float:right; margin-top: 15px;"></div></div>
        
            <div id="footer" style="background-color:#FFA500;clear:both;text-align:center;font-family:'PT Sans'; font-size:8pt;">Carpe Diem!</div>
            <div id="underfooter" style="clear:both;text-align:center;font-family:'PT Sans'; font-size:8pt; text-align:center">This is where the legal disclaimer and all that junk goes.</div>
        </div>
    </body>
</html>
