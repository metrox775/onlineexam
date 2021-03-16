<?php


ini_set("display_errors", "1");
        error_reporting(E_ALL);
 
  $systemdate =date("Y-m-d");

  $systemtime = date("H:i");
  echo $systemtime;

$exmneId = $_SESSION['examineeSession']['exmne_id'];

// Select Data sa nilogin nga examinee
$selExmneeData = $conn->query("SELECT * FROM examinee_tbl WHERE exmne_id='$exmneId' ")->fetch(PDO::FETCH_ASSOC);
$exmneCourse =  $selExmneeData['department_id'];


        
// Select and tanang exam depende sa course nga ni login 
$selExam = $conn->query("SELECT * FROM exam_tbl WHERE department_id='$exmneCourse' ORDER BY ex_id DESC ");

$selExam2 = $conn->query("SELECT * FROM exam_tbl WHERE department_id='$exmneCourse' AND ex_date='$systemdate' AND ex_time='$systemtime'  ORDER BY ex_id DESC ");

$selAccRow = $selExam->fetch(PDO::FETCH_ASSOC);


 if($selExam->rowCount() > 0)
 {
	 session_start();
   	$_SESSION['examineeTimeSession'] = array(
   	 'time' => $selAccRow['ex_time'],
   	 'date'=> $selAccRow['ex_date'],
   	);

  	 
 }





// echo json_encode($res);
  
//

 ?>