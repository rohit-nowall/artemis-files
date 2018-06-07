var mysql = require('mysql');
var date = require('locutus/php/datetime/date');
var strtotime = require('locutus/php/datetime/strtotime');
var fs = require('fs');
var https = require('https');

function createSQL()
{
	return mysql.createConnection({
	host:'localhost',
	user:'root',
	password:'password',
	database:'artemistest',
	});
}

function queryOne() // all kyc
{
	var query = "Select * from kyc limit 2"
	var connection = createSQL();
	
	connection.query(query,
	function(error,results,fields)
	{
		connection.end();
				if(error)throw error;
		if(results.length>0){
			results.forEach(function(element)
			{
				queryTwo(element);
			
			});
		}
			
	}
	);
}
	
function queryTwo(entity) //nationality
{
	var connection = createSQL();
	
	connection.query("Select name from nationality where id = '".concat(entity.nationality_id).concat("'"),function(error,results,fields)
	{
		connection.end();
				if(error)throw error;
		if(results.length>0) // found
		{
			entity.nationality = results[0].name;
		}else
		{
			entity.nationality = 'UNKNOWN';
		}
		
		queryThree(entity)
	});
}

function queryThree(entity) //country
{
	var connection = createSQL();
	
	connection.query("Select DISTINCT a.id,b.btn FROM country a,country_artemis b WHERE TRIM(a.name) = TRIM(b.artemis) AND a.id = '".concat(entity.country_id).concat("'"),function(error,results,fields)
	{
		connection.end();
				if(error)throw error;
		if(results.length>0)
		{
			entity.country_of_residence = results[0].btn;
		}
		else
		{
			entity.country_of_residence = "UNKNOWN";
		}
		queryFour(entity);
	});
}

function queryFour(entity) //industry
{
	var connection = createSQL();
	connection.query("SELECT b.id,a.btn FROM industry a,work_industry b WHERE a.artemis = b.name and b.id = '".concat(entity.work_industry_id).concat("'"),function(error,results,fields)
	{

		connection.end();
				if(error)throw error;
		if(results.length>0)
		{
			entity.industry = results[0].btn;
		}else
		{
			entity.industry = "UNKNOWN";
		}
		entity.ssic_code = entity.industry;
		queryFive(entity);
	});
}

function queryFive(entity)
{
	var connection = createSQL();
	connection.query("Select b.id,a.btn FROM work_type_artemis a,work_type b WHERE a.artemis = b.name and b.id = '".concat(entity.work_type_id).concat("'"),function(error,results,fields)
	{
		connection.end();
		if(error)throw error;
		if(results.length>0)
		{
			entity.work_type = results[0].btn;
		}else
		{
			entity.work_type = "UNKNOWN";
		}
		additionalFormatting(entity);
	});
}

function additionalFormatting(entity)
{
	entity.ssic_code = encodeURI(entity.ssic_code);
	entity.ssoc_code = encodeURI(entity.work_type);
	entity.payment_mode = 'VIRTUAL CURRENCY';
	entity.onboarding_mode = "NON FACE-TO-FACE";
	entity.product_service_complexity = "COMPLEX";
	entity.date_of_birth = date("d/m/Y",strtotime(entity.dateofbirth.toString()));
	
	if(entity.id_type == 1)
	{
		entity.identification_type = 'NRIC';
	}else if(entity.id_type == 2)
	{
		entity.identification_type = 'PASSPORT';
	}else if(entity.id_type == 3)
	{
		entity.identification_type = 'DRIVING LICENSE';
	}else
	{
		entity.identification_type = "OTHERS";
	}
	
	entity.identification_number = entity.passport_nid;
	entity.gender = entity.gender.toUpperCase();
	entity.domain_name = "NOWALL";
	
	photosDownload(entity);
	
}

