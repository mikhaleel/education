<?php $pagename= "Edit Scores By Course"; include("result_header.php");?>
<div class="card">
    <div class="card-body">
    <h4 class="card-title">Edit Score By Course</h4>
    <div class="row">
        <div class="col-12">
            <?php
			// score input form                   
            if(isset($_GET["inputResult"]))
            {?>
            <div id="editResult"></div>
                
                <h5>Programme: <?php echo $programme = encryptor('decrypt',$_GET["programme"]);?></h5>
                <h5>Course Code: <?php echo $code = encryptor('decrypt',$_GET["code"]);?></h5>
                <h5>Level: <?php echo $level = encryptor('decrypt',$_GET["level"]);?></h5>
                <h5>Session: <?php echo $session = encryptor('decrypt',$_GET["session"]);?></h5>
                <h5>Semester: <?php echo $semester = encryptor('decrypt',$_GET["semester"]);?></h5>
				
                <form id="inputForm" action="" method="">
            <div class="container-fluid mt-5 d-flex justify-content-center w-100">
                <div class="table-responsive w-100">
                <table class="table">
                    <thead>
                        <tr class="bg-dark text-white">
                            <th>#</th>
                            <!-- <th>NAME</th> -->
                            <th> MATRIC NUMBER</th>
                            <th>SCORE</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                     $qry = $pdo->query("SELECT *  FROM `stu_course_reg` WHERE `level` LIKE '".$level."' AND `session` LIKE '".$session."' AND `semester` LIKE '".$semester."' AND `coursecode` LIKE '".$code."' AND `programme` LIKE '".$programme."'");

                    // $qry = $pdo->prepare("SELECT * FROM `stu_course_reg` WHERE programme = ? &&  `semester` = ? && `level` = ? && `coursecode` = ? && `session`= ? GROUP BY `coursecode`");
                    // $qry->execute([$_GET['programme'], $_GET['semester'], $_GET['level'], $_GET["code"], $_GET['session']]);
                   
                    $mn = 0; 
                  //  while($stdrows = $stdt_qry->fetch(PDO::FETCH_ASSOC))
                    while($found_q = $qry->fetch(PDO::FETCH_ASSOC))
                    {
                        $res_qry = $pdo->prepare("SELECT * FROM `results` WHERE `matno` = ? && `code` = ? ORDER BY `results`.`matno` ASC");
                        $res_qry->execute([$found_q["matno"], $code]);
                        $res_row = $res_qry->fetch();
                        $mn++;
                        ?>
                        <tr>
                            <td scope="row"><?php echo $mn;?></td>
                            <!-- <td><?php //echo @$found_q["names"];?> <input name="names[]" value="<?php //echo @$found_q["names"];?>" type="hidden"></td> -->
                            <td><?php echo $found_q["matno"];?> <input name="matno[]" value="<?php echo encryptor('encrypt',$found_q["matno"]);?>" type="hidden"></td>
                            <td>
                            <div class="col-sm-4">
				                <div class="form-group">          
                                <input name="score[]" type="text" class="form-control" value="<?php echo @$res_row['score'];?>">								
                                <input name="sid[]" type="hidden" class="form-control" value="<?php echo @$res_row['id'];?>">								
                                <input name="programme" value="<?php echo $_GET["programme"];?>" type="hidden">
                                <input name="semester" value="<?php echo $_GET["semester"];?>" type="hidden">
                                <input name="level" value="<?php echo $_GET["level"];?>" type="hidden">
                                <input name="code" value="<?php echo $_GET["code"];?>" type="hidden">
                                <input name="level" value="<?php echo $_GET["level"];?>" type="hidden">
                                <input name="unit" value="<?php echo $_GET['unit'];?>" type="hidden">
                                
                                </div>
                            </div>
                            </td>
                        </tr>
                        <?php 
                    }?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="2"></th>
                            <th><button class="btn btn-primary pull-left" type="Submit" name="savescore" id="inputBtn"> SUBMIT SCORES </button></th>
                        </tr>
                    </tfoot>
                    </tbody>
                </table>
				</div>
			</div>
                

                </form>

             <?php    
            }
            else
            if(isset($_REQUEST['Submitf']))
            {
                if ($_REQUEST['programme'] =="") 
                {
                    echo "
                        <div class='alert alert-danger'>Please Select a programme</div>
                        <script>setTimeout(function(){location.href='managescores.php'},2000)</script>
                        ";
                }
                else
                {
                    ?>
                                
                    <a href='edit_scores_course.php' class='float-right btn btn-danger'>Back</a>
                    <p>
                    <br>

                    <?php 
                    $pqry = $pdo->prepare("SELECT * FROM `programmes` 
                    WHERE `programme` = ?");
                    $pqry->execute([$_REQUEST['programme']]);
                    $prows = $pqry->fetch(PDO::FETCH_ASSOC);
                   
                    
                    echo "<div class='row'>".
                    "<div class='col-md-6'>
                    <span class='float-'> <h6>". strtoupper('School').": ".strtoupper($_SESSION["school"])."</h6></span>".
                    "<span class='float-'> <h6>". strtoupper('Programme').": ".strtoupper($prows["programme"])."</h6></span>".
                    "<span class='float-'><h6>". strtoupper("Session").": ".strtoupper($_REQUEST['session'])."</h6></span>".
                    "<span class='float-'> <h6>". strtoupper("Semseter").": Semester ".strtoupper($_REQUEST['semester'])."</h6></span>".
                    "</div>
                    </div>";
                    ?>
                    <hr>      
                    </p>
                    <?php 
                    $ccqry = $pdo->prepare("SELECT * FROM `stu_course_reg` WHERE `programme` = ? && `semester` = ? && `level` = ? && `session` =? GROUP BY  `coursecode`");
                    $ccqry->execute([$_REQUEST['programme'] , $_REQUEST['semester'], $_REQUEST['level'], $_REQUEST['session']]);
                    ?>
                    <table class="table">
                        <thead>
                            <tr class="bg-success text-white">
                                <th>Code</th>
                                <th>Title</th>
                                <th>Unit</th>
                                <th>Semester</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php 
                                while($ccrows = $ccqry->fetch(PDO::FETCH_ASSOC))
                                {
                                ?>
                            <tr>
                                <td><?php echo $ccrows['coursecode'];?></td>
                                <td><?php echo $ccrows['coursetitle'];?></td>
                                <td><?php echo $ccrows['courseunit'];?></td>
                                <td><?php echo $ccrows['semester'];?></td>
                                <td><a class="btn btn-inverse-primary" href="?programme=<?php echo encryptor('encrypt',$_REQUEST['programme']).'&level='.encryptor('encrypt',$_REQUEST['level']).'&semester='.encryptor('encrypt',$ccrows['semester']).'&code='. encryptor('encrypt',$ccrows['coursecode']).'&unit='. encryptor('encrypt',$ccrows['courseunit']).'&session='.encryptor('encrypt',$_REQUEST['session']).'&inputResult';?>"><span class="mdi mdi-square-edit-outline"> Edit Scores</span></a></td>
                            </tr>  
                                
                            <?php 
                                }?>
                        </tbody>
                    </table>
                <?php 
                }
            }
            else
            {
            ?>
        		<p>&nbsp;</p>
                <form method="post" name="grade">
                <div class="row"> 
                  <div class="form-group col-5">
                    <?php require_once("fetch_programme.php");?> <i style="color:red">*</i>  
                  </div>
                <?php 
                if(isset($_GET["progs"])){?>
                    <div class="form-group col-2">
                        <?php require_once("fetch_class.php");?>  <i style="color:red">*</i>          
                    </div>
                    <div class="form-group col-2">
                        <?php require_once("fetch_session.php");?>  <i style="color:red">*</i>  
                    </div>
                    <div class="form-group col-2">
                        <?php require_once("fetch_semester.php");?> <i style="color:red">*</i>    
                    </div>
                <div class="col-sm-1"> 		
                  <div class="form-group">
                        <input name="Submitf" value="Submit" type="submit" class="btn btn-primary"/>
                  </div>
                </div>
                </div>
                        <?php 
                }
            }
            ?>
        </div>
        </form>
          </div>
    </div>
    </div>
</div>
<?php include("result_footer.php");?>
<script>
    function progm()
    {
        //alert("welcome");
        var prg= document.getElementById("programme").value;
        window.location.href="?progs="+prg;
    }
</script>
<script>
		$(document).ready(function() {
			$("#inputForm").submit(function(e) {
				e.preventDefault()
				let data = $("#inputForm").serialize()
				let appReq = $.ajax({
					url: "edit_scores_sub.php",
					type: "POST",
					data: data,
					beforeSend: () => {
						$("#inputBtn").html("Processing...")
						$("#inputBtn").attr("disabled", "true")
					},
					complete: () => {
						$("#inputBtn").html("Begin")
						$("#inputBtn").removeAttr("disabled")
					},
					success: (res) => $("#editResult").html(res)
				})
			})
		})
	</script>