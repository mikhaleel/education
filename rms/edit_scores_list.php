<?php $pagename= "Edit Scores From List"; include("result_header.php");?>
 
<div class="card">
    <div class="card-body">
    <h4 class="card-title">Edit Scores</h4>
    <div class="row">
        <div class="col-12">
        <?php
if(isset($_REQUEST['Submit2']))
{ 
  // $name= $_REQUEST['name'];
  $matno= $_REQUEST['matno'];
  $score_id = $_POST["id"];
  $scores = $_POST["score"];
  $units = $_POST["unit"];
  foreach($score_id as $i=> $id)
  {
    $score = $scores[$i];
    include("scoregrade.php");    
    $point = $n[$grade1];
    $unit = $units[$i];
    $gpoints = ($point * $units[$i]);
    $query = $pdo->prepare("UPDATE `results` SET `score` = ?, `grade` = ?, `points`= ?, `unit`= ?, `gp` = ?  WHERE  `id` =?");
    $query->execute([$score, $grade1, $point, $unit, $gpoints, $id]);
  }
  if($query)
  {
      // echo "<div class='alert alert-info'><i> ".$code." Records Updated to ".$score."</i></div>";
      echo '<div class="alert alert-info">Updated!!</div> <script>setTimeout(function(){location.href="?matno='.$matno.'&Submit"},2000)</script>';
      // echo '<div class="alert alert-info">Updated!!</div> <script>setTimeout(function(){},2000)</script>';
  }
}
if(isset($_GET["delbyid"]))
{
  $id = encryptor("decrypt",$_GET["delbyid"]);
  $matno = encryptor("decrypt",$_GET["matno"]);
  $delqry = $pdo->prepare("DELETE FROM results WHERE id = ?");
  $delqry->execute([$id]);
  if($delqry)
  {
    echo '<div class="alert alert-info">Deleted!!</div> <script>setTimeout(function(){location.href="?matno='.$matno.'&Submit"},2000)</script>';
  }

}
if(isset($_REQUEST['button']))
{
  // show all pages
  $programme=$_REQUEST['programme'];
  $session=$_REQUEST['session'];
  if ($programme ==""  || $session == "") 
	{
		echo '<script type="text/javascript">
		alert("Empty fields not allowed!!!");
		location.replace("index.php?editres");
    	</script>';
		//die("Empty fields not allowed!!!"."<a href='index.php?views'><br>&lt;&lt;Back</a>");
}  
?>
<div><b>ENTRY SESSION:</b> <?php echo $session;?></div>
<div><b>PROGRAMME:</b> <?php echo $programme;?></div>
<h5>
<!-- <div class="pull-right"> -->
  <!-- <a class="btn btn-warning" href='javascript:void(0);' class='btn btn-primary' title=' Add score ' onClick=window.open('all_courses_edit.php?programme=<?php //echo encryptor("encrypt",$programme);?>','Ratting','width=750,height=600,0,status=0,scrollbars=1');>View/Edit Courses</a> -->
<!-- </div> -->
</h5>
<!-- <hr> -->
<div class="table-responsive">
    <table id="order-listing" class="table">
    <thead>
    <tr>
      <th><strong>Id</strong></th>
      <th><strong>Name</strong></th>
      <th><strong>Matric Number</strong></th>
      <th><strong>Level</strong></th>
      <th><strong>Status</strong></th>
      <th><strong>EDIT</strong></th>
    </tr>
    </thead>
    <tbody>
      <?php
      //$dept = mysqli_escape_string($logs,$dept);      
      $sql=$pdo->prepare("SELECT * FROM `students` WHERE `programme` = ? && `entry_session` =?");
      $sql->execute([$_REQUEST['programme'], $_REQUEST['session']]);
      $n=0;
        while ($row=$sql->fetch(PDO::FETCH_ASSOC))
        {
          $n=$n+1;
          ?>
          <tr>
            <td><span class="style1"><?php echo $n;?></span></td>
            <td><span class="style1"><?php echo $row['names'];?></span></td>
            <td><span class="style1"><?php echo $row['matno'];?></span></td>
            <td><span class="style1"><?php echo $row['level'];?></span></td>
            <td>
              <span class="style1">
                <?php
                $status=$row['Withdrwan']; 
                if($status==0)
                {
                  echo "Active";
                }elseif($status==1)
                {
                  echo "<font color='#FF0000'>In_Active</font>";
                }?>
              </span>
            </td>
            <td>
            <form name="form<?php echo $n;?>" method="post" action="">  
            <input name="id" value="<?php echo $row['id'] ;?>" type="hidden">
            <input name="semester" value="<?php echo $_REQUEST['semester'];?>" type="hidden">
            <input name="programme" value="<?php echo $_REQUEST['programme'];?>" type="hidden">
            <input name="level" value="<?php echo $_REQUEST['level'];?>" type="hidden">
            <input name="session" value="<?php echo $_REQUEST['session'];?>" type="hidden">
            <input name="matno" value="<?php echo $row['matno'];?>" type="hidden">
            <button type="Submit" name="Submit" class="btn btn-primary"><span class="mdi mdi-pen btn btn-primary">Edit Score</span></button>
            <!-- <input type="Submit" name="Submit" value="EDIT SCORES" class="btn btn-primary"> -->  
            </form>
            </td>
          </tr>
          <?php  
  
        }?>
        </tbody>
  </table>

  </div>
  <?php
}
elseif(isset($_REQUEST['Submit']))
{
	$matno=$_REQUEST['matno'];
//	$programme= mysqli_escape_string($logs,$programme);
	$sql=$pdo->query("SELECT * FROM `students` WHERE matno = '$matno'");
	$sql->execute();
	$row=$sql->fetch();
	?>
	<form id="form1" name="formback" method="post" action="">
    <input name="programme" type="hidden" value="<?php echo $row["programme"];?>">
    <input name="level" type="hidden" value="<?php echo $row["level"];?>">
    <input name="semester" type="hidden" value="<?php echo $row["semester"];?>">
    <input name="session" type="hidden" value="<?php echo $row["session"];?>">
    <input class="btn btn-danger pull-right" name="button" type="Submit" value="Back">
  </form>
	<form id="form1" name="form1" method="post" action="">
    <div class="table-responsive">
        <table id="order-listing." class="table">
        <tr>
          <th><span style="font-weight: bold">Name:</span></th>
          <th >
          <?php echo $row['names'];?>
          <input name="name" type="hidden" id="name" value="<?php echo $row['names'];?>"/>
          </th>
        </tr>
        <tr>
          <td ><span style="font-weight: bold">MatricNo:</span></td>
          <td >
            <?php echo $row['matno'];?>
            <input name="matno" type="hidden" id="matno"  value="<?php echo $row['matno'];?>"/>
          </td>
        </tr>
      </table>
  </div>
      <p><div style='border: solid; border-radius:10px; width: 100%; height:73px'>
      <?php
      //$c_arr = [];
      $seme_ar = array(1=>"First Semester", 2=>"Second Semester");
      $res_q = $pdo->query("SELECT * FROM `results` WHERE `matno` ='".$row['matno']."' GROUP BY `semester`, `session`, `level`");
      while($valss = $res_q->fetch())
      {
        echo "<div class='pull-left'>
        <a href='javascript:void(0);' class='btn btn-primary' title=' Add score ' onClick=window.open('missing_score.php?level=".encryptor('encrypt',$valss['level'])."&semester=".encryptor('encrypt',$valss['semester'])."&session=".encryptor('encrypt',$valss['session'])."&programme=".encryptor('encrypt',$valss['programme'])."&matno=".encryptor('encrypt',$row['matno'])."','Ratting','width=550,height=400,0,status=0,scrollbars=1');>"
        .$valss['level']."<br>".$seme_ar[$valss['semester']]."<br>".$valss['session'].
        "</a> 
        &nbsp;&nbsp;&nbsp;
        </div>";
      }
      ?></div>
      </p>
    <div class="table-responsive">
        <table id="order-listing" class="table">
            <thead>
        <tr>
            <th>#</th>
            <th>Title</th>
            <th>Code</th>
            <th>Unit</th>
            <th>Scores</th>
            <th>Grade</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        <?php 
        $sn = 0;
        $reg_c = $pdo->query("SELECT * FROM `results` WHERE `matno` ='".$row['matno']."' order by `code` ASC");
         while($fetch_d = $reg_c->fetch())
         { $sn++;
            ?>
            <tr>
                <td><?php echo $sn;?></td>
                <td>
                    <?php echo strtoupper($fetch_d['title']);?>
                </td> 
                <td><?php echo $fetch_d['code'];?></td>
                <td>
                    <?php //echo $fetch_d['unit'];?>
                    <div class="col-6">
                    <input name="unit[]" type="number" value="<?php echo $fetch_d['unit'];?>" class="form-control" maxlength="2">
                    </div>
                </td>
                <td>                    
                    <div class="col-6">
                      <input name="id[]" type="hidden" value="<?php echo $fetch_d['id'];?>" class="form-control">
                    <input name="score[]" type="text" value="<?php echo $fetch_d['score'];?>" class="form-control" maxlength="2">
                    </div>
                </td>
                <td><?php echo $fetch_d['grade'];?></td>
                <td style="width: 300px; text-align:right">
                <div>
                    <a class='btn btn-inverse-danger' href="?delbyid=<?php echo encryptor('encrypt',$fetch_d['id']).'&matno='.encryptor('encrypt',$matno);?>" title="Delete" onClick="Javascript:return confirm('Are you sure you want to Delete this score?<?php echo ' '.$fetch_d['code'].'('.$fetch_d['score'].')' ?>','Confirm Delete')"> <span class="mdi mdi-delete text-danger"> Delete</span></a>
                    </div>
                  </td>
            </tr>
            <?php 
         }?>
         </tbody>
      </table>
      </div>
        <input type="submit" name="Submit2" value="Update Score" class="btn btn-primary pull-right"/>
    </form>
	<?php 
    }
  ?>
<br>
<hr>
<br>
<div style="color:darkblue">VIEW STUDENTS LIST BY ENTRY SESSION</div>
<hr>
<!-- NEW -->
<form class="form-inline" id="form1" action="" enctype="multipart/form-data" method="post" name="form1">
   <div class="row"> 
        <div class="form-group col-4">
            <div class="col">
          <?php require_once("fetch_programme.php");?>         
        </div>
      </div>
    <?php 
    if(isset($_GET["progs"])){?>
        <div class="form-group col-4">
            <div class="col">
          <?php require_once("fetch_session.php");?>
        </div>
      </div>
    
    <div class="col-2">
      <input class="btn btn-success mr-2" name="button" type="submit" value="Submit"> 
    </div>
    <?php 
    }
    ?>
  </div>  
</form> 
</div>
</div>
</div>
</div>
<!--  /.Page content -->
<?php include("result_footer.php");?>

<script>
    function progm()
    {
        //alert("welcome");
        var prg= document.getElementById("programme").value;
        window.location.href="?progs="+prg;
    }
</script>