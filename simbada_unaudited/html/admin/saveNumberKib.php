<?php
		include "mysql_connect.php";
				
        //KIB-D-0000000001
        $kode    = $_POST['kode']; 
		
		$data      = array();
		$data['peringatan'] = 0;	
    	
    	if(isset($_POST['kode']) ){   		
            
            switch (substr($kode,0,6)) {
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
               
            $sql = "SELECT kode_bar FROM ta_kib_108_barcode WHERE kode_bar = '$kode' AND kD_aset_108 LIKE '$kode_kib%' ORDER BY idt";
            //echo $sql.'<p>';
			$rstClient = $mysqli->query($sql);			
    		$rowClient = $rstClient->fetch_array();

    		if($rowClient['kode_bar']){

                $json['msg'] = 'exist';
				
			}else{
                $sql = "INSERT INTO ta_kib_108_barcode (Kd_Aset_108, kode_bar,Recorded)
                     VALUES ('$kode_kib', '$kode', now())";                        
                $results = $mysqli->query($sql);

                if($results){                                
                    $json['msg'] = 'success';        	
                }else{                
                    $json['msg'] = 'failed';                   
                }
            }            

            echo json_encode($json);
           
    	}

       
		
		
		
		
		
		
    