<?php $pagename= "Upload Scores"; include("result_header.php"); $dept_id = $_SESSION['dept_id'];
$the_semesters = 2;
$the_session = "2021/2022";
function count_scores_entered($pdo, $code, $programme, $level)
{
   $fquery = $pdo->query("SELECT * FROM `results` WHERE `code` LIKE '$code' AND `programme` LIKE '$programme' AND `level` = '$level' AND  `semester`= '".$the_semesters."' AND `session` LIKE '".$the_session."'");
    $row = $fquery->rowcount();
    return $row;
}
function fetchecourses($pdo, $programme){     
$ccqry = $pdo->query("SELECT * FROM `course` WHERE `programme` LIKE '$programme' AND `semester` = '".$the_semesters."' ORDER BY `semester`, `level`"); 
return $ccqry;  
}  
if(isset($_POST["uploadResult"]))
{
    if($_POST['code'] =="")
    {
        echo "
        <div class='alert alert-danger'>Empty fields not allowed</div>
        <script>setTimeout(function(){location.href='managescores.php'},2000)</script>
        ";
    }
    else
    {
        $ccodes = $_REQUEST['code'];
        $uqry = $pdo->query("SELECT * FROM `course` WHERE `programme` LIKE '".$_POST["programme"]."' AND `semester`= '$the_semesters' AND `code` = '$ccodes' ORDER BY `semester`, `level`");

        $urows = $uqry->fetch(PDO::FETCH_ASSOC);
        $level = $urows["level"]; 
        $coursetitle = $urows["title"]; 
        $courseunit = $urows["unit"];  
        $cunit = $urows["unit"];  
        $programme = $urows["programme"];  
        $coursecode = $_REQUEST['code'];
        
        $s_tatus = substr($level, -1).$the_semesters;
        include("loadcsv.php");
    }
}
?>    
<div class="card">
    <div class="card-body">
        <!-- <h4 class="card-title">Data table<?php //echo $dpt;?></h4> -->
            <div class="row"> <!--beginig of first row-->
             <div class="col-8">
            <div class="table-responsive">
            
            <table class="table">
                    <thead>
                        <tr class="bg-dark text-white">
                            <th>Programme</th>
                            <th>Level</th>
                            <th>Semester</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>  
                    <?php $pr_row = get_all_programmes($pdo); foreach($pr_row as $pr=> $theprogrammes){        
                        $fetchpl = $pdo->query("SELECT * FROM `course` WHERE `programme` = '$theprogrammes' AND `semester`= '$the_semesters' GROUP BY `programme`, `level`  ORDER BY `semester`, `level`");
                        while($rowspl = $fetchpl->fetch(PDO::FETCH_ASSOC)){?>                 
                        <tr>
                            <td><?php echo $rowspl['programme'];?></td>
                            <td><?php echo $rowspl['level'];?></td>
                            <td><?php echo $rowspl['semester'];?></td>
                            <td>
                                <a class="btn btn-inverse-primary btn-block" href="?programme=<?php echo encryptor('encrypt',$rowspl['programme']).'&flevel='.encryptor('encrypt',$rowspl['level']);?>">Upload</a>
                            </td>
                        </tr>
                        <?php 
                    }
                    }?>

                    </tbody>
                </table>                
                        
              
             </div>
             </div>
             <div class="col-4">          
           <?php 
            if(isset($_GET['flevel']))
            {  // $_SESSION["department"];//$_SESSION["deptname"];
                $programme = encryptor('decrypt',$_GET['programme']);
                $level = encryptor('decrypt',$_GET['flevel']);
                $ccqry = $ccqry = $pdo->query("SELECT * FROM `course` WHERE `programme` LIKE '$programme' AND `semester`= '$the_semesters' AND `level` = '$level' ORDER BY `semester`, `level`");   
                ?>        
        <!-- <a href='managescores.php' class='float-right btn btn-danger'>Back</a> -->        
            <div class="row bg-primary text-white" style="font-size:6ptl">
                <div class="col-12">
                    <div>PROGRAMME: <?php echo $programme;?></div>	
                    <div>LEVEL: <?php echo $level;?></div>
               
                    <div>SEMESTER: <?php echo $the_semesters;?></div>	
                    <div>SESSION: <?php echo $the_session;?></div>
                </div>
            </div>	
                <hr>	

            <form  method="post" action="" class="form-inline" enctype="multipart/form-data">
                <div class="row">            
                    <div class="col-12"> 
                        <div class="form-group">
                            <label>Select Course</label>
                            <input name="programme" type="hidden" value="<?php echo $programme;?>">
                            <select name="code" id="programme" class="js-example-basic-multiple form-control" style="width:100%">
                            <?php  
                                while($ccrows = $ccqry->fetch(PDO::FETCH_ASSOC))
                                {
                                ?>
                                    <option value="<?php echo $ccrows['code'];?>"><?php echo $ccrows['code']." - ".$ccrows['title'];?></option>
                                <?php 
                                }?>
                            </select>
                        </div>
                    </div>
                    <div class="col-12"> 		
                        <div class="form-group">
                            <label>Select file to Upload</label>
                            <input type="file" name="csvfile" class = "form-control col-5 mb-2 mr-sm-2">            
                            <span class="text-danger">*</span>the file must ne in <span class="text-danger">.csv file format</span></p>
                        </div> 
                    </div>
                    <div class="col-1">
                        <div class="form-group">
                            <label>&nbsp;</label>
                            <button name="uploadResult" type="Submit" class="btn btn-success  mb-2 mr-sm-2"> Import </button> <p>
                        </div> 
                    </div>
                </div>
            </form>
            <?php }?>
            </div>
        </div>     <!-- end of first row -->
<hr>

    </div>
</div>
<?php include("result_footer.php");?>