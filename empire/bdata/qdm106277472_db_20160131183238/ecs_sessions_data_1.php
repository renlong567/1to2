<?php
require("../../inc/header.php");

/*
		SoftName : EmpireBak Version 2010
		Author   : wm_chief
		Copyright: Powered by www.phome.net
*/

DoSetDbChar('utf8');
E_D("DROP TABLE IF EXISTS `ecs_sessions_data`;");
E_C("CREATE TABLE `ecs_sessions_data` (
  `sesskey` varchar(32) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '',
  `expiry` int(10) unsigned NOT NULL DEFAULT '0',
  `data` longtext NOT NULL,
  PRIMARY KEY (`sesskey`),
  KEY `expiry` (`expiry`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8");
E_D("replace into `ecs_sessions_data` values('529100956b848e77e008f0bd1c13dc9b','2877513688','a:8:{s:7:\"from_ad\";i:0;s:7:\"referer\";s:6:\"本站\";s:10:\"login_fail\";i:0;s:12:\"captcha_word\";s:16:\"OGIwNmM1NmIxYQ==\";s:9:\"flow_type\";i:0;s:10:\"flow_order\";a:1:{s:14:\"extension_code\";s:0:\"\";}s:9:\"last_time\";i:1438756845;s:7:\"last_ip\";s:0:\"\";}');");
E_D("replace into `ecs_sessions_data` values('42f01567917d96251c934a987eabeffc','2877701983','a:8:{s:7:\"from_ad\";i:0;s:7:\"referer\";s:6:\"本站\";s:10:\"login_fail\";i:0;s:12:\"captcha_word\";s:16:\"MmFkOWQ2MmEyMg==\";s:9:\"flow_type\";i:0;s:10:\"flow_order\";a:8:{s:14:\"extension_code\";s:0:\"\";s:11:\"shipping_id\";i:0;s:6:\"pay_id\";i:0;s:7:\"pack_id\";i:0;s:7:\"card_id\";i:0;s:5:\"bonus\";i:0;s:8:\"integral\";i:0;s:7:\"surplus\";i:0;}s:15:\"direct_shopping\";i:1;s:14:\"flow_consignee\";a:13:{s:10:\"address_id\";i:0;s:9:\"consignee\";s:3:\"gad\";s:7:\"country\";s:1:\"1\";s:8:\"province\";s:1:\"5\";s:4:\"city\";s:2:\"66\";s:8:\"district\";s:3:\"633\";s:5:\"email\";s:16:\"651165516@qq.com\";s:7:\"address\";s:12:\"agdadgadgadg\";s:7:\"zipcode\";s:0:\"\";s:3:\"tel\";s:11:\"12546896563\";s:6:\"mobile\";s:0:\"\";s:13:\"sign_building\";s:0:\"\";s:9:\"best_time\";s:0:\"\";}}');");
E_D("replace into `ecs_sessions_data` values('b5fb479cc3630f59bd91cf7a22caf3c6','4294967295','a:9:{s:7:\"from_ad\";i:0;s:7:\"referer\";s:6:\"本站\";s:10:\"login_fail\";i:0;s:12:\"captcha_word\";s:16:\"ZTMxNjljZDUxZg==\";s:9:\"flow_type\";i:0;s:10:\"flow_order\";a:8:{s:14:\"extension_code\";s:0:\"\";s:11:\"shipping_id\";i:1;s:6:\"pay_id\";i:1;s:7:\"pack_id\";i:0;s:7:\"card_id\";i:0;s:5:\"bonus\";i:0;s:8:\"integral\";i:0;s:7:\"surplus\";i:0;}s:9:\"last_time\";s:10:\"1454047626\";s:7:\"last_ip\";s:13:\"123.14.204.53\";s:14:\"flow_consignee\";a:14:{s:10:\"address_id\";i:0;s:9:\"consignee\";s:6:\"王允\";s:7:\"country\";s:1:\"1\";s:8:\"province\";s:2:\"11\";s:4:\"city\";s:3:\"149\";s:8:\"district\";s:4:\"1251\";s:5:\"email\";s:14:\"7600687@qq.com\";s:7:\"address\";s:18:\"郑州市文化路\";s:7:\"zipcode\";s:6:\"450001\";s:3:\"tel\";s:11:\"13838117797\";s:6:\"mobile\";s:11:\"13838117797\";s:13:\"sign_building\";s:0:\"\";s:9:\"best_time\";s:0:\"\";s:7:\"user_id\";s:1:\"2\";}}');");

require("../../inc/footer.php");
?>