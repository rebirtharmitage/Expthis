<?php
require_once 'key.php';
$xmlDoc=new DOMDocument();
$xmlDoc->load("links.xml");

//$x=$xmlDoc->getElementsByTagName('link');

//get the q parameter from URL
$q=$_GET["q"];

//lookup all links from the xml file if length of q>0
if (strlen($q)>0)
{
$hint="";
$link = array();
for($i=0; $i<1; $i++)
  {
    $db_server = mysql_connect($db_hostname, $db_username);
    if (!$db_server) die("Unable to connect to host MySQL : " . mysql_error());
    mysql_select_db($db_database) or die("Unable to connect to host Database : " .  mysql_error());
    
    $result = mysql_query("SELECT * FROM usernames WHERE username='".$q."'");
    $rows = mysql_num_rows($result);
    while($row = mysql_fetch_array($result)){
            $link[$i] = $row[$i];
    }
    
    if ($hint==""){
        if ($link == null){
            $hint = "";
        }
        else{
           $hint = $link[0]; 
        }
    }
    else{
        $hint = $hint . $link[1];
    }
  }
}

// Set output to "no suggestion" if no hint were found
// or to the correct values
if ($hint=="")
  {
  $response="Username Available";
  }
else
  {
  $response="Username is already taken.";
  }

//output the response
echo $response;
?>
