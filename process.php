<?php
session_start();
/*
$idtoken = $_POST["idtoken"];
$email = $_POST["email"];

echo $email;
*/

$dbhost = 'localhost';
$dbuser = 'root';
$dbpassword = 'G0@tCh33$3M00nC00k!3';
$dbname = 'projectreadinglist';

//table to check
$table_to_query = 'users';

$articledb = 'readingtree';

//login to database; new database instance called db
$db = new mysqli($dbhost, $dbuser, $dbpassword, $dbname);

if($db->connect_errno > 0){
    die('Process.php: Unable to connect to database [' . $db->connect_error . ']');
}

//get user info from POST
$idtoken = $_POST["idtoken"];
$email = $_POST["email"];

$query = mysqli_query($db, "SELECT * FROM $table_to_query WHERE email='".$email."'");

if(mysqli_num_rows($query) > 0){
    //user already exists
    echo "email already exists";

    $newemail1 = str_replace("@", "at", $email);
    $newemail2 = str_replace(".", "dot", $newemail1);

    $_SESSION['idtoken'] = $idtoken;
    $_SESSION['rawemail'] = $email;
    $_SESSION['filteredemail'] = $newemail2;

    //echo "You got this far: process.php";

    die;

}else{
    //user doesn't yet exist
    echo "email does not exist";

    //add entry to user table
    $saveuser = "INSERT INTO $table_to_query (email) VALUES(?)";
    $statement = $db->prepare($saveuser);
    //bind parameters for markers, where (s = string, i = integer, d = double,  b = blob)
    $statement->bind_param('s', $email);

    $conn = new mysqli($dbhost, $dbuser, $dbpassword, $articledb);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    //create reading list user table

    $newemail1 = str_replace("@", "at", $email);
    $newemail2 = str_replace(".", "dot", $newemail1);

    $sql = "CREATE TABLE `" . $newemail2 ."` (
      linkid INT(20) UNSIGNED PRIMARY KEY, 
      linktitle TEXT NOT NULL,
      linkurl TEXT NOT NULL,
      linkdate DATE NOT NULL
    )";

    if ($conn->query($sql) === TRUE) {
        echo "Table created successfully";
    } else {
        echo "Error creating table: " . $conn->error;
    }

    //start new session for the user
    $_SESSION['idtoken'] = $idtoken;
    $_SESSION['rawemail'] = $email;
    $_SESSION['filteredemail'] = $newemail2;

    if($statement->execute()){
        print 'Success! ID of last inserted record is : ' .$statement->insert_id .'<br />';

        die;
    }else{
        die('Error : ('. $db->errno .') '. $db->error);
    }
    $statement->close();


    if (!mysqli_query($db,$query))
    {
        die('Error: ' . mysqli_error($db));
    }
}

?>



