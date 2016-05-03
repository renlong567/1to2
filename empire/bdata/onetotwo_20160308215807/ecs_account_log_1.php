<?php
require("../../inc/header.php");

/*
		SoftName : EmpireBak Version 2010
		Author   : wm_chief
		Copyright: Powered by www.phome.net
*/

DoSetDbChar('utf8');
E_D("DROP TABLE IF EXISTS `ecs_account_log`;");
E_C("CREATE TABLE `ecs_account_log` (
  `log_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` mediumint(8) unsigned NOT NULL,
  `user_money` decimal(10,2) NOT NULL,
  `frozen_money` decimal(10,2) NOT NULL,
  `rank_points` mediumint(9) NOT NULL,
  `pay_points` mediumint(9) NOT NULL,
  `change_time` int(10) unsigned NOT NULL,
  `change_desc` varchar(255) NOT NULL,
  `change_type` tinyint(3) unsigned NOT NULL,
  PRIMARY KEY (`log_id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8");
E_D("replace into `ecs_account_log` values('1','2','0.00','0.00','299','299','1454228696','订单 2016012989062 赠送的积分','99');");
E_D("replace into `ecs_account_log` values('2','2','0.00','0.00','-299','-299','1454249371','由于退货或未发货操作，退回订单 2016012989062 赠送的积分','99');");
E_D("replace into `ecs_account_log` values('3','3','0.00','0.00','307','307','1454309806','订单 2016020158480 赠送的积分','99');");
E_D("replace into `ecs_account_log` values('4','3','0.00','0.00','307','307','1454309828','订单 2016020158480 赠送的积分','99');");

require("../../inc/footer.php");
?>