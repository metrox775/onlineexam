 <?php 
    $examId = $_GET['id'];

    $_SESSION['test_id']=$examId;
    $selExam = $conn->query("SELECT * FROM exam_tbl WHERE ex_id='$examId' ")->fetch(PDO::FETCH_ASSOC);

 ?>

<div class="app-main__outer">
<div class="app-main__inner">
    <div id="refreshData">
            
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
            </div>
        </div>  
        <div class="row col-md-12">
        	<h1 class="text-primary">RESULT'S</h1>
        </div>

        <div class="row col-md-6 float-left">
        	<div class="main-card mb-3 card">
                <div class="card-body">
                	<h5 class="card-title">Your Answer's</h5>
        			<table class="align-middle mb-0 table table-borderless table-striped table-hover" id="tableList">
                    <?php 
                    	$selQuest = $conn->query("SELECT * FROM exam_question_tbl eqt INNER JOIN exam_answers ea ON eqt.eqt_id = ea.quest_id WHERE eqt.exam_id='$examId' AND ea.axmne_id='$exmneId' AND ea.exans_status='new' ");
                    	$i = 1;
                    	while ($selQuestRow = $selQuest->fetch(PDO::FETCH_ASSOC)) { ?>
                    		<tr>
                    			<td>
                    				<b><p><?php echo $i++; ?> .) <?php echo $selQuestRow['exam_question']; ?></p></b>
                    				<label class="pl-4 text-success">
                    					Answer : 
                    					<?php 
                    						if($selQuestRow['exam_answer'] != $selQuestRow['exans_answer'])
                    						{ ?>
                    							<span style="color:red"><?php echo $selQuestRow['exans_answer']; ?></span>
                    						<?PHP }
                    						else
                    						{ ?>
                    							<span class="text-success"><?php echo $selQuestRow['exans_answer']; ?></span>
                    						<?php }
                    					 ?>
                    				</label>
                    			</td>
                    		</tr>
                    	<?php }
                     ?>
	                 </table>
                </div>
            </div>
        </div>

        <div class="col-md-6 float-left">
        	<div class="col-md-6 float-left">
        	<div class="card mb-3 widget-content bg-night-fade">
                <div class="widget-content-wrapper text-white">
                    <div class="widget-content-left">
                        <div class="widget-heading"><h5>Score</h5></div>
                        <div class="widget-subheading" style="color: transparent;">/</div>
                    </div>
                    <div class="widget-content-right">
                        <div class="widget-numbers text-white">
                            <?php 
                                $selScore = $conn->query("SELECT * FROM exam_question_tbl eqt INNER JOIN exam_answers ea ON eqt.eqt_id = ea.quest_id AND eqt.exam_answer = ea.exans_answer  WHERE ea.axmne_id='$exmneId' AND ea.exam_id='$examId' AND ea.exans_status='new' ");
                            ?>
                            <span>
                                <?php echo $selScore->rowCount(); ?>
                                <?php 
                                    $over  = $selExam['ex_questlimit_display'];
                                 ?>
                            </span> / <?php echo $over; ?>
                        </div>
                    </div>
                </div>
            </div>
        	</div>

            <div class="col-md-6 float-left">
            <div class="card mb-3 widget-content bg-happy-green">
                <div class="widget-content-wrapper text-white">
                    <div class="widget-content-left">
                        <div class="widget-heading"><h5>Percentage</h5></div>
                        <div class="widget-subheading" style="color: transparent;">/</div>
                        </div>
                        <div class="widget-content-right">
                        <div class="widget-numbers text-white">
                            <?php 
                                $selScore = $conn->query("SELECT * FROM exam_question_tbl eqt INNER JOIN exam_answers ea ON eqt.eqt_id = ea.quest_id AND eqt.exam_answer = ea.exans_answer  WHERE ea.axmne_id='$exmneId' AND ea.exam_id='$examId' AND ea.exans_status='new' ");
                            ?>
                            <span>
                                <?php 
                                    $score = $selScore->rowCount();
                                    $ans = $score / $over * 100;
                                    echo "$ans";
                                    $ans1 = $ans."%";

                                    echo "%";
                                    
                                 ?>
                            </span> 
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </div>


    </div>
</div>
<?php                          

                                             if($ans >= 90)
                                             {
                                                $grade='A1';
                                             } 
                                             else if($ans >= 80){
                                                $grade='A2';
                                             }
                                             else if($ans >= 70){
                                                $grade='B1';
                                             }
                                             else if($ans >= 60){
                                                $grade='B2';
                                             }
                                             else if($ans >= 50){
                                                $grade='C1';
                                             }
                                             else if($ans >= 40){
                                                $grade='C2';
                                             }
                                             else if($ans >= 33){
                                                $grade='E';
                                             }
                                             else{
                                                $grade='FF';
                                             }
                                           
   $exmne_id = $_SESSION['examineeSession']['exmne_id'];

    // $selExAttempt = $conn->query("SELECT * FROM exam_attempt WHERE exmne_id='$exmne_id' AND exam_id='$examId'  ");
    //   print_r($selExAttempt);
    // if($selExAttempt->rowCount() > 0)
    // {
           
    // }
    // else{
      $marks=$selScore->rowCount(); 
     $selstatus = $conn->query("SELECT examat_id FROM exam_attempt WHERE  exmne_id='$exmne_id' AND exam_id='$examId'");

     $array_examat_id=$selstatus->fetch(PDO::FETCH_ASSOC);
     $examat_resultid=$array_examat_id['examat_id'];
    
     if(isset($examat_resultid))
     {    
     echo "<script>alert('It's Working);</script>";
     $user_id=$_SESSION['examineeSession']['exmne_id'];
     $resultinsert=$conn->query("INSERT INTO `result`(`ex_id`, `examat_resultid` ,`exmne_id`, `score`, `percentage`, `grade`) VALUES('$examId',$examat_resultid,'$user_id','$marks','$ans','$grade')");

     }
    
    // // }     
    //               $temp=$selScore->rowCount();
    //         $_SESSION['over']=$temp;
    //          $_SESSION['ans']=$ans;
    //           $_SESSION['grade']=$grade;


?>