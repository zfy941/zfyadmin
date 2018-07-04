/*
Navicat MySQL Data Transfer

Source Server         : 本地
Source Server Version : 100131
Source Host           : localhost:3306
Source Database       : tladmin

Target Server Type    : MYSQL
Target Server Version : 100131
File Encoding         : 65001

Date: 2018-04-17 17:39:23
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for dede_shop_recommend
-- ----------------------------
DROP TABLE IF EXISTS `dede_shop_recommend`;
CREATE TABLE `dede_shop_recommend` (
  `id` int(5) unsigned NOT NULL AUTO_INCREMENT,
  `table_name` varchar(20) NOT NULL DEFAULT '' COMMENT '商品所在表名',
  `gid` int(10) NOT NULL COMMENT '商品所在表的id',
  `type` tinyint(2) NOT NULL COMMENT '类型（前台根据这个跳转到不同详情页）六个类型',
  `sort` int(4) NOT NULL COMMENT '排序',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '状态',
  `add_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='商品推荐表';

-- ----------------------------
-- Records of dede_shop_recommend
-- ----------------------------

-- ----------------------------
-- Table structure for tl_admin_user
-- ----------------------------
DROP TABLE IF EXISTS `tl_admin_user`;
CREATE TABLE `tl_admin_user` (
  `id` int(4) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(10) NOT NULL DEFAULT '' COMMENT '用户名',
  `password` char(32) NOT NULL DEFAULT '' COMMENT '密码',
  `head_img` varchar(125) NOT NULL DEFAULT '/static/images/head_img.png' COMMENT '头像',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '状态',
  `add_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of tl_admin_user
-- ----------------------------
INSERT INTO `tl_admin_user` VALUES ('1', 'admin', 'e10adc3949ba59abbe56e057f20f883e', '/static/images/head_img.png', '1', '222');
INSERT INTO `tl_admin_user` VALUES ('2', '周逢宇', 'e10adc3949ba59abbe56e057f20f883e', '/static/images/head_img.png', '1', '0');

-- ----------------------------
-- Table structure for tl_auth_group
-- ----------------------------
DROP TABLE IF EXISTS `tl_auth_group`;
CREATE TABLE `tl_auth_group` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `title` char(100) NOT NULL DEFAULT '' COMMENT '组名称',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态',
  `redirect_url` varchar(100) NOT NULL DEFAULT '/' COMMENT '跳转',
  `rules` varchar(255) NOT NULL DEFAULT '' COMMENT '拥有的规则',
  `add_time` varchar(20) NOT NULL DEFAULT '0' COMMENT '时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of tl_auth_group
-- ----------------------------
INSERT INTO `tl_auth_group` VALUES ('1', '超级管理员', '1', '/', '1,2', '33');

-- ----------------------------
-- Table structure for tl_auth_group_access
-- ----------------------------
DROP TABLE IF EXISTS `tl_auth_group_access`;
CREATE TABLE `tl_auth_group_access` (
  `uid` mediumint(8) unsigned NOT NULL COMMENT '后台用户ID',
  `group_id` mediumint(8) unsigned NOT NULL COMMENT '后台分组ID',
  UNIQUE KEY `uid_group_id` (`uid`,`group_id`),
  KEY `uid` (`uid`),
  KEY `group_id` (`group_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=FIXED;

-- ----------------------------
-- Records of tl_auth_group_access
-- ----------------------------
INSERT INTO `tl_auth_group_access` VALUES ('1', '1');

-- ----------------------------
-- Table structure for tl_auth_rule
-- ----------------------------
DROP TABLE IF EXISTS `tl_auth_rule`;
CREATE TABLE `tl_auth_rule` (
  `id` int(8) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  `pid` int(8) unsigned NOT NULL DEFAULT '0' COMMENT '父ID',
  `name` char(80) NOT NULL DEFAULT '' COMMENT '权限规则',
  `title` char(20) NOT NULL DEFAULT '' COMMENT '权限标题（名称）',
  `icon` varchar(25) NOT NULL DEFAULT '' COMMENT '图标',
  `type` tinyint(1) NOT NULL DEFAULT '1' COMMENT '类型',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态',
  `sort` int(5) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
  `is_show` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '显示',
  `condition` char(100) NOT NULL DEFAULT '' COMMENT '规则附件条件',
  PRIMARY KEY (`id`),
  KEY `name` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of tl_auth_rule
-- ----------------------------
INSERT INTO `tl_auth_rule` VALUES ('1', '0', 'content', '内容管理', 'fa fa-cart-arrow-down', '1', '1', '2', '1', '');
INSERT INTO `tl_auth_rule` VALUES ('2', '0', 'config', '系统管理', 'fa fa-gear', '1', '1', '1', '1', '');
INSERT INTO `tl_auth_rule` VALUES ('3', '0', 'user', '会员管理', 'fa fa-user', '1', '1', '3', '1', '');
INSERT INTO `tl_auth_rule` VALUES ('4', '12', 'menu/menu', '后台菜单', 'fa fa-align-justify', '1', '1', '0', '1', '');
INSERT INTO `tl_auth_rule` VALUES ('5', '1', 'article/article', '文章管理', 'fa fa-file-text-o', '1', '1', '0', '1', '');
INSERT INTO `tl_auth_rule` VALUES ('6', '1', 'goods', '商品管理', 'fa fa-shopping-bag', '1', '1', '0', '1', '');
INSERT INTO `tl_auth_rule` VALUES ('11', '3', 'users/users', '用户列表', 'fa fa-user-md', '1', '1', '0', '1', '');
INSERT INTO `tl_auth_rule` VALUES ('12', '2', '#', '系统设置', 'fa fa-list', '1', '1', '0', '1', '');
INSERT INTO `tl_auth_rule` VALUES ('13', '12', '#', '系统参数', 'fa fa-shopping-bag', '1', '1', '0', '1', '');
INSERT INTO `tl_auth_rule` VALUES ('14', '12', '777', '文件储存', 'fa fa-briefcase', '1', '1', '0', '1', '');
INSERT INTO `tl_auth_rule` VALUES ('15', '2', 'admin', '用户权限', 'fa fa-file-text', '1', '1', '0', '1', '');
INSERT INTO `tl_auth_rule` VALUES ('16', '15', 'admin/index', '用户管理', 'fa fa-user', '1', '1', '0', '1', '');
INSERT INTO `tl_auth_rule` VALUES ('17', '15', 'admin/group', '用户组', 'fa fa-send', '1', '1', '0', '1', '');
INSERT INTO `tl_auth_rule` VALUES ('18', '15', 'admin/rules', '权限列表', 'fa fa-database', '1', '1', '0', '1', '');
