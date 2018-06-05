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
	`tx_timestamp` text ,
	`status` text ,
	`created_at` text ,
	`updated_at` text ,
	`deleted_at` text ,
	`user_id` text ,
	`fromAddress` text ,
	`status_msg` text ,
	`is_db_token` text ,
	`is_premium` text 
); 
insert into `transactions_transaction` (`id`, `tx_hash`, `amount`, `odin_token_equivalent`, `token`, `toAddress`, `tx_timestamp`, `status`, `created_at`, `updated_at`, `deleted_at`, `user_id`, `fromAddress`, `status_msg`, `is_db_token`, `is_premium`) values('id','tx_hash','amount','odin_token_equivalent','token','toAddress','tx_timestamp','status','created_at','updated_at','deleted_at','user_id','fromAddress','status_msg','is_db_token','is_premium');
