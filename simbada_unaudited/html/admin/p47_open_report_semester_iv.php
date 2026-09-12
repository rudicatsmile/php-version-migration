<?
// require "checklogin.php"; 
// require "checkusertype.php"; 

require('Connection.php');
require('FileFunction.php');
require("CheckLogin.php");

extract($_GET);

$gUNT = substr($SkP,0,11);
$dUNT = fGlobal("Nm_Unit","ref_unit","Kd_Unit",$gUNT,"=","","");

if (isset($_GET['rIDT'])) {$gIDT=$_GET['rIDT'];} 
if (isset($_GET['rDELL'])) {$gDELL=$_GET['rDELL'];} 

$fHri = date('d'); 
$fBln = date('m'); 
$fThn = date('Y'); 

$rSem = 1;
$rThn = date('Y'); 

#$g02v = substr($rBD,0,11);
#$g03v = $rBD;
#$g02  = fGlobal("bidang","tb_bidang","kode",$g02v,"=","","");

#$g03  = fGlobal("sub_bidang","tb_bidang_sub","kode",$g03v,"=","",DatabaseSA,$ConSA,"");
// echo $UID." --- ".$Lev;
function itemListDocument($stringListDocument,$doc,$formatType,$titleDocument,$subTitleDocument,$subTitleDocument2,
  							$semesterOrMonth,$isLocation,$isSkpd,$skpdPosition,$level,$isKomptabel,$isNameLocation,$IdL	){
	
	echo "
		<tr height=22>
			<td>&nbsp;</td>
			<td>		
				<a href='#' class='ico docu' onClick=\"showDocNew('',
						'".$doc."',
						'".$formatType."',
						'".$titleDocument."',
						'".$subTitleDocument."',
						'".$subTitleDocument2."',
						'".$semesterOrMonth."',
						'".$isLocation."','".$isSkpd."','".$skpdPosition."','".$level."','".$isKomptabel."','".$isNameLocation."',
						'".$IdL."'); return false;\">
						".$stringListDocument."
				</a>
			</td>
		</tr>	
	";

  } 

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
<title>Simbada</title>
<link rel="stylesheet" href="css/style.css" type="text/css" media="all" />
<script type="text/javascript" src="js/jquery-1.8.2.min.js"></script>
<script type="text/javascript" src="global.js"></script>
<body>
<?php require "FileMenu.php";?>

