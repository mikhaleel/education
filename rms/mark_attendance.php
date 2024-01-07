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
                <tr>
                    <th>#</th>
                    <th>Course Code</th>
                    <th>Course Title</th>
                    <th>Course Unit</th>
                    <th>Semester</th>
                    <th>Level</th>
                    <th>Status</th>
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
            Preview</a>
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
                    <th>Course Code</th>
                    <th>Course Title</th>
                    <th>Course Unit</th>
                    <th>Semester</th>
                    <th>Level</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            <?php $rr_row = get_all_programmes($pdo); foreach($rr_row as $pr=> $theprogramme){  
            $sort_courses = $pdo->query("SELECT * FROM `course` WHERE `semester` ='".$_SESSION['rsemester']."' AND `programme` LIKE '$theprogramme'");
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
                <?php 
            }
        }
            ?>
            </tbody>
            </table>
        </div>
<p></p>
<?php
 }
 ?>
 <?php 
 /**
 <select name="pick" class="form-control">
     <option valu="">Select a Programme</option>
     <a href='?'><div class='btn btn-warning btn-md btn btn-block'>All <br> Courses</div></a>&nbsp;&nbsp;&nbsp;
             <?php $r_row = get_all_programmes($pdo); foreach($r_row as $pr=> $theprogramme)
             {
              $courses = $pdo->query("SELECT * FROM `course` WHERE  `semester` ='".$_SESSION['rsemester']."' AND `programme` LIKE '$theprogramme' GROUP BY `semester`, `level`");
                while($rows = $courses->fetch())
                {
                 $whatIWant = substr($theprogramme, strpos($theprogramme, "IN ") + 3);    
                   // echo $whatIWant;
                    if($rows['semester'] == "" OR $rows['level'] == ""){ 
    
                    }else{
                   ?>
                <tr>
               <option>
                    <?php
                    echo "<a href='?frecs=".$rows['semester']."&level=".$rows['level']."&programme=".$theprogramme."' class='btn btn-primary'>";?>
                    
                    <?php echo $theprogramme;?>- -<?php echo $c_arr[$rows['semester']];?> - <?php echo $rows['level'];?>
                    <?php echo  "VIEW</a>";?>
               </option>
                <?php 
                    }
                }
            }?>
 </select>
 **/
 ?>
    <div class="table-responsive">
        <table id="order-listing." class="table">
        <thead>
            <tr> 
                <th>#</th>
                <th>PROGRAMME</th>
                <th>SEMESTER</th>
                <th>LEVEL</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <a href='?'><div class='btn btn-warning btn-md btn btn-block'>All <br> Courses</div></a>&nbsp;&nbsp;&nbsp;
             <?php $r_row = get_all_programmes($pdo); foreach($r_row as $pr=> $theprogramme)
             {
              $courses = $pdo->query("SELECT * FROM `course` WHERE  `semester` ='".$_SESSION['rsemester']."' AND `programme` LIKE '$theprogramme' GROUP BY `semester`, `level`");
                while($rows = $courses->fetch())
                {
                 $whatIWant = substr($theprogramme, strpos($theprogramme, "IN ") + 3);    
                   // echo $whatIWant;
                    if($rows['semester'] == "" OR $rows['level'] == ""){ 
    
                    }else{
                   ?>
                <tr>
                <td></td>
                <td><?php echo $theprogramme;?></td>
                <td><?php echo $c_arr[$rows['semester']];?></td>
                <td><?php echo $rows['level'];?></td>
                <td>
                 <?php
                    echo "<a href='?frecs=".$rows['semester']."&level=".$rows['level']."&programme=".$theprogramme."' class='btn btn-primary'>VIEW</a>&nbsp;&nbsp;&nbsp;";
                
                ?>
                    
                </td>
               
                
                </tr>
                <?php 
                    }
                }
            }?>
        </tbody>
        </table>
    
 </div>
    </div>
    </div>
</div>
<?php include("result_footer.php");?>