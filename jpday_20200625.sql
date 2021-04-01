-- MySQL dump 10.13  Distrib 5.6.41, for linux-glibc2.12 (x86_64)
--
-- Host: localhost    Database: jp1
-- ------------------------------------------------------
-- Server version	5.6.41

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `g5_auth`
--

DROP TABLE IF EXISTS `g5_auth`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `g5_auth` (
  `mb_id` varchar(20) NOT NULL DEFAULT '',
  `au_menu` varchar(20) NOT NULL DEFAULT '',
  `au_auth` set('r','w','d') NOT NULL DEFAULT '',
  PRIMARY KEY (`mb_id`,`au_menu`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `g5_auth`
--

LOCK TABLES `g5_auth` WRITE;
/*!40000 ALTER TABLE `g5_auth` DISABLE KEYS */;
/*!40000 ALTER TABLE `g5_auth` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `g5_autosave`
--

DROP TABLE IF EXISTS `g5_autosave`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `g5_autosave` (
  `as_id` int(11) NOT NULL AUTO_INCREMENT,
  `mb_id` varchar(20) NOT NULL,
  `as_uid` bigint(20) unsigned NOT NULL,
  `as_subject` varchar(255) NOT NULL,
  `as_content` text NOT NULL,
  `as_datetime` datetime NOT NULL,
  PRIMARY KEY (`as_id`),
  UNIQUE KEY `as_uid` (`as_uid`),
  KEY `mb_id` (`mb_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `g5_autosave`
--

LOCK TABLES `g5_autosave` WRITE;
/*!40000 ALTER TABLE `g5_autosave` DISABLE KEYS */;
/*!40000 ALTER TABLE `g5_autosave` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `g5_board`
--

DROP TABLE IF EXISTS `g5_board`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `g5_board` (
  `bo_table` varchar(20) NOT NULL DEFAULT '',
  `gr_id` varchar(255) NOT NULL DEFAULT '',
  `bo_subject` varchar(255) NOT NULL DEFAULT '',
  `bo_mobile_subject` varchar(255) NOT NULL DEFAULT '',
  `bo_device` enum('both','pc','mobile') NOT NULL DEFAULT 'both',
  `bo_admin` varchar(255) NOT NULL DEFAULT '',
  `bo_list_level` tinyint(4) NOT NULL DEFAULT '0',
  `bo_read_level` tinyint(4) NOT NULL DEFAULT '0',
  `bo_write_level` tinyint(4) NOT NULL DEFAULT '0',
  `bo_reply_level` tinyint(4) NOT NULL DEFAULT '0',
  `bo_comment_level` tinyint(4) NOT NULL DEFAULT '0',
  `bo_upload_level` tinyint(4) NOT NULL DEFAULT '0',
  `bo_download_level` tinyint(4) NOT NULL DEFAULT '0',
  `bo_html_level` tinyint(4) NOT NULL DEFAULT '0',
  `bo_link_level` tinyint(4) NOT NULL DEFAULT '0',
  `bo_count_delete` tinyint(4) NOT NULL DEFAULT '0',
  `bo_count_modify` tinyint(4) NOT NULL DEFAULT '0',
  `bo_read_point` int(11) NOT NULL DEFAULT '0',
  `bo_write_point` int(11) NOT NULL DEFAULT '0',
  `bo_comment_point` int(11) NOT NULL DEFAULT '0',
  `bo_download_point` int(11) NOT NULL DEFAULT '0',
  `bo_use_category` tinyint(4) NOT NULL DEFAULT '0',
  `bo_category_list` text NOT NULL,
  `bo_use_sideview` tinyint(4) NOT NULL DEFAULT '0',
  `bo_use_file_content` tinyint(4) NOT NULL DEFAULT '0',
  `bo_use_secret` tinyint(4) NOT NULL DEFAULT '0',
  `bo_use_dhtml_editor` tinyint(4) NOT NULL DEFAULT '0',
  `bo_use_rss_view` tinyint(4) NOT NULL DEFAULT '0',
  `bo_use_good` tinyint(4) NOT NULL DEFAULT '0',
  `bo_use_nogood` tinyint(4) NOT NULL DEFAULT '0',
  `bo_use_name` tinyint(4) NOT NULL DEFAULT '0',
  `bo_use_signature` tinyint(4) NOT NULL DEFAULT '0',
  `bo_use_ip_view` tinyint(4) NOT NULL DEFAULT '0',
  `bo_use_list_view` tinyint(4) NOT NULL DEFAULT '0',
  `bo_use_list_file` tinyint(4) NOT NULL DEFAULT '0',
  `bo_use_list_content` tinyint(4) NOT NULL DEFAULT '0',
  `bo_table_width` int(11) NOT NULL DEFAULT '0',
  `bo_subject_len` int(11) NOT NULL DEFAULT '0',
  `bo_mobile_subject_len` int(11) NOT NULL DEFAULT '0',
  `bo_page_rows` int(11) NOT NULL DEFAULT '0',
  `bo_mobile_page_rows` int(11) NOT NULL DEFAULT '0',
  `bo_new` int(11) NOT NULL DEFAULT '0',
  `bo_hot` int(11) NOT NULL DEFAULT '0',
  `bo_image_width` int(11) NOT NULL DEFAULT '0',
  `bo_skin` varchar(255) NOT NULL DEFAULT '',
  `bo_mobile_skin` varchar(255) NOT NULL DEFAULT '',
  `bo_include_head` varchar(255) NOT NULL DEFAULT '',
  `bo_include_tail` varchar(255) NOT NULL DEFAULT '',
  `bo_content_head` text NOT NULL,
  `bo_mobile_content_head` text NOT NULL,
  `bo_content_tail` text NOT NULL,
  `bo_mobile_content_tail` text NOT NULL,
  `bo_insert_content` text NOT NULL,
  `bo_gallery_cols` int(11) NOT NULL DEFAULT '0',
  `bo_gallery_width` int(11) NOT NULL DEFAULT '0',
  `bo_gallery_height` int(11) NOT NULL DEFAULT '0',
  `bo_mobile_gallery_width` int(11) NOT NULL DEFAULT '0',
  `bo_mobile_gallery_height` int(11) NOT NULL DEFAULT '0',
  `bo_upload_size` int(11) NOT NULL DEFAULT '0',
  `bo_reply_order` tinyint(4) NOT NULL DEFAULT '0',
  `bo_use_search` tinyint(4) NOT NULL DEFAULT '0',
  `bo_order` int(11) NOT NULL DEFAULT '0',
  `bo_count_write` int(11) NOT NULL DEFAULT '0',
  `bo_count_comment` int(11) NOT NULL DEFAULT '0',
  `bo_write_min` int(11) NOT NULL DEFAULT '0',
  `bo_write_max` int(11) NOT NULL DEFAULT '0',
  `bo_comment_min` int(11) NOT NULL DEFAULT '0',
  `bo_comment_max` int(11) NOT NULL DEFAULT '0',
  `bo_notice` text NOT NULL,
  `bo_upload_count` tinyint(4) NOT NULL DEFAULT '0',
  `bo_use_email` tinyint(4) NOT NULL DEFAULT '0',
  `bo_use_cert` enum('','cert','adult','hp-cert','hp-adult') NOT NULL DEFAULT '',
  `bo_use_sns` tinyint(4) NOT NULL DEFAULT '0',
  `bo_use_captcha` tinyint(4) NOT NULL DEFAULT '0',
  `bo_sort_field` varchar(255) NOT NULL DEFAULT '',
  `bo_1_subj` varchar(255) NOT NULL DEFAULT '',
  `bo_2_subj` varchar(255) NOT NULL DEFAULT '',
  `bo_3_subj` varchar(255) NOT NULL DEFAULT '',
  `bo_4_subj` varchar(255) NOT NULL DEFAULT '',
  `bo_5_subj` varchar(255) NOT NULL DEFAULT '',
  `bo_6_subj` varchar(255) NOT NULL DEFAULT '',
  `bo_7_subj` varchar(255) NOT NULL DEFAULT '',
  `bo_8_subj` varchar(255) NOT NULL DEFAULT '',
  `bo_9_subj` varchar(255) NOT NULL DEFAULT '',
  `bo_10_subj` varchar(255) NOT NULL DEFAULT '',
  `bo_1` varchar(255) NOT NULL DEFAULT '',
  `bo_2` varchar(255) NOT NULL DEFAULT '',
  `bo_3` varchar(255) NOT NULL DEFAULT '',
  `bo_4` varchar(255) NOT NULL DEFAULT '',
  `bo_5` varchar(255) NOT NULL DEFAULT '',
  `bo_6` varchar(255) NOT NULL DEFAULT '',
  `bo_7` varchar(255) NOT NULL DEFAULT '',
  `bo_8` varchar(255) NOT NULL DEFAULT '',
  `bo_9` varchar(255) NOT NULL DEFAULT '',
  `bo_10` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`bo_table`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `g5_board`
--

LOCK TABLES `g5_board` WRITE;
/*!40000 ALTER TABLE `g5_board` DISABLE KEYS */;
INSERT INTO `g5_board` VALUES ('free','shop','자유게시판','','both','',1,1,1,1,1,1,1,1,1,1,1,0,0,0,0,0,'',0,0,0,1,0,0,0,0,0,0,0,0,0,100,60,30,15,15,24,100,835,'basic','basic','_head.php','_tail.php','','','','','',4,202,150,125,100,1048576,1,0,0,0,0,0,0,0,0,'',2,0,'',0,0,'','','','','','','','','','','','','','','','','','','','',''),('gallery','shop','갤러리','','both','',1,1,1,1,1,1,1,1,1,1,1,0,0,0,0,0,'',0,0,0,1,0,0,0,0,0,0,0,0,0,100,60,30,15,15,24,100,835,'gallery','gallery','_head.php','_tail.php','','','','','',4,202,150,125,100,1048576,1,0,0,0,0,0,0,0,0,'',2,0,'',0,0,'','','','','','','','','','','','','','','','','','','','',''),('notice','shop','공지사항','','both','',1,1,10,10,10,1,1,1,1,1,1,0,0,0,0,0,'',0,0,0,1,0,0,0,0,0,0,0,0,0,100,60,30,15,15,24,100,835,'basic','basic','_head.php','_tail.php','','','','','',4,202,150,125,100,1048576,1,0,0,1,0,0,0,0,0,'',2,0,'',0,0,'','','','','','','','','','','','','','','','','','','','',''),('qa','shop','상품문의','','both','',1,1,1,1,1,1,1,1,1,1,1,0,0,0,0,1,'상품 문의|취소 문의|배송 문의|입금 확인 문의|교환＆반품 문의',0,0,0,1,0,0,0,0,0,0,0,0,0,100,60,30,15,15,24,100,835,'basic','basic','_head.php','_tail.php','','','','','',4,202,150,125,100,1048576,1,0,0,0,0,0,0,0,0,'',2,0,'',0,0,'','','','','','','','','','','','','','','','','','','','',''),('review','shop','상품후기','','both','',1,1,1,1,1,1,1,1,1,1,1,0,0,0,0,0,'',0,0,0,1,0,0,0,0,0,0,0,0,0,100,60,30,15,15,24,100,835,'basic','basic','_head.php','_tail.php','','','','','',4,202,150,125,100,1048576,1,0,0,0,0,0,0,0,0,'',2,0,'',0,0,'','','','','','','','','','','','','','','','','','','','',''),('unidentified','shop','미확인입금내역','','both','',1,1,1,1,1,1,1,1,1,1,1,0,0,0,0,0,'',0,0,0,1,0,0,0,0,0,0,0,0,0,100,60,30,15,15,24,100,835,'basic','basic','_head.php','_tail.php','','','','','',4,202,150,125,100,1048576,1,0,0,0,0,0,0,0,0,'',2,0,'',0,0,'','','','','','','','','','','','','','','','','','','','','');
/*!40000 ALTER TABLE `g5_board` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `g5_board_file`
--

DROP TABLE IF EXISTS `g5_board_file`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `g5_board_file` (
  `bo_table` varchar(20) NOT NULL DEFAULT '',
  `wr_id` int(11) NOT NULL DEFAULT '0',
  `bf_no` int(11) NOT NULL DEFAULT '0',
  `bf_source` varchar(255) NOT NULL DEFAULT '',
  `bf_file` varchar(255) NOT NULL DEFAULT '',
  `bf_download` int(11) NOT NULL,
  `bf_content` text NOT NULL,
  `bf_fileurl` varchar(255) NOT NULL DEFAULT '',
  `bf_thumburl` varchar(255) NOT NULL DEFAULT '',
  `bf_storage` varchar(50) NOT NULL DEFAULT '',
  `bf_filesize` int(11) NOT NULL DEFAULT '0',
  `bf_width` int(11) NOT NULL DEFAULT '0',
  `bf_height` smallint(6) NOT NULL DEFAULT '0',
  `bf_type` tinyint(4) NOT NULL DEFAULT '0',
  `bf_datetime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`bo_table`,`wr_id`,`bf_no`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `g5_board_file`
--

LOCK TABLES `g5_board_file` WRITE;
/*!40000 ALTER TABLE `g5_board_file` DISABLE KEYS */;
/*!40000 ALTER TABLE `g5_board_file` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `g5_board_good`
--

DROP TABLE IF EXISTS `g5_board_good`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `g5_board_good` (
  `bg_id` int(11) NOT NULL AUTO_INCREMENT,
  `bo_table` varchar(20) NOT NULL DEFAULT '',
  `wr_id` int(11) NOT NULL DEFAULT '0',
  `mb_id` varchar(20) NOT NULL DEFAULT '',
  `bg_flag` varchar(255) NOT NULL DEFAULT '',
  `bg_datetime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`bg_id`),
  UNIQUE KEY `fkey1` (`bo_table`,`wr_id`,`mb_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `g5_board_good`
--

LOCK TABLES `g5_board_good` WRITE;
/*!40000 ALTER TABLE `g5_board_good` DISABLE KEYS */;
/*!40000 ALTER TABLE `g5_board_good` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `g5_board_new`
--

DROP TABLE IF EXISTS `g5_board_new`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `g5_board_new` (
  `bn_id` int(11) NOT NULL AUTO_INCREMENT,
  `bo_table` varchar(20) NOT NULL DEFAULT '',
  `wr_id` int(11) NOT NULL DEFAULT '0',
  `wr_parent` int(11) NOT NULL DEFAULT '0',
  `bn_datetime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `mb_id` varchar(20) NOT NULL DEFAULT '',
  PRIMARY KEY (`bn_id`),
  KEY `mb_id` (`mb_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `g5_board_new`
--

LOCK TABLES `g5_board_new` WRITE;
/*!40000 ALTER TABLE `g5_board_new` DISABLE KEYS */;
/*!40000 ALTER TABLE `g5_board_new` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `g5_cert_history`
--

DROP TABLE IF EXISTS `g5_cert_history`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `g5_cert_history` (
  `cr_id` int(11) NOT NULL AUTO_INCREMENT,
  `mb_id` varchar(20) NOT NULL DEFAULT '',
  `cr_company` varchar(255) NOT NULL DEFAULT '',
  `cr_method` varchar(255) NOT NULL DEFAULT '',
  `cr_ip` varchar(255) NOT NULL DEFAULT '',
  `cr_date` date NOT NULL DEFAULT '0000-00-00',
  `cr_time` time NOT NULL DEFAULT '00:00:00',
  PRIMARY KEY (`cr_id`),
  KEY `mb_id` (`mb_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `g5_cert_history`
--

LOCK TABLES `g5_cert_history` WRITE;
/*!40000 ALTER TABLE `g5_cert_history` DISABLE KEYS */;
/*!40000 ALTER TABLE `g5_cert_history` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `g5_config`
--

DROP TABLE IF EXISTS `g5_config`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `g5_config` (
  `cf_title` varchar(255) NOT NULL DEFAULT '',
  `cf_theme` varchar(100) NOT NULL DEFAULT '',
  `cf_admin` varchar(100) NOT NULL DEFAULT '',
  `cf_admin_email` varchar(100) NOT NULL DEFAULT '',
  `cf_admin_email_name` varchar(100) NOT NULL DEFAULT '',
  `cf_add_script` text NOT NULL,
  `cf_use_point` tinyint(4) NOT NULL DEFAULT '0',
  `cf_point_term` int(11) NOT NULL DEFAULT '0',
  `cf_use_copy_log` tinyint(4) NOT NULL DEFAULT '0',
  `cf_use_email_certify` tinyint(4) NOT NULL DEFAULT '0',
  `cf_login_point` int(11) NOT NULL DEFAULT '0',
  `cf_cut_name` tinyint(4) NOT NULL DEFAULT '0',
  `cf_nick_modify` int(11) NOT NULL DEFAULT '0',
  `cf_new_skin` varchar(50) NOT NULL DEFAULT '',
  `cf_new_rows` int(11) NOT NULL DEFAULT '0',
  `cf_search_skin` varchar(50) NOT NULL DEFAULT '',
  `cf_connect_skin` varchar(50) NOT NULL DEFAULT '',
  `cf_faq_skin` varchar(50) NOT NULL DEFAULT '',
  `cf_read_point` int(11) NOT NULL DEFAULT '0',
  `cf_write_point` int(11) NOT NULL DEFAULT '0',
  `cf_comment_point` int(11) NOT NULL DEFAULT '0',
  `cf_download_point` int(11) NOT NULL DEFAULT '0',
  `cf_write_pages` int(11) NOT NULL DEFAULT '0',
  `cf_mobile_pages` int(11) NOT NULL DEFAULT '0',
  `cf_link_target` varchar(50) NOT NULL DEFAULT '',
  `cf_bbs_rewrite` tinyint(4) NOT NULL DEFAULT '0',
  `cf_delay_sec` int(11) NOT NULL DEFAULT '0',
  `cf_filter` text NOT NULL,
  `cf_possible_ip` text NOT NULL,
  `cf_intercept_ip` text NOT NULL,
  `cf_analytics` text NOT NULL,
  `cf_add_meta` text NOT NULL,
  `cf_syndi_token` varchar(255) NOT NULL,
  `cf_syndi_except` text NOT NULL,
  `cf_member_skin` varchar(50) NOT NULL DEFAULT '',
  `cf_use_homepage` tinyint(4) NOT NULL DEFAULT '0',
  `cf_req_homepage` tinyint(4) NOT NULL DEFAULT '0',
  `cf_use_tel` tinyint(4) NOT NULL DEFAULT '0',
  `cf_req_tel` tinyint(4) NOT NULL DEFAULT '0',
  `cf_use_hp` tinyint(4) NOT NULL DEFAULT '0',
  `cf_req_hp` tinyint(4) NOT NULL DEFAULT '0',
  `cf_use_addr` tinyint(4) NOT NULL DEFAULT '0',
  `cf_req_addr` tinyint(4) NOT NULL DEFAULT '0',
  `cf_use_signature` tinyint(4) NOT NULL DEFAULT '0',
  `cf_req_signature` tinyint(4) NOT NULL DEFAULT '0',
  `cf_use_profile` tinyint(4) NOT NULL DEFAULT '0',
  `cf_req_profile` tinyint(4) NOT NULL DEFAULT '0',
  `cf_register_level` tinyint(4) NOT NULL DEFAULT '0',
  `cf_register_point` int(11) NOT NULL DEFAULT '0',
  `cf_icon_level` tinyint(4) NOT NULL DEFAULT '0',
  `cf_use_recommend` tinyint(4) NOT NULL DEFAULT '0',
  `cf_recommend_point` int(11) NOT NULL DEFAULT '0',
  `cf_leave_day` int(11) NOT NULL DEFAULT '0',
  `cf_search_part` int(11) NOT NULL DEFAULT '0',
  `cf_email_use` tinyint(4) NOT NULL DEFAULT '0',
  `cf_email_wr_super_admin` tinyint(4) NOT NULL DEFAULT '0',
  `cf_email_wr_group_admin` tinyint(4) NOT NULL DEFAULT '0',
  `cf_email_wr_board_admin` tinyint(4) NOT NULL DEFAULT '0',
  `cf_email_wr_write` tinyint(4) NOT NULL DEFAULT '0',
  `cf_email_wr_comment_all` tinyint(4) NOT NULL DEFAULT '0',
  `cf_email_mb_super_admin` tinyint(4) NOT NULL DEFAULT '0',
  `cf_email_mb_member` tinyint(4) NOT NULL DEFAULT '0',
  `cf_email_po_super_admin` tinyint(4) NOT NULL DEFAULT '0',
  `cf_prohibit_id` text NOT NULL,
  `cf_prohibit_email` text NOT NULL,
  `cf_new_del` int(11) NOT NULL DEFAULT '0',
  `cf_memo_del` int(11) NOT NULL DEFAULT '0',
  `cf_visit_del` int(11) NOT NULL DEFAULT '0',
  `cf_popular_del` int(11) NOT NULL DEFAULT '0',
  `cf_optimize_date` date NOT NULL DEFAULT '0000-00-00',
  `cf_use_member_icon` tinyint(4) NOT NULL DEFAULT '0',
  `cf_member_icon_size` int(11) NOT NULL DEFAULT '0',
  `cf_member_icon_width` int(11) NOT NULL DEFAULT '0',
  `cf_member_icon_height` int(11) NOT NULL DEFAULT '0',
  `cf_member_img_size` int(11) NOT NULL DEFAULT '0',
  `cf_member_img_width` int(11) NOT NULL DEFAULT '0',
  `cf_member_img_height` int(11) NOT NULL DEFAULT '0',
  `cf_login_minutes` int(11) NOT NULL DEFAULT '0',
  `cf_image_extension` varchar(255) NOT NULL DEFAULT '',
  `cf_flash_extension` varchar(255) NOT NULL DEFAULT '',
  `cf_movie_extension` varchar(255) NOT NULL DEFAULT '',
  `cf_formmail_is_member` tinyint(4) NOT NULL DEFAULT '0',
  `cf_page_rows` int(11) NOT NULL DEFAULT '0',
  `cf_mobile_page_rows` int(11) NOT NULL DEFAULT '0',
  `cf_visit` varchar(255) NOT NULL DEFAULT '',
  `cf_max_po_id` int(11) NOT NULL DEFAULT '0',
  `cf_stipulation` text NOT NULL,
  `cf_privacy` text NOT NULL,
  `cf_open_modify` int(11) NOT NULL DEFAULT '0',
  `cf_memo_send_point` int(11) NOT NULL DEFAULT '0',
  `cf_mobile_new_skin` varchar(50) NOT NULL DEFAULT '',
  `cf_mobile_search_skin` varchar(50) NOT NULL DEFAULT '',
  `cf_mobile_connect_skin` varchar(50) NOT NULL DEFAULT '',
  `cf_mobile_faq_skin` varchar(50) NOT NULL DEFAULT '',
  `cf_mobile_member_skin` varchar(50) NOT NULL DEFAULT '',
  `cf_captcha_mp3` varchar(255) NOT NULL DEFAULT '',
  `cf_editor` varchar(50) NOT NULL DEFAULT '',
  `cf_cert_use` tinyint(4) NOT NULL DEFAULT '0',
  `cf_cert_ipin` varchar(255) NOT NULL DEFAULT '',
  `cf_cert_hp` varchar(255) NOT NULL DEFAULT '',
  `cf_cert_kcb_cd` varchar(255) NOT NULL DEFAULT '',
  `cf_cert_kcp_cd` varchar(255) NOT NULL DEFAULT '',
  `cf_lg_mid` varchar(100) NOT NULL DEFAULT '',
  `cf_lg_mert_key` varchar(100) NOT NULL DEFAULT '',
  `cf_cert_limit` int(11) NOT NULL DEFAULT '0',
  `cf_cert_req` tinyint(4) NOT NULL DEFAULT '0',
  `cf_sms_use` varchar(255) NOT NULL DEFAULT '',
  `cf_sms_type` varchar(10) NOT NULL DEFAULT '',
  `cf_icode_id` varchar(255) NOT NULL DEFAULT '',
  `cf_icode_pw` varchar(255) NOT NULL DEFAULT '',
  `cf_icode_server_ip` varchar(50) NOT NULL DEFAULT '',
  `cf_icode_server_port` varchar(50) NOT NULL DEFAULT '',
  `cf_googl_shorturl_apikey` varchar(50) NOT NULL DEFAULT '',
  `cf_social_login_use` tinyint(4) NOT NULL DEFAULT '0',
  `cf_social_servicelist` varchar(255) NOT NULL DEFAULT '',
  `cf_payco_clientid` varchar(100) NOT NULL DEFAULT '',
  `cf_payco_secret` varchar(100) NOT NULL DEFAULT '',
  `cf_facebook_appid` varchar(100) NOT NULL,
  `cf_facebook_secret` varchar(100) NOT NULL,
  `cf_twitter_key` varchar(100) NOT NULL,
  `cf_twitter_secret` varchar(100) NOT NULL,
  `cf_google_clientid` varchar(100) NOT NULL DEFAULT '',
  `cf_google_secret` varchar(100) NOT NULL DEFAULT '',
  `cf_naver_clientid` varchar(100) NOT NULL DEFAULT '',
  `cf_naver_secret` varchar(100) NOT NULL DEFAULT '',
  `cf_kakao_rest_key` varchar(100) NOT NULL DEFAULT '',
  `cf_kakao_client_secret` varchar(100) NOT NULL DEFAULT '',
  `cf_kakao_js_apikey` varchar(100) NOT NULL,
  `cf_captcha` varchar(100) NOT NULL DEFAULT '',
  `cf_recaptcha_site_key` varchar(100) NOT NULL DEFAULT '',
  `cf_recaptcha_secret_key` varchar(100) NOT NULL DEFAULT '',
  `cf_1_subj` varchar(255) NOT NULL DEFAULT '',
  `cf_2_subj` varchar(255) NOT NULL DEFAULT '',
  `cf_3_subj` varchar(255) NOT NULL DEFAULT '',
  `cf_4_subj` varchar(255) NOT NULL DEFAULT '',
  `cf_5_subj` varchar(255) NOT NULL DEFAULT '',
  `cf_6_subj` varchar(255) NOT NULL DEFAULT '',
  `cf_7_subj` varchar(255) NOT NULL DEFAULT '',
  `cf_8_subj` varchar(255) NOT NULL DEFAULT '',
  `cf_9_subj` varchar(255) NOT NULL DEFAULT '',
  `cf_10_subj` varchar(255) NOT NULL DEFAULT '',
  `cf_1` varchar(255) NOT NULL DEFAULT '',
  `cf_2` varchar(255) NOT NULL DEFAULT '',
  `cf_3` varchar(255) NOT NULL DEFAULT '',
  `cf_4` varchar(255) NOT NULL DEFAULT '',
  `cf_5` varchar(255) NOT NULL DEFAULT '',
  `cf_6` varchar(255) NOT NULL DEFAULT '',
  `cf_7` varchar(255) NOT NULL DEFAULT '',
  `cf_8` varchar(255) NOT NULL DEFAULT '',
  `cf_9` varchar(255) NOT NULL DEFAULT '',
  `cf_10` varchar(255) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `g5_config`
--

LOCK TABLES `g5_config` WRITE;
/*!40000 ALTER TABLE `g5_config` DISABLE KEYS */;
INSERT INTO `g5_config` VALUES ('JAPANDAY','','admin','admin@jp1.com','JAPANDAY','',1,0,0,0,100,15,60,'basic',15,'basic','basic','basic',0,0,0,0,10,5,'_blank',0,30,'18아,18놈,18새끼,18뇬,18노,18것,18넘,개년,개놈,개뇬,개새,개색끼,개세끼,개세이,개쉐이,개쉑,개쉽,개시키,개자식,개좆,게색기,게색끼,광뇬,뇬,눈깔,뉘미럴,니귀미,니기미,니미,도촬,되질래,뒈져라,뒈진다,디져라,디진다,디질래,병쉰,병신,뻐큐,뻑큐,뽁큐,삐리넷,새꺄,쉬발,쉬밸,쉬팔,쉽알,스패킹,스팽,시벌,시부랄,시부럴,시부리,시불,시브랄,시팍,시팔,시펄,실밸,십8,십쌔,십창,싶알,쌉년,썅놈,쌔끼,쌩쑈,썅,써벌,썩을년,쎄꺄,쎄엑,쓰바,쓰발,쓰벌,쓰팔,씨8,씨댕,씨바,씨발,씨뱅,씨봉알,씨부랄,씨부럴,씨부렁,씨부리,씨불,씨브랄,씨빠,씨빨,씨뽀랄,씨팍,씨팔,씨펄,씹,아가리,아갈이,엄창,접년,잡놈,재랄,저주글,조까,조빠,조쟁이,조지냐,조진다,조질래,존나,존니,좀물,좁년,좃,좆,좇,쥐랄,쥐롤,쥬디,지랄,지럴,지롤,지미랄,쫍빱,凸,퍽큐,뻑큐,빠큐,ㅅㅂㄹㅁ','','','','','','','basic',0,0,0,0,0,0,0,0,0,0,0,0,2,1000,2,0,0,30,10000,1,0,0,0,0,0,0,0,0,'admin,administrator,관리자,운영자,어드민,주인장,webmaster,웹마스터,sysop,시삽,시샵,manager,매니저,메니저,root,루트,su,guest,방문객','',30,180,180,180,'2020-06-25',2,5000,22,22,50000,60,60,10,'gif|jpg|jpeg|png','swf','asx|asf|wmv|wma|mpg|mpeg|mov|avi|mp3',1,15,15,'오늘:3,어제:3,최대:18,전체:123',0,'해당 홈페이지에 맞는 회원가입약관을 입력합니다.','해당 홈페이지에 맞는 개인정보처리방침을 입력합니다.',0,500,'basic','basic','basic','basic','basic','basic','smarteditor2',0,'','','','','','',2,0,'','','','','211.172.232.124','7295','',0,'','','','','','','','','','','','','','','kcaptcha','','','','','','','','','','','','','','','','','','','','','','');
/*!40000 ALTER TABLE `g5_config` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `g5_content`
--

DROP TABLE IF EXISTS `g5_content`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `g5_content` (
  `co_id` varchar(20) NOT NULL DEFAULT '',
  `co_html` tinyint(4) NOT NULL DEFAULT '0',
  `co_subject` varchar(255) NOT NULL DEFAULT '',
  `co_content` longtext NOT NULL,
  `co_seo_title` varchar(255) NOT NULL DEFAULT '',
  `co_mobile_content` longtext NOT NULL,
  `co_skin` varchar(255) NOT NULL DEFAULT '',
  `co_mobile_skin` varchar(255) NOT NULL DEFAULT '',
  `co_tag_filter_use` tinyint(4) NOT NULL DEFAULT '0',
  `co_hit` int(11) NOT NULL DEFAULT '0',
  `co_include_head` varchar(255) NOT NULL,
  `co_include_tail` varchar(255) NOT NULL,
  PRIMARY KEY (`co_id`),
  KEY `co_seo_title` (`co_seo_title`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `g5_content`
--

LOCK TABLES `g5_content` WRITE;
/*!40000 ALTER TABLE `g5_content` DISABLE KEYS */;
INSERT INTO `g5_content` VALUES ('company',1,'회사소개','<div><h2>재팬데이</h2>\r\n<h3>COMPANY INTRODUCTION</h3></div>\r\n<p align=\"center\">일본에 가지 않아도 <strong>드럭스토어, 카베진, 동전파스, 샤론파스, 오타이산, 곤약젤리 등</strong> 일본 직배송으로 쉽고 빠르게 구입할 수 있습니다.</p>','회사소개','','basic','basic',1,0,'',''),('customs',1,'관세/부가세 안내','<p>재팬데이의 모든 상품은 별도 표시가 없는 경우 모두 관/부가세가 포함되지 않은 금액입니다. 판매 목적이 아닌 자가 사용 목적으로, 구매 금액 미화 150＄ 이하인 경우에만 면세이며, 150＄를 초과하는 경우는 고객이 관/부가세를 납부해야 합니다. 자가 사용 목적이 아닌 경우 관/부가세가 발생되며 통관 수수료 (개인 11,000원/사업자 16,500원)가 추가로 발생됩니다. 통관 수수료 발생 시에는 재팬데이와 계약된 관세사의 안내에 따라 관/부가세를 납부해야만 상품이 배송됩니다.</p>\r\n\r\n<h5>관/부가세</h5>\r\n<ul><li>관세란 국가가 재정 수입을 얻기 위하여 관세 영역을 출입하는 물품에 대하여 법률이나 조약에 의거하여 징수하는 세금입니다. 해외 구매물품에 납부하는 관/부가세는 해외에서 국내로 들어오는 화물에 부과하는 관세와 해당 구매금액 및 관세에 대한 10%의 부가가치세를 합산한 금액입니다.</li>\r\n	<li>과세가격(CIF)은 국내에 입항 전까지 물품에 드는 모든 비용을 말하며 과세 금액이 미화 150＄을 초과하게 되면 관/부가세가 부과됩니다. 150＄ 이하의 경우에도 자가 사용이 인정되는 경우에만 관/부가세가 면제됩니다.</li>\r\n	<li>관/부가세 과세표준가격은 다음과 같습니다.</li>\r\n</ul><div>\r\n	<p>{구매대행 쇼핑몰에서 물품 구입 시 지불한 전체 금액(물품가격 + 현지 세금 + 현지 운송비) × 관세청 고시 환율} + 과세 운임</p>\r\n	<p class=\"smail\">- 과세 운임을 물품의 구입 시 결제 금액이 20만원 이하일 경우에는 선편 일반 소포 과세 운임이 적용되며 20만원을 초과하는 경우에는 특급 탁송 화물운임이 적용됩니다.</p>\r\n</div>\r\n<p><strong>관세 = 과세 표준가격 × 해당 물품의 관세율(%)</strong><br><strong>부가세 = (과세 표준가격 + 관세 + 기타 수입 세금) × 10%</strong><br><strong>특별 소비세 = (과세 표준가격 + 관세) × 특별 소비세율 또는 (기준 가격 초과 금액 + 관세) × 특별 소비세율</strong></p>\r\n\r\n\r\n<ul><li>동일 입항일(한국 도착일)에 2건 이상의 물품이 도착하는 경우 각 물품의 과세가격이 미화 150＄ 이하여도 물품의 총 과세 표준가격을 기준으로 합산과세가 발생 할 수 있습니다.</li>\r\n	<li>입항일(한국 도착일)은 다르나 2건 이상의 물품을 같은 날짜에 구입한 경우 각 물품의 과세가격이 미화 150＄ 이하여도 물품의 총 과세 표준가격을 기준으로 합산과세가 발생 할 수 있습니다.</li>\r\n</ul>\r\n\r\n<h5>품목별 관세율 안내</h5>\r\n<p><strong>일반 품목</strong>(*) 품목은 물품 금액이 100~200만원 이상일 경우 특소세가 부가될 수 있습니다.</p>\r\n<table cellpadding=\"0\" cellspacing=\"0\">\r\n	<colgroup>\r\n		<col style=\"width:26%\">\r\n		<col style=\"width:12%\">\r\n		<col style=\"width:12%\">\r\n		<col style=\"width:26%\">\r\n		<col style=\"width:12%\">\r\n		<col style=\"width:12%\">\r\n	</colgroup>\r\n	<caption>품목별 관세율</caption>\r\n	<thead>\r\n	<tr><th scope=\"col\" class=\"border_r\">품목</th>\r\n			<th scope=\"col\" class=\"border_r\">관세율</th>\r\n			<th scope=\"col\" class=\"border_r\">부가세</th>\r\n			<th scope=\"col\" class=\"border_l\">품목</th>\r\n			<th scope=\"col\" class=\"border_l\">관세율</th>\r\n			<th scope=\"col\" class=\"border_l\">부가세</th>\r\n		</tr></thead><tbody><tr><td class=\"border_r border_b\">의류/수영복/속옷</td>\r\n			<td class=\"border_r border_b\">13%</td>\r\n			<td class=\"border_r border_b\">10%</td>\r\n			<td class=\"border_l border_b\">기저귀</td>\r\n			<td class=\"border_l border_b\">-</td>\r\n			<td class=\"border_l border_b\">10%</td>\r\n		</tr><tr><td class=\"border_r border_b\">스카프/숄/넥타이/장갑</td>\r\n			<td class=\"border_r border_b\">8%</td>\r\n			<td class=\"border_r border_b\">10%</td>\r\n			<td class=\"border_l border_b\">기념주화</td>\r\n			<td class=\"border_l border_b\">-</td>\r\n			<td class=\"border_l border_b\">10%</td>\r\n		</tr><tr><td class=\"border_r border_b\">액세서리*</td>\r\n			<td class=\"border_r border_b\">8%</td>\r\n			<td class=\"border_r border_b\">10%</td>\r\n			<td class=\"border_l border_b\">텐트</td>\r\n			<td class=\"border_l border_b\">13%</td>\r\n			<td class=\"border_l border_b\">10%</td>\r\n		</tr><tr><td class=\"border_r border_b\">신발류</td>\r\n			<td class=\"border_r border_b\">13%</td>\r\n			<td class=\"border_r border_b\">10%</td>\r\n			<td class=\"border_l border_b\">PDP</td>\r\n			<td class=\"border_l border_b\">8%</td>\r\n			<td class=\"border_l border_b\">10%</td>\r\n		</tr><tr><td class=\"border_r border_b\">가방/핸드백</td>\r\n			<td class=\"border_r border_b\">8%</td>\r\n			<td class=\"border_r border_b\">10%</td>\r\n			<td class=\"border_l border_b\">가습기</td>\r\n			<td class=\"border_l border_b\">8%</td>\r\n			<td class=\"border_l border_b\">10%</td>\r\n		</tr><tr><td class=\"border_r border_b\">선글라스</td>\r\n			<td class=\"border_r border_b\">8%</td>\r\n			<td class=\"border_r border_b\">10%</td>\r\n			<td class=\"border_l border_b\">낚시대</td>\r\n			<td class=\"border_l border_b\">8%</td>\r\n			<td class=\"border_l border_b\">10%</td>\r\n		</tr><tr><td class=\"border_r border_b\">화장품/향수*</td>\r\n			<td class=\"border_r border_b\">8%</td>\r\n			<td class=\"border_r border_b\">10%</td>\r\n			<td class=\"border_l border_b\">동물사료</td>\r\n			<td class=\"border_l border_b\">8%</td>\r\n			<td class=\"border_l border_b\">10%</td>\r\n		</tr><tr><td class=\"border_r border_b\">펜/잉크</td>\r\n			<td class=\"border_r border_b\">8%/6.5%</td>\r\n			<td class=\"border_r border_b\">10%</td>\r\n			<td class=\"border_l border_b\">GPS 수신기</td>\r\n			<td class=\"border_l border_b\">-</td>\r\n			<td class=\"border_l border_b\">10%</td>\r\n		</tr><tr><td class=\"border_r border_b\">서적/잡지/우편</td>\r\n			<td class=\"border_r border_b\">-</td>\r\n			<td class=\"border_r border_b\">-</td>\r\n			<td class=\"border_l border_b\">그림</td>\r\n			<td class=\"border_l border_b\">-</td>\r\n			<td class=\"border_l border_b\">-</td>\r\n		</tr><tr><td class=\"border_r border_b\">면도기/다리미</td>\r\n			<td class=\"border_r border_b\">8%</td>\r\n			<td class=\"border_r border_b\">10%</td>\r\n			<td class=\"border_l border_b\">꿀</td>\r\n			<td class=\"border_l border_b\">20%</td>\r\n			<td class=\"border_l border_b\">10%</td>\r\n		</tr><tr><td class=\"border_r border_b\">CDP/MP3/오디오/스피커</td>\r\n			<td class=\"border_r border_b\">8%</td>\r\n			<td class=\"border_r border_b\">10%</td>\r\n			<td class=\"border_l border_b\">가구</td>\r\n			<td class=\"border_l border_b\">-</td>\r\n			<td class=\"border_l border_b\">10%</td>\r\n		</tr><tr><td class=\"border_r border_b\">노트북/PDA/컴퓨터</td>\r\n			<td class=\"border_r border_b\">-</td>\r\n			<td class=\"border_r border_b\">10%</td>\r\n			<td class=\"border_l border_b\">침대/침구류</td>\r\n			<td class=\"border_l border_b\">-</td>\r\n			<td class=\"border_l border_b\">10%</td>\r\n		</tr><tr><td class=\"border_r border_b\">컴퓨터 부품</td>\r\n			<td class=\"border_r border_b\">-</td>\r\n			<td class=\"border_r border_b\">-</td>\r\n			<td class=\"border_l border_b\">방독면</td>\r\n			<td class=\"border_l border_b\">8%</td>\r\n			<td class=\"border_l border_b\">-</td>\r\n		</tr><tr><td class=\"border_r border_b\">캠코더*</td>\r\n			<td class=\"border_r border_b\">8%</td>\r\n			<td class=\"border_r border_b\">10%</td>\r\n			<td class=\"border_l border_b\">건강보조식품(최대 수량 6개)</td>\r\n			<td class=\"border_l border_b\">8%</td>\r\n			<td class=\"border_l border_b\">10%</td>\r\n		</tr><tr><td class=\"border_r border_b\">폴라로이드 카메라/필름 카메라</td>\r\n			<td class=\"border_r border_b\">8%</td>\r\n			<td class=\"border_r border_b\">10%</td>\r\n			<td class=\"border_l border_b\">액션 피규어</td>\r\n			<td class=\"border_l border_b\">8%</td>\r\n			<td class=\"border_l border_b\">10%</td>\r\n		</tr><tr><td class=\"border_r border_b\">디지털 카메라*</td>\r\n			<td class=\"border_r border_b\">-</td>\r\n			<td class=\"border_r border_b\">10%</td>\r\n			<td class=\"border_l border_b\">소프트웨어</td>\r\n			<td class=\"border_l border_b\">-</td>\r\n			<td class=\"border_l border_b\">10%</td>\r\n		</tr><tr><td class=\"border_r border_b\">손목시계</td>\r\n			<td class=\"border_r border_b\">8%</td>\r\n			<td class=\"border_r border_b\">10%</td>\r\n			<td class=\"border_l border_b\">전기전자 제어판</td>\r\n			<td class=\"border_l border_b\">8%</td>\r\n			<td class=\"border_l border_b\">10%</td>\r\n		</tr><tr><td class=\"border_r border_b\">골프채</td>\r\n			<td class=\"border_r border_b\">8%</td>\r\n			<td class=\"border_r border_b\">10%</td>\r\n			<td class=\"border_l border_b\">자전거(부품)</td>\r\n			<td class=\"border_l border_b\">8%</td>\r\n			<td class=\"border_l border_b\">10%</td>\r\n		</tr><tr><td class=\"border_r border_b\">모터보트 관련</td>\r\n			<td class=\"border_r border_b\">8%</td>\r\n			<td class=\"border_r border_b\">10%</td>\r\n			<td class=\"border_l border_b\">공기청정기</td>\r\n			<td class=\"border_l border_b\">8%</td>\r\n			<td class=\"border_l border_b\">10%</td>\r\n		</tr><tr><td class=\"border_r border_b\">행글라이더</td>\r\n			<td class=\"border_r border_b\">8%</td>\r\n			<td class=\"border_r border_b\">10%</td>\r\n			<td class=\"border_l border_b\">무전기</td>\r\n			<td class=\"border_l border_b\">-</td>\r\n			<td class=\"border_l border_b\">10%</td>\r\n		</tr><tr><td class=\"border_r border_b\">수상 스키</td>\r\n			<td class=\"border_r border_b\">8%</td>\r\n			<td class=\"border_r border_b\">10%</td>\r\n			<td class=\"border_l border_b\">페인트</td>\r\n			<td class=\"border_l border_b\">7%</td>\r\n			<td class=\"border_l border_b\">10%</td>\r\n		</tr><tr><td class=\"border_r border_b\">영사기</td>\r\n			<td class=\"border_r border_b\">8%</td>\r\n			<td class=\"border_r border_b\">10%</td>\r\n			<td class=\"border_l border_b\">금괴(골드바)</td>\r\n			<td class=\"border_l border_b\">3%</td>\r\n			<td class=\"border_l border_b\">10%</td>\r\n		</tr><tr><td class=\"border_r border_b\">헤어 관련용품</td>\r\n			<td class=\"border_r border_b\">8%</td>\r\n			<td class=\"border_r border_b\">10%</td>\r\n			<td class=\"border_l border_b\">식품</td>\r\n			<td class=\"border_l border_b\">8%</td>\r\n			<td class=\"border_l border_b\">10%</td>\r\n		</tr><tr><td class=\"border_r border_b\">음반</td>\r\n			<td class=\"border_r border_b\">8%</td>\r\n			<td class=\"border_r border_b\">10%</td>\r\n			<td class=\"border_l border_b\">카메라 렌즈</td>\r\n			<td class=\"border_l border_b\">8%</td>\r\n			<td class=\"border_l border_b\">10%</td>\r\n		</tr><tr><td class=\"border_r border_b\">커피머신</td>\r\n			<td class=\"border_r border_b\">8%</td>\r\n			<td class=\"border_r border_b\">10%</td>\r\n			<td class=\"border_l border_b\">LCD패널</td>\r\n			<td class=\"border_l border_b\">8%</td>\r\n			<td class=\"border_l border_b\">10%</td>\r\n		</tr><tr><td class=\"border_r border_b\">RC</td>\r\n			<td class=\"border_r border_b\">8%</td>\r\n			<td class=\"border_r border_b\">10%</td>\r\n			<td class=\"border_l border_b\">정수기</td>\r\n			<td class=\"border_l border_b\">8%</td>\r\n			<td class=\"border_l border_b\">10%</td>\r\n		</tr><tr><td class=\"border_r border_b\">유리식기 종류</td>\r\n			<td class=\"border_r border_b\">8%</td>\r\n			<td class=\"border_r border_b\">10%</td>\r\n			<td class=\"border_l border_b\">담배</td>\r\n			<td class=\"border_l border_b\">40%</td>\r\n			<td class=\"border_l border_b\">10%</td>\r\n		</tr><tr><td class=\"border_r border_b\">자동차(오토바이) 부품</td>\r\n			<td class=\"border_r border_b\">8%</td>\r\n			<td class=\"border_r border_b\">10%</td>\r\n			<td class=\"border_l border_b\">스프레이(락카)</td>\r\n			<td class=\"border_l border_b\">8%</td>\r\n			<td class=\"border_l border_b\">10%</td>\r\n		</tr><tr><td class=\"border_r border_b\">전등</td>\r\n			<td class=\"border_r border_b\">8%</td>\r\n			<td class=\"border_r border_b\">10%</td>\r\n			<td class=\"border_l border_b\">도자기<br>(골동품 100년이상 제외)</td>\r\n			<td class=\"border_l border_b\">8%</td>\r\n			<td class=\"border_l border_b\">10%</td>\r\n		</tr><tr><td class=\"border_r border_b\">음향장비/악기</td>\r\n			<td class=\"border_r border_b\">8%</td>\r\n			<td class=\"border_r border_b\">10%</td>\r\n			<td class=\"border_l border_b\">우산</td>\r\n			<td class=\"border_l border_b\">13%</td>\r\n			<td class=\"border_l border_b\">10%</td>\r\n		</tr><tr><td class=\"border_r border_b\">레고/블럭 장난감</td>\r\n			<td class=\"border_r border_b\">8%</td>\r\n			<td class=\"border_r border_b\">10%</td>\r\n			<td class=\"border_l border_b\">자동차/오토바이</td>\r\n			<td class=\"border_l border_b\">별도 문의</td>\r\n			<td class=\"border_l border_b\">별도 문의</td>\r\n		</tr><tr><td class=\"border_r border_b\">유모차</td>\r\n			<td class=\"border_r border_b\">8%</td>\r\n			<td class=\"border_r border_b\">10%</td>\r\n			<td class=\"border_l border_b\">배/트레일러 등</td>\r\n			<td class=\"border_l border_b\">-</td>\r\n			<td class=\"border_l border_b\">-</td>\r\n		</tr><tr><td class=\"border_r border_b\">스포차장비(가구)</td>\r\n			<td class=\"border_r border_b\">8%</td>\r\n			<td class=\"border_r border_b\">10%</td>\r\n			<td class=\"border_l border_b\">카페트</td>\r\n			<td class=\"border_l border_b\">8%</td>\r\n			<td class=\"border_l border_b\">10%</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n\r\n\r\n<h5>특소세 부과 물품</h5>\r\n<table cellpadding=\"0\" cellspacing=\"0\">\r\n	<colgroup>\r\n		<col style=\"width:\">\r\n		<col style=\"width:11%\">\r\n		<col style=\"width:11%\">\r\n		<col style=\"width:11%\">\r\n		<col style=\"width:11%\">\r\n		<col style=\"width:11%\">\r\n		<col style=\"width:\">\r\n	</colgroup>\r\n	<caption>특소세 부과 물품</caption>\r\n	<thead>\r\n		<tr><th scope=\"col\" class=\"border_r\">품목</th>\r\n			<th scope=\"col\" class=\"border_r\">관세율</th>\r\n			<th scope=\"col\" class=\"border_r\">특소세</th>\r\n			<th scope=\"col\" class=\"border_r\">교육</th>\r\n			<th scope=\"col\" class=\"border_r\">농특세</th>\r\n			<th scope=\"col\" class=\"border_r\">부가세</th>\r\n			<th scope=\"col\">비고</th>\r\n		</tr>\r\n	</thead>\r\n	<tbody>\r\n		<tr><td class=\"border_r border_b\">오락용품(사행성)</td>\r\n			<td class=\"border_r border_b\">8%</td>\r\n			<td class=\"border_r border_b\">20%</td>\r\n			<td class=\"border_r border_b\">30%</td>\r\n			<td class=\"border_r border_b\">10%</td>\r\n			<td class=\"border_r border_b\">10%</td>\r\n			<td class=\"border_b\">&nbsp;</td>\r\n		</tr><tr><td class=\"border_r border_b\">공기 조절기 관련</td>\r\n			<td class=\"border_r border_b\">8%</td>\r\n			<td class=\"border_r border_b\">20%</td>\r\n			<td class=\"border_r border_b\">30%</td>\r\n			<td class=\"border_r border_b\">-</td>\r\n			<td class=\"border_r border_b\">10%</td>\r\n			<td class=\"border_b\">&nbsp;</td>\r\n		</tr><tr><td class=\"border_r border_b\">영사투사방식 TV등</td>\r\n			<td class=\"border_r border_b\">8%</td>\r\n			<td class=\"border_r border_b\">10%</td>\r\n			<td class=\"border_r border_b\">30%</td>\r\n			<td class=\"border_r border_b\">-</td>\r\n			<td class=\"border_r border_b\">10%</td>\r\n			<td class=\"border_b\">&nbsp;</td>\r\n		</tr><tr><td class=\"border_r border_b\">녹용/로얄젤리</td>\r\n			<td class=\"border_r border_b\">20%</td>\r\n			<td class=\"border_r border_b\">7%</td>\r\n			<td class=\"border_r border_b\">30%</td>\r\n			<td class=\"border_r border_b\">-</td>\r\n			<td class=\"border_r border_b\">10%</td>\r\n			<td class=\"border_b\">&nbsp;</td>\r\n		</tr><tr><td class=\"border_r border_b\">향수</td>\r\n			<td class=\"border_r border_b\">8%</td>\r\n			<td class=\"border_r border_b\">7%</td>\r\n			<td class=\"border_r border_b\">30%</td>\r\n			<td class=\"border_r border_b\">10%</td>\r\n			<td class=\"border_r border_b\">10%</td>\r\n			<td class=\"border_b\">&nbsp;</td>\r\n		</tr><tr><td class=\"border_r border_b\">보석/귀금속 관련</td>\r\n			<td class=\"border_r border_b\">8%</td>\r\n			<td class=\"border_r border_b\">20%</td>\r\n			<td class=\"border_r border_b\">30%</td>\r\n			<td class=\"border_r border_b\">-</td>\r\n			<td class=\"border_r border_b\">10%</td>\r\n			<td class=\"border_b\">&nbsp;</td>\r\n		</tr><tr><td class=\"border_r border_b\">고급 카메라 관련</td>\r\n			<td class=\"border_r border_b\">8%</td>\r\n			<td class=\"border_r border_b\">20%</td>\r\n			<td class=\"border_r border_b\">30%</td>\r\n			<td class=\"border_r border_b\">-</td>\r\n			<td class=\"border_r border_b\">10%</td>\r\n			<td class=\"border_b\">&nbsp;</td>\r\n		</tr><tr><td class=\"border_r border_b\">고급 모피 관련</td>\r\n			<td class=\"border_r border_b\">16%</td>\r\n			<td class=\"border_r border_b\">20%</td>\r\n			<td class=\"border_r border_b\">30%</td>\r\n			<td class=\"border_r border_b\">10%</td>\r\n			<td class=\"border_r border_b\">10%</td>\r\n			<td class=\"border_b\">&nbsp;</td>\r\n		</tr><tr><td class=\"border_r border_b\">고급 융단 등</td>\r\n			<td class=\"border_r border_b\">10%</td>\r\n			<td class=\"border_r border_b\">20%</td>\r\n			<td class=\"border_r border_b\">30%</td>\r\n			<td class=\"border_r border_b\">-</td>\r\n			<td class=\"border_r border_b\">10%</td>\r\n			<td class=\"border_b\">&nbsp;</td>\r\n		</tr><tr><td class=\"border_r border_b\">고급 가구 등</td>\r\n			<td class=\"border_r border_b\">8%</td>\r\n			<td class=\"border_r border_b\">20%</td>\r\n			<td class=\"border_r border_b\">30%</td>\r\n			<td class=\"border_r border_b\">10%</td>\r\n			<td class=\"border_r border_b\">10%</td>\r\n			<td class=\"border_b\">&nbsp;</td>\r\n		</tr><tr><td class=\"border_r border_b\">술(위스키)</td>\r\n			<td class=\"border_r border_b\">20%</td>\r\n			<td class=\"border_r border_b\">-</td>\r\n			<td class=\"border_r border_b\">30%</td>\r\n			<td class=\"border_r border_b\">-</td>\r\n			<td class=\"border_r border_b\">10%</td>\r\n			<td class=\"border_b\">주세 72%</td>\r\n		</tr><tr><td class=\"border_r border_b\">술(와인)</td>\r\n			<td class=\"border_r border_b\">15%</td>\r\n			<td class=\"border_r border_b\">-</td>\r\n			<td class=\"border_r border_b\">10%</td>\r\n			<td class=\"border_r border_b\">-</td>\r\n			<td class=\"border_r border_b\">10%</td>\r\n			<td class=\"border_b\">주세 30%</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n		\r\n<h5>관세 안내(취합)</h5>\r\n<p>상품가와 운임료를 포함하여 15만원이 넘으면 세금 부과 대상이며 같은 날 동일한 주소로 물품을 받게 되면 각각 개별의 물품을 받더라도 물품 금액의 합계로 관세를 납부하시게 됩니다.</p>','관세부가세-안내','','basic','basic',1,0,'',''),('delivery',1,'배송비안내','<div><img src=\"/img/sub/imgDelivery.jpg\" alt=\"\"></div>\r\n\r\n<table cellpadding=\"0\" cellspacing=\"0\">\r\n	<colgroup>\r\n		<col style=\"width:20%\">\r\n		<col style=\"width:30%\">\r\n		<col style=\"width:20%\">\r\n		<col style=\"width:30%\">\r\n	</colgroup>\r\n	<caption>배송비 안내</caption>\r\n	<thead>\r\n		<tr>\r\n			<th scope=\"col\" class=\"border_r\">무게(kg)</th>\r\n			<th scope=\"col\" class=\"border_r\">배송비</th>\r\n			<th scope=\"col\" class=\"border_l\">무게(kg)</th>\r\n			<th scope=\"col\" class=\"border_l\">배송비</th>\r\n		</tr>\r\n	</thead>\r\n	<tbody>\r\n		<tr>\r\n			<td class=\"border_r border_b\">~0.5</td>\r\n			<td class=\"border_r border_b\">8,500원</td>\r\n			<td class=\"border_l border_b\">~1</td>\r\n			<td class=\"border_l border_b\">11,000원</td>\r\n		</tr>\r\n		<tr>\r\n			<td class=\"border_r border_b\">~1.5</td>\r\n			<td class=\"border_r border_b\">12,000원</td>\r\n			<td class=\"border_l border_b\">~2</td>\r\n			<td class=\"border_l border_b\">13,500원</td>\r\n		</tr>\r\n		<tr>\r\n			<td class=\"border_r border_b\">~2.5</td>\r\n			<td class=\"border_r border_b\">15,000원</td>\r\n			<td class=\"border_l border_b\">~3</td>\r\n			<td class=\"border_l border_b\">17,000원</td>\r\n		</tr>\r\n		<tr>\r\n			<td class=\"border_r border_b\">~3.5</td>\r\n			<td class=\"border_r border_b\">18,500원</td>\r\n			<td class=\"border_l border_b\">~4</td>\r\n			<td class=\"border_l border_b\">21,000원</td>\r\n		</tr>\r\n		<tr>\r\n			<td class=\"border_r border_b\">~4.5</td>\r\n			<td class=\"border_r border_b\">22,500원</td>\r\n			<td class=\"border_l border_b\">~5</td>\r\n			<td class=\"border_l border_b\">25,500원</td>\r\n		</tr>\r\n		<tr>\r\n			<td class=\"border_r border_b\">~5.5</td>\r\n			<td class=\"border_r border_b\">26,500원</td>\r\n			<td class=\"border_l border_b\">~6</td>\r\n			<td class=\"border_l border_b\">28,500원</td>\r\n		</tr>\r\n		<tr>\r\n			<td class=\"border_r border_b\">~6.5</td>\r\n			<td class=\"border_r border_b\">31,500원</td>\r\n			<td class=\"border_l border_b\">~7</td>\r\n			<td class=\"border_l border_b\">32,500원</td>\r\n		</tr>\r\n		<tr>\r\n			<td class=\"border_r border_b\">~7.5</td>\r\n			<td class=\"border_r border_b\">33,500원</td>\r\n			<td class=\"border_l border_b\">~8</td>\r\n			<td class=\"border_l border_b\">35,500원</td>\r\n		</tr>\r\n		<tr>\r\n			<td class=\"border_r border_b\">~8.5</td>\r\n			<td class=\"border_r border_b\">37,500원</td>\r\n			<td class=\"border_l border_b\">~9</td>\r\n			<td class=\"border_l border_b\">39,500원</td>\r\n		</tr>\r\n		<tr>\r\n			<td class=\"border_r border_b\">~9.5</td>\r\n			<td class=\"border_r border_b\">41,500원</td>\r\n			<td class=\"border_l border_b\">~10</td>\r\n			<td class=\"border_l border_b\">43,500원</td>\r\n		</tr>\r\n		<tr>\r\n			<td class=\"border_r border_b\">~11</td>\r\n			<td class=\"border_r border_b\">47,000원</td>\r\n			<td class=\"border_l border_b\">~12</td>\r\n			<td class=\"border_l border_b\">51,000원</td>\r\n		</tr>\r\n		<tr>\r\n			<td class=\"border_r border_b\">~13</td>\r\n			<td class=\"border_r border_b\">54,000원</td>\r\n			<td class=\"border_l border_b\">~14</td>\r\n			<td class=\"border_l border_b\">58,000원</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n','배송비안내','','basic','basic',1,0,'',''),('holiday',1,'일본 휴무일 안내','<div style=\"text-align:center; background:#fbcf62\">\r\n<img src=\"/img/sub/imgHoliday.jpg\" alt=\"일본휴무일\">\r\n</div>','일본-휴무일-안내','','basic','basic',1,0,'',''),('privacy',1,'개인정보 처리방침','<div class=\"service_cont\">\r\n재팬데이(주)는 이용자의 개인정보를 보호하고 이와 관련한 고충을 신속하고 원활하게 처리할 수 있도록 다음과 같이 개인정보 처리방침을 수립·공개하며, 본 개인정보 처리방침을 홈페이지 첫 화면에 공개함으로써 이용자들이 언제나 용이하게 보실 수 있도록 조치하고 있습니다. 개인정보 처리방침은 정부의 법률 및 지침 변경이나 회사의 내부 방침 변경 등으로 인하여 수시로 변경될 수 있고, 이에 따른 개인정보 처리방침의 지속적인 개선을 위하여 필요한 절차를 정하고 있습니다. 이용자들께서는 사이트 방문 시 수시로 확인하시기 바랍니다.<br>\r\n<br>\r\n재팬데이(주)의 개인정보 처리방침은 다음과 같은 내용을 담고 있습니다.<br>\r\n<br>\r\n1. 개인정보 수집에 대한 동의<br>\r\n2. 수집하는 개인정보 항목 및 수집방법<br>\r\n3. 개인정보의 수집 및 이용목적<br>\r\n4. 수집하는 개인정보의 보유 및 이용기간<br>\r\n5. 개인정보의 파기 절차 및 방법 <br>\r\n6. 수집한 개인정보의 공유 및 제공 <br>\r\n7. 이용자 자신의 개인정보 관리(열람,정정,삭제 등)에 관한 사항 <br>\r\n8. 쿠키(Cookie)의 운용 및 거부 <br>\r\n9. 개인정보의 위탁처리<br>\r\n10. 개인정보보호를 위한 기술적/관리적 대책 <br>\r\n11. 개인정보 관련 의견수렴 및 불만처리에 관한 사항 <br>\r\n12. 개인정보 보호책임자 및 담당자의 소속-성명 및 연락처 <br>\r\n13. 이용자 및 법정대리인의 권리와 그 행사방법 <br>\r\n14. 권익침해 구제방법 <br>\r\n15. 고지의 의무 <br>\r\n<br>\r\n1. 개인정보 수집에 대한 동의<br>\r\n재팬데이(주)는 이용자들이 회사의 개인정보수집이용 동의 또는 이용약관의 내용에 대하여 「동의」버튼 또는 「취소」버튼을 클릭할 수 있는 절차를 마련하여, 「동의」버튼을 클릭하면 개인정보 수집에 대해 동의한 것으로 봅니다.<br>\r\n<br>\r\n2. 수집하는 개인정보의 항목 및 수집방법<br>\r\n가. 수집 항목 <br>\r\n재팬데이(주)는 이용자들이 회원서비스를 이용하기 위해 회원으로 가입하실 때 서비스 제공을 위한 필수/선택적인 정보들을 온라인상에서 입력 받고 있습니다. <br>\r\n-	회원 가입 시에 받는 필수적인 정보 : 이름, 이메일 주소, ooo, ooo  <br>\r\n-	회원제 서비스 이용에 따른 본인 확인 절차에 이용 시 수집 정보 : 아이디, 비밀번호 <br>\r\n-	서비스 및 부가 서비스 이용에 대한 요금 결제 시 수집하는 정보 : 은행계좌정보, 신용카드정보 <br>\r\n-	불량회원의 부정 이용 방지와 비인가 사용 방지를 위해 수집하는 정보 : IP Address <br>\r\n-	14세미만 가입자의 경우 법정대리인의 정보 <br>\r\n-	기타 양질의 서비스 제공을 위하여 선택적으로 수집하는 정보 : 전화번호, ooo, ooo <br>\r\n나. 수집 방법<br>\r\n재팬데이(주)는 다음과 같은 방법으로 개인정보를 수집합니다.<br>\r\n- 홈페이지, 모바일기기, 서면양식, 팩스, 전화, 상담 게시판, 이메일, 이벤트 응모, 배송요청<br>\r\n- 협력회사로부터의 제공<br>\r\n- 생성정보 수집 툴을 통한 수집<br>\r\n<br>\r\n다. 기타 <br>\r\n쇼핑몰 내에서의 설문조사나 이벤트 행사 시 통계분석이나 경품제공 등을 위해 선별적으로 개인정보 입력을 요청할 수 있습니다. 그러나, 이용자의 기본적 인권 침해의 우려가 있는 민감한 개인정보(인종 및 민족, 사상 및 신조, 출신지 및 본적지, 정치적 성향 및 범죄기록, 건강상태 및 성생활 등)는 수집하지 않으며 부득이하게 수집해야 할 경우 이용자들의 사전동의를 반드시 구할 것입니다.<br>\r\n<br>\r\n3. 개인정보의 수집 및 이용 목적<br>\r\n재팬데이(주)는 이용자의 사전 동의 없이는 이용자의 개인 정보를 수집하지 않으며, 수집된 정보는 아래와 같이 이용하고 있습니다.<br>\r\n가. 신규 서비스의 개발<br>\r\n이용자들이 제공한 개인정보를 바탕으로 보다 더 유용한 서비스를 개발할 수 있습니다. 회사는 신규 서비스 개발이나 컨텐츠의 확충 시에 기존 이용자들이 회사에 제공한 개인정보를 바탕으로 개발해야 할 서비스의 우선 순위를 보다 더 효율적으로 정하고, 회사는 이용자들이 필요로 할 컨텐츠를 합리적으로 선택하여 제공할 수 있습니다.<br>\r\n<br>\r\n나. 회원관리<br>\r\n회원제 서비스 이용에 따른 본인확인, 개인 식별, 불량회원의 부정 이용 방지와 비인가 사용 방지, 가입 의사 확인, 연령확인, 주문 및 결제처리, 배송처리, 만14세 미만 아동 개인정보 수집 시 법정 대리인 동의여부 확인, 불만처리 등 민원처리, 고지사항 전달<br>\r\n<br>\r\n다. 마케팅 및 광고에 활용<br>\r\n신규 서비스 개발과 이벤트 행사에 따른 정보 전달 및 맞춤 서비스 제공, 인구통계학적 특성에 따른 서비스 제공 및 광고 게재, 접속 빈도 파악 또는 회원의 서비스 이용에 대한 통계 <br>\r\n<br>\r\n4. 수집하는 개인정보의 보유 및 이용기간<br>\r\n재팬데이(주)는 이용자의 개인정보를 원칙적으로 개인정보의 수집 및 이용목적이 달성되면 지체 없이 파기합니다. 단, 다음의 정보에 대해서는 아래의 이유로 명시한 기간 동안 보존합니다.<br>\r\n가. 관련법령에 의한 정보보유 사유<br>\r\n- 계약 또는 청약철회 등에 관한 기록 : 5년 (전자상거래등에서의 소비자보호에 관한 법률)<br>\r\n- 대금결제 및 재화 등의 공급에 관한 기록 : 5년 (전자상거래등에서의 소비자보호에 관한 법률)<br>\r\n- 소비자의 불만 또는 분쟁처리에 관한 기록 : 3년 (전자상거래등에서의 소비자보호에 관한 법률)<br>\r\n- 방문(로그)에 관한 기록 : 3개월(통신비밀보호법)<br>\r\n<br>\r\n5. 개인정보의 파기 절차 및 방법<br>\r\n재팬데이(주)는 귀중한 회원의 개인정보를 안전하게 처리하며, 유출의 방지를 위하여 다음과 같은 방법을 통하여 개인정보를 파기합니다.<br>\r\n가. 파기절차<br>\r\n이용자가 서비스 이용 등을 위해 입력하신 정보는 목적이 달성된 후 별도의 DB로 옮겨져(종이의 경우 별도의 서류함) 내부 방침 및 기타 관련 법령에 의한 정보보호 사유에 따라(보유 및 이용기간 참조) 일정 기간 저장된 후 파기됩니다. 별도 DB로 옮겨진 개인정보는 법률에 의한 경우가 아니고서는 보유되어지는 이외의 다른 목적으로 이용되지 않습니다. <br>\r\n<br>\r\n나. 파기방법<br>\r\n- 종이에 출력된 개인정보 : 분쇄기로 분쇄하거나 소각 <br>\r\n- 전자적 파일 형태로 저장된 개인정보 : 기록을 재생할 수 없는 기술적 방법을 사용하여 삭제<br>\r\n<br>\r\n6. 수집한 개인정보의 공유 및 제공<br>\r\n재팬데이(주)는 이용자들의 개인정보를 동의받은 범위 내에서 사용하며, 이용자의 사전 동의 없이는 동 범위를 초과하여 이용하거나 원칙적으로 이용자의 개인정보를 외부에 공유 및 제공하지 않습니다. 다만, 아래의 경우에는 예외로 합니다.<br>\r\n- 이용자들이 사전에 공유 및 제공에 동의한 경우<br>\r\n- 서비스 제공에 따른 요금정산을 위하여 필요한 경우<br>\r\n- 법령의 규정에 의거하거나, 수사 목적으로 법령에 정해진 절차와 방법에 따라 수사기관의 요구가 있는 경우<br>\r\n<br>\r\n7. 이용자 자신의 개인정보 관리(열람,정정,삭제 등)에 관한 사항<br>\r\n회원님이 원하실 경우 언제라도 당사에서 개인정보를 열람하실 수 있으며 보관된 필수 정보를<br>\r\n수정하실 수 있습니다. 또한 회원 가입 시 요구된 필수 정보 외의 추가 정보는 언제나 열람,<br>\r\n수정, 삭제할 수 있습니다. 회원님의 개인정보 변경 및 삭제와 회원탈퇴는 당사의 고객센터에서<br>\r\n로그인(Login) 후 이용하실 수 있습니다.<br>\r\n <br>\r\n8. 쿠키(Cookie)의 운용 및 거부<br>\r\n가. 쿠키의 사용 목적<br>\r\n  ① 회사는 개인 맞춤 서비스를 제공하기 위해서 이용자에 대한 정보를 저장하고 수시로 불러오는 \'쿠키(cookie)\'를 사용합니다. 쿠키는 웹사이트 서버가 이용자의 브라우저에게 전송하는 소량의 정보로서 이용자 컴퓨터의 하드디스크에 저장됩니다.<br>\r\n  ② 회사는 쿠키의 사용을 통해서만 가능한 특정된 맞춤형 서비스를 제공할 수 있습니다.<br>\r\n  ③ 회사는 회원을 식별하고 회원의 로그인 상태를 유지하기 위해 쿠키를 사용할 수 있습니다.<br>\r\n<br>\r\n나. 쿠키의 설치/운용 및 거부<br>\r\n  ① 이용자는 쿠키 설치에 대한 선택권을 가지고 있습니다. 따라서 이용자는 웹브라우저에서 옵션을 조정함으로써 모든 쿠키를 허용/거부하거나, 쿠키가 저장될 때마다 확인을 거치도록 할 수 있습니다.<br>\r\n- 쿠키 설치 허용 여부를 지정하는 방법(Internet Explorer의 경우)은 다음과 같습니다.<br>\r\n  ºInternet Explorer 웹 브라우저 <br>\r\n[도구] &gt; [인터넷 옵션] &gt; [개인정보] 탭 &gt; [설정] 변경<br>\r\n  ºChrome 웹 브라우저 <br>\r\n우측 상단 메뉴 [설정] &gt; [고급] &gt; [콘텐츠 설정] &gt; [쿠키] 설정<br>\r\n② 쿠키의 저장을 거부할 경우에는 개인 맞춤서비스 등 회사가 제공하는 일부 서비스는 이용이 어려울 수 있습니다.<br>\r\n<br>\r\n9. 개인정보의 위탁처리<br>\r\n재팬데이(주)은(는)  개인정보의 처리와 관련하여 아래와 같이 업무를 위탁하고 있으며, 관계 법령에 따라 위탁계약 시 개인정보가 안전하게 관리될 수 있도록 필요한 사항을 규정하고 있습니다. 또한 위탁하는 정보는 당해 목적을 달성하기 위하여 필요한 최소한의 정보에 국한됩니다.<br>\r\n<br>\r\n- 위탁 대상자 : [택배사 이름]<br>\r\n- 위탁업무 내용 : [택배사 위탁 내용]<br>\r\n<br>\r\n- 위탁 대상자 : [PG사 이름]<br>\r\n- 위탁업무 내용 : [PG사 위탁 내용]<br>\r\n<br>\r\n- 위탁 대상자 : 엔에이치엔고도㈜<br>\r\n- 위탁업무 내용 : 고객정보 DB시스템 구축 및 운영/관리(전산아웃소싱)<br>\r\n<br>\r\n10. 개인정보보호를 위한 기술적/관리적 대책 <br>\r\n재팬데이(주)는 이용자의 개인정보를 처리함에 있어 개인정보가 분실, 도난, 유출, 변조, 또는 훼손되지 않도록 안전성 확보를 위하여 다음과 같은 관리적, 기술적, 물리적 대책을 강구하고 있습니다.<br>\r\n가. 관리적 조치 : 내부관리계획 수립. 시행, 정기적 직원 교육 등<br>\r\n<br>\r\n나. 기술적 조치 : 개인정보처리시스템 등의 접근권한 관리, 접근통제시스템 설치, 고유식별정보 등의 암호화, 보안프로그램 설치<br>\r\n<br>\r\n다. 물리적 조치 : 전산실, 자료보관실 등의 접근통제<br>\r\n<br>\r\n재팬데이(주)는 는 이용자 개인의 실수나 기본적인 인터넷의 위험성 때문에 일어나는 일들에 대해 책임을 지지 않습니다. 이용자 개개인이 본인의 개인정보를 보호하기 위해서 자신의 아이디(ID) 와 비밀번호를 적절하게 관리하고 이에 대한 책임을 져야 합니다.<br>\r\n<br>\r\n11. 개인정보 관련 의견수렴 및 불만처리에 관한 사항<br>\r\n<br>\r\n재팬데이(주)는 개인정보보호와 관련하여 이용자 여러분들의 의견을 수렴하고 있으며 불만을 처리하기 위하여 모든 절차와 방법을 마련하고 있습니다. 이용자들은 하단에 명시한 \"13. 개인정보 관리책임자 및 담당자의 소속-성명 및 연락처\"항을 참고하여 전화나 메일을 통하여 불만사항을 신고할 수 있고, 재팬데이(주)는 이용자들의 신고사항에 대하여 신속하고도 충분한 답변을 해 드릴 것입니다.<br>\r\n<br>\r\n12. 개인정보 보호책임자 및 담당자의 소속-성명 및 연락처<br>\r\n재팬데이(주)는 개인정보 처리에 관한 업무를 총괄해서 책임지고, 개인정보 처리와 관련한 이용자의 불만처리 및 피해구제 등을 위하여 아래와 같이 개인정보 보호책임자를 지정하고 있습니다. <br>\r\n<br>\r\n이　　　 름  : 이전영<br>\r\n소속 / 직위　: 영업마케팅 대표<br>\r\nE-M A I L 　 : yhfamilly@naver.com<br>\r\n전 화 번 호　: 070-7124-2376<br>\r\n<br>\r\n13. 이용자 및 법정대리인의 권리와 그 행사방법<br>\r\n가. 이용자 및 법정 대리인은 언제든지 등록되어 있는 자신 혹은 당해 만 14세 미만 아동의 개인정보를 조회하거나 수정할 수 있으며 가입해지(동의철회)를 요청할 수도 있습니다.<br>\r\n<br>\r\n나. 이용자 혹은 만 14세 미만 아동의 개인정보 조회, 수정을 위해서는 로그인 후 MyPage에서 ‘개인정보변경’(또는 ‘회원정보수정’ 등)을, 가입해지(동의철회)를 위해서는 \"회원탈퇴\"를 클릭하여 본인 확인 절차를 거치신 후 직접 열람, 정정 또는 탈퇴가 가능합니다. 혹은 개인정보 보호책임자에게 서면, 전화 또는 이메일로 연락하시면 지체 없이 조치하겠습니다.<br>\r\n<br>\r\n다. 이용자가 개인정보의 오류에 대한 정정을 요청하신 경우에는 정정을 완료하기 전까지 당해 개인정보를 이용 또는 제공하지 않습니다. 또한 잘못된 개인정보를 제3자에게 이미 제공한 경우에는 정정 처리결과를 제3자에게 지체 없이 통지하여 정정이 이루어지도록 하겠습니다. <br>\r\n<br>\r\n라. 재팬데이는 이용자 혹은 법정 대리인의 요청에 의해 해지 또는 삭제된 개인정보는 \"수집하는 개인정보의 보유 및 이용기간\"에 명시된 바에 따라 처리하고 그 외의 용도로 열람 또는 이용할 수 없도록 처리하고 있습니다.<br>\r\n<br>\r\n14. 권익침해 구제방법<br>\r\n이용자는 아래의 기관에 대해 개인정보 침해에 대한 피해구제, 상담 등을 문의하실 수 있습니다.<br>\r\n&lt;아래의 기관은 회사와는 별개의 기관으로서, 회사의 자체적인 개인정보 불만처리, 피해구제 결과에 만족하지 못하시거나 보다 자세한 도움이 필요하시면 문의하여 주시기 바랍니다&gt;<br>\r\n▶ 개인정보 침해신고센터 (한국인터넷진흥원 운영)<br>\r\n- 소관업무 : 개인정보 침해사실 신고, 상담 신청<br>\r\n- 홈페이지 : privacy.kisa.or.kr<br>\r\n- 전화 : (국번없이) 118<br>\r\n- 주소 : (58324) 전남 나주시 진흥길 9(빛가람동 301-2) 3층 개인정보침해신고센터<br>\r\n▶ 개인정보 분쟁조정위원회<br>\r\n- 소관업무 : 개인정보 분쟁조정신청, 집단분쟁조정 (민사적 해결)<br>\r\n- 홈페이지 : www.kopico.go.kr<br>\r\n- 전화 : (국번없이) 1833-6972<br>\r\n- 주소 : (03171)서울특별시 종로구 세종대로 209 정부서울청사 4층<br>\r\n▶ 대검찰청 사이버수사과 : http://www.spo.go.kr<br>\r\n▶ 경찰청 사이버안전국 : http://cyberbureau.police.go.kr<br>\r\n<br>\r\n15. 고지의 의무<br>\r\n현 개인정보처리방침의 내용은 정부의 정책 또는 보안기술의 변경에 따라 내용의 추가 삭제 및 수정이 있을 시에는 홈페이지의 \'공지사항\'을 통해 고지할 것입니다.<br>\r\n<br>\r\n개인정보처리방침 시행일자: 0000-00-00<br>\r\n개인정보처리방침 변경일자: 0000-00-00\r\n    </div>','개인정보-처리방침','','basic','basic',1,0,'',''),('provision',1,'서비스 이용약관','<div class=\"service_cont\">\r\n        제1조(목적)<br>\r\n<br>\r\n표준약관 제10023호<br>\r\n<br>\r\n이 약관은 주식회사 유엠씨코리아 회사(전자거래 사업자)가 운영하는 재팬데이 사이버 몰(이하 \"몰\"이라 한다)에서 제공하는 인터넷 관련 서비스(이하 \"서비스\"라 한다)를 이용함에 있어 사이버몰과 이용자의 권리·의무 및 책임사항을 규정함을 목적으로 합니다.<br>\r\n※ 「PC통신등을 이용하는 전자거래에 대해서도 그 성질에 반하지 않는한 이 약관을 준용합니다」<br>\r\n<br>\r\n<br>\r\n제2조(정의)<br>\r\n<br>\r\n① \"몰\"이란 주식회사 유엠씨코리아 회사가 재화 또는 용역을 이용자에게 제공하기 위하여 컴퓨터등 정보통신설비를 이용하여 재화 또는 용역을 거래할 수 있도록 설정한 가상의 영업장을 말하며, 아울러 사이버몰을 운영하는 사업자의 의미로도 사용합니다.<br>\r\n② \"이용자\"란 \"몰\"에 접속하여 이 약관에 따라 \"몰\"이 제공하는 서비스를 받는 회원 및 비회원을 말합니다.<br>\r\n③ ‘회원’이라 함은 \"몰\"에 개인정보를 제공하여 회원등록을 한 자로서, \"몰\"의 정보를 지속적으로 제공받으며, \"몰\"이 제공하는 서비스를 계속적으로 이용할 수 있는 자를 말합니다.<br>\r\n④ ‘비회원’이라 함은 회원에 가입하지 않고 \"몰\"이 제공하는 서비스를 이용하는 자를 말합니다.<br>\r\n<br>\r\n<br>\r\n제3조(약관등의 명시와 설명 및 개정)<br>\r\n<br>\r\n① \"몰\"은 이 약관의 내용과 상호 및 대표자 성명, 영업소 소재지 주소(소비자의 불만을 처리할 수 있는 곳의 주소를 포함), 전화번호·모사전송번호·전자우편주소, 사업자등록번호, 통신판매업신고번호, 개인정보 보호책임자등을 이용자가 쉽게 알 수 있도록 \"몰\"의 초기 서비스화면(전면)에 게시합니다. 다만, 약관의 내용은 이용자가 연결화면을 통하여 볼 수 있도록 할 수 있습니다.<br>\r\n② \"몰\"은 이용자가 약관에 동의하기에 앞서 약관에 정하여져 있는 내용 중 청약철회·배송책임·환불조건 등과 같은 중요한 내용을 이용자가 이해할 수 있도록 별도의 연결화면 또는 팝업화면 등을 제공하여 이용자의 확인을 구하여야 합니다.<br>\r\n③ \"몰\"은 전자상거래등에서의소비자보호에관한법률, 약관의규제에관한법률, 전자거래기본법, 전자서명법, 정보통신망이용촉진등에관한법률, 방문판매등에관한법률, 소비자보호법 등 관련법을 위배하지 않는 범위에서 이 약관을 개정할 수 있습니다.<br>\r\n④ \"몰\"이 약관을 개정할 경우에는 적용일자 및 개정사유를 명시하여 현행약관과 함께 몰의 초기화면에 그 적용일자 7일이전부터 적용일자 전일까지 공지합니다.<br>\r\n다만, 이용자에게 불리하게 약관내용을 변경하는 경우에는 최소한 30일 이상의 사전 유예기간을 두고 공지합니다.  이 경우 \"몰“은 개정전 내용과 개정후 내용을 명확하게 비교하여 이용자가 알기 쉽도록 표시합니다.<br>\r\n⑤ \"몰\"이 약관을 개정할 경우에는 그 개정약관은 그 적용일자 이후에 체결되는 계약에만 적용되고 그 이전에 이미 체결된 계약에 대해서는 개정전의 약관조항이 그대로 적용됩니다. 다만 이미 계약을 체결한 이용자가 개정약관 조항의 적용을 받기를 원하는 뜻을 제3항에 의한 개정약관의 공지기간내에 \"몰\"에 송신하여 \"몰\"의 동의를 받은 경우에는 개정약관 조항이 적용됩니다.<br>\r\n⑥ 이 약관에서 정하지 아니한 사항과 이 약관의 해석에 관하여는 전자상거래등에서의 소비자보호에 관한 법률, 약관의 규제 등에 관한 법률, 공정거래위원회가 정하는 전자상거래 등에서의 소비자보호지침 및 관계법령 또는 상관례에 따릅니다.<br>\r\n<br>\r\n<br>\r\n제4조(서비스의 제공 및 변경)<br>\r\n<br>\r\n① \"몰\"은 다음과 같은 업무를 수행합니다.<br>\r\n1. 재화 또는 용역에 대한 정보 제공 및 구매계약의 체결<br>\r\n2. 구매계약이 체결된 재화 또는 용역의 배송<br>\r\n3. 기타 \"몰\"이 정하는 업무<br>\r\n② \"몰\"은 재화 또는 용역의 품절 또는 기술적 사양의 변경 등의 경우에는 장차 체결되는 계약에 의해 제공할 재화 또는 용역의 내용을 변경할 수 있습니다. 이 경우에는 변경된 재화 또는 용역의 내용 및 제공일자를 명시하여 현재의 재화 또는 용역의 내용을 게시한 곳에 즉시 공지합니다.<br>\r\n③ \"몰\"이 제공하기로 이용자와 계약을 체결한 서비스의 내용을 재화등의 품절 또는 기술적 사양의 변경 등의 사유로 변경할 경우에는 그 사유를 이용자에게 통지 가능한 주소로 즉시 통지합니다.<br>\r\n④ 전항의 경우 \"몰\"은 이로 인하여 이용자가 입은 손해를 배상합니다. 다만, \"몰\"이 고의 또는 과실이 없음을 입증하는 경우에는 그러하지 아니합니다.<br>\r\n<br>\r\n<br>\r\n제5조(서비스의 중단)<br>\r\n<br>\r\n① \"몰\"은 컴퓨터 등 정보통신설비의 보수점검·교체 및 고장, 통신의 두절 등의 사유가 발생한 경우에는 서비스의 제공을 일시적으로 중단할 수 있습니다.<br>\r\n② \"몰\"은 제1항의 사유로 서비스의 제공이 일시적으로 중단됨으로 인하여 이용자 또는 제3자가 입은 손해에 대하여 배상합니다. 단, \"몰\"이 고의 또는 과실이 없음을 입증하는 경우에는 그러하지 아니합니다.<br>\r\n③ 사업종목의 전환, 사업의 포기, 업체간의 통합 등의 이유로 서비스를 제공할 수 없게 되는 경우에는 \"몰\"은 제8조에 정한 방법으로 이용자에게 통지하고 당초 \"몰\"에서 제시한 조건에 따라 소비자에게 보상합니다. 다만, \"몰\"이 보상기준 등을 고지하지 아니한 경우에는 이용자들의 마일리지 또는 적립금 등을 \"몰\"에서 통용되는 통화가치에 상응하는 현물 또는 현금으로 이용자에게 지급합니다.<br>\r\n<br>\r\n<br>\r\n제6조(회원가입)<br>\r\n<br>\r\n① 이용자는 \"몰\"이 정한 가입 양식에 따라 회원정보를 기입한 후 이 약관에 동의한다는 의사표시를 함으로서 회원가입을 신청합니다.<br>\r\n② \"몰\"은 제1항과 같이 회원으로 가입할 것을 신청한 이용자 중 다음 각호에 해당하지 않는 한 회원으로 등록합니다.<br>\r\n1. 가입신청자가 이 약관 제7조제3항에 의하여 이전에 회원자격을 상실한 적이 있는 경우, 다만 제7조제3항에 의한 회원자격 상실후 3년이 경과한 자로서 \"몰\"의 회원재가입 승낙을 얻은 경우에는 예외로 한다.<br>\r\n2. 등록 내용에 허위, 기재누락, 오기가 있는 경우<br>\r\n3. 기타 회원으로 등록하는 것이 \"몰\"의 기술상 현저히 지장이 있다고 판단되는 경우<br>\r\n③ 회원가입계약의 성립시기는 \"몰\"의 승낙이 회원에게 도달한 시점으로 합니다.<br>\r\n④ 회원은 제15조제1항에 의한 등록사항에 변경이 있는 경우, 즉시 전자우편 기타 방법으로 \"몰\"에 대하여 그 변경사항을 알려야 합니다.<br>\r\n<br>\r\n<br>\r\n제7조(회원 탈퇴 및 자격 상실 등)<br>\r\n<br>\r\n① 회원은 \"몰\"에 언제든지 탈퇴를 요청할 수 있으며 \"몰\"은 즉시 회원탈퇴를 처리합니다.<br>\r\n② 회원이 다음 각호의 사유에 해당하는 경우, \"몰\"은 회원자격을 제한 및 정지시킬 수 있습니다.<br>\r\n1. 가입 신청시에 허위 내용을 등록한 경우<br>\r\n2. \"몰\"을 이용하여 구입한 재화등의 대금, 기타 \"몰\"이용에 관련하여 회원이 부담하는 채무를 기일에 지급하지 않는 경우<br>\r\n3. 다른 사람의 \"몰\" 이용을 방해하거나 그 정보를 도용하는 등 전자상거래 질서를 위협하는 경우<br>\r\n4. \"몰\"을 이용하여 법령 또는 이 약관이 금지하거나 공서양속에 반하는 행위를 하는 경우<br>\r\n③ \"몰\"이 회원 자격을 제한·정지 시킨후, 동일한 행위가 2회이상 반복되거나 30일이내에 그 사유가 시정되지 아니하는 경우 \"몰\"은 회원자격을 상실시킬 수 있습니다.<br>\r\n④ \"몰\"이 회원자격을 상실시키는 경우에는 회원등록을 말소합니다. 이 경우 회원에게 이를 통지하고, 회원등록 말소전에 최소한 30일 이상의 기간을 정하여 소명할 기회를 부여합니다.<br>\r\n<br>\r\n<br>\r\n제8조(회원에 대한 통지)<br>\r\n<br>\r\n① \"몰\"이 회원에 대한 통지를 하는 경우, 회원이 \"몰\"과 미리 약정하여 지정한 전자우편 주소로 할 수 있습니다.<br>\r\n② \"몰\"은 불특정다수 회원에 대한 통지의 경우 1주일이상 \"몰\" 게시판에 게시함으로서 개별 통지에 갈음할 수 있습니다. 다만, 회원 본인의 거래와 관련하여 중대한 영향을 미치는 사항에 대하여는 개별통지를 합니다.<br>\r\n<br>\r\n<br>\r\n제9조(구매신청) \"몰\"이용자는 \"몰\"상에서 다음 또는 이와 유사한 방법에 의하여 구매를 신청하며, \"몰\"은 이용자가 구매신청을 함에 있어서 다음의 각 내용을 알기 쉽게 제공하여야 합니다.  단, 회원인 경우 제2호 내지 제4호의 적용을 제외할 수 있습니다.<br>\r\n1. 재화등의 검색 및 선택<br>\r\n2. 성명, 주소, 전화번호, 전자우편주소(또는 이동전화번호) 등의 입력<br>\r\n3. 약관내용, 청약철회권이 제한되는 서비스, 배송료·설치비 등의 비용부담과 관련한 내용에 대한 확인<br>\r\n4. 이 약관에 동의하고 위 3.호의 사항을 확인하거나 거부하는 표시(예, 마우스 클릭)<br>\r\n5. 재화등의 구매신청 및 이에 관한 확인 또는 \"몰\"의 확인에 대한 동의<br>\r\n6. 결제방법의 선택<br>\r\n<br>\r\n<br>\r\n제10조 (계약의 성립)<br>\r\n<br>\r\n①  \"몰\"은 제9조와 같은 구매신청에 대하여 다음 각호에 해당하면 승낙하지 않을 수 있습니다. 다만, 미성년자와 계약을 체결하는 경우에는 법정대리인의 동의를 얻지 못하면 미성년자 본인 또는 법정대리인이 계약을 취소할 수 있다는 내용을 고지하여야 합니다.<br>\r\n1. 신청 내용에 허위, 기재누락, 오기가 있는 경우<br>\r\n2. 미성년자가 담배, 주류등 청소년보호법에서 금지하는 재화 및 용역을 구매하는 경우<br>\r\n3. 기타 구매신청에 승낙하는 것이 \"몰\" 기술상 현저히 지장이 있다고 판단하는 경우<br>\r\n② \"몰\"의 승낙이 제12조제1항의 수신확인통지형태로 이용자에게 도달한 시점에 계약이 성립한 것으로 봅니다.<br>\r\n③ \"몰\"의 승낙의 의사표시에는 이용자의 구매 신청에 대한 확인 및 판매가능 여부, 구매신청의 정정 취소등에 관한 정보등을 포함하여야 합니다.<br>\r\n<br>\r\n<br>\r\n제11조(지급방법) \"몰\"에서 구매한 재화 또는 용역에 대한 대금지급방법은 다음 각호의 방법중 가용한 방법으로 할 수 있습니다. 단, \"몰\"은 이용자의 지급방법에 대하여 재화 등의 대금에 어떠한 명목의 수수료도  추가하여 징수할 수 없습니다.<br>\r\n1. 폰뱅킹, 인터넷뱅킹, 메일 뱅킹 등의 각종 계좌이체<br>\r\n2. 선불카드, 직불카드, 신용카드 등의 각종 카드 결제<br>\r\n3. 온라인무통장입금<br>\r\n4. 전자화폐에 의한 결제<br>\r\n5. 수령시 대금지급<br>\r\n6. 마일리지 등 \"몰\"이 지급한 포인트에 의한 결제<br>\r\n7. \"몰\"과 계약을 맺었거나 \"몰\"이 인정한 상품권에 의한 결제<br>\r\n8. 기타 전자적 지급 방법에 의한 대금 지급 등<br>\r\n<br>\r\n<br>\r\n제12조(수신확인통지·구매신청 변경 및 취소)<br>\r\n<br>\r\n① \"몰\"은 이용자의 구매신청이 있는 경우 이용자에게 수신확인통지를 합니다.<br>\r\n② 수신확인통지를 받은 이용자는 의사표시의 불일치등이 있는 경우에는 수신확인통지를 받은 후 즉시 구매신청 변경 및 취소를 요청할 수 있고 \"몰\"은 배송전에 이용자의 요청이 있는 경우에는 지체없이 그 요청에 따라 처리하여야 합니다. 다만 이미 대금을 지불한 경우에는 제15조의 청약철회 등에 관한 규정에 따릅니다.<br>\r\n<br>\r\n<br>\r\n제13조(재화등의 공급)<br>\r\n<br>\r\n① \"몰\"은 이용자와 재화등의 공급시기에 관하여 별도의 약정이 없는 이상, 이용자가 청약을 한 날부터 7일 이내에 재화 등을 배송할 수 있도록 주문제작, 포장 등 기타의 필요한 조치를 취합니다. 다만, \"몰\"이 이미 재화 등의 대금의 전부 또는 일부를 받은 경우에는 대금의 전부 또는 일부를 받은 날부터 2영업일 이내에 조치를 취합니다.  이때 \"몰\"은 이용자가 재화등의 공급 절차 및 진행 사항을 확인할 수 있도록 적절한 조치를 합니다.<br>\r\n② \"몰\"은 이용자가 구매한 재화에 대해 배송수단, 수단별 배송비용 부담자, 수단별 배송기간 등을 명시합니다. 만약 \"몰\"이 약정 배송기간을 초과한 경우에는 그로 인한 이용자의 손해를 배상하여야 합니다. 다만 \"몰\"이 고의·과실이 없음을 입증한 경우에는 그러하지 아니합니다.<br>\r\n<br>\r\n<br>\r\n제14조(환급)<br>\r\n<br>\r\n\"몰\"은 이용자가 구매신청한 재화등이 품절 등의 사유로 인도 또는 제공을 할 수 없을 때에는 지체없이 그 사유를 이용자에게 통지하고 사전에 재화 등의 대금을 받은 경우에는 대금을 받은 날부터 2영업일 이내에 환급하거나 환급에 필요한 조치를 취합니다.<br>\r\n<br>\r\n<br>\r\n제15조(청약철회 등)<br>\r\n<br>\r\n① \"몰\"과 재화등의 구매에 관한 계약을 체결한 이용자는 수신확인의 통지를 받은 날부터 7일 이내에는 청약의 철회를 할 수 있습니다.<br>\r\n② 이용자는 재화등을 배송받은 경우 다음 각호의 1에 해당하는 경우에는 반품 및 교환을 할 수 없습니다.<br>\r\n1. 이용자에게 책임 있는 사유로 재화 등이 멸실 또는 훼손된 경우(다만, 재화 등의 내용을 확인하기 위하여 포장 등을 훼손한 경우에는 청약철회를 할 수 있습니다)<br>\r\n2. 이용자의 사용 또는 일부 소비에 의하여 재화 등의 가치가 현저히 감소한 경우<br>\r\n3. 시간의 경과에 의하여 재판매가 곤란할 정도로 재화등의 가치가 현저히 감소한 경우<br>\r\n4. 같은 성능을 지닌 재화등으로 복제가 가능한 경우 그 원본인 재화 등의 포장을 훼손한 경우<br>\r\n③ 제2항제2호 내지 제4호의 경우에 \"몰\"이 사전에 청약철회 등이 제한되는 사실을 소비자가 쉽게 알 수 있는 곳에 명기하거나 시용상품을 제공하는 등의 조치를 하지 않았다면 이용자의 청약철회등이 제한되지 않습니다.<br>\r\n④ 이용자는 제1항 및 제2항의 규정에 불구하고 재화등의 내용이 표시·광고 내용과 다르거나 계약내용과 다르게 이행된 때에는 당해 재화등을 공급받은 날부터 3월이내, 그 사실을 안 날 또는 알 수 있었던 날부터 30일 이내에 청약철회 등을 할 수 있습니다.<br>\r\n<br>\r\n<br>\r\n제16조(청약철회 등의 효과)<br>\r\n<br>\r\n① \"몰\"은 이용자로부터 재화 등을 반환받은 경우 3영업일 이내에 이미 지급받은 재화등의 대금을 환급합니다. 이 경우 \"몰\"이 이용자에게 재화등의 환급을 지연한 때에는 그 지연기간에 대하여 공정거래위원회가 정하여 고시하는 지연이자율을 곱하여 산정한 지연이자를 지급합니다.<br>\r\n② \"몰\"은 위 대금을 환급함에 있어서 이용자가 신용카드 또는 전자화폐 등의 결제수단으로 재화등의 대금을 지급한 때에는 지체없이 당해 결제수단을 제공한 사업자로 하여금 재화등의 대금의 청구를 정지 또는 취소하도록 요청합니다.<br>\r\n③ 청약철회등의 경우 공급받은 재화등의 반환에 필요한 비용은 이용자가 부담합니다. \"몰\"은 이용자에게 청약철회등을 이유로 위약금 또는 손해배상을 청구하지 않습니다. 다만 재화등의 내용이 표시·광고 내용과 다르거나 계약내용과 다르게 이행되어 청약철회등을 하는 경우 재화등의 반환에 필요한 비용은 \"몰\"이 부담합니다.<br>\r\n④ 이용자가 재화등을 제공받을때 발송비를 부담한 경우에 \"몰\"은 청약철회시 그 비용을  누가 부담하는지를 이용자가 알기 쉽도록 명확하게 표시합니다.<br>\r\n<br>\r\n<br>\r\n제17조(개인정보보호)<br>\r\n<br>\r\n① \"몰\"은 이용자의 정보수집시 구매계약 이행에 필요한 최소한의 정보를 수집합니다. 다음 사항을 필수사항으로 하며 그 외 사항은 선택사항으로 합니다.<br>\r\n1. 성명<br>\r\n2. 주소<br>\r\n3. 전화번호<br>\r\n4. 희망ID(회원의 경우)<br>\r\n5. 비밀번호(회원의 경우)<br>\r\n6. 전자우편주소(또는 이동전화번호)<br>\r\n② \"몰\"이 이용자의 개인식별이 가능한 개인정보를 수집하는 때에는 반드시 당해 이용자의 동의를 받습니다.<br>\r\n③ 제공된 개인정보는 당해 이용자의 동의없이 목적외의 이용이나 제3자에게 제공할 수 없으며, 이에 대한 모든 책임은 몰이 집니다.  다만, 다음의 경우에는 예외로 합니다.<br>\r\n1. 배송업무상 배송업체에게 배송에 필요한 최소한의 이용자의 정보(성명, 주소, 전화번호)를 알려주는 경우<br>\r\n2. 통계작성, 학술연구 또는 시장조사를 위하여 필요한 경우로서 특정 개인을 식별할 수 없는 형태로 제공하는 경우<br>\r\n3. 재화등의 거래에 따른 대금정산을 위하여 필요한 경우<br>\r\n4. 도용방지를 위하여 본인확인에 필요한 경우<br>\r\n5. 법률의 규정 또는 법률에 의하여 필요한 불가피한 사유가 있는 경우<br>\r\n④ \"몰\"이 제2항과 제3항에 의해 이용자의 동의를 받아야 하는 경우에는 개인정보 보호책임자의 신원(소속, 성명 및 전화번호, 기타 연락처), 정보의 수집목적 및 이용목적, 제3자에 대한 정보제공 관련사항(제공받은자, 제공목적 및 제공할 정보의 내용) 등 정보통신망이용촉진등에관한법률 제22조제2항이 규정한 사항을 미리 명시하거나 고지해야 하며 이용자는 언제든지 이 동의를 철회할 수 있습니다.<br>\r\n⑤ 이용자는 언제든지 \"몰\"이 가지고 있는 자신의 개인정보에 대해 열람 및 오류정정을 요구할 수 있으며 \"몰\"은 이에 대해 지체없이 필요한 조치를 취할 의무를 집니다. 이용자가 오류의 정정을 요구한 경우에는 \"몰\"은 그 오류를 정정할 때까지 당해 개인정보를 이용하지 않습니다.<br>\r\n⑥ \"몰\"은 개인정보 보호를 위하여 관리자를 한정하여 그 수를 최소화하며 신용카드, 은행계좌 등을 포함한 이용자의 개인정보의 분실, 도난, 유출, 변조 등으로 인한 이용자의 손해에 대하여 모든 책임을  집니다.<br>\r\n⑦ \"몰\" 또는 그로부터 개인정보를 제공받은 제3자는 개인정보의 수집목적 또는 제공받은 목적을 달성한 때에는 당해 개인정보를 지체없이 파기합니다.<br>\r\n<br>\r\n<br>\r\n제18조(“몰“의 의무)<br>\r\n<br>\r\n① \"몰\"은 법령과 이 약관이 금지하거나 공서양속에 반하는 행위를 하지 않으며 이 약관이 정하는 바에 따라 지속적이고, 안정적으로 재화·용역을 제공하는데 최선을 다하여야 합니다.<br>\r\n② \"몰\"은 이용자가 안전하게 인터넷 서비스를 이용할 수 있도록 이용자의 개인정보(신용정보 포함)보호를 위한 보안 시스템을 갖추어야 합니다.<br>\r\n③ \"몰\"이 상품이나 용역에 대하여 「표시·광고의공정화에관한법률」 제3조 소정의 부당한 표시·광고행위를 함으로써 이용자가 손해를 입은 때에는 이를 배상할 책임을 집니다.<br>\r\n④ \"몰\"은 이용자가 원하지 않는 영리목적의 광고성 전자우편을 발송하지 않습니다.<br>\r\n<br>\r\n<br>\r\n제19조(회원의 ID 및 비밀번호에 대한 의무)<br>\r\n<br>\r\n① 제17조의 경우를 제외한 ID와 비밀번호에 관한 관리책임은 회원에게 있습니다.<br>\r\n② 회원은 자신의 ID 및 비밀번호를 제3자에게 이용하게 해서는 안됩니다.<br>\r\n③ 회원이 자신의 ID 및 비밀번호를 도난당하거나 제3자가 사용하고 있음을 인지한 경우에는 바로 \"몰\"에 통보하고 \"몰\"의 안내가 있는 경우에는 그에 따라야 합니다.<br>\r\n<br>\r\n<br>\r\n제20조(이용자의 의무) 이용자는 다음 행위를 하여서는 안됩니다.<br>\r\n1. 신청 또는 변경시 허위 내용의 등록<br>\r\n2. 타인의 정보 도용<br>\r\n3. \"몰\"에 게시된 정보의 변경<br>\r\n4. \"몰\"이 정한 정보 이외의 정보(컴퓨터 프로그램 등) 등의 송신 또는 게시<br>\r\n5. \"몰\" 기타 제3자의 저작권 등 지적재산권에 대한 침해<br>\r\n6. \"몰\" 기타 제3자의 명예를 손상시키거나 업무를 방해하는 행위<br>\r\n7. 외설 또는 폭력적인 메시지, 화상, 음성, 기타 공서양속에 반하는 정보를 몰에 공개 또는 게시하는 행위<br>\r\n<br>\r\n<br>\r\n제21조(연결\"몰\"과 피연결\"몰\" 간의 관계)<br>\r\n<br>\r\n① 상위 \"몰\"과 하위 \"몰\"이 하이퍼 링크(예: 하이퍼 링크의 대상에는 문자, 그림 및 동화상 등이 포함됨)방식 등으로 연결된 경우, 전자를 연결 \"몰\"(웹 사이트)이라고 하고 후자를 피연결 \"몰\"(웹사이트)이라고 합니다.<br>\r\n② 연결\"몰\"은 피연결\"몰\"이 독자적으로 제공하는 재화등에 의하여 이용자와 행하는 거래에 대해서 보증책임을 지지 않는다는 뜻을 연결\"몰\"의 초기화면 또는 연결되는 시점의 팝업화면으로 명시한 경우에는 그 거래에 대한 보증책임을 지지 않습니다.<br>\r\n<br>\r\n<br>\r\n제22조(저작권의 귀속 및 이용제한)<br>\r\n<br>\r\n① “몰“이 작성한 저작물에 대한 저작권 기타 지적재산권은 ”몰“에 귀속합니다.<br>\r\n② 이용자는 \"몰\"을 이용함으로써 얻은 정보 중 \"몰\"에게 지적재산권이 귀속된 정보를 \"몰\"의 사전 승낙없이 복제, 송신, 출판, 배포, 방송 기타 방법에 의하여 영리목적으로 이용하거나 제3자에게 이용하게 하여서는 안됩니다.<br>\r\n③ \"몰\"은 약정에 따라 이용자에게 귀속된 저작권을 사용하는 경우 당해 이용자에게 통보하여야 합니다.<br>\r\n<br>\r\n<br>\r\n제23조(분쟁해결)<br>\r\n<br>\r\n① \"몰\"은 이용자가 제기하는 정당한 의견이나 불만을 반영하고 그 피해를 보상처리하기 위하여 피해보상처리기구를 설치·운영합니다.<br>\r\n② \"몰\"은 이용자로부터 제출되는 불만사항 및 의견은 우선적으로 그 사항을 처리합니다. 다만, 신속한 처리가 곤란한 경우에는 이용자에게 그 사유와 처리일정을 즉시 통보해 드립니다.<br>\r\n③ \"몰\"과 이용자간에 발생한 전자상거래 분쟁과 관련하여 이용자의 피해구제신청이 있는 경우에는 공정거래위원회 또는 시·도지사가 의뢰하는 분쟁조정기관의 조정에 따를 수 있습니다.<br>\r\n<br>\r\n<br>\r\n제24조(재판권 및 준거법)<br>\r\n<br>\r\n① \"몰\"과 이용자간에 발생한 전자상거래 분쟁에 관한 소송은 제소 당시의 이용자의 주소에 의하고, 주소가 없는 경우에는 거소를 관할하는 지방법원의 전속관할로 합니다. 다만, 제소 당시 이용자의 주소 또는 거소가 분명하지 않거나 외국 거주자의 경우에는 민사소송법상의 관할법원에 제기합니다.<br>\r\n② \"몰\"과 이용자간에 제기된 전자상거래 소송에는 한국법을 적용합니다.<br>\r\n<br>\r\n<br>\r\n부칙<br>\r\n<br>\r\n1. 이 약관은 2019년 06월 05일부터 적용됩니다.<br>\r\n\r\n    </div>','서비스-이용약관','','basic','basic',1,0,'',''),('rating',1,'회원등급혜택','<table cellpadding=\"0\" cellspacing=\"0\">\r\n	<colgroup>\r\n		<col style=\"width:20%\">\r\n		<col style=\"width:40%\">\r\n		<col style=\"width:40%\">\r\n	</colgroup>\r\n	<caption>회원 등급 혜택</caption>\r\n	<thead>\r\n		<tr>\r\n			<th scope=\"col\" class=\"border_r\">회원 등급</th>\r\n			<th scope=\"col\" class=\"border_r\">등급 기준</th>\r\n			<th scope=\"col\">혜택</th>\r\n		</tr>\r\n	</thead>\r\n	<tbody>\r\n		<tr>\r\n			<td class=\"border_r border_b\"><span class=\"s\">SILVER</span></td>\r\n			<td class=\"border_r border_b\">신규 회원으로 등급 평가 시점 기준 50만원 미만 구매 고객</td>\r\n			<td class=\"border_b\">가입 축하금 1,000 + 구매 시 1% 적립</td>\r\n		</tr>\r\n		<tr>\r\n			<td class=\"border_r border_b\"><span class=\"g\">GOLD</span></td>\r\n			<td class=\"border_r border_b\">등급 평가 시점 기준 50만원 이상 ~ 100만원 미만 구매 고객</td>\r\n			<td class=\"border_b\">구매 시 2% 적립</td>\r\n		</tr>\r\n		<tr>\r\n			<td class=\"border_r border_b\"><span class=\"v\">VIP</span></td>\r\n			<td class=\"border_r border_b\">등급 평가 시점 기준 100만원 이상 ~ 150만원 미만 구매 고객</td>\r\n			<td class=\"border_b\">구매 시 3% 적립</td>\r\n		</tr>\r\n		<tr>\r\n			<td class=\"border_r border_b\"><span class=\"vv\">VVIP</span></td>\r\n			<td class=\"border_r border_b\">등급 평가 시점 기준 150만원 이상 구매 고객</td>\r\n			<td class=\"border_b\">구매 시 5% 적립</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n\r\n\r\n<ul>\r\n	<li>재팬데이 회원등급은 가입 시점과 상관 없이 상/하반기 6개월 실적 기준으로 2회 평가 운영합니다.</li>\r\n	<li>평가 시점 기준으로 새롭게 적용되는 회원등급의 혜택은 평가 익월에 새롭게 적용됩니다.</li>\r\n	<li>구매 금액은 배송비를 제외한 실제 구매 금액을 의미하며 구매 금액을 기준으로 적립금이 지급됩니다.</li>\r\n	<li>적립금은 회원 탈퇴 시에 소멸 및 삭제됩니다.</li>\r\n	<li>사용하지 않은 적립금은 반환되지 않습니다.</li>\r\n</ul>','회원등급혜택','','basic','basic',1,0,'',''),('service',1,'구매대행 안내','<div class=\"process\">\r\n	<ul><li><img src=\"/img/sub/imgProcess01.png\" alt=\"주문\"></li>\r\n		<li><img src=\"/img/sub/imgProcess02.png\" alt=\"구매대행\"></li>\r\n		<li><img src=\"/img/sub/imgProcess03.png\" alt=\"국제운송 및 수입통관\"></li>\r\n		<li><img src=\"/img/sub/imgProcess04.png\" alt=\"국내배송\"></li>\r\n	</ul></div>\r\n\r\n<p>재팬데이는 구매자의 요청에 따라 해외 상품 구매를 대행하는 중개 업체로서 상품의 재고를 일체 보유하고 있지 않으며, 고객 구매 요청 시 일본 현지 매장에서 상품 구입 후 상품 발송을 진행합니다. <br>\r\n이에 제품의 선택과 구매 책임은 구매대행 서비스 요청자(구매자)에게 있습니다.</p>\r\n\r\n<p>재팬데이는 관세청 고시를 준수하는 업체로서 일반 판매 사이트와는 차이점이 있으니, 구매 시 참조하시기 바랍니다.</p>\r\n<ul><li>반드시 자가소비 목적으로 구매가 가능하며, 자가소비로 인정되기 어려울 경우, 통관 시 혹은 사후에도 세금이 부과될 수 있습니다.</li>\r\n	<li>관세법에 의해 통관 시 수입자 및 납세의무자는 구매자(수취인)가 됩니다.</li>\r\n	<li>2014년 12월 1일부터 도로명주소 사용이 100% 의무입니다. 도로명주소가 아닌 경우 통관이 지연되거나 반송될 수 있습니다.</li>\r\n</ul>\r\n\r\n<p>구매 시 반드시 수위인 명의의 개인통관고유부호를 입력해야 통관이 진행됩니다. 개인통관고유부호는 개인 정보 유출을 방지하고자 주민등록번호 대신 사용하는 제도입니다.<br>\r\n2014년 12월부터 전면 시행되었습니다.(개인통관고유부호 미 입력 시 제품이 발송되지 않습니다.)</p>\r\n\r\n<p>상품 수취인의 연락처와 성함을 정확히 입력하여 주세요.</p>\r\n<ul><li>수취인 연락이 안 될 경우 세관에서 최대 2주 보관 후 제품이 폐기될 수 있습니다. 제반 모든 비용은 구매자가 부담하게 됩니다.</li>\r\n</ul>\r\n\r\n<p>재팬데이는 100% 일본 내수 정품 상품을 취급하며, 상품 상세페이지는 제조사 홈페이지 내용을 원문 번역하여 작성하였으며, 표현방식이 국내법이나 규정과 다소 차이가 있을 수 있습니다.<br>\r\n재팬데이는 해외 구매대행업체로 제품의 품질 및 성분을 보증하지 않습니다.<br>\r\n구매대행 가격에는 <strong>해외상품가격 + 현지 TAX  및 운임 + 국제운송료 + 통관수수료 + 국내배송료 + 구매대행 수수료</strong>가 포함되어 있습니다.<br>\r\n주문하신 상품은 FEDEX로 발송되며, 배송까지는 통상적으로 5~7일(최대 10일) 정도 소요 예상됩니다.(단, 일본 휴무일은 발송 불가능)<br>\r\n무게 기준 배송비는 제품의 패키지를 포함한 실물을 측정한 무게와 사이즈를 측정한 부피 무게 중에서 무게 값이 더 나가는 것으로 적용하여 배송비가 산정됩니다.<br>\r\n<u>해외배송 제품으로 <strong>국내 A/S는 불가능</strong>합니다.</u></p>\r\n\r\n\r\n\r\n<p>구매대행 시 유의사항은 아래 내용을 참조하여 주세요.</p>\r\n<ul><li>구매 금액은 배송비 제외 상품 금액 150＄(한화 17만원) 이내에서 면세입니다. 따라서 현재 환율 기준 (약 1＄=1,150원)으로 17만원 초과 시에는 관, 부가세가 발생하며 이를 구매자가 납부해야만 통관이 진행됩니다.</li>\r\n	<li>합산과세를 주의하세요. 동일한 명의로 수입통관이 이루어지므로 타 사이트 구매금액과 합산하여 동일한 시기에 위 기준 금액을 초과 시에 관, 부가세가 발생하니 이점을 참고하여 구매하여 주시기 바랍니다.</li>\r\n	<li>통관 기준 제한 품목 (의약품 최대 6개까지만 통관 가능) 등으로 문제 발생 시 통관이 안 될 수 있으니, 통관 시 주의사항을 반드시 참조해 주세요.</li>\r\n</ul>','구매대행-안내','','basic','basic',1,0,'',''),('tax',1,'통관시 주의사항','<h4>언더벨류 및 나눔 배송은 불법 행위입니다.</h4>\r\n<div class=\"bg\">\r\n	<h6>언더벨류</h6>\r\n	<p>관/부가세를 피하거나 적게 납부하기 위해 150＄에 구매했다고 가격을 허위 신고하는 \'언더벨류\' 역시 세관에서 가장 철저하게 금지하고 있는 항목입니다.<br>물품의 통관 시 위의 사례가 적발될 경우 과태료 부과 및 불이익이 발생할 수 있으니 특별히 주의해 주시기 바랍니다.</p>\r\n	<h6>나눔 배송</h6>\r\n	<p>쇼핑몰에서 한 번에 구매한 관/부가세 대상인 복수의 물품을 나누어서 배송을 받는 방법입니다.<br>예를 들면, 동시에 구매한 A 상품을 오늘 받고, B 상품은 내일 받는다고 신청하는 경우, 또는 A 상품은 본인 이름으로 받고 B 상품은 타인의 이름으로 받는 방식을 말합니다.<br>상기 예시처럼 따로따로 상품을 받아 관/부가세를 피하는 나눔 배송은 엄연한 불법 행위입니다.</p>\r\n</div>\r\n\r\n<h5>합산과세에 특별히 주의하세요.</h5>\r\n<div>\r\n	<p>합산과세란 같은 날 도착한 같은 구매자의 복수의 배송 건을 모두 한 건으로 간주하여 세금을 부과하는 것을 의미합니다. 구매대행으로 자가 사용 목적의 상품 구매 시에 미화 150＄(한화 환산 17만원) 이상의 금액에 대해서는 관세법에 따라 관세가 붙게 됩니다. 따라서 재팬데이에서 주문한 결제 건이 17만원 미만이라 하더라도 동일한 일자에 동일한 분의 성함으로 다른 곳에서 주문한 해외 상품이 들어오게 되면 두 건의 구매 금액을 합산하여 17만원 초과 시에는 관세가 붙습니다. 따라서, 해외 구매대행을 통한 쇼핑 시에는 먼저 결제한 배송 건이 통관 중으로 변경된 이후에 다음 주문 건을 결제하도록 권장하고 있습니다. 또한 다른 일자로 상품을 주문하였더라도 배송 사정에 의해 같은 날 국내에 도착하는 경우에도 합산과세가 발생하며 항공사의 사정으로 항공편이 지연되어 스케줄이 변경되는 경우에도 발생할 수 있으니 복수의 신청 건이 대기 중이라면 반드시 먼저 결제한 건이 통관된 것을 확인하시고 나머지 건을 결제해 주셔야 합산과세를 미연에 방지할 수 있습니다.</p>\r\n</div>\r\n\r\n<h5>건강보조식품류 구매전 체크 사항</h5>\r\n<div>\r\n	<p>재팬데이에서 취급하는 건강 보조식품류(영양제, 비타민 등)는 자가 사용 목적인 경우에만 용량에 관계없이 최대 6개까지만 통관이 가능합니다. 따라서 만약 6개를 초과하여 구매한 경우에는 카톤 분할 수수료와 폐기 수수료까지 지불하고 폐기 처리됩니다. 즉, 주문한 상품은 폐기 처리되고 수수료까지 물어야 하는 최악의 상황이 발생할 수 있으니, 반드시 통관 허용 수량을 체크하여 구매 부탁드립니다.</p>\r\n</div>\r\n\r\n<h5>카톤 분할 비용/폐기 처리 비용</h5>\r\n<div>\r\n	<p>재팬데이에서 취급하는 건강 보조식품류는 자가 사용 목적인 경우 용량에 관계없이 최대 6개까지만 통관이 가능하기에 6개를 초과한 경우에는 해당 상품은 폐기해야 하며, 통관이 가능한 6개와 초과한 폐기대상 상품들을 분리하는 과정이 생기는데 이때 발생하는 비용을 카톤 분할 비용이라고 합니다. 또한 물품을 폐기 처리할 때도 비용이 발생되며 이 비용 모두 구매자가 지불해야 통관이 가능함을 확인 바랍니다.</p>\r\n</div>\r\n\r\n<h5>통관 불가 품목 확인</h5>\r\n<div>\r\n	<p>일부 영양제, 건강식품, 반려동물용품 등에 국내 반입이 금지된 특정 성분을 함유하고 있을 경우에 통관이 불가능합니다. 따라서 특정 상품의 구매 전에 반드시 관세청(1577-8577), 인천세관, 식약처 등을 통하여 통관이 가능한 상품인지 확인 후 구매하시길 바랍니다.</p>\r\n</div>\r\n\r\n<h5>통관 소요시간 안내</h5>\r\n<div>\r\n	<p>일반적으로 재팬데이 일본 배송센터에서 상품을 발송한 후 1~2일 안에는 통관 조회가 가능하며, 통관에 소요되는 시간은 세관의 사정에 따라 빠르거나 다소 지연될 수 있습니다. 통상적으로는 반입 후 하루 만에 반출이 되지만, 통관 방식, 정보 미흡, 관/부가세 납부 여부 등에 따라 통관 지연이 발생할 수 있습니다. 통관 후에는 해당 일 오후 늦게 배송 업체로 상품이 인계되며, 일반적으로 통관이 완료된 익일 상품을 받아 보실 수 있습니다. 단, 주말이나 공휴일이 포함되어 있는 경우에는 다음 영업일에 배송 될 수 있습니다.</p>\r\n</div>\r\n\r\n\r\n<div class=\"text\">\r\n	재팬데이는 관세법 등 관련 규정을 준수하고 불법 물건을 취급하지 않으며 나눔 배송 및 가격 허위 신고 등 고객의 불법 사항 요청에는 협조하지 않습니다.<br>더불어 허위 신고로 인한 불이익에도 책임을 지지 않습니다. \r\n</div>','통관시-주의사항','','basic','basic',1,0,'','');
/*!40000 ALTER TABLE `g5_content` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `g5_faq`
--

DROP TABLE IF EXISTS `g5_faq`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `g5_faq` (
  `fa_id` int(11) NOT NULL AUTO_INCREMENT,
  `fm_id` int(11) NOT NULL DEFAULT '0',
  `fa_subject` text NOT NULL,
  `fa_content` text NOT NULL,
  `fa_order` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`fa_id`),
  KEY `fm_id` (`fm_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `g5_faq`
--

LOCK TABLES `g5_faq` WRITE;
/*!40000 ALTER TABLE `g5_faq` DISABLE KEYS */;
INSERT INTO `g5_faq` VALUES (3,2,'<p>구매대행안내 test<br></p>','<p>구매대행안내 test구매대행안내 test<br></p>',0);
/*!40000 ALTER TABLE `g5_faq` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `g5_faq_master`
--

DROP TABLE IF EXISTS `g5_faq_master`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `g5_faq_master` (
  `fm_id` int(11) NOT NULL AUTO_INCREMENT,
  `fm_subject` varchar(255) NOT NULL DEFAULT '',
  `fm_head_html` text NOT NULL,
  `fm_tail_html` text NOT NULL,
  `fm_mobile_head_html` text NOT NULL,
  `fm_mobile_tail_html` text NOT NULL,
  `fm_order` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`fm_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `g5_faq_master`
--

LOCK TABLES `g5_faq_master` WRITE;
/*!40000 ALTER TABLE `g5_faq_master` DISABLE KEYS */;
INSERT INTO `g5_faq_master` VALUES (2,'구매대행안내','','','','',1),(3,'회원/멤버쉽','','','','',2),(4,'주문/결제','','','','',4),(5,'배송','','','','',5),(6,'교환/반품/환불','','','','',6),(7,'기타','','','','',7);
/*!40000 ALTER TABLE `g5_faq_master` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `g5_group`
--

DROP TABLE IF EXISTS `g5_group`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `g5_group` (
  `gr_id` varchar(10) NOT NULL DEFAULT '',
  `gr_subject` varchar(255) NOT NULL DEFAULT '',
  `gr_device` enum('both','pc','mobile') NOT NULL DEFAULT 'both',
  `gr_admin` varchar(255) NOT NULL DEFAULT '',
  `gr_use_access` tinyint(4) NOT NULL DEFAULT '0',
  `gr_order` int(11) NOT NULL DEFAULT '0',
  `gr_1_subj` varchar(255) NOT NULL DEFAULT '',
  `gr_2_subj` varchar(255) NOT NULL DEFAULT '',
  `gr_3_subj` varchar(255) NOT NULL DEFAULT '',
  `gr_4_subj` varchar(255) NOT NULL DEFAULT '',
  `gr_5_subj` varchar(255) NOT NULL DEFAULT '',
  `gr_6_subj` varchar(255) NOT NULL DEFAULT '',
  `gr_7_subj` varchar(255) NOT NULL DEFAULT '',
  `gr_8_subj` varchar(255) NOT NULL DEFAULT '',
  `gr_9_subj` varchar(255) NOT NULL DEFAULT '',
  `gr_10_subj` varchar(255) NOT NULL DEFAULT '',
  `gr_1` varchar(255) NOT NULL DEFAULT '',
  `gr_2` varchar(255) NOT NULL DEFAULT '',
  `gr_3` varchar(255) NOT NULL DEFAULT '',
  `gr_4` varchar(255) NOT NULL DEFAULT '',
  `gr_5` varchar(255) NOT NULL DEFAULT '',
  `gr_6` varchar(255) NOT NULL DEFAULT '',
  `gr_7` varchar(255) NOT NULL DEFAULT '',
  `gr_8` varchar(255) NOT NULL DEFAULT '',
  `gr_9` varchar(255) NOT NULL DEFAULT '',
  `gr_10` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`gr_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `g5_group`
--

LOCK TABLES `g5_group` WRITE;
/*!40000 ALTER TABLE `g5_group` DISABLE KEYS */;
INSERT INTO `g5_group` VALUES ('shop','쇼핑몰','both','',0,0,'','','','','','','','','','','','','','','','','','','','');
/*!40000 ALTER TABLE `g5_group` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `g5_group_member`
--

DROP TABLE IF EXISTS `g5_group_member`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `g5_group_member` (
  `gm_id` int(11) NOT NULL AUTO_INCREMENT,
  `gr_id` varchar(255) NOT NULL DEFAULT '',
  `mb_id` varchar(20) NOT NULL DEFAULT '',
  `gm_datetime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`gm_id`),
  KEY `gr_id` (`gr_id`),
  KEY `mb_id` (`mb_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `g5_group_member`
--

LOCK TABLES `g5_group_member` WRITE;
/*!40000 ALTER TABLE `g5_group_member` DISABLE KEYS */;
/*!40000 ALTER TABLE `g5_group_member` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `g5_login`
--

DROP TABLE IF EXISTS `g5_login`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `g5_login` (
  `lo_ip` varchar(100) NOT NULL DEFAULT '',
  `mb_id` varchar(20) NOT NULL DEFAULT '',
  `lo_datetime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `lo_location` text NOT NULL,
  `lo_url` text NOT NULL,
  PRIMARY KEY (`lo_ip`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `g5_login`
--

LOCK TABLES `g5_login` WRITE;
/*!40000 ALTER TABLE `g5_login` DISABLE KEYS */;
INSERT INTO `g5_login` VALUES ('121.173.199.59','admin','2020-06-25 14:43:02','게시판그룹설정','');
/*!40000 ALTER TABLE `g5_login` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `g5_mail`
--

DROP TABLE IF EXISTS `g5_mail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `g5_mail` (
  `ma_id` int(11) NOT NULL AUTO_INCREMENT,
  `ma_subject` varchar(255) NOT NULL DEFAULT '',
  `ma_content` mediumtext NOT NULL,
  `ma_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `ma_ip` varchar(255) NOT NULL DEFAULT '',
  `ma_last_option` text NOT NULL,
  PRIMARY KEY (`ma_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `g5_mail`
--

LOCK TABLES `g5_mail` WRITE;
/*!40000 ALTER TABLE `g5_mail` DISABLE KEYS */;
INSERT INTO `g5_mail` VALUES (1,'TEST','<p>TESTTEST<br></p>','2020-05-28 11:25:26','121.173.199.59','');
/*!40000 ALTER TABLE `g5_mail` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `g5_member`
--

DROP TABLE IF EXISTS `g5_member`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `g5_member` (
  `mb_no` int(11) NOT NULL AUTO_INCREMENT,
  `mb_id` varchar(20) NOT NULL DEFAULT '',
  `mb_password` varchar(255) NOT NULL DEFAULT '',
  `mb_name` varchar(255) NOT NULL DEFAULT '',
  `mb_nick` varchar(255) NOT NULL DEFAULT '',
  `mb_nick_date` date NOT NULL DEFAULT '0000-00-00',
  `mb_email` varchar(255) NOT NULL DEFAULT '',
  `mb_homepage` varchar(255) NOT NULL DEFAULT '',
  `mb_level` tinyint(4) NOT NULL DEFAULT '0',
  `mb_sex` char(1) NOT NULL DEFAULT '',
  `mb_birth` varchar(255) NOT NULL DEFAULT '',
  `mb_tel` varchar(255) NOT NULL DEFAULT '',
  `mb_hp` varchar(255) NOT NULL DEFAULT '',
  `mb_certify` varchar(20) NOT NULL DEFAULT '',
  `mb_adult` tinyint(4) NOT NULL DEFAULT '0',
  `mb_dupinfo` varchar(255) NOT NULL DEFAULT '',
  `mb_zip1` char(3) NOT NULL DEFAULT '',
  `mb_zip2` char(3) NOT NULL DEFAULT '',
  `mb_addr1` varchar(255) NOT NULL DEFAULT '',
  `mb_addr2` varchar(255) NOT NULL DEFAULT '',
  `mb_addr3` varchar(255) NOT NULL DEFAULT '',
  `mb_addr_jibeon` varchar(255) NOT NULL DEFAULT '',
  `mb_signature` text NOT NULL,
  `mb_recommend` varchar(255) NOT NULL DEFAULT '',
  `mb_point` int(11) NOT NULL DEFAULT '0',
  `mb_today_login` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `mb_login_ip` varchar(255) NOT NULL DEFAULT '',
  `mb_datetime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `mb_ip` varchar(255) NOT NULL DEFAULT '',
  `mb_leave_date` varchar(8) NOT NULL DEFAULT '',
  `mb_intercept_date` varchar(8) NOT NULL DEFAULT '',
  `mb_email_certify` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `mb_email_certify2` varchar(255) NOT NULL DEFAULT '',
  `mb_memo` text NOT NULL,
  `mb_lost_certify` varchar(255) NOT NULL,
  `mb_mailling` tinyint(4) NOT NULL DEFAULT '0',
  `mb_sms` tinyint(4) NOT NULL DEFAULT '0',
  `mb_open` tinyint(4) NOT NULL DEFAULT '0',
  `mb_open_date` date NOT NULL DEFAULT '0000-00-00',
  `mb_profile` text NOT NULL,
  `mb_memo_call` varchar(255) NOT NULL DEFAULT '',
  `mb_memo_cnt` int(11) NOT NULL DEFAULT '0',
  `mb_scrap_cnt` int(11) NOT NULL DEFAULT '0',
  `mb_1` varchar(255) NOT NULL DEFAULT '',
  `mb_2` varchar(255) NOT NULL DEFAULT '',
  `mb_3` varchar(255) NOT NULL DEFAULT '',
  `mb_4` varchar(255) NOT NULL DEFAULT '',
  `mb_5` varchar(255) NOT NULL DEFAULT '',
  `mb_6` varchar(255) NOT NULL DEFAULT '',
  `mb_7` varchar(255) NOT NULL DEFAULT '',
  `mb_8` varchar(255) NOT NULL DEFAULT '',
  `mb_9` varchar(255) NOT NULL DEFAULT '',
  `mb_10` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`mb_no`),
  UNIQUE KEY `mb_id` (`mb_id`),
  KEY `mb_today_login` (`mb_today_login`),
  KEY `mb_datetime` (`mb_datetime`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `g5_member`
--

LOCK TABLES `g5_member` WRITE;
/*!40000 ALTER TABLE `g5_member` DISABLE KEYS */;
INSERT INTO `g5_member` VALUES (1,'admin','sha256:12000:uXV1a5KGB3cu0qyBeTVJ1EC+dp8TTloE:5+QN27GcAOaiDh+LqIatlOctEoBv9P7X','관리자','관리자','0000-00-00','admin@jp1.com','',10,'','','','','',0,'','','','','','','','','',3805,'2020-06-25 14:42:28','121.173.199.59','2020-03-25 01:31:09','58.224.133.171','','','2020-03-25 01:31:09','','','',1,0,1,'0000-00-00','','',0,0,'','','','','','','','','',''),(2,'ennieenka','','UYERBAATAR ENEREL','라멘','2020-05-20','','',1,'','','','','',0,'','','','','','','','','',1000,'2020-05-20 12:01:49','61.82.191.161','2020-05-20 12:01:49','61.82.191.161','20200520','','2020-05-20 12:01:49','','20200622 삭제함\n','',1,0,0,'2020-05-20','','',0,0,'','','','','','','','','','');
/*!40000 ALTER TABLE `g5_member` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `g5_member2`
--

DROP TABLE IF EXISTS `g5_member2`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `g5_member2` (
  `mb_no` int(11) NOT NULL AUTO_INCREMENT,
  `mb_id` varchar(20) NOT NULL DEFAULT '',
  `mb_password` varchar(255) NOT NULL DEFAULT '',
  `mb_name` varchar(255) NOT NULL DEFAULT '',
  `mb_nick` varchar(255) NOT NULL DEFAULT '',
  `mb_nick_date` date NOT NULL DEFAULT '0000-00-00',
  `mb_email` varchar(255) NOT NULL DEFAULT '',
  `mb_homepage` varchar(255) NOT NULL DEFAULT '',
  `mb_level` tinyint(4) NOT NULL DEFAULT '0',
  `mb_sex` char(1) NOT NULL DEFAULT '',
  `mb_birth` varchar(255) NOT NULL DEFAULT '',
  `mb_tel` varchar(255) NOT NULL DEFAULT '',
  `mb_hp` varchar(255) NOT NULL DEFAULT '',
  `mb_certify` varchar(20) NOT NULL DEFAULT '',
  `mb_adult` tinyint(4) NOT NULL DEFAULT '0',
  `mb_dupinfo` varchar(255) NOT NULL DEFAULT '',
  `mb_zip1` char(3) NOT NULL DEFAULT '',
  `mb_zip2` char(3) NOT NULL DEFAULT '',
  `mb_addr1` varchar(255) NOT NULL DEFAULT '',
  `mb_addr2` varchar(255) NOT NULL DEFAULT '',
  `mb_addr3` varchar(255) NOT NULL DEFAULT '',
  `mb_addr_jibeon` varchar(255) NOT NULL DEFAULT '',
  `mb_signature` text NOT NULL,
  `mb_recommend` varchar(255) NOT NULL DEFAULT '',
  `mb_point` int(11) NOT NULL DEFAULT '0',
  `mb_today_login` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `mb_login_ip` varchar(255) NOT NULL DEFAULT '',
  `mb_datetime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `mb_ip` varchar(255) NOT NULL DEFAULT '',
  `mb_leave_date` varchar(8) NOT NULL DEFAULT '',
  `mb_intercept_date` varchar(8) NOT NULL DEFAULT '',
  `mb_email_certify` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `mb_email_certify2` varchar(255) NOT NULL DEFAULT '',
  `mb_memo` text NOT NULL,
  `mb_lost_certify` varchar(255) NOT NULL,
  `mb_mailling` tinyint(4) NOT NULL DEFAULT '0',
  `mb_sms` tinyint(4) NOT NULL DEFAULT '0',
  `mb_open` tinyint(4) NOT NULL DEFAULT '0',
  `mb_open_date` date NOT NULL DEFAULT '0000-00-00',
  `mb_profile` text NOT NULL,
  `mb_memo_call` varchar(255) NOT NULL DEFAULT '',
  `mb_memo_cnt` int(11) NOT NULL DEFAULT '0',
  `mb_scrap_cnt` int(11) NOT NULL DEFAULT '0',
  `mb_1` varchar(255) NOT NULL DEFAULT '',
  `mb_2` varchar(255) NOT NULL DEFAULT '',
  `mb_3` varchar(255) NOT NULL DEFAULT '',
  `mb_4` varchar(255) NOT NULL DEFAULT '',
  `mb_5` varchar(255) NOT NULL DEFAULT '',
  `mb_6` varchar(255) NOT NULL DEFAULT '',
  `mb_7` varchar(255) NOT NULL DEFAULT '',
  `mb_8` varchar(255) NOT NULL DEFAULT '',
  `mb_9` varchar(255) NOT NULL DEFAULT '',
  `mb_10` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`mb_no`),
  UNIQUE KEY `mb_id` (`mb_id`),
  KEY `mb_today_login` (`mb_today_login`),
  KEY `mb_datetime` (`mb_datetime`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `g5_member2`
--

LOCK TABLES `g5_member2` WRITE;
/*!40000 ALTER TABLE `g5_member2` DISABLE KEYS */;
INSERT INTO `g5_member2` VALUES (1,'admin','$2y$06$zKbxaYsF.akKDsYUT1asU.7TN4IGoGTHmYArqRXZgeYAO64T9MuAy','관리자','관리자','0000-00-00','admin@jp1.com','',10,'','','','','',0,'','','','','','','','','',100,'2020-03-25 01:34:14','58.224.133.171','2020-03-25 01:31:09','58.224.133.171','','','2020-03-25 01:31:09','','','',1,0,1,'0000-00-00','','',0,0,'','','','','','','','','','');
/*!40000 ALTER TABLE `g5_member2` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `g5_member_social_profiles`
--

DROP TABLE IF EXISTS `g5_member_social_profiles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `g5_member_social_profiles` (
  `mp_no` int(11) NOT NULL AUTO_INCREMENT,
  `mb_id` varchar(255) NOT NULL DEFAULT '',
  `provider` varchar(50) NOT NULL DEFAULT '',
  `object_sha` varchar(45) NOT NULL DEFAULT '',
  `identifier` varchar(255) NOT NULL DEFAULT '',
  `profileurl` varchar(255) NOT NULL DEFAULT '',
  `photourl` varchar(255) NOT NULL DEFAULT '',
  `displayname` varchar(150) NOT NULL DEFAULT '',
  `description` varchar(255) NOT NULL DEFAULT '',
  `mp_register_day` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `mp_latest_day` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  UNIQUE KEY `mp_no` (`mp_no`),
  KEY `mb_id` (`mb_id`),
  KEY `provider` (`provider`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `g5_member_social_profiles`
--

LOCK TABLES `g5_member_social_profiles` WRITE;
/*!40000 ALTER TABLE `g5_member_social_profiles` DISABLE KEYS */;
/*!40000 ALTER TABLE `g5_member_social_profiles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `g5_memo`
--

DROP TABLE IF EXISTS `g5_memo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `g5_memo` (
  `me_id` int(11) NOT NULL AUTO_INCREMENT,
  `me_recv_mb_id` varchar(20) NOT NULL DEFAULT '',
  `me_send_mb_id` varchar(20) NOT NULL DEFAULT '',
  `me_send_datetime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `me_read_datetime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `me_memo` text NOT NULL,
  `me_send_id` int(11) NOT NULL DEFAULT '0',
  `me_type` enum('send','recv') NOT NULL DEFAULT 'recv',
  `me_send_ip` varchar(100) NOT NULL DEFAULT '',
  PRIMARY KEY (`me_id`),
  KEY `me_recv_mb_id` (`me_recv_mb_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `g5_memo`
--

LOCK TABLES `g5_memo` WRITE;
/*!40000 ALTER TABLE `g5_memo` DISABLE KEYS */;
/*!40000 ALTER TABLE `g5_memo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `g5_menu`
--

DROP TABLE IF EXISTS `g5_menu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `g5_menu` (
  `me_id` int(11) NOT NULL AUTO_INCREMENT,
  `me_code` varchar(255) NOT NULL DEFAULT '',
  `me_name` varchar(255) NOT NULL DEFAULT '',
  `me_link` varchar(255) NOT NULL DEFAULT '',
  `me_target` varchar(255) NOT NULL DEFAULT '',
  `me_order` int(11) NOT NULL DEFAULT '0',
  `me_use` tinyint(4) NOT NULL DEFAULT '0',
  `me_mobile_use` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`me_id`)
) ENGINE=InnoDB AUTO_INCREMENT=122 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `g5_menu`
--

LOCK TABLES `g5_menu` WRITE;
/*!40000 ALTER TABLE `g5_menu` DISABLE KEYS */;
INSERT INTO `g5_menu` VALUES (109,'10','고객센터','/bbs/board.php?bo_table=notice','self',0,1,1),(110,'1010','공지사항','/bbs/board.php?bo_table=notice','self',1,1,1),(111,'1020','구매대행 안내','/bbs/content.php?co_id=service','self',7,1,1),(112,'1030','관세/부가세 안내','/bbs/content.php?co_id=customs','self',8,1,1),(113,'1040','배송비안내','/bbs/content.php?co_id=delivery','self',9,1,1),(114,'1050','회원등급혜택','/bbs/content.php?co_id=rating','self',10,1,1),(115,'1060','통관시 주의사항','/bbs/content.php?co_id=tax','self',11,1,1),(116,'1070','일본 휴무일 안내','/bbs/content.php?co_id=holiday','self',12,1,1),(117,'1080','FAQ','/bbs/faq.php','self',2,1,1),(118,'1090','상품후기','/bbs/board.php?bo_table=review','self',3,1,1),(119,'10a0','상품문의','/bbs/board.php?bo_table=qa','self',4,1,1),(120,'10b0','1:1문의','/bbs/qalist.php','self',5,1,1),(121,'10c0','미확인입금내역','/bbs/board.php?bo_table=unidentified','self',6,1,1);
/*!40000 ALTER TABLE `g5_menu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `g5_new_win`
--

DROP TABLE IF EXISTS `g5_new_win`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `g5_new_win` (
  `nw_id` int(11) NOT NULL AUTO_INCREMENT,
  `nw_division` varchar(10) NOT NULL DEFAULT 'both',
  `nw_device` varchar(10) NOT NULL DEFAULT 'both',
  `nw_begin_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `nw_end_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `nw_disable_hours` int(11) NOT NULL DEFAULT '0',
  `nw_left` int(11) NOT NULL DEFAULT '0',
  `nw_top` int(11) NOT NULL DEFAULT '0',
  `nw_height` int(11) NOT NULL DEFAULT '0',
  `nw_width` int(11) NOT NULL DEFAULT '0',
  `nw_subject` text NOT NULL,
  `nw_content` text NOT NULL,
  `nw_content_html` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`nw_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `g5_new_win`
--

LOCK TABLES `g5_new_win` WRITE;
/*!40000 ALTER TABLE `g5_new_win` DISABLE KEYS */;
/*!40000 ALTER TABLE `g5_new_win` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `g5_point`
--

DROP TABLE IF EXISTS `g5_point`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `g5_point` (
  `po_id` int(11) NOT NULL AUTO_INCREMENT,
  `mb_id` varchar(20) NOT NULL DEFAULT '',
  `po_datetime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `po_content` varchar(255) NOT NULL DEFAULT '',
  `po_point` int(11) NOT NULL DEFAULT '0',
  `po_use_point` int(11) NOT NULL DEFAULT '0',
  `po_expired` tinyint(4) NOT NULL DEFAULT '0',
  `po_expire_date` date NOT NULL DEFAULT '0000-00-00',
  `po_mb_point` int(11) NOT NULL DEFAULT '0',
  `po_rel_table` varchar(20) NOT NULL DEFAULT '',
  `po_rel_id` varchar(20) NOT NULL DEFAULT '',
  `po_rel_action` varchar(100) NOT NULL DEFAULT '',
  PRIMARY KEY (`po_id`),
  KEY `index1` (`mb_id`,`po_rel_table`,`po_rel_id`,`po_rel_action`),
  KEY `index2` (`po_expire_date`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `g5_point`
--

LOCK TABLES `g5_point` WRITE;
/*!40000 ALTER TABLE `g5_point` DISABLE KEYS */;
INSERT INTO `g5_point` VALUES (1,'admin','2020-03-25 01:34:14','2020-03-25 첫로그인',100,0,0,'9999-12-31',100,'@login','admin','2020-03-25'),(2,'admin','2020-04-01 23:02:29','2020-04-01 첫로그인',100,0,0,'9999-12-31',200,'@login','admin','2020-04-01'),(3,'admin','2020-04-02 00:38:19','2020-04-02 첫로그인',100,0,0,'9999-12-31',300,'@login','admin','2020-04-02'),(4,'admin','2020-04-10 10:52:39','2020-04-10 첫로그인',100,0,0,'9999-12-31',400,'@login','admin','2020-04-10'),(5,'admin','2020-04-17 10:33:48','2020-04-17 첫로그인',100,0,0,'9999-12-31',500,'@login','admin','2020-04-17'),(6,'admin','2020-04-20 10:01:26','2020-04-20 첫로그인',100,0,0,'9999-12-31',600,'@login','admin','2020-04-20'),(7,'admin','2020-04-21 15:35:05','2020-04-21 첫로그인',100,0,0,'9999-12-31',700,'@login','admin','2020-04-21'),(8,'admin','2020-04-24 10:50:23','2020-04-24 첫로그인',100,0,0,'9999-12-31',800,'@login','admin','2020-04-24'),(9,'admin','2020-04-27 12:46:28','2020-04-27 첫로그인',100,0,0,'9999-12-31',900,'@login','admin','2020-04-27'),(10,'admin','2020-04-28 09:58:13','2020-04-28 첫로그인',100,0,0,'9999-12-31',1000,'@login','admin','2020-04-28'),(11,'admin','2020-04-29 11:09:20','2020-04-29 첫로그인',100,0,0,'9999-12-31',1100,'@login','admin','2020-04-29'),(12,'admin','2020-05-07 10:46:51','2020-05-07 첫로그인',100,0,0,'9999-12-31',1200,'@login','admin','2020-05-07'),(13,'admin','2020-05-08 11:25:29','2020-05-08 첫로그인',100,0,0,'9999-12-31',1300,'@login','admin','2020-05-08'),(14,'admin','2020-05-11 20:16:18','2020-05-11 첫로그인',100,0,0,'9999-12-31',1400,'@login','admin','2020-05-11'),(15,'admin','2020-05-12 17:07:16','2020-05-12 첫로그인',100,0,0,'9999-12-31',1500,'@login','admin','2020-05-12'),(16,'admin','2020-05-14 12:14:32','2020-05-14 첫로그인',100,0,0,'9999-12-31',1600,'@login','admin','2020-05-14'),(17,'admin','2020-05-18 09:52:36','2020-05-18 첫로그인',100,0,0,'9999-12-31',1700,'@login','admin','2020-05-18'),(18,'admin','2020-05-18 17:19:32','공지사항 1 글쓰기',5,0,0,'9999-12-31',1705,'notice','1','쓰기'),(19,'admin','2020-05-19 11:08:55','2020-05-19 첫로그인',100,0,0,'9999-12-31',1805,'@login','admin','2020-05-19'),(20,'admin','2020-05-20 09:04:02','2020-05-20 첫로그인',100,0,0,'9999-12-31',1905,'@login','admin','2020-05-20'),(22,'admin','2020-05-21 12:04:31','2020-05-21 첫로그인',100,0,0,'9999-12-31',2005,'@login','admin','2020-05-21'),(23,'admin','2020-05-22 10:39:50','2020-05-22 첫로그인',100,0,0,'9999-12-31',2105,'@login','admin','2020-05-22'),(24,'admin','2020-05-25 13:50:22','2020-05-25 첫로그인',100,0,0,'9999-12-31',2205,'@login','admin','2020-05-25'),(25,'admin','2020-05-26 13:46:50','2020-05-26 첫로그인',100,0,0,'9999-12-31',2305,'@login','admin','2020-05-26'),(26,'admin','2020-05-28 11:17:32','2020-05-28 첫로그인',100,0,0,'9999-12-31',2405,'@login','admin','2020-05-28'),(27,'admin','2020-05-29 14:41:46','2020-05-29 첫로그인',100,0,0,'9999-12-31',2505,'@login','admin','2020-05-29'),(28,'admin','2020-06-01 09:52:26','2020-06-01 첫로그인',100,0,0,'9999-12-31',2605,'@login','admin','2020-06-01'),(29,'admin','2020-06-03 10:22:37','2020-06-03 첫로그인',100,0,0,'9999-12-31',2705,'@login','admin','2020-06-03'),(30,'admin','2020-06-05 00:40:54','2020-06-05 첫로그인',100,0,0,'9999-12-31',2805,'@login','admin','2020-06-05'),(31,'admin','2020-06-06 22:10:13','2020-06-06 첫로그인',100,0,0,'9999-12-31',2905,'@login','admin','2020-06-06'),(32,'admin','2020-06-07 00:01:51','2020-06-07 첫로그인',100,0,0,'9999-12-31',3005,'@login','admin','2020-06-07'),(33,'admin','2020-06-08 00:10:29','2020-06-08 첫로그인',100,0,0,'9999-12-31',3105,'@login','admin','2020-06-08'),(34,'admin','2020-06-09 10:12:34','2020-06-09 첫로그인',100,0,0,'9999-12-31',3205,'@login','admin','2020-06-09'),(35,'admin','2020-06-11 10:14:04','2020-06-11 첫로그인',100,0,0,'9999-12-31',3305,'@login','admin','2020-06-11'),(36,'admin','2020-06-12 00:13:27','2020-06-12 첫로그인',100,0,0,'9999-12-31',3405,'@login','admin','2020-06-12'),(37,'admin','2020-06-22 13:45:47','2020-06-22 첫로그인',100,0,0,'9999-12-31',3505,'@login','admin','2020-06-22'),(38,'admin','2020-06-23 16:21:26','2020-06-23 첫로그인',100,0,0,'9999-12-31',3605,'@login','admin','2020-06-23'),(39,'admin','2020-06-24 21:46:59','2020-06-24 첫로그인',100,0,0,'9999-12-31',3705,'@login','admin','2020-06-24'),(40,'admin','2020-06-25 14:42:28','2020-06-25 첫로그인',100,0,0,'9999-12-31',3805,'@login','admin','2020-06-25');
/*!40000 ALTER TABLE `g5_point` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `g5_poll`
--

DROP TABLE IF EXISTS `g5_poll`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `g5_poll` (
  `po_id` int(11) NOT NULL AUTO_INCREMENT,
  `po_subject` varchar(255) NOT NULL DEFAULT '',
  `po_poll1` varchar(255) NOT NULL DEFAULT '',
  `po_poll2` varchar(255) NOT NULL DEFAULT '',
  `po_poll3` varchar(255) NOT NULL DEFAULT '',
  `po_poll4` varchar(255) NOT NULL DEFAULT '',
  `po_poll5` varchar(255) NOT NULL DEFAULT '',
  `po_poll6` varchar(255) NOT NULL DEFAULT '',
  `po_poll7` varchar(255) NOT NULL DEFAULT '',
  `po_poll8` varchar(255) NOT NULL DEFAULT '',
  `po_poll9` varchar(255) NOT NULL DEFAULT '',
  `po_cnt1` int(11) NOT NULL DEFAULT '0',
  `po_cnt2` int(11) NOT NULL DEFAULT '0',
  `po_cnt3` int(11) NOT NULL DEFAULT '0',
  `po_cnt4` int(11) NOT NULL DEFAULT '0',
  `po_cnt5` int(11) NOT NULL DEFAULT '0',
  `po_cnt6` int(11) NOT NULL DEFAULT '0',
  `po_cnt7` int(11) NOT NULL DEFAULT '0',
  `po_cnt8` int(11) NOT NULL DEFAULT '0',
  `po_cnt9` int(11) NOT NULL DEFAULT '0',
  `po_etc` varchar(255) NOT NULL DEFAULT '',
  `po_level` tinyint(4) NOT NULL DEFAULT '0',
  `po_point` int(11) NOT NULL DEFAULT '0',
  `po_date` date NOT NULL DEFAULT '0000-00-00',
  `po_ips` mediumtext NOT NULL,
  `mb_ids` text NOT NULL,
  PRIMARY KEY (`po_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `g5_poll`
--

LOCK TABLES `g5_poll` WRITE;
/*!40000 ALTER TABLE `g5_poll` DISABLE KEYS */;
/*!40000 ALTER TABLE `g5_poll` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `g5_poll_etc`
--

DROP TABLE IF EXISTS `g5_poll_etc`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `g5_poll_etc` (
  `pc_id` int(11) NOT NULL DEFAULT '0',
  `po_id` int(11) NOT NULL DEFAULT '0',
  `mb_id` varchar(20) NOT NULL DEFAULT '',
  `pc_name` varchar(255) NOT NULL DEFAULT '',
  `pc_idea` varchar(255) NOT NULL DEFAULT '',
  `pc_datetime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`pc_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `g5_poll_etc`
--

LOCK TABLES `g5_poll_etc` WRITE;
/*!40000 ALTER TABLE `g5_poll_etc` DISABLE KEYS */;
/*!40000 ALTER TABLE `g5_poll_etc` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `g5_popular`
--

DROP TABLE IF EXISTS `g5_popular`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `g5_popular` (
  `pp_id` int(11) NOT NULL AUTO_INCREMENT,
  `pp_word` varchar(50) NOT NULL DEFAULT '',
  `pp_date` date NOT NULL DEFAULT '0000-00-00',
  `pp_ip` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`pp_id`),
  UNIQUE KEY `index1` (`pp_date`,`pp_word`,`pp_ip`)
) ENGINE=InnoDB AUTO_INCREMENT=88 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `g5_popular`
--

LOCK TABLES `g5_popular` WRITE;
/*!40000 ALTER TABLE `g5_popular` DISABLE KEYS */;
INSERT INTO `g5_popular` VALUES (1,'샤론파스','2020-05-18','121.173.199.59'),(9,'카베진','2020-05-18','121.173.199.59'),(13,'곤약젤리','2020-05-19','121.173.199.59'),(12,'젤리','2020-05-19','121.173.199.59'),(14,'젤리','2020-05-19','61.82.191.161'),(10,'타마고','2020-05-19','121.173.199.59'),(11,'파스','2020-05-19','121.173.199.59'),(23,'간장된장고추장초장막장','2020-05-20','121.173.199.59'),(17,'곤약젤리','2020-05-20','61.82.191.161'),(24,'곤약젤리곤약젤리곤약젤리','2020-05-20','121.173.199.59'),(22,'데이','2020-05-20','121.173.199.59'),(18,'로션','2020-05-20','121.173.199.59'),(19,'스킨','2020-05-20','121.173.199.59'),(16,'이브','2020-05-20','61.82.191.161'),(21,'재팬','2020-05-20','121.173.199.59'),(25,'카레카레카레카레카레카레','2020-05-20','121.173.199.59'),(15,'카베진','2020-05-20','61.82.191.161'),(26,'샤론파스','2020-05-28','121.173.199.59'),(27,'카베진','2020-05-29','61.82.191.161'),(28,'파스','2020-06-03','211.202.43.197'),(30,'wpff','2020-06-06','125.182.12.32'),(32,'동전','2020-06-06','125.182.12.32'),(31,'젤리','2020-06-06','125.182.12.32'),(29,'파스','2020-06-06','125.182.12.32'),(33,'파스파스파스젤리젤리젤리','2020-06-06','125.182.12.32'),(34,'파스','2020-06-08','211.202.43.197'),(37,'곤약','2020-06-09','121.173.199.59'),(41,'바몬드','2020-06-09','121.173.199.59'),(53,'센카','2020-06-09','121.173.199.59'),(52,'시세이도','2020-06-09','121.173.199.59'),(39,'아이봉','2020-06-09','121.173.199.59'),(36,'오타이산','2020-06-09','121.173.199.59'),(38,'젤리','2020-06-09','121.173.199.59'),(44,'카레','2020-06-09','121.173.199.59'),(49,'카배진','2020-06-09','121.173.199.59'),(48,'카베진','2020-06-09','121.173.199.59'),(54,'퍼펙트','2020-06-09','121.173.199.59'),(40,'후리카게','2020-06-09','121.173.199.59'),(55,'휩','2020-06-09','121.173.199.59'),(56,'카베진','2020-06-10','121.173.199.59'),(70,'Ae','2020-06-11','121.173.199.59'),(63,'놋케루','2020-06-11','121.173.199.59'),(60,'동전파스','2020-06-11','121.173.199.59'),(61,'바몬드','2020-06-11','121.173.199.59'),(69,'샤론파스','2020-06-11','121.173.199.59'),(58,'샤론파스A','2020-06-11','121.173.199.59'),(66,'센카','2020-06-11','121.173.199.59'),(65,'시세이도','2020-06-11','121.173.199.59'),(57,'아이봉','2020-06-11','121.173.199.59'),(59,'오타이산','2020-06-11','121.173.199.59'),(62,'카레','2020-06-11','121.173.199.59'),(73,'카베진','2020-06-11','121.173.199.59'),(71,'타마고','2020-06-11','121.173.199.59'),(67,'퍼펙트','2020-06-11','121.173.199.59'),(64,'후리카게','2020-06-11','121.173.199.59'),(68,'휩','2020-06-11','121.173.199.59'),(79,'Ae','2020-06-12','58.224.133.171'),(76,'곤약젤리','2020-06-12','58.224.133.171'),(86,'동전파스','2020-06-12','121.173.199.59'),(78,'샤론파스','2020-06-12','58.224.133.171'),(85,'샤론파스A','2020-06-12','121.173.199.59'),(83,'아이봉','2020-06-12','121.173.199.59'),(77,'아이봉','2020-06-12','58.224.133.171'),(80,'카베진','2020-06-12','58.224.133.171');
/*!40000 ALTER TABLE `g5_popular` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `g5_qa_config`
--

DROP TABLE IF EXISTS `g5_qa_config`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `g5_qa_config` (
  `qa_title` varchar(255) NOT NULL DEFAULT '',
  `qa_category` varchar(255) NOT NULL DEFAULT '',
  `qa_skin` varchar(255) NOT NULL DEFAULT '',
  `qa_mobile_skin` varchar(255) NOT NULL DEFAULT '',
  `qa_use_email` tinyint(4) NOT NULL DEFAULT '0',
  `qa_req_email` tinyint(4) NOT NULL DEFAULT '0',
  `qa_use_hp` tinyint(4) NOT NULL DEFAULT '0',
  `qa_req_hp` tinyint(4) NOT NULL DEFAULT '0',
  `qa_use_sms` tinyint(4) NOT NULL DEFAULT '0',
  `qa_send_number` varchar(255) NOT NULL DEFAULT '0',
  `qa_admin_hp` varchar(255) NOT NULL DEFAULT '',
  `qa_admin_email` varchar(255) NOT NULL DEFAULT '',
  `qa_use_editor` tinyint(4) NOT NULL DEFAULT '0',
  `qa_subject_len` int(11) NOT NULL DEFAULT '0',
  `qa_mobile_subject_len` int(11) NOT NULL DEFAULT '0',
  `qa_page_rows` int(11) NOT NULL DEFAULT '0',
  `qa_mobile_page_rows` int(11) NOT NULL DEFAULT '0',
  `qa_image_width` int(11) NOT NULL DEFAULT '0',
  `qa_upload_size` int(11) NOT NULL DEFAULT '0',
  `qa_insert_content` text NOT NULL,
  `qa_include_head` varchar(255) NOT NULL DEFAULT '',
  `qa_include_tail` varchar(255) NOT NULL DEFAULT '',
  `qa_content_head` text NOT NULL,
  `qa_content_tail` text NOT NULL,
  `qa_mobile_content_head` text NOT NULL,
  `qa_mobile_content_tail` text NOT NULL,
  `qa_1_subj` varchar(255) NOT NULL DEFAULT '',
  `qa_2_subj` varchar(255) NOT NULL DEFAULT '',
  `qa_3_subj` varchar(255) NOT NULL DEFAULT '',
  `qa_4_subj` varchar(255) NOT NULL DEFAULT '',
  `qa_5_subj` varchar(255) NOT NULL DEFAULT '',
  `qa_1` varchar(255) NOT NULL DEFAULT '',
  `qa_2` varchar(255) NOT NULL DEFAULT '',
  `qa_3` varchar(255) NOT NULL DEFAULT '',
  `qa_4` varchar(255) NOT NULL DEFAULT '',
  `qa_5` varchar(255) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `g5_qa_config`
--

LOCK TABLES `g5_qa_config` WRITE;
/*!40000 ALTER TABLE `g5_qa_config` DISABLE KEYS */;
INSERT INTO `g5_qa_config` VALUES ('1:1문의','회원|포인트','basic','basic',1,0,1,0,0,'0','','',1,60,30,15,15,600,1048576,'','','','','','','','','','','','','','','','','');
/*!40000 ALTER TABLE `g5_qa_config` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `g5_qa_content`
--

DROP TABLE IF EXISTS `g5_qa_content`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `g5_qa_content` (
  `qa_id` int(11) NOT NULL AUTO_INCREMENT,
  `qa_num` int(11) NOT NULL DEFAULT '0',
  `qa_parent` int(11) NOT NULL DEFAULT '0',
  `qa_related` int(11) NOT NULL DEFAULT '0',
  `mb_id` varchar(20) NOT NULL DEFAULT '',
  `qa_name` varchar(255) NOT NULL DEFAULT '',
  `qa_email` varchar(255) NOT NULL DEFAULT '',
  `qa_hp` varchar(255) NOT NULL DEFAULT '',
  `qa_type` tinyint(4) NOT NULL DEFAULT '0',
  `qa_category` varchar(255) NOT NULL DEFAULT '',
  `qa_email_recv` tinyint(4) NOT NULL DEFAULT '0',
  `qa_sms_recv` tinyint(4) NOT NULL DEFAULT '0',
  `qa_html` tinyint(4) NOT NULL DEFAULT '0',
  `qa_subject` varchar(255) NOT NULL DEFAULT '',
  `qa_content` text NOT NULL,
  `qa_status` tinyint(4) NOT NULL DEFAULT '0',
  `qa_file1` varchar(255) NOT NULL DEFAULT '',
  `qa_source1` varchar(255) NOT NULL DEFAULT '',
  `qa_file2` varchar(255) NOT NULL DEFAULT '',
  `qa_source2` varchar(255) NOT NULL DEFAULT '',
  `qa_ip` varchar(255) NOT NULL DEFAULT '',
  `qa_datetime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `qa_1` varchar(255) NOT NULL DEFAULT '',
  `qa_2` varchar(255) NOT NULL DEFAULT '',
  `qa_3` varchar(255) NOT NULL DEFAULT '',
  `qa_4` varchar(255) NOT NULL DEFAULT '',
  `qa_5` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`qa_id`),
  KEY `qa_num_parent` (`qa_num`,`qa_parent`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `g5_qa_content`
--

LOCK TABLES `g5_qa_content` WRITE;
/*!40000 ALTER TABLE `g5_qa_content` DISABLE KEYS */;
/*!40000 ALTER TABLE `g5_qa_content` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `g5_scrap`
--

DROP TABLE IF EXISTS `g5_scrap`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `g5_scrap` (
  `ms_id` int(11) NOT NULL AUTO_INCREMENT,
  `mb_id` varchar(20) NOT NULL DEFAULT '',
  `bo_table` varchar(20) NOT NULL DEFAULT '',
  `wr_id` varchar(15) NOT NULL DEFAULT '',
  `ms_datetime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`ms_id`),
  KEY `mb_id` (`mb_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `g5_scrap`
--

LOCK TABLES `g5_scrap` WRITE;
/*!40000 ALTER TABLE `g5_scrap` DISABLE KEYS */;
/*!40000 ALTER TABLE `g5_scrap` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `g5_shop_banner`
--

DROP TABLE IF EXISTS `g5_shop_banner`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `g5_shop_banner` (
  `bn_id` int(11) NOT NULL AUTO_INCREMENT,
  `bn_alt` varchar(255) NOT NULL DEFAULT '',
  `bn_url` varchar(255) NOT NULL DEFAULT '',
  `bn_device` varchar(10) NOT NULL DEFAULT '',
  `bn_position` varchar(255) NOT NULL DEFAULT '',
  `bn_border` tinyint(4) NOT NULL DEFAULT '0',
  `bn_new_win` tinyint(4) NOT NULL DEFAULT '0',
  `bn_begin_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `bn_end_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `bn_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `bn_hit` int(11) NOT NULL DEFAULT '0',
  `bn_order` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`bn_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `g5_shop_banner`
--

LOCK TABLES `g5_shop_banner` WRITE;
/*!40000 ALTER TABLE `g5_shop_banner` DISABLE KEYS */;
INSERT INTO `g5_shop_banner` VALUES (1,'일본 국민 위장약 카베진 코와 알파 100정/200정/300정-양배추 성분으로 편안하게~','/shop/search.php?q=카베진','pc','메인',0,0,'2020-04-24 00:00:00','2022-06-25 23:59:59','0000-00-00 00:00:00',2,1),(2,'','/shop/search.php?q=카베진','pc','메인',0,0,'2020-04-24 00:00:00','2022-05-25 00:00:00','0000-00-00 00:00:00',3,50),(3,'','/shop/search.php?q=카베진','mobile','메인',0,0,'2020-06-06 00:00:00','2022-07-07 00:00:00','0000-00-00 00:00:00',0,50),(4,'','/shop/search.php?q=카베진','mobile','메인',0,0,'2020-06-06 00:00:00','2022-07-07 00:00:00','0000-00-00 00:00:00',0,50);
/*!40000 ALTER TABLE `g5_shop_banner` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `g5_shop_cart`
--

DROP TABLE IF EXISTS `g5_shop_cart`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `g5_shop_cart` (
  `ct_id` int(11) NOT NULL AUTO_INCREMENT,
  `od_id` bigint(20) unsigned NOT NULL,
  `mb_id` varchar(255) NOT NULL DEFAULT '',
  `it_id` varchar(20) NOT NULL DEFAULT '',
  `it_name` varchar(255) NOT NULL DEFAULT '',
  `it_sc_type` tinyint(4) NOT NULL DEFAULT '0',
  `it_sc_method` tinyint(4) NOT NULL DEFAULT '0',
  `it_sc_price` int(11) NOT NULL DEFAULT '0',
  `it_sc_minimum` int(11) NOT NULL DEFAULT '0',
  `it_sc_qty` int(11) NOT NULL DEFAULT '0',
  `ct_status` varchar(255) NOT NULL DEFAULT '',
  `ct_history` text NOT NULL,
  `ct_price` int(11) NOT NULL DEFAULT '0',
  `ct_point` int(11) NOT NULL DEFAULT '0',
  `cp_price` int(11) NOT NULL DEFAULT '0',
  `ct_point_use` tinyint(4) NOT NULL DEFAULT '0',
  `ct_stock_use` tinyint(4) NOT NULL DEFAULT '0',
  `ct_option` varchar(255) NOT NULL DEFAULT '',
  `ct_qty` int(11) NOT NULL DEFAULT '0',
  `ct_notax` tinyint(4) NOT NULL DEFAULT '0',
  `io_id` varchar(255) NOT NULL DEFAULT '',
  `io_type` tinyint(4) NOT NULL DEFAULT '0',
  `io_price` int(11) NOT NULL DEFAULT '0',
  `ct_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `ct_ip` varchar(25) NOT NULL DEFAULT '',
  `ct_send_cost` tinyint(4) NOT NULL DEFAULT '0',
  `ct_direct` tinyint(4) NOT NULL DEFAULT '0',
  `ct_select` tinyint(4) NOT NULL DEFAULT '0',
  `ct_select_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`ct_id`),
  KEY `od_id` (`od_id`),
  KEY `it_id` (`it_id`),
  KEY `ct_status` (`ct_status`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `g5_shop_cart`
--

LOCK TABLES `g5_shop_cart` WRITE;
/*!40000 ALTER TABLE `g5_shop_cart` DISABLE KEYS */;
INSERT INTO `g5_shop_cart` VALUES (16,2020061201434084,'admin','1589775637','아사히 에비오스 1200/2000정',4,0,10000,0,6,'주문','',34050,0,0,0,0,'아사히 에비오스 1200/2000정',6,0,'',0,0,'2020-06-12 01:33:08','58.224.133.171',0,0,1,'2020-06-12 01:41:56'),(19,2020061201515189,'admin','1588926247','히사미츠 샤론파스A',4,0,20000,0,6,'주문','',7300,0,0,0,0,'히사미츠 샤론파스A',7,0,'',0,0,'2020-06-12 01:51:46','58.224.133.171',0,0,1,'2020-06-12 01:51:51'),(29,2020061201503681,'admin','1589775430','EVE 이브 퀵 40정 일본 두통약',0,0,0,0,0,'쇼핑','',22200,0,0,0,0,'EVE 이브 퀵 40정 일본 두통약',1,0,'',0,0,'2020-06-12 02:57:52','58.224.133.171',0,1,0,'2020-06-12 02:57:52'),(30,2020061209294172,'','1589775430','EVE 이브 퀵 40정 일본 두통약',0,0,0,0,0,'주문','',22200,0,0,0,0,'EVE 이브 퀵 40정 일본 두통약',1,0,'',0,0,'2020-06-12 09:29:35','121.173.199.59',0,1,1,'2020-06-12 09:29:35'),(31,2020061209310662,'','1588909839','반테린 코와 파스 액체 EX 90g',0,0,0,0,0,'쇼핑','',30300,0,0,0,0,'반테린 코와 파스 액체 EX 90g',6,0,'',0,0,'2020-06-12 09:31:06','121.173.199.59',0,1,0,'2020-06-12 09:31:06'),(32,2020061209310969,'','1588909839','반테린 코와 파스 액체 EX 90g',0,0,0,0,0,'쇼핑','',30300,0,0,0,0,'반테린 코와 파스 액체 EX 90g',6,0,'',0,0,'2020-06-12 09:31:09','121.173.199.59',0,0,0,'0000-00-00 00:00:00'),(34,2020061209310969,'','1589775637','아사히 에비오스 1200/2000정',4,0,10000,0,6,'쇼핑','',34050,0,0,0,0,'아사히 에비오스 1200/2000정',7,0,'',0,0,'2020-06-12 09:32:11','121.173.199.59',0,0,0,'0000-00-00 00:00:00');
/*!40000 ALTER TABLE `g5_shop_cart` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `g5_shop_category`
--

DROP TABLE IF EXISTS `g5_shop_category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `g5_shop_category` (
  `ca_id` varchar(10) NOT NULL DEFAULT '0',
  `ca_name` varchar(255) NOT NULL DEFAULT '',
  `ca_order` int(11) NOT NULL DEFAULT '0',
  `ca_skin_dir` varchar(255) NOT NULL DEFAULT '',
  `ca_mobile_skin_dir` varchar(255) NOT NULL DEFAULT '',
  `ca_skin` varchar(255) NOT NULL DEFAULT '',
  `ca_mobile_skin` varchar(255) NOT NULL DEFAULT '',
  `ca_img_width` int(11) NOT NULL DEFAULT '0',
  `ca_img_height` int(11) NOT NULL DEFAULT '0',
  `ca_mobile_img_width` int(11) NOT NULL DEFAULT '0',
  `ca_mobile_img_height` int(11) NOT NULL DEFAULT '0',
  `ca_sell_email` varchar(255) NOT NULL DEFAULT '',
  `ca_use` tinyint(4) NOT NULL DEFAULT '0',
  `ca_stock_qty` int(11) NOT NULL DEFAULT '0',
  `ca_explan_html` tinyint(4) NOT NULL DEFAULT '0',
  `ca_head_html` text NOT NULL,
  `ca_tail_html` text NOT NULL,
  `ca_mobile_head_html` text NOT NULL,
  `ca_mobile_tail_html` text NOT NULL,
  `ca_list_mod` int(11) NOT NULL DEFAULT '0',
  `ca_list_row` int(11) NOT NULL DEFAULT '0',
  `ca_mobile_list_mod` int(11) NOT NULL DEFAULT '0',
  `ca_mobile_list_row` int(11) NOT NULL DEFAULT '0',
  `ca_include_head` varchar(255) NOT NULL DEFAULT '',
  `ca_include_tail` varchar(255) NOT NULL DEFAULT '',
  `ca_mb_id` varchar(255) NOT NULL DEFAULT '',
  `ca_cert_use` tinyint(4) NOT NULL DEFAULT '0',
  `ca_adult_use` tinyint(4) NOT NULL DEFAULT '0',
  `ca_nocoupon` tinyint(4) NOT NULL DEFAULT '0',
  `ca_1_subj` varchar(255) NOT NULL DEFAULT '',
  `ca_2_subj` varchar(255) NOT NULL DEFAULT '',
  `ca_3_subj` varchar(255) NOT NULL DEFAULT '',
  `ca_4_subj` varchar(255) NOT NULL DEFAULT '',
  `ca_5_subj` varchar(255) NOT NULL DEFAULT '',
  `ca_6_subj` varchar(255) NOT NULL DEFAULT '',
  `ca_7_subj` varchar(255) NOT NULL DEFAULT '',
  `ca_8_subj` varchar(255) NOT NULL DEFAULT '',
  `ca_9_subj` varchar(255) NOT NULL DEFAULT '',
  `ca_10_subj` varchar(255) NOT NULL DEFAULT '',
  `ca_1` varchar(255) NOT NULL DEFAULT '',
  `ca_2` varchar(255) NOT NULL DEFAULT '',
  `ca_3` varchar(255) NOT NULL DEFAULT '',
  `ca_4` varchar(255) NOT NULL DEFAULT '',
  `ca_5` varchar(255) NOT NULL DEFAULT '',
  `ca_6` varchar(255) NOT NULL DEFAULT '',
  `ca_7` varchar(255) NOT NULL DEFAULT '',
  `ca_8` varchar(255) NOT NULL DEFAULT '',
  `ca_9` varchar(255) NOT NULL DEFAULT '',
  `ca_10` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`ca_id`),
  KEY `ca_order` (`ca_order`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `g5_shop_category`
--

LOCK TABLES `g5_shop_category` WRITE;
/*!40000 ALTER TABLE `g5_shop_category` DISABLE KEYS */;
INSERT INTO `g5_shop_category` VALUES ('10','회원특가',0,'basic','basic','list.10.skin.php','list.10.skin.php',230,230,230,230,'',1,99999,1,'','','','',4,5,2,5,'','','',0,0,0,'','','','','','','','','','','','','','','','','','','',''),('20','베스트',0,'basic','basic','list.10.skin.php','list.10.skin.php',230,230,230,230,'',1,99999,1,'','','','',4,5,2,5,'','','',0,0,0,'','','','','','','','','','','','','','','','','','','',''),('30','기획전',0,'basic','basic','list.10.skin.php','list.10.skin.php',230,230,230,230,'',1,99999,1,'','','','',4,5,2,5,'','','',0,0,0,'','','','','','','','','','','','','','','','','','','',''),('40','건강용품',0,'basic','basic','list.10.skin.php','list.10.skin.php',230,230,230,230,'',1,99999,1,'','','','',4,5,2,5,'','','',0,0,0,'','','','','','','','','','','','','','','','','','','',''),('4010','비타민/영양제',0,'basic','basic','list.10.skin.php','list.10.skin.php',230,230,230,230,'',1,99999,1,'','','','',4,5,2,5,'','','',0,0,0,'','','','','','','','','','','','','','','','','','','',''),('4020','어린이 관련',0,'basic','basic','list.10.skin.php','list.10.skin.php',230,230,230,230,'',1,99999,1,'','','','',4,5,2,5,'','','',0,0,0,'','','','','','','','','','','','','','','','','','','',''),('4030','눈/코/입',0,'basic','basic','list.10.skin.php','list.10.skin.php',230,230,230,230,'',1,99999,1,'','','','',4,5,2,5,'','','',0,0,0,'','','','','','','','','','','','','','','','','','','',''),('4040','무좀',0,'basic','basic','list.10.skin.php','list.10.skin.php',230,230,230,230,'',1,99999,1,'','','','',4,5,2,5,'','','',0,0,0,'','','','','','','','','','','','','','','','','','','',''),('4050','장/소화',0,'basic','basic','list.10.skin.php','list.10.skin.php',230,230,230,230,'',1,99999,1,'','','','',4,5,2,5,'','','',0,0,0,'','','','','','','','','','','','','','','','','','','',''),('4060','여성/두통/변비',0,'basic','basic','list.10.skin.php','list.10.skin.php',230,230,230,230,'',1,99999,1,'','','','',4,5,2,5,'','','',0,0,0,'','','','','','','','','','','','','','','','','','','',''),('4070','피부',0,'basic','basic','list.10.skin.php','list.10.skin.php',230,230,230,230,'',1,99999,1,'','','','',4,5,2,5,'','','',0,0,0,'','','','','','','','','','','','','','','','','','','',''),('4080','파스/통증',0,'basic','basic','list.10.skin.php','list.10.skin.php',230,230,230,230,'',1,99999,1,'','','','',4,5,2,5,'','','',0,0,0,'','','','','','','','','','','','','','','','','','','',''),('50','서플리먼트',0,'basic','basic','list.10.skin.php','list.10.skin.php',230,230,230,230,'',1,99999,1,'','','','',4,5,2,5,'','','',0,0,0,'','','','','','','','','','','','','','','','','','','',''),('5010','다이어트식품',0,'basic','basic','list.10.skin.php','list.10.skin.php',230,230,230,230,'',1,99999,1,'','','','',4,5,2,5,'','','',0,0,0,'','','','','','','','','','','','','','','','','','','',''),('5020','건강기능식품',0,'basic','basic','list.10.skin.php','list.10.skin.php',230,230,230,230,'',1,99999,1,'','','','',4,5,2,5,'','','',0,0,0,'','','','','','','','','','','','','','','','','','','',''),('60','뷰티용품',0,'','','list.10.skin.php','list.10.skin.php',230,230,230,230,'',1,99999,1,'','','','',4,5,3,5,'','','',0,0,0,'','','','','','','','','','','','','','','','','','','',''),('6010','클렌징/필링',0,'','','list.10.skin.php','list.10.skin.php',230,230,230,230,'',1,99999,1,'','','','',4,5,3,5,'','','',0,0,0,'','','','','','','','','','','','','','','','','','','',''),('6020','스킨케어',0,'','','list.10.skin.php','list.10.skin.php',230,230,230,230,'',1,99999,1,'','','','',4,5,3,5,'','','',0,0,0,'','','','','','','','','','','','','','','','','','','',''),('6030','바디케어',0,'','','list.10.skin.php','list.10.skin.php',230,230,230,230,'',1,99999,1,'','','','',4,5,3,5,'','','',0,0,0,'','','','','','','','','','','','','','','','','','','',''),('6040','썬케어',0,'','','list.10.skin.php','list.10.skin.php',230,230,230,230,'',1,99999,1,'','','','',4,5,3,5,'','','',0,0,0,'','','','','','','','','','','','','','','','','','','',''),('6050','남성케어',0,'','','list.10.skin.php','list.10.skin.php',230,230,230,230,'',1,99999,1,'','','','',4,5,3,5,'','','',0,0,0,'','','','','','','','','','','','','','','','','','','',''),('6060','헤어케어',0,'','','list.10.skin.php','list.10.skin.php',230,230,230,230,'',1,99999,1,'','','','',4,5,3,5,'','','',0,0,0,'','','','','','','','','','','','','','','','','','','',''),('6070','팩/마스크',0,'','','list.10.skin.php','list.10.skin.php',230,230,230,230,'',1,99999,1,'','','','',4,5,3,5,'','','',0,0,0,'','','','','','','','','','','','','','','','','','','',''),('6080','미용소품',0,'','','list.10.skin.php','list.10.skin.php',230,230,230,230,'',1,99999,1,'','','','',4,5,3,5,'','','',0,0,0,'','','','','','','','','','','','','','','','','','','',''),('70','식품/차/커피',0,'','','list.10.skin.php','list.10.skin.php',230,230,230,230,'',1,99999,1,'','','','',4,5,3,5,'','','',0,0,0,'','','','','','','','','','','','','','','','','','','',''),('7010','곤약/젤리',0,'','','list.10.skin.php','list.10.skin.php',230,230,230,230,'',1,99999,1,'','','','',4,5,3,5,'','','',0,0,0,'','','','','','','','','','','','','','','','','','','',''),('7020','라면',0,'','','list.10.skin.php','list.10.skin.php',230,230,230,230,'',1,99999,1,'','','','',4,5,3,5,'','','',0,0,0,'','','','','','','','','','','','','','','','','','','',''),('7030','과자/간식/캔디/껌',0,'','','list.10.skin.php','list.10.skin.php',230,230,230,230,'',1,99999,1,'','','','',4,5,3,5,'','','',0,0,0,'','','','','','','','','','','','','','','','','','','',''),('7040','초콜렛',0,'','','list.10.skin.php','list.10.skin.php',230,230,230,230,'',1,99999,1,'','','','',4,5,3,5,'','','',0,0,0,'','','','','','','','','','','','','','','','','','','',''),('7050','음료/커피',0,'','','list.10.skin.php','list.10.skin.php',230,230,230,230,'',1,99999,1,'','','','',4,5,3,5,'','','',0,0,0,'','','','','','','','','','','','','','','','','','','',''),('7060','소스류',0,'','','list.10.skin.php','list.10.skin.php',230,230,230,230,'',1,99999,1,'','','','',4,5,3,5,'','','',0,0,0,'','','','','','','','','','','','','','','','','','','',''),('7070','간편조리',0,'','','list.10.skin.php','list.10.skin.php',230,230,230,230,'',1,99999,1,'','','','',4,5,3,5,'','','',0,0,0,'','','','','','','','','','','','','','','','','','','',''),('7080','기타',0,'','','list.10.skin.php','list.10.skin.php',230,230,230,230,'',1,99999,1,'','','','',4,5,3,5,'','','',0,0,0,'','','','','','','','','','','','','','','','','','','',''),('80','생활용품',0,'','','list.10.skin.php','list.10.skin.php',230,230,230,230,'',1,99999,1,'','','','',4,5,3,5,'','','',0,0,0,'','','','','','','','','','','','','','','','','','','',''),('8010','주방용품',0,'','','list.10.skin.php','list.10.skin.php',230,230,230,230,'',1,99999,1,'','','','',4,5,3,5,'','','',0,0,0,'','','','','','','','','','','','','','','','','','','',''),('8020','주방/세탁세제',0,'','','list.10.skin.php','list.10.skin.php',230,230,230,230,'',1,99999,1,'','','','',4,5,3,5,'','','',0,0,0,'','','','','','','','','','','','','','','','','','','',''),('8030','욕실/화장실용품',0,'','','list.10.skin.php','list.10.skin.php',230,230,230,230,'',1,99999,1,'','','','',4,5,3,5,'','','',0,0,0,'','','','','','','','','','','','','','','','','','','',''),('8040','생활용품',0,'','','list.10.skin.php','list.10.skin.php',230,230,230,230,'',1,99999,1,'','','','',4,5,3,5,'','','',0,0,0,'','','','','','','','','','','','','','','','','','','',''),('8050','치약/구강용품',0,'','','list.10.skin.php','list.10.skin.php',230,230,230,230,'',1,99999,1,'','','','',4,5,3,5,'','','',0,0,0,'','','','','','','','','','','','','','','','','','','',''),('8060','유아/어린이용품',0,'','','list.10.skin.php','list.10.skin.php',230,230,230,230,'',1,99999,1,'','','','',4,5,3,5,'','','',0,0,0,'','','','','','','','','','','','','','','','','','','',''),('90','세트할인',0,'','','list.10.skin.php','list.10.skin.php',230,230,230,230,'',1,99999,1,'','','','',4,5,3,5,'','','',0,0,0,'','','','','','','','','','','','','','','','','','','',''),('a0','이벤트',0,'','','list.10.skin.php','list.10.skin.php',230,230,230,230,'',1,99999,1,'','','','',4,5,3,5,'','','',0,0,0,'','','','','','','','','','','','','','','','','','','','');
/*!40000 ALTER TABLE `g5_shop_category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `g5_shop_coupon`
--

DROP TABLE IF EXISTS `g5_shop_coupon`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `g5_shop_coupon` (
  `cp_no` int(11) NOT NULL AUTO_INCREMENT,
  `cp_id` varchar(100) NOT NULL DEFAULT '',
  `cp_subject` varchar(255) NOT NULL DEFAULT '',
  `cp_method` tinyint(4) NOT NULL DEFAULT '0',
  `cp_target` varchar(255) NOT NULL DEFAULT '',
  `mb_id` varchar(255) NOT NULL DEFAULT '',
  `cz_id` int(11) NOT NULL DEFAULT '0',
  `cp_start` date NOT NULL DEFAULT '0000-00-00',
  `cp_end` date NOT NULL DEFAULT '0000-00-00',
  `cp_price` int(11) NOT NULL DEFAULT '0',
  `cp_type` tinyint(4) NOT NULL DEFAULT '0',
  `cp_trunc` int(11) NOT NULL DEFAULT '0',
  `cp_minimum` int(11) NOT NULL DEFAULT '0',
  `cp_maximum` int(11) NOT NULL DEFAULT '0',
  `od_id` bigint(20) unsigned NOT NULL,
  `cp_datetime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`cp_no`),
  UNIQUE KEY `cp_id` (`cp_id`),
  KEY `mb_id` (`mb_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `g5_shop_coupon`
--

LOCK TABLES `g5_shop_coupon` WRITE;
/*!40000 ALTER TABLE `g5_shop_coupon` DISABLE KEYS */;
/*!40000 ALTER TABLE `g5_shop_coupon` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `g5_shop_coupon_log`
--

DROP TABLE IF EXISTS `g5_shop_coupon_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `g5_shop_coupon_log` (
  `cl_id` int(11) NOT NULL AUTO_INCREMENT,
  `cp_id` varchar(100) NOT NULL DEFAULT '',
  `mb_id` varchar(100) NOT NULL DEFAULT '',
  `od_id` bigint(20) NOT NULL,
  `cp_price` int(11) NOT NULL DEFAULT '0',
  `cl_datetime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`cl_id`),
  KEY `mb_id` (`mb_id`),
  KEY `od_id` (`od_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `g5_shop_coupon_log`
--

LOCK TABLES `g5_shop_coupon_log` WRITE;
/*!40000 ALTER TABLE `g5_shop_coupon_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `g5_shop_coupon_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `g5_shop_coupon_zone`
--

DROP TABLE IF EXISTS `g5_shop_coupon_zone`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `g5_shop_coupon_zone` (
  `cz_id` int(11) NOT NULL AUTO_INCREMENT,
  `cz_type` tinyint(4) NOT NULL DEFAULT '0',
  `cz_subject` varchar(255) NOT NULL DEFAULT '',
  `cz_start` date NOT NULL DEFAULT '0000-00-00',
  `cz_end` date NOT NULL DEFAULT '0000-00-00',
  `cz_file` varchar(255) NOT NULL DEFAULT '',
  `cz_period` int(11) NOT NULL DEFAULT '0',
  `cz_point` int(11) NOT NULL DEFAULT '0',
  `cp_method` tinyint(4) NOT NULL DEFAULT '0',
  `cp_target` varchar(255) NOT NULL DEFAULT '',
  `cp_price` int(11) NOT NULL DEFAULT '0',
  `cp_type` tinyint(4) NOT NULL DEFAULT '0',
  `cp_trunc` int(11) NOT NULL DEFAULT '0',
  `cp_minimum` int(11) NOT NULL DEFAULT '0',
  `cp_maximum` int(11) NOT NULL DEFAULT '0',
  `cz_download` int(11) NOT NULL DEFAULT '0',
  `cz_datetime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`cz_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `g5_shop_coupon_zone`
--

LOCK TABLES `g5_shop_coupon_zone` WRITE;
/*!40000 ALTER TABLE `g5_shop_coupon_zone` DISABLE KEYS */;
/*!40000 ALTER TABLE `g5_shop_coupon_zone` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `g5_shop_default`
--

DROP TABLE IF EXISTS `g5_shop_default`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `g5_shop_default` (
  `de_admin_company_owner` varchar(255) NOT NULL DEFAULT '',
  `de_admin_company_name` varchar(255) NOT NULL DEFAULT '',
  `de_admin_company_saupja_no` varchar(255) NOT NULL DEFAULT '',
  `de_admin_company_tel` varchar(255) NOT NULL DEFAULT '',
  `de_admin_company_fax` varchar(255) NOT NULL DEFAULT '',
  `de_admin_tongsin_no` varchar(255) NOT NULL DEFAULT '',
  `de_admin_company_zip` varchar(255) NOT NULL DEFAULT '',
  `de_admin_company_addr` varchar(255) NOT NULL DEFAULT '',
  `de_admin_info_name` varchar(255) NOT NULL DEFAULT '',
  `de_admin_info_email` varchar(255) NOT NULL DEFAULT '',
  `de_shop_skin` varchar(255) NOT NULL DEFAULT '',
  `de_shop_mobile_skin` varchar(255) NOT NULL DEFAULT '',
  `de_type1_list_use` tinyint(4) NOT NULL DEFAULT '0',
  `de_type1_list_skin` varchar(255) NOT NULL DEFAULT '',
  `de_type1_list_mod` int(11) NOT NULL DEFAULT '0',
  `de_type1_list_row` int(11) NOT NULL DEFAULT '0',
  `de_type1_img_width` int(11) NOT NULL DEFAULT '0',
  `de_type1_img_height` int(11) NOT NULL DEFAULT '0',
  `de_type2_list_use` tinyint(4) NOT NULL DEFAULT '0',
  `de_type2_list_skin` varchar(255) NOT NULL DEFAULT '',
  `de_type2_list_mod` int(11) NOT NULL DEFAULT '0',
  `de_type2_list_row` int(11) NOT NULL DEFAULT '0',
  `de_type2_img_width` int(11) NOT NULL DEFAULT '0',
  `de_type2_img_height` int(11) NOT NULL DEFAULT '0',
  `de_type3_list_use` tinyint(4) NOT NULL DEFAULT '0',
  `de_type3_list_skin` varchar(255) NOT NULL DEFAULT '',
  `de_type3_list_mod` int(11) NOT NULL DEFAULT '0',
  `de_type3_list_row` int(11) NOT NULL DEFAULT '0',
  `de_type3_img_width` int(11) NOT NULL DEFAULT '0',
  `de_type3_img_height` int(11) NOT NULL DEFAULT '0',
  `de_type4_list_use` tinyint(4) NOT NULL DEFAULT '0',
  `de_type4_list_skin` varchar(255) NOT NULL DEFAULT '',
  `de_type4_list_mod` int(11) NOT NULL DEFAULT '0',
  `de_type4_list_row` int(11) NOT NULL DEFAULT '0',
  `de_type4_img_width` int(11) NOT NULL DEFAULT '0',
  `de_type4_img_height` int(11) NOT NULL DEFAULT '0',
  `de_type5_list_use` tinyint(4) NOT NULL DEFAULT '0',
  `de_type5_list_skin` varchar(255) NOT NULL DEFAULT '',
  `de_type5_list_mod` int(11) NOT NULL DEFAULT '0',
  `de_type5_list_row` int(11) NOT NULL DEFAULT '0',
  `de_type5_img_width` int(11) NOT NULL DEFAULT '0',
  `de_type5_img_height` int(11) NOT NULL DEFAULT '0',
  `de_mobile_type1_list_use` tinyint(4) NOT NULL DEFAULT '0',
  `de_mobile_type1_list_skin` varchar(255) NOT NULL DEFAULT '',
  `de_mobile_type1_list_mod` int(11) NOT NULL DEFAULT '0',
  `de_mobile_type1_list_row` int(11) NOT NULL DEFAULT '0',
  `de_mobile_type1_img_width` int(11) NOT NULL DEFAULT '0',
  `de_mobile_type1_img_height` int(11) NOT NULL DEFAULT '0',
  `de_mobile_type2_list_use` tinyint(4) NOT NULL DEFAULT '0',
  `de_mobile_type2_list_skin` varchar(255) NOT NULL DEFAULT '',
  `de_mobile_type2_list_mod` int(11) NOT NULL DEFAULT '0',
  `de_mobile_type2_list_row` int(11) NOT NULL DEFAULT '0',
  `de_mobile_type2_img_width` int(11) NOT NULL DEFAULT '0',
  `de_mobile_type2_img_height` int(11) NOT NULL DEFAULT '0',
  `de_mobile_type3_list_use` tinyint(4) NOT NULL DEFAULT '0',
  `de_mobile_type3_list_skin` varchar(255) NOT NULL DEFAULT '',
  `de_mobile_type3_list_mod` int(11) NOT NULL DEFAULT '0',
  `de_mobile_type3_list_row` int(11) NOT NULL DEFAULT '0',
  `de_mobile_type3_img_width` int(11) NOT NULL DEFAULT '0',
  `de_mobile_type3_img_height` int(11) NOT NULL DEFAULT '0',
  `de_mobile_type4_list_use` tinyint(4) NOT NULL DEFAULT '0',
  `de_mobile_type4_list_skin` varchar(255) NOT NULL DEFAULT '',
  `de_mobile_type4_list_mod` int(11) NOT NULL DEFAULT '0',
  `de_mobile_type4_list_row` int(11) NOT NULL DEFAULT '0',
  `de_mobile_type4_img_width` int(11) NOT NULL DEFAULT '0',
  `de_mobile_type4_img_height` int(11) NOT NULL DEFAULT '0',
  `de_mobile_type5_list_use` tinyint(4) NOT NULL DEFAULT '0',
  `de_mobile_type5_list_skin` varchar(255) NOT NULL DEFAULT '',
  `de_mobile_type5_list_mod` int(11) NOT NULL DEFAULT '0',
  `de_mobile_type5_list_row` int(11) NOT NULL DEFAULT '0',
  `de_mobile_type5_img_width` int(11) NOT NULL DEFAULT '0',
  `de_mobile_type5_img_height` int(11) NOT NULL DEFAULT '0',
  `de_rel_list_use` tinyint(4) NOT NULL DEFAULT '0',
  `de_rel_list_skin` varchar(255) NOT NULL DEFAULT '',
  `de_rel_list_mod` int(11) NOT NULL DEFAULT '0',
  `de_rel_img_width` int(11) NOT NULL DEFAULT '0',
  `de_rel_img_height` int(11) NOT NULL DEFAULT '0',
  `de_mobile_rel_list_use` tinyint(4) NOT NULL DEFAULT '0',
  `de_mobile_rel_list_skin` varchar(255) NOT NULL DEFAULT '',
  `de_mobile_rel_list_mod` int(11) NOT NULL DEFAULT '0',
  `de_mobile_rel_img_width` int(11) NOT NULL DEFAULT '0',
  `de_mobile_rel_img_height` int(11) NOT NULL DEFAULT '0',
  `de_search_list_skin` varchar(255) NOT NULL DEFAULT '',
  `de_search_list_mod` int(11) NOT NULL DEFAULT '0',
  `de_search_list_row` int(11) NOT NULL DEFAULT '0',
  `de_search_img_width` int(11) NOT NULL DEFAULT '0',
  `de_search_img_height` int(11) NOT NULL DEFAULT '0',
  `de_mobile_search_list_skin` varchar(255) NOT NULL DEFAULT '',
  `de_mobile_search_list_mod` int(11) NOT NULL DEFAULT '0',
  `de_mobile_search_list_row` int(11) NOT NULL DEFAULT '0',
  `de_mobile_search_img_width` int(11) NOT NULL DEFAULT '0',
  `de_mobile_search_img_height` int(11) NOT NULL DEFAULT '0',
  `de_listtype_list_skin` varchar(255) NOT NULL DEFAULT '',
  `de_listtype_list_mod` int(11) NOT NULL DEFAULT '0',
  `de_listtype_list_row` int(11) NOT NULL DEFAULT '0',
  `de_listtype_img_width` int(11) NOT NULL DEFAULT '0',
  `de_listtype_img_height` int(11) NOT NULL DEFAULT '0',
  `de_mobile_listtype_list_skin` varchar(255) NOT NULL DEFAULT '',
  `de_mobile_listtype_list_mod` int(11) NOT NULL DEFAULT '0',
  `de_mobile_listtype_list_row` int(11) NOT NULL DEFAULT '0',
  `de_mobile_listtype_img_width` int(11) NOT NULL DEFAULT '0',
  `de_mobile_listtype_img_height` int(11) NOT NULL DEFAULT '0',
  `de_bank_use` int(11) NOT NULL DEFAULT '0',
  `de_bank_account` text NOT NULL,
  `de_card_test` int(11) NOT NULL DEFAULT '0',
  `de_card_use` int(11) NOT NULL DEFAULT '0',
  `de_card_noint_use` tinyint(4) NOT NULL DEFAULT '0',
  `de_card_point` int(11) NOT NULL DEFAULT '0',
  `de_settle_min_point` int(11) NOT NULL DEFAULT '0',
  `de_settle_max_point` int(11) NOT NULL DEFAULT '0',
  `de_settle_point_unit` int(11) NOT NULL DEFAULT '0',
  `de_level_sell` int(11) NOT NULL DEFAULT '0',
  `de_delivery_company` varchar(255) NOT NULL DEFAULT '',
  `de_send_cost_case` varchar(255) NOT NULL DEFAULT '',
  `de_send_cost_limit` varchar(255) NOT NULL DEFAULT '',
  `de_send_ea_limit` varchar(255) NOT NULL COMMENT '개수별 배송비',
  `de_send_cost_list` varchar(255) NOT NULL DEFAULT '',
  `de_hope_date_use` int(11) NOT NULL DEFAULT '0',
  `de_hope_date_after` int(11) NOT NULL DEFAULT '0',
  `de_baesong_content` text NOT NULL,
  `de_change_content` text NOT NULL,
  `de_point_days` int(11) NOT NULL DEFAULT '0',
  `de_simg_width` int(11) NOT NULL DEFAULT '0',
  `de_simg_height` int(11) NOT NULL DEFAULT '0',
  `de_mimg_width` int(11) NOT NULL DEFAULT '0',
  `de_mimg_height` int(11) NOT NULL DEFAULT '0',
  `de_sms_cont1` text NOT NULL,
  `de_sms_cont2` text NOT NULL,
  `de_sms_cont3` text NOT NULL,
  `de_sms_cont4` text NOT NULL,
  `de_sms_cont5` text NOT NULL,
  `de_sms_use1` tinyint(4) NOT NULL DEFAULT '0',
  `de_sms_use2` tinyint(4) NOT NULL DEFAULT '0',
  `de_sms_use3` tinyint(4) NOT NULL DEFAULT '0',
  `de_sms_use4` tinyint(4) NOT NULL DEFAULT '0',
  `de_sms_use5` tinyint(4) NOT NULL DEFAULT '0',
  `de_sms_hp` varchar(255) NOT NULL DEFAULT '',
  `de_pg_service` varchar(255) NOT NULL DEFAULT '',
  `de_kcp_mid` varchar(255) NOT NULL DEFAULT '',
  `de_kcp_site_key` varchar(255) NOT NULL DEFAULT '',
  `de_inicis_mid` varchar(255) NOT NULL DEFAULT '',
  `de_inicis_admin_key` varchar(255) NOT NULL DEFAULT '',
  `de_inicis_sign_key` varchar(255) NOT NULL DEFAULT '',
  `de_iche_use` tinyint(4) NOT NULL DEFAULT '0',
  `de_easy_pay_use` tinyint(4) NOT NULL DEFAULT '0',
  `de_samsung_pay_use` tinyint(4) NOT NULL DEFAULT '0',
  `de_inicis_lpay_use` tinyint(4) NOT NULL DEFAULT '0',
  `de_inicis_cartpoint_use` tinyint(4) NOT NULL DEFAULT '0',
  `de_item_use_use` tinyint(4) NOT NULL DEFAULT '0',
  `de_item_use_write` tinyint(4) NOT NULL DEFAULT '0',
  `de_code_dup_use` tinyint(4) NOT NULL DEFAULT '0',
  `de_cart_keep_term` int(11) NOT NULL DEFAULT '0',
  `de_guest_cart_use` tinyint(4) NOT NULL DEFAULT '0',
  `de_admin_buga_no` varchar(255) NOT NULL DEFAULT '',
  `de_vbank_use` varchar(255) NOT NULL DEFAULT '',
  `de_taxsave_use` tinyint(4) NOT NULL,
  `de_taxsave_types` set('account','vbank','transfer') NOT NULL DEFAULT 'account',
  `de_guest_privacy` text NOT NULL,
  `de_hp_use` tinyint(4) NOT NULL DEFAULT '0',
  `de_escrow_use` tinyint(4) NOT NULL DEFAULT '0',
  `de_tax_flag_use` tinyint(4) NOT NULL DEFAULT '0',
  `de_kakaopay_mid` varchar(255) NOT NULL DEFAULT '',
  `de_kakaopay_key` varchar(255) NOT NULL DEFAULT '',
  `de_kakaopay_enckey` varchar(255) NOT NULL DEFAULT '',
  `de_kakaopay_hashkey` varchar(255) NOT NULL DEFAULT '',
  `de_kakaopay_cancelpwd` varchar(255) NOT NULL DEFAULT '',
  `de_naverpay_mid` varchar(255) NOT NULL DEFAULT '',
  `de_naverpay_cert_key` varchar(255) NOT NULL DEFAULT '',
  `de_naverpay_button_key` varchar(255) NOT NULL DEFAULT '',
  `de_naverpay_test` tinyint(4) NOT NULL DEFAULT '0',
  `de_naverpay_mb_id` varchar(255) NOT NULL DEFAULT '',
  `de_naverpay_sendcost` varchar(255) NOT NULL DEFAULT '',
  `de_member_reg_coupon_use` tinyint(4) NOT NULL DEFAULT '0',
  `de_member_reg_coupon_term` int(11) NOT NULL DEFAULT '0',
  `de_member_reg_coupon_price` int(11) NOT NULL DEFAULT '0',
  `de_member_reg_coupon_minimum` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `g5_shop_default`
--

LOCK TABLES `g5_shop_default` WRITE;
/*!40000 ALTER TABLE `g5_shop_default` DISABLE KEYS */;
INSERT INTO `g5_shop_default` VALUES ('이전영, 천성욱','주식회사 유엠씨코리아','204-86-40423','070-7772-4500','','2019-용인기흥-0093','123-456','경기도 용인시 기흥구 동백중앙로16번길 16-9 (이호지식산업센터) 403호','이전영','yhfamilly@naver.com','basic','basic',1,'main.60.skin.php',4,2,282,282,1,'main.40.skin.php',5,4,225,225,1,'main.40.skin.php',5,2,225,225,0,'main.50.skin.php',1,5,230,230,0,'main.40.skin.php',5,2,430,430,1,'main.30.skin.php',4,2,300,300,1,'main.30.skin.php',4,2,300,300,1,'main.30.skin.php',4,2,300,300,1,'main.30.skin.php',4,2,300,300,1,'main.30.skin.php',4,2,300,300,1,'relation.10.skin.php',5,225,225,1,'relation.10.skin.php',2,300,300,'list.10.skin.php',5,3,225,225,'list.10.skin.php',2,4,300,300,'list.10.skin.php',5,3,225,225,'list.10.skin.php',2,4,300,300,1,'신한은행 140-012-668442 예금주명 주식회사 유엠씨코리아',1,0,1,0,5000,50000,100,1,'','개수','20000;30000;40000','7개;13개;19개','20000;40000;60000',0,3,'배송 안내 입력전입니다.','교환/반품 안내 입력전입니다.',7,230,230,300,300,'{이름}님의 회원가입을 축하드립니다.\r\nID:{회원아이디}\r\n{회사명}','{이름}님 주문해주셔서 고맙습니다.\r\n{주문번호}\r\n{주문금액}원\r\n{회사명}','{이름}님께서 주문하셨습니다.\r\n{주문번호}\r\n{주문금액}원\r\n{회사명}','{이름}님 입금 감사합니다.\r\n{입금액}원\r\n주문번호:\r\n{주문번호}\r\n{회사명}','{이름}님 배송합니다.\r\n택배:{택배회사}\r\n운송장번호:\r\n{운송장번호}\r\n{회사명}',0,0,0,0,0,'','kcp','asdfg','','','','',0,0,0,0,0,0,0,1,15,0,'','0',1,'account,vbank,transfer','<p><span style=\"color:rgb(85,85,85);font-family:Roboto, Arial, \'Nanum Gothic\', \'나눔고딕\', \'돋움\', \'Malgun Gothic\', \'맑은 고딕\', AppleGothic, Dotum, \'돋움\', sans-serif;\">- 수집항목: 성명, 비밀번호, 이메일, 휴대폰번호, 주소, 전화번호</span><br style=\"color:rgb(85,85,85);font-family:Roboto, Arial, \'Nanum Gothic\', \'나눔고딕\', \'돋움\', \'Malgun Gothic\', \'맑은 고딕\', AppleGothic, Dotum, \'돋움\', sans-serif;\"><span style=\"color:rgb(85,85,85);font-family:Roboto, Arial, \'Nanum Gothic\', \'나눔고딕\', \'돋움\', \'Malgun Gothic\', \'맑은 고딕\', AppleGothic, Dotum, \'돋움\', sans-serif;\">- 수집/이용목적: 서비스 제공 및 계약의 이행, 구매 및 대금결제, 물품배송 또는 청구지 발송, 불만처리 등 민원처리, 회원관리 등을 위한 목적</span><br style=\"color:rgb(85,85,85);font-family:Roboto, Arial, \'Nanum Gothic\', \'나눔고딕\', \'돋움\', \'Malgun Gothic\', \'맑은 고딕\', AppleGothic, Dotum, \'돋움\', sans-serif;\"><span style=\"color:rgb(85,85,85);font-family:Roboto, Arial, \'Nanum Gothic\', \'나눔고딕\', \'돋움\', \'Malgun Gothic\', \'맑은 고딕\', AppleGothic, Dotum, \'돋움\', sans-serif;\">- 이용기간: 원칙적으로 개인정보 수집 및 이용목적이 달성된 후에는 해당 정보를 지체 없이 파기합니다.</span><br style=\"color:rgb(85,85,85);font-family:Roboto, Arial, \'Nanum Gothic\', \'나눔고딕\', \'돋움\', \'Malgun Gothic\', \'맑은 고딕\', AppleGothic, Dotum, \'돋움\', sans-serif;\"><span style=\"color:rgb(85,85,85);font-family:Roboto, Arial, \'Nanum Gothic\', \'나눔고딕\', \'돋움\', \'Malgun Gothic\', \'맑은 고딕\', AppleGothic, Dotum, \'돋움\', sans-serif;\">단, 관계법령의 규정에 의하여 보전할 필요가 있는 경우 일정기간 동안 개인정보를 보관할 수 있습니다.</span></p><p><br style=\"color:rgb(85,85,85);font-family:Roboto, Arial, \'Nanum Gothic\', \'나눔고딕\', \'돋움\', \'Malgun Gothic\', \'맑은 고딕\', AppleGothic, Dotum, \'돋움\', sans-serif;\"><span style=\"color:rgb(85,85,85);font-family:Roboto, Arial, \'Nanum Gothic\', \'나눔고딕\', \'돋움\', \'Malgun Gothic\', \'맑은 고딕\', AppleGothic, Dotum, \'돋움\', sans-serif;\">그 밖의 사항은 주식회사 유엠씨코리아 개인정보처리방침을 준수합니다.</span>&nbsp;</p>',0,0,0,'','','','','','','','',0,'','',0,0,0,0);
/*!40000 ALTER TABLE `g5_shop_default` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `g5_shop_event`
--

DROP TABLE IF EXISTS `g5_shop_event`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `g5_shop_event` (
  `ev_id` int(11) NOT NULL AUTO_INCREMENT,
  `ev_skin` varchar(255) NOT NULL DEFAULT '',
  `ev_mobile_skin` varchar(255) NOT NULL DEFAULT '',
  `ev_img_width` int(11) NOT NULL DEFAULT '0',
  `ev_img_height` int(11) NOT NULL DEFAULT '0',
  `ev_list_mod` int(11) NOT NULL DEFAULT '0',
  `ev_list_row` int(11) NOT NULL DEFAULT '0',
  `ev_mobile_img_width` int(11) NOT NULL DEFAULT '0',
  `ev_mobile_img_height` int(11) NOT NULL DEFAULT '0',
  `ev_mobile_list_mod` int(11) NOT NULL DEFAULT '0',
  `ev_mobile_list_row` int(11) NOT NULL DEFAULT '0',
  `ev_subject` varchar(255) NOT NULL DEFAULT '',
  `ev_subject_strong` tinyint(4) NOT NULL DEFAULT '0',
  `ev_head_html` text NOT NULL,
  `ev_tail_html` text NOT NULL,
  `ev_use` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ev_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `g5_shop_event`
--

LOCK TABLES `g5_shop_event` WRITE;
/*!40000 ALTER TABLE `g5_shop_event` DISABLE KEYS */;
/*!40000 ALTER TABLE `g5_shop_event` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `g5_shop_event_item`
--

DROP TABLE IF EXISTS `g5_shop_event_item`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `g5_shop_event_item` (
  `ev_id` int(11) NOT NULL DEFAULT '0',
  `it_id` varchar(20) NOT NULL DEFAULT '',
  PRIMARY KEY (`ev_id`,`it_id`),
  KEY `it_id` (`it_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `g5_shop_event_item`
--

LOCK TABLES `g5_shop_event_item` WRITE;
/*!40000 ALTER TABLE `g5_shop_event_item` DISABLE KEYS */;
/*!40000 ALTER TABLE `g5_shop_event_item` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `g5_shop_inicis_log`
--

DROP TABLE IF EXISTS `g5_shop_inicis_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `g5_shop_inicis_log` (
  `oid` bigint(20) unsigned NOT NULL,
  `P_TID` varchar(255) NOT NULL DEFAULT '',
  `P_MID` varchar(255) NOT NULL DEFAULT '',
  `P_AUTH_DT` varchar(255) NOT NULL DEFAULT '',
  `P_STATUS` varchar(255) NOT NULL DEFAULT '',
  `P_TYPE` varchar(255) NOT NULL DEFAULT '',
  `P_OID` varchar(255) NOT NULL DEFAULT '',
  `P_FN_NM` varchar(255) NOT NULL DEFAULT '',
  `P_AUTH_NO` varchar(255) NOT NULL DEFAULT '',
  `P_AMT` int(11) NOT NULL DEFAULT '0',
  `P_RMESG1` varchar(255) NOT NULL DEFAULT '',
  `post_data` text NOT NULL,
  `is_mail_send` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`oid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `g5_shop_inicis_log`
--

LOCK TABLES `g5_shop_inicis_log` WRITE;
/*!40000 ALTER TABLE `g5_shop_inicis_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `g5_shop_inicis_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `g5_shop_item`
--

DROP TABLE IF EXISTS `g5_shop_item`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `g5_shop_item` (
  `it_id` varchar(20) NOT NULL DEFAULT '',
  `ca_id` varchar(10) NOT NULL DEFAULT '0',
  `ca_id2` varchar(255) NOT NULL DEFAULT '',
  `ca_id3` varchar(255) NOT NULL DEFAULT '',
  `it_skin` varchar(255) NOT NULL DEFAULT '',
  `it_mobile_skin` varchar(255) NOT NULL DEFAULT '',
  `it_name` varchar(255) NOT NULL DEFAULT '',
  `it_seo_title` varchar(200) NOT NULL DEFAULT '',
  `it_maker` varchar(255) NOT NULL DEFAULT '',
  `it_origin` varchar(255) NOT NULL DEFAULT '',
  `it_brand` varchar(255) NOT NULL DEFAULT '',
  `it_model` varchar(255) NOT NULL DEFAULT '',
  `it_option_subject` varchar(255) NOT NULL DEFAULT '',
  `it_supply_subject` varchar(255) NOT NULL DEFAULT '',
  `it_type1` tinyint(4) NOT NULL DEFAULT '0',
  `it_type2` tinyint(4) NOT NULL DEFAULT '0',
  `it_type3` tinyint(4) NOT NULL DEFAULT '0',
  `it_type4` tinyint(4) NOT NULL DEFAULT '0',
  `it_type5` tinyint(4) NOT NULL DEFAULT '0',
  `it_basic` text NOT NULL,
  `it_explan` mediumtext NOT NULL,
  `it_explan2` mediumtext NOT NULL,
  `it_mobile_explan` mediumtext NOT NULL,
  `it_cust_price` int(11) NOT NULL DEFAULT '0',
  `it_price` int(11) NOT NULL DEFAULT '0',
  `it_point` int(11) NOT NULL DEFAULT '0',
  `it_point_type` tinyint(4) NOT NULL DEFAULT '0',
  `it_supply_point` int(11) NOT NULL DEFAULT '0',
  `it_notax` tinyint(4) NOT NULL DEFAULT '0',
  `it_sell_email` varchar(255) NOT NULL DEFAULT '',
  `it_use` tinyint(4) NOT NULL DEFAULT '0',
  `it_nocoupon` tinyint(4) NOT NULL DEFAULT '0',
  `it_soldout` tinyint(4) NOT NULL DEFAULT '0',
  `it_stock_qty` int(11) NOT NULL DEFAULT '0',
  `it_stock_sms` tinyint(4) NOT NULL DEFAULT '0',
  `it_noti_qty` int(11) NOT NULL DEFAULT '0',
  `it_sc_type` tinyint(4) NOT NULL DEFAULT '0',
  `it_sc_method` tinyint(4) NOT NULL DEFAULT '0',
  `it_sc_price` int(11) NOT NULL DEFAULT '0',
  `it_sc_minimum` int(11) NOT NULL DEFAULT '0',
  `it_sc_qty` int(11) NOT NULL DEFAULT '0',
  `it_buy_min_qty` int(11) NOT NULL DEFAULT '0',
  `it_buy_max_qty` int(11) NOT NULL DEFAULT '0',
  `it_head_html` text NOT NULL,
  `it_tail_html` text NOT NULL,
  `it_mobile_head_html` text NOT NULL,
  `it_mobile_tail_html` text NOT NULL,
  `it_hit` int(11) NOT NULL DEFAULT '0',
  `it_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `it_update_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `it_ip` varchar(25) NOT NULL DEFAULT '',
  `it_order` int(11) NOT NULL DEFAULT '0',
  `it_tel_inq` tinyint(4) NOT NULL DEFAULT '0',
  `it_info_gubun` varchar(50) NOT NULL DEFAULT '',
  `it_info_value` text NOT NULL,
  `it_sum_qty` int(11) NOT NULL DEFAULT '0',
  `it_use_cnt` int(11) NOT NULL DEFAULT '0',
  `it_use_avg` decimal(2,1) NOT NULL,
  `it_shop_memo` text NOT NULL,
  `ec_mall_pid` varchar(255) NOT NULL DEFAULT '',
  `it_img1` varchar(255) NOT NULL DEFAULT '',
  `it_img2` varchar(255) NOT NULL DEFAULT '',
  `it_img3` varchar(255) NOT NULL DEFAULT '',
  `it_img4` varchar(255) NOT NULL DEFAULT '',
  `it_img5` varchar(255) NOT NULL DEFAULT '',
  `it_img6` varchar(255) NOT NULL DEFAULT '',
  `it_img7` varchar(255) NOT NULL DEFAULT '',
  `it_img8` varchar(255) NOT NULL DEFAULT '',
  `it_img9` varchar(255) NOT NULL DEFAULT '',
  `it_img10` varchar(255) NOT NULL DEFAULT '',
  `it_1_subj` varchar(255) NOT NULL DEFAULT '',
  `it_2_subj` varchar(255) NOT NULL DEFAULT '',
  `it_3_subj` varchar(255) NOT NULL DEFAULT '',
  `it_4_subj` varchar(255) NOT NULL DEFAULT '',
  `it_5_subj` varchar(255) NOT NULL DEFAULT '',
  `it_6_subj` varchar(255) NOT NULL DEFAULT '',
  `it_7_subj` varchar(255) NOT NULL DEFAULT '',
  `it_8_subj` varchar(255) NOT NULL DEFAULT '',
  `it_9_subj` varchar(255) NOT NULL DEFAULT '',
  `it_10_subj` varchar(255) NOT NULL DEFAULT '',
  `it_1` varchar(255) NOT NULL DEFAULT '',
  `it_2` varchar(255) NOT NULL DEFAULT '',
  `it_3` varchar(255) NOT NULL DEFAULT '',
  `it_4` varchar(255) NOT NULL DEFAULT '',
  `it_5` varchar(255) NOT NULL DEFAULT '',
  `it_6` varchar(255) NOT NULL DEFAULT '',
  `it_7` varchar(255) NOT NULL DEFAULT '',
  `it_8` varchar(255) NOT NULL DEFAULT '',
  `it_9` varchar(255) NOT NULL DEFAULT '',
  `it_10` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`it_id`),
  KEY `ca_id` (`ca_id`),
  KEY `it_name` (`it_name`),
  KEY `it_seo_title` (`it_seo_title`),
  KEY `it_order` (`it_order`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `g5_shop_item`
--

LOCK TABLES `g5_shop_item` WRITE;
/*!40000 ALTER TABLE `g5_shop_item` DISABLE KEYS */;
INSERT INTO `g5_shop_item` VALUES ('1588909839','40','4040','','','','반테린 코와 파스 액체 EX 90g','반테린-코와-파스-액체-ex-90g','','','','','','',0,1,1,0,1,'반테린 코와 파스 액체 EX 90g반테린 코와 파스 액체 EX 90g','','','',45450,30300,0,0,0,0,'',1,0,0,99999,0,0,0,0,0,0,0,0,0,'','<h3 style=\"text-align:center;\" align=\"center\">★★필독사항★★&nbsp;</h3>\r\n<div style=\"margin:15px 0 30px;padding:20px;border:1px solid #eee;line-height:1.8;\">\r\n<p><u>필독사항 미확인으로 인한 문제는 당사에서 도움드릴 수 없는 점 꼭 참고해주세요.</u></p>\r\n<p>(1) 결제금액에는 관세 · 부가세가 포함되어 있지 않습니다.&nbsp;</p>\r\n<p>(2) 받는 분 정보란에 반드시 실명, 받는 분의 개인통관고유번호, 휴대전화번호를 기재해주셔야 합니다.&nbsp;</p>\r\n<p>(3) 건강 · 서플리먼트 상품인 의약품, 의약외품은 1회 주문 시 관세법상 개인사용 목적으로 6개까지만 통관이 가능합니다.<br> &nbsp;  &nbsp; &nbsp;\r\n3개 세트상품은 3개로 책정됩니다.(6개 초과 시 세관에서 폐기처분되며, 이때 발생하는 모든 비용은 구매자가 부담하게 됩니다.)&nbsp;</p>\r\n<p>(4) 배송비를 제외한 상품금액 150$(한화 17만 원) 이상이면 관 · 부가세가 발생할 수 있으므로 주의해주세요.</p>\r\n</div>\r\n<p style=\"text-align:center;\" align=\"center\"><img src=\"/img/sub/jd2_intro_out.jpg\" alt=\"\"></p>','','',23,'2020-05-08 12:52:51','2020-06-11 17:37:13','121.173.199.59',0,0,'wear','a:8:{s:8:\"material\";s:22:\"상품페이지 참고\";s:5:\"color\";s:22:\"상품페이지 참고\";s:4:\"size\";s:22:\"상품페이지 참고\";s:5:\"maker\";s:22:\"상품페이지 참고\";s:7:\"caution\";s:22:\"상품페이지 참고\";s:16:\"manufacturing_ym\";s:22:\"상품페이지 참고\";s:8:\"warranty\";s:22:\"상품페이지 참고\";s:2:\"as\";s:22:\"상품페이지 참고\";}',0,1,5.0,'','','1588909839/T_4987067214303.jpg','','','','','','','','','','','','','','','','','','','','','','','','','','','','',''),('1588926247','40','4050','','','','히사미츠 샤론파스A','히사미츠-샤론파스a','','','','','','',1,1,0,0,1,'통증 특효약 일본 국민파스','','','',10050,7300,0,0,0,0,'',1,0,0,99999,0,0,4,0,20000,0,6,0,0,'','<h3 style=\"text-align:center;\" align=\"center\">★★필독사항★★&nbsp;</h3>\r\n<div style=\"margin:15px 0 30px;padding:20px;border:1px solid #eee;line-height:1.8;\">\r\n<p><u>필독사항 미확인으로 인한 문제는 당사에서 도움드릴 수 없는 점 꼭 참고해주세요.</u></p>\r\n<p>(1) 결제금액에는 관세 · 부가세가 포함되어 있지 않습니다.&nbsp;</p>\r\n<p>(2) 받는 분 정보란에 반드시 실명, 받는 분의 개인통관고유번호, 휴대전화번호를 기재해주셔야 합니다.&nbsp;</p>\r\n<p>(3) 건강 · 서플리먼트 상품인 의약품, 의약외품은 1회 주문 시 관세법상 개인사용 목적으로 6개까지만 통관이 가능합니다.<br> &nbsp;  &nbsp; &nbsp;\r\n3개 세트상품은 3개로 책정됩니다.(6개 초과 시 세관에서 폐기처분되며, 이때 발생하는 모든 비용은 구매자가 부담하게 됩니다.)&nbsp;</p>\r\n<p>(4) 배송비를 제외한 상품금액 150$(한화 17만 원) 이상이면 관 · 부가세가 발생할 수 있으므로 주의해주세요.</p>\r\n</div>\r\n<p style=\"text-align:center;\" align=\"center\"><img src=\"/img/sub/jd2_intro_out.jpg\" alt=\"\"></p>','','',18,'2020-05-08 12:52:51','2020-06-12 01:51:13','58.224.133.171',0,0,'wear','a:8:{s:8:\"material\";s:22:\"상품페이지 참고\";s:5:\"color\";s:22:\"상품페이지 참고\";s:4:\"size\";s:22:\"상품페이지 참고\";s:5:\"maker\";s:22:\"상품페이지 참고\";s:7:\"caution\";s:22:\"상품페이지 참고\";s:16:\"manufacturing_ym\";s:22:\"상품페이지 참고\";s:8:\"warranty\";s:22:\"상품페이지 참고\";s:2:\"as\";s:22:\"상품페이지 참고\";}',0,0,0.0,'','','1588926247/1000000553_main_062.jpg','','','','','','','','','1588926247/imgChoice01.jpg','','','','','','','','','','','','','','','','','','','',''),('1588929503','40','4080','','','','로이히츠보쿠 동전파스','로이히츠보쿠-동전파스','','','','','','',1,1,0,0,1,'일본은 몰라도 파스는 안다','','','',10050,7300,0,0,0,0,'',1,0,0,99999,0,0,0,0,0,0,0,0,0,'','<h3 style=\"text-align:center;\" align=\"center\">★★필독사항★★&nbsp;</h3>\r\n<div style=\"margin:15px 0 30px;padding:20px;border:1px solid #eee;line-height:1.8;\">\r\n<p><u>필독사항 미확인으로 인한 문제는 당사에서 도움드릴 수 없는 점 꼭 참고해주세요.</u></p>\r\n<p>(1) 결제금액에는 관세 · 부가세가 포함되어 있지 않습니다.&nbsp;</p>\r\n<p>(2) 받는 분 정보란에 반드시 실명, 받는 분의 개인통관고유번호, 휴대전화번호를 기재해주셔야 합니다.&nbsp;</p>\r\n<p>(3) 건강 · 서플리먼트 상품인 의약품, 의약외품은 1회 주문 시 관세법상 개인사용 목적으로 6개까지만 통관이 가능합니다.<br> &nbsp;  &nbsp; &nbsp;\r\n3개 세트상품은 3개로 책정됩니다.(6개 초과 시 세관에서 폐기처분되며, 이때 발생하는 모든 비용은 구매자가 부담하게 됩니다.)&nbsp;</p>\r\n<p>(4) 배송비를 제외한 상품금액 150$(한화 17만 원) 이상이면 관 · 부가세가 발생할 수 있으므로 주의해주세요.</p>\r\n</div>\r\n<p style=\"text-align:center;\" align=\"center\"><img src=\"/img/sub/jd2_intro_out.jpg\" alt=\"\"></p>','','',6,'2020-05-08 12:52:51','2020-06-08 00:49:39','211.202.43.197',0,0,'wear','a:8:{s:8:\"material\";s:22:\"상품페이지 참고\";s:5:\"color\";s:22:\"상품페이지 참고\";s:4:\"size\";s:22:\"상품페이지 참고\";s:5:\"maker\";s:22:\"상품페이지 참고\";s:7:\"caution\";s:22:\"상품페이지 참고\";s:16:\"manufacturing_ym\";s:22:\"상품페이지 참고\";s:8:\"warranty\";s:22:\"상품페이지 참고\";s:2:\"as\";s:22:\"상품페이지 참고\";}',0,0,0.0,'','','1588929503/1000001351_main_0100.jpg','','','','','','','','','1588929503/imgChoice01.jpg','','','','','','','','','','','','','','','','','','','',''),('1589775141','40','4060','','','','고바야시 등 여드름 세나큐아 100ml','고바야시-등-여드름-세나큐아-100ml','','','','','','',0,1,1,0,1,'살균작용','','','',16300,24450,0,0,0,0,'',1,0,0,99999,0,0,0,0,0,0,0,0,0,'','<h3 style=\"text-align:center;\" align=\"center\">★★필독사항★★&nbsp;</h3>\r\n<div style=\"margin:15px 0 30px;padding:20px;border:1px solid #eee;line-height:1.8;\">\r\n<p><u>필독사항 미확인으로 인한 문제는 당사에서 도움드릴 수 없는 점 꼭 참고해주세요.</u></p>\r\n<p>(1) 결제금액에는 관세 · 부가세가 포함되어 있지 않습니다.&nbsp;</p>\r\n<p>(2) 받는 분 정보란에 반드시 실명, 받는 분의 개인통관고유번호, 휴대전화번호를 기재해주셔야 합니다.&nbsp;</p>\r\n<p>(3) 건강 · 서플리먼트 상품인 의약품, 의약외품은 1회 주문 시 관세법상 개인사용 목적으로 6개까지만 통관이 가능합니다.<br> &nbsp;  &nbsp; &nbsp;\r\n3개 세트상품은 3개로 책정됩니다.(6개 초과 시 세관에서 폐기처분되며, 이때 발생하는 모든 비용은 구매자가 부담하게 됩니다.)&nbsp;</p>\r\n<p>(4) 배송비를 제외한 상품금액 150$(한화 17만 원) 이상이면 관 · 부가세가 발생할 수 있으므로 주의해주세요.</p>\r\n</div>\r\n<p style=\"text-align:center;\" align=\"center\"><img src=\"/img/sub/jd2_intro_out.jpg\" alt=\"\"></p>','','',11,'2020-05-08 12:52:51','2020-06-11 17:36:55','121.173.199.59',0,0,'wear','a:8:{s:8:\"material\";s:22:\"상품페이지 참고\";s:5:\"color\";s:22:\"상품페이지 참고\";s:4:\"size\";s:22:\"상품페이지 참고\";s:5:\"maker\";s:22:\"상품페이지 참고\";s:7:\"caution\";s:22:\"상품페이지 참고\";s:16:\"manufacturing_ym\";s:22:\"상품페이지 참고\";s:8:\"warranty\";s:22:\"상품페이지 참고\";s:2:\"as\";s:22:\"상품페이지 참고\";}',0,0,0.0,'','','1589775141/T_49870720415122.jpg','','','','','','','','','1589775141/imgChoice01.jpg','','','','','','','','','','','','','','','','','','','',''),('1589775430','40','4010','','','','EVE 이브 퀵 40정 일본 두통약','eve-이브-퀵-40정-일본-두통약','','','','','','',0,1,1,0,1,'살균작용','','','',14800,22200,0,0,0,0,'',1,0,0,99999,0,0,0,0,0,0,0,0,0,'','<h3 style=\"text-align:center;\" align=\"center\">★★필독사항★★&nbsp;</h3>\r\n<div style=\"margin:15px 0 30px;padding:20px;border:1px solid #eee;line-height:1.8;\">\r\n<p><u>필독사항 미확인으로 인한 문제는 당사에서 도움드릴 수 없는 점 꼭 참고해주세요.</u></p>\r\n<p>(1) 결제금액에는 관세 · 부가세가 포함되어 있지 않습니다.&nbsp;</p>\r\n<p>(2) 받는 분 정보란에 반드시 실명, 받는 분의 개인통관고유번호, 휴대전화번호를 기재해주셔야 합니다.&nbsp;</p>\r\n<p>(3) 건강 · 서플리먼트 상품인 의약품, 의약외품은 1회 주문 시 관세법상 개인사용 목적으로 6개까지만 통관이 가능합니다.<br> &nbsp;  &nbsp; &nbsp;\r\n3개 세트상품은 3개로 책정됩니다.(6개 초과 시 세관에서 폐기처분되며, 이때 발생하는 모든 비용은 구매자가 부담하게 됩니다.)&nbsp;</p>\r\n<p>(4) 배송비를 제외한 상품금액 150$(한화 17만 원) 이상이면 관 · 부가세가 발생할 수 있으므로 주의해주세요.</p>\r\n</div>\r\n<p style=\"text-align:center;\" align=\"center\"><img src=\"/img/sub/jd2_intro_out.jpg\" alt=\"\"></p>','','',23,'2020-05-08 12:52:51','2020-06-11 17:36:42','121.173.199.59',0,0,'wear','a:8:{s:8:\"material\";s:22:\"상품페이지 참고\";s:5:\"color\";s:22:\"상품페이지 참고\";s:4:\"size\";s:22:\"상품페이지 참고\";s:5:\"maker\";s:22:\"상품페이지 참고\";s:7:\"caution\";s:22:\"상품페이지 참고\";s:16:\"manufacturing_ym\";s:22:\"상품페이지 참고\";s:8:\"warranty\";s:22:\"상품페이지 참고\";s:2:\"as\";s:22:\"상품페이지 참고\";}',0,0,0.0,'','','1589775430/T_4987300052716.jpg','','','','','','','','','','','','','','','','','','','','','','','','','','','','',''),('1589775634','70','7010','20','','','곤약 젤리 청포도+오렌지 12개입','곤약-젤리-청포도오렌지-12개입','','','','','','',1,1,0,0,1,'말랑하고 탱글한 과육느낌 그대로!','','','',3200,4800,0,0,0,0,'',1,0,0,99999,0,0,4,0,10000,0,6,0,0,'','<h3 style=\"text-align:center;\" align=\"center\">★★필독사항★★&nbsp;</h3>\r\n<div style=\"margin:15px 0 30px;padding:20px;border:1px solid #eee;line-height:1.8;\">\r\n<p><u>필독사항 미확인으로 인한 문제는 당사에서 도움드릴 수 없는 점 꼭 참고해주세요.</u></p>\r\n<p>(1) 결제금액에는 관세 · 부가세가 포함되어 있지 않습니다.&nbsp;</p>\r\n<p>(2) 받는 분 정보란에 반드시 실명, 받는 분의 개인통관고유번호, 휴대전화번호를 기재해주셔야 합니다.&nbsp;</p>\r\n<p>(3) 건강 · 서플리먼트 상품인 의약품, 의약외품은 1회 주문 시 관세법상 개인사용 목적으로 6개까지만 통관이 가능합니다.<br> &nbsp;  &nbsp; &nbsp;\r\n3개 세트상품은 3개로 책정됩니다.(6개 초과 시 세관에서 폐기처분되며, 이때 발생하는 모든 비용은 구매자가 부담하게 됩니다.)&nbsp;</p>\r\n<p>(4) 배송비를 제외한 상품금액 150$(한화 17만 원) 이상이면 관 · 부가세가 발생할 수 있으므로 주의해주세요.</p>\r\n</div>\r\n<p style=\"text-align:center;\" align=\"center\"><img src=\"/img/sub/jd2_intro_out.jpg\" alt=\"\"></p>','','',21,'2020-05-08 12:52:51','2020-06-12 01:28:42','58.224.133.171',0,0,'wear','a:8:{s:8:\"material\";s:22:\"상품페이지 참고\";s:5:\"color\";s:22:\"상품페이지 참고\";s:4:\"size\";s:22:\"상품페이지 참고\";s:5:\"maker\";s:22:\"상품페이지 참고\";s:7:\"caution\";s:22:\"상품페이지 참고\";s:16:\"manufacturing_ym\";s:22:\"상품페이지 참고\";s:8:\"warranty\";s:22:\"상품페이지 참고\";s:2:\"as\";s:22:\"상품페이지 참고\";}',0,0,0.0,'','','1589775634/T_4571157255422.jpg','','','','','','','','','','','','','','','','','','','','','','','','','','','','',''),('1589775637','40','4080','20','','','아사히 에비오스 1200/2000정','아사히-에비오스-12002000정','','','','','','',0,1,0,0,1,'일본은 몰라도 파스는 안다','','','',22700,34050,0,0,0,0,'',1,0,0,99999,0,0,4,0,10000,0,6,0,0,'','<h3 style=\"text-align:center;\" align=\"center\">★★필독사항★★&nbsp;</h3>\r\n<div style=\"margin:15px 0 30px;padding:20px;border:1px solid #eee;line-height:1.8;\">\r\n<p><u>필독사항 미확인으로 인한 문제는 당사에서 도움드릴 수 없는 점 꼭 참고해주세요.</u></p>\r\n<p>(1) 결제금액에는 관세 · 부가세가 포함되어 있지 않습니다.&nbsp;</p>\r\n<p>(2) 받는 분 정보란에 반드시 실명, 받는 분의 개인통관고유번호, 휴대전화번호를 기재해주셔야 합니다.&nbsp;</p>\r\n<p>(3) 건강 · 서플리먼트 상품인 의약품, 의약외품은 1회 주문 시 관세법상 개인사용 목적으로 6개까지만 통관이 가능합니다.<br> &nbsp;  &nbsp; &nbsp;\r\n3개 세트상품은 3개로 책정됩니다.(6개 초과 시 세관에서 폐기처분되며, 이때 발생하는 모든 비용은 구매자가 부담하게 됩니다.)&nbsp;</p>\r\n<p>(4) 배송비를 제외한 상품금액 150$(한화 17만 원) 이상이면 관 · 부가세가 발생할 수 있으므로 주의해주세요.</p>\r\n</div>\r\n<p style=\"text-align:center;\" align=\"center\"><img src=\"/img/sub/jd2_intro_out.jpg\" alt=\"\"></p>','','',38,'2020-05-08 12:52:51','2020-06-12 01:28:03','58.224.133.171',0,0,'wear','a:8:{s:8:\"material\";s:22:\"상품페이지 참고\";s:5:\"color\";s:22:\"상품페이지 참고\";s:4:\"size\";s:22:\"상품페이지 참고\";s:5:\"maker\";s:22:\"상품페이지 참고\";s:7:\"caution\";s:22:\"상품페이지 참고\";s:16:\"manufacturing_ym\";s:22:\"상품페이지 참고\";s:8:\"warranty\";s:22:\"상품페이지 참고\";s:2:\"as\";s:22:\"상품페이지 참고\";}',0,1,5.0,'','','1589775637/1000000571_main_069.jpg','','','','','','','','','','','','','','','','','','','','','','','','','','','','',''),('1591948118','40','4040','','','','반테린 코와 파스 액체 EX 90g','반테린-코와-파스-액체-ex-90g-2','','','','','','',0,1,1,0,1,'반테린 코와 파스 액체 EX 90g반테린 코와 파스 액체 EX 90g','','','',45450,30300,0,0,0,0,'',0,0,0,99999,0,0,0,0,0,0,0,0,0,'','<h3 style=\"text-align:center;\" align=\"center\">★★필독사항★★&nbsp;</h3>\r\n<div style=\"margin:15px 0 30px;padding:20px;border:1px solid #eee;line-height:1.8;\">\r\n<p><u>필독사항 미확인으로 인한 문제는 당사에서 도움드릴 수 없는 점 꼭 참고해주세요.</u></p>\r\n<p>(1) 결제금액에는 관세 · 부가세가 포함되어 있지 않습니다.&nbsp;</p>\r\n<p>(2) 받는 분 정보란에 반드시 실명, 받는 분의 개인통관고유번호, 휴대전화번호를 기재해주셔야 합니다.&nbsp;</p>\r\n<p>(3) 건강 · 서플리먼트 상품인 의약품, 의약외품은 1회 주문 시 관세법상 개인사용 목적으로 6개까지만 통관이 가능합니다.<br> &nbsp;  &nbsp; &nbsp;\r\n3개 세트상품은 3개로 책정됩니다.(6개 초과 시 세관에서 폐기처분되며, 이때 발생하는 모든 비용은 구매자가 부담하게 됩니다.)&nbsp;</p>\r\n<p>(4) 배송비를 제외한 상품금액 150$(한화 17만 원) 이상이면 관 · 부가세가 발생할 수 있으므로 주의해주세요.</p>\r\n</div>\r\n<p style=\"text-align:center;\" align=\"center\"><img src=\"/img/sub/jd2_intro_out.jpg\" alt=\"\"></p>','','',23,'2020-05-08 12:52:51','2020-06-12 16:50:08','121.173.199.59',0,0,'wear','a:8:{s:8:\"material\";s:22:\"상품페이지 참고\";s:5:\"color\";s:22:\"상품페이지 참고\";s:4:\"size\";s:22:\"상품페이지 참고\";s:5:\"maker\";s:22:\"상품페이지 참고\";s:7:\"caution\";s:22:\"상품페이지 참고\";s:16:\"manufacturing_ym\";s:22:\"상품페이지 참고\";s:8:\"warranty\";s:22:\"상품페이지 참고\";s:2:\"as\";s:22:\"상품페이지 참고\";}',0,0,0.0,'','','1591948118/T_4987067214303.jpg','','','','','','','','','','','','','','','','','','','','','','','','','','','','',''),('1591948186','40','4040','','','','반테린 코와 파스 액체 EX 90g','반테린-코와-파스-액체-ex-90g-1','','','','','','',0,1,1,0,1,'반테린 코와 파스 액체 EX 90g반테린 코와 파스 액체 EX 90g','','','',45450,30300,0,0,0,0,'',0,0,0,99999,0,0,0,0,0,0,0,0,0,'','<h3 style=\"text-align:center;\" align=\"center\">★★필독사항★★&nbsp;</h3>\r\n<div style=\"margin:15px 0 30px;padding:20px;border:1px solid #eee;line-height:1.8;\">\r\n<p><u>필독사항 미확인으로 인한 문제는 당사에서 도움드릴 수 없는 점 꼭 참고해주세요.</u></p>\r\n<p>(1) 결제금액에는 관세 · 부가세가 포함되어 있지 않습니다.&nbsp;</p>\r\n<p>(2) 받는 분 정보란에 반드시 실명, 받는 분의 개인통관고유번호, 휴대전화번호를 기재해주셔야 합니다.&nbsp;</p>\r\n<p>(3) 건강 · 서플리먼트 상품인 의약품, 의약외품은 1회 주문 시 관세법상 개인사용 목적으로 6개까지만 통관이 가능합니다.<br> &nbsp;  &nbsp; &nbsp;\r\n3개 세트상품은 3개로 책정됩니다.(6개 초과 시 세관에서 폐기처분되며, 이때 발생하는 모든 비용은 구매자가 부담하게 됩니다.)&nbsp;</p>\r\n<p>(4) 배송비를 제외한 상품금액 150$(한화 17만 원) 이상이면 관 · 부가세가 발생할 수 있으므로 주의해주세요.</p>\r\n</div>\r\n<p style=\"text-align:center;\" align=\"center\"><img src=\"/img/sub/jd2_intro_out.jpg\" alt=\"\"></p>','','',23,'2020-05-08 12:52:51','2020-06-12 16:50:08','121.173.199.59',0,0,'wear','a:8:{s:8:\"material\";s:22:\"상품페이지 참고\";s:5:\"color\";s:22:\"상품페이지 참고\";s:4:\"size\";s:22:\"상품페이지 참고\";s:5:\"maker\";s:22:\"상품페이지 참고\";s:7:\"caution\";s:22:\"상품페이지 참고\";s:16:\"manufacturing_ym\";s:22:\"상품페이지 참고\";s:8:\"warranty\";s:22:\"상품페이지 참고\";s:2:\"as\";s:22:\"상품페이지 참고\";}',0,0,0.0,'','','1591948186/T_4987067214303.jpg','','','','','','','','','','','','','','','','','','','','','','','','','','','','','');
/*!40000 ALTER TABLE `g5_shop_item` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `g5_shop_item_option`
--

DROP TABLE IF EXISTS `g5_shop_item_option`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `g5_shop_item_option` (
  `io_no` int(11) NOT NULL AUTO_INCREMENT,
  `io_id` varchar(255) NOT NULL DEFAULT '0',
  `io_type` tinyint(4) NOT NULL DEFAULT '0',
  `it_id` varchar(20) NOT NULL DEFAULT '',
  `io_price` int(11) NOT NULL DEFAULT '0',
  `io_stock_qty` int(11) NOT NULL DEFAULT '0',
  `io_noti_qty` int(11) NOT NULL DEFAULT '0',
  `io_use` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`io_no`),
  KEY `io_id` (`io_id`),
  KEY `it_id` (`it_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `g5_shop_item_option`
--

LOCK TABLES `g5_shop_item_option` WRITE;
/*!40000 ALTER TABLE `g5_shop_item_option` DISABLE KEYS */;
/*!40000 ALTER TABLE `g5_shop_item_option` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `g5_shop_item_qa`
--

DROP TABLE IF EXISTS `g5_shop_item_qa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `g5_shop_item_qa` (
  `iq_id` int(11) NOT NULL AUTO_INCREMENT,
  `it_id` varchar(20) NOT NULL DEFAULT '',
  `mb_id` varchar(255) NOT NULL DEFAULT '',
  `iq_secret` tinyint(4) NOT NULL DEFAULT '0',
  `iq_name` varchar(255) NOT NULL DEFAULT '',
  `iq_email` varchar(255) NOT NULL DEFAULT '',
  `iq_hp` varchar(255) NOT NULL DEFAULT '',
  `iq_password` varchar(255) NOT NULL DEFAULT '',
  `iq_subject` varchar(255) NOT NULL DEFAULT '',
  `iq_question` text NOT NULL,
  `iq_answer` text NOT NULL,
  `iq_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `iq_ip` varchar(25) NOT NULL DEFAULT '',
  PRIMARY KEY (`iq_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `g5_shop_item_qa`
--

LOCK TABLES `g5_shop_item_qa` WRITE;
/*!40000 ALTER TABLE `g5_shop_item_qa` DISABLE KEYS */;
/*!40000 ALTER TABLE `g5_shop_item_qa` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `g5_shop_item_relation`
--

DROP TABLE IF EXISTS `g5_shop_item_relation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `g5_shop_item_relation` (
  `it_id` varchar(20) NOT NULL DEFAULT '',
  `it_id2` varchar(20) NOT NULL DEFAULT '',
  `ir_no` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`it_id`,`it_id2`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `g5_shop_item_relation`
--

LOCK TABLES `g5_shop_item_relation` WRITE;
/*!40000 ALTER TABLE `g5_shop_item_relation` DISABLE KEYS */;
INSERT INTO `g5_shop_item_relation` VALUES ('1588926247','1588929503',0),('1588929503','1588926247',0),('1588929503','1589775637',0),('1589775637','1588929503',0);
/*!40000 ALTER TABLE `g5_shop_item_relation` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `g5_shop_item_stocksms`
--

DROP TABLE IF EXISTS `g5_shop_item_stocksms`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `g5_shop_item_stocksms` (
  `ss_id` int(11) NOT NULL AUTO_INCREMENT,
  `it_id` varchar(20) NOT NULL DEFAULT '',
  `ss_hp` varchar(255) NOT NULL DEFAULT '',
  `ss_send` tinyint(4) NOT NULL DEFAULT '0',
  `ss_send_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `ss_datetime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `ss_ip` varchar(25) NOT NULL DEFAULT '',
  PRIMARY KEY (`ss_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `g5_shop_item_stocksms`
--

LOCK TABLES `g5_shop_item_stocksms` WRITE;
/*!40000 ALTER TABLE `g5_shop_item_stocksms` DISABLE KEYS */;
/*!40000 ALTER TABLE `g5_shop_item_stocksms` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `g5_shop_item_use`
--

DROP TABLE IF EXISTS `g5_shop_item_use`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `g5_shop_item_use` (
  `is_id` int(11) NOT NULL AUTO_INCREMENT,
  `it_id` varchar(20) NOT NULL DEFAULT '0',
  `mb_id` varchar(255) NOT NULL DEFAULT '',
  `is_name` varchar(255) NOT NULL DEFAULT '',
  `is_password` varchar(255) NOT NULL DEFAULT '',
  `is_score` tinyint(4) NOT NULL DEFAULT '0',
  `is_subject` varchar(255) NOT NULL DEFAULT '',
  `is_content` text NOT NULL,
  `is_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `is_ip` varchar(25) NOT NULL DEFAULT '',
  `is_confirm` tinyint(4) NOT NULL DEFAULT '0',
  `is_reply_subject` varchar(255) NOT NULL DEFAULT '',
  `is_reply_content` text NOT NULL,
  `is_reply_name` varchar(25) NOT NULL DEFAULT '',
  PRIMARY KEY (`is_id`),
  KEY `index1` (`it_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `g5_shop_item_use`
--

LOCK TABLES `g5_shop_item_use` WRITE;
/*!40000 ALTER TABLE `g5_shop_item_use` DISABLE KEYS */;
INSERT INTO `g5_shop_item_use` VALUES (1,'1588909839','admin','관리자','sha256:12000:uXV1a5KGB3cu0qyBeTVJ1EC+dp8TTloE:5+QN27GcAOaiDh+LqIatlOctEoBv9P7X',5,'TEST','<p>TEST<br></p>','2020-05-25 14:41:40','121.173.199.59',1,'','','관리자'),(2,'1589775637','admin','관리자','sha256:12000:uXV1a5KGB3cu0qyBeTVJ1EC+dp8TTloE:5+QN27GcAOaiDh+LqIatlOctEoBv9P7X',5,'GOOD GOOD~~~','<p>GOODGOODGOOD<br></p>','2020-05-28 11:37:06','121.173.199.59',1,'','','');
/*!40000 ALTER TABLE `g5_shop_item_use` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `g5_shop_order`
--

DROP TABLE IF EXISTS `g5_shop_order`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `g5_shop_order` (
  `od_id` bigint(20) unsigned NOT NULL,
  `mb_id` varchar(255) NOT NULL DEFAULT '',
  `od_name` varchar(20) NOT NULL DEFAULT '',
  `od_email` varchar(100) NOT NULL DEFAULT '',
  `od_tel` varchar(20) NOT NULL DEFAULT '',
  `od_hp` varchar(20) NOT NULL DEFAULT '',
  `od_zip1` char(3) NOT NULL DEFAULT '',
  `od_zip2` char(3) NOT NULL DEFAULT '',
  `od_addr1` varchar(100) NOT NULL DEFAULT '',
  `od_addr2` varchar(100) NOT NULL DEFAULT '',
  `od_addr3` varchar(255) NOT NULL DEFAULT '',
  `od_addr_jibeon` varchar(255) NOT NULL DEFAULT '',
  `od_deposit_name` varchar(20) NOT NULL DEFAULT '',
  `od_b_name` varchar(20) NOT NULL DEFAULT '',
  `od_b_tel` varchar(20) NOT NULL DEFAULT '',
  `od_b_hp` varchar(20) NOT NULL DEFAULT '',
  `od_b_zip1` char(3) NOT NULL DEFAULT '',
  `od_b_zip2` char(3) NOT NULL DEFAULT '',
  `od_b_addr1` varchar(100) NOT NULL DEFAULT '',
  `od_b_addr2` varchar(100) NOT NULL DEFAULT '',
  `od_b_addr3` varchar(255) NOT NULL DEFAULT '',
  `od_b_addr_jibeon` varchar(255) NOT NULL DEFAULT '',
  `od_memo` text NOT NULL,
  `od_cart_count` int(11) NOT NULL DEFAULT '0',
  `od_cart_price` int(11) NOT NULL DEFAULT '0',
  `od_cart_coupon` int(11) NOT NULL DEFAULT '0',
  `od_send_cost` int(11) NOT NULL DEFAULT '0',
  `od_send_cost2` int(11) NOT NULL DEFAULT '0',
  `od_send_coupon` int(11) NOT NULL DEFAULT '0',
  `od_receipt_price` int(11) NOT NULL DEFAULT '0',
  `od_cancel_price` int(11) NOT NULL DEFAULT '0',
  `od_receipt_point` int(11) NOT NULL DEFAULT '0',
  `od_refund_price` int(11) NOT NULL DEFAULT '0',
  `od_bank_account` varchar(255) NOT NULL DEFAULT '',
  `od_receipt_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `od_coupon` int(11) NOT NULL DEFAULT '0',
  `od_misu` int(11) NOT NULL DEFAULT '0',
  `od_shop_memo` text NOT NULL,
  `od_mod_history` text NOT NULL,
  `od_status` varchar(255) NOT NULL DEFAULT '',
  `od_hope_date` date NOT NULL DEFAULT '0000-00-00',
  `od_settle_case` varchar(255) NOT NULL DEFAULT '',
  `od_test` tinyint(4) NOT NULL DEFAULT '0',
  `od_mobile` tinyint(4) NOT NULL DEFAULT '0',
  `od_pg` varchar(255) NOT NULL DEFAULT '',
  `od_tno` varchar(255) NOT NULL DEFAULT '',
  `od_app_no` varchar(20) NOT NULL DEFAULT '',
  `od_escrow` tinyint(4) NOT NULL DEFAULT '0',
  `od_casseqno` varchar(255) NOT NULL DEFAULT '',
  `od_tax_flag` tinyint(4) NOT NULL DEFAULT '0',
  `od_tax_mny` int(11) NOT NULL DEFAULT '0',
  `od_vat_mny` int(11) NOT NULL DEFAULT '0',
  `od_free_mny` int(11) NOT NULL DEFAULT '0',
  `od_delivery_company` varchar(255) NOT NULL DEFAULT '0',
  `od_invoice` varchar(255) NOT NULL DEFAULT '',
  `od_invoice_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `od_cash` tinyint(4) NOT NULL,
  `od_cash_no` varchar(255) NOT NULL,
  `od_cash_info` text NOT NULL,
  `od_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `od_pwd` varchar(255) NOT NULL DEFAULT '',
  `od_ip` varchar(25) NOT NULL DEFAULT '',
  PRIMARY KEY (`od_id`),
  KEY `index2` (`mb_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `g5_shop_order`
--

LOCK TABLES `g5_shop_order` WRITE;
/*!40000 ALTER TABLE `g5_shop_order` DISABLE KEYS */;
INSERT INTO `g5_shop_order` VALUES (2020061201434084,'admin','박상열','dme1004@gmail.com','010-5235-4356','010-5235-4356','078','03','서울 강서구 강서로 375','ㅁㄴㅇㄹ',' (마곡동)','R','박상열','박상열','010-5235-4356','010-5235-4356','078','03','서울 강서구 강서로 375','ㅁㄴㅇㄹ',' (마곡동)','R','ㅅㄷㄴㅅ',1,204300,0,10000,0,0,0,0,0,0,'신한은행 140-012-668442 예금주명 주식회사 유엠씨코리아','0000-00-00 00:00:00',0,214300,'','','주문','0000-00-00','무통장',1,0,'kcp','','',0,'',0,194818,19482,0,'0','','0000-00-00 00:00:00',0,'','','2020-06-12 01:44:13','sha256:12000:uXV1a5KGB3cu0qyBeTVJ1EC+dp8TTloE:5+QN27GcAOaiDh+LqIatlOctEoBv9P7X','58.224.133.171'),(2020061201515189,'admin','관리자','dme1004@gmail.com','010-5235-4356','','429','57','대구 달성군 화원읍 류목정길 5','102dong 1003ho',' (설화리)','R','관리자','관리자','010-5235-4356','','429','57','대구 달성군 화원읍 류목정길 5','102dong 1003ho',' (설화리)','R','',1,51100,0,40000,0,0,0,0,0,0,'신한은행 140-012-668442 예금주명 주식회사 유엠씨코리아','0000-00-00 00:00:00',0,91100,'','','주문','0000-00-00','무통장',1,0,'kcp','','',0,'',0,82818,8282,0,'0','','0000-00-00 00:00:00',0,'','','2020-06-12 01:52:19','sha256:12000:uXV1a5KGB3cu0qyBeTVJ1EC+dp8TTloE:5+QN27GcAOaiDh+LqIatlOctEoBv9P7X','58.224.133.171'),(2020061209294172,'','gyggy','admin@sdsds.com','01052354356','01052354356','062','67','서울 강남구 강남대로 238','',' (도곡동, 스카이쏠라빌딩)','R','gyggy','gyggy','01052354356','01052354356','062','67','서울 강남구 강남대로 238','',' (도곡동, 스카이쏠라빌딩)','R','',1,22200,0,0,0,0,0,0,0,0,'신한은행 140-012-668442 예금주명 주식회사 유엠씨코리아','0000-00-00 00:00:00',0,22200,'','','주문','0000-00-00','무통장',1,0,'kcp','','',0,'',0,20182,2018,0,'0','','0000-00-00 00:00:00',0,'','','2020-06-12 09:30:47','sha256:12000:Odg1Sdswe9T0+uKtLSXQVZMNsTYCQQMa:0pQ75nFS5seOOfAs4zisO+MkRtzrPOhs','121.173.199.59');
/*!40000 ALTER TABLE `g5_shop_order` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `g5_shop_order_address`
--

DROP TABLE IF EXISTS `g5_shop_order_address`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `g5_shop_order_address` (
  `ad_id` int(11) NOT NULL AUTO_INCREMENT,
  `mb_id` varchar(255) NOT NULL DEFAULT '',
  `ad_subject` varchar(255) NOT NULL DEFAULT '',
  `ad_default` tinyint(4) NOT NULL DEFAULT '0',
  `ad_name` varchar(255) NOT NULL DEFAULT '',
  `ad_tel` varchar(255) NOT NULL DEFAULT '',
  `ad_hp` varchar(255) NOT NULL DEFAULT '',
  `ad_zip1` char(3) NOT NULL DEFAULT '',
  `ad_zip2` char(3) NOT NULL DEFAULT '',
  `ad_addr1` varchar(255) NOT NULL DEFAULT '',
  `ad_addr2` varchar(255) NOT NULL DEFAULT '',
  `ad_addr3` varchar(255) NOT NULL DEFAULT '',
  `ad_jibeon` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`ad_id`),
  KEY `mb_id` (`mb_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `g5_shop_order_address`
--

LOCK TABLES `g5_shop_order_address` WRITE;
/*!40000 ALTER TABLE `g5_shop_order_address` DISABLE KEYS */;
INSERT INTO `g5_shop_order_address` VALUES (1,'admin','',0,'박상열','010-5235-4356','010-5235-4356','078','03','서울 강서구 강서로 375','ㅁㄴㅇㄹ',' (마곡동)','R'),(2,'admin','',0,'관리자','010-5235-4356','','429','57','대구 달성군 화원읍 류목정길 5','102dong 1003ho',' (설화리)','R');
/*!40000 ALTER TABLE `g5_shop_order_address` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `g5_shop_order_data`
--

DROP TABLE IF EXISTS `g5_shop_order_data`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `g5_shop_order_data` (
  `od_id` bigint(20) unsigned NOT NULL,
  `cart_id` bigint(20) unsigned NOT NULL,
  `mb_id` varchar(20) NOT NULL DEFAULT '',
  `dt_pg` varchar(255) NOT NULL DEFAULT '',
  `dt_data` text NOT NULL,
  `dt_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  KEY `od_id` (`od_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `g5_shop_order_data`
--

LOCK TABLES `g5_shop_order_data` WRITE;
/*!40000 ALTER TABLE `g5_shop_order_data` DISABLE KEYS */;
/*!40000 ALTER TABLE `g5_shop_order_data` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `g5_shop_order_delete`
--

DROP TABLE IF EXISTS `g5_shop_order_delete`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `g5_shop_order_delete` (
  `de_id` int(11) NOT NULL AUTO_INCREMENT,
  `de_key` varchar(255) NOT NULL DEFAULT '',
  `de_data` longtext NOT NULL,
  `mb_id` varchar(20) NOT NULL DEFAULT '',
  `de_ip` varchar(255) NOT NULL DEFAULT '',
  `de_datetime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`de_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `g5_shop_order_delete`
--

LOCK TABLES `g5_shop_order_delete` WRITE;
/*!40000 ALTER TABLE `g5_shop_order_delete` DISABLE KEYS */;
/*!40000 ALTER TABLE `g5_shop_order_delete` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `g5_shop_order_post_log`
--

DROP TABLE IF EXISTS `g5_shop_order_post_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `g5_shop_order_post_log` (
  `oid` bigint(20) unsigned NOT NULL,
  `mb_id` varchar(255) NOT NULL DEFAULT '',
  `post_data` text NOT NULL,
  `ol_code` varchar(255) NOT NULL DEFAULT '',
  `ol_msg` varchar(255) NOT NULL DEFAULT '',
  `ol_datetime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `ol_ip` varchar(25) NOT NULL DEFAULT '',
  PRIMARY KEY (`oid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `g5_shop_order_post_log`
--

LOCK TABLES `g5_shop_order_post_log` WRITE;
/*!40000 ALTER TABLE `g5_shop_order_post_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `g5_shop_order_post_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `g5_shop_personalpay`
--

DROP TABLE IF EXISTS `g5_shop_personalpay`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `g5_shop_personalpay` (
  `pp_id` bigint(20) unsigned NOT NULL,
  `od_id` bigint(20) unsigned NOT NULL,
  `pp_name` varchar(255) NOT NULL DEFAULT '',
  `pp_email` varchar(255) NOT NULL DEFAULT '',
  `pp_hp` varchar(255) NOT NULL DEFAULT '',
  `pp_content` text NOT NULL,
  `pp_use` tinyint(4) NOT NULL DEFAULT '0',
  `pp_price` int(11) NOT NULL DEFAULT '0',
  `pp_pg` varchar(255) NOT NULL DEFAULT '',
  `pp_tno` varchar(255) NOT NULL DEFAULT '',
  `pp_app_no` varchar(20) NOT NULL DEFAULT '',
  `pp_casseqno` varchar(255) NOT NULL DEFAULT '',
  `pp_receipt_price` int(11) NOT NULL DEFAULT '0',
  `pp_settle_case` varchar(255) NOT NULL DEFAULT '',
  `pp_bank_account` varchar(255) NOT NULL DEFAULT '',
  `pp_deposit_name` varchar(255) NOT NULL DEFAULT '',
  `pp_receipt_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `pp_receipt_ip` varchar(255) NOT NULL DEFAULT '',
  `pp_shop_memo` text NOT NULL,
  `pp_cash` tinyint(4) NOT NULL DEFAULT '0',
  `pp_cash_no` varchar(255) NOT NULL DEFAULT '',
  `pp_cash_info` text NOT NULL,
  `pp_ip` varchar(255) NOT NULL DEFAULT '',
  `pp_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`pp_id`),
  KEY `od_id` (`od_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `g5_shop_personalpay`
--

LOCK TABLES `g5_shop_personalpay` WRITE;
/*!40000 ALTER TABLE `g5_shop_personalpay` DISABLE KEYS */;
/*!40000 ALTER TABLE `g5_shop_personalpay` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `g5_shop_sendcost`
--

DROP TABLE IF EXISTS `g5_shop_sendcost`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `g5_shop_sendcost` (
  `sc_id` int(11) NOT NULL AUTO_INCREMENT,
  `sc_name` varchar(255) NOT NULL DEFAULT '',
  `sc_zip1` varchar(10) NOT NULL DEFAULT '',
  `sc_zip2` varchar(10) NOT NULL DEFAULT '',
  `sc_price` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`sc_id`),
  KEY `sc_zip1` (`sc_zip1`),
  KEY `sc_zip2` (`sc_zip2`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `g5_shop_sendcost`
--

LOCK TABLES `g5_shop_sendcost` WRITE;
/*!40000 ALTER TABLE `g5_shop_sendcost` DISABLE KEYS */;
/*!40000 ALTER TABLE `g5_shop_sendcost` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `g5_shop_wish`
--

DROP TABLE IF EXISTS `g5_shop_wish`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `g5_shop_wish` (
  `wi_id` int(11) NOT NULL AUTO_INCREMENT,
  `mb_id` varchar(255) NOT NULL DEFAULT '',
  `it_id` varchar(20) NOT NULL DEFAULT '0',
  `wi_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `wi_ip` varchar(25) NOT NULL DEFAULT '',
  PRIMARY KEY (`wi_id`),
  KEY `index1` (`mb_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `g5_shop_wish`
--

LOCK TABLES `g5_shop_wish` WRITE;
/*!40000 ALTER TABLE `g5_shop_wish` DISABLE KEYS */;
INSERT INTO `g5_shop_wish` VALUES (1,'admin','1588926247','2020-05-08 18:00:36','121.173.199.59'),(2,'admin','1588909839','2020-05-08 18:01:10','121.173.199.59'),(3,'admin','1589775637','2020-05-21 12:09:13','211.215.167.149'),(4,'admin','1589775634','2020-06-08 10:10:12','121.173.199.59'),(5,'admin','1589775430','2020-06-12 00:32:20','58.224.133.171');
/*!40000 ALTER TABLE `g5_shop_wish` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `g5_uniqid`
--

DROP TABLE IF EXISTS `g5_uniqid`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `g5_uniqid` (
  `uq_id` bigint(20) unsigned NOT NULL,
  `uq_ip` varchar(255) NOT NULL,
  PRIMARY KEY (`uq_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `g5_uniqid`
--

LOCK TABLES `g5_uniqid` WRITE;
/*!40000 ALTER TABLE `g5_uniqid` DISABLE KEYS */;
INSERT INTO `g5_uniqid` VALUES (2020032501341418,'58.224.133.171'),(2020040123022949,'58.224.133.171'),(2020040123025525,'58.224.133.171'),(2020040200381958,'58.224.133.171'),(2020041010523899,'121.173.199.59'),(2020041710334800,'121.173.199.59'),(2020042115350524,'121.173.199.59'),(2020042410502339,'121.173.199.59'),(2020042411184480,'121.173.199.59'),(2020042411214984,'121.173.199.59'),(2020042712462838,'121.173.199.59'),(2020042809581390,'121.173.199.59'),(2020042911092029,'121.173.199.59'),(2020042911355785,'121.173.199.59'),(2020050710465104,'121.173.199.59'),(2020050718463310,'58.224.133.171'),(2020050811252973,'121.173.199.59'),(2020050814141969,'211.215.167.149'),(2020051120104698,'58.224.133.171'),(2020051120161888,'58.224.133.171'),(2020051121160522,'58.224.133.171'),(2020051217071614,'211.215.167.149'),(2020051412143286,'211.215.167.149'),(2020051809523671,'121.173.199.59'),(2020051812442313,'121.173.199.59'),(2020051816381995,'121.173.199.59'),(2020051817142297,'121.173.199.59'),(2020051817152297,'121.173.199.59'),(2020051817161617,'121.173.199.59'),(2020051817163533,'121.173.199.59'),(2020051911085508,'121.173.199.59'),(2020051913004381,'121.173.199.59'),(2020051913294441,'121.173.199.59'),(2020051913543205,'121.173.199.59'),(2020051914063359,'121.173.199.59'),(2020051914115140,'121.173.199.59'),(2020051914121759,'121.173.199.59'),(2020051914123636,'121.173.199.59'),(2020051914125675,'121.173.199.59'),(2020051914131102,'121.173.199.59'),(2020051914133489,'121.173.199.59'),(2020051914135009,'121.173.199.59'),(2020051914140316,'121.173.199.59'),(2020051914144578,'121.173.199.59'),(2020051914160333,'121.173.199.59'),(2020051914164050,'121.173.199.59'),(2020051914283235,'121.173.199.59'),(2020051915090995,'211.215.167.149'),(2020051915125437,'211.215.167.149'),(2020051915165245,'61.82.191.161'),(2020051921192317,'110.70.55.172'),(2020051921192431,'61.82.191.161'),(2020051921554630,'58.29.81.12'),(2020052009040193,'61.82.191.161'),(2020052009291229,'61.82.191.161'),(2020052009303424,'61.82.191.161'),(2020052009310701,'61.82.191.161'),(2020052009311209,'61.82.191.161'),(2020052010110005,'61.82.191.161'),(2020052011304791,'61.82.191.161'),(2020052011310756,'61.82.191.161'),(2020052011311375,'61.82.191.161'),(2020052011332187,'121.173.199.59'),(2020052011580434,'61.82.191.161'),(2020052011580773,'61.82.191.161'),(2020052013402342,'110.70.55.172'),(2020052013413714,'110.70.55.172'),(2020052013463689,'223.62.163.246'),(2020052013473734,'61.82.191.161'),(2020052013534654,'61.82.191.161'),(2020052014013849,'61.82.191.161'),(2020052014025632,'61.82.191.161'),(2020052014212044,'61.82.191.161'),(2020052014275201,'61.82.191.161'),(2020052015460595,'121.173.199.59'),(2020052018421028,'121.173.199.59'),(2020052018460832,'121.173.199.59'),(2020052018503852,'121.173.199.59'),(2020052112043095,'61.82.191.161'),(2020052112081384,'211.215.167.149'),(2020052117003881,'61.82.191.161'),(2020052210395041,'121.173.199.59'),(2020052213103703,'121.173.199.59'),(2020052213211222,'121.173.199.59'),(2020052213211245,'121.173.199.59'),(2020052213213073,'121.173.199.59'),(2020052213214036,'121.173.199.59'),(2020052213214901,'121.173.199.59'),(2020052213225082,'121.173.199.59'),(2020052213234848,'121.173.199.59'),(2020052213363742,'121.173.199.59'),(2020052213393182,'121.173.199.59'),(2020052213400247,'121.173.199.59'),(2020052216541722,'223.38.41.155'),(2020052217063138,'61.82.191.161'),(2020052217340451,'61.82.191.161'),(2020052217344286,'61.82.191.161'),(2020052217363067,'121.173.199.59'),(2020052217433090,'61.82.191.161'),(2020052217512077,'223.38.22.13'),(2020052217521561,'223.38.22.13'),(2020052302483025,'211.176.125.70'),(2020052513502217,'121.173.199.59'),(2020052514155587,'121.173.199.59'),(2020052516294986,'121.173.199.59'),(2020052516491895,'121.173.199.59'),(2020052516513063,'121.173.199.59'),(2020052516521760,'121.173.199.59'),(2020052516550298,'121.173.199.59'),(2020052516561177,'121.173.199.59'),(2020052516570084,'121.173.199.59'),(2020052516574232,'121.173.199.59'),(2020052517050779,'121.173.199.59'),(2020052517114244,'121.173.199.59'),(2020052517155206,'121.173.199.59'),(2020052517155560,'121.173.199.59'),(2020052517155710,'121.173.199.59'),(2020052517195653,'121.173.199.59'),(2020052517223188,'121.173.199.59'),(2020052517341678,'121.173.199.59'),(2020052517381495,'121.173.199.59'),(2020052613465032,'121.173.199.59'),(2020052811173214,'121.173.199.59'),(2020052811242656,'121.173.199.59'),(2020052813060750,'121.173.199.59'),(2020052813095490,'121.173.199.59'),(2020052813555694,'121.173.199.59'),(2020052815041246,'121.173.199.59'),(2020052914414684,'61.82.191.161'),(2020060111133222,'121.173.199.59'),(2020060116322496,'61.82.191.161'),(2020060116371232,'61.82.191.161'),(2020060313543085,'61.82.191.161'),(2020060500325388,'211.202.43.197'),(2020060500405473,'211.202.43.197'),(2020060500580800,'211.202.43.197'),(2020060501003428,'211.202.43.197'),(2020060622011097,'125.182.12.32'),(2020060713561705,'125.182.12.32'),(2020060714060292,'125.182.12.32'),(2020060800102897,'211.202.43.197'),(2020060800273189,'211.202.43.197'),(2020060800433190,'211.202.43.197'),(2020060810093555,'121.173.199.59'),(2020060910455201,'121.173.199.59'),(2020060910462577,'121.173.199.59'),(2020061110140451,'121.173.199.59'),(2020061115482892,'121.173.199.59'),(2020061115501248,'121.173.199.59'),(2020061116334811,'121.173.199.59'),(2020061200132743,'58.224.133.171'),(2020061200584995,'58.224.133.171'),(2020061200591066,'58.224.133.171'),(2020061201415723,'58.224.133.171'),(2020061201434084,'58.224.133.171'),(2020061201503681,'58.224.133.171'),(2020061201503703,'58.224.133.171'),(2020061201512187,'58.224.133.171'),(2020061201515189,'58.224.133.171'),(2020061202422359,'58.224.133.171'),(2020061202495875,'58.224.133.171'),(2020061202513204,'58.224.133.171'),(2020061202530193,'58.224.133.171'),(2020061202530390,'58.224.133.171'),(2020061202531838,'58.224.133.171'),(2020061202532391,'58.224.133.171'),(2020061202544776,'58.224.133.171'),(2020061202565105,'58.224.133.171'),(2020061202571045,'58.224.133.171'),(2020061202572791,'58.224.133.171'),(2020061202575318,'58.224.133.171'),(2020061209293600,'121.173.199.59'),(2020061209294172,'121.173.199.59'),(2020061209310662,'121.173.199.59'),(2020061209310969,'121.173.199.59'),(2020062213454724,'121.173.199.59'),(2020062216010085,'121.173.199.59'),(2020062316212663,'121.173.199.59'),(2020062421465916,'58.224.133.171'),(2020062514422868,'121.173.199.59');
/*!40000 ALTER TABLE `g5_uniqid` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `g5_visit`
--

DROP TABLE IF EXISTS `g5_visit`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `g5_visit` (
  `vi_id` int(11) NOT NULL DEFAULT '0',
  `vi_ip` varchar(100) NOT NULL DEFAULT '',
  `vi_date` date NOT NULL DEFAULT '0000-00-00',
  `vi_time` time NOT NULL DEFAULT '00:00:00',
  `vi_referer` text NOT NULL,
  `vi_agent` varchar(200) NOT NULL DEFAULT '',
  `vi_browser` varchar(255) NOT NULL DEFAULT '',
  `vi_os` varchar(255) NOT NULL DEFAULT '',
  `vi_device` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`vi_id`),
  UNIQUE KEY `index1` (`vi_ip`,`vi_date`),
  KEY `index2` (`vi_date`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `g5_visit`
--

LOCK TABLES `g5_visit` WRITE;
/*!40000 ALTER TABLE `g5_visit` DISABLE KEYS */;
INSERT INTO `g5_visit` VALUES (1,'58.224.133.171','2020-03-25','01:55:05','','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/80.0.3987.149 Safari/537.36','','',''),(2,'121.173.199.59','2020-03-26','11:39:26','','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/80.0.3987.149 Safari/537.36','','',''),(3,'58.224.133.171','2020-04-01','22:54:20','','Mozilla/5.0 (Windows NT 10.0; WOW64; Trident/7.0; rv:11.0) like Gecko','','',''),(4,'121.173.199.59','2020-04-10','10:52:08','','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/80.0.3987.163 Safari/537.36','','',''),(5,'121.173.199.59','2020-04-17','10:32:25','','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/80.0.3987.163 Safari/537.36','','',''),(6,'121.173.199.59','2020-04-20','10:01:26','http://jp1.bksoft.kr/','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/80.0.3987.163 Safari/537.36','','',''),(7,'121.173.199.59','2020-04-21','15:18:57','','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/80.0.3987.163 Safari/537.36','','',''),(8,'121.173.199.59','2020-04-24','10:49:23','','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/81.0.4044.122 Safari/537.36','','',''),(9,'121.173.199.59','2020-04-27','10:08:05','http://jp1.bksoft.kr/bbs/login.php','Mozilla/5.0 (Windows NT 10.0; WOW64; Trident/7.0; rv:11.0) like Gecko','','',''),(10,'121.173.199.59','2020-04-28','13:07:31','http://jp1.bksoft.kr/adm/session_file_delete.php','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/81.0.4044.129 Safari/537.36','','',''),(11,'121.173.199.59','2020-04-29','11:34:45','','Mozilla/5.0 (Windows NT 10.0; WOW64; Trident/7.0; rv:11.0) like Gecko','','',''),(12,'121.173.199.59','2020-05-07','10:02:15','','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/81.0.4044.129 Safari/537.36','','',''),(13,'58.224.133.171','2020-05-07','18:45:29','','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/81.0.4044.129 Safari/537.36','','',''),(14,'27.0.238.182','2020-05-07','18:46:45','','facebookexternalhit/1.1; kakaotalk-scrap/1.0; +https://devtalk.kakao.com/t/scrap/33984','','',''),(15,'121.173.199.59','2020-05-08','10:02:32','','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/81.0.4044.138 Safari/537.36','','',''),(16,'211.231.103.91','2020-05-08','11:51:48','','facebookexternalhit/1.1; kakaotalk-scrap/1.0; +https://devtalk.kakao.com/t/scrap/33984','','',''),(17,'211.215.167.149','2020-05-08','14:13:55','','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/81.0.4044.129 Safari/537.36','','',''),(18,'203.226.253.198','2020-05-08','16:31:21','','Java/1.8.0_162','','',''),(19,'211.176.125.70','2020-05-08','18:18:12','','Mozilla/5.0 (compatible; MSIE 10.0; Windows NT 6.2; Trident/6.0)','','',''),(20,'223.38.23.253','2020-05-11','13:17:24','','NTWebPageAssist/1.0 (Linux; Android;) Mobile Safari','','',''),(21,'223.38.27.225','2020-05-11','13:24:03','','NTWebPageAssist/1.0 (Linux; Android;) Mobile Safari','','',''),(22,'58.224.133.171','2020-05-11','20:10:21','','Mozilla/5.0 (Windows NT 10.0; WOW64; Trident/7.0; rv:11.0) like Gecko','','',''),(23,'211.215.167.149','2020-05-12','17:06:59','','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/80.0.3987.163 Whale/2.7.98.27 Safari/537.36','','',''),(24,'211.249.201.229','2020-05-13','21:56:00','','facebookexternalhit/1.1; kakaotalk-scrap/1.0; +https://devtalk.kakao.com/t/scrap/33984','','',''),(25,'211.215.167.149','2020-05-14','12:13:38','','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/81.0.4044.138 Safari/537.36','','',''),(26,'211.176.125.70','2020-05-14','18:26:29','','Mozilla/5.0 (compatible; MSIE 10.0; Windows NT 6.2; Trident/6.0)','','',''),(27,'121.173.199.59','2020-05-18','09:49:39','','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/81.0.4044.138 Safari/537.36','','',''),(28,'121.173.199.59','2020-05-19','10:57:59','','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/81.0.4044.138 Safari/537.36','','',''),(29,'211.215.167.149','2020-05-19','15:07:11','','Mozilla/5.0 (Windows NT 6.1; WOW64; Trident/7.0; rv:11.0) like Gecko','','',''),(30,'211.249.204.138','2020-05-19','15:15:26','','facebookexternalhit/1.1; kakaotalk-scrap/1.0; +https://devtalk.kakao.com/t/scrap/33984','','',''),(31,'61.82.191.161','2020-05-19','15:16:27','','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/70.0.3538.102 Safari/537.36 Edge/18.18362','','',''),(32,'203.226.253.198','2020-05-19','15:18:23','','Java/1.8.0_162','','',''),(33,'223.62.11.98','2020-05-19','15:19:11','','WebInfoUtil/1.0 (Linux; Android;) Mobile Safari','','',''),(34,'211.249.205.141','2020-05-19','21:18:27','','facebookexternalhit/1.1; kakaotalk-scrap/1.0; +https://devtalk.kakao.com/t/scrap/33984','','',''),(35,'110.70.55.172','2020-05-19','21:18:38','','NTWebPageAssist/1.0 (Linux; Android;) Mobile Safari','','',''),(36,'211.249.203.140','2020-05-19','21:20:54','','facebookexternalhit/1.1; kakaotalk-scrap/1.0; +https://devtalk.kakao.com/t/scrap/33984','','',''),(37,'211.177.181.240','2020-05-19','21:23:23','','Mozilla/5.0 (Linux; Android 10; SM-F700N Build/QP1A.190711.020; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/81.0.4044.138 Mobile Safari/537.36;KAKAOTALK 1908851','','',''),(38,'58.29.81.12','2020-05-19','21:54:52','','WebInfoUtil/1.0 (Linux; Android;) Mobile Safari','','',''),(39,'211.249.202.232','2020-05-20','00:25:46','','facebookexternalhit/1.1; kakaotalk-scrap/1.0; +https://devtalk.kakao.com/t/scrap/33984','','',''),(40,'61.82.191.161','2020-05-20','09:03:51','','Mozilla/5.0 (Windows NT 10.0; WOW64; Trident/7.0; rv:11.0) like Gecko','','',''),(41,'203.226.253.198','2020-05-20','09:30:50','','Java/1.8.0_162','','',''),(42,'121.53.84.2','2020-05-20','09:32:21','','facebookexternalhit/1.1; kakaotalk-scrap/1.0; +https://devtalk.kakao.com/t/scrap/33984','','',''),(43,'121.143.240.49','2020-05-20','09:33:11','','Mozilla/5.0 (Windows NT 10.0; WOW64; Trident/7.0; rv:11.0) like Gecko','','',''),(44,'223.38.42.35','2020-05-20','10:22:03','','WebInfoUtil/1.0 (Linux; Android;) Mobile Safari','','',''),(45,'211.249.204.15','2020-05-20','11:28:51','','facebookexternalhit/1.1; kakaotalk-scrap/1.0; +https://devtalk.kakao.com/t/scrap/33984','','',''),(46,'121.173.199.59','2020-05-20','11:33:14','','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/81.0.4044.138 Safari/537.36','','',''),(47,'220.64.101.15','2020-05-20','13:28:58','','facebookexternalhit/1.1; kakaotalk-scrap/1.0; +https://devtalk.kakao.com/t/scrap/33984','','',''),(48,'118.235.8.213','2020-05-20','13:30:47','','Mozilla/5.0 (Linux; Android 9; SM-N971N Build/PPR1.180610.011; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/81.0.4044.138 Mobile Safari/537.36;KAKAOTALK 1908790','','',''),(49,'223.62.163.246','2020-05-20','13:45:37','','Mozilla/5.0 (Linux; Android 9; SM-G955N Build/PPR1.180610.011; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/81.0.4044.138 Mobile Safari/537.36;KAKAOTALK 1908810','','',''),(50,'173.252.83.16','2020-05-20','13:51:42','','facebookexternalhit/1.1 (+http://www.facebook.com/externalhit_uatext.php)','','',''),(51,'173.252.83.5','2020-05-20','13:51:42','','facebookexternalhit/1.1 (+http://www.facebook.com/externalhit_uatext.php)','','',''),(52,'173.252.83.8','2020-05-20','13:51:45','','facebookexternalhit/1.1 (+http://www.facebook.com/externalhit_uatext.php)','','',''),(53,'121.53.81.7','2020-05-20','15:08:33','','facebookexternalhit/1.1; kakaotalk-scrap/1.0; +https://devtalk.kakao.com/t/scrap/33984','','',''),(54,'116.118.104.221','2020-05-20','15:09:35','','Mozilla/5.0 (Linux; Android 10; SM-N975F Build/QP1A.190711.020; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/81.0.4044.138 Mobile Safari/537.36;KAKAOTALK 1908860','','',''),(55,'121.53.84.1','2020-05-20','16:25:23','','facebookexternalhit/1.1; kakaotalk-scrap/1.0; +https://devtalk.kakao.com/t/scrap/33984','','',''),(56,'58.29.81.12','2020-05-20','21:58:49','','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/81.0.4044.138 Safari/537.36','','',''),(57,'61.82.191.161','2020-05-21','10:30:13','','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/81.0.4044.138 Safari/537.36','','',''),(58,'66.249.82.151','2020-05-21','11:55:01','','Mozilla/5.0 (Linux; Android 6.0.1; Nexus 5 Build/MRA58N) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.97 Mobile Safari/537.36 Chrome-Lighthouse','','',''),(59,'66.249.82.150','2020-05-21','11:55:01','','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.97 Safari/537.36 Chrome-Lighthouse','','',''),(60,'66.249.82.152','2020-05-21','11:55:13','','Mozilla/5.0 (Linux; Android 6.0.1; Nexus 5 Build/MRA58N) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.97 Mobile Safari/537.36 Chrome-Lighthouse','','',''),(61,'211.215.167.149','2020-05-21','12:08:04','','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/81.0.4044.138 Safari/537.36','','',''),(62,'211.176.125.70','2020-05-21','13:30:25','','Mozilla/5.0 (compatible; MSIE 10.0; Windows NT 6.2; Trident/6.0)','','',''),(63,'121.173.199.59','2020-05-22','10:09:08','','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/81.0.4044.138 Safari/537.36','','',''),(64,'223.38.41.155','2020-05-22','16:53:42','','Mozilla/5.0 (Linux; Android 10; SAMSUNG SM-N976N) AppleWebKit/537.36 (KHTML, like Gecko) SamsungBrowser/11.2 Chrome/75.0.3770.143 Mobile Safari/537.36','','',''),(65,'61.82.191.161','2020-05-22','17:06:19','','Mozilla/5.0 (Windows NT 10.0; WOW64; Trident/7.0; rv:11.0) like Gecko','','',''),(66,'223.38.22.13','2020-05-22','17:31:07','','Mozilla/5.0 (Linux; Android 9; SM-G955N) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/81.0.4044.138 Mobile Safari/537.36','','',''),(67,'211.176.125.70','2020-05-23','02:48:29','','Mozilla/5.0 (compatible; MSIE 10.0; Windows NT 6.2; Trident/6.0)','','',''),(68,'220.64.103.11','2020-05-23','18:48:23','','facebookexternalhit/1.1; kakaotalk-scrap/1.0; +https://devtalk.kakao.com/t/scrap/33984','','',''),(69,'121.53.81.11','2020-05-23','20:28:01','','facebookexternalhit/1.1; kakaotalk-scrap/1.0; +https://devtalk.kakao.com/t/scrap/33984','','',''),(70,'61.82.191.161','2020-05-25','11:02:59','','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/81.0.4044.138 Safari/537.36','','',''),(71,'121.173.199.59','2020-05-25','13:03:26','','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/81.0.4044.138 Safari/537.36','','',''),(72,'61.82.191.161','2020-05-26','13:12:28','','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.61 Safari/537.36','','',''),(73,'121.173.199.59','2020-05-26','13:23:30','','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/81.0.4044.138 Safari/537.36','','',''),(74,'121.173.199.59','2020-05-28','10:47:12','','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/81.0.4044.138 Safari/537.36','','',''),(75,'58.224.133.171','2020-05-28','19:00:48','','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/81.0.4044.138 Safari/537.36','','',''),(76,'61.82.191.161','2020-05-28','19:17:37','','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/81.0.4044.138 Safari/537.36','','',''),(77,'61.82.191.161','2020-05-29','11:11:12','','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.61 Safari/537.36','','',''),(78,'121.53.84.1','2020-05-30','14:39:38','','facebookexternalhit/1.1; kakaotalk-scrap/1.0; +https://devtalk.kakao.com/t/scrap/33984','','',''),(79,'61.82.191.161','2020-05-31','15:40:34','','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.61 Safari/537.36','','',''),(80,'61.82.191.161','2020-06-01','09:52:26','','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.61 Safari/537.36','','',''),(81,'121.173.199.59','2020-06-01','11:08:19','','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.61 Safari/537.36','','',''),(82,'223.62.219.216','2020-06-01','16:34:27','','Mozilla/5.0 (Linux; Android 9; SM-G955N) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/81.0.4044.138 Mobile Safari/537.36','','',''),(83,'121.173.199.59','2020-06-02','17:43:36','','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.61 Safari/537.36','','',''),(84,'61.82.191.161','2020-06-03','10:22:37','http://jp1.bksoft.kr/adm/board_list.php','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.61 Safari/537.36','','',''),(85,'121.173.199.59','2020-06-03','12:41:31','','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.61 Safari/537.36','','',''),(86,'211.215.167.149','2020-06-03','12:59:29','','Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.61 Safari/537.36','','',''),(87,'49.50.55.1','2020-06-03','13:42:30','','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.61 Safari/537.36','','',''),(88,'211.176.125.70','2020-06-03','18:36:02','','Mozilla/5.0 (compatible; MSIE 10.0; Windows NT 6.2; Trident/6.0)','','',''),(89,'1.11.185.103','2020-06-03','18:57:16','','Mozilla/5.0 (iPhone; CPU iPhone OS 13_5 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) CriOS/83.0.4103.88 Mobile/15E148 Safari/604.1','','',''),(90,'211.202.43.197','2020-06-03','21:11:41','','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.61 Safari/537.36','','',''),(91,'58.224.133.171','2020-06-04','00:59:57','','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/81.0.4044.138 Safari/537.36','','',''),(92,'149.154.161.8','2020-06-04','01:09:26','','TelegramBot (like TwitterBot)','','',''),(93,'175.223.31.70','2020-06-04','08:30:21','','Mozilla/5.0 (iPhone; CPU iPhone OS 12_4_6 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/12.1.2 Mobile/15E148 Safari/604.1','','',''),(94,'49.50.55.1','2020-06-04','10:32:42','','Mozilla/5.0 (iPhone; CPU iPhone OS 12_4_6 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/12.1.2 Mobile/15E148 Safari/604.1','','',''),(95,'211.202.43.197','2020-06-04','22:54:59','','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.61 Safari/537.36','','',''),(96,'211.176.125.70','2020-06-05','02:42:53','','Mozilla/5.0 (compatible; MSIE 10.0; Windows NT 6.2; Trident/6.0)','','',''),(97,'125.182.12.32','2020-06-06','14:22:25','','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.61 Safari/537.36','','',''),(98,'125.182.12.32','2020-06-07','14:36:20','http://jpday.bksoft.kr/bbs/login.php?url=%2Fshop%2F','Mozilla/5.0 (iPhone; CPU iPhone OS 13_2_3 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/13.0.3 Mobile/15E148 Safari/604.1','','',''),(99,'211.202.43.197','2020-06-07','22:34:56','','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.97 Safari/537.36','','',''),(100,'211.176.125.70','2020-06-08','04:14:05','','Mozilla/5.0 (compatible; MSIE 10.0; Windows NT 6.2; Trident/6.0)','','',''),(101,'121.173.199.59','2020-06-08','10:05:17','','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.61 Safari/537.36','','',''),(102,'121.173.199.59','2020-06-09','10:12:34','','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.61 Safari/537.36','','',''),(103,'211.202.43.197','2020-06-09','21:22:43','http://jpday.bksoft.kr/shop/','Mozilla/5.0 (iPhone; CPU iPhone OS 12_4_6 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/12.1.2 Mobile/15E148 Safari/604.1','','',''),(104,'211.176.125.70','2020-06-10','03:48:55','','Mozilla/5.0 (compatible; MSIE 10.0; Windows NT 6.2; Trident/6.0)','','',''),(105,'121.173.199.59','2020-06-10','18:25:21','','Mozilla/5.0 (Windows NT 10.0; WOW64; Trident/7.0; rv:11.0) like Gecko','','',''),(106,'58.224.133.171','2020-06-10','22:31:52','','Mozilla/5.0 (Windows NT 10.0; WOW64; Trident/7.0; rv:11.0) like Gecko','','',''),(107,'121.173.199.59','2020-06-11','10:09:26','','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.97 Safari/537.36','','',''),(108,'58.224.133.171','2020-06-11','23:44:00','','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.97 Safari/537.36','','',''),(109,'66.102.8.164','2020-06-12','01:45:01','','Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.11 (KHTML, like Gecko) Chrome/23.0.1271.64 Safari/537.11','','',''),(110,'66.102.8.169','2020-06-12','01:45:01','','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/81.0.4044.129 Safari/537.36','','',''),(111,'66.102.8.167','2020-06-12','01:45:02','','Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.11 (KHTML, like Gecko) Chrome/23.0.1271.64 Safari/537.11','','',''),(112,'121.173.199.59','2020-06-12','09:27:35','','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.97 Safari/537.36 Edg/83.0.478.45','','',''),(113,'223.62.21.213','2020-06-12','10:58:21','','Mozilla/5.0 (iPhone; CPU iPhone OS 13_5 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) CriOS/83.0.4103.88 Mobile/15E148 Safari/604.1','','',''),(114,'207.46.13.118','2020-06-16','10:13:43','','Mozilla/5.0 (compatible; bingbot/2.0; +http://www.bing.com/bingbot.htm)','','',''),(115,'121.173.199.59','2020-06-19','16:02:51','','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.106 Safari/537.36','','',''),(116,'121.173.199.59','2020-06-22','13:45:39','','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.106 Safari/537.36','','',''),(117,'121.173.199.59','2020-06-23','16:21:20','','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.106 Safari/537.36','','',''),(118,'58.224.133.171','2020-06-24','21:46:28','','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.106 Safari/537.36','','',''),(119,'121.53.241.15','2020-06-24','21:46:32','','facebookexternalhit/1.1; kakaotalk-scrap/1.0; +https://devtalk.kakao.com/t/scrap/33984','','',''),(120,'121.53.206.128','2020-06-24','21:46:33','http://jpday.bksoft.kr/shop','facebookexternalhit/1.1; kakaotalk-scrap/1.0; +https://devtalk.kakao.com/t/scrap/33984','','',''),(121,'121.53.241.15','2020-06-25','08:55:32','','facebookexternalhit/1.1; kakaotalk-scrap/1.0; +https://devtalk.kakao.com/t/scrap/33984','','',''),(122,'121.53.206.128','2020-06-25','08:55:33','http://jpday.bksoft.kr/shop','facebookexternalhit/1.1; kakaotalk-scrap/1.0; +https://devtalk.kakao.com/t/scrap/33984','','',''),(123,'121.173.199.59','2020-06-25','14:42:22','','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.116 Safari/537.36','','','');
/*!40000 ALTER TABLE `g5_visit` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `g5_visit_sum`
--

DROP TABLE IF EXISTS `g5_visit_sum`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `g5_visit_sum` (
  `vs_date` date NOT NULL DEFAULT '0000-00-00',
  `vs_count` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`vs_date`),
  KEY `index1` (`vs_count`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `g5_visit_sum`
--

LOCK TABLES `g5_visit_sum` WRITE;
/*!40000 ALTER TABLE `g5_visit_sum` DISABLE KEYS */;
INSERT INTO `g5_visit_sum` VALUES ('2020-03-25',1),('2020-03-26',1),('2020-04-01',1),('2020-04-10',1),('2020-04-17',1),('2020-04-20',1),('2020-04-21',1),('2020-04-24',1),('2020-04-27',1),('2020-04-28',1),('2020-04-29',1),('2020-05-12',1),('2020-05-13',1),('2020-05-18',1),('2020-05-29',1),('2020-05-30',1),('2020-05-31',1),('2020-06-02',1),('2020-06-05',1),('2020-06-06',1),('2020-06-16',1),('2020-06-19',1),('2020-06-22',1),('2020-06-23',1),('2020-05-14',2),('2020-05-25',2),('2020-05-26',2),('2020-06-07',2),('2020-06-08',2),('2020-06-09',2),('2020-06-11',2),('2020-05-07',3),('2020-05-11',3),('2020-05-23',3),('2020-05-28',3),('2020-06-01',3),('2020-06-10',3),('2020-06-24',3),('2020-06-25',3),('2020-05-22',4),('2020-05-08',5),('2020-06-04',5),('2020-06-12',5),('2020-05-21',6),('2020-06-03',7),('2020-05-19',11),('2020-05-20',18);
/*!40000 ALTER TABLE `g5_visit_sum` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `g5_write_free`
--

DROP TABLE IF EXISTS `g5_write_free`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `g5_write_free` (
  `wr_id` int(11) NOT NULL AUTO_INCREMENT,
  `wr_num` int(11) NOT NULL DEFAULT '0',
  `wr_reply` varchar(10) NOT NULL,
  `wr_parent` int(11) NOT NULL DEFAULT '0',
  `wr_is_comment` tinyint(4) NOT NULL DEFAULT '0',
  `wr_comment` int(11) NOT NULL DEFAULT '0',
  `wr_comment_reply` varchar(5) NOT NULL,
  `ca_name` varchar(255) NOT NULL,
  `wr_option` set('html1','html2','secret','mail') NOT NULL,
  `wr_subject` varchar(255) NOT NULL,
  `wr_content` text NOT NULL,
  `wr_seo_title` varchar(255) NOT NULL DEFAULT '',
  `wr_link1` text NOT NULL,
  `wr_link2` text NOT NULL,
  `wr_link1_hit` int(11) NOT NULL DEFAULT '0',
  `wr_link2_hit` int(11) NOT NULL DEFAULT '0',
  `wr_hit` int(11) NOT NULL DEFAULT '0',
  `wr_good` int(11) NOT NULL DEFAULT '0',
  `wr_nogood` int(11) NOT NULL DEFAULT '0',
  `mb_id` varchar(20) NOT NULL,
  `wr_password` varchar(255) NOT NULL,
  `wr_name` varchar(255) NOT NULL,
  `wr_email` varchar(255) NOT NULL,
  `wr_homepage` varchar(255) NOT NULL,
  `wr_datetime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `wr_file` tinyint(4) NOT NULL DEFAULT '0',
  `wr_last` varchar(19) NOT NULL,
  `wr_ip` varchar(255) NOT NULL,
  `wr_facebook_user` varchar(255) NOT NULL,
  `wr_twitter_user` varchar(255) NOT NULL,
  `wr_1` varchar(255) NOT NULL,
  `wr_2` varchar(255) NOT NULL,
  `wr_3` varchar(255) NOT NULL,
  `wr_4` varchar(255) NOT NULL,
  `wr_5` varchar(255) NOT NULL,
  `wr_6` varchar(255) NOT NULL,
  `wr_7` varchar(255) NOT NULL,
  `wr_8` varchar(255) NOT NULL,
  `wr_9` varchar(255) NOT NULL,
  `wr_10` varchar(255) NOT NULL,
  PRIMARY KEY (`wr_id`),
  KEY `wr_seo_title` (`wr_seo_title`),
  KEY `wr_num_reply_parent` (`wr_num`,`wr_reply`,`wr_parent`),
  KEY `wr_is_comment` (`wr_is_comment`,`wr_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `g5_write_free`
--

LOCK TABLES `g5_write_free` WRITE;
/*!40000 ALTER TABLE `g5_write_free` DISABLE KEYS */;
/*!40000 ALTER TABLE `g5_write_free` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `g5_write_gallery`
--

DROP TABLE IF EXISTS `g5_write_gallery`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `g5_write_gallery` (
  `wr_id` int(11) NOT NULL AUTO_INCREMENT,
  `wr_num` int(11) NOT NULL DEFAULT '0',
  `wr_reply` varchar(10) NOT NULL,
  `wr_parent` int(11) NOT NULL DEFAULT '0',
  `wr_is_comment` tinyint(4) NOT NULL DEFAULT '0',
  `wr_comment` int(11) NOT NULL DEFAULT '0',
  `wr_comment_reply` varchar(5) NOT NULL,
  `ca_name` varchar(255) NOT NULL,
  `wr_option` set('html1','html2','secret','mail') NOT NULL,
  `wr_subject` varchar(255) NOT NULL,
  `wr_content` text NOT NULL,
  `wr_seo_title` varchar(255) NOT NULL DEFAULT '',
  `wr_link1` text NOT NULL,
  `wr_link2` text NOT NULL,
  `wr_link1_hit` int(11) NOT NULL DEFAULT '0',
  `wr_link2_hit` int(11) NOT NULL DEFAULT '0',
  `wr_hit` int(11) NOT NULL DEFAULT '0',
  `wr_good` int(11) NOT NULL DEFAULT '0',
  `wr_nogood` int(11) NOT NULL DEFAULT '0',
  `mb_id` varchar(20) NOT NULL,
  `wr_password` varchar(255) NOT NULL,
  `wr_name` varchar(255) NOT NULL,
  `wr_email` varchar(255) NOT NULL,
  `wr_homepage` varchar(255) NOT NULL,
  `wr_datetime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `wr_file` tinyint(4) NOT NULL DEFAULT '0',
  `wr_last` varchar(19) NOT NULL,
  `wr_ip` varchar(255) NOT NULL,
  `wr_facebook_user` varchar(255) NOT NULL,
  `wr_twitter_user` varchar(255) NOT NULL,
  `wr_1` varchar(255) NOT NULL,
  `wr_2` varchar(255) NOT NULL,
  `wr_3` varchar(255) NOT NULL,
  `wr_4` varchar(255) NOT NULL,
  `wr_5` varchar(255) NOT NULL,
  `wr_6` varchar(255) NOT NULL,
  `wr_7` varchar(255) NOT NULL,
  `wr_8` varchar(255) NOT NULL,
  `wr_9` varchar(255) NOT NULL,
  `wr_10` varchar(255) NOT NULL,
  PRIMARY KEY (`wr_id`),
  KEY `wr_seo_title` (`wr_seo_title`),
  KEY `wr_num_reply_parent` (`wr_num`,`wr_reply`,`wr_parent`),
  KEY `wr_is_comment` (`wr_is_comment`,`wr_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `g5_write_gallery`
--

LOCK TABLES `g5_write_gallery` WRITE;
/*!40000 ALTER TABLE `g5_write_gallery` DISABLE KEYS */;
/*!40000 ALTER TABLE `g5_write_gallery` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `g5_write_notice`
--

DROP TABLE IF EXISTS `g5_write_notice`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `g5_write_notice` (
  `wr_id` int(11) NOT NULL AUTO_INCREMENT,
  `wr_num` int(11) NOT NULL DEFAULT '0',
  `wr_reply` varchar(10) NOT NULL,
  `wr_parent` int(11) NOT NULL DEFAULT '0',
  `wr_is_comment` tinyint(4) NOT NULL DEFAULT '0',
  `wr_comment` int(11) NOT NULL DEFAULT '0',
  `wr_comment_reply` varchar(5) NOT NULL,
  `ca_name` varchar(255) NOT NULL,
  `wr_option` set('html1','html2','secret','mail') NOT NULL,
  `wr_subject` varchar(255) NOT NULL,
  `wr_content` text NOT NULL,
  `wr_seo_title` varchar(255) NOT NULL DEFAULT '',
  `wr_link1` text NOT NULL,
  `wr_link2` text NOT NULL,
  `wr_link1_hit` int(11) NOT NULL DEFAULT '0',
  `wr_link2_hit` int(11) NOT NULL DEFAULT '0',
  `wr_hit` int(11) NOT NULL DEFAULT '0',
  `wr_good` int(11) NOT NULL DEFAULT '0',
  `wr_nogood` int(11) NOT NULL DEFAULT '0',
  `mb_id` varchar(20) NOT NULL,
  `wr_password` varchar(255) NOT NULL,
  `wr_name` varchar(255) NOT NULL,
  `wr_email` varchar(255) NOT NULL,
  `wr_homepage` varchar(255) NOT NULL,
  `wr_datetime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `wr_file` tinyint(4) NOT NULL DEFAULT '0',
  `wr_last` varchar(19) NOT NULL,
  `wr_ip` varchar(255) NOT NULL,
  `wr_facebook_user` varchar(255) NOT NULL,
  `wr_twitter_user` varchar(255) NOT NULL,
  `wr_1` varchar(255) NOT NULL,
  `wr_2` varchar(255) NOT NULL,
  `wr_3` varchar(255) NOT NULL,
  `wr_4` varchar(255) NOT NULL,
  `wr_5` varchar(255) NOT NULL,
  `wr_6` varchar(255) NOT NULL,
  `wr_7` varchar(255) NOT NULL,
  `wr_8` varchar(255) NOT NULL,
  `wr_9` varchar(255) NOT NULL,
  `wr_10` varchar(255) NOT NULL,
  PRIMARY KEY (`wr_id`),
  KEY `wr_seo_title` (`wr_seo_title`),
  KEY `wr_num_reply_parent` (`wr_num`,`wr_reply`,`wr_parent`),
  KEY `wr_is_comment` (`wr_is_comment`,`wr_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `g5_write_notice`
--

LOCK TABLES `g5_write_notice` WRITE;
/*!40000 ALTER TABLE `g5_write_notice` DISABLE KEYS */;
INSERT INTO `g5_write_notice` VALUES (1,-1,'',1,0,0,'','','html1','재팬데이가 쏩니다!','<div style=\"margin:10px 0 10px 0\">\r\n<p style=\"text-align: center; \" align=\"center\">&nbsp;</p>\r\n<p style=\"text-align: center; \" align=\"center\">&nbsp;</p>\r\n<p style=\"text-align: center; \" align=\"center\"><img src=\"http://jp1.bksoft.kr/data/editor/2005/b32af715601853b6387b77636fad24a1_1589789826_0222.jpg\" alt=\"\"></p>\r\n\r\n<p style=\"text-align: center; \" align=\"center\">&nbsp;</p><p style=\"text-align: center; \" align=\"center\">&nbsp;</p><p style=\"language:ko;margin-top:0pt;margin-bottom:0pt;margin-left:0in;\r\ntext-align:center;direction:ltr;unicode-bidi:embed;mso-line-break-override:\r\nnone;word-break:break-hangul;punctuation-wrap:hanging\"><b><span style=\"font-size: 12pt; font-family: 나눔고딕, NanumGothic; color: rgb(149, 16, 21);\">카카오톡</span><span style=\"font-size: 12pt; font-family: 나눔고딕, NanumGothic; color: rgb(149, 16, 21);\"> </span><span style=\"font-size: 12pt; font-family: 나눔고딕, NanumGothic; color: rgb(149, 16, 21);\">검색창에</span><span style=\"font-size: 12pt; font-family: 나눔고딕, NanumGothic; color: rgb(149, 16, 21);\"> </span><span style=\"font-size: 12pt; font-family: 나눔고딕, NanumGothic; color: rgb(149, 16, 21);\">\'</span><span style=\"font-size: 12pt; font-family: 나눔고딕, NanumGothic; color: rgb(149, 16, 21);\">재팬데이</span><span style=\"font-size: 12pt; font-family: 나눔고딕, NanumGothic; color: rgb(149, 16, 21);\">\'</span><span style=\"font-size: 12pt; font-family: 나눔고딕, NanumGothic; color: rgb(149, 16, 21);\">를 검색하여 </span></b></p><p style=\"language:ko;margin-top:0pt;margin-bottom:0pt;margin-left:0in;\r\ntext-align:center;direction:ltr;unicode-bidi:embed;mso-line-break-override:\r\nnone;word-break:break-hangul;punctuation-wrap:hanging\"><b><span style=\"font-size: 12pt; font-family: 나눔고딕, NanumGothic; color: rgb(255, 0, 0);\">플러스친구 등록하시면 쿠폰암호가 발급됩니다</span><span style=\"font-size: 12pt; font-family: 나눔고딕, NanumGothic; color: rgb(255, 0, 0);\">.</span></b></p><p style=\"language:ko;margin-top:0pt;margin-bottom:0pt;margin-left:0in;\r\ntext-align:center;direction:ltr;unicode-bidi:embed;mso-line-break-override:\r\nnone;word-break:break-hangul;punctuation-wrap:hanging\"><b><span style=\"font-size: 18pt; font-family: &quot;맑은 고딕&quot;;\"><br>\r\n</span><span style=\"font-size: 12pt; font-family: 나눔고딕, NanumGothic; color: rgb(149, 16, 21);\">마이페이지</span><span style=\"font-size: 12pt; font-family: 나눔고딕, NanumGothic; color: rgb(149, 16, 21);\"> </span><span style=\"font-size: 12pt; font-family: 나눔고딕, NanumGothic; color: rgb(149, 16, 21);\">- </span><span style=\"font-size: 12pt; font-family: 나눔고딕, NanumGothic; color: rgb(149, 16, 21);\">쿠폰 </span><span style=\"font-size: 12pt; font-family: 나눔고딕, NanumGothic; color: rgb(149, 16, 21);\">– </span><span style=\"font-size: 12pt; font-family: 나눔고딕, NanumGothic; color: rgb(149, 16, 21);\">쿠폰등록</span></b></p><p style=\"language:ko;margin-top:0pt;margin-bottom:0pt;margin-left:0in;\r\ntext-align:center;direction:ltr;unicode-bidi:embed;mso-line-break-override:\r\nnone;word-break:break-hangul;punctuation-wrap:hanging\"><b><span style=\"font-size: 12pt; font-family: 나눔고딕, NanumGothic; color: rgb(149, 16, 21);\">쿠폰암호 </span><span style=\"font-size: 12pt; font-family: 나눔고딕, NanumGothic; color: rgb(149, 16, 21);\">입력</span><span style=\"font-size: 12pt; font-family: 나눔고딕, NanumGothic; color: rgb(149, 16, 21);\"> 후 </span><span style=\"font-size: 12pt; font-family: 나눔고딕, NanumGothic; color: rgb(149, 16, 21);\">- 쿠폰 발급 -&nbsp;</span><span style=\"font-size: 12pt; font-family: 나눔고딕, NanumGothic; color: rgb(149, 16, 21);\">쿠폰사용 시</span></b></p><p style=\"language:ko;margin-top:0pt;margin-bottom:0pt;margin-left:0in;\r\ntext-align:center;direction:ltr;unicode-bidi:embed;mso-line-break-override:\r\nnone;word-break:break-hangul;punctuation-wrap:hanging\"><b><span style=\"font-size: 12pt; font-family: 나눔고딕, NanumGothic; color: rgb(149, 16, 21);\">적립금 바로 지급</span><span style=\"font-size: 12pt; font-family: 나눔고딕, NanumGothic; color: rgb(149, 16, 21);\">!!</span></b></p><p style=\"language:ko;margin-top:0pt;margin-bottom:0pt;margin-left:0in;\r\ntext-align:center;direction:ltr;unicode-bidi:embed;mso-line-break-override:\r\nnone;word-break:break-hangul;punctuation-wrap:hanging\">&nbsp;</p><p style=\"text-align: center; \" align=\"center\">&nbsp;</p><p style=\"language:ko;margin-top:0pt;margin-bottom:0pt;margin-left:0in;\r\ntext-align:center;direction:ltr;unicode-bidi:embed;mso-line-break-override:\r\nnone;word-break:break-hangul;punctuation-wrap:hanging\"><b><span style=\"font-size: 12pt; font-family: 나눔고딕, NanumGothic; color: rgb(149, 16, 21);\">주문</span><span style=\"font-size: 12pt; font-family: 나눔고딕, NanumGothic; color: rgb(149, 16, 21);\">, </span><span style=\"font-size: 12pt; font-family: 나눔고딕, NanumGothic; color: rgb(149, 16, 21);\">결제 시 사용 하실 수 있습니다</span><span style=\"font-size: 12pt; font-family: 나눔고딕, NanumGothic; color: rgb(149, 16, 21);\">.</span></b></p><p style=\"text-align: center; \" align=\"center\">&nbsp;</p><p style=\"text-align: center; \" align=\"center\"><a href=\"http://pf.kakao.com/_bqbCT\" target=\"_self\"><span style=\"font-size: 12pt;\"><b>[플러스친구]</b></span><br style=\"clear:both;\"></a>&nbsp;</p>\r\n					</div>','재팬데이가-쏩니다','','',0,0,31,0,0,'admin','','관리자','admin@jp1.com','','2020-05-18 17:19:32',0,'2020-05-18 17:19:32','121.173.199.59','','','','','','','','','','','','');
/*!40000 ALTER TABLE `g5_write_notice` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `g5_write_qa`
--

DROP TABLE IF EXISTS `g5_write_qa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `g5_write_qa` (
  `wr_id` int(11) NOT NULL AUTO_INCREMENT,
  `wr_num` int(11) NOT NULL DEFAULT '0',
  `wr_reply` varchar(10) NOT NULL,
  `wr_parent` int(11) NOT NULL DEFAULT '0',
  `wr_is_comment` tinyint(4) NOT NULL DEFAULT '0',
  `wr_comment` int(11) NOT NULL DEFAULT '0',
  `wr_comment_reply` varchar(5) NOT NULL,
  `ca_name` varchar(255) NOT NULL,
  `wr_option` set('html1','html2','secret','mail') NOT NULL,
  `wr_subject` varchar(255) NOT NULL,
  `wr_content` text NOT NULL,
  `wr_seo_title` varchar(255) NOT NULL DEFAULT '',
  `wr_link1` text NOT NULL,
  `wr_link2` text NOT NULL,
  `wr_link1_hit` int(11) NOT NULL DEFAULT '0',
  `wr_link2_hit` int(11) NOT NULL DEFAULT '0',
  `wr_hit` int(11) NOT NULL DEFAULT '0',
  `wr_good` int(11) NOT NULL DEFAULT '0',
  `wr_nogood` int(11) NOT NULL DEFAULT '0',
  `mb_id` varchar(20) NOT NULL,
  `wr_password` varchar(255) NOT NULL,
  `wr_name` varchar(255) NOT NULL,
  `wr_email` varchar(255) NOT NULL,
  `wr_homepage` varchar(255) NOT NULL,
  `wr_datetime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `wr_file` tinyint(4) NOT NULL DEFAULT '0',
  `wr_last` varchar(19) NOT NULL,
  `wr_ip` varchar(255) NOT NULL,
  `wr_facebook_user` varchar(255) NOT NULL,
  `wr_twitter_user` varchar(255) NOT NULL,
  `wr_1` varchar(255) NOT NULL,
  `wr_2` varchar(255) NOT NULL,
  `wr_3` varchar(255) NOT NULL,
  `wr_4` varchar(255) NOT NULL,
  `wr_5` varchar(255) NOT NULL,
  `wr_6` varchar(255) NOT NULL,
  `wr_7` varchar(255) NOT NULL,
  `wr_8` varchar(255) NOT NULL,
  `wr_9` varchar(255) NOT NULL,
  `wr_10` varchar(255) NOT NULL,
  PRIMARY KEY (`wr_id`),
  KEY `wr_seo_title` (`wr_seo_title`),
  KEY `wr_num_reply_parent` (`wr_num`,`wr_reply`,`wr_parent`),
  KEY `wr_is_comment` (`wr_is_comment`,`wr_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `g5_write_qa`
--

LOCK TABLES `g5_write_qa` WRITE;
/*!40000 ALTER TABLE `g5_write_qa` DISABLE KEYS */;
/*!40000 ALTER TABLE `g5_write_qa` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `g5_write_review`
--

DROP TABLE IF EXISTS `g5_write_review`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `g5_write_review` (
  `wr_id` int(11) NOT NULL AUTO_INCREMENT,
  `wr_num` int(11) NOT NULL DEFAULT '0',
  `wr_reply` varchar(10) NOT NULL,
  `wr_parent` int(11) NOT NULL DEFAULT '0',
  `wr_is_comment` tinyint(4) NOT NULL DEFAULT '0',
  `wr_comment` int(11) NOT NULL DEFAULT '0',
  `wr_comment_reply` varchar(5) NOT NULL,
  `ca_name` varchar(255) NOT NULL,
  `wr_option` set('html1','html2','secret','mail') NOT NULL,
  `wr_subject` varchar(255) NOT NULL,
  `wr_content` text NOT NULL,
  `wr_seo_title` varchar(255) NOT NULL,
  `wr_link1` text NOT NULL,
  `wr_link2` text NOT NULL,
  `wr_link1_hit` int(11) NOT NULL DEFAULT '0',
  `wr_link2_hit` int(11) NOT NULL DEFAULT '0',
  `wr_hit` int(11) NOT NULL DEFAULT '0',
  `wr_good` int(11) NOT NULL DEFAULT '0',
  `wr_nogood` int(11) NOT NULL DEFAULT '0',
  `mb_id` varchar(20) NOT NULL,
  `wr_password` varchar(255) NOT NULL,
  `wr_name` varchar(255) NOT NULL,
  `wr_email` varchar(255) NOT NULL,
  `wr_homepage` varchar(255) NOT NULL,
  `wr_datetime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `wr_file` tinyint(4) NOT NULL DEFAULT '0',
  `wr_last` varchar(19) NOT NULL,
  `wr_ip` varchar(255) NOT NULL,
  `wr_facebook_user` varchar(255) NOT NULL,
  `wr_twitter_user` varchar(255) NOT NULL,
  `wr_1` varchar(255) NOT NULL,
  `wr_2` varchar(255) NOT NULL,
  `wr_3` varchar(255) NOT NULL,
  `wr_4` varchar(255) NOT NULL,
  `wr_5` varchar(255) NOT NULL,
  `wr_6` varchar(255) NOT NULL,
  `wr_7` varchar(255) NOT NULL,
  `wr_8` varchar(255) NOT NULL,
  `wr_9` varchar(255) NOT NULL,
  `wr_10` varchar(255) NOT NULL,
  PRIMARY KEY (`wr_id`),
  KEY `wr_seo_title` (`wr_seo_title`),
  KEY `wr_num_reply_parent` (`wr_num`,`wr_reply`,`wr_parent`),
  KEY `wr_is_comment` (`wr_is_comment`,`wr_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `g5_write_review`
--

LOCK TABLES `g5_write_review` WRITE;
/*!40000 ALTER TABLE `g5_write_review` DISABLE KEYS */;
/*!40000 ALTER TABLE `g5_write_review` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `g5_write_unidentified`
--

DROP TABLE IF EXISTS `g5_write_unidentified`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `g5_write_unidentified` (
  `wr_id` int(11) NOT NULL AUTO_INCREMENT,
  `wr_num` int(11) NOT NULL DEFAULT '0',
  `wr_reply` varchar(10) NOT NULL,
  `wr_parent` int(11) NOT NULL DEFAULT '0',
  `wr_is_comment` tinyint(4) NOT NULL DEFAULT '0',
  `wr_comment` int(11) NOT NULL DEFAULT '0',
  `wr_comment_reply` varchar(5) NOT NULL,
  `ca_name` varchar(255) NOT NULL,
  `wr_option` set('html1','html2','secret','mail') NOT NULL,
  `wr_subject` varchar(255) NOT NULL,
  `wr_content` text NOT NULL,
  `wr_seo_title` varchar(255) NOT NULL,
  `wr_link1` text NOT NULL,
  `wr_link2` text NOT NULL,
  `wr_link1_hit` int(11) NOT NULL DEFAULT '0',
  `wr_link2_hit` int(11) NOT NULL DEFAULT '0',
  `wr_hit` int(11) NOT NULL DEFAULT '0',
  `wr_good` int(11) NOT NULL DEFAULT '0',
  `wr_nogood` int(11) NOT NULL DEFAULT '0',
  `mb_id` varchar(20) NOT NULL,
  `wr_password` varchar(255) NOT NULL,
  `wr_name` varchar(255) NOT NULL,
  `wr_email` varchar(255) NOT NULL,
  `wr_homepage` varchar(255) NOT NULL,
  `wr_datetime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `wr_file` tinyint(4) NOT NULL DEFAULT '0',
  `wr_last` varchar(19) NOT NULL,
  `wr_ip` varchar(255) NOT NULL,
  `wr_facebook_user` varchar(255) NOT NULL,
  `wr_twitter_user` varchar(255) NOT NULL,
  `wr_1` varchar(255) NOT NULL,
  `wr_2` varchar(255) NOT NULL,
  `wr_3` varchar(255) NOT NULL,
  `wr_4` varchar(255) NOT NULL,
  `wr_5` varchar(255) NOT NULL,
  `wr_6` varchar(255) NOT NULL,
  `wr_7` varchar(255) NOT NULL,
  `wr_8` varchar(255) NOT NULL,
  `wr_9` varchar(255) NOT NULL,
  `wr_10` varchar(255) NOT NULL,
  PRIMARY KEY (`wr_id`),
  KEY `wr_seo_title` (`wr_seo_title`),
  KEY `wr_num_reply_parent` (`wr_num`,`wr_reply`,`wr_parent`),
  KEY `wr_is_comment` (`wr_is_comment`,`wr_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `g5_write_unidentified`
--

LOCK TABLES `g5_write_unidentified` WRITE;
/*!40000 ALTER TABLE `g5_write_unidentified` DISABLE KEYS */;
/*!40000 ALTER TABLE `g5_write_unidentified` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sms5_book`
--

DROP TABLE IF EXISTS `sms5_book`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sms5_book` (
  `bk_no` int(11) NOT NULL AUTO_INCREMENT,
  `bg_no` int(11) NOT NULL DEFAULT '0',
  `mb_no` int(11) NOT NULL DEFAULT '0',
  `mb_id` varchar(20) NOT NULL DEFAULT '',
  `bk_name` varchar(255) NOT NULL DEFAULT '',
  `bk_hp` varchar(255) NOT NULL DEFAULT '',
  `bk_receipt` tinyint(4) NOT NULL DEFAULT '0',
  `bk_datetime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `bk_memo` text NOT NULL,
  PRIMARY KEY (`bk_no`),
  KEY `bk_name` (`bk_name`),
  KEY `bk_hp` (`bk_hp`),
  KEY `mb_no` (`mb_no`),
  KEY `bg_no` (`bg_no`,`bk_no`),
  KEY `mb_id` (`mb_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sms5_book`
--

LOCK TABLES `sms5_book` WRITE;
/*!40000 ALTER TABLE `sms5_book` DISABLE KEYS */;
/*!40000 ALTER TABLE `sms5_book` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sms5_book_group`
--

DROP TABLE IF EXISTS `sms5_book_group`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sms5_book_group` (
  `bg_no` int(11) NOT NULL AUTO_INCREMENT,
  `bg_name` varchar(255) NOT NULL DEFAULT '',
  `bg_count` int(11) NOT NULL DEFAULT '0',
  `bg_member` int(11) NOT NULL DEFAULT '0',
  `bg_nomember` int(11) NOT NULL DEFAULT '0',
  `bg_receipt` int(11) NOT NULL DEFAULT '0',
  `bg_reject` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`bg_no`),
  KEY `bg_name` (`bg_name`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sms5_book_group`
--

LOCK TABLES `sms5_book_group` WRITE;
/*!40000 ALTER TABLE `sms5_book_group` DISABLE KEYS */;
INSERT INTO `sms5_book_group` VALUES (1,'미분류',0,0,0,0,0);
/*!40000 ALTER TABLE `sms5_book_group` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sms5_config`
--

DROP TABLE IF EXISTS `sms5_config`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sms5_config` (
  `cf_phone` varchar(255) NOT NULL DEFAULT '',
  `cf_datetime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sms5_config`
--

LOCK TABLES `sms5_config` WRITE;
/*!40000 ALTER TABLE `sms5_config` DISABLE KEYS */;
/*!40000 ALTER TABLE `sms5_config` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sms5_form`
--

DROP TABLE IF EXISTS `sms5_form`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sms5_form` (
  `fo_no` int(11) NOT NULL AUTO_INCREMENT,
  `fg_no` tinyint(4) NOT NULL DEFAULT '0',
  `fg_member` char(1) NOT NULL DEFAULT '0',
  `fo_name` varchar(255) NOT NULL DEFAULT '',
  `fo_content` text NOT NULL,
  `fo_datetime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`fo_no`),
  KEY `fg_no` (`fg_no`,`fo_no`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sms5_form`
--

LOCK TABLES `sms5_form` WRITE;
/*!40000 ALTER TABLE `sms5_form` DISABLE KEYS */;
/*!40000 ALTER TABLE `sms5_form` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sms5_form_group`
--

DROP TABLE IF EXISTS `sms5_form_group`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sms5_form_group` (
  `fg_no` int(11) NOT NULL AUTO_INCREMENT,
  `fg_name` varchar(255) NOT NULL DEFAULT '',
  `fg_count` int(11) NOT NULL DEFAULT '0',
  `fg_member` tinyint(4) NOT NULL,
  PRIMARY KEY (`fg_no`),
  KEY `fg_name` (`fg_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sms5_form_group`
--

LOCK TABLES `sms5_form_group` WRITE;
/*!40000 ALTER TABLE `sms5_form_group` DISABLE KEYS */;
/*!40000 ALTER TABLE `sms5_form_group` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sms5_history`
--

DROP TABLE IF EXISTS `sms5_history`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sms5_history` (
  `hs_no` int(11) NOT NULL AUTO_INCREMENT,
  `wr_no` int(11) NOT NULL DEFAULT '0',
  `wr_renum` int(11) NOT NULL DEFAULT '0',
  `bg_no` int(11) NOT NULL DEFAULT '0',
  `mb_no` int(11) NOT NULL DEFAULT '0',
  `mb_id` varchar(20) NOT NULL DEFAULT '',
  `bk_no` int(11) NOT NULL DEFAULT '0',
  `hs_name` varchar(30) NOT NULL DEFAULT '',
  `hs_hp` varchar(255) NOT NULL DEFAULT '',
  `hs_datetime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `hs_flag` tinyint(4) NOT NULL DEFAULT '0',
  `hs_code` varchar(255) NOT NULL DEFAULT '',
  `hs_memo` varchar(255) NOT NULL DEFAULT '',
  `hs_log` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`hs_no`),
  KEY `wr_no` (`wr_no`),
  KEY `mb_no` (`mb_no`),
  KEY `bk_no` (`bk_no`),
  KEY `hs_hp` (`hs_hp`),
  KEY `hs_code` (`hs_code`),
  KEY `bg_no` (`bg_no`),
  KEY `mb_id` (`mb_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sms5_history`
--

LOCK TABLES `sms5_history` WRITE;
/*!40000 ALTER TABLE `sms5_history` DISABLE KEYS */;
/*!40000 ALTER TABLE `sms5_history` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sms5_write`
--

DROP TABLE IF EXISTS `sms5_write`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sms5_write` (
  `wr_no` int(11) NOT NULL DEFAULT '1',
  `wr_renum` int(11) NOT NULL DEFAULT '0',
  `wr_reply` varchar(255) NOT NULL DEFAULT '',
  `wr_message` varchar(255) NOT NULL DEFAULT '',
  `wr_booking` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `wr_total` int(11) NOT NULL DEFAULT '0',
  `wr_re_total` int(11) NOT NULL DEFAULT '0',
  `wr_success` int(11) NOT NULL DEFAULT '0',
  `wr_failure` int(11) NOT NULL DEFAULT '0',
  `wr_datetime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `wr_memo` text NOT NULL,
  KEY `wr_no` (`wr_no`,`wr_renum`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sms5_write`
--

LOCK TABLES `sms5_write` WRITE;
/*!40000 ALTER TABLE `sms5_write` DISABLE KEYS */;
/*!40000 ALTER TABLE `sms5_write` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-06-25 20:06:21
