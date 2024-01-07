<table id="example"  class="" style="width: 100%;">
<!-- <table id="example"  class="table table-bordered table-striped table-hover dataTable" style="width: 100%;"> -->
<tr>
    <th rowspan="2">#</th>
    <th rowspan="2">COURSE</th>
    <th rowspan="2">CODE</th>
    <th rowspan="2">UNITS</th>
    <th colspan="">TOTAL STUDENTS</th>
    <th rowspan="2">ABS</th>
    <th rowspan="2">EM</th>
    <th rowspan="2">FAIL</th>
    <th rowspan="2">PASS</th>
    <th rowspan="2">SCORE<br>(30-39)</th>
</tr> 
<tr>
    <th>in class</th><!--
    <th>that sat</th>-->
</tr> 
<?php
$ser = 0;

$canalqry= $pdo->prepare ("SELECT `code`, `title`,`unit` FROM `results` WHERE `programme` = ? && `level` = ? && `semester` = ? && `session` = ? group by code order by code ASC");
$canalqry->execute([$_REQUEST['programme'], $_REQUEST["level"],  $_REQUEST["semester"],$_REQUEST['session']]);

while($found_course = $canalqry->fetch())
{ 
    $ser++; 				
    //optimise the query 
        // Total student
        $ccount = 0;
        $stcount = 0;
        $abscount = 0;
        $emcount = 0;
        
        //$stndsql = titlqr($pdo, $programme, $level, $semester, $session);
        $stndsql= $pdo->prepare ("SELECT `matno`,`code`, `grade` FROM `results` WHERE `programme` = ? && `level`= ? && `semester` = ? && `session` = ?");
        $stndsql->execute([$_REQUEST["programme"], $_REQUEST["level"], $_REQUEST["semester"], $_REQUEST['session']]);
        while($fetch_std = $stndsql->fetch())
        {
            $sqry = $pdo->prepare("SELECT `id` FROM `students` WHERE `matno` = ? AND Withdrwan != ?");
            $sqry->execute([$fetch_std["matno"], 1]);
            $srows = $sqry->fetch(PDO::FETCH_ASSOC);						
            
            if($sqry->rowCount() == 1)
            {
                if($fetch_std["code"] == $found_course["code"])
                {
                    $ccount++;					
                }
                if($fetch_std["code"] == $found_course["code"] AND ($fetch_std["grade"] != "AE" OR $fetch_std["grade"] != "ABS"))
                {
                    $stcount++;						
                }	
                if($fetch_std["code"] == $found_course["code"] AND ($fetch_std["grade"] == "AE" OR $fetch_std["grade"] == "ABS"))
                {
                    $abscount++;						
                }
                if($fetch_std["code"] == $found_course["code"] AND $fetch_std["grade"] == "EM")
                {
                    $emcount++;						
                }
            }
        }
        //echo $fetch_std["ttsdt"];
        $passed = 0;
        $failed = 0;
        $frange = 0;
        
        // $stndsql1 = titlqr($pdo, $programme, $level, $semester, $session);
        
        $ressql= $pdo->prepare ("SELECT * FROM `results` WHERE `programme` = ?  && `level`= ? && `semester` = ?  && `session` = ?");
        $ressql->execute([$_REQUEST["programme"], $_REQUEST["level"], $_REQUEST["semester"], $_REQUEST['session']]);
        while($res_fetch = $ressql->fetch())
        {
            $sqry2 = $pdo->prepare("SELECT id FROM `students` 
            WHERE `matno` = ? AND Withdrwan != ?");
            $sqry2->execute([$res_fetch["matno"], 1]);
            $srows = $sqry2->fetch(PDO::FETCH_ASSOC);
            
            if($sqry2->rowCount() == 1)
            {
                if($res_fetch["score"] >= 40 && $res_fetch["code"] == $found_course["code"] && ($res_fetch["grade"] != "AE" OR
                $res_fetch["grade"] != "EM"  OR $res_fetch["grade"] != "MS" OR $res_fetch["grade"] != "PI"))
                {
                    $passed++;
                }
                if($res_fetch["grade"] == "F" && $res_fetch["code"] == $found_course["code"])
                {
                    $failed++;
                }
                if(($res_fetch["score"] >= 30 && $res_fetch["score"] <= 39) && $res_fetch["code"] == $found_course["code"])
                {
                    $frange++;
                }
            }
            
        }
        ?>
    
<tr>
    <td>
        <?php echo $ser;?>
    </td>
    <td>
        <?php 		
        
        echo @$found_course["title"];?>
    </td>
    <td>
        <?php echo $found_course["code"];?>
    </td>
    <td>
        <?php echo $found_course["unit"];?>
    </td>
    <td>
        <?php 
        // Total student/
        echo $ccount; //echo $fetch_std["ttsdt"];?>
    </td><!--
    <td>
        <?php 
        //Student that sat 
        echo $stcount; // $fetch_std["ttsdt"];?>
    </td>-->
    <td>
        <?php 
        //Absent
        echo $abscount;  //$fetch_std["ttsdt"];?>
    </td>
    <td>
        <?php
        //Exam Malpractice	
        echo $emcount; //echo $fetch_std["ttsdt"];?>
    </td>
    <td>
        <?php 
        // Failed00
        echo $failed;
        ?>
    </td>
    <td>
        <?php 
        //Passed
        echo $passed;
        ?>
    </td>
    <td>
        <?php 
        echo $frange;
        ?>
    </td>
</tr>
<?php 
}
?>
</table>
