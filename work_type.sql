/*
SQLyog Community v10.3 
MySQL - 5.7.21 
*********************************************************************
*/
/*!40101 SET NAMES utf8 */;

create table `work_type` (
	`id` int (11),
	`name` varchar (765),
	`name_jp` varchar (765),
	`datetime_created` datetime ,
	`datetime_updated` datetime 
); 
insert into `work_type` (`id`, `name`, `name_jp`, `datetime_created`, `datetime_updated`) values('1','Salaried - General','','0000-00-00 00:00:00.000','0000-00-00 00:00:00.000');
insert into `work_type` (`id`, `name`, `name_jp`, `datetime_created`, `datetime_updated`) values('2','Salaried - Executive Level','','0000-00-00 00:00:00.000','0000-00-00 00:00:00.000');
insert into `work_type` (`id`, `name`, `name_jp`, `datetime_created`, `datetime_updated`) values('3','Self Employed','','0000-00-00 00:00:00.000','0000-00-00 00:00:00.000');
insert into `work_type` (`id`, `name`, `name_jp`, `datetime_created`, `datetime_updated`) values('4','Student','','0000-00-00 00:00:00.000','0000-00-00 00:00:00.000');
insert into `work_type` (`id`, `name`, `name_jp`, `datetime_created`, `datetime_updated`) values('5','Unemployed','','0000-00-00 00:00:00.000','0000-00-00 00:00:00.000');
insert into `work_type` (`id`, `name`, `name_jp`, `datetime_created`, `datetime_updated`) values('6','Retired','','0000-00-00 00:00:00.000','0000-00-00 00:00:00.000');
insert into `work_type` (`id`, `name`, `name_jp`, `datetime_created`, `datetime_updated`) values('7','Homemaker','','0000-00-00 00:00:00.000','0000-00-00 00:00:00.000');
