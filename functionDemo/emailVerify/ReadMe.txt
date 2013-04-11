邮箱验证模块：
 require 
 1、PHPMailer ，请加入到你的PHP include_path,详情参看 https://github.com/Synchro/PHPMailer；

 2、Mysql 数据表
CREATE TABLE IF NOT EXISTS `users` (
`id` int(11) NOT NULL auto_increment,
`status` varchar(20) NOT NULL,
`username` varchar(20) NOT NULL,
`password` varchar(20) NOT NULL,
`email` varchar(20) NOT NULL,
`activationkey` varchar(100) NOT NULL,
PRIMARY KEY (`id`),
UNIQUE KEY `username` (`username`),
UNIQUE KEY `email` (`email`),
UNIQUE KEY `activationkey` (`activationkey`)
)



	