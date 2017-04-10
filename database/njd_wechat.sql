/*
 Navicat Premium Data Transfer

 Source Server         : localhost
 Source Server Type    : MySQL
 Source Server Version : 50715
 Source Host           : localhost
 Source Database       : njd_wechat

 Target Server Type    : MySQL
 Target Server Version : 50715
 File Encoding         : utf-8

 Date: 04/10/2017 21:20:02 PM
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
--  Table structure for `backmenu`
-- ----------------------------
DROP TABLE IF EXISTS `backmenu`;
CREATE TABLE `backmenu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '菜单名',
  `pid` int(11) unsigned NOT NULL COMMENT '菜单类型',
  `sort` int(11) NOT NULL DEFAULT '0',
  `url` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `hide` tinyint(1) unsigned NOT NULL COMMENT '侧边栏显示',
  `route` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `group` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '网站顶部显示',
  `is_dev` tinyint(1) DEFAULT NULL,
  `is_active` tinyint(1) unsigned DEFAULT NULL COMMENT '网站底部显示',
  `icon` varchar(55) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '导航图标',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=122 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
--  Records of `backmenu`
-- ----------------------------
BEGIN;
INSERT INTO `backmenu` VALUES ('3', '网站配置管理', '0', '2', 'backmenu', '0', 'BackmenuController@index', null, null, null, 'fa-cogs'), ('4', '后台菜单列表', '3', '1', 'backmenu', '0', 'BackmenuController@index', null, null, null, null), ('5', '新增后台菜单', '3', '2', '', '1', 'BackmenuController@create', null, null, null, null), ('6', '新增后台菜单处理', '3', '3', '', '1', 'BackmenuController@store', null, null, null, null), ('7', '修改后台菜单', '3', '4', null, '1', 'BackmenuController@edit', null, null, null, null), ('8', '修改后台菜单处理', '3', '5', null, '1', 'BackmenuController@update', null, null, null, null), ('9', '删除后台菜单', '3', '6', null, '1', 'BackmenuController@destroy', null, null, null, null), ('10', 'RBAC', '0', '3', 'user', '0', 'UserController@index', null, null, null, 'fa-users'), ('11', '后台用户列表', '10', '0', 'user', '0', 'UserController@index', null, null, null, ''), ('12', '新增后台用户', '10', '0', '', '1', 'UserController@create', null, null, null, ''), ('13', '新增后台用户处理', '10', '0', '', '1', 'UserController@store', null, null, null, ''), ('14', '修改后台用户', '10', '0', '', '1', 'UserController@edit', null, null, null, ''), ('15', '修改后台用户处理', '10', '0', '', '1', 'UserController@update', null, null, null, ''), ('16', '删除后台用户', '10', '0', null, '1', 'UserController@destroy', null, null, null, null), ('17', '修改账户状态', '10', '0', null, '1', 'UserController@active', null, null, null, null), ('18', '角色列表', '10', '0', 'role', '0', 'RoleController@index', null, null, null, ''), ('19', '新增角色', '10', '0', null, '1', 'RoleController@create', null, null, null, null), ('20', '新增角色处理', '10', '0', null, '1', 'RoleController@store', null, null, null, null), ('21', '修改角色', '10', '0', null, '1', 'RoleController@edit', null, null, null, null), ('22', '修改角色处理', '10', '0', null, '1', 'RoleController@update', null, null, null, null), ('23', '删除角色', '10', '0', null, '1', 'RoleController@destroy', null, null, null, null), ('24', '权限列表', '10', '0', 'node', '0', 'NodeController@index', null, null, null, null), ('25', '新增权限', '10', '0', null, '1', 'NodeController@create', null, null, null, null), ('26', '新增权限处理', '10', '0', null, '1', 'NodeController@store', null, null, null, null), ('27', '修改权限', '10', '0', null, '1', 'NodeController@edit', null, null, null, null), ('28', '修改权限处理', '10', '0', null, '1', 'NodeController@update', null, null, null, null), ('29', '删除权限', '10', '0', null, '1', 'NodeController@destroy', null, null, null, null), ('30', '网站首页', '0', '0', null, '1', 'IndexController@index', null, null, null, null), ('69', '修改用户密码', '10', '0', null, '1', 'UserController@changePwd', null, null, null, null), ('113', '客户管理', '0', '0', null, '0', 'ClientController@index', null, null, null, 'fa-tags'), ('114', '客户列表', '113', '1', 'client', '0', 'ClientController@index', null, null, null, null), ('115', '客户新增', '113', '1', '', '1', 'ClientController@create', null, null, null, null), ('116', '客户新增处理', '113', '1', '', '1', 'ClientController@store', null, null, null, null), ('117', '客户修改', '113', '1', '', '1', 'ClientController@edit', null, null, null, null), ('118', '客户修改处理', '113', '1', '', '1', 'ClientController@update', null, null, null, null), ('119', '客户删除', '113', '1', '', '1', 'ClientController@destroy', null, null, null, null), ('120', '添加备注', '113', '0', null, '1', 'ClientController@remark', null, null, null, null), ('121', '更改客户状态', '113', '0', null, '1', 'ClientController@changeStatus', null, null, null, null);
COMMIT;

-- ----------------------------
--  Table structure for `client`
-- ----------------------------
DROP TABLE IF EXISTS `client`;
CREATE TABLE `client` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(55) NOT NULL COMMENT '姓名',
  `tel` char(11) NOT NULL COMMENT '手机号',
  `sex` tinyint(1) NOT NULL DEFAULT '1' COMMENT '性别 默认1男性 2女性',
  `house_type` tinyint(1) NOT NULL COMMENT '房屋性质  1住宅 2商用',
  `house_addr` text NOT NULL COMMENT '房屋地址',
  `house_area` int(11) NOT NULL COMMENT '房屋面积',
  `create_time` int(11) DEFAULT NULL COMMENT '评估时间',
  `price` float(10,2) DEFAULT NULL COMMENT '房屋价格',
  `status` int(11) NOT NULL DEFAULT '1' COMMENT '1已评估 2已申请 3有效客户 4无效客户',
  `remark` text COMMENT '备注说明',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `client`
-- ----------------------------
BEGIN;
INSERT INTO `client` VALUES ('1', '王', '15720826619', '1', '1', '南京市鼓楼区', '90', null, '200.00', '3', 'ok11');
COMMIT;

-- ----------------------------
--  Table structure for `node`
-- ----------------------------
DROP TABLE IF EXISTS `node`;
CREATE TABLE `node` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `title` varchar(50) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '0',
  `remark` varchar(255) DEFAULT NULL,
  `sort` smallint(6) unsigned DEFAULT NULL,
  `pid` smallint(6) unsigned DEFAULT NULL COMMENT '节点ID',
  `level` tinyint(1) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `level` (`level`) USING BTREE,
  KEY `pid` (`pid`) USING BTREE,
  KEY `status` (`status`) USING BTREE,
  KEY `name` (`name`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `node`
-- ----------------------------
BEGIN;
INSERT INTO `node` VALUES ('2', '客户管理', null, '0', '客户管理相关', null, null, null);
COMMIT;

-- ----------------------------
--  Table structure for `node_backmenu`
-- ----------------------------
DROP TABLE IF EXISTS `node_backmenu`;
CREATE TABLE `node_backmenu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `node_id` int(11) NOT NULL,
  `backmenu_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `node_id_btree` (`node_id`) USING BTREE,
  KEY `backmenu_id_btree` (`backmenu_id`) USING BTREE,
  CONSTRAINT `node_backmenu_ibfk_1` FOREIGN KEY (`backmenu_id`) REFERENCES `backmenu` (`id`) ON DELETE CASCADE,
  CONSTRAINT `node_backmenu_ibfk_2` FOREIGN KEY (`node_id`) REFERENCES `node` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `node_backmenu`
-- ----------------------------
BEGIN;
INSERT INTO `node_backmenu` VALUES ('26', '2', '69'), ('27', '2', '30'), ('28', '2', '113'), ('29', '2', '114'), ('30', '2', '115'), ('31', '2', '116'), ('32', '2', '117'), ('33', '2', '118'), ('34', '2', '119'), ('35', '2', '120'), ('36', '2', '121');
COMMIT;

-- ----------------------------
--  Table structure for `role`
-- ----------------------------
DROP TABLE IF EXISTS `role`;
CREATE TABLE `role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `pid` smallint(6) DEFAULT NULL,
  `status` tinyint(1) unsigned DEFAULT NULL,
  `remark` varchar(255) DEFAULT NULL,
  `menu_ids` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pid` (`pid`) USING BTREE,
  KEY `status` (`status`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `role`
-- ----------------------------
BEGIN;
INSERT INTO `role` VALUES ('2', '客户经理', null, null, '拥有客户管理权限', null);
COMMIT;

-- ----------------------------
--  Table structure for `role_node`
-- ----------------------------
DROP TABLE IF EXISTS `role_node`;
CREATE TABLE `role_node` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` int(11) NOT NULL,
  `node_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `role_id_role_node_key` (`role_id`),
  KEY `node_id_role_node_id` (`node_id`),
  CONSTRAINT `role_node_ibfk_1` FOREIGN KEY (`node_id`) REFERENCES `node` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_node_ibfk_2` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `role_node`
-- ----------------------------
BEGIN;
INSERT INTO `role_node` VALUES ('2', '2', '2');
COMMIT;

-- ----------------------------
--  Table structure for `role_user`
-- ----------------------------
DROP TABLE IF EXISTS `role_user`;
CREATE TABLE `role_user` (
  `role_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  KEY `group_id` (`role_id`) USING BTREE,
  KEY `user_id` (`user_id`) USING BTREE,
  CONSTRAINT `role_user_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_user_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `role_user`
-- ----------------------------
BEGIN;
INSERT INTO `role_user` VALUES ('2', '3');
COMMIT;

-- ----------------------------
--  Table structure for `user`
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '用户表id',
  `name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `logins` int(11) DEFAULT NULL,
  `last_login` int(11) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `user`
-- ----------------------------
BEGIN;
INSERT INTO `user` VALUES ('1', 'admin', '23b959dab5b0be5a5b58a8bb0fbb73b3', '39', '1491823263', '1'), ('3', 'manager', 'f6fdffe48c908deb0f4c3bd36c032e72', '1', '1491830201', '1');
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;
