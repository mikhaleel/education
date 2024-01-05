<?php
require_once("../data/db.php");
$application_no = encryptor("decrypt", $_GET['appno']);

$appqry = $pdo->prepare("SELECT * FROM `applicant` WHERE `application_no` = ?");
$appqry->execute([$application_no]);
$approw = $appqry->fetch(PDO::FETCH_ASSOC);
$level = $approw["level"];
$category = "School Fees";
$session = $school_activesession;
$lvl = "%1%";
$payment_type = $pdo->prepare("SELECT * FROM `payment_schedule` WHERE `category` like ? AND `level` LIKE ? AND `session`=? AND `semester`=?");
$payment_type->execute([$category,$lvl, $session, 1]);
$fetch_sch = $payment_type->fetch();
?>
<head>
<style type="text/css">
 p.MsoNormal
	{margin-bottom:.0001pt;
	font-size:12.0pt;
	font-family:"Times New Roman",serif;
	margin-left: 0in;
	margin-right: 0in;
	margin-top: 0in;
}
table.MsoTableGrid
	{border:solid windowtext 1.0pt;
	font-size:11.0pt;
	font-family:"Calibri",sans-serif;
	}
p.MsoListParagraphCxSpFirst
	{margin-top:0in;
	margin-right:0in;
	margin-bottom:0in;
	margin-left:.5in;
	margin-bottom:.0001pt;
	font-size:12.0pt;
	font-family:"Times New Roman",serif;
	}
a:link
	{color:#0563C1;
	text-decoration:underline;
	text-underline:single;
}
p.MsoListParagraphCxSpMiddle
	{margin-top:0in;
	margin-right:0in;
	margin-bottom:0in;
	margin-left:.5in;
	margin-bottom:.0001pt;
	font-size:12.0pt;
	font-family:"Times New Roman",serif;
	}
p.MsoListParagraphCxSpLast
	{margin-top:0in;
	margin-right:0in;
	margin-bottom:0in;
	margin-left:.5in;
	margin-bottom:.0001pt;
	font-size:12.0pt;
	font-family:"Times New Roman",serif;
	}
</style>
</head>

