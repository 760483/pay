

/*Table structure for table `pay_app` */

DROP TABLE IF EXISTS `pay_app`;

CREATE TABLE `pay_app` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `app_id` varchar(50) NOT NULL DEFAULT '' COMMENT '应用id',
  `app_secret` varchar(50) NOT NULL DEFAULT '' COMMENT '应用密码',
  `app_name` varchar(50) NOT NULL DEFAULT '' COMMENT '应用名称',
  `app_status` tinyint(2) NOT NULL DEFAULT '1' COMMENT '应用状态：0表示禁用，1表示启用',
  `app_info` tinytext NOT NULL COMMENT '应用说明',
  `handler` varchar(32) NOT NULL DEFAULT '10000' COMMENT '操作者id',
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `update_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新时间',
  `app_api` text COMMENT '当前应用允许请求的全部API接口',
  PRIMARY KEY (`id`),
  UNIQUE KEY `app_id` (`app_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='appId和appSecret表';

/*Data for the table `pay_app` */

insert  into `pay_app`(`id`,`app_id`,`app_secret`,`app_name`,`app_status`,`app_info`,`handler`,`create_at`,`update_at`,`app_api`) values (1,'69920173','SVRZKjiXaLnaIGaqCqjsCloazWRfOUdl','测试账号',1,'获取api使用的密钥','10000','2018-04-09 23:09:03','2018-04-09 23:09:03',NULL),(2,'72706061','OZswbfqtJHWTSehfGIFSydLzvxhpQWDy','生产账号',0,'应用上线用账号','10000','2018-04-09 23:09:03','2018-04-11 22:47:30',NULL),(3,'48770236','YsOHpGNNdyTirlXBvLsHlIaGHBFLcLzc','Demo',1,'我是呆萌666','10000','2018-04-11 23:19:24','2018-04-11 23:22:30',NULL);

/*Table structure for table `pay_document` */

DROP TABLE IF EXISTS `pay_document`;

CREATE TABLE `pay_document` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `key` varchar(50) NOT NULL DEFAULT '' COMMENT '授权秘钥',
  `endTime` int(11) NOT NULL DEFAULT '0' COMMENT '失效时间戳',
  `times` int(11) NOT NULL DEFAULT '0' COMMENT '访问次数',
  `lastTime` int(11) NOT NULL DEFAULT '0' COMMENT '最后访问时间',
  `lastIp` varchar(50) NOT NULL DEFAULT '' COMMENT '最后访问IP',
  `createTime` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1生效，0失效',
  `handler` varchar(32) NOT NULL DEFAULT '10000' COMMENT '操作者id',
  PRIMARY KEY (`id`),
  UNIQUE KEY `key` (`key`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='文档访问秘钥';

/*Data for the table `pay_document` */

insert  into `pay_document`(`id`,`key`,`endTime`,`times`,`lastTime`,`lastIp`,`createTime`,`status`,`handler`) values (1,'120243761017e3fd94f1210564ff6229',1550764800,0,1516512958,'60.176.30.146',1523462676,1,'10000'),(2,'jm12345',1524153600,6,1524016731,'127.0.0.1',1523462659,1,'10000'),(3,'demo666',1525017600,0,0,'',1523461842,1,'10000');

/*Table structure for table `pay_fields` */

DROP TABLE IF EXISTS `pay_fields`;

CREATE TABLE `pay_fields` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `fieldName` varchar(50) NOT NULL DEFAULT '' COMMENT '字段名称',
  `hash` varchar(50) NOT NULL DEFAULT '' COMMENT '对应接口的唯一标识',
  `dataType` tinyint(2) NOT NULL DEFAULT '0' COMMENT '数据类型，来源于DataType类库',
  `default` varchar(500) NOT NULL DEFAULT '' COMMENT '默认值',
  `isMust` tinyint(2) NOT NULL DEFAULT '0' COMMENT '是否必须 0为不必须，1为必须',
  `range` varchar(500) NOT NULL DEFAULT '' COMMENT '范围，Json字符串，根据数据类型有不一样的含义',
  `info` varchar(500) NOT NULL DEFAULT '' COMMENT '字段说明',
  `type` tinyint(2) NOT NULL DEFAULT '0' COMMENT '字段用处：0为request，1为response',
  `showName` varchar(50) NOT NULL DEFAULT '' COMMENT 'wiki显示用字段',
  `handler` varchar(32) NOT NULL DEFAULT '10000' COMMENT '操作者id',
  PRIMARY KEY (`id`),
  KEY `hash` (`hash`)
) ENGINE=InnoDB AUTO_INCREMENT=57 DEFAULT CHARSET=utf8 COMMENT='用于保存各个API的请求和返回字段规则';

/*Data for the table `pay_fields` */

insert  into `pay_fields`(`id`,`fieldName`,`hash`,`dataType`,`default`,`isMust`,`range`,`info`,`type`,`showName`,`handler`) values (1,'timestamp','5a60c77b79875',1,'1514736000',1,'','当前时间戳，精确到秒十位整型数据',0,'timestamp','10000'),(2,'app_id','5a60c77b79875',2,'69920173',1,'','服务器分配的应用ID',0,'app_id','10000'),(3,'rand_str','5a60c77b79875',2,'CJbHN4oIRT2L',1,'','随机字符串，由客户端生成，建议长度为12~16位，只允许大小写字母+数字',0,'rand_str','10000'),(4,'signature','5a60c77b79875',2,'',1,'','客户端根据约定算法计算出的身份标识',0,'signature','10000'),(5,'device_id','5a60c77b79875',1,'668668',1,'','设备ID，必填，没有的可以自己随便写个就可以',0,'device_id','10000'),(6,'data','5a60c77b79875',9,'',1,'','数据对象',1,'data','10000'),(7,'data{}access_token','5a60c77b79875',2,'',1,'','应用身份令牌',1,'data{}access_token','10000'),(8,'data{}expires_in','5a60c77b79875',1,'',1,'','access_token剩余有效期时间，单位秒（S）',1,'data{}expires_in','10000'),(9,'data{}Product','5a570d64428ca',2,'',1,'','产品',1,'data{}Product','10000'),(10,'data{}Version','5a570d64428ca',2,'',1,'','接口版本',1,'data{}Version','10000'),(11,'data{}Company','5a570d64428ca',2,'',1,'','开发团队',1,'data{}Company','10000'),(12,'data{}ToYou','5a570d64428ca',2,'',1,'','欢迎词',1,'data{}ToYou','10000'),(13,'data','5a570d64428ca',9,'',1,'','数据对象',1,'data','10000'),(14,'img','5a64a01c9ed67',2,'',1,'','图片进行base64编码后的字符串',0,'img','10000'),(15,'uptype','5a64a01c9ed67',2,'oss',0,'','uptype 指定上传文件存储方式，可选择( local | qiniu | oss ) 为空跟随总后台设置',0,'uptype','10000'),(16,'data','5a64a01c9ed67',9,'',1,'','返回数据对象',1,'data','10000'),(17,'data{}Url','5a64a01c9ed67',2,'',1,'','图片上传成功后的URL地址',1,'data{}Url','10000'),(18,'file','5a63444c41b45',6,'',1,'','要上传的文件(类型:文本,图片,压缩包等...20M以内)',0,'file','10000'),(19,'data','5a63444c41b45',9,'',1,'','返回data数据对象',1,'data','10000'),(20,'data{}Url','5a63444c41b45',2,'',1,'','文件上传成功后的URL地址',1,'data{}Url','10000'),(21,'file','5acce4ff98111',6,'',1,'','要上传的文件(类型:文本,图片,压缩包等...20M以内)',0,'file','10000'),(22,'data','5acce4ff98111',9,'',1,'','返回数据对象',1,'data','10000'),(23,'info','5acce4ff98111',3,'',1,'','返回结果信息',1,'data{}info','10000'),(24,'data','5acce4ff98111',9,'',1,'','返回data数据对象',1,'data{}info[]','10000'),(25,'data{}info[]{}code','5acce4ff98111',1,'',1,'','状态码',1,'data{}info[]{}code','10000'),(26,'data{}info[]{}url','5acce4ff98111',2,'',1,'','文件上传后url地址',1,'data{}info[]{}url','10000'),(27,'data{}info[]{}file_name','5acce4ff98111',2,'',1,'','源文件名称',1,'data{}info[]{}file_name','10000'),(28,'mobile','5acd9f48bb275',8,'',1,'','正确的手机号',0,'mobile','10000'),(29,'signame','5acd9f48bb275',2,'ThinkApiAdmin',0,'','短信模板签名',0,'signame','10000'),(30,'email','5acdaf03ae160',2,'',1,'','正确的收件人邮件地址',0,'email','10000'),(31,'data','5acd9f48bb275',9,'',1,'','数据对象',1,'data','10000'),(32,'data{}SmsMsg','5acd9f48bb275',2,'',1,'','短信发送成功提示',1,'data{}SmsMsg','10000'),(33,'data','5a6ad33cd8b30',9,'',1,'','返回data数据对象',1,'data','10000'),(34,'data{}Result','5a6ad33cd8b30',3,'',1,'','操作结果说明',1,'data{}Result','10000'),(35,'data{}Result[]','5a6ad33cd8b30',9,'',1,'','操作结果数组',1,'data{}Result[]','10000'),(36,'data{}Result[]{}id','5a6ad33cd8b30',1,'',1,'','省份ID',1,'data{}Result[]{}id','10000'),(37,'data{}Result[]{}parent_id','5a6ad33cd8b30',1,'',1,'','国家ID(pid)',1,'data{}Result[]{}parent_id','10000'),(38,'data{}Result[]{}name','5a6ad33cd8b30',2,'',1,'','省份名称',1,'data{}Result[]{}name','10000'),(39,'data{}Result[]{}type','5a6ad33cd8b30',1,'',1,'','地区类型(1:省份,2:城市,3:县区)',1,'data{}Result[]{}type','10000'),(40,'pid','5a6ad3bc9c27e',1,'',1,'','省份ID',0,'pid','10000'),(41,'data','5a6ad3bc9c27e',9,'',1,'','返回data数据对象',1,'data','10000'),(42,'data{}Result','5a6ad3bc9c27e',3,'',1,'','操作结果说明',1,'data{}Result','10000'),(43,'data{}Result[]','5a6ad3bc9c27e',9,'',1,'','操作结果数组',1,'data{}Result[]','10000'),(44,'data{}Result[]{}id','5a6ad3bc9c27e',1,'',1,'','城市ID',1,'data{}Result[]{}id','10000'),(45,'data{}Result[]{}parent_id','5a6ad3bc9c27e',1,'',1,'','省份ID(pid)',1,'data{}Result[]{}parent_id','10000'),(46,'data{}Result[]{}name','5a6ad3bc9c27e',2,'',1,'','城市名称',1,'data{}Result[]{}name','10000'),(47,'data{}Result[]{}type','5a6ad3bc9c27e',1,'',1,'','地区类型(1:省份,2:城市,3:县区)',1,'data{}Result[]{}type','10000'),(48,'cid','5a6ad401210c7',1,'',1,'','城市ID',0,'cid','10000'),(49,'data','5a6ad401210c7',9,'',1,'','返回data数据对象',1,'data','10000'),(50,'data{}Result','5a6ad401210c7',3,'',1,'','操作结果说明',1,'data{}Result','10000'),(51,'data{}Result[]','5a6ad401210c7',9,'',1,'','操作结果数组',1,'data{}Result[]','10000'),(52,'data{}Result[]{}id','5a6ad401210c7',1,'',1,'','县区ID',1,'data{}Result[]{}id','10000'),(53,'data{}Result[]{}parent_id','5a6ad401210c7',1,'',1,'','城市ID(pid)',1,'data{}Result[]{}parent_id','10000'),(54,'data{}Result[]{}name','5a6ad401210c7',2,'',1,'','县区名称',1,'data{}Result[]{}name','10000'),(55,'data{}Result[]{}type','5a6ad401210c7',1,'',1,'','地区类型(1:省份,2:城市,3:县区)',1,'data{}Result[]{}type','10000'),(56,'hello','5a570d64428ca',2,'',1,'','',0,'hello','10000');

