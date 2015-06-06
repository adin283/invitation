/*
 Navicat Premium Data Transfer

 Source Server         : localhost
 Source Server Type    : MySQL
 Source Server Version : 50538
 Source Host           : localhost
 Source Database       : wedding

 Target Server Type    : MySQL
 Target Server Version : 50538
 File Encoding         : utf-8

 Date: 06/06/2015 12:34:32 PM
*/

SET NAMES utf8;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
--  Table structure for `wd_comment`
-- ----------------------------
DROP TABLE IF EXISTS `wd_comment`;
CREATE TABLE `wd_comment` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ctime` datetime NOT NULL,
  `name` varchar(100) NOT NULL,
  `reply_num` int(5) unsigned NOT NULL,
  `present_address` tinyint(5) unsigned NOT NULL COMMENT '0新郎方；1新娘方；2两方都出席',
  `content` text,
  `ip_address` mediumint(9) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `wd_upload_pic`
-- ----------------------------
DROP TABLE IF EXISTS `wd_upload_pic`;
CREATE TABLE `wd_upload_pic` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ctime` datetime NOT NULL,
  `pic_path` varchar(255) NOT NULL,
  `ip_address` mediumint(9) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `wd_wedding_photo`
-- ----------------------------
DROP TABLE IF EXISTS `wd_wedding_photo`;
CREATE TABLE `wd_wedding_photo` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ctime` datetime NOT NULL,
  `original` varchar(255) NOT NULL,
  `thumb` varchar(255) NOT NULL,
  `order_id` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

SET FOREIGN_KEY_CHECKS = 1;
