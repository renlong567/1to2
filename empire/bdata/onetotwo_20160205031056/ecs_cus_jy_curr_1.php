<?php
require("../../inc/header.php");

/*
		SoftName : EmpireBak Version 2010
		Author   : wm_chief
		Copyright: Powered by www.phome.net
*/

DoSetDbChar('utf8');
E_D("DROP TABLE IF EXISTS `ecs_cus_jy_curr`;");
E_C("CREATE TABLE `ecs_cus_jy_curr` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `itemcode` varchar(20) DEFAULT NULL,
  `itemname` varchar(40) DEFAULT NULL,
  `def` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=31 DEFAULT CHARSET=utf8");
E_D("replace into `ecs_cus_jy_curr` values('1','036','澳大利亚元','0');");
E_D("replace into `ecs_cus_jy_curr` values('2','040','奥地利先令','0');");
E_D("replace into `ecs_cus_jy_curr` values('3','056','比利时法郎','0');");
E_D("replace into `ecs_cus_jy_curr` values('4','124','加拿大元','0');");
E_D("replace into `ecs_cus_jy_curr` values('5','156','人民币','1');");
E_D("replace into `ecs_cus_jy_curr` values('6','158','新台湾币','0');");
E_D("replace into `ecs_cus_jy_curr` values('7','208','丹麦克朗','0');");
E_D("replace into `ecs_cus_jy_curr` values('8','246','芬兰马克','0');");
E_D("replace into `ecs_cus_jy_curr` values('9','250','法国法郎','0');");
E_D("replace into `ecs_cus_jy_curr` values('10','276','德国马克','0');");
E_D("replace into `ecs_cus_jy_curr` values('11','344','港币','0');");
E_D("replace into `ecs_cus_jy_curr` values('12','380','意大利里拉','0');");
E_D("replace into `ecs_cus_jy_curr` values('13','392','日元','0');");
E_D("replace into `ecs_cus_jy_curr` values('14','446','澳门元','0');");
E_D("replace into `ecs_cus_jy_curr` values('15','458','马来西亚林吉特','0');");
E_D("replace into `ecs_cus_jy_curr` values('16','528','荷兰盾','0');");
E_D("replace into `ecs_cus_jy_curr` values('17','554','新西兰元','0');");
E_D("replace into `ecs_cus_jy_curr` values('18','578','挪威克朗','0');");
E_D("replace into `ecs_cus_jy_curr` values('19','608','菲律宾比索','0');");
E_D("replace into `ecs_cus_jy_curr` values('20','702','新加坡元','0');");
E_D("replace into `ecs_cus_jy_curr` values('21','724','西班牙比塞塔','0');");
E_D("replace into `ecs_cus_jy_curr` values('22','752','瑞典克朗','0');");
E_D("replace into `ecs_cus_jy_curr` values('23','756','瑞士法郎','0');");
E_D("replace into `ecs_cus_jy_curr` values('24','764','泰铢','0');");
E_D("replace into `ecs_cus_jy_curr` values('25','826','英镑','0');");
E_D("replace into `ecs_cus_jy_curr` values('26','840','美元','0');");
E_D("replace into `ecs_cus_jy_curr` values('27','910','欧元','0');");
E_D("replace into `ecs_cus_jy_curr` values('28','410','韩国元','0');");
E_D("replace into `ecs_cus_jy_curr` values('29','999','其他','0');");
E_D("replace into `ecs_cus_jy_curr` values('30','643','俄罗斯卢布','0');");

require("../../inc/footer.php");
?>