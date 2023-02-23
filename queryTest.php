<?php


ini_set('display_errors', 1);
require_once 'vendor/autoload.php';

// Connect to the database
$servername = "localhost";
$username = "whatever";
$password = "Rr3RzXy97G3u6T8";
$dbname = "testme";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$start = microtime(true);
if ($result = $conn->query("SELECT count(*) FROM users")) {
  echo "Select Count of all " . $result -> num_rows;
  // Free result set
  $result -> free_result();
}
$time_elapsed_secs = microtime(true) - $start;
echo "<br>Time elapsed" . $time_elapsed_secs;

$start = microtime(true);
if ($result = $conn->query("SELECT * FROM users where id=22333 ")) {
  echo "<br>Individual Record: Returned rows are: " . $result -> num_rows;
  // Free result set
  $result -> free_result();
}
$time_elapsed_secs = microtime(true) - $start;
echo "<br>Time elapsed" . $time_elapsed_secs;


$start = microtime(true);
if ($result = $conn->query("SELECT count(*) FROM users where name like '%John%' ")) {
  echo "<br>USING LIKE Returned rows are: " . $result -> num_rows;
  // Free result set
  $result -> free_result();
}
$time_elapsed_secs = microtime(true) - $start;
echo "<br>Time elapsed" . $time_elapsed_secs;


$start = microtime(true);
if ($result = $conn->query("SELECT count(*) FROM users WHERE MATCH(name) AGAINST('*john*' IN BOOLEAN MODE)")) {
  echo "<br>USING FULL TEXT SEARCH: Returned rows are: " . $result -> num_rows;
  // Free result set
  $result -> free_result();
}
$time_elapsed_secs = microtime(true) - $start;
echo "<br>Time elapsed" . $time_elapsed_secs;

//SELECT * FROM users WHERE MATCH(name)
//AGAINST('john' IN NATURAL LANGUAGE MODE)
 
echo "\n";
// Close the statement and the database connection
$conn->close();
