<?php $pagename= "View Courses"; include("result_header.php");?>
<?php
$c_arr = array(1=> "1st Semester", 2=>"2nd Semester");
$dpt = $_SESSION["names"];//$_SESSION["deptname"];

?>
<div class="card">
    <div class="card-body">
    <!-- <h4 class="card-title">Data table<?php //echo $dpt;?></h4> -->
    <div class="row">
        <div class="col-12">
        <a href='?'><div class='btn btn-secondary btn-md btn btn-block'>All <br> Courses</div></a>&nbsp;&nbsp;&nbsp;
            <?php $r_row = get_all_programmes($pdo); foreach($r_row as $pr=> $theprogramme){  
            $courses = $pdo->query("SELECT * FROM `course` WHERE `programme` LIKE '$theprogramme' GROUP BY `semester`, `level`");
            while($rows = $courses->fetch())
            {
                $whatIWant = substr($theprogramme, strpos($theprogramme, "IN ") + 3);    
               // echo $whatIWant;
                if($rows['semester'] == "" OR $rows['level'] == ""){ 

                }else{
                echo "<a href='?frecs=".$rows['semester']."&level=".$rows['level']."&programme=".$theprogramme."'><div class='btn btn-warning btn-md btn btn-block' style='font-size:5pt'>".$c_arr[$rows['semester']]."<br>".$rows['level']."<br>".$whatIWant."</div></a>&nbsp;&nbsp;&nbsp;";}
            }
        }
            ?>
            <p></p>
<?php
if(isset($_GET['frecs']))
{
    $session = $_GET["frecs"];
    $level = $_GET["level"];
    $programme = $_GET["programme"];
    $sort_courses = $pdo->query("SELECT * FROM `course` WHERE `programme` LIKE '$programme' && `semester` = '".$session."' && `level` ='".$level."' ORDER BY length(code),code ASC");
// $edit_student->execute([$dept, $session]);	
?>
        <div class="table-responsive">
            <table id="order-listing" class="table">
            <thead>
                <tr class="bg-primary text-white">
                    <th>#</th>
                    <th>Course Code</th>
                    <th>Course Title</th>
                    <th>Course Unit</th>
                    <th>Semester</th>
                    <th>Level</th>
                    <!-- <th>Status</th> -->
                    <!-- <th>Actions</th> -->
                </tr>
            </thead>
            <tbody>
            <?php
            $n=0;
            while($row = $sort_courses->fetch(PDO::FETCH_ASSOC))
            {
            $n++;?>
                <tr>
                    <td><?php echo $n;?></td>
                    <td><?php echo $row["code"];?></td>
                    <td><?php echo $row["title"];?></td>
                    <td><?php echo $row["unit"];?></td>
                    <td><?php echo $row["semester"];?></td>
                    <td><?php echo $row["level"];?></td>
                    <!-- <td>
                        <label class="badge badge-danger"><?php //echo @$row[""];?></label>
                    </td> -->
                    <!-- <td>
                        <button class="btn btn-outline-primary">View</button>
                    </td> -->
                </tr>
                <?php }?>
            </tbody>
            </table>
        </div>
        <?php 
        }
        else
        {    
            ?>
 <div class="table-responsive">
            <table id="order-listing" class="table">
            <thead>
                <tr class="bg-primary text-white">
                    <th>#</th>
                    <th>Course Code</th>
                    <th>Course Title</th>
                    <th>Course Unit</th>
                    <th>Semester</th>
                    <th>Level</th>
                    <!-- <th>Status</th> -->
                    <!-- <th>Actions</th> -->
                </tr>
            </thead>
            <tbody>
            <?php $rr_row = get_all_programmes($pdo); foreach($rr_row as $pr=> $theprogramme){  
            $sort_courses = $pdo->query("SELECT * FROM `course` WHERE `programme` LIKE '$theprogramme'");
            $n=0;
            while($row = $sort_courses->fetch(PDO::FETCH_ASSOC))
            {
            $n++;?>
                <tr>
                    <td><?php echo $n;?></td>
                    <td><?php echo $row["code"];?></td>
                    <td><?php echo $row["title"];?></td>
                    <td><?php echo $row["unit"];?></td>
                    <td><?php echo $row["semester"];?></td>
                    <td><?php echo $row["level"];?></td>
                    <!-- <td>
                        <label class="badge badge-danger"><?php //echo @$row[""];?></label>
                    </td> -->
                    <!-- <td>
                        <button class="btn btn-outline-primary">View</button>
                    </td> -->
                </tr>
                <?php 
            }
        }
            ?>
            </tbody>
            </table>
        </div>

       <?php
        }
        ?>
        </div>
    </div>
    </div>
</div>
<?php include("result_footer.php");?>