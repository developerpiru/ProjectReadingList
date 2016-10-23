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

$userid_to_query = $_SESSION['filteredemail'];
//$userid_to_query = 'userid_1';

$db = new mysqli($dbhost, $dbuser, $dbpassword, $dbname);

if($db->connect_errno > 0){
    die('Unable to connect to database [' . $db->connect_error . ']');
}

$linkid = $_GET["linkid"];

//delete article from database
$results = $db->query("DELETE FROM $userid_to_query WHERE linkid = $linkid");

if($results){
    header('Location: /getarticles.php');
    die;
}else{
    print 'Error : ('. $db->errno .') '. $db->error;
}

?>

</body>
</html>