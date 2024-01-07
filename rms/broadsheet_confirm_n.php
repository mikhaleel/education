<style>
.alignleft {
text-align:left;
}
.aligncenter {
text-align:center;
}
.alignright {

text-align:right;
}
#textbox {display:flex; flex-flow:row wrap;width: 100%;}
​table, th, td {
		border: 1px solid black; border-collapse: collapse; padding: 5px; letter-spacing: 1px;
}
#ttbl{border-collapse: collapse; border: none;}
</style>

<?php
$semester_arr = array(1=>"First Semester", 2=>"Second Semester");
if(isset($_REQUEST['Submit']))
{					
	$semester=$_REQUEST['semester'];
	$session=$_REQUEST['session'];
	$level=$_REQUEST['level'];
	$programme=$_REQUEST['programme'];
	// $start=@$_REQUEST['start'];
	// $list=@$_REQUEST['list'];
	$_SESSION['ex_semester'] =$_REQUEST['semester'];
	$_SESSION['ex_session']=$_REQUEST['session'];
	$_SESSION['ex_level']=$_REQUEST['level'];
	$_SESSION['ex_programme'] =$_REQUEST['programme'];
	
	if ($programme =="" || $level == "" || $session == "" || $semester == "") 
	{				
		echo "
		<div class='alert alert-danger'>Empty fields not allowed!!!</div>
		<script>setTimeout(function(){location.href='index.php'},20000)</script>";
	}

	// keep title here					
	$dptprosch = $pdo->prepare("SELECT * FROM `programmes` WHERE `programme` = ?");
	$dptprosch->execute([$_REQUEST['programme']]);
	$allrows = $dptprosch->fetch(PDO::FETCH_ASSOC);
	$exfilename = $level.'-'.$semester_arr[$semester].'_'.$session;
	?>
	<button onclick="Export2Word('printdivcontent', '<?php echo $exfilename ;?>');"  class=" pull-left btn btn-primary"><i class="mdi mdi-file-export">Export</i></button>
	<button onClick="PrintDiv()" class=" pull-left btn btn-success"><i class="mdi mdi-printer"></i>Print</button>

<div id="printdivcontent">
	<?php include("result_top.php")?>

<div style="text-align:center; font-size:16pt; font-weight:bold">RESULT ANALYSIS</div>
<!-- Analysis begins here -->
<?php 
include("analyzer.php");
?>
<p style="page-break-after: always">&nbsp;</p>  

<?php include("result_top.php")?>	
				<div class="table-responsive">
					<table id="example" class="" style="width: 100%;">   
					<!-- <table id="example" class="table table-bordered table-striped table-hover dataTable" style="width: 100%;">    -->
					<!--<table id="t1" class="table table-bordered">-->
						<thead>
							<tr style="font-size:7pt;">
								<th rowspan="2"><div align="center" style="font-weight: bold"><span><strong>S/N</strong></span></div></th>
								<th rowspan="2" ><div align="center" style="font-weight: bold"><span><strong>matno</strong></span></div></th>
                                <?php if($acad == 1){?>
								<th rowspan="2">Names</th>
                                <?php }?>
								<?php 
								$semester=$_REQUEST['semester'];
								$session=$_REQUEST['session'];
								$level=$_REQUEST['level'];
								$programme=$_REQUEST['programme'];
								//fetch distinct courses (code and unit) offered by students
								$query = $pdo->prepare("SELECT `code`, `unit`  FROM `results` WHERE `programme` =? AND `level` =? AND `semester` =? AND `session` =? GROUP BY code ORDER BY `code` ASC");
								$query->execute([$_REQUEST['programme'], $_REQUEST['level'], $_REQUEST['semester'], $_REQUEST['session']]);
                                while($row = $query->fetch())
								{ ?>  
								<th rowspan="2"><div align="center" style="font-weight: bold"><?php echo $row['code']."<br>"."(".$row['unit'].")";?></div></th>
								<?php 
								}?>
								<th colspan="3"><div align="center" style="font-weight: bold">Current_Semester </div></th>
								<th colspan="3"><div align="center" style="font-weight: bold">Previous_Semester </div></th>
								<th colspan="3"><div align="center" style="font-weight: bold">Current_Cumulative </div></th>
								<th colspan="5"><div align="center" style="font-weight: bold">REMARKS</div></th>
							</tr>
							<tr style="font-size:8pt;">
								<th><div align="center" style="font-weight: bold">cr</div></th>
								<th><div align="center" style="font-weight: bold">gp</div></th>
								<th><div align="center" style="font-weight: bold">gpa</div></th>
								<th><div align="center" style="font-weight: bold">cr</div></th>
								<th><div align="center" style="font-weight: bold">gp</div></th>
								<th><div align="center" style="font-weight: bold">gpa</div></th>
								<th><div align="center" style="font-weight: bold">cr</div></th>
								<th><div align="center" style="font-weight: bold">gp</div></th>
								<th><div align="center" style="font-weight: bold">gpa</div></th>
								<th><div align="center" style="font-weight: bold;">co</div></th>
								<th><div align="center" style="font-weight: bold">EM</div></th>
								<th><div align="center" style="font-weight: bold">AE</div></th>
								<th><div align="center" style="font-weight: bold">PEND</div></th>
								<th><div align="center"></div></th>
							</tr>
						</thead>
					<?php $n = 0;  
					// fetch distinct student records 
					$the_student = $pdo->prepare("SELECT `matno`  FROM `results` WHERE `programme`= ? && `level`= ? && `semester`= ? && `session` = ? GROUP BY `matno` ORDER BY length(`matno`),matno ASC");
					$the_student->execute([$_REQUEST['programme'], $_REQUEST['level'], $_REQUEST['semester'], $_REQUEST['session']]);

					while($col = $the_student->fetch())
					{
						//$n= $n+1;
						?>
						<tbody>
						<?php
						// check for student that are active
						$schk = $pdo->prepare("SELECT `names` FROM `students` 
						WHERE `matno` = ? AND Withdrwan != ?");
						$schk->execute([$col["matno"], 1]);
						$rows_chk = $schk->fetch(PDO::FETCH_ASSOC);
						
						if($schk->rowCount() == 1)
						{ $n++;?>
							<tr style="font-size:8pt">
								<td><?php echo $n;?></td>
								<td><?php echo $col['matno'];?> &nbsp;</td>
                                <?php if($acad == 1){?>
    								<td><?php echo $rows_chk['names'];?></td>
                                <?php }?>
								<?php 
								// all the courses offerd by a student
								$codeqry = $pdo->prepare("SELECT `code` FROM `results` WHERE `programme` =? AND `level` = ? AND `semester` =? AND `session` =? GROUP BY `code` ORDER BY `code` ASC");
								$codeqry->execute([$_REQUEST['programme'], $_REQUEST['level'], $_REQUEST['semester'], $_REQUEST['session']]);

								$tucwe = 0;
							//	$cumtucwe = 0;
								//$prevtucwe = 0;								
								while($found_code = $codeqry->fetch())
								{
									//fetch student scores grade and points 
									$the_semeter_result = $pdo->prepare("SELECT `unit`,`score`, `grade` FROM `results` WHERE `matno` =? && `programme` = ? && `semester` = ? && `session` = ? && `code` = ?");
									$the_semeter_result->execute([$col['matno'], $_REQUEST['programme'], $_REQUEST['semester'], $_REQUEST["session"], $found_code["code"]]);
								
                                    $res=$the_semeter_result->fetch(PDO::FETCH_ASSOC);		
									$unit=0;
									$gp=0;
									//$rem = 0;
									if(is_null(@$res['grade']) && is_null(@$res['score']))
									{
										$res['grade'] = 'F';
										$res['score'] = '0';
									}
									
									if(($res['grade']=="SICK")||($res['grade']=="PEND")||
									($res['grade']=="---")||($res['grade']=="EM")||
									($res['grade']=="AE")||($res['grade']=="PI"))
									{									 
										$tucwe = ($tucwe + $res['unit']); // total unit of course with excuse									 
									}
									?>
									<td>
									<div align="center" style="font-size:8pt">
									<?php
									// grade / score 
									if ((@$res['grade']=="SICK")||(@$res['grade']=="ABS")||
									(@$res['grade']=="PEND")||(@$res['grade']=="---")||
									(@$res['grade']=="EM")||(@$res['grade']=="AE")||
									(@$res['grade']=="PI"))
									{
										echo $res['grade']; 
									}
									else
									{  
										if($acad == 1)
										{
                                            echo @$res['score']."<br>";
                                        }
										//echo '<hr style="width:8px; height:;"/>';
										echo @$res['grade'];
									} 
									?>
									</div>
									</td>
									<?php 
								include("cpgpas.php");
							}
								?>
								<td><div align="center"><?php echo @$unit;?></div></td>
								<td><div align="center"><?php echo $gp;?></div></td>
								<td><div align="center"><?php echo number_format($gpa,2);?></div></td>
								<td><div align="center"><?php echo $pcu;?></div></td>
								<td><div align="center"><?php echo $pcgp;?></div></td>
								<td><div align="center"><?php echo $pcgpa;?></div></td>
								<td><div align="center"><?php echo  $ccu;?></div></td>
								<td><div align="center"><?php echo $ccgp;?></div></td>
								<td><div align="center"><?php echo $ccgpa;?></div></td>
								<td>
								<div align="center" style="font-size:8px;">
								<?php
								//create an array off deficiency from results 
								$malpract = array();
								$awe = array();
								$cover = array();
								$pnd = array();
							//	$cosql= $pdo->query ("SELECT `code`,`grade` FROM `results` WHERE `matno` = '".$col['matno']."' && `semester` <= ? && (`points` = 0 || `points` = '') GROUP BY `code`");
								$cosql= $pdo->query ("SELECT `code`,`grade` FROM `results` WHERE `matno` = '".$col['matno']."' && (`points` = 0 || `points` = '') GROUP BY `code`");
								$cosql->execute([]);
						//		$brkn = 0;
								while($corow = $cosql->fetch(PDO::FETCH_ASSOC))
								{									
									$cov = $corow['code'];
									if($corow["grade"] == "F" || $corow["grade"] == "ABS")
									{
										$cover[] = $cov.",";
									}
									elseif($corow["grade"] == "EM")
									{
										$malpract[] = $cov.",";
									}
									elseif($corow["grade"] == "AE"  || $corow["grade"] == "ABSE")
									{
										$awe[] = $cov.",";
									}
									elseif($corow["grade"] == "PEND")
									{
										$pnd[] = $cov.",";
									}
								}
								// Carry Over
								
								$brkn = 0;
								foreach($cover as $cis => $cos)
								{
									echo $cos.",";
									$brkn++;
									if($brkn == 5 || $brkn == 10 || $brkn == 15 || $brkn == 20)
									{
										echo "<br>";
									}
								}						
								?>
								</div>
								</td>
								<td style="font-size:8px;">
									<div align="center" class="style1">
										<?php
										//Exam MAlpractice
									$brkn1 = 0;
									foreach($malpract as $em => $exm)
									{
										echo $exm.",";
										$brkn1++;
										if($brkn1 == 5 || $brkn1 == 10 || $brkn1 == 15 || $brkn1 == 20)
										{
											echo "<br>";
										}
									}?>
									</div>
								</td>
								<td style="font-size:8px;">
									<div align="center" class="style1">
									<?php 		
									// $aesql= $pdo->prepare ("SELECT * FROM `results` WHERE `matno` = ? &&  `level` = ? && `semester` <= ? && (`grade` = ? ||`grade` = ? ||`grade` = ?)");
									// $aesql->execute([$col['matno'], $level, $semester, "AE", "ABSE", "SICK"]);
									$brkn2 = 0;
									foreach($awe as $ae => $abe)
									{
										echo $abe.",";
										$brkn2++;
										if($brkn2 == 5 || $brkn2 == 10 || $brkn2 == 15 || $brkn2 == 20)
										{
											echo "<br>";
										}
									}?>
									</div>
								</td>
								<td style="font-size:8px;">
									<div align="center" class="style1">
									<?php 
								$brkn4 = 0;
								foreach($pnd as $pndin => $pending)
								{
									echo $pending.",";
									$brkn4++;
									if($brkn4 == 5 || $brkn4 == 10 || $brkn4 == 15 || $brkn4 == 20)
									{
										echo "<br>";
									}
								}?>
									</div>
								</td>
								<td>
								<?php include("rmks.php"); ?>
								</td>
							</tr>
							<?php 
								
							}
					}
						//wihle from the student table
							?>
						</tbody> 
					</table>	
			</div>	
			<!--
			$_REQUEST['level'];
			$programme=$_REQUEST['programme'];
			-->	
<p style="page-break-after: always">&nbsp;</p>
			<?php 	
	include("broadsheet_co.php");?>
	
		</div>					
	<?php 
	}
	?>	
    
	<p>&nbsp;</p>
<br>
	<?php
	
		echo '<em style="color:green">Select programme, session, semester, level to view broad sheet result	</em>';
	?>
				<form action="" method="REQUEST" name="grade" class="form"> 
				<div class="row">
					<div class="col-sm-5">
						<div class="form-group">
							<div class="form focused"> 
						        <?php require_once("fetch_programme.php");?>
							</div>
						</div>
					</div>
							
							<?php if(isset($_GET["progs"])){?>
					<div class="col-sm-2">
						<div class="form-group">
							<div class="form-line focused">  
			        			<?php require_once("fetch_session.php");?>
							</div>
						</div>
					</div>
					<div class="col-sm-2">
						<div class="form-group">
							<div class="form-line focused">
					            <?php //require_once("fetch_class.php");?> 
					            <select name='level' class="form-control"  style="width:100%">
					            <option>HND2</option>
					            <option>ND2</option>
					            <option>DIP2</option>
					            <option>CERT</option>
					            </select>
				    		</div>
						</div>
					</div>
					<div class="col-sm-2">
						<div class="form-group">
							<div class="form-line focused">  
					            <?php //require_once("fetch_semester.php");?>
					            <select name='semester' class="form-control"  style="width:100%"> 
					            <option value="2">Second Semester</option>
			            	</div>
					            </select>
				        </div>
				    </div>
				<div class="col-sm-1">  
					<input name="Submit" value="View Broad Sheet" type="submit" class="btn btn-primary m-t-15 waves-effect"/>
				</div>
				
				<?php 
            }
            
            ?>
				</div>
			</form>