<?php include("../data/db.php");
if(isset($_POST["datums"]))
{
    
$in_data = unserialize(encryptor("decrypt", $_POST['datums']));
    ?>
<div id="editResult"></div>    
<div class="row">    
    <div class="col-12">Programme: <?php echo $programme = $in_data["programme"];?></div>
    <div class="col-6">Course Code: <?php echo $code = $in_data["code"];?></div>
    <div class="col-6">Level: <?php echo $level = $in_data["level"];?></div>
    <div class="col-6">Session: <?php echo $session = $in_data["session"];?></div>
    <div class="col-6">Semester: <?php echo $semester = $in_data["semester"];?></div>
</div>
    
<form id="inputForm">
<div class="container-fluid mt-5 d-flex justify-content-center w-100">
    <div class="table-responsive w-100">
    <table class="table">
        <thead>
            <tr class="bg-dark text-white">
                <th>#</th>
                <!-- <th>NAME</th> -->
                <th> MATRIC NUMBER</th>
                <th>SCORE</th>
            </tr>
        </thead>
        <tbody>
        <?php
         $qry = $pdo->query("SELECT *  FROM `stu_course_reg` WHERE `level` LIKE '".$level."' AND `session` LIKE '".$session."' AND `semester` LIKE '".$semester."' AND `coursecode` LIKE '".$code."' AND `programme` LIKE '".$programme."'");

        // $qry = $pdo->prepare("SELECT * FROM `stu_course_reg` WHERE programme = ? &&  `semester` = ? && `level` = ? && `coursecode` = ? && `session`= ? GROUP BY `coursecode`");
        // $qry->execute([$_POST['programme'], $_POST['semester'], $_POST['level'], $_POST["code"], $_POST['session']]);
       
        $mn = 0; 
      //  while($stdrows = $stdt_qry->fetch(PDO::FETCH_ASSOC))
        while($found_q = $qry->fetch(PDO::FETCH_ASSOC))
        {
            $res_qry = $pdo->prepare("SELECT * FROM `results` WHERE `matno` = ? && `code` = ? ORDER BY `results`.`matno` ASC");
            $res_qry->execute([$found_q["matno"], $code]);
            $res_row = $res_qry->fetch();
            $mn++;
            ?>
            <tr>
                <td scope="row"><?php echo $mn;?></td>
                <!-- <td><?php //echo @$found_q["names"];?> <input name="names[]" value="<?php //echo @$found_q["names"];?>" type="hidden"></td> -->
                <td><?php echo $found_q["matno"];?> 
                    <input name="matno[]" value="<?php echo encryptor('encrypt',$found_q["matno"]);?>" type="hidden">
                </td>
                <td>
                <div class="col-sm-4">
                    <div class="form-group">          
                    <input name="score[]" type="text" class="form-control" value="<?php echo @$res_row['score'];?>">								
                    <input name="sid[]" type="hidden" class="form-control" value="<?php echo @$res_row['id'];?>">								
                    <input name="programme" value="<?php echo $in_data["programme"];?>" type="hidden">
                    <input name="semester" value="<?php echo $in_data["semester"];?>" type="hidden">
                    <input name="level" value="<?php echo $in_data["level"];?>" type="hidden">
                    <input name="code" value="<?php echo $in_data["code"];?>" type="hidden">
                    <input name="level" value="<?php echo $in_data["level"];?>" type="hidden">
                    <input name="unit" value="<?php echo $in_data['unit'];?>" type="hidden">
                    
                    </div>
                </div>
                </td>
            </tr>
            <?php 
        }?>
        </tbody>
        <tfoot>
            <tr>
                <th colspan="2"></th>
                <th><button class="btn btn-primary pull-left" type="Submit" name="savescore" id="inputBtn"> SUBMIT SCORES </button></th>
            </tr>
        </tfoot>
        </tbody>
    </table>
    </div>
</div>
    </form>

 <?php    
}?>

<script>
		$(document).ready(function() {
			$("#inputForm").submit(function(e) {
				e.preventDefault()
				let data = $("#inputForm").serialize()
				let appReq = $.ajax({
					url: "edit_scores_sub.php",
					type: "POST",
					data: data,
					beforeSend: () => {
						$("#inputBtn").html("Processing...")
						$("#inputBtn").attr("disabled", "true")
					},
					complete: () => {
						$("#inputBtn").html("Begin")
						$("#inputBtn").removeAttr("disabled")
					},
					success: (res) => $("#editResult").html(res)
				})
			})
		})
	</script>