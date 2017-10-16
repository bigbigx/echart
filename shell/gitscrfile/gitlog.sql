/*
Navicat MySQL Data Transfer

Source Server         : 192.168.56.253
Source Server Version : 50631
Source Host           : 192.168.56.253:3306
Source Database       : gitlog

Target Server Type    : MYSQL
Target Server Version : 50631
File Encoding         : 65001

Date: 2017-03-15 11:48:24
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for gitlog
-- ----------------------------
DROP TABLE IF EXISTS `gitlog`;
CREATE TABLE `gitlog` (
  `sdate` date NOT NULL,
  `edate` date NOT NULL,
  `author` varchar(100) NOT NULL,
  `line` int(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