<form name="myfrm" method="POST" action=""> 
<br><br>
<table border="0" class="table-link" cellspacing="0" cellpadding="0" align="center" style="width:1100px; color:#fff; background:#79a86a">
  <tr>
    <td width="150">&nbsp;</td>
    <td width="19">&nbsp;</td>
    <td width="550">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr height="24">
    <td align="right">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td rowspan="3">
      <input type="hidden" name="B1" id="B1" value="Rekap" onclick="P_Rekap('<?=$IncFile?>','<?=$_GET['IdL']?>','<?=str_replace(" ","_",$_GET['JdL'])?>')" style="width:105px; height:30px" tabindex="2" />
    </td>
  </tr>
 
  <tr height="23">
      <td class="ar">Unit Kerja  </td>
      <td align="center">&nbsp;</td>
      <td colspan="3">
    <input name="fUNT" id="fUNT" type="text" value="<?=$gUNT?>" readonly style="padding-left:3px; width:105px; border: 1px solid #C0C0C0"/>
    <input name="dUNT" id="dUNT" type="text" value="<?=$dUNT?>" readonly 
      <? if ($Lev <= 1) {?> onClick="showUNIT('','<?=$_GET['IdL']?>')" 
      <? } else {echo "readonly";}?> style="padding-left:3px; width:450px; border: 1px solid #C0C0C0"/>
    <div id="unitMstCri" class="Unit0Cri">
      <div id="unitDiv1Cri" class="Unit1Cri"></div>
      <div id="unitDiv2Cri" class="Unit2Cri"></div>
    </div>	
  </td>
  <td align="right">&nbsp;</td>
  </tr>

    
  <tr height="24">
    <td align="right">Semester</td>
    <td>&nbsp;</td>
    <td><select name="fSem" id="fSem" style="width:100px" tabindex="1">
      <? 
        for ($iG=1; $iG<=2; $iG++) 
        { 
            if ($rSem==$iG) {$gSL="selected";} else {$gSL="";} 
            echo "<option value='$iG' $gSL >Semester ".$iG."</option>"; 
        } 
        ?>
    </select>
        <select name="fThn" id="fThn" style="width:63px" tabindex="1">
          <? 
        for ($iG=2022; $iG<=date('Y'); $iG++) 
        { 
            if ($rThn==$iG) {$gSL="selected";} else {$gSL="";} 
            echo "<option value='$iG' $gSL >".$iG."</option>"; 
        } 
        ?>
        </select>    </td>
  </tr>
  <tr height="24">
    <td align="right">Laporan BMD</td>
    <td>&nbsp;</td>
    <td>
	<label><input name="radiOnOff" id="radiOnOff" type="radio" value="V1" checked />Kuasa Pengguna</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	<label><input name="radiOnOff" id="radiOnOff" type="radio" value="V2" />Pengguna</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	<label><input name="radiOnOff" id="radiOnOff" type="radio" value="V3" />Pengelola</label>	</td>
    <td>&nbsp;</td>
  </tr>
  <tr height="24">
    <td align="right">Tanggal TTD</td>
    <td>&nbsp;</td>
    <td>
	  <select name="fHri" id="fHri" style="width:45px; text-align:center" tabindex="1">
        <? 
        for ($iG=1; $iG<=31; $iG++) 
        { 
            if ($fHri==$iG) {$gSL="selected";} else {$gSL="";} 
            echo "<option value='$iG' $gSL>".$iG."</option>"; 
        } 
        ?>
      </select>
        <select name="fBln" id="fBln" style="width:85px; text-align:center" tabindex="1">
          <? 
        for ($iG=1; $iG<=12; $iG++) 
        { 
            if ($fBln==$iG) {$gSL="selected";} else {$gSL="";} 
            echo "<option value='$iG' $gSL>".fNmBulanLong($iG)."</option>"; 
        } 
        ?>
        </select>
        <select name="fThn" id="fThn" style="width:58px; text-align:center" tabindex="1">
          <? 
        for ($iG=2020; $iG<=date('Y'); $iG++) 
        { 
            if ($fThn==$iG) {$gSL="selected";} else {$gSL="";} 
            echo "<option value='$iG' $gSL>".$iG."</option>"; 
        } 
        ?>
        </select>	
	</td>
    <td>&nbsp;</td>
  </tr>
  <tr height="24">
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
<table border="0" class="table-link" cellspacing="0" cellpadding="0" align="center" style="width:1100px">

  <tr>
    <td width="126">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  

 

  <tr height="22">
    <td>&nbsp;</td>
    <td><u>Format IV.A.1.1</u></td>
  </tr>

  <tr height="22">
    <td>&nbsp;</td>
    <td><a href="#" class="ico docu" onClick="showDoc('','Format_IV_A_1_1_1','<?=$IdL?>'); return false;">Format IV.A.1.1.1 - LAPORAN PENGADAAN BMD BERUPA ASET LANCAR PERSEDIAAN PER SEMESTER
	</a></td>
  </tr>

  <tr height="22">
    <td>&nbsp;</td>
    <td><a href="#" class="ico docu" onClick="showDoc('','Format_IV_A_1_1_2','<?=$IdL?>'); return false;">Format IV.A.1.1.2 - LAPORAN PENGADAAN BMD BERUPA ASET LANCAR PERSEDIAAN PER BULAN
	</a></td>
  </tr>

  <tr height="22">
    <td>&nbsp;</td>
    <td><a href="#" class="ico docu" onClick="showDoc('','Format_IV_A_1_1_3','<?=$IdL?>'); return false;">Format IV.A.1.1.3 - REKAPITULASI PENGADAAN BMD BERUPA ASET LANCAR PERSEDIAAN 	MENURUT SUB RINCIAN OBJEK
	</a></td>
  </tr>

  <tr height="22">
    <td>&nbsp;</td>
    <td><a href="#" class="ico docu" onClick="showDoc('','Format_IV_A_1_1_4','<?=$IdL?>'); return false;">Format IV.A.1.1.4 - REKAPITULASI PENGADAAN BMD BERUPA ASET LANCAR PERSEDIAAN MENURUT OBJEK
	</a></td>
  </tr>

  <tr height="22">
    <td>&nbsp;</td>
    <td><a href="#" class="ico docu" onClick="showDoc('','Format_IV_A_1_1_5','<?=$IdL?>'); return false;">Format IV.A.1.1.5 - REKAPITULASI PENGADAAN BMD BERUPA ASET LANCAR PERSEDIAAN MENURUT RINCIAN OBJEK
	</a></td>
  </tr>

  <tr height="22">
    <td>&nbsp;</td>
    <td><a href="#" class="ico docu" onClick="showDoc('','Format_IV_A_1_1_6','<?=$IdL?>'); return false;">Format IV.A.1.1.6 - LAPORAN PENGADAAN BMD BERUPA ASET LANCAR PERSEDIAAN MENURUT SUB RINCIAN OBJEK
	</a></td>
  </tr>

  <tr height="22">
    <td>&nbsp;</td>
    <td><a href="#" class="ico docu" onClick="showDoc('','Format_IV_A_1_1_7','<?=$IdL?>'); return false;">Format IV.A.1.1.7- LAPORAN PENGADAAN BMD BERUPA ASET LANCAR PERSEDIAAN MENURUT SUB SUB RINCIAN OBJEK
	</a></td>
  </tr>

  <tr height="22">
    <td>&nbsp;</td>
    <td><a href="#" class="ico docu" onClick="showDoc('','Format_IV_A_1_1_8','<?=$IdL?>'); return false;">Format IV.A.1.1.8 - REKAPITULASI PENGADAAN PERSEDIAAN PER PENGGUNA BARANG MENURUT OBJEK
	</a></td>
  </tr>

  <tr height="22">
    <td>&nbsp;</td>
    <td></td>
  </tr>
  <tr height="22">
    <td>&nbsp;</td>
    <td><u>Format IV.A.1.2</u></td>
  </tr>

  <tr height="22">
    <td>&nbsp;</td>
    <td><a href="#" class="ico docu" onClick="showDoc('','Format_IV_A_1_2_1','<?=$IdL?>'); return false;">Format IV.A.1.2.1 - LAPORAN PENGADAAN BMD BERUPA ASET LANCAR PERSEDIAAN PER SEMESTER PER SUB RINCIAN OBJEK PER BULAN
	</a></td>
  </tr>

  <tr height="22">
    <td>&nbsp;</td>
    <td><a href="#" class="ico docu" onClick="showDoc('','Format_IV_A_1_2_2','<?=$IdL?>'); return false;">Format IV.A.1.2.2 - LAPORAN PENGADAAN BMD BERUPA ASET LANCAR PERSEDIAAN PER SEMESTER PER SUB SUB RINCIAN OBJEK PER BULAN
	</a></td>
  </tr>

  <tr height="22">
    <td>&nbsp;</td>
    <td><a href="#" class="ico docu" onClick="showDoc('','Format_IV_A_1_2_3','<?=$IdL?>'); return false;">Format IV.A.1.2.3 - LAPORAN PENGADAAN BMD BERUPA ASET LANCAR PERSEDIAAN PER SEMESTER PER SUB SUB RINCIAN OBJEK PER SEMESTER
	</a></td>
  </tr>

  <tr height="22">
    <td>&nbsp;</td>
    <td>
		<!-- <a href="#" class="ico docu" onClick="showDoc('','Format_IV_A_1_2_4','<?=$IdL?>'); return false;">Format IV.A.1.2.4 - LAPORAN PENGADAAN BMD BERUPA ASET LANCAR PERSEDIAAN PER SEMESTER PER SUB SUB RINCIAN OBJEK PER SEMESTER PER SKPD
	</a> -->
	<a href="#" class="ico docu" onClick="showDocNew('',
			'Format_IV_A_1_2_4',
			'Format.IV.A.1.2.4',
			'LAPORAN PENGADAAN BMD BERUPA ASET TETAP',
			'EKSTRAKOMPTABEL',
			'',
			'semester',
			'1',
			'1',
			'1',
			'7','1','0',
			'<?=$IdL?>'); return false;">
			Format IV.A.1.2.4 - LAPORAN PENGADAAN BMD BERUPA ASET LANCAR PERSEDIAAN PER SEMESTER PER SUB SUB RINCIAN OBJEK PER SEMESTER PER SKPD
		</a>
	</td>
  </tr>

  <tr height="22">
    <td>&nbsp;</td>
	<!-- function showDocNew(nR,doc,formatType,titleDocument,subTitleDocument,subTitleDocument2,semesterOrMonth,isLocation,isSkpd,skpdPosition,IdL) -->

    <td>
		<a href="#" class="ico docu" onClick="showDocNew('',
		'Format_IV_A_1_2_5',
		'Format.IV.A.1.2.5',
		'RINCIAN PENJELASAN LAPORAN PENGADAAN BMD BERUPA ASET TETAP',
		'INTRAKOMPTABEL',
		'KARENA PENAMBAHAN PENGADAAN BARANG DARI REKENING BELANJA OPERASI MENJADI ASET TETAP',
		'semester',
		'1',
		'1',
		'1',
		'7','1','0',
		'<?=$IdL?>'); return false;">
			Format IV.A.1.2.5 - RINCIAN PENJELASAN LAPORAN PENGADAAN BMD BERUPA ASET TETAP
		</a>
	</td>
  </tr>

  <tr height="22">
    <td>&nbsp;</td>
    <td>
		<a href="#" class="ico docu" onClick="showDocNew('',
		'Format_IV_A_1_2_5',
		'Format.IV.A.1.2.6',
		'RINCIAN PENJELASAN LAPORAN PENGADAAN BMD BERUPA ASET TETAP',
		'INTRAKOMPTABEL',
		'KARENA PENAMBAHAN PENGADAAN BARANG DARI REKENING BELANJA TIDAK TERDUGA MENJADI ASET TETAP',
		'semester',
		'1',
		'1',
		'1',
		'7','1','0',
		'<?=$IdL?>'); return false;">
			Format IV.A.1.2.6 - RINCIAN PENJELASAN LAPORAN PENGADAAN BMD BERUPA ASET TETAP
		</a>
	</td>
  </tr>

  <tr height="22">
    <td>&nbsp;</td>
    <td>
		<a href="#" class="ico docu" onClick="showDocNew('',
		'Format_IV_A_1_2_5',
		'Format.IV.A.1.2.7',
		'RINCIAN PENJELASAN LAPORAN PENGADAAN BMD BERUPA ASET TETAP',
		'INTRAKOMPTABEL',
		'KARENA PENAMBAHAN PENGADAAN BARANG DARI REKENING BELANJA MODAL JENIS LAINNYA MENJADI ASET TETAP',
		'semester',
		'1',
		'1',
		'1',
		'7','1','0',
		'<?=$IdL?>'); return false;">
			Format IV.A.1.2.7 - RINCIAN PENJELASAN LAPORAN PENGADAAN BMD BERUPA ASET TETAP
		</a>
	</td>
  </tr>

  <tr height="22">
    <td>&nbsp;</td>
    <td>
		<a href="#" class="ico docu" onClick="showDocNew('',
		'Format_IV_A_1_2_5',
		'Format.IV.A.1.2.8',
		'RINCIAN PENJELASAN LAPORAN PENGADAAN BMD BERUPA ASET TETAP',
		'INTRAKOMPTABEL',
		'KARENA PENAMBAHAN PENGADAAN BARANG KARENA ALASAN LAINNYA*',
		'semester',
		'1',
		'1',
		'1',
		'7','1','0',
		'<?=$IdL?>'); return false;">
			Format IV.A.1.2.8 - RINCIAN PENJELASAN LAPORAN PENGADAAN BMD BERUPA ASET TETAP
		</a>
	</td>
  </tr>

  <tr height="22">
    <td>&nbsp;</td>
    <td>
		<a href="#" class="ico docu" onClick="showDocNew('',
		'Format_IV_A_1_2_5',
		'Format.IV.A.1.2.9',
		'RINCIAN PENJELASAN LAPORAN PENGADAAN BMD BERUPA ASET TETAP',
		'INTRAKOMPTABEL',
		'KARENA PENGURANGAN PENGADAAN BARANG PADA REKENING BELANJA MODAL …….(1) KE JENIS LAINYA PADA ASET TETAP',
		'semester',
		'1',
		'1',
		'1',
		'7','1','0',
		'<?=$IdL?>'); return false;">
			Format IV.A.1.2.9 - RINCIAN PENJELASAN LAPORAN PENGADAAN BMD BERUPA ASET TETAP
		</a>
	</td>
  </tr>

  <tr height="22">
    <td>&nbsp;</td>
    <td>
		<a href="#" class="ico docu" onClick="showDocNew('',
		'Format_IV_A_1_2_5',
		'Format.IV.A.1.2.10',
		'RINCIAN PENJELASAN PENGURANGAN LAPORAN PENGADAAN BMD BERUPA ASET TETAP',
		'INTRAKOMPTABEL',
		'KARENA PENGURANGAN PENGADAAN BARANG PADA REKENING BELANJA MODAL ….(1) KE ASET TETAP EKSTRAKOMPTABEL',
		'semester',
		'1',
		'1',
		'1',
		'7','1','0',
		'<?=$IdL?>'); return false;">
			Format IV.A.1.2.10 - RINCIAN PENJELASAN PENGURANGAN LAPORAN PENGADAAN BMD BERUPA ASET TETAP
		</a>
	</td>
  </tr>

  <tr height="22">
    <td>&nbsp;</td>
    <td>
		<a href="#" class="ico docu" onClick="showDocNew('',
		'Format_IV_A_1_2_5',
		'Format.IV.A.1.2.11',
		'RINCIAN PENJELASAN PENGURANGAN LAPORAN PENGADAAN BMD BERUPA ASET TETAP',
		'INTRAKOMPTABEL',
		'PENGURANGAN PENGADAAN BARANG DARI REKENING BELANJA MODAL …….(1) KE ASET LANCAR BERUPA PERSEDIAAN',
		'semester',
		'1',
		'1',
		'1',
		'7','1','0',
		'<?=$IdL?>'); return false;">
			Format IV.A.1.2.11 - RINCIAN PENJELASAN PENGURANGAN LAPORAN PENGADAAN BMD BERUPA ASET TETAP
		</a>
	</td>
  </tr>

  <tr height="22">
    <td>&nbsp;</td>
    <td>
		<a href="#" class="ico docu" onClick="showDocNew('',
		'Format_IV_A_1_2_5',
		'Format.IV.A.1.2.12',
		'RINCIAN PENJELASAN PENGURANGAN LAPORAN PENGADAAN BMD BERUPA ASET TETAP',
		'INTRAKOMPTABEL',
		'PENGURANGAN PENGADAAN BARANG DARI REKENING BELANJA MODAL …….(1) KE ASET LAINNYA',
		'semester',
		'1',
		'1',
		'1',
		'7','1','0',
		'<?=$IdL?>'); return false;">
			Format IV.A.1.2.12 - RINCIAN PENJELASAN PENGURANGAN LAPORAN PENGADAAN BMD BERUPA ASET TETAP
		</a>
	</td>
  </tr>

  <tr height="22">
    <td>&nbsp;</td>
    <td>
		<a href="#" class="ico docu" onClick="showDocNew('',
		'Format_IV_A_1_2_5',
		'Format.IV.A.1.2.13',
		'RINCIAN PENJELASAN PENGURANGAN LAPORAN PENGADAAN BMD BERUPA ASET TETAP',
		'INTRAKOMPTABEL',
		'PENGURANGAN PENGADAAN BARANG DARI REKENING BELANJA MODAL….(1) KARENA ALASAN LAINNYA',
		'semester',
		'1',
		'1',
		'1',
		'7','1','0',
		'<?=$IdL?>'); return false;">
			Format IV.A.1.2.13 - RINCIAN PENJELASAN PENGURANGAN LAPORAN PENGADAAN BMD BERUPA ASET TETAP
		</a>
	</td>
  </tr>

  <tr height="22">
    <td>&nbsp;</td>
    <td>
		<a href="#" class="ico docu" onClick="showDocNew('',
		'Format_IV_A_1_2_14',
		'Format.IV.A.1.2.14',
		'REKAPITULASI RINCIAN PENJELASAN SELISIH ATAS PENAMBAHAN DAN PENGURANGAN PADA LAPORAN PENGADAAN BMD BERUPA ASET TETAP …. (1) MENURUT SUB RINCIAN OBJEK',
		'INTRAKOMPTABEL',
		'',
		'semester',
		'1',
		'1',
		'1',
		'6','1','0',
		'<?=$IdL?>'); return false;">
			Format IV.A.1.2.14 - REKAPITULASI RINCIAN PENJELASAN SELISIH ATAS PENAMBAHAN DAN PENGURANGAN PADA LAPORAN PENGADAAN BMD BERUPA ASET TETAP …. (1) MENURUT SUB RINCIAN OBJEK

		</a>
	</td>
  </tr>

  <tr height="22">
    <td>&nbsp;</td>
    <td>
		<a href="#" class="ico docu" onClick="showDocNew('',
		'Format_IV_A_1_2_14',
		'Format.IV.A.1.2.15',
		'REKAPITULASI RINCIAN PENJELASAN SELISIH ATAS PENAMBAHAN DAN PENGURANGAN PADA LAPORAN PENGADAAN BMD BERUPA ASET TETAP …. (1) MENURUT RINCIAN OBJEK',
		'INTRAKOMPTABEL',
		'',
		'semester',
		'1',
		'1',
		'1',
		'5','1','0',
		'<?=$IdL?>'); return false;">
			Format IV.A.1.2.15 - REKAPITULASI RINCIAN PENJELASAN SELISIH ATAS PENAMBAHAN DAN PENGURANGAN PADA LAPORAN PENGADAAN BMD BERUPA ASET TETAP …. (1) MENURUT RINCIAN OBJEK

		</a>
	</td>
  </tr>

  <tr height="22">
    <td>&nbsp;</td>
    <td>
		<a href="#" class="ico docu" onClick="showDocNew('',
		'Format_IV_A_1_2_16',
		'Format.IV.A.1.2.16',
		'REKAPITULASI PENGADAAN BMD BERUPA ASET TETAP MENURUT SUB RINCIAN OBJEK',
		'INTRAKOMPTABEL',
		'',
		'semester',
		'1',
		'0',
		'1',
		'6','1','0',
		'<?=$IdL?>'); return false;">
			Format IV.A.1.2.16 - REKAPITULASI PENGADAAN BMD BERUPA ASET TETAP MENURUT SUB RINCIAN OBJEK
		</a>
	</td>
  </tr>

  <tr height="22">
    <td>&nbsp;</td>
    <td>
		<a href="#" class="ico docu" onClick="showDocNew('',
		'Format_IV_A_1_2_16',
		'Format.IV.A.1.2.17',
		'REKAPITULASI PENGADAAN BMD BERUPA ASET TETAP MENURUT  RINCIAN OBJEK',
		'INTRAKOMPTABEL',
		'',
		'semester',
		'1',
		'0',
		'1',
		'5','1','0',
		'<?=$IdL?>'); return false;">
			Format IV.A.1.2.17 - REKAPITULASI PENGADAAN BMD BERUPA ASET TETAP MENURUT  RINCIAN OBJEK
		</a>
	</td>
  </tr>

  <tr height="22">
    <td>&nbsp;</td>
    <td>
		<a href="#" class="ico docu" onClick="showDocNew('',
		'Format_IV_A_1_2_16',
		'Format.IV.A.1.2.18',
		'REKAPITULASI PENGADAAN BMD BERUPA ASET TETAP MENURUT  OBJEK',
		'INTRAKOMPTABEL',
		'',
		'semester',
		'1',
		'0',
		'1',
		'4','1','0',
		'<?=$IdL?>'); return false;">
			Format IV.A.1.2.18 - REKAPITULASI PENGADAAN BMD BERUPA ASET TETAP MENURUT  OBJEK
		</a>
	</td>
  </tr>

  <tr height="22">
    <td>&nbsp;</td>
    <td>
		<a href="#" class="ico docu" onClick="showDocNew('',
		'Format_IV_A_1_2_16',
		'Format.IV.A.1.2.19',
		'REKAPITULASI PENGADAAN BMD BERUPA ASET TETAP MENURUT  JENIS',
		'INTRAKOMPTABEL',
		'',
		'semester',
		'1','0','1','3','1','0',
		'<?=$IdL?>'); return false;">
			Format IV.A.1.2.19 - REKAPITULASI PENGADAAN BMD BERUPA ASET TETAP MENURUT  JENIS
		</a>
	</td>
  </tr>

  <tr height="22">
    <td>&nbsp;</td>
    <td>
		<a href="#" class="ico docu" onClick="showDocNew('',
		'Format_IV_A_1_2_16',
		'Format.IV.A.1.2.20',
		'LAPORAN PENGADAAN BMD BERUPA ASET TETAP MENURUT SUB RINCIAN OBJEK',
		'INTRAKOMPTABEL',
		'',
		'semester',
		'0','0','0','6','0','1',
		'<?=$IdL?>'			
		); return false;">
			Format IV.A.1.2.20 - LAPORAN PENGADAAN BMD BERUPA ASET TETAP MENURUT SUB RINCIAN OBJEK
		</a>
	</td>
  </tr>

  <tr height="22">
    <td>&nbsp;</td>
    <td>
		<a href="#" class="ico docu" onClick="showDocNew('',
		'Format_IV_A_1_2_16',
		'Format.IV.A.1.2.21',
		'REKAPITULASI PENGADAAN BMD BERUPA ASET TETAP MENURUT RINCIAN OBJEK',
		'INTRAKOMPTABEL',
		'',
		'semester',
		'0','0','0','5','0','1',
		'<?=$IdL?>'			
		); return false;">
			Format IV.A.1.2.21 - REKAPITULASI PENGADAAN BMD BERUPA ASET TETAP MENURUT RINCIAN OBJEK
		</a>
	</td>
  </tr>

  <tr height="22">
    <td>&nbsp;</td>
    <td>
		<a href="#" class="ico docu" onClick="showDocNew('',
		'Format_IV_A_1_2_16',
		'Format.IV.A.1.2.22',
		'REKAPITULASI PENGADAAN BMD BERUPA ASET TETAP MENURUT OBJEK',
		'INTRAKOMPTABEL',
		'',
		'semester',
		'0','0','0','4','0','1',
		'<?=$IdL?>'			
		); return false;">
			Format IV.A.1.2.22 - REKAPITULASI PENGADAAN BMD BERUPA ASET TETAP MENURUT OBJEK
		</a>
	</td>
  </tr>

  <tr height="22">
    <td>&nbsp;</td>
    <td>
		<a href="#" class="ico docu" onClick="showDocNew('',
		'Format_IV_A_1_2_14',
		'Format.IV.A.1.2.24',
		'REKAPITULASI RINCIAN PENJELASAN SELISIH ATAS PENAMBAHAN DAN PENGURANGAN PADA LAPORAN PENGADAAN BMD BERUPA ASET TETAP …. (1) MENURUT RINCIAN OBJEK',
		'INTRAKOMPTABEL',
		'',
		'semester',
		'0','0','1','5','0','1',
		'<?=$IdL?>'); return false;">
			Format IV.A.1.2.24 - REKAPITULASI RINCIAN PENJELASAN SELISIH ATAS PENAMBAHAN DAN PENGURANGAN PADA LAPORAN PENGADAAN BMD BERUPA ASET TETAP …. (1) MENURUT RINCIAN OBJEK

		</a>
	</td>
  </tr>

  <tr height="22">
    <td>&nbsp;</td>
    <td>
		<a href="#" class="ico docu" onClick="showDocNew('',
		'Format_IV_A_1_2_14',
		'Format.IV.A.1.2.25',
		'REKAPITULASI RINCIAN PENJELASAN SELISIH ATAS PENAMBAHAN DAN PENGURANGAN PADA LAPORAN PENGADAAN BMD BERUPA ASET TETAP …. (1) MENURUT  OBJEK',
		'INTRAKOMPTABEL',
		'',
		'semester',
		'0','0','1','4','0','1',
		'<?=$IdL?>'); return false;">
			Format IV.A.1.2.25 - REKAPITULASI RINCIAN PENJELASAN SELISIH ATAS PENAMBAHAN DAN PENGURANGAN PADA LAPORAN PENGADAAN BMD BERUPA ASET TETAP …. (1) MENURUT  OBJEK

		</a>
	</td>
  </tr>

  <tr height="22">
    <td>&nbsp;</td>
    <td>
		<a href="#" class="ico docu" onClick="showDocNew('',
		'Format_IV_A_1_2_14',
		'Format.IV.A.1.2.26',
		'REKAPITULASI RINCIAN PENJELASAN SELISIH ATAS PENAMBAHAN DAN PENGURANGAN PADA LAPORAN PENGADAAN BMD BERUPA ASET TETAP …. (1) MENURUT  JENIS',
		'INTRAKOMPTABEL',
		'',
		'semester',
		'0','0','1','3','0','1',
		'<?=$IdL?>'); return false;">
			Format IV.A.1.2.26 - REKAPITULASI RINCIAN PENJELASAN SELISIH ATAS PENAMBAHAN DAN PENGURANGAN PADA LAPORAN PENGADAAN BMD BERUPA ASET TETAP …. (1) MENURUT  JENIS

		</a>
	</td>
  </tr>

  <tr height="22">
    <td>&nbsp;</td>
    <td></td>
  </tr>
  <tr height="22">
    <td>&nbsp;</td>
    <td><u>Format IV.A.1.3</u></td>
  </tr>

  
  <tr height="22">
    <td>&nbsp;</td>
    <td>		
	<a href="#" class="ico docu" onClick="showDocNew('',
			'Format_IV_A_1_2_1',
			'Format.IV.A.1.3.1',
			'LAPORAN PENGADAAN BMD BERUPA ASET LAINNYA',
			'EKSTRAKOMPTABEL',
			'',
			'bulan',
			'1',
			'1',
			'1',
			'7','1','0',
			'<?=$IdL?>'); return false;">
			Format IV.A.1.3.1 - LAPORAN PENGADAAN BMD BERUPA ASET LAINNYA

		</a>
	</td>
  </tr>

  <tr height="22">
    <td>&nbsp;</td>
    <td>		
	<a href="#" class="ico docu" onClick="showDocNew('',
			'Format_IV_A_1_2_1',
			'Format.IV.A.1.3.2',
			'LAPORAN PENGADAAN BMD BERUPA ASET LAINNYA',
			'EKSTRAKOMPTABEL',
			'',
			'semester',
			'1',
			'1',
			'1',
			'7','1','0',
			'<?=$IdL?>'); return false;">
			Format IV.A.1.3.2 - LAPORAN PENGADAAN BMD BERUPA ASET LAINNYA

		</a>
	</td>
  </tr>

  <tr height="22">
    <td>&nbsp;</td>
    <td>		
	<a href="#" class="ico docu" onClick="showDocNew('',
			'Format_IV_A_1_3_3',
			'Format.IV.A.1.3.3',
			'REKAPITULASI PENGADAAN BMD BERUPA ASET LAINNYA MENURUT SUB RINCIAN OBJEK',
			'EKSTRAKOMPTABEL',
			'',
			'semester',
			'1','0','1','6','1','0',
			'<?=$IdL?>'); return false;">
			Format IV.A.1.3.3 - REKAPITULASI PENGADAAN BMD BERUPA ASET LAINNYA MENURUT SUB RINCIAN OBJEK

		</a>
	</td>
  </tr>

  <tr height="22">
    <td>&nbsp;</td>
    <td>		
	<a href="#" class="ico docu" onClick="showDocNew('',
			'Format_IV_A_1_3_3',
			'Format.IV.A.1.3.4',
			'REKAPITULASI PENGADAAN BMD BERUPA ASET LAINNYA MENURUT  RINCIAN OBJEK',
			'EKSTRAKOMPTABEL',
			'',
			'semester',
			'1','0','1','5','1','0',
			'<?=$IdL?>'); return false;">
			Format IV.A.1.3.4 - REKAPITULASI PENGADAAN BMD BERUPA ASET LAINNYA MENURUT  RINCIAN OBJEK

		</a>
	</td>
  </tr>

  <tr height="22">
    <td>&nbsp;</td>
    <td>		
	<a href="#" class="ico docu" onClick="showDocNew('',
			'Format_IV_A_1_3_3',
			'Format.IV.A.1.3.5',
			'REKAPITULASI PENGADAAN BMD BERUPA ASET LAINNYA MENURUT   OBJEK',
			'EKSTRAKOMPTABEL',
			'',
			'semester',
			'1','0','1','4','1','0',
			'<?=$IdL?>'); return false;">
			Format IV.A.1.3.5 - REKAPITULASI PENGADAAN BMD BERUPA ASET LAINNYA MENURUT   OBJEK

		</a>
	</td>
  </tr>

  <tr height="22">
    <td>&nbsp;</td>
    <td>		
	<a href="#" class="ico docu" onClick="showDocNew('',
			'Format_IV_A_1_3_3',
			'Format.IV.A.1.3.6',
			'REKAPITULASI PENGADAAN BMD BERUPA ASET LAINNYA MENURUT   JENIS',
			'EKSTRAKOMPTABEL',
			'',
			'semester',
			'1','0','1','3','1','0',
			'<?=$IdL?>'); return false;">
			Format IV.A.1.3.6 - REKAPITULASI PENGADAAN BMD BERUPA ASET LAINNYA MENURUT   JENIS

		</a>
	</td>
  </tr>

  <tr height="22">
    <td>&nbsp;</td>
    <td>		
	<a href="#" class="ico docu" onClick="showDocNew('',
			'Format_IV_A_1_3_7',
			'Format.IV.A.1.3.7',
			'LAPORAN PENGADAAN BMD BERUPA ASET LAINNYA MENURUT   SUB RINCIAN OBJEK',
			'EKSTRAKOMPTABEL',
			'',
			'semester',
			'0','0','1','6','0','1',
			'<?=$IdL?>'); return false;">
			Format IV.A.1.3.7 - LAPORAN PENGADAAN BMD BERUPA ASET LAINNYA MENURUT   SUB RINCIAN OBJEK

		</a>
	</td>
  </tr>

  <tr height="22">
    <td>&nbsp;</td>
    <td>		
	<a href="#" class="ico docu" onClick="showDocNew('',
			'Format_IV_A_1_3_7',
			'Format.IV.A.1.3.8',
			'LAPORAN PENGADAAN BMD BERUPA ASET LAINNYA MENURUT   RINCIAN OBJEK',
			'EKSTRAKOMPTABEL',
			'',
			'semester',
			'0','0','1','5','0','1',
			'<?=$IdL?>'); return false;">
			Format IV.A.1.3.8 - LAPORAN PENGADAAN BMD BERUPA ASET LAINNYA MENURUT   RINCIAN OBJEK

		</a>
	</td>
  </tr>

  <tr height="22">
    <td>&nbsp;</td>
    <td>		
	<a href="#" class="ico docu" onClick="showDocNew('',
			'Format_IV_A_1_3_7',
			'Format.IV.A.1.3.9',
			'LAPORAN PENGADAAN BMD BERUPA ASET LAINNYA MENURUT    OBJEK',
			'EKSTRAKOMPTABEL',
			'',
			'semester',
			'0','0','1','4','0','1',
			'<?=$IdL?>'); return false;">
			Format IV.A.1.3.9 - LAPORAN PENGADAAN BMD BERUPA ASET LAINNYA MENURUT    OBJEK

		</a>
	</td>
  </tr>

  <tr height="22">
    <td>&nbsp;</td>
    <td>		
	<a href="#" class="ico docu" onClick="showDocNew('',
			'Format_IV_A_1_3_7',
			'Format.IV.A.1.3.10',
			'LAPORAN PENGADAAN BMD BERUPA ASET LAINNYA MENURUT    JENIS',
			'EKSTRAKOMPTABEL',
			'',
			'semester',
			'0','0','1','3','0','1',
			'<?=$IdL?>'); return false;">
			Format IV.A.1.3.10 - LAPORAN PENGADAAN BMD BERUPA ASET LAINNYA MENURUT    JENIS

		</a>
	</td>
  </tr>

  <tr height="22">
    <td>&nbsp;</td>
    <td></td>
  </tr>
  <tr height="22">
    <td>&nbsp;</td>
    <td><u>Format IV.A.2</u></td>
  </tr>

  <tr height="22">
    <td>&nbsp;</td>
    <td>		
	<a href="#" class="ico docu" onClick="showDocNew('',
			'Format_IV_A_2_1',
			'Format.IV.A.2.1',
			'LAPORAN PEROLEHAN/PENERIMAAN BMD DARI HIBAH/SUMBANGAN ATAU YANG SEJENIS BERUPA……. (1)',
			'EKSTRAKOMPTABEL',
			'',
			'bulan',
			'1','1','1','7','1','0',
			'<?=$IdL?>'); return false;">
			Format IV.A.2.1 - LAPORAN PEROLEHAN/PENERIMAAN BMD DARI HIBAH/SUMBANGAN ATAU YANG SEJENIS BERUPA……. (1)

		</a>
	</td>
  </tr>

  <tr height="22">
    <td>&nbsp;</td>
    <td>		
	<a href="#" class="ico docu" onClick="showDocNew('',
			'Format_IV_A_2_1',
			'Format.IV.A.2.2',
			'LAPORAN PEROLEHAN/PENERIMAAN BMD DARI HIBAH/SUMBANGAN ATAU YANG SEJENIS BERUPA……. (1)',
			'EKSTRAKOMPTABEL',
			'',
			'semester',
			'1','1','1','7','1','0',
			'<?=$IdL?>'); return false;">
			Format IV.A.2.2 - LAPORAN PEROLEHAN/PENERIMAAN BMD DARI HIBAH/SUMBANGAN ATAU YANG SEJENIS BERUPA……. (1)

		</a>
	</td>
  </tr>

  <tr height="22">
    <td>&nbsp;</td>
    <td>		
	<a href="#" class="ico docu" onClick="showDocNew('',
			'Format_IV_A_1_3_7',
			'Format.IV.A.2.3',
			'REKAPITULASI PEROLEHAN/PENERIMAAN BMD DARI HIBAH/SUMBANGAN ATAU YANG SEJENIS BERUPA……..(1) MENURUT SUB RINCIAN OBJEK',
			'EKSTRAKOMPTABEL',
			'',
			'semester',
			'1','1','1','6','1','0',
			'<?=$IdL?>'); return false;">
			Format IV.A.2.3 - REKAPITULASI PEROLEHAN/PENERIMAAN BMD DARI HIBAH/SUMBANGAN ATAU YANG SEJENIS BERUPA……..(1)
			MENURUT SUB RINCIAN OBJEK

		</a>
	</td>
  </tr>

  <tr height="22">
    <td>&nbsp;</td>
    <td>		
	<a href="#" class="ico docu" onClick="showDocNew('',
			'Format_IV_A_1_3_7',
			'Format.IV.A.2.4',
			'REKAPITULASI PEROLEHAN/PENERIMAAN BMD DARI HIBAH/SUMBANGAN ATAU YANG SEJENIS BERUPA……..(1) MENURUT  RINCIAN OBJEK',
			'EKSTRAKOMPTABEL',
			'',
			'semester',
			'1','1','1','5','1','0',
			'<?=$IdL?>'); return false;">
			Format IV.A.2.4 - REKAPITULASI PEROLEHAN/PENERIMAAN BMD DARI HIBAH/SUMBANGAN ATAU YANG SEJENIS BERUPA……..(1)
			MENURUT  RINCIAN OBJEK

		</a>
	</td>
  </tr>

  <tr height="22">
    <td>&nbsp;</td>
    <td>		
	<a href="#" class="ico docu" onClick="showDocNew('',
			'Format_IV_A_1_3_7',
			'Format.IV.A.2.5',
			'REKAPITULASI PEROLEHAN/PENERIMAAN BMD DARI HIBAH/SUMBANGAN ATAU YANG SEJENIS BERUPA……..(1) MENURUT   OBJEK',
			'EKSTRAKOMPTABEL',
			'',
			'semester',
			'1','1','1','4','1','0',
			'<?=$IdL?>'); return false;">
			Format IV.A.2.5 - REKAPITULASI PEROLEHAN/PENERIMAAN BMD DARI HIBAH/SUMBANGAN ATAU YANG SEJENIS BERUPA……..(1)
			MENURUT  OBJEK

		</a>
	</td>
  </tr>

  <tr height="22">
    <td>&nbsp;</td>
    <td>		
	<a href="#" class="ico docu" onClick="showDocNew('',
			'Format_IV_A_1_3_7',
			'Format.IV.A.2.6',
			'REKAPITULASI PEROLEHAN/PENERIMAAN BMD DARI HIBAH/SUMBANGAN ATAU YANG SEJENIS BERUPA……..(1) MENURUT   JENIS',
			'EKSTRAKOMPTABEL',
			'',
			'semester',
			'1','1','1','3','1','0',
			'<?=$IdL?>'); return false;">
			Format IV.A.2.6 - REKAPITULASI PEROLEHAN/PENERIMAAN BMD DARI HIBAH/SUMBANGAN ATAU YANG SEJENIS BERUPA……..(1)
			MENURUT  JENIS

		</a>
	</td>
  </tr>

  <tr height="22">
    <td>&nbsp;</td>
    <td>		
	<a href="#" class="ico docu" onClick="showDocNew('',
			'Format_IV_A_1_3_7',
			'Format.IV.A.2.7',
			'LAPORAN PEROLEHAN/PENERIMAAN BMD DARI HIBAH/SUMBANGAN ATAU YANG SEJENIS BERUPA……. (1) MENURUT SUB RINCIAN OBJEK',
			'EKSTRAKOMPTABEL',
			'',
			'semester',
			'0','0','1','6','1','1',
			'<?=$IdL?>'); return false;">
			Format IV.A.2.7 - LAPORAN PEROLEHAN/PENERIMAAN BMD DARI HIBAH/SUMBANGAN ATAU YANG SEJENIS BERUPA……. (1)
			MENURUT SUB RINCIAN OBJEK

		</a>
	</td>
  </tr>

  <tr height="22">
    <td>&nbsp;</td>
    <td>		
	<a href="#" class="ico docu" onClick="showDocNew('',
			'Format_IV_A_1_3_7',
			'Format.IV.A.2.8',
			'LAPORAN PEROLEHAN/PENERIMAAN BMD DARI HIBAH/SUMBANGAN ATAU YANG SEJENIS BERUPA……. (1) MENURUT  RINCIAN OBJEK',
			'EKSTRAKOMPTABEL',
			'',
			'semester',
			'0','0','1','5','1','1',
			'<?=$IdL?>'); return false;">
			Format IV.A.2.8 - LAPORAN PEROLEHAN/PENERIMAAN BMD DARI HIBAH/SUMBANGAN ATAU YANG SEJENIS BERUPA……. (1)
			MENURUT  RINCIAN OBJEK

		</a>
	</td>
  </tr>

  <tr height="22">
    <td>&nbsp;</td>
    <td>		
	<a href="#" class="ico docu" onClick="showDocNew('',
			'Format_IV_A_1_3_7',
			'Format.IV.A.2.9',
			'LAPORAN PEROLEHAN/PENERIMAAN BMD DARI HIBAH/SUMBANGAN ATAU YANG SEJENIS BERUPA……. (1) MENURUT   OBJEK',
			'EKSTRAKOMPTABEL',
			'',
			'semester',
			'0','0','1','4','1','1',
			'<?=$IdL?>'); return false;">
			Format IV.A.2.9 - LAPORAN PEROLEHAN/PENERIMAAN BMD DARI HIBAH/SUMBANGAN ATAU YANG SEJENIS BERUPA……. (1)
			MENURUT   OBJEK

		</a>
	</td>
  </tr>

  <tr height="22">
    <td>&nbsp;</td>
    <td>		
	<a href="#" class="ico docu" onClick="showDocNew('',
			'Format_IV_A_1_3_7',
			'Format.IV.A.2.10',
			'LAPORAN PEROLEHAN/PENERIMAAN BMD DARI HIBAH/SUMBANGAN ATAU YANG SEJENIS BERUPA……. (1) MENURUT  JENIS',
			'EKSTRAKOMPTABEL',
			'',
			'semester',
			'0','0','1','3','1','1',
			'<?=$IdL?>'); return false;">
			Format IV.A.2.10 - LAPORAN PEROLEHAN/PENERIMAAN BMD DARI HIBAH/SUMBANGAN ATAU YANG SEJENIS BERUPA……. (1)
			MENURUT  JENIS

		</a>
	</td>
  </tr>

  <tr height="22">
    <td>&nbsp;</td>
    <td></td>
  </tr>

  <tr height="22">
    <td>&nbsp;</td>
    <td><u>Format IV.A.3</u></td>
  </tr>

  <tr height="22">
    <td>&nbsp;</td>
    <td>		
	<a href="#" class="ico docu" onClick="showDocNew('',
			'Format_IV_A_3_1',
			'Format.IV.A.3.1',
			'LAPORAN PEROLEHAN/PENERIMAAN BMD DARI PELAKSANAAN PERJANJIAN/KONTRAK BERUPA …..(1) - BULAN',
			'EKSTRAKOMPTABEL',
			'',
			'bulan',
			'1','1','1','7','1','0',
			'<?=$IdL?>'); return false;">
			Format IV.A.3.1 - LAPORAN PEROLEHAN/PENERIMAAN BMD DARI PELAKSANAAN PERJANJIAN/KONTRAK BERUPA …..(1) - BULAN
		</a>
	</td>
  </tr>

  <tr height="22">
    <td>&nbsp;</td>
    <td>		
	<a href="#" class="ico docu" onClick="showDocNew('',
			'Format_IV_A_3_1',
			'Format.IV.A.3.2',
			'LAPORAN PEROLEHAN/PENERIMAAN BMD DARI PELAKSANAAN PERJANJIAN/KONTRAK BERUPA …..(1) - SEMESTER',
			'EKSTRAKOMPTABEL',
			'',
			'semester',
			'1','1','1','7','1','0',
			'<?=$IdL?>'); return false;">
			Format IV.A.3.2 - LAPORAN PEROLEHAN/PENERIMAAN BMD DARI PELAKSANAAN PERJANJIAN/KONTRAK BERUPA …..(1) - SEMESTER
		</a>
	</td>
  </tr>

  <tr height="22">
    <td>&nbsp;</td>
    <td>		
	<a href="#" class="ico docu" onClick="showDocNew('',
			'Format_IV_A_1_3_7',
			'Format.IV.A.3.3',
			'REKAPITULASI PEROLEHAN/PENERIMAAN BMD DARI PELAKSANAAN PERJANJIAN/KONTRAK BERUPA….(1) MENURUT SUB RINCIAN OBJEK',
			'EKSTRAKOMPTABEL',
			'',
			'semester',
			'1','1','1','6','1','0',
			'<?=$IdL?>'); return false;">
			Format IV.A.3.3 - REKAPITULASI PEROLEHAN/PENERIMAAN BMD DARI PELAKSANAAN PERJANJIAN/KONTRAK BERUPA….(1) MENURUT SUB RINCIAN OBJEK		

		</a>
	</td>
  </tr>

  <tr height="22">
    <td>&nbsp;</td>
    <td>		
	<a href="#" class="ico docu" onClick="showDocNew('',
			'Format_IV_A_1_3_7',
			'Format.IV.A.3.4',
			'REKAPITULASI PEROLEHAN/PENERIMAAN BMD DARI PELAKSANAAN PERJANJIAN/KONTRAK BERUPA….(1) MENURUT  RINCIAN OBJEK',
			'EKSTRAKOMPTABEL',
			'',
			'semester',
			'1','1','1','5','1','0',
			'<?=$IdL?>'); return false;">
			Format IV.A.3.4 - REKAPITULASI PEROLEHAN/PENERIMAAN BMD DARI PELAKSANAAN PERJANJIAN/KONTRAK BERUPA….(1) MENURUT  RINCIAN OBJEK		

		</a>
	</td>
  </tr>

  <tr height="22">
    <td>&nbsp;</td>
    <td>		
	<a href="#" class="ico docu" onClick="showDocNew('',
			'Format_IV_A_1_3_7',
			'Format.IV.A.3.5',
			'REKAPITULASI PEROLEHAN/PENERIMAAN BMD DARI PELAKSANAAN PERJANJIAN/KONTRAK BERUPA….(1) MENURUT   OBJEK',
			'EKSTRAKOMPTABEL',
			'',
			'semester',
			'1','1','1','4','1','0',
			'<?=$IdL?>'); return false;">
			Format IV.A.3.5 - REKAPITULASI PEROLEHAN/PENERIMAAN BMD DARI PELAKSANAAN PERJANJIAN/KONTRAK BERUPA….(1) MENURUT   OBJEK		

		</a>
	</td>
  </tr>

  <tr height="22">
    <td>&nbsp;</td>
    <td>		
	<a href="#" class="ico docu" onClick="showDocNew('',
			'Format_IV_A_1_3_7',
			'Format.IV.A.3.6',
			'REKAPITULASI PEROLEHAN/PENERIMAAN BMD DARI PELAKSANAAN PERJANJIAN/KONTRAK BERUPA….(1) MENURUT   JENIS',
			'EKSTRAKOMPTABEL',
			'',
			'semester',
			'1','1','1','3','1','0',
			'<?=$IdL?>'); return false;">
			Format IV.A.3.6 - REKAPITULASI PEROLEHAN/PENERIMAAN BMD DARI PELAKSANAAN PERJANJIAN/KONTRAK BERUPA….(1) MENURUT   JENIS		

		</a>
	</td>
  </tr>

  <tr height="22">
    <td>&nbsp;</td>
    <td>		
	<a href="#" class="ico docu" onClick="showDocNew('',
			'Format_IV_A_1_3_7',
			'Format.IV.A.3.7',
			'LAPORAN PEROLEHAN/PENERIMAAN BMD DARI PELAKSANAAN PERJANJIAN/KONTRAK BERUPA...(1) (6) MENURUT SUB RINCIAN OBJEK',
			'EKSTRAKOMPTABEL',
			'',
			'semester',
			'0','0','1','6','0','1',
			'<?=$IdL?>'); return false;">
			Format IV.A.3.7 - LAPORAN PEROLEHAN/PENERIMAAN BMD DARI PELAKSANAAN PERJANJIAN/KONTRAK BERUPA...(1) (6) MENURUT SUB RINCIAN OBJEK		

		</a>
	</td>
  </tr>

  <tr height="22">
    <td>&nbsp;</td>
    <td>		
	<a href="#" class="ico docu" onClick="showDocNew('',
			'Format_IV_A_1_3_7',
			'Format.IV.A.3.8',
			'LAPORAN PEROLEHAN/PENERIMAAN BMD DARI PELAKSANAAN PERJANJIAN/KONTRAK BERUPA...(1) (6) MENURUT  RINCIAN OBJEK',
			'EKSTRAKOMPTABEL',
			'',
			'semester',
			'0','0','1','5','0','1',
			'<?=$IdL?>'); return false;">
			Format IV.A.3.8 - LAPORAN PEROLEHAN/PENERIMAAN BMD DARI PELAKSANAAN PERJANJIAN/KONTRAK BERUPA...(1) (6) MENURUT  RINCIAN OBJEK		

		</a>
	</td>
  </tr>

  <tr height="22">
    <td>&nbsp;</td>
    <td>		
	<a href="#" class="ico docu" onClick="showDocNew('',
			'Format_IV_A_1_3_7',
			'Format.IV.A.3.9',
			'LAPORAN PEROLEHAN/PENERIMAAN BMD DARI PELAKSANAAN PERJANJIAN/KONTRAK BERUPA...(1) (6) MENURUT   OBJEK',
			'EKSTRAKOMPTABEL',
			'',
			'semester',
			'0','0','1','4','0','1',
			'<?=$IdL?>'); return false;">
			Format IV.A.3.9 - LAPORAN PEROLEHAN/PENERIMAAN BMD DARI PELAKSANAAN PERJANJIAN/KONTRAK BERUPA...(1) (6) MENURUT  OBJEK		

		</a>
	</td>
  </tr>

  <tr height="22">
    <td>&nbsp;</td>
    <td>		
	<a href="#" class="ico docu" onClick="showDocNew('',
			'Format_IV_A_1_3_7',
			'Format.IV.A.3.10',
			'LAPORAN PEROLEHAN/PENERIMAAN BMD DARI PELAKSANAAN PERJANJIAN/KONTRAK BERUPA...(1) (6) MENURUT   JENIS',
			'EKSTRAKOMPTABEL',
			'',
			'semester',
			'0','0','1','3','0','1',
			'<?=$IdL?>'); return false;">
			Format IV.A.3.10 - LAPORAN PEROLEHAN/PENERIMAAN BMD DARI PELAKSANAAN PERJANJIAN/KONTRAK BERUPA...(1) (6) MENURUT  JENIS		

		</a>
	</td>
  </tr>

  <tr height="22">
    <td>&nbsp;</td>
    <td></td>
  </tr>

  <tr height="22">
    <td>&nbsp;</td>
    <td><u>Format IV.A.4</u></td>
  </tr>

  <tr height="22">
    <td>&nbsp;</td>
    <td>		
	<a href="#" class="ico docu" onClick="showDocNew('',
			'Format_IV_A_3_1',
			'Format.IV.A.4.1',
			'LAPORAN PEROLEHAN/PENERIMAAN BMD DARI KETENTUAN PERUNDANG-UNDANGAN BERUPA …..(1) - BULAN',
			'EKSTRAKOMPTABEL',
			'',
			'bulan',
			'1','1','1','7','1','0',
			'<?=$IdL?>'); return false;">
			Format IV.A.4.1 - LAPORAN PEROLEHAN/PENERIMAAN BMD DARI KETENTUAN PERUNDANG-UNDANGAN BERUPA …..(1) - BULAN
		</a>
	</td>
  </tr>

  <tr height="22">
    <td>&nbsp;</td>
    <td>		
	<a href="#" class="ico docu" onClick="showDocNew('',
			'Format_IV_A_3_1',
			'Format.IV.A.4.2',
			'LAPORAN PEROLEHAN/PENERIMAAN BMD DARI KETENTUAN PERUNDANG-UNDANGAN BERUPA …..(1) - SEMESTER',
			'EKSTRAKOMPTABEL',
			'',
			'semester',
			'1','1','1','7','1','0',
			'<?=$IdL?>'); return false;">
			Format IV.A.4.2 - LAPORAN PEROLEHAN/PENERIMAAN BMD DARI KETENTUAN PERUNDANG-UNDANGAN BERUPA …..(1) - SEMESTER
		</a>
	</td>
  </tr>

  <tr height="22">
    <td>&nbsp;</td>
    <td>		
	<a href="#" class="ico docu" onClick="showDocNew('',
			'Format_IV_A_1_3_7',
			'Format.IV.A.4.3',
			'REKAPITULASI PEROLEHAN/PENERIMAAN BMD DARI KETENTUAN PERUNDANG-UNDANGAN BERUPA...(1) <br>MENURUT SUB RINCIAN OBJEK',
			'EKSTRAKOMPTABEL',
			'',
			'semester',
			'1','1','1','6','1','0',
			'<?=$IdL?>'); return false;">
			Format IV.A.4.3 - REKAPITULASI PEROLEHAN/PENERIMAAN BMD DARI KETENTUAN PERUNDANG-UNDANGAN BERUPA...(1) MENURUT SUB RINCIAN OBJEK		

		</a>
	</td>
  </tr>

  <tr height="22">
    <td>&nbsp;</td>
    <td>		
	<a href="#" class="ico docu" onClick="showDocNew('',
			'Format_IV_A_1_3_7',
			'Format.IV.A.4.4',
			'REKAPITULASI PEROLEHAN/PENERIMAAN BMD DARI KETENTUAN PERUNDANG-UNDANGAN BERUPA...(1) <br>MENURUT  RINCIAN OBJEK',
			'EKSTRAKOMPTABEL',
			'',
			'semester',
			'1','1','1','5','1','0',
			'<?=$IdL?>'); return false;">
			Format IV.A.4.4 - REKAPITULASI PEROLEHAN/PENERIMAAN BMD DARI KETENTUAN PERUNDANG-UNDANGAN BERUPA...(1) MENURUT  RINCIAN OBJEK		

		</a>
	</td>
  </tr>

  <tr height="22">
    <td>&nbsp;</td>
    <td>		
	<a href="#" class="ico docu" onClick="showDocNew('',
			'Format_IV_A_1_3_7',
			'Format.IV.A.4.5',
			'REKAPITULASI PEROLEHAN/PENERIMAAN BMD DARI KETENTUAN PERUNDANG-UNDANGAN BERUPA...(1) <br>MENURUT   OBJEK',
			'EKSTRAKOMPTABEL',
			'',
			'semester',
			'1','1','1','4','1','0',
			'<?=$IdL?>'); return false;">
			Format IV.A.4.5 - REKAPITULASI PEROLEHAN/PENERIMAAN BMD DARI KETENTUAN PERUNDANG-UNDANGAN BERUPA...(1) MENURUT   OBJEK		

		</a>
	</td>
  </tr>

  <tr height="22">
    <td>&nbsp;</td>
    <td>		
	<a href="#" class="ico docu" onClick="showDocNew('',
			'Format_IV_A_1_3_7',
			'Format.IV.A.4.6',
			'REKAPITULASI PEROLEHAN/PENERIMAAN BMD DARI KETENTUAN PERUNDANG-UNDANGAN BERUPA...(1) <br>MENURUT JENIS',
			'EKSTRAKOMPTABEL',
			'',
			'semester',
			'1','1','1','3','1','0',
			'<?=$IdL?>'); return false;">
			Format IV.A.4.6 - REKAPITULASI PEROLEHAN/PENERIMAAN BMD DARI KETENTUAN PERUNDANG-UNDANGAN BERUPA...(1) MENURUT JENIS		

		</a>
	</td>
  </tr>

  <tr height="22">
    <td>&nbsp;</td>
    <td>		
	<a href="#" class="ico docu" onClick="showDocNew('',
			'Format_IV_A_1_3_7',
			'Format.IV.A.4.7',
			'REKAPITULASI PEROLEHAN/PENERIMAAN BMD DARI KETENTUAN PERUNDANG-UNDANGAN BERUPA...(1) <br>MENURUT SUB RINCIAN OBJEK',
			'EKSTRAKOMPTABEL',
			'',
			'semester',
			'0','0','1','6','0','1',
			'<?=$IdL?>'); return false;">
			Format IV.A.4.7 - REKAPITULASI PEROLEHAN/PENERIMAAN BMD DARI KETENTUAN PERUNDANG-UNDANGAN BERUPA...(1) MENURUT SUB RINCIAN OBJEK		

		</a>
	</td>
  </tr>
  <tr height="22">
    <td>&nbsp;</td>
    <td>		
	<a href="#" class="ico docu" onClick="showDocNew('',
			'Format_IV_A_1_3_7',
			'Format.IV.A.4.8',
			'REKAPITULASI PEROLEHAN/PENERIMAAN BMD DARI KETENTUAN PERUNDANG-UNDANGAN BERUPA...(1) <br>MENURUT  RINCIAN OBJEK',
			'EKSTRAKOMPTABEL',
			'',
			'semester',
			'0','0','1','5','0','1',
			'<?=$IdL?>'); return false;">
			Format IV.A.4.8 - REKAPITULASI PEROLEHAN/PENERIMAAN BMD DARI KETENTUAN PERUNDANG-UNDANGAN BERUPA...(1)  MENURUT RINCIAN OBJEK		

		</a>
	</td>
  </tr>

  <tr height="22">
    <td>&nbsp;</td>
    <td>		
	<a href="#" class="ico docu" onClick="showDocNew('',
			'Format_IV_A_1_3_7',
			'Format.IV.A.4.9',
			'REKAPITULASI PEROLEHAN/PENERIMAAN BMD DARI KETENTUAN PERUNDANG-UNDANGAN BERUPA...(1) MENURUT   OBJEK',
			'EKSTRAKOMPTABEL',
			'',
			'semester',
			'0','0','1','4','0','1',
			'<?=$IdL?>'); return false;">
			Format IV.A.4.9 - REKAPITULASI PEROLEHAN/PENERIMAAN BMD DARI KETENTUAN PERUNDANG-UNDANGAN BERUPA...(1)  MENURUT OBJEK		

		</a>
	</td>
  </tr>

  <tr height="22">
    <td>&nbsp;</td>
    <td>		
	<a href="#" class="ico docu" onClick="showDocNew('',
			'Format_IV_A_1_3_7',
			'Format.IV.A.4.10',
			'REKAPITULASI PEROLEHAN/PENERIMAAN BMD DARI KETENTUAN PERUNDANG-UNDANGAN BERUPA...(1) MENURUT   JENIS',
			'EKSTRAKOMPTABEL',
			'',
			'semester',
			'0','0','1','3','0','1',
			'<?=$IdL?>'); return false;">
			Format IV.A.4.10 - REKAPITULASI PEROLEHAN/PENERIMAAN BMD DARI KETENTUAN PERUNDANG-UNDANGAN BERUPA...(1)  MENURUT JENIS		

		</a>
	</td>
  </tr>

  <!-- ============== -->
  <tr height="22">
    <td>&nbsp;</td>
    <td></td>
  </tr>

  <tr height="22">
    <td>&nbsp;</td>
    <td><u>Format IV.A.5</u></td>
  </tr>

  <tr height="22">
    <td>&nbsp;</td>
    <td>		
	<a href="#" class="ico docu" onClick="showDocNew('',
			'Format_IV_A_3_1',
			'Format.IV.A.5.1',
			'LAPORAN PEROLEHAN/PENERIMAAN BMD BERDASARKAN PUTUSAN PENGADILAN YANG TELAH MEMPUNYAI KEKUATAN HUKUM TETAP BERUPA....(1) - BULAN',
			'EKSTRAKOMPTABEL',
			'',
			'bulan',
			'1','1','1','7','1','0',
			'<?=$IdL?>'); return false;">
			Format IV.A.5.1 - LAPORAN PEROLEHAN/PENERIMAAN BMD BERDASARKAN PUTUSAN PENGADILAN YANG TELAH MEMPUNYAI KEKUATAN HUKUM TETAP BERUPA....(1) - BULAN
		</a>
	</td>
  </tr>

  <tr height="22">
    <td>&nbsp;</td>
    <td>		
	<a href="#" class="ico docu" onClick="showDocNew('',
			'Format_IV_A_3_1',
			'Format.IV.A.5.2',
			'LAPORAN PEROLEHAN/PENERIMAAN BMD BERDASARKAN PUTUSAN PENGADILAN YANG TELAH MEMPUNYAI KEKUATAN HUKUM TETAP BERUPA....(1) - SEMESTER',
			'EKSTRAKOMPTABEL',
			'',
			'semester',
			'1','1','1','7','1','0',
			'<?=$IdL?>'); return false;">
			Format IV.A.5.2 - LAPORAN PEROLEHAN/PENERIMAAN BMD BERDASARKAN PUTUSAN PENGADILAN YANG TELAH MEMPUNYAI KEKUATAN HUKUM TETAP BERUPA....(1) - SEMESTER
		</a>
	</td>
  </tr>

  <tr height="22">
    <td>&nbsp;</td>
    <td>		
	<a href="#" class="ico docu" onClick="showDocNew('',
			'Format_IV_A_1_3_7',
			'Format.IV.A.5.3',
			'REKAPITULASI PEROLEHAN/PENERIMAAN BMD BERDASARKAN PUTUSAN PENGADILAN YANG TELAH MEMPUNYAI KEKUATAN HUKUM TETAP BERUPA....(1) <br>MENURUT SUB RINCIAN OBJEK',
			'EKSTRAKOMPTABEL',
			'',
			'semester',
			'1','1','1','6','1','0',
			'<?=$IdL?>'); return false;">
			Format IV.A.5.3 - REKAPITULASI PEROLEHAN/PENERIMAAN BMD BERDASARKAN PUTUSAN PENGADILAN YANG TELAH MEMPUNYAI KEKUATAN HUKUM TETAP BERUPA....(1) MENURUT SUB RINCIAN OBJEK		

		</a>
	</td>
  </tr>

  <tr height="22">
    <td>&nbsp;</td>
    <td>		
	<a href="#" class="ico docu" onClick="showDocNew('',
			'Format_IV_A_1_3_7',
			'Format.IV.A.5.4',
			'REKAPITULASI PEROLEHAN/PENERIMAAN BMD BERDASARKAN PUTUSAN PENGADILAN YANG TELAH MEMPUNYAI KEKUATAN HUKUM TETAP BERUPA....(1) <br>MENURUT  RINCIAN OBJEK',
			'EKSTRAKOMPTABEL',
			'',
			'semester',
			'1','1','1','5','1','0',
			'<?=$IdL?>'); return false;">
			Format IV.A.5.4 - REKAPITULASI PEROLEHAN/PENERIMAAN BMD BERDASARKAN PUTUSAN PENGADILAN YANG TELAH MEMPUNYAI KEKUATAN HUKUM TETAP BERUPA....(1) MENURUT  RINCIAN OBJEK		

		</a>
	</td>
  </tr>

  <tr height="22">
    <td>&nbsp;</td>
    <td>		
	<a href="#" class="ico docu" onClick="showDocNew('',
			'Format_IV_A_1_3_7',
			'Format.IV.A.5.5',
			'REKAPITULASI PEROLEHAN/PENERIMAAN BMD BERDASARKAN PUTUSAN PENGADILAN YANG TELAH MEMPUNYAI KEKUATAN HUKUM TETAP BERUPA....(1) <br>MENURUT   OBJEK',
			'EKSTRAKOMPTABEL',
			'',
			'semester',
			'1','1','1','4','1','0',
			'<?=$IdL?>'); return false;">
			Format IV.A.5.5 - REKAPITULASI PEROLEHAN/PENERIMAAN BMD BERDASARKAN PUTUSAN PENGADILAN YANG TELAH MEMPUNYAI KEKUATAN HUKUM TETAP BERUPA....(1) MENURUT   OBJEK		

		</a>
	</td>
  </tr>

  <tr height="22">
    <td>&nbsp;</td>
    <td>		
	<a href="#" class="ico docu" onClick="showDocNew('',
			'Format_IV_A_1_3_7',
			'Format.IV.A.5.6',
			'REKAPITULASI PEROLEHAN/PENERIMAAN BMD BERDASARKAN PUTUSAN PENGADILAN YANG TELAH MEMPUNYAI KEKUATAN HUKUM TETAP BERUPA....(1) <br>MENURUT JENIS',
			'EKSTRAKOMPTABEL',
			'',
			'semester',
			'1','1','1','3','1','0',
			'<?=$IdL?>'); return false;">
			Format IV.A.5.6 - REKAPITULASI PEROLEHAN/PENERIMAAN BMD BERDASARKAN PUTUSAN PENGADILAN YANG TELAH MEMPUNYAI KEKUATAN HUKUM TETAP BERUPA....(1) MENURUT JENIS		

		</a>
	</td>
  </tr>

  <tr height="22">
    <td>&nbsp;</td>
    <td>		
	<a href="#" class="ico docu" onClick="showDocNew('',
			'Format_IV_A_1_3_7',
			'Format.IV.A.5.7',
			'LAPORAN PEROLEHAN/PENERIMAAN BMD BERDASARKAN PUTUSAN PENGADILAN YANG TELAH MEMPUNYAI KEKUATAN HUKUM TETAP BERUPA....(1) <br>MENURUT SUB RINCIAN OBJEK',
			'EKSTRAKOMPTABEL',
			'',
			'semester',
			'0','0','1','6','0','1',
			'<?=$IdL?>'); return false;">
			Format IV.A.5.7 - LAPORAN PEROLEHAN/PENERIMAAN BMD BERDASARKAN PUTUSAN PENGADILAN YANG TELAH MEMPUNYAI KEKUATAN HUKUM TETAP BERUPA....(1)  MENURUT SUB RINCIAN OBJEK		

		</a>
	</td>
  </tr>
  <tr height="22">
    <td>&nbsp;</td>
    <td>		
	<a href="#" class="ico docu" onClick="showDocNew('',
			'Format_IV_A_1_3_7',
			'Format.IV.A.5.8',
			'LAPORAN PEROLEHAN/PENERIMAAN BMD BERDASARKAN PUTUSAN PENGADILAN YANG TELAH MEMPUNYAI KEKUATAN HUKUM TETAP BERUPA....(1)  <br>MENURUT  RINCIAN OBJEK',
			'EKSTRAKOMPTABEL',
			'',
			'semester',
			'0','0','1','5','0','1',
			'<?=$IdL?>'); return false;">
			Format IV.A.5.8 - LAPORAN PEROLEHAN/PENERIMAAN BMD BERDASARKAN PUTUSAN PENGADILAN YANG TELAH MEMPUNYAI KEKUATAN HUKUM TETAP BERUPA....(1)   MENURUT RINCIAN OBJEK		

		</a>
	</td>
  </tr>

  <tr height="22">
    <td>&nbsp;</td>
    <td>		
	<a href="#" class="ico docu" onClick="showDocNew('',
			'Format_IV_A_1_3_7',
			'Format.IV.A.5.9',
			'LAPORAN PEROLEHAN/PENERIMAAN BMD BERDASARKAN PUTUSAN PENGADILAN YANG TELAH MEMPUNYAI KEKUATAN HUKUM TETAP BERUPA....(1)  MENURUT   OBJEK',
			'EKSTRAKOMPTABEL',
			'',
			'semester',
			'0','0','1','4','0','1',
			'<?=$IdL?>'); return false;">
			Format IV.A.5.9 - LAPORAN PEROLEHAN/PENERIMAAN BMD BERDASARKAN PUTUSAN PENGADILAN YANG TELAH MEMPUNYAI KEKUATAN HUKUM TETAP BERUPA....(1)   MENURUT OBJEK		

		</a>
	</td>
  </tr>

  <tr height="22">
    <td>&nbsp;</td>
    <td>		
	<a href="#" class="ico docu" onClick="showDocNew('',
			'Format_IV_A_1_3_7',
			'Format.IV.A.5.10',
			'LAPORAN PEROLEHAN/PENERIMAAN BMD BERDASARKAN PUTUSAN PENGADILAN YANG TELAH MEMPUNYAI KEKUATAN HUKUM TETAP BERUPA....(1)  MENURUT   JENIS',
			'EKSTRAKOMPTABEL',
			'',
			'semester',
			'0','0','1','3','0','1',
			'<?=$IdL?>'); return false;">
			Format IV.A.5.10 - LAPORAN PEROLEHAN/PENERIMAAN BMD BERDASARKAN PUTUSAN PENGADILAN YANG TELAH MEMPUNYAI KEKUATAN HUKUM TETAP BERUPA....(1)   MENURUT JENIS		

		</a>
	</td>
  </tr>


  <!-- ============== -->
  <tr height="22">
    <td>&nbsp;</td>
    <td></td>
  </tr>

  <tr height="22">
    <td>&nbsp;</td>
    <td><u>Format IV.A.6</u></td>
  </tr>

  <tr height="22">
    <td>&nbsp;</td>
    <td>		
	<a href="#" class="ico docu" onClick="showDocNew('',
			'Format_IV_A_3_1',
			'Format.IV.A.6.1',
			'LAPORAN PEROLEHAN/PENERIMAAN BMD DARI DIVESTASI BERUPA...(1) - BULAN',
			'EKSTRAKOMPTABEL',
			'',
			'bulan',
			'1','1','1','7','1','0',
			'<?=$IdL?>'); return false;">
			Format IV.A.6.1 - LAPORAN PEROLEHAN/PENERIMAAN BMD DARI DIVESTASI BERUPA...(1) - BULAN
		</a>
	</td>
  </tr>

  <tr height="22">
    <td>&nbsp;</td>
    <td>		
	<a href="#" class="ico docu" onClick="showDocNew('',
			'Format_IV_A_3_1',
			'Format.IV.A.6.2',
			'LAPORAN PEROLEHAN/PENERIMAAN BMD DARI DIVESTASI BERUPA...(1) - SEMESTER',
			'EKSTRAKOMPTABEL',
			'',
			'semester',
			'1','1','1','7','1','0',
			'<?=$IdL?>'); return false;">
			Format IV.A.6.2 - LAPORAN PEROLEHAN/PENERIMAAN BMD DARI DIVESTASI BERUPA...(1) - SEMESTER
		</a>
	</td>
  </tr>

  <tr height="22">
    <td>&nbsp;</td>
    <td>		
	<a href="#" class="ico docu" onClick="showDocNew('',
			'Format_IV_A_1_3_7',
			'Format.IV.A.6.3',
			'REKAPITULASI PEROLEHAN/PENERIMAAN BMD DARI DIVESTASI BERUPA...(1) <br>MENURUT SUB RINCIAN OBJEK',
			'EKSTRAKOMPTABEL',
			'',
			'semester',
			'1','1','1','6','1','0',
			'<?=$IdL?>'); return false;">
			Format IV.A.6.3 - REKAPITULASI PEROLEHAN/PENERIMAAN BMD DARI DIVESTASI BERUPA...(1) MENURUT SUB RINCIAN OBJEK		

		</a>
	</td>
  </tr>

  <tr height="22">
    <td>&nbsp;</td>
    <td>		
	<a href="#" class="ico docu" onClick="showDocNew('',
			'Format_IV_A_1_3_7',
			'Format.IV.A.6.4',
			'REKAPITULASI PEROLEHAN/PENERIMAAN BMD DARI DIVESTASI BERUPA...(1) <br>MENURUT  RINCIAN OBJEK',
			'EKSTRAKOMPTABEL',
			'',
			'semester',
			'1','1','1','5','1','0',
			'<?=$IdL?>'); return false;">
			Format IV.A.6.4 - REKAPITULASI PEROLEHAN/PENERIMAAN BMD DARI DIVESTASI BERUPA...(1) MENURUT  RINCIAN OBJEK		

		</a>
	</td>
  </tr>

  <tr height="22">
    <td>&nbsp;</td>
    <td>		
	<a href="#" class="ico docu" onClick="showDocNew('',
			'Format_IV_A_1_3_7',
			'Format.IV.A.6.5',
			'REKAPITULASI PEROLEHAN/PENERIMAAN BMD DARI DIVESTASI BERUPA...(1) <br>MENURUT   OBJEK',
			'EKSTRAKOMPTABEL',
			'',
			'semester',
			'1','1','1','4','1','0',
			'<?=$IdL?>'); return false;">
			Format IV.A.6.5 - REKAPITULASI PEROLEHAN/PENERIMAAN BMD DARI DIVESTASI BERUPA...(1) MENURUT   OBJEK		

		</a>
	</td>
  </tr>

  <tr height="22">
    <td>&nbsp;</td>
    <td>		
	<a href="#" class="ico docu" onClick="showDocNew('',
			'Format_IV_A_1_3_7',
			'Format.IV.A.6.6',
			'REKAPITULASI PEROLEHAN/PENERIMAAN BMD DARI DIVESTASI BERUPA...(1) <br>MENURUT JENIS',
			'EKSTRAKOMPTABEL',
			'',
			'semester',
			'1','1','1','3','1','0',
			'<?=$IdL?>'); return false;">
			Format IV.A.6.6 - REKAPITULASI PEROLEHAN/PENERIMAAN BMD DARI DIVESTASI BERUPA...(1) MENURUT JENIS		

		</a>
	</td>
  </tr>

  <tr height="22">
    <td>&nbsp;</td>
    <td>		
	<a href="#" class="ico docu" onClick="showDocNew('',
			'Format_IV_A_1_3_7',
			'Format.IV.A.6.7',
			'LAPORAN PEROLEHAN/PENERIMAAN BMD DARI DIVESTASI BERUPA...(1) <br>MENURUT SUB RINCIAN OBJEK',
			'EKSTRAKOMPTABEL',
			'',
			'semester',
			'0','0','1','6','0','1',
			'<?=$IdL?>'); return false;">
			Format IV.A.6.7 - LAPORAN PEROLEHAN/PENERIMAAN BMD DARI DIVESTASI BERUPA...(1)  MENURUT SUB RINCIAN OBJEK		

		</a>
	</td>
  </tr>
  <tr height="22">
    <td>&nbsp;</td>
    <td>		
	<a href="#" class="ico docu" onClick="showDocNew('',
			'Format_IV_A_1_3_7',
			'Format.IV.A.6.8',
			'LAPORAN PEROLEHAN/PENERIMAAN BMD DARI DIVESTASI BERUPA...(1)  <br>MENURUT  RINCIAN OBJEK',
			'EKSTRAKOMPTABEL',
			'',
			'semester',
			'0','0','1','5','0','1',
			'<?=$IdL?>'); return false;">
			Format IV.A.6.8 - LAPORAN PEROLEHAN/PENERIMAAN BMD DARI DIVESTASI BERUPA...(1)   MENURUT RINCIAN OBJEK		

		</a>
	</td>
  </tr>

  <tr height="22">
    <td>&nbsp;</td>
    <td>		
	<a href="#" class="ico docu" onClick="showDocNew('',
			'Format_IV_A_1_3_7',
			'Format.IV.A.6.9',
			'LAPORAN PEROLEHAN/PENERIMAAN BMD DARI DIVESTASI BERUPA...(1)  MENURUT   OBJEK',
			'EKSTRAKOMPTABEL',
			'',
			'semester',
			'0','0','1','4','0','1',
			'<?=$IdL?>'); return false;">
			Format IV.A.6.9 - LAPORAN PEROLEHAN/PENERIMAAN BMD DARI DIVESTASI BERUPA...(1)   MENURUT OBJEK		

		</a>
	</td>
  </tr>

  <tr height="22">
    <td>&nbsp;</td>
    <td>		
	<a href="#" class="ico docu" onClick="showDocNew('',
			'Format_IV_A_1_3_7',
			'Format.IV.A.6.10',
			'LAPORAN PEROLEHAN/PENERIMAAN BMD DARI DIVESTASI BERUPA...(1)  MENURUT   JENIS',
			'EKSTRAKOMPTABEL',
			'',
			'semester',
			'0','0','1','3','0','1',
			'<?=$IdL?>'); return false;">
			Format IV.A.6.10 - LAPORAN PEROLEHAN/PENERIMAAN BMD DARI DIVESTASI BERUPA...(1)  MENURUT JENIS		

		</a>
	</td>
  </tr>


  <!-- ============== -->
  <tr height="22">
    <td>&nbsp;</td>
    <td></td>
  </tr>

  <tr height="22">
    <td>&nbsp;</td>
    <td><u>Format IV.A.7</u></td>
  </tr>

  <tr height="22">
    <td>&nbsp;</td>
    <td>		
	<a href="#" class="ico docu" onClick="showDocNew('',
			'Format_IV_A_3_1',
			'Format.IV.A.7.1',
			'LAPORAN PEROLEHAN/PENERIMAAN BMD DARI INVENTARISASI BERUPA...(1) - BULAN',
			'EKSTRAKOMPTABEL',
			'',
			'bulan',
			'1','1','1','7','1','0',
			'<?=$IdL?>'); return false;">
			Format IV.A.7.1 - LAPORAN PEROLEHAN/PENERIMAAN BMD DARI INVENTARISASI BERUPA...(1) - BULAN
		</a>
	</td>
  </tr>

  <tr height="22">
    <td>&nbsp;</td>
    <td>		
	<a href="#" class="ico docu" onClick="showDocNew('',
			'Format_IV_A_3_1',
			'Format.IV.A.7.2',
			'LAPORAN PEROLEHAN/PENERIMAAN BMD DARI INVENTARISASI BERUPA...(1) - SEMESTER',
			'EKSTRAKOMPTABEL',
			'',
			'semester',
			'1','1','1','7','1','0',
			'<?=$IdL?>'); return false;">
			Format IV.A.7.2 - LAPORAN PEROLEHAN/PENERIMAAN BMD DARI INVENTARISASI BERUPA...(1) - SEMESTER
		</a>
	</td>
  </tr>

  <tr height="22">
    <td>&nbsp;</td>
    <td>		
	<a href="#" class="ico docu" onClick="showDocNew('',
			'Format_IV_A_1_3_7',
			'Format.IV.A.7.3',
			'REKAPITULASI PEROLEHAN/PENERIMAAN BMD DARI INVENTARISASI BERUPA...(1) <br>MENURUT SUB RINCIAN OBJEK',
			'EKSTRAKOMPTABEL',
			'',
			'semester',
			'1','1','1','6','1','0',
			'<?=$IdL?>'); return false;">
			Format IV.A.7.3 - REKAPITULASI PEROLEHAN/PENERIMAAN BMD DARI INVENTARISASI BERUPA...(1) MENURUT SUB RINCIAN OBJEK		

		</a>
	</td>
  </tr>

  <tr height="22">
    <td>&nbsp;</td>
    <td>		
	<a href="#" class="ico docu" onClick="showDocNew('',
			'Format_IV_A_1_3_7',
			'Format.IV.A.7.4',
			'REKAPITULASI PEROLEHAN/PENERIMAAN BMD DARI INVENTARISASI BERUPA...(1) <br>MENURUT  RINCIAN OBJEK',
			'EKSTRAKOMPTABEL',
			'',
			'semester',
			'1','1','1','5','1','0',
			'<?=$IdL?>'); return false;">
			Format IV.A.7.4 - REKAPITULASI PEROLEHAN/PENERIMAAN BMD DARI INVENTARISASI BERUPA...(1) MENURUT  RINCIAN OBJEK		

		</a>
	</td>
  </tr>

  <tr height="22">
    <td>&nbsp;</td>
    <td>		
	<a href="#" class="ico docu" onClick="showDocNew('',
			'Format_IV_A_1_3_7',
			'Format.IV.A.7.5',
			'REKAPITULASI PEROLEHAN/PENERIMAAN BMD DARI INVENTARISASI BERUPA...(1) <br>MENURUT   OBJEK',
			'EKSTRAKOMPTABEL',
			'',
			'semester',
			'1','1','1','4','1','0',
			'<?=$IdL?>'); return false;">
			Format IV.A.7.5 - REKAPITULASI PEROLEHAN/PENERIMAAN BMD DARI INVENTARISASI BERUPA...(1) MENURUT   OBJEK		

		</a>
	</td>
  </tr>

  <tr height="22">
    <td>&nbsp;</td>
    <td>		
	<a href="#" class="ico docu" onClick="showDocNew('',
			'Format_IV_A_1_3_7',
			'Format.IV.A.7.6',
			'REKAPITULASI PEROLEHAN/PENERIMAAN BMD DARI INVENTARISASI BERUPA...(1) <br>MENURUT JENIS',
			'EKSTRAKOMPTABEL',
			'',
			'semester',
			'1','1','1','3','1','0',
			'<?=$IdL?>'); return false;">
			Format IV.A.7.6 - REKAPITULASI PEROLEHAN/PENERIMAAN BMD DARI INVENTARISASI BERUPA...(1) MENURUT JENIS		

		</a>
	</td>
  </tr>

  <tr height="22">
    <td>&nbsp;</td>
    <td>		
	<a href="#" class="ico docu" onClick="showDocNew('',
			'Format_IV_A_1_3_7',
			'Format.IV.A.7.7',
			'LAPORAN PEROLEHAN/PENERIMAAN BMD DARI INVENTARISASI BERUPA...(1) <br>MENURUT SUB RINCIAN OBJEK',
			'EKSTRAKOMPTABEL',
			'',
			'semester',
			'0','0','1','6','0','1',
			'<?=$IdL?>'); return false;">
			Format IV.A.7.7 - LAPORAN PEROLEHAN/PENERIMAAN BMD DARI INVENTARISASI BERUPA...(1)  MENURUT SUB RINCIAN OBJEK		

		</a>
	</td>
  </tr>
  <tr height="22">
    <td>&nbsp;</td>
    <td>		
	<a href="#" class="ico docu" onClick="showDocNew('',
			'Format_IV_A_1_3_7',
			'Format.IV.A.7.8',
			'LAPORAN PEROLEHAN/PENERIMAAN BMD DARI INVENTARISASI BERUPA...(1)  <br>MENURUT  RINCIAN OBJEK',
			'EKSTRAKOMPTABEL',
			'',
			'semester',
			'0','0','1','5','0','1',
			'<?=$IdL?>'); return false;">
			Format IV.A.7.8 - LAPORAN PEROLEHAN/PENERIMAAN BMD DARI INVENTARISASI BERUPA...(1)   MENURUT RINCIAN OBJEK		

		</a>
	</td>
  </tr>

  <tr height="22">
    <td>&nbsp;</td>
    <td>		
	<a href="#" class="ico docu" onClick="showDocNew('',
			'Format_IV_A_1_3_7',
			'Format.IV.A.7.9',
			'LAPORAN PEROLEHAN/PENERIMAAN BMD DARI INVENTARISASI BERUPA...(1)  MENURUT   OBJEK',
			'EKSTRAKOMPTABEL',
			'',
			'semester',
			'0','0','1','4','0','1',
			'<?=$IdL?>'); return false;">
			Format IV.A.7.9 - LAPORAN PEROLEHAN/PENERIMAAN BMD DARI INVENTARISASI BERUPA...(1)   MENURUT OBJEK		

		</a>
	</td>
  </tr>

  <tr height="22">
    <td>&nbsp;</td>
    <td>		
	<a href="#" class="ico docu" onClick="showDocNew('',
			'Format_IV_A_1_3_7',
			'Format.IV.A.7.10',
			'LAPORAN PEROLEHAN/PENERIMAAN BMD DARI INVENTARISASI BERUPA...(1)  MENURUT   JENIS',
			'EKSTRAKOMPTABEL',
			'',
			'semester',
			'0','0','1','3','0','1',
			'<?=$IdL?>'); return false;">
			Format IV.A.7.10 - LAPORAN PEROLEHAN/PENERIMAAN BMD DARI INVENTARISASI BERUPA...(1)  MENURUT JENIS		

		</a>
	</td>
  </tr>

  <!-- ============ -->

  <!-- ============== -->
  <tr height="22">
    <td>&nbsp;</td>
    <td></td>
  </tr>

  <tr height="22">
    <td>&nbsp;</td>
    <td><u>Format IV.A.8</u></td>
  </tr>

  <tr height="22">
    <td>&nbsp;</td>
    <td>		
	<a href="#" class="ico docu" onClick="showDocNew('',
			'Format_IV_A_8_1',
			'Format.IV.A.8.1',
			'LAPORAN PEROLEHAN/PENERIMAAN BMD DARI TUKAR MENUKAR BERUPA...(1) - BULAN',
			'EKSTRAKOMPTABEL',
			'',
			'bulan',
			'1','1','1','7','1','0',
			'<?=$IdL?>'); return false;">
			Format IV.A.8.1 - LAPORAN PEROLEHAN/PENERIMAAN BMD DARI TUKAR MENUKAR BERUPA...(1) - BULAN
		</a>
	</td>
  </tr>

  <tr height="22">
    <td>&nbsp;</td>
    <td>		
	<a href="#" class="ico docu" onClick="showDocNew('',
			'Format_IV_A_8_1',
			'Format.IV.A.8.2',
			'LAPORAN PEROLEHAN/PENERIMAAN BMD DARI TUKAR MENUKAR BERUPA...(1) - SEMESTER',
			'EKSTRAKOMPTABEL',
			'',
			'semester',
			'1','1','1','7','1','0',
			'<?=$IdL?>'); return false;">
			Format IV.A.8.2 - LAPORAN PEROLEHAN/PENERIMAAN BMD DARI TUKAR MENUKAR BERUPA...(1) - SEMESTER
		</a>
	</td>
  </tr>

  <tr height="22">
    <td>&nbsp;</td>
    <td>		
	<a href="#" class="ico docu" onClick="showDocNew('',
			'Format_IV_A_1_3_7',
			'Format.IV.A.8.3',
			'REKAPITULASI PEROLEHAN/PENERIMAAN BMD DARI TUKAR MENUKAR BERUPA...(1) <br>MENURUT SUB RINCIAN OBJEK',
			'EKSTRAKOMPTABEL',
			'',
			'semester',
			'1','1','1','6','1','0',
			'<?=$IdL?>'); return false;">
			Format IV.A.8.3 - REKAPITULASI PEROLEHAN/PENERIMAAN BMD DARI TUKAR MENUKAR BERUPA...(1) MENURUT SUB RINCIAN OBJEK		

		</a>
	</td>
  </tr>

  <tr height="22">
    <td>&nbsp;</td>
    <td>		
	<a href="#" class="ico docu" onClick="showDocNew('',
			'Format_IV_A_1_3_7',
			'Format.IV.A.8.4',
			'REKAPITULASI PEROLEHAN/PENERIMAAN BMD DARI TUKAR MENUKAR BERUPA...(1) <br>MENURUT  RINCIAN OBJEK',
			'EKSTRAKOMPTABEL',
			'',
			'semester',
			'1','1','1','5','1','0',
			'<?=$IdL?>'); return false;">
			Format IV.A.8.4 - REKAPITULASI PEROLEHAN/PENERIMAAN BMD DARI TUKAR MENUKAR BERUPA...(1) MENURUT  RINCIAN OBJEK		

		</a>
	</td>
  </tr>

  <tr height="22">
    <td>&nbsp;</td>
    <td>		
	<a href="#" class="ico docu" onClick="showDocNew('',
			'Format_IV_A_1_3_7',
			'Format.IV.A.8.5',
			'REKAPITULASI PEROLEHAN/PENERIMAAN BMD DARI TUKAR MENUKAR BERUPA...(1) <br>MENURUT   OBJEK',
			'EKSTRAKOMPTABEL',
			'',
			'semester',
			'1','1','1','4','1','0',
			'<?=$IdL?>'); return false;">
			Format IV.A.8.5 - REKAPITULASI PEROLEHAN/PENERIMAAN BMD DARI TUKAR MENUKAR BERUPA...(1) MENURUT   OBJEK		

		</a>
	</td>
  </tr>

  <tr height="22">
    <td>&nbsp;</td>
    <td>		
	<a href="#" class="ico docu" onClick="showDocNew('',
			'Format_IV_A_1_3_7',
			'Format.IV.A.8.6',
			'REKAPITULASI PEROLEHAN/PENERIMAAN BMD DARI TUKAR MENUKAR BERUPA...(1) <br>MENURUT JENIS',
			'EKSTRAKOMPTABEL',
			'',
			'semester',
			'1','1','1','3','1','0',
			'<?=$IdL?>'); return false;">
			Format IV.A.8.6 - REKAPITULASI PEROLEHAN/PENERIMAAN BMD DARI TUKAR MENUKAR BERUPA...(1) MENURUT JENIS		

		</a>
	</td>
  </tr>

  <tr height="22">
    <td>&nbsp;</td>
    <td>		
	<a href="#" class="ico docu" onClick="showDocNew('',
			'Format_IV_A_1_3_7',
			'Format.IV.A.8.7',
			'LAPORAN PEROLEHAN/PENERIMAAN BMD DARI TUKAR MENUKAR BERUPA...(1) <br>MENURUT SUB RINCIAN OBJEK',
			'EKSTRAKOMPTABEL',
			'',
			'semester',
			'0','0','1','6','0','1',
			'<?=$IdL?>'); return false;">
			Format IV.A.8.7 - LAPORAN PEROLEHAN/PENERIMAAN BMD DARI TUKAR MENUKAR BERUPA...(1)  MENURUT SUB RINCIAN OBJEK		

		</a>
	</td>
  </tr>
  <tr height="22">
    <td>&nbsp;</td>
    <td>		
	<a href="#" class="ico docu" onClick="showDocNew('',
			'Format_IV_A_1_3_7',
			'Format.IV.A.8.8',
			'LAPORAN PEROLEHAN/PENERIMAAN BMD DARI TUKAR MENUKAR BERUPA...(1)  <br>MENURUT  RINCIAN OBJEK',
			'EKSTRAKOMPTABEL',
			'',
			'semester',
			'0','0','1','5','0','1',
			'<?=$IdL?>'); return false;">
			Format IV.A.8.8 - LAPORAN PEROLEHAN/PENERIMAAN BMD DARI TUKAR MENUKAR BERUPA...(1)   MENURUT RINCIAN OBJEK		

		</a>
	</td>
  </tr>

  <tr height="22">
    <td>&nbsp;</td>
    <td>		
	<a href="#" class="ico docu" onClick="showDocNew('',
			'Format_IV_A_1_3_7',
			'Format.IV.A.8.9',
			'LAPORAN PEROLEHAN/PENERIMAAN BMD DARI TUKAR MENUKAR BERUPA...(1)  MENURUT   OBJEK',
			'EKSTRAKOMPTABEL',
			'',
			'semester',
			'0','0','1','4','0','1',
			'<?=$IdL?>'); return false;">
			Format IV.A.8.9 - LAPORAN PEROLEHAN/PENERIMAAN BMD DARI TUKAR MENUKAR BERUPA...(1)   MENURUT OBJEK		

		</a>
	</td>
  </tr>

  <tr height="22">
    <td>&nbsp;</td>
    <td>		
	<a href="#" class="ico docu" onClick="showDocNew('',
			'Format_IV_A_1_3_7',
			'Format.IV.A.8.10',
			'LAPORAN PEROLEHAN/PENERIMAAN BMD DARI TUKAR MENUKAR BERUPA...(1)  MENURUT   JENIS',
			'EKSTRAKOMPTABEL',
			'',
			'semester',
			'0','0','1','3','0','1',
			'<?=$IdL?>'); return false;">
			Format IV.A.8.10 - LAPORAN PEROLEHAN/PENERIMAAN BMD DARI TUKAR MENUKAR BERUPA...(1)  MENURUT JENIS		

		</a>
	</td>
  </tr>

  <!-- ============ -->

  <!-- ============== -->
  <tr height="22">
    <td>&nbsp;</td>
    <td></td>
  </tr>

  <tr height="22">
    <td>&nbsp;</td>
    <td><u>Format IV.A.9</u></td>
  </tr>

  <tr height="22">
    <td>&nbsp;</td>
    <td>		
	<a href="#" class="ico docu" onClick="showDocNew('',
			'Format_IV_A_9_1',
			'Format.IV.A.9.1',
			'LAPORAN PEROLEHAN/PENERIMAAN BMD DARI PEMBATALAN PENGHAPUSAN BERUPA...(1) - BULAN',
			'EKSTRAKOMPTABEL',
			'',
			'bulan',
			'1','1','1','7','1','0',
			'<?=$IdL?>'); return false;">
			Format IV.A.9.1 - LAPORAN PEROLEHAN/PENERIMAAN BMD DARI PEMBATALAN PENGHAPUSAN BERUPA...(1) - BULAN
		</a>
	</td>
  </tr>

  <tr height="22">
    <td>&nbsp;</td>
    <td>		
	<a href="#" class="ico docu" onClick="showDocNew('',
			'Format_IV_A_9_1',
			'Format.IV.A.9.2',
			'LAPORAN PEROLEHAN/PENERIMAAN BMD DARI PEMBATALAN PENGHAPUSAN BERUPA...(1) - SEMESTER',
			'EKSTRAKOMPTABEL',
			'',
			'semester',
			'1','1','1','7','1','0',
			'<?=$IdL?>'); return false;">
			Format IV.A.9.2 - LAPORAN PEROLEHAN/PENERIMAAN BMD DARI PEMBATALAN PENGHAPUSAN BERUPA...(1) - SEMESTER
		</a>
	</td>
  </tr>

  <tr height="22">
    <td>&nbsp;</td>
    <td>		
	<a href="#" class="ico docu" onClick="showDocNew('',
			'Format_IV_A_1_3_7',
			'Format.IV.A.9.3',
			'REKAPITULASI PEROLEHAN/PENERIMAAN BMD DARI PEMBATALAN PENGHAPUSAN BERUPA...(1) <br>MENURUT SUB RINCIAN OBJEK',
			'EKSTRAKOMPTABEL',
			'',
			'semester',
			'1','1','1','6','1','0',
			'<?=$IdL?>'); return false;">
			Format IV.A.9.3 - REKAPITULASI PEROLEHAN/PENERIMAAN BMD DARI PEMBATALAN PENGHAPUSAN BERUPA...(1) MENURUT SUB RINCIAN OBJEK		

		</a>
	</td>
  </tr>

  <tr height="22">
    <td>&nbsp;</td>
    <td>		
	<a href="#" class="ico docu" onClick="showDocNew('',
			'Format_IV_A_1_3_7',
			'Format.IV.A.9.4',
			'REKAPITULASI PEROLEHAN/PENERIMAAN BMD DARI PEMBATALAN PENGHAPUSAN BERUPA...(1) <br>MENURUT  RINCIAN OBJEK',
			'EKSTRAKOMPTABEL',
			'',
			'semester',
			'1','1','1','5','1','0',
			'<?=$IdL?>'); return false;">
			Format IV.A.9.4 - REKAPITULASI PEROLEHAN/PENERIMAAN BMD DARI PEMBATALAN PENGHAPUSAN BERUPA...(1) MENURUT  RINCIAN OBJEK		

		</a>
	</td>
  </tr>

  <tr height="22">
    <td>&nbsp;</td>
    <td>		
	<a href="#" class="ico docu" onClick="showDocNew('',
			'Format_IV_A_1_3_7',
			'Format.IV.A.9.5',
			'REKAPITULASI PEROLEHAN/PENERIMAAN BMD DARI PEMBATALAN PENGHAPUSAN BERUPA...(1) <br>MENURUT   OBJEK',
			'EKSTRAKOMPTABEL',
			'',
			'semester',
			'1','1','1','4','1','0',
			'<?=$IdL?>'); return false;">
			Format IV.A.9.5 - REKAPITULASI PEROLEHAN/PENERIMAAN BMD DARI PEMBATALAN PENGHAPUSAN BERUPA...(1) MENURUT   OBJEK		

		</a>
	</td>
  </tr>

  <tr height="22">
    <td>&nbsp;</td>
    <td>		
	<a href="#" class="ico docu" onClick="showDocNew('',
			'Format_IV_A_1_3_7',
			'Format.IV.A.9.6',
			'REKAPITULASI PEROLEHAN/PENERIMAAN BMD DARI PEMBATALAN PENGHAPUSAN BERUPA...(1) <br>MENURUT JENIS',
			'EKSTRAKOMPTABEL',
			'',
			'semester',
			'1','1','1','3','1','0',
			'<?=$IdL?>'); return false;">
			Format IV.A.9.6 - REKAPITULASI PEROLEHAN/PENERIMAAN BMD DARI PEMBATALAN PENGHAPUSAN BERUPA...(1) MENURUT JENIS		

		</a>
	</td>
  </tr>

  <tr height="22">
    <td>&nbsp;</td>
    <td>		
	<a href="#" class="ico docu" onClick="showDocNew('',
			'Format_IV_A_1_3_7',
			'Format.IV.A.9.7',
			'LAPORAN PEROLEHAN/PENERIMAAN BMD DARI PEMBATALAN PENGHAPUSAN BERUPA...(1) <br>MENURUT SUB RINCIAN OBJEK',
			'EKSTRAKOMPTABEL',
			'',
			'semester',
			'0','0','1','6','0','1',
			'<?=$IdL?>'); return false;">
			Format IV.A.9.7 - LAPORAN PEROLEHAN/PENERIMAAN BMD DARI PEMBATALAN PENGHAPUSAN BERUPA...(1)  MENURUT SUB RINCIAN OBJEK		

		</a>
	</td>
  </tr>
  <tr height="22">
    <td>&nbsp;</td>
    <td>		
	<a href="#" class="ico docu" onClick="showDocNew('',
			'Format_IV_A_1_3_7',
			'Format.IV.A.9.8',
			'LAPORAN PEROLEHAN/PENERIMAAN BMD DARI PEMBATALAN PENGHAPUSAN BERUPA...(1)  <br>MENURUT  RINCIAN OBJEK',
			'EKSTRAKOMPTABEL',
			'',
			'semester',
			'0','0','1','5','0','1',
			'<?=$IdL?>'); return false;">
			Format IV.A.9.8 - LAPORAN PEROLEHAN/PENERIMAAN BMD DARI PEMBATALAN PENGHAPUSAN BERUPA...(1)   MENURUT RINCIAN OBJEK		

		</a>
	</td>
  </tr>

  <tr height="22">
    <td>&nbsp;</td>
    <td>		
	<a href="#" class="ico docu" onClick="showDocNew('',
			'Format_IV_A_1_3_7',
			'Format.IV.A.9.9',
			'LAPORAN PEROLEHAN/PENERIMAAN BMD DARI PEMBATALAN PENGHAPUSAN BERUPA...(1)  MENURUT   OBJEK',
			'EKSTRAKOMPTABEL',
			'',
			'semester',
			'0','0','1','4','0','1',
			'<?=$IdL?>'); return false;">
			Format IV.A.9.9 - LAPORAN PEROLEHAN/PENERIMAAN BMD DARI PEMBATALAN PENGHAPUSAN BERUPA...(1)   MENURUT OBJEK		

		</a>
	</td>
  </tr>

  <tr height="22">
    <td>&nbsp;</td>
    <td>		
	<a href="#" class="ico docu" onClick="showDocNew('',
			'Format_IV_A_1_3_7',
			'Format.IV.A.9.10',
			'LAPORAN PEROLEHAN/PENERIMAAN BMD DARI PEMBATALAN PENGHAPUSAN BERUPA...(1)  MENURUT   JENIS',
			'EKSTRAKOMPTABEL',
			'',
			'semester',
			'0','0','1','3','0','1',
			'<?=$IdL?>'); return false;">
			Format IV.A.9.10 - LAPORAN PEROLEHAN/PENERIMAAN BMD DARI PEMBATALAN PENGHAPUSAN BERUPA...(1)  MENURUT JENIS		

		</a>
	</td>
  </tr>

  <!-- ============ -->

  <!-- ============== -->
  <tr height="22">
    <td>&nbsp;</td>
    <td></td>
  </tr>

  <tr height="22">
    <td>&nbsp;</td>
    <td><u>Format IV.A.10</u></td>
  </tr>

  <tr height="22">
    <td>&nbsp;</td>
    <td>		
	<a href="#" class="ico docu" onClick="showDocNew('',
			'Format_IV_A_10_1',
			'Format.IV.A.10.1',
			'LAPORAN PEROLEHAN/PENERIMAAN BMD DARI PEROLEHAN/PENERIMAAN LAINNYA ...(1) - BULAN',
			'EKSTRAKOMPTABEL',
			'',
			'bulan',
			'1','1','1','7','1','0',
			'<?=$IdL?>'); return false;">
			Format IV.A.10.1 - LAPORAN PEROLEHAN/PENERIMAAN BMD DARI PEROLEHAN/PENERIMAAN LAINNYA ...(1) - BULAN
		</a>
	</td>
  </tr>

  <tr height="22">
    <td>&nbsp;</td>
    <td>		
	<a href="#" class="ico docu" onClick="showDocNew('',
			'Format_IV_A_10_1',
			'Format.IV.A.10.2',
			'LAPORAN PEROLEHAN/PENERIMAAN BMD DARI PEROLEHAN/PENERIMAAN LAINNYA ...(1) - SEMESTER',
			'EKSTRAKOMPTABEL',
			'',
			'semester',
			'1','1','1','7','1','0',
			'<?=$IdL?>'); return false;">
			Format IV.A.10.2 - LAPORAN PEROLEHAN/PENERIMAAN BMD DARI PEROLEHAN/PENERIMAAN LAINNYA ...(1) - SEMESTER
		</a>
	</td>
  </tr>

  <tr height="22">
    <td>&nbsp;</td>
    <td>		
	<a href="#" class="ico docu" onClick="showDocNew('',
			'Format_IV_A_1_3_7',
			'Format.IV.A.10.3',
			'REKAPITULASI PEROLEHAN/PENERIMAAN BMD DARI PEROLEHAN/PENERIMAAN LAINNYA ...(1) <br>MENURUT SUB RINCIAN OBJEK',
			'EKSTRAKOMPTABEL',
			'',
			'semester',
			'1','1','1','6','1','0',
			'<?=$IdL?>'); return false;">
			Format IV.A.10.3 - REKAPITULASI PEROLEHAN/PENERIMAAN BMD DARI PEROLEHAN/PENERIMAAN LAINNYA ...(1) MENURUT SUB RINCIAN OBJEK		

		</a>
	</td>
  </tr>

  <tr height="22">
    <td>&nbsp;</td>
    <td>		
	<a href="#" class="ico docu" onClick="showDocNew('',
			'Format_IV_A_1_3_7',
			'Format.IV.A.10.4',
			'REKAPITULASI PEROLEHAN/PENERIMAAN BMD DARI PEROLEHAN/PENERIMAAN LAINNYA ...(1) <br>MENURUT  RINCIAN OBJEK',
			'EKSTRAKOMPTABEL',
			'',
			'semester',
			'1','1','1','5','1','0',
			'<?=$IdL?>'); return false;">
			Format IV.A.10.4 - REKAPITULASI PEROLEHAN/PENERIMAAN BMD DARI PEROLEHAN/PENERIMAAN LAINNYA ...(1) MENURUT  RINCIAN OBJEK		

		</a>
	</td>
  </tr>

  <tr height="22">
    <td>&nbsp;</td>
    <td>		
	<a href="#" class="ico docu" onClick="showDocNew('',
			'Format_IV_A_1_3_7',
			'Format.IV.A.10.5',
			'REKAPITULASI PEROLEHAN/PENERIMAAN BMD DARI PEROLEHAN/PENERIMAAN LAINNYA ...(1) <br>MENURUT   OBJEK',
			'EKSTRAKOMPTABEL',
			'',
			'semester',
			'1','1','1','4','1','0',
			'<?=$IdL?>'); return false;">
			Format IV.A.10.5 - REKAPITULASI PEROLEHAN/PENERIMAAN BMD DARI PEROLEHAN/PENERIMAAN LAINNYA ...(1) MENURUT   OBJEK		

		</a>
	</td>
  </tr>

  <tr height="22">
    <td>&nbsp;</td>
    <td>		
	<a href="#" class="ico docu" onClick="showDocNew('',
			'Format_IV_A_1_3_7',
			'Format.IV.A.10.6',
			'REKAPITULASI PEROLEHAN/PENERIMAAN BMD DARI PEROLEHAN/PENERIMAAN LAINNYA ...(1) <br>MENURUT JENIS',
			'EKSTRAKOMPTABEL',
			'',
			'semester',
			'1','1','1','3','1','0',
			'<?=$IdL?>'); return false;">
			Format IV.A.10.6 - REKAPITULASI PEROLEHAN/PENERIMAAN BMD DARI PEROLEHAN/PENERIMAAN LAINNYA ...(1) MENURUT JENIS		

		</a>
	</td>
  </tr>

  <tr height="22">
    <td>&nbsp;</td>
    <td>		
	<a href="#" class="ico docu" onClick="showDocNew('',
			'Format_IV_A_1_3_7',
			'Format.IV.A.10.7',
			'LAPORAN PEROLEHAN/PENERIMAAN BMD DARI PEROLEHAN/PENERIMAAN LAINNYA ...(1) <br>MENURUT SUB RINCIAN OBJEK',
			'EKSTRAKOMPTABEL',
			'',
			'semester',
			'0','0','1','6','0','1',
			'<?=$IdL?>'); return false;">
			Format IV.A.10.7 - LAPORAN PEROLEHAN/PENERIMAAN BMD DARI PEROLEHAN/PENERIMAAN LAINNYA ...(1)  MENURUT SUB RINCIAN OBJEK		

		</a>
	</td>
  </tr>
  <tr height="22">
    <td>&nbsp;</td>
    <td>		
	<a href="#" class="ico docu" onClick="showDocNew('',
			'Format_IV_A_1_3_7',
			'Format.IV.A.10.8',
			'LAPORAN PEROLEHAN/PENERIMAAN BMD DARI PEROLEHAN/PENERIMAAN LAINNYA ...(1)  <br>MENURUT  RINCIAN OBJEK',
			'EKSTRAKOMPTABEL',
			'',
			'semester',
			'0','0','1','5','0','1',
			'<?=$IdL?>'); return false;">
			Format IV.A.10.8 - LAPORAN PEROLEHAN/PENERIMAAN BMD DARI PEROLEHAN/PENERIMAAN LAINNYA ...(1)   MENURUT RINCIAN OBJEK		

		</a>
	</td>
  </tr>

  <tr height="22">
    <td>&nbsp;</td>
    <td>		
	<a href="#" class="ico docu" onClick="showDocNew('',
			'Format_IV_A_1_3_7',
			'Format.IV.A.10.9',
			'LAPORAN PEROLEHAN/PENERIMAAN BMD DARI PEROLEHAN/PENERIMAAN LAINNYA ...(1)  MENURUT   OBJEK',
			'EKSTRAKOMPTABEL',
			'',
			'semester',
			'0','0','1','4','0','1',
			'<?=$IdL?>'); return false;">
			Format IV.A.10.9 - LAPORAN PEROLEHAN/PENERIMAAN BMD DARI PEROLEHAN/PENERIMAAN LAINNYA ...(1)   MENURUT OBJEK		

		</a>
	</td>
  </tr>

  <tr height="22">
    <td>&nbsp;</td>
    <td>		
	<a href="#" class="ico docu" onClick="showDocNew('',
			'Format_IV_A_1_3_7',
			'Format.IV.A.10.10',
			'LAPORAN PEROLEHAN/PENERIMAAN BMD DARI PEROLEHAN/PENERIMAAN LAINNYA ...(1)  MENURUT   JENIS',
			'EKSTRAKOMPTABEL',
			'',
			'semester',
			'0','0','1','3','0','1',
			'<?=$IdL?>'); return false;">
			Format IV.A.10.10 - LAPORAN PEROLEHAN/PENERIMAAN BMD DARI PEROLEHAN/PENERIMAAN LAINNYA ...(1)  MENURUT JENIS		

		</a>
	</td>
  </tr>

  <!-- ============ -->

  <!-- ============== -->
  <tr height="22">
    <td>&nbsp;</td>
    <td></td>
  </tr>

  <tr height="22">
    <td>&nbsp;</td>
    <td><u>Format IV.A.11</u></td>
  </tr>

  <tr height="22">
    <td>&nbsp;</td>
    <td>		
	<a href="#" class="ico docu" onClick="showDocNew('',
			'Format_IV_A_11_1',
			'Format.IV.A.11.1',
			'REKAPITULASI GABUNGAN PEROLEHAN/PENERIMAAN BMD BERUPA……..(1)<br>MENURUT SUB RINCIAN OBJEK',
			'EKSTRAKOMPTABEL',
			'',
			'semester',
			'1','1','1','6','1','0',
			'<?=$IdL?>'); return false;">
			Format IV.A.11.1 - REKAPITULASI GABUNGAN PEROLEHAN/PENERIMAAN BMD BERUPA……..(1) - MENURUT SUB RINCIAN OBJEK
		</a>
	</td>
  </tr>

  <tr height="22">
    <td>&nbsp;</td>
    <td>		
	<a href="#" class="ico docu" onClick="showDocNew('',
			'Format_IV_A_11_1',
			'Format.IV.A.11.2',
			'REKAPITULASI GABUNGAN PEROLEHAN/PENERIMAAN BMD BERUPA……..(1)<br>MENURUT  RINCIAN OBJEK',
			'EKSTRAKOMPTABEL',
			'',
			'semester',
			'1','1','1','5','1','0',
			'<?=$IdL?>'); return false;">
			Format IV.A.11.2 - REKAPITULASI GABUNGAN PEROLEHAN/PENERIMAAN BMD BERUPA……..(1) - MENURUT  RINCIAN OBJEK
		</a>
	</td>
  </tr>

  <tr height="22">
    <td>&nbsp;</td>
    <td>		
	<a href="#" class="ico docu" onClick="showDocNew('',
			'Format_IV_A_11_1',
			'Format.IV.A.11.3',
			'REKAPITULASI GABUNGAN PEROLEHAN/PENERIMAAN BMD BERUPA……..(1)<br>MENURUT   OBJEK',
			'EKSTRAKOMPTABEL',
			'',
			'semester',
			'1','1','1','4','1','0',
			'<?=$IdL?>'); return false;">
			Format IV.A.11.3 - REKAPITULASI GABUNGAN PEROLEHAN/PENERIMAAN BMD BERUPA……..(1) -   RINCIAN OBJEK
		</a>
	</td>
  </tr>

  <tr height="22">
    <td>&nbsp;</td>
    <td>		
	<a href="#" class="ico docu" onClick="showDocNew('',
			'Format_IV_A_11_1',
			'Format.IV.A.11.4',
			'REKAPITULASI GABUNGAN PEROLEHAN/PENERIMAAN BMD BERUPA……..(1)<br>MENURUT JENIS',
			'EKSTRAKOMPTABEL',
			'',
			'semester',
			'1','1','1','3','1','0',
			'<?=$IdL?>'); return false;">
			Format IV.A.11.4 - REKAPITULASI GABUNGAN PEROLEHAN/PENERIMAAN BMD BERUPA……..(1) - MENURUT  JENIS
		</a>
	</td>
  </tr>

  <tr height="22">
    <td>&nbsp;</td>
    <td>		
	<a href="#" class="ico docu" onClick="showDocNew('',
			'Format_IV_A_11_1',
			'Format.IV.A.11.5',
			'REKAPITULASI GABUNGAN PEROLEHAN/PENERIMAAN BMD BERUPA……..(1)<br>MENURUT SUB RINCIAN OBJEK',
			'EKSTRAKOMPTABEL',
			'',
			'semester',
			'0','0','1','6','1','1',
			'<?=$IdL?>'); return false;">
			Format IV.A.11.5 - REKAPITULASI GABUNGAN PEROLEHAN/PENERIMAAN BMD BERUPA……..(1) - MENURUT  SUB RINCIAN OBJEK
		</a>
	</td>
  </tr>

  <tr height="22">
    <td>&nbsp;</td>
    <td>		
	<a href="#" class="ico docu" onClick="showDocNew('',
			'Format_IV_A_11_1',
			'Format.IV.A.11.6',
			'REKAPITULASI GABUNGAN PEROLEHAN/PENERIMAAN BMD BERUPA……..(1)<br>MENURUT  RINCIAN OBJEK',
			'EKSTRAKOMPTABEL',
			'',
			'semester',
			'0','0','1','5','1','1',
			'<?=$IdL?>'); return false;">
			Format IV.A.11.6 - REKAPITULASI GABUNGAN PEROLEHAN/PENERIMAAN BMD BERUPA……..(1) - MENURUT   RINCIAN OBJEK
		</a>
	</td>
  </tr>

  <tr height="22">
    <td>&nbsp;</td>
    <td>		
	<a href="#" class="ico docu" onClick="showDocNew('',
			'Format_IV_A_11_1',
			'Format.IV.A.11.7',
			'REKAPITULASI GABUNGAN PEROLEHAN/PENERIMAAN BMD BERUPA……..(1)<br>MENURUT SUB  OBJEK',
			'EKSTRAKOMPTABEL',
			'',
			'semester',
			'0','0','1','4','1','1',
			'<?=$IdL?>'); return false;">
			Format IV.A.11.7 - REKAPITULASI GABUNGAN PEROLEHAN/PENERIMAAN BMD BERUPA……..(1) - MENURUT  OBJEK
		</a>
	</td>
  </tr>

  <tr height="22">
    <td>&nbsp;</td>
    <td>		
	<a href="#" class="ico docu" onClick="showDocNew('',
			'Format_IV_A_11_1',
			'Format.IV.A.11.8',
			'REKAPITULASI GABUNGAN PEROLEHAN/PENERIMAAN BMD BERUPA……..(1)<br>MENURUT JENIS',
			'EKSTRAKOMPTABEL',
			'',
			'semester',
			'0','0','1','3','1','1',
			'<?=$IdL?>'); return false;">
			Format IV.A.11.8 - REKAPITULASI GABUNGAN PEROLEHAN/PENERIMAAN BMD BERUPA……..(1) - MENURUT  JENIS
		</a>
	</td>
  </tr>

  <!-- ============== -->
  <tr height="22">
    <td>&nbsp;</td>
    <td></td>
  </tr>

  <tr height="22">
    <td>&nbsp;</td>
    <td><u>Format IV.B.1</u></td>
  </tr>

  <tr height="22">
    <td>&nbsp;</td>
    <td>		
	<a href="#" class="ico docu" onClick="showDocNew('',
			'Format_IV_B_1_1',
			'Format.IV.B.1.1',
			'LAPORAN PENERIMAAN PENGGUNAAN BERUPA……. (1) DALAM BENTUK PENGGUNAAN PENGALIHAN ATAU PENYERAHAN STATUS PENGGUNAAN BMD - BULAN',
			'EKSTRAKOMPTABEL',
			'',
			'bulan',
			'1','1','1','7','1','0',
			'<?=$IdL?>'); return false;">
			Format IV.B.1.1 - LAPORAN PENERIMAAN PENGGUNAAN BERUPA……. (1) DALAM BENTUK PENGGUNAAN PENGALIHAN ATAU PENYERAHAN STATUS PENGGUNAAN BMD - BULAN
		</a>
	</td>
  </tr>

  <tr height="22">
    <td>&nbsp;</td>
    <td>		
	<a href="#" class="ico docu" onClick="showDocNew('',
			'Format_IV_B_1_1',
			'Format.IV.B.1.2',
			'LAPORAN PENERIMAAN PENGGUNAAN BERUPA……. (1) DALAM BENTUK PENGGUNAAN PENGALIHAN ATAU PENYERAHAN STATUS PENGGUNAAN BMD - SEMESTER',
			'EKSTRAKOMPTABEL',
			'',
			'semester',
			'1','1','1','7','1','0',
			'<?=$IdL?>'); return false;">
			Format IV.B.1.2 - LAPORAN PENERIMAAN PENGGUNAAN BERUPA……. (1) DALAM BENTUK PENGGUNAAN PENGALIHAN ATAU PENYERAHAN STATUS PENGGUNAAN BMD	- SEMESTER
		</a>
	</td>
  </tr>

  <tr height="22">
    <td>&nbsp;</td>
    <td>		
	<a href="#" class="ico docu" onClick="showDocNew('',
			'Format_IV_B_1_3',
			'Format.IV.B.1.3',
			'REKAPITULASI PENERIMAAN PENGGUNAAN BERUPA……. (1) DALAM BENTUK PENGGUNAAN PENGALIHAN ATAU PENYERAHAN STATUS PENGGUNAAN BMD <br>MENURUT SUB RINCIAN OBJEK',
			'EKSTRAKOMPTABEL',
			'',
			'semester',
			'1','1','1','6','1','0',
			'<?=$IdL?>'); return false;">
			Format IV.B.1.3 - REKAPITULASI PENERIMAAN PENGGUNAAN BERUPA……. (1) DALAM BENTUK PENGGUNAAN PENGALIHAN ATAU PENYERAHAN STATUS PENGGUNAAN BMD MENURUT SUB RINCIAN OBJEK		

		</a>
	</td>
  </tr>

  <tr height="22">
    <td>&nbsp;</td>
    <td>		
	<a href="#" class="ico docu" onClick="showDocNew('',
			'Format_IV_B_1_3',
			'Format.IV.B.1.4',
			'REKAPITULASI PENERIMAAN PENGGUNAAN BERUPA……. (1) DALAM BENTUK PENGGUNAAN PENGALIHAN ATAU PENYERAHAN STATUS PENGGUNAAN BMD <br>MENURUT  RINCIAN OBJEK',
			'EKSTRAKOMPTABEL',
			'',
			'semester',
			'1','1','1','5','1','0',
			'<?=$IdL?>'); return false;">
			Format IV.B.1.4 - REKAPITULASI PENERIMAAN PENGGUNAAN BERUPA……. (1) DALAM BENTUK PENGGUNAAN PENGALIHAN ATAU PENYERAHAN STATUS PENGGUNAAN BMD MENURUT  RINCIAN OBJEK		

		</a>
	</td>
  </tr>

  <tr height="22">
    <td>&nbsp;</td>
    <td>		
	<a href="#" class="ico docu" onClick="showDocNew('',
			'Format_IV_B_1_3',
			'Format.IV.B.1.5',
			'REKAPITULASI PENERIMAAN PENGGUNAAN BERUPA……. (1) DALAM BENTUK PENGGUNAAN PENGALIHAN ATAU PENYERAHAN STATUS PENGGUNAAN BMD <br>MENURUT   OBJEK',
			'EKSTRAKOMPTABEL',
			'',
			'semester',
			'1','1','1','4','1','0',
			'<?=$IdL?>'); return false;">
			Format IV.B.1.5 - REKAPITULASI PENERIMAAN PENGGUNAAN BERUPA……. (1) DALAM BENTUK PENGGUNAAN PENGALIHAN ATAU PENYERAHAN STATUS PENGGUNAAN BMD MENURUT   OBJEK		

		</a>
	</td>
  </tr>

  <tr height="22">
    <td>&nbsp;</td>
    <td>		
	<a href="#" class="ico docu" onClick="showDocNew('',
			'Format_IV_B_1_3',
			'Format.IV.B.1.6',
			'REKAPITULASI PENERIMAAN PENGGUNAAN BERUPA……. (1) DALAM BENTUK PENGGUNAAN PENGALIHAN ATAU PENYERAHAN STATUS PENGGUNAAN BMD <br>MENURUT JENIS',
			'EKSTRAKOMPTABEL',
			'',
			'semester',
			'1','1','1','3','1','0',
			'<?=$IdL?>'); return false;">
			Format IV.B.1.6 - REKAPITULASI PENERIMAAN PENGGUNAAN BERUPA……. (1) DALAM BENTUK PENGGUNAAN PENGALIHAN ATAU PENYERAHAN STATUS PENGGUNAAN BMD MENURUT JENIS		

		</a>
	</td>
  </tr>

  <tr height="22">
    <td>&nbsp;</td>
    <td>		
	<a href="#" class="ico docu" onClick="showDocNew('',
			'Format_IV_B_1_3',
			'Format.IV.B.1.7',
			'LAPORAN PENERIMAAN PENGGUNAAN BERUPA……. (1) DALAM BENTUK PENGGUNAAN PENGALIHAN ATAU PENYERAHAN STATUS PENGGUNAAN BMD <br>MENURUT SUB RINCIAN OBJEK',
			'EKSTRAKOMPTABEL',
			'',
			'semester',
			'0','0','1','6','0','1',
			'<?=$IdL?>'); return false;">
			Format IV.B.1.7 - LAPORAN PENERIMAAN PENGGUNAAN BERUPA……. (1) DALAM BENTUK PENGGUNAAN PENGALIHAN ATAU PENYERAHAN STATUS PENGGUNAAN BMD  MENURUT SUB RINCIAN OBJEK		

		</a>
	</td>
  </tr>
  <tr height="22">
    <td>&nbsp;</td>
    <td>		
	<a href="#" class="ico docu" onClick="showDocNew('',
			'Format_IV_B_1_3',
			'Format.IV.B.1.8',
			'LAPORAN PENERIMAAN PENGGUNAAN BERUPA……. (1) DALAM BENTUK PENGGUNAAN PENGALIHAN ATAU PENYERAHAN STATUS PENGGUNAAN BMD  <br>MENURUT  RINCIAN OBJEK',
			'EKSTRAKOMPTABEL',
			'',
			'semester',
			'0','0','1','5','0','1',
			'<?=$IdL?>'); return false;">
			Format IV.B.1.8 - LAPORAN PENERIMAAN PENGGUNAAN BERUPA……. (1) DALAM BENTUK PENGGUNAAN PENGALIHAN ATAU PENYERAHAN STATUS PENGGUNAAN BMD   MENURUT RINCIAN OBJEK		

		</a>
	</td>
  </tr>

  <tr height="22">
    <td>&nbsp;</td>
    <td>		
	<a href="#" class="ico docu" onClick="showDocNew('',
			'Format_IV_B_1_3',
			'Format.IV.B.1.9',
			'LAPORAN PENERIMAAN PENGGUNAAN BERUPA……. (1) DALAM BENTUK PENGGUNAAN PENGALIHAN ATAU PENYERAHAN STATUS PENGGUNAAN BMD  MENURUT   OBJEK',
			'EKSTRAKOMPTABEL',
			'',
			'semester',
			'0','0','1','4','0','1',
			'<?=$IdL?>'); return false;">
			Format IV.B.1.9 - LAPORAN PENERIMAAN PENGGUNAAN BERUPA……. (1) DALAM BENTUK PENGGUNAAN PENGALIHAN ATAU PENYERAHAN STATUS PENGGUNAAN BMD   MENURUT OBJEK		

		</a>
	</td>
  </tr>

  <tr height="22">
    <td>&nbsp;</td>
    <td>		
	<a href="#" class="ico docu" onClick="showDocNew('',
			'Format_IV_B_1_3',
			'Format.IV.B.1.10',
			'LAPORAN PENERIMAAN PENGGUNAAN BERUPA……. (1) DALAM BENTUK PENGGUNAAN PENGALIHAN ATAU PENYERAHAN STATUS PENGGUNAAN BMD  MENURUT   JENIS',
			'EKSTRAKOMPTABEL',
			'',
			'semester',
			'0','0','1','3','0','1',
			'<?=$IdL?>'); return false;">
			Format IV.B.1.10 - LAPORAN PENERIMAAN PENGGUNAAN BERUPA……. (1) DALAM BENTUK PENGGUNAAN PENGALIHAN ATAU PENYERAHAN STATUS PENGGUNAAN BMD  MENURUT JENIS		

		</a>
	</td>
  </tr>

  <!-- ============ -->

  <tr height="22">
    <td>&nbsp;</td>
    <td><u>Format IV.B.2</u></td>
  </tr>

  <tr height="22">
    <td>&nbsp;</td>
    <td>		
	<a href="#" class="ico docu" onClick="showDocNew('',
			'Format_IV_B_2_1',
			'Format.IV.B.2.1',
			'LAPORAN PENGGUNAAN SEMENTARA BMD - Bulan',
			'EKSTRAKOMPTABEL',
			'',
			'bulan',
			'1','1','1','7','1','0',
			'<?=$IdL?>'); return false;">
			Format IV.B.2.1 - LAPORAN PENGGUNAAN SEMENTARA BMD - BULAN
		</a>
	</td>
  </tr>

  <?php
	itemListDocument(
						'Format IV.B.2.2 - LAPORAN PENGGUNAAN SEMENTARA BMD - SEMESTER',
						'Format_IV_B_2_1',	'Format.IV.B.2.2',
						'LAPORAN PENGGUNAAN SEMENTARA BMD - Semester',
						'EKSTRAKOMPTABEL','',
						'semester','1','1','1','7','1','0',$IdL	
					);

	itemListDocument(
						'Format IV.B.2.3 - LAPORAN PENGAKHIRAN PENGGUNAAN SEMENTARA BMD - BULAN',
						'Format_IV_B_2_3',	'Format.IV.B.2.3',
						'LAPORAN PENGAKHIRAN PENGGUNAAN SEMENTARA BMD',
						'EKSTRAKOMPTABEL','',
						'bulan','1','1','1','7','1','0',$IdL	
					);

	itemListDocument(
						'Format IV.B.2.4 - LAPORAN PENGAKHIRAN PENGGUNAAN SEMENTARA BMD - SEMESTER',
						'Format_IV_B_2_3',	'Format.IV.B.2.4',
						'LAPORAN PENGAKHIRAN PENGGUNAAN SEMENTARA BMD',
						'EKSTRAKOMPTABEL','',
						'semester','1','1','1','7','1','0',$IdL	
					);
	itemListDocument(
						'Format IV.B.2.5 - REKAPITULASI LAPORAN PENGGUNAAN SEMENTARA BMD',
						'Format_IV_B_2_5',	'Format.IV.B.2.5',
						'REKAPITULASI LAPORAN PENGGUNAAN SEMENTARA BMD',
						'EKSTRAKOMPTABEL','',
						'semester','1','1','1','7','1','0',$IdL	
					);



  ?>


