<?php require "CheckSession.php"?>
<?php require "Connection.php";?>
<?php require "FileFunction.php";?>
<?php require "CheckLogin.php"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
<title><?php require_once 'AppTitle.php'; echo APP_TITLE; ?></title>
<link rel="stylesheet" href="css/style_popup.css" type="text/css" media="all" />
<script type="text/javascript" src="js/jquery-1.8.2.min.js"></script>
</head>
<?php
extract($_GET);

$rIDT = $_GET['rIDT'];
$gReaD= "readonly";
$gDisB= "hidden";
if ($rIDT!="")
{
	$nSQ = "SELECT * FROM ref_upb WHERE IDT='".$rIDT."'";
	$nRs = mysql_query($nSQ) or die(mysql_error());
	$mRo = mysql_fetch_assoc($nRs);
	$tRo = mysql_num_rows($nRs);
	if ($tRo > 0)
	{
	$gKd  = $mRo['Kd_UPB'];
	$gBdg = substr($gKd,0,8);
	$gUnt = substr($gKd,0,11);
	$gSub = substr($gKd,0,14);
	$gUpb = substr($gKd,0,18);
	$gNMU = $mRo['Nm_UPB'];
	}
}
else
{
	$Sbmt  = "onchange='this.form.submit()'";
	$gBdg  = $_GET['gBdg'];
	$gUnt  = $_GET['gUnt'];
	$gSub  = $_GET['gSub'];
	$gUpb  = $_GET['gUpb'];
}
?>
<body onload="P_Load()">
<form name="myfrm" method="post" action="<?php echo "Form_UPB_Mid_.php?IdL=".$_GET['IdL']."&rIDT=".$rIDT ?>">
  <input type="hidden" name="Simpan">
  <input type="hidden" name="CritIDT" size="10">
  <table border="0" width="1100" cellpadding="0" style="border-collapse: collapse">
    <tr> 
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr> 
      <td width="15">&nbsp;</td>
      <td width="102">BIDANG</td>
      <td width="37">:</td>
      <td> <select class="boxs" name="fBdg" tabindex="0" style="width: 470px" <?php echo $Sbmt ?>>
          <?php
		if ($Lev > 1)
		{$nSQ = "SELECT * FROM ref_bidang WHERE Kd_Bidang = '".substr($SkP,0,8)."' ORDER BY Kd_Bidang";}
		else
		{$nSQ = sprintf("SELECT Kd_Bidang, Nm_Bidang FROM ref_bidang ORDER BY Kd_Bidang");}
		$nRs = mysql_query($nSQ) or die(mysql_error());
		$mRo = mysql_fetch_assoc($nRs);
		$tRo = mysql_num_rows($nRs);
		if ($tRo > 0)
		{
			if ($gBdg=="") {$gBdg=$mRo['Kd_Bidang'];}
			do
			{
				$sel ="";
				if ($mRo['Kd_Bidang']==$gBdg) 
				{
				$sel ="selected";
				$zBdg=$mRo['Kd_Bidang'];
				}
				echo '<option '.$sel.' value="'.$mRo['Kd_Bidang'].'">'.$mRo['Kd_Bidang']." : ".$mRo['Nm_Bidang'].'</option>';
			}
			while ($mRo = mysql_fetch_assoc($nRs));	
		}
	  ?>
        </select></td>
    </tr>
    <tr> 
      <td width="15">&nbsp;</td>
      <td width="102">UNIT</td>
      <td width="37">:</td>
      <td>
	  <select class="boxs" name="fUnt" tabindex="0" style="width: 470px" <?php echo $Sbmt ?>>
	  <option value=""></option>
          <?php
		if ($Lev > 1)
		{$nSQ = "SELECT * FROM ref_unit where Kd_Unit like '".substr($SkP,0,11)."' ORDER BY Kd_Unit";}
		else
		{$nSQ = "SELECT Kd_Unit, Nm_Unit FROM ref_unit WHERE Kd_Unit LIKE '".$zBdg.".__' ORDER BY Kd_Unit";}
		$nRs = mysql_query($nSQ) or die(mysql_error());
		$mRo = mysql_fetch_assoc($nRs);
		$tRo = mysql_num_rows($nRs);
		if ($tRo > 0)
		{
			if ($gUnt=="") {$gUnt=$mRo['Kd_Unit'];}
			if (substr($gUnt,0,8)!=$gBdg) {$gUnt=$mRo['Kd_Unit'];}
			do
			{
				$sel ="";
				if ($mRo['Kd_Unit']==$gUnt) 
				{
				$sel ="selected";
				$zUnt=$mRo['Kd_Unit'];
				}
				echo '<option '.$sel.' value="'.$mRo['Kd_Unit'].'">'.$mRo['Kd_Unit']." : ".$mRo['Nm_Unit'].'</option>';
			}
			while ($mRo = mysql_fetch_assoc($nRs));	
		}
	  ?>
        </select></td>
    </tr>
    <tr> 
      <td width="15">&nbsp;</td>
      <td width="102">SUB UNIT</td>
      <td width="37">:</td>
      <td><select class="boxs" name="fSub" tabindex="0" style="width: 470px" <?php echo $Sbmt ?>>
          <?php
		$nSQ = "SELECT Kd_Sub, Nm_Sub FROM ref_sub_unit WHERE Kd_Sub LIKE '".$zBdg.".".substr($zUnt,-2).".__' ORDER BY Kd_Sub";
		$nRs = mysql_query($nSQ) or die(mysql_error());
		$mRo = mysql_fetch_assoc($nRs);
		$tRo = mysql_num_rows($nRs);
		if ($tRo > 0)
		{
			if ($gSub=="") {$gSub=$mRo['Kd_Sub'];}
			if (substr($gSub,0,11)!=$gUnt) {$gSub=$mRo['Kd_Sub'];}
			do
			{
				$sel ="";
				if ($mRo['Kd_Sub']==$gSub) 
				{
				$sel ="selected";
				$zSub= $mRo['Kd_Sub'];
				if ($rIDT=="") {$gUpb= $zSub.".XXX";}
				}
				echo '<option '.$sel.' value="'.$mRo['Kd_Sub'].'">'.$mRo['Kd_Sub']." : ".$mRo['Nm_Sub'].'</option>';
			}
			while ($mRo = mysql_fetch_assoc($nRs));	
		}
	  ?>
        </select> </td>
    </tr>
    <tr> 
      <td width="15">&nbsp;</td>
      <td width="102">KODE UPB</td>
      <td width="37">:</td>
      <td><input name="fKdUpb" readonly type="text" class="text" style="width:110px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" value="<?=$gUpb?>" maxlength="18" /></td>
    </tr>
    <tr> 
      <td width="15">&nbsp;</td>
      <td width="102">NAMA UPB</td>
      <td width="37">:</td>
      <td> <input name="fNmUpb" type="text" class="text" id="fNmUpb" style="widht:100%; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" value="<?php echo $gNMU?>" size="55" maxlength="100" /> 
      </td>
    </tr>
    <tr> 
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr> 
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td><input type="button" name="B39" value="SIMPAN" onclick="P_Save('<?=$ReO?>')" style="width: 60px; height: 21px; padding-left: 0px; padding-right: 0px; padding-top: 0px; padding-bottom: 0px" /> 
        <input type="button" name="B392" value="RESET" onclick="P_Reset('<?=$ReO?>')" style="width: 60px; height: 21px; padding-left: 0px; padding-right: 0px; padding-top: 0px; padding-bottom: 0px" />
        <input type="button" name="B3922" value="REFRESH" <?php if ($rIDT==""){echo "disabled";}?> onclick="P_Refresh()" style="width: 60px; height: 21px; padding-left: 0px; padding-right: 0px; padding-top: 0px; padding-bottom: 0px" /> 
        <input type="button" name="B393" value="TUTUP" onclick="P_Tutup()" style="width: 60px; height: 21px; padding-left: 0px; padding-right: 0px; padding-top: 0px; padding-bottom: 0px" /></td>
    </tr>
    <tr> 
      <td width="15">&nbsp;</td>
      <td colspan="3">&nbsp; </td>
    </tr>
    <tr> 
      <td>&nbsp;</td>
      <td colspan="3"> <div class="table"> 
          <table width="100%" border="0" cellspacing="0" cellpadding="0" style="font-size: 8pt; font-family: Arial Narrow">
            <tr> 
              <th width="22" align="center" style="color:#FFFFFF">No</th>
              <th width="52" align="center" style="color:#FFFFFF">Tahun</th>
              <th width="159" align="left" style="color:#FFFFFF">Pimpinan</th>
              <th width="137" align="left" style="color:#FFFFFF">NIP</th>
              <th width="230" align="left" style="color:#FFFFFF">Jabatan</th>
              <th width="121" align="left" style="color:#FFFFFF">No. HP </th>
              <th width="108" align="left" style="color:#FFFFFF">Pin BBM </th>
              <th width="134" align="left" style="color:#FFFFFF">Emai Address </th>
              <th width="114" class="ac" style="color:#FFFFFF">Action</th>
            </tr>
            <?php
		$iG=1;
		$nSQL= "SELECT * FROM ta_upb where Kd_UPB='".$gUpb."' ORDER BY Tahun";
		$nRs = mysql_query($nSQL) or die(mysql_error());
		$mRo = mysql_fetch_assoc($nRs);
		$tRo = mysql_num_rows($nRs);
		if ($tRo > 0)
		{
		do
			{
			?>
            <tr style="cursor: pointer" title="clik disini untuk melihat rincian...!" onmouseover="this.style.cursor=&#39;pointer&#39"> 
              <td> 
                <?php echo $iG?>
                .</td>
              <td onclick="$(&#39;#detail<?php echo $iG?>&#39;).toggle(&#39;past&#39;)"> 
                <?php echo $mRo['Tahun']?>              </td>
              <td onclick="$(&#39;#detail<?php echo $iG?>&#39;).toggle(&#39;past&#39;)"> 
                <?php echo $mRo['Nm_Pimpinan']?>              </td>
              <td onclick="$(&#39;#detail<?php echo $iG?>&#39;).toggle(&#39;past&#39;)"> 
                <?php echo $mRo['Nip_Pimpinan']?>              </td>
              <td onclick="$(&#39;#detail<?php echo $iG?>&#39;).toggle(&#39;past&#39;)"> 
                <?php
				if  ((int) strlen($mRo['Jbt_Pimpinan']) > 35)
				{echo substr($mRo['Jbt_Pimpinan'],0,35)." .....";}
				else
				{echo $mRo['Jbt_Pimpinan'];}
				?>
				</td>
              <td onclick="$(&#39;#detail<?php echo $iG?>&#39;).toggle(&#39;past&#39;)"><?=$mRo['Hp_Pimpinan']?></td>
              <td onclick="$(&#39;#detail<?php echo $iG?>&#39;).toggle(&#39;past&#39;)"><?=$mRo['Pin_Pimpinan']?></td>
              <td onclick="$(&#39;#detail<?php echo $iG?>&#39;).toggle(&#39;past&#39;)"><?=$mRo['Ema_Pimpinan']?></td>
              <td align="center">
			  <a href="#" class="ico edit" onclick="EditData('900','530','<?=$mRo['IDT']?>','<?=$_GET['IdL']?>')">EDIT</a>&nbsp;&nbsp;&nbsp;&nbsp;
			  <a href="#" class="ico del" onclick="P_DeleteR('<?=$mRo['IDT']?>','<?=$ReO?>')">DELETE</a>
			  </td>
            </tr>
            <tr> 
              <td colspan="9">
			  <table cellpadding="3" id="detail<?php echo $iG?>" border="0" width="100%" style="border:1px solid #C0C0C0; font-family: Calibri; font-size: 9pt; font-style: Italic; color: #800000; display: none; border-collapse:collapse">
                  <tr> 
                    <td width="26">&nbsp;</td>
                    <td width="65">Pengurus</td>
                    <td width="10">:</td>
                    <td width="194"> <?=$mRo['Nm_Pengurus']?>                    </td>
                    <td width="4">&nbsp;</td>
                    <td width="79">Penyimpan</td>
                    <td width="9">:</td>
                    <td width="170"> <?=$mRo['Nm_Penyimpan']?>                    </td>
                  </tr>
                  <tr> 
                    <td>&nbsp;</td>
                    <td>Nip</td>
                    <td>:</td>
                    <td> <?=$mRo['Nip_Pengurus']?></td>
                    <td>&nbsp;</td>
                    <td>NIP</td>
                    <td>:</td>
                    <td> <?=$mRo['Nip_Penyimpan']?></td>
                  </tr>
                  <tr> 
                    <td>&nbsp;</td>
                    <td>Jabatan</td>
                    <td>:</td>
                    <td> <?=$mRo['Jbt_Pengurus']?></td>
                    <td>&nbsp;</td>
                    <td>Jabatan</td>
                    <td>:</td>
                    <td> <?=$mRo['Jbt_Penyimpan']?></td>
                  </tr>
                </table></td>
            </tr>
            <?php
			  $iG++;
			}
			while ($mRo = mysql_fetch_assoc($nRs));	
		}
		else
		{
		?>
            <tr> 
              <td></td>
              <td colspan="7">Data tidak ditemukan..!!</td>
              <td>&nbsp;</td>
            </tr>
            <?php
		}
		?>
            <tr> 
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td align="center"><a href="#" class="ico edit" onclick="AddData('<?=$rIDT?>','900','530','center'); return false;">TAMBAH BARU</a></td>
            </tr>
          </table>
          <!-- Pagging -->
        </div></td>
    </tr>
    <tr> 
      <td width="15">&nbsp;</td>
      <td colspan="3"> </td>
    </tr>
  </table>	
