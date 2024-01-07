<select name="session" class="js-example-basic-single" style="width:100%">
	<option selected="selected" value="">Select Session</option>
	<?php 
	$fetch_sess = $pdo->query("SELECT * FROM `session`");
	while($row_ses = $fetch_sess->fetch()){?>
	<option><?php echo $row_ses["session"];?></option>
	<?php }?>
</select>