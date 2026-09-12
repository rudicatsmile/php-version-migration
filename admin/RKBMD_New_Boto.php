<table border="0" cellspacing="0" cellpadding="0" align="center" style="width:99%; height:100%">
  <tr>
  <td style="text-align:center; color:#990000">
  <?php 
  if (isset($_GET['MsG'])){
  	$MsG  = str_replace('**',' ',$_GET['MsG']);
  	$MsG  = str_replace('_',' ',$MsG);
	echo strtolower($MsG);
  }
  ?></td>
</tr>
</table>