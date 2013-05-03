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
        $topic = "topic";
        $a = 0;
        
        $con = mysql_connect("localhost","root", "");
        if (!$con){ die('Could not connect: ' . mysql_error());}

        mysql_select_db("user") or die("Unable to connected to Database." . mysql_error());
        //$query = mysql_query("SELECT max( id ) FROM main ORDER BY id LIMIT 100");
        $query = mysql_query("SELECT * FROM main WHERE id='$userCookie' LIMIT 18");
        while($row = mysql_fetch_array($query)){
                
                $user[0] = $row['username'];
                $user[1] = $row['firstname'];
                $user[2] = $row['lastname'];
                $user[3] = $row['email'];
                $user[4] = $row['ranking'];
                $user[5] = $row['trolling'];
        }
        
        $query2 = mysql_query("SELECT * FROM cipher WHERE id='$userCookie'");
        while($row = mysql_fetch_array($query2)){
                
                $user2[0] = $row['username'];
                $user2[1] = $row['numberOfLogins'];
                $user2[2] = $row['numberOfArticles'];
        }
        
            mysql_select_db("topics") or die("Unable to connected to Database." . mysql_error());    
            $result = mysql_query("SELECT * FROM main WHERE author='".$userCookie."'");
            $count = mysql_num_rows($result);
            $articleMax = $count;
            $randomize = range(0,$articleMax);
            shuffle($randomize);

            if(mysql_num_rows($result) > 0)
            {
            while($row = mysql_fetch_assoc($result))
                {
                        ${$topic.$a}[0] = $row['id'];
                        ${$topic.$a}[1] = $row['title'];
                        ${$topic.$a}[2] = $row['titleImage'];
                        $a++;
                }
            } 

                $color[0] = "#317661";
                $color[1] = "#3A4879";
                $color[2] = "#B29249";
                $color[3] = "#B26E49";
                $color[4] = "#32594D";
                $color[5] = "#383F5C";
                $color[6] = "#87754B";
                $color[7] = "#87604B";
                $color[8] = "#114E3C";
                $color[9] = "#142150";
                $color[10] = "#765A19";
                $color[11] = "#763A19";
                $color[12] = "#317661";
                $color[13] = "#3A4879";
                $color[14] = "#B29249";
                $color[15] = "#B26E49";
                $color[16] = "#114E3C";
            
        ?>
        <style>
        #blocksA{
            background-color:#FFD700;
            height:170px;
            width:232px;
            margin-left: 0px;
            margin-right: 8px;
            margin-top: 8px;
            margin-bottom: 8px;
            float:left;
        }
        
        #blocks{
            background-color:#FFD700;
            height:170px;
            width:232px;
            margin-left: 8px;
            margin-right: 8px;
            margin-top: 8px;
            margin-bottom: 8px;
            float:left;
        }
        
        #titleBar{
            opacity:.8;
        }
        
        #title{
            color:white; margin-right:15px; top:-15px; font-family:"PT Sans"; font-size: 12pt; z-index:4
        }
        </style>
        <div id="container" 
             style="width:998px;
                    position: relative;
                    height: 100%;
                    margin: 0px auto 0 auto;
                    text-align: left;
                    padding-left: 1px;
                    cursor: default;">

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
                    echo "<text>Welcome Back ".$usernameDefinedFirstname."</text><a>   </a><text>".$usernameDefinedLastname."</text><a>   </a><a href='accountView.php'>View Account</a><a>   </a><a href='createArticle.php'>Create Article</a>";
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
                <form action="searchResults.php" method="post">
                <input type="textbox" height="25" text="Search" id="search" name="search" class="search"/>
                <input style="text-align: center" type="submit" height="25" size="10" value="Search"/>
                </form>
            </div>        
                
        <div id="leftBorder" style="height:1100px; width:255px; float:left; margin-left:0px; margin-right:0px; margin-bottom: 20px">
            <div id="userinfo"><img src="./images/userimages/<?PHP echo $userCookie; ?>.jpg" style="width:11em; width:11em;"/>
                <div id="table">
                <table border="0" style="margin-bottom:10px;">
                <tr>
                <td>Number of Logins</td>
                <td><?PHP echo $user2[1]; ?></td>
                </tr>
                <tr>
                <td>Number of Articles</td>
                <td><?PHP echo $user2[2]; ?></td>
                </tr>
                </table>
                </div>
            </div>
                <form action="modify.php" method="post">
                <div>Username</div>
                <div id="username"><input type="text" name="username" readonly="readonly" id="username" value="<?PHP echo $user[0] ?>" width="100%" size="25" height="50px"/></div>
                <div>Firstname</div>
                <div id="firstname"><input type="textbox" name="firstname" id="firstname" value="<?PHP echo $user[1] ?>" width="100%" size="25" height="50px"/></div>
                <div>Lastname</div>
                <div id="lastname"><input type="textbox" name="lastname" id="lastname" value="<?PHP echo $user[2] ?>" width="100%" size="25" height="50px"/></div>
                <div>Email Address</div>
                <div id="email"><input type="textbox" name="email" id="email" value="<?PHP echo $user[3] ?>" width="100%" size="25" height="50px"/></div>
                <div id="change"><input type="submit" value="Apply Changes" style="margin-left: 57px; margin-top: 5px"/></div>
                </form>
        </div>
        
        <div id="leftBorder" style="height:100%px; width:100%; margin: 5px; margin-bottom: 20px; font-family:'PT Sans'; font-size:14pt; margin-left: 50px"> <div>Your Created Articles</div>
            <?PHP
                $b = 1;
                $previous = "previous";
                $colorPrevious = "colorPrevious";
                $numbers = range(0,$articleMax);
                shuffle($numbers);
                $colorRandom = range(0,16);
                shuffle($colorRandom);
                for($i=0; $i < $articleMax; $i++){
                    if ($i == 0 ||  $i%3 == 0){
                         echo '<div id="blocksA">';
                         echo '<div id="image">
                             <a href="./articleView.php?artID='.${$topic.$i}[0].'"><img id="loadImage" style="height:170px; width:232px; z-index: 2" src="'.${$topic.$i}[2].'" alt="Whoa, our bad man.    Please reload this page..."></a>
                             </div>';
                         echo '<div id="titleBar" style="height:50px;position:relative; top:-54px; background-color:'.$color[$colorRandom[$i]].';text-align:right;font-family:"PT Sans"; opacity:.80; z-index: 1">';
                         echo '<div id="title" style="color:white; margin-right:15px; top:-15px; font-family:"PT Sans"; font-size: 12pt; z-index:4">'.${$topic.$i}[1].'</div>                        
                             </div>
                             </div>';
                        
                    }
                    else{               
                        echo '<div id="blocks">';
                        echo '<div id="image">
                            <a href="./articleView.php?artID='.${$topic.$i}[0].'"><img id="loadImage" style="height:170px; width:232px; z-index: 2" src="'.${$topic.$i}[2].'" alt="Whoa, our bad man.    Please reload this page..."></a>
                            </div>';
                        echo '<div id="titleBar" style="height:50px;position:relative; top:-54px; background-color:'.$color[$colorRandom[$i]].';text-align:right;font-family:"PT Sans"; opacity:.80; z-index: 1">';
                        echo '<div id="title">'.${$topic.$i}[1].'</div>                        
                            </div>
                            </div>';
                    }
                    
                };
                
            ?>
        </div>
            <div id="footer" style="background-color:#FFA500;clear:both;text-align:center;font-family:'PT Sans'; font-size:8pt;">Carpe Diem!</div>
            <div id="underfooter" style="clear:both;text-align:center;font-family:'PT Sans'; font-size:8pt; text-align:center">This is where the legal disclaimer and all that junk goes.</div>
        </div>
    </body>
</html>
