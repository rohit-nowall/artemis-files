<?php

// source server - btn server
$servername_source = "nwwdb.cluster-cpgg05n7by4k.us-east-2.rds.amazonaws.com";
$username_source = "nwwroot";
$password_source = "hdyhxGTLy6e1";
$dbname_source = "allian12_nowallworld";
$conn_2 = new mysqli($servername_source, $username_source, $password_source, $dbname_source);


$servername_source = "odinkyc.cluster-cpgg05n7by4k.us-east-2.rds.amazonaws.com";
$username_source = "nwwuser";
$password_source = "xx1809R*7&%xx1809R*7&%";
$dbname_source = "kycdb";
$conn_source = new mysqli($servername_source, $username_source, $password_source, $dbname_source);

	
// destination server
/*
$servername = "alliance-a-staging.com";
$username = "allian12_nowallw";
$password = "#3}hGcD)R6J(";
$dbname = "allian12_nowallworld";

$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

*/

$sql2 = 'TRUNCATE TABLE kyc';

if ($conn_2->query($sql2) === TRUE) {}



$sql = "SELECT work_type_id,status,user_id,first_name,middle_name,last_name,dateofbirth,nationality_id,country_id,
passport_nid,tax_id,reason,address,address2,
city,state,zip_code,id_type,id_photo_front,id_photo_front_name,id_photo_selfie,id_photo_selfie_name,
gender,work_industry_id,planned_investment_amount,purpose_of_action
 FROM kyc";
$result = $conn_source->query($sql);

if ($result->num_rows > 0) {
    
    while($row = $result->fetch_assoc()) {
		$user_id = $row["user_id"];
		$first_name = $row["first_name"];
$middle_name = $row["middle_name"];
$last_name = $row["last_name"];	

$dateofbirth = $row["dateofbirth"];
$nationality_id = $row["nationality_id"];
$country_id = $row["country_id"];



$passport_nid = $row["passport_nid"];
$tax_id = $row["tax_id"];
$reason= $row["reason"];


$address = $row["address"];
$address2 = $row["address2"];

$city = $row["city"];
$state = $row["state"];
$zip_code = $row["zip_code"];
$id_type = $row["id_type"];
$id_photo_front = $row["id_photo_front"];
$id_photo_front_name = $row["id_photo_front_name"];
$id_photo_selfie = $row["id_photo_selfie"];
$id_photo_selfie_name = $row["id_photo_selfie_name"];
$gender = $row["gender"];
$work_industry_id = $row["work_industry_id"];
$planned_investment_amount = $row["planned_investment_amount"];
$purpose_of_action = $row["purpose_of_action"];
$status = $row["status"];
$work_type_id = $row["work_type_id"];
echo $user_id;



		$sql1 = "INSERT INTO kyc(work_type_id,status,user_id,first_name,middle_name,last_name,dateofbirth,nationality_id,country_id,
passport_nid,tax_id,reason,address,address2,
city,state,zip_code,id_type,id_photo_front,id_photo_front_name,id_photo_selfie,id_photo_selfie_name,
gender,work_industry_id,planned_investment_amount,purpose_of_action) 
VALUES
('$work_type_id','$status','$user_id','$first_name','$middle_name','$last_name','$dateofbirth','$nationality_id','$country_id',
'$passport_nid','$tax_id','$reason','$address','$address2',
'$city','$state','$zip_code','$id_type','$id_photo_front','$id_photo_front_name','$id_photo_selfie','$id_photo_selfie_name',
'$gender','$work_industry_id','$planned_investment_amount','$purpose_of_action')";

if (mysqli_query($conn_2, $sql1)) { echo 'done';} else { echo 'not done';}
}}
/*

if ($conn_2->query($sql1) === TRUE) { echo "New record created successfully";} else {
    echo "Error: " . $sql1 . "<br>" . $conn_2->error;
}    
    }
} else {
    echo "0 results";
}

*/
$conn_source->close();
$conn_2->close();

//echo "successfully copied";



//echo 'test';
?>