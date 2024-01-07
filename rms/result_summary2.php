<?php $pagename= "Result Summary"; //include("../data/db.php"); 
$dept_id = $_SESSION['dept_id'];

function total_students($pdo,$fountprog,$levels,$conf_semester,$conf_session)
{
     if($levels == "ND1" OR $levels == "HND1" OR $levels == "DIP1")
    {
        $yr = "/021/";
    }
    if($levels == "ND2" OR $levels == "HND2" OR $levels == "DIP2")
    {
        $yr = "/020/";
    }
     $nlevel = substr($levels, 0, -1);
    	$thequery = $pdo->query("SELECT id FROM `students` WHERE `programme` LIKE '%$fountprog%' AND  `matno` LIKE '%$yr%'  AND `level` LIKE '$nlevel%' GROUP BY matno");
    	//SELECT * FROM `results` WHERE `matno` LIKE '%/021/%' AND `programme` LIKE '%QUANTITY%' and `level` = 'ND1' GROUP BY `matno`
    	
    	return $thequery;
}

function cleared_students($pdo,$fountprog,$levels,$conf_semester,$conf_session)
{
     if($levels == "ND1" OR $levels == "HND1" OR $levels == "DIP1")
    {
        $yr = "/021/";
    }
    if($levels == "ND2" OR $levels == "HND2" OR $levels == "DIP2")
    {
        $yr = "/020/";
    }
    $nlevel = substr($levels, 0, -1);
    	$thequery = $pdo->query("SELECT id FROM `results` WHERE `programme` LIKE '%$fountprog%' AND `matno` LIKE '%$yr%' AND `level` LIKE '$nlevel%' AND `semester` = '$conf_semester' AND `session` = '$conf_session' GROUP BY matno");
    	
    	return $thequery;
}

function previous_cleared_students($pdo,$fountprog,$levels,$conf_semester,$conf_session)
{
     if($levels == "ND1" OR $levels == "HND1" OR $levels == "DIP1")
    {
        $yr = "/021/";
    }
    if($levels == "ND2" OR $levels == "HND2" OR $levels == "DIP2")
    {
        $yr = "/020/";
    }
    $nlevel = substr($levels, 0, -1);
    	//$thequery = $pdo->query("SELECT id FROM `results` WHERE `programme` LIKE '%$fountprog%' AND `matno` LIKE '%$yr%' AND  `semester` = '1' AND `level` LIKE '%$nlevel%' AND `session` = '$conf_session' GROUP BY matno");
    	 	$thequery = $pdo->query("SELECT id FROM `results` WHERE `programme` LIKE '%$fountprog%' AND `matno` LIKE '%$yr%' AND `level` LIKE '$nlevel%' AND `semester` = 1 AND `session` = '$conf_session' GROUP BY matno");
    	return $thequery;
}
function em_students($pdo,$fountprog,$levels,$conf_semester,$conf_session)
{
     if($levels == "ND1" OR $levels == "HND1" OR $levels == "DIP1")
    {
        $yr = "/021/";
    }
    if($levels == "ND2" OR $levels == "HND2" OR $levels == "DIP2")
    {
        $yr = "/020/";
    }
    $nlevel = substr($levels, 0, -1);
    
    $mthequery = $pdo->query("SELECT matno FROM `results` WHERE `programme` LIKE '%$fountprog%' AND `matno` LIKE '%$yr%' AND  `semester` LIKE '$conf_semester' AND `session` LIKE '$conf_session' AND `level` LIKE '%$nlevel%' GROUP BY matno");
    $em = 0;
      while($rmt = $mthequery->fetch()){
          $matnoo = $rmt["matno"];
    	$thequery = $pdo->query("SELECT id FROM `results` WHERE `programme` LIKE '%$fountprog%' AND `matno` LIKE '$matnoo' AND  `semester` LIKE '$conf_semester' AND `session` LIKE '$conf_session' AND `score` LIKE 'EM' GROUP BY matno");
    	$em_row = $thequery->rowcount();
    	if($em_row > 0)
    	{
    	    $em++;
    	}
      }
    	return $em;
}

function atw_students($pdo,$fountprog,$levels,$conf_semester,$conf_session)
{
     if($levels == "ND1" OR $levels == "HND1" OR $levels == "DIP1")
    {
        $yr = "/021/";
    }
    if($levels == "ND2" OR $levels == "HND2" OR $levels == "DIP2")
    {
        $yr = "/020/";
    }
    $nlevel = substr($levels, 0, -1);
    $mthequery = $pdo->query("SELECT matno FROM `results` WHERE `programme` LIKE '%$fountprog%' AND `matno` LIKE '%$yr%' AND  `semester` LIKE '$conf_semester' AND `session` LIKE '$conf_session' AND `level` LIKE '%$nlevel%' GROUP BY matno");
    $atw = 0;
      while($rmt = $mthequery->fetch()){
    	$thequery = $pdo->query("SELECT id,(SUM(cunit*points)/SUM(cunit)) as gpa FROM `results` WHERE `matno` LIKE '".$rmt['matno']."'");
    	$res = $thequery->fetch();
    	if($res["gpa"] < 1.5)
    	{
    	    $atw++;
        }
      }
    	return $atw;
}

