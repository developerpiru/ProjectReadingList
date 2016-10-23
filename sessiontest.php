<?php
/**
 * Created by PhpStorm.
 * User: Piru
 * Date: 10/22/2016
 * Time: 7:43 PM
 */

session_start();

$_SESSION['name'] = "Piru";
$_SESSION['colour'] = "red";

echo $_SESSION['name'];
echo $_SESSION['colour'];

?>

<a href="getarticles.php">test</a>
