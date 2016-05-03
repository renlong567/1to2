<?php
require("../../inc/header.php");

/*
		SoftName : EmpireBak Version 2010
		Author   : wm_chief
		Copyright: Powered by www.phome.net
*/

DoSetDbChar('utf8');
E_D("DROP TABLE IF EXISTS `ecs_order_goods`;");
E_C("CREATE TABLE `ecs_order_goods` (
  `rec_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `order_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `goods_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `goods_name` varchar(120) NOT NULL DEFAULT '',
  `goods_sn` varchar(60) NOT NULL DEFAULT '',
  `product_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `goods_number` smallint(5) unsigned NOT NULL DEFAULT '1',
  `market_price` decimal(10,2) NOT NULL DEFAULT '0.00',
  `goods_price` decimal(10,2) NOT NULL DEFAULT '0.00',
  `goods_attr` text NOT NULL,
  `send_number` smallint(5) unsigned NOT NULL DEFAULT '0',
  `is_real` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `extension_code` varchar(30) NOT NULL DEFAULT '',
  `parent_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `is_gift` smallint(5) unsigned NOT NULL DEFAULT '0',
  `goods_attr_id` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`rec_id`),
  KEY `order_id` (`order_id`),
  KEY `goods_id` (`goods_id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8");
E_D("replace into `ecs_order_goods` values('1','1','178','澳洲顶级车厘子1公斤装30-32mm 新西兰直邮到家','ECS000178','0','1','378.00','299.00','','0','1','','0','0','');");
E_D("replace into `ecs_order_goods` values('2','2','178','澳洲顶级车厘子1公斤装30-32mm 新西兰直邮到家','ECS000178','0','2','378.00','299.00','','2','1','','0','0','');");
E_D("replace into `ecs_order_goods` values('3','2','160','新西兰法式小羊排约800-900g/块新鲜羊肉小羊排骨','ECS000160','0','1','294.00','230.00','','1','1','','0','0','');");
E_D("replace into `ecs_order_goods` values('4','3','182','Jamieson健美生 天然钙镁维D3超值家庭装365片','ECS000182','0','1','237.60','198.00','','1','1','','0','0','');");
E_D("replace into `ecs_order_goods` values('5','3','181','进口澳芒/进口澳大利亚芒果/芒果王者','ECS000181','0','1','130.79','109.00','','1','1','','0','0','');");
E_D("replace into `ecs_order_goods` values('6','4','178','澳洲顶级车厘子1公斤装30-32mm 新西兰直邮到家','ECS000178','0','1','378.00','299.00','','0','1','','0','0','');");
E_D("replace into `ecs_order_goods` values('7','5','157','Aveeno Baby婴儿童天然燕麦润肤霜 宝宝保湿护肤面霜 227ml','ECS000157','0','1','117.60','98.00','','0','1','','0','0','');");
E_D("replace into `ecs_order_goods` values('8','6','178','澳洲顶级车厘子1公斤装30-32mm 新西兰直邮到家','ECS000178','0','1','378.00','299.00','','0','1','','0','0','');");
E_D("replace into `ecs_order_goods` values('9','7','157','Aveeno Baby婴儿童天然燕麦润肤霜 宝宝保湿护肤面霜 227ml','ECS000157','0','1','117.60','98.00','','1','1','','0','0','');");

require("../../inc/footer.php");
?>