	<select name="level" id="level" class="js-example-basic-single" style="width:100%">
	<option selected="selected" value="">Class/Level</option>
	<?php 
if(isset($_GET["progs"])){
    // Capture selected country
    $programme = $_GET["progs"];
    $prog = $_GET["progs"];
    $programme = explode(' ', trim($prog ))[0];

     
    // Define country and city array
    $programmeArr = array(
                    "HIGHER" => array("HND1", "HND2"),
                    "NATIONAL" => array("ND1", "ND2"),
                    "DIPLOMA" => array("DIP1", "DIP2"),
                    "PRE-HND" => array("PRE-HND")
                );
    
    // Display city dropdown based on country name
    if($programme !== 'Select'){
      //  echo "<label>City:</label>";
        //echo "<select>";
        foreach($programmeArr[$programme] as $value){
            echo "<option>". $value . "</option>";
        }
        //echo "</select>";
    } 
}
?>
</select>