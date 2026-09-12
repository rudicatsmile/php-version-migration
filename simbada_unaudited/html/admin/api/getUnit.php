<?php 

require_once 'connect.php';

$tableName 	= $_GET['tableName'];  
$kode 		= $_GET['kode'];
$kodeUpb	= $_GET['kodeUpb'];
$level 		= $_GET['level'];
$admin 		= $_GET['admin'];


/*
level = 1 : administrator
level = 2 : Unit/Skpd
level = 3 : Subunit
level = 4 : Upb

kodeUpb 	= 24.04.04.01.01.001
kd_unit 	= 24.04.01.01			/ 11 huruf
kd_sub_unit = 24.04.01.01.01		/ 14 huruf


*/

switch ($level) {
  case "0":
    $condition = " ";
    break;
  case "1":
	$condition = " ";
	break;
  case "2":
	$kdUnit    = substr($kodeUpb,0,11);
    $condition = " WHERE Kd_Unit = '$kdUnit' ";
    break;
  case "3":
	$kdUnit    = substr($kodeUpb,0,14);
	$condition = " WHERE Kd_Sub = '$kdUnit' ";
	if($admin=='1'){
		$kdUnit    = substr($kodeUpb,0,11);
		$condition = " WHERE Kd_Sub LIKE '$kdUnit%' ";
	}
  
    break;
  case "4":
	$kdUnit    = $kodeUpb;
	$condition = " WHERE Kd_Upb = '$kdUnit' ";
	if($admin=='1'){
		$kdUnit    = substr($kodeUpb,0,14);
		$condition = " WHERE Kd_Upb LIKE '$kdUnit%' ";
	}
  
    break;
  default:
  
}

switch ($tableName) {
	case "ref_unit":							
        $kode_unit = "Kd_Unit";
		$nama_unit = "Nm_Unit";
		
		switch ($level) {		 
		  case "2":			
			$kdUnit    = "";			
			if($admin=='0'){
				$kdUnit    = substr($kodeUpb,0,11);				
			}
			$kdUnit    = substr($kodeUpb,0,11);	
			$condition = " WHERE Kd_Unit LIKE '$kdUnit%' ";
			break;		 
		  default:
			$kdUnit    = "";
			$condition = " WHERE Kd_Unit LIKE '$kdUnit%' ";
		}
			
        break;
    case "ref_sub_unit":
        $kode_unit = "Kd_Sub";
		$nama_unit = "Nm_Sub";
		//$condition = " WHERE Kd_Sub LIKE '$kode.__' ";
		
		switch ($level) {		 
		  case "3":			
			$kdUnit    = $kode;			
			if($admin=='0'){
				$kdUnit    = substr($kodeUpb,0,14);				
			}	
			$condition = " WHERE Kd_Sub LIKE '$kdUnit%' ";
			break;		 
		  default:
			$kdUnit    = $kode;
			$condition = " WHERE Kd_Sub LIKE '$kdUnit%' ";
		}

        break;
    case "ref_upb":
        $kode_unit = "Kd_Upb";
		$nama_unit = "Nm_Upb";
		//$condition = " WHERE Kd_Upb LIKE '$kode.___' ";
		switch ($level) {		 
		  case "4":			
			$kdUnit    = $kode;			
			if($admin=='0'){
				$kdUnit    = $kodeUpb;				
			}
			//level UPB admin dan reguler hanya bisa tampil upb nya sendiri
			$kdUnit    = $kodeUpb;	
			$condition = " WHERE Kd_Upb LIKE '$kdUnit%' ";
			break;		 
		  default:
			$kdUnit    = $kode;
			$condition = " WHERE Kd_Upb LIKE '$kdUnit%' ";
		}
        break;
}


/*
SELECT Kd_Unit AS kode_unit, Nm_Unit AS nama_unit   FROM ref_unit                                               ORDER BY Kd_Unit;
SELECT Kd_Sub  AS kode_unit, Nm_Sub  AS nama_unit   FROM ref_sub_unit    WHERE Kd_Sub LIKE '24.04.04.01.__'     ORDER BY Kd_Sub;
SELECT Kd_Upb  AS kode_unit, Nm_Upb  AS nama_unit   FROM ref_upb         WHERE Kd_Upb LIKE '24.04.04.01.01.___' ORDER BY Kd_Upb;

*/
$query=" SELECT $kode_unit  AS kode_unit, $nama_unit  AS nama_unit FROM $tableName  $condition  ORDER BY $kode_unit ";
//echo $query;
//exit;
$data=array();
$result = mysqli_query($conn, $query);
while($row=mysqli_fetch_object($result))
      {
         $data[]=$row;
      }
$response=array(
            'status' => 1,
            'message' =>'Get Data Successfully.',
            'value' => $data
        );
header('Content-Type: application/json');
echo json_encode($response);

?>
