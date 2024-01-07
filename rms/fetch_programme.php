	<select name="programme" id="programme" class="form-control js-example-basic-single" onchange="progm();">
	<option value="">Select Programme</option>
		<?php 
		if(Isset($_GET["progs"]))
		{
			echo '<option selected="selected" value="'. $_GET["progs"].'">'. $_GET["progs"].'</option>';
		}
		if($_SESSION["usertype"] == 1 or $_SESSION["usertype"] == 11)
		{
			$qry = $pdo->prepare("SELECT * FROM `programmes` GROUP BY `programme` ORDER BY `programme` ASC");
			$qry->execute([]);
			//$rows = $qry->fetch(PDO::FETCH_ASSOC);
		}
		else
		{
		    $mydept_id = $_SESSION['department'];
		    	
		    $dptt = $pdo->query("SELECT * FROM `departments` WHERE names = '$mydept_id'");
		    $dept_idsss = $dptt->fetch();
		    $dptids = $dept_idsss["dept_id"];
			$qry = $pdo->prepare("SELECT * FROM `programmes` WHERE `dept_id` LIKE ? GROUP BY `programme` ORDER BY programme ASC");
			$qry->execute([$dptids]);
		}
			while($rows = $qry->fetch(PDO::FETCH_ASSOC))
			{
			?>
			 <!--<option value=""><?php //echo $mydept_id;?></option>-->
			<option value="<?php echo $rows['programme'];?>"><?php echo  $rows['programme'];?></option>
		<?php 
		}?>
	</select>