function ae_students($pdo,$fountprog,$levels,$conf_semester,$conf_session)
{
    if($levels == "ND1" OR $levels == "HND1" OR $levels == "DIP1")
    {
        $yr = "/021/";
    }
    if($levels == "ND2" OR $levels == "HND2" OR $levels == "DIP2")
    {
        $yr = "/020/";
    }
    $nlevel = substr($levels, 0, -1);
    $mthequery = $pdo->query("SELECT matno FROM `results` WHERE `programme` LIKE '%$fountprog%' AND `matno` LIKE '%$yr%' AND  `semester` LIKE '$conf_semester' AND `session` LIKE '$conf_session'AND `level` LIKE '%$nlevel%'  GROUP BY matno");
    $ae = 0;
      while($rmt = $mthequery->fetch()){
    	$thequery = $pdo->query("SELECT score FROM `results` WHERE `matno` LIKE '".$rmt['matno']."' AND score LIKE 'AE'");
    	$res = $thequery->rowcount();
    	if($res > 0)
    	{
    	    $ae++;
        }
      }
    	return $ae;
}
?> 
	<button onclick="Export2Word('printdivcontent', 'Result_Summary');"  class=" pull-left btn btn-primary"><i class="mdi mdi-file-export">Export</i></button>
	<button onClick="PrintDiv()" class=" pull-left btn btn-success"><i class="mdi mdi-printer"></i>Print</button>
	<br>
