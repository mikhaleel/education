<?php $pagename= "Edit Scores by Search"; include("result_header.php");?>
 
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
  $search=$_REQUEST['search'];
  //$session=$_REQUEST['session'];
  if ($search =="") 
	{
		echo '<script type="text/javascript">
		alert("Empty fields not allowed!!!");
		location.replace("index.php?editres");
    	</script>';
		//die("Empty fields not allowed!!!"."<a href='index.php?views'><br>&lt;&lt;Back</a>");
}  
?>
<div><b>Searching for :</b> <?php echo $search;?></div>
<!--<div><b>PROGRAMME:</b> <?php //echo $programme;?></div>-->
<h5>
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
      $search_val = '%'.$search.'%';
      //$dept = mysqli_escape_string($logs,$dept);      
      $sql=$pdo->prepare("SELECT names,matno,level,Withdrwan FROM `students` WHERE (`matno` LIKE ? || `names` LIKE ?)");
      $sql->execute([$search_val,$search_val]);
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
            <input name="matno" value="<?php echo $row['matno'];?>" type="hidden">
            <button type="Submit" name="Submit" class="btn btn-primary"><span class="mdi mdi-pen btn btn-primary">View Scores</span></button>
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
	$sql=$pdo->query("SELECT names, matno FROM `students` WHERE `matno` LIKE '$matno'");
	$sql->execute();
	$row=$sql->fetch(PDO::FETCH_ASSOC);
	?>
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
            
            // $reg_c = $pdo->prepare("SELECT title,code,unit,id,score FROM `results` WHERE `matno` = :matno ORDER BY `code` ASC");
            // $reg_c->execute(array(':matno' => $matno));
            
            $reg_c = $pdo->prepare("SELECT title,code,unit,id,score FROM `results` LIMIT 5");
            $reg_c->execute();
            
            $results = $reg_c->fetchAll(PDO::FETCH_ASSOC);
            foreach ($results as $row) {
                // Process each row here
             $sn++;
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
                    <a class='btn btn-inverse-danger' href="?delbyid=<?php echo encryptor('encrypt',$fetch_d['id']).'&matno='.encryptor('encrypt',$matno);?>" title="Delete" onClick="Javascript:return confirm('Are you sure you want to Delete this score?<?php echo ' '.$fetch_d['code'].'('.$fetch_d['score'].')';?>','Confirm Delete')"> <span class="mdi mdi-delete text-danger">Delete</span></a>
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
<div style="color:darkblue">Search for students</div>
<hr>
<!-- NEW -->
<form class="form-inline" id="form1" action="" enctype="multipart/form-data" method="post" name="form1">
   <div class="row"> 
        <div class="form-group col-4">
            <div class="col">
            <input name="search" class="form-control" type="text">
        </div>
      </div>
    
    
    <div class="col-2">
      <input class="btn btn-success mr-2" name="button" type="submit" value="Search"> 
    </div>

  </div>  
</form> 
</div>
</div>
</div>
</div>
<!--  /.Page content -->
<?php include("result_footer.php");?>