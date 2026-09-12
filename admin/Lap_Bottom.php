		<table border="0" width="100%" cellspacing="1" style="font-family: Calibri; font-size: 10pt; border-collapse: collapse">
		<tr>
			<td width="400">&nbsp;</td>
			<td>&nbsp;</td>
			<td width="400">&nbsp;</td>
		</tr>
		<?php
		$DataG = fGlobal("Nma_Pimpinan:Nip_Pimpinan:Jab_Pimpinan","ref_unit","Kd_Unit",$gUnt,"=","","");
		if ($DataG)
		{
			$DataG = explode(':', $DataG);
			$NmaP = $DataG[0];
			$NipP = $DataG[1];
			$JbaP = $DataG[2];
			if ($frHri=="") {$frHri=fGetDate('mday');}
			if ($frBln=="") {$frBln=fGetDate('mon');}
			if ($frThn=="") {$frThn=fGetDate('year');}
		}
		?>
		<tr>
		  <td>&nbsp;</td>
		  <td>&nbsp;</td>
		  <td style="text-align:center"><?=$NmIbuk.", ".$frHri." ".fNmBulan($frBln)." ".$frThn?></td>
		  </tr>
		<tr>
		  <td>&nbsp;</td>
		  <td>&nbsp;</td>
		  <td style="text-align:center">&nbsp;</td>
		  </tr>
		<tr>
		  <td>&nbsp;</td>
		  <td>&nbsp;</td>
		  <td style="text-align:center"><?=$JbaP?></td>
		  </tr>
		<tr height="70">
		  <td>&nbsp;</td>
		  <td>&nbsp;</td>
		  <td>&nbsp;</td>
		  </tr>
		<tr>
		  <td>&nbsp;</td>
		  <td>&nbsp;</td>
		  <td style="text-align:center; text-decoration:underline; font-weight:bold">&nbsp;&nbsp;<?=$NmaP?>&nbsp;&nbsp;</td>
		  </tr>
		<tr>
		  <td>&nbsp;</td>
		  <td>&nbsp;</td>
		  <td style="text-align:center">NIP. <?=$NipP?></td>
		  </tr>
		<tr>
		  <td>&nbsp;</td>
		  <td>&nbsp;</td>
		  <td>&nbsp;</td>
		  </tr>
	    </table>