</form>
</body>
</html>
<script language="javascript">
	var objfrm=document.myfrm;
	function P_Save(xR)
	{
		if (xR=="Y") {window.alert('<?=TxReadOnly?>'); return false;}
		objfrm.Simpan.value = "Save";
		objfrm.submit();
	}

	function P_Refresh()
	{
		objfrm.Simpan.value = "Refresh";
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
	
	function P_DeleteR(xA,xR)
	{
		if (xR=="Y") {window.alert('<?=TxReadOnly?>'); return false;}
		if (xB!="")
			{window.alert("Access denied...!");}
		else
		{
			var AN = confirm("Hapus data aset..?!!");
			if (AN)
			{
			objfrm.CritIDT.value = xA;
			objfrm.Simpan.value = "DeleteRecord";
			objfrm.submit();
			}
		}
	}

	function AddData(idt,w,h,pos)
	{
		if (idt==""){alert('error'); return false;}
		var win=null;
		var txtHTML = "";
		var iErrors=0;
		LeftPosition=(screen.width)?(screen.width-w)/2:100; 
		TopPosition=(screen.height)?(screen.height-h)/2:100;
		settings='width='+w+',height='+h+',top='+TopPosition+',left='+LeftPosition+',location=no,directories=no,status=no,menubar=no,toolbar=no,resizable=yes';
			win=window.open('','',settings);
			if (win!=null)
				{
					win.window.document.open()       			
					<?php
						$URL_Top = "Form_UPB_Edit_Top.php?FrmG=".$_GET['FrmG']."&IdL=".$_GET['IdL'];
						$URL_Mid = "Form_UPB_Edit_Mid.php?gUpb=".$gUpb."&IdL=".$_GET['IdL'];
						$URL_Bot = "Form_UPB_Edit_Bot.php";
					?>       			
				txtHTML="<html><head><title><?php require_once 'AppTitle.php'; echo APP_TITLE; ?></title></head><frameset framespacing='0' border='0' rows='45,*,30' frameborder='0'><frame name='WinFormKIB_Top' noresize src='<?php echo $URL_Top?>' scrolling='no'><frame name='WinFormKIB_Mid' src='<?php echo $URL_Mid?>' scrolling='auto'><frame name='WinFormKIB_Bot' src= '<?php echo $URL_Bot?>' scrolling='no'><noframes><body><p>=>.............??!</p></body></noframes></frameset></html>"            
				win.focus()
				win.window.document.clear()
				win.window.document.write(txtHTML)
				win.window.document.close() 
				win.setTimeout("self.close()",200000000)
			}
	}
	
	function EditData(w,h,idt,IdL)
	{	var win=null;
		var txtHTML = "";
		var iErrors=0;
		LeftPosition=(screen.width)?(screen.width-w)/2:100; 
		TopPosition=(screen.height)?(screen.height-h)/2:100;
		settings='width='+w+',height='+h+',top='+TopPosition+',left='+LeftPosition+',location=no,directories=no,status=no,menubar=no,toolbar=no,resizable=yes';
		win=window.open('','',settings);
		if (win!=null)
		{
			win.window.document.open()       			
			URL_Top = 'Form_UPB_Edit_Top.php?IdL='+IdL;
			URL_Mid = 'Form_UPB_Edit_Mid.php?rIDT='+idt+'&IdL='+IdL;
			URL_Bot = 'Form_UPB_Edit_Bot.php';
			txtHTML="<html><head><title><?php require_once 'AppTitle.php'; echo APP_TITLE; ?></title></head><frameset framespacing='0' border='0' rows='45,*,30' frameborder='0'><frame name='WinFormKIB_Top' noresize src='"+URL_Top+"' scrolling='no'><frame name='WinFormKIB_Mid' src='"+URL_Mid+"' scrolling='auto'><frame name='WinFormKIB_Bot' src= '"+URL_Bot+"' scrolling='no'><noframes><body><p>=>.............??!</p></body></noframes></frameset></html>"            
			win.focus()
			win.window.document.clear()
			win.window.document.write(txtHTML)
			win.window.document.close() 
			win.setTimeout("self.close()",200000000)
		}
	}
	
	function P_Load()
	{
		
		objfrm.fNmUpb.focus();
	}
</script>
            
<?php require('Connection_Close.php');?>
