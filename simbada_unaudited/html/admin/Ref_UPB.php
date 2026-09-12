<?php require "CheckSession.php"?>
<?php require "Connection.php"?>
<?php require "FileFunction.php"?>
<?php require "CheckLogin.php"?>
<?
extract($_GET);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
<title>Simbada Kab. Hulu Sungai Tengah</title>
<link rel="stylesheet" href="css/style.css" type="text/css" media="all" />
<script type="text/javascript" src="js/jquery-1.8.2.min.js"></script>
</head>
<?
if (isset($_GET['gBdG'])) {$gBdG = $_GET['gBdG'];} else {$gBdG  ="";}
if (isset($_GET['gUnT'])) {$gUnT = $_GET['gUnT'];} else {$gUnT  ="";}
if (isset($_GET['sUnT'])) {$sUnT = $_GET['sUnT'];} else {$sUnT  ="";}
?>
<body>
<?php require "FileMenu.php";?>
<form name="myfrm" method="post" action="<?php echo "Ref_UPB_.php?FrmG=".$FrmG."&IdL=".$IdL."&Page=".$Page."&iG=".$iG?>">
  <input type="hidden" name="Simpan">
  <input type="hidden" name="CritIDT" size="10">
  <table border="0" align="center" style="width:99%">
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      
      <tr> 
        <td width="74">UNIT KERJA</td>
        <td width="25">:</td>
        <td width="1197">
		<?
		if ($Lev > 1){
		?>
		<input name="fUnT" type="text" readonly="readonly" value="<?=substr($SkP,0,11)?>" style="width:80px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px"/>
		<input name="fUnM" type="text" readonly="readonly" value="<?=strtoupper(fGlobal("Nm_Unit","ref_unit","Kd_Unit",substr($SkP,0,11),"=","",""))?>" style=" width:400px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px"/>
		<?
		}
		else {
		?>
		<select class="boxs" name="fUnT" tabindex="0" style="width: 470px" onchange="this.form.submit()">
        <?
		$nSQ = "SELECT Kd_Unit, Nm_Unit FROM ref_unit ORDER BY Kd_Unit";
		$nRs = mysql_query($nSQ) or die(mysql_error());
		$mRo = mysql_fetch_assoc($nRs);
		$tRo = mysql_num_rows($nRs);
		if ($tRo > 0)
		{
			if ($gUnT=="") {$gUnT=$mRo['Kd_Unit'];}
			do
			{
				$sel ="";
				if ($mRo['Kd_Unit']==$gUnT) 
				{
				$sel ="selected";
				$zUnT=$mRo['Kd_Unit'];
				$zBdG=substr($mRo['Kd_Unit'],0,8);
				}
				echo '<option '.$sel.' value="'.$mRo['Kd_Unit'].'">'.$mRo['Kd_Unit']." : ".strtoupper($mRo['Nm_Unit']).'</option>';
			}
			while ($mRo = mysql_fetch_assoc($nRs));	
		}
	  ?>
        </select>
		<? } ?>		</td>
      </tr>      
      <tr> 
        <td width="74">SUB UNIT</td>
        <td width="25">:</td>
        <td width="1197">
		<?
		if ($Lev > 1){
		?>
		<input name="fUnTs" id="fUnTs" type="text" readonly="readonly" value="<?=substr($SkP,0,14)?>" style="width:80px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px"/>
		<input name="fUnMs" type="text" readonly="readonly" value="<?=strtoupper(fGlobal("Nm_Sub","ref_sub_unit","Kd_Sub",substr($SkP,0,14),"=","",""))?>" style=" width:400px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px"/>
		<?
		}
		else {
		?>
		<select class="boxs" name="fUnTs" id="fUnTs" tabindex="0" style="width: 470px" onchange="this.form.submit()">
        <?
		$nSQ = "SELECT Kd_Sub, Nm_Sub FROM ref_sub_unit WHERE Kd_Sub LIKE '$zUnT%' ORDER BY Kd_Sub";
		$nRs = mysql_query($nSQ) or die(mysql_error());
		$mRo = mysql_fetch_assoc($nRs);
		$tRo = mysql_num_rows($nRs);
		if ($tRo > 0)
		{
			if ($gUnTs=="") {$gUnTs=$mRo['Kd_Sub'];}
			if (substr($gUnTs,0,11)!=$gUnT) {$gUnTs=$mRo['Kd_Sub'];}
			do
			{
				$sel ="";
				if ($mRo['Kd_Sub']==$gUnTs) 
				{
				$sel ="selected";
				$zUnTs=$mRo['Kd_Sub'];
				}
				echo '<option '.$sel.' value="'.$mRo['Kd_Sub'].'">'.$mRo['Kd_Sub']." : ".strtoupper($mRo['Nm_Sub']).'</option>';
			}
			while ($mRo = mysql_fetch_assoc($nRs));	
		}
	  ?>
        </select>
		<? } ?>		</td>
      </tr>      
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
	 </table>
  <table align="center" border="0" cellspacing="0" cellpadding="0" class="table-list" style="width:99%">
      <tr> 
        <th width="47" style=" text-align:center">No</th>
        <th width="139" align="center">Kode <?=$zSub?></th>
        <th align="left">UPB</th>
        <th width="80" class="ac">Kib-A</th>
        <th width="80" class="ac">Kib-B</th>
        <th width="80" class="ac">Kib-C</th>
        <th width="80" class="ac">Kib-D</th>
        <th width="80" class="ac">Kib-E</th>
        <th width="80" class="ac">Kib-F</th>
        <th width="59" align="left">&nbsp;</th>
        <th colspan="2" class="ac">Actions</th>
      </tr>
      <?
	  	#$eSK = substr($zUnTs,0,11);
		#$IdPost = fGlobal("IdPostgreSQL","ref_unit","Kd_Unit",$eSK,"=","","");
		#echo $IdPost;
		#$nSQ = "SELECT KDSUB, DESKRIPSI, ID FROM sheet11 WHERE IDSKPD = '".$IdPost."%' ORDER BY KDSUB";
		#echo $nSQL;
		#$nRs = mysql_query($nSQ);
		#while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
		#{
		#	$nUP = $eSK.".01.".substr('000'.$mRo[0],-3,3);
		#	$FiD = fGlobal("IDT","ref_upb","Kd_UPB",$nUP,"=","","");
		#	if ($FiD=='')
		#	{
		#		$SI="INSERT INTO ref_upb SET 
		#		Kd_UPB='".$nUP."',
		#		Nm_UPB='".$mRo[1]."',
		#		KdKelurahan='',
		#		IdPostgreSQL='".$mRo[2]."'";
		#		$ns = mysql_query($SI);
		#	}
		#}
		
		$DataPerPageF = 500;
		include "FilePagingTop.php";
		if ($Lev > 1)
		{$nSQL= "SELECT * FROM ref_upb WHERE Kd_UPB LIKE '".substr($SkP,0,11)."%' ORDER BY Kd_UPB LIMIT $Offset, $DataPerPage";}
		else
		{$nSQL= "SELECT * FROM ref_upb WHERE Kd_UPB LIKE '".$zUnTs."%' ORDER BY Kd_UPB LIMIT $Offset, $DataPerPage";}
		#echo $nSQL;
		$nRs = mysql_query($nSQL) or die(mysql_error());
		$mRo = mysql_fetch_assoc($nRs);
		$tRo = mysql_num_rows($nRs);
		if ($tRo > 0)
		{
		do
			{
			/*
			if (substr($mRo['Kd_UPB'],0,14)=='25.08.08.01.02' || 
			substr($mRo['Kd_UPB'],0,14)=='25.08.08.01.03' || 
			substr($mRo['Kd_UPB'],0,14)=='25.08.08.01.04' || 
			substr($mRo['Kd_UPB'],0,14)=='25.08.08.01.05' || 
			substr($mRo['Kd_UPB'],0,14)=='25.08.08.01.06' || 
			substr($mRo['Kd_UPB'],0,14)=='25.08.08.01.07' || 
			substr($mRo['Kd_UPB'],0,14)=='25.08.08.01.08' || 
			substr($mRo['Kd_UPB'],0,14)=='25.08.08.01.09' || 
			substr($mRo['Kd_UPB'],0,14)=='25.08.08.01.10' || 
			substr($mRo['Kd_UPB'],0,14)=='25.08.08.01.11' || 
			substr($mRo['Kd_UPB'],0,14)=='25.08.08.01.12') 
			{
				$CeK = fGlobal("idt","ta_user","user_id",$mRo['Nm_UPB'],"=","","");
				if ($CeK=='')
				{
					echo "Insert; &nbsp;";
					
					$AQ="INSERT INTO ta_user SET 
					user_id='".$mRo['Nm_UPB']."', 
					password='".base64_encode('12345678')."', 
					kode='".$mRo['Kd_UPB']."', 
					admin='1', 
					active='Y', 
					user_sekolah='Y'";
					mysql_query($AQ);
				}
			}
			*/
			$tKibA = fGlobal("COUNT(*)","Ta_Kib_108","Kd_UPB:Referensi",$mRo['Kd_UPB'].":TNH%","=:LIKE","","");
			$tKibB = fGlobal("COUNT(*)","Ta_Kib_108","Kd_UPB:Referensi",$mRo['Kd_UPB'].":ALT%","=:LIKE","","");
			$tKibC = fGlobal("COUNT(*)","Ta_Kib_108","Kd_UPB:Referensi",$mRo['Kd_UPB'].":BNG%","=:LIKE","","");
			$tKibD = fGlobal("COUNT(*)","Ta_Kib_108","Kd_UPB:Referensi",$mRo['Kd_UPB'].":JLN%","=:LIKE","","");
			$tKibE = fGlobal("COUNT(*)","Ta_Kib_108","Kd_UPB:Referensi",$mRo['Kd_UPB'].":ATL%","=:LIKE","","");
			$tKibF = fGlobal("COUNT(*)","Ta_Kib_108","Kd_UPB:Referensi",$mRo['Kd_UPB'].":KDP%","=:LIKE","","");
			
			$tKibT = $tKibA + $tKibB + $tKibC + $tKibD + $tKibE + $tKibF;
			if ($tKibT >0 )
				{$nDel="NoDel";}
			else 
				{$nDel="";}
			?>
      		<script language="javascript">
				function EditData<?=$mRo['IDT']?>(w,h,pos)
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
								<?
									$URL_Top = "Form_UPB_Top.php?FrmG=".$_GET['FrmG']."&IdL=".$_GET['IdL'];
									$URL_Mid = "Form_UPB_Mid.php?rIDT=".$mRo['IDT']."&FrmG=".$_GET['FrmG']."&IdL=".$_GET['IdL'];
									$URL_Bot = "Form_UPB_Bot.php";
								?>       			
							txtHTML="<html><head><title>Simbada Kab. Hulu Sungai Tengah</title></head><frameset framespacing='0' border='0' rows='45,*,30' frameborder='0'><frame name='WinFormKIB_Top' noresize src='<?=$URL_Top?>' scrolling='no'><frame name='WinFormKIB_Mid' src='<?=$URL_Mid?>' scrolling='auto'><frame name='WinFormKIB_Bot' src= '<?=$URL_Bot?>' scrolling='no'><noframes><body><p>=>.............??!</p></body></noframes></frameset></html>"            
							win.focus()
							win.window.document.clear()
							win.window.document.write(txtHTML)
							win.window.document.close() 
							win.setTimeout("self.close()",200000000)
						}
				}
			</script>
      <tr height="22" style="cursor: pointer" title="clik disini untuk melihat rincian...!" onmouseover="this.style.cursor=&#39;pointer&#39"> 
        <td <?=fBackCLR($iG)?> style="text-align:center"><?=$iG?>.</td>
        <td style="border-bottom:1px dotted #CCCCCC; vertical-align:top" onclick="$(&#39;#detail<?=$iG?>&#39;).toggle(&#39;past&#39;)" <?=fBackCLR($iG)?>><?=$mRo['Kd_UPB']?></td>
        <td style="border-bottom:1px dotted #CCCCCC; vertical-align:top" onclick="$(&#39;#detail<?=$iG?>&#39;).toggle(&#39;past&#39;)" <?=fBackCLR($iG)?>><?=$mRo['Nm_UPB']?></td>
        <td style="border-bottom:1px dotted #CCCCCC" onclick="$(&#39;#detail<?=$iG?>&#39;).toggle(&#39;past&#39;)" class="ac" <?=fBackCLR($iG)?>><?=$tKibA?></td>
        <td style="border-bottom:1px dotted #CCCCCC" onclick="$(&#39;#detail<?=$iG?>&#39;).toggle(&#39;past&#39;)" class="ac" <?=fBackCLR($iG)?>><?=$tKibB?></td>
        <td style="border-bottom:1px dotted #CCCCCC" onclick="$(&#39;#detail<?=$iG?>&#39;).toggle(&#39;past&#39;)" class="ac" <?=fBackCLR($iG)?>><?=$tKibC?></td>
        <td style="border-bottom:1px dotted #CCCCCC" onclick="$(&#39;#detail<?=$iG?>&#39;).toggle(&#39;past&#39;)" class="ac" <?=fBackCLR($iG)?>><?=$tKibD?></td>
        <td style="border-bottom:1px dotted #CCCCCC" onclick="$(&#39;#detail<?=$iG?>&#39;).toggle(&#39;past&#39;)" class="ac" <?=fBackCLR($iG)?>><?=$tKibE?></td>
        <td style="border-bottom:1px dotted #CCCCCC" onclick="$(&#39;#detail<?=$iG?>&#39;).toggle(&#39;past&#39;)" class="ac" <?=fBackCLR($iG)?>><?=$tKibF?></td>
        <td style="border-bottom:1px dotted #CCCCCC" onclick="$(&#39;#detail<?=$iG?>&#39;).toggle(&#39;past&#39;)" <?=fBackCLR($iG)?>>&nbsp;</td>
        <td style="border-bottom:1px dotted #CCCCCC" width="61" align="center" <?=fBackCLR($iG)?>>
		<a href="#" class="ico edit" onclick="EditData<?=$mRo['IDT']?>('1130','500','center'); return false;">EDIT</a></td>
        <td width="83" align="center" <?=fBackCLR($iG)?>><a href="#" class="ico del" onclick="P_DeleteR('<?=$mRo['IDT']?>','<?=$nDel?>','<?=$ReO?>'); return false;">DELETE</a></td>
      </tr>
      <tr> 
        <td colspan="12">
		<table id="detail<?=$iG?>" cellpadding="3" border="0" width="100%" style="border:1px solid #C0C0C0; font-family: Calibri; font-size: 9pt; font-style: Italic; color: #800000; display: none; border-collapse:collapse">
        <?
		$iiG=1;
		$nSQ= "SELECT * FROM ta_upb WHERE Kd_UPB='".$mRo['Kd_UPB']."' ORDER BY Tahun";
		$mRs = mysql_query($nSQ) or die(mysql_error());
		$mTo = mysql_fetch_assoc($mRs);
		$zRo = mysql_num_rows($mRs);
		if ($zRo > 0)
		{
		do
			{
			?>
            <tr> 
              <td width="46">&nbsp;</td>
              <td width="52" style="border-top: 1px dotted  #C0C0C0"> 
                <?=$mTo['Tahun']?>              </td>
              <td width="250" style="border-top: 1px dotted  #C0C0C0"> 
                <?=$mTo['Nm_Pimpinan']?>              </td>
              <td width="6" style="border-top: 1px dotted  #C0C0C0">&nbsp;</td>
              <td width="273" style="border-top: 1px dotted  #C0C0C0"> 
                <?=$mTo['Nm_Pengurus']?>              </td>
              <td width="6" style="border-top: 1px dotted  #C0C0C0">&nbsp;</td>
              <td width="395" style="border-top: 1px dotted  #C0C0C0"> 
                <?=$mTo['Nm_Penyimpan']?>              </td>
            </tr>
            <tr> 
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td> 
                <?=$mTo['Nip_Pimpinan']?>              </td>
              <td>&nbsp;</td>
              <td> 
                <?=$mTo['Nip_Pengurus']?>              </td>
              <td>&nbsp;</td>
              <td> 
                <?=$mTo['Nip_Penyimpan']?>              </td>
            </tr>
            <?
			  $iiG++;
				}
			while ($mTo = mysql_fetch_assoc($mRs));	
			}
			?>
          </table>			</td>
      </tr>
      <?
			  $iG++;
			}
			while ($mRo = mysql_fetch_assoc($nRs));	
		}
		else
		{
		?>
      <tr> 
        <td></td>
        <td colspan="9">Data tidak ditemukan..!!</td>
        <td colspan="2">&nbsp;</td>
      </tr>
      <?
		}
		?>
      <tr height="30">
        <td style="border-top:1px solid #CCCCCC">&nbsp;</td>
        <td colspan="9" style="border-top:1px solid #CCCCCC">
		[&nbsp;<a href="#" class="ico add" onclick="AddItem('1130','500','center'); return false;">&nbsp;ADD ITEM</a>&nbsp;]&nbsp;&nbsp;&nbsp;
		[&nbsp;<a href="<?=$_SERVER['PHP_SELF']."?gUnT=".$zUnT."&gUnTs=".$zUnTs."&FrmG=".$_GET['FrmG']."&IdL=".$_GET['IdL']."&Page=".$_GET['Page']."&iG=".$_GET['iG'] ?>" class="ico reff">&nbsp;REFRESH</a>&nbsp;]</td>
        <td colspan="2" style="border-top:1px solid #CCCCCC">&nbsp;</td>
      </tr>
  </table>
  <?
	if ($Lev > 1)
	{$nSQL= "SELECT COUNT(*) AS JmlRc FROM ref_upb WHERE Kd_UPB LIKE '".substr($SkP,0,11)."%'";}
	else
	{$nSQL= "SELECT COUNT(*) AS JmlRc FROM ref_upb";}
	$fUlrR= "FrmG=".$_GET['FrmG']."&IdL=".$_GET['IdL']."&";
	#include "FilePagingBot.php";
  ?>