<!-- ============ -->

<tr height="22">
    <td>&nbsp;</td>
    <td><u>Format IV.B.3</u></td>
  </tr>
  
  <?php
	itemListDocument(
						'Format IV.B.3.1 - LAPORAN PENGGUNAAN BMD UNTUK DIOPERASIKAN OLEH PIHAK LAIN - BULAN',
						'Format_IV_B_2_1',	'Format.IV.B.3.1',
						'LAPORAN PENGGUNAAN BMD UNTUK DIOPERASIKAN OLEH PIHAK LAIN',
						'EKSTRAKOMPTABEL','',
						'bulan','1','1','1','7','1','0',$IdL	
					);

	itemListDocument(
						'Format IV.B.3.2 - LAPORAN PENGGUNAAN BMD UNTUK DIOPERASIKAN OLEH PIHAK LAIN - SEMESTER',
						'Format_IV_B_2_1',	'Format.IV.B.3.2',
						'LAPORAN PENGGUNAAN BMD UNTUK DIOPERASIKAN OLEH PIHAK LAIN',
						'EKSTRAKOMPTABEL','',
						'semester','1','1','1','7','1','0',$IdL		
					);

	itemListDocument(
						'Format IV.B.3.3 - LAPORAN PENGAKHIRAN BMD UNTUK DIOPERASIKAN OLEH PIHAK LAIN - BULAN',
						'Format_IV_B_3_3',	'Format.IV.B.3.3',
						'LAPORAN PENGAKHIRAN BMD UNTUK DIOPERASIKAN OLEH PIHAK LAIN ',
						'EKSTRAKOMPTABEL','',
						'bulan','1','1','1','7','1','0',$IdL	
					);
	itemListDocument(
						'Format IV.B.3.4 - LAPORAN PENGAKHIRAN BMD UNTUK DIOPERASIKAN OLEH PIHAK LAIN - SEMESTER',
						'Format_IV_B_3_3',	'Format.IV.B.3.4',
						'LAPORAN PENGAKHIRAN BMD UNTUK DIOPERASIKAN OLEH PIHAK LAIN',
						'EKSTRAKOMPTABEL','',
						'semester','1','1','1','7','1','0',$IdL		
					);
	itemListDocument(
						'Format IV.B.3.5 - REKAPITULASI LAPORAN PENGGUNAAN BMD UNTUK DIOPERASIKAN OLEH PIHAK LAIN',
						'Format_IV_B_3_5',	'Format.IV.B.3.5',
						'REKAPITULASI LAPORAN PENGGUNAAN BMD UNTUK DIOPERASIKAN OLEH PIHAK LAIN',
						'EKSTRAKOMPTABEL','',
						'semester','1','1','1','7','1','0',$IdL		
					);



  ?>
