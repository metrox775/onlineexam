<?php
session_start();
 
 $time = $_SESSION['examineeTimeSession']['time'];
 $date = $_SESSION['examineeTimeSession']['date'];
 
 //echo $time."<br>";
 echo $date."<br>";

$systemdate =date("Y-m-d");

echo $systemdate."<br>";
if ($systemdate == $date)
{
	echo "are metch with computer";
}
else
{
	echo "not metch with computer";
	echo "<script>alert('you exam at".$date."')</script>";
}

?>