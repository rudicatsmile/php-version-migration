<?php
		include "mysql_connect.php";
				
        $kode    = $_POST['kode']; 
		
		$data      = array();
		$data['peringatan'] = 0;	
    	
    	if(isset($_POST['kode']) ){   		
            
            switch ($kode) {
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
               
            $sql = "SELECT idt,Kd_UPB,Kd_Aset_108,kode_bar FROM ta_kib_108_barcode WHERE kode_bar <> '' AND kD_aset_108 LIKE '$kode_kib%' ORDER BY kode_bar DESC";
            //echo $sql.'<p>';
			$rstClient = $mysqli->query($sql);			
    		$rowClient = $rstClient->fetch_array();

    		if($rowClient['kode_bar']){

                //KIB-A-0000000002
				$kode_bar = $rowClient['kode_bar'];	
                $kode_bar_pieces = explode("-",$kode_bar);              
                $kib_value = intval($kode_bar_pieces[2]) + 1;
                $kib_value = fMakeReferensi($kib_value,10);
                $new_kode_bar = $kode_bar_pieces[0].'-'.$kode_bar_pieces[1].'-'.$kib_value;
				
			}else{
                $new_kode_bar = $kode.'0000000001';
            }

			$data['next']    = $new_kode_bar;	
						
			echo json_encode($data);
    	}

        function fMakeReferensi($gRefVr,$nDgT)
        {
            $NewKRf = substr("0000000000".$gRefVr,-$nDgT,strlen("0000000000".$gRefVr));
            return $NewKRf;
        }
		
		
		
		
		
		
    