<?php 
if($level == "ND1")
{ 
    $level1 = "ND1"; $level2 = "ND2";
}
elseif($level == "HND1")
{
    $level1 = "HND1"; $level2 = "HND2";
}
elseif($level == "DIP1")
{
    $level1 = "DIP1"; $level2 = "DIP2";
}

if($level == "ND2")
{ 
    $level1 = "ND1"; $level2 = "ND2";
}
elseif($level == "HND2")
{
    $level1 = "HND1"; $level2 = "HND2";
}
elseif($level == "DIP2") 
{
    $level1 = "DIP1"; $level2 = "DIP2";
}

//curent semester 
if(($level == "ND1" OR $level == "HND1" OR $level == "DIP1"))
{
    if($semester == 1)
    {
        $year1sem1 = yearsem($pdo, $level, $semester, $col['matno']);
        //curent semester 
        $unit = $year1sem1['tunit'];
        // $unit = $year1sem1['sunit'];
        $gp = $year1sem1['gps'];
        if(@$unit == 0){ $gpa = 0;}else{ $gpa = number_format(($year1sem1['gpa']),2); }
        //previous semester    
        $pcgp="000";
        $pcu="000";
        $pcgpa="000";
        //current cumulative
        $ccu = $unit;
        $ccgp = $gp;	    
        if($ccu == 0){
        $ccgpa = 0;	
        $gpa= 0;
        }        
        $ccgpa= number_format($gpa,2);
        $gpa = number_format($gpa,2);
    }
    elseif($semester == 2)
    {
       //current semseter
        $year1sem2 = yearsem($pdo, $level, $semester, $col['matno']);
        $unit = $year1sem2['tunit'];
        //$unit = $year1sem2['sunit'];
        $gp = $year1sem2['gps'];
        if(@$unit == 0){ $gpa = 0; }else{ $gpa = number_format(($year1sem2['gpa']),2);}
        //previouse
        $year1sem1 = yearsem($pdo, $level, 1, $col['matno']); 
       $pcu = $year1sem1["tunit"];
       // $pcu = $year1sem1["sunit"];
        $pcgp = $year1sem1["gps"];
        $pcgpa = number_format(($year1sem1["gpa"]),2);
        //cumulative 
        $ccu = $pcu + $unit;
        $ccgp = $pcgp + $gp;	    
        if($ccu == 0){
        $ccgp = 0;	
        $gpa= 0;
        }
        $ccgpa = number_format(($ccgp / $ccu),2);
    }
}
if(($level == "ND2" OR $level == "HND2" OR $level == "DIP2"))
{
    if($semester == 1)
    {
        //current semester
        $year2sem1 = yearsem($pdo, $level, $semester, $col['matno']);        
        $unit = $year2sem1['tunit'];
        // $unit = $year2sem1['sunit'];
        $gp = $year2sem1['gps'];
        if(@$unit == 0){ $gpa = 0;}else{ $gpa = number_format(($year2sem1['gpa']),2); }
        //previous semster
        $year1sem1 = yearsem($pdo, $level1, 1, $col['matno']);
        $year1sem2 = yearsem($pdo, $level1, 2, $col['matno']);

        $pcu = $year1sem1["tunit"] + $year1sem2["tunit"];
        $pcgp = $year1sem1["gps"] + $year1sem2["gps"];
        if($pcu == 0){ $pcgpa = 0; }else{
        $pcgpa = number_format(($pcgp / $pcu),2);
        }
        //cumulative
        $ccu = $pcu + $unit;
        $ccgp = $pcgp + $gp;	    
        if($ccu == 0){
        $ccgpa = 0;	
        $gpa= 0;
        }else{
        $ccgpa = number_format(($ccgp / $ccu),2);}
    }
    elseif($semester == 2)
    {
        //current semester
        $year2sem2 = yearsem($pdo, $level, $semester, $col['matno']);        
        $unit = $year2sem2['tunit'];
        // $unit = $year2sem2['sunit'];
        $gp = $year2sem2['gps'];
        if(@$unit == 0){ $gpa = 0;}else{ $gpa = $year2sem2['gpa']; }
        //previous semster
        $year1sem1 = yearsem($pdo, $level1, 1, $col['matno']);
        $year1sem2 = yearsem($pdo, $level1, 2, $col['matno']);
        $year2sem1 = yearsem($pdo, $level2, 1, $col['matno']);

        $pcu = $year1sem1["tunit"] + $year1sem2["tunit"] + $year2sem1["tunit"];
        $pcgp = $year1sem1["gps"] + $year1sem2["gps"] + $year2sem1["gps"];
        if($pcu == 0){ $pcgpa = 0;}else{
        $pcgpa = number_format(($pcgp / $pcu), 2);}
        //cumulative
        $ccu = $pcu + $unit;
        $ccgp = $pcgp + $gp;	    
        if($ccu == 0){
        $ccgpa = 0;	
        $gpa= 0;
        }else{
        $ccgpa = number_format(($ccgp / $ccu), 2);}
    }
}
?>