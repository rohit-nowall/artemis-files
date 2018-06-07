var mysql = require('mysql');

function createSQLSrc()
{
	return mysql.createConnection({
	host:'localhost',
	user:'root',
	password:'password',
	database:'artemistest',
	});
}

function createSQLDst()
{
	return mysql.createConnection({
	host:'localhost',
	user:'root',
	password:'password',
	database:'artemistest',
	});	
}

var connectionSrc = createSQLSrc();
connectionSrc.query("TRUNCATE TABLE kyc",function(error,results,fields)
{
	connectionSrc.end();
	if(error)throw error;
	
	var connectionDst = createSQLDst();
	connectionDst.query("SELECT work_type_id,status,user_id,first_name,middle_name,last_name,dateofbirth,nationality_id,country_id,passport_nid,tax_id,reason,address,address2,city,state,zip_code,id_type,id_photo_front,id_photo_front_name,id_photo_selfie,id_photo_selfie_name,gender,work_industry_id,planned_investment_amount,purpose_of_action FROM kyc",function(error,results,fields)
	{
		connectionDst.end();
		if(error)throw error;
		if(result.length>0)
		{
			result.forEach(function(element)
			{
				echo element.user_id;
				
				connectionSrc = createSQLSrc();
				connectionSrc.query("INSERT INTO kyc(work_type_id,status,user_id,first_name,middle_name,last_name,dateofbirth,nationality_id,country_id,passport_nid,tax_id,reason,address,address2,city,state,zip_code,id_type,id_photo_front,id_photo_front_name,id_photo_selfie,id_photo_selfie_name,gender,work_industry_id,planned_investment_amount,purpose_of_action) VALUES ".concat(element.work_type_id).concat(element.status).concat(element.user_id).concat(element.first_name).concat(element.middle_name).concat(element.last_name).concat(element.dateofbirth).concat(element.nationality_id).concat(element.country_id).concat(element.passport_nid).concat(element.tax_id).concat(element.reason).concat(element.address).concat(element.address2).concat(element.city).concat(element.state).concat(element.zip_code).concat(element.id_type).concat(element.id_photo_front).concat(element.id_photo_front_name).concat(element.id_photo_selfie).concat(element.id_photo_selfie_name).concat(element.gender).concat(element.work_industry_id).concat(element.planned_investment_amount).concat(element.purpose_of_action),function(error,results,fields)
				{
					connectionSrc.end();
					if(error)throw error;
					
				}
				
			}
		}
	}
		
	
	
	
	
});