</form>
</body>
</html>
<script language="javascript">
	var objfrm=document.myfrm;
	function P_DeleteR(xA,xB,xR)
	{
		if (xR=="Y") {window.alert('<?=TxReadOnly?>'); return false;}
		if (xB!="")
			{window.alert("Access Denied...!!");}
		else
		{
			var AN = confirm("Hapus data ..?!!");
			if (AN)
			{
			objfrm.CritIDT.value = xA;
			objfrm.Simpan.value = "DeleteRecord";
			objfrm.submit();
			}
		}
	}

	function P_Comming()
	{
		window.alert('Under construction...!!');
	}
	
	function AddItem(w,h,pos)
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
					<?
					$URL_Top = "Form_UPB_Top.php?FrmG=".$_GET['FrmG']."&IdL=".$_GET['IdL'];
					$URL_Mid = "Form_UPB_Mid.php?gBdg=".$zBdG."&gUnt=".$zUnT."&gSub=".$zUnTs."&FrmG=".$_GET['FrmG']."&IdL=".$_GET['IdL'];
					$URL_Bot = "Form_UPB_Bot.php";
					?>       			
       			txtHTML="<html><head><title>Simbada Kab. Hulu Sungai Tengah</title></head><frameset framespacing='0' border='0' rows='45,*,30' frameborder='0'><frame name='WinFormKIB_Top' noresize src='<?=$URL_Top?>' scrolling='no'><frame name='WinFormKIB_Mid' src='<?=$URL_Mid?>' scrolling='auto'><frame name='WinFormKIB_Bot' src= '<?=$URL_Bot?>' scrolling='no'><noframes><body><p>=>.............??!</p></body></noframes></frameset></html>"            
       			win.focus()
      			win.window.document.clear()
      			win.window.document.write(txtHTML)
      			win.window.document.close() 
      			win.setTimeout("self.close()",200000000)
    		}
	}

	$("#fUnTs").focus();
</script>

<?php require('Connection_Close.php');?>
