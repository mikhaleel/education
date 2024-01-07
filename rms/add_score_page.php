<?php include('../data/db.php'); include('../data/functions.php');
$semester_conv = array(1=>"First Semester", 2=>"Second Semester"); //$conf_semester?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>NIGER STATE POLYTECHNIC</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="assets/vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="assets/vendors/select2/select2.min.css">
    <link rel="stylesheet" href="assets/vendors/select2-bootstrap-theme/select2-bootstrap.min.css">
    <link rel="stylesheet" href="assets/vendors/datatables.net-bs4/dataTables.bootstrap4.css">
    <link rel="stylesheet" href="assets/vendors/jquery-bar-rating/css-stars.css">
    <link rel="stylesheet" href="assets/vendors/font-awesome/css/font-awesome.min.css">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="assets/css/demo_3/style.css">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="logos.png" />
   
  </head>
  <body>
    <div class="dot-opacity-loader" id="spinner">
        <span></span>
        <span></span>
        <span></span>
    </div>

    <div class="card">
        <div class="card-body">
            <!-- <h4 class="card-title"><?php //echo $dpt = $_SESSION['department'];?></h4> -->
            <div class="row">
                <div class="col-12">
                    <?php
                    if(isset($_GET['scorepage']))
                    {
                        $level =  encryptor('decrypt', $_GET['level']);
                        $programme =  encryptor('decrypt', $_GET['programme']);
                        $coursecode = encryptor('decrypt',$_GET['code']);
                        $courseunit = encryptor('decrypt',$_GET['unit']);
                        $semester = $conf_semester;
                        $session = $conf_session;      

                    //  $c_reg = $pdo->query("SELECT * FROM `stu_course_reg` WHERE coursecode='$coursecode' AND `semester` = '$semester' AND `programme` = '$programme' AND `level` = '$level' AND `session` = '$session'");
                        $c_reg = $pdo->query("SELECT * FROM `stu_course_reg` WHERE coursecode='$coursecode' AND `semester` = '$semester' AND `programme` = '$programme' AND `courselevel` = '$level' AND `session` = '$session' order by length(`matno`), `matno` ASC");
                    ?>
                    <h5>Score entry form for: </h5>
                    <div class="page-header flex-wrap">
                    <span class="header-right d-flex flex-wrap  mt-md-2 mt-lg-0">
                        Course Code: <?php echo $coursecode;?><br>
                        Course Unit: <?php echo $courseunit;?>
                        <br>Programme: <?php echo $programme;?>
                    </span>
                    
                    <span class="header-left d-flex flex-wrap  mt-md-2 mt-lg-0"> 
                        SEMESTER:<?php echo $semester_conv[$semester];?>  <br>
                        Level: <?php echo $level;?><br>
                        Session: <?php echo $session;?>
                    </span>
                    </div>
                    <p></p>
                    <br>    
                    <div id="scoreresult"></div>
                    <div class="table-responsive">
                    <form name="formscore" id="scoreform" onsubmit="return false">
                        <table id="order-listing." class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Matric Number</th>
                                <th>SCORE</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        $n=0;
                        while($row = $c_reg->fetch(PDO::FETCH_ASSOC))
                        { $mtno = $row['matno'];
                        // $resqry = $pdo->query("SELECT * FROM `results` WHERE `code` = '$coursecode' AND `matno` = '".$row["matno"]."' ");
                            $resqry = $pdo->query("SELECT * FROM `results` WHERE `code` = '$coursecode' AND `matno` = '$mtno' ");
                            $rows = $resqry->fetch();
                        $n++;?>
                            <tr>
                                <td><?php echo $n;?></td>
                                <td>
                                    <input name="matno[]" value="<?php echo $row["matno"];?>" type="hidden">                    
                                    <input name="code" value="<?php echo $coursecode;?>" type="hidden">
                                    <input name="programme" value="<?php echo $programme;?>" type="hidden">
                                    <input name="level" value="<?php echo $level;?>" type="hidden">
                                    <input name="unit" value="<?php echo $row["courseunit"];?>" type="hidden">
                                    <input name="title" value="<?php echo $row["coursetitle"];?>" type="hidden"> 
                                <?php echo $row["matno"];?></td>
                                <?php if($resqry->rowCount() > 0) 
                                {?>                    
                                    <td>
                                        <div class="col-3">
                                            <input name="scores[]" value="<?php echo $rows["score"];?>" class="form-control">
                                        </div>
                                    </td>                          
                                <?php 
                                }else
                                {?>
                                <td><div class="col-3"><input name="scores[]" value="0" class="form-control"></div></td>    
                                <?php 
                                }?>              
                            </tr>
                            <?php }?>
                            <tr>
                                <td colspan="2">
                                    <div class="pull-right">
                                        <button type="submit" id="scorebtn" class="btn btn-primary" name="scorebtn" value="sid">Submit Scores</button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                        </table>
                        </form>
                    </div>
                    <?php 
                    }?>
                </div>
            </div>
        </div>
    </div>

  </body>
    <script src="assets/vendors/js/vendor.bundle.base.js"></script>
