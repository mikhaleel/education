<?php 
    $fname = $_FILES['csvfile']['name'];
    echo 'upload file name: '. $fname. ' ';
    $chk_ext = explode(".",$fname);
    if(strtolower(end($chk_ext)) == "csv")
    {
        $filename = $_FILES['csvfile']['tmp_name'];
        $handle = fopen($filename, "r");
        while (($data = fgetcsv($handle,10000,",")) !== FALSE)
        {                               
           $score = $data[1];
           $smatno = $data[0];
            // get students names from table 
                $stdqry = $pdo->prepare("SELECT * FROM `students` WHERE `matno` = ?");
                $stdqry->execute([$smatno]);
                $stdrows = $stdqry->fetch(PDO::FETCH_ASSOC);				
			if($stdqry->rowCount() == 0)
			{
				echo "
                <div class='alert alert-warning'>".$smatno." does not exist!</div>";
			}   
            else 
            {            
                $snames = $stdrows["names"];
                include("scoregrade.php");
                $point = $n[$grade1];				
				$chkqry = $pdo->prepare("SELECT * FROM `results` WHERE `matno` = ? && `code` = ?");
				$chkqry->execute([$smatno, $coursecode]);
				
				$chk_rows = $chkqry->fetch(PDO::FETCH_ASSOC);

                if($score == 'AE' OR $score == 'SICK')
                {
                    $cunit = 0;
                }
                else
                {
                    $cunit = $courseunit;
                }
				if($chkqry->rowCount() == 0)
				{
                    // insert into result table
                    $up = ($courseunit*$point);   
					$msqry = $pdo->prepare("INSERT INTO `results` (`matno`, `title`, `code`, `unit`, `cunit`, `score`, 
					`grade`, `points`, `gp`, `programme`, `level`, `semester`, `session`) VALUES (?, ?, ?, ?, ?, ?,  ?, ?, ?, ?, ?, ?, ?)");
					$msqry->execute([$smatno, $coursetitle, $coursecode, $courseunit, $cunit, $score, $grade1, $point,$up, $programme, $level, $conf_semester, $conf_session]);
				}else
				{
                    if($chk_rows["session"] != $conf_session)
                    {
                        $scoretype = 1;
                        $conf_sessio = $conf_session;
                    }
                    else
                    {
                        $scoretype = 0;
                        $conf_sessio = null; 
                    }
                    $up = $courseunit*$point;   
                        $qry = $pdo->query("UPDATE `results` SET `title` = '$coursetitle', `unit`='$courseunit',`cunit`='$cunit',`score` = '$score', `grade` = '$grade1', `points` = '$point', `gp` = '$up', `scoretype` = '$scoretype', `co_session` = '".$conf_sessio."' WHERE `matno`='$smatno' AND `code` = '$coursecode'");
                        $msg = "Record Updated";
					echo "<div class='alert alert-info'>Score of ".$coursecode." for ".$smatno." alraedy exist! and ".$msg."</div>";	
                }
            }
        }
        if(fclose($handle))
        { 
			echo "
			<div class='alert alert-success'>Successfully imported, Please wait.....</div>
			<script>setTimeout(function(){location.href='?programme=".encryptor('encrypt',$programme)."&flevel=".encryptor('encrypt',$level)."'},1000)</script>";  
        }        
    }
    else
    {
        echo "
        <div class='alert alert-danger'>Invalid file, only .csv file is valid....</div>
			<script>setTimeout(function(){location.href='?programme=".encryptor('encrypt',$programme)."&flevel=".encryptor('encrypt',$level)."'},1000)</script>";              
    }
?>