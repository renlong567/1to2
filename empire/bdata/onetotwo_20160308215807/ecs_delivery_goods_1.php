<?php
require("../../inc/header.php");

/*
		SoftName : EmpireBak Version 2010
		Author   : wm_chief
		Copyright: Powered by www.phome.net
*/

DoSetDbChar('utf8');
E_D("DROP TABLE IF EXISTS `ecs_delivery_goods`;");
E_C("CREATE TABLE `ecs_delivery_goods` (
  `rec_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `delivery_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `goods_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `product_id` mediumint(8) unsigned DEFAULT '0',
  `product_sn` varchar(60) DEFAULT NULL,
  `goods_name` varchar(120) DEFAULT NULL,
  `brand_name` varchar(60) DEFAULT NULL,
  `goods_sn` varchar(60) DEFAULT NULL,
  `is_real` tinyint(1) unsigned DEFAULT '0',
  `extension_code` varchar(30) DEFAULT NULL,
  `parent_id` mediumint(8) unsigned DEFAULT '0',
  `send_number` smallint(5) unsigned DEFAULT '0',
  `goods_attr` text,
  PRIMARY KEY (`rec_id`),
  KEY `delivery_id` (`delivery_id`,`goods_id`),
  KEY `goods_id` (`goods_id`)
) ENGINE=MyISAM AUTO_INCREMENT=37 DEFAULT CHARSET=utf8");
E_D("replace into `ecs_delivery_goods` values('32','3','178','0','','澳洲顶级车厘子1公斤装30-32mm 新西兰直邮到家','','ECS000178','1',NULL,'0','2','');");
E_D("replace into `ecs_delivery_goods` values('36','7','178','0','','澳洲顶级车厘子1公斤装30-32mm 新西兰直邮到家','','ECS000178','1',NULL,'0','1','');");
E_D("replace into `ecs_delivery_goods` values('35','6','157','0','','Aveeno Baby婴儿童天然燕麦润肤霜 宝宝保湿护肤面霜 227ml','','ECS000157','1',NULL,'0','1','');");
E_D("replace into `ecs_delivery_goods` values('33','4','181','0','','进口澳芒/进口澳大利亚芒果/芒果王者','','ECS000181','1',NULL,'0','1','');");
E_D("replace into `ecs_delivery_goods` values('34','5','182','0','','Jamieson健美生 天然钙镁维D3超值家庭装365片','','ECS000182','1',NULL,'0','1','');");
E_D("replace into `ecs_delivery_goods` values('31','2','160','0','','新西兰法式小羊排约800-900g/块新鲜羊肉小羊排骨','','ECS000160','1',NULL,'0','1','');");

require("../../inc/footer.php");
?>