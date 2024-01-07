<?php
//grade points
$n = array('A' => 4.0, 'AB' => 3.5, 'B' => 3.25, 'BC' => 3.0, 'C' => 2.75, 'CD' => 2.50, 'D' => 2.25, 'E' => 2.0, 'F' => 0, 'SICK' => 0, 'ABS' => 0,'PEND'=> 0, 'ABSE' => 0,'EM'=> 0, 'MS' => 0, 'AE' => 0,'PI'=> 0);
// grade AA tp F
$a = array(75 => 'A',76 => 'A',77 => 'A',78 => 'A',79 => 'A',80 => 'A',81 => 'A',82 => 'A',83 => 'A',84 => 'A',85 => 'A',86 => 'A',87 => 'A',88 => 'A',89 => 'A',90 => 'A',91 => 'A',92 => 'A',93 => 'A',94 => 'A',95 => 'A',96 => 'A',97 => 'A',98 => 'A',99 => 'A',100 => 'A');
$ab = array(70 => 'AB',71=> 'AB',72=> 'AB',73=> 'AB',74=> 'AB');
$b = array(65 => 'B',66 => 'B',67 => 'B',68 => 'B',69 => 'B');
$bc = array(60 => 'BC',61 => 'BC',62 => 'BC',63 => 'BC',64 => 'BC');
$c = array(55 => 'C',56 => 'C',57 => 'C',58 => 'C',59 => 'C');
$cd = array(50 => 'CD',51 => 'CD',52 => 'CD',53 => 'CD',54 => 'CD');
$d = array(45 => 'D',46 => 'D',47 => 'D',48 => 'D',49 => 'D');
$e = array(40 => 'E',41 => 'E',42 => 'E',43 => 'E',44 => 'E');
$f = array(0 => 'F',1 => 'F',2 => 'F',3 => 'F',4 => 'F',5 => 'F',6 => 'F',7 => 'F',8 => 'F',9 => 'F',10 => 'F',11 => 'F',12 => 'F',13 => 'F',14 => 'F',15 => 'F',16 => 'F',17 => 'F',18 => 'F',19 => 'F',20 => 'F',21 => 'F',22 => 'F',23 => 'F',24 => 'F',25 => 'F',26 => 'F',27 => 'F',28 => 'F',29 => 'F',30 => 'F',31 => 'F',32 => 'F',33 => 'F',34 => 'F',35 => 'F',36 => 'F',37 => 'F',38 => 'F',39 => 'F', 'SICK' => 'SICK', 'ABS' => 'ABS', 'ABSE' => 'ABSE','---' => '---','PEND' => 'PEND','EM' => 'EM','MS' => 'MS','AE' => 'AE', 'PI' =>'PI');
// New grade / points
if ($score=='SICK'){
$grade1 = "SICK";
}
else
if($score =='---'){
$grade1 = "---";
}
else
if ($score =='PEND'){
$grade1 = "PEND";
}
else
if ($score =='EM'){
$grade1 = "EM";
}else
if ($score =='MS'){
$grade1 = "MS";
}
else
if ($score =='ABS'){
    $grade1 = "ABS";
}
else
if ($score =='ABSE'){
    $grade1 = "ABSE";
}
else
if ($score =='AE'){
    $grade1 = "AE";
}else
if ($score =='PI'){
    $grade1 = "PI";
}
else
	if ($score>=0 and $score <=39){
    	$grade1 = $f[$score];
}
else
    if ($score >= 40 and $score <= 44){

        $grade1 =$e[$score];
    }
    else
        if ($score >= 45 and $score <= 49){

            $grade1 =$d[$score];
        }
        else
            if ($score >= 50 and $score <= 54){

                $grade1 =$cd[$score];
            }
            else
                if ($score >= 55 and $score <= 59){

                    $grade1 =$c[$score];
                }
                else
                    if ($score >= 60 and $score <=64){

                        $grade1 =$bc[$score];
                    }
                    else
                        if ($score >= 65 and $score <=69){

                            $grade1 =$b[$score];
                        }
                        else
                            if ($score >= 70 and $score <=74){

                                $grade1 =$ab[$score];
                            }
                            else
                                if ($score >= 75){

                                    $grade1 =$a[$score];
                                }
?>