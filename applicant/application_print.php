<?php 
include("../data/db.php");
$applicationno = encryptor('decrypt',$_GET['appno']);
$apptypes = $applicationno;
   
$checkq = $pdo->prepare("SELECT * FROM `applicant` WHERE `application_no` = ?");
$checkq->execute([$applicationno]);
$app_data = $checkq->fetch();

$programme = $app_data["programme"];
list($programme_type) = explode(' IN', $programme);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
    <title>EYAIMAS | APPLICATION FORM</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="eyaimas.png">
    <style type="text/css">
table.MsoTableGrid
	{border:solid windowtext 1.0pt;
	font-size:11.0pt;
	font-family:"Calibri",sans-serif;
	}
 p.MsoNormal
	{margin-top:0in;
	margin-right:0in;
	margin-bottom:8.0pt;
	margin-left:0in;
	line-height:107%;
	font-size:11.0pt;
	font-family:"Calibri",sans-serif;
	}
.auto-style1 {
	text-align: center;
}
.auto-style2 {
	font-size: 20pt;
}
.auto-style3 {
	font-size: 14pt;
	font-weight: bold;
}
.auto-style4 {
	font-size: 14pt;
}
.auto-style5 {
	font-family: "Times New Roman", Times, serif;
}
</style>


<script>
	function printDiv() {
	    var divContents = document.getElementById("appform").innerHTML;
	    var a = window.open('', '', 'height=900, width=500');
	    a.document.write(divContents);
	    a.document.close();
	    a.print();
	}
</script>
</head>

<body>

