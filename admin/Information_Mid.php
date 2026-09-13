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
$IdL = $_REQUEST['IdL'];
if ($IdL!="")
{
	if (isset($_REQUEST['fSimpan']))
	{
		if ($_REQUEST['fSimpan']=="DelRec")
		{
		$gIdT = $_REQUEST['fIdT'];
		$SQ = "DELETE FROM ta_informasi WHERE IDT='$gIdT'";
		$rs = mysql_query($SQ) or die(mysql_error());
		}
	}
}
?>
<body>
<form name="myfrm" method="POST" action="<?php echo "Information_Mid.php?IdL=".$IdL ?>">
<input type="hidden" name="fSimpan">
<input type="hidden" name="fIdT">
<div class="table"> 
<table width="850" border="0" cellspacing="0" cellpadding="0" style="font-size: 8pt; font-family: Arial Narrow">
<tr> 
  <th width="39" align="center">NO</th>
  <th width="191" align="center">JUDUL</th>
  <th width="457" align="left">INFORMASI</th>
  <th width="62" class="ac">TAMPIL</th>
  <th width="101" class="ac">ACTION</th>
</tr>
		<?php
		$iG=1;
		$nSQL= "SELECT * FROM ta_informasi ORDER by IDT";
		$nRs = mysql_query($nSQL) or die(mysql_error());
		$mRo = mysql_fetch_assoc($nRs);
		$tRo = mysql_num_rows($nRs);
		if ($tRo > 0)
		{
		do
			{
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
									$URL_Top = "Form_Info_Top.php";
									$URL_Mid = "Form_Info_Mid.php?rIDT=".$mRo['IDT']."&IdL=".$_REQUEST['IdL'];
									$URL_Bot = "Form_Info_Bot.php";
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
            <tr style="cursor: pointer" title="clik disini untuk melihat rincian...!" onmouseover="this.style.cursor=&#39;pointer&#39" <?=fBackCLR($iG)?>> 
              <td> 
                <?php echo $iG?>
                .</td>
              <td onclick="$(&#39;#detail<?php echo $iG?>&#39;).toggle(&#39;past&#39;)"> 
                <?php echo $mRo['Header']?>              </td>
              <td onclick="$(&#39;#detail<?php echo $iG?>&#39;).toggle(&#39;past&#39;)"> 
                <?php echo substr($mRo['Informasi'],0,60)."...."?>              </td>
              <td onclick="$(&#39;#detail<?php echo $iG?>&#39;).toggle(&#39;past&#39;)" align="center"><?php echo $mRo['Tampil']?></td>
              <td align="right"><a href="#" class="ico del" onclick="P_DeleteR('<?php echo $mRo['IDT']?>')">DELETE</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="#" class="ico edit" onclick="EditData<?php echo $mRo['IDT']?>('650','450','center')">EDIT</a></td>
            </tr>
            <tr> 
              <td colspan="5">
			  <table cellpadding="3" id="detail<?php echo $iG?>" border="0" width="100%" style="border:1px solid #C0C0C0; font-family: Calibri; font-size: 9pt; font-style: Italic; color: #800000; display: none; border-collapse:collapse">
                  <tr> 
                    <td width="100">&nbsp;</td>
                    <td align="center"><?php echo $mRo['Informasi']?></td>
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
              <td colspan="3">Data tidak ditemukan..!!</td>
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
              <td align="right"><a href="#" class="ico edit" onclick="AddData('650','450','center')">TAMBAH 
                BARU</a></td>
            </tr>
          </table>
          <!-- Pagging -->
</div>
</form>
</body>
</html>
<script language="javascript">
var objfrm=document.myfrm;
	function P_DeleteR(xA)
	{
		var AN = confirm("Delete data..?!!");
		if (AN)
		{
			objfrm.fIdT.value=xA;
			objfrm.fSimpan.value="DelRec";
			objfrm.submit();
		}
	}
	
	function AddData(w,h,pos)
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
						$URL_Top = "Form_Info_Top.php";
						$URL_Mid = "Form_Info_Mid.php?IdL=".$_REQUEST['IdL'];
						$URL_Bot = "Form_Info_Bot.php";
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
