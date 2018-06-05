<?php

// source server - btn server
$servername_source = "nwwdb.cluster-cpgg05n7by4k.us-east-2.rds.amazonaws.com";
$username_source = "nwwroot";
$password_source = "hdyhxGTLy6e1";
$dbname_source = "allian12_nowallworld";
$conn = new mysqli($servername_source, $username_source, $password_source, $dbname_source);


$servername_source = "odinkyc.cluster-cpgg05n7by4k.us-east-2.rds.amazonaws.com";
$username_source = "nwwuser";
$password_source = "xx1809R*7&%xx1809R*7&%";
$dbname_source = "kycdb";
$conn_btn = new mysqli($servername_source, $username_source, $password_source, $dbname_source);


 $sql_i = "SELECT * FROM kyc_status WHERE send_status = 'no'";	
//$sql_i = "SELECT * FROM kyc_status";	 
							$result_i = $conn->query($sql_i);
							if ($result_i->num_rows > 0) { 
								while($row_i = $result_i->fetch_assoc())
									{ $rfrID = $row_i["user_id"]; 
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

										if ($err) {
										  echo "cURL Error #:" . $err;
										} else 
										{ echo $response;
									      echo '<br>';echo '<br>';echo '<br>';
									      $json_a = json_decode($response, true);
		                                  
											if (isset($json_a["approval_status"])) 
											{	$approval_status = $json_a["approval_status"];
										        // update local
											    $sql = "UPDATE kyc_status SET status = '$approval_status', send_status = 'no' where user_id ='$rfrID'";
												if (mysqli_query($conn, $sql)) { } else {}
												// update btn
												if ($approval_status == 'CLEARED')
												{
													$sql = "UPDATE kyc SET status = 'CLEARED' where user_id ='$rfrID'";
													if (mysqli_query($conn_btn, $sql))
														{$sql = "UPDATE kyc_status SET send_status = 'yes' where user_id ='$rfrID'"; if (mysqli_query($conn, $sql)) { } else {} } 
													else { echo 'some issue in sending';}
												}
												elseif ($approval_status == 'ACCEPTED')
												{
													$sql = "UPDATE kyc SET status = 'CLEARED' where user_id ='$rfrID'";
													if (mysqli_query($conn_btn, $sql))
														{$sql = "UPDATE kyc_status SET send_status = 'yes' where user_id ='$rfrID'"; if (mysqli_query($conn, $sql)) { } else {} } 
													else { echo 'some issue in sending';}
												}
												elseif ($approval_status == 'REJECTED')
												{
													$sql = "UPDATE kyc SET status = 'REJECTED' where user_id ='$rfrID'";
													if (mysqli_query($conn_btn, $sql))
														{$sql = "UPDATE kyc_status SET send_status = 'yes' where user_id ='$rfrID'"; if (mysqli_query($conn, $sql)) { } else {} } 
													else { echo 'some issue in sending';}
												}
										   }
										}
									
									}								  
									}
															 
?>