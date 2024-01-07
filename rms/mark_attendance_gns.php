<?php $pagename= "Mark and Attendance"; include("result_header.php");?>
<?php
$c_arr = array(1=> "1st Semester", 2=>"2nd Semester");
$dpt = $_SESSION["names"];//$_SESSION["deptname"];

?>
<div class="card">
    <div class="card-body">
    <!-- <h4 class="card-title">Data table<?php //echo $dpt;?></h4> -->
    <div class="row">
        <div class="col-12">
        <!--<a href='?'><div class='btn btn-warning btn-md btn btn-block'>All <br> Courses</div></a>&nbsp;&nbsp;&nbsp;-->
       
            <p></p>
            <?php 
if(isset($_GET['frecs']))
{
    $session = $_GET["frecs"];
    $level = $_GET["level"];
    $programme = $_GET["programme"];
    $sort_courses = $pdo->prepare("SELECT * FROM `course` WHERE `code` LIKE 'GNS%' && `semester` = ? && `level` =? AND `programme` =? GROUP BY `code` ORDER BY length(code),code ASC");
    $sort_courses->execute([$session,$level,$programme]);
    // $edit_student->execute([$dept, $session]);	
    ?>
    <a href="mark_attendance_gns" class="btn btn-danger">Back</a>
    <h4><?php echo $programme. " - (".$level.")";?></h4>
        <div class="table-responsive">
            <table id="order-listing" class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <!--<th>Programme</th>-->
                    <th>Course Code</th>
                    <th>Course Title</th>
                    <th>Course Unit</th>
                    <th>Semester</th>
                    <th>Level</th>
                    <!--<th>Status</th>-->
                    <th>Actions</th>
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
                    <!--<td><?php //echo $row["programme"];?></td>-->
                    <td><?php echo $row["code"];?></td>
                    <td><?php echo $row["title"];?></td>
                    <td><?php echo $row["unit"];?></td>
                    <td><?php echo $row["semester"];?></td>
                    <td><?php echo $row["level"];?></td>
                    <td>
                        <a class="badge badge-primary" href="mark_attendance_print.php?dwnld=&csvss=&inputResult=&programme=<?php echo encryptor('encrypt',$row["programme"]).
            "&semester=".encryptor('encrypt',$row['semester']).
            "&ccode=".encryptor('encrypt',$row['code']).
            "&title=".encryptor('encrypt',$row['title']).
            "&year=".$row['level'].
            "&unit=".encryptor('encrypt',$row['unit']).
            "&class=".$row['level'];?>" target="_new"> Download </a>
                    </td>
                    <td>
            <a class="badge badge-primary" href="mark_attendance_print.php?csvss=&inputResult=&programme=<?php echo encryptor('encrypt',$row["programme"]).
            "&semester=".encryptor('encrypt',$row['semester']).
            "&ccode=".encryptor('encrypt',$row['code']).
            "&title=".encryptor('encrypt',$row['title']).
            "&year=".$row['level'].
            "&unit=".encryptor('encrypt',$row['unit']).
            "&class=".$row['level'];?>" target="_new"> 
            <!--<span class="btn btn-info">Score Sheet</span>-->
            View</a>
                    </td>
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
                <tr>
                    <th>#</th>
                    <th>Programme</th>
                    <!--<th>Course Code</th>-->
                    <!--<th>Course Title</th>-->
                    <!--<th>Course Unit</th>-->
                    <!--<th>Semester</th>-->
                    <th>Level</th>
                    <!--<th>Status</th>-->
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            <?php  
            $sort_courses = $pdo->prepare("SELECT * FROM `course` WHERE `code` LIKE 'GNS%' AND `semester` = ? GROUP BY `programme`,`level`,`semester` ORDER BY `programme` ASC");
            $sort_courses->execute([$_SESSION['rsemester']]);
            $n=0;
            while($row = $sort_courses->fetch(PDO::FETCH_ASSOC))
            {
            $n++;?>
                <tr>
                    <td><?php echo $n;?></td>
                    <td><?php echo $row["programme"];?></td>
                    <!--<td><?php //echo $row["code"];?></td>-->
                    <!--<td><?php //echo $row["title"];?></td>-->
                    <!--<td><?php //echo $row["unit"];?></td>-->
                    <!--<td><?php //echo $row["semester"];?></td>-->
                    <td><?php echo $row["level"];?></td>
                    <!--<td>-->
                    <!--    <label class="badge badge-success">Download</label>-->
                    <!--</td>-->
                    <td>
                     <?php 
                      echo "
                      <a href='?frecs=".$row['semester']."&level=".$row['level']."&programme=".$row['programme']."'>
                      <div class='btn btn-success btn-md btn btn-block'> Fetch Courses </div>
                      </a>";
                      /**
            <a class="badge badge-primary" href="mark_attendance_print.php?csvss=&inputResult=&programme=<?php echo encryptor('encrypt',$row["programme"]).
            "&semester=".encryptor('encrypt',$row['semester']).
            "&ccode=".encryptor('encrypt',$row['code']).
            "&title=".encryptor('encrypt',$row['title']).
            "&year=".$row['level'].
            "&unit=".encryptor('encrypt',$row['unit']).
            "&class=".$row['level'];?>" target="_new"> 
            <!--<span class="btn btn-info">Score Sheet</span>-->
            View</a>**/
                  ?>  </td>
                </tr>
                <?php 
            
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