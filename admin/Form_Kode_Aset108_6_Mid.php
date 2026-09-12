<?php require "CheckSession.php"?>
<?php require "Connection.php";?>
<?php require "FileFunction.php";?>
<?php require "CheckLogin.php"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
<title>SIMBAD@</title>
<link rel="stylesheet" href="css/style_popup.css" type="text/css" media="all" />
<script type="text/javascript" src="js/jquery-1.8.2.min.js"></script>
</head>
<?php
extract($_GET);
extract($_POST);

$rIDT = $rIDT;
$Sbmt  = "";
if ($rIDT!="")
{
	$nSQ = "SELECT * FROM ref_rek_aset108_7 WHERE IDT='".$rIDT."'";
	$nRs = mysql_query($nSQ) or die(mysql_error());
	$mRo = mysql_fetch_assoc($nRs);
	$tRo = mysql_num_rows($nRs);
	if ($tRo > 0)
	{
		$gCod  = $mRo['Kd_Aset'];
		$gNma  = $mRo['Nm_Aset'];
		$gMas  = $mRo['Ms_Manfaat'];
		
		$gBid  = substr($gCod,0,3);
		if (substr($gCod,0,6)=='1.1.12')
		{
			$gKel  = substr($gCod,0,6);
			$gJNS  = substr($gCod,0,9);
			$gOBJ  = substr($gCod,0,12);
			$gSUB  = substr($gCod,0,15);
		}
		else
		{
			$gKel  = substr($gCod,0,5);
			$gJNS  = substr($gCod,0,8);
			$gOBJ  = substr($gCod,0,11);
			$gSUB  = substr($gCod,0,14);
		}
	}
}
else
{
	if ($_GET['gBid']!="")
	{
		$gBid  = $_GET['gBid'];
		$gKel  = $_GET['gKel'];
		$gJNS  = $_GET['gJNS'];
		$gOBJ  = $_GET['gOBJ'];
		$gSUB  = $_GET['gSUB'];
	}
	else
	{
		$gCod  = $_GET['KdAst5'];
		$gBid  = substr($gCod,0,3);
		if (substr($gCod,0,6)=='1.1.12')
		{
			$gKel  = substr($gCod,0,6);
			$gJNS  = substr($gCod,0,9);
			$gOBJ  = substr($gCod,0,12);
			$gSUB  = substr($gCod,0,15);
		}
		else
		{
			$gKel  = substr($gCod,0,5);
			$gJNS  = substr($gCod,0,8);
			$gOBJ  = substr($gCod,0,11);
			$gSUB  = substr($gCod,0,14);
		}
	}
	$gCod  = $gSUB.".xxx";
	$Sbmt  = "onchange='this.form.submit()'";
}
?>
<body>
<form name="myfrm" method="post" action="<?php echo "Form_Kode_Aset108_6_Mid_.php?IdL=".$IdL."&rIDT=".$rIDT ?>">
  <input type="hidden" name="Simpan">
  <input type="hidden" name="fDL">
  <table border="0" width="663" cellspacing="1" style="font-family: Calibri; font-size: 10pt; border-collapse: collapse">
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td width="492">&nbsp;</td>
    </tr>
    <tr> 
      <td width="16">&nbsp;</td>
      <td width="121">KELOMPOK</td>
      <td width="21">:</td>
      <td><select class="boxs" name="fBid" tabindex="0" style="width: 480px" <?php echo $Sbmt?>>
          <?php
		$nSQ = "SELECT Kd_Aset, Nm_Aset FROM ref_rek_aset108_2 ORDER BY Kd_Aset";
		$nRs = mysql_query($nSQ) or die(mysql_error());
		$mRo = mysql_fetch_assoc($nRs);
		$tRo = mysql_num_rows($nRs);
		if ($tRo > 0)
		{
            if ($gBid!="All")
            {
			if ($gBid=="") {$gBid=$mRo['Kd_Aset'];}
            }
			do
			{
				$sel ="";
				if ($mRo['Kd_Aset']==$gBid) 
				{
				$sel ="selected";
				$zBid=$mRo['Kd_Aset'];
				}
				echo '<option '.$sel.' value="'.$mRo['Kd_Aset'].'">'.$mRo['Kd_Aset']." : ".$mRo['Nm_Aset'].'</option>';
			}
			while ($mRo = mysql_fetch_assoc($nRs));	
		}
	  ?>
        </select></td>
    </tr>
    <tr> 
      <td width="16">&nbsp;</td>
      <td width="121">JENIS</td>
      <td width="21">:</td>
      <td><select name="fKel" class="boxs" id="fKel" style="width: 480px" tabindex="0" <?php echo $Sbmt?>>
          <?php
		$nSQ = "SELECT Kd_Aset, Nm_Aset FROM ref_rek_aset108_3 WHERE Kd_Aset LIKE '".$zBid."._' ORDER BY Kd_Aset";
		if ($zBid=='1.1')
		{
			$nSQ = "SELECT Kd_Aset, Nm_Aset FROM ref_rek_aset108_3 WHERE Kd_Aset LIKE '".$zBid.".__' ORDER BY Kd_Aset";
		}
		$nRs = mysql_query($nSQ) or die(mysql_error());
		$mRo = mysql_fetch_assoc($nRs);
		$tRo = mysql_num_rows($nRs);
		if ($tRo > 0)
		{
			if ($zBid=='1.1')
			{
				if (substr($gKel,0,4)!=$zBid) {$gKel=$mRo['Kd_Aset'];}
			}
			else
			{
				if (substr($gKel,0,3)!=$zBid) {$gKel=$mRo['Kd_Aset'];}
			}
			if ($gKel=="") {$gKel=$mRo['Kd_Aset'];}
			do
			{
				$sel ="";
				if ($mRo['Kd_Aset']==$gKel) 
				{
				$sel ="selected";
				$zKel=$mRo['Kd_Aset'];
				}
				echo '<option '.$sel.' value="'.$mRo['Kd_Aset'].'">'.$mRo['Kd_Aset']." : ".$mRo['Nm_Aset'].'</option>';
			}
			while ($mRo = mysql_fetch_assoc($nRs));	
		}
	  ?>
        </select></td>
    </tr>
    <tr> 
      <td width="16">&nbsp;</td>
      <td width="121">OBJEK</td>
      <td width="21">:</td>
      <td><select name="fJNS" class="boxs" id="fJNS" style="width: 480px" tabindex="0" <?php echo $Sbmt?>>
          <?php
		$nSQ = "SELECT Kd_Aset, Nm_Aset FROM ref_rek_aset108_4 WHERE Kd_Aset LIKE '".$zBid.".".substr($zKel,-1).".__' ORDER BY Kd_Aset";
		if ($zKel=='1.1.12')
		{
			$nSQ = "SELECT Kd_Aset, Nm_Aset FROM ref_rek_aset108_4 WHERE Kd_Aset LIKE '".$zBid.".".substr($zKel,-2,2).".__' ORDER BY Kd_Aset";
		}
		$nRs = mysql_query($nSQ) or die(mysql_error());
		$mRo = mysql_fetch_assoc($nRs);
		$tRo = mysql_num_rows($nRs);
		if ($tRo > 0)
		{
			if ($gJNS=="") {$gJNS=$mRo['Kd_Aset'];}
			if ($zKel=='1.1.12')
			{
				if (substr($gJNS,0,6)!=$zKel) {$gJNS=$mRo['Kd_Aset'];}
			}
			else
			{
				if (substr($gJNS,0,5)!=$zKel) {$gJNS=$mRo['Kd_Aset'];}
			}
			do
			{
				$sel ="";
				if ($mRo['Kd_Aset']==$gJNS) 
				{
				$sel ="selected";
				$zJNS=$mRo['Kd_Aset'];
				}
				echo '<option '.$sel.' value="'.$mRo['Kd_Aset'].'">'.$mRo['Kd_Aset']." : ".$mRo['Nm_Aset'].'</option>';
			}
			while ($mRo = mysql_fetch_assoc($nRs));	
		}
	  ?>
        </select></td>
    </tr>
    <tr> 
      <td width="16">&nbsp;</td>
      <td width="121">RINCIN OBJEK </td>
      <td width="21">:</td>
      <td><select class="boxs" name="fOBJ" tabindex="0" style="width: 480px" <?php echo $Sbmt?>>
          <?php
		$nSQ = "SELECT Kd_Aset, Nm_Aset FROM ref_rek_aset108_5 WHERE Kd_Aset LIKE '".$gBid.".".substr($zKel,-1).".".substr($zJNS,-2).".__' ORDER BY Kd_Aset";
		if ($zKel=='1.1.12')
		{
			$nSQ = "SELECT Kd_Aset, Nm_Aset FROM ref_rek_aset108_5 WHERE Kd_Aset LIKE '".$gBid.".".substr($zKel,-2).".".substr($zJNS,-2).".__' ORDER BY Kd_Aset";
		}
		$nRs = mysql_query($nSQ) or die(mysql_error());
		$mRo = mysql_fetch_assoc($nRs);
		$tRo = mysql_num_rows($nRs);
		if ($tRo > 0)
		{
			if ($gOBJ=="") {$gOBJ=$mRo['Kd_Aset'];}
			if ($zKel=='1.1.12')
			{
				if (substr($gOBJ,0,9)!=$zJNS) {$gOBJ=$mRo['Kd_Aset'];}
			}
			else
			{
				if (substr($gOBJ,0,8)!=$zJNS) {$gOBJ=$mRo['Kd_Aset'];}
			}
			do
			{
				$sel ="";
				if ($mRo['Kd_Aset']==$gOBJ) 
				{
				$sel ="selected";
				$zOBJ=$mRo['Kd_Aset'];
				}
				echo '<option '.$sel.' value="'.$mRo['Kd_Aset'].'">'.$mRo['Kd_Aset']." : ".$mRo['Nm_Aset'].'</option>';
			}
			while ($mRo = mysql_fetch_assoc($nRs));	
		}
	  ?>
        </select></td>
    </tr>
    <tr> 
      <td width="16">&nbsp;</td>
      <td width="121">SUB RINCIN OBJ</td>
      <td width="21">:</td>
      <td><select class="boxs" name="fSUB" tabindex="0" style="width: 480px" <?php echo $Sbmt?>>
          <?php
		$nSQ = "SELECT Kd_Aset, Nm_Aset FROM ref_rek_aset108_6 WHERE Kd_Aset LIKE '".$gBid.".".substr($zKel,-1).".".substr($zJNS,-2).".".substr($zOBJ,-2).".__' ORDER BY Kd_Aset";
		if ($zKel=='1.1.12')
		{
			$nSQ = "SELECT Kd_Aset, Nm_Aset FROM ref_rek_aset108_6 WHERE Kd_Aset LIKE '".$gBid.".".substr($zKel,-2).".".substr($zJNS,-2).".".substr($zOBJ,-2).".__' ORDER BY Kd_Aset";
		}
		$nRs = mysql_query($nSQ) or die(mysql_error());
		$mRo = mysql_fetch_assoc($nRs);
		$tRo = mysql_num_rows($nRs);
		if ($tRo > 0)
		{
			if ($gSUB=="") {$gSUB=$mRo['Kd_Aset'];}
			if ($zKel=='1.1.12')
			{
				if (substr($gSUB,0,12)!=$zOBJ) {$gSUB=$mRo['Kd_Aset'];}
			}
			else
			{
				if (substr($gSUB,0,11)!=$zOBJ) {$gSUB=$mRo['Kd_Aset'];}
			}	
			do
			{
				$sel ="";
				if ($mRo['Kd_Aset']==$gSUB) 
				{
				$sel ="selected";
				$zSUB=$mRo['Kd_Aset'];
				}
				echo '<option '.$sel.' value="'.$mRo['Kd_Aset'].'">'.$mRo['Kd_Aset']." : ".$mRo['Nm_Aset'].'</option>';
			}
			while ($mRo = mysql_fetch_assoc($nRs));	
		}
	  ?>
        </select></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr> 
      <td width="16">&nbsp;</td>
      <td width="121">KODE SUBSUBR</td>
      <td width="21">:</td>
      <td><input name="fKode" type="text" class="text" id="fKode" style="width:120px; font-family: Calibri; font-size: 11pt; border: 1px solid #C0C0C0; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px; background-color: #E1F986" value="<?php echo $gCod?>"/></td>
    </tr>
    <tr> 
      <td width="16">&nbsp;</td>
      <td width="121">NAMA SUBSUBR</td>
      <td width="21">:</td>
      <td><input name="fNama" type="text" class="text" id="fNama" style="width:470px; font-family: Calibri; font-size: 11pt; border: 1px solid #C0C0C0; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px; background-color: #E1F986" value="<?php echo $gNma?>" /></td>
    </tr>
    
    <tr> 
      <td width="16">&nbsp;</td>
      <td width="121">MASA MANFAAT</td>
      <td width="21">:</td>
      <td><input name="fMasa" type="text" class="text" id="fMasa" style=" text-align:center; width:40px; font-family: Calibri; font-size: 11pt; border: 1px solid #C0C0C0; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px; background-color: #E1F986" value="<?php echo $gMas?>"/>&nbsp;&nbsp;Tahun</td>
    </tr>
    <!--tr>
      <td>&nbsp;</td>
      <td colspan="3">&nbsp;</td>
    </tr-->
    <tr>
      <td>&nbsp;</td>
      <td>PERTAMBAHAN NILAI</td>
      <td>:</td>
      <td style="font-weight:bold">RENOVASI / RESTORASI / OVERHAUL</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>
	  <table border="0" width="350" cellspacing="1" style="background:#FFFFFF; border: 1px solid #999999; font-family: Calibri; font-size: 10pt; border-collapse: collapse">
		<?php
		$nSQ = "SELECT IDT, tA,tB,tUmur FROM ta_masa_manfaat_108 WHERE Kode = '".$gCod."' ORDER BY IDT";
		#echo $nSQ;
		$nRs = mysql_query($nSQ) or die(mysql_error());
		$mRo = mysql_fetch_assoc($nRs);
		$tRo = mysql_num_rows($nRs);
		if ($tRo > 0)
		{
			do
			{
			$gID = $mRo['IDT'];
			?>
			<tr> 
			  <td style="font-weight:bold; text-align:center">></td>
			  <td><input name="fA<?=$gID?>" type="text" style="text-align:center; font-family: Calibri; font-size: 9pt; background: #99CC00; width:30px; height:15px; border:0px" value="<?=$mRo['tA']?>" /></td>
			  <td>%</td>
			  <td><=</td>
			  <td><input name="fB<?=$gID?>" type="text" style="text-align:center; font-family: Calibri; font-size: 9pt; background: #99CC00; width:30px; height:15px; border:0px" value="<?=$mRo['tB']?>" /></td>
			  <td>%</td>
			  <td><input name="fU<?=$gID?>" type="text" style="text-align:center; font-family: Calibri; font-size: 9pt; background: #99CC00; width:30px; height:15px; border:0px" value="<?=$mRo['tUmur']?>" /></td>
			  <td>Tahun</td>
			  <td><a href="#" class="ico delt" onclick="P_Dell('<?=$gID?>'); return false">&nbsp;delete</a></td>
			</tr>
			<?php
			}
			while ($mRo = mysql_fetch_assoc($nRs));	
		}
		?>
		<tr>
		  <td width="15" style="border-top:dotted 1px #999999">&nbsp;</td>
		  <td width="30" style="border-top:dotted 1px #999999">&nbsp;</td>
		  <td width="30" style="border-top:dotted 1px #999999">&nbsp;</td>
		  <td width="20" style="border-top:dotted 1px #999999">&nbsp;</td>
		  <td width="30" style="border-top:dotted 1px #999999">&nbsp;</td>
		  <td width="30" style="border-top:dotted 1px #999999">&nbsp;</td>
		  <td width="40" style="border-top:dotted 1px #999999">&nbsp;</td>
		  <td style="border-top:dotted 1px #999999">&nbsp;</td>
		  <td width="64" style="border-top:dotted 1px #999999"><a href="#" class="ico itet" onclick="P_Add('<?=$rIDT?>'); return false">&nbsp;&nbsp;Add Item</a></td>
		</tr>
	  </table>	  </td>
    </tr>
    <tr> 
      <td width="16">&nbsp;</td>
      <td width="121">&nbsp;</td>
      <td width="21">&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr> 
      <td width="16">&nbsp;</td>
      <td width="121">&nbsp;</td>
      <td width="21">&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr> 
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td><input type="button" name="B39" value="SIMPAN" onclick="P_Save('<?=$ReO?>')" style="width: 60px; height: 21px; padding-left: 0px; padding-right: 0px; padding-top: 0px; padding-bottom: 0px" /> 
        <input type="button" name="B392" value="RESET" onclick="P_Reset('<?=$ReO?>')" style="width: 60px; height: 21px; padding-left: 0px; padding-right: 0px; padding-top: 0px; padding-bottom: 0px" /> 
        <input type="button" name="B393" value="TUTUP" onclick="P_Tutup()" style="width: 60px; height: 21px; padding-left: 0px; padding-right: 0px; padding-top: 0px; padding-bottom: 0px" /></td>
    </tr>
    <tr> 
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
  </table>	
</form>
</body>
</html>
<script language="javascript">
	var objfrm=document.myfrm;
	function P_Add(xR)
	{
		if (xR=='') {alert('Data belum disimpan..!!'); return false;}
		objfrm.Simpan.value = "Add";
		objfrm.submit();
	}

	function P_Dell(xR)
	{
		var AN = confirm("Delete record..?!!");
		if (AN)
		{
			objfrm.fDL.value = xR;
			objfrm.Simpan.value = "DelItem";
			objfrm.submit();
		}
	}
	
	function P_Save(xR)
	{
		if (xR=="Y") {window.alert('<?=TxReadOnly?>'); return false;}
		objfrm.Simpan.value = "Save";
		objfrm.submit();
	}

	function P_Reset(xR)
	{
		if (xR=="Y") {window.alert('<?=TxReadOnly?>'); return false;}
		objfrm.Simpan.value = "Reset";
		objfrm.submit();
	}
	
	function P_Tutup()
	{
		objfrm.Simpan.value = "Close";
		objfrm.target="_top";
		objfrm.submit();
	}
</script>

<?php require('Connection_Close.php');?>
