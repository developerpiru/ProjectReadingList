<?php
/**
 * Created by PhpStorm.
 * User: Piru
 * Date: 9/5/2016
 * Time: 9:38 PM
 */

include 'header.php';

// include snoopy library
require('Snoopy.class.php');
// initialize snoopy object
$snoopy = new Snoopy;

//$url = "http://www.theglobeandmail.com/news/world/hillary-clintons-canadian-warrior-a-conversation-with-jennifergranholm/article31745510/";
$linkid = $_GET["linkid"];

$dbhost = 'localhost';
$dbuser = 'root';
$dbpassword = 'G0@tCh33$3M00nC00k!3';
$dbname = 'readingtree';

$userid_to_query = 'userid_1';

$db = new mysqli($dbhost, $dbuser, $dbpassword, $dbname);

if($db->connect_errno > 0){
    die('Unable to connect to database [' . $db->connect_error . ']');
}

$sql = <<<SQL
    SELECT *
    FROM $userid_to_query
    WHERE linkid = $linkid 
SQL;

if(!$result = $db->query($sql)){
    die('There was an error running the query [' . $db->error . ']');
}

$row = $result->fetch_assoc();

$url = $row['linkurl'];


// read webpage content
$snoopy->fetch($url);
// save it to $lines_string
$lines_string = $snoopy->results;
//output, you can also save it locally on the server
echo $lines_string;


?>
