/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50547
Source Host           : localhost:3306
Source Database       : blog_laravel

Target Server Type    : MYSQL
Target Server Version : 50547
File Encoding         : 65001

Date: 2016-11-16 22:07:31
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for my_article
-- ----------------------------
DROP TABLE IF EXISTS `my_article`;
CREATE TABLE `my_article` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL COMMENT '标题',
  `author` varchar(126) DEFAULT NULL COMMENT '作者',
  `tag` varchar(255) DEFAULT NULL,
  `thumb` varchar(255) DEFAULT NULL COMMENT '缩略图',
  `content` text COMMENT '内容',
  `description` varchar(255) DEFAULT NULL COMMENT '描述',
  `addtime` int(10) unsigned DEFAULT NULL COMMENT '时间',
  `updatetime` int(10) unsigned DEFAULT NULL,
  `viewnum` int(10) unsigned DEFAULT '0' COMMENT '查看次数',
  `cate_id` int(10) unsigned DEFAULT NULL COMMENT '分类id',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COMMENT='文章表';

-- ----------------------------
-- Table structure for my_category
-- ----------------------------
DROP TABLE IF EXISTS `my_category`;
CREATE TABLE `my_category` (
  `cate_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '主键',
  `cate_name` varchar(255) NOT NULL COMMENT '名称',
  `cate_title` varchar(255) NOT NULL,
  `cate_keywords` varchar(255) DEFAULT NULL,
  `cate_desc` varchar(255) DEFAULT NULL,
  `cate_view` int(11) unsigned DEFAULT '0' COMMENT '查看次数',
  `cate_order` tinyint(3) unsigned DEFAULT '0' COMMENT '排序',
  `cate_pid` int(10) unsigned DEFAULT '0' COMMENT '父级ID',
  PRIMARY KEY (`cate_id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COMMENT='文章分类';

-- ----------------------------
-- Table structure for my_config
-- ----------------------------
DROP TABLE IF EXISTS `my_config`;
CREATE TABLE `my_config` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `content` text,
  `order` int(11) NOT NULL DEFAULT '0',
  `tips` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `value` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for my_link
-- ----------------------------
DROP TABLE IF EXISTS `my_link`;
CREATE TABLE `my_link` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `link_name` varchar(255) DEFAULT NULL,
  `link_url` varchar(255) DEFAULT NULL,
  `link_order` int(11) DEFAULT '0',
  `link_title` varchar(255) DEFAULT NULL,
  `add_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for my_navs
-- ----------------------------
DROP TABLE IF EXISTS `my_navs`;
CREATE TABLE `my_navs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nav_name` varchar(255) DEFAULT NULL,
  `nav_alias` varchar(255) DEFAULT NULL,
  `nav_url` varchar(255) DEFAULT NULL,
  `nav_order` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for my_user
-- ----------------------------
DROP TABLE IF EXISTS `my_user`;
CREATE TABLE `my_user` (
  `user_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(264) NOT NULL COMMENT '用户名',
  `password` varchar(255) NOT NULL COMMENT '密码',
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='管理员表';
