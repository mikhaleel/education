<?php include('../data/db.php'); if(isset($_REQUEST['dwnld'])){
    header("Content-type: application/vnd.ms-word");
    $filename = encryptor('decrypt',$_REQUEST["ccode"])."-".encryptor('decrypt',$_REQUEST["title"]).".doc";
header("Content-Disposition: attachment;Filename=$filename");
}
//include('../data/db.php');
$time = date("h:i:sa");
$n_arr = array(1=>"FIRST SEMESTER", 2=>"SECOND SEMESTER");
?>
<!Doctype html>
<html>
<head>
    <title><?php echo encryptor('decrypt',$_REQUEST["ccode"]);?>| Mark & Attendance</title>
    <link rel="icon" href="logo.png" type="image/x-icon"/>
<meta http-equiv=Content-Type content="text/html; charset=windows-1252">
<meta name=Generator content="Microsoft Word 15 (filtered)">
</head>

<body lang=en-NG style='word-wrap:break-word'>
<div style="text-align: center;">
<img src="logo.png" style="height: 90px; width: 90px;">
    <h4>NIGER STATE POLYTECHNIC ZUNGERU<br>
    <?php echo $n_arr[$_SESSION['rsemester']]." ". $_SESSION['rsession'];?> EXAMINATION<br>MARK AND ATTENDANCE</h4>
</div>
<div style="float: right;">
    <h5>PROGRAMME: <?php echo encryptor('decrypt',$_REQUEST["programme"]);?><br>
    LEVEL: <?php echo $_REQUEST["class"];?></h5>
</div>

<div style="float: left;">
    <h5>COURSE CODE: <?php echo $coursecode = encryptor('decrypt',$_REQUEST["ccode"]);?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;COURSE UNIT: <?php echo encryptor('decrypt',$_REQUEST["unit"]);?><br>
    COURSE TITLE: <?php echo encryptor('decrypt',$_REQUEST["title"]);?>
    <br> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; EXAMINAR: _______________________________________SIGN: ____________________</h5>
