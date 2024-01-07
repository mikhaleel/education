<div align="center">
<?php 
$matno = $col['matno'];
$the_stu_result = $pdo->prepare("SELECT `id` FROM `results` WHERE `matno` = ? && (`points` = 0 || `points` = '')");
$the_stu_result->execute([$col['matno']]);
$rem = $the_stu_result->rowCount();
//$result = $the_stu_result->fetch(PDO::FETCH_ASSOC);
// {  	
//     $rem++;
   //$reslt = $result['grade'];
// }
    if(($semester == 2) && ($level == "ND2" || $level == "HND2" || $level == "DIP2"))
    { // this is final year remarks
        if(($rem >= 1)){ // check if the student has deficiency
        echo "";
        }else
        {    //final Remarks for non deficient Students
            if(($gpa < 1.5)||($ccgpa <= 1.99))
            {
                echo   $remarks =  "FAIL";
            }
            else
            {
                if ($ccgpa >= 1.5 and $ccgpa <= 2.49){
                    echo    $remarks = "PASS";
                    }
                    else
                        if ($ccgpa >= 2.5 and $ccgpa <= 2.99){
                            echo    $remarks = "LOWER CREDIT";
                    }
                    else
                        if ($ccgpa >= 3.0 and $ccgpa <= 3.49){
                            echo $remarks = "UPPER CREDIT";
                        }
                        else
                            if ($ccgpa >= 3.5 and $ccgpa <= 4.0){
                                echo  $remarks = "DISTINCTION";
                            }
            }			
            // $remarks;
         //echo   $semester. $level;
         //show confirmation buton ?>
			<form name="confirmation"method="post">
			    <input name="ccgpa" value="<?php echo $ccgpa;?>" type="hidden">
			    <input name="course_study" value="<?php echo $_REQUEST['programme'];?>" type="hidden">
			    <input name="matno" value="<?php echo $col['matno'];?>" type="hidden">
			    <input name="grad_name" value="<?php echo $rows_chk['names'];?>" type="hidden">
			   <?php $csd_name = get_colschdept($pdo, $allrows["dept_id"]);?>
			    <input name="school" value="<?php echo $csd_name['school'];?>" type="hidden">
			    <input name="college" value="<?php echo $csd_name['college'];?>" type="hidden">
			    <input name="dept" value="<?php echo $csd_name['dept'];?>" type="hidden">
			    <input name="class_grad" value="<?php echo $remarks;?>" type="hidden">
			    <input name="session" value="<?php echo $session;?>" type="hidden">
			    <!--<input type="submit" name="dconfirmbtn" value="Confirm" class="btn btn-primary m-t-15 waves-effect">-->
			</form>
			<?php 
		// end of show confirmation button
        }	
    }
    else
    {
    //     if(($rem>=1 )&&($reslt=="PEND")){
    //         echo "PENDING"; 
    // // }elseif($rem>=1 && $msnc>=1){
    //     }
    //     else
        if($rem >= 1){

        if(($ccgpa <= 1.99)&&($semester == 2)){
        echo "PROB";
        }elseif(($gpa < 1.5)||($ccgpa <= 1.5)&&($semester >= 1)){
        echo "Withdrawn";
        }else{
        echo "";
        }
        //}elseif($rem<1 && $msnc<1){
        }elseif($rem < 1){
            echo "PASS";
        }else{
            echo "";
        }	
    }
?>
</div>
        