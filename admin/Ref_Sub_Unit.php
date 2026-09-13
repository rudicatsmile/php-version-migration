<?php require "CheckSession.php"?>
<?php require "Connection.php"?>
<?php require "FileFunction.php"?>
<?php require "CheckLogin.php"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
<title><?php require_once 'AppTitle.php'; echo APP_TITLE; ?></title>
<link rel="stylesheet" href="css/style.css" type="text/css" media="all" />
<script type="text/javascript" src="js/jquery-1.8.2.min.js"></script>
</head>
<?php
if (isset($_GET['gUnT'])) {$gUnT = $_GET['gUnT'];} else {$gUnT  ="";}
?>
<body>
<?php require "FileMenu.php";?>
<form name="myfrm" method="post" action="<?php echo "Ref_Sub_Unit_.php?FrmG=".$_GET['FrmG']."&IdL=".$_GET['IdL']."&Page=".$_GET['Page']."&iG=".$_GET['iG'] ?>">
  <input type="hidden" name="Simpan">
  <input type="hidden" name="CritIDT" size="10">
    <table border="0" align="center" style="width:99%">
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      
      <tr> 
        <td width="77">UNIT KERJA</td>
        <td width="17">:</td>
        <td width="1202">
		<?php
		if ($Lev > 1){
		?>
		<input name="fUnT" type="text" readonly="readonly" value="<?=substr($SkP,0,11)?>" style="width:80px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px"/>
		<input name="fUnM" type="text" readonly="readonly" value="<?=strtoupper(fGlobal("Nm_Unit","ref_unit","Kd_Unit",substr($SkP,0,11),"=","",""))?>" style=" width:400px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px"/>
		<?php
		}
		else {
		?>
		<select class="boxs" name="fUnT" tabindex="0" style="width: 470px" onchange="this.form.submit()">
        <?php
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
				$zBdG=substr($mRo['Kd_Unit'],0,8);
				$zUnT=$mRo['Kd_Unit'];
				}
				echo '<option '.$sel.' value="'.$mRo['Kd_Unit'].'">'.$mRo['Kd_Unit']." : ".strtoupper($mRo['Nm_Unit']).'</option>';
			}
			while ($mRo = mysql_fetch_assoc($nRs));	
		}
	  ?>
        </select>
		<?php } ?>		</td>
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
        <th width="85">Kode</th>
        <th width="840">Nama Sub Unit</th>
        <th width="156" class="ac">Actions</th>
      </tr>
      <?php
		$DataPerPageF = 500;
		include "FilePagingTop.php";

		if ($Lev > 1)
		{
			$nSQL = "SELECT * FROM ref_sub_unit WHERE Kd_Sub LIKE '".substr($SkP,0,11)."%' ORDER BY Kd_Sub LIMIT $Offset, $DataPerPage";
			$zBdG = substr($SkP,0,8);
			$zUnT = substr($SkP,0,11);
		}
		else
		{$nSQL= "SELECT * FROM ref_sub_unit WHERE Kd_Sub LIKE '$zUnT%' ORDER BY Kd_Sub LIMIT $Offset, $DataPerPage";}
		$nRs = mysql_query($nSQL) or die(mysql_error());
		$mRo = mysql_fetch_assoc($nRs);
		$tRo = mysql_num_rows($nRs);
		if ($tRo > 0)
		{
		do
			{
			$mSQL= "SELECT * FROM ref_upb WHERE Kd_UPB LIKE '".$mRo['Kd_Sub'].".___' ORDER BY Kd_UPB";
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
									$URL_Top = "Form_Sub_Unit_Top.php?FrmG=".$_GET['FrmG']."&IdL=".$_GET['IdL'];
									$URL_Mid = "Form_Sub_Unit_Mid.php?rIDT=".$mRo['IDT']."&IdL=".$_GET['IdL'];
									$URL_Bot = "Form_Sub_Unit_Bot.php";
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
        <td style="border-bottom: 1px dotted #CCCCCC" onclick="$(&#39;#detail<?php echo $iG?>&#39;).toggle(&#39;past&#39;)" <?=fBackCLR($iG)?>><?php echo $mRo['Kd_Sub']?></td>
        <td style="border-bottom: 1px dotted #CCCCCC" onclick="$(&#39;#detail<?php echo $iG?>&#39;).toggle(&#39;past&#39;)" <?=fBackCLR($iG)?>><?php echo $mRo['Nm_Sub']?></td>
        <td style="border-bottom: 1px dotted #CCCCCC" class="ac" <?=fBackCLR($iG)?>><a href="#" class="ico del" onclick="P_DeleteR('<?=$mRo['IDT']?>','<?=$nDel?>','<?=$ReO?>'); return false;">DELETE</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="#" class="ico edit" onclick="EditData<?php echo $mRo['IDT']?>('800','450','center'); return false;">EDIT</a></td>
      </tr>
      <tr> 
        <td colspan="4"> <table id="detail<?php echo $iG?>" cellpadding="3" border="0" width="900" style="border:1px solid #C0C0C0; font-family: Calibri; font-size: 9pt; font-style: Italic; color: #800000; display: none; border-collapse:collapse">
            <?php
			if ($zRo > 0)
			{
			do
				{
				?>
      		<script language="javascript">
				function EditDataUPB<?php echo $mRo['IDT'].$rRo['IDT']?>(w,h,pos)
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
									$URL_Top = "Form_UPB_Top.php?FrmG=REFERENSI -> UPB";
									$URL_Mid = "Form_UPB_Mid.php?rIDT=".$rRo['IDT']."&IdL=".$_GET['IdL'];
									$URL_Bot = "Form_UPB_Bot.php";
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
            <tr> 
              <td width="36">&nbsp;</td>
              <td width="81"><a href="#" onclick="EditDataUPB<?php echo $mRo['IDT'].$rRo['IDT']?>('800','450','center'); return false"> 
                <?php echo $rRo['Kd_UPB']?>
                </a></td>
              <td width="8">:</td>
              <td width="814"><a href="#" onclick="EditDataUPB<?php echo $mRo['IDT'].$rRo['IDT']?>('800','450','center'); return false">
                <?php echo $rRo['Nm_UPB']?>
                </a></td>
              <td width="137">&nbsp; </td>
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
              <td>UPB tidak ditemukan </td>
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
        <td colspan="2">Data tidak ditemukan..!!</td>
        <td>&nbsp;</td>
      </tr>
      <?php
		}
		?>
      <tr height="30">
        <td style="border-top:1px solid #CCCCCC">&nbsp;</td>
        <td colspan="2" style="border-top:1px solid #CCCCCC">
		[&nbsp;<a href="#" class="ico add" onclick="AddItem('800','450','center')">&nbsp;ADD ITEM</a>&nbsp;]&nbsp;&nbsp;&nbsp;
		[&nbsp;<a href="<?php echo $_SERVER['PHP_SELF']."?gUnT=".$zUnT."&FrmG=".$_GET['FrmG']."&IdL=".$_GET['IdL']."&Page=".$_GET['Page']."&iG=".$_GET['iG'] ?>" class="ico reff">&nbsp;REFRESH</a>&nbsp;]</td>
        <td style="border-top:1px solid #CCCCCC">&nbsp;</td>
      </tr>
    </table>
	  <?php
		if ($Lev > 1)
		{$nSQL= "SELECT COUNT(*) FROM ref_sub_unit WHERE Kd_Sub LIKE '".substr($SkP,0,11)."%'";}
		else
		{$nSQL= "SELECT COUNT(*) AS JmlRc FROM ref_sub_unit";}
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
			var AN = confirm("Hapus data aset..?!!");
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
					<?php
						$URL_Top = "Form_Sub_Unit_Top.php?FrmG=".$_GET['FrmG']."&IdL=".$_GET['IdL'];
						$URL_Mid = "Form_Sub_Unit_Mid.php?gBid=".$zBdG."&gUnt=".$zUnT."&IdL=".$_GET['IdL'];
						$URL_Bot = "Form_Sub_Unit_Bot.php";
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
