<?php
require("../../inc/header.php");

/*
		SoftName : EmpireBak Version 2010
		Author   : wm_chief
		Copyright: Powered by www.phome.net
*/

DoSetDbChar('utf8');
E_D("DROP TABLE IF EXISTS `ecs_cuslist`;");
E_C("CREATE TABLE `ecs_cuslist` (
  `cusid` int(10) NOT NULL AUTO_INCREMENT,
  `order_sn` varchar(40) DEFAULT NULL,
  `add_time` int(10) NOT NULL DEFAULT '0',
  `update_time` int(10) NOT NULL DEFAULT '0',
  `order_id` int(10) NOT NULL DEFAULT '0',
  `orderstatus` tinyint(1) NOT NULL DEFAULT '1',
  `sendorderdate` int(10) NOT NULL DEFAULT '0',
  `paymentstatus` tinyint(1) NOT NULL DEFAULT '1',
  `sendpaymentdate` int(10) NOT NULL DEFAULT '0',
  `shippingstatus` int(1) NOT NULL DEFAULT '1',
  `sendshippingdate` int(10) NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `sendstatus` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`cusid`),
  UNIQUE KEY `order_id` (`order_id`)
) ENGINE=MyISAM AUTO_INCREMENT=100035 DEFAULT CHARSET=utf8");
E_D("replace into `ecs_cuslist` values('100034','2016030864907','1457471658','1457471658','10','1','0','1','0','1','0','0','1');");

require("../../inc/footer.php");
?>