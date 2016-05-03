<?php
require("../../inc/header.php");

/*
		SoftName : EmpireBak Version 2010
		Author   : wm_chief
		Copyright: Powered by www.phome.net
*/

DoSetDbChar('utf8');
E_D("DROP TABLE IF EXISTS `ecs_cus_hg_unit`;");
E_C("CREATE TABLE `ecs_cus_hg_unit` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `unit_code` varchar(10) DEFAULT NULL,
  `unit_name` varchar(100) DEFAULT NULL,
  `conv_code` varchar(10) DEFAULT NULL,
  `conv_ratio` varchar(10) DEFAULT NULL,
  `def` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=125 DEFAULT CHARSET=utf8");
E_D("replace into `ecs_cus_hg_unit` values('1','001','台','','1','0');");
E_D("replace into `ecs_cus_hg_unit` values('2','002','座','','1','0');");
E_D("replace into `ecs_cus_hg_unit` values('3','003','辆','','1','0');");
E_D("replace into `ecs_cus_hg_unit` values('4','004','艘','','1','0');");
E_D("replace into `ecs_cus_hg_unit` values('5','005','架','','1','0');");
E_D("replace into `ecs_cus_hg_unit` values('6','006','套','','1','0');");
E_D("replace into `ecs_cus_hg_unit` values('7','007','个','','1','0');");
E_D("replace into `ecs_cus_hg_unit` values('8','008','只','','1','0');");
E_D("replace into `ecs_cus_hg_unit` values('9','009','头','','1','0');");
E_D("replace into `ecs_cus_hg_unit` values('10','010','张','','1','0');");
E_D("replace into `ecs_cus_hg_unit` values('11','011','件','','1','0');");
E_D("replace into `ecs_cus_hg_unit` values('12','012','支','','1','0');");
E_D("replace into `ecs_cus_hg_unit` values('13','013','枝','','1','0');");
E_D("replace into `ecs_cus_hg_unit` values('14','014','根','','1','0');");
E_D("replace into `ecs_cus_hg_unit` values('15','015','条','','1','0');");
E_D("replace into `ecs_cus_hg_unit` values('16','016','把','','1','0');");
E_D("replace into `ecs_cus_hg_unit` values('17','017','块','','1','0');");
E_D("replace into `ecs_cus_hg_unit` values('18','018','卷','','1','0');");
E_D("replace into `ecs_cus_hg_unit` values('19','019','副','','1','0');");
E_D("replace into `ecs_cus_hg_unit` values('20','020','片','','1','0');");
E_D("replace into `ecs_cus_hg_unit` values('21','021','组','','0','0');");
E_D("replace into `ecs_cus_hg_unit` values('22','022','份','','0','0');");
E_D("replace into `ecs_cus_hg_unit` values('23','023','幅','','1','0');");
E_D("replace into `ecs_cus_hg_unit` values('24','025','双','','1','0');");
E_D("replace into `ecs_cus_hg_unit` values('25','026','对','','1','0');");
E_D("replace into `ecs_cus_hg_unit` values('26','027','棵','','0','0');");
E_D("replace into `ecs_cus_hg_unit` values('27','028','株','','1','0');");
E_D("replace into `ecs_cus_hg_unit` values('28','029','井','','0','0');");
E_D("replace into `ecs_cus_hg_unit` values('29','030','米','','1','0');");
E_D("replace into `ecs_cus_hg_unit` values('30','031','盘','','0','0');");
E_D("replace into `ecs_cus_hg_unit` values('31','032','平方米','','1','0');");
E_D("replace into `ecs_cus_hg_unit` values('32','033','立方米','','1','0');");
E_D("replace into `ecs_cus_hg_unit` values('33','034','筒','','0','0');");
E_D("replace into `ecs_cus_hg_unit` values('34','035','千克','','1','1');");
E_D("replace into `ecs_cus_hg_unit` values('35','036','克','','1','0');");
E_D("replace into `ecs_cus_hg_unit` values('36','037','盆','','0','0');");
E_D("replace into `ecs_cus_hg_unit` values('37','038','万个','007','10000','0');");
E_D("replace into `ecs_cus_hg_unit` values('38','039','具','','0','0');");
E_D("replace into `ecs_cus_hg_unit` values('39','040','百副','','1','0');");
E_D("replace into `ecs_cus_hg_unit` values('40','041','百支','','1','0');");
E_D("replace into `ecs_cus_hg_unit` values('41','042','百把','','1','0');");
E_D("replace into `ecs_cus_hg_unit` values('42','043','百个','','1','0');");
E_D("replace into `ecs_cus_hg_unit` values('43','044','百片','','1','0');");
E_D("replace into `ecs_cus_hg_unit` values('44','045','刀','','0','0');");
E_D("replace into `ecs_cus_hg_unit` values('45','046','疋','','0','0');");
E_D("replace into `ecs_cus_hg_unit` values('46','047','公担','035','100','0');");
E_D("replace into `ecs_cus_hg_unit` values('47','048','扇','','0','0');");
E_D("replace into `ecs_cus_hg_unit` values('48','049','百枝','','1','0');");
E_D("replace into `ecs_cus_hg_unit` values('49','050','千只','','1','0');");
E_D("replace into `ecs_cus_hg_unit` values('50','051','千块','','1','0');");
E_D("replace into `ecs_cus_hg_unit` values('51','052','千盒','','1','0');");
E_D("replace into `ecs_cus_hg_unit` values('52','053','千枝','','1','0');");
E_D("replace into `ecs_cus_hg_unit` values('53','054','千个','','1','0');");
E_D("replace into `ecs_cus_hg_unit` values('54','055','亿支','','0','0');");
E_D("replace into `ecs_cus_hg_unit` values('55','056','亿个','','0','0');");
E_D("replace into `ecs_cus_hg_unit` values('56','057','万套','006','10000','0');");
E_D("replace into `ecs_cus_hg_unit` values('57','058','千张','010','1000','0');");
E_D("replace into `ecs_cus_hg_unit` values('58','059','万张','010','10000','0');");
E_D("replace into `ecs_cus_hg_unit` values('59','060','千伏安','','1','0');");
E_D("replace into `ecs_cus_hg_unit` values('60','061','千瓦','','1','0');");
E_D("replace into `ecs_cus_hg_unit` values('61','062','千瓦时','','1','0');");
E_D("replace into `ecs_cus_hg_unit` values('62','063','千升','','0','0');");
E_D("replace into `ecs_cus_hg_unit` values('63','067','英尺','030','0.3048','0');");
E_D("replace into `ecs_cus_hg_unit` values('64','070','吨','035','1000','0');");
E_D("replace into `ecs_cus_hg_unit` values('65','071','长吨','035','1016','0');");
E_D("replace into `ecs_cus_hg_unit` values('66','072','短吨','035','907.2','0');");
E_D("replace into `ecs_cus_hg_unit` values('67','073','司马担','035','60.5','0');");
E_D("replace into `ecs_cus_hg_unit` values('68','074','司马斤','035','0.605','0');");
E_D("replace into `ecs_cus_hg_unit` values('69','075','斤','035','0.5','0');");
E_D("replace into `ecs_cus_hg_unit` values('70','076','磅','035','0.4536','0');");
E_D("replace into `ecs_cus_hg_unit` values('71','077','担','035','100','0');");
E_D("replace into `ecs_cus_hg_unit` values('72','078','英担','035','50.8024','0');");
E_D("replace into `ecs_cus_hg_unit` values('73','079','短担','035','45.36','0');");
E_D("replace into `ecs_cus_hg_unit` values('74','080','两','035','0.05','0');");
E_D("replace into `ecs_cus_hg_unit` values('75','081','市担','035','50','0');");
E_D("replace into `ecs_cus_hg_unit` values('76','083','盎司','036','31.1','0');");
E_D("replace into `ecs_cus_hg_unit` values('77','084','克拉','036','0.2','0');");
E_D("replace into `ecs_cus_hg_unit` values('78','085','市尺','030','0.3333','0');");
E_D("replace into `ecs_cus_hg_unit` values('79','086','码','030','0.9144','0');");
E_D("replace into `ecs_cus_hg_unit` values('80','088','英寸','030','0.0254','0');");
E_D("replace into `ecs_cus_hg_unit` values('81','089','寸','030','0.0333','0');");
E_D("replace into `ecs_cus_hg_unit` values('82','095','升','','1','0');");
E_D("replace into `ecs_cus_hg_unit` values('83','096','毫升','095','0.001','0');");
E_D("replace into `ecs_cus_hg_unit` values('84','097','英加仑','033','0.0045','0');");
E_D("replace into `ecs_cus_hg_unit` values('85','098','美加仑','033','0.0037','0');");
E_D("replace into `ecs_cus_hg_unit` values('86','099','立方英尺','033','0.0283','0');");
E_D("replace into `ecs_cus_hg_unit` values('87','101','立方尺','033','0.037','0');");
E_D("replace into `ecs_cus_hg_unit` values('88','110','平方码','032','0.8361','0');");
E_D("replace into `ecs_cus_hg_unit` values('89','111','平方英尺','032','0.0929','0');");
E_D("replace into `ecs_cus_hg_unit` values('90','112','平方尺','032','0.111','0');");
E_D("replace into `ecs_cus_hg_unit` values('91','115','英制马力','061','0.7463','0');");
E_D("replace into `ecs_cus_hg_unit` values('92','116','公制马力','061','0.7353','0');");
E_D("replace into `ecs_cus_hg_unit` values('93','118','令','','0','0');");
E_D("replace into `ecs_cus_hg_unit` values('94','120','箱','','0','0');");
E_D("replace into `ecs_cus_hg_unit` values('95','121','批','','0','0');");
E_D("replace into `ecs_cus_hg_unit` values('96','122','罐','','0','0');");
E_D("replace into `ecs_cus_hg_unit` values('97','123','桶','','0','0');");
E_D("replace into `ecs_cus_hg_unit` values('98','124','扎','','0','0');");
E_D("replace into `ecs_cus_hg_unit` values('99','125','包','','0','0');");
E_D("replace into `ecs_cus_hg_unit` values('100','126','箩','','0','0');");
E_D("replace into `ecs_cus_hg_unit` values('101','127','打','011','12','0');");
E_D("replace into `ecs_cus_hg_unit` values('102','128','筐','','0','0');");
E_D("replace into `ecs_cus_hg_unit` values('103','129','罗','007','144','0');");
E_D("replace into `ecs_cus_hg_unit` values('104','130','匹','','0','0');");
E_D("replace into `ecs_cus_hg_unit` values('105','131','册','','0','0');");
E_D("replace into `ecs_cus_hg_unit` values('106','132','本','','0','0');");
E_D("replace into `ecs_cus_hg_unit` values('107','133','发','','0','0');");
E_D("replace into `ecs_cus_hg_unit` values('108','134','枚','','0','0');");
E_D("replace into `ecs_cus_hg_unit` values('109','135','捆','','0','0');");
E_D("replace into `ecs_cus_hg_unit` values('110','136','袋','','0','0');");
E_D("replace into `ecs_cus_hg_unit` values('111','139','粒','','0','0');");
E_D("replace into `ecs_cus_hg_unit` values('112','140','盒','','0','0');");
E_D("replace into `ecs_cus_hg_unit` values('113','141','合','','0','0');");
E_D("replace into `ecs_cus_hg_unit` values('114','142','瓶','','0','0');");
E_D("replace into `ecs_cus_hg_unit` values('115','143','千支','','1','0');");
E_D("replace into `ecs_cus_hg_unit` values('116','144','万双','025','10000','0');");
E_D("replace into `ecs_cus_hg_unit` values('117','145','万粒','','0','0');");
E_D("replace into `ecs_cus_hg_unit` values('118','146','千粒','','0','0');");
E_D("replace into `ecs_cus_hg_unit` values('119','147','千米','030','1000','0');");
E_D("replace into `ecs_cus_hg_unit` values('120','148','千英尺','030','304.8','0');");
E_D("replace into `ecs_cus_hg_unit` values('121','149','百万贝可','063','1','0');");
E_D("replace into `ecs_cus_hg_unit` values('122','163','部','001','1','0');");
E_D("replace into `ecs_cus_hg_unit` values('123','164','亿株','071','1','0');");

require("../../inc/footer.php");
?>