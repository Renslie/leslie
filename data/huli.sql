/*
Navicat MySQL Data Transfer

Source Server         : 内网
Source Server Version : 50627
Source Host           : 192.168.8.41:3306
Source Database       : huli

Target Server Type    : MYSQL
Target Server Version : 50627
File Encoding         : 65001

Date: 2016-03-05 18:54:02
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for auth_assignment
-- ----------------------------
DROP TABLE IF EXISTS `auth_assignment`;
CREATE TABLE `auth_assignment` (
  `item_name` varchar(64) NOT NULL,
  `user_id` varchar(64) NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`item_name`,`user_id`),
  CONSTRAINT `auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of auth_assignment
-- ----------------------------
INSERT INTO `auth_assignment` VALUES ('管理员', '3', '1456483437');
INSERT INTO `auth_assignment` VALUES ('管理员', '6', '1456483446');
INSERT INTO `auth_assignment` VALUES ('管理员', '7', '1456483442');

-- ----------------------------
-- Table structure for auth_item
-- ----------------------------
DROP TABLE IF EXISTS `auth_item`;
CREATE TABLE `auth_item` (
  `name` varchar(64) NOT NULL,
  `type` int(11) NOT NULL,
  `description` text,
  `rule_name` varchar(64) DEFAULT NULL,
  `data` text,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`),
  KEY `rule_name` (`rule_name`),
  KEY `type` (`type`),
  CONSTRAINT `auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of auth_item
-- ----------------------------
INSERT INTO `auth_item` VALUES ('Admin', '2', '管理员管理', null, null, '1456483326', '1456483326');
INSERT INTO `auth_item` VALUES ('admin/safe', '2', '安全验证', null, null, '1456483326', '1456483326');
INSERT INTO `auth_item` VALUES ('Level', '2', '等级管理', null, null, '1456483326', '1456483326');
INSERT INTO `auth_item` VALUES ('Message', '2', '留言管理', null, null, '1456483326', '1456483326');
INSERT INTO `auth_item` VALUES ('message/safe', '2', '安全验证', null, null, '1456483326', '1456483326');
INSERT INTO `auth_item` VALUES ('news/index', '2', '资讯列表', null, null, '1456483326', '1456483326');
INSERT INTO `auth_item` VALUES ('news/safe', '2', '安全验证', null, null, '1456483326', '1456483326');
INSERT INTO `auth_item` VALUES ('order/safe', '2', '安全验证', null, null, '1456483326', '1456483326');
INSERT INTO `auth_item` VALUES ('orders/index', '2', '首页订单管理', null, null, '1456483326', '1456483326');
INSERT INTO `auth_item` VALUES ('orders/index1', '2', '帮助管理', null, null, '1456483326', '1456483326');
INSERT INTO `auth_item` VALUES ('orders/index2', '2', '订单管理', null, null, '1456483326', '1456483326');
INSERT INTO `auth_item` VALUES ('orders/index3', '2', '异常订单', null, null, '1456483326', '1456483326');
INSERT INTO `auth_item` VALUES ('orders/safe', '2', '安全验证', null, null, '1456483326', '1456483326');
INSERT INTO `auth_item` VALUES ('Role', '2', '角色管理', null, null, '1456483326', '1456483326');
INSERT INTO `auth_item` VALUES ('Rule', '2', '规则管理', null, null, '1456483326', '1456483326');
INSERT INTO `auth_item` VALUES ('User', '2', '用户管理', null, null, '1456483326', '1456483326');
INSERT INTO `auth_item` VALUES ('user/addmoney', '2', '金币增减', null, null, '1456483326', '1456483326');
INSERT INTO `auth_item` VALUES ('user/disable', '2', '封号用户', null, null, '1456483326', '1456483326');
INSERT INTO `auth_item` VALUES ('user/editactive', '2', '激活内容修改', null, null, '1456483326', '1456483326');
INSERT INTO `auth_item` VALUES ('user/fenghao', '2', '封号操作', null, null, '1456483326', '1456483326');
INSERT INTO `auth_item` VALUES ('user/index', '2', '正常用户', null, null, '1456483326', '1456483326');
INSERT INTO `auth_item` VALUES ('user/money-log', '2', null, null, null, null, null);
INSERT INTO `auth_item` VALUES ('user/relate', '2', '会员关系查看', null, null, '1456483326', '1456483326');
INSERT INTO `auth_item` VALUES ('user/safe', '2', '安全验证', null, null, '1456483326', '1456483326');
INSERT INTO `auth_item` VALUES ('user/unactive', '2', '未激活用户列表', null, null, '1456483326', '1456483326');
INSERT INTO `auth_item` VALUES ('管理员', '1', null, null, null, '1456483429', '1456483429');

-- ----------------------------
-- Table structure for auth_item_child
-- ----------------------------
DROP TABLE IF EXISTS `auth_item_child`;
CREATE TABLE `auth_item_child` (
  `parent` varchar(64) NOT NULL,
  `child` varchar(64) NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`),
  CONSTRAINT `auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of auth_item_child
-- ----------------------------
INSERT INTO `auth_item_child` VALUES ('管理员', 'Admin');
INSERT INTO `auth_item_child` VALUES ('管理员', 'Level');
INSERT INTO `auth_item_child` VALUES ('管理员', 'Message');
INSERT INTO `auth_item_child` VALUES ('管理员', 'news/index');
INSERT INTO `auth_item_child` VALUES ('管理员', 'orders/index');
INSERT INTO `auth_item_child` VALUES ('管理员', 'orders/index1');
INSERT INTO `auth_item_child` VALUES ('管理员', 'orders/index2');
INSERT INTO `auth_item_child` VALUES ('管理员', 'orders/index3');
INSERT INTO `auth_item_child` VALUES ('管理员', 'orders/safe');
INSERT INTO `auth_item_child` VALUES ('管理员', 'Role');
INSERT INTO `auth_item_child` VALUES ('管理员', 'Rule');
INSERT INTO `auth_item_child` VALUES ('管理员', 'User');
INSERT INTO `auth_item_child` VALUES ('管理员', 'user/addmoney');
INSERT INTO `auth_item_child` VALUES ('管理员', 'user/disable');
INSERT INTO `auth_item_child` VALUES ('管理员', 'user/editactive');
INSERT INTO `auth_item_child` VALUES ('管理员', 'user/fenghao');
INSERT INTO `auth_item_child` VALUES ('管理员', 'user/index');
INSERT INTO `auth_item_child` VALUES ('管理员', 'user/relate');
INSERT INTO `auth_item_child` VALUES ('管理员', 'user/safe');
INSERT INTO `auth_item_child` VALUES ('管理员', 'user/unactive');

-- ----------------------------
-- Table structure for auth_rule
-- ----------------------------
DROP TABLE IF EXISTS `auth_rule`;
CREATE TABLE `auth_rule` (
  `name` varchar(64) NOT NULL,
  `data` text,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of auth_rule
-- ----------------------------

-- ----------------------------
-- Table structure for hl_admin
-- ----------------------------
DROP TABLE IF EXISTS `hl_admin`;
CREATE TABLE `hl_admin` (
  `admin_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `password` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `create_time` int(11) NOT NULL,
  `login_time` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`admin_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of hl_admin
-- ----------------------------
INSERT INTO `hl_admin` VALUES ('1', 'admin', '$2y$13$Wtrryq2E.R3TfcCcDcoGheaYpS8EBNcB2d4yQUZacy8XMoXEwmcZC', '1899846543', '123456789', '');
INSERT INTO `hl_admin` VALUES ('3', 'leslie', '$2y$13$yZzhH4./3cV3VmWqBq43xudvkFg6gay5jKXEBC8Rv7OxkamjwMag.', '18889984645', '1492667239', null);
INSERT INTO `hl_admin` VALUES ('6', 'huying', '$2y$13$Y2..86d7xhmWJ5CzcLm1xuFO4BeKEUoqxJLBgE34aSHrS.akjl/qO', '13422001851', '1454140918', '1454140918');
INSERT INTO `hl_admin` VALUES ('7', 'wayway', '$2y$13$bRvPvLFbxc5MB4fZWP.MseEfcXU5F0Qpi.6/w/9EQ3h4W9YbldAeS', '18824108680', '1456151489', '1456151489');

-- ----------------------------
-- Table structure for hl_back_money_log
-- ----------------------------
DROP TABLE IF EXISTS `hl_back_money_log`;
CREATE TABLE `hl_back_money_log` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `user_name` varchar(20) DEFAULT NULL,
  `target` varchar(20) NOT NULL,
  `log` varchar(100) NOT NULL,
  `create_time` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of hl_back_money_log
-- ----------------------------
INSERT INTO `hl_back_money_log` VALUES ('1', '13', '朝鲜飞行员', 'admin', '增加了1000金币', '1456303491');
INSERT INTO `hl_back_money_log` VALUES ('2', '1', '湖滨', 'admin', '增加了1000金币', '1456303515');

-- ----------------------------
-- Table structure for hl_bonus_type
-- ----------------------------
DROP TABLE IF EXISTS `hl_bonus_type`;
CREATE TABLE `hl_bonus_type` (
  `bonus_type_id` int(32) NOT NULL AUTO_INCREMENT COMMENT '佣金类别id（1为奖金推荐,2为经理 )）',
  `tx_days` int(32) DEFAULT NULL COMMENT '每月提现次数',
  `money` int(32) DEFAULT NULL COMMENT '每次体现金额',
  `exceed_money` int(32) DEFAULT NULL COMMENT '每轮投资额度超过XX元(既是 每轮已经完成舍的订单的金钱超过XX元),																			就不限制额度跟次数',
  PRIMARY KEY (`bonus_type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of hl_bonus_type
-- ----------------------------
INSERT INTO `hl_bonus_type` VALUES ('1', '5', '3000', '30000');
INSERT INTO `hl_bonus_type` VALUES ('2', '5', '2000', '20000');

-- ----------------------------
-- Table structure for hl_comments
-- ----------------------------
DROP TABLE IF EXISTS `hl_comments`;
CREATE TABLE `hl_comments` (
  `new_id` int(8) unsigned NOT NULL,
  `user_id` int(6) unsigned NOT NULL,
  `content` varchar(255) DEFAULT NULL,
  `create_time` int(20) DEFAULT NULL,
  `cid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `status` int(6) unsigned NOT NULL DEFAULT '0' COMMENT '0为未审核 1为已审核',
  PRIMARY KEY (`cid`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of hl_comments
-- ----------------------------
INSERT INTO `hl_comments` VALUES ('25', '4', '888', '1456370414', '1', '0');
INSERT INTO `hl_comments` VALUES ('25', '4', '888', '1456370415', '2', '0');
INSERT INTO `hl_comments` VALUES ('25', '4', '88哈哈哈', '1456370442', '3', '0');
INSERT INTO `hl_comments` VALUES ('25', '4', '222', '1456372368', '4', '0');
INSERT INTO `hl_comments` VALUES ('26', '4', '3333', '1456376921', '5', '0');
INSERT INTO `hl_comments` VALUES ('25', '15', '655', '1457165755', '6', '0');

-- ----------------------------
-- Table structure for hl_gethelp
-- ----------------------------
DROP TABLE IF EXISTS `hl_gethelp`;
CREATE TABLE `hl_gethelp` (
  `get_id` int(32) NOT NULL AUTO_INCREMENT COMMENT '接受帮助id',
  `user_id` int(32) DEFAULT NULL COMMENT '用户id',
  `money` int(32) DEFAULT NULL COMMENT '接受帮助金额',
  `match_time` int(32) DEFAULT NULL COMMENT '匹配成功时间',
  `create_time` int(32) DEFAULT NULL COMMENT '匹配时间',
  `status` int(32) DEFAULT '1' COMMENT '1为匹配中，2为交易失败，3交易成功',
  `type` int(32) unsigned DEFAULT '1' COMMENT '1,为个人流动钱包，2为推荐奖金流动钱包，3为经理奖金',
  `pay_type` varchar(32) NOT NULL COMMENT '1为支付宝 2微信 3银行卡',
  PRIMARY KEY (`get_id`)
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of hl_gethelp
-- ----------------------------
INSERT INTO `hl_gethelp` VALUES ('1', '15', '300', null, '1455609619', '1', '1', '3');
INSERT INTO `hl_gethelp` VALUES ('2', '4', '3000', null, '1455944972', '1', '1', '3');
INSERT INTO `hl_gethelp` VALUES ('3', '4', '3000', '1455945455', '1455944972', '3', '1', '3');
INSERT INTO `hl_gethelp` VALUES ('4', '7', '1900', null, '1456108229', '1', '1', '3');
INSERT INTO `hl_gethelp` VALUES ('5', '7', '300', '1456302602', '1456109807', '3', '1', '3');
INSERT INTO `hl_gethelp` VALUES ('6', '7', '2000', null, '1456112614', '1', '1', '3');
INSERT INTO `hl_gethelp` VALUES ('7', '7', '2000', null, '1456112614', '1', '1', '3');
INSERT INTO `hl_gethelp` VALUES ('8', '7', '1900', null, '1456112730', '1', '1', '3');
INSERT INTO `hl_gethelp` VALUES ('9', '7', '1900', null, '1456112730', '1', '1', '3');
INSERT INTO `hl_gethelp` VALUES ('10', '13', '300', null, '1456112764', '1', '1', '3');
INSERT INTO `hl_gethelp` VALUES ('11', '13', '300', null, '1456112960', '1', '1', '3');
INSERT INTO `hl_gethelp` VALUES ('12', '13', '300', null, '1456112960', '1', '1', '3');
INSERT INTO `hl_gethelp` VALUES ('13', '13', '300', null, '1456112960', '1', '1', '3');
INSERT INTO `hl_gethelp` VALUES ('14', '13', '300', null, '1456112960', '1', '1', '3');
INSERT INTO `hl_gethelp` VALUES ('15', '13', '300', null, '1456112960', '1', '1', '3');
INSERT INTO `hl_gethelp` VALUES ('16', '13', '300', null, '1456112960', '1', '1', '3');
INSERT INTO `hl_gethelp` VALUES ('17', '13', '300', null, '1456112960', '1', '1', '3');
INSERT INTO `hl_gethelp` VALUES ('18', '13', '300', null, '1456112960', '1', '1', '3');
INSERT INTO `hl_gethelp` VALUES ('19', '13', '300', null, '1456112960', '1', '1', '3');
INSERT INTO `hl_gethelp` VALUES ('20', '7', '300', null, '1456113079', '1', '1', '3');
INSERT INTO `hl_gethelp` VALUES ('21', '7', '300', null, '1456113080', '1', '1', '3');
INSERT INTO `hl_gethelp` VALUES ('22', '4', '300', null, '1456113342', '1', '1', '3');
INSERT INTO `hl_gethelp` VALUES ('23', '4', '300', null, '1456113342', '1', '1', '3');
INSERT INTO `hl_gethelp` VALUES ('24', '4', '300', null, '1456113344', '1', '1', '3');
INSERT INTO `hl_gethelp` VALUES ('25', '4', '300', null, '1456113344', '1', '1', '3');
INSERT INTO `hl_gethelp` VALUES ('26', '4', '300', null, '1456113344', '1', '1', '1,2,3');
INSERT INTO `hl_gethelp` VALUES ('27', '4', '600', null, '1456114059', '1', '1', '3');
INSERT INTO `hl_gethelp` VALUES ('28', '4', '800', null, '1456114075', '1', '1', '3');
INSERT INTO `hl_gethelp` VALUES ('29', '5', '3000', null, '1456117055', '1', '1', '3');
INSERT INTO `hl_gethelp` VALUES ('30', '5', '3000', null, '1456117055', '1', '1', '3');
INSERT INTO `hl_gethelp` VALUES ('31', '5', '3000', null, '1456117106', '1', '1', '3');
INSERT INTO `hl_gethelp` VALUES ('32', '5', '1000', null, '1456117155', '1', '1', '3');
INSERT INTO `hl_gethelp` VALUES ('33', '4', '700', null, '1456122305', '1', '1', '3');
INSERT INTO `hl_gethelp` VALUES ('34', '15', '300', '1456209096', '1456208848', '3', '1', '1');
INSERT INTO `hl_gethelp` VALUES ('35', '4', '500', null, '1456214540', '1', '1', '1');
INSERT INTO `hl_gethelp` VALUES ('36', '4', '300', null, '1456219468', '1', '1', '1');
INSERT INTO `hl_gethelp` VALUES ('37', '4', '400', '1456288387', '1456287121', '3', '1', '1');
INSERT INTO `hl_gethelp` VALUES ('38', '4', '3000', null, '1456288763', '2', '1', '1');
INSERT INTO `hl_gethelp` VALUES ('39', '5', '300', '1456385508', '1456304793', '3', '1', '1,2,3');
INSERT INTO `hl_gethelp` VALUES ('40', '4', '3000', null, '1456556270', '1', '2', '1,2,3');
INSERT INTO `hl_gethelp` VALUES ('41', '4', '2000', null, '1456556279', '1', '3', '1,2,3');
INSERT INTO `hl_gethelp` VALUES ('42', '4', '500', null, '1456556364', '1', '1', '1,2,3');
INSERT INTO `hl_gethelp` VALUES ('43', '4', '3000', null, '1456559603', '1', '2', '1,2,3');
INSERT INTO `hl_gethelp` VALUES ('44', '4', '2000', null, '1456566195', '1', '3', '1,2');
INSERT INTO `hl_gethelp` VALUES ('45', '4', '2000', null, '1456566249', '1', '3', '2,3');
INSERT INTO `hl_gethelp` VALUES ('46', '4', '2000', null, '1456566261', '1', '3', '1,2');
INSERT INTO `hl_gethelp` VALUES ('47', '4', '800', null, '1457161385', '1', '1', '2');
INSERT INTO `hl_gethelp` VALUES ('48', '4', '500', null, '1457161414', '1', '1', '1');
INSERT INTO `hl_gethelp` VALUES ('49', '4', '500', null, '1457161568', '1', '1', '3');
INSERT INTO `hl_gethelp` VALUES ('50', '4', '600', null, '1457161842', '1', '1', '3');
INSERT INTO `hl_gethelp` VALUES ('51', '4', '400', null, '1457161853', '1', '1', '1');

-- ----------------------------
-- Table structure for hl_gethelp_rule
-- ----------------------------
DROP TABLE IF EXISTS `hl_gethelp_rule`;
CREATE TABLE `hl_gethelp_rule` (
  `grid` int(32) unsigned NOT NULL COMMENT '得到帮助规则id',
  `mlutiple` int(11) DEFAULT NULL,
  `min_money` int(32) DEFAULT NULL COMMENT '提供最小金额',
  `max_money` int(32) DEFAULT NULL COMMENT '金额上限',
  `help_money_month` int(32) DEFAULT NULL COMMENT '每月提供帮助总额度',
  `after_recive_days` int(32) DEFAULT NULL COMMENT '每次接受帮助N天后，可进行第二次接受帮助',
  PRIMARY KEY (`grid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of hl_gethelp_rule
-- ----------------------------
INSERT INTO `hl_gethelp_rule` VALUES ('1', '100', '300', '3000', '100000', '0');

-- ----------------------------
-- Table structure for hl_ip
-- ----------------------------
DROP TABLE IF EXISTS `hl_ip`;
CREATE TABLE `hl_ip` (
  `id` int(32) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(16) NOT NULL COMMENT '记录ip 地址',
  `create_time` varchar(11) DEFAULT NULL,
  `count` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of hl_ip
-- ----------------------------
INSERT INTO `hl_ip` VALUES ('1', '192.168.1.1', '123456789', '1');
INSERT INTO `hl_ip` VALUES ('2', '127.0.0.1', '123456987', '2');
INSERT INTO `hl_ip` VALUES ('3', '119.130.187.171', '1455883943', '0');
INSERT INTO `hl_ip` VALUES ('4', '119.130.99.229', '1455946609', '1');
INSERT INTO `hl_ip` VALUES ('5', '119.130.185.191', '1456107481', '3');
INSERT INTO `hl_ip` VALUES ('6', '119.130.186.222', '1456112410', '0');
INSERT INTO `hl_ip` VALUES ('7', '119.130.186.112', '1456208628', '0');
INSERT INTO `hl_ip` VALUES ('8', '::1', '1456566767', '0');

-- ----------------------------
-- Table structure for hl_jihuo_prompt
-- ----------------------------
DROP TABLE IF EXISTS `hl_jihuo_prompt`;
CREATE TABLE `hl_jihuo_prompt` (
  `id` int(10) NOT NULL COMMENT '激活提示id',
  `content` text COMMENT '激活内容',
  `get_time` float DEFAULT NULL COMMENT '收款时间（天）',
  `pay_time` float DEFAULT NULL COMMENT '打款时间（天）',
  `limt_time` float DEFAULT NULL COMMENT '匹配中（天）',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of hl_jihuo_prompt
-- ----------------------------
INSERT INTO `hl_jihuo_prompt` VALUES ('1', '<p style=\"text-align: center;\"><span style=\"font-family: 微软雅黑, &#39;Microsoft YaHei&#39;; font-size: 20px;\"><strong>开通会员请用关注微信公众号：huyingbd</strong></span></p><p style=\"text-align: center;\"><span style=\"font-family: 微软雅黑, &#39;Microsoft YaHei&#39;; font-size: 20px;\"><strong>或直接扫描下方二维码</strong></span></p><p style=\"text-align: center;\"><img src=\"/huhui_back/web/upload/20160220272520.jpg\" title=\"20160220272520.jpg\" alt=\"QQ图片20160220132803.jpg\" width=\"247\" height=\"242\" style=\"width: 247px; height: 242px;\"/></p>', '1.5', '2', '1');

-- ----------------------------
-- Table structure for hl_level
-- ----------------------------
DROP TABLE IF EXISTS `hl_level`;
CREATE TABLE `hl_level` (
  `level_id` int(32) unsigned NOT NULL AUTO_INCREMENT COMMENT '等级表',
  `name` varchar(32) DEFAULT NULL COMMENT '等级名称',
  `tz_money` int(32) unsigned DEFAULT '0' COMMENT '投资金额',
  `recommend` int(32) unsigned DEFAULT '0' COMMENT '推荐人数',
  `commission` text NOT NULL COMMENT '{"count":3,"num":[1,2,3]} 佣金格式 json格式，count为可获取的代数，num为代数及所对应的数量',
  `bonus_type` int(32) DEFAULT NULL COMMENT '佣金类别（1为推荐奖金，2为经理奖金）',
  `next_money_less` int(32) DEFAULT NULL COMMENT '如下级一个会员投资额度减少，对该会员的佣金减少额度（%）：',
  `month_money_less` int(32) DEFAULT NULL COMMENT '月投资金额减少，扣除本月佣金奖励额度（%）',
  PRIMARY KEY (`level_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of hl_level
-- ----------------------------
INSERT INTO `hl_level` VALUES ('1', 'vip会员', '0', '0', '{\"count\":4,\"num\":[\"1\",\"2\",\"3\",\"4\"]}', '1', '5', '5');
INSERT INTO `hl_level` VALUES ('2', '黄金会员', '0', '8', '{\"count\":3,\"num\":[\"1\",\"2\",\"3\"]}', '1', '0', '0');
INSERT INTO `hl_level` VALUES ('3', '铂金会员', '5000', '8', '{\"count\":3,\"num\":[1,2,3]}', '1', '10', '0');
INSERT INTO `hl_level` VALUES ('5', '最强会员', '10086', '50', '{\"count\":3,\"num\":[\"1\",\"2\",\"50\"]}', '2', '1', '2');

-- ----------------------------
-- Table structure for hl_message
-- ----------------------------
DROP TABLE IF EXISTS `hl_message`;
CREATE TABLE `hl_message` (
  `mess_id` int(32) NOT NULL AUTO_INCREMENT COMMENT '留言id',
  `user_id` int(32) DEFAULT NULL COMMENT '用户id',
  `title` varchar(255) DEFAULT NULL COMMENT '留言标题',
  `target_id` int(32) DEFAULT '0' COMMENT '留言用户的id ----0为管理员留言',
  `content` varchar(255) DEFAULT NULL COMMENT '留言内容',
  `img` varchar(255) DEFAULT NULL COMMENT '留言图片',
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1未处理，2为已经处理',
  `type` tinyint(4) NOT NULL DEFAULT '2' COMMENT '1.通知用户的留言,  2为（联系我们模块）的留言',
  `create_time` int(11) unsigned DEFAULT NULL COMMENT '留言时间',
  `error_type` varchar(4) DEFAULT '1' COMMENT '1为未浏览 2为已浏览 浏览标识',
  `parent_id` int(32) DEFAULT '0' COMMENT '回复的信息id  0为首条信息',
  PRIMARY KEY (`mess_id`)
) ENGINE=InnoDB AUTO_INCREMENT=90 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of hl_message
-- ----------------------------
INSERT INTO `hl_message` VALUES ('1', '4', null, '5', 'ggg', '/huhui_weixin/web/upload/2016020218365331022.jpg', '3', '1', '1454409413', '1', '0');
INSERT INTO `hl_message` VALUES ('2', '5', null, '4', '7777', null, '3', '1', '1454409433', '1', '0');
INSERT INTO `hl_message` VALUES ('3', '4', null, '5', '', '/huhui_weixin/web/upload/2016020218404265116.png', '3', '1', '1454409642', '1', '0');
INSERT INTO `hl_message` VALUES ('4', '5', null, '4', '7773', null, '3', '1', '1454409670', '1', '0');
INSERT INTO `hl_message` VALUES ('5', '4', null, '5', 'uu', '/huhui_weixin/web/upload/2016020315570242128.jpg', '3', '1', '1454486222', '1', '0');
INSERT INTO `hl_message` VALUES ('6', '5', null, '4', 'ii', null, '3', '1', '1454486246', '1', '0');
INSERT INTO `hl_message` VALUES ('7', '4', null, '5', 'yy', '/huhui_weixin/web/upload/2016020316063068356.jpg', '3', '1', '1454486790', '1', '0');
INSERT INTO `hl_message` VALUES ('8', '5', null, '4', '7778889990000', null, '3', '1', '1454486827', '1', '0');
INSERT INTO `hl_message` VALUES ('9', '4', 'yyy', '0', '尼玛波', '/huhui_weixin/web/upload/2016020316194675839.jpg', '1', '2', null, '系统错误', '0');
INSERT INTO `hl_message` VALUES ('10', '4', 'yyy', '0', '尼玛波', '/huhui_weixin/web/upload/2016020316222410841.jpg', '1', '2', null, '坑爹吧', '0');
INSERT INTO `hl_message` VALUES ('11', '4', '后台回复', '0', '负分 滚粗···', null, '3', '1', '1454487786', '1', '0');
INSERT INTO `hl_message` VALUES ('12', '4', null, '0', '尼玛波', null, '1', '2', '1454487802', '用户留言', '0');
INSERT INTO `hl_message` VALUES ('13', '4', '啊啊啊', '0', '来撸了', '/huhui_weixin/web/upload/2016020316322948090.jpg', '1', '2', null, '系统错误', '0');
INSERT INTO `hl_message` VALUES ('14', '4', 'dfgd', '0', 'sdgsdfsdf', '/huhui_weixin/web/upload/2016021922263050645.jpg', '1', '2', null, '系统错误', '0');
INSERT INTO `hl_message` VALUES ('15', '4', null, '0', 'ch', '/huhui_weixin/web/upload/2016022011014989064.jpg', '2', '2', '1455937309', '用户留言', '0');
INSERT INTO `hl_message` VALUES ('16', '4', null, '5', '', '/huhui_weixin/web/upload/2016022013141859925.jpg', '3', '1', '1455945258', '1', '0');
INSERT INTO `hl_message` VALUES ('17', '5', null, '4', '怎样，回个话呗。', null, '3', '1', '1455945341', '用户留言', '0');
INSERT INTO `hl_message` VALUES ('18', '5', null, '4', '没有收到', null, '3', '1', '1455945455', '1', '0');
INSERT INTO `hl_message` VALUES ('19', '4', null, '5', '卵咯', null, '3', '1', '1455945583', '用户留言', '0');
INSERT INTO `hl_message` VALUES ('20', '7', '123123', '0', '123', '/huhui_weixin/web/upload/2016022016383063065.jpg', '1', '2', null, '系统错误', '0');
INSERT INTO `hl_message` VALUES ('21', '4', '后台回复', '0', '什么', null, '3', '1', '1455961225', '1', '0');
INSERT INTO `hl_message` VALUES ('22', '4', '后台回复', '0', '忆 ', null, '3', '1', '1455961233', '1', '0');
INSERT INTO `hl_message` VALUES ('23', '4', null, '5', '收到请确认', '/huhui_weixin/web/upload/2016022214031469611.png', '3', '1', '1456120994', '1', '0');
INSERT INTO `hl_message` VALUES ('24', '5', null, '4', '西瓜', null, '3', '1', '1456128434', '用户留言', '0');
INSERT INTO `hl_message` VALUES ('25', '4', null, '5', '瓜瓜\r\n', null, '3', '1', '1456132681', '用户留言', '0');
INSERT INTO `hl_message` VALUES ('26', '5', null, '4', '西西', null, '3', '1', '1456138249', '2', '0');
INSERT INTO `hl_message` VALUES ('27', '15', null, '14', '', null, '3', '1', '1456209030', '2', '0');
INSERT INTO `hl_message` VALUES ('28', '14', null, '15', '111', null, '3', '1', '1456209096', '1', '0');
INSERT INTO `hl_message` VALUES ('29', '15', null, '14', '膜', null, '3', '1', '1456225630', '用户留言', '0');
INSERT INTO `hl_message` VALUES ('30', '7', null, '1', '', null, '1', '1', '1456286229', '1', '0');
INSERT INTO `hl_message` VALUES ('31', '4', null, '14', '摸一下', '/huhui_weixin/web/upload/2016022412204612107.jpeg', '3', '1', '1456287646', '1', '0');
INSERT INTO `hl_message` VALUES ('32', '4', '', '0', '', null, '1', '2', null, '系统错误', '0');
INSERT INTO `hl_message` VALUES ('33', '14', null, '4', 'ggg', null, '3', '1', '1456288387', '1', '0');
INSERT INTO `hl_message` VALUES ('34', '4', '后台回复', '0', 'mmm', null, '3', '1', '1456290830', '1', '0');
INSERT INTO `hl_message` VALUES ('35', '1', null, '7', '123123', null, '1', '1', '1456302602', '1', '0');
INSERT INTO `hl_message` VALUES ('36', '4', null, '5', '', '/huhui_weixin/web/upload/2016022416310835802.jpeg', '3', '1', '1456302668', '1', '0');
INSERT INTO `hl_message` VALUES ('37', '4', '123', '0', '123', '/huhui_weixin/web/upload/2016022416575192854.JPG', '1', '2', null, '1', '0');
INSERT INTO `hl_message` VALUES ('38', '4', 'aaa', '0', 'ggg', '/huhui_weixin/web/upload/2016022417103624721.JPG', '1', '2', null, '1', '0');
INSERT INTO `hl_message` VALUES ('39', '5', null, '4', '22', '/huhui_weixin/web/upload/2016022417141116796.JPG', '3', '1', '1456305251', '1', '0');
INSERT INTO `hl_message` VALUES ('40', '4', '后台回复', '0', 'chhhhhhhhhhhhhhhhhhhhhhhhhhhhhh!', null, '3', '1', '1456368521', '1', '0');
INSERT INTO `hl_message` VALUES ('41', '4', null, '5', '123456', null, '3', '1', '1456385508', '1', '0');
INSERT INTO `hl_message` VALUES ('42', '5', null, '4', 'ttt', '/huhui_weixin/web/upload/2016022515362516595.JPG', '3', '1', '1456385785', '2', '0');
INSERT INTO `hl_message` VALUES ('43', '5', '888', '0', '8888', '/huhui_pc/web/upload/201602251249110205.jpeg', '1', '2', null, '1', '0');
INSERT INTO `hl_message` VALUES ('44', '5', '888', '0', '8888', '/huhui_pc/web/upload/2016022572644405.jpeg', '1', '2', null, '1', '0');
INSERT INTO `hl_message` VALUES ('45', '5', '8888', '0', '8888', '/huhui_pc/web/upload/20160225162614935.jpeg', '1', '2', null, '1', '0');
INSERT INTO `hl_message` VALUES ('46', '5', null, '4', '888', '/huhui_pc/web/upload/2016022546887465.jpeg', '3', '1', '1456392039', '2', '0');
INSERT INTO `hl_message` VALUES ('47', '4', '888', '0', '88', '/huhui_weixin/web/upload/201602252100213768.jpeg', '1', '2', null, '1', '0');
INSERT INTO `hl_message` VALUES ('48', '4', '888', '0', '88', '/huhui_weixin/web/upload/201602251484237124.jpeg', '1', '2', null, '1', '0');
INSERT INTO `hl_message` VALUES ('49', '5', null, '4', 'yyyy', '/huhui_weixin/web/upload/20160225968816878.jpeg', '3', '1', '1456392713', '2', '0');
INSERT INTO `hl_message` VALUES ('50', '4', null, '5', '8888', null, '3', '1', '1456393044', '用户留言', '0');
INSERT INTO `hl_message` VALUES ('51', '4', null, '5', '5555', null, '3', '1', '1456393177', '用户留言', '0');
INSERT INTO `hl_message` VALUES ('52', '5', null, '4', '888', null, '3', '1', '1456393256', '2', '0');
INSERT INTO `hl_message` VALUES ('53', '5', null, '4', '8888', '/huhui_weixin/web/upload/201602251542788478.jpeg', '3', '1', '1456393528', '2', '0');
INSERT INTO `hl_message` VALUES ('54', '4', null, '5', '888', '/huhui_weixin/web/upload/201602251349027022.jpeg', '3', '1', '1456393556', '用户留言', '0');
INSERT INTO `hl_message` VALUES ('55', '4', '后台回复', '0', '1111111111111111111111111111', null, '1', '1', '1456474081', '1', '0');
INSERT INTO `hl_message` VALUES ('56', '4', '后台回复', '0', '哈哈哈哈哈哈', null, '1', '1', '1456474385', '1', '0');
INSERT INTO `hl_message` VALUES ('57', '4', '后台回复', '0', '5555555555555555555555', null, '1', '1', '1456474423', '1', '0');
INSERT INTO `hl_message` VALUES ('58', '4', '后台回复', '0', '88888888888888888888888888888888888888', null, '1', '1', '1456474591', '1', '0');
INSERT INTO `hl_message` VALUES ('59', '4', null, '5', 'jjjjjjjjjjjj', null, '1', '1', '1456475272', '2', '0');
INSERT INTO `hl_message` VALUES ('60', '4', null, '5', 'kkk', '/huhui_weixin/web/upload/20160226966625871.jpeg', '1', '1', '1456475282', '2', '0');
INSERT INTO `hl_message` VALUES ('61', '4', 'www', '0', 'www', '/huhui_weixin/web/upload/201602261412762201.jpeg', '1', '2', null, '1', '0');
INSERT INTO `hl_message` VALUES ('62', '4', '88888', '0', '88', '/huhui_weixin/web/upload/20160226480719209.jpeg', '1', '2', null, '1', '0');
INSERT INTO `hl_message` VALUES ('63', '4', '后台回复', '0', '222', null, '1', '1', '1456475521', '1', '0');
INSERT INTO `hl_message` VALUES ('64', '4', '后台回复', '0', '222', null, '1', '1', '1456475522', '1', '0');
INSERT INTO `hl_message` VALUES ('65', '4', '后台回复', '0', '222', null, '1', '1', '1456475523', '1', '0');
INSERT INTO `hl_message` VALUES ('66', '4', '后台回复', '0', '222', null, '1', '1', '1456475524', '2', '0');
INSERT INTO `hl_message` VALUES ('67', '4', '后台回复', '0', '222', null, '1', '1', '1456475524', '1', '0');
INSERT INTO `hl_message` VALUES ('68', '4', '后台回复', '0', 'ffff', null, '1', '1', '1456475533', '2', '0');
INSERT INTO `hl_message` VALUES ('69', '4', '8888', '0', '8888', '/huhui_pc/web/upload/20160226445633548.jpeg', '1', '2', null, '1', '0');
INSERT INTO `hl_message` VALUES ('70', '4', '8888', '0', '8888888', '/huhui_weixin/web/upload/201602261716533899.jpeg', '1', '2', null, '1', '0');
INSERT INTO `hl_message` VALUES ('71', '4', '6666666', '0', 'iii', '/huhui_weixin/web/upload/201602261234827126.jpeg', '1', '2', null, '1', '0');
INSERT INTO `hl_message` VALUES ('72', '5', null, '4', '222', '/huhui_weixin/web/upload/201602261878490740.jpeg', '1', '1', '1456475734', '2', '0');
INSERT INTO `hl_message` VALUES ('73', '4', '8888', '0', '888', '/huhui_weixin/web/upload/201602261405184094.jpeg', '1', '2', '1456475858', '1', '0');
INSERT INTO `hl_message` VALUES ('74', '4', '777', '0', '777', '/huhui_pc/web/upload/201602265562713.jpeg', '1', '2', '1456475885', '1', '0');
INSERT INTO `hl_message` VALUES ('75', '4', '22', '0', '22', '/huhui_pc/web/upload/20160226166355721.jpeg', '2', '2', '1456476084', '1', '0');
INSERT INTO `hl_message` VALUES ('76', '4', '后台回复', '0', '55555555555555555555555555555555555', null, '1', '1', '1456476135', '2', '0');
INSERT INTO `hl_message` VALUES ('77', '4', '88888888', '0', '888', '/huhui_weixin/web/upload/20160226336913658.jpeg', '2', '2', '1456477012', '1', '0');
INSERT INTO `hl_message` VALUES ('78', '4', '后台回复', '0', '999', null, '1', '1', '1456477019', '2', '0');
INSERT INTO `hl_message` VALUES ('79', '4', '后台回复', '0', '999', null, '1', '1', '1456477019', '2', '0');
INSERT INTO `hl_message` VALUES ('80', '4', null, '0', '888', '/huhui_weixin/web/upload/201602261095905750.jpeg', '1', '2', '1456477470', '1', '78');
INSERT INTO `hl_message` VALUES ('81', '5', null, '4', 'mm', '/huhui_weixin/web/upload/201602261303922928.jpeg', '1', '1', '1456477504', '1', '0');
INSERT INTO `hl_message` VALUES ('82', '4', '后台信息', '0', 'hello wold', null, '1', '1', '1456478440', '2', '0');
INSERT INTO `hl_message` VALUES ('83', '4', null, '0', '6546456', '/huhui_weixin/web/upload/201602261949634151.jpeg', '2', '2', '1456481690', '1', '82');
INSERT INTO `hl_message` VALUES ('84', '4', '后台信息', '0', '111111111111111111111111111111', null, '1', '1', '1456481716', '2', '83');
INSERT INTO `hl_message` VALUES ('85', '4', null, '0', '2222 ', null, '1', '2', '1456481724', '1', '84');
INSERT INTO `hl_message` VALUES ('86', '5', null, '4', '888', '/huhui_pc/web/upload/201602271865699769.jpeg', '1', '1', '1456555621', '1', '0');
INSERT INTO `hl_message` VALUES ('87', '5', null, '4', '', '/huhui_weixin/web/upload/20160227363493505.jpeg', '1', '1', '1456555752', '2', '0');
INSERT INTO `hl_message` VALUES ('88', '4', null, '5', '88888', '/huhui_weixin/web/upload/201603051396456592.jpeg', '1', '1', '1457169124', '2', '0');
INSERT INTO `hl_message` VALUES ('89', '4', null, '5', '2312312', '/huhui_pc/web/upload/20160305588623690.jpeg', '1', '1', '1457169493', '2', '0');

-- ----------------------------
-- Table structure for hl_money_log
-- ----------------------------
DROP TABLE IF EXISTS `hl_money_log`;
CREATE TABLE `hl_money_log` (
  `log_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `desc` varchar(100) NOT NULL COMMENT '说明，此记录的来源',
  `old_money` int(10) unsigned DEFAULT NULL COMMENT '原金额',
  `new_money` int(10) unsigned DEFAULT NULL COMMENT '操作的后的金额 即新金额',
  `handle` varchar(255) DEFAULT NULL COMMENT '操作的金额',
  `create_time` int(11) DEFAULT NULL COMMENT '记录创建时间',
  PRIMARY KEY (`log_id`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of hl_money_log
-- ----------------------------
INSERT INTO `hl_money_log` VALUES ('1', '4', '接受帮助操作', '500000', '498000', '-2000', '1454409433');
INSERT INTO `hl_money_log` VALUES ('2', '5', '提现操作', '0', '2000', '+2000', '1454409450');
INSERT INTO `hl_money_log` VALUES ('3', '4', '推荐奖金提现', '30000', '27000', '-3000', '1454409670');
INSERT INTO `hl_money_log` VALUES ('4', '5', '提现操作', '2000', '5000', '+3000', '1454409693');
INSERT INTO `hl_money_log` VALUES ('5', '4', '接受帮助操作', '498000', '495000', '-3000', '1454486246');
INSERT INTO `hl_money_log` VALUES ('6', '4', '推荐奖金提现', '27060', '24060', '-3000', '1454486827');
INSERT INTO `hl_money_log` VALUES ('7', '5', '提现操作', '5000', '8000', '+3000', '1454486843');
INSERT INTO `hl_money_log` VALUES ('8', '5', '提现操作', '8000', '11000', '+3000', '1454486847');
INSERT INTO `hl_money_log` VALUES ('9', '1', '提现操作', '0', '300', '+300', '1455541416');
INSERT INTO `hl_money_log` VALUES ('10', '4', '提现操作', '0', '3000', '+3000', '1455609582');
INSERT INTO `hl_money_log` VALUES ('11', '4', '提现操作', '3000', '6000', '+3000', '1455679065');
INSERT INTO `hl_money_log` VALUES ('12', '3', '提现操作', '0', '303', '+303', '1455727788');
INSERT INTO `hl_money_log` VALUES ('13', '4', '提现操作', '6000', '9060', '+3060', '1455802737');
INSERT INTO `hl_money_log` VALUES ('14', '7', '提现操作', '0', '500', '+500', '1455891754');
INSERT INTO `hl_money_log` VALUES ('15', '4', '接受帮助操作', '19060', '16060', '-3000', '1455945455');
INSERT INTO `hl_money_log` VALUES ('16', '7', '提现操作', '500', '800', '+300', '1456108081');
INSERT INTO `hl_money_log` VALUES ('17', '7', '提现操作', '800', '1200', '+400', '1456108125');
INSERT INTO `hl_money_log` VALUES ('18', '7', '提现操作', '1200', '1500', '+300', '1456108130');
INSERT INTO `hl_money_log` VALUES ('19', '7', '提现操作', '1500', '1900', '+400', '1456108134');
INSERT INTO `hl_money_log` VALUES ('20', '5', '提现操作', '0', '303', '+303', '1456116908');
INSERT INTO `hl_money_log` VALUES ('21', '5', '提现操作', '303', '3453', '+3150', '1456116915');
INSERT INTO `hl_money_log` VALUES ('22', '5', '提现操作', '3453', '6483', '+3030', '1456116998');
INSERT INTO `hl_money_log` VALUES ('23', '5', '提现操作', '6483', '9513', '+3030', '1456117001');
INSERT INTO `hl_money_log` VALUES ('24', '5', '提现操作', '9513', '9816', '+303', '1456117006');
INSERT INTO `hl_money_log` VALUES ('25', '5', '提现操作', '9816', '10816', '+1000', '1456117011');
INSERT INTO `hl_money_log` VALUES ('26', '10', '提现操作', '0', '300', '+300', '1456129150');
INSERT INTO `hl_money_log` VALUES ('27', '10', '提现操作', '300', '600', '+300', '1456129256');
INSERT INTO `hl_money_log` VALUES ('28', '4', '提现操作', '16060', '16460', '+400', '1456130815');
INSERT INTO `hl_money_log` VALUES ('29', '4', '提现操作', '16460', '19460', '+3000', '1456143745');
INSERT INTO `hl_money_log` VALUES ('30', '15', '接受帮助操作', '10000', '9700', '-300', '1456209096');
INSERT INTO `hl_money_log` VALUES ('31', '4', '接受帮助操作', '19460', '19060', '-400', '1456288387');
INSERT INTO `hl_money_log` VALUES ('32', '7', '接受帮助操作', '22300', '22000', '-300', '1456302602');
INSERT INTO `hl_money_log` VALUES ('33', '5', '提现操作', '10816', '12016', '+1200', '1456309985');
INSERT INTO `hl_money_log` VALUES ('34', '5', '提现操作', '12016', '13516', '+1500', '1456310026');
INSERT INTO `hl_money_log` VALUES ('35', '5', '接受帮助操作', '13516', '13216', '-300', '1456385508');
INSERT INTO `hl_money_log` VALUES ('36', '4', '提现操作', '19060', '19366', '+306', '1456484004');

-- ----------------------------
-- Table structure for hl_news
-- ----------------------------
DROP TABLE IF EXISTS `hl_news`;
CREATE TABLE `hl_news` (
  `news_id` int(32) NOT NULL AUTO_INCREMENT COMMENT '公告id',
  `title` varchar(255) DEFAULT NULL COMMENT '公告标题',
  `content` text COMMENT '公告内容',
  `cover` varchar(255) DEFAULT NULL COMMENT '头像',
  `type` tinyint(4) DEFAULT NULL COMMENT '1为新闻,2为帮助',
  `create_time` int(32) unsigned DEFAULT NULL COMMENT '发布时间',
  PRIMARY KEY (`news_id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of hl_news
-- ----------------------------
INSERT INTO `hl_news` VALUES ('1', '新人入门高级手册（经典）', '<p>第一步：~~~~~</p><p>第二步：xxxxx</p><p>第三步：ddddd<br/></p>', '/huhui_back/web/upload/20160224775690.jpg', '1', '1456304934');
INSERT INTO `hl_news` VALUES ('25', '娱乐', '<p style=\"margin-top: 0px; margin-bottom: 25px; padding: 0px; text-indent: 28px;\"><a href=\"http://ent.ifeng.com/music/mainland/detail_2010_04/11/518586_0.shtml\" target=\"_blank\" style=\"text-decoration: none; color: rgb(0, 66, 118); font-weight: bold;\">汪峰</a><a href=\"http://app.ent.ifeng.com/star/3222\" target=\"_blank\" style=\"text-decoration: none; color: rgb(0, 66, 118); font-weight: bold;\">章子怡</a>的爱女满月了！</p><p style=\"margin-top: 0px; margin-bottom: 25px; padding: 0px; text-indent: 28px;\">昨天下午，章子怡在微博用女儿口吻打招呼：“Hello爸爸妈妈的朋友们：我是醒醒小盆友，今天我满月啦!!! 玩了一下午，现在要去呼呼了！”</p><p style=\"margin-top: 0px; margin-bottom: 25px; padding: 0px; text-indent: 28px; text-align: center;\"><img src=\"http://y1.ifengimg.com/haina/2016_05/98dc4650eb7922e_w463_h376.jpg\" width=\"500\" height=\"406\" alt=\"\" style=\"border: 0px; vertical-align: bottom; display: block; margin: 0px auto;\"/></p><p style=\"margin-top: 0px; margin-bottom: 25px; padding: 0px; text-indent: 28px;\">照片中，女儿包着尿不湿，露出肉肉小腿。还有女儿满月生日会的蛋糕等，当了妈妈之后的子怡少女心爆棚。</p><p style=\"margin-top: 0px; margin-bottom: 25px; padding: 0px; text-indent: 28px; text-align: center;\"><img src=\"http://y1.ifengimg.com/haina/2016_05/4bc346d16987e2e_w472_h588.jpg\" width=\"401\" height=\"500\" alt=\"\" style=\"border: 0px; vertical-align: bottom; display: block; margin: 0px auto;\"/></p><p style=\"margin-top: 0px; margin-bottom: 25px; padding: 0px; text-indent: 28px; text-align: center;\"><img src=\"http://y1.ifengimg.com/haina/2016_05/8ae8f06235d697b_w459_h582.jpg\" width=\"394\" height=\"500\" alt=\"\" style=\"border: 0px; vertical-align: bottom; display: block; margin: 0px auto;\"/></p><p style=\"margin-top: 0px; margin-bottom: 25px; padding: 0px; text-indent: 28px; text-align: center;\"><img src=\"http://y1.ifengimg.com/haina/2016_05/7513ba02c507bbb_w477_h480.jpg\" width=\"497\" height=\"500\" alt=\"\" style=\"border: 0px; vertical-align: bottom; display: block; margin: 0px auto;\"/></p><p style=\"margin-top: 0px; margin-bottom: 25px; padding: 0px; text-indent: 28px;\">随后，<a href=\"http://app.ent.ifeng.com/star/2609\" target=\"_blank\" style=\"text-decoration: none; color: rgb(0, 66, 118); font-weight: bold;\">汪峰</a>转发微博亲昵呼唤女儿乳名：醒醒~</p><p style=\"margin-top: 0px; margin-bottom: 25px; padding: 0px; text-indent: 28px; text-align: center;\"><img src=\"http://y1.ifengimg.com/haina/2016_05/0b33f142e13f3cb_w544_h336.jpg\" width=\"550\" height=\"340\" alt=\"\" style=\"border: 0px; vertical-align: bottom; display: block; margin: 0px auto;\"/></p><p style=\"margin-top: 0px; margin-bottom: 25px; padding: 0px; text-indent: 28px;\">这名字太吸引人注意了，一时间网友都在好奇，子怡和汪峰为什么给女儿取名叫醒醒？难道是为了不睡懒觉吗？</p><p style=\"margin-top: 0px; margin-bottom: 25px; padding: 0px; text-indent: 28px;\">小妹（微信号：entifengvip）看到一些好玩的评论~</p><p style=\"margin-top: 0px; margin-bottom: 25px; padding: 0px; text-indent: 28px; text-align: center;\"><img src=\"http://y1.ifengimg.com/haina/2016_05/1b9a78a7f989c12_w532_h64.jpg\" width=\"550\" height=\"66\" alt=\"\" style=\"border: 0px; vertical-align: bottom; display: block; margin: 0px auto;\"/></p><p style=\"margin-top: 0px; margin-bottom: 25px; padding: 0px; text-indent: 28px; text-align: center;\"><img src=\"http://y1.ifengimg.com/haina/2016_05/72c9ea32563dd4d_w592_h86.jpg\" width=\"550\" height=\"80\" alt=\"\" style=\"border: 0px; vertical-align: bottom; display: block; margin: 0px auto;\"/></p><p style=\"margin-top: 0px; margin-bottom: 25px; padding: 0px; text-indent: 28px; text-align: center;\"><img src=\"http://y1.ifengimg.com/haina/2016_05/bcf4e2d80b109fe_w483_h56.jpg\" width=\"550\" height=\"64\" alt=\"\" style=\"border: 0px; vertical-align: bottom; display: block; margin: 0px auto;\"/></p><p style=\"margin-top: 0px; margin-bottom: 25px; padding: 0px; text-indent: 28px; text-align: center;\"><img src=\"http://y1.ifengimg.com/haina/2016_05/df1db905473f155_w481_h55.jpg\" width=\"550\" height=\"63\" alt=\"\" style=\"border: 0px; vertical-align: bottom; display: block; margin: 0px auto;\"/></p><p style=\"margin-top: 0px; margin-bottom: 25px; padding: 0px; text-indent: 28px; text-align: center;\"><img src=\"http://y1.ifengimg.com/haina/2016_05/059c6a0de63689f_w424_h59.jpg\" width=\"550\" height=\"77\" alt=\"\" style=\"border: 0px; vertical-align: bottom; display: block; margin: 0px auto;\"/></p><p style=\"margin-top: 0px; margin-bottom: 25px; padding: 0px; text-indent: 28px; text-align: center;\"><img src=\"http://y1.ifengimg.com/haina/2016_05/501db33bf95b31a_w511_h54.jpg\" width=\"550\" height=\"58\" alt=\"\" style=\"border: 0px; vertical-align: bottom; display: block; margin: 0px auto;\"/></p><p style=\"margin-top: 0px; margin-bottom: 25px; padding: 0px; text-indent: 28px; text-align: center;\"><img src=\"http://y1.ifengimg.com/haina/2016_05/563dd990f30acab_w451_h55.jpg\" width=\"550\" height=\"67\" alt=\"\" style=\"border: 0px; vertical-align: bottom; display: block; margin: 0px auto;\"/></p><p style=\"margin-top: 0px; margin-bottom: 25px; padding: 0px; text-indent: 28px;\">明星的孩子从出世起就备受人们关注，宝宝的名字也为人津津乐道。提到给孩子取名字这事，明星们总是创意无限，给孩子起的名字也是颇费心思。</p><p style=\"margin-top: 0px; margin-bottom: 25px; padding: 0px; text-indent: 28px;\">一起来看看，这些明星家宝宝的小名都是怎么来的？</p><p style=\"margin-top: 0px; margin-bottom: 25px; padding: 0px; text-indent: 28px;\"><strong><a href=\"http://app.ent.ifeng.com/star/3220\" target=\"_blank\" style=\"text-decoration: none; color: rgb(0, 66, 118);\">赵薇</a>女儿：小四月</strong></p><p style=\"margin-top: 0px; margin-bottom: 25px; padding: 0px; text-indent: 28px; text-align: center;\"><img src=\"http://y1.ifengimg.com/haina/2016_05/890180e483b9530_w293_h220.jpg\" alt=\"\" style=\"border: 0px; vertical-align: bottom; display: block; margin: 0px auto;\"/></p><p style=\"margin-top: 0px; margin-bottom: 25px; padding: 0px; text-indent: 28px; text-align: center;\"><img src=\"http://y1.ifengimg.com/haina/2016_05/429bb85b46ab22d_w500_h450.jpg\" width=\"500\" height=\"450\" alt=\"\" style=\"border: 0px; vertical-align: bottom; display: block; margin: 0px auto;\"/></p><p style=\"margin-top: 0px; margin-bottom: 25px; padding: 0px; text-indent: 28px;\">赵薇于2010年4月11日在新加坡生下女儿，由于当时赵薇的保密工作做得好，大家都无从得知赵薇女儿的名字。因宝宝四月出生，所以赵薇的粉丝们给宝宝起了个很清新独特的名字“小四月”，四月是一个美好的时节，有一树一树的花开，有梁间呢喃的春燕，有出芽后的新绿，雪化后的鹅黄。</p><p style=\"margin-top: 0px; margin-bottom: 25px; padding: 0px; text-indent: 28px;\">所以小四月其实是粉丝起的名字呢~</p><p style=\"margin-top: 0px; margin-bottom: 25px; padding: 0px; text-indent: 28px;\"><strong><a href=\"http://app.ent.ifeng.com/star/2180\" target=\"_blank\" style=\"text-decoration: none; color: rgb(0, 66, 118);\">孙俪</a>邓超儿子：等等</strong></p><p style=\"margin-top: 0px; margin-bottom: 25px; padding: 0px; text-indent: 28px; text-align: center;\"><img src=\"http://y1.ifengimg.com/haina/2016_05/effcbd1e131d022_w550_h357.jpg\" width=\"500\" height=\"325\" alt=\"\" style=\"border: 0px; vertical-align: bottom; display: block; margin: 0px auto;\"/></p><p style=\"margin-top: 0px; margin-bottom: 25px; padding: 0px; text-indent: 28px; text-align: center;\"><img src=\"http://y1.ifengimg.com/haina/2016_05/9e387eb9d00dc5d_w469_h289.jpg\" width=\"500\" height=\"308\" alt=\"\" style=\"border: 0px; vertical-align: bottom; display: block; margin: 0px auto;\"/></p><p style=\"margin-top: 0px; margin-bottom: 25px; padding: 0px; text-indent: 28px;\">孙俪于2011年11月12日喜得爱子，小名叫等等。</p><p style=\"margin-top: 0px; margin-bottom: 25px; padding: 0px; text-indent: 28px;\">其实孙俪给儿子起这个名字有很深的内涵在里面，孙俪表示“这个小名早在他出生前就想好了，取《心经》中的一句‘是无等等咒’，有很多含义。现在生活节奏这么快，我们希望能等一等慢一点；老公姓邓，听上去又像‘邓邓’……”</p><p style=\"margin-top: 0px; margin-bottom: 25px; padding: 0px; text-indent: 28px;\">但是这个名字也给等等带来了误会。</p><p style=\"margin-top: 0px; margin-bottom: 25px; padding: 0px; text-indent: 28px;\">孙俪曾在微博讲述，带着儿子去早教班报名，老师问小孩的名字要做登记。</p><p style=\"margin-top: 0px; margin-bottom: 25px; padding: 0px; text-indent: 28px;\">孙俪回答道：等等。</p><p style=\"margin-top: 0px; margin-bottom: 25px; padding: 0px; text-indent: 28px;\">老师说：喔。</p><p style=\"margin-top: 0px; margin-bottom: 25px; padding: 0px; text-indent: 28px;\">然后过了很久老师又问道：请问小孩叫什么？，孙俪又答：等等。</p><p style=\"margin-top: 0px; margin-bottom: 25px; padding: 0px; text-indent: 28px;\">老师说：这小孩的名字很麻烦吗？</p><p style=\"margin-top: 0px; margin-bottom: 25px; padding: 0px; text-indent: 28px;\">孙俪和<a href=\"http://app.ent.ifeng.com/star/425\" target=\"_blank\" style=\"text-decoration: none; color: rgb(0, 66, 118); font-weight: bold;\">邓超</a>答道：就叫等等呀。</p><p style=\"margin-top: 0px; margin-bottom: 25px; padding: 0px; text-indent: 28px;\">老师顿时一脸黑。</p><p style=\"margin-top: 0px; margin-bottom: 25px; padding: 0px; text-indent: 28px;\"><strong><a href=\"http://app.ent.ifeng.com/star/2553\" target=\"_blank\" style=\"text-decoration: none; color: rgb(0, 66, 118);\">吴尊</a>女儿：NEI NEI</strong></p><p style=\"margin-top: 0px; margin-bottom: 25px; padding: 0px; text-indent: 28px; text-align: center;\"><img src=\"http://y1.ifengimg.com/haina/2016_05/92c15400d7e686e_w500_h375.jpg\" width=\"500\" height=\"375\" alt=\"\" style=\"border: 0px; vertical-align: bottom; display: block; margin: 0px auto;\"/></p><p style=\"margin-top: 0px; margin-bottom: 25px; padding: 0px; text-indent: 28px; text-align: center;\"><img src=\"http://y1.ifengimg.com/haina/2016_05/06262deeb07dc1b_w605_h519.jpg\" width=\"500\" height=\"429\" alt=\"\" style=\"border: 0px; vertical-align: bottom; display: block; margin: 0px auto;\"/></p><p style=\"margin-top: 0px; margin-bottom: 25px; padding: 0px; text-indent: 28px;\">2014年，吴尊女儿NEI NEI因《爸爸回来了》人气大增，吴尊透露这个小名是女儿自己想的，因为她很喜欢喝奶奶，觉得NEI NEI这个名字和奶奶同音又可爱，还勒令全家人都这么叫她。</p><p style=\"margin-top: 0px; margin-bottom: 25px; padding: 0px; text-indent: 28px;\"><strong><a href=\"http://app.ent.ifeng.com/star/2976\" target=\"_blank\" style=\"text-decoration: none; color: rgb(0, 66, 118);\">杨幂</a>刘恺威女儿：小糯米</strong></p><p style=\"margin-top: 0px; margin-bottom: 25px; padding: 0px; text-indent: 28px; text-align: center;\"><img src=\"http://y1.ifengimg.com/haina/2016_05/e84f34373e70e90_w300_h300.jpg\" alt=\"\" style=\"border: 0px; vertical-align: bottom; display: block; margin: 0px auto;\"/></p><p style=\"margin-top: 0px; margin-bottom: 25px; padding: 0px; text-indent: 28px; text-align: center;\"><img src=\"http://y1.ifengimg.com/haina/2016_05/6f4df17bf69c09a_w515_h468.jpg\" width=\"500\" height=\"454\" alt=\"\" style=\"border: 0px; vertical-align: bottom; display: block; margin: 0px auto;\"/></p><p style=\"margin-top: 0px; margin-bottom: 25px; padding: 0px; text-indent: 28px;\"><a href=\"http://app.ent.ifeng.com/star/1414\" target=\"_blank\" style=\"text-decoration: none; color: rgb(0, 66, 118); font-weight: bold;\">刘恺威</a>与杨幂的爱女在6月1日诞生，因为“小女神”于端午节前夕出世，一出世便有粽子吃，明星爹妈便暂时为她取乳名“小糯米”，有了一个色香味俱全的小名。</p><p style=\"margin-top: 0px; margin-bottom: 25px; padding: 0px; text-indent: 28px;\"><strong><a href=\"http://app.ent.ifeng.com/star/204\" target=\"_blank\" style=\"text-decoration: none; color: rgb(0, 66, 118);\">陈慧琳</a>儿子：虾饺仔</strong></p><p style=\"margin-top: 0px; margin-bottom: 25px; padding: 0px; text-indent: 28px; text-align: center;\"><img src=\"http://y1.ifengimg.com/haina/2016_05/2d98a2cd276a954_w409_h464.jpg\" width=\"441\" height=\"500\" alt=\"\" style=\"border: 0px; vertical-align: bottom; display: block; margin: 0px auto;\"/></p><p style=\"margin-top: 0px; margin-bottom: 25px; padding: 0px; text-indent: 28px; text-align: center;\"><img src=\"http://y1.ifengimg.com/haina/2016_05/eabf07cd7bd6c01_w585_h445.jpg\" width=\"500\" height=\"380\" alt=\"\" style=\"border: 0px; vertical-align: bottom; display: block; margin: 0px auto;\"/></p><p style=\"margin-top: 0px; margin-bottom: 25px; padding: 0px; text-indent: 28px;\">陈慧琳有两个儿子，大儿子叫“虾饺仔”，这个名字原来是误打误撞来的。陈慧琳刚生完宝宝受访时，她形容孩子的下巴很像虾饺，结果第二天刊登出来孩子的名字就成了“虾饺仔”。</p><p style=\"margin-top: 0px; margin-bottom: 25px; padding: 0px; text-indent: 28px;\">不过，她似乎也对茶点类小名上瘾，因为小儿子是龙年生，干脆就叫“小龙包”，她还笑说：“又不想叫他烧卖。”</p><p style=\"margin-top: 0px; margin-bottom: 25px; padding: 0px; text-indent: 28px;\"><strong><a href=\"http://app.ent.ifeng.com/star/3254\" target=\"_blank\" style=\"text-decoration: none; color: rgb(0, 66, 118);\">朱茵</a>黄贯中女儿：叉烧包</strong></p><p style=\"margin-top: 0px; margin-bottom: 25px; padding: 0px; text-indent: 28px; text-align: center;\"><img src=\"http://y1.ifengimg.com/haina/2016_05/ad0eebe106389c6_w342_h220.jpg\" alt=\"\" style=\"border: 0px; vertical-align: bottom; display: block; margin: 0px auto;\"/></p><p style=\"margin-top: 0px; margin-bottom: 25px; padding: 0px; text-indent: 28px;\">2012年，<a href=\"http://app.ent.ifeng.com/star/909\" target=\"_blank\" style=\"text-decoration: none; color: rgb(0, 66, 118); font-weight: bold;\">黄贯中</a>发微博宣布朱茵产下一女，取小名“叉烧包”，这位星爸还笑说：“好靓的新鲜出炉的叉烧包！ ”</p><p style=\"margin-top: 0px; margin-bottom: 25px; padding: 0px; text-indent: 28px;\">后来朱茵透露女儿大名“黄莺”，“莺”是智慧之鸟，英文名则是Debbie，因为黄贯中很欣赏外国女歌手Debbie。</p><p style=\"margin-top: 0px; margin-bottom: 25px; padding: 0px; text-indent: 28px;\"><strong><a href=\"http://app.ent.ifeng.com/star/791\" target=\"_blank\" style=\"text-decoration: none; color: rgb(0, 66, 118);\">黄磊</a>女儿：多多</strong></p><p style=\"margin-top: 0px; margin-bottom: 25px; padding: 0px; text-indent: 28px; text-align: center;\"><img src=\"http://y1.ifengimg.com/haina/2016_05/b2cd81ade08b66c_w550_h503.jpg\" width=\"500\" height=\"457\" alt=\"\" style=\"border: 0px; vertical-align: bottom; display: block; margin: 0px auto;\"/></p><p style=\"margin-top: 0px; margin-bottom: 25px; padding: 0px; text-indent: 28px;\">黄磊和<a href=\"http://app.ent.ifeng.com/star/3822\" target=\"_blank\" style=\"text-decoration: none; color: rgb(0, 66, 118); font-weight: bold;\">孙莉</a>都是演员，他们希望自己的女儿能够完全遗传父母的才艺，多才多艺，同时，还要多福多寿，总之什么都要多，因此取名多多。</p><p style=\"margin-top: 0px; margin-bottom: 25px; padding: 0px; text-indent: 28px;\"><strong><a href=\"http://app.ent.ifeng.com/star/1395\" target=\"_blank\" style=\"text-decoration: none; color: rgb(0, 66, 118);\">刘欢</a>女儿：丝丝</strong></p><p style=\"margin-top: 0px; margin-bottom: 25px; padding: 0px; text-indent: 28px; text-align: center;\"><img src=\"http://y1.ifengimg.com/haina/2016_05/b070b310ddaecd2_w350_h400.jpg\" alt=\"\" style=\"border: 0px; vertical-align: bottom; display: block; margin: 0px auto;\"/></p><p style=\"margin-top: 0px; margin-bottom: 25px; padding: 0px; text-indent: 28px;\">刘欢的女儿叫刘一丝，小名丝丝，1991年生，说起女儿这个奇怪的名字，刘欢说来自“一丝不挂”，不过可别想歪了，刘欢曾解释说：“一丝不挂原是佛家用语，讲的是心境，是很高的修行。”</p><p style=\"margin-top: 0px; margin-bottom: 25px; padding: 0px; text-indent: 28px;\"><strong><a href=\"http://app.ent.ifeng.com/star/2219\" target=\"_blank\" style=\"text-decoration: none; color: rgb(0, 66, 118);\">沙溢</a>胡可儿子：安吉</strong></p><p style=\"margin-top: 0px; margin-bottom: 25px; padding: 0px; text-indent: 28px; text-align: center;\"><img src=\"http://y1.ifengimg.com/haina/2016_05/df521e0fb9451d8_w482_h588.jpg\" width=\"410\" height=\"500\" alt=\"\" style=\"border: 0px; vertical-align: bottom; display: block; margin: 0px auto;\"/></p><p style=\"margin-top: 0px; margin-bottom: 25px; padding: 0px; text-indent: 28px;\">沙溢<a href=\"http://app.ent.ifeng.com/star/805\" target=\"_blank\" style=\"text-decoration: none; color: rgb(0, 66, 118); font-weight: bold;\">胡可</a>儿子的小名叫安吉。说起为什么会给儿子起名安吉，沙溢自个儿说：“安吉这个名字其实就是取‘平安吉祥’的字意，也是我们对孩子未来的一种祈愿。”</p><p style=\"margin-top: 0px; margin-bottom: 25px; padding: 0px; text-indent: 28px;\"><strong><a href=\"http://app.ent.ifeng.com/star/246\" target=\"_blank\" style=\"text-decoration: none; color: rgb(0, 66, 118);\">陈可辛</a>吴君如女儿：小肥鸡</strong></p><p style=\"margin-top: 0px; margin-bottom: 25px; padding: 0px; text-indent: 28px; text-align: center;\"><img src=\"http://y1.ifengimg.com/haina/2016_05/9620fdd0dba269c_w550_h359.jpg\" width=\"500\" height=\"326\" alt=\"\" style=\"border: 0px; vertical-align: bottom; display: block; margin: 0px auto;\"/></p><p style=\"margin-top: 0px; margin-bottom: 25px; padding: 0px; text-indent: 28px;\">从怀孕开始就一直相当低调的<a href=\"http://app.ent.ifeng.com/star/2592\" target=\"_blank\" style=\"text-decoration: none; color: rgb(0, 66, 118); font-weight: bold;\">吴君如</a>夫妇，对于女儿的名字发愁，后来因为吴君如主演《金鸡》，因此吴君如直接用“小肥鸡”作为爱女的的昵称。但是小时候可以这么叫，长大了这个小绰号会给小朋友带来烦恼。吴君如和陈可辛后来给女儿起了一个颇有内涵的名字陈是知。</p><p style=\"margin-top: 0px; margin-bottom: 25px; padding: 0px; text-indent: 28px;\"><strong><a href=\"http://app.ent.ifeng.com/star/2190\" target=\"_blank\" style=\"text-decoration: none; color: rgb(0, 66, 118);\">孙燕姿</a>儿子：纳小子</strong></p><p style=\"margin-top: 0px; margin-bottom: 25px; padding: 0px; text-indent: 28px; text-align: center;\"><img src=\"http://y1.ifengimg.com/haina/2016_05/8435bf1c8860154_w520_h388.jpg\" width=\"500\" height=\"373\" alt=\"\" style=\"border: 0px; vertical-align: bottom; display: block; margin: 0px auto;\"/></p><p style=\"margin-top: 0px; margin-bottom: 25px; padding: 0px; text-indent: 28px; text-align: center;\"><img src=\"http://y1.ifengimg.com/haina/2016_05/e67cc467ccd5691_w512_h520.jpg\" width=\"492\" height=\"500\" alt=\"\" style=\"border: 0px; vertical-align: bottom; display: block; margin: 0px auto;\"/></p><p style=\"margin-top: 0px; margin-bottom: 25px; padding: 0px; text-indent: 28px;\">孙燕姿的老公叫纳迪姆，当她产下儿子时，网友建议她为儿子起名“纳么帅”，不过孙燕姿自己喜欢的小名是“纳小子”，觉得很有个性。</p><p style=\"margin-top: 0px; margin-bottom: 25px; padding: 0px; text-indent: 28px;\"><strong><a href=\"http://app.ent.ifeng.com/star/1298\" target=\"_blank\" style=\"text-decoration: none; color: rgb(0, 66, 118);\">李念</a>女儿：小酸奶</strong></p><p style=\"margin-top: 0px; margin-bottom: 25px; padding: 0px; text-indent: 28px; text-align: center;\"><img src=\"http://y1.ifengimg.com/haina/2016_05/094dfd0634578e2_w500_h248.jpg\" width=\"500\" height=\"248\" alt=\"\" style=\"border: 0px; vertical-align: bottom; display: block; margin: 0px auto;\"/></p><p style=\"margin-top: 0px; margin-bottom: 25px; padding: 0px; text-indent: 28px;\">2012年1月25日大年初三李念便在微博中向网友们报喜称小女jessica 出生6斤8两！一个多月后李念于3月1日首次在微博上曝光了女儿的小名“酸奶”，网友得知李念宝宝的小名之后纷纷赞“念麻麻”很有创意，并称是个很乖的名字，还有网友自告奋勇称我家宝宝叫红豆，十分搭配。</p><p style=\"margin-top: 0px; margin-bottom: 25px; padding: 0px; text-indent: 28px;\"><strong>李静女儿：木耳</strong></p><p style=\"margin-top: 0px; margin-bottom: 25px; padding: 0px; text-indent: 28px; text-align: center;\"><img src=\"http://y1.ifengimg.com/haina/2016_05/3f2698ce12fea21_w192_h220.jpg\" alt=\"\" style=\"border: 0px; vertical-align: bottom; display: block; margin: 0px auto;\"/></p><p style=\"margin-top: 0px; margin-bottom: 25px; padding: 0px; text-indent: 28px;\">李静和黄晓茂曾经给女儿取名为“黄木耳”，李静透露：“当时还没想好大名，就想起个特别好玩的小名，觉得这个名字特别可爱，一想到木耳就觉得可爱。后来木耳改成了沐尔，沐是给，尔是你，希望长大成为一个懂得分享的孩子。”</p><p style=\"margin-top: 0px; margin-bottom: 25px; padding: 0px; text-indent: 28px;\"><strong>小S女儿：许俏妞</strong></p><p style=\"margin-top: 0px; margin-bottom: 25px; padding: 0px; text-indent: 28px; text-align: center;\"><img src=\"http://y1.ifengimg.com/haina/2016_05/10076531cd7e427_w422_h461.jpg\" width=\"458\" height=\"500\" alt=\"\" style=\"border: 0px; vertical-align: bottom; display: block; margin: 0px auto;\"/></p><p style=\"margin-top: 0px; margin-bottom: 25px; padding: 0px; text-indent: 28px;\">眼看小S家的许老三将要降生，不知小S到时会给许老三起一个怎样有趣的名字。不管怎样小S已经为许老大起了一个十分带劲的名字。2006年1月16日小S诞下女儿，许老大还还未出世就已经</p><p style=\"margin-top: 0px; margin-bottom: 25px; padding: 0px; text-indent: 28px;\">成为了众所周知的小明星。聪明的小S给大女儿起了一个“俏妞”这个略带“无赖”性质的名字，对宝贝的一声呼唤便是一句赞美。</p><p style=\"margin-top: 0px; margin-bottom: 25px; padding: 0px; text-indent: 28px;\"><strong>袁泉夏雨女儿：哈哈</strong></p><p style=\"margin-top: 0px; margin-bottom: 25px; padding: 0px; text-indent: 28px; text-align: center;\"><img src=\"http://y1.ifengimg.com/haina/2016_05/bedd9166ab0e02a_w696_h511.jpg\" width=\"500\" height=\"367\" alt=\"\" style=\"border: 0px; vertical-align: bottom; display: block; margin: 0px auto;\"/></p><p style=\"margin-top: 0px; margin-bottom: 25px; padding: 0px; text-indent: 28px;\">袁泉和夏雨同为中戏校友，在学校中相识、相知、相恋，共同走过了10年多的情路。而后结婚，随即怀孕，经过一夜奋战，孩子顺产，母女平安，一家三口成了。看看这个家庭来得多么容易，怪不得袁泉顺口就叫女儿“哈哈。”</p><p style=\"margin-top: 0px; margin-bottom: 25px; padding: 0px; text-indent: 28px;\"><strong>吴京谢楠儿子：吴所谓</strong></p><p style=\"margin-top: 0px; margin-bottom: 25px; padding: 0px; text-indent: 28px; text-align: center;\"><img src=\"http://y1.ifengimg.com/haina/2016_05/53ddcfb7a3da0bd_w486_h256.jpg\" width=\"500\" height=\"263\" alt=\"\" style=\"border: 0px; vertical-align: bottom; display: block; margin: 0px auto;\"/></p><p style=\"margin-top: 0px; margin-bottom: 25px; padding: 0px; text-indent: 28px;\">吴京和谢楠所生的孩子于2014年出生，男孩取名“吴所谓”。吴京曾在孩子出生前表示：男孩就叫“吴所谓”，女孩就叫“吴懈可击”。不过也可能只是小名，真叫“吴所谓”那就真佩服京哥的勇气。</p><p style=\"margin-top: 0px; margin-bottom: 25px; padding: 0px; text-indent: 28px;\">这些名字，小妹（微信号：entifengvip）觉得有些还是寓意深刻、创意十足的，但有一些真是莫名其妙，好像就是一时间拍脑袋想的一样嘛~<span class=\"ifengLogo\"><a href=\"http://www.ifeng.com/\" target=\"_blank\" style=\"text-decoration: none; color: rgb(0, 66, 118); font-weight: bold;\"><img src=\"http://y2.ifengimg.com/a/2015/0708/icon_logo.gif\" style=\"border: 0px; vertical-align: top; display: inline; margin: 0px; padding-top: 3px;\"/></a></span></p><p><img src=\"http://y3.ifengimg.com/a/2015/1118/detailQrcode.jpg\" style=\"border: 0px; vertical-align: bottom;\"/></p><p class=\"iphone_none\" style=\"margin-top: 0px; margin-bottom: 0px; padding: 0px; float: left; width: 322px;\">[责任编辑：张路桥 PK018]</p><p class=\"p01 ss_none\" style=\"margin-top: 0px; margin-bottom: 0px; padding: 8px 0px 0px; line-height: 18px; color: rgb(102, 102, 102); float: left; width: 322px;\">标签：<a href=\"http://search.ifeng.com/sofeng/search.action?c=1&q=%E5%A5%B3%E5%84%BF\" target=\"_blank\" style=\"text-decoration: none; color: rgb(126, 154, 201);\">女儿</a>&nbsp;<a href=\"http://search.ifeng.com/sofeng/search.action?c=1&q=%E5%B0%8F%E5%90%8D\" target=\"_blank\" style=\"text-decoration: none; color: rgb(126, 154, 201);\">小名</a>&nbsp;<a href=\"http://search.ifeng.com/sofeng/search.action?c=1&q=%E6%9D%A8%E5%B9%82\" target=\"_blank\" style=\"text-decoration: none; color: rgb(126, 154, 201);\">杨幂</a></p><p><iframe class=\"miniseebox js_weixin_iframe\" frameborder=\"0\" scrolling=\"no\" src=\"about:blank\" style=\"width: 232px; height: 0px; position: absolute; left: -73px; bottom: 42px; z-index: 102;\"></iframe></p><p><img src=\"http://h2.ifengimg.com/0f56ee67a4c375c2/2013/1106/indeccode.png\" class=\"js_wx_qrcod\" style=\"border: 0px; vertical-align: bottom; width: 86px; height: 86px; float: left; margin-right: 14px;\"/></p><p style=\"margin-top: 0px; margin-bottom: 0px; padding: 12px 0px 0px; float: left; width: auto; color: rgb(102, 102, 102); line-height: 24px; font-size: 12px;\"><br/></p><p><a class=\"bds_tsina js_content_share_btn\" data-type=\"sina\" data-fid=\"f9069e31e59\" style=\"color: rgb(43, 43, 43); float: left; display: block; width: 36px; height: 30px; margin: 0px; padding: 0px; font-family: simsun, arial, helvetica, clean, sans-serif; font-size: 12px; white-space: normal; background: url(&quot;http://y2.ifengimg.com/e01ed39fc2da5d4a/2014/0317/sharebg.gif&quot;) 0px 0px no-repeat rgb(255, 255, 255);\"></a><a class=\"bds_qzone js_content_share_btn\" data-type=\"qqZone\" data-fid=\"f4a14d74b00\" style=\"color: rgb(43, 43, 43); float: left; display: block; width: 36px; height: 30px; margin: 0px; padding: 0px; font-family: simsun, arial, helvetica, clean, sans-serif; font-size: 12px; white-space: normal; background: url(&quot;http://y2.ifengimg.com/e01ed39fc2da5d4a/2014/0317/sharebg.gif&quot;) 0px -39px no-repeat rgb(255, 255, 255);\"></a></p><p><br/></p>', '/huhui_back/web/upload/20160129606502.jpg', '1', '21');
INSERT INTO `hl_news` VALUES ('26', '三打白骨精', '<h1 itemprop=\"headline\" id=\"artical_topic\" style=\"margin: 0px; padding: 0px 0px 20px; font-size: 24px; font-stretch: normal; font-family: 宋体; letter-spacing: -1.5px;\">《三打白骨精》郭富城：此生演次孙悟空，无憾！</h1><p class=\"p_time\" style=\"margin-top: 0px; margin-bottom: 0px; padding: 0px; float: left; width: 250px; color: rgb(153, 153, 153); line-height: 22px;\"><span itemprop=\"datePublished\" class=\"ss01\">2016年01月29日 08:47</span><br/><span class=\"ss02\">来源：</span><span itemprop=\"publisher\" itemscope=\"\" itemtype=\"http://schema.org/Organization\"><span itemprop=\"name\" class=\"ss03\"><a href=\"http://www.bjnews.com.cn/ent/2016/01/29/393182.html\" itemprop=\"isBasedOnUrl\" target=\"_blank\" ref=\"nofollow\" style=\"text-decoration: none; color: rgb(128, 128, 128);\">新京报</a></span></span>&nbsp;<span itemprop=\"author\" itemscope=\"\" itemtype=\"http://schema.org/Person\" class=\"ss04\">作者：<span itemprop=\"name\">安莹 田颖</span></span></p><p><iframe class=\"miniseebox js_weixin_iframe\" frameborder=\"0\" scrolling=\"no\" src=\"about:blank\" style=\"width: 232px; height: 0px; position: absolute; left: -73px; bottom: 42px; z-index: 102;\"></iframe></p><p><img src=\"http://h2.ifengimg.com/0f56ee67a4c375c2/2013/1106/indeccode.png\" class=\"js_wx_qrcod\" style=\"border: 0px; vertical-align: bottom; width: 86px; height: 86px; float: left; margin-right: 14px;\"/></p><p style=\"margin-top: 0px; margin-bottom: 0px; padding: 12px 0px 0px; float: left; width: auto; color: rgb(102, 102, 102); line-height: 24px; font-size: 12px;\"><br/></p><p><a class=\"bds_tsina js_content_share_btn\" data-type=\"sina\" data-fid=\"fdd8f41d906\" style=\"color: rgb(43, 43, 43); float: left; display: block; width: 36px; height: 30px; margin: 0px; padding: 0px; background-image: url(&quot;http://y2.ifengimg.com/e01ed39fc2da5d4a/2014/0317/sharebg.gif&quot;); background-attachment: initial; background-size: initial; background-origin: initial; background-clip: initial; background-position: 0px 0px; background-repeat: no-repeat;\"></a><a class=\"bds_qzone js_content_share_btn\" data-type=\"qqZone\" data-fid=\"f6ee6f1b036\" style=\"color: rgb(43, 43, 43); float: left; display: block; width: 36px; height: 30px; margin: 0px; padding: 0px; background-image: url(&quot;http://y2.ifengimg.com/e01ed39fc2da5d4a/2014/0317/sharebg.gif&quot;); background-attachment: initial; background-size: initial; background-origin: initial; background-clip: initial; background-position: 0px -39px; background-repeat: no-repeat;\"></a><a class=\"bds_twx js_content_share_btn\" data-type=\"weixin\" data-fid=\"f13e32ca0f7\" style=\"color: rgb(43, 43, 43); float: left; display: block; width: 36px; height: 30px; margin: 0px; padding: 0px; background-image: url(&quot;http://y2.ifengimg.com/e01ed39fc2da5d4a/2014/0317/sharebg.gif&quot;); background-attachment: initial; background-size: initial; background-origin: initial; background-clip: initial; background-position: 0px -115px; background-repeat: no-repeat;\"></a></p><h5 class=\"cmt js_commentCount\" id=\"js_commentCount_top\" style=\"margin: 0px; padding: 22px 0px 0px; font-size: 12px; float: right; font-weight: normal; text-align: right; color: rgb(153, 153, 153);\"><span class=\"ss_none\" style=\"cursor: pointer; height: 13px; margin-right: 10px;\"><a href=\"http://gentie.ifeng.com/view.html?docUrl=http%3A%2F%2Fent.ifeng.com%2Fa%2F20160129%2F42570198_0.shtml&docName=%E3%80%8A%E4%B8%89%E6%89%93%E7%99%BD%E9%AA%A8%E7%B2%BE%E3%80%8B%E9%83%AD%E5%AF%8C%E5%9F%8E%EF%BC%9A%E6%AD%A4%E7%94%9F%E6%BC%94%E6%AC%A1%E5%AD%99%E6%82%9F%E7%A9%BA%EF%BC%8C%E6%97%A0%E6%86%BE%EF%BC%81&skey=a9a150\" target=\"_blank\" class=\"js_joinUrl js_peopleNumber\" id=\"\" style=\"text-decoration: none; color: rgb(245, 67, 67); font-weight: bold;\"><span class=\"js_joinNum\" style=\"font-family: Georgia; font-size: 16px;\">28</span><span style=\"color: rgb(153, 153, 153); font-weight: lighter; cursor: pointer; height: 13px; margin-right: 10px;\">人参与</span></a>&nbsp;</span><a href=\"http://gentie.ifeng.com/view.html?docUrl=http%3A%2F%2Fent.ifeng.com%2Fa%2F20160129%2F42570198_0.shtml&docName=%E3%80%8A%E4%B8%89%E6%89%93%E7%99%BD%E9%AA%A8%E7%B2%BE%E3%80%8B%E9%83%AD%E5%AF%8C%E5%9F%8E%EF%BC%9A%E6%AD%A4%E7%94%9F%E6%BC%94%E6%AC%A1%E5%AD%99%E6%82%9F%E7%A9%BA%EF%BC%8C%E6%97%A0%E6%86%BE%EF%BC%81&skey=a9a150\" target=\"_blank\" class=\"js_cmtUrl js_commentNumber\" id=\"\" style=\"text-decoration: none; color: rgb(245, 67, 67); font-weight: bold;\"><span class=\"js_cmtNum\" style=\"font-family: Georgia; font-size: 16px;\">12</span><span class=\"ss_none\" style=\"color: rgb(153, 153, 153); font-weight: lighter; cursor: pointer; height: 13px; margin-right: 10px;\">评论</span></a></h5><p class=\"detailPic\" style=\"margin: 0px auto 10px; padding: 0px; text-indent: 28px; text-align: center;\"><img src=\"http://y2.ifengimg.com/haina/2016_05/7183c97db90b91f_w400_h599.jpg\" alt=\"\" style=\"border: 0px; vertical-align: bottom; display: block; margin: 0px auto;\"/></p><p class=\"picIntro\" style=\"margin-top: 0px; margin-bottom: 25px; padding: 0px; text-align: center; font-family: 楷体_gb2312, 楷体;\">郭富城</p><p style=\"margin-top: 0px; margin-bottom: 25px; padding: 0px; text-indent: 28px;\">接演孙悟空，对任何一位演员来说，都会是天平上惊喜与压力双重考验，对于两届金马影帝的<a href=\"http://app.ent.ifeng.com/star/618\" target=\"_blank\" style=\"text-decoration: none; color: rgb(0, 66, 118); font-weight: bold;\">郭富城</a>也不例外，“不能去毁了大家对你的信心，更是我对观众的承诺”。在拍摄现场，因为化装不易，他连饮食都不能达到常人所需，实在太饿就只能吃些花生米或薯条充饥，为了拍好打戏，带着腿伤坚持没日没夜地练习。因为在他看来，自己和孙悟空有着太多精神共鸣，“不妥协不解释，跟我也是蛮像的，做事勇往直前，不惜一切去做好一个工作，有一种使命感”。</p><p style=\"margin-top: 0px; margin-bottom: 25px; padding: 0px; text-indent: 28px;\"><strong>重装上阵</strong></p><p style=\"margin-top: 0px; margin-bottom: 25px; padding: 0px; text-indent: 28px;\"><strong>变孙悟空，吃饭的欲望都没了</strong></p><p style=\"margin-top: 0px; margin-bottom: 25px; padding: 0px; text-indent: 28px;\">新京报：每次拍戏要化装将近7小时，很好奇拍戏这四个月你是怎么熬过来的？</p><p style=\"margin-top: 0px; margin-bottom: 25px; padding: 0px; text-indent: 28px;\">郭富城：其实化装需要7小时是刚刚开始的两个星期，因为像第一幕唐僧来五指山救我那个野猴妆，不但需要全身都有肌肉和猴毛，还要到现场穿完服装再粘上猴的指甲，那个指甲都要差不多一个小时，还要一个小时才能干透，才能上颜色，很复杂。那些美国化装特技师，一丝不苟，每个细节都要做到很妥当才给你拍，光是这个又得一个小时。每天早上四点开始化装，差不多下午一点开始拍，只能拍四个多小时，因为五点就没太阳了。穿完那个肌肉服，五、六个小时不能去洗手间，而且手指甲粘完之后你根本不能做任何事。</p><p style=\"margin-top: 0px; margin-bottom: 25px; padding: 0px; text-indent: 28px;\">新京报：据说你在片场一天只能也只顾得上吃一顿饭？</p><p style=\"margin-top: 0px; margin-bottom: 25px; padding: 0px; text-indent: 28px;\">郭富城：不是一顿饭，是没有任何想吃的欲望。因为你根本连嘴巴都张不开，只可以讲对白，连小笼包这么小的都吃不了，勺子都放不进嘴巴，但为了拍戏，有能量才能打好，真太饿的时候就吃些花生米或者薯条。还有就是穿上戏服后，实在太不透气，身体在发热，汗从耳朵后面流下来，原来粘了胶水的地方和汗水融在一起就会烂掉，还会起水泡，所以要很小心，每次拍完一条文戏，刚有流汗的感觉，就跑到棚外面，室外温度是零下大概两三度，在外面吹风止汗，四个月来每天都是这样。</p><p class=\"detailPic\" style=\"margin: 0px auto 10px; padding: 0px; text-indent: 28px; text-align: center;\"><img src=\"http://y0.ifengimg.com/a/2016_05/4283fb18b09bee0.jpg\" width=\"600\" height=\"400\" alt=\"\" style=\"border: 0px; vertical-align: bottom; display: block; margin: 0px auto;\"/></p><p class=\"picIntro\" style=\"margin-top: 0px; margin-bottom: 25px; padding: 0px; text-align: center; font-family: 楷体_gb2312, 楷体;\">郭富城版孙悟空</p><p style=\"margin-top: 0px; margin-bottom: 25px; padding: 0px; text-indent: 28px;\"><strong>埋头苦练</strong></p><p style=\"margin-top: 0px; margin-bottom: 25px; padding: 0px; text-indent: 28px;\"><strong>挨金箍棒打最多的人，是我</strong></p><p style=\"margin-top: 0px; margin-bottom: 25px; padding: 0px; text-indent: 28px;\">新京报：据说你为孙悟空曾经秘密训练了将近三个月？</p><p style=\"margin-top: 0px; margin-bottom: 25px; padding: 0px; text-indent: 28px;\">郭富城：主要是形体上的东西和准备功课，看看比如六小龄童这样的前辈是怎么演的，他的猴王是最让人认同的。但现在我们和电视剧不一样，电影是巨大的银幕，它看得很清楚，有什么东西稍微有些差池就会穿帮，所以每个细节都是你必须要在大银幕上做得很到位。我记得我当时是穿着运动服去练功，但正式进入剧组后发现，穿着猴装讲对白做动作，他的表情眼神跟他的肢体语言怎么配合都要重新揣摩。他是猴，你是人，我要做的就是要猴人合一。</p><p style=\"margin-top: 0px; margin-bottom: 25px; padding: 0px; text-indent: 28px;\">新京报：<a href=\"http://app.ent.ifeng.com/star/546\" target=\"_blank\" style=\"text-decoration: none; color: rgb(0, 66, 118); font-weight: bold;\">冯绍峰</a>说你平时不拍戏也一直在练金箍棒，经常身上青一块紫一块，很想知道金箍棒这项你花了多久时间才练到我们在电影里看到的那样的熟练状态？</p><p style=\"margin-top: 0px; margin-bottom: 25px; padding: 0px; text-indent: 28px;\">郭富城：因为金箍棒好像孙悟空的手一样，形影不离，如影随形，所以金箍棒必须要去练好。差不多几个月的时间里，我只要有空就练。<a href=\"http://app.ent.ifeng.com/star/800\" target=\"_blank\" style=\"text-decoration: none; color: rgb(0, 66, 118); font-weight: bold;\">洪金宝</a>大哥和他的徒弟都在教我，他们都是练京剧出来的，非常厉害。</p><p style=\"margin-top: 0px; margin-bottom: 25px; padding: 0px; text-indent: 28px;\">新京报：练出什么诀窍了吗？</p><p style=\"margin-top: 0px; margin-bottom: 25px; padding: 0px; text-indent: 28px;\">郭富城：没有，我练的时候常常打到头、脚、脖子、膝盖，都受过伤，是青的。有时候空中要抛起来接，一松手飞出去了，还打到人家的腿。好在打戏有洪金宝大哥，他知道我《道士下山》时的腿伤还没康复，就专门去设计动作，做的过程中不会影响到你受伤的部分，在银幕上也完全看不出来，我觉得这个是最厉害的，他懂得怎么避重就轻。我相信大哥拍很多戏都是带着伤的，所以他知道一个演员受伤的时候他应该怎么做，非常有经验。</p><p style=\"margin-top: 0px; margin-bottom: 25px; padding: 0px; text-indent: 28px;\"><strong>角色解读</strong></p><p style=\"margin-top: 0px; margin-bottom: 25px; padding: 0px; text-indent: 28px;\"><strong>要懂得舍身成仁，方成英雄</strong></p><p style=\"margin-top: 0px; margin-bottom: 25px; padding: 0px; text-indent: 28px;\">新京报：你觉得孙悟空跟你本人有没有性格上的共鸣？</p><p style=\"margin-top: 0px; margin-bottom: 25px; padding: 0px; text-indent: 28px;\">郭富城：孙悟空蛮单纯的，对我来说，也是一个返璞归真的过程，从一个没有人知的舞者，到今天大家知道我是一个舞者，也是一个演员。我觉得从来本质上没有改变过，孙悟空也是这样，一步一步这样成长。</p><p style=\"margin-top: 0px; margin-bottom: 25px; padding: 0px; text-indent: 28px;\">新京报：观音劝孙悟空回去跟唐僧继续西行的那段话印象深刻，她说悟空看见的是人相，唐僧看到的是心相，你是否认同这个评价？</p><p style=\"margin-top: 0px; margin-bottom: 25px; padding: 0px; text-indent: 28px;\">郭富城：我非常赞成。观音菩萨让孙悟空明白，他和唐僧的矛盾在哪里，也让他知道每个人都拥有不同的天赋，我们应该把一个天赋发扬光大，而不是去评价人家不对的地方。我们每个人都有缺失，但是我们可以包容。我觉得这个是电影很微妙的讯息，很了不起，不是每个电影能够做得到。</p><p style=\"margin-top: 0px; margin-bottom: 25px; padding: 0px; text-indent: 28px;\">新京报：数度被唐僧误解百口莫辩，甚至逐出师门，你如何揣摩这种复杂的角色心理？</p><p style=\"margin-top: 0px; margin-bottom: 25px; padding: 0px; text-indent: 28px;\">郭富城：观音菩萨告诉孙悟空，你要成为一个做大事的人，必须要有这样一种修为，就好像人生一样，慢慢去修炼自己，懂得舍身成仁，才能成为真正的英雄，哪怕受到所有人的责怪，哪怕不被理解，但还是要勇往直前，去保护大家，保护师傅。</p><p style=\"margin-top: 0px; margin-bottom: 25px; padding: 0px; text-indent: 28px;\">新京报：整部电影中哪场戏你动情最多？</p><p style=\"margin-top: 0px; margin-bottom: 25px; padding: 0px; text-indent: 28px;\">郭富城：我觉得孙悟空最大的一次情感爆发就是在第三打的时候，导演的诠释跟传统故事不一样，也是三打的精神所在，拿起金箍棒要下手的时候，那个情感推进是整个电影最大的爆发点。孙悟空当时的心理活动是怎么样的呢，他的情绪，他的眼神，他整个心是怎么走，都要在此刻爆发。回想起来，一个演员，此生能演一次孙悟空，真的无憾。</p><p style=\"margin-top: 0px; margin-bottom: 25px; padding: 0px; text-indent: 28px;\">新京报：为何这么拼命，两届金马影帝难道不已经是你演员实力的最好证明吗？</p><p style=\"margin-top: 0px; margin-bottom: 25px; padding: 0px; text-indent: 28px;\">郭富城：如果你是一个大家心目中的好演员，你更不能去毁了大家对你的信心，是对观众的承诺。奖项只是个锦上添花的过程而已，不能用它捆绑自己的思想，不是唯一的，还是要回到最开始的状态，做一个演员的初心不要改变，是对艺术的追求。我还有很多角色没尝试过，还想一直演到80岁、90岁，相信不同的年龄呈现出来的东西是不一样的。比如正是有了之前舞蹈、动作及演戏经验，才有了现在一个属于郭富城版的孙悟空。<span class=\"ifengLogo\"><a href=\"http://www.ifeng.com/\" target=\"_blank\" style=\"text-decoration: none; color: rgb(0, 66, 118); font-weight: bold;\"><img src=\"http://y2.ifengimg.com/a/2015/0708/icon_logo.gif\" style=\"border: 0px; vertical-align: top; display: inline; margin: 0px; padding-top: 3px;\"/></a></span></p><p><img src=\"http://y3.ifengimg.com/a/2015/1118/detailQrcode.jpg\" style=\"border: 0px; vertical-align: bottom;\"/></p><p class=\"iphone_none\" style=\"margin-top: 0px; margin-bottom: 0px; padding: 0px; float: left; width: 322px;\">[责任编辑：胡俊豪 PK027]</p><p class=\"p01 ss_none\" style=\"margin-top: 0px; margin-bottom: 0px; padding: 8px 0px 0px; line-height: 18px; color: rgb(102, 102, 102); float: left; width: 322px;\">标签：<a href=\"http://search.ifeng.com/sofeng/search.action?c=1&q=%E4%B8%89%E6%89%93%E7%99%BD%E9%AA%A8%E7%B2%BE\" target=\"_blank\" style=\"text-decoration: none; color: rgb(126, 154, 201);\">三打白骨精</a>&nbsp;<a href=\"http://search.ifeng.com/sofeng/search.action?c=1&q=%E9%83%AD%E5%AF%8C%E5%9F%8E\" target=\"_blank\" style=\"text-decoration: none; color: rgb(126, 154, 201);\">郭富城</a>&nbsp;<a href=\"http://search.ifeng.com/sofeng/search.action?c=1&q=%E5%AD%99%E6%82%9F%E7%A9%BA\" target=\"_blank\" style=\"text-decoration: none; color: rgb(126, 154, 201);\">孙悟空</a></p><p><iframe class=\"miniseebox js_weixin_iframe\" frameborder=\"0\" scrolling=\"no\" src=\"about:blank\" style=\"width: 232px; height: 0px; position: absolute; left: -73px; bottom: 42px; z-index: 102;\"></iframe></p><p><img src=\"http://h2.ifengimg.com/0f56ee67a4c375c2/2013/1106/indeccode.png\" class=\"js_wx_qrcod\" style=\"border: 0px; vertical-align: bottom; width: 86px; height: 86px; float: left; margin-right: 14px;\"/></p><p style=\"margin-top: 0px; margin-bottom: 0px; padding: 12px 0px 0px; float: left; width: auto; color: rgb(102, 102, 102); line-height: 24px; font-size: 12px;\"><br/></p><p><a class=\"bds_tsina js_content_share_btn\" data-type=\"sina\" data-fid=\"fed43f2111d\" style=\"color: rgb(43, 43, 43); float: left; display: block; width: 36px; height: 30px; margin: 0px; padding: 0px; font-family: simsun, arial, helvetica, clean, sans-serif; font-size: 12px; white-space: normal; background: url(&quot;http://y2.ifengimg.com/e01ed39fc2da5d4a/2014/0317/sharebg.gif&quot;) 0px 0px no-repeat rgb(255, 255, 255);\"></a><a class=\"bds_qzone js_content_share_btn\" data-type=\"qqZone\" data-fid=\"f75737b337c\" style=\"color: rgb(43, 43, 43); float: left; display: block; width: 36px; height: 30px; margin: 0px; padding: 0px; font-family: simsun, arial, helvetica, clean, sans-serif; font-size: 12px; white-space: normal; background: url(&quot;http://y2.ifengimg.com/e01ed39fc2da5d4a/2014/0317/sharebg.gif&quot;) 0px -39px no-repeat rgb(255, 255, 255);\"></a></p><p><br/></p>', '/huhui_back/web/upload/20160129209394.jpg', '1', '2112');
INSERT INTO `hl_news` VALUES ('27', '只为发烧而生', '<p><br/></p><ul class=\"xm-carousel-list xm-carousel-col-5-list goods-list rainbow-list clearfix J_carouselList list-paddingleft-2\" style=\"list-style-type: none;\"><li><p><a class=\"thumb\" href=\"http://www.mi.com/mi4/\" data-stat-aid=\"AA11747\" data-stat-pid=\"2_17_1_80\" target=\"_blank\" data-stat-id=\"AA11747+2_17_1_80\" style=\"color: rgb(117, 117, 117); text-decoration: none; display: block; width: 160px; margin: 0px auto 22px;\"><img src=\"http://i3.mifile.cn/a4/T1UCV_B4dv1RXrhCrK.jpg\" srcset=\"//i3.mifile.cn/a4/T1fNK_BCLv1RXrhCrK.jpg 2x\" alt=\"小米手机4\" style=\"border: 0px; width: 160px; height: 160px;\"/></a></p><h3 class=\"title\" style=\"font-size: 14px; margin: 0px 20px 3px; font-weight: 400; text-overflow: ellipsis; white-space: nowrap; overflow: hidden; color: rgb(33, 33, 33);\"><a href=\"http://www.mi.com/mi4/\" data-stat-aid=\"AA11747\" data-stat-pid=\"2_17_1_80\" target=\"_blank\" data-stat-id=\"AA11747+2_17_1_80\" style=\"color: rgb(33, 33, 33); text-decoration: none;\">小米手机4</a></h3><p class=\"desc\" style=\"margin: 0px 20px 12px; height: 18px; font-size: 12px; text-overflow: ellipsis; white-space: nowrap; overflow: hidden; color: rgb(176, 176, 176);\">工艺和手感超乎想象</p><p class=\"price\" style=\"margin-top: 0px; margin-bottom: 0px; color: rgb(255, 103, 9);\">1299元起</p></li><li><p><a class=\"thumb\" href=\"http://www.mi.com/tvzj/\" data-stat-aid=\"AA12106\" data-stat-pid=\"2_17_2_81\" target=\"_blank\" data-stat-id=\"AA12106+2_17_2_81\" style=\"color: rgb(117, 117, 117); text-decoration: none; display: block; width: 160px; margin: 0px auto 22px;\"><img src=\"http://i3.mifile.cn/a4/T1vwVgBCVv1RXrhCrK.jpg\" srcset=\"//i3.mifile.cn/a4/T1zMhgBmLv1RXrhCrK.jpg 2x\" alt=\"小米电视主机\" style=\"border: 0px; width: 160px; height: 160px;\"/></a></p><h3 class=\"title\" style=\"font-size: 14px; margin: 0px 20px 3px; font-weight: 400; text-overflow: ellipsis; white-space: nowrap; overflow: hidden; color: rgb(33, 33, 33);\"><a href=\"http://www.mi.com/tvzj/\" data-stat-aid=\"AA12106\" data-stat-pid=\"2_17_2_81\" target=\"_blank\" data-stat-id=\"AA12106+2_17_2_81\" style=\"color: rgb(33, 33, 33); text-decoration: none;\">小米电视主机</a></h3><p class=\"desc\" style=\"margin: 0px 20px 12px; height: 18px; font-size: 12px; text-overflow: ellipsis; white-space: nowrap; overflow: hidden; color: rgb(176, 176, 176);\">次世代智能电视主机，内置独立音响</p><p class=\"price\" style=\"margin-top: 0px; margin-bottom: 0px; color: rgb(255, 103, 9);\">999元</p></li><li><p><a class=\"thumb\" href=\"http://www.mi.com/hezimini/\" data-stat-aid=\"AA11926\" data-stat-pid=\"2_17_3_82\" target=\"_blank\" data-stat-id=\"AA11926+2_17_3_82\" style=\"color: rgb(117, 117, 117); text-decoration: none; display: block; width: 160px; margin: 0px auto 22px;\"><img src=\"http://i3.mifile.cn/a4/T1ICCjBTxT1R4cSCrK.png\" srcset=\"//i3.mifile.cn/a4/T1euDjBgET1R4cSCrK.png 2x\" alt=\"小米盒子mini版(礼品装)\" style=\"border: 0px; width: 160px; height: 160px;\"/></a></p><h3 class=\"title\" style=\"font-size: 14px; margin: 0px 20px 3px; font-weight: 400; text-overflow: ellipsis; white-space: nowrap; overflow: hidden; color: rgb(33, 33, 33);\"><a href=\"http://www.mi.com/hezimini/\" data-stat-aid=\"AA11926\" data-stat-pid=\"2_17_3_82\" target=\"_blank\" data-stat-id=\"AA11926+2_17_3_82\" style=\"color: rgb(33, 33, 33); text-decoration: none;\">小米盒子mini版(礼品装)</a></h3><p class=\"desc\" style=\"margin: 0px 20px 12px; height: 18px; font-size: 12px; text-overflow: ellipsis; white-space: nowrap; overflow: hidden; color: rgb(176, 176, 176);\">10亿美金影视库，内容新增83%</p><p class=\"price\" style=\"margin-top: 0px; margin-bottom: 0px; color: rgb(255, 103, 9);\">199元</p></li><li><p><a class=\"thumb\" href=\"http://www.mi.com/minote/ns/\" data-stat-aid=\"AA11314\" data-stat-pid=\"2_17_4_83\" target=\"_blank\" data-stat-id=\"AA11314+2_17_4_83\" style=\"color: rgb(117, 117, 117); text-decoration: none; display: block; width: 160px; margin: 0px auto 22px;\"><img src=\"http://i3.mifile.cn/a4/T1Tvh_BjWT1RXrhCrK.jpg\" srcset=\"//i3.mifile.cn/a4/T1aiAvBX_v1RXrhCrK.jpg 2x\" alt=\"小米Note 女神版\" style=\"border: 0px; width: 160px; height: 160px;\"/></a></p><h3 class=\"title\" style=\"font-size: 14px; margin: 0px 20px 3px; font-weight: 400; text-overflow: ellipsis; white-space: nowrap; overflow: hidden; color: rgb(33, 33, 33);\"><a href=\"http://www.mi.com/minote/ns/\" data-stat-aid=\"AA11314\" data-stat-pid=\"2_17_4_83\" target=\"_blank\" data-stat-id=\"AA11314+2_17_4_83\" style=\"color: rgb(33, 33, 33); text-decoration: none;\">小米Note 女神版</a></h3><p class=\"desc\" style=\"margin: 0px 20px 12px; height: 18px; font-size: 12px; text-overflow: ellipsis; white-space: nowrap; overflow: hidden; color: rgb(176, 176, 176);\">科技与时尚的理想结合</p><p class=\"price\" style=\"margin-top: 0px; margin-bottom: 0px; color: rgb(255, 103, 9);\">1799元起</p></li><li><p><a class=\"thumb\" href=\"http://www.mi.com/miwifimini/\" data-stat-aid=\"AA11526\" data-stat-pid=\"2_17_5_84\" target=\"_blank\" data-stat-id=\"AA11526+2_17_5_84\" style=\"color: rgb(117, 117, 117); text-decoration: none; display: block; width: 160px; margin: 0px auto 22px;\"><img src=\"http://i3.mifile.cn/a4/T1KDAjBCAT1RXrhCrK.jpg\" srcset=\"//i3.mifile.cn/a4/T1F0WjBCCT1RXrhCrK.jpg 2x\" alt=\"小米路由器 mini\" style=\"border: 0px; width: 160px; height: 160px;\"/></a></p><h3 class=\"title\" style=\"font-size: 14px; margin: 0px 20px 3px; font-weight: 400; text-overflow: ellipsis; white-space: nowrap; overflow: hidden; color: rgb(33, 33, 33);\"><a href=\"http://www.mi.com/miwifimini/\" data-stat-aid=\"AA11526\" data-stat-pid=\"2_17_5_84\" target=\"_blank\" data-stat-id=\"AA11526+2_17_5_84\" style=\"color: rgb(33, 33, 33); text-decoration: none;\">小米路由器 mini</a></h3><p class=\"desc\" style=\"margin: 0px 20px 12px; height: 18px; font-size: 12px; text-overflow: ellipsis; white-space: nowrap; overflow: hidden; color: rgb(176, 176, 176);\">主流双频AC智能路由器</p><p class=\"price\" style=\"margin-top: 0px; margin-bottom: 0px; color: rgb(255, 103, 9);\">129元</p></li></ul><p><br/></p>', '/huhui_back/web/upload/20160203901423.jpg', '1', '213123312');

-- ----------------------------
-- Table structure for hl_orders
-- ----------------------------
DROP TABLE IF EXISTS `hl_orders`;
CREATE TABLE `hl_orders` (
  `mate_id` int(32) NOT NULL AUTO_INCREMENT COMMENT '匹配订单id',
  `pay_id` int(32) unsigned DEFAULT '0' COMMENT '提供帮助订单id(当 pay_id不为0,get_id为0时    表示订单为匹配中 针对舍的一方，)',
  `get_id` int(32) unsigned DEFAULT '0' COMMENT '接受帮助订单id(当 get_id不为0时, pay_id为0时  表示订单为匹配中 针对得的一方 )',
  `money` int(32) DEFAULT '0' COMMENT '交易金额',
  `create_time` int(32) DEFAULT NULL COMMENT '创建时间',
  `need_time` int(32) DEFAULT NULL COMMENT '订单完成时间',
  `status` int(32) DEFAULT '1' COMMENT '匹配状态(1.匹配中,2待打款/待收款,3已打款/等待收款确认,4.虚假打款/(未收到款)异常,5.为48小时未打款 （异常）,6.为36小时未确认收款 （异常），7.交易成功',
  `pipei_count` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`mate_id`)
) ENGINE=InnoDB AUTO_INCREMENT=128 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of hl_orders
-- ----------------------------
INSERT INTO `hl_orders` VALUES ('8', '5', '0', '3000', '1455609317', null, '1', null);
INSERT INTO `hl_orders` VALUES ('9', '6', '0', '3000', '1455609344', null, '1', null);
INSERT INTO `hl_orders` VALUES ('12', '7', '0', '500', '1455884785', null, '1', null);
INSERT INTO `hl_orders` VALUES ('13', '8', '0', '300', '1455892305', null, '1', null);
INSERT INTO `hl_orders` VALUES ('16', '0', '2', '3000', '1455944972', null, '1', null);
INSERT INTO `hl_orders` VALUES ('18', '9', '3', '3000', '1455945455', null, '5', null);
INSERT INTO `hl_orders` VALUES ('19', '11', '0', '300', '1455945128', null, '1', null);
INSERT INTO `hl_orders` VALUES ('20', '12', '0', '300', '1455945128', null, '1', null);
INSERT INTO `hl_orders` VALUES ('21', '13', '0', '3000', '1455949616', null, '1', null);
INSERT INTO `hl_orders` VALUES ('22', '14', '0', '3000', '1455949616', null, '1', null);
INSERT INTO `hl_orders` VALUES ('23', '15', '0', '300', '1456108002', null, '1', null);
INSERT INTO `hl_orders` VALUES ('24', '16', '0', '300', '1456108002', null, '1', null);
INSERT INTO `hl_orders` VALUES ('25', '17', '0', '400', '1456108064', null, '1', null);
INSERT INTO `hl_orders` VALUES ('26', '18', '0', '400', '1456108064', null, '1', null);
INSERT INTO `hl_orders` VALUES ('27', '0', '4', '1900', '1456108229', null, '1', null);
INSERT INTO `hl_orders` VALUES ('28', '19', '0', '400', '1456108893', null, '1', null);
INSERT INTO `hl_orders` VALUES ('30', '20', '0', '300', '1456109863', null, '1', null);
INSERT INTO `hl_orders` VALUES ('31', '21', '0', '300', '1456109863', null, '1', null);
INSERT INTO `hl_orders` VALUES ('32', '22', '0', '2000', '1456109902', null, '1', null);
INSERT INTO `hl_orders` VALUES ('33', '23', '0', '2000', '1456109902', null, '1', null);
INSERT INTO `hl_orders` VALUES ('34', '24', '0', '3000', '1456110105', null, '1', null);
INSERT INTO `hl_orders` VALUES ('35', '25', '0', '600', '1456110138', null, '1', null);
INSERT INTO `hl_orders` VALUES ('36', '1', '5', '300', '1456302602', null, '5', null);
INSERT INTO `hl_orders` VALUES ('38', '3', '1', '3000', '1456120994', null, '6', null);
INSERT INTO `hl_orders` VALUES ('40', '27', '0', '500', '1456111618', null, '1', null);
INSERT INTO `hl_orders` VALUES ('41', '28', '0', '2000', '1456112537', null, '1', null);
INSERT INTO `hl_orders` VALUES ('42', '0', '6', '2000', '1456112614', null, '1', null);
INSERT INTO `hl_orders` VALUES ('43', '0', '7', '2000', '1456112614', null, '1', null);
INSERT INTO `hl_orders` VALUES ('44', '0', '8', '1900', '1456112730', null, '1', null);
INSERT INTO `hl_orders` VALUES ('45', '0', '9', '1900', '1456112730', null, '1', null);
INSERT INTO `hl_orders` VALUES ('46', '0', '10', '300', '1456112764', null, '1', null);
INSERT INTO `hl_orders` VALUES ('47', '0', '11', '300', '1456112960', null, '1', null);
INSERT INTO `hl_orders` VALUES ('48', '0', '12', '300', '1456112960', null, '1', null);
INSERT INTO `hl_orders` VALUES ('49', '0', '13', '300', '1456112960', null, '1', null);
INSERT INTO `hl_orders` VALUES ('50', '0', '14', '300', '1456112960', null, '1', null);
INSERT INTO `hl_orders` VALUES ('51', '0', '15', '300', '1456112960', null, '1', null);
INSERT INTO `hl_orders` VALUES ('52', '0', '16', '300', '1456112960', null, '1', null);
INSERT INTO `hl_orders` VALUES ('53', '0', '17', '300', '1456112960', null, '1', null);
INSERT INTO `hl_orders` VALUES ('54', '0', '18', '300', '1456112960', null, '1', null);
INSERT INTO `hl_orders` VALUES ('55', '0', '19', '300', '1456112960', null, '1', null);
INSERT INTO `hl_orders` VALUES ('56', '0', '20', '300', '1456113079', null, '1', null);
INSERT INTO `hl_orders` VALUES ('57', '0', '21', '300', '1456113080', null, '1', null);
INSERT INTO `hl_orders` VALUES ('58', '0', '22', '300', '1456113342', null, '1', null);
INSERT INTO `hl_orders` VALUES ('59', '0', '23', '300', '1456113342', null, '1', null);
INSERT INTO `hl_orders` VALUES ('60', '0', '24', '300', '1456113344', null, '1', null);
INSERT INTO `hl_orders` VALUES ('61', '0', '25', '300', '1456113344', null, '1', null);
INSERT INTO `hl_orders` VALUES ('62', '0', '26', '300', '1456113344', null, '1', null);
INSERT INTO `hl_orders` VALUES ('63', '29', '0', '300', '1456113963', null, '1', null);
INSERT INTO `hl_orders` VALUES ('64', '30', '0', '600', '1456113997', null, '1', null);
INSERT INTO `hl_orders` VALUES ('65', '0', '27', '600', '1456114059', null, '1', null);
INSERT INTO `hl_orders` VALUES ('66', '0', '28', '800', '1456114075', null, '1', null);
INSERT INTO `hl_orders` VALUES ('67', '31', '0', '1000', '1456116853', null, '1', null);
INSERT INTO `hl_orders` VALUES ('68', '32', '0', '1000', '1456116853', null, '1', null);
INSERT INTO `hl_orders` VALUES ('69', '0', '29', '3000', '1456117055', null, '1', null);
INSERT INTO `hl_orders` VALUES ('70', '0', '30', '3000', '1456117055', null, '1', null);
INSERT INTO `hl_orders` VALUES ('71', '0', '31', '3000', '1456117106', null, '1', null);
INSERT INTO `hl_orders` VALUES ('72', '0', '32', '1000', '1456117155', null, '1', null);
INSERT INTO `hl_orders` VALUES ('73', '33', '0', '1000', '1456120554', null, '1', null);
INSERT INTO `hl_orders` VALUES ('74', '34', '0', '1000', '1456120554', null, '1', null);
INSERT INTO `hl_orders` VALUES ('76', '35', '0', '500', '1456122891', null, '1', null);
INSERT INTO `hl_orders` VALUES ('77', '36', '0', '500', '1456122892', null, '1', null);
INSERT INTO `hl_orders` VALUES ('78', '37', '0', '300', '1456125834', null, '1', null);
INSERT INTO `hl_orders` VALUES ('79', '38', '0', '1300', '1456131132', null, '1', null);
INSERT INTO `hl_orders` VALUES ('80', '39', '0', '400', '1456141223', null, '1', null);
INSERT INTO `hl_orders` VALUES ('81', '40', '0', '3000', '1456143654', null, '1', null);
INSERT INTO `hl_orders` VALUES ('84', '41', '34', '300', '1456209096', null, '7', null);
INSERT INTO `hl_orders` VALUES ('85', '0', '35', '500', '1456214540', null, '1', null);
INSERT INTO `hl_orders` VALUES ('86', '42', '0', '500', '1456217346', null, '1', null);
INSERT INTO `hl_orders` VALUES ('87', '43', '0', '400', '1456217619', null, '1', null);
INSERT INTO `hl_orders` VALUES ('88', '0', '36', '300', '1456219468', null, '1', null);
INSERT INTO `hl_orders` VALUES ('89', '44', '0', '500', '1456227418', null, '1', null);
INSERT INTO `hl_orders` VALUES ('92', '45', '37', '400', '1456288387', null, '7', null);
INSERT INTO `hl_orders` VALUES ('94', '10', '38', '3000', '1456302668', null, '5', null);
INSERT INTO `hl_orders` VALUES ('95', '46', '0', '1500', '1456292526', null, '1', null);
INSERT INTO `hl_orders` VALUES ('96', '47', '0', '1200', null, null, '1', null);
INSERT INTO `hl_orders` VALUES ('99', '26', '39', '300', '1456555752', null, '6', null);
INSERT INTO `hl_orders` VALUES ('100', '0', '40', '3000', '1456556270', null, '1', null);
INSERT INTO `hl_orders` VALUES ('101', '0', '41', '2000', '1456556279', null, '1', null);
INSERT INTO `hl_orders` VALUES ('103', '0', '43', '3000', '1456559603', null, '1', null);
INSERT INTO `hl_orders` VALUES ('106', '47', '33', '700', '1456562028', null, '2', null);
INSERT INTO `hl_orders` VALUES ('107', '47', '42', '500', '1456562028', null, '2', null);
INSERT INTO `hl_orders` VALUES ('108', '48', '0', '150', '1456563257', null, '1', null);
INSERT INTO `hl_orders` VALUES ('110', '48', '0', '70', '1456563555', null, '1', null);
INSERT INTO `hl_orders` VALUES ('111', '48', '0', '80', '1456563555', null, '1', null);
INSERT INTO `hl_orders` VALUES ('114', '1', '1', '300', '1456565859', null, '2', null);
INSERT INTO `hl_orders` VALUES ('115', '0', '44', '2000', '1456566195', null, '1', null);
INSERT INTO `hl_orders` VALUES ('116', '0', '45', '2000', '1456566249', null, '1', null);
INSERT INTO `hl_orders` VALUES ('117', '0', '46', '2000', '1456566261', null, '1', null);
INSERT INTO `hl_orders` VALUES ('121', '1', '1', '300', '1456567111', null, '2', null);
INSERT INTO `hl_orders` VALUES ('122', '49', '0', '300', '1456572043', null, '1', null);
INSERT INTO `hl_orders` VALUES ('123', '0', '47', '800', '1457161385', null, '1', null);
INSERT INTO `hl_orders` VALUES ('124', '0', '48', '500', '1457161414', null, '1', null);
INSERT INTO `hl_orders` VALUES ('125', '0', '49', '500', '1457161568', null, '1', null);
INSERT INTO `hl_orders` VALUES ('126', '0', '50', '600', '1457161842', null, '1', null);
INSERT INTO `hl_orders` VALUES ('127', '0', '51', '400', '1457161853', null, '1', null);

-- ----------------------------
-- Table structure for hl_payhelp
-- ----------------------------
DROP TABLE IF EXISTS `hl_payhelp`;
CREATE TABLE `hl_payhelp` (
  `pay_id` int(32) NOT NULL AUTO_INCREMENT COMMENT '帮助订单id',
  `user_id` int(32) DEFAULT NULL COMMENT '用户id',
  `money` int(32) DEFAULT NULL COMMENT '提供帮助金钱',
  `match_time` int(32) unsigned DEFAULT NULL COMMENT '匹配成功时间',
  `create_time` int(32) unsigned DEFAULT NULL COMMENT '匹配时间',
  `status` int(11) NOT NULL DEFAULT '1' COMMENT '1.匹配中，2.交易未完成，3交易完成',
  `accrual` int(32) DEFAULT NULL COMMENT '利息 （本金×利率）',
  `is_tx` int(32) DEFAULT '0' COMMENT '是否提现。0未提现，1为提现成功',
  `pay_type` varchar(32) NOT NULL COMMENT '1支付宝 2微信 3银行卡',
  PRIMARY KEY (`pay_id`)
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of hl_payhelp
-- ----------------------------
INSERT INTO `hl_payhelp` VALUES ('1', '13', '300', '1456302602', '1455534156', '1', '0', '1', '3');
INSERT INTO `hl_payhelp` VALUES ('2', '3', '300', null, '1455589196', '1', '3', '1', '3');
INSERT INTO `hl_payhelp` VALUES ('3', '5', '3000', null, '1455607584', '2', '150', '1', '3');
INSERT INTO `hl_payhelp` VALUES ('4', '4', '3000', null, '1455609230', '1', '0', '1', '3');
INSERT INTO `hl_payhelp` VALUES ('5', '4', '3000', null, '1455609317', '1', '0', '1', '3');
INSERT INTO `hl_payhelp` VALUES ('6', '4', '3000', null, '1455609344', '1', '60', '1', '3');
INSERT INTO `hl_payhelp` VALUES ('7', '7', '500', null, '1455884785', '4', '0', '1', '3');
INSERT INTO `hl_payhelp` VALUES ('8', '3', '300', null, '1455892305', '1', '12', '0', '1');
INSERT INTO `hl_payhelp` VALUES ('9', '5', '3000', '1455945455', '1455944934', '3', '300', '1', '3');
INSERT INTO `hl_payhelp` VALUES ('10', '5', '3000', null, '1455944934', '2', '30', '1', '3');
INSERT INTO `hl_payhelp` VALUES ('11', '5', '300', null, '1455945128', '1', '3', '1', '3');
INSERT INTO `hl_payhelp` VALUES ('12', '5', '300', null, '1455945128', '1', '3', '1', '3');
INSERT INTO `hl_payhelp` VALUES ('13', '8', '3000', null, '1455949616', '1', null, '0', '3');
INSERT INTO `hl_payhelp` VALUES ('14', '8', '3000', null, '1455949616', '1', null, '0', '3');
INSERT INTO `hl_payhelp` VALUES ('15', '7', '300', null, '1456108002', '1', '0', '1', '3');
INSERT INTO `hl_payhelp` VALUES ('16', '7', '300', null, '1456108002', '1', '0', '1', '3');
INSERT INTO `hl_payhelp` VALUES ('17', '7', '400', null, '1456108064', '1', '0', '1', '3');
INSERT INTO `hl_payhelp` VALUES ('18', '7', '400', null, '1456108064', '1', '0', '1', '3');
INSERT INTO `hl_payhelp` VALUES ('19', '4', '400', null, '1456108893', '1', '0', '1', '1');
INSERT INTO `hl_payhelp` VALUES ('20', '10', '300', null, '1456109863', '1', '0', '1', '3');
INSERT INTO `hl_payhelp` VALUES ('21', '10', '300', null, '1456109863', '1', '0', '1', '3');
INSERT INTO `hl_payhelp` VALUES ('22', '10', '2000', null, '1456109902', '1', '20', '0', '3');
INSERT INTO `hl_payhelp` VALUES ('23', '10', '2000', null, '1456109902', '1', '20', '0', '3');
INSERT INTO `hl_payhelp` VALUES ('24', '4', '3000', null, '1456110105', '1', '0', '1', '2');
INSERT INTO `hl_payhelp` VALUES ('25', '4', '600', null, '1456110105', '1', '60', '1', '1');
INSERT INTO `hl_payhelp` VALUES ('26', '4', '300', '1456385508', '1456110105', '3', '30', '1', '1,2,3');
INSERT INTO `hl_payhelp` VALUES ('27', '4', '500', null, '1456110105', '1', '50', '1', '1');
INSERT INTO `hl_payhelp` VALUES ('28', '13', '2000', null, '1456110105', '1', null, '0', '3');
INSERT INTO `hl_payhelp` VALUES ('29', '4', '300', null, '1456110105', '1', '30', '1', '1');
INSERT INTO `hl_payhelp` VALUES ('30', '4', '600', null, '1455120000', '1', '60', '1', '1');
INSERT INTO `hl_payhelp` VALUES ('31', '5', '1000', null, '1456116853', '1', '100', '1', '3');
INSERT INTO `hl_payhelp` VALUES ('32', '5', '1000', null, '1456116853', '1', '100', '1', '3');
INSERT INTO `hl_payhelp` VALUES ('33', '5', '1000', null, '1456120554', '1', '100', '1', '3');
INSERT INTO `hl_payhelp` VALUES ('34', '5', '1000', null, '1456120554', '1', '100', '1', '3');
INSERT INTO `hl_payhelp` VALUES ('35', '5', '500', null, '1456122891', '1', '50', '1', '3');
INSERT INTO `hl_payhelp` VALUES ('36', '5', '500', null, '1456122892', '1', '50', '1', '3');
INSERT INTO `hl_payhelp` VALUES ('37', '4', '300', null, '1455120000', '1', '30', '1', '2');
INSERT INTO `hl_payhelp` VALUES ('38', '4', '1300', null, '1455120000', '1', '130', '1', '1');
INSERT INTO `hl_payhelp` VALUES ('39', '7', '400', null, '1456141223', '1', '0', '0', '1');
INSERT INTO `hl_payhelp` VALUES ('40', '4', '3000', null, '1455120000', '1', '300', '1', '1');
INSERT INTO `hl_payhelp` VALUES ('41', '14', '300', '1456209096', '1456208727', '4', '3', '0', '1');
INSERT INTO `hl_payhelp` VALUES ('42', '10', '500', null, '1456217346', '1', '0', '0', '1');
INSERT INTO `hl_payhelp` VALUES ('43', '10', '400', null, '1456217619', '1', '0', '0', '1');
INSERT INTO `hl_payhelp` VALUES ('44', '15', '500', null, '1456227418', '1', '50', '1', '1');
INSERT INTO `hl_payhelp` VALUES ('45', '14', '400', '1456288387', '1456236159', '4', '0', '0', '2');
INSERT INTO `hl_payhelp` VALUES ('46', '5', '1500', null, '1456292526', '1', '0', '1', '1');
INSERT INTO `hl_payhelp` VALUES ('47', '5', '1200', null, '1456298832', '1', '0', '1', '1');
INSERT INTO `hl_payhelp` VALUES ('48', '4', '300', null, '1456304685', '1', '6', '1', '1,2,3');
INSERT INTO `hl_payhelp` VALUES ('49', '4', '300', null, '1456572043', '1', '18', '0', '1,2');

-- ----------------------------
-- Table structure for hl_payhelp_rule
-- ----------------------------
DROP TABLE IF EXISTS `hl_payhelp_rule`;
CREATE TABLE `hl_payhelp_rule` (
  `prid` int(32) NOT NULL AUTO_INCREMENT COMMENT '规则id',
  `mlutiple` int(32) DEFAULT NULL COMMENT '金额输入倍数',
  `min_money` int(32) DEFAULT NULL COMMENT '最小金额',
  `max_money` int(32) DEFAULT NULL COMMENT '最大金额',
  `rate` int(32) DEFAULT NULL COMMENT '利率',
  `limit_days` int(32) DEFAULT NULL COMMENT '不得提现天数(从用户提供帮助操作成功后开始算。)',
  `interest_days` int(32) DEFAULT NULL COMMENT '利息天数(达到该天数后，不再获得利息，本金与利息也自动转回钱包。)',
  `help_money_month` int(32) DEFAULT NULL COMMENT '每月提供帮助总额度',
  `after_pay_days` int(32) DEFAULT NULL COMMENT '每次提供帮助N天后，可进行第二次提供帮助',
  PRIMARY KEY (`prid`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of hl_payhelp_rule
-- ----------------------------
INSERT INTO `hl_payhelp_rule` VALUES ('1', '100', '300', '3000', '1', '0', '10', '30000', '0');

-- ----------------------------
-- Table structure for hl_user
-- ----------------------------
DROP TABLE IF EXISTS `hl_user`;
CREATE TABLE `hl_user` (
  `user_id` int(32) unsigned NOT NULL AUTO_INCREMENT COMMENT '用户id',
  `nickname` varchar(32) DEFAULT NULL COMMENT '昵称',
  `account` varchar(255) NOT NULL COMMENT '用户名',
  `pwd_log` varchar(255) NOT NULL COMMENT '登陆密码',
  `pwd_tra` varchar(255) NOT NULL COMMENT '交易密码',
  `weixin` varchar(255) DEFAULT NULL COMMENT '微信账号',
  `alipay` varchar(255) DEFAULT NULL COMMENT '支付宝账号',
  `bank` text COMMENT '银行信息(以json格式输出(依次为银行账号.用户银行.开户名))',
  `phone` varchar(32) NOT NULL COMMENT '手机号码',
  `last_log` int(32) DEFAULT NULL COMMENT '最后一次登陆时间',
  `status` varchar(50) NOT NULL DEFAULT '1' COMMENT '使用状态 默认为1 正常使用 当为其他字符串时候为封号状态，字符串为封号理由',
  `reg_ip` varchar(32) DEFAULT NULL COMMENT '注册ip',
  `create_time` int(32) unsigned DEFAULT NULL COMMENT '注册时间',
  `is_active` tinyint(4) DEFAULT '0' COMMENT '是否激活 1为激活，0为未激活',
  `fixation_money` int(32) DEFAULT NULL COMMENT '个人待定总额',
  `money_manager` int(32) DEFAULT '0' COMMENT '经理待定奖金',
  `money_rec` int(32) DEFAULT '0' COMMENT '推荐待定奖金',
  `level_id` int(32) DEFAULT '1' COMMENT '等级id',
  `wdk_count` int(32) DEFAULT '0' COMMENT '未打款次数（三次封号）',
  `flow_money` int(32) DEFAULT '0' COMMENT '个人流动钱包(接受帮助的金额，经理奖金提现的金额，推荐奖金的金额的归为流动钱包)',
  `flow_money_manager` int(11) DEFAULT '0' COMMENT '经理奖金流动钱包',
  `flow_money_rec` int(11) DEFAULT '0' COMMENT '推荐奖金流动钱包',
  `headicon` varchar(255) DEFAULT NULL COMMENT '头像',
  `ip_id` int(32) DEFAULT '0',
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of hl_user
-- ----------------------------
INSERT INTO `hl_user` VALUES ('1', '湖滨', 'abcdefg', 'e10adc3949ba59abbe56e057f20f883e', 'e10adc3949ba59abbe56e057f20f883e', 'gdbdyqhs', 'sbdgsyd', '{\"bk1\":\"\\u4e2d\\u56fd\\u94f6\\u884c\",\"bk_zh1\":\"\\u4e2d\\u56fd\\u94f6\\u884c\\u82b1\\u5c71\\u652f\\u884c\",\"bkc1\":\"1111111111111111\",\"name1\":\"\\u5927\\u961f\\u957f\"}', '13922219523', '1456286203', '1', '广东 广州 天河', '1455525982', '1', '0', '0', '0', '1', '0', '1300', '0', '0', null, '0');
INSERT INTO `hl_user` VALUES ('2', null, '不悔', 'e10adc3949ba59abbe56e057f20f883e', '107ba8f56f79d19ddd88f7a7997bea45', null, null, null, '13725130847', null, 'x', '广东 广州 天河', '1455529177', '0', null, '0', '0', '1', '0', '0', '0', '0', null, '0');
INSERT INTO `hl_user` VALUES ('3', '哈哈哈', '654232773', '25f9e794323b453885f5181f1b624d0b', '25f9e794323b453885f5181f1b624d0b', 'daihuanqi', '1839232259', '{\"bk1\":\"\\u4e2d\\u56fd\\u94f6\\u884c\",\"bk_zh1\":\"\\u4e2d\\u56fd\\u94f6\\u884c\\u82b1\\u5c71\\u652f\\u884c\",\"bkc1\":\"1111111111111111\",\"name1\":\"\\u5927\\u961f\\u957f\"}', '18392322209', '1456284952', '1', '广东 广州 天河', '1455588949', '1', '300', '0', '123', '1', '0', '303', '0', '3', '/huhui_weixin/web/upload/2016-02-19-76426.jpeg', '0');
INSERT INTO `hl_user` VALUES ('4', '互赢', 'huying', 'e10adc3949ba59abbe56e057f20f883e', 'e10adc3949ba59abbe56e057f20f883e', 'huying', 'huying@163.com', '{\"bk1\":\"\\u4e2d\\u56fd\\u94f6\\u884c\",\"bk_zh1\":\"\\u4e2d\\u56fd\\u94f6\\u884c\\u82b1\\u5c71\\u652f\\u884c\",\"bkc1\":\"1111111111111111\",\"name1\":\"\\u5927\\u961f\\u957f\"}', '13422001851', '1457169501', '1', '广东 揭阳 普宁', '1455600922', '1', '7200', '0', '107', '1', '1', '27726', '8000', '8000', '/huhui_weixin/web/upload/20160225395937221.jpeg', '0');
INSERT INTO `hl_user` VALUES ('5', 'a', 'coro11', 'e10adc3949ba59abbe56e057f20f883e', 'e10adc3949ba59abbe56e057f20f883e', '213123213212', '312321321', '{\"bk1\":\"21321323\",\"bk_zh1\":\"21321321321\",\"bkc1\":\"2313111111111111111\",\"name1\":\"a\",\"bk2\":\"1\",\"bk_zh2\":\"2222222222222222222222222\",\"bkc2\":\"3222222222222222222\",\"name2\":\"4\"}', '13129347806', '1457172305', '1', '广东 广州 白云', '1455606761', '1', '4000', '0', '60', '1', '0', '22016', '0', '0', '/huhui_pc/web/upload/20160305954265965.jpeg', '0');
INSERT INTO `hl_user` VALUES ('6', null, '888999', 'e10adc3949ba59abbe56e057f20f883e', 'e10adc3949ba59abbe56e057f20f883e', null, null, null, '13719109232', '1456372669', '1', '广东 广州 荔湾', '1455619048', '1', null, '0', '0', '1', '0', '45', '0', '0', null, '0');
INSERT INTO `hl_user` VALUES ('7', 'asdd', 'test123', 'e10adc3949ba59abbe56e057f20f883e', '7694f4a66316e53c8cdd9d9954bd611d', 'test', 'asdd', '{\"bk1\":\"\\u4e2d\\u56fd\\u94f6\\u884c\",\"bk_zh1\":\"\\u4e2d\\u56fd\\u94f6\\u884c\\u82b1\\u5c71\\u652f\\u884c\",\"bkc1\":\"1111111111111111\",\"name1\":\"\\u5927\\u961f\\u957f\"}', '3123123', '1456302560', '1', '广东 广州 天河', '1455883943', '1', '400', '0', '101', '1', '0', '22000', '0', '30', '/huhui_weixin/web/upload/2016-02-21-26252.jpeg', '3');
INSERT INTO `hl_user` VALUES ('8', '王欢', '王欢', '02a2ef5cd08b238a44d9e8800e9e9d5f', '5acc63c350269be35cce34b2400b59b6', '123456', '12345686', '{\"bk1\":\"\\u4e2d\\u56fd\\u94f6\\u884c\",\"bk_zh1\":\"\\u4e2d\\u56fd\\u94f6\\u884c\\u82b1\\u5c71\\u652f\\u884c\",\"bkc1\":\"1111111111111111\",\"name1\":\"\\u5927\\u961f\\u957f\"}', '17081649731', '1455946875', '1', '广东 广州 白云', '1455946609', '1', '6000', '0', '0', '1', '0', '0', '0', '0', null, '4');
INSERT INTO `hl_user` VALUES ('9', null, '凤', '02a2ef5cd08b238a44d9e8800e9e9d5f', '5acc63c350269be35cce34b2400b59b6', null, null, null, '13265378462', null, '1', '广东 广州 白云', '1455947778', '1', null, '0', '0', '1', '0', '0', '0', '0', null, '4');
INSERT INTO `hl_user` VALUES ('10', '零', 'shelain', '202cb962ac59075b964b07152d234b70', '202cb962ac59075b964b07152d234b70', '', '', '{\"bk1\":\"\\u4e2d\\u56fd\\u94f6\\u884c\",\"bk_zh1\":\"\\u4e2d\\u56fd\\u94f6\\u884c\\u82b1\\u5c71\\u652f\\u884c\",\"bkc1\":\"1111111111111111\",\"name1\":\"\\u5927\\u961f\\u957f\"}', '13570583080', '1456292865', '1', '广东 广州 天河', '1456107481', '1', '4900', '0', '0', '1', '0', '600', '0', '0', null, '5');
INSERT INTO `hl_user` VALUES ('11', null, '12', 'c20ad4d76fe97759aa27a0c99bff6710', 'c20ad4d76fe97759aa27a0c99bff6710', null, null, null, '18392676925', null, '1', '广东 广州 天河', '1456107977', '0', null, '0', '0', '1', '0', '0', '0', '0', null, '5');
INSERT INTO `hl_user` VALUES ('12', 'Qwert', 'Warnstar', 'e10adc3949ba59abbe56e057f20f883e', 'e10adc3949ba59abbe56e057f20f883e', 'Djdn', 'Jdfjjd', '{\"bk1\":\"\\u4e2d\\u56fd\\u94f6\\u884c\",\"bk_zh1\":\"\\u4e2d\\u56fd\\u94f6\\u884c\\u82b1\\u5c71\\u652f\\u884c\",\"bkc1\":\"1111111111111111\",\"name1\":\"\\u5927\\u961f\\u957f\"}', '7192837912', '1456109340', '1', '广东 广州 天河', '1456109304', '1', null, '0', '0', '1', '0', '0', '0', '0', null, '5');
INSERT INTO `hl_user` VALUES ('13', '朝鲜飞行员', 'coroqq', '29c3eea3f305d6b823f562ac4be35217', '29c3eea3f305d6b823f562ac4be35217', '1356043333', '1356043333', '{\"bk1\":\"\\u4e2d\\u56fd\\u94f6\\u884c\",\"bk_zh1\":\"\\u4e2d\\u56fd\\u94f6\\u884c\\u82b1\\u5c71\\u652f\\u884c\",\"bkc1\":\"1111111111111111\",\"name1\":\"\\u5927\\u961f\\u957f\"}', '13922219523', '1456112453', '1', '广东 广州 天河', '1456112410', '1', '2000', '0', '0', '1', '0', '21000', '0', '0', null, '6');
INSERT INTO `hl_user` VALUES ('14', 'Qwe', 'Test', '7694f4a66316e53c8cdd9d9954bd611d', 'a384b6463fc216a5f8ecb6670f86456a', 'Qwe', 'Qwe', '{\"bk1\":\"\\u4e2d\\u56fd\\u94f6\\u884c\",\"bkc1\":\"1111111111111111\",\"bk_zh1\":\"\\u4e2d\\u56fd\\u94f6\\u884c\\u4e1c\\u5703\\u652f\\u884c\",\"name1\":\"\\u5927\\u961f\\u957f\",\"bk2\":\"\",\"bkc2\":\"\",\"bk_zh2\":\"\",\"name2\":\"\"}', '3123123123', '1456300355', '888888888', '广东 广州 天河', '1456208619', '1', '700', '0', '0', '1', '0', '0', '0', '0', '/huhui_weixin/web/upload/2016-02-23-35422.png', '5');
INSERT INTO `hl_user` VALUES ('15', 'aa', 'coro12', 'e10adc3949ba59abbe56e057f20f883e', 'e10adc3949ba59abbe56e057f20f883e', '123456', '123456', '{\"bk1\":\"123456\",\"bk_zh1\":\"123456\",\"bkc1\":\"1234567891234567890\",\"name1\":\"aa\"}', '546456', '1457172260', '1', '广东 广州 天河', '1456208628', '1', '500', '0', '0', '1', '0', '10250', '0', '0', null, '7');
INSERT INTO `hl_user` VALUES ('16', '朝鲜飞行大队', 'coro111', 'e10adc3949ba59abbe56e057f20f883e', 'e10adc3949ba59abbe56e057f20f883e', '123', '123', '{\"bk1\":\"123\",\"bk_zh1\":\"zg\",\"bkc1\":\"1111111111111111111\",\"name1\":\"\\u671d\\u9c9c\\u98de\\u884c\\u5927\\u961f\",\"bk2\":\"21321321\",\"bk_zh2\":\"1111111111111111111\",\"bkc2\":\"1111111111111111111\",\"name2\":\"2312312\"}', '56546', '1456566961', '1', '::1', '1456566767', '1', null, '0', '0', '1', '0', '0', '3000', '3000', null, '8');

-- ----------------------------
-- Table structure for hl_user_relation
-- ----------------------------
DROP TABLE IF EXISTS `hl_user_relation`;
CREATE TABLE `hl_user_relation` (
  `user_id` int(32) unsigned NOT NULL COMMENT '用户名',
  `parent_id` int(32) unsigned NOT NULL COMMENT '推荐人 推荐人为0时表示顶级',
  `create_time` int(32) DEFAULT NULL COMMENT '时间',
  PRIMARY KEY (`user_id`,`parent_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of hl_user_relation
-- ----------------------------
INSERT INTO `hl_user_relation` VALUES ('1', '0', '1455525982');
INSERT INTO `hl_user_relation` VALUES ('2', '7', '1455529177');
INSERT INTO `hl_user_relation` VALUES ('3', '7', '1455588949');
INSERT INTO `hl_user_relation` VALUES ('4', '3', '1455600922');
INSERT INTO `hl_user_relation` VALUES ('5', '4', '1455606761');
INSERT INTO `hl_user_relation` VALUES ('6', '5', '1455619048');
INSERT INTO `hl_user_relation` VALUES ('7', '0', '1455883943');
INSERT INTO `hl_user_relation` VALUES ('8', '5', '1455946609');
INSERT INTO `hl_user_relation` VALUES ('9', '5', '1455947778');
INSERT INTO `hl_user_relation` VALUES ('10', '0', '1456107481');
INSERT INTO `hl_user_relation` VALUES ('11', '0', '1456107977');
INSERT INTO `hl_user_relation` VALUES ('12', '11', '1456109304');
INSERT INTO `hl_user_relation` VALUES ('13', '7', '1456112410');
INSERT INTO `hl_user_relation` VALUES ('14', '0', '1456208619');
INSERT INTO `hl_user_relation` VALUES ('15', '0', '1456208629');
INSERT INTO `hl_user_relation` VALUES ('16', '0', '1456566767');

-- ----------------------------
-- View structure for child_gethelps
-- ----------------------------
DROP VIEW IF EXISTS `child_gethelps`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`%` SQL SECURITY DEFINER VIEW `child_gethelps` AS select `hl_gethelp`.`get_id` AS `get_id`,`hl_gethelp`.`user_id` AS `user_id`,`hl_gethelp`.`money` AS `money`,`hl_gethelp`.`match_time` AS `match_time`,`hl_gethelp`.`create_time` AS `create_time`,`hl_gethelp`.`status` AS `status`,`hl_gethelp`.`type` AS `type`,`hl_user`.`nickname` AS `nickname`,`hl_user`.`phone` AS `phone`,`hl_user_relation`.`parent_id` AS `parent_id`,`parent_user`.`nickname` AS `parent_nickname`,`parent_user`.`phone` AS `parent_phone`,`hl_orders`.`mate_id` AS `help_id`,`hl_orders`.`status` AS `order_status` from ((((`hl_gethelp` left join `hl_user` on((`hl_user`.`user_id` = `hl_gethelp`.`user_id`))) left join `hl_user_relation` on((`hl_user_relation`.`user_id` = `hl_user`.`user_id`))) left join `hl_orders` on((`hl_orders`.`get_id` = `hl_gethelp`.`get_id`))) left join `hl_user` `parent_user` on((`hl_user_relation`.`parent_id` = `parent_user`.`user_id`))) ;

-- ----------------------------
-- View structure for child_payhelps
-- ----------------------------
DROP VIEW IF EXISTS `child_payhelps`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`%` SQL SECURITY DEFINER VIEW `child_payhelps` AS select `hl_payhelp`.`pay_id` AS `pay_id`,`hl_payhelp`.`user_id` AS `user_id`,`hl_payhelp`.`money` AS `money`,`hl_payhelp`.`match_time` AS `match_time`,`hl_payhelp`.`create_time` AS `create_time`,`hl_payhelp`.`status` AS `status`,`hl_user`.`nickname` AS `nickname`,`hl_user`.`phone` AS `phone`,`hl_user_relation`.`parent_id` AS `parent_id`,`parent_user`.`nickname` AS `parent_nickname`,`parent_user`.`phone` AS `parent_phone`,`hl_orders`.`mate_id` AS `help_id`,`hl_orders`.`status` AS `order_status` from ((((`hl_payhelp` left join `hl_user` on((`hl_user`.`user_id` = `hl_payhelp`.`user_id`))) left join `hl_user_relation` on((`hl_user_relation`.`user_id` = `hl_user`.`user_id`))) left join `hl_orders` on((`hl_orders`.`pay_id` = `hl_payhelp`.`pay_id`))) left join `hl_user` `parent_user` on((`hl_user_relation`.`parent_id` = `parent_user`.`user_id`))) ;

-- ----------------------------
-- View structure for order_detail
-- ----------------------------
DROP VIEW IF EXISTS `order_detail`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `order_detail` AS select `hl_orders`.`mate_id` AS `mate_id`,`hl_orders`.`pay_id` AS `pay_id`,`hl_orders`.`get_id` AS `get_id`,`hl_orders`.`money` AS `money`,`hl_orders`.`create_time` AS `create_time`,`hl_orders`.`need_time` AS `need_time`,`hl_orders`.`status` AS `status`,`hl_gethelp`.`user_id` AS `get_user_id`,`hl_payhelp`.`user_id` AS `pay_user_id`,`pay_user`.`nickname` AS `pay_user_nickname`,`get_user`.`nickname` AS `get_user_nickname` from ((((`hl_orders` left join `hl_gethelp` on((`hl_orders`.`get_id` = `hl_gethelp`.`get_id`))) left join `hl_payhelp` on((`hl_orders`.`pay_id` = `hl_payhelp`.`pay_id`))) left join `hl_user` `pay_user` on((`hl_payhelp`.`user_id` = `pay_user`.`user_id`))) left join `hl_user` `get_user` on((`hl_gethelp`.`user_id` = `get_user`.`user_id`))) ;
