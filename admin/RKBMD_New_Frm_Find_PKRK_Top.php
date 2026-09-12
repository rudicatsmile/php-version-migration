<?php
extract($_GET);
?>
<table border="0" width="100%" height="34" cellspacing="0" cellpadding="0" align="center">
  <tr>
    <td width="10">&nbsp;</td>
    <td width="50" style="padding-left:3px">Search</td>
    <td>
	<?php if ($gFrm=='prog'){ ?>
	<input type="text" name="fFindPR" onkeypress="if (event.keyCode==13){showPROG('<?=$stLOCK?>','find','<?=$IdT?>','<?=$IdL?>');} else if (event.keyCode==27){closeCLICK('<?=$gFrm?>'); return false}" style="width: 200px">
	<?php } ?>
	<?php if ($gFrm=='kegi'){ ?>
	<input type="text" name="fFindKG" onkeypress="if (event.keyCode==13){showKEGI('<?=$stLOCK?>','find','<?=$rIdT?>','<?=$IdL?>');} else if (event.keyCode==27){closeCLICK('<?=$gFrm?>'); return false}" style="width: 200px">
	<?php } ?>
	<?php if ($gFrm=='subk'){ ?>
	<input type="text" name="fFindSB" onkeypress="if (event.keyCode==13){showSUBK('<?=$stLOCK?>','find','<?=$rIdT?>','<?=$IdL?>');} else if (event.keyCode==27){closeCLICK('<?=$gFrm?>'); return false}" style="width: 200px">
	<?php } ?>
	<?php if ($gFrm=='rekn'){ ?>
	<input type="text" name="fFindRK" onkeypress="if (event.keyCode==13){showREKN('<?=$stLOCK?>','find','<?=$rIdT?>','<?=$IdL?>');} else if (event.keyCode==27){closeCLICK('<?=$gFrm?>'); return false}" style="width: 200px">
	<?php } ?>
	</td>
    <td style="text-align:right; padding-right:6px"><a href="#" onclick="closeCLICK('<?=$gFrm?>'); return false" class="ico clos"><u>C</u>LOSE</a></td>
  </tr>
</table>
<script languange="javascript">
	<?php if ($gFrm=='prog'){ ?>
		myfrm.fFindPR.focus();
	<?php } ?>
	<?php if ($gFrm=='kegi'){ ?>
		myfrm.fFindKG.focus();
	<?php } ?>
	<?php if ($gFrm=='subk'){ ?>
		myfrm.fFindSB.focus();
	<?php } ?>
	<?php if ($gFrm=='rekn'){ ?>
		myfrm.fFindRK.focus();
	<?php } ?>
</script>