<tr height="22">
    <td>&nbsp;</td>
    <td></td>
  </tr>

<tr height="22">
    <td>&nbsp;</td>
    <td><u>Format IV.C</u></td>
  </tr>
  
  <?php
	itemListDocument(
						'Format IV.C.1 - LAPORAN PENERIMAAN BMD INTERNAL PENGGUNA BARANG BERUPA……. (1) - BULAN',
						'Format_IV_C_1',	'Format.IV.C.1',
						'LAPORAN PENERIMAAN BMD INTERNAL PENGGUNA BARANG BERUPA……. (1)',
						'EKSTRAKOMPTABEL','',
						'bulan','1','1','1','7','1','0',$IdL	
					);

	itemListDocument(
						'Format IV.C.2 - LAPORAN PENERIMAAN BMD INTERNAL PENGGUNA BARANG BERUPA……. (1) - SEMESTER',
						'Format_IV_C_1',	'Format.IV.C.2',
						'LAPORAN PENERIMAAN BMD INTERNAL PENGGUNA BARANG BERUPA……. (1)',
						'EKSTRAKOMPTABEL','',
						'semester','1','1','1','7','1','0',$IdL		
					);
	itemListDocument(
						'Format IV.C.3 - REKAPITULASI PENERIMAAN BMD INTERNAL PENGGUNA BARANG BERUPA……. (1) - MENURUT SUB RINCIAN OBJEK',
						'Format_IV_B_1_3',	'Format.IV.C.3',
						'REKAPITULASI PENERIMAAN BMD INTERNAL PENGGUNA BARANG BERUPA……. (1)<br>MENURUT SUB RINCIAN OBJEK',
						'EKSTRAKOMPTABEL','',
						'semester','1','0','1','6','1','0',$IdL		
					);
	itemListDocument(
						'Format IV.C.4 - REKAPITULASI PENERIMAAN BMD INTERNAL PENGGUNA BARANG BERUPA……. (1) - MENURUT RINCIAN OBJEK',
						'Format_IV_B_1_3',	'Format.IV.C.4',
						'REKAPITULASI PENERIMAAN BMD INTERNAL PENGGUNA BARANG BERUPA……. (1)<br>MENURUT  RINCIAN OBJEK',
						'EKSTRAKOMPTABEL','',
						'semester','1','0','1','5','1','0',$IdL		
					);
	itemListDocument(
						'Format IV.C.5 - REKAPITULASI PENERIMAAN BMD INTERNAL PENGGUNA BARANG BERUPA……. (1) - MENURUT  OBJEK',
						'Format_IV_B_1_3',	'Format.IV.C.5',
						'REKAPITULASI PENERIMAAN BMD INTERNAL PENGGUNA BARANG BERUPA……. (1)<br>MENURUT   OBJEK',
						'EKSTRAKOMPTABEL','',
						'semester','1','0','1','4','1','0',$IdL		
					);
	itemListDocument(
						'Format IV.C.6 - REKAPITULASI PENERIMAAN BMD INTERNAL PENGGUNA BARANG BERUPA……. (1) - MENURUT  JENIS',
						'Format_IV_B_1_3',	'Format.IV.C.6',
						'REKAPITULASI PENERIMAAN BMD INTERNAL PENGGUNA BARANG BERUPA……. (1)<br>MENURUT   JENIS',
						'EKSTRAKOMPTABEL','',
						'semester','1','0','1','3','1','0',$IdL		
					);

  ?>