<p align="center" class="MsoNormal"><b><span style="mso-bidi-font-size:16.0pt"><![if !vml]>
<img height="60" src="logo.png" v:shapes="_x0000_i1025" width="78"><![endif]>
</span><span style="font-size:11.0pt;mso-bidi-font-size:
13.5pt"><o:p></o:p></span></b></p>
<p align="center" class="MsoNormal"><b>
<span style="font-size:18.0pt;mso-bidi-font-size:13.5pt"><?php echo strtoupper($school_names);?><o:p></o:p></span></b></p>
<p align="center" class="MsoNormal"><b>
<span style="font-size:11.0pt;mso-bidi-font-size:13.5pt">FEES PAYABLE / PAYMENT 
PROCEDURE<o:p></o:p></span></b></p>
<p align="center" class="MsoNormal"><b>
<span style="font-size:11.0pt;mso-bidi-font-size:13.5pt">
<span style="mso-spacerun:yes">&nbsp;</span><?php echo $school_activesession;?> ACADEMIC SESSIONS<o:p></o:p></span></b></p>
<p align="center" class="MsoNormal"><b>
<span style="font-size:11.0pt;mso-bidi-font-size:13.5pt">PROGRAM:<span style="mso-spacerun:yes">&nbsp;
</span>FULL TIME PROGRAMMES <o:p></o:p></span></b></p>
<p class="MsoNormal"><b><span style="font-size:5.0pt;mso-bidi-font-size:13.5pt"><o:p>
&nbsp;</o:p></span></b></p>
<p align="center" class="MsoNormal"><b><span style="mso-bidi-font-size:17.5pt">
FIRST SEMESTERS <?php echo $school_activesession;?><o:p></o:p></span></b></p>
<p align="center" class="MsoNormal"><b><span style="mso-bidi-font-size:17.5pt"><o:p>
&nbsp;</o:p></span></b></p>
<p class="MsoNormal"><b style="mso-bidi-font-weight:normal"><u>
<span style="font-size:14.0pt;mso-bidi-font-size:12.0pt">PAYMENT SCHEDULE<o:p></o:p></span></u></b></p>
<p align="center" class="MsoNormal"><b><span style="mso-bidi-font-size:17.5pt"><o:p>
&nbsp;</o:p></span></b></p>
<p align="center" class="MsoNormal"><b><span style="mso-bidi-font-size:17.5pt"><o:p>
&nbsp;</o:p></span></b></p>
<table border="1" cellpadding="0" cellspacing="0" class="MsoTableGrid" width="0">
	<tr style="mso-yfti-irow:0;mso-yfti-firstrow:yes;height:13.9pt">
		<td rowspan="2" style="width:37.3pt;border:solid windowtext 1.0pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:13.9pt" valign="top" width="50">
		<p align="center" class="MsoNormal">
		<b style="mso-bidi-font-weight:normal">
		<span style="font-size:18.0pt;mso-bidi-font-size:
  12.0pt">SN<o:p></o:p></span></b></p>
		</td>
		<td rowspan="2" style="width:187.45pt;border:solid windowtext 1.0pt;
  border-left:none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
  solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:13.9pt" valign="top" width="250">
		<p align="center" class="MsoNormal">
		<b style="mso-bidi-font-weight:normal">
		<span style="font-size:18.0pt;mso-bidi-font-size:
  12.0pt">LEVEL<o:p></o:p></span></b></p>
		</td>
		<td colspan="2" style="width:265.5pt;border:solid windowtext 1.0pt;
  border-left:none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
  solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:13.9pt" valign="top" width="354">
		<p align="center" class="MsoNormal">
		<b style="mso-bidi-font-weight:normal">
		<span style="font-size:18.0pt;mso-bidi-font-size:
  12.0pt">AMOUNT<o:p></o:p></span></b></p>
		</td>
	</tr>
	<tr style="mso-yfti-irow:1;height:13.85pt">
		<td style="width:139.5pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:13.85pt" valign="top" width="186">
		<p align="center" class="MsoNormal">
		<b style="mso-bidi-font-weight:normal">
		<span style="font-size:18.0pt;mso-bidi-font-size:
  12.0pt">Indigene<o:p></o:p></span></b></p>
		</td>
		<td style="width:1.75in;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:13.85pt" valign="top" width="168">
		<p align="center" class="MsoNormal">
		<b style="mso-bidi-font-weight:normal">
		<span style="font-size:18.0pt;mso-bidi-font-size:
  12.0pt">Non-Indigene<o:p></o:p></span></b></p>
		</td>
	</tr>
	<?php while($fetch_sch = $payment_type->fetch()){?>
	<tr style="mso-yfti-irow:2;height:10.55pt">
		<td style="width:37.3pt;border:solid windowtext 1.0pt;
  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0in 5.4pt 0in 5.4pt;height:10.55pt" valign="top" width="50">
		<p align="center" class="MsoNormal">
		<span style="font-size:18.0pt;mso-bidi-font-size:12.0pt">1<o:p></o:p></span></p>
		</td>
		<td style="width:187.45pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:10.55pt" valign="top" width="250">
		<p class="MsoNormal">
		<span style="font-size:18.0pt;mso-bidi-font-size:12.0pt"><?php echo $fetch_sch['level'];?><o:p></o:p></span></p>
		</td>
		<td style="width:139.5pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:10.55pt" valign="top" width="186">
		<p align="center" class="MsoNormal"><s style="text-line-through:double">
		<span style="font-size:18.0pt;mso-bidi-font-size:
  12.0pt">N</span></s><span style="font-size:18.0pt;mso-bidi-font-size:12.0pt"><?php echo $fetch_sch['amount_indigene'];?><o:p></o:p></span></p>
		</td>
		<td style="width:1.75in;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:10.55pt" valign="top" width="168">
		<p align="center" class="MsoNormal"><s style="text-line-through:double">
		<span style="font-size:18.0pt;mso-bidi-font-size:
  12.0pt">N</span></s><span style="font-size:18.0pt;mso-bidi-font-size:12.0pt"><?php echo $fetch_sch['amount_nonindigene'];?><o:p></o:p></span></p>
		</td>
	</tr>
	<?php }?>
