<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE html>
<?PHP session_start(); ?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Lyfactuality: Carpe Diem!</title>
    </head>

    <body>
        <?php
        // Initial Check for a possible signed in user.  This will determine controls that are available and comment section availability
        if (isset($_COOKIE["user"])) $userCookie = $_COOKIE["user"]; else{ $userCookie = "Guest";}
        // This is a variable past through the URL to the PHP to determine which article is being loaded from the database
        $artID = $_GET['artID'];
        // $con is the variable holding the MySQL Database connection
        $con = mysql_connect("localhost","root", ""); if (!$con){ die('Could not connect: ' . mysql_error());}
        // Starts session to hold the Article ID that is being viewed.   This remain in memory for quick memory access.
        $_SESSION['articleID'] = $artID;
        
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
            $result = mysql_query("SELECT * FROM main WHERE id='".$artID."'");
            $count = mysql_num_rows($result);
            $articleMax = $count;
            $randomize = range(0,$articleMax);
            shuffle($randomize);
            
            
            while($row = mysql_fetch_assoc($result)){
                        $topic[0] = $row['id'];
                        $topic[1] = $row['title'];
                        $topic[2] = $row['titleImage'];
                        $topic[3] = $row['post'];
                        $topic[4] = $row['tagging'];
                        $topic[5] = $row['views'];
                        //$topic[6] = $row['rating'];
            } 
            
            mysql_query("UPDATE main SET views='".($topic[5] + 1)."' WHERE id='".$artID."'");

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
 

            $result1 = mysql_query("SELECT * FROM commentary WHERE id='".$artID."' ORDER BY commentID DESC");
            $comment = "comment";
            $counting = mysql_num_rows($result1);
            $resulting = mysql_query("SELECT * FROM commentary WHERE id=".$artID." ORDER BY commentID DESC");
            $commentMax = $counting;
            for($b = 0; $b < $commentMax; $b++){
                
                ${$comment.$b}[0] = mysql_result($resulting, $b, 'author');
                ${$comment.$b}[1] = mysql_result($resulting, $b, 'comment');
                ${$comment.$b}[2] = mysql_result($resulting, $b, 'rating');
                ${$comment.$b}[3] = mysql_result($resulting, $b, 'img');
                ${$comment.$b}[5] = mysql_result($resulting, $b, 'rating');
                ${$comment.$b}[6] = mysql_result($resulting, $b, 'thumbUp');
                ${$comment.$b}[7] = mysql_result($resulting, $b, 'thumbDown');
                ${$comment.$b}[8] = mysql_result($resulting, $b, 'commentID');
                                                $connect = mysql_connect("localhost","root", "");
                                                if (!$connect){ die('Could not connect: ' . mysql_error());}
                                                mysql_select_db("user") or die("Unable to connected to Database." . mysql_error());
                                                $userQuery2 = mysql_query("SELECT * FROM main WHERE id='".${$comment.$b}[0]."'");
                                                while($row = mysql_fetch_array($userQuery2)){
                                                  ${$comment.$b}[0] = $row['username'];
                                                  ${$comment.$b}[4] = $row['id'];
                                                }
            }
            $commentTotal = 0;
            $commentTotalHold = 0;
            $commentTotalFinal = 0;
            if($commentMax > 0){
                 for($c = 0; $c < $commentMax; $c++){
                    $commentTotalHold = $commentTotal + ${$comment.$c}[5];
                    $commentTotal = $commentTotalHold;
                }
                $commentTotalFinal = ($commentTotal/$commentMax);
            }

            $number = $commentTotalFinal*10;
            $numberFinal = number_format($number, 0, ".", "");
           
            


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
        a img {border: none; }
        
        #titleBar{
            opacity:.8;
        }
        
        #title{
            color:white; margin-right:15px; top:-15px; font-family:"PT Sans"; font-size: 12pt; z-index:4; margin-bottom: 5px
        }
        #slider{margin-bottom:10px}
        #demo-frame > div.demo { padding: 10px !important; }
        </style>
        
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.9.1/themes/base/jquery-ui.css" />
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script> 
    <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.9.1/jquery-ui.min.js"></script> 
    <script src="/lightbox/js/lightbox.js"></script>
    <link href="/lightbox/css/lightbox.css" rel="stylesheet" />


        
    <script>
	$(function() {
            $( "#slider" ).slider({
                    value:5,
                    min: 0,
                    max: 10,
                    step: 1,
                    slide: function( event, ui ) { $( "#amount" ).val( "" + ui.value ); }
        });});

        $( "#amount" ).val( "" + $( "#slider" ).slider( "value" ) );
        
        $(document).ready(function(){
            $('.dialogmodal1').dialog({autoOpen :false});
        });
        $(document).ready(function(){
            $('.dialogmodal2').dialog({autoOpen :false});
        });
        $(document).ready(function(){
            $('.dialogmodal3').dialog({autoOpen :false});
        });
        $(document).ready(function(){
            $('.dialogmodal4').dialog({autoOpen :false});
        });
       
        $(function() {
            $( "#dialog:ui-dialog" ).dialog( "destroy" );

            $( ".dialogmodal" ).dialog({
                    height: 140,
                    modal: true
            });
        });
                
        </script>
        
        <div id="container" 
             style="width:998px;
                    position: relative;
                    height: 100%;
                    font-family: 'PT Sans';
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
                
        <div id="leftBorder" style="height:1100px; width:255px; float:left; margin-left:0px; margin-right:-25px; margin-bottom: 20px; font-family:'PT Sans'">
            <?PHP
                         $b = 1;
                         $previous = "previous";
                         $colorPrevious = "colorPrevious";
                         $numbers = range(0,$articleMax);
                         shuffle($numbers);
                         $colorRandom = range(0,16);
                         shuffle($colorRandom);
                         echo '<div id="blocksA">';
                         echo '<div id="image">
                            <img id="loadImage" style="height:170px; width:232px; z-index: 2" src="'.$topic[2].'" alt="Whoa, our bad man.    Please reload this page...">
                                </div>
                                    <div id="table">
                                    <table border="0" style="margin-bottom:10px;">
                                    <tr>
                                    <td>Number of Views</td>
                                    <td>'.$topic[5].'</td>
                                    </tr>
                                    <tr>
                                    <td>Average Rating</td>
                                    <td>'.$numberFinal.'% Positive</td>
                                    </tr>
                                    <tr>
                                    <td></td>
                                    </tr>
                                    </tr>
                                    <tr>
                                    <td>Tagging</td>
                                    </tr>
                                    </table>
                                    <table>
                                    <tr><div style="font-size:10pt">
                                    '.$topic[4].'
                                    </div>
                                    </tr>
                                    <tr>
                                    <td></td>
                                    </tr>
                                    <tr>
                                    <td></td>
                                    </tr>
                                    <tr>
                                    <td></td>
                                    </tr>';
                           if($userCookie == "Guest"){
                              
                           }
                           else{
                               echo '<tr>
                                    <td>Add Tags</td>
                                    </tr>
                                    <tr>
                                    <td><form action="addTagging.php?artID='.$artID.'" method="GET"><textarea name="addTags" rows="5" col="4" ></textarea><input type="submit" style="margin-left:100px" value="Add Tags"/></form></td>
                                    </tr>';
                           }
                                    
                        echo            '</table>
                                    </div>
                                 <div>
                             </div>';
                         
                         echo '</div>
                             </div>';
            ?>
        </div>
        
        <div id="leftBorder" style="height:1000px; width:700px; float:left; margin-left: -55px; margin: 5px; margin-bottom: 20px; font-family:'PT Sans'; font-size:12pt; margin-left: 50px"> <div style="font-size:16pt"><?PHP echo $topic[1]?></div>
            
            <?PHP
                echo '<div style="height:150px">'.$topic[3].'</div>';
                $t=0;
                if(isset (${$comment.$t}[0])){
                        for($t=0; $t< $commentMax; $t++){
                        echo '<div style="margin: 5px; float:right; width:75%">'.${$comment.$t}[1].'</div>';
                            if (${$comment.$t}[3]>0){
                               //echo '<div><a class="thumbnail"><img style="width:12%; height:12%; margin-top:5px; float:left; margin-left:5px; margin-bottom:5px;" src="./images/0'.${$comment.$t}[3].'.jpg" class="thumbnail"/></a></div>';
                               echo '<a href="./images/0'.${$comment.$t}[3].'.jpg" rel="lightbox" title="my caption"><img style="width:18%; height:12%; margin-top:5px; float:left; margin-left:5px; margin-bottom:5px;" src="./images/0'.${$comment.$t}[3].'.jpg" class="thumbnail"/></a>';
                               //echo '<div id="dialogmodal'.$t.'"><class="dialogmodal'.$t.' id="dialogmodal'.$t.'" title="Basic modal dialog" img src="./images/0'.${$comment.$t}[3].'.jpg"/></div>';
                            }  else {
                                
                            }
                            
                            if (${$comment.$t}[4] == $userCookie){
                                echo '<div style=" background-color:#C9C9C9; clear:both; margin-top: 5px; margin-bottom: 5px; text-align:right; margin-right:15px; font-size:8pt"><a>Thumbs Up : '.${$comment.$t}[6].'</a><a style="color:#C9C9C9">_______</a> <a>Thumbs Down : '.${$comment.$t}[7].'</a><a style="color:#C9C9C9">____</a>    <a style="color:#C9C9C9">____</a> <a>Rated : '.${$comment.$t}[2].'  </a><a style="color:#C9C9C9">_______</a> Comment By : '.${$comment.$t}[0].' <a style="color:#C9C9C9">______</a><img style="width:20px; height:25px" src="./images/userimages/'.${$comment.$t}[4].'.jpg"/></div>';
                            }else{
                                echo '<div style="background-color:#C9C9C9; clear:both; margin-top: 5px; margin-bottom: 5px; text-align:right; margin-right:15px; font-size:8pt"><a>Thumbs Up : '.${$comment.$t}[6].'</a><a style="color:#C9C9C9">_______</a> <a>Thumbs Down : '.${$comment.$t}[7].'</a><a style="color:#C9C9C9">____</a>   <a href="likeComment.php?artID='.$artID.'&commentID='.${$comment.$t}[8].'&authorID='.${$comment.$t}[4].'">Like Comment</a>  <a style="color:#C9C9C9">____</a> <a href="dislikeComment.php?artID='.$artID.'&commentID='.${$comment.$t}[8].'&authorID='.${$comment.$t}[4].'"">Dislike Comment</a> <a style="color:#C9C9C9">____</a> <a>Rated : '.${$comment.$t}[2].'  </a><a style="color:#C9C9C9">_______</a> Comment By : '.${$comment.$t}[0].' <a style="color:#C9C9C9">______</a><img style="width:20px; height:25px" src="./images/userimages/'.${$comment.$t}[4].'.jpg"/></div>';
                            }
                        
                        }
                }
                if($userCookie == "Guest"){
                    
                }else{                  
                    echo '<div id="addComment" style="margin-left: 15px; margin-top:20px; margin-bottom:25px">
                        <form action="commentCreate.php" method="post" enctype="multipart/form-data">
                        <div id="comment"><textarea name="comment" id="comment" cols="80" rows="5"></textarea></div>
                        <div id="file" style="width:100%; float:right">Add Image to Comment : <input type="file" name="filename" id="file" /></div>
                        <div class="demo">
                        <p>
                                <label for="ranking">Rank It : </label>
                                <input type="text" name="amount" id="amount" style=" margin-top:10px; border:0; color:#317661;" />
                        </p>

                        <div id="slider" name="slider" style="margin-bottom:10px; width:45%"></div>
                        
                        </div>
                        
                        <div style="margin-left:545px; margin-top: 10px"><input type="submit" value="Submit Comment" style="align:right"/></div>
                        </form>
                      </div>';
                     }
            ?>

        </div>
<!--        <div id="footer" style="background-color:#FFA500;clear:both;text-align:center;font-family:'PT Sans'; font-size:8pt;">Carpe Diem!</div>
            <div id="underfooter" style="clear:both;text-align:center;font-family:'PT Sans'; font-size:8pt; text-align:center">This is where the legal disclaimer and all that junk goes.</div>-->
        </div>
    </body>
</html>
