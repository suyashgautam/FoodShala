<?php
// $db_host     = "localhost";
// $db_user     = "root";
// $db_password = "";
// $db_name     = "foodshala_db";

// // Create Connection
// $conn = new mysqli($db_host, $db_user, $db_password, $db_name);

// // Check Connection
// if ($conn->connect_error) {
//  die("connection failed");
//}
?>
<?php
//Get Heroku ClearDB connection information
$cleardb_url = parse_url(getenv("CLEARDB_DATABASE_URL"));
$cleardb_server = $cleardb_url["host"];
$cleardb_username = $cleardb_url["user"];
$cleardb_password = $cleardb_url["pass"];
$cleardb_db = substr($cleardb_url["path"],1);
$active_group = 'default';
$query_builder = TRUE;
// Connect to DB
$conn = mysqli_connect($cleardb_server, $cleardb_username, $cleardb_password, $cleardb_db);
?>