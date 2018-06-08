/*
SQLyog Community v10.3 
MySQL - 5.7.21 
*********************************************************************
*/
/*!40101 SET NAMES utf8 */;

create table `transactions_transaction` (
	`id` text ,
	`tx_hash` text ,
	`amount` text ,
	`odin_token_equivalent` text ,
	`token` text ,
	`toAddress` text ,
	`tx_timestamp` datetime ,
	`status` text ,
	`created_at` datetime ,
	`updated_at` datetime ,
	`deleted_at` datetime ,
	`user_id` text ,
	`fromAddress` text ,
	`status_msg` text ,
	`is_db_token` text ,
	`is_premium` text 
); 
insert into `transactions_transaction` (`id`, `tx_hash`, `amount`, `odin_token_equivalent`, `token`, `toAddress`, `tx_timestamp`, `status`, `created_at`, `updated_at`, `deleted_at`, `user_id`, `fromAddress`, `status_msg`, `is_db_token`, `is_premium`) values('1','abcd','221','56','njbg','imjn','2018-06-06 17:23:19','CLEARED',NULL,NULL,NULL,'1','LKMN','NIL','NO','NO');
insert into `transactions_transaction` (`id`, `tx_hash`, `amount`, `odin_token_equivalent`, `token`, `toAddress`, `tx_timestamp`, `status`, `created_at`, `updated_at`, `deleted_at`, `user_id`, `fromAddress`, `status_msg`, `is_db_token`, `is_premium`) values('2','abcdxxx','22112','5612','njbgxx','iaamjn','2018-06-04 17:23:24','CLEARED',NULL,NULL,NULL,'2','LKMN','NIL','NO','NO');
insert into `transactions_transaction` (`id`, `tx_hash`, `amount`, `odin_token_equivalent`, `token`, `toAddress`, `tx_timestamp`, `status`, `created_at`, `updated_at`, `deleted_at`, `user_id`, `fromAddress`, `status_msg`, `is_db_token`, `is_premium`) values('2','abcdddxxx','2992112','512612','njbgxxxx','i11aamjn','2018-06-04 17:23:27','CLEARED',NULL,NULL,NULL,'2','LKMNg','NIL','NO','NO');
insert into `transactions_transaction` (`id`, `tx_hash`, `amount`, `odin_token_equivalent`, `token`, `toAddress`, `tx_timestamp`, `status`, `created_at`, `updated_at`, `deleted_at`, `user_id`, `fromAddress`, `status_msg`, `is_db_token`, `is_premium`) values('15','abcddaadxxx','882112','589612','njkkxxxx','i11ujmjn','2018-05-09 17:23:32','CLEARED',NULL,NULL,NULL,'15','LKMNg','NIL','NO','NO');
