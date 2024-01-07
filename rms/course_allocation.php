<?php $pagename= "Upload Scores"; include("result_header.php"); $dept_id = $_SESSION['dept_id'];
function count_scores_entered($pdo, $code, $programme, $level)
{
    $fquery = $pdo->query("SELECT * FROM `results` WHERE `code` LIKE '$code' AND `programme` LIKE '$programme' AND `level` = '$level' AND  `semester`= '".$_SESSION['rsemester']."' AND `session` LIKE '".$_SESSION['rsession']."'");
    $row = $fquery->rowcount();
    return $row;
}
function fetchecourses($pdo, $programme){     
$ccqry = $pdo->query("SELECT * FROM `course` WHERE `programme` LIKE '$programme' AND `semester` = '".$_SESSION['rsemester']."' ORDER BY `semester`, `level`"); 
return $ccqry;  
}  
// if(isset($_POST["uploadResult"]))
// {
//     if($_POST['code'] =="")
//     {
//         echo "
//         <div class='alert alert-danger'>Empty fields not allowed</div>
//         <script>setTimeout(function(){location.href='managescores.php'},2000)</script>
//         ";
//     }
//     else
//     {
//         $uqry = $pdo->query("SELECT * FROM `course` WHERE `programme` LIKE '".$_POST["programme"]."' AND `semester` = '".$_SESSION['rsemester']."' AND `code` = '".$_REQUEST['code']."' ORDER BY `semester`, `level`");
//         $urows = $uqry->fetch(PDO::FETCH_ASSOC);
//         $level = $urows["level"]; 
//         $coursetitle = $urows["title"]; 
//         $courseunit = $urows["unit"];  
//         $cunit = $urows["unit"];  
//         $programme = $urows["programme"];  
//         $coursecode = $_REQUEST['code'];
        
//         $s_tatus = substr($level, -1).$_SESSION["rsemester"];

//         include("loadcsvresult.php");
//     }
// }
?>    
<div class="card">
    <div class="card-body">
        <!-- <h4 class="card-title">Data table<?php //echo $dpt;?></h4> -->
        <div class="row"> <!--beginig of first row-->
            <div class="col-4">
            <div class="table-responsive">
            <table class="table">
                    <thead>
                        <tr class="bg-dark text-white">
                            <th>Name</th>
                            <th>Email</th>
                            <th>GSM</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>  
                    <?php //$pr_row = get_all_programmes($pdo); foreach($pr_row as $pr=> $theprogrammes){        
                        $fetchpl = $pdo->query("SELECT * FROM `staff` WHERE `department` = '".$_SESSION['department']."' AND `designation` = 'Lecturer' ");
                        while($rowspl = $fetchpl->fetch(PDO::FETCH_ASSOC)){?>                 
                        <tr>
                            <td><?php echo $rowspl['names'];?></td>
                            <td><?php echo $rowspl['email'];?></td>
                            <td><?php echo $rowspl['gsm'];?></td>
                            <td>
                                <a class="btn btn-inverse-primary btn-block" href="javascript:void(0);" NAME="Error Handling" title="Course Allocation" onClick=window.open("alloc_child?names=<?php echo encryptor('encrypt',$rowspl['names']).'&id='.encryptor('encrypt',$rowspl['id']);?>","Ratting","width=1500,height=1100,left=20,top=100,toolbar=0,status=0,");>Allocate</a>
                            </td>
                        </tr>
                        <?php 
                    }
                   // }?>

                    </tbody>
                </table>                
                        
              
             </div>
             </div>
        
            <div class="col-8">
            <div class="table-responsive">
                <table id="order-listing" class="table">
                    <thead>
                        <tr class="bg-success text-white">
                            <th>#</th>
                            <th>Course Code /Title</th>
                            <th>Unit</th>
                            <th>Name of Staff</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $srn = 0;      $r_row = get_all_programmes($pdo); foreach($r_row as $pr1=> $theprogramme){  
                        $ccqry = fetchecourses($pdo, $theprogramme);
                        while($coderow = $ccqry->fetch()){
                            $srn++;
                        $cnts =  count_scores_entered($pdo,  $coderow['code'], $coderow['programme'], $coderow['level']);
                        //if($cnts == 0){
                        $cod = encryptor('encrypt',$coderow['code']); 
                        $prg = encryptor('encrypt',$coderow['programme']);
                        $lvl=encryptor('encrypt',$coderow['level']);
                        ?>
                        <tr>
                            <td><?php echo $srn;?></td>
                            <td><?php echo $coderow['code'];?> - <?php echo $coderow['title'];?></td>
                            <td><?php echo $coderow['unit'];?></td>
                            <td>
                            <?php
                             $llqry = $pdo->query("SELECT `staffname` FROM `staff_allocation` 
                             WHERE 
                             `coursecode` LIKE '".$coderow['code']."' AND
                             `programme` LIKE '".$coderow['programme']."' AND
                             `semester` = '".$_SESSION['rsemester']."' AND
                             `session` = '".$_SESSION['rsession']."' 
                             ORDER BY `semester`");
                             $allrow = $llqry->fetch();
                             echo @$allrow['staffname'];
                            ?>
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