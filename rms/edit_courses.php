<?php include("result_header.php");?>
<?php
$c_arr = array(1=> "1st Semester", 2=>"2nd Semester");
$dpt = $_SESSION["names"];//$_SESSION["deptname"];
$courses = $pdo->query("SELECT * FROM `course` WHERE `programme` LIKE '%".$dpt."%' GROUP BY `semester`, `level`");

if(isset($_GET['frecs'])){
$semester = encryptor('decrypt',$_GET["frecs"]);
$level = encryptor('decrypt',$_GET["level"]);
$sort_courses = $pdo->query("SELECT * FROM `course` WHERE `programme` LIKE '%".$dpt."%' && `semester` = '".$semester."' && `level` ='".$level."' ORDER BY length(code),code ASC");
// $edit_student->execute([$dept, $session]);	
}
else
{    
    //$dpt = "%".$_SESSION["deptname"]."%";
    $sort_courses = $pdo->query("SELECT * FROM `course` WHERE `programme` LIKE '%".$dpt."%'");
}

?>
<div class="card">
    <div class="card-body">
    <h4 class="card-title">Data table<?php echo $dpt;?></h4>
    <div class="row">
        <div class="col-12">
        <a href='?'><div class='btn btn-secondary btn-md btn btn-block'>All <br> Courses</div></a>&nbsp;&nbsp;&nbsp;
            <?php 
            while($rows = $courses->fetch())
            {
                if($rows['semester'] == "" OR $rows['level'] == ""){ 

                }else{
                echo "<a href='?frecs=".encryptor('encrypt',$rows['semester'])."&level=".encryptor('encrypt',$rows['level'])."'><div class='btn btn-warning btn-md btn btn-block'>". $c_arr[$rows['semester']]."<br>".$rows['level']."</div></a>&nbsp;&nbsp;&nbsp;";}
            }
            
            if(isset($_GET['del']))
            {
                $semester = encryptor('decrypt',$_GET["semester"]);
                $level = encryptor('decrypt',$_GET["level"]);
                $id = encryptor('decrypt',$_GET["del"]);
                $qry = $pdo->prepare("DELETE FROM `course` WHERE `sn`=?");
                $qry->execute([$id]);
                
                if($qry){ echo "<div class='alert alert-info'>Success</div><script>setTimeout(function(){location.href='?frecs=".encryptor('encrypt',$semester)."&level=".encryptor('encrypt',$level)."'},20)</script>";}

            }
            if(isset($_POST['courseedit']))
            {
                $title = $_POST['title'];
                $code = $_POST['code'];
                $unit = $_POST['unit'];
                $semester = $_POST['semester'];
                $level = $_POST['level'];
                $id =  encryptor('decrypt', $_POST['id']);
                $course_edit = $pdo->prepare("UPDATE `course` SET `title`=?, `code`=?, `unit`=?, `semester`=?, `level`=? WHERE `sn` = ?");
                $course_edit->execute([$title, $code, $unit, $semester, $level, $id]);
                if($course_edit){ echo "<div class='alert alert-info'>Success</div><script>setTimeout(function(){location.href='?frecs=".encryptor('encrypt',$semester)."&level=".encryptor('encrypt',$level)."'},20)</script>";}
                
            }
            ?>
            <p></p>
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
                    <th>Edit</th>
                    <th>Delete</th>
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
                        <div class="modal fade" id="exampleModal-<?php echo $n;?>" tabindex="-1" role="dialog" aria-hidden="true">                        
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                            <form name="form<?php echo $n;?>" method="post">
                            <div class="modal-header">
                                <h4>Edit <?php echo $row["code"];?></h4>
                                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="coursetitle" class="col-form-label">Course Title:</label>
                                    <input type="text" name="title" class="form-control" id="coursetitle" value="<?php echo $row["title"];?>">
                                </div>     
                                <div class="row">
                                <div class="form-group col-6">
                                    <label for="coursecode" class="col-form-label">Course code:</label>
                                    <input type="text" name="code" class="form-control" id="coursecode" value="<?php echo $row["code"];?>">
                                </div>                           
                                <div class="form-group col-6">
                                    <label for="courseunit" class="col-form-label">Course Unit:</label>
                                    <input type="text" name="unit" class="form-control" id="courseunit" value="<?php echo $row["unit"];?>">
                                    <input type="hidden" name="id" value="<?php echo encryptor('encrypt', $row["sn"]);?>">
                                </div>   
                                </div>                                     
                                <div class="row">                           
                                <div class="form-group col-6">
                                    <label for="coursesemester" class="col-form-label">Course Semester:</label>
                                    <input type="text" name="semester" class="form-control" id="coursesemester" value="<?php echo $row["semester"];?>">
                                </div>                              
                                <div class="form-group col-6">
                                    <label for="courslevel" class="col-form-label">Course Level:</label>
                                    <input type="text" name="level" class="form-control" id="courslevel" value="<?php echo $row["level"];?>">
                                </div>
                                </div> 
                            </div>
                            <div class="modal-footer">
                                <button type="submit" name="courseedit" class="btn btn-success">Send message</button>
                                <!-- <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button> -->
                            </div>                         
                            </form>
                            </div>
                        </div>
                        </div>        
                        <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#exampleModal-<?php echo $n;?>" data-whatever="">Edit</button>
                         
                    </td>
                    <td><a href="?del=<?php echo encryptor('encrypt', $row["sn"])."&semester=".encryptor('encrypt',$row['semester'])."&level=".encryptor('encrypt',$row['level']);?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete <?php echo $row['code'];?>?')">Delete</a></td>
                </tr>
                <?php }?>
            </tbody>
            </table>
        </div>
        </div>
    </div>
    </div>
</div>
<?php include("result_footer.php");?>