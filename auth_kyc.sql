/*
SQLyog Community v10.3 
MySQL - 5.7.21 
*********************************************************************
*/
/*!40101 SET NAMES utf8 */;

create table `authentication_kycuserdetail` (
	`user_detail_id` int (11),
	`wallet_id` text ,
	`first_name` text ,
	`middle_name` text ,
	`last_name` text ,
	`date_of_birth` text ,
	`nationality` text ,
	`country_of_residence` text ,
	`contact_number` text ,
	`odin_holding` double ,
	`tax_id` text ,
	`wallet_open_date` text ,
	`reason` text ,
	`address_line_1` text ,
	`address_line_2` text ,
	`address_line_3` text ,
	`city` text ,
	`state` text ,
	`postal_code` text ,
	`country_home` text ,
	`document_type` text ,
	`document_number` text ,
	`img_front` text ,
	`img_back` text ,
	`img_selfie` text ,
	`public_key` text ,
	`work_address` text ,
	`gender` text ,
	`kyc_flag` text ,
	`kyc_message` text ,
	`keystore` text ,
	`created_at` text ,
	`updated_at` text ,
	`deleted_at` text ,
	`user_id` int (11),
	`odin_points` int (11),
	`industry` int (11),
	`phone_country_code` text ,
	`planned_investment` int (11),
	`purpose_of_action` int (11),
	`work_type` int (11),
	`contact_number_code` text ,
	`document_expiry` text ,
	`kyc_update_date` text ,
	`is_subscribed` int (11)
); 
insert into `authentication_kycuserdetail` (`user_detail_id`, `wallet_id`, `first_name`, `middle_name`, `last_name`, `date_of_birth`, `nationality`, `country_of_residence`, `contact_number`, `odin_holding`, `tax_id`, `wallet_open_date`, `reason`, `address_line_1`, `address_line_2`, `address_line_3`, `city`, `state`, `postal_code`, `country_home`, `document_type`, `document_number`, `img_front`, `img_back`, `img_selfie`, `public_key`, `work_address`, `gender`, `kyc_flag`, `kyc_message`, `keystore`, `created_at`, `updated_at`, `deleted_at`, `user_id`, `odin_points`, `industry`, `phone_country_code`, `planned_investment`, `purpose_of_action`, `work_type`, `contact_number_code`, `document_expiry`, `kyc_update_date`, `is_subscribed`) values('1','1234','gstue','hi','test','2018-01-01','MALAYSIA','','','0','','2018-04-26 09:00:55.819516','','','','','','','','','','','','','','test@test.com','','','PENDING','','','2018-04-26 09:00:55.820012','2018-04-26 09:00:55.820080','2018-04-26 09:00:55.820128','1','0','1','JP','1','1','1','','','','0');
insert into `authentication_kycuserdetail` (`user_detail_id`, `wallet_id`, `first_name`, `middle_name`, `last_name`, `date_of_birth`, `nationality`, `country_of_residence`, `contact_number`, `odin_holding`, `tax_id`, `wallet_open_date`, `reason`, `address_line_1`, `address_line_2`, `address_line_3`, `city`, `state`, `postal_code`, `country_home`, `document_type`, `document_number`, `img_front`, `img_back`, `img_selfie`, `public_key`, `work_address`, `gender`, `kyc_flag`, `kyc_message`, `keystore`, `created_at`, `updated_at`, `deleted_at`, `user_id`, `odin_points`, `industry`, `phone_country_code`, `planned_investment`, `purpose_of_action`, `work_type`, `contact_number_code`, `document_expiry`, `kyc_update_date`, `is_subscribed`) values('2','0xab419ff7eda408bcba6ab925e8f356bb96adf687','Sample','Example','Like','1990-02-28','Alien','MY','1234567890','644','12345678','2018-05-11 05:50:28.560962','Just trading','Bangsar','Kuala Lumpur','Malaysia','Bangsar','Wilayah Persekutan','50470','PH','Passport','AC123456','user_26/multiform.png','user_26/multiform_LrKkKNs.png','user_26/multiform_XHtOo53.png','test2@test.com','Cyberjaya','Male','PENDING','','{\"encSeed\"\":{\"\"encStr\"\":\"\"7igM4307+pgH77WfQ7m0b8ob9uJLo3U7rABU7UW4TiX5zfpUmKU+BEYI9vzQspjrAx3f+9B0IfCPRc3VRXw1I15GgSreUify8mJQmQIXjHlu29n7ftaZjc/uuEfkIcFx/kQKLvC5oc7C5iWZpBorCB1XzvBwmFnuOHGTBl14RhwnLTK/T6Ygjw==\"\",\"\"nonce\"\":\"\"hGv+a9uZWO0de0sNtnFN95OL2hj9HXoF\"\"},\"\"encHdRootPriv\"\":{\"\"encStr\"\":\"\"zm4nEC8acVM5kFpBsAxlOx2XHEH/QzEl6B46SZXm0EfnRNE6eTzdonuR1aSIvqib3B2YtIZyUP4l5POO2S2ofgyEBwDAvLoBjlM6FnmidmA6zzARA39lQREEK6fAb1rcDqYGzRFfNpQAGjJgSZPVK6Ve1vSJIl/O5+/6c5cPQg==\"\",\"\"nonce\"\":\"\"3mSY86g4CfMLe9hgYhPcfBfvTnmMWdA9\"\"},\"\"addresses\"\":[\"\"ab419ff7eda408bcba6ab925e8f356bb96adf687\"\"],\"\"encPrivKeys\"\":{\"\"ab419ff7eda408bcba6ab925e8f356bb96adf687\"\":{\"\"key\"\":\"\"VjUU69w2IxWkopZqyRWfvb4bmVzIQ15xwCMx/iNDfMpZAOyEgbThAsybkpGvpRzd\"\",\"\"nonce\"\":\"\"Z8GtpMHFqCDzbPEBy96bwti5bkgSUCa0\"\"}},\"\"hdPathString\"\":\"\"m/44\'/60\'/0\'/0\"\",\"\"salt\"\":\"\"h9PsTaiL0gFu7MMTqh2D8DEhg1L+BQ4R39HLTZ3hEA4=\"\",\"\"hdIndex\"\":1,\"\"version\"\":3}\"','2018-04-12 06:17:53.156129','2018-05-11 05:50:28.561011','2018-05-11 05:50:28.561014','2','0','1','JP','1','1','1','','','','0');
insert into `authentication_kycuserdetail` (`user_detail_id`, `wallet_id`, `first_name`, `middle_name`, `last_name`, `date_of_birth`, `nationality`, `country_of_residence`, `contact_number`, `odin_holding`, `tax_id`, `wallet_open_date`, `reason`, `address_line_1`, `address_line_2`, `address_line_3`, `city`, `state`, `postal_code`, `country_home`, `document_type`, `document_number`, `img_front`, `img_back`, `img_selfie`, `public_key`, `work_address`, `gender`, `kyc_flag`, `kyc_message`, `keystore`, `created_at`, `updated_at`, `deleted_at`, `user_id`, `odin_points`, `industry`, `phone_country_code`, `planned_investment`, `purpose_of_action`, `work_type`, `contact_number_code`, `document_expiry`, `kyc_update_date`, `is_subscribed`) values('3','0xab6f5591a5a70e12d774fd9aa9bb405d4eed5676','any','body','nobody','1990-02-28','Alien','MY','1234567890','6','pilot','2018-05-04 04:20:47.233973','Just trading','Bangsar','Kuala Lumpur','Malaysia','Bangsar','Wilayah Persekutan','50470','PH','Passport','AC123456','user_30/bxmfav.png','user_30/favicon.ico','user_30/bxm-logo.png','test3@test.com','Cyberjaya','Male','NOT_STARTED','','{\"encSeed\"\":{\"\"encStr\"\":\"\"b0/3tkt3KpPEwTTRf+xPorpnyo90QEeJMF+ABbZaOKSb4uNc+KwO4CWHJRz5Z8pezMsubkjcj2a9vDZ6K2P6uH4eN09QycsXIKdY2ldDyCDGly+06JuyMIENm9K3eiANxTnkuV8PPh5ew1jmlGV9xvoene9aq+KowEGn0Y2di7kHD6X58hjrEA==\"\",\"\"nonce\"\":\"\"sSo8kP9g9/TgcaVowgTUgfYrmFZvMf0Q\"\"},\"\"encHdRootPriv\"\":{\"\"encStr\"\":\"\"Grd2f9B7WAN0/pXCIXihgZ6AyOLbAZQF/i8aINu0L72hSNRSpSkydU3OpKW4SoPGs95Irg3vlc46N7TBq7sazfertJduIHCUc9n3L8zPK1qi7BoH0l5Pd/jKNmvSCtC+9B3hUuphh5RM/6AG1ShSzYAj7dkQQroN1pD2fsRRpg==\"\",\"\"nonce\"\":\"\"96hL5YE2TBEt2xVqjFbny6A/pHV3A1Vz\"\"},\"\"addresses\"\":[\"\"ab6f5591a5a70e12d774fd9aa9bb405d4eed5676\"\"],\"\"encPrivKeys\"\":{\"\"ab6f5591a5a70e12d774fd9aa9bb405d4eed5676\"\":{\"\"key\"\":\"\"oWNCJSexW8ElDdyIXOQRhFglwxplSnw9QF8M8tpEkI84XbTmlCPg5GAmMPgSu7iY\"\",\"\"nonce\"\":\"\"QlZW9PwmZqtlOq5YKsSg3PZZzKZb4XIk\"\"}},\"\"hdPathString\"\":\"\"m/44\'/60\'/0\'/0\"\",\"\"salt\"\":\"\"S96tz147UK2QZUUHDZMIRcLrr/JozcxAOGAnt60vNiE=\"\",\"\"hdIndex\"\":1,\"\"version\"\":3}\"','2018-04-13 03:19:49.609951','2018-05-04 04:20:47.234147','2018-05-04 04:20:47.234163','3','0','1','JP','1','0','1','','','','0');
insert into `authentication_kycuserdetail` (`user_detail_id`, `wallet_id`, `first_name`, `middle_name`, `last_name`, `date_of_birth`, `nationality`, `country_of_residence`, `contact_number`, `odin_holding`, `tax_id`, `wallet_open_date`, `reason`, `address_line_1`, `address_line_2`, `address_line_3`, `city`, `state`, `postal_code`, `country_home`, `document_type`, `document_number`, `img_front`, `img_back`, `img_selfie`, `public_key`, `work_address`, `gender`, `kyc_flag`, `kyc_message`, `keystore`, `created_at`, `updated_at`, `deleted_at`, `user_id`, `odin_points`, `industry`, `phone_country_code`, `planned_investment`, `purpose_of_action`, `work_type`, `contact_number_code`, `document_expiry`, `kyc_update_date`, `is_subscribed`) values('15','0xdd49cba0f4482a38fb982196fde64504f795a922','waleed','khaled','alqaefi','1989-05-09','YE','MY','1137785824','1','','2018-05-14 02:32:58.381359','I dont have a solid reason ','Vertex Cybersquare','Cyber5','','cyberjaya','selangor','123456','YE','Passport','123456','user_55/IMG-20180502-WA0000.jpg','user_55/IMG-20180501-WA0007.jpg','user_55/IMG-20180501-WA0005.jpg','live@test.com','This is work address','Male','CLEARED','','{\"encSeed\"\":{\"\"encStr\"\":\"\"jmNFCjOrz9mLDC46pjohazCIRlnFE4Y0xc3unHK3CCJ0KhX6PFHATCLZLaKENKBbNpCzFWm2Tof8aRaJyRjps39R9ZqBkNiyQp1kq+N7vMClNvooNtFL5VykZsphExO/CObPmvHS/O7oWxcioJ6l3a67Por4yHKaZQ9Vu5oszKIIoJEXt1vLzw==\"\",\"\"nonce\"\":\"\"9tLDxO31CRz65FUiutHtPK4yl478rkBr\"\"},\"\"encHdRootPriv\"\":{\"\"encStr\"\":\"\"1Q2j0vgccrCv4kcI4jicqv0Kb1ywDOsHoJHuIU8lPvTMZbtMYgEJGYzHEBguiMewIW0aABldfUkKm7DasXKd+2s12qM4c0FqHMWJLj8u3Uu8E2jP4DnjJpDJYWkwsjj313zBRDAzuYoEcxmHiiS1AFNuj38DLTS751U6rU1isQ==\"\",\"\"nonce\"\":\"\"DJvc58txoD0UtAP2JMyjhLXOt0pm+Uk0\"\"},\"\"addresses\"\":[\"\"dd49cba0f4482a38fb982196fde64504f795a922\"\"],\"\"encPrivKeys\"\":{\"\"dd49cba0f4482a38fb982196fde64504f795a922\"\":{\"\"key\"\":\"\"+yUpYVfhvf5Vi7jkllcxWJ64UlST3gUe7QevlCymcjiySk6JIcaFvSGGWwrhRDdu\"\",\"\"nonce\"\":\"\"P6O0mq2gOm/45JchZ+o6O7XfuTcsu01P\"\"}},\"\"hdPathString\"\":\"\"m/44\'/60\'/0\'/0\"\",\"\"salt\"\":\"\"//56DqoQhl3OciW9Lz+r7jaW6KNDmdcdomNHCNYhono=\"\",\"\"hdIndex\"\":1,\"\"version\"\":3}\"','2018-05-09 05:01:23.322360','2018-05-14 02:32:58.381411','2018-05-14 02:32:58.381415','15','4960','9','MY','2','1','2','','2018-5-9','','1');
