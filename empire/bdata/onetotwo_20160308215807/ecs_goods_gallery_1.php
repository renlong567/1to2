<?php
require("../../inc/header.php");

/*
		SoftName : EmpireBak Version 2010
		Author   : wm_chief
		Copyright: Powered by www.phome.net
*/

DoSetDbChar('utf8');
E_D("DROP TABLE IF EXISTS `ecs_goods_gallery`;");
E_C("CREATE TABLE `ecs_goods_gallery` (
  `img_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `goods_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `img_url` varchar(255) NOT NULL DEFAULT '',
  `img_desc` varchar(255) NOT NULL DEFAULT '',
  `thumb_url` varchar(255) NOT NULL DEFAULT '',
  `img_original` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`img_id`),
  KEY `goods_id` (`goods_id`)
) ENGINE=MyISAM AUTO_INCREMENT=421 DEFAULT CHARSET=utf8");
E_D("replace into `ecs_goods_gallery` values('407','165','images/201601/goods_img/165_P_1453879474986.jpg','','images/201601/thumb_img/165_thumb_P_1453879474725.jpg','images/201601/source_img/165_P_1453879474731.jpg');");
E_D("replace into `ecs_goods_gallery` values('408','165','images/201601/goods_img/165_P_1453879615132.jpg','','images/201601/thumb_img/165_thumb_P_1453879615570.jpg','images/201601/source_img/165_P_1453879615965.jpg');");
E_D("replace into `ecs_goods_gallery` values('409','166','images/201601/goods_img/166_P_1453881983613.jpg','','images/201601/thumb_img/166_thumb_P_1453881983213.jpg','images/201601/source_img/166_P_1453881983710.jpg');");
E_D("replace into `ecs_goods_gallery` values('410','166','images/201601/goods_img/166_P_1453882015839.jpg','','images/201601/thumb_img/166_thumb_P_1453882015489.jpg','images/201601/source_img/166_P_1453882015769.jpg');");
E_D("replace into `ecs_goods_gallery` values('411','162','images/201601/goods_img/162_P_1453887165625.jpg','','images/201601/thumb_img/162_thumb_P_1453887165026.jpg','images/201601/source_img/162_P_1453887165731.jpg');");
E_D("replace into `ecs_goods_gallery` values('412','162','images/201601/goods_img/162_P_1453887188712.jpg','','images/201601/thumb_img/162_thumb_P_1453887188770.jpg','images/201601/source_img/162_P_1453887188119.jpg');");
E_D("replace into `ecs_goods_gallery` values('413','162','images/201601/goods_img/162_P_1453887208985.jpg','','images/201601/thumb_img/162_thumb_P_1453887208892.jpg','images/201601/source_img/162_P_1453887208704.jpg');");
E_D("replace into `ecs_goods_gallery` values('414','169','images/201601/goods_img/169_P_1453888778649.jpg','','images/201601/thumb_img/169_thumb_P_1453888778464.jpg','images/201601/source_img/169_P_1453888778834.jpg');");
E_D("replace into `ecs_goods_gallery` values('415','169','images/201601/goods_img/169_P_1453888805606.jpg','','images/201601/thumb_img/169_thumb_P_1453888805169.jpg','images/201601/source_img/169_P_1453888805853.jpg');");
E_D("replace into `ecs_goods_gallery` values('416','169','images/201601/goods_img/169_P_1453888826799.jpg','','images/201601/thumb_img/169_thumb_P_1453888826483.jpg','images/201601/source_img/169_P_1453888826803.jpg');");
E_D("replace into `ecs_goods_gallery` values('417','170','images/201601/goods_img/170_P_1453951186548.jpg','','images/201601/thumb_img/170_thumb_P_1453951186490.jpg','images/201601/source_img/170_P_1453951186884.jpg');");
E_D("replace into `ecs_goods_gallery` values('418','170','images/201601/goods_img/170_P_1453951614866.jpg','','images/201601/thumb_img/170_thumb_P_1453951614925.jpg','images/201601/source_img/170_P_1453951614012.jpg');");
E_D("replace into `ecs_goods_gallery` values('420','179','images/201601/goods_img/179_P_1453951962303.jpg','','images/201601/thumb_img/179_thumb_P_1453951962021.jpg','images/201601/source_img/179_P_1453951962212.jpg');");
E_D("replace into `ecs_goods_gallery` values('419','172','images/201601/goods_img/172_P_1453951807456.jpg','','images/201601/thumb_img/172_thumb_P_1453951807457.jpg','images/201601/source_img/172_P_1453951807227.jpg');");
E_D("replace into `ecs_goods_gallery` values('313','151','images/201601/goods_img/151_P_1453704554782.jpg','','images/201601/thumb_img/151_thumb_P_1453704554547.jpg','images/201601/source_img/151_P_1453704554156.jpg');");
E_D("replace into `ecs_goods_gallery` values('314','151','images/201601/goods_img/151_P_1453704937963.jpg','','images/201601/thumb_img/151_thumb_P_1453704937886.jpg','images/201601/source_img/151_P_1453704937593.jpg');");
E_D("replace into `ecs_goods_gallery` values('315','151','images/201601/goods_img/151_P_1453704961151.jpg','','images/201601/thumb_img/151_thumb_P_1453704961361.jpg','images/201601/source_img/151_P_1453704961659.jpg');");
E_D("replace into `ecs_goods_gallery` values('316','152','images/201601/goods_img/152_P_1453705148279.jpg','','images/201601/thumb_img/152_thumb_P_1453705148282.jpg','images/201601/source_img/152_P_1453705148603.jpg');");
E_D("replace into `ecs_goods_gallery` values('317','152','images/201601/goods_img/152_P_1453705221877.jpg','','images/201601/thumb_img/152_thumb_P_1453705221268.jpg','images/201601/source_img/152_P_1453705221451.jpg');");
E_D("replace into `ecs_goods_gallery` values('318','153','images/201601/goods_img/153_P_1453705691976.jpg','','images/201601/thumb_img/153_thumb_P_1453705691536.jpg','images/201601/source_img/153_P_1453705691130.jpg');");
E_D("replace into `ecs_goods_gallery` values('319','153','images/201601/goods_img/153_P_1453706273035.jpg','','images/201601/thumb_img/153_thumb_P_1453706273044.jpg','images/201601/source_img/153_P_1453706273111.jpg');");
E_D("replace into `ecs_goods_gallery` values('320','153','images/201601/goods_img/153_P_1453706300726.jpg','','images/201601/thumb_img/153_thumb_P_1453706300961.jpg','images/201601/source_img/153_P_1453706300249.jpg');");
E_D("replace into `ecs_goods_gallery` values('323','154','images/201601/goods_img/154_P_1453706581116.jpg','','images/201601/thumb_img/154_thumb_P_1453706581422.jpg','images/201601/source_img/154_P_1453706581295.jpg');");
E_D("replace into `ecs_goods_gallery` values('322','153','images/201601/goods_img/153_P_1453706334894.jpg','','images/201601/thumb_img/153_thumb_P_1453706334623.jpg','images/201601/source_img/153_P_1453706334857.jpg');");
E_D("replace into `ecs_goods_gallery` values('324','154','images/201601/goods_img/154_P_1453706922199.jpg','','images/201601/thumb_img/154_thumb_P_1453706922713.jpg','images/201601/source_img/154_P_1453706922653.jpg');");
E_D("replace into `ecs_goods_gallery` values('325','155','images/201601/goods_img/155_P_1453707058668.jpg','','images/201601/thumb_img/155_thumb_P_1453707058017.jpg','images/201601/source_img/155_P_1453707058745.jpg');");
E_D("replace into `ecs_goods_gallery` values('326','155','images/201601/goods_img/155_P_1453707211874.jpg','','images/201601/thumb_img/155_thumb_P_1453707211253.jpg','images/201601/source_img/155_P_1453707211830.jpg');");
E_D("replace into `ecs_goods_gallery` values('327','155','images/201601/goods_img/155_P_1453707224558.jpg','','images/201601/thumb_img/155_thumb_P_1453707224665.jpg','images/201601/source_img/155_P_1453707224366.jpg');");
E_D("replace into `ecs_goods_gallery` values('328','156','images/201601/goods_img/156_P_1453707327774.jpg','','images/201601/thumb_img/156_thumb_P_1453707327653.jpg','images/201601/source_img/156_P_1453707327093.jpg');");
E_D("replace into `ecs_goods_gallery` values('329','156','images/201601/goods_img/156_P_1453707544313.jpg','','images/201601/thumb_img/156_thumb_P_1453707544008.jpg','images/201601/source_img/156_P_1453707544796.jpg');");
E_D("replace into `ecs_goods_gallery` values('330','156','images/201601/goods_img/156_P_1453707564936.jpg','','images/201601/thumb_img/156_thumb_P_1453707564813.jpg','images/201601/source_img/156_P_1453707564868.jpg');");
E_D("replace into `ecs_goods_gallery` values('331','156','images/201601/goods_img/156_P_1453707587189.jpg','','images/201601/thumb_img/156_thumb_P_1453707587632.jpg','images/201601/source_img/156_P_1453707587809.jpg');");
E_D("replace into `ecs_goods_gallery` values('332','157','images/201601/goods_img/157_P_1453707826367.jpg','','images/201601/thumb_img/157_thumb_P_1453707826904.jpg','images/201601/source_img/157_P_1453707826882.jpg');");
E_D("replace into `ecs_goods_gallery` values('336','158','images/201601/goods_img/158_P_1453714224672.jpg','','images/201601/thumb_img/158_thumb_P_1453714224811.jpg','images/201601/source_img/158_P_1453714224015.jpg');");
E_D("replace into `ecs_goods_gallery` values('335','158','images/201601/goods_img/158_P_1453713785065.jpg','','images/201601/thumb_img/158_thumb_P_1453713785974.jpg','images/201601/source_img/158_P_1453713785439.jpg');");
E_D("replace into `ecs_goods_gallery` values('337','158','images/201601/goods_img/158_P_1453714481650.jpg','','images/201601/thumb_img/158_thumb_P_1453714481755.jpg','images/201601/source_img/158_P_1453714481205.jpg');");
E_D("replace into `ecs_goods_gallery` values('339','158','images/201601/goods_img/158_P_1453714709311.jpg','','images/201601/thumb_img/158_thumb_P_1453714709993.jpg','images/201601/source_img/158_P_1453714709663.jpg');");
E_D("replace into `ecs_goods_gallery` values('340','159','images/201601/goods_img/159_P_1453716029209.jpg','','images/201601/thumb_img/159_thumb_P_1453716029331.jpg','images/201601/source_img/159_P_1453716029051.jpg');");
E_D("replace into `ecs_goods_gallery` values('341','159','images/201601/goods_img/159_P_1453716136102.jpg','','images/201601/thumb_img/159_thumb_P_1453716136239.jpg','images/201601/source_img/159_P_1453716136403.jpg');");
E_D("replace into `ecs_goods_gallery` values('342','160','images/201601/goods_img/160_P_1453716318406.jpg','','images/201601/thumb_img/160_thumb_P_1453716318454.jpg','images/201601/source_img/160_P_1453716318591.jpg');");
E_D("replace into `ecs_goods_gallery` values('343','160','images/201601/goods_img/160_P_1453770138842.jpg','','images/201601/thumb_img/160_thumb_P_1453770138668.jpg','images/201601/source_img/160_P_1453770138743.jpg');");
E_D("replace into `ecs_goods_gallery` values('344','160','images/201601/goods_img/160_P_1453770176031.jpg','','images/201601/thumb_img/160_thumb_P_1453770176857.jpg','images/201601/source_img/160_P_1453770176783.jpg');");
E_D("replace into `ecs_goods_gallery` values('345','160','images/201601/goods_img/160_P_1453770245986.jpg','','images/201601/thumb_img/160_thumb_P_1453770245570.jpg','images/201601/source_img/160_P_1453770245384.jpg');");
E_D("replace into `ecs_goods_gallery` values('350','162','images/201601/goods_img/162_P_1453774486715.jpg','','images/201601/thumb_img/162_thumb_P_1453774486764.jpg','images/201601/source_img/162_P_1453774486195.jpg');");
E_D("replace into `ecs_goods_gallery` values('349','161','images/201601/goods_img/161_P_1453774288764.jpg','','images/201601/thumb_img/161_thumb_P_1453774288432.jpg','images/201601/source_img/161_P_1453774288514.jpg');");
E_D("replace into `ecs_goods_gallery` values('348','161','images/201601/goods_img/161_P_1453774192341.jpg','','images/201601/thumb_img/161_thumb_P_1453774192237.jpg','images/201601/source_img/161_P_1453774192591.jpg');");
E_D("replace into `ecs_goods_gallery` values('351','163','images/201601/goods_img/163_P_1453774735482.jpg','','images/201601/thumb_img/163_thumb_P_1453774735913.jpg','images/201601/source_img/163_P_1453774735254.jpg');");
E_D("replace into `ecs_goods_gallery` values('352','163','images/201601/goods_img/163_P_1453774875579.jpg','','images/201601/thumb_img/163_thumb_P_1453774875888.jpg','images/201601/source_img/163_P_1453774875823.jpg');");
E_D("replace into `ecs_goods_gallery` values('353','163','images/201601/goods_img/163_P_1453774895148.jpg','','images/201601/thumb_img/163_thumb_P_1453774895398.jpg','images/201601/source_img/163_P_1453774895163.jpg');");
E_D("replace into `ecs_goods_gallery` values('354','163','images/201601/goods_img/163_P_1453774923639.jpg','','images/201601/thumb_img/163_thumb_P_1453774923635.jpg','images/201601/source_img/163_P_1453774923173.jpg');");
E_D("replace into `ecs_goods_gallery` values('357','165','images/201601/goods_img/165_P_1453776516225.jpg','','images/201601/thumb_img/165_thumb_P_1453776516309.jpg','images/201601/source_img/165_P_1453776516114.jpg');");
E_D("replace into `ecs_goods_gallery` values('356','164','images/201601/goods_img/164_P_1453776103759.jpg','','images/201601/thumb_img/164_thumb_P_1453776103570.jpg','images/201601/source_img/164_P_1453776103742.jpg');");
E_D("replace into `ecs_goods_gallery` values('358','166','images/201601/goods_img/166_P_1453777237886.jpg','','images/201601/thumb_img/166_thumb_P_1453777237636.jpg','images/201601/source_img/166_P_1453777237868.jpg');");
E_D("replace into `ecs_goods_gallery` values('359','167','images/201601/goods_img/167_P_1453778131219.jpg','','images/201601/thumb_img/167_thumb_P_1453778131435.jpg','images/201601/source_img/167_P_1453778131904.jpg');");
E_D("replace into `ecs_goods_gallery` values('360','167','images/201601/goods_img/167_P_1453778515163.jpg','','images/201601/thumb_img/167_thumb_P_1453778515617.jpg','images/201601/source_img/167_P_1453778515680.jpg');");
E_D("replace into `ecs_goods_gallery` values('361','167','images/201601/goods_img/167_P_1453778603172.jpg','','images/201601/thumb_img/167_thumb_P_1453778603810.jpg','images/201601/source_img/167_P_1453778603406.jpg');");
E_D("replace into `ecs_goods_gallery` values('362','167','images/201601/goods_img/167_P_1453778656664.jpg','','images/201601/thumb_img/167_thumb_P_1453778656109.jpg','images/201601/source_img/167_P_1453778656810.jpg');");
E_D("replace into `ecs_goods_gallery` values('363','168','images/201601/goods_img/168_P_1453779506760.jpg','','images/201601/thumb_img/168_thumb_P_1453779506073.jpg','images/201601/source_img/168_P_1453779506296.jpg');");
E_D("replace into `ecs_goods_gallery` values('364','168','images/201601/goods_img/168_P_1453779729319.jpg','','images/201601/thumb_img/168_thumb_P_1453779729887.jpg','images/201601/source_img/168_P_1453779729636.jpg');");
E_D("replace into `ecs_goods_gallery` values('365','169','images/201601/goods_img/169_P_1453780270708.jpg','','images/201601/thumb_img/169_thumb_P_1453780270100.jpg','images/201601/source_img/169_P_1453780270289.jpg');");
E_D("replace into `ecs_goods_gallery` values('366','170','images/201601/goods_img/170_P_1453786319465.jpg','','images/201601/thumb_img/170_thumb_P_1453786319686.jpg','images/201601/source_img/170_P_1453786319672.jpg');");
E_D("replace into `ecs_goods_gallery` values('367','170','images/201601/goods_img/170_P_1453786447622.jpg','','images/201601/thumb_img/170_thumb_P_1453786447160.jpg','images/201601/source_img/170_P_1453786447086.jpg');");
E_D("replace into `ecs_goods_gallery` values('368','170','images/201601/goods_img/170_P_1453786471463.jpg','','images/201601/thumb_img/170_thumb_P_1453786471853.jpg','images/201601/source_img/170_P_1453786471088.jpg');");
E_D("replace into `ecs_goods_gallery` values('369','171','images/201601/goods_img/171_P_1453786624784.jpg','','images/201601/thumb_img/171_thumb_P_1453786624512.jpg','images/201601/source_img/171_P_1453786624270.jpg');");
E_D("replace into `ecs_goods_gallery` values('370','171','images/201601/goods_img/171_P_1453787344045.jpg','','images/201601/thumb_img/171_thumb_P_1453787344714.jpg','images/201601/source_img/171_P_1453787344532.jpg');");
E_D("replace into `ecs_goods_gallery` values('371','171','images/201601/goods_img/171_P_1453787385153.jpg','','images/201601/thumb_img/171_thumb_P_1453787385752.jpg','images/201601/source_img/171_P_1453787385994.jpg');");
E_D("replace into `ecs_goods_gallery` values('372','172','images/201601/goods_img/172_P_1453788389118.jpg','','images/201601/thumb_img/172_thumb_P_1453788389861.jpg','images/201601/source_img/172_P_1453788389161.jpg');");
E_D("replace into `ecs_goods_gallery` values('373','172','images/201601/goods_img/172_P_1453788504074.jpg','','images/201601/thumb_img/172_thumb_P_1453788504223.jpg','images/201601/source_img/172_P_1453788504715.jpg');");
E_D("replace into `ecs_goods_gallery` values('374','172','images/201601/goods_img/172_P_1453788530474.jpg','','images/201601/thumb_img/172_thumb_P_1453788530717.jpg','images/201601/source_img/172_P_1453788530947.jpg');");
E_D("replace into `ecs_goods_gallery` values('375','172','images/201601/goods_img/172_P_1453788549070.jpg','','images/201601/thumb_img/172_thumb_P_1453788549414.jpg','images/201601/source_img/172_P_1453788549799.jpg');");
E_D("replace into `ecs_goods_gallery` values('376','173','images/201601/goods_img/173_P_1453788674910.jpg','','images/201601/thumb_img/173_thumb_P_1453788674548.jpg','images/201601/source_img/173_P_1453788674742.jpg');");
E_D("replace into `ecs_goods_gallery` values('377','173','images/201601/goods_img/173_P_1453788986769.jpg','','images/201601/thumb_img/173_thumb_P_1453788986981.jpg','images/201601/source_img/173_P_1453788986518.jpg');");
E_D("replace into `ecs_goods_gallery` values('378','173','images/201601/goods_img/173_P_1453789001779.jpg','','images/201601/thumb_img/173_thumb_P_1453789001593.jpg','images/201601/source_img/173_P_1453789001463.jpg');");
E_D("replace into `ecs_goods_gallery` values('379','173','images/201601/goods_img/173_P_1453789015862.jpg','','images/201601/thumb_img/173_thumb_P_1453789015891.jpg','images/201601/source_img/173_P_1453789015516.jpg');");
E_D("replace into `ecs_goods_gallery` values('380','174','images/201601/goods_img/174_P_1453789555453.jpg','','images/201601/thumb_img/174_thumb_P_1453789555162.jpg','images/201601/source_img/174_P_1453789555699.jpg');");
E_D("replace into `ecs_goods_gallery` values('381','174','images/201601/goods_img/174_P_1453789775937.jpg','','images/201601/thumb_img/174_thumb_P_1453789775263.jpg','images/201601/source_img/174_P_1453789775378.jpg');");
E_D("replace into `ecs_goods_gallery` values('382','174','images/201601/goods_img/174_P_1453789799375.jpg','','images/201601/thumb_img/174_thumb_P_1453789799099.jpg','images/201601/source_img/174_P_1453789799520.jpg');");
E_D("replace into `ecs_goods_gallery` values('383','174','images/201601/goods_img/174_P_1453789813390.jpg','','images/201601/thumb_img/174_thumb_P_1453789813392.jpg','images/201601/source_img/174_P_1453789813474.jpg');");
E_D("replace into `ecs_goods_gallery` values('384','175','images/201601/goods_img/175_P_1453790749457.jpg','','images/201601/thumb_img/175_thumb_P_1453790749979.jpg','images/201601/source_img/175_P_1453790749941.jpg');");
E_D("replace into `ecs_goods_gallery` values('385','175','images/201601/goods_img/175_P_1453791039065.jpg','','images/201601/thumb_img/175_thumb_P_1453791039080.jpg','images/201601/source_img/175_P_1453791039216.jpg');");
E_D("replace into `ecs_goods_gallery` values('386','176','images/201601/goods_img/176_P_1453791152710.jpg','','images/201601/thumb_img/176_thumb_P_1453791152479.jpg','images/201601/source_img/176_P_1453791152529.jpg');");
E_D("replace into `ecs_goods_gallery` values('387','176','images/201601/goods_img/176_P_1453791578062.jpg','','images/201601/thumb_img/176_thumb_P_1453791578622.jpg','images/201601/source_img/176_P_1453791578838.jpg');");
E_D("replace into `ecs_goods_gallery` values('388','176','images/201601/goods_img/176_P_1453791590326.jpg','','images/201601/thumb_img/176_thumb_P_1453791590788.jpg','images/201601/source_img/176_P_1453791590138.jpg');");
E_D("replace into `ecs_goods_gallery` values('389','177','images/201601/goods_img/177_P_1453791751237.jpg','','images/201601/thumb_img/177_thumb_P_1453791751454.jpg','images/201601/source_img/177_P_1453791751095.jpg');");
E_D("replace into `ecs_goods_gallery` values('390','177','images/201601/goods_img/177_P_1453792516499.jpg','','images/201601/thumb_img/177_thumb_P_1453792516847.jpg','images/201601/source_img/177_P_1453792516750.jpg');");
E_D("replace into `ecs_goods_gallery` values('391','177','images/201601/goods_img/177_P_1453792529191.jpg','','images/201601/thumb_img/177_thumb_P_1453792529853.jpg','images/201601/source_img/177_P_1453792529845.jpg');");
E_D("replace into `ecs_goods_gallery` values('392','178','images/201601/goods_img/178_P_1453792681499.jpg','','images/201601/thumb_img/178_thumb_P_1453792681319.jpg','images/201601/source_img/178_P_1453792681107.jpg');");
E_D("replace into `ecs_goods_gallery` values('393','179','images/201601/goods_img/179_P_1453794299412.jpg','','images/201601/thumb_img/179_thumb_P_1453794299014.jpg','images/201601/source_img/179_P_1453794299785.jpg');");
E_D("replace into `ecs_goods_gallery` values('394','178','images/201601/goods_img/178_P_1453794417736.jpg','','images/201601/thumb_img/178_thumb_P_1453794417288.jpg','images/201601/source_img/178_P_1453794417295.jpg');");
E_D("replace into `ecs_goods_gallery` values('395','178','images/201601/goods_img/178_P_1453794433602.jpg','','images/201601/thumb_img/178_thumb_P_1453794433752.jpg','images/201601/source_img/178_P_1453794433241.jpg');");
E_D("replace into `ecs_goods_gallery` values('396','179','images/201601/goods_img/179_P_1453794982356.jpg','','images/201601/thumb_img/179_thumb_P_1453794982917.jpg','images/201601/source_img/179_P_1453794982315.jpg');");
E_D("replace into `ecs_goods_gallery` values('397','179','images/201601/goods_img/179_P_1453795026282.jpg','','images/201601/thumb_img/179_thumb_P_1453795026328.jpg','images/201601/source_img/179_P_1453795026954.jpg');");
E_D("replace into `ecs_goods_gallery` values('398','179','images/201601/goods_img/179_P_1453795931245.jpg','','images/201601/thumb_img/179_thumb_P_1453795931084.jpg','images/201601/source_img/179_P_1453795931218.jpg');");
E_D("replace into `ecs_goods_gallery` values('399','180','images/201601/goods_img/180_P_1453796396791.jpg','','images/201601/thumb_img/180_thumb_P_1453796396589.jpg','images/201601/source_img/180_P_1453796396822.jpg');");
E_D("replace into `ecs_goods_gallery` values('400','180','images/201601/goods_img/180_P_1453799375771.jpg','','images/201601/thumb_img/180_thumb_P_1453799375962.jpg','images/201601/source_img/180_P_1453799375734.jpg');");
E_D("replace into `ecs_goods_gallery` values('401','180','images/201601/goods_img/180_P_1453799438065.jpg','','images/201601/thumb_img/180_thumb_P_1453799438946.jpg','images/201601/source_img/180_P_1453799438304.jpg');");
E_D("replace into `ecs_goods_gallery` values('402','181','images/201601/goods_img/181_P_1453800825848.jpg','','images/201601/thumb_img/181_thumb_P_1453800825780.jpg','images/201601/source_img/181_P_1453800825537.jpg');");
E_D("replace into `ecs_goods_gallery` values('403','181','images/201601/goods_img/181_P_1453801378857.jpg','','images/201601/thumb_img/181_thumb_P_1453801378497.jpg','images/201601/source_img/181_P_1453801378695.jpg');");
E_D("replace into `ecs_goods_gallery` values('404','182','images/201601/goods_img/182_P_1453801737683.jpg','','images/201601/thumb_img/182_thumb_P_1453801737854.jpg','images/201601/source_img/182_P_1453801737509.jpg');");
E_D("replace into `ecs_goods_gallery` values('405','182','images/201601/goods_img/182_P_1453802214045.jpg','','images/201601/thumb_img/182_thumb_P_1453802214774.jpg','images/201601/source_img/182_P_1453802214240.jpg');");
E_D("replace into `ecs_goods_gallery` values('406','182','images/201601/goods_img/182_P_1453802237918.jpg','','images/201601/thumb_img/182_thumb_P_1453802237078.jpg','images/201601/source_img/182_P_1453802237752.jpg');");

require("../../inc/footer.php");
?>