<?php
require_once("../data/db.php");
//$ptype = array("Consultancy Programme"=>"Part Time","Regular Programme"=>"Regular");
$application_no = encryptor("decrypt", $_GET['appno']);

$appqry = $pdo->prepare("SELECT * FROM `applicant` WHERE `application_no` = ?");
$appqry->execute([$application_no]);
$approw = $appqry->fetch(PDO::FETCH_ASSOC);
if($approw["level"] == 'DIP1'){
	$phrase1 = strtoupper($approw["programme"]).' for two years';
	$phrase2 = 'JAMB and Screening requirements';
}
if($approw["level"] == 'ND1'){
	$phrase1 = strtoupper($approw["programme"]).' for two years';
	$phrase2 = 'JAMB and Screening requirements';
}
if($approw["level"] == 'HND1'){
	$phrase1 = strtoupper($approw["programme"]).' for two years';	
	$phrase2 = 'Screening requirements';
}
if($approw["level"] == 'REMEDIAL'){
	$phrase1 = 'one year Remedial course in '.strtoupper($approw["programme"]);	
	$phrase2 = 'Screening requirements';
}
if($approw["level"] == 'CERT'){
	$phrase1 = 'one year Certificate course in '.strtoupper($approw["programme"]);	
	$phrase2 = 'Screening requirements';
}
if($approw["level"] == 'IJMB'){
// 	$phrase1 = 'one year IJMB course in '.strtoupper($approw["programme"]);	
$phrase1 = 'one year '.strtoupper($approw["programme"]).' course';	
	$phrase2 = 'Screening requirements';
}
if($approw["application_fee"] == "unpaid" || $approw["screening_fee"] == "unpaid" || $approw["acceptance_fee"] == "unpaid")
{
	echo '<div class="alert alert-success">This Candidate ('.$approw["applicationno"].')have not made payment</div> <script>setTimeout(function(){location.href="applicationlist.php"},2000)</script>';
}
else
{?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>Offer-Letter<?php echo $application_no;?></title>
  <link rel="shortcut icon" href="logo.png" />
  
  <!-- Include Bootstrap for styling -->
  <link rel="stylesheet" href=
"https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" />
  
  <style>
    .qr-code {
      max-width: 200px;
      margin: 10px;
    }
  </style>

<style type="text/css">

table.MsoTable15Plain4
	{font-size:11.0pt;
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
a:link
	{color:#0563C1;
	text-decoration:underline;
	text-underline:single;
}
.auto-style5 {
	text-align: center;
	font-weight: bold;
}
</style>
</head>

<body>
<p>Application No.<?php echo $approw["application_no"]; 
if($approw["matno"] != "" OR $approw["matno"] != NULL){
?>
<br>Registeration No.<?php echo @$approw["matno"];
}?></p>
<table border="0" cellpadding="0" cellspacing="0" class="MsoTable15Plain4" style="border-collapse:collapse;mso-yfti-tbllook:1536;mso-padding-alt:0in 5.4pt 0in 5.4pt" align="center">
	<tr style="mso-yfti-irow:0;mso-yfti-firstrow:yes">
		<td style="width:467.5pt;padding:0in 5.4pt 0in 5.4pt" valign="top" width="623">
		<p align="center" class="MsoNormal" style="margin-bottom:0in;text-align:center;
  line-height:normal">
  
<img width='100%'
src="offer_head.png" v:shapes="Picture_x0020_3"><br>
		</p>
		</td>
	</tr>
	<tr style="mso-yfti-irow:1;mso-yfti-lastrow:yes">
		<td style="width:624px; padding:0in 5.4pt 0in 5.4pt" valign="top">
		
<p class="MsoNormal"><span style="mso-tab-count:4">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span><span style="mso-spacerun:yes">&nbsp;</span><o:p></o:p></p>
		<span style="font-size:14.0pt;line-height:107%;
font-family:&quot;Times New Roman&quot;,serif">
<p class="MsoNormal" style="margin-top:12.0pt;text-align:justify">
<span style="font-size:12.0pt;line-height:107%;font-family:&quot;Arial Black&quot;,sans-serif"><o:p>
&nbsp;<?php echo $approw["names"];?></o:p></span></p>
<br>
<p class="auto-style5" style="margin-top:12.0pt;">
<span style="font-size:14.0pt;line-height:107%;font-family:&quot;Arial Black&quot;,sans-serif">
OFFER OF PROVISIONAL ADMISSION <?php echo $conf_session;?> SESSION<o:p></o:p></span></p>
<p class="MsoNormal" style="margin-top:12.0pt;text-align:justify">
<span style="font-size:14.0pt;line-height:107%;mso-bidi-font-family:Calibri;
mso-bidi-theme-font:minor-latin">This has reference to your application for 
admission into <?php echo $school_names;?>, Zungeru. I am pleased to inform you that 
you have been offered provisional admission to study a <?php echo $phrase1;?>.</span></p>
<p class="MsoNormal" style="margin-top:12.0pt;text-align:justify">
<span style="font-size:14.0pt;line-height:107%;mso-bidi-font-family:Calibri;
mso-bidi-theme-font:minor-latin">2. Please note that this offer of admission is 
subject to your acceptance and fulfillment of the <?php echo $phrase2;?> as well 
as other conditions that might be issued by the Polytechnic.<o:p></o:p></span></p>
<p class="MsoNormal" style="margin-top:12.0pt;text-align:justify">
<span style="font-size:14.0pt;line-height:107%;mso-bidi-font-family:Calibri;
mso-bidi-theme-font:minor-latin">3. Congratulations.<o:p></o:p></span></p>
</td>
</tr>
<tr>
    <td>
<p class="MsoNormal" style="text-align:justify"><o:p>&nbsp;</o:p><b><span style="font-size:14.0pt"><o:p>&nbsp;</o:p></span></b></p>
<div style="float: right" >
    <img src=
	"https://chart.googleapis.com/chart?cht=qr&chl=<?php echo $approw["application_no"];?>&chs=100x100&chld=L|0"
	        class="qr-code img-thumbnail img-responsive" />
</div>
<div class="MsoNormal" style="margin-bottom:0in;text-align:justify;line-height:
normal">
    <img src="reg_sign.png"width="150px" height="70px" style="width:50; height:40"><br>
    <b>
        <span style="font-size:14.0pt">Registrar Name<o:p></o:p></span>
    </b><br>
    <span style="font-size:14.0pt"> Registrar <o:p></o:p></span>
</div>
</td>
<td>
    <p class="MsoNormal" style="margin-bottom:0in;text-align:justify;line-height:
normal"><span style="font-size:14.0pt">
 
	<o:p></o:p>
</span>
</p>
	</td>
	</tr>	
</table>
 
</body>
<script src=
    "https://code.jquery.com/jquery-3.5.1.js">
  </script>
  
  <script>
    // Function to HTML encode the text
    // This creates a new hidden element,
    // inserts the given text into it 
    // and outputs it out as HTML
    function htmlEncode(value) {
      return $('<div/>').text(value)
        .html();
    }
  
    $(function () {
  
      // Specify an onclick function
      // for the generate button
      $('#generate').click(function () {
  
        // Generate the link that would be
        // used to generate the QR Code
        // with the given data 
        let finalURL =
'https://chart.googleapis.com/chart?cht=qr&chl=' +
          htmlEncode($('#content').val()) +
          '&chs=160x160&chld=L|0'
  
        // Replace the src of the image with
        // the QR code image
        $('.qr-code').attr('src', finalURL);
      });
    });
  </script>
</html>
<?php 
}?>
