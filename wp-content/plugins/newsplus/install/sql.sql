CREATE TABLE IF NOT EXISTS `mail_subscriber_stat_delete_account` (
  `date` int(11) NOT NULL
);# __TMM_MAIL_SUBSCRIBER2__
CREATE TABLE IF NOT EXISTS `mail_subscriber_stat_mail_clicking` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` varchar(32) NOT NULL,
  `mail_id` int(11) NOT NULL,
  `date` int(11) NOT NULL,
  PRIMARY KEY (`id`)
);# __TMM_MAIL_SUBSCRIBER2__
CREATE TABLE IF NOT EXISTS `mail_subscriber_user_not_confirmed` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(32) NOT NULL,
  `email` varchar(64) NOT NULL,
  `hash` varchar(48) NOT NULL,
  `date` int(11) NOT NULL,
  PRIMARY KEY (`id`)
);# __TMM_MAIL_SUBSCRIBER2__
CREATE TABLE IF NOT EXISTS `mail_subscriber_stat_mail_sent` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` varchar(32) NOT NULL,
  `mail_id` int(11) NOT NULL,
  `groups` varchar(128) NOT NULL,
  `date` int(11) NOT NULL,
  PRIMARY KEY (`id`)
);
CREATE TABLE IF NOT EXISTS `mail_subscriber_posts_heap` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `post_id` int(11) NOT NULL,
  `is_ready` tinyint(1) NOT NULL,
  `date_add` int(11) NOT NULL,
  `date_last_send` int(11) NOT NULL DEFAULT '0',
  `times_send` int(4) NOT NULL,
  PRIMARY KEY (`id`)
);