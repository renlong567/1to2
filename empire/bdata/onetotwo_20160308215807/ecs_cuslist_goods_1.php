<?php
require("../../inc/header.php");

/*
		SoftName : EmpireBak Version 2010
		Author   : wm_chief
		Copyright: Powered by www.phome.net
*/

DoSetDbChar('utf8');
E_D("DROP TABLE IF EXISTS `ecs_cuslist_goods`;");
E_C("CREATE TABLE `ecs_cuslist_goods` (
  `rec_id` int(10) NOT NULL AUTO_INCREMENT,
  `cusid` int(10) NOT NULL DEFAULT '0',
  `order_id` int(10) NOT NULL DEFAULT '0',
  `goods_id` int(10) DEFAULT '0',
  `product_id` int(10) NOT NULL DEFAULT '0',
  `product_sn` varchar(100) DEFAULT NULL,
  `goods_name` varchar(200) DEFAULT NULL,
  `goods_sn` varchar(200) DEFAULT NULL,
  `gno` varchar(10) DEFAULT NULL,
  `itemno` varchar(30) DEFAULT NULL,
  `shelfgoodsname` varchar(200) DEFAULT NULL,
  `describe` varchar(300) DEFAULT NULL,
  `goodid` varchar(30) DEFAULT NULL,
  `goodname` varchar(200) DEFAULT NULL,
  `specifications` varchar(200) DEFAULT NULL,
  `barcode` varchar(15) DEFAULT NULL,
  `taxid` varchar(10) DEFAULT NULL,
  `sourceproducercountry` varchar(3) DEFAULT NULL,
  `coin` varchar(3) DEFAULT NULL,
  `unit` varchar(20) DEFAULT NULL,
  `amount` varchar(10) DEFAULT NULL,
  `goodprice` varchar(10) DEFAULT NULL,
  `ordersum` varchar(10) DEFAULT NULL,
  `flag` varchar(1) DEFAULT NULL,
  `goodidinsp` varchar(50) DEFAULT NULL,
  `orderid` varchar(50) DEFAULT NULL,
  `goodnameenglish` varchar(200) DEFAULT NULL,
  `weigth` varchar(10) DEFAULT NULL,
  `weightunit` varchar(20) DEFAULT NULL,
  `packcategoryinsp` varchar(10) DEFAULT NULL,
  `wasterornotinsp` varchar(2) DEFAULT NULL,
  `remarksinsp` varchar(300) DEFAULT NULL,
  `coininsp` varchar(3) DEFAULT NULL,
  `unitinsp` varchar(20) DEFAULT NULL,
  `srccountryinsp` varchar(3) DEFAULT NULL,
  PRIMARY KEY (`rec_id`)
) ENGINE=MyISAM AUTO_INCREMENT=10000 DEFAULT CHARSET=utf8");

require("../../inc/footer.php");
?>