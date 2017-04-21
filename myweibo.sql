/*
Navicat MySQL Data Transfer

Source Server         : mysql
Source Server Version : 50714
Source Host           : localhost:3306
Source Database       : myweibo

Target Server Type    : MYSQL
Target Server Version : 50714
File Encoding         : 65001

Date: 2017-04-21 15:25:21
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `wb_admin`
-- ----------------------------
DROP TABLE IF EXISTS `wb_admin`;
CREATE TABLE `wb_admin` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(20) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `password` char(32) COLLATE utf8_unicode_ci NOT NULL,
  `logintime` int(10) unsigned NOT NULL,
  `loginip` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `lock` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `admin` smallint(3) unsigned NOT NULL DEFAULT '0' COMMENT '//0 普通管理员 ；1是超级管理员；',
  `create_at` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of wb_admin
-- ----------------------------
INSERT INTO `wb_admin` VALUES ('1', 'admin', '123456', '5', '5', '0', '1', '55');

-- ----------------------------
-- Table structure for `wb_atme`
-- ----------------------------
DROP TABLE IF EXISTS `wb_atme`;
CREATE TABLE `wb_atme` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '提及到我',
  `wid` int(10) unsigned NOT NULL COMMENT '//在哪篇微博提及到我',
  `uid` int(10) unsigned NOT NULL,
  `create_at` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of wb_atme
-- ----------------------------
INSERT INTO `wb_atme` VALUES ('1', '39', '7', '1492080894');
INSERT INTO `wb_atme` VALUES ('2', '40', '7', '1492081871');

-- ----------------------------
-- Table structure for `wb_comment`
-- ----------------------------
DROP TABLE IF EXISTS `wb_comment`;
CREATE TABLE `wb_comment` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `content` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `uid` int(10) unsigned NOT NULL,
  `wid` int(10) unsigned NOT NULL,
  `create_at` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`) USING BTREE,
  KEY `uid` (`uid`) USING BTREE,
  KEY `wid` (`wid`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of wb_comment
-- ----------------------------
INSERT INTO `wb_comment` VALUES ('1', ' // @马云 : 分享图片！~~', '14', '11', '1491363627');
INSERT INTO `wb_comment` VALUES ('6', ' // @漩涡鸣人 :  // @漩涡鸣人 :  // @马云 : 分享图片！~~吱吱吱吱吱吱', '14', '32', '1491365830');
INSERT INTO `wb_comment` VALUES ('7', ' // @漩涡鸣人 :  // @漩涡鸣人 :  // @漩涡鸣人 :  // @马云 : 分享图片！~~吱吱吱吱吱吱1111', '14', '34', '1491365850');
INSERT INTO `wb_comment` VALUES ('8', ' // @漩涡鸣人 :  // @漩涡鸣人 :  // @漩涡鸣人 :  // @漩涡鸣人 :  // @马云 : 分享图片！~~吱吱吱吱吱吱1111222222222', '15', '35', '1491366026');
INSERT INTO `wb_comment` VALUES ('9', 'asdfasdfa', '14', '35', '1491367987');
INSERT INTO `wb_comment` VALUES ('10', 'asdfa', '14', '35', '1491368123');
INSERT INTO `wb_comment` VALUES ('11', 'asfaf', '14', '35', '1491368178');
INSERT INTO `wb_comment` VALUES ('12', '樱桃小丸子评论了', '15', '36', '1491368352');
INSERT INTO `wb_comment` VALUES ('13', '樱桃小丸子评论了', '15', '36', '1491368376');
INSERT INTO `wb_comment` VALUES ('14', '发表评论！！', '14', '35', '1491371528');
INSERT INTO `wb_comment` VALUES ('15', '发表啊手动阀手动阀手动阀啊', '14', '35', '1491371873');
INSERT INTO `wb_comment` VALUES ('16', '噼噼啪啪', '14', '35', '1491371908');
INSERT INTO `wb_comment` VALUES ('17', 'asdfasfa', '14', '32', '1491372164');
INSERT INTO `wb_comment` VALUES ('18', '表情评论解析[[哈哈]][[哈哈]]', '14', '35', '1491372385');
INSERT INTO `wb_comment` VALUES ('19', '[[右哼哼]]', '14', '35', '1491372454');
INSERT INTO `wb_comment` VALUES ('20', '[[哈哈]][[呵呵]]', '14', '35', '1491372471');
INSERT INTO `wb_comment` VALUES ('21', 'aaaaaaaa', '15', '36', '1491373814');
INSERT INTO `wb_comment` VALUES ('22', 'aaaaa', '14', '35', '1491373984');
INSERT INTO `wb_comment` VALUES ('23', 'aaaaaa', '14', '34', '1491374124');
INSERT INTO `wb_comment` VALUES ('24', '啊啊啊', '15', '37', '1491406487');
INSERT INTO `wb_comment` VALUES ('25', '马化腾来评论', '15', '37', '1492078842');
INSERT INTO `wb_comment` VALUES ('26', 'aaaaaaaaa', '8', '38', '1492079436');

-- ----------------------------
-- Table structure for `wb_follow`
-- ----------------------------
DROP TABLE IF EXISTS `wb_follow`;
CREATE TABLE `wb_follow` (
  `follow` int(10) unsigned NOT NULL COMMENT '被关注的id  ',
  `fans` int(10) unsigned NOT NULL COMMENT '某用户的id对应follow的',
  `gid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '//所属的组；例如同学；同时，同家乡；where("follow=wo and gid=''同学''")->field("fans")  查到，关注我的粉丝，并且是我的同学；',
  KEY `follow` (`follow`) USING BTREE,
  KEY `fans` (`fans`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of wb_follow
-- ----------------------------
INSERT INTO `wb_follow` VALUES ('1', '6', '0');
INSERT INTO `wb_follow` VALUES ('6', '1', '0');
INSERT INTO `wb_follow` VALUES ('7', '6', '0');
INSERT INTO `wb_follow` VALUES ('7', '6', '0');
INSERT INTO `wb_follow` VALUES ('8', '6', '0');
INSERT INTO `wb_follow` VALUES ('0', '6', '3');
INSERT INTO `wb_follow` VALUES ('0', '6', '3');
INSERT INTO `wb_follow` VALUES ('1', '15', '6');
INSERT INTO `wb_follow` VALUES ('14', '15', '6');
INSERT INTO `wb_follow` VALUES ('3', '15', '6');

-- ----------------------------
-- Table structure for `wb_group`
-- ----------------------------
DROP TABLE IF EXISTS `wb_group`;
CREATE TABLE `wb_group` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(45) COLLATE utf8_unicode_ci NOT NULL COMMENT '//分组的名称',
  `uid` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of wb_group
-- ----------------------------
INSERT INTO `wb_group` VALUES ('1', '同学', '9');
INSERT INTO `wb_group` VALUES ('2', '同事', '9');
INSERT INTO `wb_group` VALUES ('3', '同学', '6');
INSERT INTO `wb_group` VALUES ('4', '朋友', '6');
INSERT INTO `wb_group` VALUES ('5', '明星', '6');
INSERT INTO `wb_group` VALUES ('6', '同学', '15');

-- ----------------------------
-- Table structure for `wb_keep`
-- ----------------------------
DROP TABLE IF EXISTS `wb_keep`;
CREATE TABLE `wb_keep` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '//收藏表；一篇微博可能有多个人收藏，一对多关系； 被谁收藏；一对一的关系',
  `uid` int(10) unsigned NOT NULL,
  `wid` int(10) unsigned NOT NULL,
  `create_at` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`) USING BTREE,
  KEY `wid` (`wid`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of wb_keep
-- ----------------------------
INSERT INTO `wb_keep` VALUES ('1', '15', '35', '1491379790');

-- ----------------------------
-- Table structure for `wb_letter`
-- ----------------------------
DROP TABLE IF EXISTS `wb_letter`;
CREATE TABLE `wb_letter` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `from` int(10) unsigned NOT NULL COMMENT '//信息从哪里来，记录发信息的uid',
  `content` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `create_at` int(10) unsigned NOT NULL,
  `uid` int(10) unsigned NOT NULL COMMENT '//查看谁给我发信息where("uid=wo")->field("from,content,create_at")->select();',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`) USING BTREE,
  KEY `uid` (`uid`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of wb_letter
-- ----------------------------

-- ----------------------------
-- Table structure for `wb_picture`
-- ----------------------------
DROP TABLE IF EXISTS `wb_picture`;
CREATE TABLE `wb_picture` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '//微博的配图；',
  `mini` varchar(60) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `medium` varchar(60) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `max` varchar(80) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `source` varchar(80) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `wid` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of wb_picture
-- ----------------------------
INSERT INTO `wb_picture` VALUES ('1', './Uploads/2017-04-04/_80758e326129e4ed.jpg', '', '', '', '7');
INSERT INTO `wb_picture` VALUES ('2', './Uploads/2017-04-04/_80758e33b3861ace.jpg', '', '', '', '9');
INSERT INTO `wb_picture` VALUES ('3', './Uploads/2017-04-04/_80758e33b38a9367.jpg', '', '', '', '9');
INSERT INTO `wb_picture` VALUES ('4', './Uploads/2017-04-04/_80758e33cc2adbd0.jpg', '', '', '', '10');
INSERT INTO `wb_picture` VALUES ('5', './Uploads/2017-04-04/_80758e33cc31d367.jpg', '', '', '', '10');
INSERT INTO `wb_picture` VALUES ('6', './Uploads/2017-04-04/_80758e33e6929b2b.jpg', './Uploads/2017-04-04/_180758e33e6929b2b.jpg', './Uploads/2017-04-04/_400758e33e6929b2b.jpg', './Uploads/2017-04-04/58e33e6929b2b.jpg', '11');
INSERT INTO `wb_picture` VALUES ('7', './Uploads/2017-04-04/_80758e33e69980e5.jpg', './Uploads/2017-04-04/_180758e33e69980e5.jpg', './Uploads/2017-04-04/_400758e33e69980e5.jpg', './Uploads/2017-04-04/58e33e69980e5.jpg', '11');
INSERT INTO `wb_picture` VALUES ('8', './Uploads/2017-04-04/_80758e33e69c5b67.jpg', './Uploads/2017-04-04/_180758e33e69c5b67.jpg', './Uploads/2017-04-04/_400758e33e69c5b67.jpg', './Uploads/2017-04-04/58e33e69c5b67.jpg', '11');
INSERT INTO `wb_picture` VALUES ('9', './Uploads/2017-04-04/_80758e348815a3c3.jpg', './Uploads/2017-04-04/_180758e348815a3c3.jpg', './Uploads/2017-04-04/_400758e348815a3c3.jpg', './Uploads/2017-04-04/58e348815a3c3.jpg', '13');
INSERT INTO `wb_picture` VALUES ('10', './Uploads/2017-04-04/_801358e3b86bc90b7.jpg', './Uploads/2017-04-04/_1801358e3b86bc90b7.jpg', './Uploads/2017-04-04/_4001358e3b86bc90b7.jpg', './Uploads/2017-04-04/58e3b86bc90b7.jpg', '16');
INSERT INTO `wb_picture` VALUES ('11', './Uploads/2017-04-04/_801358e3c0a36b5f7.jpg', './Uploads/2017-04-04/_1801358e3c0a36b5f7.jpg', './Uploads/2017-04-04/_4001358e3c0a36b5f7.jpg', './Uploads/2017-04-04/58e3c0a36b5f7.jpg', '18');
INSERT INTO `wb_picture` VALUES ('12', './Uploads/2017-04-05/_801458e4411f2d49a.jpg', './Uploads/2017-04-05/_1801458e4411f2d49a.jpg', './Uploads/2017-04-05/_4001458e4411f2d49a.jpg', './Uploads/2017-04-05/58e4411f2d49a.jpg', '20');
INSERT INTO `wb_picture` VALUES ('13', './Uploads/2017-04-05/_801458e442860a685.jpg', './Uploads/2017-04-05/_1801458e442860a685.jpg', './Uploads/2017-04-05/_4001458e442860a685.jpg', './Uploads/2017-04-05/58e442860a685.jpg', '21');

-- ----------------------------
-- Table structure for `wb_user`
-- ----------------------------
DROP TABLE IF EXISTS `wb_user`;
CREATE TABLE `wb_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `account` char(20) COLLATE utf8_unicode_ci NOT NULL,
  `password` char(32) COLLATE utf8_unicode_ci NOT NULL,
  `create_at` int(10) unsigned NOT NULL,
  `lock` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否锁定',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`) USING BTREE,
  UNIQUE KEY `account` (`account`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of wb_user
-- ----------------------------
INSERT INTO `wb_user` VALUES ('1', 'admin', 'fcea920f7412b5da7be0cf42b8c93759', '111', '1');
INSERT INTO `wb_user` VALUES ('2', 'admin2', 'e10adc3949ba59abbe56e057f20f883e', '1491124278', '1');
INSERT INTO `wb_user` VALUES ('3', 'admin3', 'e10adc3949ba59abbe56e057f20f883e', '1491124682', '0');
INSERT INTO `wb_user` VALUES ('4', 'admin4', 'e10adc3949ba59abbe56e057f20f883e', '1491124753', '0');
INSERT INTO `wb_user` VALUES ('5', 'admin5', 'e10adc3949ba59abbe56e057f20f883e', '1491125044', '0');
INSERT INTO `wb_user` VALUES ('6', 'guojikai', 'e10adc3949ba59abbe56e057f20f883e', '1491186377', '0');
INSERT INTO `wb_user` VALUES ('7', 'woshimayun', 'e10adc3949ba59abbe56e057f20f883e', '1491190525', '0');
INSERT INTO `wb_user` VALUES ('8', 'mahuateng', 'e10adc3949ba59abbe56e057f20f883e', '1491190766', '0');
INSERT INTO `wb_user` VALUES ('9', 'liyanhui', 'e10adc3949ba59abbe56e057f20f883e', '1491191034', '0');
INSERT INTO `wb_user` VALUES ('10', 'tongpan', 'e10adc3949ba59abbe56e057f20f883e', '1491191147', '0');
INSERT INTO `wb_user` VALUES ('11', 'huangyongcheng', 'e10adc3949ba59abbe56e057f20f883e', '1491191289', '0');
INSERT INTO `wb_user` VALUES ('12', 'mukewang', 'e10adc3949ba59abbe56e057f20f883e', '1491191402', '0');
INSERT INTO `wb_user` VALUES ('13', 'labixiaoxin', 'e10adc3949ba59abbe56e057f20f883e', '1491318705', '0');
INSERT INTO `wb_user` VALUES ('14', 'xuanwomingren', 'e10adc3949ba59abbe56e057f20f883e', '1491353784', '0');
INSERT INTO `wb_user` VALUES ('15', 'yingtaoxiaowanzi', 'e10adc3949ba59abbe56e057f20f883e', '1491365907', '0');

-- ----------------------------
-- Table structure for `wb_userinfo`
-- ----------------------------
DROP TABLE IF EXISTS `wb_userinfo`;
CREATE TABLE `wb_userinfo` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `truename` varchar(45) COLLATE utf8_unicode_ci DEFAULT '',
  `sex` enum('男','女') COLLATE utf8_unicode_ci NOT NULL DEFAULT '男',
  `location` varchar(45) COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '//所在地',
  `constellation` char(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `intro` varchar(100) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `face50` varchar(60) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `face80` varchar(60) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `face180` varchar(60) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `style` varchar(45) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'default' COMMENT '//个性模板',
  `follow` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '//关注数；',
  `fans` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '//粉丝',
  `weibo` int(10) unsigned NOT NULL DEFAULT '0',
  `uid` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`) USING BTREE,
  UNIQUE KEY `uid` (`uid`) USING BTREE,
  CONSTRAINT `wb_userinfo_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `wb_user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of wb_userinfo
-- ----------------------------
INSERT INTO `wb_userinfo` VALUES ('1', 'admin', 'kai', '男', 'a', null, 'meiyou', './Uploads/Face/_50158e1a46281af1.jpg', './Uploads/Face/_80158e1a46281af1.jpg', './Uploads/Face/_150158e1a46281af1.jpg', 'default', '0', '1', '0', '1');
INSERT INTO `wb_userinfo` VALUES ('2', 'admin3', 'aaaa', '女', '黑龙江 黑河', '巨蟹座', '', '', '', '', 'default', '0', '1', '0', '3');
INSERT INTO `wb_userinfo` VALUES ('3', 'admin4', 'aaa', '男', ' ', '', '', '', '', '', 'default', '0', '0', '0', '4');
INSERT INTO `wb_userinfo` VALUES ('5', '郭积开', '开', '男', '广东 阳江', '巨蟹座', '啊啊啊啊', './Uploads/Face/_50658e1b33177d28.jpg', './Uploads/Face/_80658e1b33177d28.jpg', './Uploads/Face/_150658e1b33177d28.jpg', 'default', '6', '0', '0', '6');
INSERT INTO `wb_userinfo` VALUES ('6', '马云', '', '男', '', null, '', './Uploads/Face/_50758e326b1a3f25.jpg', './Uploads/Face/_80758e326b1a3f25.jpg', './Uploads/Face/_150758e326b1a3f25.jpg', 'default', '0', '1', '1', '7');
INSERT INTO `wb_userinfo` VALUES ('7', '马化腾', '', '男', '', null, '', './Uploads/Face/_50858e1c45e674a6.jpg', './Uploads/Face/_80858e1c45e674a6.jpg', './Uploads/Face/_150858e1c45e674a6.jpg', 'default', '0', '1', '2', '8');
INSERT INTO `wb_userinfo` VALUES ('8', '李炎恢', '', '男', '', null, '', './Uploads/Face/_50958e1c68a51c16.jpg', './Uploads/Face/_80958e1c68a51c16.jpg', './Uploads/Face/_150958e1c68a51c16.jpg', 'default', '0', '0', '0', '9');
INSERT INTO `wb_userinfo` VALUES ('9', '童攀', '', '男', '', null, '', '', '', '', 'default', '0', '0', '0', '10');
INSERT INTO `wb_userinfo` VALUES ('10', '黄永成', '', '男', '', null, '', '', '', '', 'default', '0', '0', '0', '11');
INSERT INTO `wb_userinfo` VALUES ('11', '慕课网', '', '男', '', null, '', '', '', '', 'default', '0', '0', '0', '12');
INSERT INTO `wb_userinfo` VALUES ('12', '蜡笔小新', '', '男', '', null, '', './Uploads/Face/_501358e3b84823436.jpg', './Uploads/Face/_801358e3b84823436.jpg', './Uploads/Face/_1501358e3b84823436.jpg', 'default', '0', '0', '0', '13');
INSERT INTO `wb_userinfo` VALUES ('13', '漩涡鸣人', '', '男', '', null, '', './Uploads/Face/_501458e44100200c3.jpg', './Uploads/Face/_801458e44100200c3.jpg', './Uploads/Face/_1501458e44100200c3.jpg', 'default', '0', '1', '4', '14');
INSERT INTO `wb_userinfo` VALUES ('14', '樱桃小丸子', 'yingtao', '女', '甘肃 白银', '狮子座', '我是殷桃小丸子！~~·', './Uploads/Face/_501558e4704c35824.jpg', './Uploads/Face/_801558e4704c35824.jpg', './Uploads/Face/_1501558e4704c35824.jpg', 'default', '3', '0', '2', '15');

-- ----------------------------
-- Table structure for `wb_weibo`
-- ----------------------------
DROP TABLE IF EXISTS `wb_weibo`;
CREATE TABLE `wb_weibo` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `content` char(255) COLLATE utf8_unicode_ci NOT NULL,
  `isfigure` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '//默认没有配图；',
  `isturn` int(10) unsigned NOT NULL DEFAULT '0',
  `turn` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '// 转发的次数',
  `keep` int(10) unsigned NOT NULL DEFAULT '0',
  `comment` int(10) unsigned NOT NULL DEFAULT '0',
  `create_at` int(10) unsigned NOT NULL,
  `uid` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`) USING BTREE,
  KEY `uid` (`uid`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of wb_weibo
-- ----------------------------
INSERT INTO `wb_weibo` VALUES ('3', '[血战上甘岭：方寸之地争夺惨烈，10分钟揭秘43天绞肉机之战！] \n上甘岭，一个不足3.7平方公里的狭小地带，成为了继二战以来最惨烈的战场，随手抓把土，能数出30多块弹片；一面战旗，被打穿381个弹孔；一截一米不到的树干上，竟然嵌进了100多个弹头和弹片！', '0', '0', '0', '0', '9', '1491242811', '6');
INSERT INTO `wb_weibo` VALUES ('4', '[血战上甘岭：方寸之地争夺惨烈，10分钟揭秘43天绞肉机之战！] \n上甘岭，一个不足3.7平方公里的狭小地带，成为了继二战以来最惨烈的战场，随手抓把土，能数出30多块弹片；一面战旗，被打穿381个弹孔；一截一米不到的树干上，竟然嵌进了100多个弹头和弹片！', '0', '0', '0', '0', '9', '1491242837', '6');
INSERT INTO `wb_weibo` VALUES ('5', '【奖项公布迎重大改革 总决赛后将举办颁奖典礼】今年常规赛的各项奖项宣布方式可能会与往年有所不同，官方将首次尝试颁奖典礼的方式，典礼将与当地时间6月26日在曼哈顿举行。联盟届时将公布常规赛MVP得主已经其他主要的奖项，而颁奖典礼将全程在TNT直播', '0', '0', '0', '0', '9', '1491242894', '6');
INSERT INTO `wb_weibo` VALUES ('6', '【辽宁舰编队时隔两月在黄渤海夜间训练】连日来，歼-15舰载战斗机从辽宁舰飞行甲板起飞升空，多名舰载战斗机飞行员进行了舰基技术恢复训练和战术课目训练飞行，开展了空中加受油、空中对抗、空面打击等多项训练任务，各型舰载直升机进行了夜间着舰训练，担负完成伴航搜救、警戒任务。 ​​​​', '0', '0', '0', '0', '9', '1491276122', '7');
INSERT INTO `wb_weibo` VALUES ('7', '170303 雪花舞台问候+170305 雪花Myung talk高清 [CR:ForMemory922/jy_94922] 咬嘴嘟嘴!!!!!!好想在这粉嫩嫩的小嘴上面咬几口[泪] ​​​​[阴险][太开心]', '1', '0', '0', '0', '9', '1491281429', '7');
INSERT INTO `wb_weibo` VALUES ('8', '[[抱抱]]   ssss', '0', '0', '0', '0', '9', '1491285239', '7');
INSERT INTO `wb_weibo` VALUES ('9', '多图上传 [[哈哈]][[哈哈]][[抱抱]][[抱抱]]', '1', '0', '0', '0', '9', '1491286873', '7');
INSERT INTO `wb_weibo` VALUES ('10', '[[抱抱]][[抱抱]]asdfasdfasda', '1', '0', '0', '0', '9', '1491287249', '7');
INSERT INTO `wb_weibo` VALUES ('11', '分享图片！~~', '1', '0', '5', '0', '10', '1491287738', '7');
INSERT INTO `wb_weibo` VALUES ('12', '@admin', '0', '0', '0', '0', '9', '1491288933', '7');
INSERT INTO `wb_weibo` VALUES ('13', '[[抱抱]][[抱抱]]  一张图', '1', '0', '0', '0', '9', '1491290248', '7');
INSERT INTO `wb_weibo` VALUES ('14', '[[抱抱]][[抱抱]]aaaa', '0', '0', '0', '0', '9', '1491290728', '7');
INSERT INTO `wb_weibo` VALUES ('15', '头像', '0', '0', '0', '0', '9', '1491291270', '7');
INSERT INTO `wb_weibo` VALUES ('16', '蜡笔小新来发微博[[抱抱]][[抱抱]]', '1', '0', '0', '0', '9', '1491318894', '13');
INSERT INTO `wb_weibo` VALUES ('17', '[[嘻嘻]][[哈哈]][[怒骂]] 测试表情发布', '0', '0', '0', '0', '9', '1491319748', '13');
INSERT INTO `wb_weibo` VALUES ('18', '分享图片[[吃惊]]', '1', '0', '1', '0', '9', '1491321006', '13');
INSERT INTO `wb_weibo` VALUES ('19', '前台解析表情功能；[[怒骂]][[阴险]][[鄙视]]', '0', '0', '0', '0', '9', '1491322312', '13');
INSERT INTO `wb_weibo` VALUES ('20', '我是漩涡鸣人啊[[哈哈]][[哈哈]]', '1', '0', '0', '0', '9', '1491353891', '14');
INSERT INTO `wb_weibo` VALUES ('21', '[[打哈欠]] 漩涡鸣人', '1', '0', '0', '0', '9', '1491354253', '14');
INSERT INTO `wb_weibo` VALUES ('22', ' // @漩涡鸣人 : [[打哈欠]] 漩涡鸣人', '0', '21', '0', '0', '9', '1491356947', '14');
INSERT INTO `wb_weibo` VALUES ('23', ' // @漩涡鸣人 :  // @漩涡鸣人 : [[打哈欠]] 漩涡鸣人', '0', '22', '0', '0', '9', '1491360389', '14');
INSERT INTO `wb_weibo` VALUES ('24', ' // @漩涡鸣人 : [[打哈欠]] 漩涡鸣人', '0', '21', '0', '0', '9', '1491360419', '14');
INSERT INTO `wb_weibo` VALUES ('25', ' // @蜡笔小新 : 分享图片[[吃惊]]', '0', '18', '3', '0', '9', '1491360685', '14');
INSERT INTO `wb_weibo` VALUES ('26', ' // @漩涡鸣人 :  // @蜡笔小新 : 分享图片[[吃惊]]  多重转发微博', '0', '25', '1', '0', '9', '1491361807', '14');
INSERT INTO `wb_weibo` VALUES ('27', ' // @漩涡鸣人 :  // @漩涡鸣人 :  // @蜡笔小新 : 分享图片[[吃惊]]  多重转发微博啊啊啊啊啊啊啊', '0', '26', '0', '0', '9', '1491362223', '14');
INSERT INTO `wb_weibo` VALUES ('28', ' // @马云 : 分享图片！~~啊啊啊啊啊啊 测试同时评论', '0', '11', '0', '0', '9', '1491363000', '14');
INSERT INTO `wb_weibo` VALUES ('29', ' // @马云 : 分享图片！~~啊啊啊啊啊啊 测试同时评论', '0', '11', '0', '0', '9', '1491363159', '14');
INSERT INTO `wb_weibo` VALUES ('30', ' // @马云 : 分享图片！~~', '0', '11', '4', '0', '9', '1491363627', '14');
INSERT INTO `wb_weibo` VALUES ('31', ' // @漩涡鸣人 :  // @马云 : 分享图片！~~吱吱吱吱吱吱', '0', '30', '0', '0', '9', '1491364754', '14');
INSERT INTO `wb_weibo` VALUES ('32', ' // @漩涡鸣人 :  // @马云 : 分享图片！~~吱吱吱吱吱吱', '0', '30', '3', '0', '10', '1491365368', '14');
INSERT INTO `wb_weibo` VALUES ('33', ' // @漩涡鸣人 :  // @漩涡鸣人 :  // @马云 : 分享图片！~~吱吱吱吱吱吱', '0', '32', '0', '0', '9', '1491365750', '14');
INSERT INTO `wb_weibo` VALUES ('34', ' // @漩涡鸣人 :  // @漩涡鸣人 :  // @马云 : 分享图片！~~吱吱吱吱吱吱', '0', '32', '2', '0', '11', '1491365830', '14');
INSERT INTO `wb_weibo` VALUES ('35', ' // @漩涡鸣人 :  // @漩涡鸣人 :  // @漩涡鸣人 :  // @马云 : 分享图片！~~吱吱吱吱吱吱1111', '0', '34', '1', '1', '10', '1491365850', '14');
INSERT INTO `wb_weibo` VALUES ('36', ' // @漩涡鸣人 :  // @漩涡鸣人 :  // @漩涡鸣人 :  // @漩涡鸣人 :  // @马云 : 分享图片！~~吱吱吱吱吱吱1111222222222', '0', '35', '0', '0', '9', '1491366025', '15');
INSERT INTO `wb_weibo` VALUES ('37', '听说总裁冷淡，我偏不信邪，做小秘第一天就让他开了荤~没想到他人前正经，床上格外性急，“别说话，吃吧~[[哈哈]][[哈哈]]', '0', '0', '0', '0', '2', '1491372533', '15');
INSERT INTO `wb_weibo` VALUES ('38', '&lt;script&gt;alert(&quot;aaaa&quot;)&lt;/script&gt;[[哈哈]]', '0', '0', '0', '0', '1', '1492079194', '8');
INSERT INTO `wb_weibo` VALUES ('39', '@马化腾', '0', '0', '0', '0', '0', '1492080894', '8');
INSERT INTO `wb_weibo` VALUES ('40', '@马云', '0', '0', '0', '0', '0', '1492081871', '7');
