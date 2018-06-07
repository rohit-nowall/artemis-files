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


function queryOne()
{
	var connectionSrc = createSQLSrc();
	connection.queryCommandEnabled("SELECT * from kyc_status WHERE send_status = 'no",function(error,results,fields)
	{
		connectionSrc.end();
		if(error)throw error;
		if(results.length>0)
		{
			
			results.forEach(function(element)
			{
				queryTwo(element)
				
			});
			
		}
	});
}
function queryTwo(entity)
{
	var request = require('request');
	var options = 
	{
		url:"https://p4.cynopsis.co/artemis_nowall/default/check_status.json?rfrID=".concat(entity.user_id),
		headers
		{
			"Content-Type": "multipart/form-data",			
			"WEB2PY-USER-TOKEN": "842fab80-3201-46e6-b9fb-ce3289f4a9cf"			
		}

	}
	request(options,function(error,response,body)
	{
		if(error){ console.log("Submission Error :".concat(error);}
		else
		{
			console.log(body);
			var json_result = JSON.parse(body);
			if(json_result.approval_status !=null)
			{
				var connectionSrc = createSQLSrc();
				connectionSrc.query("UPDATE kyc_status SET status = '".concat(json_result.approval_status).concat("',send_status = 'no' WHERE user_id = '").concat(entity.user_id).concat("'"),function(error,results,fields)
				{
					connectionSrc.end();
					if(error)throw error;
					
					if(json_result.approval_status == 'CLEARED')
					{
							var connectionBtn = createSQLDst();
							connectionBtn.query("UPDATE kyc SET status = 'CLEARED' where user_id = '".concat(entity.user_id).concat("'"),
							function(error,results,fields)
							{
								connectionBtn.end();
								if(error)throw error;
								
								connectionSrc = createSQLsrc();
								connectionSrc.query("UPDATE kyc_status SET send_status = 'yes' where user_id = '".concat(entity.user_id).concat("'"),function(error,results,fields)
								{
									connectionSrc.end();
									if(error)throw error;
								});
								
							});
							
							
					}else if(json_result.approval_status == 'ACCEPTED')
					{
							var connectionBtn = createSQLDst();
							connectionBtn.query("UPDATE kyc SET status = 'CLEARED' where user_id = '".concat(entity.user_id).concat("'"),
							function(error,results,fields)
							{
								connectionBtn.end();
								if(error)throw error;
								
								connectionSrc = createSQLsrc();
								connectionSrc.query("UPDATE kyc_status SET send_status = 'yes' where user_id = '".concat(entity.user_id).concat("'"),function(error,results,fields)
								{
									connectionSrc.end();
									if(error)throw error;
								});
								
							});						
					}else if(json_result.approval_status == 'REJECTED');
					{
							var connectionBtn = createSQLDst();
							connectionBtn.query("UPDATE kyc SET status = 'REJECTED' where user_id = '".concat(entity.user_id).concat("'"),
							function(error,results,fields)
							{
								connectionBtn.end();
								if(error)throw error;
								
								connectionSrc = createSQLsrc();
								connectionSrc.query("UPDATE kyc_status SET send_status = 'yes' where user_id = '".concat(entity.user_id).concat("'"),function(error,results,fields)
								{
									connectionSrc.end();
									if(error)throw error;
								});
								
							});									
					}
				});
			}
		}	
	});
}

queryOne();