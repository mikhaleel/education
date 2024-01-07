<select name="level" id="level" class="form-control show-tick">
	<option selected="selected" value="">Class/Level</option>
	<?php 
if(isset($_GET["progs"])){
    // Capture selected country
    $programme = $_GET["progs"];
    $programmes = explode(' ', trim($programme ))[0];

    // Define levels
    // $programmeArr = array(
    //                 "HIGHER" => array("HND1"),
    //                 "NATIONAL" => array("ND1"),
    //                 "DIPLOMA" => array("DIP1"),
    //                 "PRE-HND" => array("PRE-HND")
    //             );
    
    $programmeArr = array(
        "HIGHER" => array("HND1", "HND2"),
        "NATIONAL" => array("ND1", "ND2"),
        "DIPLOMA" => array("DIP1", "DIP2"),
        "PRE-HND" => array("PRE-HND")
    );
    // Display city dropdown based on country name
    $levels = $programmeArr;

    foreach($levels[$programmes] as $level){
        echo "<option>". $level . "</option>";
   //echo  '<input name="level" id="level" type="text" class="form-control" value="'.$level.'">';        
    }
     
}
?>
</select>
 
