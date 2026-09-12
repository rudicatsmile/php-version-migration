<?php
if(file_exists('xml/ref_kegiatan.xml'))
{
	$SQ="TRUNCATE ref_kegiatan";
	$rs = mysql_query($SQ);
	
	$dataxml = simplexml_load_file('xml/ref_kegiatan.xml');
	foreach($dataxml->row as $daT)
	{
		echo "urut : ".$daT->urut."<br>";
		echo "id_urusan : ".$daT->id_urusan."<br>";
		echo "id_referensi : ".$daT->id_referensi."<br>";
		echo "nm_referensi : ".$daT->nm_referensi."<br>";
		
		$SQ="INSERT INTO ref_kegiatan SET 
		urut='".$daT->urut."',
		id_urusan='".substr($daT->id_referensi,0,1)."',
		id_referensi='".$daT->id_referensi."',
		nm_referensi='".$daT->nm_referensi."'";
		$rs = mysql_query($SQ);
	}
}
else
{
	echo "file tidak ditemukan";
}
?>