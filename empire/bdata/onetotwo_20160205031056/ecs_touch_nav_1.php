<?php
require("../../inc/header.php");

/*
		SoftName : EmpireBak Version 2010
		Author   : wm_chief
		Copyright: Powered by www.phome.net
*/

DoSetDbChar('utf8');
E_D("DROP TABLE IF EXISTS `ecs_touch_nav`;");
E_C("CREATE TABLE `ecs_touch_nav` (
  `id` mediumint(8) NOT NULL AUTO_INCREMENT,
  `ctype` varchar(10) DEFAULT NULL,
  `cid` smallint(5) unsigned DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `ifshow` tinyint(1) NOT NULL,
  `vieworder` tinyint(1) NOT NULL,
  `opennew` tinyint(1) NOT NULL,
  `url` varchar(255) NOT NULL,
  `pic` varchar(255) NOT NULL,
  `type` varchar(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `type` (`type`),
  KEY `ifshow` (`ifshow`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8");
E_D("replace into `ecs_touch_nav` values('1','','0','全部分类','1','0','0','index.php?c=category&amp;a=top_all','data/attached/nav/c78d6a6b9b1ef0f58760c1c26fcd1ed3.png','middle');");
E_D("replace into `ecs_touch_nav` values('2','','0','我的订单','1','0','0','index.php?m=default&amp;c=user&amp;a=order_list','data/attached/nav/fa2f3f5df8dfa7ca5740515d47d2381d.png','middle');");
E_D("replace into `ecs_touch_nav` values('3','','0','最新团购','1','0','0','index.php?m=default&amp;c=groupbuy','data/attached/nav/0c71ca825682cad7222266a7e7cd052a.png','middle');");
E_D("replace into `ecs_touch_nav` values('4','','0','促销活动','1','0','0','index.php?m=default&amp;c=activity','data/attached/nav/ca0a1b9798403546b2b3b9ccdc7a3fcc.png','middle');");
E_D("replace into `ecs_touch_nav` values('5','','0','热门搜索','1','0','0','#','data/attached/nav/cea26362c1ba667b48ff26d5a7f06fe1.png','middle');");
E_D("replace into `ecs_touch_nav` values('6','','0','品牌街','1','0','0','index.php?m=default&amp;c=brand','data/attached/nav/d4eaf0ee8bf517fb0d7368481a170df0.png','middle');");
E_D("replace into `ecs_touch_nav` values('7','','0','个人中心','1','0','0','index.php?m=default&amp;c=user','data/attached/nav/b0e139079e5c5d052f1f05d0f400dfa1.png','middle');");
E_D("replace into `ecs_touch_nav` values('8','','0','购物车','1','0','0','index.php?m=default&amp;c=flow&amp;a=cart','data/attached/nav/3355eb17b4a10ab97ac5bf4d5ceef3ef.png','middle');");

require("../../inc/footer.php");
?>