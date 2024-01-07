<?php include("result_header.php");?>
<?php
echo $dpt = $_SESSION["names"];//$_SESSION["deptname"];
$students = $pdo->query("SELECT * FROM `students` WHERE `programme` LIKE '%".$dpt."%' GROUP BY `session`, `level`");

if(isset($_GET['frecs'])){
$session = encryptor('decrypt',$_GET["frecs"]);
$level = encryptor('decrypt',$_GET["level"]);
$edit_student = $pdo->query("SELECT * FROM `students` WHERE `programme` LIKE '%".$dpt."%' && `session` = '".$session."' && `level` ='".$level."' ORDER BY length(matno),matno ASC");
// $edit_student->execute([$dept, $session]);	
}
else
{    
    //$dpt = "%".$_SESSION["deptname"]."%";
    $edit_student = $pdo->query("SELECT * FROM `students` WHERE `programme` LIKE '%".$dpt."%'");
}

?>
<div class="card">
    <div class="card-body">
    <h4 class="card-title">Data table<?php echo $dpt;?></h4>
    <div class="row">
        <div class="col-12">
        <a href='?'><div class='btn btn-warning btn-lg btn btn-block'>All <br> Students</div></a>&nbsp;&nbsp;&nbsp;

            <?php 
            while($rows = $students->fetch())
            {
                if($rows['session'] == "" OR $rows['level'] == ""){ 

                }else{
                echo "<a href='?frecs=".encryptor('encrypt',$rows['session'])."&level=".encryptor('encrypt',$rows['level'])."'><div class='btn btn-info btn-lg btn btn-block'>". $rows['session']."<br>".$rows['level']."</div></a>&nbsp;&nbsp;&nbsp;";}
            }
            
            if(isset($_GET['del']))
            {
                $session = encryptor('decrypt',$_GET["session"]);
                $level = encryptor('decrypt',$_GET["level"]);
                $id = encryptor('decrypt',$_GET["del"]);
                $qry = $pdo->prepare("DELETE FROM `students` WHERE `id`=?");
                $qry->execute([$id]);
                if($qry)
                {

                }
                
                if($qry){ echo "<div class='alert alert-info'>Success</div><script>setTimeout(function(){location.href='?frecs=".encryptor('encrypt',$session)."&level=".encryptor('encrypt',$level)."'},20)</script>";}

            }
            if(isset($_POST['stdntedit']))
            {
                $names = $_POST['names'];
                $matno = $_POST['matno'];
                $level = $_POST['level'];
                $session = $_POST['session'];
                $esession = $_POST['esession'];
                $id =  encryptor('decrypt', $_POST['id']);
                $students_edit = $pdo->prepare("UPDATE `students` SET `names`=?, `matno`=?, `level`=?, `session`=?, `entry_session`=? WHERE `id` = ?");
                $students_edit->execute([$names, $matno, $level, $session, $esession, $id]);
                if($students_edit){ echo "<div class='alert alert-info'>Success</div><script>setTimeout(function(){location.href='?frecs=".encryptor('encrypt',$session)."&level=".encryptor('encrypt',$level)."'},20)</script>";}
                
            }
            ?>
            <p></p>
        <div class="table-responsive">
            <table id="order-listing" class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Matric No</th>
                    <th>Entry_Session</th>
                    <th>Current_Session</th>
                    <th>Level</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            <?php
            $n=0;
            while($row = $edit_student->fetch(PDO::FETCH_ASSOC))
            {
            $n++;?>
                <tr>
                    <td><?php echo $n;?></td>
                    <td><?php echo $row["names"];?></td>
                    <td><?php echo $row["matno"];?></td>
                    <td><?php echo $row["entry_session"];?></td>
                    <td><?php echo $row["session"];?></td>
                    <td><?php echo $row["level"];?></td>
                    <td>
                    <div class="modal fade" id="exampleModal-<?php echo $n;?>" tabindex="-1" role="dialog" aria-hidden="true">                        
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                            <form name="form<?php echo $n;?>" method="post">
                            <div class="modal-header">
                                <h4>EDIT <?php echo $row["matno"];?> RECORDS</h4>
                                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="names" class="col-form-label">Name:</label>
                                    <input type="text" name="names" class="form-control" id="names" value="<?php echo $row["names"];?>">
                                </div>     
                                <div class="row">
                                <div class="form-group col-6">
                                    <label for="matno" class="col-form-label"> Matric No.:</label>
                                    <input type="text" name="matno" class="form-control" id="matno" value="<?php echo $row["matno"];?>">
                                </div>                           
                                <div class="form-group col-6">
                                    <label for="level" class="col-form-label"> Level:</label>
                                    <input type="text" name="level" class="form-control" id="level" value="<?php echo $row["level"];?>">
                                    <input type="hidden" name="id" value="<?php echo encryptor('encrypt', $row["id"]);?>">
                                </div>   
                                </div>                                     
                                <div class="row">                           
                                <div class="form-group col-6">
                                    <label for="session" class="col-form-label">Session:</label>
                                    <input type="text" name="session" class="form-control" id="session" value="<?php echo $row["session"];?>">
                                </div>                              
                                <div class="form-group col-6">
                                    <label for="courslevel" class="col-form-label">Entry Session:</label>
                                    <input type="text" name="esession" class="form-control" id="esession" value="<?php echo $row["entry_session"];?>">
                                </div>
                                </div> 
                            </div>
                            <div class="modal-footer">
                                <button type="submit" name="stdntedit" class="btn btn-success">Send message</button>
                                <!-- <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button> -->
                            </div>                         
                            </form>
                            </div>
                        </div>
                        </div>        
                        <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#exampleModal-<?php echo $n;?>" data-whatever="">Edit</button>
                    </td>
                    <td>
                    <a href="?del=<?php echo encryptor('encrypt', $row["id"])."&session=".encryptor('encrypt',$row['session'])."&level=".encryptor('encrypt',$row['level'])."&matno=".encryptor('encrypt',$row['matno']);?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete <?php echo $row['matno'];?>?')">Delete</a>
                    </td>
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