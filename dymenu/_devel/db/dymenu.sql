-- phpMyAdmin SQL Dump
-- version 2.11.2.1
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2009 年 04 月 22 日 08:47
-- 服务器版本: 5.0.45
-- PHP 版本: 5.2.4

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- 数据库: `test`
--

-- --------------------------------------------------------

--
-- 表的结构 `dm_sysmenu`
--

CREATE TABLE IF NOT EXISTS `dm_sysmenu` (
  `menu_id` int(11) NOT NULL auto_increment,
  `title` varchar(32) default NULL,
  `controller` varchar(32) default NULL,
  `action` varchar(32) default NULL,
  `args` varchar(255) default NULL,
  `icon` varchar(255) default NULL,
  `description` varchar(255) default NULL,
  `target` varchar(32) default NULL,
  `split` tinyint(1) NOT NULL default '0',
  `parent_id` int(11) NOT NULL default '0',
  `order_pos` int(11) NOT NULL default '0',
  PRIMARY KEY  (`menu_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=75 ;

--
-- 导出表中的数据 `dm_sysmenu`
--

INSERT INTO `dm_sysmenu` (`menu_id`, `title`, `controller`, `action`, `args`, `icon`, `description`, `target`, `split`, `parent_id`, `order_pos`) VALUES
(1, ' 管理首页', 'BoDashboard', 'index', NULL, NULL, NULL, NULL, 0, 0, 0),
(2, ' 商品管理', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 1),
(3, '添加商品', 'BoProducts', 'add', NULL, NULL, NULL, NULL, 0, 2, 0),
(4, '浏览商品', 'BoProducts', 'index', NULL, NULL, NULL, NULL, 0, 2, 1),
(6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 2, 2),
(7, '列出所有热销商品', 'BoProducts', 'index', 'filter=is_hot_sale&is_hot_sale=1', NULL, NULL, NULL, 0, 2, 8),
(8, '列出所有热门点击商品', 'BoProducts', 'index', 'filter=is_hot_click&is_hot_click=1', NULL, NULL, NULL, 0, 2, 9),
(9, '列出所有推荐商品', 'BoProducts', 'index', 'filter=is_recommend&is_recommend=1', NULL, NULL, NULL, 0, 2, 7),
(10, '列出所有置顶商品', 'BoProducts', 'index', 'filter=is_ontop&is_ontop=1', NULL, NULL, NULL, 0, 2, 3),
(11, ' 订单管理', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 2),
(12, '列出本日确认新订单', 'BoOrders', 'index', 'filter=is_confirm&is_confirm=1&range=today', NULL, NULL, NULL, 0, 11, 0),
(13, '列出全部确认新订单', 'BoOrders', 'index', 'filter=is_confirm&is_confirm=1', NULL, NULL, NULL, 0, 11, 1),
(14, '列出未确认订单', 'BoOrders', 'index', 'filter=is_confirm&is_confirm=0', NULL, NULL, NULL, 0, 11, 2),
(15, '列出本日发货订单', 'BoOrders', 'index', 'filter=is_processed&is_processed=1&range=today', NULL, NULL, NULL, 0, 11, 4),
(16, '列出全部发货订单', 'BoOrders', 'index', 'filter=is_processed&is_processed=1', NULL, NULL, NULL, 0, 11, 5),
(19, '列出全部订单', 'BoOrders', 'index', NULL, NULL, NULL, NULL, 0, 11, 8),
(31, ' 用户管理', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 4),
(32, '列出所有会员', 'BoMembers', 'index', NULL, NULL, NULL, NULL, 0, 31, 0),
(33, '列出普通会员', 'BoMembers', 'index', 'filter=level_ix&level_ix=1', NULL, NULL, NULL, 0, 31, 1),
(34, '列出VIP会员', 'BoMembers', 'index', 'filter=level_ix&level_ix=2', NULL, NULL, NULL, 0, 31, 2),
(35, '列出高级VIP会员', 'BoMembers', 'index', 'filter=level_ix&level_ix=3', NULL, NULL, NULL, 0, 31, 3),
(36, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 31, 4),
(37, '审核用户', 'BoMembers', 'index', 'filter=is_locked&is_locked=1', NULL, NULL, NULL, 0, 31, 5),
(38, 'VIP升级管理', 'BoUpgrade', 'index', 'filter=status_ix&status_ix=0', NULL, NULL, NULL, 0, 31, 6),
(39, '已经通过的VIP升级', 'BoUpgrade', 'index', 'filter=status_ix&status_ix=1', NULL, NULL, NULL, 0, 31, 7),
(40, '拒绝的VIP升级', 'BoUpgrade', 'index', 'filter=status_ix&status_ix=2', NULL, NULL, NULL, 0, 31, 8),
(44, ' 网站内容管理', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 6),
(48, '发布新闻', 'BoNews', 'add', NULL, NULL, NULL, NULL, 0, 44, 3),
(49, '列出新闻', 'BoNews', 'index', NULL, NULL, NULL, NULL, 0, 44, 4),
(50, ' 网站设置', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 7),
(51, '系统设置', 'BoSettings', 'global', NULL, NULL, NULL, NULL, 0, 50, 0),
(53, '送货方式设置', 'BoDeliverMethods', 'index', NULL, NULL, NULL, NULL, 0, 50, 11),
(54, '付款方式设置', 'BoPaymentMethods', 'index', NULL, NULL, NULL, NULL, 0, 50, 12),
(55, '退款方式设置', 'BoRefundmentMethods', 'index', NULL, NULL, NULL, NULL, 0, 50, 13),
(56, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 50, 5),
(57, '标签管理', 'BoTags', 'index', NULL, NULL, NULL, NULL, 0, 2, 11),
(58, '后台用户管理', 'BoSysUsers', 'index', NULL, NULL, NULL, NULL, 0, 50, 8),
(60, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 11, 3),
(61, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 11, 6),
(63, '列出所有现货商品', 'BoProducts', 'index', 'filter=is_on_hand&is_on_hand=1', NULL, NULL, NULL, 0, 2, 4),
(64, '商品地区设置', 'BoLocations', 'index', NULL, NULL, NULL, NULL, 0, 2, 13),
(65, '列出所有缺货商品', 'BoProducts', 'index', 'filter=stock_in_trade&stock_in_trade=0', NULL, NULL, NULL, 0, 2, 5),
(66, '列出所有预订商品', 'BoProducts', 'index', 'filter=is_on_hand&is_on_hand=0', NULL, NULL, NULL, 0, 2, 6),
(67, '标签类别管理', 'BoTagTypes', 'index', NULL, NULL, NULL, NULL, 0, 2, 12),
(68, NULL, NULL, '', NULL, NULL, NULL, NULL, 1, 31, 9),
(69, '违约用户管理', 'BoMembers', 'index', 'filter=is_breach&is_breach=1', NULL, NULL, NULL, 0, 31, 10),
(70, ' 站内短信', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 5),
(71, '查看用户发送的消息', 'BoMessages', 'index', NULL, NULL, NULL, NULL, 0, 70, 0),
(72, '查看管理员发送的消息', 'BoMessages', 'outbox', NULL, NULL, NULL, NULL, 0, 70, 1),
(73, '群发消息', 'BoMessages', 'send', NULL, NULL, NULL, NULL, 0, 70, 3),
(74, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 2, 10);

-- --------------------------------------------------------

--
-- 表的结构 `dm_sysroles`
--

CREATE TABLE IF NOT EXISTS `dm_sysroles` (
  `role_id` int(11) NOT NULL auto_increment,
  `group_id` int(11) NOT NULL default '0',
  `rolename` varchar(64) NOT NULL default '',
  `description` varchar(255) NOT NULL default '',
  `is_system` tinyint(1) NOT NULL default '0',
  `req` varchar(255) default NULL,
  PRIMARY KEY  (`role_id`),
  KEY `group_id` (`group_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=44 ;

--
-- 导出表中的数据 `dm_sysroles`
--

INSERT INTO `dm_sysroles` (`role_id`, `group_id`, `rolename`, `description`, `is_system`, `req`) VALUES
(1, 6, 'ROOT', '系统管理员权限，可以创建其他管理员', 1, NULL),
(2, 1, '前台功能设置', '前台功能设置', 1, NULL),
(3, 1, '商品相关设置', '商品相关设置', 1, NULL),
(4, 1, '用户注册默认设置', '用户注册默认设置', 1, NULL),
(5, 1, '违约用户检查', '违约用户检查', 1, NULL),
(6, 1, '送货方式设置', '送货方式设置', 1, NULL),
(7, 1, '付款方式设置', '付款方式设置', 1, NULL),
(8, 1, '后台用户管理', '后台用户管理', 1, NULL),
(9, 3, '导出会员资料', '导出VIP和高级VIP会员的资料', 1, '18'),
(10, 2, '发布新闻', '发布新闻', 1, '11'),
(11, 2, '列出及修改新闻', '列出及修改新闻', 1, NULL),
(12, 2, '查看会员消息', '列出及查看会员发送的消息', 1, NULL),
(13, 2, '查看管理员发送的消息', '查看管理员发送的消息', 1, NULL),
(14, 2, '向会员发送消息', '向会员发送消息', 1, '12'),
(15, 2, '群发消息', '群发消息', 1, NULL),
(17, 2, '删除消息', '删除消息', 1, '12'),
(18, 3, '列出会员', '列出并查看会员账户信息', 1, NULL),
(19, 3, '修改会员', '修改会员账户信息', 1, '18'),
(20, 3, '审核会员', '审核会员：通过审核的会员才能登录系统', 1, '18'),
(21, 3, '审核VIP升级', '通过或者拒绝VIP升级请求', 1, NULL),
(25, 3, '删除会员', '删除会员的帐户', 1, '18'),
(26, 4, '列出并查看所有订单', '列出并查看所有订单', 1, NULL),
(27, 4, '修改订单', '修改订单', 1, '26'),
(28, 4, '确认订单', '确认订单', 1, '26'),
(30, 4, '确认发货', '确认发货', 1, '26'),
(31, 4, '删除订单', '删除订单', 1, '26'),
(32, 5, '添加商品', '添加新的商品', 1, '33'),
(33, 5, '列出商品', '浏览商品、搜索商品', 1, NULL),
(34, 5, '商品审核', '商品审核', 1, '33'),
(35, 5, '商品图片管理', '商品图片管理', 1, '33'),
(36, 5, '标签管理', '标签管理', 1, NULL),
(37, 5, '标签类别管理', '标签类别管理', 1, NULL),
(38, 5, '商品地区管理', '商品地区管理', 1, NULL),
(39, 5, '删除商品', '删除商品', 1, '33'),
(40, 1, 'VIP升级设置', 'VIP升级设置', 1, NULL),
(41, 1, '会员级别变更通知设置', '会员级别变更通知设置', 1, NULL),
(42, 1, '退款方式设置', '退款方式设置', 1, NULL),
(43, 5, '修改商品', '修改已有商品的信息', 1, '33');

-- --------------------------------------------------------

--
-- 表的结构 `dm_sysroles_group`
--

CREATE TABLE IF NOT EXISTS `dm_sysroles_group` (
  `group_id` int(11) NOT NULL auto_increment,
  `title` varchar(128) NOT NULL,
  PRIMARY KEY  (`group_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- 导出表中的数据 `dm_sysroles_group`
--

INSERT INTO `dm_sysroles_group` (`group_id`, `title`) VALUES
(1, '商城核心设置'),
(2, '网站内容管理'),
(3, '用户管理'),
(4, '订单管理'),
(5, '商品管理'),
(6, '系统管理员（所有权限）');