<tr height="22">
    <td>&nbsp;</td>
    <td></td>
  </tr>
<tr height="22">
    <td>&nbsp;</td>
    <td><u>Format IV.D</u></td>
  </tr>
  
  <?php
	itemListDocument(
						'Format IV.D.1 - LAPORAN PENGELUARAN BMD INTERNAL PENGGUNA BARANG BERUPA……. (1) - BULAN',
						'Format_IV_D_1',	'Format.IV.D.1',
						'LAPORAN PENGELUARAN BMD INTERNAL PENGGUNA BARANG BERUPA……. (1)',
						'EKSTRAKOMPTABEL','',
						'bulan','1','1','1','4','1','0',$IdL	
					);

	itemListDocument(
						'Format IV.D.2 - LAPORAN PENGELUARAN BMD INTERNAL PENGGUNA BARANG BERUPA……. (1) - SEMESTER',
						'Format_IV_D_1',	'Format.IV.D.2',
						'LAPORAN PENGELUARAN BMD INTERNAL PENGGUNA BARANG BERUPA……. (1)',
						'EKSTRAKOMPTABEL','',
						'semester','1','1','1','4','1','0',$IdL		
					);

	itemListDocument(
						'Format IV.D.3 -REKAPITULASI PENGELUARAN BMD INTERNAL PENGGUNA BARANG BERUPA……. (1) - MENURUT SUB RINCIAN OBJEK',
						'Format_IV_B_1_3',	'Format.IV.D.3',
						'REKAPITULASI PENGELUARAN BMD INTERNAL PENGGUNA BARANG BERUPA……. (1)<br>MENURUT SUB RINCIAN OBJEK',
						'EKSTRAKOMPTABEL','',
						'semester','1','0','1','6','1','0',$IdL		
					);
	itemListDocument(
						'Format IV.D.4 - REKAPITULASI PENGELUARAN BMD INTERNAL PENGGUNA BARANG BERUPA……. (1) - MENURUT RINCIAN OBJEK',
						'Format_IV_B_1_3',	'Format.IV.D.4',
						'REKAPITULASI PENGELUARAN BMD INTERNAL PENGGUNA BARANG BERUPA……. (1)<br>MENURUT  RINCIAN OBJEK',
						'EKSTRAKOMPTABEL','',
						'semester','1','0','1','5','1','0',$IdL		
					);
	itemListDocument(
						'Format IV.D.5 - REKAPITULASI PENGELUARAN BMD INTERNAL PENGGUNA BARANG BERUPA……. (1) - MENURUT  OBJEK',
						'Format_IV_B_1_3',	'Format.IV.D.5',
						'REKAPITULASI PENGELUARAN BMD INTERNAL PENGGUNA BARANG BERUPA……. (1)<br>MENURUT   OBJEK',
						'EKSTRAKOMPTABEL','',
						'semester','1','0','1','4','1','0',$IdL		
					);
	itemListDocument(
						'Format IV.D.6 - REKAPITULASI PENGELUARAN BMD INTERNAL PENGGUNA BARANG BERUPA……. (1) - MENURUT  JENIS',
						'Format_IV_B_1_3',	'Format.IV.D.6',
						'REKAPITULASI PENGELUARAN BMD INTERNAL PENGGUNA BARANG BERUPA……. (1)<br>MENURUT   JENIS',
						'EKSTRAKOMPTABEL','',
						'semester','1','0','1','3','1','0',$IdL		
					);

	itemListDocument(
						'Format IV.D.7 - REKAPITULASI GABUNGAN PENGELUARAN DAN PENERIMAAN BMD INTERNAL PENGGUNA BARANG BERUPA……. (1)',
						'Format_IV_D_7',	'Format.IV.D.7',
						'REKAPITULASI GABUNGAN PENGELUARAN DAN PENERIMAAN BMD INTERNAL PENGGUNA BARANG BERUPA……. (1)',
						'EKSTRAKOMPTABEL','',
						'semester','1','1','1','6','1','0',$IdL		
					);
	

	?>
