<?php
require("../../inc/header.php");

/*
		SoftName : EmpireBak Version 2010
		Author   : wm_chief
		Copyright: Powered by www.phome.net
*/

DoSetDbChar('utf8');
E_D("DROP TABLE IF EXISTS `ecs_cus_hg_curr`;");
E_C("CREATE TABLE `ecs_cus_hg_curr` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `curr_code` varchar(20) DEFAULT NULL,
  `curr_symb` varchar(20) DEFAULT NULL,
  `curr_name` varchar(20) DEFAULT NULL,
  `def` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=utf8");
E_D("replace into `ecs_cus_hg_curr` values('1','110','HKD   ','港币','0');");
E_D("replace into `ecs_cus_hg_curr` values('2','112','IDR','印度尼西亚卢比','0');");
E_D("replace into `ecs_cus_hg_curr` values('3','116','JPY   ','日本元','0');");
E_D("replace into `ecs_cus_hg_curr` values('4','121','MOP   ','澳门元','0');");
E_D("replace into `ecs_cus_hg_curr` values('5','122','MYR','马来西亚林吉特','0');");
E_D("replace into `ecs_cus_hg_curr` values('6','129','PHP   ','菲律宾比索','0');");
E_D("replace into `ecs_cus_hg_curr` values('7','132','SGD   ','新加坡元','0');");
E_D("replace into `ecs_cus_hg_curr` values('8','133','KRW','韩国圆','0');");
E_D("replace into `ecs_cus_hg_curr` values('9','136','THB   ','泰国铢','0');");
E_D("replace into `ecs_cus_hg_curr` values('10','142','CNY','人民币','1');");
E_D("replace into `ecs_cus_hg_curr` values('11','143','TWD','新台币','0');");
E_D("replace into `ecs_cus_hg_curr` values('12','300','EUR  ','欧元','0');");
E_D("replace into `ecs_cus_hg_curr` values('13','302','DKK   ','丹麦克朗','0');");
E_D("replace into `ecs_cus_hg_curr` values('14','303','GBP   ','英镑','0');");
E_D("replace into `ecs_cus_hg_curr` values('15','326','NOK   ','挪威克朗','0');");
E_D("replace into `ecs_cus_hg_curr` values('16','330','SEK   ','瑞典克朗','0');");
E_D("replace into `ecs_cus_hg_curr` values('17','331','CHF   ','瑞士法郎','0');");
E_D("replace into `ecs_cus_hg_curr` values('18','344','RUB','俄罗斯卢布','0');");
E_D("replace into `ecs_cus_hg_curr` values('19','501','CAD   ','加拿大元','0');");
E_D("replace into `ecs_cus_hg_curr` values('20','502','USD   ','美元','0');");
E_D("replace into `ecs_cus_hg_curr` values('21','601','AUD   ','澳大利亚元','0');");
E_D("replace into `ecs_cus_hg_curr` values('22','609','NZD   ','新西兰元','0');");

require("../../inc/footer.php");
?>