<div id="printdivcontent">
<h4>NIGER STATE POLYTECHNIC, ZUNGERU<br>
FULL TIME PROGRAMME<br>
<?php echo $conf_session;?><br>
RESULT SUMMARY
</h5>
<hr>
<div class="card">
    <div class="card-body">
        <!-- <h4 class="card-title">Data table<?php //echo $dpt;?></h4> -->
            <div class="row"> <!--beginig of first row-->
             <div class="col-12">
          <?php 
            $prgquery = $pdo->query("SELECT `programme` FROM `results` WHERE `semester`= '".$conf_semester."' AND `session` LIKE '".$conf_session."' AND (`programme` LIKE '%NATIONAL%' OR `programme` LIKE 'DIPLOMA%') GROUP BY `programme` order by `programme` ASC");
            //$rowcounts = $prgquery->rowcount();
            while($prog_rows = $prgquery->fetch()){
                $programme = $prog_rows['programme'];
                
                	$theprogs = strtolower($programme);
                	if (($pos = strpos($theprogs, "in ")) !== FALSE) { 
                        $fountprog = substr($theprogs, $pos+2); 
                    }
                    
            $lquery = $pdo->query("SELECT `level` FROM `results` WHERE `programme` LIKE '%$fountprog%'  AND  `semester` LIKE '".$conf_semester."' AND `session` LIKE '".$conf_session."'  GROUP BY `level`");
                $level_array = [];
                $row_c = $lquery->rowcount();
            ?>
            <h5><?php echo strtoupper($fountprog);?></h5>
            <div class="table-responsive">
                <table class="table" border='1' style="width: 100%; border-collapse: collapse;">
                	<tr>
                		<td class="auto-style1" style="width: 32px"><strong>SN</strong></td>
                		<td><strong>ITEM</strong></td>
                		<?php while($level_row = $lquery->fetch())
                        { 
                        $level_array[] = $level_row['level'];?>
                		<td><strong> <?php echo $level_row['level'];?></strong></td>
                		<?php 
                        }?>
                	</tr>
                	<tr>
                		<td class="auto-style1" style="width: 32px">1</td>
                		<td><strong>TOTAL STUDENTS</strong></td>
                		<?php for($i = 0; $i < $row_c; $i++){ ?><td>
                		<?php   $levels = $level_array[$i];
                		
                        $thequery = total_students($pdo,$fountprog,$levels,$conf_semester,$conf_session);
                        echo  $total_row = $thequery->rowcount();
                        $ttlrow[$i] = $total_row;
                		?></td><?php }
                		
                		?>
                	</tr>
                	<tr>
                		<td class="auto-style1" style="width: 32px">2</td>
                		<td><strong>TOTAL CLEARED</strong></td>
                		<?php 
                		for($k = 0; $k < $row_c; $k++){ ?>
                		<td>
                		    <?php $levels = $level_array[$k];
                	    $cleared = 0;
                	    $ucleared = 0;
                	    
                	    $csquery = cleared_students($pdo,$fountprog,$levels,$conf_semester,$conf_session);
                	     echo  $cleared_row = $csquery->rowcount();
                            $clrd[$k] = $cleared_row;
                            
                        $pcsquery = previous_cleared_students($pdo,$fountprog,$levels,1,$conf_session);
                	       $pcleared_row = $pcsquery->rowcount();
                            $pclrd[$k] = $pcleared_row;
                        ?>
                        </td>
                        <?php }?>
                	</tr>
                	<tr>
                		<td class="auto-style1" style="width: 32px">3</td>
                		<td><strong>TOTAL NOT CLEARED</strong></td>
                		<?php for($j = 0; $j < $row_c; $j++){ ?>
                		<td>
                		<?php   
                        echo $unclrd = ($ttlrow[$j] - $clrd[$j]);
                        //echo $punclrd = ($ttlrow[$j] - $pclrd[$j]);
                		    ?>
                		    </td>
                		    <?php }?>
                	</tr>
                	<tr>
                		<td class="auto-style1" style="width: 32px">4</td>
                		<td><strong>SUCCESS RATE (PREVIOUSE)</strong></td>
                		<?php for($l = 0; $l < $row_c; $l++){ ?>
                		<td><?php 
                        echo $psuccesr = number_format((($pclrd[$l] / $ttlrow[$l]) * 100),2)."%";
                        ?>
                		</td><?php }?>
                	</tr>
                	<tr>
                		<td class="auto-style1" style="width: 32px">5</td>
                		<td><strong>SUCCESS RATE (CURRENT)</strong></td>
                		<?php for($m = 0; $m < $row_c; $m++){ ?><td><?php 
                        echo $succesr = number_format((($clrd[$m] / $ttlrow[$m]) * 100),2)."%";?></td><?php }?>
                	</tr>
                	<tr>
                		<td class="auto-style1" style="width: 32px">6</td>
                		<td><strong>NUMBER OF EXAM MALPRACTICE (EM)</strong></td>
                		<?php for($o = 0; $o < $row_c; $o++){ ?><td><?php 
                		$emlevels = $level_array[$o];
                		$em = em_students($pdo,$fountprog, $emlevels,$conf_semester,$conf_session);
                		echo $em;?>
                		</td><?php }?>
                	</tr>
                	<tr>
                		<td class="auto-style1" style="width: 32px">7</td>
                		<td><strong>NUMBER ADVISED TO WITHDRAW (ATW)</strong></td>
                		<?php for($p = 0; $p < $row_c; $p++){ ?><td><?php 
                		$atwlevels = $level_array[$p];
                		$atw = atw_students($pdo,$fountprog,$atwlevels,$conf_semester,$conf_session);
                		echo $atw;?></td><?php }?>
                	</tr>
                	<tr>
                		<td class="auto-style1" style="width: 32px">8</td>
                		<td><strong>NUMBER ABSENT WITH EXCUSE (AE)</strong></td>
                		<?php for($q = 0; $q < $row_c; $q++){ ?><td><?php 
                		$aelevels = $level_array[$q];
                		$ae = ae_students($pdo,$fountprog,$aelevels,$conf_semester,$conf_session);
                		    echo $ae;?></td><?php }?>
                	</tr>
                	<!--<tr>-->
                	<!--	<td class="auto-style1" style="width: 32px">9</td>-->
                	<!--	<td><strong>NUMBER OF SPILL OVER</strong></td>-->
                	<!--	<?php //for($i = 0; $i < $row_c; $i++){ ?><td><?php //echo $i;?></td><?php //}?>-->
                	<!--</tr>-->
                	<tr>
                		<td class="auto-style1" style="width: 32px">10</td>
                		<td><strong>GENRAL PERFORMANCE</strong></td>
                			<?php for($r = 0; $r < $row_c; $r++){ ?><td><?php 
                        echo $succesr = number_format((($clrd[$r] / $ttlrow[$r]) * 100),2)."%";?></td><?php }?>
                	</tr>
                	<tr>
                		<td class="auto-style1" style="width: 32px">11</td>
                		<td><strong>OTHER COMMENTS:</strong></td>
                		<td>&nbsp;</td>
                	</tr>
                </table>
            </div>
            <?php } ?>
             </div>
        </div>     <!-- end of first row -->
    </div>
</div>
<?php //include("result_footer.php");?>
</div>