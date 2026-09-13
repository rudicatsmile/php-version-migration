<?php
require "CheckSession.php";
require "Connection.php";
require "Connection_Simkada.php";
require "FileFunction.php";
require "CheckLogin.php";
#$Lev=2;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
<title><?php require_once 'AppTitle.php'; echo APP_TITLE; ?></title>
<link rel="stylesheet" href="css/style.css" type="text/css" media="all" />
<script type="text/javascript" src="js/jquery-1.8.2.min.js"></script>
</head>
<?php
if (isset($_GET['gBdG'])) {$gBdG = $_GET['gBdG'];} else {$gBdG  ="";}

?>
<body>
<?php require "FileMenu.php";?>
<form name="myfrm" method="post" action="<?php echo "Ref_Unit_.php?FrmG=".$_GET['FrmG']."&IdL=".$_GET['IdL']."&Page=".$_GET['Page']."&iG=".$_GET['iG']?>">
  <input type="hidden" name="Simpan">
  <input type="hidden" name="CritIDT" size="10">
	<table border="0" align="center" style="width:99%">
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr> 
        <td width="139">BIDANG PEMERINTAHAN</td>
        <td width="20">:</td>
        <td width="1151">
		<?php
		if ($Lev > 1){
		?>
		<input name="fBdG" type="text" readonly="readonly" value="<?=substr($SkP,0,8)?>" style="text-align:center; width:60px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px"/>
		<input name="fBdM" type="text" readonly="readonly" value="<?=fGlobal("Nm_Bidang","ref_bidang","Kd_Bidang",substr($SkP,0,8),"=","","")?>" style=" width:400px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px"/>
		<?php
		}
		else {
		?>
		<select class="boxs" name="fBdG" tabindex="0" style="width: 470px" onchange="this.form.submit()">
		<option value="%">Semua</option>
          <?php
		$nSQ = "SELECT Kd_Bidang, Nm_Bidang FROM ref_bidang ORDER BY Kd_Bidang";
		$nRs = mysql_query($nSQ) or die(mysql_error());
		$mRo = mysql_fetch_assoc($nRs);
		$tRo = mysql_num_rows($nRs);
		if ($tRo > 0)
		{
			#if ($gBdG=="") {$gBdG=$mRo['Kd_Bidang'];}
			do
			{
				$sel ="";
				if ($mRo['Kd_Bidang']==$gBdG) 
				{
				$sel ="selected";
				$zBdG=$mRo['Kd_Bidang'];
				}
				echo '<option '.$sel.' value="'.$mRo['Kd_Bidang'].'">'.$mRo['Kd_Bidang']." : ".strtoupper($mRo['Nm_Bidang']).'</option>';
			}
			while ($mRo = mysql_fetch_assoc($nRs));	
		}
	  ?>
        </select>
		<?php } ?>
		</td>
      </tr>
      
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
	 </table>
    <table align="center" class="table-list" border="0" cellspacing="0" cellpadding="0" style="width:99%">
      <tr> 
        <th width="47" class="ac">No</th>
        <th width="76">Kode</th>
        <th width="424">Nama Unit Kerja</th>
        <th width="425">LINK UNIT</th>
        <th width="156" class="ac">Actions</th>
      </tr>
      <?php
		$DataPerPageF = 500;
		include "FilePagingTop.php";
	  	if ($Lev > 1)
	  	{$nSQL= "SELECT * FROM ref_unit WHERE Kd_Unit = '".substr($SkP,0,11)."' ORDER BY Kd_Unit LIMIT $Offset, $DataPerPage";}
		else
	  	{$nSQL= "SELECT * FROM ref_unit WHERE Kd_Unit LIKE '".$zBdG."%' ORDER BY Kd_Unit LIMIT $Offset, $DataPerPage";}
		$nRs = mysql_query($nSQL) or die(mysql_error());
		$mRo = mysql_fetch_assoc($nRs);
		$tRo = mysql_num_rows($nRs);
		if ($tRo > 0)
		{
		do
			{
				
			$gLNK = $mRo['Kd_Unit_Link'];
			$mLNK = $gLNK." ".$mRo['Nm_Unit_Link'];
			#if ($gLNK) {
			#	$mLNK = $gLNK." : ".fGlobalNEW("Satuan_Kerja","satuan_kerja","ID_Satker",$gLNK,"=","",DatabaseSA,$ConSA,"");
			#	CallConnection(DatabaseSB,$ConSB);
			#}
			$mSQL= "SELECT * FROM ref_sub_unit WHERE Kd_Sub LIKE '".$mRo['Kd_Unit'].".__' ORDER BY Kd_Sub";
			$mRs = mysql_query($mSQL) or die(mysql_error());
			$rRo = mysql_fetch_assoc($mRs);
			$zRo = mysql_num_rows($mRs);
			if ($zRo > 0)
			{$nDel="NoDel";}
			else
			{$nDel="";}
			?>
      		<script language="javascript">
				function EditData<?php echo $mRo['IDT']?>(w,h,pos)
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
								<?php
									$URL_Top = "Form_Unit_Top.php?FrmG=".$_GET['FrmG']."&IdL=".$_GET['IdL'];
									$URL_Mid = "Form_Unit_Mid.php?rIDT=".$mRo['IDT']."&IdL=".$_GET['IdL'];
									$URL_Bot = "Form_Unit_Bot.php";
								?>       			
							txtHTML="<html><head><title><?php require_once 'AppTitle.php'; echo APP_TITLE; ?></title></head><frameset framespacing='0' border='0' rows='45,*,30' frameborder='0'><frame name='WinFormKIB_Top' noresize src='<?php echo $URL_Top?>' scrolling='no'><frame name='WinFormKIB_Mid' src='<?php echo $URL_Mid?>' scrolling='auto'><frame name='WinFormKIB_Bot' src= '<?php echo $URL_Bot?>' scrolling='no'><noframes><body><p>=>.............??!</p></body></noframes></frameset></html>"            
							win.focus()
							win.window.document.clear()
							win.window.document.write(txtHTML)
							win.window.document.close() 
							win.setTimeout("self.close()",200000000)
						}
				}
			</script>
      <tr height="22" style="cursor: pointer" title="clik disini untuk melihat rincian...!" onmouseover="this.style.cursor=&#39;pointer&#39"> 
        <td <?=fBackCLR($iG)?> style="border-bottom: 1px dotted #CCCCCC; text-align:center"><?php echo $iG?>.</td>
        <td style="border-bottom: 1px dotted #CCCCCC" onclick="$(&#39;#detail<?php echo $iG?>&#39;).toggle(&#39;past&#39;)" <?=fBackCLR($iG)?>><?=$mRo['Kd_Unit']?></td>
        <td style="border-bottom: 1px dotted #CCCCCC" onclick="$(&#39;#detail<?php echo $iG?>&#39;).toggle(&#39;past&#39;)" <?=fBackCLR($iG)?>><?=$mRo['Nm_Unit']?></td>
        <td style="border-bottom: 1px dotted #CCCCCC" onclick="$(&#39;#detail<?php echo $iG?>&#39;).toggle(&#39;past&#39;)" <?=fBackCLR($iG)?>><?=$mLNK?></td>
        <td style="border-bottom: 1px dotted #CCCCCC" class="ac" <?=fBackCLR($iG)?>>
		<a href="#" class="ico edit" onclick="EditData<?=$mRo['IDT']?>('950','500','center'); return false;">EDIT</a>
		&nbsp;&nbsp;&nbsp;&nbsp;
		<a href="#" class="ico del" onclick="P_DeleteR('<?=$mRo['IDT']?>','<?=$nDel?>','<?=$Lev?>','<?=$ReO?>'); return false;">DELETE</a></td>
      </tr>
      <tr> 
        <td colspan="5"> <table id="detail<?php echo $iG?>" cellpadding="3" border="0" width="900" style="border:1px solid #C0C0C0; font-family: Calibri; font-size: 9pt; font-style: Italic; color: #800000; display: none; border-collapse:collapse">
            <?php
			if ($zRo > 0)
			{
			do
				{
				?>
            <tr> 
              <td width="4%">&nbsp;</td>
              <td width="7%"> 
                <?php echo $rRo['Kd_Sub']?>              </td>
              <td width="1%">:</td>
              <td width="74%"> 
                <?php echo $rRo['Nm_Sub']?>              </td>
              <td width="14%">&nbsp; </td>
            </tr>
            <?php
				}
					while ($rRo = mysql_fetch_assoc($mRs));	
				}
				else
				{
				?>
            <tr> 
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>Unit tidak ditemukan </td>
              <td valign="top">&nbsp;</td>
            </tr>
            <?php }?>
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
        <td colspan="3">Data tidak ditemukan..!!</td>
        <td>&nbsp;</td>
      </tr>
      <?php
		}
		?>
      <tr height="30">
        <td style="border-top:1px solid #CCCCCC">&nbsp;</td>
        <td colspan="3" style="border-top:1px solid #CCCCCC">
		[&nbsp;<a href="#" class="ico add" onclick="AddItem('950','500','center','<?=$Lev?>'); return false;">&nbsp;ADD ITEM</a>&nbsp;]&nbsp;&nbsp;&nbsp;
		[&nbsp;<a href="<?=$_SERVER['PHP_SELF']."?gBdG=".$zBdG."&FrmG=".$_GET['FrmG']."&IdL=".$_GET['IdL']."&Page=".$_GET['Page']."&iG=".$_GET['iG'] ?>" class="ico reff">&nbsp;REFRESH</a>&nbsp;]</td>
        <td style="border-top:1px solid #CCCCCC">&nbsp;</td>
      </tr>
    </table>
	  <?php
		if ($Lev > 1)
		{$nSQL= "SELECT COUNT(*) FROM ref_unit WHERE Kd_Unit = '".substr($SkP,0,11)."'";}
		else
		{$nSQL= "SELECT COUNT(*) AS JmlRc FROM ref_unit WHERE Kd_Unit LIKE '".$zBdG."%'";}
		$fUlrR= "FrmG=".$_GET['FrmG']."&IdL=".$_GET['IdL']."&";
	  ?>
