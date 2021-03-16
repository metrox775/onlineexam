<?php
    
    ini_set("display_errors", "1");
        error_reporting(E_ALL);
  
    include 'Connection.php';
    //echo "model";
    $con1=new Connection();
    $conn=$con1->mkConnection();
    
?>