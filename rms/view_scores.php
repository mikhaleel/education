<?php $pagename= "View Scores"; include("result_header.php");?>
<?php
$c_arr = array(1=> "1st Semester", 2=>"2nd Semester");
$dpt = $_SESSION["names"]; //$_SESSION["deptname"];
//$smcnt = count($sem_arr);
$sscnt = count($ses_arr);
$lcnt = count($lev_arr);
?>
<div class="card">
    <div class="card-body">
    <h4 class="card-title"><?php echo $dpt;?></h4>
    <div class="row">
        <div class="col-12">
                <form method="POST">
                    <div class="row"> 
                    <div class="form-group col-5">
                            <div class="col">
                            <label> Select Programme</label>
                            <?php require_once("fetch_programme.php");?>
                            </div> 
                        </div> 
                        <?php if(isset($_GET["progs"])){?>
                        <div class="form-group col-2">
                            <div class="col">
                            <label> Select Level</label>
                            <?php require_once("fetch_class.php");?>
                            </div> 
                        </div> 
                        <div class="form-group col-2">
                            <label>Select Semester</label>
                            <select name="semester" class="js-example-basic-single" style="width:100%">
                            <option value="1">First Semester</option>
                            <option value="2">Second Semester</option>
                            </select>
                        </div>
                        <div class="form-group col-2">
                            <label>Select Session</label>
                            <select name="session" class="js-example-basic-single" style="width:100%">
                            <?php for($ss = 0; $ss < $sscnt; $ss++){?>
                            <option><?php echo $ses_arr[$ss];?></option>
                            <?php }?>
                            </select>
                        </div>
                        <div class="form-group col-1">
                            <label></label><br>
                            <button type="submit" name="frecs" class="btn btn-primary">Fetch Record</button>
                        </div>
                    </div>                      
                        <?php }?>
                </form>
            <p></p>
<?php 
if(isset($_POST['frecs']))
{
     $session = $_POST["session"];
     $level = $_POST["level"];
     $semester = $_POST["semester"];
     $programme = $_POST["programme"];

    $students = $pdo->query("SELECT * FROM `results` WHERE `programme` LIKE '$programme' AND `level` = '".$level."'AND `session` = '".$session."' AND `semester` = '".$semester."' GROUP BY `matno` ORDER BY length(matno),matno ASC");
    
    $sort_results = $pdo->query("SELECT * FROM `results` WHERE `programme` LIKE '$programme' AND `session` = '".$session."' AND `semester` = '".$semester."' AND `level` = '".$level."'");

    $sort_course_reg = $pdo->query("SELECT * FROM `stu_course_reg` WHERE `programme` LIKE '$programme' AND `session` = '".$session."' AND `semester` = '".$semester."' AND `level` = '".$level."' GROUP BY coursecode");

    $code_arr = array();
    while($codes = $sort_course_reg->fetch())
    {
        $code_arr[] = $codes['coursecode'];
    }
?>        
        <div class="table-responsive">
            <table id="order-listing" class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Matric No</th>
                    <?php 
                    $cnt = count($code_arr);
                    for($cs = 0; $cs < $cnt; $cs++){?>
                    <th><?php echo $code_arr[$cs];?></th>
                    <?php }?>
                    <th>Status</th>
                    <!-- <th>Actions</th> -->
                </tr>
            </thead>
            <tbody>
            <?php
            $n=0;
            while($row = $students->fetch(PDO::FETCH_ASSOC))
            {
            $n++;?>
                <tr>
                    <td><?php echo $n;?></td>
                    <td><?php echo $row["matno"];?></td>
                    <?php for($d = 0; $d < $cnt; $d++){
                        $sort_results = $pdo->query("SELECT `id`, `score` FROM `results` WHERE `matno`='".$row['matno']."' AND `code` = '".$code_arr[$d]."'");
                        $score_row = $sort_results->fetch();
                        ?>
                    <td><?php echo @$score_row['score'];?></td>
                    <?php }?>
                    <td>
                        <label class="badge badge-danger"><?php echo @$row[""];?></label>
                    </td>
                    <!-- <td>
                        <button class="btn btn-outline-primary">View</button>
                    </td> -->
                </tr>
                <?php }?>
            </tbody>
            </table>
        </div>
<?php }?>

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