</form>
</body>
</html>
<script language="javascript">
	var objfrm=document.myfrm;
	function P_DeleteR(xA,xB,Lev,xR)
	{
		if (xR=="Y") {window.alert('<?=TxReadOnly?>'); return false;}
		if (Lev > 1) {window.alert('Access denied...!!'); return false;}
		if (xB!="")	{window.alert("Access Denied...!!"); return false;}
		var AN = confirm("Hapus data ..?!!");
		if (AN)
		{
		objfrm.CritIDT.value = xA;
		objfrm.Simpan.value = "DeleteRecord";
		objfrm.submit();
		}
	}

	function P_Comming()
	{
		window.alert('Under construction...!!');
	}
	
	function AddItem(w,h,pos,Lev)
	{
		if (Lev > 1) {window.alert('Access denied...!!'); return false;}
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
				$URL_Top = "Form_Unit_Top.php?FrmG=".$_GET['FrmG']."&IdL=".$_GET['IdL'];
				$URL_Mid = "Form_Unit_Mid.php?gBid=".$gBdG."&IdL=".$_GET['IdL'];
				$URL_Bot = "Form_Unit_Bot.php";
			?>       			
			txtHTML="<html><head><title><?php require_once 'AppTitle.php'; echo APP_TITLE; ?></title></head><frameset framespacing='0' border='0' rows='45,*,30' frameborder='0'><frame name='WinFormKIB_Top' noresize src='<?php echo $URL_Top?>' scrolling='no'><frame name='WinFormKIB_Mid' src='<?php echo $URL_Mid?>' scrolling='auto'><frame name='WinFormKIB_Bot' src= '<?php echo $URL_Bot?>' scrolling='no'><noframes><body><p>=>.............??!</p></body></noframes></frameset></html>"            
			win.focus()
			win.window.document.clear()
			win.window.document.write(txtHTML)
			win.window.document.close() 
			win.setTimeout("self.close()",200000000)
		}
	}
</script>
<?php require('Connection_Close.php');?>
