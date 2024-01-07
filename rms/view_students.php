<?php $pagename= "View Students"; include("result_header.php");?>
<div class="card">
    <div class="card-body">
    <h4 class="card-title"></h4>
    <div class="row">
        <div class="col-12">
        <a href='?'><div class='btn btn-warning btn-lg btn btn-block'>All <br> Students</div></a>&nbsp;&nbsp;&nbsp;
            <?php 
            $r_row = get_all_programmes($pdo); foreach($r_row as $pr=> $theprogramme){             
            $students = $pdo->query("SELECT * FROM `students` WHERE `programme` LIKE '$theprogramme' GROUP BY `session`, `level`");
            $whatIWant = substr($theprogramme, strpos($theprogramme, "IN ") + 3);
            while($rows = $students->fetch())
            {
                if($rows['session'] == "" OR $rows['level'] == ""){ 

                }else{
                echo "<a href='?frecs=".$rows['session']."&level=".$rows['level']."&programme=".$theprogramme."'><div class='btn btn-info btn-lg btn btn-block'  style='font-size:5pt'>". $rows['session']."<br>".$rows['level']."<br>".$whatIWant."</div></a>&nbsp;&nbsp;&nbsp;";
                }
            }
        }
            ?>
            <p></p>
            <?php 
            
if(isset($_GET['frecs'])){
    $session = $_GET["frecs"];
    $level = $_GET["level"];
    $programme = $_GET["programme"];
    $edit_student = $pdo->query("SELECT * FROM `students` WHERE `programme` LIKE '$programme' && `session` = '".$session."' && `level` ='".$level."' ORDER BY length(matno),matno ASC");
    // $edit_student->execute([$dept, $session]);	
    
    ?>
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
                        <label class="badge badge-danger"><?php echo $row["Withdrwan"];?></label>
                    </td>
                    <td>
                        <button class="btn btn-outline-primary">View</button>
                    </td>
                </tr>
                <?php }?>
            </tbody>
            </table>
        </div>
        <?php 
        }
        else
        {  ?> 
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
            $pr_row = get_all_programmes($pdo); foreach($pr_row as $pr=> $theprogramme){  
                $edit_student = $pdo->query("SELECT * FROM `students` WHERE `programme` LIKE '$theprogramme'");
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
                        <label class="badge badge-danger"><?php echo $row["Withdrwan"];?></label>
                    </td>
                    <td>
                        <button class="btn btn-outline-primary">View</button>
                    </td>
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