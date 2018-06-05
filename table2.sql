/*
SQLyog Community v10.3 
MySQL - 5.7.21 
*********************************************************************
*/
/*!40101 SET NAMES utf8 */;

create table `transaction_usertoken` (
	`id` int (11),
	`token_name` text ,
	`holdings` double ,
	`created_at` text ,
	`updated_at` text ,
	`deleted_at` text ,
	`user_id` int (11),
	`wallet_id` text 
); 
insert into `transaction_usertoken` (`id`, `token_name`, `holdings`, `created_at`, `updated_at`, `deleted_at`, `user_id`, `wallet_id`) values('3','ATV','42200','2018-04-30 03:07:35.004870','2018-05-11 05:50:27.681988','2018-05-11 05:50:27.681995','26','0xab419ff7eda408bcba6ab925e8f356bb96adf687');
insert into `transaction_usertoken` (`id`, `token_name`, `holdings`, `created_at`, `updated_at`, `deleted_at`, `user_id`, `wallet_id`) values('4','ABT','36760','2018-04-30 03:07:37.210060','2018-05-11 05:50:28.555048','2018-05-11 05:50:28.555054','26','0xab419ff7eda408bcba6ab925e8f356bb96adf687');
insert into `transaction_usertoken` (`id`, `token_name`, `holdings`, `created_at`, `updated_at`, `deleted_at`, `user_id`, `wallet_id`) values('7','ATV','52900','2018-04-30 04:06:10.789005','2018-05-04 04:20:45.098311','2018-05-04 04:20:45.098321','30','0xab6f5591a5a70e12d774fd9aa9bb405d4eed5676');
insert into `transaction_usertoken` (`id`, `token_name`, `holdings`, `created_at`, `updated_at`, `deleted_at`, `user_id`, `wallet_id`) values('8','ABT','8000','2018-04-30 04:06:12.808225','2018-05-04 04:20:47.158996','2018-05-04 04:20:47.159023','30','0xab6f5591a5a70e12d774fd9aa9bb405d4eed5676');
insert into `transaction_usertoken` (`id`, `token_name`, `holdings`, `created_at`, `updated_at`, `deleted_at`, `user_id`, `wallet_id`) values('9','ATV','0','2018-05-10 06:51:48.762944','2018-05-10 07:14:40.170143','2018-05-10 07:14:40.170187','32','0x82bcb583ce12332247768ba8060357426633584f');
insert into `transaction_usertoken` (`id`, `token_name`, `holdings`, `created_at`, `updated_at`, `deleted_at`, `user_id`, `wallet_id`) values('10','ABT','0','2018-05-10 06:51:49.876178','2018-05-10 07:14:41.365868','2018-05-10 07:14:41.365931','32','0x82bcb583ce12332247768ba8060357426633584f');
insert into `transaction_usertoken` (`id`, `token_name`, `holdings`, `created_at`, `updated_at`, `deleted_at`, `user_id`, `wallet_id`) values('13','ATV','0','2018-05-11 05:51:10.938991','2018-05-14 02:32:56.844647','2018-05-14 02:32:56.844653','55','0xdd49cba0f4482a38fb982196fde64504f795a922');
insert into `transaction_usertoken` (`id`, `token_name`, `holdings`, `created_at`, `updated_at`, `deleted_at`, `user_id`, `wallet_id`) values('14','ABT','5','2018-05-11 05:51:12.110283','2018-05-14 02:32:57.443327','2018-05-14 02:32:57.443334','55','0xdd49cba0f4482a38fb982196fde64504f795a922');
