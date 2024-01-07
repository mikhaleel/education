<?php $pagename= "Result Summary"; include("result_header.php"); $dept_id = $_SESSION['dept_id'];
function students_matno($pdo,$fountprog,$levels,$conf_semester,$conf_session)
{
    	$thequery = $pdo->query("SELECT id,matno FROM `results` WHERE `programme` LIKE '%$fountprog%' AND `level` LIKE '$levels' AND  `semester` LIKE '$conf_semester' AND `session` LIKE '$conf_session' GROUP BY matno");
    	return $thequery;
}
?>    
<div class="card">
    <div class="card-body">
        <!-- <h4 class="card-title">Data table<?php //echo $dpt;?></h4> -->
            <div class="row"> <!--beginig of first row-->
             <div class="col-12">
          <?php 
            $prgquery = $pdo->query("SELECT `programme` FROM `results` WHERE `semester`= '".$conf_semester."' AND `session` LIKE '".$conf_session."' AND (`programme` LIKE 'HIGHER NATIONAL%' OR `programme` LIKE 'DIPLOMA%') GROUP BY `programme` order by `programme` ASC");
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
                        $level_array[] = $level_row['level']?>
                		<td><strong> <?php echo $level_row['level'];?></strong></td>
                		<?php 
                        }?>
                	</tr>
                	<tr>
                		<td class="auto-style1" style="width: 32px">1</td>
                		<td><strong>TOTAL STUDENTS</strong></td>
                		<?php for($i = 0; $i < $row_c; $i++){ ?><td>
                		<?php   $levels = $level_array[$i];
                		
                        $thequery = students_matno($pdo,$fountprog,$levels,$conf_semester,$conf_session);
                // 	$thequery = $pdo->query("SELECT id FROM `results` WHERE `programme` LIKE '%$fountprog%' AND `level` LIKE '$levels' AND  `semester` LIKE '$conf_semester' AND `session` LIKE '$conf_session' GROUP BY matno");
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
                	    $csquery = students_matno($pdo,$fountprog,$levels,$conf_semester,$conf_session);
                        // $csquery = $pdo->query("SELECT matno FROM `results` WHERE `programme` LIKE '%$fountprog%' AND `level` = '$levels' AND  `semester`= '".$conf_semester."' AND `session` LIKE '$conf_session' GROUP BY matno");
                        while($stdm = $csquery->fetch())
                        {
                	            $mt_n = $stdm['matno'];
                            $cquery = $pdo->query("SELECT id,points FROM `results` WHERE `matno` LIKE '$mt_n' AND  `semester`= '$conf_semester' AND `session` LIKE '$conf_session' AND `points` = 0");
                            
                        $total_c = $cquery->rowcount();
                            
                           if($total_c == 0) 
                            {
                                $cleared++;
                            } 
                        }
                            
                        echo $cleared;   
                        $clrd[$k] = $cleared;
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
                		    ?>
                		    </td>
                		    <?php }?>
                	</tr>
                	<tr>
                		<td class="auto-style1" style="width: 32px">4</td>
                		<td><strong>SUCCESS RATE (PREVIOUSE)</strong></td>
                		<?php for($l = 0; $l < $row_c; $l++){ ?>
                		<td><?php 
                        echo $succesr = (($clrd[$l] / $ttlrow[$l]) * 100)."%";
                        ?>
                		</td><?php }?>
                	</tr>
                	<tr>
                		<td class="auto-style1" style="width: 32px">5</td>
                		<td><strong>SUCCESS RATE (CURRENT)</strong></td>
                		<?php for($i = 0; $i < $row_c; $i++){ ?><td><?php echo $i;?></td><?php }?>
                	</tr>
                	<tr>
                		<td class="auto-style1" style="width: 32px">6</td>
                		<td><strong>NUMBER OF EXAM MALPRACTICE (EM)</strong></td>
                		<?php for($i = 0; $i < $row_c; $i++){ ?><td><?php echo $i;?></td><?php }?>
                	</tr>
                	<tr>
                		<td class="auto-style1" style="width: 32px">7</td>
                		<td><strong>NUMBER ADVISED TO WITHDRAW (ATW)</strong></td>
                		<?php for($i = 0; $i < $row_c; $i++){ ?><td><?php echo $i;?></td><?php }?>
                	</tr>
                	<tr>
                		<td class="auto-style1" style="width: 32px">8</td>
                		<td><strong>NUMBER ABSENT WITH EXCUSE (AE)</strong></td>
                		<?php for($i = 0; $i < $row_c; $i++){ ?><td><?php echo $i;?></td><?php }?>
                	</tr>
                	<tr>
                		<td class="auto-style1" style="width: 32px">9</td>
                		<td><strong>NUMBER OF SPILL OVER</strong></td>
                		<?php for($i = 0; $i < $row_c; $i++){ ?><td><?php echo $i;?></td><?php }?>
                	</tr>
                	<tr>
                		<td class="auto-style1" style="width: 32px">10</td>
                		<td><strong>GENRAL PERFORMANCE</strong></td>
                		<td>&nbsp;</td>
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
<?php include("result_footer.php");?>