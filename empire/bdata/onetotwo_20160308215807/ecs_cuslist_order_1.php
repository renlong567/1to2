<?php
require("../../inc/header.php");

/*
		SoftName : EmpireBak Version 2010
		Author   : wm_chief
		Copyright: Powered by www.phome.net
*/

DoSetDbChar('utf8');
E_D("DROP TABLE IF EXISTS `ecs_cuslist_order`;");
E_C("CREATE TABLE `ecs_cuslist_order` (
  `cusid` int(10) NOT NULL AUTO_INCREMENT,
  `order_id` int(10) NOT NULL DEFAULT '0',
  `lmsno` varchar(20) DEFAULT NULL,
  `manualno` varchar(20) DEFAULT NULL,
  `license_no` varchar(50) DEFAULT NULL,
  `declaretype` tinyint(1) DEFAULT '1',
  `cbecode` varchar(20) DEFAULT NULL,
  `cbename` varchar(50) DEFAULT NULL,
  `ecpcode` varchar(20) DEFAULT NULL,
  `ecpname` varchar(50) DEFAULT NULL,
  `collectionuseraddress` varchar(200) DEFAULT NULL,
  `collectionusercountry` varchar(3) DEFAULT NULL,
  `collectionusername` varchar(50) DEFAULT NULL,
  `collectionusertelephone` varchar(30) DEFAULT NULL,
  `goodsvalue` varchar(10) DEFAULT NULL,
  `orderid` varchar(50) DEFAULT NULL,
  `ordersum` varchar(20) DEFAULT NULL,
  `freight` varchar(10) DEFAULT NULL,
  `otherfee` varchar(10) DEFAULT NULL,
  `taxfee` varchar(10) DEFAULT NULL,
  `remark` varchar(300) DEFAULT NULL,
  `senderusercountry` varchar(3) DEFAULT NULL,
  `senderusername` varchar(50) DEFAULT NULL,
  `senderuseraddress` varchar(200) DEFAULT NULL,
  `senderusertelephone` varchar(30) DEFAULT NULL,
  `idtype` varchar(10) DEFAULT NULL,
  `customerid` varchar(30) DEFAULT NULL,
  `ietype` varchar(6) DEFAULT 'I',
  `billmode` tinyint(1) DEFAULT '2',
  `wasterornot` varchar(10) DEFAULT 'N',
  `botanyornot` varchar(10) DEFAULT 'N',
  `taxedenterprise` varchar(20) DEFAULT NULL,
  `cbecodeinsp` varchar(50) DEFAULT NULL,
  `ecpcodeinsp` varchar(50) DEFAULT NULL,
  `trepcodeinsp` varchar(50) DEFAULT NULL,
  `submittime` varchar(30) DEFAULT NULL,
  `tradecompany` varchar(3) DEFAULT NULL,
  `totalfeeunit` varchar(20) DEFAULT NULL,
  `countofgoodstype` varchar(10) DEFAULT NULL,
  `weight` varchar(10) DEFAULT NULL,
  `weightunit` varchar(20) DEFAULT NULL,
  `netweight` varchar(10) DEFAULT NULL,
  `netweightunit` varchar(20) DEFAULT NULL,
  `platformurl` varchar(50) DEFAULT NULL,
  `collusercountryinsp` varchar(3) DEFAULT NULL,
  `sendusercountryinsp` varchar(3) DEFAULT NULL,
  `paynumber` varchar(50) DEFAULT NULL,
  `payenterprisecode` varchar(20) DEFAULT NULL,
  `payenterprisename` varchar(50) DEFAULT NULL,
  `otherpayment` varchar(10) DEFAULT NULL,
  `otherpaymenttype` varchar(300) DEFAULT NULL,
  `declcode` varchar(20) DEFAULT NULL,
  `declname` varchar(50) DEFAULT NULL,
  `depositorguarantee` varchar(10) DEFAULT NULL,
  `guaranteeno` varchar(200) DEFAULT NULL,
  `extendfield1` varchar(200) DEFAULT NULL,
  `extendfield2` varchar(200) DEFAULT NULL,
  `extendfield3` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`cusid`)
) ENGINE=MyISAM AUTO_INCREMENT=100035 DEFAULT CHARSET=utf8");
E_D("replace into `ecs_cuslist_order` values('100034','10','1015','H20101015',NULL,'1','D461200044','一比二商城','W461200040','一比二平台','北京  北京  东城区 11111','142','xie','11111','198.00','2016030864907','203.00','5.00','0.00','0.00',NULL,'142','一比二商城','北京市东城区南环1号','13321673916','T0C001','452502198005083135','I','2','N','N','H451210','4100102324','4100102324','4100102324','2016-03-09 05:09:36','156','156',NULL,'1.2','035','1','035',NULL,'156','156',NULL,'P461200031','一比二支付','0.00',NULL,'4101983536','一比二报关','','',NULL,NULL,NULL);");

require("../../inc/footer.php");
?>