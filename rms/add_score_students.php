<?php $pagename= "Add Scores By Students"; include("result_header.php");?>
          
<div class="card">
    <div class="card-body">
    <h4 class="card-title">Add Scores</h4>
    <div class="row">
        <div class="col-12">
            <?php
            if(isset($_POST['Submit2']))
            {
                $programme=$_POST['programme'];
                //$programme = mysqli_escape_string($logs, $programme);
                $level=$_POST['level'];
                
                $session=$_POST['session'];
                $semester=$_POST['semester'];
              //  $thename= $_POST['thename'];
                //$thename = mysqli_escape_string($logs, $thename);
                $matno= $_POST['matno'];
                $count = $_POST['count'];
                $session = $_POST['session'];
                
                $s_tatus = substr($_POST['level'], -1).$_POST['semester'];
                if (!$matno)
                {
                //die( 'No more records and Empty fields cannot be added');
                echo "
                    <div class='alert alert-info'>No records left!!!</div>
                    <script>setTimeout(function(){location.href='add_score_students'},20000)</script>
                    ";
                }
                $count=$count-1;
                $m=0;
                while($m<=$count)
                {
                    $m=$m+1;
                    
                    $ttl= "title".$m;
                    $title = $_POST[$ttl];
                    $scr= "score".$m;
                    $score = $_POST[$scr];
                    include("scoregrade.php");
                    $point = $n[$grade1];
                    $un="unit".$m;
                    $unit=$_POST[$un];
                    $cod="code".$m;
                    $code = $_POST[$cod];
                    // insert results
                    $gp = ($point*$unit);
                    
                   
                    if($score == 'AE')
                    {
                        $cunit = 0;
                    }else
                    {
                        $cunit = $unit;
                    }
                    $ifexst = $pdo->query("SELECT * FROM `results` WHERE `matno` = '$matno' AND `code` = '$code'"); 
                    $fs = $ifexst->fetch();
                    if($ifexst->rowCount() > 0)
                    {
                        if($fs["session"] != $_SESSION['rsession'])
                        {
                            $scoretype = 1;
                        }
                        else
                        {
                            $scoretype = 0;
                        }
                        $qry = $pdo->query("UPDATE `results` SET `title` = '$title', `unit`='$unit', `cunit`='$cunit',`score` = '$score', `grade` = '$grade1', `points` = '$point', `gp` = '$gp', `scoretype` = '$scoretype', `co_session` = '".$_SESSION['rsession']."' WHERE `matno`='$matno' AND `code` = '$code'");
                        $msg = "Records Updated";
                    }
                    else
                    {
                        $mqry = $pdo->prepare("INSERT INTO `results` (`matno`, `code`,`title`,`unit`,`cunit`,`score`, `grade`,`points`,`gp`, `programme`, `semester`, `session`, `level`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)"); 
                        $mqry->execute([$matno, $code,$title,$unit,$cunit, $score, $grade1, $point, $gp,$programme,$semester,$session, $level]); 
                        
                    }
                }
              
                $sql = $pdo->prepare("SELECT * FROM `stu_course_reg` sc, `students` s WHERE sc.`programme` = ?  && sc.`level` = ? &&  sc.`courselevel` = ? AND  sc.`matno` = s.`matno` AND s.`s_status` < ? && s.`Withdrwan` = ? AND sc.`semester` = ?  AND s.`programme` = sc.`programme` AND sc.`session` = ?  ORDER BY s.`matno` ASC");
                    
                $sql->execute([$_POST['programme'], $_POST['level'],$_POST['level'], $s_tatus, '0', $_POST['semester'], $_POST['session']]);


                $row=$sql->fetch(PDO::FETCH_ASSOC);
            
                if($sql->rowCount() == 0)
                //if($exixtin==0)
                {
                    echo "
                        <div class='alert alert-info'>No Student left!!!</div>
                        <script>setTimeout(function(){location.href='add_score_students'},20000)</script>";
                }
                else
                {	
                ?>
                <form action="" method="post" name="form2" id="form2">
                <div class="table-responsive">
                    <table class="table table-bordered">
                    <tr>
                        <td><span style="font-weight: bold">NAME:</span></td>
                        <td>
                        <input name="thename" type="text" id="name" value="<?php echo $row['names'];?>"  class="form-control" readonly="1"/>
                        <input name="thename" type="hidden" id="name" value="<?php echo $row['names'];?>" size="40" />
                        </td>
                    </tr>
                    <tr>
                        <td ><span style="font-weight: bold">MATRIC NUMBER:</span></td>
                        <td >
                        <input name="matno" type="text" id="matno"  value="<?php echo $row['matno'];?>" class="form-control" readonly="1"/>
                        <input name="matno" type="hidden" id="matno"  value="<?php echo $row['matno'];?>" />
                        </td>
                    </tr>
                    </table>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered">
                    <tr>
                        <?php 
                        $n=0; 
                        $query= $pdo->prepare("SELECT * FROM `course` WHERE programme = ? && semester = ?  && `level` = ?");
                        $query->execute([$_POST['programme'], $_POST['semester'], $_POST['level']]);
                    
                        while ($col= $query->fetch(PDO::FETCH_ASSOC))
                        {
                        // check if there are existing records and the records are not complete
                        $cscode =  $col['code'];
                        $csunit =  $col['unit'];
                        $smatno = $row['matno'];
                        //echo "<input type='text' value='".$matno."'>";
                        $sqry= $pdo->prepare("SELECT * FROM `results` WHERE  matno = ? && code = ? && unit = ?");
                        $sqry->execute([$row['matno'], $col['code'], $col['unit']]);

                        if($sqry->rowCount() == 0)
                        {
                        $n++;
                        ?>
                        <td>
                            <span style="color: #000000; font-weight: bold"><?php echo $col['code']."<br>";?>
                            <input name="<?php echo'unit'.$n;?>" type="hidden" value="<?php echo $col['unit'];?>">
                            <input name="<?php echo'code'.$n;?>" type="hidden" value="<?php echo $col['code'];?>">
                            <input name="<?php echo'title'.$n;?>" type="hidden" value="<?php echo $col['title'];?>">
                            <select name="<?php echo'score'.$n;?>" class="form-control">
                                <option value="0">0</option>
                                <?php include("scoreopt.php");?>
                            </select>
                            </span>
                        </td>
                        <?php 
                        }  // end of checking
                        }?>
                    </tr>
                    </table>
                    </div>
                    <input name="count" type="hidden" id="count" value="<?php echo $n;?>">
                    <input type="submit" name="Submit2" value="Submit Scores"  class="btn btn-primary">
                    <input type="hidden" name="programme"  value="<?php echo $programme;?>"/>
                    <input type="hidden" name="session"  value="<?php echo $session;?>"/>
                    <input type="hidden" name="semester"  value="<?php echo $semester;?>"/>
                    <input type="hidden" name="level"  value="<?php echo $level;?>"/>
                </form>
                <?php //exit;
            }
         } // isset
        else
        if(isset($_POST['Submit']))
        {
            //  $programme = mysqli_escape_string($logs,$programme);
            if ($_POST['programme'] =="" || $_POST['level'] == "" || $_POST['session'] == "" || $_POST['semester'] == "") 
                {
                    echo "
                        <div class='alert alert-danger'>All fields are Required!!!</div>
                        <script>setTimeout(function(){location.href='add_score_students'},20000)</script>";
                }
                else
                {
                    $s_tatus = substr($_POST['level'], -1).$_POST['semester'];

                    $sql = $pdo->prepare("SELECT * FROM `stu_course_reg` sc, `students` s WHERE sc.`programme` = ?  && sc.`level` = ? &&  sc.`courselevel` = ? AND  sc.`matno` = s.`matno` AND s.`s_status` < ? && s.`Withdrwan` = ? AND sc.`semester` = ?  AND s.`programme` = sc.`programme` AND sc.`session` = ?  ORDER BY s.`matno` ASC");
                    
                    $sql->execute([$_POST['programme'], $_POST['level'],$_POST['level'], $s_tatus, '0', $_POST['semester'], $_POST['session']]);

                    $row=$sql->fetch(PDO::FETCH_ASSOC);

                    $matricno = @$row['matno'];

                    $exixtin = $sql->rowCount();
                    
                    if($sql->rowCount() == 0)
                    {    
                        echo "
                        <div class='alert alert-info'>No Student left!!!</div>";
                    }
                    else
                    {	
                        ?>
                        <form action="" method="post" name="form1" class="form1">
                        <div class="table-responsive">
                        <table class="table table-bordered">
                            <tr>
                            <td><span style="font-weight: bold">Name:</span></td>
                            <td>
                                <input name="thename" type="text" id="name" value="<?php echo $row['names'];?>" size="40" readonly="1" class="form-control"/>
                                <input name="thename" type="hidden" id="name" value="<?php echo $row['names'];?>" size="40" />
                            </td>
                            </tr>
                            <tr>
                            <td ><span style="font-weight: bold">Matric Number:</span></td>
                            <td >
                                <input name="matno" type="text" id="matno"  value="<?php echo $row['matno'];?>" readonly="1" class="form-control"/>
                                <input name="matno" type="hidden" id="matno"  value="<?php echo $row['matno'];?>" />
                            </td>
                            </tr>
                        </table>
                        </div>
                        <div class="table-responsive">
                        <table class="table table-bordered">
                            <tr>
                            <?php $n = 0; 
                            // change this to table to course_reg    
                            $query= $pdo->prepare("SELECT * FROM `course` WHERE programme = ? && semester = ?  && `level` = ?");
                            $query->execute([$_POST['programme'], $_POST['semester'], $_POST['level']]);

                            while ($col= $query->fetch(PDO::FETCH_ASSOC))
                            {                            
                                // check if there are existing records and the records are not complete
                                $cscode =  $col['code'];
                                $csunit =  $col['unit'];
                                $smatno = $row['matno'];
                                
                                $sqry= $pdo->prepare("SELECT * FROM `results` WHERE  matno = ? && code = ? && unit = ?");
                                $sqry->execute([$row['matno'], $col['code'], $col['unit']]);
                                //$nmrws = mysqli_num_rows($sqry);
                                if($sqry->rowCount() == 0)
                                {
                                    $n++;
                                ?>
                                <td >
                                    <span style="color: #000000; font-weight: bold"><?php echo $col['code']."<br>";?>
                                    <input name="<?php echo'unit'.$n;?>" type="hidden" value="<?php echo $col['unit'];?>">
                                    <input name="<?php echo'code'.$n;?>" type="hidden" value="<?php echo $col['code'];?>">
                                    <input name="<?php echo'title'.$n;?>" type="hidden" value="<?php echo $col['title'];?>">
                                    <select name="<?php echo'score'.$n;?>" class="form-control">
                                    <option value="0">0</option>
                                    <?php                                     
                                    include("scoreopt.php");?>
                                    </select>
                                    </span>
                                </td>
                                <?php
                                }
                            }?>
                            </tr>
                        </table>
                        </div>

                        <input name="count" type="hidden" id="count" value="<?php echo $n;?>" />
                        <input type="submit" name="Submit2" value="Submit Scores" class="btn btn-primary"/>
                        <input type="hidden" name="programme"  value="<?php echo $_POST['programme'];?>"/>
                        <input type="hidden" name="session"  value="<?php echo $_POST['session'];?>"/>
                        <input type="hidden" name="semester"  value="<?php echo $_POST['semester'];?>"/>
                        <input type="hidden" name="level"  value="<?php echo $_POST['level'];?>"/>
                        </form>

                        <?php 
                    }
            
                }
            }	
            ?>
            <p> <strong >&nbsp;</strong></p>
            <form action="" method="post" name="grade">
            <div class="row clearfix">
            <div class="col-5"> 		
              <div class="form-group">
                <div class="form-line">
                <?php require_once("fetch_programme.php");?>
                </div>
               </div>
            </div>
            <?php if(isset($_GET["progs"])){?>
            <div class="col-sm-2"> 		
              <div class="form-group">
                <div class="form-line">
                        <?php require_once("fetch_insert_session.php");?>
                </div>
              </div>
            </div>
            <div class="col-2"> 		
              <div class="form-group">
                <div class="form-line">
                   <?php require_once("fetch_class.php");?>	       
                </div>
              </div>
            </div>
            <div class="col-2"> 		
              <div class="form-group">
                <div class="form-line">
                       <?php require_once("fetch_insert_semester.php");?>	     
                </div>
              </div>
            </div>
            <div class="col-1"> 		
              <div class="form-group">
                <div class="form-line">
                    <input name="Submit" value="Fetch Record" type="submit" class="btn btn-success">                     
                </div>
              </div>
            </div>
            <?php }?>
        </div>
        </form>
            </div>
       </div>
    </div>
</div>
<?php require_once("result_footer.php");?>
<script>
    function progm()
    {
        //alert("welcome");
        var prg= document.getElementById("programme").value;
        window.location.href="?progs="+prg;
    }
</script>