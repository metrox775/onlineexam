<?php 

$host = "localhost";
$user = "root";
$pass = "root";
$db   = "online_examination";
$conn = null;

try {
  $conn = new PDO("mysql:host={$host};dbname={$db};",$user,$pass);
} catch (Exception $e) {
  
}


 ?>