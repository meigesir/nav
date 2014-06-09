/*
SQLyog Ultimate v9.63 
MySQL - 5.5.17 : Database - nav_php
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`nav_php` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `nav_php`;

/*Table structure for table `node` */

DROP TABLE IF EXISTS `node`;

CREATE TABLE `node` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) CHARACTER SET gbk DEFAULT NULL,
  `u_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `t_node_w_id` (`u_id`),
  CONSTRAINT `t_user_node` FOREIGN KEY (`u_id`) REFERENCES `t_user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8;

/*Data for the table `node` */

insert  into `node`(`id`,`name`,`u_id`) values (1,'校园招聘',1883441410),(26,'不错站点',1883441410),(37,'网上购物',1883441410),(38,'云平台',1883441410);

/*Table structure for table `suggest` */

DROP TABLE IF EXISTS `suggest`;

CREATE TABLE `suggest` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `message` varchar(200) CHARACTER SET gbk DEFAULT NULL,
  `contact` varchar(30) CHARACTER SET gbk DEFAULT NULL,
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=58 DEFAULT CHARSET=utf8;

/*Data for the table `suggest` */

insert  into `suggest`(`id`,`message`,`contact`) values (47,'大家好','emomeildg'),(53,'dddd都懂得','都懂得'),(54,'helo','emomeild@gmail.com'),(56,'hello','qq'),(57,'hello','qq');

/*Table structure for table `t_user` */

DROP TABLE IF EXISTS `t_user`;

CREATE TABLE `t_user` (
  `id` int(11) NOT NULL,
  `name` varchar(20) CHARACTER SET gbk DEFAULT NULL,
  `pwd` varchar(32) CHARACTER SET gbk DEFAULT NULL,
  `email` varchar(30) CHARACTER SET gbk DEFAULT NULL,
  KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `t_user` */

insert  into `t_user`(`id`,`name`,`pwd`,`email`) values (1883441410,'meigesir','3a3b775f0d835ef0e66ead0bad9af741','emomeild@gmail.com');

/*Table structure for table `t_weibo` */

DROP TABLE IF EXISTS `t_weibo`;

CREATE TABLE `t_weibo` (
  `w_id` int(11) NOT NULL,
  `w_name` varchar(20) CHARACTER SET gbk DEFAULT NULL,
  `w_img` varchar(255) CHARACTER SET gbk DEFAULT NULL,
  PRIMARY KEY (`w_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `t_weibo` */

insert  into `t_weibo`(`w_id`,`w_name`,`w_img`) values (1883441410,'魔sir','http://tp3.sinaimg.cn/1883441410/50/5645796337/1');

/*Table structure for table `tag` */

DROP TABLE IF EXISTS `tag`;

CREATE TABLE `tag` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) CHARACTER SET gbk DEFAULT NULL,
  `url` varchar(255) CHARACTER SET gbk DEFAULT NULL,
  `node_id` int(11) NOT NULL,
  PRIMARY KEY (`id`,`node_id`),
  KEY `node_tag` (`node_id`),
  CONSTRAINT `node_tag` FOREIGN KEY (`node_id`) REFERENCES `node` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

/*Data for the table `tag` */

insert  into `tag`(`id`,`name`,`url`,`node_id`) values (1,'新浪','http://campus.sina.com.cn/index.php/info/sina',1),(2,'百度','http://tongxue.baidu.com/baidu/',1),(3,'腾讯','http://join.qq.com/index.php',1),(14,'36氪','http://www.36kr.com',26),(15,'淘宝','http://www.taobao.com',37),(16,'sae','http://sina.app.com.cn',38);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
