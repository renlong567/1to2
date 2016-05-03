<?php
require("../../inc/header.php");

/*
		SoftName : EmpireBak Version 2010
		Author   : wm_chief
		Copyright: Powered by www.phome.net
*/

DoSetDbChar('utf8');
E_D("DROP TABLE IF EXISTS `ecs_users`;");
E_C("CREATE TABLE `ecs_users` (
  `user_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(60) NOT NULL DEFAULT '',
  `user_name` varchar(60) NOT NULL DEFAULT '',
  `password` varchar(32) NOT NULL DEFAULT '',
  `question` varchar(255) NOT NULL DEFAULT '',
  `answer` varchar(255) NOT NULL DEFAULT '',
  `sex` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `birthday` date NOT NULL DEFAULT '0000-00-00',
  `user_money` decimal(10,2) NOT NULL DEFAULT '0.00',
  `frozen_money` decimal(10,2) NOT NULL DEFAULT '0.00',
  `real_name` varchar(20) DEFAULT NULL,
  `idtype` varchar(20) DEFAULT 'TOC001',
  `customerid` varchar(32) DEFAULT NULL,
  `pay_points` int(10) unsigned NOT NULL DEFAULT '0',
  `rank_points` int(10) unsigned NOT NULL DEFAULT '0',
  `address_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `reg_time` int(10) unsigned NOT NULL DEFAULT '0',
  `last_login` int(11) unsigned NOT NULL DEFAULT '0',
  `last_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `last_ip` varchar(15) NOT NULL DEFAULT '',
  `visit_count` smallint(5) unsigned NOT NULL DEFAULT '0',
  `user_rank` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `is_special` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `ec_salt` varchar(10) DEFAULT NULL,
  `salt` varchar(10) NOT NULL DEFAULT '0',
  `parent_id` mediumint(9) NOT NULL DEFAULT '0',
  `flag` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `alias` varchar(60) NOT NULL,
  `msn` varchar(60) NOT NULL,
  `qq` varchar(20) NOT NULL,
  `office_phone` varchar(20) NOT NULL,
  `home_phone` varchar(20) NOT NULL,
  `mobile_phone` varchar(20) NOT NULL,
  `is_validated` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `credit_line` decimal(10,2) unsigned NOT NULL,
  `passwd_question` varchar(50) DEFAULT NULL,
  `passwd_answer` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `user_name` (`user_name`),
  KEY `email` (`email`),
  KEY `parent_id` (`parent_id`),
  KEY `flag` (`flag`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8");
E_D("replace into `ecs_users` values('1','123456@qq.com','123456789','25f9e794323b453885f5181f1b624d0b','','','0','0000-00-00','0.00','0.00',NULL,'TOC001',NULL,'0','0','0','1438756843','1438756843','0000-00-00 00:00:00','127.0.0.1','1','0','0',NULL,'0','0','0','','','','','','','0','0.00','interest','chi');");
E_D("replace into `ecs_users` values('2','7600687@qq.com','zzsky','dd7ec91347f472a23393ba2df49c9a44','','','0','0000-00-00','0.00','0.00',NULL,'TOC001',NULL,'0','0','1','1453953058','1454047990','0000-00-00 00:00:00','123.14.204.53','3','0','0','4804','0','0','0','','','','','','','0','0.00','old_address','ls');");
E_D("replace into `ecs_users` values('3','528187@qq.com','hicancer','7f609c5b0f35444d44756071361242be','','','0','1956-01-01','0.00','0.00','谢伟','TOC001','452502198005083135','614','614','2','1454249312','1454583143','0000-00-00 00:00:00','127.0.0.1','7','0','0','4107','0','0','0','','','','','','','0','0.00','friend_birthday','111111');");

require("../../inc/footer.php");
?>