<html>
<head>
    <title>Connecting MySQL Server</title>
    <link rel="stylesheet" type="text/css" href="defaultStyleSheet.css">
</head>
<body>

<?php

session_start();

$dbhost = 'localhost';
$dbuser = 'root';
$dbpassword = 'G0@tCh33$3M00nC00k!3';
$dbname = 'readingtree';

//which userid database to store articles under; string
$userid_to_query = $_SESSION['filteredemail'];
echo $userid_to_query;
//$userid_to_query = 'userid_1';

//login to database; new database instance called db
$db = new mysqli($dbhost, $dbuser, $dbpassword, $dbname);

if($db->connect_errno > 0){
    die('Savearticles.ca: Unable to connect to database [' . $db->connect_error . ']');
}

//get article title and link string from HTTP POST method
$linktitle = $_POST["title"];
$linkurl  = $_POST["link"];
$linkid = time();

//Format date
date_default_timezone_set('America/Toronto');
$linkdate = date('Y-m-d');

//store values in db
$query = "INSERT INTO $userid_to_query (linkid, linktitle, linkurl, linkdate) VALUES(?, ?, ?, ?)";
$statement = $db->prepare($query);
//bind parameters for markers, where (s = string, i = integer, d = double,  b = blob)
$statement->bind_param('isss', $linkid, $linktitle, $linkurl , $linkdate);

if($statement->execute()){
    //print 'Success! ID of last inserted record is : ' .$statement->insert_id .'<br />';
    //redirect to main page after successfully saving articles
    header('Location: /articlesavedsuccess.html');
    die;
}else{
    die('Error : ('. $db->errno .') '. $db->error);
}
$statement->close();


?>

</body>
</html>