/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50553
Source Host           : localhost:3306
Source Database       : wlywpt

Target Server Type    : MYSQL
Target Server Version : 50553
File Encoding         : 65001

Date: 2019-05-17 09:44:19
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `admin`
-- ----------------------------
DROP TABLE IF EXISTS `admin`;
CREATE TABLE `admin` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `account` varchar(20) NOT NULL,
  `passwd` varchar(50) NOT NULL,
  `create_at` datetime NOT NULL,
  `u_level` tinyint(1) NOT NULL DEFAULT '2',
  `phone` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `crate_id` int(11) NOT NULL DEFAULT '0',
  `u_desc` varchar(30) NOT NULL COMMENT '描述',
  `u_status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1可用2不可用',
  `powers` varchar(200) NOT NULL DEFAULT '0',
  `did` int(11) unsigned NOT NULL COMMENT '部门',
  `rid` int(11) unsigned NOT NULL COMMENT '角色ID',
  `number` varchar(100) NOT NULL COMMENT '编制编号',
  `u_name` varchar(50) NOT NULL COMMENT '用户名称',
  PRIMARY KEY (`id`),
  UNIQUE KEY `account` (`account`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of admin
-- ----------------------------
INSERT INTO `admin` VALUES ('1', 'admin', '18a8680dff0ed5238f778b21ff04e692124ddfe2', '2019-04-30 11:09:34', '1', '18883344575', '1751411453@qq.com', '0', '', '2', '', '0', '0', '10000001', '开发人员');
INSERT INTO `admin` VALUES ('9', 'zkwh', 'e82e2aa3b6bb2f15b355251ac6863f546cd68618', '2019-05-14 11:54:30', '2', '18888888888', '1@qq.com', '9', '111111', '1', '', '11', '9', '10000002', '测试人员大壮');
INSERT INTO `admin` VALUES ('19', 'test', 'e82e2aa3b6bb2f15b355251ac6863f546cd68618', '2019-05-10 10:39:49', '3', '18888888888', '1@qq.com', '9', '1111111', '1', '1,3,4,24,25,5,15,7,12,19,20,21,22,23', '10', '11', '1000003', '凄凄切切');
INSERT INTO `admin` VALUES ('20', 't1111', 'e82e2aa3b6bb2f15b355251ac6863f546cd68618', '2019-05-10 16:03:39', '2', '18888888888', '175555555@qq.com', '9', '测试', '1', '0', '11', '8', '10000031', '凄凄切切他');
INSERT INTO `admin` VALUES ('21', 'juzhang', 'e82e2aa3b6bb2f15b355251ac6863f546cd68618', '2019-05-15 14:29:05', '2', '18888888888', '1@qq.com', '9', '他是局长', '1', '0', '12', '14', '120000000001', '采购负责人李四');

-- ----------------------------
-- Table structure for `category`
-- ----------------------------
DROP TABLE IF EXISTS `category`;
CREATE TABLE `category` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `c_name` varchar(50) NOT NULL,
  `c_url` varchar(100) NOT NULL,
  `c_pid` int(11) NOT NULL DEFAULT '0',
  `c_path` varchar(100) NOT NULL DEFAULT '0',
  `c_time_at` datetime NOT NULL,
  `c_time_upd` datetime NOT NULL,
  `c_userid` int(11) NOT NULL,
  `icon` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique` (`c_name`,`c_pid`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of category
-- ----------------------------
INSERT INTO `category` VALUES ('1', '部门管理', '', '0', '0', '2019-04-26 16:06:43', '2019-05-07 16:20:20', '0', '&#xe62b;');
INSERT INTO `category` VALUES ('20', '工具列表', 'ctrl=tools', '19', '0', '2019-04-29 12:44:05', '2019-05-10 17:18:22', '0', '');
INSERT INTO `category` VALUES ('3', '权限列表', 'ctrl=user&amp;action=permission', '26', '0', '2019-04-25 16:25:33', '2019-05-10 12:12:25', '0', '');
INSERT INTO `category` VALUES ('4', '人员列表', 'ctrl=user', '1', '0', '2019-04-25 16:25:48', '2019-05-10 12:00:02', '0', '');
INSERT INTO `category` VALUES ('5', '系统管理', '', '0', '0', '2019-04-25 16:27:57', '2019-04-25 17:30:34', '0', '&#xe62e;');
INSERT INTO `category` VALUES ('15', '栏目配置', 'ctrl=category', '5', '0', '2019-04-26 16:14:33', '2019-05-10 12:16:37', '0', '');
INSERT INTO `category` VALUES ('7', '系统日志', 'ctrl=system&amp;action=log', '5', '0', '2019-04-25 16:28:34', '2019-04-25 16:28:34', '0', null);
INSERT INTO `category` VALUES ('12', '操作配置', 'ctrl=category&amp;action=action', '5', '0', '2019-04-26 12:14:39', '2019-05-10 12:16:20', '0', '');
INSERT INTO `category` VALUES ('19', '工具管理', '', '0', '0', '2019-04-29 12:43:10', '2019-05-14 09:44:34', '0', '&#xe654;');
INSERT INTO `category` VALUES ('21', '作战管理', '', '0', '0', '2019-05-05 09:18:46', '2019-05-10 12:21:52', '0', '&#xe637;');
INSERT INTO `category` VALUES ('22', '部门任务', 'ctrl=task', '21', '0', '2019-05-05 09:21:29', '2019-05-14 11:21:40', '0', '');
INSERT INTO `category` VALUES ('23', '作战记录', 'ctrl=task&amp;action=log', '21', '0', '2019-05-05 09:45:44', '2019-05-05 10:03:53', '0', '');
INSERT INTO `category` VALUES ('24', '部门列表', 'ctrl=department', '1', '0', '2019-05-07 15:57:23', '2019-05-07 16:02:21', '0', '');
INSERT INTO `category` VALUES ('25', '职位管理', 'ctrl=role', '1', '0', '2019-05-07 15:58:05', '2019-05-09 16:00:39', '0', '');
INSERT INTO `category` VALUES ('26', '权限管理', '', '0', '0', '2019-05-10 12:10:11', '2019-05-10 12:10:11', '0', '&#xe62d;');
INSERT INTO `category` VALUES ('27', '工具类别', 'ctrl=tools&amp;action=tlsClass', '19', '0', '2019-05-10 17:41:42', '2019-05-10 17:59:53', '0', '');
INSERT INTO `category` VALUES ('28', '指派任务', 'ctrl=task&amp;action=blame', '21', '0', '2019-05-14 09:47:35', '2019-05-14 12:13:13', '0', '');
INSERT INTO `category` VALUES ('29', '协助任务', 'ctrl=task&amp;action=assist', '21', '0', '2019-05-14 09:47:49', '2019-05-14 12:13:03', '0', '');

-- ----------------------------
-- Table structure for `category_action`
-- ----------------------------
DROP TABLE IF EXISTS `category_action`;
CREATE TABLE `category_action` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `c_id` int(11) NOT NULL DEFAULT '0',
  `a_name` varchar(50) NOT NULL,
  `a_url` varchar(100) CHARACTER SET utf8 NOT NULL,
  `a_icon` varchar(20) DEFAULT NULL,
  `a_time_at` datetime NOT NULL,
  `userid` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique` (`a_name`,`c_id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=35 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of category_action
-- ----------------------------
INSERT INTO `category_action` VALUES ('26', '20', '添加工具', 'ctrl=tools&amp;action=addEdit', '&#xe62d;', '2019-05-10 17:19:55', '9');
INSERT INTO `category_action` VALUES ('17', '12', '删除', 'ctrl=category&amp;action=delAction', '&#xe6e2;', '2019-04-29 18:36:51', '9');
INSERT INTO `category_action` VALUES ('18', '7', '删除', 'ctrl=log&amp;action=delLog1', '&#xe6e2;', '2019-04-29 18:24:35', '1');
INSERT INTO `category_action` VALUES ('19', '15', '编辑', 'ctrl=category&amp;action=AddEdit', '&#xe6df;', '2019-04-26 17:25:41', '1');
INSERT INTO `category_action` VALUES ('15', '12', '添加操作', 'ctrl=category&amp;action=actionAddEdit', '&#xe600;', '2019-04-26 16:27:21', '1');
INSERT INTO `category_action` VALUES ('20', '15', '删除', 'ctrl=category&amp;action=delAction', '&#xe6e2;', '2019-04-26 17:26:09', '1');
INSERT INTO `category_action` VALUES ('21', '4', '编辑', 'ctrl=user&amp;action=addEdit', '&#xe6df;', '2019-04-29 18:41:54', '1');
INSERT INTO `category_action` VALUES ('22', '4', '添加', 'ctrl=category&amp;action=actionAddEdit', '&#xe600;', '2019-04-29 17:50:50', '1');
INSERT INTO `category_action` VALUES ('23', '4', '删除', 'ctrl=log&amp;action=del', '&#xe6e2;', '2019-04-29 17:50:52', '1');
INSERT INTO `category_action` VALUES ('24', '3', '编辑', 'ctrl=user&amp;action=permAddEdit', '&#xe6df;', '2019-04-29 17:50:55', '1');
INSERT INTO `category_action` VALUES ('25', '3', '删除', 'ctrl=user&amp;action=del', '&#xe6e2;', '2019-04-29 15:27:23', '1');
INSERT INTO `category_action` VALUES ('27', '20', '删除', 'ctrl=tools&amp;action=delete', '&#xe6e2;', '2019-05-10 17:20:15', '9');
INSERT INTO `category_action` VALUES ('28', '22', '添加', 'ctrl=task&amp;action=addEdit', '&#xe600;', '2019-05-05 11:14:04', '1');
INSERT INTO `category_action` VALUES ('29', '22', '删除', 'ctrl=task&amp;action=del', '&#xe6e2;', '2019-05-05 13:24:22', '1');
INSERT INTO `category_action` VALUES ('30', '22', '添加节点', 'ctrl=task&amp;action=addNode', '&#xe600;', '2019-05-05 16:39:49', '1');
INSERT INTO `category_action` VALUES ('31', '22', '详情', 'ctrl=task&amp;action=info', '&#xe627;', '2019-05-15 11:50:50', '9');
INSERT INTO `category_action` VALUES ('32', '22', '发布', 'ctrl=task&amp;action=publish', '&#xe603;', '2019-05-07 12:26:40', '1');
INSERT INTO `category_action` VALUES ('33', '27', '分类添加', 'ctrl=tools&amp;action=classAddEdit', '&#xe600;', '2019-05-13 11:23:57', '1');
INSERT INTO `category_action` VALUES ('34', '27', '删除', 'ctrl=tools&amp;action=delClass', '&#xe6e2;', '2019-05-13 11:27:22', '1');

-- ----------------------------
-- Table structure for `client_file`
-- ----------------------------
DROP TABLE IF EXISTS `client_file`;
CREATE TABLE `client_file` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `mac` varchar(200) NOT NULL COMMENT 'mac地址',
  `file_id` int(11) unsigned NOT NULL,
  `down_num` int(11) unsigned NOT NULL COMMENT '下载次数',
  `status` tinyint(1) unsigned NOT NULL COMMENT '0是没有，1删除',
  `down_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '最近下载时间',
  `create_at` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '添加时间',
  `params` varchar(255) DEFAULT '',
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique` (`mac`,`file_id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of client_file
-- ----------------------------
INSERT INTO `client_file` VALUES ('19', '00:50:56:c0:00:00', '11', '0', '1', '0', '1555920478', '{\"af\":\"asdf\",\"ew\":\"cc\",\"asdf\":\"zxcaf\"}');
INSERT INTO `client_file` VALUES ('21', '00:50:56:c0:00:08', '11', '0', '1', '0', '1555919001', '{\"af\":\"asdf\",\"ew\":\"cc\",\"asdf\":\"zxcaf\"}');
INSERT INTO `client_file` VALUES ('17', '00:50:56:c0:00:08', '12', '0', '1', '0', '1555919006', '{\"ip\":\"127.0.0.1\",\"port\":\"8888\",\"account\":\"12345\"}');
INSERT INTO `client_file` VALUES ('23', '10:50:56:c0:00:08', '12', '0', '1', '0', '1555920498', '{\"ip\":\"127.0.0.1\",\"port\":\"8888\",\"account\":\"12345\",\"account1\":\"12345\"}');

-- ----------------------------
-- Table structure for `department`
-- ----------------------------
DROP TABLE IF EXISTS `department`;
CREATE TABLE `department` (
  `did` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '部门ID',
  `d_name` varchar(50) NOT NULL COMMENT '部门名称',
  `p_did` int(11) NOT NULL DEFAULT '0' COMMENT '上级部门的ID',
  `d_desc` varchar(50) NOT NULL COMMENT '部门简述',
  `d_leading_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '部门负责人ID',
  `user_id` int(11) NOT NULL COMMENT '创建人员',
  `d_create_at` datetime NOT NULL COMMENT '创建时间',
  `d_status` tinyint(1) unsigned NOT NULL,
  PRIMARY KEY (`did`),
  UNIQUE KEY `d_name` (`d_name`,`p_did`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of department
-- ----------------------------
INSERT INTO `department` VALUES ('10', '中部司令部', '0', '中国军队最高指挥管理中心部门', '9', '1', '2019-05-10 10:55:13', '0');
INSERT INTO `department` VALUES ('11', '中央后勤部', '0', '中央军备采购部', '9', '9', '2019-05-10 11:28:33', '0');
INSERT INTO `department` VALUES ('12', '中央司令部采购分局', '11', '职责是采购装备', '21', '9', '2019-05-10 11:37:26', '0');

-- ----------------------------
-- Table structure for `files`
-- ----------------------------
DROP TABLE IF EXISTS `files`;
CREATE TABLE `files` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL DEFAULT '''文件''',
  `type` varchar(10) NOT NULL DEFAULT 'tar.zip',
  `path` varchar(255) NOT NULL,
  `desc` varchar(255) NOT NULL COMMENT '描述',
  `create_at` datetime NOT NULL COMMENT '修改时间',
  `class` varchar(50) DEFAULT NULL,
  `version` varchar(20) NOT NULL DEFAULT '1.0.0.0',
  `params` varchar(255) DEFAULT '',
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique` (`name`,`version`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of files
-- ----------------------------
INSERT INTO `files` VALUES ('11', '111', 'tar.gz', 'source/file/files//20190422142955174_files.sql', '11111', '2019-04-22 14:51:09', '111', '1.0.0.0', '{\"af\":\"asdf\",\"ew\":\"cc\",\"asdf\":\"zxcaf\"}');
INSERT INTO `files` VALUES ('12', 'admin', '.sql', 'source/file/files//20190422150043391_admin.sql', '数据库', '2019-04-22 15:01:00', '数据库', '1.0.0.0', '{\"ip\":\"127.0.0.1\",\"port\":\"8888\",\"account\":\"12345\"}');

-- ----------------------------
-- Table structure for `ipc`
-- ----------------------------
DROP TABLE IF EXISTS `ipc`;
CREATE TABLE `ipc` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `mac` varchar(50) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `create_at` datetime NOT NULL,
  `ip` varchar(50) DEFAULT '' COMMENT '绑定的VPN、主机IP',
  `desc` varchar(255) DEFAULT NULL,
  `account` varchar(20) DEFAULT NULL,
  `passwd` varchar(50) NOT NULL,
  `hostid` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `mac` (`ip`,`account`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of ipc
-- ----------------------------
INSERT INTO `ipc` VALUES ('1', 'mac:mac:mac', '1', '2019-04-04 18:23:11', '192.168.52.15', '这是一台工控机', 'root3', '123456', '38');
INSERT INTO `ipc` VALUES ('2', '00:16:3e:12:36:4f', '1', '2019-04-04 18:23:05', '192.168.10.153', '这是一台工控机', 'admin', '123456', '38');

-- ----------------------------
-- Table structure for `permission`
-- ----------------------------
DROP TABLE IF EXISTS `permission`;
CREATE TABLE `permission` (
  `a_id` int(11) unsigned NOT NULL COMMENT '人员ID',
  `actions` text NOT NULL COMMENT 'actions动作权限ids',
  `powers` text NOT NULL COMMENT '栏目权限',
  `p_create_at` datetime NOT NULL,
  `user_id` int(11) unsigned NOT NULL COMMENT '创建人员的id',
  UNIQUE KEY `unique` (`a_id`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of permission
-- ----------------------------
INSERT INTO `permission` VALUES ('1', '', '', '2019-04-03 10:52:18', '1');
INSERT INTO `permission` VALUES ('8', '24,25,21,22,23,19,20,18,17,15', '', '2019-04-29 19:25:16', '1');
INSERT INTO `permission` VALUES ('9', '21,22,23,19,20,18,17,15,26,27,33,34,28,29,30,31,32,24,25', '1,4,24,25,5,15,7,12,19,20,27,21,22,23,28,29,26,3', '2019-05-14 09:48:20', '1');
INSERT INTO `permission` VALUES ('14', '24,25,21,22,23,19,20,18,17,15', '', '2019-04-30 09:42:07', '9');
INSERT INTO `permission` VALUES ('19', '24,25,21,22,23,19,20,18,17,15,26,27,28,29,30,31,32', '', '2019-05-08 19:00:40', '9');
INSERT INTO `permission` VALUES ('20', '24,25,21,22,23,19,20,18,17,15,26,27,28,29,30,31,32', '1,3,4,24,25,5,15,7,12,19,20,21,22,23', '2019-05-08 19:22:25', '1');
INSERT INTO `permission` VALUES ('21', '21,22,23,19,20,18,17,15,26,27,33,34,28,29,30,31,32,24,25', '1,4,24,25,5,15,7,12,19,20,27,21,22,23,28,29,26,3', '2019-05-15 10:03:20', '1');
INSERT INTO `permission` VALUES ('22', '', '', '2019-05-13 09:26:23', '9');

-- ----------------------------
-- Table structure for `role`
-- ----------------------------
DROP TABLE IF EXISTS `role`;
CREATE TABLE `role` (
  `rid` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '角色ID',
  `r_name` varchar(50) NOT NULL COMMENT '职位名称',
  `d_did` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '所属部门的ID',
  `r_desc` varchar(50) NOT NULL COMMENT '职位简述',
  `is_owner` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否是部门负责人角色,0不是1是',
  `user_id` int(11) unsigned NOT NULL COMMENT '创建人员',
  `r_create_at` datetime NOT NULL COMMENT '创建时间',
  `r_status` tinyint(1) unsigned NOT NULL COMMENT '状态',
  PRIMARY KEY (`rid`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of role
-- ----------------------------
INSERT INTO `role` VALUES ('9', '部长', '11', '这是本部门的头', '1', '1', '2019-05-09 18:50:50', '0');
INSERT INTO `role` VALUES ('7', '职员', '10', '普通职员', '0', '1', '2019-05-09 18:47:04', '0');
INSERT INTO `role` VALUES ('8', '职员', '11', '普通职员', '0', '1', '2019-05-09 18:50:24', '0');
INSERT INTO `role` VALUES ('10', '部长', '10', '只会军队打仗的干活', '1', '1', '2019-05-09 18:51:15', '0');
INSERT INTO `role` VALUES ('11', '政委', '10', '和部长一起，党指挥枪的干活', '1', '1', '2019-05-09 18:51:46', '0');
INSERT INTO `role` VALUES ('12', '部长秘书', '10', '专职给领导提供工作支持服务的', '0', '1', '2019-05-09 19:06:59', '0');
INSERT INTO `role` VALUES ('13', '副部长', '10', '中部战区最高领导', '0', '1', '2019-05-09 18:59:07', '0');
INSERT INTO `role` VALUES ('14', '局长', '12', '我的大局长', '1', '9', '2019-05-10 11:34:28', '0');
INSERT INTO `role` VALUES ('15', '副局长', '12', '协助局长维护本部门的日常工作', '1', '9', '2019-05-10 12:25:02', '0');
INSERT INTO `role` VALUES ('16', '副部长', '0', '协助部长维护本部门的正常工作', '1', '9', '2019-05-10 12:25:41', '0');
INSERT INTO `role` VALUES ('17', '职员', '12', '职员', '0', '9', '2019-05-10 12:26:09', '0');

-- ----------------------------
-- Table structure for `server`
-- ----------------------------
DROP TABLE IF EXISTS `server`;
CREATE TABLE `server` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ip` varchar(50) NOT NULL,
  `account` varchar(20) NOT NULL,
  `passwd` varchar(50) NOT NULL,
  `port` int(11) NOT NULL DEFAULT '22',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0不可用，1可用',
  `c_userid` int(11) NOT NULL DEFAULT '0',
  `create_at` datetime NOT NULL,
  `u_desc` varchar(255) NOT NULL COMMENT '备注',
  PRIMARY KEY (`id`),
  UNIQUE KEY `unio` (`ip`,`account`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of server
-- ----------------------------
INSERT INTO `server` VALUES ('1', '192.168.10.153', 'root', '123456', '27017', '1', '1', '2019-04-30 10:35:44', '备注');
INSERT INTO `server` VALUES ('2', '192.168.43.15', 'root', '123456', '22', '1', '1', '2019-04-30 10:36:34', '备注');

-- ----------------------------
-- Table structure for `system_log`
-- ----------------------------
DROP TABLE IF EXISTS `system_log`;
CREATE TABLE `system_log` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ip` varchar(50) DEFAULT NULL,
  `mac` varchar(50) DEFAULT NULL,
  `create_at` datetime NOT NULL COMMENT '请求时间',
  `log_desc` text COMMENT '请求描述',
  `log_type` varchar(50) NOT NULL DEFAULT '系统操作',
  `status` tinyint(1) DEFAULT '1' COMMENT '1正常0已删除',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=63 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of system_log
-- ----------------------------
INSERT INTO `system_log` VALUES ('1', '192.168.43.197', '00-01-6C-06-A6-29', '2019-04-11 11:19:31', '下载成功;获取条件是：00-01-6C-06-A6-29', '下载文件包', '1');
INSERT INTO `system_log` VALUES ('2', '192.168.43.197', '00-01-6C-06-A6-29', '2019-04-11 11:19:56', '下载成功;获取条件是：00-01-6C-06-A6-29', '下载文件包', '1');
INSERT INTO `system_log` VALUES ('3', '192.168.43.197', '00-01-6C-06-A6-29', '2019-04-11 11:20:54', '下载成功;获取条件是：00-01-6C-06-A6-29', '下载文件包', '1');
INSERT INTO `system_log` VALUES ('4', '192.168.43.194', '00-01-6C-06-A6-29', '2019-04-11 11:22:27', '下载成功;获取条件是：00-01-6C-06-A6-29', '下载文件包', '1');
INSERT INTO `system_log` VALUES ('5', '192.168.43.194', '00-01-6C-06-A6-29', '2019-04-11 11:22:45', '下载成功;获取条件是：00-01-6C-06-A6-29', '下载文件包', '1');
INSERT INTO `system_log` VALUES ('6', '192.168.43.197', '00-01-6C-06-A6-29', '2019-04-11 11:26:15', '下载成功;获取条件是：00-01-6C-06-A6-29', '下载文件包', '1');
INSERT INTO `system_log` VALUES ('7', '192.168.43.197', '00-01-6C-06-A6-29', '2019-04-11 11:26:17', '下载成功;获取条件是：00-01-6C-06-A6-29', '下载文件包', '1');
INSERT INTO `system_log` VALUES ('8', '192.168.43.197', '00:50:56:c0:00:08', '2019-04-11 11:26:51', '下载成功;获取条件是：00:50:56:c0:00:08', '下载文件包', '1');
INSERT INTO `system_log` VALUES ('9', '192.168.43.197', '00-01-6C-06-A6-29=00-01-6C-06-A6-2922', '2019-04-11 11:27:18', '获取条件是：00-01-6C-06-A6-29=00-01-6C-06-A6-2922', '下载文件包', '1');
INSERT INTO `system_log` VALUES ('10', '192.168.43.197', '00-01-6C-06-A6-29=00-01-6C-06-A6-29', '2019-04-11 11:27:21', '获取条件是：00-01-6C-06-A6-29=00-01-6C-06-A6-29', '下载文件包', '1');
INSERT INTO `system_log` VALUES ('11', '192.168.43.197', '00-01-6C-06-A6-29=00-01-6C-06-A6-29', '2019-04-11 11:27:24', '获取条件是：00-01-6C-06-A6-29=00-01-6C-06-A6-29', '下载文件包', '1');
INSERT INTO `system_log` VALUES ('12', '192.168.43.197', '00-01-6C-06-A6-29', '2019-04-11 11:27:31', '下载成功;获取条件是：00-01-6C-06-A6-29', '下载文件包', '1');
INSERT INTO `system_log` VALUES ('13', '192.168.43.197', '00:50:56:c0:00:08', '2019-04-11 11:27:45', '下载成功;获取条件是：00:50:56:c0:00:08', '下载文件包', '1');
INSERT INTO `system_log` VALUES ('14', '192.168.43.197', '00:50:56:c0:00:08', '2019-04-11 11:27:56', '下载成功;获取条件是：00:50:56:c0:00:08', '下载文件包', '1');
INSERT INTO `system_log` VALUES ('15', '192.168.43.194', '00-01-6C-06-A6-29', '2019-04-11 11:29:14', '获取条件是：00-01-6C-06-A6-29', '下载文件包', '1');
INSERT INTO `system_log` VALUES ('16', '192.168.43.194', '00-01-6C-06-A6-29', '2019-04-11 11:30:20', '下载成功;获取条件是：00-01-6C-06-A6-29', '下载文件包', '1');
INSERT INTO `system_log` VALUES ('17', '192.168.43.197', '00-01-6C-06-A6-29', '2019-04-11 13:25:52', '下载成功;获取条件是：00-01-6C-06-A6-29', '下载文件包', '1');
INSERT INTO `system_log` VALUES ('18', '192.168.43.197', '00-01-6C-06-A6-291', '2019-04-11 13:26:01', '获取条件是：00-01-6C-06-A6-291', '下载文件包', '1');
INSERT INTO `system_log` VALUES ('19', '192.168.43.197', '00-01-6C-06-A6-29', '2019-04-11 13:26:03', '下载成功;获取条件是：00-01-6C-06-A6-29', '下载文件包', '1');
INSERT INTO `system_log` VALUES ('20', '127.0.0.1', '00-01-6C-06-A6-29', '2019-04-11 16:04:34', '获取条件是：00-01-6C-06-A6-29', '下载文件包', '1');
INSERT INTO `system_log` VALUES ('21', '127.0.0.1', '00-01-6C-06-A6-29', '2019-04-11 16:04:45', '获取条件是：00-01-6C-06-A6-29', '下载文件包', '1');
INSERT INTO `system_log` VALUES ('22', '127.0.0.1', '00-01-6C-06-A6-29', '2019-04-11 16:13:18', '获取条件是：00-01-6C-06-A6-29', '下载文件包', '1');
INSERT INTO `system_log` VALUES ('23', '127.0.0.1', '00-01-6C-06-A6-29', '2019-04-11 16:13:20', '获取条件是：00-01-6C-06-A6-29', '下载文件包', '1');
INSERT INTO `system_log` VALUES ('24', '127.0.0.1', '00-01-6C-06-A6-29', '2019-04-11 16:13:21', '获取条件是：00-01-6C-06-A6-29', '下载文件包', '1');
INSERT INTO `system_log` VALUES ('25', '127.0.0.1', '00-01-6C-06-A6-29', '2019-04-11 16:13:21', '获取条件是：00-01-6C-06-A6-29', '下载文件包', '1');
INSERT INTO `system_log` VALUES ('26', '127.0.0.1', '00-01-6C-06-A6-29', '2019-04-11 16:13:21', '获取条件是：00-01-6C-06-A6-29', '下载文件包', '1');
INSERT INTO `system_log` VALUES ('27', '127.0.0.1', '00-01-6C-06-A6-29', '2019-04-11 16:13:21', '获取条件是：00-01-6C-06-A6-29', '下载文件包', '1');
INSERT INTO `system_log` VALUES ('28', '127.0.0.1', '00-01-6C-06-A6-29', '2019-04-11 16:13:21', '获取条件是：00-01-6C-06-A6-29', '下载文件包', '1');
INSERT INTO `system_log` VALUES ('29', '127.0.0.1', '00-01-6C-06-A6-29', '2019-04-11 16:13:22', '获取条件是：00-01-6C-06-A6-29', '下载文件包', '1');
INSERT INTO `system_log` VALUES ('30', '127.0.0.1', '00-01-6C-06-A6-29', '2019-04-11 16:13:25', '获取条件是：00-01-6C-06-A6-29', '下载文件包', '1');
INSERT INTO `system_log` VALUES ('31', '127.0.0.1', '00-01-6C-06-A6-29', '2019-04-11 16:13:45', '获取条件是：00-01-6C-06-A6-29', '下载文件包', '1');
INSERT INTO `system_log` VALUES ('32', '127.0.0.1', '00-01-6C-06-A6-29', '2019-04-11 16:13:46', '获取条件是：00-01-6C-06-A6-29', '下载文件包', '1');
INSERT INTO `system_log` VALUES ('33', '127.0.0.1', '00-01-6C-06-A6-29', '2019-04-11 16:13:46', '获取条件是：00-01-6C-06-A6-29', '下载文件包', '1');
INSERT INTO `system_log` VALUES ('34', '127.0.0.1', '00-01-6C-06-A6-29', '2019-04-11 16:13:46', '获取条件是：00-01-6C-06-A6-29', '下载文件包', '1');
INSERT INTO `system_log` VALUES ('35', '127.0.0.1', '00-01-6C-06-A6-29', '2019-04-11 16:13:59', '下载成功;获取条件是：00-01-6C-06-A6-29', '下载文件包', '1');
INSERT INTO `system_log` VALUES ('36', '127.0.0.1', '00-01-6C-06-A6-29', '2019-04-11 16:15:25', '获取条件是：00-01-6C-06-A6-29', '下载文件包', '1');
INSERT INTO `system_log` VALUES ('37', '127.0.0.1', '00-01-6C-06-A6-29', '2019-04-11 16:15:43', '下载成功;获取条件是：00-01-6C-06-A6-29', '下载文件包', '1');
INSERT INTO `system_log` VALUES ('38', '127.0.0.1', '00-01-6C-06-A6-29', '2019-04-11 16:20:45', '下载成功;获取条件是：00-01-6C-06-A6-29', '下载文件包', '1');
INSERT INTO `system_log` VALUES ('39', '127.0.0.1', '00-01-6C-06-A6-29', '2019-04-11 16:22:04', '下载成功;获取条件是：00-01-6C-06-A6-29', '下载文件包', '1');
INSERT INTO `system_log` VALUES ('40', '127.0.0.1', '00-01-6C-06-A6-29', '2019-04-11 16:22:07', '下载成功;获取条件是：00-01-6C-06-A6-29', '下载文件包', '1');
INSERT INTO `system_log` VALUES ('41', '127.0.0.1', '00-01-6C-06-A6-29', '2019-04-11 16:25:23', '下载成功;获取条件是：00-01-6C-06-A6-29', '下载文件包', '1');
INSERT INTO `system_log` VALUES ('42', '127.0.0.1', '00-01-6C-06-A6-29', '2019-04-11 16:27:28', '下载成功;获取条件是：00-01-6C-06-A6-29', '下载文件包', '1');
INSERT INTO `system_log` VALUES ('43', '127.0.0.1', '00-01-6C-06-A6-29', '2019-04-11 16:28:32', '下载成功;获取条件是：00-01-6C-06-A6-29', '下载文件包', '1');
INSERT INTO `system_log` VALUES ('44', '127.0.0.1', '00-01-6C-06-A6-29', '2019-04-11 17:12:23', '下载成功;获取条件是：00-01-6C-06-A6-29', '下载文件包', '1');
INSERT INTO `system_log` VALUES ('45', '127.0.0.1', '00-01-6C-06-A6-29', '2019-04-11 17:20:08', '下载成功;【mysql,00-01-6C-06-A6-29', '下载文件包', '1');
INSERT INTO `system_log` VALUES ('46', '127.0.0.1', '00-01-6C-06-A6-29', '2019-04-11 17:20:29', '下载成功;【nginx,00-01-6C-06-A6-29', '下载文件包', '1');
INSERT INTO `system_log` VALUES ('47', '127.0.0.1', '00-01-6C-06-A6-29', '2019-04-11 17:27:34', '【mysql,00-01-6C-06-A6-29', '下载文件包', '1');
INSERT INTO `system_log` VALUES ('48', '127.0.0.1', '00-01-6C-06-A6-29', '2019-04-11 17:28:35', '【mysql,00-01-6C-06-A6-29', '下载文件包', '1');
INSERT INTO `system_log` VALUES ('49', '127.0.0.1', '00-01-6C-06-A6-29', '2019-04-11 17:29:30', '【mysql,00-01-6C-06-A6-29', '下载文件包', '1');
INSERT INTO `system_log` VALUES ('50', '127.0.0.1', '00-01-6C-06-A6-29', '2019-04-11 17:29:48', '【mysql,00-01-6C-06-A6-29', '下载文件包', '1');
INSERT INTO `system_log` VALUES ('51', '127.0.0.1', '00-01-6C-06-A6-29', '2019-04-11 17:30:06', '【mysql,00-01-6C-06-A6-29', '下载文件包', '1');
INSERT INTO `system_log` VALUES ('52', '127.0.0.1', '00-01-6C-06-A6-29', '2019-04-11 17:30:43', '【mysql,=00-01-6C-06-A6-29', '下载文件包', '1');
INSERT INTO `system_log` VALUES ('53', '127.0.0.1', '00-01-6C-06-A6-29', '2019-04-11 17:30:45', '【mysql,=00-01-6C-06-A6-29', '下载文件包', '1');
INSERT INTO `system_log` VALUES ('54', '127.0.0.1', '00-01-6C-06-A6-29', '2019-04-11 17:30:45', '【mysql,=00-01-6C-06-A6-29', '下载文件包', '1');
INSERT INTO `system_log` VALUES ('55', '127.0.0.1', '00-01-6C-06-A6-29', '2019-04-11 17:30:45', '【mysql,=00-01-6C-06-A6-29', '下载文件包', '1');
INSERT INTO `system_log` VALUES ('56', '127.0.0.1', '00-01-6C-06-A6-29', '2019-04-11 17:30:45', '【mysql,=00-01-6C-06-A6-29', '下载文件包', '0');
INSERT INTO `system_log` VALUES ('57', '127.0.0.1', '00-01-6C-06-A6-29', '2019-04-11 17:33:23', '【mysql,1.0.0.0】获取条件是：mac=00-01-6C-06-A6-29', '下载文件包', '0');
INSERT INTO `system_log` VALUES ('58', '127.0.0.1', '00-01-6C-06-A6-29', '2019-04-11 17:50:19', '【mysql,1.0.0.0】获取条件是：mac=00-01-6C-06-A6-29', '下载文件包', '1');
INSERT INTO `system_log` VALUES ('59', '127.0.0.1', '00-01-6C-06-A6-29', '2019-04-11 17:50:25', '【mysql,1.0.0.0】获取条件是：mac=00-01-6C-06-A6-29', '下载文件包', '0');
INSERT INTO `system_log` VALUES ('60', '127.0.0.1', '00-01-6C-06-A6-29', '2019-04-11 17:50:26', '【mysql,1.0.0.0】获取条件是：mac=00-01-6C-06-A6-29', '下载文件包', '0');
INSERT INTO `system_log` VALUES ('61', '127.0.0.1', '00-01-6C-06-A6-29', '2019-04-11 17:50:27', '【mysql,1.0.0.0】获取条件是：mac=00-01-6C-06-A6-29', '下载文件包', '0');
INSERT INTO `system_log` VALUES ('62', '127.0.0.1', '00-01-6C-06-A6-29', '2019-04-11 17:52:38', '【nginx,1.0.0.0】获取条件是：mac=00-01-6C-06-A6-29', '下载文件包', '0');

-- ----------------------------
-- Table structure for `task`
-- ----------------------------
DROP TABLE IF EXISTS `task`;
CREATE TABLE `task` (
  `task_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `t_name` varchar(100) NOT NULL,
  `t_number` varchar(100) NOT NULL COMMENT '任务类型',
  `t_b_time` varchar(20) NOT NULL DEFAULT '0',
  `t_e_time` varchar(20) NOT NULL DEFAULT '0',
  `t_desc` varchar(255) NOT NULL,
  `t_create_at` datetime NOT NULL,
  `t_user_id` int(11) unsigned NOT NULL COMMENT '创建人员的id',
  `t_status` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '1未发布，2进行中，3执行失败，4执行成功，5发布待执行，6停止，7继续执行,8删除',
  `t_blame_id` int(11) unsigned NOT NULL COMMENT '负责人ID,eg:12',
  `t_assist` varchar(255) NOT NULL COMMENT '协助人员ID,eg:1,2,3,4',
  `t_tools` varchar(255) NOT NULL COMMENT '制定工具，eg:1,2,3,4',
  `t_source` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '0当前部门，1上级部门',
  `t_did` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '任务来源部门',
  `t_result_desc` text NOT NULL COMMENT '执行结果反馈',
  `t_rcv_userid` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '任务确认人ID',
  `t_type` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '0原创任务1转发任务或者子任务',
  `p_t_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '父任务id',
  `t_son_powers` varchar(255) NOT NULL COMMENT '拥有操作权限的协助人员',
  PRIMARY KEY (`task_id`)
) ENGINE=MyISAM AUTO_INCREMENT=63 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of task
-- ----------------------------
INSERT INTO `task` VALUES ('15', '反法西斯联盟', '111111111', '1558713600', '1559404799', '消灭法西斯的组织任务', '2019-05-05 17:48:39', '1', '1', '0', '', '', '0', '0', '', '0', '0', '0', '');
INSERT INTO `task` VALUES ('6', '时代大厦', '222222222222', '1557936000', '1559318399', '大师傅', '2019-05-05 12:10:43', '1', '1', '0', '', '', '0', '0', '', '0', '0', '0', '');
INSERT INTO `task` VALUES ('30', '首秀', '55555555555', '1557763200', '1559404799', '撒大声地', '2019-05-16 09:11:18', '9', '1', '9', '20,21', '2,8,1,17,14,15,16', '0', '11', '{\"9\":{\"content\":\"\\u5566\\u5566\\u5566\\u5566\\u5566\\u5566\\u5566\\u5566\\u5566\\u5566\\u5566\\u5566\\u6848\\u4f8b\\u4e86\\u7eff\\u7eff\\u7eff\\u7eff\\u7eff\\u7eff\\u7eff\\u7eff\\u7eff\\u7eff\\u7eff\\u7eff\\u7eff\\u7eff\\n       \\u5566\\u5566\\u5566\\u5566\\u5566\\u5566\\u5566\\u5566\\u5566\\u5566\\u5566\\u5566\\u6848\\u4f8b\\u4e86\\u7eff\\u7eff\\u7eff\\u7eff\\u7eff\\u7eff\\u7eff\\u7eff\\u7eff\\u7eff\\u7eff\\u7eff\\u7eff\\u7eff\\u5566\\u5566\\u5566\\u5566\\u5566\\u5566\\u5566\\u5566\\u5566\\u5566\\u5566\\u5566\\u6848\\u4f8b\\u4e86\\u7eff\\u7eff\\u7eff\\u7eff\\u7eff\\u7eff\\u7eff\\u7eff\\u7eff\\u7eff\\u7eff\\u7eff\\u7eff\\u7eff\",\"urls\":\"source\\/file\\/files\\/\\/20190516183906621_phpStudy\\u5b98\\u7f51.url,source\\/file\\/files\\/\\/20190516183908519_Msvcp71.dll\",\"time\":\"2019-05-16 18:39:38\"}}', '9', '0', '0', '');
INSERT INTO `task` VALUES ('32', '乔沃维奇无群', '56566565', '1557763200', '1557849599', '3232', '2019-05-16 09:11:07', '9', '2', '9', '21', '2,14,15,16', '0', '11', '', '9', '0', '0', '');
INSERT INTO `task` VALUES ('33', '测试任务', '11111111111111111', '1557849600', '1558713599', '任务描述', '2019-05-16 16:04:47', '9', '2', '9', '20,21', '2,8,1,17,14,15,16', '0', '11', '{\"lalalal\":{\"content\":\"aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa\",\"time\":\"2019-05-06 12:12:12\"},\"BBBBBBB\":{\"content\":\"bbbbbbbbbbbbbbb\",\"time\":\"2019-05-06 12:12:12\"}}', '9', '0', '0', '20,21');
INSERT INTO `task` VALUES ('57', '破UIIT䏃', '嗯嗯翁翁', '1557849600', '1558454399', '任务描述444', '2019-05-16 11:17:21', '9', '0', '21', '9,21', '8,17', '0', '11', '', '0', '0', '33', '');
INSERT INTO `task` VALUES ('58', '破UIIT䏃', '嗯嗯翁翁等等', '1557849600', '1558454399', '任务描述444', '2019-05-16 09:11:25', '9', '0', '20', '21', '8,17', '0', '11', '', '0', '0', '33', '');
INSERT INTO `task` VALUES ('59', '破UIIT䏃', '32323', '1557849600', '1558454399', '任务描述444', '2019-05-16 11:49:22', '9', '0', '20', '9,21', '2,8,1,17,14,15,16', '0', '11', '', '20', '0', '58', '9,21');
INSERT INTO `task` VALUES ('60', '重复测试', '嗯嗯翁翁等等11', '1557849600', '1558713599', '嗯嗯翁翁等等', '2019-05-16 12:12:37', '9', '0', '9', '20,21', '2,8,1,17,14,15,16', '0', '11', '', '0', '0', '33', '20,21');
INSERT INTO `task` VALUES ('61', '3', '3', '1557849600', '1558713599', '3', '2019-05-16 11:17:55', '9', '0', '9', '9,20', '8,1,17', '0', '11', '', '9', '0', '33', '');

-- ----------------------------
-- Table structure for `task_node`
-- ----------------------------
DROP TABLE IF EXISTS `task_node`;
CREATE TABLE `task_node` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `t_id` int(11) unsigned NOT NULL COMMENT '任务id',
  `n_name` varchar(20) NOT NULL COMMENT '节点任务名称',
  `n_desc` varchar(20) NOT NULL COMMENT '节点任务描述',
  `n_b_time` varchar(20) NOT NULL DEFAULT '0' COMMENT '开始时间',
  `n_e_time` varchar(20) NOT NULL DEFAULT '0' COMMENT '结束时间',
  `n_number` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `n_create_at` datetime NOT NULL,
  `user_id` int(11) unsigned NOT NULL COMMENT '添加人员id',
  `n_status` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '0等待执行，1执行中，2执行成功，3执行失败',
  `n_ret_desc` varchar(50) NOT NULL COMMENT '执行结果描述',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=36 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of task_node
-- ----------------------------
INSERT INTO `task_node` VALUES ('30', '15', '踩点', '找到最佳作战时间', '1557244800', '1558108799', '1', '2019-05-07 11:14:11', '1', '0', '');
INSERT INTO `task_node` VALUES ('31', '15', '情报分析', '情报分析', '1557244800', '1558022399', '2', '2019-05-07 11:23:59', '1', '0', '');
INSERT INTO `task_node` VALUES ('32', '15', '选择武器', '根据报告选择相关武器代用', '1557244800', '1557331199', '3', '2019-05-07 12:13:03', '1', '0', '');
INSERT INTO `task_node` VALUES ('33', '28', '2233', '323', '1558454400', '1559750399', '1', '2019-05-07 13:42:04', '1', '0', '');
INSERT INTO `task_node` VALUES ('34', '15', '1212', '1212', '1557244800', '1558108799', '4', '2019-05-07 13:44:06', '1', '0', '');
INSERT INTO `task_node` VALUES ('35', '15', '4445', '32323232', '1557849600', '1559059199', '5', '2019-05-08 09:54:57', '1', '0', '');

-- ----------------------------
-- Table structure for `task_sub`
-- ----------------------------
DROP TABLE IF EXISTS `task_sub`;
CREATE TABLE `task_sub` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `t_id` int(11) unsigned NOT NULL COMMENT '任务id',
  `n_id` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `ts_name` varchar(20) NOT NULL COMMENT '节点任务名称暂时也就是目的了',
  `ts_desc` varchar(20) NOT NULL COMMENT '节点任务描述',
  `ts_b_time` varchar(20) NOT NULL DEFAULT '0' COMMENT '开始时间',
  `ts_e_time` varchar(20) NOT NULL DEFAULT '0' COMMENT '结束时间',
  `ts_exec_id` int(11) unsigned NOT NULL COMMENT '执行人员id',
  `ts_create_at` datetime NOT NULL,
  `ts_status` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '0等待执行，1执行中，2执行成功，3执行失败',
  `ts_ret_desc` varchar(50) NOT NULL COMMENT '执行结果描述',
  `user_id` int(11) unsigned NOT NULL COMMENT '最后修改人员id',
  `ts_detail_desc` text NOT NULL,
  `ts_tools` varchar(100) NOT NULL COMMENT '作战工具',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of task_sub
-- ----------------------------
INSERT INTO `task_sub` VALUES ('8', '15', '31', '总结情报', '把报告拿出来', '1557244800', '1558022399', '4', '2019-05-07 12:03:12', '0', '', '1', '把已有的结果整理成报告', '3');
INSERT INTO `task_sub` VALUES ('9', '15', '32', '选出所需武器', '要形成报告哦', '1557244800', '1557331199', '1', '2019-05-07 12:14:23', '0', '', '1', '根据报告选出最适合的作战武器', '4');
INSERT INTO `task_sub` VALUES ('7', '15', '31', '总结情报', '把报告拿出来', '1557244800', '1558022399', '4', '2019-05-07 12:01:56', '0', '', '1', '把已有的结果整理成报告', '3');
INSERT INTO `task_sub` VALUES ('10', '15', '32', '选出所需武器', '要形成报告哦', '1557244800', '1557331199', '5', '2019-05-07 12:16:09', '0', '', '1', '根据报告选出最适合的作战武器', '22');
INSERT INTO `task_sub` VALUES ('11', '28', '33', '232323', '2323', '1558454400', '1559750399', '4', '2019-05-07 13:42:34', '0', '', '1', '4', '7');

-- ----------------------------
-- Table structure for `tools`
-- ----------------------------
DROP TABLE IF EXISTS `tools`;
CREATE TABLE `tools` (
  `tid` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `t_name` varchar(20) NOT NULL,
  `t_class_id` int(11) unsigned NOT NULL COMMENT '分类id',
  `t_did` int(11) NOT NULL COMMENT '部门ID',
  `t_create_at` datetime NOT NULL COMMENT '最近修改时间',
  `t_user_id` int(11) NOT NULL COMMENT '添加人员ID',
  `t_info` text NOT NULL COMMENT '工具信息',
  `t_desc` varchar(255) NOT NULL COMMENT '工具简介',
  `filePath` varchar(100) NOT NULL,
  PRIMARY KEY (`tid`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of tools
-- ----------------------------
INSERT INTO `tools` VALUES ('1', '漏洞扫描', '3', '11', '2019-05-13 18:37:06', '9', '{\"ip\":\"count\",\"port\":\"8080\"}', '描述', '');
INSERT INTO `tools` VALUES ('2', 'nmap', '1', '11', '2019-05-13 18:37:00', '9', '{\"ip\":\"count\",\"port\":\"8080\"}', '这是攻击软件之一', 'source/file/files//20190513122302948_win10一键清除垃圾.bat');
INSERT INTO `tools` VALUES ('3', '端口扫描', '1', '10', '2019-05-10 17:26:15', '9', '{\"ip\":\"count\",\"port\":\"8080\"}', '这是端口扫描工具', '');
INSERT INTO `tools` VALUES ('8', 'windows', '2', '11', '2019-05-13 18:38:07', '9', '{\"ip\":\"count\",\"port\":\"8080\"}', '渗透工具', '');
INSERT INTO `tools` VALUES ('14', 'kali', '7', '11', '2019-05-14 09:06:01', '9', '{\"ip\":\"127.0.0.1\",\"port\":\"12345\"}', '这是操作系统', 'source/file/files//20190514090526587_win10一键清除垃圾.bat');
INSERT INTO `tools` VALUES ('15', 'centos7', '7', '11', '2019-05-14 09:07:43', '9', '{\"ip\":\"1212\"}', 'centos7', '');
INSERT INTO `tools` VALUES ('16', 'ubuntu18.04', '7', '11', '2019-05-14 09:08:29', '9', '{\"port\":\"4545\"}', '德班', '');
INSERT INTO `tools` VALUES ('17', 'window缓存清除脚本', '8', '11', '2019-05-14 09:10:40', '9', '', '脚本', 'source/file/files//20190514090940128_win10一键清除垃圾.bat');

-- ----------------------------
-- Table structure for `tools_class`
-- ----------------------------
DROP TABLE IF EXISTS `tools_class`;
CREATE TABLE `tools_class` (
  `t_c_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `t_c_name` varchar(100) NOT NULL COMMENT '分类名称',
  `t_c_did` int(11) NOT NULL COMMENT '添加部门',
  `t_c_time` datetime NOT NULL COMMENT '最后修改时间',
  `t_c_userid` int(11) NOT NULL,
  `t_c_desc` varchar(200) NOT NULL COMMENT '简述',
  PRIMARY KEY (`t_c_id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of tools_class
-- ----------------------------
INSERT INTO `tools_class` VALUES ('1', '漏洞发现', '11', '2019-05-10 17:32:19', '9', '备注1');
INSERT INTO `tools_class` VALUES ('2', '渗透工具', '11', '2019-05-14 17:32:23', '9', '备注11');
INSERT INTO `tools_class` VALUES ('3', '端口处理', '11', '2019-05-13 18:38:36', '9', '备注1222333');
INSERT INTO `tools_class` VALUES ('8', '操作脚本', '11', '2019-05-14 09:09:27', '9', '文件');
INSERT INTO `tools_class` VALUES ('7', '操作主机', '11', '2019-05-14 09:05:09', '9', '这是操作平台的计算机');