<tr height="22">
    <td>&nbsp;</td>
    <td></td>
  </tr>

<tr height="22">
    <td>&nbsp;</td>
    <td><u>Format IV.E</u></td>
  </tr>
  
  <?php
	itemListDocument(
						'Format IV.E.1 - LAPORAN PEMANFAATAN BMD - BULAN',
						'Format_IV_E_1',	'Format.IV.E.1',
						'LAPORAN PEMANFAATAN BMD',
						'EKSTRAKOMPTABEL','BENTUK PEMANFAATAN……(2)',
						'bulan','1','0','1','4','1','0',$IdL	
					);

	itemListDocument(
						'Format IV.E.2 - LAPORAN PEMANFAATAN BMD - SEMESTER',
						'Format_IV_E_1',	'Format.IV.E.2',
						'LAPORAN PEMANFAATAN BMD',
						'EKSTRAKOMPTABEL','BENTUK PEMANFAATAN……(2)',
						'semester','1','0','1','4','1','0',$IdL	
					);

	itemListDocument(
						'Format IV.E.3 - LAPORAN PENGAKHIRAN PEMANFAATAN BMD - BULAN',
						'Format_IV_E_3',	'Format.IV.E.3',
						'LAPORAN PENGAKHIRAN PEMANFAATAN BMD',
						'EKSTRAKOMPTABEL','',
						'bulan','1','0','1','4','1','0',$IdL		
					);

	itemListDocument(
						'Format IV.E.4 - LAPORAN PENGAKHIRAN PEMANFAATAN BMD - SEMESTER',
						'Format_IV_E_3',	'Format.IV.E.4',
						'LAPORAN PENGAKHIRAN PEMANFAATAN BMD',
						'EKSTRAKOMPTABEL','',
						'semester','1','0','1','4','1','0',$IdL		
					);

	itemListDocument(
						'Format IV.E.5 - REKAPITULASI LAPORAN PEMANFAATAN BMD',
						'Format_IV_E_1',	'Format.IV.E.5',
						'REKAPITULASI LAPORAN PEMANFAATAN BMD',
						'EKSTRAKOMPTABEL','BENTUK PEMANFAATAN……(2)',
						'semester','0','0','1','4','1','0',$IdL		
					);
	

	?>
<tr height="22">
    <td>&nbsp;</td>
    <td></td>
  </tr>
<tr height="22">
    <td>&nbsp;</td>
    <td><u>Format IV.F</u></td>
  </tr>
  
  <?php
	itemListDocument(
						'Format IV.F.1 - LAPORAN PENAMBAHAN AKIBAT REKLASIFIKASI BMD BERUPA……. - BULAN',
						'Format_IV_F_1',	'Format.IV.F.1',
						'LAPORAN PENAMBAHAN AKIBAT REKLASIFIKASI BMD BERUPA ...',
						'EKSTRAKOMPTABEL','',
						'bulan','1','0','1','4','1','0',$IdL	
					);
	itemListDocument(
						'Format IV.F.2 - LAPORAN PENAMBAHAN AKIBAT REKLASIFIKASI BMD BERUPA……. - SEMESTER',
						'Format_IV_F_1',	'Format.IV.F.2',
						'LAPORAN PENAMBAHAN AKIBAT REKLASIFIKASI BMD BERUPA ...',
						'EKSTRAKOMPTABEL','',
						'semester','1','0','1','4','1','0',$IdL	
					);

	itemListDocument(
						'Format IV.F.3 -REKAPITULASI PENAMBAHAN AKIBAT REKLASIFIKASI BMD BERUPA……. - MENURUT SUB RINCIAN OBJEK',
						'Format_IV_B_1_3',	'Format.IV.F.3',
						'REKAPITULASI PENAMBAHAN AKIBAT REKLASIFIKASI BMD BERUPA…….<br>MENURUT SUB RINCIAN OBJEK',
						'EKSTRAKOMPTABEL','',
						'semester','1','0','1','6','1','0',$IdL		
					);
	itemListDocument(
						'Format IV.F.4 - REKAPITULASI PENAMBAHAN AKIBAT REKLASIFIKASI BMD BERUPA……. - MENURUT RINCIAN OBJEK',
						'Format_IV_B_1_3',	'Format.IV.F.4',
						'REKAPITULASI PENAMBAHAN AKIBAT REKLASIFIKASI BMD BERUPA…….<br>MENURUT  RINCIAN OBJEK',
						'EKSTRAKOMPTABEL','',
						'semester','1','0','1','5','1','0',$IdL		
					);
	itemListDocument(
						'Format IV.F.5 - REKAPITULASI PENAMBAHAN AKIBAT REKLASIFIKASI BMD BERUPA……. - MENURUT  OBJEK',
						'Format_IV_B_1_3',	'Format.IV.F.5',
						'REKAPITULASI PENAMBAHAN AKIBAT REKLASIFIKASI BMD BERUPA…….<br>MENURUT   OBJEK',
						'EKSTRAKOMPTABEL','',
						'semester','1','0','1','4','1','0',$IdL		
					);
	itemListDocument(
						'Format IV.F.6 - REKAPITULASI PENAMBAHAN AKIBAT REKLASIFIKASI BMD BERUPA……. - MENURUT  JENIS',
						'Format_IV_B_1_3',	'Format.IV.F.6',
						'REKAPITULASI PENAMBAHAN AKIBAT REKLASIFIKASI BMD BERUPA…….<br>MENURUT   JENIS',
						'EKSTRAKOMPTABEL','',
						'semester','1','0','1','3','1','0',$IdL		
					);

	itemListDocument(
						'Format IV.F.7 -REKAPITULASI PENAMBAHAN AKIBAT REKLASIFIKASI BMD BERUPA……. - MENURUT SUB RINCIAN OBJEK',
						'Format_IV_B_1_3',	'Format.IV.F.7',
						'REKAPITULASI PENAMBAHAN AKIBAT REKLASIFIKASI BMD BERUPA…….<br>MENURUT SUB RINCIAN OBJEK',
						'EKSTRAKOMPTABEL','',
						'semester','0','0','1','6','0','1',$IdL		
					);
	itemListDocument(
						'Format IV.F.8 - REKAPITULASI PENAMBAHAN AKIBAT REKLASIFIKASI BMD BERUPA……. - MENURUT RINCIAN OBJEK',
						'Format_IV_B_1_3',	'Format.IV.F.8',
						'REKAPITULASI PENAMBAHAN AKIBAT REKLASIFIKASI BMD BERUPA…….<br>MENURUT  RINCIAN OBJEK',
						'EKSTRAKOMPTABEL','',
						'semester','0','0','1','5','0','1',$IdL		
					);
	itemListDocument(
						'Format IV.F.9 - REKAPITULASI PENAMBAHAN AKIBAT REKLASIFIKASI BMD BERUPA……. - MENURUT  OBJEK',
						'Format_IV_B_1_3',	'Format.IV.F.9',
						'REKAPITULASI PENAMBAHAN AKIBAT REKLASIFIKASI BMD BERUPA…….<br>MENURUT   OBJEK',
						'EKSTRAKOMPTABEL','',
						'semester','0','0','1','4','0','1',$IdL		
					);
	itemListDocument(
						'Format IV.F.10 - REKAPITULASI PENAMBAHAN AKIBAT REKLASIFIKASI BMD BERUPA……. - MENURUT  JENIS',
						'Format_IV_B_1_3',	'Format.IV.F.10',
						'REKAPITULASI PENAMBAHAN AKIBAT REKLASIFIKASI BMD BERUPA…….<br>MENURUT   JENIS',
						'EKSTRAKOMPTABEL','',
						'semester','0','0','1','3','0','1',$IdL		
					);

	itemListDocument(
						'Format IV.F.11 - LAPORAN PENGURANGAN AKIBAT REKLASIFIKASI BMD BERUPA……. - BULAN',
						'Format_IV_F_1',	'Format.IV.F.11',
						'LAPORAN PENGURANGAN AKIBAT REKLASIFIKASI BMD BERUPA ...',
						'EKSTRAKOMPTABEL','',
						'bulan','1','0','1','4','1','0',$IdL	
					);
	itemListDocument(
						'Format IV.F.12 - LAPORAN PENGURANGAN AKIBAT REKLASIFIKASI BMD BERUPA……. - SEMESTER',
						'Format_IV_F_1',	'Format.IV.F.12',
						'LAPORAN PENGURANGAN AKIBAT REKLASIFIKASI BMD BERUPA ...',
						'EKSTRAKOMPTABEL','',
						'semester','1','0','1','4','1','0',$IdL	
					);

	itemListDocument(
						'Format IV.F.13 -REKAPITULASI PENGURANGAN AKIBAT REKLASIFIKASI BMD BERUPA……. - MENURUT SUB RINCIAN OBJEK',
						'Format_IV_B_1_3',	'Format.IV.F.13',
						'REKAPITULASI PENGURANGAN AKIBAT REKLASIFIKASI BMD BERUPA…….<br>MENURUT SUB RINCIAN OBJEK',
						'EKSTRAKOMPTABEL','',
						'semester','1','0','1','6','1','0',$IdL		
					);
	itemListDocument(
						'Format IV.F.14 - REKAPITULASI PENGURANGAN AKIBAT REKLASIFIKASI BMD BERUPA……. - MENURUT RINCIAN OBJEK',
						'Format_IV_B_1_3',	'Format.IV.F.14',
						'REKAPITULASI PENGURANGAN AKIBAT REKLASIFIKASI BMD BERUPA…….<br>MENURUT  RINCIAN OBJEK',
						'EKSTRAKOMPTABEL','',
						'semester','1','0','1','5','1','',$IdL		
					);
	itemListDocument(
						'Format IV.F.15 - REKAPITULASI PENGURANGAN AKIBAT REKLASIFIKASI BMD BERUPA……. - MENURUT  OBJEK',
						'Format_IV_B_1_3',	'Format.IV.F.15',
						'REKAPITULASI PENGURANGAN AKIBAT REKLASIFIKASI BMD BERUPA…….<br>MENURUT   OBJEK',
						'EKSTRAKOMPTABEL','',
						'semester','1','0','1','4','1','0',$IdL		
					);
	itemListDocument(
						'Format IV.F.16 - REKAPITULASI PENGURANGAN AKIBAT REKLASIFIKASI BMD BERUPA……. - MENURUT  JENIS',
						'Format_IV_B_1_3',	'Format.IV.F.16',
						'REKAPITULASI PENGURANGAN AKIBAT REKLASIFIKASI BMD BERUPA…….<br>MENURUT   JENIS',
						'EKSTRAKOMPTABEL','',
						'semester','1','0','1','3','1','0',$IdL		
					);
	itemListDocument(
						'Format IV.F.17 -REKAPITULASI PENGURANGAN AKIBAT REKLASIFIKASI BMD BERUPA……. - MENURUT SUB RINCIAN OBJEK',
						'Format_IV_B_1_3',	'Format.IV.F.17',
						'REKAPITULASI PENGURANGAN AKIBAT REKLASIFIKASI BMD BERUPA…….<br>MENURUT SUB RINCIAN OBJEK',
						'EKSTRAKOMPTABEL','',
						'semester','0','0','1','6','0','1',$IdL		
					);
	itemListDocument(
						'Format IV.F.18 - REKAPITULASI PENGURANGAN AKIBAT REKLASIFIKASI BMD BERUPA……. - MENURUT RINCIAN OBJEK',
						'Format_IV_B_1_3',	'Format.IV.F.18',
						'REKAPITULASI PENGURANGAN AKIBAT REKLASIFIKASI BMD BERUPA…….<br>MENURUT  RINCIAN OBJEK',
						'EKSTRAKOMPTABEL','',
						'semester','0','0','1','5','0','1',$IdL		
					);
	itemListDocument(
						'Format IV.F.19 - REKAPITULASI PENGURANGAN AKIBAT REKLASIFIKASI BMD BERUPA……. - MENURUT  OBJEK',
						'Format_IV_B_1_3',	'Format.IV.F.19',
						'REKAPITULASI PENGURANGAN AKIBAT REKLASIFIKASI BMD BERUPA…….<br>MENURUT   OBJEK',
						'EKSTRAKOMPTABEL','',
						'semester','0','0','1','4','0','1',$IdL		
					);
	itemListDocument(
						'Format IV.F.20 - REKAPITULASI PENGURANGAN AKIBAT REKLASIFIKASI BMD BERUPA……. - MENURUT  JENIS',
						'Format_IV_B_1_3',	'Format.IV.F.20',
						'REKAPITULASI PENGURANGAN AKIBAT REKLASIFIKASI BMD BERUPA…….<br>MENURUT   JENIS',
						'EKSTRAKOMPTABEL','',
						'semester','0','0','1','3','0','1',$IdL		
					);
						

	?>
	<tr height="22">
    <td>&nbsp;</td>
    <td></td>
  </tr>

<tr height="22">
    <td>&nbsp;</td>
    <td><u>Format IV.G</u></td>
  </tr>
  
  <?php
	itemListDocument(
						'Format IV.G.1 - LAPORAN KOREKSI BMD BERUPA……. (1) - BULAN',
						'Format_IV_G_1',	'Format.IV.G.1',
						'LAPORAN KOREKSI BMD BERUPA……. (1)',
						'EKSTRAKOMPTABEL','',
						'bulan','1','0','1','7','1','0',$IdL	
					);
	itemListDocument(
						'Format IV.G.2 - LAPORAN KOREKSI BMD BERUPA……. (1) - SEMESTER',
						'Format_IV_G_1',	'Format.IV.G.2',
						'LAPORAN KOREKSI BMD BERUPA……. (1)',
						'EKSTRAKOMPTABEL','',
						'semester','1','0','1','7','1','0',$IdL	
					);

	itemListDocument(
						'Format IV.G.3 - REKAPITULASI PENJELASAN SELISIH NILAI KOREKSI TAMBAH DAN KURANG BMD BERUPA…….  - MENURUT SUB SUB RINCIAN OBJEK',
						'Format_IV_G_3',	'Format.IV.G.3',
						'REKAPITULASI PENJELASAN SELISIH NILAI KOREKSI TAMBAH DAN KURANG BMD BERUPA…….<br>MENURUT SUB SUB RINCIAN OBJEK',
						'EKSTRAKOMPTABEL','',
						'semester','1','0','1','7','1','0',$IdL		
					);
	itemListDocument(
						'Format IV.G.4 - REKAPITULASI PENJELASAN SELISIH NILAI KOREKSI TAMBAH DAN KURANG BMD BERUPA……. - MENURUT SUB RINCIAN OBJEK',
						'Format_IV_G_7',	'Format.IV.G.4',
						'REKAPITULASI PENJELASAN SELISIH NILAI KOREKSI TAMBAH DAN KURANG BMD BERUPA…….<br>MENURUT SUB  RINCIAN OBJEK',
						'EKSTRAKOMPTABEL','',
						'semester','1','0','1','5','1','0',$IdL		
					);
	itemListDocument(
						'Format IV.G.5 - REKAPITULASI PENJELASAN SELISIH NILAI KOREKSI TAMBAH DAN KURANG BMD BERUPA……. - MENURUT RINCIAN OBJEK',
						'Format_IV_G_7',	'Format.IV.G.5',
						'REKAPITULASI PENJELASAN SELISIH NILAI KOREKSI TAMBAH DAN KURANG BMD BERUPA…….<br>MENURUT  RINCIAN OBJEK',
						'EKSTRAKOMPTABEL','',
						'semester','1','0','1','4','1','0',$IdL		
					);
	itemListDocument(
						'Format IV.G.6 - REKAPITULASI PENJELASAN SELISIH NILAI KOREKSI TAMBAH DAN KURANG BMD BERUPA……. - MENURUT  OBJEK',
						'Format_IV_G_7',	'Format.IV.G.6',
						'REKAPITULASI PENJELASAN SELISIH NILAI KOREKSI TAMBAH DAN KURANG BMD BERUPA…….<br>MENURUT   OBJEK',
						'EKSTRAKOMPTABEL','',
						'semester','1','0','1','3','1','0',$IdL		
					);

	itemListDocument(
						'Format IV.G.7 - REKAPITULASI PENJELASAN SELISIH NILAI KOREKSI TAMBAH DAN KURANG BMD BERUPA……. - MENURUT  JENIS',
						'Format_IV_G_7',	'Format.IV.G.7',
						'REKAPITULASI PENJELASAN SELISIH NILAI KOREKSI TAMBAH DAN KURANG BMD BERUPA…….<br>MENURUT   JENIS',
						'EKSTRAKOMPTABEL','',
						'semester','1','0','1','3','1','0',$IdL		
					);

	itemListDocument(
						'Format IV.G.8 - REKAPITULASI PENJELASAN SELISIH NILAI KOREKSI TAMBAH DAN KURANG BMD BERUPA…….  - MENURUT SUB RINCIAN OBJEK',
						'Format_IV_G_7',	'Format.IV.G.8',
						'REKAPITULASI PENJELASAN SELISIH NILAI KOREKSI TAMBAH DAN KURANG BMD BERUPA…….<br>MENURUT SUB RINCIAN OBJEK',
						'EKSTRAKOMPTABEL','',
						'semester','1','0','1','6','0','0',$IdL		
					);
	itemListDocument(
						'Format IV.G.9 - REKAPITULASI PENJELASAN SELISIH NILAI KOREKSI TAMBAH DAN KURANG BMD BERUPA……. - MENURUT RINCIAN OBJEK',
						'Format_IV_G_7',	'Format.IV.G.9',
						'REKAPITULASI PENJELASAN SELISIH NILAI KOREKSI TAMBAH DAN KURANG BMD BERUPA…….<br>MENURUT  RINCIAN OBJEK',
						'EKSTRAKOMPTABEL','',
						'semester','1','0','1','5','0','0',$IdL		
					);
	itemListDocument(
						'Format IV.G.10 - REKAPITULASI PENJELASAN SELISIH NILAI KOREKSI TAMBAH DAN KURANG BMD BERUPA……. - MENURUT  OBJEK',
						'Format_IV_G_7',	'Format.IV.G.10',
						'REKAPITULASI PENJELASAN SELISIH NILAI KOREKSI TAMBAH DAN KURANG BMD BERUPA…….<br>MENURUT   OBJEK',
						'EKSTRAKOMPTABEL','',
						'semester','1','0','1','4','0','0',$IdL		
					);
	itemListDocument(
						'Format IV.G.11 - REKAPITULASI PENJELASAN SELISIH NILAI KOREKSI TAMBAH DAN KURANG BMD BERUPA……. - MENURUT  JENIS',
						'Format_IV_G_7',	'Format.IV.G.11',
						'REKAPITULASI PENJELASAN SELISIH NILAI KOREKSI TAMBAH DAN KURANG BMD BERUPA…….<br>MENURUT   JENIS',
						'EKSTRAKOMPTABEL','',
						'semester','1','0','1','3','0','0',$IdL		
					);

	?>
	<tr height="22">
    <td>&nbsp;</td>
    <td></td>
  </tr>