</table>
<p class="MsoNormal"><o:p>&nbsp;</o:p></p>
<p class="MsoNormal"><o:p>&nbsp;</o:p></p>
<p class="MsoNormal"><span style="font-size:14.0pt;mso-bidi-font-size:12.0pt">
Signed
<o:p></o:p></span></p>
<p class="MsoNormal"><b style="mso-bidi-font-weight:normal">
<span style="font-size:14.0pt;mso-bidi-font-size:12.0pt">Karimu Victoria <sub>
(FCNS)</sub><o:p></o:p></span></b></p>
<p class="MsoNormal"><span style="font-size:14.0pt;mso-bidi-font-size:12.0pt">
Bursar<o:p></o:p></span></p>
<p class="MsoNormal"><span style="font-size:14.0pt;mso-bidi-font-size:12.0pt"><o:p>
&nbsp;</o:p></span></p>
<p class="MsoNormal"><span style="font-size:14.0pt;mso-bidi-font-size:12.0pt"><o:p>
&nbsp;</o:p></span></p>
<p class="MsoNormal"><b style="mso-bidi-font-weight:
normal"><u><span style="font-size:14.0pt;mso-bidi-font-size:12.0pt">PAYMENT 
PROCEDURE<o:p></o:p></span></u></b></p>
<p align="center" class="MsoNormal"><b style="mso-bidi-font-weight:
normal"><u><span style="font-size:14.0pt;mso-bidi-font-size:12.0pt"><o:p>
<span style="text-decoration:none">&nbsp;</span></o:p></span></u></b></p>
<p class="MsoNormal"><span style="font-size:14.0pt;
mso-bidi-font-size:12.0pt">Follow the steps below to pay your school fee: <o:p></o:p>
</span></p>
<p class="MsoNormal"><span style="font-size:14.0pt;
mso-bidi-font-size:12.0pt"><o:p>&nbsp;</o:p></span></p>
<p class="MsoListParagraphCxSpFirst"><![if !supportLists]>
<span style="font-size:14.0pt;
mso-bidi-font-size:12.0pt"><span style="mso-list:Ignore">1.<span style="font:7.0pt &quot;Times New Roman&quot;">&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]>
<span style="font-size:14.0pt;mso-bidi-font-size:12.0pt">Visit:
<a href="https://fulltime.nigerpoly.edu.ng/application">
https://domain.edu.ng/application</a>
<o:p></o:p></span></p>
<p class="MsoListParagraphCxSpMiddle"><![if !supportLists]>
<span style="font-size:14.0pt;
mso-bidi-font-size:12.0pt"><span style="mso-list:Ignore">2.<span style="font:7.0pt &quot;Times New Roman&quot;">&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]>
<span style="font-size:14.0pt;mso-bidi-font-size:12.0pt">Click on “Continue 
Application” button <o:p></o:p></span></p>
<p class="MsoListParagraphCxSpMiddle"><![if !supportLists]>
<span style="font-size:14.0pt;
mso-bidi-font-size:12.0pt"><span style="mso-list:Ignore">3.<span style="font:7.0pt &quot;Times New Roman&quot;">&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]>
<span style="font-size:14.0pt;mso-bidi-font-size:12.0pt">Enter your application 
number and password <o:p></o:p></span></p>
<p class="MsoListParagraphCxSpMiddle"><![if !supportLists]>
<span style="font-size:14.0pt;
mso-bidi-font-size:12.0pt"><span style="mso-list:Ignore">4.<span style="font:7.0pt &quot;Times New Roman&quot;">&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]>
<span style="font-size:14.0pt;mso-bidi-font-size:12.0pt">Then click on 
“continue” button<o:p></o:p></span></p>
<p class="MsoListParagraphCxSpLast"><![if !supportLists]>
<span style="font-size:14.0pt;
mso-bidi-font-size:12.0pt"><span style="mso-list:Ignore">5.<span style="font:7.0pt &quot;Times New Roman&quot;">&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]>
<span style="font-size:14.0pt;mso-bidi-font-size:12.0pt">Then Click on <u>
<span style="color:#0070C0">Pay Now</span></u><span style="color:#0070C0">
</span>link to proceed to payment invoice.<o:p></o:p></span></p>
<p class="MsoNormal"><b style="mso-bidi-font-weight:
normal"><span style="font-size:14.0pt;mso-bidi-font-size:12.0pt"><o:p>&nbsp;</o:p></span></b></p>
<p class="MsoNormal"><b style="mso-bidi-font-weight:
normal"><span style="color:red">Note</span></b><span style="color:red">: The Pay 
Now link will not appear until you appeared for physical screening <o:p></o:p>
</span></p>
<p class="MsoNormal"><o:p>&nbsp;</o:p></p>
