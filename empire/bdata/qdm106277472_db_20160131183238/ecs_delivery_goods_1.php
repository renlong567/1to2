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
) ENGINE=MyISAM AUTO_INCREMENT=31 DEFAULT CHARSET=utf8");
E_D("replace into `ecs_delivery_goods` values('1','1','13','0',NULL,'诺基亚5320 XpressMusic','诺基亚','ECS000013','1','','0','3',NULL);");
E_D("replace into `ecs_delivery_goods` values('2','1','14','0',NULL,'诺基亚5800XM','诺基亚','ECS000014','1','','0','1',NULL);");
E_D("replace into `ecs_delivery_goods` values('3','2','24','0',NULL,'P806','联想','ECS000024','1','','0','3',NULL);");
E_D("replace into `ecs_delivery_goods` values('4','2','9','0',NULL,'诺基亚E66','诺基亚','ECS000009','1','','0','1',NULL);");
E_D("replace into `ecs_delivery_goods` values('5','3','24','0',NULL,'P806','联想','ECS000024','1','','0','1',NULL);");
E_D("replace into `ecs_delivery_goods` values('6','3','8','0',NULL,'飞利浦9@9v','飞利浦','ECS000008','1','','0','3',NULL);");
E_D("replace into `ecs_delivery_goods` values('7','4','12','0',NULL,'摩托罗拉A810','摩托罗拉','ECS000012','1','','0','2',NULL);");
E_D("replace into `ecs_delivery_goods` values('8','5','24','0',NULL,'P806','联想','ECS000024','1','','0','1',NULL);");
E_D("replace into `ecs_delivery_goods` values('9','6','42','0',NULL,'乐华(ROWA)32英寸高清液晶电视LCD32M08','乐华','ECS000042','1',NULL,'0','1',NULL);");
E_D("replace into `ecs_delivery_goods` values('10','7','91','0','','富士（FUJIFILM）Z71 数码相机（银色）','天翼','ECS000091','1',NULL,'0','1','');");
E_D("replace into `ecs_delivery_goods` values('11','7','90','0','','富士（FUJIFILM）Z71 数码相机（香槟色）','漫步者','ECS000090','1',NULL,'0','1','');");
E_D("replace into `ecs_delivery_goods` values('12','8','38','0','','三星（SAMSUNG）26英寸 高清液晶电视LA32B350F1','天翼','ECS000038','1',NULL,'0','1','');");
E_D("replace into `ecs_delivery_goods` values('13','8','39','0','','创维（Skyworth）37英寸液晶电视37L05HR（内置底座）','创维','ECS000039','1',NULL,'0','1','');");
E_D("replace into `ecs_delivery_goods` values('14','9','55','0','','三洋（Sanyo）ECJ-DF115MC　微电脑电饭煲','AMD','ECS000055','1',NULL,'0','1','颜色:黑色 \n屏幕尺寸:42英寸 \n');");
E_D("replace into `ecs_delivery_goods` values('15','9','66','0','','飞科（FLYCO）浮动旋转式剃须刀-FS812','AMD','ECS000066','1',NULL,'0','1','颜色:黑色 \n屏幕尺寸:42英寸 \n');");
E_D("replace into `ecs_delivery_goods` values('16','9','88','0','','索尼（sony）HDR-XR350E高清数码摄像机','漫步者','ECS000088','1',NULL,'0','1','颜色:黑色 \n屏幕尺寸:42英寸 \n');");
E_D("replace into `ecs_delivery_goods` values('17','10','92','0','','茵佳妮优雅公主风褶边修身轻盈衬衫 送胸花5121-1110045','白领','ECS000092','1',NULL,'0','1','颜色:红 \n尺寸:XL \n');");
E_D("replace into `ecs_delivery_goods` values('18','10','123','0','','美亿佳懒人沙发SF0505咖啡色','千弘','ECS000123','1',NULL,'0','1','颜色:黄 \n尺寸:XL \n');");
E_D("replace into `ecs_delivery_goods` values('19','10','121','0','','宝贝世家 儿童床品套件 海洋乐园 英国设计 精梳全棉 活性环保印染 儿童三件套','千弘','ECS000121','1',NULL,'0','1','颜色:黄 \n尺寸:XL \n');");
E_D("replace into `ecs_delivery_goods` values('20','11','49','0','','美的（Midea）空气加湿器 S30U-M1','乐华','ECS000049','1',NULL,'0','1','颜色:黑色 \n屏幕尺寸:42英寸 \n');");
E_D("replace into `ecs_delivery_goods` values('21','12','43','0','','乐华(ROWA)42英寸高清液晶电视LCD42M19','乐华','ECS000043','1',NULL,'0','1','颜色:黑色 \n屏幕尺寸:42英寸 \n');");
E_D("replace into `ecs_delivery_goods` values('22','13','134','0','','天使之城 新款 手工珍珠金线蕾丝衫雪纺衫LM0304 白色','  恒基伟业','ECS000000','1',NULL,'0','3','颜色:红 \n尺寸:XL \n');");
E_D("replace into `ecs_delivery_goods` values('23','13','135','0','','JIULALA 久拉拉 2013年夏装新款 女 撞色波浪装','金立','ECS000135','1',NULL,'0','1','颜色:黄 \n尺寸:XXL \n');");
E_D("replace into `ecs_delivery_goods` values('24','13','138','0','','ANDO STORE 安都韩版显瘦女裙雪纺两件套连衣裙9','希捷','ECS000138','1',NULL,'0','1','颜色:红 \n尺寸:L \n');");
E_D("replace into `ecs_delivery_goods` values('25','13','139','0','','SDEER 圣迪奥 女夏装拼接感双层裙摆连衣裙22812','漫步者','ECS000139','1',NULL,'0','1','颜色:黄 \n尺寸:XL \n');");
E_D("replace into `ecs_delivery_goods` values('26','13','136','0','','Souline 素缕 《斑驳》2013秋款新女棉麻刺绣长','APPLE','ECS000136','1',NULL,'0','1','颜色:红 \n尺寸:XL \n');");
E_D("replace into `ecs_delivery_goods` values('27','13','137','0','','桑缇 2013秋季新款 韩版修身圆领外套ST133W540','方正','ECS000137','1',NULL,'0','1','颜色:黄 \n尺寸:XXL \n');");
E_D("replace into `ecs_delivery_goods` values('28','13','140','0','','GOLDFARM 高梵 2013夏装新款 雪纺复古印花连衣','天翼','ECS000140','1',NULL,'0','1','颜色:红 \n尺寸:XL \n');");
E_D("replace into `ecs_delivery_goods` values('29','13','141','0','','茵克拉芙 2013夏装女装春款连衣裙碎花雪纺OL气','美的','ECS000141','1',NULL,'0','1','颜色:黄 \n尺寸:XXL \n');");
E_D("replace into `ecs_delivery_goods` values('30','1','178','0','','澳洲顶级车厘子1公斤装30-32mm 新西兰直邮到家','','ECS000178','1',NULL,'0','1','');");

require("../../inc/footer.php");
?>