/*Table structure for table `pay_group` */

DROP TABLE IF EXISTS `pay_group`;

CREATE TABLE `pay_group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL DEFAULT '' COMMENT '组名称',
  `img` varchar(255) NOT NULL DEFAULT '' COMMENT '组缩略图',
  `description` varchar(60) NOT NULL COMMENT '组描述',
  `detail` varchar(60) NOT NULL DEFAULT '' COMMENT '组额外细节',
  `hot_num` int(11) unsigned NOT NULL DEFAULT '1' COMMENT '组热度,点击率',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '组状态：为1正常，为0禁用',
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `update_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新时间',
  `is_deleted` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '删除状态(1:删除,0:未删)',
  `handler` varchar(32) NOT NULL DEFAULT '10000' COMMENT '操作者id',
  `sort` tinyint(2) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='接口API组';

/*Data for the table `pay_group` */

insert  into `pay_group`(`id`,`name`,`img`,`description`,`detail`,`hot_num`,`status`,`create_at`,`update_at`,`is_deleted`,`handler`,`sort`) values (1,'公共api组','','公共通用系列api接口','Tools',563,1,'2018-01-17 09:45:07','2018-04-18 11:45:50',0,'10000',2),(2,'Debug分组','','测试,问题接口','待修复接口',12,1,'2018-04-09 16:07:18','2018-04-18 11:02:38',0,'10000',3);

/*Table structure for table `pay_list` */

DROP TABLE IF EXISTS `pay_list`;

