<?php $pagename= "Score Templates"; include("result_header.php");?>
<?php
function count_scores_entered($pdo, $code, $programme, $level)
{
    $fquery = $pdo->query("SELECT * FROM `results` WHERE `code` LIKE '".$code."' AND `programme` LIKE '%$programme%' AND `level` = '".$level."' AND  `semester`= '".$_SESSION['rsemester']."' AND `session` LIKE '".$_SESSION['rsession']."'");
    $row = $fquery->rowcount();
    return $row;
}
$c_arr = array(1=> "1st Semester", 2=>"2nd Semester");
?>
        <div class="table-responsive">
            <table id="order-listing" class="table">
            <thead>
                <tr class="bg-dark text-white">
                    <th>#</th>
                    <th>Course Code</th>
                    <th>Course Title</th>
                    <th>Course Unit</th>
                    <th>Semester</th>
                    <th>Level</th>
                    <th>Reords</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            <?php
                $r_row = get_all_programmes($pdo); foreach($r_row as $pr=> $theprogramme){ 
                $courses = $pdo->query("SELECT * FROM `course` WHERE `programme` LIKE '$theprogramme' AND `semester` = '".$_SESSION['rsemester']."' ORDER BY `semester`, `level`");
            $n=0;
            while($row = $courses->fetch(PDO::FETCH_ASSOC))
            {
               $cnt =  count_scores_entered($pdo,  $row["code"], $theprogramme, $row["level"]);
            $n++;?>
                <tr>
                    <td><?php echo $n;?></td>
                    <td><?php echo $row["code"];?></td>
                    <td><?php echo $row["title"];?></td>
                    <td><?php echo $row["unit"];?></td>
                    <td><?php echo $row["semester"];?></td>
                    <td><?php echo $row["level"];?></td>
                    <td><label class="btn btn-outline-primary"><?php  echo $cnt;?></label></td>
                    
                    <td><a href="download_csv?csvss=&code=<?php echo encryptor('encrypt',$row["code"])."&level=".encryptor('encrypt',$row["level"])."&programme=".encryptor('encrypt',$row["programme"]);?>" class="btn btn-primary">Download Score Sheet</a></td>
                </tr>
                <?php 
            }
        }
            ?>
            </tbody>
            </table>
        </div>
        <?php 
      //  }
        ?>
        </div>
    </div>
    </div>
</div>
<?php include("result_footer.php");?>
<script>
$(document).ready(function() {
    $("#scoreform").submit(function(e) {
        e.preventDefault()
        let data = $("#scoreform").serialize()
        let appReq = $.ajax({
            url: "score_add.php",
            type: "POST",
            data: data,
            beforeSend: () => {
                $("#scorebtn").html("Processing...")
                $("#scorebtn").attr("disabled", "true")
            },
            complete: () => {
                $("#scorebtn").html("Submitted")
                $("#scorebtn").removeAttr("disabled")
            },
            success: (res) => $("#scoreresult").html(res)
        })
    })
})
</script>