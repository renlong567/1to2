<?php
require("../../inc/header.php");

/*
		SoftName : EmpireBak Version 2010
		Author   : wm_chief
		Copyright: Powered by www.phome.net
*/

DoSetDbChar('utf8');
E_D("DROP TABLE IF EXISTS `ecs_category`;");
E_C("CREATE TABLE `ecs_category` (
  `cat_id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `cat_name` varchar(90) NOT NULL DEFAULT '',
  `keywords` varchar(255) NOT NULL DEFAULT '',
  `cat_desc` varchar(255) NOT NULL DEFAULT '',
  `parent_id` smallint(5) unsigned NOT NULL DEFAULT '0',
  `sort_order` tinyint(1) unsigned NOT NULL DEFAULT '50',
  `template_file` varchar(50) NOT NULL DEFAULT '',
  `measure_unit` varchar(15) NOT NULL DEFAULT '',
  `show_in_nav` tinyint(1) NOT NULL DEFAULT '0',
  `style` varchar(150) NOT NULL,
  `is_show` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `grade` tinyint(4) NOT NULL DEFAULT '0',
  `filter_attr` varchar(255) NOT NULL DEFAULT '0',
  PRIMARY KEY (`cat_id`),
  KEY `parent_id` (`parent_id`)
) ENGINE=MyISAM AUTO_INCREMENT=689 DEFAULT CHARSET=utf8");
E_D("replace into `ecs_category` values('16','营养保健','','','0','11','','','1','','1','5','');");
E_D("replace into `ecs_category` values('17','营养滋补','','3G手机 GSM手机 CDMA手机 ','16','2','','','0','','1','5','');");
E_D("replace into `ecs_category` values('21','进口食品','','','0','10','','个','1','','1','10','');");
E_D("replace into `ecs_category` values('29','牛奶饮料','','燃气炉 电饭煲 电磁炉 电水壶 ','21','50','','','0','','1','0','');");
E_D("replace into `ecs_category` values('44','时尚服饰','','','0','13','','','0','','1','0','');");
E_D("replace into `ecs_category` values('45','高端男装','','','44','50','','','0','','1','0','');");
E_D("replace into `ecs_category` values('54','精品女装','','','44','50','','','0','','1','0','');");
E_D("replace into `ecs_category` values('69','生活家居','','','0','12','','','0','','1','0','');");
E_D("replace into `ecs_category` values('89','生活家电','','','69','50','','','0','','1','0','');");
E_D("replace into `ecs_category` values('97','生活日用','','游戏软件 杀毒软件 办公软件 ','69','50','','','0','','1','0','');");
E_D("replace into `ecs_category` values('101','运动健身','','','69','50','','','0','','1','0','');");
E_D("replace into `ecs_category` values('120','保健强身','','MP3/MP4  MP3/MP4配件 苹果配件 录音笔','16','1','','','0','','1','0','');");
E_D("replace into `ecs_category` values('110','休闲食品','','电吹风 电蚊香','21','50','','3','0','','1','0','');");
E_D("replace into `ecs_category` values('116','纤体修身','','便携相机\r\n单反相机\r\n数码摄像机','16','3','','','0','','1','0','');");
E_D("replace into `ecs_category` values('132','个护彩妆','','','0','9','','','1','','1','0','');");
E_D("replace into `ecs_category` values('121','袜子/配件','','','44','50','','','0','','1','0','');");
E_D("replace into `ecs_category` values('216','女鞋','','','215','50','','','0','','1','0','');");
E_D("replace into `ecs_category` values('215','鞋靴箱包','','','0','14','','','0','','1','0','');");
E_D("replace into `ecs_category` values('688','洗发护理','','','132','50','','','0','','1','0','');");
E_D("replace into `ecs_category` values('635','进口果蔬','','','21','50','','','0','','1','0','');");
E_D("replace into `ecs_category` values('175','身体护理','','','132','50','','','0','','1','0','');");
E_D("replace into `ecs_category` values('182','面部护理','','','132','50','','','0','','1','0','');");
E_D("replace into `ecs_category` values('237','潮流女包','','','215','50','','','0','','1','0','');");
E_D("replace into `ecs_category` values('247','功能箱包','','','215','50','','','0','','1','0','');");
E_D("replace into `ecs_category` values('260','精品男包','','','215','50','','','0','','1','0','');");
E_D("replace into `ecs_category` values('265','精美配饰','','','0','15','','','0','','1','0','');");
E_D("replace into `ecs_category` values('277','腰带','','','265','50','','','0','','1','0','');");
E_D("replace into `ecs_category` values('289','手表','','','265','50','','','0','','1','0','');");
E_D("replace into `ecs_category` values('293','围巾','','','265','50','','','0','','1','0','');");
E_D("replace into `ecs_category` values('307','首饰','','','265','50','','','0','','1','0','');");
E_D("replace into `ecs_category` values('318','帽子','','','265','50','','','0','','1','0','');");

require("../../inc/footer.php");
?>