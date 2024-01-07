<?php $pagename= "Upload Scores"; include("result_header.php"); $dept_id = $_SESSION['dept_id'];
function count_scores_entered($pdo, $code, $programme, $level)
{
    $fquery = $pdo->query("SELECT * FROM `results` WHERE `code` LIKE '$code' AND `programme` LIKE '$programme' AND `level` = '$level' AND  `semester`= '".$conf_semester."' AND `session` = '".$conf_session."'");
    $row = $fquery->rowcount();
    return $row;
}
function fetchecourses($pdo, $programme){     
$ccqry = $pdo->query("SELECT * FROM `course` WHERE `programme` LIKE '$programme' AND `semester` = '".$conf_semester."' ORDER BY `semester`, `level`"); 
return $ccqry;  
}  
if(isset($_POST["uploadResult"]))
{
    if($_POST['code'] =="")
    {
        echo "
        <div class='alert alert-danger'>Empty fields not allowed</div>
        <script>setTimeout(function(){location.href='managescores.php'},2000)</script>";
    }
    else
    {
        $uqry = $pdo->query("SELECT * FROM `course` WHERE `programme` LIKE '".$_POST["programme"]."' AND `semester` = '".$conf_semester."' AND `code` = '".$_REQUEST['code']."' ORDER BY `semester`, `level`");

        $urows = $uqry->fetch(PDO::FETCH_ASSOC);
        $level = $urows["level"]; 
        $coursetitle = $urows["title"]; 
        $courseunit = $urows["unit"];  
        $cunit = $urows["unit"];  
        $programme = $urows["programme"];  
        $coursecode = $_REQUEST['code'];
        
        $s_tatus = substr($level, -1).$conf_semester;

        include("loadcsvresult.php");
    }
}
?>    
<div class="card">
    <div class="card-body">
        <!-- <h4 class="card-title">Data table<?php //echo $dpt;?></h4> -->
<hr>
        <div class="row">
            <div class="col-12">
            <div class="table-responsive">
                <table id="order-listing" class="table">
                    <thead>
                        <tr class="bg-success text-white">
                            <th>#</th>
                            <th>Course Code</th>
                            <th>Course Title</th>
                            <th>level</th>
                            <th>Course Unit</th>
                            <th>Records Entered</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $srn = 0;  
                        $r_row = get_all_programmes($pdo); foreach($r_row as $pr1=> $theprogramme){  
                            
                            $ccqry = $pdo->query("SELECT * FROM `course` WHERE `programme` LIKE '$theprogramme' AND `semester` = '".$conf_semester."' ORDER BY `semester`, `level`");
                            
                        //$ccqry = fetchecourses($pdo, $theprogramme);
                        while($coderow = $ccqry->fetch()){
                            $srn++;
                            $coursecodes = $coderow['code'];
                            $courselevel = $coderow['level'];
                            $crsprog = $coderow['programme'];
                            
                            $fquery = $pdo->query("SELECT * FROM `results` WHERE `code` LIKE '$coursecodes' AND `programme` LIKE '$crsprog' AND `level` = '$courselevel' AND  `semester`= '".$conf_semester."' AND `session` = '".$conf_session."'");
                        $cnts = $fquery->rowcount();
                        
                       // $cnts =  count_scores_entered($pdo,  $coderow['code'], $coderow['programme'], $coderow['level']);
                        //if($cnts == 0){
                        $cod = encryptor('encrypt',$coderow['code']); 
                        $prg = encryptor('encrypt',$coderow['programme']);
                        $lvl=encryptor('encrypt',$coderow['level']);
                        ?>
                        <tr>
                            <td><?php echo $srn;?></td>
                            <td><?php echo $coderow['code'];?></td>
                            <td><?php echo $coderow['title'];?></td>
                            <td><?php echo $coderow['level'];?></td>
                            <td><?php echo $coderow['unit'];?></td>
                            <td>
                                    <div class="badge badge-pill badge-outline-danger"><?php echo $cnts;?></div>
                            </td>
                            <td>
                                <?php if($cnts >0){?>
                            <a class="btn btn-inverse-primary" href="javascript:void(0);" NAME="Error Handling" class="btn btn-inverse-primary btn-block" title="View Scores" 
                            onClick=window.open("score_child?level=<?php echo $lvl.'&programme='.$prg.'&code='.$cod;?>","Ratting","width=650,height=650,left=250,top=10,toolbar=0,status=0");><span class="mdi mdi-view-list text-white">View</span></a>
                            <?php }
                            else{?>
                            <button class="btn btn-inverse-secondary">View</button>
                            <?php }?>                          
                            
                        <a class="btn btn-inverse-success" href="javascript:void(0);" NAME="score page" title="Add Scores" onClick=window.open("add_score_page?scorepage=&code=<?php echo $cod.'&level='.$lvl.'&unit='.encryptor('encrypt',$coderow['unit']).'&programme='.$prg;?>","Ratting","width=650,height=700,left=150,top=50,toolbar=0,status=0,");><span class="mdi mdi-plus-box text-primary">Add Score</span></a>

                            </td>
                        </tr>
                        <?php 
                       }
                        }?>
                    </tbody>
                </table>
            </div>
            </div>
        </div>
    </div>
</div>
<?php include("result_footer.php");?>