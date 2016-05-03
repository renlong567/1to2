<?php
require("../../inc/header.php");

/*
		SoftName : EmpireBak Version 2010
		Author   : wm_chief
		Copyright: Powered by www.phome.net
*/

DoSetDbChar('utf8');
E_D("DROP TABLE IF EXISTS `ecs_topic`;");
E_C("CREATE TABLE `ecs_topic` (
  `topic_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL DEFAULT '''''',
  `intro` text NOT NULL,
  `start_time` int(11) NOT NULL DEFAULT '0',
  `end_time` int(10) NOT NULL DEFAULT '0',
  `data` text NOT NULL,
  `template` varchar(255) NOT NULL DEFAULT '''''',
  `css` text NOT NULL,
  `topic_img` varchar(255) DEFAULT NULL,
  `title_pic` varchar(255) DEFAULT NULL,
  `base_style` char(6) DEFAULT NULL,
  `htmls` mediumtext,
  `keywords` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  KEY `topic_id` (`topic_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8");
E_D("replace into `ecs_topic` values('1','上的范德萨vd','<p>&nbsp;啥的嘎嘎嘎嘎嘎嘎嘎嘎嘎嘎嘎嘎嘎嘎嘎嘎嘎嘎嘎嘎嘎嘎嘎嘎嘎嘎嘎嘎嘎嘎嘎嘎嘎嘎嘎嘎嘎嘎嘎嘎嘎嘎嘎嘎嘎个</p>','1438876800','1754496000','O:8:\"stdClass\":1:{s:7:\"default\";a:7:{i:0;s:125:\"韩味HW-2014初冬套装 毛衣外套 长袖连衣裙 蓬蓬裙 气质长袖针织衫+半身裙 两件套连衣裙套装|134\";i:1;s:93:\"米兰时装周同款 法式优雅女人味性感尖头及踝靴 细跟高跟短靴裸靴|136\";i:2;s:51:\"卡西欧(CASIO) EX-TR550 数码相机（粉）|137\";i:3;s:47:\"小米 4 2GB内存版 白色 移动4G手机|138\";i:4;s:45:\"华硕手机Zenfone ZE551 1.8G 4G/16G 金|139\";i:5;s:64:\"尼康数码单反相机 D3200（18-55Ⅱ）+8G卡+原装包|140\";i:6;s:64:\"Apple iPhone 6（16GB）土豪金 移动联通电信4G手机|141\";}}','','','data/afficheimg/20150807pyxphq.jpg','data/afficheimg/20150807xipgbm.jpg','C0C0C0','','阿德萨嘎嘎嘎','阿嘎嘎嘎嘎嘎嘎嘎嘎嘎嘎嘎嘎嘎嘎嘎嘎嘎嘎嘎嘎嘎');");

require("../../inc/footer.php");
?>