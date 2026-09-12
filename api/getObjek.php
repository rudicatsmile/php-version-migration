<?php 

require_once 'connect.php';

/*
$query = " SELECT * FROM ref_rek_aset108_4 WHERE Kd_Aset LIKE '1.3.2.02%'";
$result = mysqli_query($conn, $query);
$response = array();
while( $row = mysqli_fetch_assoc($result) ){
        array_push($response, 
        array(
                'kode'=>$row['Kd_Aset'], 
				'deskripsi'=>$row['Nm_Aset']
            ) 
        );
}
echo json_encode($response);  

mysqli_close($conn);

//Mengatasi Error pada aplikasi mobile :
//UPDATE ref_rek_aset108_7 SET Nm_Aset = 'Dst...' WHERE Nm_Aset LIKE 'Dst….%'
*/
//-----------------
$tableName = $_GET['tableName'];  //ref_rek_aset108_4
$kode = $_GET['kode'];

$query=" SELECT IDT,Kd_Aset,Nm_Aset FROM $tableName WHERE Kd_Aset LIKE '$kode.%' ORDER BY Kd_Aset";
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