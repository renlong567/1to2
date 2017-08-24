/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : qdm106277472_db

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2016-10-14 16:49:34
*/

alter table `ecs_order_info` add column `shipping_weight` decimal(10,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '订单总重';
alter table `ecs_goods` add column `goods_netweight` decimal(10,3) unsigned DEFAULT NULL COMMENT '净重';

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `ecs_airport_order`
-- ----------------------------
DROP TABLE IF EXISTS `ecs_airport_order`;
CREATE TABLE `ecs_airport_order` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `import_time` int(10) NOT NULL DEFAULT '0' COMMENT '导入时间',
  `order_sn` varchar(20) NOT NULL DEFAULT '' COMMENT '订单号',
  `order_addtime` int(10) NOT NULL DEFAULT '0' COMMENT '订单生成时间',
  `pay_time` int(10) NOT NULL DEFAULT '0' COMMENT '支付时间',
  `order_amount` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '订单总费用',
  `goods_amount` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '商品总价',
  `shipping_fee` decimal(10,2) DEFAULT NULL COMMENT '运费',
  `other` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '其他费用',
  `taxfee` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '进口行邮费',
  `country` varchar(10) NOT NULL DEFAULT '156',
  `consignee` varchar(60) NOT NULL DEFAULT '' COMMENT '收货人名称',
  `address` varchar(120) NOT NULL DEFAULT '' COMMENT '收货人地址',
  `mobile` varchar(60) NOT NULL DEFAULT '' COMMENT '收货人电话',
  `consignee_idc` varchar(20) NOT NULL DEFAULT '' COMMENT '证件号码',
  `batchNumbers` char(20) DEFAULT NULL COMMENT '批次号',
  `totalLogisticsNo` char(20) DEFAULT NULL COMMENT '总运单号',
  `note` varchar(255) DEFAULT NULL COMMENT '备注',
  `paymentNo` varchar(50) NOT NULL COMMENT '支付交易号',
  `logisticsNo` varchar(20) DEFAULT NULL COMMENT '物流运单号',
  `transfer_comments` varchar(255) DEFAULT NULL,
  `trackingNo` varchar(20) DEFAULT NULL COMMENT '物流跟踪号',
  `order_status` tinyint(1) NOT NULL DEFAULT '99' COMMENT '1:成功 0:失败 99:未申报',
  `order_comments` varchar(255) DEFAULT NULL,
  `pay_number_status` tinyint(1) NOT NULL DEFAULT '99' COMMENT '1:成功 0:失败 99:未申报',
  `pay_comments` varchar(255) DEFAULT NULL,
  `transfer_status` tinyint(1) NOT NULL DEFAULT '99' COMMENT '1:成功 0:失败 99:未申报',
  `weight` decimal(10,3) NOT NULL DEFAULT '0.000' COMMENT '毛重',
  `netweight` decimal(10,3) NOT NULL DEFAULT '0.000' COMMENT '净重',
  `COUNTOFGOODSTYPE` varchar(10) NOT NULL COMMENT '商品种类数',
  `st_status` tinyint(1) NOT NULL DEFAULT '99' COMMENT '仓储状态,99:未申报',
  `st_comments` varchar(255) DEFAULT NULL COMMENT '仓储回执',
  `st_stock_flag` tinyint(1) DEFAULT NULL COMMENT '集货/备货标识 1集货，2备货',
  `st_entry_time` int(10) NOT NULL DEFAULT '0' COMMENT '��������',
  `category` varchar(255) DEFAULT NULL COMMENT '所属店铺',
  `LMSNO` varchar(20) DEFAULT NULL COMMENT 'S账册号,保税模式必填，一般模式不用填',
  `MANUALNO` varchar(20) DEFAULT NULL COMMENT '关联H2010账册,保税模式必填，一般模式不用填',
  PRIMARY KEY (`id`),
  UNIQUE KEY `orderNo` (`order_sn`),
  KEY `logisticsNo` (`logisticsNo`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=27306 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ecs_airport_order
-- ----------------------------
INSERT INTO `ecs_airport_order` VALUES ('27305', '1462503661', '2016030864907', '1457471334', '1457471384', '203.00', '198.00', '5.00', '0.00', '0.00', '156', 'xie', '北京北京东城区11111', '13321673916', '452502198005083135', '1111111111111', '2222222222222222222', null, '4004004003432343243', '97000343435', '', null, '0', '订单号:2016030864907进口保金保函类型不能为空担保编号不能为空', '99', null, '1', '0.000', '0.000', '', '0', '订单编号已存在', null, '0', null, null, null);
