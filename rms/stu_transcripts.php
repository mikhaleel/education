<?php $pagename= "Broadsheet"; include("result_header.php");?>

<div class="card">
    <div class="card-body">
    <!-- <h4 class="card-title">Data table<?php //echo $dpt;?></h4> -->
    <div class="row">
        <div class="col-12">

     <h4>STUDENT TRANSCRIPT</h4> 
	 
	<?php
	
$semm_array = array(1=>"First",2=>"Second");

// $semm_array = array(1=>"First",2=>"Second",3=>"Third",4=>"Fourth",5=>"Fift",6=>"Sixth");

if(isset($_POST["button"])){
		
$programme=$_REQUEST['programme'];
$session=$_REQUEST['session'];
  if ($programme =="" || $session == "" ) 
	{
		echo '<script type="text/javascript">
		alert("Empty fields not allowed!!!");
		location.replace("index.php?editres");
    	</script>';
	}
    
  //$programme = mysqli_escape_string($logs,$programme);
  //add session 
  $_SESSION['programme'] = $programme;
  $_SESSION['session'] = $session;
  ?>
  <table class="table table-bordered">
    <tr >
      <td ><strong>Id</strong></td>
      <td ><strong>Name</strong></td>
      <td ><strong>Matric Number</strong></td>
      <td ><strong>Session</strong></td>
      <td ><strong>Status</strong></td>
      <td ><strong>EDIT</strong></td>
    </tr>
      <?php
      $sql=$pdo->prepare("SELECT * FROM `students` WHERE `programme` = ? && `entry_session` =?");
      $sql->execute([$_REQUEST['programme'], $_REQUEST['session']]);
      $n=0;
        while ($row=$sql->fetch(PDO::FETCH_ASSOC))
        {
          $n=$n+1;
          ?>
          <tr>
            <td ><span class="style1"><?php echo $n;?></span></td>
            <td ><span class="style1"><?php echo $row['names'];?></span></td>
            <td ><span class="style1"><?php echo $row['matno'];?></span></td>
            <td ><span class="style1"><?php echo $row['entry_session'];?></span></td>
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
            <input name="fullname" value="<?php echo $row['names'];?>" type="hidden"><!--
            <input name="semester" value="<?php //echo $_REQUEST['semester'];?>" type="hidden">-->
            <input name="programme" value="<?php echo $_REQUEST['programme'];?>" type="hidden">
            <input name="year" value="<?php echo $_REQUEST['year'];?>" type="hidden"><!--
            <input name="session" value="<?php //echo $_REQUEST['session'];?>" type="hidden">-->
            <input name="matno" value="<?php echo $row['matno'];?>" type="hidden">
            <input type="Submit" name="Submit" value="View Transcript" class="btn btn-gradient-primary mr-2">
            <!--  <a href="index.php?editres&id=<?php //echo $row['sn']."&"."semester=".$semester."&"."programme="."$dept"."&"."year="."$year"."&"."session="."$session"."& Submit="."Submit". "& matno=".$row['matno'];?>" class="style1">
                EDIT
              </a>-->
              </form>
            </td>
          </tr>
          <?php  
  
        }?>
  </table>
  <?php
}
elseif(isset($_REQUEST['Submit']))
{
	?>
	<a href="#" onclick="PrintDiv();" class=" pull-right btn btn-warning"><i class="material-icons">print</i>Print</a><hr>

<div id="printdivcontent" >
		<div  class="table-responsive">
		<table>
		<tr>
			<td><img src="logo.png" alt="logo" style="width:100px; height:90px"></td>
			<td style="text-align:center"><h3>NIGER STATE POLYTECHNIC, ZUNGERU</h3>
			<h4>CENTRE FOR CONTINUING EDUCATION AND TRAINING</h4>
			<h5>STUDENT TRANSCRIPT</h5>
			</td>
		</tr>
		<tr><td>Full Name:</td><td><?php echo $_REQUEST["fullname"];?></td></tr>
		<tr><td>Matric Number:</td><td><?php echo $_REQUEST["matno"];?></td></tr>
		<tr><td>Programme:</td><td><?php echo $_REQUEST["programme"];?></td></tr>
		</table>
		</div>
		
	 
	 <?php 
	  $dist_sem = $pdo->prepare("SELECT `session`, `semester` FROM `results` WHERE `matno` = ? GROUP BY `semester`, session ORDER BY `semester`, `session` ASC");
	  $dist_sem->execute([$_REQUEST["matno"]]);
	  while($dist_rsem = $dist_sem->fetch(PDO::FETCH_ASSOC)){
	 ?>
	 <h3><?php echo $semm_array[$dist_rsem['semester']].' Semester '.$dist_rsem['session'];?> Academic Session </h3>
	 <div  class="table-responsive">
	 
		<table id="recent-purchases-listing" class="table table-hover">
		  <thead>
			<tr>
			  <th>#</th>
			  <th>Title</th>
			  <th>Code</th>
			  <th>Unit</th>
			  <th>Marks</th>
			  <th>Grade</th>
			  <th>Points</th>
			  <th>WPts</th>
			</tr>
		  </thead>
		  <tbody>
		  <?php 
		  $sn = 0;
		  //$matricno = encryptor("decrypt",$_SESSION["matno"]);
		  $resqry = $pdo->prepare("SELECT * FROM `results` WHERE `matno` = ? && `semester` = ? and session = ?");
		  $resqry->execute([$_REQUEST["matno"], $dist_rsem['semester'], $dist_rsem['session']]);
		  while($resrows = $resqry->fetch(PDO::FETCH_ASSOC)){
		  $sn++;
			  
			$cqry = $pdo->prepare("SELECT * FROM `course` WHERE `code` = ? && `sessions` = ?");
			$cqry->execute([$resrows["code"], $resrows["session"]]);
			$crows = $cqry->fetch(PDO::FETCH_ASSOC);
		  ?>
			<tr>
			  <td><?php echo $sn;?></td>
			  <td><?php echo $crows["title"];?></td>
			  <td><?php echo $resrows["code"];?></td>
			  <td><?php echo $resrows["unit"];?></td>
			  <td><?php echo $resrows["score"];?></td>
			  <td><?php echo $resrows["grade"];?></td>
			  <td><?php echo $resrows["points"];?></td>
			  <td><?php echo ($resrows["points"]*$resrows["unit"]);?></td>
			</tr>
		  <?php }?>
		  </tbody>
		 </table>
	 </div>
	 
	 <?php 
	 // calculate CGPA for all result
	$cqrys = $pdo->prepare("SELECT sum(unit) as tunit, sum(unit*points) as gp, (sum(unit*points)/sum(unit)) as gpa FROM `results` 
	WHERE `matno` = ? && `semester` = ? &&(`grade` != ? ||`grade` != ? || `grade` != ? || `grade` != ? || `grade` != ?)");
	$cqrys->execute([$_REQUEST["matno"], $dist_rsem['semester'], "EM", "AE", "SICK", "NR", "PEND"]);
	$crowss = $cqrys->fetch(PDO::FETCH_ASSOC);
	 ?>
	 <div  class="table-responsive">
		<table id="recent-purchases-listing" class="table">
		  <thead>
			<tr>
			  <th>Total Unit</th>
			  <th>GP</th>
			  <th>GPA</th>
			</tr>
		  </thead>
		  <tbody>
		     <td><?php echo $crowss["tunit"];?></td>
			 <td><?php echo @number_format($crowss["gp"],2);?></td>
			 <td><?php echo @number_format($crowss["gpa"], 2);?></td>
		  </tbody>
		  </table>
		  
		  </div>
		<?php 
}
	 // calculate CGPA for all result
	$cqrys = $pdo->prepare("SELECT sum(unit) as tunit, sum(unit*points) as gp, (sum(unit*points)/sum(unit)) as gpa FROM `results` 
	WHERE `matno` = ? &&(`grade` != ? ||`grade` != ? || `grade` != ? || `grade` != ? || `grade` != ?)");
	$cqrys->execute([$_REQUEST["matno"], "EM", "AE", "SICK", "NR", "PEND"]);
	$crowss = $cqrys->fetch(PDO::FETCH_ASSOC);
	 ?>
	 <h3>Cumulative</h3>
	 <hr>
	 <div  class="table-responsive">
		<table id="recent-purchases-listing" class="table">
		  <thead>
			<tr>
			  <th> Unit</th>
			  <th> GP</th>
			  <th> GPA</th>
			</tr>
		  </thead>
		  <tbody>
		     <td><?php echo $crowss["tunit"];?></td>
			 <td><?php echo @number_format($crowss["gp"],2);?></td>
			 <td><?php echo @number_format($crowss["gpa"], 2);?></td>
		  </tbody>
		  </table>
		  
	</div>
	<p></p>
    <hr/>
	<div  class="table-responsive">
    <table width="247" border="0" align="right" bgcolor="#FFFFFF">
      <tr>
        <td><div align="center">
            <p>&nbsp;</p>
          <p class="style3"><strong>&nbsp;.............................................<br />
            Deputy Registrar<br />
            &nbsp;For&nbsp;Exams & Records</strong></p>
        </div>
		</td>
      </tr>
    </table>
</div>
</div>
	<?php	  
}?>		
		  
		  
<!-- NEW -->
<form class="form-inline" id="form1" action="" enctype="multipart/form-data" method="post" name="form1">
<div class="row clearfix">
<div class="col-6">
  <div class="form-group">
    <select name="programme" id="programme" class="form-control">
    <option selected="selected" value=""> Programme </option>
    <?php 
    $qry = $pdo->prepare("SELECT * FROM `programmes` GROUP BY programme");
      $qry->execute([]);
        while($rows = $qry->fetch(PDO::FETCH_ASSOC))
      {
      ?>
        <option><?php echo $rows['programme'];?></option>
        <?php 
      }?>
    </select>          
    </div>
    </div>
<div class="col-6">
<div class="form-group">
	<select name="session" id="session" class="form-control">
		<option selected="selected" value="">Session of Entry</option>
		<option>2021/2022</option>
		<option>2020/2021</option>
		<option>2019/2020</option>
		<option>2018/2019</option>
		<option>2017/2018</option>
	</select>
	</diV>
	</diV>
<div class="col-sm-2">
	<input class="btn btn-success mr-2" name="button" type="submit" value="Submit"> 
	</div>
	</div>
      </div>
  </div>
</form>
<!--  /.Page content -->
</div>
</div>
</div>
</div>
<?php include("result_footer.php");?>