CREATE TABLE `pay_list` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `gid` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '' COMMENT '接口组id(可多个)',
  `apiName` varchar(50) CHARACTER SET utf8 NOT NULL DEFAULT '' COMMENT 'api索引，保存了类和方法',
  `hash` varchar(50) CHARACTER SET utf8 NOT NULL DEFAULT '' COMMENT 'api唯一标识',
  `accessToken` tinyint(2) NOT NULL DEFAULT '1' COMMENT '是否需要认证AccessToken 1：需要，0：不需要',
  `needLogin` tinyint(2) NOT NULL DEFAULT '1' COMMENT '是否需要认证用户token  1：需要 0：不需要',
  `status` tinyint(2) NOT NULL DEFAULT '1' COMMENT 'API状态：0表示禁用，1表示启用',
  `method` tinyint(2) NOT NULL DEFAULT '2' COMMENT '请求方式0：不限1：Post，2：Get',
  `info` varchar(500) CHARACTER SET utf8 NOT NULL DEFAULT '' COMMENT 'api中文说明',
  `isTest` tinyint(2) NOT NULL DEFAULT '0' COMMENT '是否是测试模式：0:生产模式，1：测试模式',
  `returnStr` text COMMENT '返回数据示例',
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `update_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新时间',
  `is_deleted` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '删除状态(1:删除,0:未删)',
  `handler` varchar(32) CHARACTER SET utf8 NOT NULL DEFAULT '10000' COMMENT '操作者id',
  `sort` tinyint(2) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
  PRIMARY KEY (`id`),
  UNIQUE KEY `hash` (`hash`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COMMENT='接口列表';

/*Data for the table `pay_list` */

insert  into `pay_list`(`id`,`gid`,`apiName`,`hash`,`accessToken`,`needLogin`,`status`,`method`,`info`,`isTest`,`returnStr`,`create_at`,`update_at`,`is_deleted`,`handler`,`sort`) values (1,'1,2','Index/index','5a570d64428ca',1,0,1,2,'欢迎使用ThinkApiAdmin v4.0',1,'{\"code\":1,\"msg\":\"\\u64cd\\u4f5c\\u6210\\u529f\",\"data\":{\"Product\":\"ThinkApiAdmin\",\"Version\":\"v4.0\",\"Company\":\"ThinkApiAdmin \\u00a9 2018\",\"ToYou\":\"I\\\'m glad to meet you\\uff08\\u7ec8\\u4e8e\\u7b49\\u5230\\u4f60\\uff01\\uff09\"},\"debug\":[{\"ThinkPHPVersion\":\"5.0.17\",\"PHPVersion\":\"7.2.0\"}]}','2018-01-16 23:27:11','2018-04-18 10:55:55',0,'10000',1),(2,'1','Buildtoken/getAccessToken','5a60c77b79875',1,0,1,1,'获取AccessToken',1,'{\"code\":1,\"msg\":\"\\u64cd\\u4f5c\\u6210\\u529f\",\"data\":{\"access_token\":\"00051a2e44df61d69ae1421a5f489885\",\"expires_in\":7200}}','2018-01-16 23:27:11','2018-04-11 14:44:49',0,'10000',2),(3,'1','Tool/uploadImage','5a64a01c9ed67',1,1,1,1,'图片上传接口(单文件,支持云存储)base64加密传输',1,'{\"code\":1,\"msg\":\"\\u64cd\\u4f5c\\u6210\\u529f\",\"data\":{\"Url\":\"http:\\/\\/asscdn.zwt520.com\\/1xdig8j7tw4zr1on\\/5a656240eb1f5.png\"}}','2018-01-21 22:14:58','2018-04-09 16:49:27',0,'10000',3),(4,'1','Tool/uploadFile','5a63444c41b45',1,1,1,1,'文件上传接口(单文件,云存储)模拟HTTP的Post请求方式',1,'{\"code\":1,\"msg\":\"\\u64cd\\u4f5c\\u6210\\u529f\",\"data\":{\"Url\":\"https:\\/\\/www.zwt520.com\\/jmnp\\/static\\/upload\\/1xdig8j7tw4zr1on\\/5a64a1b28aeb7.png\"}}','2018-01-20 21:33:59','2018-04-09 17:27:40',0,'10000',4),(6,'1','Tool/uploadFiles','5acce4ff98111',1,1,1,1,'文件上传接口(支持多文件文件,本地存储)模拟HTTP的Post请求方式',1,'{\"code\":1,\"msg\":\"\\u64cd\\u4f5c\\u6210\\u529f\",\"data\":{\"info\":[{\"code\":1,\"url\":\"https:\\/\\/zhushixtb.oss-cn-hangzhou.aliyuncs.com\\/1\\/5acce1ea9d34c.jpg\",\"file_name\":\"27.jpg\"},{\"code\":1,\"url\":\"https:\\/\\/zhushixtb.oss-cn-hangzhou.aliyuncs.com\\/1\\/5acce1eae18dc.jpg\",\"file_name\":\"28.jpg\"}]},\"debug\":[{\"Time\":\"2018-04-11 00:10:19\"}]}','2018-04-11 00:24:05','2018-04-11 14:45:07',0,'10000',5),(7,'1','Tool/getVcodeByMobile','5acd9f48bb275',1,0,1,2,'根据手机号获取验证码 (短信签名)',1,NULL,'2018-04-11 14:44:27','2018-04-11 14:47:01',0,'10000',6),(8,'1','Tool/getVcodeByEmail','5acdaf03ae160',1,0,1,2,'根据Email获取验证码',1,NULL,'2018-04-11 14:46:11','2018-04-11 14:47:05',0,'10000',7),(9,'1','Tool/getProvinceList','5a6ad33cd8b30',1,0,1,2,'获取省份名称和ID',1,'{\"code\":1,\"msg\":\"\\u64cd\\u4f5c\\u6210\\u529f\",\"data\":{\"Result\":[{\"id\":2,\"parent_id\":1,\"name\":\"\\u5317\\u4eac\",\"type\":1},{\"id\":3,\"parent_id\":1,\"name\":\"\\u5929\\u6d25\",\"type\":1},{\"id\":4,\"parent_id\":1,\"name\":\"\\u6cb3\\u5317\\u7701\",\"type\":1},{\"id\":5,\"parent_id\":1,\"name\":\"\\u5c71\\u897f\\u7701\",\"type\":1},{\"\\u7701\\u7565\":\"...\"}]}}','2018-01-26 15:07:02','2018-04-11 16:26:12',0,'10000',8),(10,'1','Tool/getCityListByPid','5a6ad3bc9c27e',1,0,1,2,'获取城市名称和ID通过省份ID',1,'{\"code\":1,\"msg\":\"\\u64cd\\u4f5c\\u6210\\u529f\",\"data\":{\"Result\":[{\"id\":123,\"parent_id\":12,\"name\":\"\\u676d\\u5dde\\u5e02\",\"type\":2},{\"id\":124,\"parent_id\":12,\"name\":\"\\u5b81\\u6ce2\\u5e02\",\"type\":2},{\"id\":125,\"parent_id\":12,\"name\":\"\\u6e29\\u5dde\\u5e02\",\"type\":2},{\"\\u7701\\u7565\":\"...\"}]}}','2018-01-26 15:08:47','2018-01-26 15:08:47',0,'10000',9),(11,'1','Tool/getDistrictListByCid','5a6ad401210c7',1,0,1,2,'获取县区名称和ID通过城市ID',1,'{\"code\":1,\"msg\":\"\\u64cd\\u4f5c\\u6210\\u529f\",\"data\":{\"Result\":[{\"id\":1362,\"parent_id\":123,\"name\":\"\\u4e0a\\u57ce\\u533a\",\"type\":3},{\"id\":1363,\"parent_id\":123,\"name\":\"\\u4e0b\\u57ce\\u533a\",\"type\":3},{\"id\":1364,\"parent_id\":123,\"name\":\"\\u6c5f\\u5e72\\u533a\",\"type\":3},{\"\\u7701\\u7565\":\"...\"}]}}','2018-01-26 15:09:40','2018-01-26 15:09:40',0,'10000',10);

/*Table structure for table `data_region` */

DROP TABLE IF EXISTS `data_region`;

CREATE TABLE `data_region` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT '上级id',
  `name` varchar(120) NOT NULL DEFAULT '' COMMENT '地区名称',
  `type` tinyint(1) NOT NULL DEFAULT '2' COMMENT '地区类型',
  PRIMARY KEY (`id`),
  KEY `parent_id` (`parent_id`),
  KEY `region_type` (`type`)
) ENGINE=InnoDB AUTO_INCREMENT=4044 DEFAULT CHARSET=utf8mb4 COMMENT='基础数据-地区表';


DROP TABLE IF EXISTS `system_auth`;

CREATE TABLE `system_auth` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(20) NOT NULL COMMENT '权限名称',
  `status` tinyint(1) unsigned DEFAULT '1' COMMENT '状态(1:禁用,2:启用)',
  `sort` smallint(6) unsigned DEFAULT '0' COMMENT '排序权重',
  `desc` varchar(255) DEFAULT NULL COMMENT '备注说明',
  `create_by` bigint(11) unsigned DEFAULT '0' COMMENT '创建人',
  `create_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `index_system_auth_title` (`title`) USING BTREE,
  KEY `index_system_auth_status` (`status`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='系统权限表';

/*Data for the table `system_auth` */

/*Table structure for table `system_auth_node` */

DROP TABLE IF EXISTS `system_auth_node`;

CREATE TABLE `system_auth_node` (
  `auth` bigint(20) unsigned DEFAULT NULL COMMENT '角色ID',
  `node` varchar(200) DEFAULT NULL COMMENT '节点路径',
  KEY `index_system_auth_auth` (`auth`) USING BTREE,
  KEY `index_system_auth_node` (`node`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='角色与节点关系表';

/*Data for the table `system_auth_node` */

/*Table structure for table `system_config` */

DROP TABLE IF EXISTS `system_config`;

CREATE TABLE `system_config` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL COMMENT '配置编码',
  `value` varchar(500) DEFAULT NULL COMMENT '配置值',
  PRIMARY KEY (`id`),
  KEY `index_system_config_name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='系统参数配置';

/*Data for the table `system_config` */

insert  into `system_config`(`id`,`name`,`value`) values (1,'site_name','ThinkApiAdmin'),(2,'site_copy','ThinkApiAdmin © 2018'),(3,'storage_type','local'),(4,'storage_qiniu_is_https','1'),(5,'storage_qiniu_bucket',''),(6,'storage_qiniu_domain',''),(7,'storage_qiniu_access_key',''),(8,'storage_qiniu_secret_key',''),(9,'storage_qiniu_region','华东'),(10,'app_name','ThinkApiAdmin'),(11,'app_version','v4.0'),(12,'browser_icon',''),(13,'wechat_appid',NULL),(14,'wechat_appsecret',NULL),(15,'wechat_token',NULL),(16,'wechat_encodingaeskey',NULL),(17,'wechat_mch_id',NULL),(18,'wechat_partnerkey',NULL),(19,'wechat_cert_key',NULL),(20,'wechat_cert_cert',NULL),(21,'tongji_baidu_key',''),(22,'tongji_cnzz_key',NULL),(23,'storage_oss_bucket',NULL),(24,'storage_oss_keyid',NULL),(25,'storage_oss_secret',NULL),(26,'storage_oss_domain',NULL),(27,'storage_oss_is_https','0'),(28,'storage_local_exts','png,jpg,rar,doc,icon,mp4,mp3,pem'),(29,'sms_status','0'),(30,'sms_dayu_keyid',''),(31,'sms_dayu_secret','');

/*Table structure for table `system_log` */

DROP TABLE IF EXISTS `system_log`;

CREATE TABLE `system_log` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `ip` char(15) NOT NULL DEFAULT '' COMMENT '操作者IP地址',
  `node` char(200) NOT NULL DEFAULT '' COMMENT '当前操作节点',
  `username` varchar(32) NOT NULL DEFAULT '' COMMENT '操作人用户名',
  `action` varchar(200) NOT NULL DEFAULT '' COMMENT '操作行为',
  `content` text NOT NULL COMMENT '操作内容描述',
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=145 DEFAULT CHARSET=utf8 COMMENT='系统操作日志表';

/*Data for the table `system_log` */

insert  into `system_log`(`id`,`ip`,`node`,`username`,`action`,`content`,`create_at`) values (1,'192.168.0.134','admin/login/index','admin','系统管理','用户登录系统成功','2018-04-08 12:30:45'),(2,'192.168.0.134','admin/login/out','admin','系统管理','用户退出系统成功','2018-04-08 13:12:52'),(3,'192.168.0.134','admin/login/index','admin','系统管理','用户登录系统成功','2018-04-08 13:14:25'),(4,'192.168.0.134','admin/login/out','admin','系统管理','用户退出系统成功','2018-04-08 13:14:46'),(5,'192.168.0.134','admin/login/index','admin','系统管理','用户登录系统成功','2018-04-08 13:16:15'),(6,'192.168.0.134','admin/login/out','admin','系统管理','用户退出系统成功','2018-04-08 13:16:55'),(7,'192.168.0.134','admin/login/index','admin','系统管理','用户登录系统成功','2018-04-08 13:31:50'),(8,'192.168.0.134','admin/login/out','admin','系统管理','用户退出系统成功','2018-04-08 13:34:52'),(9,'192.168.0.134','admin/login/index','admin','系统管理','用户登录系统成功','2018-04-08 13:35:11'),(10,'192.168.0.134','admin/config/index','admin','系统管理','系统参数配置成功','2018-04-08 13:36:43'),(11,'192.168.0.134','admin/config/file','admin','系统管理','系统参数配置成功','2018-04-08 13:40:20'),(12,'192.168.0.134','admin/config/index','admin','系统管理','系统参数配置成功','2018-04-08 13:51:48'),(13,'192.168.0.134','admin/config/index','admin','系统管理','系统参数配置成功','2018-04-08 13:51:56'),(14,'192.168.0.134','port/group/del','admin','API接口管理','API接口分组删除成功','2018-04-08 15:48:11'),(15,'192.168.0.134','port/group/restore','admin','API接口管理','还原接口分组成功','2018-04-08 15:48:19'),(16,'127.0.0.1','admin/login/index','admin','系统管理','用户登录系统成功','2018-04-08 22:02:24'),(17,'127.0.0.1','admin/login/out','admin','系统管理','用户退出系统成功','2018-04-08 22:02:43'),(18,'127.0.0.1','admin/login/index','admin','系统管理','用户登录系统成功','2018-04-08 22:03:38'),(19,'127.0.0.1','admin/login/out','admin','系统管理','用户退出系统成功','2018-04-08 22:09:31'),(20,'127.0.0.1','admin/login/index','admin','系统管理','用户登录系统成功','2018-04-08 22:09:40'),(21,'127.0.0.1','port/row/refresh','admin','API接口管理','刷新接口路由成功','2018-04-08 22:59:26'),(22,'127.0.0.1','port/row/refresh','admin','API接口管理','刷新接口路由成功','2018-04-08 23:03:26'),(23,'127.0.0.1','port/row/refresh','admin','API接口管理','刷新接口路由成功','2018-04-08 23:06:09'),(24,'127.0.0.1','port/row/refresh','admin','API接口管理','刷新接口路由成功','2018-04-08 23:06:42'),(25,'127.0.0.1','port/row/refresh','admin','API接口管理','刷新接口路由成功','2018-04-08 23:08:00'),(26,'127.0.0.1','port/row/refresh','admin','API接口管理','刷新接口路由成功','2018-04-08 23:10:02'),(27,'127.0.0.1','port/row/refresh','admin','API接口管理','刷新接口路由成功','2018-04-08 23:10:05'),(28,'127.0.0.1','port/row/refresh','admin','API接口管理','刷新接口路由成功','2018-04-08 23:10:09'),(29,'127.0.0.1','port/row/refresh','admin','API接口管理','刷新接口路由成功','2018-04-08 23:10:12'),(30,'127.0.0.1','port/row/refresh','admin','API接口管理','刷新接口路由成功','2018-04-08 23:12:51'),(31,'127.0.0.1','port/row/refresh','admin','API接口管理','刷新接口路由成功','2018-04-08 23:12:55'),(32,'127.0.0.1','port/row/refresh','admin','API接口管理','刷新接口路由成功','2018-04-08 23:12:58'),(33,'127.0.0.1','port/row/refresh','admin','API接口管理','刷新接口路由成功','2018-04-08 23:13:01'),(34,'127.0.0.1','port/row/refresh','admin','API接口管理','刷新接口路由成功','2018-04-08 23:13:04'),(35,'127.0.0.1','port/row/refresh','admin','API接口管理','刷新接口路由成功','2018-04-08 23:15:35'),(36,'127.0.0.1','port/row/refresh','admin','API接口管理','刷新接口路由成功','2018-04-08 23:16:05'),(37,'127.0.0.1','port/row/refresh','admin','API接口管理','刷新接口路由成功','2018-04-08 23:20:06'),(38,'127.0.0.1','port/row/refresh','admin','API接口管理','刷新接口路由成功','2018-04-08 23:22:26'),(39,'127.0.0.1','port/row/refresh','admin','API接口管理','刷新接口路由成功','2018-04-08 23:22:30'),(40,'127.0.0.1','port/row/refresh','admin','API接口管理','刷新接口路由成功','2018-04-08 23:22:33'),(41,'127.0.0.1','port/row/refresh','admin','API接口管理','刷新接口路由成功','2018-04-08 23:26:32'),(42,'127.0.0.1','port/row/refresh','admin','API接口管理','刷新接口路由成功','2018-04-08 23:26:37'),(43,'127.0.0.1','port/row/refresh','admin','API接口管理','刷新接口路由成功','2018-04-08 23:28:33'),(44,'192.168.0.134','admin/login/index','admin','系统管理','用户登录系统成功','2018-04-09 11:44:56'),(45,'192.168.0.134','admin/login/out','admin','系统管理','用户退出系统成功','2018-04-09 11:46:03'),(46,'192.168.0.134','admin/login/index','admin','系统管理','用户登录系统成功','2018-04-09 11:46:32'),(47,'192.168.0.134','port/row/forbid','admin','API接口管理管理','功能禁用成功','2018-04-09 14:09:42'),(48,'192.168.0.134','port/row/resume','admin','API接口管理管理','功能启用成功','2018-04-09 14:09:48'),(49,'192.168.0.134','port/row/resume','admin','API接口管理管理','功能启用成功','2018-04-09 14:09:53'),(50,'192.168.0.134','port/row/forbid','admin','API接口管理管理','功能禁用成功','2018-04-09 14:09:59'),(51,'192.168.0.134','port/row/forbid','admin','API接口管理管理','功能禁用成功','2018-04-09 14:19:01'),(52,'192.168.0.134','port/row/forbid','admin','API接口管理管理','功能禁用成功','2018-04-09 14:19:09'),(53,'192.168.0.134','port/row/resume','admin','API接口管理管理','功能启用成功','2018-04-09 14:19:18'),(54,'192.168.0.134','port/row/resume','admin','API接口管理管理','功能启用成功','2018-04-09 14:20:22'),(55,'192.168.0.134','port/row/forbid','admin','API接口管理管理','功能禁用成功','2018-04-09 14:20:42'),(56,'192.168.0.134','port/row/resume','admin','API接口管理管理','功能启用成功','2018-04-09 14:21:15'),(57,'192.168.0.134','port/row/refresh','admin','API接口管理','刷新接口路由成功','2018-04-09 14:22:38'),(58,'192.168.0.134','port/row/refresh','admin','API接口管理','刷新接口路由成功','2018-04-09 14:24:04'),(59,'192.168.0.134','port/row/forbid','admin','API接口管理管理','功能禁用成功','2018-04-09 14:37:25'),(60,'192.168.0.134','port/row/refresh','admin','API接口管理','刷新接口路由成功','2018-04-09 14:37:30'),(61,'192.168.0.134','port/row/resume','admin','API接口管理管理','功能启用成功','2018-04-09 14:39:29'),(62,'192.168.0.134','port/row/pay_tagset','admin','API接口管理管理','接口分组设置成功','2018-04-09 16:06:08'),(63,'192.168.0.134','port/row/pay_tagset','admin','API接口管理管理','接口分组设置成功','2018-04-09 16:06:31'),(64,'192.168.0.134','port/group/add','admin','API接口管理','添加API分组成功','2018-04-09 16:07:18'),(65,'192.168.0.134','port/row/pay_tagset','admin','API接口管理管理','接口分组设置成功','2018-04-09 16:07:29'),(66,'192.168.0.134','port/row/del','admin','API接口管理','API接口删除成功','2018-04-09 16:59:40'),(67,'127.0.0.1','admin/login/index','admin','系统管理','用户登录系统成功','2018-04-09 17:13:28'),(68,'127.0.0.1','port/row/restore','admin','API接口管理','还原接口删除成功','2018-04-09 17:27:40'),(69,'127.0.0.1','port/row/add','admin','API接口管理','添加接口成功','2018-04-09 21:54:20'),(70,'127.0.0.1','port/row/edit','admin','API接口管理','编辑接口成功','2018-04-09 22:09:55'),(71,'127.0.0.1','port/row/pay_tagset','admin','API接口管理管理','接口分组设置成功','2018-04-09 22:10:07'),(72,'127.0.0.1','port/row/refresh','admin','API接口管理','刷新接口路由成功','2018-04-09 22:10:17'),(73,'127.0.0.1','port/row/del','admin','API接口管理','API接口删除成功','2018-04-09 22:11:26'),(74,'127.0.0.1','port/visit/forbid_doc','admin','API接口管理管理','文档密钥禁用成功','2018-04-09 23:35:19'),(75,'127.0.0.1','port/visit/resume_doc','admin','API接口管理管理','文档密钥启用成功','2018-04-09 23:35:24'),(76,'127.0.0.1','admin/login/index','admin','系统管理','用户登录系统成功','2018-04-11 00:18:16'),(77,'127.0.0.1','port/row/add','admin','API接口管理','添加接口成功','2018-04-11 00:24:05'),(78,'127.0.0.1','port/row/pay_tagset','admin','API接口管理管理','接口分组设置成功','2018-04-11 00:24:19'),(79,'127.0.0.1','port/row/refresh','admin','API接口管理','刷新接口路由成功','2018-04-11 00:28:55'),(80,'127.0.0.1','admin/login/index','admin','系统管理','用户登录系统成功','2018-04-11 12:23:43'),(81,'127.0.0.1','port/row/add','admin','API接口管理','添加接口成功','2018-04-11 14:44:27'),(82,'127.0.0.1','port/row/edit','admin','API接口管理','编辑接口成功','2018-04-11 14:44:42'),(83,'127.0.0.1','port/row/edit','admin','API接口管理','编辑接口成功','2018-04-11 14:44:49'),(84,'127.0.0.1','port/row/edit','admin','API接口管理','编辑接口成功','2018-04-11 14:45:07'),(85,'127.0.0.1','port/row/add','admin','API接口管理','添加接口成功','2018-04-11 14:46:11'),(86,'127.0.0.1','port/row/pay_tagset','admin','API接口管理管理','接口分组设置成功','2018-04-11 14:47:01'),(87,'127.0.0.1','port/row/pay_tagset','admin','API接口管理管理','接口分组设置成功','2018-04-11 14:47:05'),(88,'127.0.0.1','port/row/refresh','admin','API接口管理','刷新接口路由成功','2018-04-11 14:47:28'),(89,'127.0.0.1','port/row/refresh','admin','API接口管理','刷新接口路由成功','2018-04-11 16:28:39'),(90,'127.0.0.1','port/visit/forbid','admin','API接口管理','应用禁用成功','2018-04-11 22:47:30'),(91,'127.0.0.1','port/visit/add','admin','API接口管理','添加接口应用成功','2018-04-11 23:19:24'),(92,'127.0.0.1','port/visit/edit','admin','API接口管理','编辑接口应用成功','2018-04-11 23:22:30'),(93,'127.0.0.1','port/visit/add_doc','admin','API接口管理','添加接口文档访问密钥成功','2018-04-11 23:50:42'),(94,'127.0.0.1','port/visit/edit_doc','admin','API接口管理','编辑接口文档访问密钥成功','2018-04-12 00:03:12'),(95,'127.0.0.1','port/visit/edit_doc','admin','API接口管理','编辑接口文档访问密钥成功','2018-04-12 00:04:19'),(96,'127.0.0.1','port/visit/edit_doc','admin','API接口管理','编辑接口文档访问密钥成功','2018-04-12 00:04:36'),(97,'127.0.0.1','admin/login/index','admin','系统管理','用户登录系统成功','2018-04-12 10:30:37'),(98,'127.0.0.1','admin/login/index','admin','系统管理','用户登录系统成功','2018-04-13 13:13:51'),(99,'127.0.0.1','admin/login/index','admin','系统管理','用户登录系统成功','2018-04-16 16:11:21'),(100,'127.0.0.1','port/row/forbid','admin','API接口管理','功能禁用成功','2018-04-16 16:39:25'),(101,'127.0.0.1','port/row/resume','admin','API接口管理','功能启用成功','2018-04-16 16:39:40'),(102,'127.0.0.1','admin/login/index','admin','系统管理','用户登录系统成功','2018-04-17 10:50:10'),(103,'127.0.0.1','port/row/delete','admin','API接口管理','彻底删除接口成功','2018-04-17 13:50:55'),(104,'127.0.0.1','port/row/edit','admin','API接口管理','编辑接口成功','2018-04-17 16:08:57'),(105,'127.0.0.1','port/row/resume','admin','API接口管理','功能启用成功','2018-04-17 16:10:42'),(106,'127.0.0.1','port/row/forbid','admin','API接口管理','功能禁用成功','2018-04-17 16:10:46'),(107,'127.0.0.1','port/row/add_param','admin','API接口管理','添加接口参数成功','2018-04-17 17:28:49'),(108,'127.0.0.1','port/row/edit_param','admin','API接口管理','编辑接口参数成功','2018-04-17 17:33:53'),(109,'127.0.0.1','port/row/edit_param','admin','API接口管理','编辑接口参数成功','2018-04-17 17:34:21'),(110,'127.0.0.1','port/row/del','admin','API接口管理','API接口删除成功','2018-04-17 18:16:03'),(111,'127.0.0.1','port/row/restore','admin','API接口管理','还原接口删除成功','2018-04-17 18:16:10'),(112,'127.0.0.1','port/row/edit_param','admin','API接口管理','编辑接口参数成功','2018-04-17 21:37:44'),(113,'127.0.0.1','port/row/edit_param','admin','API接口管理','编辑接口参数成功','2018-04-17 21:53:02'),(114,'127.0.0.1','port/row/edit_param','admin','API接口管理','编辑接口参数成功','2018-04-17 21:55:48'),(115,'127.0.0.1','port/row/edit_param','admin','API接口管理','编辑接口参数成功','2018-04-17 21:56:40'),(116,'127.0.0.1','port/row/edit_param','admin','API接口管理','编辑接口参数成功','2018-04-17 21:58:31'),(117,'127.0.0.1','port/row/edit_param','admin','API接口管理','编辑接口参数成功','2018-04-17 22:01:34'),(118,'127.0.0.1','port/row/edit_param','admin','API接口管理','编辑接口参数成功','2018-04-17 22:28:20'),(119,'127.0.0.1','port/row/edit_param','admin','API接口管理','编辑接口参数成功','2018-04-17 22:34:07'),(120,'127.0.0.1','port/row/edit_param','admin','API接口管理','编辑接口参数失败','2018-04-17 22:34:07'),(121,'127.0.0.1','port/row/edit_param','admin','API接口管理','编辑接口参数成功','2018-04-17 22:34:42'),(122,'127.0.0.1','port/row/edit_param','admin','API接口管理','编辑接口参数成功','2018-04-17 22:38:57'),(123,'127.0.0.1','port/row/edit_param','admin','API接口管理','编辑接口参数成功','2018-04-17 22:46:00'),(124,'127.0.0.1','port/row/edit_param','admin','API接口管理','编辑接口参数成功','2018-04-17 22:52:24'),(125,'127.0.0.1','port/row/edit','admin','API接口管理','编辑接口成功','2018-04-18 00:07:56'),(126,'127.0.0.1','admin/login/index','admin','系统管理','用户登录系统成功','2018-04-18 09:49:39'),(127,'127.0.0.1','port/row/del_param','admin','API接口管理','API接口参数删除成功','2018-04-18 09:50:52'),(128,'127.0.0.1','admin/login/index','admin','系统管理','用户登录系统成功','2018-04-18 09:51:05'),(129,'127.0.0.1','port/row/add_param','admin','API接口管理','添加接口参数成功','2018-04-18 09:53:52'),(130,'127.0.0.1','port/row/del_param','admin','API接口管理','API接口参数删除成功','2018-04-18 09:54:03'),(131,'127.0.0.1','port/row/add_param','admin','API接口管理','添加接口参数成功','2018-04-18 09:54:22'),(132,'127.0.0.1','port/row/add_param','admin','API接口管理','添加接口参数成功','2018-04-18 09:54:33'),(133,'127.0.0.1','port/row/del_param','admin','API接口管理','API接口参数删除成功','2018-04-18 09:55:02'),(134,'127.0.0.1','port/row/add','admin','API接口管理','添加接口成功','2018-04-18 09:56:46'),(135,'127.0.0.1','port/row/pay_tagset','admin','API接口管理','接口分组设置成功','2018-04-18 09:58:38'),(136,'127.0.0.1','port/row/add_param','admin','API接口管理','添加接口参数成功','2018-04-18 10:47:16'),(137,'127.0.0.1','port/row/upload_res','admin','API接口管理','API接口响应参数上传失败','2018-04-18 10:53:39'),(138,'127.0.0.1','port/row/upload_res','admin','API接口管理','API接口响应参数上传成功','2018-04-18 11:02:18'),(139,'127.0.0.1','port/row/upload_res','admin','API接口管理','API接口响应参数上传失败','2018-04-18 11:19:33'),(140,'127.0.0.1','port/row/upload_res','admin','API接口管理','API接口响应参数上传成功','2018-04-18 11:49:48'),(141,'127.0.0.1','port/row/del_param','admin','API接口管理','API接口参数删除成功','2018-04-18 11:53:15'),(142,'127.0.0.1','port/row/del','admin','API接口管理','API接口删除成功','2018-04-18 11:53:33'),(143,'127.0.0.1','port/row/delete','admin','API接口管理','彻底删除接口成功','2018-04-18 11:53:44'),(144,'127.0.0.1','port/row/add_param','admin','API接口管理','添加接口参数成功','2018-04-18 11:56:36');

/*Table structure for table `system_menu` */

DROP TABLE IF EXISTS `system_menu`;

CREATE TABLE `system_menu` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `pid` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '父id',
  `title` varchar(100) NOT NULL DEFAULT '' COMMENT '名称',
  `node` varchar(200) NOT NULL DEFAULT '' COMMENT '节点代码',
  `icon` varchar(100) NOT NULL DEFAULT '' COMMENT '菜单图标',
  `url` varchar(400) NOT NULL DEFAULT '' COMMENT '链接',
  `params` varchar(500) DEFAULT '' COMMENT '链接参数',
  `target` varchar(20) NOT NULL DEFAULT '_self' COMMENT '链接打开方式',
  `sort` int(11) unsigned DEFAULT '0' COMMENT '菜单排序',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '状态(0:禁用,1:启用)',
  `create_by` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '创建人',
  `create_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  PRIMARY KEY (`id`),
  KEY `index_system_menu_node` (`node`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=108 DEFAULT CHARSET=utf8 COMMENT='系统菜单表';

/*Data for the table `system_menu` */

insert  into `system_menu`(`id`,`pid`,`title`,`node`,`icon`,`url`,`params`,`target`,`sort`,`status`,`create_by`,`create_at`) values (2,0,'系统管理','','fa fa-cog','#','','_self',1000,1,0,'2015-11-16 19:15:38'),(4,2,'系统配置','','','#','','_self',100,1,0,'2016-03-14 18:12:55'),(5,4,'网站参数','','fa fa-apple','admin/config/index','','_self',20,1,0,'2016-05-06 14:36:49'),(6,4,'文件存储','','fa fa-save','admin/config/file','','_self',30,1,0,'2016-05-06 14:39:43'),(9,20,'操作日志','','glyphicon glyphicon-console','admin/log/index','','_self',50,1,0,'2017-03-24 15:49:31'),(19,20,'权限管理','','fa fa-user-secret','admin/auth/index','','_self',10,1,0,'2015-11-17 13:18:12'),(20,2,'系统权限','','','#','','_self',200,1,0,'2016-03-14 18:11:41'),(21,20,'系统菜单','','glyphicon glyphicon-menu-hamburger','admin/menu/index','','_self',30,1,0,'2015-11-16 19:16:16'),(22,20,'节点管理','','fa fa-ellipsis-v','admin/node/index','','_self',20,1,0,'2015-11-16 19:16:16'),(29,20,'系统用户','','fa fa-users','admin/user/index','','_self',40,1,0,'2016-10-31 14:31:40'),(61,0,'微信管理','','fa fa-wechat','#','','_self',2000,1,0,'2017-03-29 11:00:21'),(62,61,'微信对接配置','','','#','','_self',400,1,0,'2017-03-29 11:03:38'),(63,62,'微信接口配置\r\n','','fa fa-usb','wechat/config/index','','_self',10,1,0,'2017-03-29 11:04:44'),(65,61,'微信粉丝管理','','','#','','_self',100,1,0,'2017-03-29 11:08:32'),(66,65,'粉丝标签','','fa fa-tags','wechat/tags/index','','_self',20,1,0,'2017-03-29 11:09:41'),(67,65,'已关注粉丝','','fa fa-wechat','wechat/fans/index','','_self',10,1,0,'2017-03-29 11:10:07'),(68,61,'微信订制','','','#','','_self',200,1,0,'2017-03-29 11:10:39'),(69,68,'微信菜单定制','','glyphicon glyphicon-phone','wechat/menu/index','','_self',40,1,0,'2017-03-29 11:11:08'),(70,68,'关键字管理','','fa fa-paw','wechat/keys/index','','_self',20,1,0,'2017-03-29 11:11:49'),(71,68,'关注自动回复','','fa fa-commenting-o','wechat/keys/subscribe','','_self',10,1,0,'2017-03-29 11:12:32'),(81,68,'无配置默认回复','','fa fa-commenting-o','wechat/keys/defaults','','_self',30,1,0,'2017-04-21 14:48:25'),(82,61,'素材资源管理','','','#','','_self',300,1,0,'2017-04-24 11:23:18'),(83,82,'添加图文','','fa fa-folder-open-o','wechat/news/add?id=1','','_self',20,1,0,'2017-04-24 11:23:40'),(85,82,'图文列表','','fa fa-file-pdf-o','wechat/news/index','','_self',10,1,0,'2017-04-24 11:25:45'),(86,65,'粉丝黑名单','','fa fa-reddit-alien','wechat/fans/back','','_self',30,1,0,'2017-05-05 16:17:03'),(87,0,'插件案例','','fa fa-hashtag','#','','_self',9000,1,0,'2017-07-10 15:10:16'),(88,87,'第三方插件','','','#','','_self',0,1,0,'2017-07-10 15:10:37'),(90,88,'PCAS 省市区','','','demo/plugs/region','','_self',0,1,0,'2017-07-10 18:45:47'),(91,87,'内置插件','','','#','','_self',0,1,0,'2017-07-10 18:56:59'),(92,91,'文件上传','','','demo/plugs/file','','_self',0,1,0,'2017-07-10 18:57:22'),(93,88,'富文本编辑器','','','demo/plugs/editor','','_self',0,1,0,'2017-07-28 15:19:44'),(94,0,'后台首页','','fa fa-edge','admin/index/main','','_self',0,1,0,'2017-08-08 11:28:43'),(95,0,'内容管理','','fa fa-code','#','','_self',3000,1,0,'2018-04-08 13:57:36'),(96,0,'接口管理','','fa fa-usb','#','','_self',4000,1,0,'2018-04-08 13:58:11'),(97,62,'微信支付配置','','fa fa-paypal','wechat/config/pay','','_self',20,1,0,'2018-04-08 14:22:30'),(98,96,'接口分组管理','','','#','','_self',20,1,0,'2018-04-08 15:37:30'),(99,98,'分组列表','','fa fa-bars','port/group/index','','_self',1,1,0,'2018-04-08 15:38:45'),(100,98,'分组回收站','','fa fa-trash-o','port/group/recycle','','_self',2,1,0,'2018-04-08 15:42:35'),(101,96,'接口管理','','','#','','_self',10,1,0,'2018-04-08 15:46:35'),(102,101,'接口列表','','fa fa-code-fork','port/row/index','','_self',1,1,0,'2018-04-08 22:13:06'),(103,101,'接口回收站','','fa fa-trash-o','port/row/recycle','','_self',3,1,0,'2018-04-09 17:02:03'),(104,96,'访问控制','','','#','','_self',30,1,0,'2018-04-09 22:32:23'),(105,104,'应用列表','','fa fa-cube','port/visit/app','','_self',1,1,0,'2018-04-09 22:38:14'),(106,104,'文档密钥','','fa fa-building-o','port/visit/doc','','_self',2,1,0,'2018-04-09 22:38:57'),(107,101,'接口参数','','fa fa-keyboard-o','port/row/param','','_self',2,1,0,'2018-04-16 17:42:15');

/*Table structure for table `system_node` */

DROP TABLE IF EXISTS `system_node`;

CREATE TABLE `system_node` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `node` varchar(100) DEFAULT NULL COMMENT '节点代码',
  `title` varchar(500) DEFAULT NULL COMMENT '节点标题',
  `is_menu` tinyint(1) unsigned DEFAULT '0' COMMENT '是否可设置为菜单',
  `is_auth` tinyint(1) unsigned DEFAULT '1' COMMENT '是否启动RBAC权限控制',
  `is_login` tinyint(1) unsigned DEFAULT '1' COMMENT '是否启动登录控制',
  `create_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  PRIMARY KEY (`id`),
  KEY `index_system_node_node` (`node`)
) ENGINE=InnoDB AUTO_INCREMENT=264 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='系统节点表';

/*Data for the table `system_node` */

insert  into `system_node`(`id`,`node`,`title`,`is_menu`,`is_auth`,`is_login`,`create_at`) values (131,'admin/auth/index','权限列表',1,1,1,'2017-08-23 15:45:42'),(132,'admin','后台管理',0,1,1,'2017-08-23 15:45:44'),(133,'admin/auth/apply','节点授权',0,1,1,'2017-08-23 16:05:18'),(134,'admin/auth/add','添加授权',0,1,1,'2017-08-23 16:05:19'),(135,'admin/auth/edit','编辑权限',0,1,1,'2017-08-23 16:05:19'),(136,'admin/auth/forbid','禁用权限',0,1,1,'2017-08-23 16:05:20'),(137,'admin/auth/resume','启用权限',0,1,1,'2017-08-23 16:05:20'),(138,'admin/auth/del','删除权限',0,1,1,'2017-08-23 16:05:21'),(139,'admin/config/index','参数配置',1,1,1,'2017-08-23 16:05:22'),(140,'admin/config/file','文件配置',1,1,1,'2017-08-23 16:05:22'),(141,'admin/log/index','日志列表',1,1,1,'2017-08-23 16:05:23'),(142,'admin/log/del','删除日志',0,1,1,'2017-08-23 16:05:24'),(143,'admin/menu/index','菜单列表',1,1,1,'2017-08-23 16:05:25'),(144,'admin/menu/add','添加菜单',0,1,1,'2017-08-23 16:05:25'),(145,'admin/menu/edit','编辑菜单',0,1,1,'2017-08-23 16:05:26'),(146,'admin/menu/del','删除菜单',0,1,1,'2017-08-23 16:05:26'),(147,'admin/menu/forbid','禁用菜单',0,1,1,'2017-08-23 16:05:27'),(148,'admin/menu/resume','启用菜单',0,1,1,'2017-08-23 16:05:28'),(149,'admin/node/index','节点列表',1,1,1,'2017-08-23 16:05:29'),(150,'admin/node/save','节点更新',0,1,1,'2017-08-23 16:05:30'),(151,'admin/user/index','用户管理',1,1,1,'2017-08-23 16:05:31'),(152,'admin/user/auth','用户授权',0,1,1,'2017-08-23 16:05:32'),(153,'admin/user/add','添加用户',0,1,1,'2017-08-23 16:05:33'),(154,'admin/user/edit','编辑用户',0,1,1,'2017-08-23 16:05:33'),(155,'admin/user/pass','用户密码',0,1,1,'2017-08-23 16:05:34'),(156,'admin/user/del','删除用户',0,1,1,'2017-08-23 16:05:34'),(157,'admin/user/forbid','禁用用户',0,1,1,'2017-08-23 16:05:34'),(158,'admin/user/resume','启用用户',0,1,1,'2017-08-23 16:05:35'),(159,'demo/plugs/file','文件上传',1,0,1,'2017-08-23 16:05:36'),(160,'demo/plugs/region','区域选择',1,0,1,'2017-08-23 16:05:36'),(161,'demo/plugs/editor','富文本器',1,0,1,'2017-08-23 16:05:37'),(162,'wechat/config/index','微信参数',1,1,1,'2017-08-23 16:05:37'),(163,'wechat/config/pay','微信支付',0,1,1,'2017-08-23 16:05:38'),(164,'wechat/fans/index','粉丝列表',1,1,1,'2017-08-23 16:05:39'),(165,'wechat/fans/back','粉丝黑名单',1,1,1,'2017-08-23 16:05:39'),(166,'wechat/fans/backadd','移入黑名单',0,1,1,'2017-08-23 16:05:40'),(167,'wechat/fans/tagset','设置标签',0,1,1,'2017-08-23 16:05:41'),(168,'wechat/fans/backdel','移出黑名单',0,1,1,'2017-08-23 16:05:41'),(169,'wechat/fans/tagadd','添加标签',0,1,1,'2017-08-23 16:05:41'),(170,'wechat/fans/tagdel','删除标签',0,1,1,'2017-08-23 16:05:42'),(171,'wechat/fans/sync','同步粉丝',0,1,1,'2017-08-23 16:05:43'),(172,'wechat/keys/index','关键字列表',1,1,1,'2017-08-23 16:05:44'),(173,'wechat/keys/add','添加关键字',0,1,1,'2017-08-23 16:05:44'),(174,'wechat/keys/edit','编辑关键字',0,1,1,'2017-08-23 16:05:45'),(175,'wechat/keys/del','删除关键字',0,1,1,'2017-08-23 16:05:45'),(176,'wechat/keys/forbid','禁用关键字',0,1,1,'2017-08-23 16:05:46'),(177,'wechat/keys/resume','启用关键字',0,1,1,'2017-08-23 16:05:46'),(178,'wechat/keys/subscribe','关注默认回复',0,1,1,'2017-08-23 16:05:48'),(179,'wechat/keys/defaults','默认响应回复',0,1,1,'2017-08-23 16:05:49'),(180,'wechat/menu/index','微信菜单',1,1,1,'2017-08-23 16:05:51'),(181,'wechat/menu/edit','发布微信菜单',0,1,1,'2017-08-23 16:05:51'),(182,'wechat/menu/cancel','取消微信菜单',0,1,1,'2017-08-23 16:05:52'),(183,'wechat/news/index','微信图文列表',1,1,1,'2017-08-23 16:05:52'),(184,'wechat/news/select','微信图文选择',0,1,1,'2017-08-23 16:05:53'),(185,'wechat/news/image','微信图片选择',0,1,1,'2017-08-23 16:05:53'),(186,'wechat/news/add','添加图文',0,1,1,'2017-08-23 16:05:54'),(187,'wechat/news/edit','编辑图文',0,1,1,'2017-08-23 16:05:56'),(188,'wechat/news/del','删除图文',0,1,1,'2017-08-23 16:05:56'),(189,'wechat/news/push','推送图文',0,1,1,'2017-08-23 16:05:56'),(190,'wechat/tags/index','微信标签列表',1,1,1,'2017-08-23 16:05:58'),(191,'wechat/tags/add','添加微信标签',0,1,1,'2017-08-23 16:05:58'),(192,'wechat/tags/edit','编辑微信标签',0,1,1,'2017-08-23 16:05:58'),(193,'wechat/tags/sync','同步微信标签',0,1,1,'2017-08-23 16:05:59'),(194,'admin/auth','权限管理',0,1,1,'2017-08-23 16:06:58'),(195,'admin/config','系统配置',0,1,1,'2017-08-23 16:07:34'),(196,'admin/log','系统日志',0,1,1,'2017-08-23 16:07:46'),(197,'admin/menu','系统菜单',0,1,1,'2017-08-23 16:08:02'),(198,'admin/node','系统节点',0,1,1,'2017-08-23 16:08:44'),(199,'admin/user','系统用户',0,1,1,'2017-08-23 16:09:43'),(200,'demo','插件案例',0,1,1,'2017-08-23 16:10:43'),(201,'demo/plugs','插件案例',0,1,1,'2017-08-23 16:10:51'),(202,'wechat','微信管理',0,1,1,'2017-08-23 16:11:13'),(203,'wechat/config','微信配置',0,1,1,'2017-08-23 16:11:19'),(204,'wechat/fans','粉丝管理',0,1,1,'2017-08-23 16:11:36'),(205,'wechat/keys','关键字管理',0,1,1,'2017-08-23 16:13:00'),(206,'wechat/menu','微信菜单管理',0,1,1,'2017-08-23 16:14:11'),(207,'wechat/news','微信图文管理',0,1,1,'2017-08-23 16:14:40'),(208,'wechat/tags','微信标签管理',0,1,1,'2017-08-23 16:15:25'),(209,'port/group/index','分组列表',0,1,1,'2018-04-08 18:09:07'),(210,'port/group/recycle','分组回收站',0,1,1,'2018-04-08 18:09:07'),(211,'port/group/add','添加分组',0,1,1,'2018-04-08 18:09:08'),(212,'port/group/edit','编辑分组',0,1,1,'2018-04-08 18:09:08'),(213,'port/group/forbid','禁用分组',0,1,1,'2018-04-08 18:09:09'),(214,'port/group/resume','启用分组',0,1,1,'2018-04-08 18:09:10'),(215,'port/group/del','删除分组',0,1,1,'2018-04-08 18:09:10'),(216,'port/group/restore','还原删除',0,1,1,'2018-04-08 18:09:11'),(217,'port/group/delete','彻底删除',0,1,1,'2018-04-08 18:09:11'),(218,'port','接口管理',0,1,1,'2018-04-08 18:10:02'),(219,'port/group','接口分组管理',0,1,1,'2018-04-08 18:10:10'),(220,'wiki','接口文档',0,1,1,'2018-04-08 18:13:31'),(221,'wiki/index','文档展示',0,1,1,'2018-04-08 18:13:43'),(222,'wiki/login','文档登录',0,1,1,'2018-04-08 18:13:51'),(223,'wiki/index/index','文档首页',0,0,0,'2018-04-08 18:14:12'),(224,'wiki/index/detail','文档详情',0,0,0,'2018-04-08 18:14:19'),(225,'wiki/index/calculation','接口访问AccessToken算法',0,0,0,'2018-04-08 18:14:21'),(226,'wiki/index/errorcode','接口错误码',0,0,0,'2018-04-08 18:14:23'),(227,'wiki/login/index','接口文档登录页',0,0,0,'2018-04-08 18:15:38'),(228,'api','接口控制器',0,1,1,'2018-04-08 18:18:10'),(229,'api/buildtoken','token建造类',0,1,1,'2018-04-08 18:18:29'),(230,'api/debug','debug接口',0,1,1,'2018-04-08 18:18:35'),(231,'api/index','接口首页',0,1,1,'2018-04-08 18:18:50'),(232,'api/miss','接口错误访问页',0,1,1,'2018-04-08 18:19:05'),(233,'api/tool','工具类接口',0,1,1,'2018-04-08 18:19:26'),(234,'port/row/index','接口列表',0,1,1,'2018-04-11 00:18:42'),(235,'port/row/add','添加接口',0,1,1,'2018-04-11 00:18:43'),(236,'port/row/edit','编辑接口',0,1,1,'2018-04-11 00:18:50'),(237,'port/row/recycle','接口回收站',0,1,1,'2018-04-11 00:18:51'),(238,'port/row/pay_tagset','接口打分组标签',0,1,1,'2018-04-11 00:18:52'),(239,'port/row/forbid','禁用接口',0,1,1,'2018-04-11 00:18:53'),(240,'port/row/resume','启用接口',0,1,1,'2018-04-11 00:18:55'),(241,'port/row/del','接口软删除',0,1,1,'2018-04-11 00:18:56'),(242,'port/row/restore','还原接口删除',0,1,1,'2018-04-11 00:18:57'),(243,'port/row/delete','接口彻底删除',0,1,1,'2018-04-11 00:18:58'),(244,'port/row/refresh','刷新接口路由配置',0,1,1,'2018-04-11 00:18:59'),(245,'port/row/ask','接口请求参数配置',0,1,1,'2018-04-11 00:19:04'),(246,'port/row/res','接口响应参数配置',0,1,1,'2018-04-11 00:19:05'),(247,'port/visit/app','接口访问应用',0,1,1,'2018-04-11 00:19:07'),(248,'port/visit/add','添加接口应用',0,1,1,'2018-04-11 00:19:09'),(249,'port/visit/edit','编辑接口应用',0,1,1,'2018-04-11 00:19:10'),(250,'port/visit/forbid','禁用应用',0,1,1,'2018-04-11 00:19:11'),(251,'port/visit/resume','启用应用',0,1,1,'2018-04-11 00:19:13'),(252,'port/visit/del','删除接口应用',0,1,1,'2018-04-11 00:19:15'),(253,'port/visit/doc','接口文档访问密钥列表',0,1,1,'2018-04-11 00:19:16'),(254,'port/visit/add_doc','添加访问密钥',0,1,1,'2018-04-11 00:19:17'),(255,'port/visit/edit_doc','编辑访问密钥',0,1,1,'2018-04-11 00:19:18'),(256,'port/visit/forbid_doc','禁用访问密钥',0,1,1,'2018-04-11 00:19:19'),(257,'port/visit/resume_doc','启用访问密钥',0,1,1,'2018-04-11 00:19:20'),(258,'port/visit/del_doc','删除访问密钥',0,1,1,'2018-04-11 00:19:21'),(259,'port/row','接口管理',0,1,1,'2018-04-11 15:17:02'),(260,'port/visit','接口访问控制',0,1,1,'2018-04-11 15:20:31'),(261,'api/buildtoken/getaccesstoken','获取接口访问accesstoken',0,0,0,'2018-04-11 15:25:54'),(262,'worker','workerman服务端',0,1,1,'2018-04-16 17:29:30'),(263,'port/row/param','接口参数',0,1,1,'2018-04-16 17:54:32');

/*Table structure for table `system_sequence` */

DROP TABLE IF EXISTS `system_sequence`;

CREATE TABLE `system_sequence` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `type` varchar(20) DEFAULT NULL COMMENT '序号类型',
  `sequence` char(50) NOT NULL COMMENT '序号值',
  `create_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `index_system_sequence_unique` (`type`,`sequence`) USING BTREE,
  KEY `index_system_sequence_type` (`type`),
  KEY `index_system_sequence_number` (`sequence`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='系统序号表';

/*Data for the table `system_sequence` */

insert  into `system_sequence`(`id`,`type`,`sequence`,`create_at`) values (1,'WECHAT-PAY-TEST','7477860649','2018-04-08 14:25:10'),(2,'WXPAY-OUTER-NO','795524300498041291','2018-04-08 14:25:10');

/*Table structure for table `system_user` */

DROP TABLE IF EXISTS `system_user`;

CREATE TABLE `system_user` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL DEFAULT '' COMMENT '用户登录名',
  `password` char(32) NOT NULL DEFAULT '' COMMENT '用户登录密码',
  `qq` varchar(16) DEFAULT NULL COMMENT '联系QQ',
  `mail` varchar(32) DEFAULT NULL COMMENT '联系邮箱',
  `phone` varchar(16) DEFAULT NULL COMMENT '联系手机号',
  `desc` varchar(255) DEFAULT '' COMMENT '备注说明',
  `login_num` bigint(20) unsigned DEFAULT '0' COMMENT '登录次数',
  `login_at` datetime DEFAULT NULL,
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '状态(0:禁用,1:启用)',
  `authorize` varchar(255) DEFAULT NULL,
  `is_deleted` tinyint(1) unsigned DEFAULT '0' COMMENT '删除状态(1:删除,0:未删)',
  `create_by` bigint(20) unsigned DEFAULT NULL COMMENT '创建人',
  `create_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `index_system_user_username` (`username`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=10001 DEFAULT CHARSET=utf8 COMMENT='系统用户表';

/*Data for the table `system_user` */

insert  into `system_user`(`id`,`username`,`password`,`qq`,`mail`,`phone`,`desc`,`login_num`,`login_at`,`status`,`authorize`,`is_deleted`,`create_by`,`create_at`) values (10000,'admin','21232f297a57a5a743894a0e4a801fc3','22222222','','','',27058,'2018-04-18 09:51:05',1,'301,302,303,304',0,NULL,'2015-11-13 15:14:22');

/*Table structure for table `wechat_fans` */

DROP TABLE IF EXISTS `wechat_fans`;

CREATE TABLE `wechat_fans` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT '粉丝表ID',
  `appid` varchar(50) DEFAULT NULL COMMENT '公众号Appid',
  `groupid` bigint(20) unsigned DEFAULT NULL COMMENT '分组ID',
  `tagid_list` varchar(100) DEFAULT '' COMMENT '标签id',
  `is_back` tinyint(1) unsigned DEFAULT '0' COMMENT '是否为黑名单用户',
  `subscribe` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '用户是否订阅该公众号，0：未关注，1：已关注',
  `openid` char(100) NOT NULL DEFAULT '' COMMENT '用户的标识，对当前公众号唯一',
  `spread_openid` char(100) DEFAULT NULL COMMENT '推荐人OPENID',
  `spread_at` datetime DEFAULT NULL,
  `nickname` varchar(100) DEFAULT NULL COMMENT '用户的昵称',
  `sex` tinyint(1) unsigned DEFAULT NULL COMMENT '用户的性别，值为1时是男性，值为2时是女性，值为0时是未知',
  `country` varchar(50) DEFAULT NULL COMMENT '用户所在国家',
  `province` varchar(50) DEFAULT NULL COMMENT '用户所在省份',
  `city` varchar(50) DEFAULT NULL COMMENT '用户所在城市',
  `language` varchar(50) DEFAULT NULL COMMENT '用户的语言，简体中文为zh_CN',
  `headimgurl` varchar(500) DEFAULT NULL COMMENT '用户头像',
  `subscribe_time` bigint(20) unsigned DEFAULT NULL COMMENT '用户关注时间',
  `subscribe_at` datetime DEFAULT NULL COMMENT '关注时间',
  `unionid` varchar(100) DEFAULT NULL COMMENT 'unionid',
  `remark` varchar(50) DEFAULT NULL COMMENT '备注',
  `expires_in` bigint(20) unsigned DEFAULT '0' COMMENT '有效时间',
  `refresh_token` varchar(200) DEFAULT NULL COMMENT '刷新token',
  `access_token` varchar(200) DEFAULT NULL COMMENT '访问token',
  `create_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  PRIMARY KEY (`id`),
  KEY `index_wechat_fans_spread_openid` (`spread_openid`) USING BTREE,
  KEY `index_wechat_fans_openid` (`openid`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='微信粉丝';

/*Data for the table `wechat_fans` */

/*Table structure for table `wechat_fans_tags` */

DROP TABLE IF EXISTS `wechat_fans_tags`;

CREATE TABLE `wechat_fans_tags` (
  `id` bigint(20) unsigned NOT NULL COMMENT '标签ID',
  `appid` char(50) DEFAULT NULL COMMENT '公众号APPID',
  `name` varchar(35) DEFAULT NULL COMMENT '标签名称',
  `count` int(11) unsigned DEFAULT NULL COMMENT '总数',
  `create_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建日期',
  KEY `index_wechat_fans_tags_id` (`id`) USING BTREE,
  KEY `index_wechat_fans_tags_appid` (`appid`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='微信会员标签';

/*Data for the table `wechat_fans_tags` */

/*Table structure for table `wechat_keys` */

DROP TABLE IF EXISTS `wechat_keys`;

CREATE TABLE `wechat_keys` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `appid` char(50) DEFAULT NULL COMMENT '公众号APPID',
  `type` varchar(20) DEFAULT NULL COMMENT '类型，text 文件消息，image 图片消息，news 图文消息',
  `keys` varchar(100) DEFAULT NULL COMMENT '关键字',
  `content` text COMMENT '文本内容',
  `image_url` varchar(255) DEFAULT NULL COMMENT '图片链接',
  `voice_url` varchar(255) DEFAULT NULL COMMENT '语音链接',
  `music_title` varchar(100) DEFAULT NULL COMMENT '音乐标题',
  `music_url` varchar(255) DEFAULT NULL COMMENT '音乐链接',
  `music_image` varchar(255) DEFAULT NULL COMMENT '音乐缩略图链接',
  `music_desc` varchar(255) DEFAULT NULL COMMENT '音乐描述',
  `video_title` varchar(100) DEFAULT NULL COMMENT '视频标题',
  `video_url` varchar(255) DEFAULT NULL COMMENT '视频URL',
  `video_desc` varchar(255) DEFAULT NULL COMMENT '视频描述',
  `news_id` bigint(20) unsigned DEFAULT NULL COMMENT '图文ID',
  `sort` bigint(20) unsigned DEFAULT '0' COMMENT '排序字段',
  `status` tinyint(1) unsigned DEFAULT '1' COMMENT '0 禁用，1 启用',
  `create_by` bigint(20) unsigned DEFAULT NULL COMMENT '创建人',
  `create_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='微信关键字';

/*Data for the table `wechat_keys` */

/*Table structure for table `wechat_menu` */

DROP TABLE IF EXISTS `wechat_menu`;

CREATE TABLE `wechat_menu` (
  `id` bigint(16) unsigned NOT NULL AUTO_INCREMENT,
  `index` bigint(20) DEFAULT NULL,
  `pindex` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '父id',
  `type` varchar(24) NOT NULL DEFAULT '' COMMENT '菜单类型 null主菜单 link链接 keys关键字',
  `name` varchar(256) NOT NULL DEFAULT '' COMMENT '菜单名称',
  `content` text NOT NULL COMMENT '文字内容',
  `sort` bigint(20) unsigned DEFAULT '0' COMMENT '排序',
  `status` tinyint(1) unsigned DEFAULT '1' COMMENT '状态(0禁用1启用)',
  `create_by` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '创建人',
  `create_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  PRIMARY KEY (`id`),
  KEY `index_wechat_menu_pindex` (`pindex`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='微信菜单配置';

/*Data for the table `wechat_menu` */

/*Table structure for table `wechat_news` */

DROP TABLE IF EXISTS `wechat_news`;

CREATE TABLE `wechat_news` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `media_id` varchar(100) DEFAULT NULL COMMENT '永久素材MediaID',
  `local_url` varchar(300) DEFAULT NULL COMMENT '永久素材显示URL',
  `article_id` varchar(60) DEFAULT NULL COMMENT '关联图文ID，用，号做分割',
  `is_deleted` tinyint(1) unsigned DEFAULT '0' COMMENT '是否删除',
  `create_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `create_by` bigint(20) DEFAULT NULL COMMENT '创建人',
  PRIMARY KEY (`id`),
  KEY `index_wechat_new_artcle_id` (`article_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='微信图文表';

/*Data for the table `wechat_news` */

/*Table structure for table `wechat_news_article` */

DROP TABLE IF EXISTS `wechat_news_article`;

CREATE TABLE `wechat_news_article` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(50) DEFAULT NULL COMMENT '素材标题',
  `local_url` varchar(300) DEFAULT NULL COMMENT '永久素材显示URL',
  `show_cover_pic` tinyint(4) unsigned DEFAULT '0' COMMENT '是否显示封面 0不显示，1 显示',
  `author` varchar(20) DEFAULT NULL COMMENT '作者',
  `digest` varchar(300) DEFAULT NULL COMMENT '摘要内容',
  `content` longtext COMMENT '图文内容',
  `content_source_url` varchar(200) DEFAULT NULL COMMENT '图文消息原文地址',
  `create_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `create_by` bigint(20) DEFAULT NULL COMMENT '创建人',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='微信素材表';

/*Data for the table `wechat_news_article` */

/*Table structure for table `wechat_news_image` */

DROP TABLE IF EXISTS `wechat_news_image`;

CREATE TABLE `wechat_news_image` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `md5` varchar(32) DEFAULT NULL COMMENT '文件md5',
  `local_url` varchar(300) DEFAULT NULL COMMENT '本地文件链接',
  `media_url` varchar(300) DEFAULT NULL COMMENT '远程图片链接',
  `create_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  PRIMARY KEY (`id`),
  KEY `index_wechat_news_image_md5` (`md5`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='微信服务器图片';

/*Data for the table `wechat_news_image` */

/*Table structure for table `wechat_news_media` */

DROP TABLE IF EXISTS `wechat_news_media`;

CREATE TABLE `wechat_news_media` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `appid` varchar(200) DEFAULT NULL COMMENT '公众号ID',
  `md5` varchar(32) DEFAULT NULL COMMENT '文件md5',
  `type` varchar(20) DEFAULT NULL COMMENT '媒体类型',
  `media_id` varchar(100) DEFAULT NULL COMMENT '永久素材MediaID',
  `local_url` varchar(300) DEFAULT NULL COMMENT '本地文件链接',
  `media_url` varchar(300) DEFAULT NULL COMMENT '远程图片链接',
  `create_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='微信素材表';

/*Data for the table `wechat_news_media` */

/*Table structure for table `wechat_pay_notify` */

DROP TABLE IF EXISTS `wechat_pay_notify`;

CREATE TABLE `wechat_pay_notify` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `appid` varchar(50) DEFAULT NULL COMMENT '公众号Appid',
  `bank_type` varchar(50) DEFAULT NULL COMMENT '银行类型',
  `cash_fee` bigint(20) DEFAULT NULL COMMENT '现金价',
  `fee_type` char(20) DEFAULT NULL COMMENT '币种，1人民币',
  `is_subscribe` char(1) DEFAULT 'N' COMMENT '是否关注，Y为关注，N为未关注',
  `mch_id` varchar(50) DEFAULT NULL COMMENT '商户MCH_ID',
  `nonce_str` varchar(32) DEFAULT NULL COMMENT '随机串',
  `openid` varchar(50) DEFAULT NULL COMMENT '微信用户openid',
  `out_trade_no` varchar(50) DEFAULT NULL COMMENT '支付平台退款交易号',
  `sign` varchar(100) DEFAULT NULL COMMENT '签名',
  `time_end` datetime DEFAULT NULL COMMENT '结束时间',
  `result_code` varchar(10) DEFAULT NULL,
  `return_code` varchar(10) DEFAULT NULL,
  `total_fee` varchar(11) DEFAULT NULL COMMENT '支付总金额，单位为分',
  `trade_type` varchar(20) DEFAULT NULL COMMENT '支付方式',
  `transaction_id` varchar(64) DEFAULT NULL COMMENT '订单号',
  `create_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP COMMENT '本地系统时间',
  PRIMARY KEY (`id`),
  KEY `index_wechat_pay_notify_openid` (`openid`) USING BTREE,
  KEY `index_wechat_pay_notify_out_trade_no` (`out_trade_no`) USING BTREE,
  KEY `index_wechat_pay_notify_transaction_id` (`transaction_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='支付日志表';

/*Data for the table `wechat_pay_notify` */

/*Table structure for table `wechat_pay_prepayid` */

DROP TABLE IF EXISTS `wechat_pay_prepayid`;

CREATE TABLE `wechat_pay_prepayid` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `appid` char(50) DEFAULT NULL COMMENT '公众号APPID',
  `from` char(32) DEFAULT 'shop' COMMENT '支付来源',
  `fee` bigint(20) unsigned DEFAULT NULL COMMENT '支付费用(分)',
  `trade_type` varchar(20) DEFAULT NULL COMMENT '订单类型',
  `order_no` varchar(50) DEFAULT NULL COMMENT '内部订单号',
  `out_trade_no` varchar(50) DEFAULT NULL COMMENT '外部订单号',
  `prepayid` varchar(500) DEFAULT NULL COMMENT '预支付码',
  `expires_in` bigint(20) unsigned DEFAULT NULL COMMENT '有效时间',
  `transaction_id` varchar(64) DEFAULT NULL COMMENT '微信平台订单号',
  `is_pay` tinyint(1) unsigned DEFAULT '0' COMMENT '1已支付，0未支退款',
  `pay_at` datetime DEFAULT NULL COMMENT '支付时间',
  `is_refund` tinyint(1) unsigned DEFAULT '0' COMMENT '是否退款，退款单号(T+原来订单)',
  `refund_at` datetime DEFAULT NULL COMMENT '退款时间',
  `create_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP COMMENT '本地系统时间',
  PRIMARY KEY (`id`),
  KEY `index_wechat_pay_prepayid_outer_no` (`out_trade_no`) USING BTREE,
  KEY `index_wechat_pay_prepayid_order_no` (`order_no`) USING BTREE,
  KEY `index_wechat_pay_is_pay` (`is_pay`) USING BTREE,
  KEY `index_wechat_pay_is_refund` (`is_refund`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='支付订单号对应表';

/*Data for the table `wechat_pay_prepayid` */

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
