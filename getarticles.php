<?php
session_start();

$dbhost = 'localhost';
$dbuser = 'root';
$dbpassword = 'G0@tCh33$3M00nC00k!3';
$dbname = 'readingtree';

$userid_to_query = $_SESSION['filteredemail'];

//echo "You got this far: getarticles.php";

//$filteredemail = $_SESSION['filteredemail'];
//echo "userid: " . $filteredemail;

//$userid_to_query = "pirunthanatgmaildotcom";

$db = new mysqli($dbhost, $dbuser, $dbpassword, $dbname);

if($db->connect_errno > 0){
    die('Unable to connect to database @ getarticles.php: [' . $db->connect_error . ']');
}

$sql = <<<SQL
    SELECT *
    FROM $userid_to_query

SQL;

if(!$result = $db->query($sql)){
    die('Line 31 in getarticles.php. Could not query $userid_to_query=' . $userid_to_query . '. There was an error running the query: [' . $db->error . ']');
}

/*
echo '<p class=pagetitle align=center>Project Reading List</p>';
echo '<p class=savelink align=center><a class=savelink href=getlink.php>Add a link</a> </p>';
*/

//include header page
include 'header.php';

echo 'Logged in as :' . $userid_to_query;

//include save link
//TO DO: Make this a separate page and use include to make it dynamic
echo '<p class=savelink align=center><a class=savelink href=getlink.php>Add a link</a> </p>';

echo '<p align=center><table width = 1000px cellpadding=5 cellspacing=5><tr>';

$cellcounter = 0;
$colourwheel = array(
    1 => "violet",
    2 => "darksalmon",
    3 => "lightpink",
    4 => "tomato",
    5 => "palegreen",
    6 => "cornflowerblue",
    7 => "lightseagreen",
    8 => "lightblue",
    9 => "limegreen",
    10 => "orchid",
);

while($row = $result->fetch_assoc()){
    //print title

    //generate random number to pick random colour
    $colourpicker = rand(1,10);
    echo '<td width=250px height=250px align=center bgcolor=' . $colourwheel[$colourpicker] .'>';
    echo '<table width=250px><tr><td width=250px height=200px>';
    echo '<a href=' . $row['linkurl'] . ' target="_blank">';
    echo '<span class="linkboxspan">';
    //print title and make it a link

    //check character length of title so it fits within the box
    $rawtitle = $row['linktitle'];

    if (strpos($rawtitle, " ") > "18") {
        $title = substr($rawtitle,0,15);
        $title .= "...";
    } else {
        $title = $rawtitle;
    }

    echo '<p class=linktitle>' . $title . '</p></span></a><td/>';
    //print date added
    echo '</tr><td width=250px height=25px align=center><p class=linkdate>' . $row['linkdate'] . '</p></td></tr>';
    //print article options: delete
    echo '</tr><td width=250px height=25px align=center><p class=linkoptions><a href=deletearticles.php?linkid=' . $row['linkid'] . '>delete</a></p></td></tr></table>';

    //max number of articles spanning vertically is 4
    //if counter reaches 4, then close the row and reset counter to 0
    $cellcounter = $cellcounter+1;
    if ($cellcounter == 4){
        echo '</tr><tr>';
        $cellcounter = 0;
    }
}

echo '</td></tr></table></p>';

?>

<p class=savelink align=center><a class=savelink href=getlink.php>Add a link</a> </p>

</body>
</html>