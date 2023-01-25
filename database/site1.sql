/*
Navicat MariaDB Data Transfer

Source Server         : localsite1
Source Server Version : 101101
Source Host           : localhost:3306
Source Database       : site1

Target Server Type    : MariaDB
Target Server Version : 101101
File Encoding         : 65001

Date: 2023-01-25 10:50:48
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for tag
-- ----------------------------
DROP TABLE IF EXISTS `tag`;
CREATE TABLE `tag` (
  `tagid` int(20) NOT NULL AUTO_INCREMENT,
  `tag` varchar(255) DEFAULT NULL,
  `tag_code` varchar(255) DEFAULT NULL,
  `tag_describe` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`tagid`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
-- Records of tag
-- ----------------------------
INSERT INTO `tag` VALUES ('1', '测试标签', 'test', '');
INSERT INTO `tag` VALUES ('2', '光盘', 'test2', '是网站测试过程中使用的标签。');
INSERT INTO `tag` VALUES ('3', '书本', 'book', '');
INSERT INTO `tag` VALUES ('4', '学习用具', 'learning_tools', '');
INSERT INTO `tag` VALUES ('5', '电脑', 'computer', '');
INSERT INTO `tag` VALUES ('6', '手机', 'mobile_phone', '');
INSERT INTO `tag` VALUES ('7', '文件', 'file', '');

-- ----------------------------
-- Table structure for things
-- ----------------------------
DROP TABLE IF EXISTS `things`;
CREATE TABLE `things` (
  `tid` int(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `things_describe` varchar(5000) DEFAULT '',
  `type` varchar(4) DEFAULT NULL,
  `add_uid` int(20) DEFAULT NULL,
  `comp_uid` int(20) DEFAULT NULL,
  `tag_about` varchar(255) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `communication` varchar(255) DEFAULT NULL,
  `img_path` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`tid`),
  KEY `tid` (`tid`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
-- Records of things
-- ----------------------------
INSERT INTO `things` VALUES ('1', '手机', '一部iPhone13', '1', '2', '0', null, '园区东门', '2023-01-17 08:28:08', 'test02@qq.com', null);
INSERT INTO `things` VALUES ('2', 'book', 'blue lily book', null, null, null, null, 'building east-401', '2023-01-17 10:04:54', 'test02@qq.com', null);
INSERT INTO `things` VALUES ('3', '笔记本电脑', '封面上有浅蓝色痛贴，上部有blue lily字样。', null, null, null, null, '东一楼边上的小亭子', '2023-01-17 10:04:57', 'test02@qq.com', null);
INSERT INTO `things` VALUES ('4', '测试物品', '一件测试物品', null, '2', null, null, '某个地点', '0000-00-00 00:00:00', 'test02', null);
INSERT INTO `things` VALUES ('5', '测试物品', '一件测试物品', null, '2', null, null, 'testlocation', '0000-00-00 00:00:00', 'test02', null);
INSERT INTO `things` VALUES ('9', '书', '一本《苏菲的世界》', '矢主寻物', '2', null, null, '实验楼二楼准备室', '2023-01-17 14:23:33', 'test02@qq.com', null);
INSERT INTO `things` VALUES ('11', '钢笔', 'test', '矢主寻物', '2', null, '2,4', 'test', '2023-01-19 13:35:19', 'test02@qq.com', './uploads/imgs/things/');
INSERT INTO `things` VALUES ('12', '测试', 'test', '矢主寻物', '2', null, '1,2', 'site2', '2023-01-19 13:38:16', 'test02@qq.com', './uploads/imgs/things/');
INSERT INTO `things` VALUES ('13', '测试', 'test', '矢主寻物', '2', null, '1,2', 'site2', '2023-01-19 14:36:07', 'test02@qq.com', './uploads/imgs/things/');
INSERT INTO `things` VALUES ('14', '测试', 'test', '矢主寻物', '2', null, '1,2', 'site2', '2023-01-19 14:42:33', 'test02@qq.com', './uploads/imgs/things/');
INSERT INTO `things` VALUES ('15', '黑金钢笔', '一支黑金色钢笔', '拾物寻主', '2', '4', '1,2,4', '呼吸内科2室', '2023-01-23 19:20:59', 'test02@qq.com', './uploads/imgs/things/202301231920596516.png');

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `uid` bigint(20) NOT NULL AUTO_INCREMENT,
  `username` varchar(64) NOT NULL,
  `password` varchar(256) NOT NULL,
  `mail` varchar(64) DEFAULT '',
  `phone` bigint(50) DEFAULT NULL,
  `reg_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `reg_ip` text DEFAULT NULL,
  `last_log_ip` text DEFAULT NULL,
  `isdelete` tinyint(4) DEFAULT 0,
  `admin_tag` varchar(255) DEFAULT '',
  PRIMARY KEY (`uid`),
  KEY `userid` (`uid`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES ('1', 'test01', '12345678', 'test01@qq.com', '123456789', '2023-01-23 15:22:11', null, null, '0', null);
INSERT INTO `user` VALUES ('2', 'test02', '$2y$10$6yeWw2fm1W92WC0BDoQytuzNdentOT6pI5Sw6hcAPdT1y/bVCKEp2', 'test01@qq.com', '13299999999', '2023-01-24 15:13:38', null, null, '0', '1');
INSERT INTO `user` VALUES ('3', 'test03', '$2y$10$ylyMiCeh.3nOPjjwZw8epe111llF3tdGIXyuxzk.Eet9zOlO0TDZS', 'test03@qq.com', '13999999999', '2023-01-17 10:05:12', '2409:8a30:ca12:5a60::10', null, '0', null);
INSERT INTO `user` VALUES ('4', 'huama', '$2y$10$SdDLvJNasdrrA7ajTE5QweUC/7R5Tuooauxii9NJbH5s6h8Rynd9O', 'lian9998@Outlook.com', '13912344321', '2023-01-16 19:46:29', '2408:8207:2510:c361:ee8c:b491:c1bf:b53b', null, '0', null);
INSERT INTO `user` VALUES ('5', 'huama', '$2y$10$SdDLvJNasdrrA7ajTE5QweUC/7R5Tuooauxii9NJbH5s6h8Rynd9O', 'huama@huama.huama', '78121781211', '2023-01-16 19:46:29', '2408:8207:2510:c361:c0e2:557:812f:d5f8', null, '0', null);
INSERT INTO `user` VALUES ('6', 'huama2', '$2y$10$E5nu1k/u5nJtFsZBsc83IeCoPIaWNreXsB.Qj2TDWG8TTTHbaubca', 'huama@huama.huama', '78121781211', '2023-01-17 10:05:16', '2408:8207:2510:c361:c0e2:557:812f:d5f8', null, '0', null);

-- ----------------------------
-- Table structure for user_info
-- ----------------------------
DROP TABLE IF EXISTS `user_info`;
CREATE TABLE `user_info` (
  `uid` bigint(20) NOT NULL AUTO_INCREMENT,
  `gra_url` varchar(255) DEFAULT NULL,
  `back_url` varchar(255) DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `region` varchar(255) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `aboutme` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`uid`),
  CONSTRAINT `user_info_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `user` (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
-- Records of user_info
-- ----------------------------
