<?php
require("../../inc/header.php");

/*
		SoftName : EmpireBak Version 2010
		Author   : wm_chief
		Copyright: Powered by www.phome.net
*/

DoSetDbChar('utf8');
E_D("DROP TABLE IF EXISTS `ecs_delivery_order`;");
E_C("CREATE TABLE `ecs_delivery_order` (
  `delivery_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `delivery_sn` varchar(20) NOT NULL,
  `order_sn` varchar(20) NOT NULL,
  `order_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `invoice_no` varchar(50) DEFAULT NULL,
  `add_time` int(10) unsigned DEFAULT '0',
  `shipping_id` tinyint(3) unsigned DEFAULT '0',
  `shipping_name` varchar(120) DEFAULT NULL,
  `user_id` mediumint(8) unsigned DEFAULT '0',
  `action_user` varchar(30) DEFAULT NULL,
  `consignee` varchar(60) DEFAULT NULL,
  `address` varchar(250) DEFAULT NULL,
  `country` smallint(5) unsigned DEFAULT '0',
  `province` smallint(5) unsigned DEFAULT '0',
  `city` smallint(5) unsigned DEFAULT '0',
  `district` smallint(5) unsigned DEFAULT '0',
  `sign_building` varchar(120) DEFAULT NULL,
  `email` varchar(60) DEFAULT NULL,
  `zipcode` varchar(60) DEFAULT NULL,
  `tel` varchar(60) DEFAULT NULL,
  `mobile` varchar(60) DEFAULT NULL,
  `best_time` varchar(120) DEFAULT NULL,
  `postscript` varchar(255) DEFAULT NULL,
  `how_oos` varchar(120) DEFAULT NULL,
  `insure_fee` decimal(10,2) unsigned DEFAULT '0.00',
  `shipping_fee` decimal(10,2) unsigned DEFAULT '0.00',
  `update_time` int(10) unsigned DEFAULT '0',
  `suppliers_id` smallint(5) DEFAULT '0',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `agency_id` smallint(5) unsigned DEFAULT '0',
  PRIMARY KEY (`delivery_id`),
  KEY `user_id` (`user_id`),
  KEY `order_id` (`order_id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8");
E_D("replace into `ecs_delivery_order` values('2','20160131141398034','2016013138821','2',NULL,'1454249526','2','邮政快递包裹','3','admin','xie','11111','1','2','52','500','','528187@qq.com','537121','11111','','','','等待所有商品备齐后再发','0.00','13.00','1454249617','0','2','0');");
E_D("replace into `ecs_delivery_order` values('3','20160131141405470','2016013138821','2',NULL,'1454249526','2','邮政快递包裹','3','admin','xie','11111','1','2','52','500','','528187@qq.com','537121','11111','','','','等待所有商品备齐后再发','0.00','13.00','1454249649','0','2','0');");
E_D("replace into `ecs_delivery_order` values('4','20160201065579510','2016020158480','3','','1454309623','2','邮政快递包裹','3','admin','xie','11111','1','2','52','500','','528187@qq.com','537121','11111','','','','','0.00','5.00','1454309712','0','0','0');");
E_D("replace into `ecs_delivery_order` values('5','20160201065578110','2016020158480','3','','1454309623','2','邮政快递包裹','3','admin','xie','11111','1','2','52','500','','528187@qq.com','537121','11111','','','','','0.00','5.00','1454309756','1','0','0');");
E_D("replace into `ecs_delivery_order` values('6','20160204134953085','2016020483117','7',NULL,'1454591728','2','邮政快递包裹','3','admin','xie','11111','1','2','52','500','','528187@qq.com','537121','11111','','','','等待所有商品备齐后再发','0.00','5.00','1454593788','1','2','0');");

require("../../inc/footer.php");
?>