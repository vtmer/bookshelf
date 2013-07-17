-- phpMyAdmin SQL Dump
-- version 3.4.10.1
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2013 年 07 月 17 日 11:51
-- 服务器版本: 5.5.20
-- PHP 版本: 5.3.10

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `bookshelf`
--

-- --------------------------------------------------------

--
-- 表的结构 `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `password` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `allbook`
--

CREATE TABLE IF NOT EXISTS `allbook` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ISBN` varchar(30) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `author` varchar(40) DEFAULT NULL,
  `publish` varchar(50) DEFAULT NULL,
  `version` varchar(20) DEFAULT NULL,
  `course_name` varchar(80) NOT NULL,
  `course_category` varchar(20) NOT NULL COMMENT '课程类别，如班级课程，公选课程',
  `term` tinyint(2) NOT NULL DEFAULT '1',
  `print` tinyint(2) NOT NULL DEFAULT '0' COMMENT '是否胶印',
  `status` int(5) NOT NULL DEFAULT '1' COMMENT '书的状态：0=>''下架''，1=>''上架''',
  PRIMARY KEY (`id`),
  KEY `ISBN` (`ISBN`,`name`),
  KEY `name` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `allbook_mg`
--

CREATE TABLE IF NOT EXISTS `allbook_mg` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `grade` varchar(10) NOT NULL,
  `major` varchar(100) NOT NULL,
  `book_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `borrow_log`
--

CREATE TABLE IF NOT EXISTS `borrow_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `book_id` int(11) NOT NULL COMMENT '书本ID',
  `from_id` int(11) NOT NULL COMMENT '借出人的ID',
  `to_id` int(11) NOT NULL COMMENT '要借书的人ID',
  `time` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `circulating_book`
--

CREATE TABLE IF NOT EXISTS `circulating_book` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `from_id` int(11) unsigned NOT NULL COMMENT '第一书源人',
  `to_id` int(11) unsigned DEFAULT NULL COMMENT '第二书源人',
  `book_id` int(11) unsigned NOT NULL,
  `circulate_number` int(11) NOT NULL DEFAULT '0' COMMENT '流通次数',
  `book_right` tinyint(2) NOT NULL DEFAULT '0' COMMENT '0=>私有;1=>共同',
  `book_status` tinyint(2) NOT NULL DEFAULT '0' COMMENT '0=>闲置；1=>预约中；2=>借出',
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '书本添加时间',
  `change_time` datetime DEFAULT NULL COMMENT '书源人改变时间',
  PRIMARY KEY (`id`),
  KEY `to_id` (`to_id`),
  KEY `from_id` (`from_id`),
  KEY `book_id` (`book_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `message`
--

CREATE TABLE IF NOT EXISTS `message` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `from` varchar(16) NOT NULL,
  `to` varchar(16) NOT NULL,
  `title` varchar(30) NOT NULL,
  `content` text NOT NULL,
  `status` tinyint(2) NOT NULL DEFAULT '0' COMMENT '0=>未读;1=>已读',
  `create_time` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `student_id` varchar(11) NOT NULL COMMENT '学号',
  `truename` char(20) NOT NULL,
  `campus` varchar(50) NOT NULL DEFAULT '大学城',
  `faculty` varchar(40) NOT NULL COMMENT '学院',
  `major` varchar(80) NOT NULL COMMENT '专业',
  `grade` varchar(10) NOT NULL COMMENT '年级',
  `phone_number` char(11) NOT NULL,
  `subphone_number` varchar(8) NOT NULL COMMENT '短号',
  `dormitory` varchar(12) NOT NULL,
  `activationkey` varchar(100) DEFAULT NULL,
  `status` tinyint(2) NOT NULL DEFAULT '0' COMMENT '-1=>禁止;0=>未激活;1=>激活/正常',
  `points` int(11) NOT NULL DEFAULT '30' COMMENT '积分',
  `donate_book` int(11) NOT NULL DEFAULT '0' COMMENT '捐书总数',
  `borrow_book` int(11) NOT NULL DEFAULT '0' COMMENT '借入书本总数',
  `lend_book` int(11) NOT NULL DEFAULT '0' COMMENT '借出书本总数',
  `register_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `activationkey` (`activationkey`),
  KEY `student_id` (`student_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- 限制导出的表
--

--
-- 限制表 `circulating_book`
--
ALTER TABLE `circulating_book`
  ADD CONSTRAINT `circulating_book_ibfk_1` FOREIGN KEY (`from_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `circulating_book_ibfk_2` FOREIGN KEY (`to_id`) REFERENCES `user` (`id`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `circulating_book_ibfk_3` FOREIGN KEY (`book_id`) REFERENCES `allbook` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
