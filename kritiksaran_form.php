<?php
require('connfile.php');
if (!isset($_SESSION)) {session_start();}
$_SESSION['NaviG'] = 'BERANDA -> KRITIK & SARAN';
?>
<form name="mFrmKritik" method="post" action="kritiksaran_form_.php" enctype="multipart/form-data">
<table width="95%" border="0" style="font-size:10pt; font-family:calibri">
	<tr>
		<td width="5">&nbsp;</td>
		<td width="100">&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td align="right" valign="top">PENGIRIM</td>
		<td width="30">&nbsp;</td>
		<td><input type="text" name="fT1" style="text-align:left; width:200px" /></td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td align="right" valign="top">FOTO PROFIL</td>
		<td>&nbsp;</td>
		<td><input type="file" name="fT2" style="text-align:left; width:204px" /></td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td align="right" valign="top">ALAMAT</td>
		<td width="30">&nbsp;</td>
		<td><input type="text" name="fT3" style="text-align:left; width:350px" /></td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td align="right" valign="top">KRITIK / SARAN</td>
		<td>&nbsp;</td>
		<td><textarea name="fT4" style="width:350px; height:150px;"></textarea></td>
		<td>&nbsp;</td>
	</tr>
	<tr height="10">
	  <td colspan="5"></td>
    </tr>
	<tr>
	  <td>&nbsp;</td>
	  <td align="right" valign="top">&nbsp;</td>
	  <td>&nbsp;</td>
	  <td><input type="button" value="KIRIM" onClick="pSend()" name="B2" style="width: 70px; height: 21px" /></td>
	  <td>&nbsp;</td>
    </tr>
	<tr>
	  <td>&nbsp;</td>
	  <td align="right" valign="top">&nbsp;</td>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
    </tr>
</table>
</form>
