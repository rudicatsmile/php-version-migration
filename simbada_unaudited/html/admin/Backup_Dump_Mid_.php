<?
include "Connection.php";
ini_set('memory_limit', '512M'); //Raise to 512 MB
ini_set('max_execution_time', '512'); //Raise to 512 MB

$CrT = $_POST['submit'];
if ($CrT=="Backup Data TRANSAKSI")
{
	$file='TRN_'.date("d-m-Y").'_'.time().'.sql';
	$tables = 'ta_kib_a';
	$tables.= ',ta_kib_b';
	$tables.= ',ta_kib_c';
	$tables.= ',ta_kib_d';
	$tables.= ',ta_kib_e';
	$tables.= ',ta_kib_f';
	$tables.= ',ta_kib_g';
	$tables.= ',ta_kib_group';
	$tables.= ',ta_kib_post';
	$tables.= ',ta_kib_post_penyusutan';
	$tables.= ',ta_rekap_mutasi';
}
else
{
	$file='REF_'.date("d-m-Y").'_'.time().'.sql';
	$tables = 'dat_version';
	$tables.= ',ref_alasan';
	$tables.= ',ref_bidang';
	$tables.= ',ref_kab_kota';
	$tables.= ',ref_kondisi';
	$tables.= ',ref_masalah';
	$tables.= ',ref_pemda';
	$tables.= ',ref_pemilik';
	$tables.= ',ref_perolehan';
	$tables.= ',ref_provinsi';
	$tables.= ',ref_rek_1';
	$tables.= ',ref_rek_2';
	$tables.= ',ref_rek_3';
	$tables.= ',ref_rek_4';
	$tables.= ',ref_rek_5';
	$tables.= ',ref_rek_aset1';
	$tables.= ',ref_rek_aset2';
	$tables.= ',ref_rek_aset3';
	$tables.= ',ref_rek_aset4';
	$tables.= ',ref_rek_aset5';
	$tables.= ',ref_sub_unit';
	$tables.= ',ref_tingkat';
	$tables.= ',ref_unit,ref_upb';
}

Backup_Data($CrT,HostnameSB.":".Port,UsernameSB,PasswordSB,DatabaseSB,$file,$tables);

function Backup_Data($CrT,$host,$user,$pass,$name_db,$nama_file,$tables)
{
	$return="# Host: localhost  (Version: 5.5.18)\n";
	$return.="# Date: 2013-06-14 19:23:48\n";
	$return.="# Generator: MySQL-Front 5.3  (Build 2.42)\n\n";
	$return.="/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;\n";
	$return.="/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;\n";
	$return.="/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;\n";
	$return.="/*!40101 SET NAMES utf8 */;\n";
	$return.="/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE */;\n";
	$return.="/*!40101 SET SQL_MODE='STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */;\n";
	$return.="/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES */;\n";
	$return.="/*!40103 SET SQL_NOTES='ON' */;\n";
	$return.="/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS */;\n";
	$return.="/*!40014 SET UNIQUE_CHECKS=0 */;\n";
	$return.="/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS */;\n";
	$return.="/*!40014 SET FOREIGN_KEY_CHECKS=0 */;\n";
	
	$ConLog = mysql_connect($host,$user,$pass);
	mysql_select_db($name_db,$ConLog);
	
	if($tables == '*')
	{
		$tables = array();
		$result = mysql_query('SHOW TABLES');
	
		while($row = mysql_fetch_row($result))
		{
			$tables[] = $row[0];
		}
	}
	else
	{
		$tables = is_array($tables) ? $tables : explode(',',$tables);
	}
	
	foreach($tables as $table)
	{
		if ($CrT=="Backup Data TRANSAKSI")
		{
			if ($table=="ta_rkbmd" || $table=="ta_rkpbmd" || $table=="ta_rkpbmd_rinci")
				{$OrD="ORDER BY IDO";}
			else
				{$OrD="ORDER BY IDT";}
		}
		else
			{$OrD="";}
		
		$result = mysql_query('SELECT * FROM '.$table.' '.$OrD);
		$num_fields = mysql_num_fields($result);
		
		//menyisipkan query drop table
		$return.= "\nDROP TABLE IF EXISTS `".$table."`;";
		$row2 = mysql_fetch_row(mysql_query('SHOW CREATE TABLE '.$table));
		$return.= "\n".$row2[1].";\n\n";
		
		//menyisipkan query Insert. untuk nanti memasukan data yang lama ketable yang baru dibuat. so toy mode : ON
		$return.= "/*!40000 ALTER TABLE `".$table."` DISABLE KEYS */;\n";
		
		for ($i = 0; $i < $num_fields; $i++)
		{
			$iG=0;
			while($row = mysql_fetch_row($result))
			{
				$return.= "INSERT INTO `".$table."` ";
				$return.= "VALUES (";
				for($j=0; $j<$num_fields; $j++)
				{
					$row[$j] = addslashes($row[$j]);
					$row[$j] = str_replace(chr(39),"",$row[$j]);
					$row[$j] = str_replace(chr(92),"",$row[$j]);
					$row[$j] = str_replace(chr(34),"",$row[$j]);
					$row[$j] = ereg_replace("\n","\n\n",$row[$j]);
					$row[$j] = ereg_replace("\n","",$row[$j]);
					$row[$j] = ereg_replace("\r","",$row[$j]);
					if (isset($row[$j]))
						{ $return.= "'".$row[$j]."'";}
					else
						{ $return.= "''"; }
						
					if ($j<($num_fields-1))
						{ $return.= ","; }
				}
				$return.= ");\n";
				$iG++;
			}
		}
		$return.="\n/*!40000 ALTER TABLE `".$table."` ENABLE KEYS */;\n";
	}
	
	$return.="\n/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;\n";
	$return.="/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;\n";
	$return.="/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;\n";
	$return.="/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;\n";
	$return.="/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;\n";
	$return.="/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;\n";
	$return.="/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;\n";
	
	$nama_file;
	$handle = fopen('D:\Backup_Data_Simbada/'.$nama_file,'w+');
	fwrite($handle,$return);
	fclose($handle);
	
	$MsG ="Proses backup berhasil...!!";
}
$URL="Backup_Dump_Mid.php?MsG=".$MsG."&IdL=".$_GET['IdL'];
header("Location: ".$URL);
?>
