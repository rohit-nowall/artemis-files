<?php

$servername = 'nwwdb.cluster-cpgg05n7by4k.us-east-2.rds.amazonaws.com';
$username = 'nwwroot';
$password = 'hdyhxGTLy6e1';
$dbname = 'allian12_nowallworld';							
$conn = mysqli_connect($servername, $username, $password, $dbname);


$sql_i = "SELECT * FROM kyc WHERE status = 'Pending' and user_id NOT IN (SELECT user_id FROM kyc_status WHERE processing_status = 'yes') limit 5";	 
//$sql_i = "SELECT * FROM kyc WHERE status = 'Pending' limit 5";	
							$result_i = $conn->query($sql_i);
							if ($result_i->num_rows > 0) { 
								while($row_i = $result_i->fetch_assoc())
									{ 
								      $rfrID = $row_i["user_id"]; 
								
									  $first_name = $row_i["first_name"];
									  $last_name = $row_i["last_name"];
									   
									  // Nationality									  
										$nationality_temp = $row_i["nationality_id"];									
									 //$sql = "SELECT artemis FROM nationality where btn='$nationality_temp'";
									    $sql = "SELECT name from nationality WHERE id = '$nationality_temp'";
										$result = $conn->query($sql);
										if ($result->num_rows > 0) { while($row = $result->fetch_assoc()){ $nationality_temp1 = $row["name"]; }}
										if (isset($nationality_temp1)) { $nationality	= $nationality_temp1;}
										else { $nationality	= 'UNKNOWN';}
										/*
										$sql = "SELECT DISTINCT a.id, b.artemis FROM nationality a, nationality_artemis b
											WHERE TRIM(a.name)=TRIM(b.btn) and a.id = '$nationality_temp'";
											*/
										
										//$gender = $row_i["gender"];
										
										// Country of residence
										$country_of_residence_temp = $row_i["country_id"];										
										$sql = "SELECT DISTINCT a.id, b.btn FROM country a, country_artemis b
										WHERE TRIM(a.name)=TRIM(b.artemis) AND a.id = '$country_of_residence_temp'";										 
										$result = $conn->query($sql);
										if ($result->num_rows > 0) { while($row = $result->fetch_assoc()){ $country_of_residence_temp1 = $row["btn"]; }}							
										if (isset($country_of_residence_temp1)) { $country_of_residence	= $country_of_residence_temp1;}
										else { $country_of_residence	= 'UNKNOWN';}
										//$country_of_residence = 'SINGAPORE';										
										
										// Industry							
										$industry_temp = $row_i["work_industry_id"];										
										$sql = "SELECT b.id, a.btn FROM industry a, work_industry b
												WHERE a.artemis = b.name and b.id = '$industry_temp'";
										$result = $conn->query($sql);
										if ($result->num_rows > 0) { while($row = $result->fetch_assoc()){ $industry_temp1 = $row["btn"]; }}							
												 if (isset($industry_temp1)) { $industry	= $industry_temp1;}
												 else { $industry	= 'UNKNOWN';}
										$ssic_code = $industry;
										//$ssic_code  = '00000 - ACTIVITIES NOT ADEQUATELY DEFINED';
										
										// work type									
										$work_type_temp = $row_i["work_type_id"];
										$sql = "SELECT b.id, a.btn FROM work_type_artemis a, work_type b
												WHERE a.artemis = b.name and b.id = '$work_type_temp'";
										$result = $conn->query($sql);
										if ($result->num_rows > 0) { while($row = $result->fetch_assoc()){ $work_type_temp1 = $row["btn"]; }}								
												 if (isset($work_type_temp1)) { $work_type	= $work_type_temp1;}
												 else { $work_type	= 'UNKNOWN';}
												 
										$ssoc_code  = $work_type;
										//$ssoc_code  = '41101 - OFFICE CLERK (GENERAL)';
										
										
										$ssic_code = urlencode($ssic_code);
										
										$ssoc_code = urlencode($ssoc_code);
										
										
										$payment_mode = 'VIRTUAL CURRENCY';	
										$onboarding_mode = 'NON FACE-TO-FACE';
										$product_service_complexity = 'COMPLEX';										
										$user_id = $row_i["user_id"];
										$date_of_birth  = $row_i["dateofbirth"];
										$date_of_birth = date("d/m/Y", strtotime($date_of_birth));
										
										// id_type
										$id_type_temp = $row_i["id_type"];
										if ($id_type_temp == '1') {$identification_type  = 'NRIC';}
										elseif ($id_type_temp == '2') {$identification_type  = 'PASSPORT';}
										elseif ($id_type_temp == '3') {$identification_type  = 'DRIVING LICENSE';}
										else {$identification_type  = 'OTHERS';}
										
										$identification_number  = $row_i["passport_nid"];
										$gender = $row_i["gender"];
							            $gender = strtoupper($gender);										
										$domain_name = "NOWALL";
										
										
// download photo first

 $sql = "SELECT id_photo_front,id_photo_front_name,id_photo_selfie,id_photo_selfie_name FROM kyc where user_id='$rfrID'";						 
							$result = $conn->query($sql);
							if ($result->num_rows > 0) { while($row = $result->fetch_assoc())
							 { $img_front = $row["id_photo_front"]; $img_selfie = $row["id_photo_selfie"];
                               $img_front_name = $row["id_photo_front_name"]; $img_selfie_name = $row["id_photo_selfie_name"]; }} 						 
						 
					
					// image front
					if ($img_front == '') {}
					else 
					{$img_front_url = $img_front; 
					$img_front = "kyc/images/new_customer/$img_front_name";
					//$img_front = "images/new_customer/$img_front_name";
					file_put_contents($img_front, file_get_contents($img_front_url));
					   }
					
					// image selfie
					if ($img_selfie == '') {}
					else 
					{$img_selfie_url = $img_selfie;
					$img_selfie = "kyc/images/new_customer/$img_selfie_name";
					//$img_selfie = "images/new_customer/$img_selfie_name";
					file_put_contents($img_selfie, file_get_contents($img_selfie_url));
					   }	

// download photo finish

// check if already exists in artemis

        $post_url = "https://p4.cynopsis.co/artemis_nowall/default/check_status.json?rfrID=$rfrID";        
    
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);

		curl_setopt_array($curl, array(
		  CURLOPT_URL => $post_url,
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => "",
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 30,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_HTTPHEADER => array(			
						"Content-Type: multipart/form-data",			
						"WEB2PY-USER-TOKEN: 842fab80-3201-46e6-b9fb-ce3289f4a9cf"
					  ),		  
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);

		$approval_status1 = json_decode($response,true);
		if (isset($approval_status1['approval_status'])) {}
		else
			// call access api				 				 
				 {
        $post_url = "https://p4.cynopsis.co/artemis_nowall/default/individual_risk?domain_name=$domain_name&rfrID=$rfrID&first_name=$first_name&last_name=$last_name&nationality=$nationality&country_of_residence=$country_of_residence&onboarding_mode=$onboarding_mode&product_service_complexity=$product_service_complexity&payment_mode=$payment_mode&ssic_code=$ssic_code&ssoc_code=$ssoc_code&gender=$gender&date_of_birth=$date_of_birth&identification_type=$identification_type&identification_number=$identification_number";
        
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);

		curl_setopt_array($curl, array(
		  CURLOPT_URL => $post_url,
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => "",
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 30,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => "POST",
		  CURLOPT_HTTPHEADER => array(
			"Cache-Control: no-cache",
			"Content-Type: application/json",
			"Postman-Token: 4c196595-3e81-4b2a-8211-6e6f6fd71190",
			"WEB2PY-USER-TOKEN: 842fab80-3201-46e6-b9fb-ce3289f4a9cf"
		  ),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);

		if ($err) {
		  echo "cURL Error #:" . $err;
		} else {		  
		  $json_a = json_decode($response, true);
		  
		 
		  
						if (!isset($json_a["errors"])) 
						{ 
					
					
						$sql = "UPDATE kyc SET status = 'Pending' where user_id ='$rfrID'";								

												 if (mysqli_query($conn, $sql)) { } else {}							
												//echo  'Action Successful'; 
												echo '<br>';echo '<br>'; echo $response; 
											   // echo 'abcd';								
																	
									
						}

		else { echo 'please check the following error'; echo $response;		 }	  
				}
	echo 'record created';
									}
									
									
	
// doc submission

// check if already submitted

 //echo 'testa';

$post_url = "https://p4.cynopsis.co/artemis_nowall/api/individual_face";        
		
				  $sql = "SELECT id_photo_front,id_photo_front_name,id_photo_selfie,id_photo_selfie_name FROM kyc where user_id='$rfrID'";						 
							$result = $conn->query($sql);
							if ($result->num_rows > 0) { while($row = $result->fetch_assoc())
							 { $img_front = $row["id_photo_front"]; $img_selfie = $row["id_photo_selfie"];
                               $img_front_name = $row["id_photo_front_name"]; $img_selfie_name = $row["id_photo_selfie_name"]; }} 		
		
		 
			 $img_front = "kyc/images/new_customer/$img_front_name";
			 $img_selfie = "kyc/images/new_customer/$img_selfie_name";
			// $img_front = "images/new_customer/$img_front_name";
			// $img_selfie = "images/new_customer/$img_selfie_name";
    
    
        // upload selfie
				
				if ($img_selfie == '') {}
				else
				{			
			
			                 $post_fields = array(
								'file' => curl_file_create ($img_selfie),					
								'cust_rfr_id' => $rfrID,
								'document_type' => 'SELFIE',	
							);

							$post_url = "https://p4.cynopsis.co/artemis_nowall/api/individual_doc";        
						
							$curl = curl_init();
							curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
							curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);

							curl_setopt_array($curl, array(
							  CURLOPT_URL => $post_url,
							  CURLOPT_RETURNTRANSFER => true,
							  CURLOPT_ENCODING => "",
							  CURLOPT_MAXREDIRS => 10,
							  CURLOPT_TIMEOUT => 30,
							  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
							  CURLOPT_CUSTOMREQUEST => "POST",
							  CURLOPT_POSTFIELDS => $post_fields,		  
							  CURLOPT_HTTPHEADER => array(			
								"Content-Type: multipart/form-data",			
								"WEB2PY-USER-TOKEN: 842fab80-3201-46e6-b9fb-ce3289f4a9cf"
							  ),
							));

							$response = curl_exec($curl);
							$err = curl_error($curl);

							curl_close($curl);

							if ($err) {
							  echo "cURL Error #:" . $err;
							} else {
							 
							  
							  echo $response; 
							  
							  $selfie_id1 = json_decode($response,true);
							  $selfie_id = $selfie_id1['id'];
							  //echo 'abcd';
							  
							  $sql = "select * from IMAGE_DOCUMENT_ID where CUST_RFR_ID='$rfrID'";  				  
								
								$result = $conn->query($sql);

								if ($result->num_rows > 0) {
									//echo 'lara';
									$sql = "UPDATE IMAGE_DOCUMENT_ID SET selfie_no = '$selfie_id' where CUST_RFR_ID ='$rfrID'";
									
									
								} else {
									//echo 'manish';
									$sql = "INSERT INTO IMAGE_DOCUMENT_ID(CUST_RFR_ID,SELFIE_NO) VALUES('$rfrID','$selfie_id')";
//echo 	$sql;								

									
								}					
									
								if (mysqli_query($conn, $sql)) { } else {}	
								//return view ('user.resultapi');
												
							}		
				}
				// upload passport
				if ($img_front == '') {}
				else
				{       
						$post_fields = array(
							'file' => curl_file_create ($img_front),							
							'cust_rfr_id' => $rfrID,
							'document_type' => 'PASSPORT',	
						);

						$post_url = "https://p4.cynopsis.co/artemis_nowall/api/individual_doc";        
					
						$curl = curl_init();
						curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
						curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);

						curl_setopt_array($curl, array(
						  CURLOPT_URL => $post_url,
						  CURLOPT_RETURNTRANSFER => true,
						  CURLOPT_ENCODING => "",
						  CURLOPT_MAXREDIRS => 10,
						  CURLOPT_TIMEOUT => 30,
						  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
						  CURLOPT_CUSTOMREQUEST => "POST",
						  CURLOPT_POSTFIELDS => $post_fields,		  
						  CURLOPT_HTTPHEADER => array(			
							"Content-Type: multipart/form-data",			
							"WEB2PY-USER-TOKEN: 842fab80-3201-46e6-b9fb-ce3289f4a9cf"
						  ),
						));

						$response = curl_exec($curl);
						$err = curl_error($curl);

						curl_close($curl);

						if ($err) {
						  echo "cURL Error #:" . $err;
						} else {
						 // echo 'test';
						  
						  echo $response; 
						  $id1 = json_decode($response,true);
						  $id = $id1['id'];				  
						 
						  $sql = "select * from IMAGE_DOCUMENT_ID where CUST_RFR_ID='$rfrID'";  				  
							
							$result = $conn->query($sql);

							if ($result->num_rows > 0) {
								$sql = "UPDATE IMAGE_DOCUMENT_ID SET id_no = '$id' where CUST_RFR_ID ='$rfrID'";
								
								
							} else {
								$sql = "INSERT INTO IMAGE_DOCUMENT_ID(CUST_RFR_ID,ID_NO) VALUES('$rfrID','$id')";						      
							}									
							if (mysqli_query($conn, $sql)) { } else {}		
                           // return view ('user.resultapi');							
						}	
				}			
				echo 'images submitted';
 
