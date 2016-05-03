<?php
require("../../inc/header.php");

/*
		SoftName : EmpireBak Version 2010
		Author   : wm_chief
		Copyright: Powered by www.phome.net
*/

DoSetDbChar('utf8');
E_D("DROP TABLE IF EXISTS `ecs_order_info`;");
E_C("CREATE TABLE `ecs_order_info` (
  `order_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `order_sn` varchar(20) NOT NULL DEFAULT '',
  `user_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `order_status` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `shipping_status` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `pay_status` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `consignee` varchar(60) NOT NULL DEFAULT '',
  `country` smallint(5) unsigned NOT NULL DEFAULT '0',
  `province` smallint(5) unsigned NOT NULL DEFAULT '0',
  `city` smallint(5) unsigned NOT NULL DEFAULT '0',
  `district` smallint(5) unsigned NOT NULL DEFAULT '0',
  `address` varchar(255) NOT NULL DEFAULT '',
  `zipcode` varchar(60) NOT NULL DEFAULT '',
  `tel` varchar(60) NOT NULL DEFAULT '',
  `mobile` varchar(60) NOT NULL DEFAULT '',
  `email` varchar(60) NOT NULL DEFAULT '',
  `best_time` varchar(120) NOT NULL DEFAULT '',
  `sign_building` varchar(120) NOT NULL DEFAULT '',
  `postscript` varchar(255) NOT NULL DEFAULT '',
  `shipping_id` tinyint(3) NOT NULL DEFAULT '0',
  `shipping_name` varchar(120) NOT NULL DEFAULT '',
  `pay_id` tinyint(3) NOT NULL DEFAULT '0',
  `pay_name` varchar(120) NOT NULL DEFAULT '',
  `how_oos` varchar(120) NOT NULL DEFAULT '',
  `how_surplus` varchar(120) NOT NULL DEFAULT '',
  `pack_name` varchar(120) NOT NULL DEFAULT '',
  `card_name` varchar(120) NOT NULL DEFAULT '',
  `card_message` varchar(255) NOT NULL DEFAULT '',
  `inv_payee` varchar(120) NOT NULL DEFAULT '',
  `inv_content` varchar(120) NOT NULL DEFAULT '',
  `goods_amount` decimal(10,2) NOT NULL DEFAULT '0.00',
  `shipping_fee` decimal(10,2) NOT NULL DEFAULT '0.00',
  `insure_fee` decimal(10,2) NOT NULL DEFAULT '0.00',
  `pay_fee` decimal(10,2) NOT NULL DEFAULT '0.00',
  `pack_fee` decimal(10,2) NOT NULL DEFAULT '0.00',
  `card_fee` decimal(10,2) NOT NULL DEFAULT '0.00',
  `money_paid` decimal(10,2) NOT NULL DEFAULT '0.00',
  `surplus` decimal(10,2) NOT NULL DEFAULT '0.00',
  `integral` int(10) unsigned NOT NULL DEFAULT '0',
  `integral_money` decimal(10,2) NOT NULL DEFAULT '0.00',
  `bonus` decimal(10,2) NOT NULL DEFAULT '0.00',
  `order_amount` decimal(10,2) NOT NULL DEFAULT '0.00',
  `from_ad` smallint(5) NOT NULL DEFAULT '0',
  `referer` varchar(255) NOT NULL DEFAULT '',
  `add_time` int(10) unsigned NOT NULL DEFAULT '0',
  `confirm_time` int(10) unsigned NOT NULL DEFAULT '0',
  `pay_time` int(10) unsigned NOT NULL DEFAULT '0',
  `shipping_time` int(10) unsigned NOT NULL DEFAULT '0',
  `pack_id` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `card_id` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `bonus_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `invoice_no` varchar(255) NOT NULL DEFAULT '',
  `extension_code` varchar(30) NOT NULL DEFAULT '',
  `extension_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `to_buyer` varchar(255) NOT NULL DEFAULT '',
  `pay_note` varchar(255) NOT NULL DEFAULT '',
  `agency_id` smallint(5) unsigned NOT NULL,
  `inv_type` varchar(60) NOT NULL,
  `tax` decimal(10,2) NOT NULL,
  `is_separate` tinyint(1) NOT NULL DEFAULT '0',
  `parent_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `discount` decimal(10,2) NOT NULL,
  `mobile_pay` int(1) unsigned NOT NULL DEFAULT '0',
  `mobile_order` int(1) unsigned NOT NULL DEFAULT '0',
  `real_name` varchar(20) DEFAULT NULL,
  `idtype` varchar(20) DEFAULT 'TOC001',
  `customerid` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`order_id`),
  UNIQUE KEY `order_sn` (`order_sn`),
  KEY `user_id` (`user_id`),
  KEY `order_status` (`order_status`),
  KEY `shipping_status` (`shipping_status`),
  KEY `pay_status` (`pay_status`),
  KEY `shipping_id` (`shipping_id`),
  KEY `pay_id` (`pay_id`),
  KEY `extension_code` (`extension_code`,`extension_id`),
  KEY `agency_id` (`agency_id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8");
E_D("replace into `ecs_order_info` values('1','2016012989062','2','1','0','2','王允','1','11','149','1251','郑州市文化路','450001','13838117797','13838117797','7600687@qq.com','','','','1','','1','<font color=\"#FF0000\">支付宝</font>','等待所有商品备齐后再发','','','','','','','299.00','0.00','0.00','0.00','0.00','0.00','299.00','0.00','0','0.00','0.00','0.00','0','本站','1454048095','1454228621','1454228633','0','0','0','0','','','0','','','0','','0.00','0','0','0.00','0','0',NULL,'TOC001',NULL);");
E_D("replace into `ecs_order_info` values('2','2016013138821','3','5','5','2','xie','1','2','52','500','11111','537121','11111','','528187@qq.com','','','','2','邮政快递包裹','1','<font color=\"#FF0000\">支付宝</font>','等待所有商品备齐后再发','','','','','','','828.00','13.00','0.00','0.00','0.00','0.00','841.00','0.00','0','0.00','0.00','0.00','0','本站','1454249526','1454249591','1454249591','0','0','0','0','','','0','','','0','','0.00','0','0','0.00','0','0',NULL,'TOC001',NULL);");
E_D("replace into `ecs_order_info` values('3','2016020158480','3','5','1','2','xie','1','2','52','500','11111','537121','11111','','528187@qq.com','','','','2','邮政快递包裹','1','<font color=\"#FF0000\">支付宝</font>','','','','','','','','307.00','5.00','0.00','0.00','0.00','0.00','312.00','0.00','0','0.00','0.00','0.00','0','管理员添加','1454309623','1454309676','1454309684','1454309828','0','0','0','','','0','','','0','','0.00','0','0','0.00','0','0',NULL,'TOC001',NULL);");
E_D("replace into `ecs_order_info` values('4','2016020494850','3','0','0','0','xie','1','2','52','500','11111','537121','11111','','528187@qq.com','','','','2','邮政快递包裹','1','<font color=\"#FF0000\">支付宝</font>','等待所有商品备齐后再发','','','','','','','299.00','5.00','0.00','0.00','0.00','0.00','0.00','0.00','0','0.00','0.00','304.00','0','本站','1454570420','0','0','0','0','0','0','','','0','','','0','','0.00','0','0','0.00','0','0',NULL,'TOC001',NULL);");
E_D("replace into `ecs_order_info` values('5','2016020476269','3','0','0','0','xie','1','2','52','500','11111','537121','11111','','528187@qq.com','','','','2','邮政快递包裹','1','<font color=\"#FF0000\">支付宝</font>','等待所有商品备齐后再发','','','','','','','98.00','5.00','0.00','0.00','0.00','0.00','0.00','0.00','0','0.00','0.00','103.00','0','本站','1454570450','0','0','0','0','0','0','','','0','','','0','','0.00','0','0','0.00','0','0',NULL,'TOC001',NULL);");
E_D("replace into `ecs_order_info` values('6','2016020463710','3','0','0','0','xie','1','2','52','500','11111','537121','11111','','528187@qq.com','','','','2','邮政快递包裹','1','<font color=\"#FF0000\">支付宝</font>','等待所有商品备齐后再发','','','','','','','299.00','5.00','0.00','0.00','0.00','0.00','0.00','0.00','0','0.00','0.00','304.00','0','本站','1454583186','0','0','0','0','0','0','','','0','','','0','','0.00','0','0','0.00','0','0',NULL,'TOC001',NULL);");
E_D("replace into `ecs_order_info` values('7','2016020483117','3','5','5','2','xie','1','2','52','500','11111','537121','11111','','528187@qq.com','','','','2','邮政快递包裹','1','<font color=\"#FF0000\">支付宝</font>','等待所有商品备齐后再发','','','','','','','98.00','5.00','0.00','0.00','0.00','0.00','103.00','0.00','0','0.00','0.00','0.00','0','本站','1454591728','1454593024','1454593024','0','0','0','0','','','0','','','0','','0.00','0','0','0.00','0','0','谢伟','TOC001','452502198005083135');");

require("../../inc/footer.php");
?>