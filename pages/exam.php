<script type="text/javascript" >
function preventBack(){window.history.forward();}
setTimeout("preventBack()", 0);
window.onunload=function(){null};
</script>

<?php

$examId = $_GET['id'];
$selExam = $conn->query("SELECT * FROM exam_tbl WHERE ex_id='$examId' ")->fetch(PDO::FETCH_ASSOC);
$selExamTimeLimit = $selExam['ex_time_limit'];
$exDisplayLimit = $selExam['ex_questlimit_display'];
?>


<div class="app-main__outer">
<div class="app-main__inner">
<div class="col-md-12">
<div class="app-page-title">
<div class="page-title-wrapper">
<div class="page-title-heading">
<div>
<?php echo $selExam['ex_title']; ?>
<div class="page-title-subheading">
<?php echo $selExam['ex_description']; ?>
</div>
</div>
</div>
<div class="page-title-actions mr-5" style="font-size: 20px;">
<form name="cd">
<input type="hidden" name="" id="timeExamLimit" value="<?php echo $selExamTimeLimit; ?>">
<label>Remaining Time : </label>
<p style="border:none;background-color: transparent;color:blue;font-size: 25px;" name="disp" type="text" class="clock" id="timerrr" value="00:00" size="5" readonly="true"></p>
</form>
</div>
</div>
</div>
</div>

<div class="col-md-12 p-0 mb-4">
<form method="post" id="submitAnswerFrm">
<input type="hidden" name="exam_id" id="exam_id" value="<?php echo $examId; ?>">
<input type="hidden" name="examAction" id="examAction" >
<table class="align-middle mb-0 table table-borderless table-striped table-hover" id="tableList">
<?php
$selQuest = $conn->query("SELECT * FROM exam_question_tbl WHERE exam_id='$examId' ORDER BY rand() LIMIT $exDisplayLimit ");
if($selQuest->rowCount() > 0)
{
$i = 1;
while ($selQuestRow = $selQuest->fetch(PDO::FETCH_ASSOC)) { ?>
<?php $questId = $selQuestRow['eqt_id'];


?>

<tr>
<td>
<p><b><?php echo $i++ ; ?> .) <?php echo $selQuestRow['exam_question']; ?></b></p>
<div class="col-md-4 float-left">
<div class="form-group pl-4 ">
<input name="answer[<?php echo $questId; ?>][correct]" value="<?php echo $selQuestRow['exam_ch1']; ?>" class="form-check-input" type="radio" value="" id="invalidCheck" required >

<label class="form-check-label" for="invalidCheck">
<?php echo $selQuestRow['exam_ch1']; ?>
</label>
</div>

<div class="form-group pl-4">
<input name="answer[<?php echo $questId; ?>][correct]" value="<?php echo $selQuestRow['exam_ch2']; ?>" class="form-check-input" type="radio" value="" id="invalidCheck" required >

<label class="form-check-label" for="invalidCheck">
<?php echo $selQuestRow['exam_ch2']; ?>
</label>
</div>
</div>
<div class="col-md-8 float-left">
<div class="form-group pl-4">
<input name="answer[<?php echo $questId; ?>][correct]" value="<?php echo $selQuestRow['exam_ch3']; ?>" class="form-check-input" type="radio" value="" id="invalidCheck" required >

<label class="form-check-label" for="invalidCheck">
<?php echo $selQuestRow['exam_ch3']; ?>
</label>
</div>

<div class="form-group pl-4">
<input name="answer[<?php echo $questId; ?>][correct]" value="<?php echo $selQuestRow['exam_ch4']; ?>" class="form-check-input" type="radio" value="" id="invalidCheck" required >

<label class="form-check-label" for="invalidCheck">
<?php echo $selQuestRow['exam_ch4']; ?>
</label>
</div>
</div>
</div>


</td>
</tr>

<?php }
?>
<tr>
<td style="padding: 20px;">
<button type="button" class="btn btn-xlg btn-warning p-3 pl-4 pr-4" id="resetExamFrm">Reset</button>
<input name="submit" type="submit" value="Submit" class="btn btn-xlg btn-primary p-3 pl-4 pr-4 float-right" id="submitAnswerFrmBtn">
</td>
</tr>

<?php
}
else
{ ?>
<b>No question at this moment</b>
<?php }
?>
</table>

</form>
</div>
</div>

<?php
$selTime = $conn->query("SELECT * FROM exam_tbl WHERE ex_id='$examId' ");

  if($selTime->rowCount() > 0)
  {
      $i = 1;
      while ($selTimeRow = $selTime->fetch(PDO::FETCH_ASSOC)) {
      $exmtimelimit = $selTimeRow['ex_time_limit'];
      $exmdate = $selTimeRow['ex_date'];

      $date = date_create($exmdate);
      $date1 = date_format($date,"M  d, Y");
        // echo "Timer limit".$exmtimelimit;

    }
  }
?> 
<input type="hidden" id = "time1" value ="<?php echo $exmtimelimit; ?>">
<input type="hidden" id = "date1" value ="<?php echo $date1; ?>">
<script>
//var t="";
  var x = document.getElementById("time1").value;
  console.log(x);

  var d = document.getElementById("date1").value
  console.log(d);
   var s= " ";
  var m = d.concat(s,x);
// Set the date we're counting down to
  console.log(m);
var countDownDate = new Date(m).getTime();

console.log(countDownDate);

// Update the count down every 1 second
var x = setInterval(function() {

  // Get today's date and time
  var now = new Date().getTime();

  // Find the distance between now and the count down date
  var distance = countDownDate - now;

  // Time calculations for days, hours, minutes and seconds
  var days = Math.floor(distance / (1000 * 60 * 60 * 24));
  var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
  var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
  var seconds = Math.floor((distance % (1000 * 60)) / 1000);

  // Display the result in the element with id="demo"
  document.getElementById("timerrr").innerHTML =
minutes + "m " + seconds + "s ";

//If the count down is finished, write some text
//document.getElementById("timerrr").innerHTML = "EXPIRED";

    if((minutes == 0) && (seconds == 0)) {
        console.log("submitted");
         $('#examAction').val("autoSubmit");
        $('#submitAnswerFrm').submit();
         clearInterval(x);
    } 
    else {
    //cd = setTimeout("redo()",1000);
    }

    }, 1000);
</script>



<!-- <script type="text/javascript">

var countDownDate = new Date().get("Mar 15, 2021 10:00");

console.log(countDownDate);
var x = setInterval(function() {

var now = new Date().getTime();

var distance = now - countDownDate ;

var days = Math.floor(distance / (1000 60 60 * 24));
var hours = Math.floor((distance % (1000 60 60 24)) / (1000 60 * 60));
var minutes = Math.floor((distance % (1000 60 60)) / (1000 * 60));
var seconds = Math.floor((distance % (1000 * 60)) / 1000);


console.log(minutes);
console.log(seconds);




** Display the result in the element with id="demo"
document.getElementById("timerrr").innerHTML =
minutes + "m " + seconds + "s ";

** If the count down is finished, write some text
**document.getElementById("timerrr").innerHTML = "EXPIRED";
if((minutes == 0) && (seconds == 0)) {
    console.log("submitted");
    clearInterval(x);
    $('#examAction').val("autoSubmit");
    $('#submitAnswerFrm').submit();
} 
else {
    **cd = setTimeout("redo()",1000);
}

}, 1000);




</script> -->

<!-- <script type="text/javascript">
document.getElementById("timerrr").innerHTML = "Hello";
</script> -->