<table border="1" cellpadding="0" cellspacing="0" class="MsoTableGrid" style="width:100%;;border-collapse:collapse;
 border:none;mso-border-alt:solid windowtext .5pt;mso-yfti-tbllook:1184;
 mso-padding-alt:0in 5.4pt 0in 5.4pt" width="722" align="center">
	<tr style="mso-yfti-irow:0;mso-yfti-firstrow:yes;">
		<td colspan="13" style="border:solid windowtext 1.0pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;" valign="top" class="auto-style1">		
                <img src="eyaimas.png" alt="EYAIMAS" style="width: 120px; height: 100px;" class="img-responsive" />
                <b><span style="font-size:16.0pt"><br />
		<span class="auto-style5">ETSU YAHAYA ABUBAKAR INSTITUTE OF MANAGAMENT AND ADMINISTRATIVE STUDIES 
		</span></span></b><br />
		<span class="about-sub-title">
		<span data-wow-delay=".2s" data-wow-duration="1s" style="font-size: 14.0pt">
		<strong>MINNA - NIGER STATE</strong></span></span>
		<span style="font-size:12.0pt"><strong><br />
		</strong>
		<span class="about-sub-title">
		<span data-wow-delay=".2s" data-wow-duration="1s"><strong>(Office of the 
		Registrar)</strong></span><o:p><br />
	<hr>
		<strong>APPLICATION DATA</strong></span></span></o:p></td>
	</tr>
	
	<tr style="mso-yfti-irow:2;height:26.5pt">
	    <td colspan="8">APPLICATION NO.: 
		<b><?php echo $app_data['application_no'];?></b>
	    <br>PROGRAMME: <b><?php echo $app_data['programme'];?></b>
	    </td>
	    
	    <td  colspan="5">STUDY CENTRE: <b><?php echo $app_data['study_center'];?></b>
	    <br>STUDY MODE: <b><?php echo $app_data['study_mode'];?></b><br>LEVEL: <b><?php echo $app_data['level'];?></b></td>
	</tr>

	<tr style="mso-yfti-irow:4;height:26.05pt">
		<td colspan="13" style="width:541.75pt;border:solid windowtext 1.0pt;
  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0in 5.4pt 0in 5.4pt;height:26.05pt" valign="bottom" width="722">
		<p style="mso-margin-top-alt:auto;mso-margin-bottom-alt:auto;
  line-height:normal;mso-outline-level:3"><b><u>
		<span style="font-family:&quot;Times New Roman&quot;,serif;mso-fareast-font-family:&quot;Times New Roman&quot;;
  mso-font-kerning:0pt;mso-ligatures:none" class="auto-style4">Personal Data</span><span style="font-size:13.0pt"><o:p></o:p></span></u></b></p>
		</td>
	</tr>
	<tr style="mso-yfti-irow:5;height:18.4pt">
		<td colspan="2" style="width:108.25pt;border:solid windowtext 1.0pt;
  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0in 5.4pt 0in 5.4pt;height:18.4pt" valign="bottom" width="144">
		<p class="MsoNormal" style="margin-bottom:0in;line-height:normal"><b>
		<span style="font-size:13.0pt">Applicant Name<o:p></o:p></span></b></p>
		</td>
		<td colspan="3" style="width:108.25pt;border-top:none;
  border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:18.4pt" valign="bottom" width="144">
		<p class="MsoNormal" style="margin-bottom:0in;line-height:normal"><b>
		<span style="font-size:13.0pt">Date of Birth<o:p></o:p></span></b></p>
		</td>
		<td colspan="3" style="width:108.35pt;border-top:none;
  border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:18.4pt" valign="bottom" width="144">
		<p class="MsoNormal" style="margin-bottom:0in;line-height:normal"><b>
		<span style="font-size:13.0pt">Gender<o:p></o:p></span></b></p>
		</td>
		<td colspan="3" style="width:108.35pt;border-top:none;
  border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:18.4pt" valign="bottom" width="144">
		<p class="MsoNormal" style="margin-bottom:0in;line-height:normal"><b>
		<span style="font-size:13.0pt">Marital Status<o:p></o:p></span></b></p>
		</td>
		<td colspan="2" style="width:108.55pt;border-top:none;
  border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:18.4pt" valign="bottom" width="145">
		<p class="MsoNormal" style="margin-bottom:0in;line-height:normal"><b>
		<span style="font-size:13.0pt">Phone Number<o:p></o:p></span></b></p>
		</td>
	</tr>
	<tr style="mso-yfti-irow:6;height:26.05pt">
		<td colspan="2" style="width:108.25pt;border:solid windowtext 1.0pt;
  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0in 5.4pt 0in 5.4pt;height:26.05pt" valign="bottom" width="144">
		<?php echo $app_data['names'];?></td>
		<td colspan="3" style="width:108.25pt;border-top:none;
  border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:26.05pt" valign="bottom" width="144">
		<?php echo $app_data['dob'];?></td>
		<td colspan="3" style="width:108.35pt;border-top:none;
  border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:26.05pt" valign="bottom" width="144">
		<?php echo $app_data['gender'];?></td>
		<td colspan="3" style="width:108.35pt;border-top:none;
  border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:26.05pt" valign="bottom" width="144">
		<?php echo $app_data['marital'];?></td>
		<td colspan="2" style="width:108.55pt;border-top:none;
  border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:26.05pt" valign="bottom" width="145">
		<?php echo $app_data['gsm'];?></td>
	</tr>
	<tr style="mso-yfti-irow:7;height:17.05pt">
		<td colspan="2" style="width:108.25pt;border:solid windowtext 1.0pt;
  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0in 5.4pt 0in 5.4pt;height:17.05pt" valign="bottom" width="144">
		<p class="MsoNormal" style="margin-bottom:0in;line-height:normal"><b>
		<span style="font-size:13.0pt">Country<o:p></o:p></span></b></p>
		</td>
		<td colspan="3" style="width:108.25pt;border-top:none;
  border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:17.05pt" valign="bottom" width="144">
		<p class="MsoNormal" style="margin-bottom:0in;line-height:normal"><b>
		<span style="font-size:13.0pt">State<o:p></o:p></span></b></p>
		</td>
		<td colspan="3" style="width:108.35pt;border-top:none;
  border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:17.05pt" valign="bottom" width="144">
		<p class="MsoNormal" style="margin-bottom:0in;line-height:normal"><b>
		<span style="font-size:13.0pt">LGA<o:p></o:p></span></b></p>
		</td>
		<td colspan="3" style="width:108.35pt;border-top:none;
  border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:17.05pt" valign="bottom" width="144">
		<p class="MsoNormal" style="margin-bottom:0in;line-height:normal"><b>
		<span style="font-size:13.0pt">Tribe<o:p></o:p></span></b></p>
		</td>
		<td colspan="2" style="width:108.55pt;border-top:none;
  border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:17.05pt" valign="bottom" width="145">
		<p class="MsoNormal" style="margin-bottom:0in;line-height:normal"><b>
		<span style="font-size:13.0pt">Email<o:p></o:p></span></b></p>
		</td>
	</tr>
	<tr style="mso-yfti-irow:8;height:31.45pt">
		<td colspan="2" style="width:108.25pt;border:solid windowtext 1.0pt;
  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0in 5.4pt 0in 5.4pt;height:31.45pt" valign="bottom" width="144">
		<?php echo $app_data['country'];?></td>
		<td colspan="3" style="width:108.25pt;border-top:none;
  border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:31.45pt" valign="bottom" width="144">
		<?php echo $app_data['state'];?></td>
		<td colspan="3" style="width:108.35pt;border-top:none;
  border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:31.45pt" valign="bottom" width="144">
		<?php echo $app_data['lga'];?></td>
		<td colspan="3" style="width:108.35pt;border-top:none;
  border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:31.45pt" valign="bottom" width="144">
		<?php echo $app_data['tribe'];?></td>
		<td colspan="2" style="width:108.55pt;border-top:none;
  border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:31.45pt" valign="bottom" width="145">
		<?php echo $app_data['email'];?></td>
	</tr>
	<tr style="mso-yfti-irow:9;height:17.5pt">
		<td colspan="13" style="width:541.75pt;border:solid windowtext 1.0pt;
  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0in 5.4pt 0in 5.4pt;height:17.5pt" valign="bottom" width="722">
		<p class="MsoNormal" style="margin-bottom:0in;line-height:normal"><b>
		<span style="font-size:13.0pt">Address</span></b><span style="font-size:13.0pt"><o:p></o:p></span></p>
		</td>
	</tr>
	<tr style="mso-yfti-irow:10;height:26.95pt">
		<td colspan="13" style="width:541.75pt;border:solid windowtext 1.0pt;
  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0in 5.4pt 0in 5.4pt;height:26.95pt" valign="bottom" width="722">
		<?php echo $app_data['pgaddress'];?></td>
	</tr>
	 <?php $app_doc = $pdo->query("SELECT * FROM `app_document` WHERE `application_no` = '$applicationno'"); //$app_doc->fetch();?>	 
        
          	 <?php while($docs = $app_doc->fetch()){?> 
       	<tr style="mso-yfti-irow:12;height:19.75pt">
		<td colspan="6" style="width:270.85pt;border:solid windowtext 1.0pt;
  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0in 5.4pt 0in 5.4pt;height:19.75pt" valign="bottom" width="361">
		<?php echo $docs['title'];?></td>
		<td colspan="7" style="width:270.9pt;border-top:none;
  border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:19.75pt" valign="bottom" width="361">
		&nbsp;</td>		
	</tr>
	 <?php  }?>
	<tr style="mso-yfti-irow:13;height:26.95pt">
		<td colspan="13" style="width:541.75pt;border:solid windowtext 1.0pt;
  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0in 5.4pt 0in 5.4pt;height:26.95pt" valign="bottom" width="722">
		<p style="mso-margin-top-alt:auto;mso-margin-bottom-alt:auto;
  line-height:normal;mso-outline-level:3"><u>
		<span style="font-family:&quot;Times New Roman&quot;,serif;mso-fareast-font-family:&quot;Times New Roman&quot;;
  mso-font-kerning:0pt;mso-ligatures:none" class="auto-style3">Parent /Guardian Data</span></u><o:p></o:p></p>
		</td>
	</tr>
	<tr style="mso-yfti-irow:14;height:23.35pt">
		<td colspan="3" style="width:135.3pt;border:solid windowtext 1.0pt;
  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0in 5.4pt 0in 5.4pt;height:23.35pt" valign="bottom" width="180">
		<p class="MsoNormal" style="margin-bottom:0in;line-height:normal"><b>
		<span style="font-size:13.0pt">Name<o:p></o:p></span></b></p>
		</td>
		<td colspan="4" style="width:179.7pt;border-top:none;
  border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:23.35pt" valign="bottom" width="240">
		<p class="MsoNormal" style="margin-bottom:0in;line-height:normal"><b>
		<span style="font-size:13.0pt">Contact<o:p></o:p></span></b></p>
		</td>
		<td colspan="3" style="width:91.2pt;border-top:none;
  border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:23.35pt" valign="bottom" width="122">
		<p class="MsoNormal" style="margin-bottom:0in;line-height:normal"><b>
		<span style="font-size:13.0pt">Relationship<o:p></o:p></span></b></p>
		</td>
		<td colspan="3" style="width:135.55pt;border-top:none;
  border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:23.35pt" valign="bottom" width="181">
		<p class="MsoNormal" style="margin-bottom:0in;line-height:normal"><b>
		<span style="font-size:13.0pt">Address<o:p></o:p></span></b></p>
		</td>
	</tr>
	<tr style="mso-yfti-irow:15;mso-yfti-lastrow:yes;height:26.5pt">
		<td colspan="3" style="width:135.3pt;border:solid windowtext 1.0pt;
  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0in 5.4pt 0in 5.4pt;height:26.5pt" valign="bottom" width="180">
		<?php echo $app_data['pgname'];?></td>
		<td colspan="4" style="width:179.7pt;border-top:none;
  border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:26.5pt" valign="bottom" width="240">
		<?php echo $app_data['pggsm'];?></td>
		<td colspan="3" style="width:91.2pt;border-top:none;
  border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:26.5pt" valign="bottom" width="122">
		<?php echo $app_data['relationship'];?></td>
		<td colspan="3" style="width:135.55pt;border-top:none;
  border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:26.5pt" valign="bottom" width="181">
		<?php echo $app_data['pgaddress'];?></td>
	</tr>