function photosDownload(entity) //download photo
{
	var connection = createSQL();
	connection.query("SELECT id_photo_front,id_photo_front_name,id_photo_selfie,id_photo_selfie_name FROM kyc where user_id = '".concat(entity.user_id).concat("'"),
	function(error,results,fields)
	{
		if(error)throw error;
		connection.end();
		
		if(results.length>0) //found
		{
			
			if(entity.id_photo_front == ''){}
			else
			{
				var img_front_url = entity.id_photo_front;
				entity.img_front = "kyc/images/new_customer/".concat(entity.id_photo_front_name);
				
				var request = https.get(img_front_url,function(response)
				{
				//if folder doesnt exist
					if(!fs.existsSync("kyc/images/new_customer"))
					{
						fs.mkdirSync("kyc");
						fs.mkdirSync("kyc/images");
						fs.mkdirSync("kyc/images/new_customer");						
					}
					var file = fs.createWriteStream(entity.img_front);					
					response.pipe(file);
				});
			}
			
			if(entity.id_photo_selfie == ''){}
			else
			{
				var image_selfie_url = entity.id_photo_selfie;
				entity.img_selfie = "kyc/images/new_customer/".concat(entity.id_photo_selfie_name)
				var request = https.get(image_selfie_url,function(response)
				{
					var file = fs.createWriteStream(entity.img_selfie);
					response.pipe(file);
				});
			}
				
			
		}
		artemisCheck(entity);
	});
}


function artemisCheck(entity)
{
	var request = require('request');
	var options = 
	{
    url: "https://p4.cynopsis.co/artemis_nowall/default/check_status.json?rfrID=".concat(entity.user_id),
	headers:
	{
		'Content-Type':'multipart/form-data',
		'WEB2PY-USER-TOKEN':'842fab80-3201-46e6-b9fb-ce3289f4a9cf'
	}
	};
	request(options,function(error,response,body)
	{
		if(!error && response.statusCode == 200) //if correct
		{
			if(JSON.parse(body).approval_status != undefined){}//already submitted
			else //submit it
			{
				artemisSubmit(entity);
			}
			
		}
		
		
		
	});
}


function artemisSubmit(entity)
{
	var request = require('request');
	//Testing
	/**
	console.log(entity.domain_name);
	console.log(entity.user_id);
	console.log(entity.first_name);
	console.log(entity.last_name);
	console.log(entity.nationality);
	console.log(entity.country_of_residence);
	console.log(entity.onboarding_mode);
	console.log(entity.product_service_complexity);
	console.log(entity.payment_mode);
	console.log(entity.ssic_code);
	console.log(entity.ssoc_code);
	console.log(entity.gender);
	console.log(entity.date_of_birth);
	console.log(entity.identification_type);
	console.log(entity.identification_number);
	**/
	
	 var post_url = "https://p4.cynopsis.co/artemis_nowall/default/individual_risk?domain_name=".concat(entity.domain_name).concat("&rfrID=").concat(entity.user_id).concat("&first_name=").concat(entity.first_name).concat("&last_name=").concat(entity.last_name).concat("&nationality=").concat(entity.nationality).concat("&country_of_residence=").concat(entity.country_of_residence).concat("&onboarding_mode=").concat(entity.onboarding_mode).concat("&product_service_complexity=").concat(entity.product_service_complexity).concat("&payment_mode=").concat(entity.payment_mode).concat("&ssic_code=").concat(entity.ssic_code).concat("&ssoc_code=").concat(entity.ssoc_code).concat("&gender=").concat(entity.gender).concat("&date_of_birth=").concat(entity.date_of_birth).concat("&identification_type=").concat(entity.identification_type).concat("&identification_number=").concat(entity.identification_number);
	 
	 var options = 
	 {
		 url: post_url,
		 headers:
		 {
			 "Cache-Control":"no-cache",
			 "Content-Type":"application/json",
			 "Postman-Token":"4c196595-3e81-4b2a-8211-6e6f6fd71190",
			 "WEB2PY-USER-TOKEN":"842fab80-3201-46e6-b9fb-ce3289f4a9cf"
		 }
	 };
	 request.post(options,function(error,response,body)
	 {
		 if(error)
		 {
			 console.log("Submission Error: ".concat(error)); //error
		 }else
		 {
		 
			if(!error && response.statusCode == 200) //if correct
			{
				var retObject =  JSON.parse(body)
				if(retObject.error == null)
				{
					updateDatabaseSuccess(entity);
				}else
				{
					console.log("Following errors ".concat(error));
				}
			}
		 }
	 });
	
}

