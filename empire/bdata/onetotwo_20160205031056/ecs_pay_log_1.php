<?php
require("../../inc/header.php");

/*
		SoftName : EmpireBak Version 2010
		Author   : wm_chief
		Copyright: Powered by www.phome.net
*/

DoSetDbChar('utf8');
E_D("DROP TABLE IF EXISTS `ecs_pay_log`;");
E_C("CREATE TABLE `ecs_pay_log` (
  `log_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `order_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `order_amount` decimal(10,2) unsigned NOT NULL,
  `order_type` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `is_paid` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`log_id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8");
E_D("replace into `ecs_pay_log` values('1','1','299.00','0','0');");
E_D("replace into `ecs_pay_log` values('2','2','841.00','0','0');");
E_D("replace into `ecs_pay_log` values('3','3','312.00','0','0');");
E_D("replace into `ecs_pay_log` values('4','4','304.00','0','0');");
E_D("replace into `ecs_pay_log` values('5','5','103.00','0','0');");
E_D("replace into `ecs_pay_log` values('6','6','304.00','0','0');");
E_D("replace into `ecs_pay_log` values('7','7','103.00','0','0');");

require("../../inc/footer.php");
?>