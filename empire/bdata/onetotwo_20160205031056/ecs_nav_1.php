<?php
require("../../inc/header.php");

/*
		SoftName : EmpireBak Version 2010
		Author   : wm_chief
		Copyright: Powered by www.phome.net
*/

DoSetDbChar('utf8');
E_D("DROP TABLE IF EXISTS `ecs_nav`;");
E_C("CREATE TABLE `ecs_nav` (
  `id` mediumint(8) NOT NULL AUTO_INCREMENT,
  `ctype` varchar(10) DEFAULT NULL,
  `cid` smallint(5) unsigned DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `ifshow` tinyint(1) NOT NULL,
  `vieworder` tinyint(1) NOT NULL,
  `opennew` tinyint(1) NOT NULL,
  `url` varchar(255) NOT NULL,
  `type` varchar(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `type` (`type`),
  KEY `ifshow` (`ifshow`)
) ENGINE=MyISAM AUTO_INCREMENT=42 DEFAULT CHARSET=utf8");
E_D("replace into `ecs_nav` values('2','','0','选购中心','1','2','0','pick_out.php','top');");
E_D("replace into `ecs_nav` values('3','','0','我的账户','1','0','0','user.php','top');");
E_D("replace into `ecs_nav` values('4','c','21','进口食品','1','2','0','category.php?id=21','middle');");
E_D("replace into `ecs_nav` values('6','','0','标签云','0','5','6','tag_cloud.php','top');");
E_D("replace into `ecs_nav` values('7','','0','免责条款','1','1','0','article.php?id=1','bottom');");
E_D("replace into `ecs_nav` values('8','','0','隐私保护','1','2','0','article.php?id=2','bottom');");
E_D("replace into `ecs_nav` values('9','','0','咨询热点','1','3','0','article.php?id=3','bottom');");
E_D("replace into `ecs_nav` values('10','','0','联系我们','1','4','0','article.php?id=4','bottom');");
E_D("replace into `ecs_nav` values('11','','0','公司简介','1','5','0','article.php?id=5','bottom');");
E_D("replace into `ecs_nav` values('12','','0','批发方案','1','6','0','wholesale.php','bottom');");
E_D("replace into `ecs_nav` values('14','','0','配送方式','1','7','0','myship.php','bottom');");
E_D("replace into `ecs_nav` values('18','c','16','营养保健','1','3','0','category.php?id=16','middle');");
E_D("replace into `ecs_nav` values('23','','0','报价单','0','6','0','quotation.php','top');");
E_D("replace into `ecs_nav` values('24','','0','消费者告知书','1','5','0','article.php?id=36','middle');");
E_D("replace into `ecs_nav` values('26','c','132','个护彩妆','1','1','0','category.php?id=132','middle');");
E_D("replace into `ecs_nav` values('33','','0','关于我们','1','4','0','article.php?id=5','bottom');");
E_D("replace into `ecs_nav` values('34','a','8','服务保证 ','1','7','0','article_cat.php?id=8','bottom');");
E_D("replace into `ecs_nav` values('35','a','9','联系我们 ','1','9','0','article_cat.php?id=9','bottom');");
E_D("replace into `ecs_nav` values('36','','0','关于我们','1','4','1','article.php?id=61','middle');");
E_D("replace into `ecs_nav` values('37','a','8','服务保证 ','0','9','0','article_cat.php?id=8','middle');");
E_D("replace into `ecs_nav` values('38','a','9','联系我们 ','0','11','0','article_cat.php?id=9','middle');");
E_D("replace into `ecs_nav` values('39','a','10','会员中心','0','13','0','article_cat.php?id=10','middle');");
E_D("replace into `ecs_nav` values('40','a','5','新手上路 ','0','15','0','article_cat.php?id=5','bottom');");
E_D("replace into `ecs_nav` values('41','a','7','配送与支付 ','0','17','0','article_cat.php?id=7','bottom');");

require("../../inc/footer.php");
?>