function updateDatabaseSuccess(entity)
{
	var connection = createSQL();
	connection.query("UPDATE kyc SET status = 'Pending' where user_id = '".concat(entity.user_id).concat("'"),function(error,response,body)
	{
		connection.end();
		console.log(response);
		console.log('record created');
		
		querySix(entity);
	});
	
}


function querySix(entity)
{
	var connection = createSQL();
	connection.query("SELECT id_photo_front,id_photo_front_name,id_photo_selfie,id_photo_selfie_name FROM kyc where user_id = '".concat(entity.user_id).concat("'"),function(error,results,body)
	{
		connection.end();
		if(error)throw error;
		
		if(results.length >0) //found
		{
			
			entity.img_front = "kyc/images/new_customer/".concat(results[0].id_photo_front_name);
			entity.img_selfie = "kyc/images/new_customer/".concat(results[0].id_photo_selfie_name);
			
			uploadSelfie(entity);
		}else
		{
			
		}
			
	});
	
}

function uploadSelfie(entity) //untested
{

	if(entity.img_selfie == ''){}
	else
	{
		var request = require('request');
		var options = 
		{	
			url : "https://p4.cynopsis.co/artemis_nowall/api/individual_doc",
			headers:
			{
				"Content-Type":"multipart/form-data",
				"WEB2PY-USER-TOKEN":"842fab80-3201-46e6-b9fb-ce3289f4a9cf"
			},
			formData:
			{
				file: fs.createReadStream('kyc/images/new_customer/'.concat(entity.img_selfie)),
				cust_rfr_id:entity.user_id,
				document_type:'SELFIE'
			}

		};
		request.post(options,function(error,response,body)
		{
			
			if(error)
			{
				console.log("Submission Error: ".concat(error));
			}else
			{
				if(!error && response.statusCode == 200)
				{
					console.log(body);
					entity.selfie_id = JSON.parse(body).id;
					querySeven(entity);
				}
			}	
		});
	}
}

function querySeven(entity)
{
	var connection = createSQL();
	connection.query("SELECT * from IMAGE_DOCUMENT_ID where CUST_RFR_ID = '".concat(entity.user_id).concat("'"),function(error,results,fields)
	{
		connection.end();
		if(error)throw error;
		if(results.length>0)
		{
			connection = createSQL();
			connection.query("UPDATE IMAGE_DOCUMENT_ID SET selfie_no = '".concat(entity.selfie_id).concat("'").concat("WHERE CUST_RFR_ID = '").concat(entity.user_id).concat("'"),function(error,results,fields)
			{
				connection.end();
				uploadPassport(entity);
			});
			
		}else
		{
			connection = createSQL();
			connection.query("INSERT INTO IMAGE_DOCUMENT_ID(CUST_RFR_ID,SELFIE_NO) VALUES ('".concat(entity.user_id).concat(",'").concat(entity.selfie_id).concat("'"),
			function(error,results,fields)
			{
				connection.end();
				uploadPassport(entity);
			});
		}
			
	});
	
}

function uploadPassport(entity)
{
	if(entity.img_front == ''){}
	else
	{
		var request = require('request');
		var options = 
		{	
			url : "https://p4.cynopsis.co/artemis_nowall/api/individual_doc",
			headers:
			{
				"Content-Type":"multipart/form-data",
				"WEB2PY-USER-TOKEN":"842fab80-3201-46e6-b9fb-ce3289f4a9cf"
			},
			formData:
			{
				file: fs.createReadStream('kyc/images/new_customer/'.concat(entity.img_front)),
				cust_rfr_id:entity.user_id,
				document_type:'PASSPORT'
			}

		};
		request.post(options,function(error,response,body)
		{
			if(error)
			{
				console.log("Submission Error: ".concat(error));
			}else
			{
				if(!error && response.statusCode == 200){
					console.log(body);
					entity.passport_id = JSON.parse(body).id;
					queryEight(entity);
				}
			}	
		});
	}
		
}

