<?php
require("../../inc/header.php");

/*
		SoftName : EmpireBak Version 2010
		Author   : wm_chief
		Copyright: Powered by www.phome.net
*/

DoSetDbChar('utf8');
E_D("DROP TABLE IF EXISTS `ecs_goods_activity`;");
E_C("CREATE TABLE `ecs_goods_activity` (
  `act_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `act_name` varchar(255) NOT NULL,
  `act_desc` text NOT NULL,
  `act_type` tinyint(3) unsigned NOT NULL,
  `goods_id` mediumint(8) unsigned NOT NULL,
  `product_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `goods_name` varchar(255) NOT NULL,
  `start_time` int(10) unsigned NOT NULL,
  `end_time` int(10) unsigned NOT NULL,
  `is_finished` tinyint(3) unsigned NOT NULL,
  `ext_info` text NOT NULL,
  PRIMARY KEY (`act_id`),
  KEY `act_name` (`act_name`,`act_type`,`goods_id`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8");
E_D("replace into `ecs_goods_activity` values('18','韩味HW-2014初冬套装 毛衣外套 长袖连衣裙 蓬蓬裙 气质长袖针织衫+半身裙 两件套连衣裙套装','','1','134','0','韩味HW-2014初冬套装 毛衣外套 长袖连衣裙 蓬蓬裙 气质长袖针织衫+半身裙 两件套连衣裙套装','1413878400','1729843200','0','a:4:{s:12:\"price_ladder\";a:1:{i:0;a:2:{s:6:\"amount\";i:10;s:5:\"price\";d:28;}}s:15:\"restrict_amount\";i:100;s:13:\"gift_integral\";i:30;s:7:\"deposit\";d:30;}');");
E_D("replace into `ecs_goods_activity` values('4','拍卖活动——索爱C702c','','2','10','0','索爱C702c','1242144000','1242403200','0','a:5:{s:7:\"deposit\";d:0;s:11:\"start_price\";d:0;s:9:\"end_price\";i:0;s:9:\"amplitude\";d:20;s:6:\"no_top\";i:1;}');");
E_D("replace into `ecs_goods_activity` values('6','大礼包','超值大礼包','4','32','0','诺基亚N85','1420094760','1564555560','0','a:1:{s:13:\"package_price\";s:2:\"50\";}');");
E_D("replace into `ecs_goods_activity` values('9','拍卖活动一','','2','33','0','索尼（SONY）32英寸 高清 液晶电视 KLV-32S550A','1278057600','1404979200','0','a:5:{s:7:\"deposit\";d:0;s:11:\"start_price\";d:10;s:9:\"end_price\";d:1000;s:9:\"amplitude\";d:10;s:6:\"no_top\";i:0;}');");
E_D("replace into `ecs_goods_activity` values('10','拍卖活动二','','2','40','0','创维（Skyworth）32英寸 高清 液晶电视 TFT32L01HM','1277971200','1341561600','0','a:5:{s:7:\"deposit\";d:0;s:11:\"start_price\";d:10;s:9:\"end_price\";d:1000;s:9:\"amplitude\";d:10;s:6:\"no_top\";i:0;}');");
E_D("replace into `ecs_goods_activity` values('11','拍卖活动三','','2','38','0','三星（SAMSUNG）26英寸 高清液晶电视LA32B350F1','1278057600','1309939200','0','a:5:{s:7:\"deposit\";d:0;s:11:\"start_price\";d:10;s:9:\"end_price\";d:1000;s:9:\"amplitude\";d:0;s:6:\"no_top\";i:0;}');");
E_D("replace into `ecs_goods_activity` values('12','拍卖活动四','','2','50','0','力开力朗双肩背包-休闲系列324灰色','1278057600','1404633600','0','a:5:{s:7:\"deposit\";d:0;s:11:\"start_price\";d:10;s:9:\"end_price\";d:1000;s:9:\"amplitude\";d:0;s:6:\"no_top\";i:0;}');");
E_D("replace into `ecs_goods_activity` values('14','拍卖活动五','','2','35','0','飞利浦 42英寸 全高清 液晶电视 42PFL5609','1278057600','1688630400','0','a:5:{s:7:\"deposit\";d:0;s:11:\"start_price\";d:10;s:9:\"end_price\";d:1000;s:9:\"amplitude\";d:0;s:6:\"no_top\";i:0;}');");
E_D("replace into `ecs_goods_activity` values('15','拍卖活动六','','2','49','0','美的（Midea）空气加湿器 S30U-M1','1278057600','1783324800','0','a:5:{s:7:\"deposit\";d:0;s:11:\"start_price\";d:100;s:9:\"end_price\";d:1000;s:9:\"amplitude\";d:0;s:6:\"no_top\";i:0;}');");
E_D("replace into `ecs_goods_activity` values('16','拍卖活动七','','2','48','0','尼康（Nikon）D90 （18-105/3.5-5.6VR）防抖镜头 单反套机','1278057600','2035785600','0','a:5:{s:7:\"deposit\";d:0;s:11:\"start_price\";d:10;s:9:\"end_price\";d:1000;s:9:\"amplitude\";d:0;s:6:\"no_top\";i:0;}');");

require("../../inc/footer.php");
?>