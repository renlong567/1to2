<?php
require("../../inc/header.php");

/*
		SoftName : EmpireBak Version 2010
		Author   : wm_chief
		Copyright: Powered by www.phome.net
*/

DoSetDbChar('utf8');
E_D("DROP TABLE IF EXISTS `ecs_order_action`;");
E_C("CREATE TABLE `ecs_order_action` (
  `action_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `order_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `action_user` varchar(30) NOT NULL DEFAULT '',
  `order_status` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `shipping_status` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `pay_status` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `action_place` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `action_note` varchar(255) NOT NULL DEFAULT '',
  `log_time` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`action_id`),
  KEY `order_id` (`order_id`)
) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=utf8");
E_D("replace into `ecs_order_action` values('1','1','admin','1','0','0','0','','1454228621');");
E_D("replace into `ecs_order_action` values('2','1','admin','1','0','2','0','2','1454228633');");
E_D("replace into `ecs_order_action` values('3','1','admin','1','3','2','0','','1454228641');");
E_D("replace into `ecs_order_action` values('4','1','admin','5','5','2','0','','1454228658');");
E_D("replace into `ecs_order_action` values('5','1','admin','1','1','2','1','','1454228696');");
E_D("replace into `ecs_order_action` values('6','1','admin','5','0','2','0','22','1454249371');");
E_D("replace into `ecs_order_action` values('7','2','admin','1','0','2','0','sd','1454249591');");
E_D("replace into `ecs_order_action` values('8','2','admin','1','3','2','0','','1454249595');");
E_D("replace into `ecs_order_action` values('9','2','admin','6','5','2','0','','1454249617');");
E_D("replace into `ecs_order_action` values('10','2','admin','5','5','2','0','','1454249649');");
E_D("replace into `ecs_order_action` values('11','3','admin','1','0','2','0','11','1454309684');");
E_D("replace into `ecs_order_action` values('12','3','admin','1','3','2','0','','1454309693');");
E_D("replace into `ecs_order_action` values('13','3','admin','6','5','2','0','','1454309712');");
E_D("replace into `ecs_order_action` values('14','3','admin','5','5','2','0','','1454309756');");
E_D("replace into `ecs_order_action` values('15','3','admin','1','4','2','1','','1454309806');");
E_D("replace into `ecs_order_action` values('16','3','admin','1','1','2','1','','1454309828');");
E_D("replace into `ecs_order_action` values('17','7','admin','1','0','2','0','55','1454593024');");
E_D("replace into `ecs_order_action` values('18','7','admin','1','3','2','0','','1454593030');");
E_D("replace into `ecs_order_action` values('19','7','admin','5','5','2','0','dddd','1454593788');");
E_D("replace into `ecs_order_action` values('20','8','admin','1','0','2','0','ss','1456074736');");
E_D("replace into `ecs_order_action` values('21','8','admin','1','3','2','0','','1456074742');");
E_D("replace into `ecs_order_action` values('22','8','admin','5','5','2','0','asasa','1456074751');");
E_D("replace into `ecs_order_action` values('23','6','admin','3','0','0','0','dfhgfdh','1457401354');");
E_D("replace into `ecs_order_action` values('24','9','admin','1','0','2','0','sfsd','1457470007');");
E_D("replace into `ecs_order_action` values('25','10','admin','1','0','2','0','ssss','1457471384');");

require("../../inc/footer.php");
?>