<tr height="22">
    <td>&nbsp;</td>
    <td><u>Format IV.H</u></td>
  </tr>
  
  <?php
	itemListDocument(
						'Format IV.H.1 - PENYUSUTAN ATAU AMORTISASI BMD (1) ',
						'Format_IV_H_1',	'Format.IV.H.1',
						'PENYUSUTAN ATAU AMORTISASI BMD (1)',
						'EKSTRAKOMPTABEL','ASET TETAP / ASET  LAINNYA',
						'','0','0','1','7','1','1',$IdL	
					);
	itemListDocument(
						'Format IV.H.2 -LAPORAN AKUMULASI PENYUSUTAN ATAU AMORTISASI BMD (1) MENURUT SUB RINCIAN OBJEK',
						'Format_IV_A_1_3_3',	'Format.IV.H.2',
						'LAPORAN AKUMULASI PENYUSUTAN ATAU AMORTISASI BMD (1)',
						'EKSTRAKOMPTABEL','MENURUT SUB RINCIAN OBJEK',
						'semester','0','0','1','6','1','1',$IdL	
					);
	itemListDocument(
						'Format IV.H.3 -LAPORAN AKUMULASI PENYUSUTAN ATAU AMORTISASI BMD (1) MENURUT  RINCIAN OBJEK',
						'Format_IV_A_1_3_3',	'Format.IV.H.3',
						'LAPORAN AKUMULASI PENYUSUTAN ATAU AMORTISASI BMD (1)',
						'EKSTRAKOMPTABEL','MENURUT  RINCIAN OBJEK',
						'semester','0','0','1','5','1','1',$IdL	
					);
	itemListDocument(
						'Format IV.H.4 -LAPORAN AKUMULASI PENYUSUTAN ATAU AMORTISASI BMD (1) MENURUT  OBJEK',
						'Format_IV_A_1_3_3',	'Format.IV.H.4',
						'LAPORAN AKUMULASI PENYUSUTAN ATAU AMORTISASI BMD (1)',
						'EKSTRAKOMPTABEL','MENURUT  OBJEK',
						'semester','0','0','1','4','1','1',$IdL	
					);

	itemListDocument(
						'Format IV.H.5 -LAPORAN AKUMULASI PENYUSUTAN ATAU AMORTISASI BMD (1) MENURUT JENIS',
						'Format_IV_A_1_3_3',	'Format.IV.H.5',
						'LAPORAN AKUMULASI PENYUSUTAN ATAU AMORTISASI BMD (1)',
						'EKSTRAKOMPTABEL','MENURUT JENIS',
						'semester','0','0','1','4','1','1',$IdL	
					);
	itemListDocument(
						'Format IV.H.6 -LAPORAN REKAPITULASI AKUMULASI PENYUSUTAN ATAU AMORTISASI BMD (1) MENURUT SUB RINCIAN OBJEK' ,
						'Format_IV_A_1_3_3',	'Format.IV.H.6',
						'LAPORAN REKAPITULASI AKUMULASI PENYUSUTAN ATAU AMORTISASI BMD (1)',
						'EKSTRAKOMPTABEL','MENURUT SUB RINCIAN OBJEK',
						'semester','0','0','1','6','1','1',$IdL	
					);
	itemListDocument(
						'Format IV.H.7 -LAPORAN REKAPITULASI AKUMULASI PENYUSUTAN ATAU AMORTISASI BMD (1) MENURUT  RINCIAN OBJEK',
						'Format_IV_A_1_3_3',	'Format.IV.H.7',
						'LAPORAN REKAPITULASI AKUMULASI PENYUSUTAN ATAU AMORTISASI BMD (1)',
						'EKSTRAKOMPTABEL','MENURUT  RINCIAN OBJEK',
						'semester','0','0','1','5','1','1',$IdL	
					);
	itemListDocument(
						'Format IV.H.8 -LAPORAN REKAPITULASI AKUMULASI PENYUSUTAN ATAU AMORTISASI BMD (1) MENURUT  OBJEK',
						'Format_IV_A_1_3_3',	'Format.IV.H.8',
						'LAPORAN REKAPITULASI AKUMULASI PENYUSUTAN ATAU AMORTISASI BMD (1)',
						'EKSTRAKOMPTABEL','MENURUT  OBJEK',
						'semester','0','0','1','4','1','1',$IdL	
					);

	itemListDocument(
						'Format IV.H.9 -LAPORAN REKAPITULASI AKUMULASI PENYUSUTAN ATAU AMORTISASI BMD (1) MENURUT JENIS',
						'Format_IV_A_1_3_3',	'Format.IV.H.9',
						'LAPORAN REKAPITULASI AKUMULASI PENYUSUTAN ATAU AMORTISASI BMD (1)',
						'EKSTRAKOMPTABEL','MENURUT JENIS',
						'semester','0','0','1','4','1','1',$IdL	
					);

	?>
<tr height="22">
    <td>&nbsp;</td>
    <td></td>
  </tr>
<tr height="22">
    <td>&nbsp;</td>
    <td><u>Format IV.I</u></td>
  </tr>
  
  <?php
	itemListDocument(
						'Format IV.I.1 - LAPORAN PERSEDIAAN RUSAK BERAT ATAU USANG ',
						'Format_IV_I_1',	'Format.IV.I.1',
						'LAPORAN PERSEDIAAN RUSAK BERAT ATAU USANG',
						'','',
						'bulan','0','0','1','7','0','0',$IdL	
					);
	itemListDocument(
						'Format IV.I.2 - LAPORAN PERSEDIAAN RUSAK BERAT ATAU USANG ',
						'Format_IV_I_1',	'Format.IV.I.2',
						'LAPORAN PERSEDIAAN RUSAK BERAT ATAU USANG',
						'','',
						'semester','0','0','1','7','0','0',$IdL	
					);

	itemListDocument(
						'Format IV.I.3 - REKAPITULASI PERSEDIAAN RUSAK BERAT ATAU USANG - MENURUT SUB RINCIAN OBJEK',
						'Format_IV_A_1_3_7',	'Format.IV.I.3',
						'LAPORAN PERSEDIAAN RUSAK BERAT ATAU USANG',
						'','MENURUT SUB RINCIAN OBJEK',
						'semester','1','1','1','6','1','0',$IdL	
					);
	itemListDocument(
						'Format IV.I.4 - REKAPITULASI PERSEDIAAN RUSAK BERAT ATAU USANG - MENURUT  RINCIAN OBJEK',
						'Format_IV_A_1_3_7',	'Format.IV.I.4',
						'LAPORAN PERSEDIAAN RUSAK BERAT ATAU USANG',
						'','MENURUT  RINCIAN OBJEK',
						'semester','1','1','1','5','1','0',$IdL	
					);
	itemListDocument(
						'Format IV.I.5 - REKAPITULASI PERSEDIAAN RUSAK BERAT ATAU USANG - MENURUT   OBJEK',
						'Format_IV_A_1_3_7',	'Format.IV.I.5',
						'LAPORAN PERSEDIAAN RUSAK BERAT ATAU USANG',
						'','MENURUT   OBJEK',
						'semester','1','1','1','4','1','0',$IdL	
					);
	itemListDocument(
						'Format IV.I.6 - LAPORAN PERSEDIAAN RUSAK BERAT ATAU USANG - MENURUT SUB RINCIAN OBJEK',
						'Format_IV_A_1_3_7',	'Format.IV.I.6',
						'LAPORAN PERSEDIAAN RUSAK BERAT ATAU USANG',
						'','MENURUT SUB RINCIAN OBJEK',
						'semester','0','0','1','6','0','1',$IdL	
					);
	itemListDocument(
						'Format IV.I.7 - REKAPITULASI PERSEDIAAN RUSAK BERAT ATAU USANG - MENURUT  RINCIAN OBJEK',
						'Format_IV_A_1_3_7',	'Format.IV.I.7',
						'REKAPITULASI PERSEDIAAN RUSAK BERAT ATAU USANG',
						'','MENURUT  RINCIAN OBJEK',
						'semester','0','0','1','6','0','1',$IdL	
					);
	itemListDocument(
						'Format IV.I.8 - REKAPITULASI PERSEDIAAN RUSAK BERAT ATAU USANG - MENURUT   OBJEK',
						'Format_IV_A_1_3_7',	'Format.IV.I.8',
						'REKAPITULASI PERSEDIAAN RUSAK BERAT ATAU USANG',
						'','MENURUT   OBJEK',
						'semester','0','0','1','6','0','1',$IdL	
					);
	itemListDocument(
						'Format IV.I.9 - REKAPITULASI PERSEDIAAN RUSAK BERAT ATAU USANG - MENURUT JENIS',
						'Format_IV_A_1_3_7',	'Format.IV.I.9',
						'REKAPITULASI PERSEDIAAN RUSAK BERAT ATAU USANG',
						'','MENURUT JENIS',
						'semester','0','0','1','6','0','1',$IdL	
					);
	itemListDocument(
						'Format IV.I.10 - LAPORAN PERSEDIAAN',
						'Format_IV_I_10',	'Format.IV.I.10',
						'LAPORAN PERSEDIAAN',
						'','',
						'semester','0','0','1','7','0','0',$IdL	
					);
	itemListDocument(
						'Format IV.I.11 - REKAPITULASI PERSEDIAAN - MENURUT SUB RINCIAN OBJEK',
						'Format_IV_I_11',	'Format.IV.I.11',
						'REKAPITULASI PERSEDIAAN',
						'','MENURUT SUB RINCIAN OBJEK',
						'semester','0','0','1','6','0','0',$IdL	
					);
	itemListDocument(
						'Format IV.I.12 - REKAPITULASI PERSEDIAAN - MENURUT  RINCIAN OBJEK',
						'Format_IV_I_11',	'Format.IV.I.12',
						'REKAPITULASI PERSEDIAAN',
						'','MENURUT  RINCIAN OBJEK',
						'semester','0','0','1','5','0','0',$IdL	
					);
	itemListDocument(
						'Format IV.I.13 - REKAPITULASI PERSEDIAAN - MENURUT   OBJEK',
						'Format_IV_I_11',	'Format.IV.I.13',
						'REKAPITULASI PERSEDIAAN',
						'','MENURUT   OBJEK',
						'semester','0','0','1','4','0','0',$IdL	
					);
	itemListDocument(
						'Format IV.I.14 - LAPORAN PERSEDIAAN - MENURUT SUB RINCIAN OBJEK',
						'Format_IV_I_11',	'Format.IV.I.14',
						'LAPORAN PERSEDIAAN',
						'','MENURUT SUB RINCIAN OBJEK',
						'semester','0','0','1','6','0','1',$IdL	
					);
	itemListDocument(
						'Format IV.I.15 - LAPORAN PERSEDIAAN - MENURUT  RINCIAN OBJEK',
						'Format_IV_I_11',	'Format.IV.I.15',
						'LAPORAN PERSEDIAAN',
						'','MENURUT  RINCIAN OBJEK',
						'semester','0','0','1','5','0','1',$IdL	
					);
	itemListDocument(
						'Format IV.I.16 - LAPORAN PERSEDIAAN - MENURUT   OBJEK',
						'Format_IV_I_11',	'Format.IV.I.16',
						'LAPORAN PERSEDIAAN',
						'','MENURUT   OBJEK',
						'semester','0','0','1','4','0','1',$IdL	
					);
	itemListDocument(
						'Format IV.I.17 - LAPORAN PERSEDIAAN - MENURUT JENIS',
						'Format_IV_I_11',	'Format.IV.I.17',
						'LAPORAN PERSEDIAAN',
						'','MENURUT JENIS',
						'semester','0','0','1','3','0','1',$IdL	
					);
	itemListDocument(
						'Format IV.I.18 - BERITA ACARA INVENTARISASI FISIK PERSEDIAAN (STOCK OPNAME)',
						'Format_IV_I_11',	'Format.IV.I.18',
						'BERITA ACARA INVENTARISASI FISIK PERSEDIAAN (STOCK OPNAME)',
						'','',
						'semester','0','0','1','3','0','1',$IdL	
					);
					

	?>
<tr height="22">
    <td>&nbsp;</td>
    <td></td>
  </tr>
<tr height="22">
    <td>&nbsp;</td>
    <td><u>Format IV.J</u></td>
  </tr>
  
  <?php
	itemListDocument(
						'Format IV.J.1.1 - LAPORAN PENGGUNAAN/PEMAKAIAN BMD PERALATAN DAN MESIN - BULAN ',
						'Format_IV_J_1_1',	'Format.IV.J.1.1',
						'LAPORAN PENGGUNAAN/PEMAKAIAN BMD PERALATAN DAN MESIN',
						'','',
						'bulan','1','0','0','4','1','0',$IdL	
					);
	itemListDocument(
						'Format IV.J.1.2 - LAPORAN PENGGUNAAN/PEMAKAIAN BMD PERALATAN DAN MESIN - SEMESTER ',
						'Format_IV_J_1_1',	'Format.IV.J.1.2',
						'LAPORAN PENGGUNAAN/PEMAKAIAN BMD PERALATAN DAN MESIN',
						'','',
						'semester','1','0','0','4','1','0',$IdL	
					);
	itemListDocument(
						'Format IV.J.1.3 - LAPORAN PENGEMBALIAN PENGGUNAAN/PEMAKAIAN BMD PERALATAN DAN MESIN - BULAN ',
						'Format_IV_J_2_3',	'Format.IV.J.1.3',
						'LAPORAN PENGEMBALIAN PENGGUNAAN/PEMAKAIAN BMD PERALATAN DAN MESIN',
						'','',
						'bulan','1','0','0','4','1','0',$IdL	
					);
	itemListDocument(
						'Format IV.J.1.4 - LAPORAN PENGEMBALIAN PENGGUNAAN/PEMAKAIAN BMD PERALATAN DAN MESIN - SEMESTER ',
						'Format_IV_J_2_3',	'Format.IV.J.1.4',
						'LAPORAN PENGEMBALIAN PENGGUNAAN/PEMAKAIAN BMD PERALATAN DAN MESIN',
						'','',
						'semester','1','0','0','4','1','0',$IdL	
					);
	itemListDocument(
						'Format IV.J.2.1 - LAPORAN PENGGUNAAN/PEMAKAIAN BMD GEDUNG DAN BANGUNAN BERUPA RUMAH NEGARA - BULAN ',
						'Format_IV_J_2_1',	'Format.IV.J.2.1',
						'LAPORAN PENGGUNAAN/PEMAKAIAN BMD GEDUNG DAN BANGUNAN BERUPA RUMAH NEGARA',
						'','',
						'bulan','1','0','0','7','1','0',$IdL	
					);
	itemListDocument(
						'Format IV.J.2.2 - LAPORAN PENGGUNAAN/PEMAKAIAN BMD GEDUNG DAN BANGUNAN BERUPA RUMAH NEGARA - SEMESTER',
						'Format_IV_J_2_1',	'Format.IV.J.2.2',
						'LAPORAN PENGGUNAAN/PEMAKAIAN BMD GEDUNG DAN BANGUNAN BERUPA RUMAH NEGARA',
						'','',
						'semester','1','0','0','7','1','0',$IdL	
					);
	itemListDocument(
						'Format IV.J.2.3 - LAPORAN PENGEMBALIAN PENGGUNAAN/PEMAKAIAN BMD GEDUNG DAN BANGUNAN BERUPA RUMAH NEGARA - BULAN ',
						'Format_IV_J_2_3',	'Format.IV.J.2.3',
						'LAPORAN PENGEMBALIAN PENGGUNAAN/PEMAKAIAN BMD GEDUNG DAN BANGUNAN BERUPA RUMAH NEGARA',
						'','',
						'bulan','1','0','0','4','1','0',$IdL	
					);
	itemListDocument(
						'Format IV.J.2.4 - LAPORAN PENGEMBALIAN PENGGUNAAN/PEMAKAIAN BMD GEDUNG DAN BANGUNAN BERUPA RUMAH NEGARA - SEMESTER ',
						'Format_IV_J_2_3',	'Format.IV.J.2.4',
						'LAPORAN PENGEMBALIAN PENGGUNAAN/PEMAKAIAN BMD GEDUNG DAN BANGUNAN BERUPA RUMAH NEGARA',
						'','',
						'semester','1','0','0','4','1','0',$IdL	
					);

	?>
<tr height="22">
    <td>&nbsp;</td>
    <td></td>
  </tr>
<tr height="22">
    <td>&nbsp;</td>
    <td><u>Format IV.K</u></td>
  </tr>
  
  <?php
	itemListDocument(
						'Format IV.K.1.1 - LAPORAN PENGHAPUSAN BMD BERUPA……. (1) PENGHAPUSAN AKIBAT PEMINDAHTANGANAN BMD - BULAN ',
						'Format_IV_K_1_1',	'Format.IV.K.1.1',
						'LAPORAN PENGHAPUSAN BMD BERUPA……. (1) PENGHAPUSAN AKIBAT PEMINDAHTANGANAN BMD',
						'EKSTRAKOMPTABEL','',
						'bulan','1','0','0','7','1','0',$IdL	
					);
	itemListDocument(
						'Format IV.K.1.1 - LAPORAN PENGHAPUSAN BMD BERUPA……. (1) PENGHAPUSAN AKIBAT PEMINDAHTANGANAN BMD - SEMESTER ',
						'Format_IV_K_1_1',	'Format.IV.K.1.1',
						'LAPORAN PENGHAPUSAN BMD BERUPA……. (1) PENGHAPUSAN AKIBAT PEMINDAHTANGANAN BMD',
						'EKSTRAKOMPTABEL','',
						'semester','1','0','0','7','1','0',$IdL	
					);
	itemListDocument(
						'Format IV.K.1.3 - REKAPITULASI PENGHAPUSAN BMD BERUPA……..(1) PENGHAPUSAN AKIBAT PEMINDAHTANGANAN BMD - MENURUT SUB RINCIAN OBJEK',
						'Format_IV_K_3',	'Format.IV.K.1.3',
						'REKAPITULASI PENGHAPUSAN BMD BERUPA……..(1) ',
						'PENGHAPUSAN AKIBAT PEMINDAHTANGANAN BMD MENURUT SUB RINCIAN OBJEK','EKSTRAKOMPTABEL',
						'semester','1','0','0','6','1','0',$IdL	
					);
	itemListDocument(
						'Format IV.K.1.4 - REKAPITULASI PENGHAPUSAN BMD BERUPA……..(1) PENGHAPUSAN AKIBAT PEMINDAHTANGANAN BMD - MENURUT  RINCIAN OBJEK',
						'Format_IV_K_3',	'Format.IV.K.1.4',
						'REKAPITULASI PENGHAPUSAN BMD BERUPA……..(1) ',
						'PENGHAPUSAN AKIBAT PEMINDAHTANGANAN BMD MENURUT  RINCIAN OBJEK','EKSTRAKOMPTABEL',
						'semester','1','0','0','5','1','0',$IdL	
					);
	itemListDocument(
						'Format IV.K.1.5 - REKAPITULASI PENGHAPUSAN BMD BERUPA……..(1) PENGHAPUSAN AKIBAT PEMINDAHTANGANAN BMD - MENURUT   OBJEK',
						'Format_IV_K_3',	'Format.IV.K.1.5',
						'REKAPITULASI PENGHAPUSAN BMD BERUPA……..(1) ',
						'PENGHAPUSAN AKIBAT PEMINDAHTANGANAN BMD MENURUT   OBJEK','EKSTRAKOMPTABEL',
						'semester','1','0','0','4','1','0',$IdL	
					);
	itemListDocument(
						'Format IV.K.1.6 - REKAPITULASI PENGHAPUSAN BMD BERUPA……..(1) PENGHAPUSAN AKIBAT PEMINDAHTANGANAN BMD - MENURUT  JENIS',
						'Format_IV_K_3',	'Format.IV.K.1.6',
						'REKAPITULASI PENGHAPUSAN BMD BERUPA……..(1) ',
						'PENGHAPUSAN AKIBAT PEMINDAHTANGANAN BMD MENURUT JENIS','EKSTRAKOMPTABEL',
						'semester','1','0','0','3','1','0',$IdL	
					);

	itemListDocument(
						'Format IV.K.1.7 - LAPORAN PENGHAPUSAN BMD BERUPA……..(1) PENGHAPUSAN AKIBAT PEMINDAHTANGANAN BMD - MENURUT SUB RINCIAN OBJEK',
						'Format_IV_K_3',	'Format.IV.K.1.7',
						'LAPORAN PENGHAPUSAN BMD BERUPA……..(1) ',
						'PENGHAPUSAN AKIBAT PEMINDAHTANGANAN BMD MENURUT SUB RINCIAN OBJEK','EKSTRAKOMPTABEL',
						'semester','0','0','0','6','0','1',$IdL	
					);
	itemListDocument(
						'Format IV.K.1.8 - LAPORAN PENGHAPUSAN BMD BERUPA……..(1) PENGHAPUSAN AKIBAT PEMINDAHTANGANAN BMD - MENURUT  RINCIAN OBJEK',
						'Format_IV_K_3',	'Format.IV.K.1.8',
						'LAPORAN PENGHAPUSAN BMD BERUPA……..(1) ',
						'PENGHAPUSAN AKIBAT PEMINDAHTANGANAN BMD MENURUT  RINCIAN OBJEK','EKSTRAKOMPTABEL',
						'semester','0','0','0','5','0','1',$IdL	
					);
	itemListDocument(
						'Format IV.K.1.9 - LAPORAN PENGHAPUSAN BMD BERUPA……..(1) PENGHAPUSAN AKIBAT PEMINDAHTANGANAN BMD - MENURUT   OBJEK',
						'Format_IV_K_3',	'Format.IV.K.1.9',
						'LAPORAN PENGHAPUSAN BMD BERUPA……..(1) ',
						'PENGHAPUSAN AKIBAT PEMINDAHTANGANAN BMD MENURUT   OBJEK','EKSTRAKOMPTABEL',
						'semester','0','0','0','4','0','1',$IdL	
					);
	itemListDocument(
						'Format IV.K.1.10 - LAPORAN PENGHAPUSAN BMD BERUPA……..(1) PENGHAPUSAN AKIBAT PEMINDAHTANGANAN BMD - MENURUT  JENIS',
						'Format_IV_K_3',	'Format.IV.K.1.10',
						'LAPORAN PENGHAPUSAN BMD BERUPA……..(1) ',
						'PENGHAPUSAN AKIBAT PEMINDAHTANGANAN BMD MENURUT JENIS','EKSTRAKOMPTABEL',
						'semester','0','0','0','3','0','1',$IdL	
					);

	itemListDocument(
						'Format IV.K.2.1 - LAPORAN PENGHAPUSAN BMD BERUPA……. (1) - BULAN ',
						'Format_IV_K_2_1',	'Format.IV.K.2.1',
						'LAPORAN PENGHAPUSAN BMD BERUPA……. (1)',
						'PENGHAPUSAN KARENA PENYERAHAN ATAU PENGALIHAN STATUS PENGGUNAAN BMD','EKSTRAKOMPTABEL',
						'bulan','1','0','0','7','1','0',$IdL	
					);
	itemListDocument(
						'Format IV.K.2.2 - LAPORAN PENGHAPUSAN BMD BERUPA……. (1) - SEMESTER ',
						'Format_IV_K_2_1',	'Format.IV.K.2.2',
						'LAPORAN PENGHAPUSAN BMD BERUPA……. (1)',
						'PENGHAPUSAN KARENA PENYERAHAN ATAU PENGALIHAN STATUS PENGGUNAAN BMD','EKSTRAKOMPTABEL',
						'semester','1','0','0','7','1','0',$IdL	
					);
	itemListDocument(
						'Format IV.K.2.3 - REKAPITULASI PENGHAPUSAN BMD BERUPA……..(1) PENGHAPUSAN AKIBAT PEMINDAHTANGANAN BMD - MENURUT SUB RINCIAN OBJEK',
						'Format_IV_K_3',	'Format.IV.K.2.3',
						'REKAPITULASI PENGHAPUSAN BMD BERUPA……..(1) ',
						'PENGHAPUSAN KARENA PENYERAHAN ATAU PENGALIHAN STATUS PENGGUNAAN BMD  SUB RINCIAN OBJEK','EKSTRAKOMPTABEL',
						'semester','1','0','0','6','1','0',$IdL	
					);
	itemListDocument(
						'Format IV.K.2.4 - REKAPITULASI PENGHAPUSAN BMD BERUPA……..(1) PENGHAPUSAN AKIBAT PEMINDAHTANGANAN BMD - MENURUT  RINCIAN OBJEK',
						'Format_IV_K_3',	'Format.IV.K.2.4',
						'REKAPITULASI PENGHAPUSAN BMD BERUPA……..(1) ',
						'PENGHAPUSAN KARENA PENYERAHAN ATAU PENGALIHAN STATUS PENGGUNAAN BMD MENURUT  RINCIAN OBJEK','EKSTRAKOMPTABEL',
						'semester','1','0','0','5','1','0',$IdL	
					);
	itemListDocument(
						'Format IV.K.2.5 - REKAPITULASI PENGHAPUSAN BMD BERUPA……..(1) PENGHAPUSAN AKIBAT PEMINDAHTANGANAN BMD - MENURUT   OBJEK',
						'Format_IV_K_3',	'Format.IV.K.2.5',
						'REKAPITULASI PENGHAPUSAN BMD BERUPA……..(1) ',
						'PENGHAPUSAN KARENA PENYERAHAN ATAU PENGALIHAN STATUS PENGGUNAAN BMD MENURUT   OBJEK','EKSTRAKOMPTABEL',
						'semester','1','0','0','4','1','0',$IdL	
					);
	itemListDocument(
						'Format IV.K.2.6 - REKAPITULASI PENGHAPUSAN BMD BERUPA……..(1) PENGHAPUSAN AKIBAT PEMINDAHTANGANAN BMD - MENURUT  JENIS',
						'Format_IV_K_3',	'Format.IV.K.2.6',
						'REKAPITULASI PENGHAPUSAN BMD BERUPA……..(1) ',
						'PENGHAPUSAN KARENA PENYERAHAN ATAU PENGALIHAN STATUS PENGGUNAAN BMD MENURUT JENIS','EKSTRAKOMPTABEL',
						'semester','1','0','0','3','1','0',$IdL	
					);
	itemListDocument(
						'Format IV.K.2.7 - LAPORAN REKAPITULASI PENGHAPUSAN BMD BERUPA……..(1) PENGHAPUSAN AKIBAT PEMINDAHTANGANAN BMD - MENURUT SUB RINCIAN OBJEK',
						'Format_IV_K_3',	'Format.IV.K.2.7',
						'LAPORAN REKAPITULASI PENGHAPUSAN BMD BERUPA……..(1) ',
						'PENGHAPUSAN KARENA PENYERAHAN ATAU PENGALIHAN STATUS PENGGUNAAN BMD  SUB RINCIAN OBJEK','EKSTRAKOMPTABEL',
						'semester','0','0','0','6','1','1',$IdL	
					);
	itemListDocument(
						'Format IV.K.2.8 - LAPORAN REKAPITULASI PENGHAPUSAN BMD BERUPA……..(1) PENGHAPUSAN AKIBAT PEMINDAHTANGANAN BMD - MENURUT  RINCIAN OBJEK',
						'Format_IV_K_3',	'Format.IV.K.2.8',
						'LAPORAN REKAPITULASI PENGHAPUSAN BMD BERUPA……..(1) ',
						'PENGHAPUSAN KARENA PENYERAHAN ATAU PENGALIHAN STATUS PENGGUNAAN BMD MENURUT  RINCIAN OBJEK','EKSTRAKOMPTABEL',
						'semester','0','0','0','5','1','1',$IdL	
					);
	itemListDocument(
						'Format IV.K.2.9 - LAPORAN REKAPITULASI PENGHAPUSAN BMD BERUPA……..(1) PENGHAPUSAN AKIBAT PEMINDAHTANGANAN BMD - MENURUT   OBJEK',
						'Format_IV_K_3',	'Format.IV.K.2.9',
						'LAPORAN REKAPITULASI PENGHAPUSAN BMD BERUPA……..(1) ',
						'PENGHAPUSAN KARENA PENYERAHAN ATAU PENGALIHAN STATUS PENGGUNAAN BMD MENURUT   OBJEK','EKSTRAKOMPTABEL',
						'semester','0','0','0','4','1','1',$IdL	
					);
	itemListDocument(
						'Format IV.K.2.10 - LAPORAN REKAPITULASI PENGHAPUSAN BMD BERUPA……..(1) PENGHAPUSAN AKIBAT PEMINDAHTANGANAN BMD - MENURUT  JENIS',
						'Format_IV_K_3',	'Format.IV.K.2.10',
						'LAPORAN REKAPITULASI PENGHAPUSAN BMD BERUPA……..(1) ',
						'PENGHAPUSAN KARENA PENYERAHAN ATAU PENGALIHAN STATUS PENGGUNAAN BMD MENURUT JENIS','EKSTRAKOMPTABEL',
						'semester','0','0','0','3','1','1',$IdL	
					);
										
				