</div>
    <?php	
    if(isset($_REQUEST["csvss"]))
    {        
        //echo "MatricNo,Score,\n";
        // $stdt_qry = $pdo->prepare("SELECT * FROM `students` WHERE `programme` = ? && `level` = ? && `stat`= 1 && `Withdrwan` = 0 ORDER BY `matno` ASC");
        $stdt_qry = $pdo->prepare("SELECT * FROM `stu_course_reg` WHERE `programme` = ? && `courselevel` = ? AND `session` =? AND `semester`=? AND `coursecode` = ? ORDER BY LENGTH(`matno`),`matno`");
        $stdt_qry->execute([
        encryptor('decrypt',$_REQUEST["programme"]), $_REQUEST["class"],$_SESSION['rsession'],$_SESSION['rsemester'],$coursecode]);?>
         <!-- start attendance table -->
        <div class=WordSection1>
            <table class=MsoTable15Grid6ColorfulAccent5 border=1 cellspacing=0
            cellpadding=0 style='width:100%;border-collapse:collapse;  border:none'>
            <thead>
            <tr>
            <td width=34 rowspan=2 valign=top style='width:25.75pt;border:solid #000000 1.0pt; padding:0cm 5.4pt 0cm 5.4pt'>
            <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center; line-height:normal'><span lang=EN-GB style='color:#000000'>&nbsp;</span></p>
            <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center; line-height:normal'><b><span lang=EN-GB style='color:#000000'>SN</span></b></p>
            </td>
            <td width=133 rowspan=2 valign=top style='width:99.75pt;border:solid #000000 1.0pt; border-left:none;padding:0cm 5.4pt 0cm 5.4pt'>
            <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;  line-height:normal'><span lang=EN-GB style='color:#000000'>&nbsp;</span></p>
            <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center; line-height:normal'><b><span lang=EN-GB style='color:#000000'>Matric Number</span></b></p>
            </td>
            <td width=203 rowspan=2 valign=top style='width:152.2pt;border:solid #000000 1.0pt;  border-left:none;padding:0cm 5.4pt 0cm 5.4pt'>
            <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;  line-height:normal'><span lang=EN-GB style='color:#000000'>&nbsp;</span></p>
            <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;  line-height:normal'><b><span lang=EN-GB style='color:#000000'>Name</span></b></p>
            </td>
            <td width=80 rowspan=2 valign=top style='width:59.85pt;border:solid #000000 1.0pt;  border-left:none;padding:0cm 5.4pt 0cm 5.4pt'>
            <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;  line-height:normal'><b><span lang=EN-GB style='color:#000000'>Booklet Number</span></b></p>
            </td>
            <td width=103 rowspan=2 valign=top style='width:77.3pt;border:solid #000000 1.0pt;  border-left:none;padding:0cm 5.4pt 0cm 5.4pt'>
            <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;  line-height:normal'><b><span lang=EN-GB style='color:#000000'>Signature</span></b></p>
            </td>
            <td width=188 colspan=7 valign=top style='width:140.8pt;border-top:solid #000000 1.0pt;  border-left:none;border-bottom:solid #000000 1.5pt;border-right:solid #000000 1.0pt;  padding:0cm 5.4pt 0cm 5.4pt'>
            <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;  line-height:normal'><b><span lang=EN-GB style='color:#000000'>Question Number</span></b></p>
            </td>
            <td width=53 rowspan=2 valign=top style='width:39.55pt;border:solid #000000 1.0pt;  border-left:none;padding:0cm 5.4pt 0cm 5.4pt'>
            <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;  line-height:normal'><b><span lang=EN-GB style='color:#000000'>Exam<br>60%</span></b></p>
            </td>
            <td width=36 rowspan=2 valign=top style='width:27.1pt;border:solid #000000 1.0pt;  border-left:none;padding:0cm 5.4pt 0cm 5.4pt'>
            <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center; line-height:normal'><span lang=EN-GB style='color:#000000'>&nbsp;</span></p>
            <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center; line-height:normal'><b><span lang=EN-GB style='color:#000000'>CA<br>20%</span></b></p>
            </td>
            <td width=39 rowspan=2 valign=top style='width:29.55pt;border:solid #000000 1.0pt;  border-left:none;padding:0cm 5.4pt 0cm 5.4pt'>
            <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;line-height:normal'><span lang=EN-GB style='color:#000000'>&nbsp;</span></p>
            <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;  line-height:normal'><b><span lang=EN-GB style='color:#000000'>PRA<br>20%</span></b></p>
            </td>
            <td width=48 rowspan=2 valign=top style='width:35.8pt;border:solid #000000 1.0pt;  border-left:none;padding:0cm 5.4pt 0cm 5.4pt'>  <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;  line-height:normal'><span lang=EN-GB style='color:#000000'>&nbsp;</span></p>
            <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;  line-height:normal'><b><span lang=EN-GB style='color:#000000'>Total<br>100%</span></b></p>
            </td>
            <td width=67 rowspan=2 valign=top style='width:50.5pt;border:solid #000000 1.0pt;  border-left:none;padding:0cm 5.4pt 0cm 5.4pt'>
            <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;  line-height:normal'><span lang=EN-GB style='color:#000000'>&nbsp;</span></p>
            <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;  line-height:normal'><b><span lang=EN-GB style='color:#000000'>Remarks</span></b></p>
            </td>
            </tr>
            <tr>
            <td width=27 valign=top style='width:20.1pt;border-top:none;border-left:none;  border-bottom:solid #000000 1.0pt;border-right:solid #000000 1.0pt;  background:#DEEAF6;padding:0cm 5.4pt 0cm 5.4pt'>
            <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;  line-height:normal'><span lang=EN-GB style='color:#000000'>1</span></p>
            </td>
            <td width=27 valign=top style='width:20.1pt;border-top:none;border-left:none;  border-bottom:solid #000000 1.0pt;border-right:solid #000000 1.0pt;  background:#DEEAF6;padding:0cm 5.4pt 0cm 5.4pt'>
            <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;  line-height:normal'><span lang=EN-GB style='color:#000000'>2</span></p>
            </td>
            <td width=27 valign=top style='width:20.15pt;border-top:none;border-left:
            none;border-bottom:solid #000000 1.0pt;border-right:solid #000000 1.0pt;  background:#DEEAF6;padding:0cm 5.4pt 0cm 5.4pt'>
            <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;  line-height:normal'><span lang=EN-GB style='color:#000000'>3</span></p>
            </td>
            <td width=27 valign=top style='width:20.1pt;border-top:none;border-left:none;  border-bottom:solid #000000 1.0pt;border-right:solid #000000 1.0pt;  background:#DEEAF6;padding:0cm 5.4pt 0cm 5.4pt'>
            <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;  line-height:normal'><span lang=EN-GB style='color:#000000'>4</span></p>
            </td>
            <td width=27 valign=top style='width:20.1pt;border-top:none;border-left:none;  border-bottom:solid #000000 1.0pt;border-right:solid #000000 1.0pt;  background:#DEEAF6;padding:0cm 5.4pt 0cm 5.4pt'>
            <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;  line-height:normal'><span lang=EN-GB style='color:#000000'>5</span></p>
            </td>
            <td width=27 valign=top style='width:20.1pt;border-top:none;border-left:none;  border-bottom:solid #000000 1.0pt;border-right:solid #000000 1.0pt;  background:#DEEAF6;padding:0cm 5.4pt 0cm 5.4pt'>
            <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;  line-height:normal'><span lang=EN-GB style='color:#000000'>6</span></p>
            </td>
            <td width=27 valign=top style='width:20.15pt;border-top:none;border-left:
            none;border-bottom:solid #000000 1.0pt;border-right:solid #000000 1.0pt;  background:#DEEAF6;padding:0cm 5.4pt 0cm 5.4pt'>
            <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;  line-height:normal'><span lang=EN-GB style='color:#000000'>7</span></p>
            </td>
            </tr>
            </thead>
            <tbody>
            <?php 
            $mn = 0; 
            while($stdrows = $stdt_qry->fetch(PDO::FETCH_ASSOC))
            {  
                $mtnum = $stdrows["matno"];
                $snames = $pdo->prepare("SELECT * FROM `students` WHERE `matno` LIKE ?");
                $snames->execute([$mtnum]);
                $thename = $snames->fetch();
                $mn++;?>
              <tr>
                <td width=34 valign=top style='width:25.75pt;border:solid #000000 1.0pt;  border-top:none;padding:0cm 5.4pt 0cm 5.4pt'>
                <p class=MsoNormal style='margin-bottom:0cm;line-height:normal'><b><span
                lang=EN-GB style='color:#000000'><?php echo $mn;?>&nbsp;</span></b></p>
                </td>
                <td width=133 valign=top style='width:99.75pt;border-top:none;border-left:
                none;border-bottom:solid #000000 1.0pt;border-right:solid #000000 1.0pt;  padding:0cm 5.4pt 0cm 5.4pt'>
                <p class=MsoNormal style='margin-bottom:0cm;line-height:normal'><span
                lang=EN-GB style='color:#000000'><?php echo  strtoupper($stdrows["matno"]);?>&nbsp;</span></p>
                </td>
                <td width=203 valign=top style='width:152.2pt;border-top:none;border-left:
                none;border-bottom:solid #000000 1.0pt;border-right:solid #000000 1.0pt;  padding:0cm 5.4pt 0cm 5.4pt'>
                <p class=MsoNormal style='margin-bottom:0cm;line-height:normal'><span
                lang=EN-GB style='color:#000000'><?php echo  strtoupper($thename["names"]);?>&nbsp;</span></p>
                </td>
                <td width=80 valign=top style='width:59.85pt;border-top:none;border-left:
                none;border-bottom:solid #000000 1.0pt;border-right:solid #000000 1.0pt;  padding:0cm 5.4pt 0cm 5.4pt'>
                <p class=MsoNormal style='margin-bottom:0cm;line-height:normal'><span
                lang=EN-GB style='color:#000000'>&nbsp;</span></p>
                </td>
                <td width=103 valign=top style='width:77.3pt;border-top:none;border-left:
                none;border-bottom:solid #000000 1.0pt;border-right:solid #000000 1.0pt;  padding:0cm 5.4pt 0cm 5.4pt'>
                <p class=MsoNormal style='margin-bottom:0cm;line-height:normal'><span
                style='color:#000000'>&nbsp;</span></p>
                </td>
                <td width=27 valign=top style='width:20.1pt;border-top:none;border-left:none;  border-bottom:solid #000000 1.0pt;border-right:solid #000000 1.0pt;  padding:0cm 5.4pt 0cm 5.4pt'>
                <p class=MsoNormal style='margin-bottom:0cm;line-height:normal'><span
                lang=EN-GB style='color:#000000'>&nbsp;</span></p>
                </td>
                <td width=27 valign=top style='width:20.1pt;border-top:none;border-left:none;  border-bottom:solid #000000 1.0pt;border-right:solid #000000 1.0pt;  padding:0cm 5.4pt 0cm 5.4pt'>
                <p class=MsoNormal style='margin-bottom:0cm;line-height:normal'><span
                lang=EN-GB style='color:#000000'>&nbsp;</span></p>
                </td>
                <td width=27 valign=top style='width:20.15pt;border-top:none;border-left:
                none;border-bottom:solid #000000 1.0pt;border-right:solid #000000 1.0pt;  padding:0cm 5.4pt 0cm 5.4pt'>
                <p class=MsoNormal style='margin-bottom:0cm;line-height:normal'><span
                lang=EN-GB style='color:#000000'>&nbsp;</span></p>
                </td>
                <td width=27 valign=top style='width:20.1pt;border-top:none;border-left:none;  border-bottom:solid #000000 1.0pt;border-right:solid #000000 1.0pt;  padding:0cm 5.4pt 0cm 5.4pt'>
                <p class=MsoNormal style='margin-bottom:0cm;line-height:normal'><span
                lang=EN-GB style='color:#000000'>&nbsp;</span></p>
                </td>
                <td width=27 valign=top style='width:20.1pt;border-top:none;border-left:none;  border-bottom:solid #000000 1.0pt;border-right:solid #000000 1.0pt;  padding:0cm 5.4pt 0cm 5.4pt'>
                <p class=MsoNormal style='margin-bottom:0cm;line-height:normal'><span
                lang=EN-GB style='color:#000000'>&nbsp;</span></p>
                </td>
                <td width=27 valign=top style='width:20.1pt;border-top:none;border-left:none;  border-bottom:solid #000000 1.0pt;border-right:solid #000000 1.0pt;  padding:0cm 5.4pt 0cm 5.4pt'>
                <p class=MsoNormal style='margin-bottom:0cm;line-height:normal'><span
                lang=EN-GB style='color:#000000'>&nbsp;</span></p>
                </td>
                <td width=27 valign=top style='width:20.15pt;border-top:none;border-left:
                none;border-bottom:solid #000000 1.0pt;border-right:solid #000000 1.0pt;  padding:0cm 5.4pt 0cm 5.4pt'>
                <p class=MsoNormal style='margin-bottom:0cm;line-height:normal'><span
                lang=EN-GB style='color:#000000'>&nbsp;</span></p>
                </td>
                <td width=53 valign=top style='width:39.55pt;border-top:none;border-left:
                none;border-bottom:solid #000000 1.0pt;border-right:solid #000000 1.0pt;  padding:0cm 5.4pt 0cm 5.4pt'>
                <p class=MsoNormal style='margin-bottom:0cm;line-height:normal'><span
                lang=EN-GB style='color:#000000'>&nbsp;</span></p>
                </td>
                <td width=36 valign=top style='width:27.1pt;border-top:none;border-left:none;  border-bottom:solid #000000 1.0pt;border-right:solid #000000 1.0pt;  padding:0cm 5.4pt 0cm 5.4pt'>
                <p class=MsoNormal style='margin-bottom:0cm;line-height:normal'><span
                lang=EN-GB style='color:#000000'>&nbsp;</span></p>
                </td>
                <td width=39 valign=top style='width:29.55pt;border-top:none;border-left:
                none;border-bottom:solid #000000 1.0pt;border-right:solid #000000 1.0pt;  padding:0cm 5.4pt 0cm 5.4pt'>
                <p class=MsoNormal style='margin-bottom:0cm;line-height:normal'><span
                lang=EN-GB style='color:#000000'>&nbsp;</span></p>
                </td>
                <td width=48 valign=top style='width:35.8pt;border-top:none;border-left:none;  border-bottom:solid #000000 1.0pt;border-right:solid #000000 1.0pt;  padding:0cm 5.4pt 0cm 5.4pt'>
                <p class=MsoNormal style='margin-bottom:0cm;line-height:normal'><span
                lang=EN-GB style='color:#000000'>&nbsp;</span></p>
                </td>
                <td width=67 valign=top style='width:50.5pt;border-top:none;border-left:none;  border-bottom:solid #000000 1.0pt;border-right:solid #000000 1.0pt;  padding:0cm 5.4pt 0cm 5.4pt'>
                <p class=MsoNormal style='margin-bottom:0cm;line-height:normal'><span
                lang=EN-GB style='color:#000000'>&nbsp;</span></p>
                </td>
              </tr>
                <?php 
            }?>  
            </tbody>
        </table>
        </div>
        <p>
            <h3>Invigilator(s)</h3>
        <table style="width: 100%;">
        <tr>
            <td style="width:3% ;">SN</td>
            <td>Name</td>
            <td>Signature/Date</td>
        </tr>
        <?php for($in = 1 ; $in <= 4; $in++){?>
        <tr>
            <td><?php echo $in;?></td>
            <td></td>
            <td></td>
        </tr>
        <?php 
        }?>
        </table>
        </p>   
<?php 
    }?>
</body>

</html>