<!-- endinject -->
<!-- Plugin js for this page -->
<script src="assets/vendors/select2/select2.min.js"></script>
<script src="assets/vendors/typeahead.js/typeahead.bundle.min.js"></script>
<script src="assets/vendors/datatables.net/jquery.dataTables.js"></script>
<script src="assets/vendors/datatables.net-bs4/dataTables.bootstrap4.js"></script>
<script src="assets/vendors/jquery-bar-rating/jquery.barrating.min.js"></script>
<script src="assets/vendors/chart.js/Chart.min.js"></script>
<script src="assets/vendors/flot/jquery.flot.js"></script>
<script src="assets/vendors/flot/jquery.flot.resize.js"></script>
<script src="assets/vendors/flot/jquery.flot.categories.js"></script>
<script src="assets/vendors/flot/jquery.flot.fillbetween.js"></script>
<script src="assets/vendors/flot/jquery.flot.stack.js"></script>
<script src="assets/js/jquery.cookie.js" type="text/javascript"></script>
<!-- End plugin js for this page -->
<!-- inject:js -->
<script src="assets/js/modal-demo.js"></script>
<script src="assets/js/off-canvas.js"></script>
<script src="assets/js/hoverable-collapse.js"></script>
<script src="assets/js/misc.js"></script>
<script src="assets/js/settings.js"></script>
<script src="assets/js/todolist.js"></script>
<!-- endinject -->
<!-- Custom js for this page -->
<script src="assets/js/dashboard.js"></script>
    <script src="assets/js/data-table.js"></script>
    <script src="assets/js/file-upload.js"></script>
    <script src="assets/js/typeahead.js"></script>
    <script src="assets/js/select2.js"></script>
    <script src="assets/js/jquery.min"></script>
<!-- End custom js for this page -->


<script>
    document.onreadystatechange = function() {
    if (document.readyState !== "complete") {
        document.querySelector(
            "body").style.visibility = "hidden";
        document.querySelector(
            "#spinner").style.visibility = "visible";
    } else {
        document.querySelector(
            "#spinner").style.display = "none";
        document.querySelector(
            "body").style.visibility = "visible";
    }
};

$(document).ready(function() {
    $("#scoreform").submit(function(e) {
        e.preventDefault()
        let data = $("#scoreform").serialize()
        let appReq = $.ajax({
            url: "score_add.php",
            type: "POST",
            data: data,
            beforeSend: () => {
                $("#scorebtn").html("Uploading scores please wait...")
                $("#scorebtn").attr("disabled", "true")
            },
            complete: () => {
                $("#scorebtn").html("Scores Uploaded!")
                $("#scorebtn").removeAttr("disabled")
            },
            success: (res) => $("#scoreresult").html(res)
        })
    })
})
</script>
</html>