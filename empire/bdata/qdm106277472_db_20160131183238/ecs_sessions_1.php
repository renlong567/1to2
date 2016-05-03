<?php
require("../../inc/header.php");

/*
		SoftName : EmpireBak Version 2010
		Author   : wm_chief
		Copyright: Powered by www.phome.net
*/

DoSetDbChar('utf8');
E_D("DROP TABLE IF EXISTS `ecs_sessions`;");
E_C("CREATE TABLE `ecs_sessions` (
  `sesskey` char(32) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '',
  `expiry` int(10) unsigned NOT NULL DEFAULT '0',
  `userid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `adminid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `ip` char(15) NOT NULL DEFAULT '',
  `user_name` varchar(60) NOT NULL,
  `user_rank` tinyint(3) NOT NULL,
  `discount` decimal(3,2) NOT NULL,
  `email` varchar(60) NOT NULL,
  `data` char(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`sesskey`),
  KEY `expiry` (`expiry`)
) ENGINE=MEMORY DEFAULT CHARSET=utf8");
E_D("replace into `ecs_sessions` values('d6ef489a1483bf0b989a5bd459948018','1454234552','0','0','101.226.33.222','0','0','1.00','0','a:0:{}');");
E_D("replace into `ecs_sessions` values('46965124c168fc2c018fcec47d877a5d','1454234552','0','0','180.153.81.163','0','0','0.00','0','a:0:{}');");
E_D("replace into `ecs_sessions` values('b5697fade0ffb322ba562189a8facb25','1454234551','0','0','180.153.201.15','0','0','1.00','0','a:3:{s:7:\"from_ad\";i:0;s:7:\"referer\";s:6:\"本站\";s:10:\"login_fail\";i:0;}');");
E_D("replace into `ecs_sessions` values('acc1a009565a89fdb41f01f213c6974f','1454234552','0','0','183.60.35.29','0','0','1.00','0','a:0:{}');");
E_D("replace into `ecs_sessions` values('4d03e5cd041ddf23559107bf7b43d6d7','1454234551','0','0','180.153.81.163','0','0','1.00','0','a:3:{s:7:\"from_ad\";i:0;s:7:\"referer\";s:6:\"本站\";s:10:\"login_fail\";i:0;}');");
E_D("replace into `ecs_sessions` values('b7aa23fadb87d5bec7ad3efc8f362a78','1454234552','0','0','101.226.33.206','0','0','1.00','0','a:0:{}');");
E_D("replace into `ecs_sessions` values('732971b754af0082d15f1ff6ec5c6f39','1454234551','0','0','101.226.33.222','0','0','1.00','0','a:3:{s:7:\"from_ad\";i:0;s:7:\"referer\";s:6:\"本站\";s:10:\"login_fail\";i:0;}');");
E_D("replace into `ecs_sessions` values('a74c1e263a43edbfb706babef04c9c6a','1454234552','0','0','101.226.33.222','0','0','1.00','0','a:0:{}');");
E_D("replace into `ecs_sessions` values('b813df129e0963607c4c44a90ec97d43','1454234552','0','0','14.17.34.190','0','0','1.00','0','a:0:{}');");
E_D("replace into `ecs_sessions` values('ead05572097da7e5c964119198f3f247','1454234552','0','0','61.151.186.144','0','0','0.00','0','a:0:{}');");
E_D("replace into `ecs_sessions` values('1450cf6d16e905a6a908c1aa4a21dc89','1454234552','0','0','101.226.33.222','0','0','1.00','0','a:3:{s:7:\"from_ad\";i:0;s:7:\"referer\";s:6:\"本站\";s:10:\"login_fail\";i:0;}');");
E_D("replace into `ecs_sessions` values('87c79eb2edf55fd00db5e7048381b6db','1454234552','0','0','180.153.201.15','0','0','1.00','0','a:0:{}');");
E_D("replace into `ecs_sessions` values('75c493a0fd2524e9dbdc7acd9c948961','1454234551','0','0','14.17.29.85','0','0','0.00','0','a:0:{}');");
E_D("replace into `ecs_sessions` values('552f49c9bb3e2098da5683dd73259e4f','1454234552','0','0','180.153.4.19','0','0','0.00','0','a:0:{}');");
E_D("replace into `ecs_sessions` values('1d2e5c02e001215b80290f652605640f','1454234551','0','0','101.226.33.206','0','0','1.00','0','a:3:{s:7:\"from_ad\";i:0;s:7:\"referer\";s:6:\"本站\";s:10:\"login_fail\";i:0;}');");
E_D("replace into `ecs_sessions` values('b30267940dd530203e8860463326f98e','1454234551','0','0','14.17.34.190','0','0','1.00','0','a:3:{s:7:\"from_ad\";i:0;s:7:\"referer\";s:6:\"本站\";s:10:\"login_fail\";i:0;}');");
E_D("replace into `ecs_sessions` values('e01f02382cae140ba767c9bf446a456c','1454234552','0','0','14.17.18.147','0','0','0.00','0','a:0:{}');");
E_D("replace into `ecs_sessions` values('2c69018d0b03cbd8a784c80cd71ae658','1454234551','0','0','183.60.35.29','0','0','1.00','0','a:3:{s:7:\"from_ad\";i:0;s:7:\"referer\";s:6:\"本站\";s:10:\"login_fail\";i:0;}');");
E_D("replace into `ecs_sessions` values('c5397d65cd361f615833952fb351bcbc','1454234218','0','0','101.226.33.206','0','0','1.00','0','a:3:{s:7:\"from_ad\";i:0;s:7:\"referer\";s:6:\"本站\";s:10:\"login_fail\";i:0;}');");
E_D("replace into `ecs_sessions` values('3b23b477f902f53d359cd95c4b76f54d','1454234551','0','0','180.153.81.163','0','0','0.00','0','a:0:{}');");
E_D("replace into `ecs_sessions` values('f34f60b8a9f41111f090595d2066ee45','1454234551','0','0','180.153.206.23','0','0','0.00','0','a:0:{}');");
E_D("replace into `ecs_sessions` values('eed3a564855139c3f750d426dc6232f2','1454234219','0','0','101.226.33.206','0','0','1.00','0','a:0:{}');");
E_D("replace into `ecs_sessions` values('81cd862af5beed7d76177fe2f13e0a84','1454234218','0','0','42.236.244.125','0','0','1.00','0','a:3:{s:7:\"from_ad\";i:0;s:7:\"referer\";s:6:\"本站\";s:10:\"login_fail\";i:0;}');");
E_D("replace into `ecs_sessions` values('0c29b8f889086f32812e912cab8934cf','1454232766','0','0','180.140.17.132','0','0','1.00','0','a:3:{s:7:\"from_ad\";i:0;s:7:\"referer\";s:6:\"本站\";s:10:\"login_fail\";i:0;}');");
E_D("replace into `ecs_sessions` values('52ce496fe3514405be1fb6fe01bda6b4','1454233861','0','1','101.100.168.201','0','0','0.00','0','a:3:{s:10:\"admin_name\";s:5:\"admin\";s:11:\"action_list\";s:3:\"all\";s:10:\"last_check\";i:1454233861;}');");
E_D("replace into `ecs_sessions` values('c7ab7e968decf2d1ff718e77afcb801f','1454234551','0','0','180.153.81.183','0','0','1.00','0','a:3:{s:7:\"from_ad\";i:0;s:7:\"referer\";s:6:\"本站\";s:10:\"login_fail\";i:0;}');");
E_D("replace into `ecs_sessions` values('58437c816506eecb36220edffbe70acb','1454232974','0','1','180.140.17.132','0','0','0.00','0','a:3:{s:10:\"admin_name\";s:5:\"admin\";s:11:\"action_list\";s:3:\"all\";s:10:\"last_check\";i:1454232974;}');");

require("../../inc/footer.php");
?>