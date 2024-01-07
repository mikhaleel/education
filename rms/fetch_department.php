	<select name="department" id="programme" class="form-control js-example-basic-single">
	<option value="">Select Department</option>
		<?php 
		    //$mydept_id = $_SESSION['department'];
		    $dptt = $pdo->query("SELECT * FROM `departments`");
		    //$dept_idsss = $dptt->fetch();
			while($rows = $dptt->fetch(PDO::FETCH_ASSOC))
			{
			?>
			<option value="<?php echo $rows['dept_id'];?>"><?php echo  $rows['names'];?>
			</option>
    		<?php 
    	    }?>
	</select>