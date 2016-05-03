<?php
require("../../inc/header.php");

/*
		SoftName : EmpireBak Version 2010
		Author   : wm_chief
		Copyright: Powered by www.phome.net
*/

DoSetDbChar('utf8');
E_D("DROP TABLE IF EXISTS `ecs_brand`;");
E_C("CREATE TABLE `ecs_brand` (
  `brand_id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `brand_name` varchar(60) NOT NULL DEFAULT '',
  `brand_logo` varchar(80) NOT NULL DEFAULT '',
  `brand_desc` text NOT NULL,
  `site_url` varchar(255) NOT NULL DEFAULT '',
  `sort_order` tinyint(3) unsigned NOT NULL DEFAULT '50',
  `is_show` tinyint(1) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`brand_id`),
  KEY `is_show` (`is_show`)
) ENGINE=MyISAM AUTO_INCREMENT=45 DEFAULT CHARSET=utf8");
E_D("replace into `ecs_brand` values('1','有讯网络','1380685184117198956.jpg','公司网站：http://www.nokia.com.cn/\r\n\r\n客服电话：400-880-0123','http://www.nokia.com.cn/','50','1');");
E_D("replace into `ecs_brand` values('2','APPLE','1380685191110433994.jpg','官方咨询电话：4008105050\r\n售后网点：http://www.motorola.com.cn/service/carecenter/search.asp ','http://www.motorola.com.cn','50','1');");
E_D("replace into `ecs_brand` values('3','方正','1380685198896536870.jpg','官方咨询电话：4008201668\r\n售后网点：http://www.dopod.com/pc/service/searchresult2.php ','http://www.dopod.com ','50','1');");
E_D("replace into `ecs_brand` values('4','希捷','1380685206906148108.jpg','官方咨询电话：4008800008\r\n售后网点：http://www.philips.com.cn/service/mustservice/index.page ','http://www.philips.com.cn ','50','1');");
E_D("replace into `ecs_brand` values('5','漫步者','1380685213383629650.jpg','官方咨询电话：4008875777\r\n售后网点：http://www.amobile.com.cn/service_fwyzc.asp ','http://www.amobile.com.cn','50','1');");
E_D("replace into `ecs_brand` values('6','天翼','1380685222792305410.jpg','官方咨询电话：8008105858\r\n售后网点：http://cn.samsungmobile.com/cn/support/search_area_o.jsp ','http://cn.samsungmobile.com','50','1');");
E_D("replace into `ecs_brand` values('7','美的','1380685232971191371.jpg','官方咨询电话：4008100000\r\n售后网点：http://www.sonyericsson.com/cws/common/contact?cc=cn&lc=zh ','http://www.sonyericsson.com.cn/','50','1');");
E_D("replace into `ecs_brand` values('8','惠普','1380685242589017695.jpg','官方咨询电话：4008199999\r\n售后网点：http://www.lg.com.cn/front.support.svccenter.retrieveCenter.laf?hrefId=9 ','http://cn.wowlg.com','50','1');");
E_D("replace into `ecs_brand` values('9','联想','1380685252873307833.jpg','官方咨询电话：4008188818\r\n售后网点：http://www.lenovomobile.com/service/kf-wanglou.asp','http://www.lenovomobile.com/','50','1');");
E_D("replace into `ecs_brand` values('10','金立','1380685292392455401.jpg','官方咨询电话：4007796666\r\n售后网点：http://www.gionee.net/service.asp ','http://www.gionee.net','50','1');");
E_D("replace into `ecs_brand` values('11','  恒基伟业','1380685907063087318.jpg','官方咨询电话：4008899126\r\n售后网点：http://www.htwchina.com/htwt/wexiu.shtml ','http://www.htwchina.com','50','1');");
E_D("replace into `ecs_brand` values('12','夏普','1380685309482040868.jpg','','http://','50','1');");
E_D("replace into `ecs_brand` values('13','索尼','1380685318966924400.jpg','','http://','50','1');");
E_D("replace into `ecs_brand` values('14','创维','1380685327309605456.jpg','','http://','50','1');");
E_D("replace into `ecs_brand` values('20','茵佳妮','1380685345175448444.jpg','','http://','50','1');");
E_D("replace into `ecs_brand` values('17','爱普生','1380685356455900353.jpg','','http://','50','1');");
E_D("replace into `ecs_brand` values('18','AMD','1380685367276048777.jpg','','http://','50','1');");
E_D("replace into `ecs_brand` values('19','acer','1380685373892689456.jpg','','http://','50','1');");
E_D("replace into `ecs_brand` values('21','白领','1380685380419928070.jpg','','http://','50','1');");
E_D("replace into `ecs_brand` values('22','LILY','1380685392917690536.jpg','','http://','50','1');");
E_D("replace into `ecs_brand` values('23','JNBY 江南布衣','1380685401225598337.jpg','','http://','50','1');");
E_D("replace into `ecs_brand` values('24','裂帛','1380685410377577740.jpg','','http://','50','1');");
E_D("replace into `ecs_brand` values('25','O.SA','1380685418074603841.jpg','','http://','50','1');");
E_D("replace into `ecs_brand` values('26','太平鸟','1380685428529409794.jpg','','http://','50','1');");
E_D("replace into `ecs_brand` values('27','艾夫斯','1380685437557546263.jpg','','http://','50','1');");
E_D("replace into `ecs_brand` values('28','betu百图','1380685447477195506.jpg','','http://','50','1');");
E_D("replace into `ecs_brand` values('29','韩都衣舍','1380685458575185862.jpg','','http://','50','1');");
E_D("replace into `ecs_brand` values('30','圣迪奥','1380685469784236028.jpg','','http://','50','1');");
E_D("replace into `ecs_brand` values('31','EVENY','1380685484076765558.jpg','','http://','50','1');");
E_D("replace into `ecs_brand` values('32','溢彩年华','1380685493614241250.jpg','','http://','50','1');");
E_D("replace into `ecs_brand` values('33','空间大师','1380685501661713371.jpg','','http://','50','1');");
E_D("replace into `ecs_brand` values('34','美好家','1380685508100765689.jpg','','http://','50','1');");
E_D("replace into `ecs_brand` values('35','生活诚品','1380685517465148857.jpg','','http://','50','1');");
E_D("replace into `ecs_brand` values('36','宝优妮','1380685528138540997.jpg','','http://','50','1');");
E_D("replace into `ecs_brand` values('37','大豪','1380685537002141945.jpg','','http://','50','1');");
E_D("replace into `ecs_brand` values('38','美亿佳','1380685546460187418.jpg','','http://','50','1');");
E_D("replace into `ecs_brand` values('39','千弘','1380685554945999090.jpg','','http://','50','1');");
E_D("replace into `ecs_brand` values('40','好事达','1380685563264277972.jpg','','http://','50','1');");
E_D("replace into `ecs_brand` values('41','雅培','1380685570445734371.jpg','','http://','50','1');");
E_D("replace into `ecs_brand` values('42','贝亲','1380685578773247262.jpg','','http://','50','1');");
E_D("replace into `ecs_brand` values('43','帮宝适','1380685585445167375.jpg','','http://','50','1');");
E_D("replace into `ecs_brand` values('44','苹果','','','','50','1');");

require("../../inc/footer.php");
?>