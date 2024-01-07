<?php session_start(); $pagename= "Edit Scores By Course"; include("result_header.php");?>
<div class="card">
    <div class="card-body">
    <h4 class="card-title">Edit Score By Course</h4>
    <div class="row">
    <?php      
     if(!isset($_REQUEST['Submitf']))
     {?>
        <div class="col-12"> 
        <form method="post" name="grade">
            <div class="row"> 
                <div class="form-group col-5">
                    <?php require_once("fetch_programme.php");?></i>  
                </div>
                <?php 
                if(isset($_GET["progs"]))
                {?>
                <div class="form-group col-2">
                    <?php require_once("fetch_class.php");?> </i>          
                </div>
                <div class="form-group col-2">
                    <?php require_once("fetch_session.php");?> </i>  
                </div>
                <div class="form-group col-2">
                    <?php require_once("fetch_semester.php");?></i>    
                </div>
                <div class="col-sm-1"> 		
                    <div class="form-group">
                            <input name="Submitf" value="Fetch Records" type="submit" class="btn btn-primary">
                    </div>
                </div>                    
                <?php
                }           
                ?>
            </div>
            </form>
        </div>   
     <?php 
     }?>
    </div>
    <div class="row">
        <div class="col-7">
           <?php  
           $rcnt = 0;
            if(isset($_REQUEST['Submitf']))
            {
                if ($_REQUEST['programme'] =="") 
                {
                    echo "
                        <div class='alert alert-danger'>Please Select a programme</div>
                        <script>setTimeout(function(){location.href='edit_scores_course'},2000)</script>
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
                    "<div class='col-md-12'> <h6>". strtoupper('Programme').": ".strtoupper($prows["programme"])."</h6></div>".
                    "<div class='col-md-6'><h6>". strtoupper("Session").": ".strtoupper($_REQUEST['session'])."</h6></div>".
                    "<div class='col-md-6'> <h6>". strtoupper("Semseter").": ".strtoupper($semester_conv[$_REQUEST['semester']])."</h6></div>".
                    "</div>";
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
                        $rcnt = $ccqry->rowcount();
                        $sn = 0;
                                while($ccrows = $ccqry->fetch(PDO::FETCH_ASSOC))
                                {
                                    $sn++;
                                    $datum = array('programme'=>$_REQUEST['programme'],'level'=>$_REQUEST['level'],'semester'=>$ccrows['semester'],'code'=>$ccrows['coursecode'],'unit'=>$ccrows['courseunit'],'session'=>$_REQUEST['session']);
                                    $datums = encryptor('encrypt',serialize($datum));
                                ?>
                            <tr>
                                <td><?php echo $ccrows['coursecode'];?></td>
                                <td><?php echo $ccrows['coursetitle'];?></td>
                                <td><?php echo $ccrows['courseunit'];?></td>
                                <td><?php echo $ccrows['semester'];?></td>
                                <td><form id="datumForm<?php echo $sn;?>">
                                    <input name="datums"  value="<?php echo $datums;?>" type="hidden">
                                    <button type="submit" id="datums<?php echo $sn;?>" class="btn btn-inverse-success"><span class="mdi mdi-square-edit-outline"> Edit Scores</span></button>
                                </form>
                                </td>
                            </tr>  
                                
                            <?php 
                                }?>
                        </tbody>
                    </table>
                <?php 
                }?>                
            </div> 
            <?php 
            }
            ?>        
        <div class="col-5">
            <div id="datumResult"></div>
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
    function edit_score()
    {
        alert("welcome");
        var val_ar= document.getElementById("datums").value;
        window.location.href="?datums="+val_ar;
    }
</script>
    <?php for($tt = 1; $tt <= $rcnt; $tt++){?>
    <script>
        $(document).ready(function() {
			$("#datumForm<?php echo $tt;?>").submit(function(e) {
				e.preventDefault()
				let data = $("#datumForm<?php echo $tt;?>").serialize()
				let appReq = $.ajax({
					url: "datumexec.php",
					type: "POST",
					data: data,
					beforeSend: () => {
						$("#datums<?php echo $tt;?>").html("Pulling Records Pleas Wait...")
						$("#datums<?php echo $tt;?>").attr("disabled", "true")
					},
					complete: () => {
						$("#datums<?php echo $tt;?>").html("Done Pulling...!")
						$("#datums<?php echo $tt;?>").removeAttr("disabled")
					},
					success: (res) => $("#datumResult").html(res)
				})
			})
		})
    </script>
    <?php 
    }
    ?>