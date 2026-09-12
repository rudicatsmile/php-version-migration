<?php
extract($_GET);
if ($CrT=='Img') {$JdL = "UPLOAD FOTO ASET (JPG,JPEG, PNG,GIF,BMP)";} 
else if ($CrT=='Pdf') {$JdL = "UPLOAD DOKUMEN ASET (PDF)";}
else if ($CrT=='Edit') 
{
	$JdL = "EDIT PEMANFAATAN";
	#if ($gJN=='RB') {$JdL.=" ASET RUSAK BERAT";}
	#if ($gJN=='MK') {$JdL.=" MUTASI ANTAR KIB";}
}
?>
<table border="0" width="100%" height="23" cellspacing="0" cellpadding="0" align="center">
  <tr>
    <td width="20" style="padding-left:3px"><img src="css/images/upload.png" /></td>
    <td style="font-size:11pt; font-weight:bold; text-shadow: #fff 1px 2px 2px"><?=$JdL?></td>
    <td style="text-align:right; padding-right:6px"><a href="#" onclick="dispNO('edtMstCri'); B11.click(); " class="igo clos"><u>C</u>LOSE</a></td>
  </tr>
</table>