// face comparison 

$post_url = "https://p4.cynopsis.co/artemis_nowall/api/individual_face";      
	  
				  
				  $sql = "SELECT id_no,SELFIE_NO FROM IMAGE_DOCUMENT_ID where CUST_RFR_ID='$rfrID'";
				  
							$result = $conn->query($sql);
							if ($result->num_rows > 0) { while($row = $result->fetch_assoc())
							 { $img_selfie_no = $row["SELFIE_NO"]; $id_no = $row["id_no"];}}                               
    
				
				
				$post_fields = array(	
				'cust_rfr_id' => "$rfrID",	
				'source_doc_id' => "$id_no",
				'target_doc_id' => "$img_selfie_no",	// SELFIE
			);
        
    
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);

		curl_setopt_array($curl, array(
		  CURLOPT_URL => $post_url,
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => "",
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 30,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => "POST",
          CURLOPT_POSTFIELDS => $post_fields,		  
		  CURLOPT_HTTPHEADER => array(			
			"Content-Type: multipart/form-data",			
			"WEB2PY-USER-TOKEN: 842fab80-3201-46e6-b9fb-ce3289f4a9cf"
		  ),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);

		if ($err) {
		  echo "cURL Error #:" . $err;
		} else {
		  echo $response;
		}	
		
		// indi report
		
		$post_url = "https://p4.cynopsis.co/artemis_nowall/api/individual_customer_report";        
    
			$post_fields = array(	
			'cust_rfr_id' => $rfrID,	
		);
       
    
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);

		curl_setopt_array($curl, array(
		  CURLOPT_URL => $post_url,
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => "",
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 30,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => "POST",
          CURLOPT_POSTFIELDS => $post_fields,		  
		  CURLOPT_HTTPHEADER => array(			
			"Content-Type: multipart/form-data",			
			"WEB2PY-USER-TOKEN: 842fab80-3201-46e6-b9fb-ce3289f4a9cf"
		  ),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);

		if ($err) {
		  echo "cURL Error #:" . $err;
		} else {
			
		  echo $response; 
		  $json_final = json_decode($response, true);
		  if (isset($json_final['approval_status'])) 
			  { $approval_status = $json_final['approval_status'];
             $sql_status = "select * from kyc_status where user_id='$rfrID'";  				  
			 $result_status = $conn->query($sql_status);
   			if ($result_status->num_rows > 0) {
									$sql = "UPDATE kyc_status SET status = '$approval_status', send_status = 'no', processing_status = 'yes' where user_id ='$rfrID'";
									
								} else {
									$sql = "INSERT INTO kyc_status(user_id,status,send_status,processing_status) VALUES('$rfrID','$approval_status','no', 'yes')";						      
								}					
									
								if (mysqli_query($conn, $sql)) { } else {}

			  }
		  
		}
}} 
		mysqli_close($conn);
?>