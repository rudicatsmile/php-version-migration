<?php
require_once 'connect.php';
/*
$db = mysqli_connect('localhost','proiso','ra11-19','sipanda-bmd');
if(!$db)
{
    echo "Database connection failed";
}

ALTER TABLE ta_kib_108_barcode ADD COLUMN userName VARCHAR(50) DEFAULT '' NULL AFTER Recorded_map; 
*/

$idt      		= $_POST['idt'];
$Kd_UPB      	= $_POST['Kd_UPB'];
$Kd_Aset_108 	= $_POST['Kd_Aset_108'];
$kode_bar       = $_POST['kode_bar'];
//$userName    	= $_POST['userName'];
$userName    	= "Simandor";
			  
$sql = "SELECT * FROM ta_kib_108 WHERE idt = $idt";
$result = mysqli_query($conn,$sql);
$count = mysqli_num_rows($result);

while( $row = mysqli_fetch_assoc($result) ){		
	$kode_aset = substr($row['Kd_Aset_108'],0,5)  ;		//1.3.1	   
}


//KIB-A-
switch (substr($kode_bar,0,6)) {
    case 'KIB-A-':
        $kode_kib = '1.3.1';
        break;
    case 'KIB-B-':
        $kode_kib = '1.3.2';
        break;
    case 'KIB-C-':
        $kode_kib = '1.3.3';
        break;
    case 'KIB-D-':
        $kode_kib = '1.3.4';
        break;
    case 'KIB-E-':
        $kode_kib = '1.3.5';
        break;
    case 'KIB-F-':
        $kode_kib = '1.3.6';
        break;
    default:
        $kode_kib = '1.3.99';
}
echo $kode_aset.' == '.$kode_kib .' : ';
exit;
if($kode_aset == $kode_kib){

	$update = "UPDATE ta_kib_108_barcode 
                SET Kd_UPB = '$Kd_UPB', 
                    Kd_Aset_108 = '$Kd_Aset_108', 
                    Recorded_map=now(),
                    userName = '$userName'
                WHERE kode_bar = '$kode_bar'";
	$query = mysqli_query($conn,$update);
	
	$insert = "UPDATE ta_kib_108 SET kode_bar = '$kode_bar' WHERE IDT = $idt";
	$query = mysqli_query($conn,$insert);
	if($query){
		echo json_encode("Success");
	}
}else{
	$check = $kode_aset.' <> '.$kode_kib;
	//echo json_encode("Failed");
	//echo json_encode($check);
	echo json_encode("Kode KIB tidak sesuai");
}
?>