<!-- 

Author: Jonathon R. Cronin
Company: Cronwol Industries

/-->
<HTML>
<HEAD>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<title>Expthis.com</title>
	<link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" rel="stylesheet" type="text/css"/>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script>
</HEAD>
<?PHP
	if (isset($_COOKIE["user"])) $userCookie = $_COOKIE["user"]; else{ $userCookie = "Guest";}
	$topic = "topic"; // 
    $con = mysql_connect("localhost","root", "");
    if (!$con){ die('Could not connect: ' . mysql_error());}

    mysql_select_db("topics") or die("Unable to connected to Database." . mysql_error());
    $countResult = mysql_query("SELECT * FROM main");
    $count = mysql_num_rows($countResult);
    $articleMax = $count;
    $randomize = range(1,$articleMax);
    shuffle($randomize);
    for($t=0;$t<17;$t++){
       $randomStart[$t] = $randomize[$t];
    }
    
    for($a = 1; $a < 17; $a++){
    $result = mysql_query("SELECT * FROM main WHERE id='".$randomStart[$a]."'");
		while($row = mysql_fetch_array($result)){
			
			${$topic.$a}[0] = $row['id'];
			${$topic.$a}[1] = $row['title'];
			${$topic.$a}[2] = $row['titleImage'];
		}
    }
	mysql_close($con);
	
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

    <style type="text/css">
        #blocksA{
            background-color:#FFD700;
            height:170px;
            width:232px;
            margin-left: 0px;
            margin-right: 10px;
            margin-top: 10px;
            font-family: 'PT Sans';
            margin-bottom: 10px;
            float:left;
        }
        
        #blocks{
            background-color:#FFD700;
            height:170px;
            width:232px;
            margin-left: 10px;
            margin-right: 10px;
            margin-top: 10px;
            font-family: 'PT Sans';
            margin-bottom: 10px;
            float:left;
        }
        a img {border: none; }
        #titleBar{
            opacity:.8;
        }
        
        #title{
            color:white; margin-right:15px; top:-15px; font-family:"PT Sans"; font-size: 12pt; z-index:4
        }
    </style>

<BODY>
        <div id="container" 
             style="width:998px;
                    position: relative;
                    height: 100%;
                    margin: 0px auto 0 auto;
                    text-align: left;
                    font-family: 'PT Sans';
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
            <?PHP
                $b = 1;
                $previous = "previous";
                $colorPrevious = "colorPrevious";
                $numbers = range(1,16);
                shuffle($numbers);
                $colorRandom = range(0,16);
                shuffle($colorRandom);
                for($i=1; $i < 17; $i++){
                    if ($i == 1 || $i == 5 || $i == 9 || $i == 13){
                         echo '<div id="blocksA">';
                         echo '<div id="image">
                             <a href="./articleView.php?artID='.${$topic.$i}[0].'"><img id="loadImage" style="height:170px; width:232px;font-family:"PT Sans"; z-index: 2" src="'.${$topic.$i}[2].'" alt="Whoa, our bad man.    Please reload this page..."></a>
                             </div>';
                         echo '<div id="titleBar" style="height:50px;position:relative; top:-54px; background-color:'.$color[$colorRandom[$i-1]].';text-align:right;font-family:"PT Sans"; opacity:.80; z-index: 1">';
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
            <script type="text/javascript">
            </script>  
            
            <div id="footer" style="background-color:#FFA500;clear:both;text-align:center;font-family:'PT Sans'; font-size:8pt;">Carpe Diem!</div>
            <div id="underfooter" style="clear:both;text-align:center;font-family:'PT Sans'; font-size:8pt; text-align:center">This is where the legal disclaimer and all that junk goes.</div>
        </div>
</BODY>
</HTML>