?>

  <tr height="22">
    <td>&nbsp;</td>
    <td></td>
  </tr>

  <tr height="22">
    <td>&nbsp;</td>
    <td><u>Format IV.L.1</u></td>
  </tr>


  <tr height="22">
    <td>&nbsp;</td>
    <td><a href="#" class="ico docu" onClick="showDoc('','Format_IV_L_1_1','<?=$IdL?>'); return false;">Format IV.L.1.1 - Laporan Persediaan Mutasi Tambah dan Mutasi Kurang</a></td>
  </tr>

  <tr height="22">
    <td>&nbsp;</td>
    <td><a href="#" class="ico docu" onClick="showDoc('','Format_IV_L_1_2','<?=$IdL?>'); return false;">Format IV.L.1.2 - REKAPITULASI LAPORAN PERSEDIAAN
	</a></td>
  </tr>

  <tr height="22">
    <td>&nbsp;</td>
    <td><a href="#" class="ico docu" onClick="showDoc('','Format_IV_L_1_3','<?=$IdL?>'); return false;">Format IV.L.1.3 - LAPORAN PERSEDIAAN MUTASI TAMBAH DAN KURANG
	</a></td>
  </tr>

  <tr height="22">
    <td>&nbsp;</td>
    <td><a href="#" class="ico docu" onClick="showDoc('','Format_IV_L_1_4','<?=$IdL?>'); return false;">Format IV.L.1.4 - REKAPITULASI LAPORAN PERSEDIAAN
	</a></td>
  </tr>

  <tr height="22">
    <td>&nbsp;</td>
    <td></td>
  </tr>

  <tr height="22">
    <td>&nbsp;</td>
    <td><u>Format IV.L.2</u></td>
  </tr>
  <tr height="22">
    <td>&nbsp;</td>
    <td><a href="#" class="ico docu" onClick="showDoc('','Format_IV_L_2_1','<?=$IdL?>'); return false;">Format IV.L.2.1 - Rekapitulasi Penjelasan Laporan Aset Tetap Mutasi Tambah Kurang</a></td>
  </tr>
	<?
	mysql_select_db(DatabaseSB,$ConSB);
	$SQ = "SELECT 
	'' as A0,
	Kd_Aset as A1, 
	Nm_Aset as A2 
	FROM ref_rek_aset108_3 WHERE Kd_Aset LIKE '1.3.%' AND Kd_Aset NOT LIKE '1.3.7' ORDER BY Kd_Aset";
	$nR = mysql_query($SQ);
	while ($mR = mysql_fetch_array($nR)) 
	{ 
	?>
	<tr height="22">
	<td>&nbsp;</td>
	<td style="padding-left:20px"><a href="#" class="ico deta" onClick="showDoc('<?=$mR[1]?>','Format_IV_L_2_1','<?=$IdL?>'); return false;">Format IV.L.2.1 - <?="Aset Tetap ( ".ucwords(strtolower($mR[2]))." )"?></a></td>
	</tr>
	<? 
	}
	?>
  
  <tr height="22">
    <td>&nbsp;</td>
    <td><a href="#" class="ico docu" onClick="showDoc('','Format_IV_L_2_2','<?=$IdL?>'); return false;">Format IV.L.2.2 - Laporan Aset Tetap Mutasi Tambah dan Mutasi Kurang</a></td>
  </tr>
  
  <tr height="22">
    <td>&nbsp;</td>
    <td><a href="#" class="ico docu" onClick="showDoc('','Format_IV_L_2_3','<?=$IdL?>'); return false;">Format IV.L.2.3 - Rekapitulasi Laporan Aset Tetap Menurut Jenis</a></td>
  </tr>
  <tr height="22">
    <td>&nbsp;</td>
    <td style="padding-left:20px"><a href="#" class="ico deta" onClick="showDoc('','Format_IV_L_2_3_a','<?=$IdL?>'); return false;">Format IV.L.2.3.a - Rekapitulasi Laporan Aset Tetap Menurut Jenis (a)</a></td>
  </tr>
  <tr height="22">
    <td>&nbsp;</td>
    <td style="padding-left:20px"><a href="#" class="ico deta" onClick="showDoc('','Format_IV_L_2_3_b','<?=$IdL?>'); return false;">Format IV.L.2.3.b - Rekapitulasi Laporan Aset Tetap Menurut Jenis (b)</a></td>
  </tr>
  <tr height="22">
    <td>&nbsp;</td>
    <td style="padding-left:20px"><a href="#" class="ico deta" onClick="showDoc('','Format_IV_L_2_3_c','<?=$IdL?>'); return false;">Format IV.L.2.3.c - Rekapitulasi Laporan Aset Tetap Menurut Jenis (c)</a></td>
  </tr>

  <tr height="22">
    <td>&nbsp;</td>
    <td><a href="#" class="ico docu" onClick="showDoc('','Format_IV_L_2_4','<?=$IdL?>'); return false;">Format IV.L.2.4 - Rekapitulasi Penjelasan Laporan Aset Tetap Mutasi Tambah Kurang</a></td>
  </tr>

  <tr height="22">
    <td>&nbsp;</td>
    <td><a href="#" class="ico docu" onClick="showDoc('','Format_IV_L_2_5','<?=$IdL?>'); return false;">Format IV.L.2.5 - LAPORAN ASET TETAP MUTASI TAMBAH DAN MUTASI KURANG ASET TETAP</a></td>
  </tr>

  <tr height="22">
    <td>&nbsp;</td>
    <td><a href="#" class="ico docu" onClick="showDoc('','Format_IV_L_2_6','<?=$IdL?>'); return false;">Format IV.L.2.6 - REKAPITULASI LAPORAN ASET TETAP</a></td>
  </tr>
  <tr height="22">
    <td>&nbsp;</td>
    <td></td>
  </tr>

  <tr height="22">
    <td>&nbsp;</td>
    <td><u>Format IV.L.3</u></td>
  </tr>
  
  <tr height="22">
    <td>&nbsp;</td>
    <td><a href="#" class="ico docu" onClick="showDoc('','Format_IV_L_3_1','<?=$IdL?>'); return false;">Format IV.L.3.1 - Rekapitulasi Penjelasan Laporan Aset Lainnya Mutasi Tambah Kurang</a></td>
  </tr>
	<?
	mysql_select_db(DatabaseSB,$ConSB);
	$SQ = "SELECT 
	'' as A0,
	Kd_Aset as A1, 
	Nm_Aset as A2 
	FROM ref_rek_aset108_3 WHERE Kd_Aset LIKE '1.5.%' AND Kd_Aset NOT LIKE '1.5.5' AND Kd_Aset NOT LIKE '1.5.6' ORDER BY Kd_Aset";
	$nR = mysql_query($SQ);
	while ($mR = mysql_fetch_array($nR)) 
	{ 
	?>
	<tr height="22">
	<td>&nbsp;</td>
	<td style="padding-left:20px"><a href="#" class="ico deta" onClick="showDoc('<?=$mR[1]?>','Format_IV_L_3_1','<?=$IdL?>'); return false;">Format IV.L.3.1 - <?="Aset Lainnya ( ".ucwords(strtolower($mR[2]))." )"?></a></td>
	</tr>
	<? 
	}
	?>
  
  <tr height="22">
    <td>&nbsp;</td>
    <td><a href="#" class="ico docu" onClick="showDoc('','Format_IV_L_3_2','<?=$IdL?>'); return false;">Format IV.L.3.2 - Laporan Aset Lainnya Mutasi Tambah dan Mutasi Kurang</a></td>
  </tr>

  <tr height="22">
    <td>&nbsp;</td>
    <td><a href="#" class="ico docu" onClick="showDoc('','Format_IV_L_3_3','<?=$IdL?>'); return false;">Format IV.L.3.3 - Rekapitulasi Laporan Aset Lainnya</a></td>
  </tr>

  <tr height="22">
    <td>&nbsp;</td>
    <td><a href="#" class="ico docu" onClick="showDoc('','Format_IV_L_3_4','<?=$IdL?>'); return false;">Format IV.L.3.4 - Rekapitulasi Penjelasan Laporan Aset Lainnya Mutasi Tambah Kurang</a></td>
  </tr>

  <tr height="22">
    <td>&nbsp;</td>
    <td><a href="#" class="ico docu" onClick="showDoc('','Format_IV_L_3_5','<?=$IdL?>'); return false;">Format IV.L.3.5 - Laporan Rekapitulasi Aset Lainnya Mutasi Tambah Kurang</a></td>
  </tr>
  <tr height="22">
    <td>&nbsp;</td>
    <td><a href="#" class="ico docu" onClick="showDoc('','Format_IV_L_3_6','<?=$IdL?>'); return false;">Format IV.L.3.6 - Rekapitulasi Laporan Aset Lainnya</a></td>
  </tr>


  <tr height="22">
    <td>&nbsp;</td>
    <td></td>
  </tr>

  <tr height="22">
    <td>&nbsp;</td>
    <td><u>Format IV.L.4</u></td>
  </tr>

  <tr height="22">
    <td>&nbsp;</td>
    <td><a href="#" class="ico docu" onClick="showDoc('','Format_IV_L_4_1','<?=$IdL?>'); return false;">Format IV.L.4.1 - REKAPITULASI MUTASI TAMBAH DAN MUTASI KURANG LAPORAN BMD</a></td>
  </tr>

  <tr height="22">
    <td>&nbsp;</td>
    <td><a href="#" class="ico docu" onClick="showDoc('','Format_IV_L_4_2','<?=$IdL?>'); return false;">Format IV.L.4.2 - Laporan BMD</a></td>
  </tr>

  <tr height="22">
    <td>&nbsp;</td>
    <td><a href="#" class="ico docu" onClick="showDoc('','Format_IV_L_4_3','<?=$IdL?>'); return false;">Format IV.L.4.3 - REKAPITULASI MUTASI TAMBAH DAN KURANG BMD</a></td>
  </tr>

  <tr height="22">
    <td>&nbsp;</td>
    <td><a href="#" class="ico docu" onClick="showDoc('','Format_IV_L_4_4','<?=$IdL?>'); return false;">Format IV.L.4.4 - Laporan BMD</a></td>
  </tr>

  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
</form>
</body>
<script languange="javascript">
var objfrm=document.myfrm; 

function showUnit_old(fnD,CrDiv,IdL) 
{ 
	if (fnD!=''){
		FnD = ReplaceText($("#fFndUnit").val());
		$(document).ready(function() 
		{
			$("#"+CrDiv+"MstDiv2").load('rekap_persemester_find_mid.php?CrT='+FnD+'&CrDiv='+CrDiv+'&IdL='+IdL);
		});
	}
	else
	{
		dispBLOCK(CrDiv+'MstDiv2');
		$(document).ready(function() 
		{
			$("#"+CrDiv+"MstDiv1").load('rekap_persemester_find_top.php?CrDiv='+CrDiv+'&IdL='+IdL);
			$("#"+CrDiv+"MstDiv2").load('rekap_persemester_find_mid.php?CrDiv='+CrDiv+'&IdL='+IdL);
		});
		dispBlockOrNo(CrDiv+'MstDiv0');
	}
}

function showUNIT(CrT,IdL)
	{
    
		if (CrT=='find')
		{
			FnD = ReplaceText($("#findUnT").val());
			$(document).ready(function()
			{
				$("#unitDiv2Cri").load('P47_Open_Laporan_Find_Unit_Mid.php?FnD='+FnD+'&IdL='+IdL);
			});
		}
		else
		{
			// dispNO('subMstCri');
			// dispNO('upbMstCri');
			 dispBLOCK('unitDiv2Cri');
      
			$(document).ready(function()
			{
				$("#unitDiv1Cri").load('P47_Open_Laporan_Find_Unit_Top.php?IdL='+IdL);
        		$("#unitDiv2Cri").load('P47_Open_Laporan_Find_Unit_Mid.php?IdL='+IdL);
			});
			
			$(document).ready(function()
			{
				$("#unitDiv2Cri").load('P47_Open_Laporan_Find_Unit_Mid.php?IdL='+IdL);
			});
			
			dispBlockOrNo('unitMstCri');

      // <div id="unitMstCri" class="Unit0Cri">
      //   <div id="unitDiv1Cri" class="Unit1Cri"></div>
      //   <div id="unitDiv2Cri" class="Unit2Cri"></div>
      // </div>
		}
	}
	
	function showSUB(CrT,IdL)
	{
		fUNT  = $("#fUNT").val();
		if (CrT=='find')
		{
			FnD = ReplaceText($("#findSuB").val());
			
			$(document).ready(function()
			{
				$("#subDiv2Cri").load('P47_Open_Laporan_Find_Sub_Mid.php?FnD='+FnD+'&gUNT='+fUNT+'&IdL='+IdL);
			});
		}
		else
		{
			dispNO('upbMstCri');
			dispBLOCK('subDiv2Cri');
			$(document).ready(function()
			{
				$("#subDiv1Cri").load('P47_Open_Laporan_Find_Sub_Top.php?IdL='+IdL);
			});
			
			$(document).ready(function()
			{
				$("#subDiv2Cri").load('P47_Open_Laporan_Find_Sub_Mid.php?gUNT='+fUNT+'&IdL='+IdL);
			});
			
			dispBlockOrNo('subMstCri');
		}
	}
	
	function showUPB(CrT,IdL)
	{
		fSUB  = $("#fSUB").val();
		if (CrT=='find')
		{
			FnD = ReplaceText($("#findUpB").val());
			
			$(document).ready(function()
			{
				$("#upbDiv2Cri").load('P47_Open_Laporan_Find_Upb_Mid.php?FnD='+FnD+'&gSUB='+fSUB+'&IdL='+IdL);
			});
		}
		else
		{
			if (fSUB=='00.00.00.00.00') {alert('Silahkan pilih Sub Unit terlebih dahulu..!!'); return false;}
			dispBLOCK('upbDiv2Cri');
			$(document).ready(function()
			{
				$("#upbDiv1Cri").load('P47_Open_Laporan_Find_Upb_Top.php?IdL='+IdL);
			});
			
			$(document).ready(function()
			{
				$("#upbDiv2Cri").load('P47_Open_Laporan_Find_Upb_Mid.php?gSUB='+fSUB+'&IdL='+IdL);
			});
			
			dispBlockOrNo('upbMstCri');
		}
	}

function showList(fnD,CrDiv,IdL) 
{ 
	SkP = $("#f02v").val();
	if (fnD!='')
	{
		FnD = ReplaceText($("#fFndLst").val());

		$(document).ready(function() 
		{
			$("#"+CrDiv+"MstDiv2").load('rekap_persemester_find_mid.php?SkP='+SkP+'&CrT='+FnD+'&CrDiv='+CrDiv+'&IdL='+IdL);
		});
	}
	else
	{
		dispBLOCK(CrDiv+'MstDiv2');
		$(document).ready(function() 
		{
			$("#"+CrDiv+"MstDiv1").load('rekap_persemester_find_top.php?CrDiv='+CrDiv+'&IdL='+IdL);
			$("#"+CrDiv+"MstDiv2").load('rekap_persemester_find_mid.php?SkP='+SkP+'&CrDiv='+CrDiv+'&IdL='+IdL);
		});
		dispBlockOrNo(CrDiv+'MstDiv0');
	}
}

function showLst_Add(KdE,NmA,CrDiv,IdL)
{
	dispBlockOrNo(CrDiv+'MstDiv0');
	
	if (CrDiv=='unit'){
		$("#f02v").val(KdE);
		$("#f02").val(NmA);
		
		$("#f03v").val('');
		$("#f03").val('');
	}
	else if (CrDiv=='depo'){
		$("#f03v").val(KdE);
		$("#f03").val(NmA);
	}
	else {
		alert('Kriteria belum dikonfigurasi..'); return false;
	}
}

function showDoc(nR,doc,IdL)
{
	rSem = $("#fSem").val();
	rThn = $("#fThn").val();
	Hri= $("#fHri").val();
	Bln= $("#fBln").val();
	Thn= $("#fThn").val();
	
	// KdS = $("#f02v").val();
	KdS = $("#fUNT").val();


	RdB = "";
	Len = objfrm.radiOnOff.length;
	for (i=0; i<=Len; i++)
	{
		if (objfrm.radiOnOff[i].checked) {RdB = objfrm.radiOnOff[i].value; break;}
	}
	
	//alert(RdB); return false;
	LeftPosition=(screen.width)?(screen.width-800)/2:100; 
	TopPosition=(screen.height)?(screen.height-400)/2:100;
	
	// URL = 'report/permen_47/'+doc+'.php?Thn='+Thn+'&Bln='+Bln+'&Hri='+Hri+'&KdS='+KdS+'&rSem='+rSem+'&rThn='+rThn+'&RdB='+RdB+'&IdL='+IdL;
	// window.open(URL,'WinDOC'+doc+KdS+RdB+rSem+rThn,'toolbar=no,menubar=yes, top='+TopPosition+',left='+LeftPosition+' location=no, scrollbars=yes, resizable, width=800, height='+400);

	URL = 'report/permen_47/'+doc+'.php?nR='+nR+'&Thn='+Thn+'&Bln='+Bln+'&Hri='+Hri+'&KdS='+KdS+'&rSem='+rSem+'&rThn='+rThn+'&RdB='+RdB+'&IdL='+IdL;
	window.open(URL,'WinDOC'+doc+KdS+RdB+rSem+rThn,'toolbar=no,menubar=yes, top='+TopPosition+',left='+LeftPosition+' location=no, scrollbars=yes, resizable, width=800, height='+400);
}

function showDocNew(nR,doc,formatType,titleDocument,subTitleDocument,subTitleDocument2,semesterOrMonth,isLocation,isSkpd,skpdPosition,level,isKomptabel,isNameLocation,IdL)
{
	rSem = $("#fSem").val();
	rThn = $("#fThn").val();
	Hri= $("#fHri").val();
	Bln= $("#fBln").val();
	Thn= $("#fThn").val();
	
	KdS = $("#fUNT").val();

	RdB = "";
	Len = objfrm.radiOnOff.length;
	for (i=0; i<=Len; i++)
	{
		if (objfrm.radiOnOff[i].checked) {RdB = objfrm.radiOnOff[i].value; break;}
	}
	
	LeftPosition=(screen.width)?(screen.width-800)/2:100; 
	TopPosition=(screen.height)?(screen.height-400)/2:100;	

	addUrl = 'formatType='+formatType+'&titleDocument='+titleDocument+'&subTitleDocument='+subTitleDocument+'&subTitleDocument2='+subTitleDocument2+'&semesterOrMonth='+semesterOrMonth+'&isLocation='+isLocation+'&isSkpd='+isSkpd+'&level='+level+'&skpdPosition='+skpdPosition+'&isKomptabel='+isKomptabel+'&isNameLocation='+isNameLocation
	
	URL = 'report/permen_47/'+doc+'.php?'+addUrl+'&nR='+nR+'&Thn='+Thn+'&Bln='+Bln+'&Hri='+Hri+'&KdS='+KdS+'&rSem='+rSem+'&rThn='+rThn+'&RdB='+RdB+'&IdL='+IdL;
	window.open(URL,'WinDOC'+doc+KdS+RdB+rSem+rThn,'toolbar=no,menubar=yes, top='+TopPosition+',left='+LeftPosition+' location=no, scrollbars=yes, resizable, width=800, height='+400);
}
function showCLICK(crt,kde,nma,IdL)
	{
		if (crt=='unit') 
		{
			$("#fUNT").val(kde);
			$("#dUNT").val(nma);
		
			// $("#fSUB").val('00.00.00.00.00');
			// $("#dSUB").val('ALL');
			
			// $("#fUPB").val('00.00.00.00.00.000');
			// $("#dUPB").val('ALL');
		}
		if (crt=='sub') 
		{
			$("#fSUB").val(kde);
			$("#dSUB").val(nma);
			
			$("#fUPB").val('00.00.00.00.00.000');
			$("#dUPB").val('ALL');
		}
		if (crt=='upb') 
		{
			$("#fUPB").val(kde);
			$("#dUPB").val(nma);
		}
		
		if (crt=='upb_cr') 
		{
			$("#fUPB").val(kde);
			$("#dUPB").val(nma);
			crt = crt.substr(0,3);
			leavejson(kde,IdL);
		}
		document.getElementById(crt+'MstCri').style.display = "none";
		
		$("#BtnGO").click();
	}
	
	function closeCLICK(crt)
	{
		document.getElementById(crt+'MstCri').style.display = "none";
	}
</script>
