<?php 
if(isset($_GET["progs"])){
    // Capture selected country
    $programme = $_GET["progs"];
    // Define country and city array
    $pcodeq = $pdo->query("SELECT * FROM programmes WHERE programme = '".$programme."'");
    $fetch = $pcodeq->fetch();    
    // Display city dropdown based on country name
    if($programme !== 'Select')
    {?>        
        <input name="matric" id="matric" type="text" class="form-control" value="<?php echo $fetch["abv"];?>/020/">
        <?php
    } 

    $programmes = explode(' ', trim($programme ))[0];

     
    // Define levels
    $programmeArr = array(
                    "HIGHER" => array("HND2"),
                    "NATIONAL" => array("ND2"),
                    "DIPLOMA" => array("DIP2"),
                    "PRE-HND" => array("PRE-HND")
                );
    
    // Display city dropdown based on country name
    $levels = $programmeArr;

    foreach($levels[$programmes] as $level){
   echo  '<input name="level" id="level" type="hidden" class="form-control" value="'.$level.'">';        
    }
     
}
?>
 
