<html>
<head>
    <title>Connecting MySQL Server</title>
</head>
<body>

<?php

$dbhost = 'localhost';
$dbuser = 'root';
$dbpassword = 'G0@tCh33$3M00nC00k!3';
$dbname = 'allusers';

$db = new mysqli($dbhost, $dbuser, $dbpassword, $dbname);

if($db->connect_errno > 0){
    die('Unable to connect to database [' . $db->connect_error . ']');
}

$sql = <<<SQL
    SELECT *
    FROM `usertable`
    WHERE `userid` = 1 
SQL;

if(!$result = $db->query($sql)){
    die('There was an error running the query [' . $db->error . ']');
}

while($row = $result->fetch_assoc()){
    echo $row['nameofuser'] . '<br />';
}

?>

</body>
</html>