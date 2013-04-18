-- phpMyAdmin SQL Dump
-- version 3.4.11.1deb1
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2013 年 04 月 18 日 22:28
-- 服务器版本: 5.5.29
-- PHP 版本: 5.4.6-1ubuntu1.2

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
-- 表的结构 `allbook`
--

CREATE TABLE IF NOT EXISTS `allbook` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ISBN` varchar(30) DEFAULT NULL,
  `name` varchar(30) DEFAULT NULL,
  `author` varchar(100) DEFAULT NULL,
  `publish` varchar(50) DEFAULT NULL,
  `version` varchar(20) DEFAULT NULL,
  `course_name` varchar(80) NOT NULL,
  `course_category` varchar(20) NOT NULL COMMENT '课程类别，如班级课程，公选课程',
  `major` varchar(80) NOT NULL,
  `grade` varchar(10) NOT NULL,
  `term` tinyint(2) NOT NULL DEFAULT '1',
  `print` tinyint(2) NOT NULL DEFAULT '0' COMMENT '是否胶印',
  PRIMARY KEY (`id`),
  KEY `ISBN` (`ISBN`,`name`),
  KEY `name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `circulating_book`
--

CREATE TABLE IF NOT EXISTS `circulating_book` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `from_user_id` int(11) unsigned NOT NULL COMMENT '第一书源人',
  `to_user_id` int(11) unsigned DEFAULT NULL COMMENT '第二书源人',
  `ISBN` varchar(30) DEFAULT NULL,
  `name` varchar(30) DEFAULT NULL,
  `circulate_number` int(11) NOT NULL DEFAULT '0' COMMENT '流通次数',
  `book_right` tinyint(2) NOT NULL DEFAULT '0' COMMENT '0=>私有;1=>共同',
  `book_status` tinyint(2) NOT NULL DEFAULT '1' COMMENT '0=>未上架；1=>已上架',
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '书本添加时间',
  `change_time` datetime DEFAULT NULL COMMENT '书源人改变时间',
  PRIMARY KEY (`id`),
  KEY `ISBN` (`ISBN`),
  KEY `name` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

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
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `password` varchar(16) NOT NULL,
  `truename` char(20) NOT NULL,
  `student_id` int(12) NOT NULL COMMENT '学号',
  `campus` varchar(50) NOT NULL DEFAULT '大学城',
  `faculty` varchar(40) NOT NULL COMMENT '学院',
  `major` varchar(80) NOT NULL COMMENT '专业',
  `grade` varchar(10) NOT NULL COMMENT '年级',
  `phone_number` char(11) NOT NULL,
  `subphone_number` varchar(8) NOT NULL COMMENT '短号',
  `dormitory` varchar(12) NOT NULL,
  `activationkey` varchar(100) NOT NULL,
  `status` tinyint(2) NOT NULL DEFAULT '0' COMMENT '-1=>禁止;0=>未激活;1=>激活/正常',
  `register_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `activationkey` (`activationkey`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