function queryEight(entity)
{
	var connection = createSQL();
	connection.query("SELECT * from IMAGE_DOCUMENT_ID where CUST_RFR_ID = '".concat(entity.user_id).concat("'"),function(error,results,fields)
	{
		connection.end();
		if(error)throw error;
		if(results.length>0)
		{
			connection = createSQL();
			connection.query("UPDATE IMAGE_DOCUMENT_ID SET id_no = '".concat(entity.passport_id).concat("' WHERE CUST_RFR_ID = '").concat(entity.user_id).concat("'")
			,function(error,results,fields)
			{
				connection.end();
				if(error)throw error;
				console.log('images submitted');
				faceComparison(entity);
			});
			
		}else
		{
			connection = createSQL();
			connection.query("INSERT INTO IMAGE_DOCUMENT_ID(CUST_RFR_ID,ID_NO) VALUES ('".concat(entity.user_id).concat("','").concat(entity.passport_id).concat("')"),function(error,results,fields)
			{
				connection.end();
				if(error)throw error;
				console.log('images submitted');
				faceComparison(entity);			
			});
			
		}
	});
}


function faceComparison(entity)
{
	var connection = createSQL();
	connection.query("SELECT id_no,selfie_no FROM IMAGE_DOCUMENT_ID where CUST_RFR_ID = '".concat(entity.user_id).concat("'"),function(error,results,fields)
	{
		connection.end();
		if(error)throw error;
		if(results.length > 0)
		{
			
			var request = require('request');
					console.log(entity.user_id);
			var options = 
			{	
				url : "https://p4.cynopsis.co/artemis_nowall/api/individual_face",
				headers:
				{
					"Content-Type":"multipart/form-data",
					"WEB2PY-USER-TOKEN":"842fab80-3201-46e6-b9fb-ce3289f4a9cf"
				},
				formData:
				{
					cust_rfr_id: entity.user_id,
					source_doc_id:results[0].id_no,
					target_doc_id:results[0].selfie_no
				}

			};
			
			request.post(options,function(error,response,body)
			{
				console.log("STATUS CODE "+ response.statusCode);
				console.log("BODY "+body);
				
				if(error)
				{
					console.log("Submission Error: ".concat(error));
				}else
				{
					if(!error && response.statusCode == 200)
					{
						console.log(body);
						indivReport(entity);
					}
				}	
			});
		}
	});
	
}

function indivReport(entity)
{
	var request = require('request');
	var options = 
	{
		url : "https://p4.cynopsis.co/artemis_nowall/api/individual_customer_report",
		headers:
		{
			"Content-Type":"multipart/form-data",
			"WEB2PY-USER-TOKEN":"842fab80-3201-46e6-b9fb-ce3289f4a9cf"
		},
		formData:
		{
			cust_rfr_id:entity.user_id
		}
	}
	request.post(options,function(error,response,body)
	{
		console.log(response.statusCode);
		
		if(error)
		{
			console.log("Submission Error: ".concat(error));
		}else
		{
			if(!error && response.statusCode == 200)
			{
				console.log(body);
				var json_final = JSON.parse(body);
				if(json_final.approval_status != null)
				{
					var connection = createSQL();
					connection.query("SELECT * from kyc_status where user_id ='".concat(entity.user_id).concat("'"),function(error,results,fields)
					{
						connection.end();
						if(error)throw error;
						if(results.length>0)
						{
							connection = createSQL();
							connection.query("UPDATE kyc_status SET status = '".concat(json_final.approval_status).concat("',send_status = 'no',processing_status = 'yes' where user_id='").concat(entity.user_id).concat("'"),
							function(error,results,fields)
							{
								connection.end();
								if(error)throw error;
								console.log("Done");
							});
								
						}else
						{
							connection = createSQL();
							connection.query("INSERT INTO kyc_status(user_id,status,send_status,processing_status) VALUES ('".concat(entity.user_id).concat("','").concat(json_final.approval_status).concat("','no','yes')"),function(error,results,fields)
							{
								connection.end();
								if(error)throw error;
								console.log("Done");
							});
						}
					});
				}
			}
					
		}			
	});
}

queryOne();