</table>
<!-- <p style="page-break-before: always;" ></p>-->
 <?php //$doc = $pdo->query("SELECT * FROM `app_olevel` WHERE `appno` = '$applicationno'");?>  
 <table style="width:100%">
     <tr>
     <td>
          <div style="float:auto">
        <h3 class="sidebar-title">O'level Details</h3>
          <table border="1" cellpadding="0" cellspacing="0" style="width:100%">
            <tr>
              <th>#</th>
              <th>Subject</th>
              <th>Grade</th>
              <th>Body</th>
              <th>Date</th>
            </tr>
            <?php $oln=0;
            $app_docss = $pdo->prepare("SELECT * FROM `app_olevel` WHERE `appno` = ?");
			$app_docss->execute([$applicationno]);
			//$app_docss = $app_doc->fetch();
            while($doc_row = $app_docss->fetch())
            { $oln++;?>
              <tr>
                <td><?php echo $oln;?></td>
                <td><?php echo $doc_row["subject"];?></td>
                <td><?php echo $doc_row["grade"];?></td>
                <td><?php echo $doc_row["exambody"];?></td>
                <td><?php echo $doc_row["examdate"];?></td>
              </tr>
            <?php
            }
            ?>
          </table>
          </div>
          </td>
            <td>
          <div style="float:auto">
          <?php 
            if($programme_type == "HIGHER NATIONAL DIPLOMA")
            {?>
            <h5>NATIONAL DIPLOMA Details</h5>
          <table border="1" cellpadding="0" cellspacing="0" style="width:100%">
            <tr>
              <th>#</th>
              <th>Institute</th>
              <th>Course</th>
              <th>Class</th>
              <th>Date</th>
            </tr>
            <?php $oln=0;
            $app_docss = $pdo->prepare("SELECT * FROM `app_institute` WHERE `appno` = ?");
			$app_docss->execute([$applicationno]);
			//$app_docss = $app_doc->fetch();
            while($doc_row = $app_docss->fetch())
            { $oln++;?>
              <tr>
                <td><?php echo $oln;?></td>
                <td><?php echo $doc_row["institution"];?></td>
                <td><?php echo $doc_row["course"];?></td>
                <td><?php echo $doc_row["class"];?></td>
                <td><?php echo $doc_row["date"];?></td>
              </tr>
            <?php
            }
            ?>
          </table>
            
            <?php 
            }?>
            </td>
        </tr>
        </table>
</div>
</body>

</html>
