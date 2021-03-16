<?php

ini_set("display_errors", "1");
error_reporting(E_ALL);

$servername = "localhost";
$username = "root";
$password = "root";

class Connection
    {
 
 function mkConnection()
        {
        	echo "function call";
try {
  $conn = new PDO("mysql:host=localhost;dbname=online_examination","root","root");

  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  echo "Connected successfully";
  return $conn;

} 
catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}
}
}


?>