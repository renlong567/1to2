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
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `delivery_sn` varchar(40) DEFAULT NULL,
  `order_sn` varchar(40) DEFAULT NULL,
  `add_time` int(10) NOT NULL DEFAULT '0',
  `update_time` int(10) NOT NULL DEFAULT '0',
  `delivery_id` int(10) NOT NULL DEFAULT '0',
  `order_id` int(10) NOT NULL DEFAULT '0',
  `suppliers_id` int(10) NOT NULL DEFAULT '0',
  `orderstatus` tinyint(1) NOT NULL DEFAULT '1',
  `sendorderdate` int(10) NOT NULL DEFAULT '0',
  `paymentstatus` tinyint(1) NOT NULL DEFAULT '1',
  `sendpaymentdate` int(10) NOT NULL DEFAULT '0',
  `shippingstatus` int(1) NOT NULL DEFAULT '1',
  `sendshippingdate` int(10) NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8");

require("../../inc/footer.php");
?>