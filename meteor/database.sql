-- ---
-- Globals
-- ---

-- SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
-- SET FOREIGN_KEY_CHECKS=0;

-- ---
-- Table 'users'
-- 
-- ---

DROP TABLE IF EXISTS `users`;
		
CREATE TABLE `users` (
	`user_id` INT NOT NULL AUTO_INCREMENT,		# unique id
	`username` VARCHAR(50) NOT NULL,			# e-mail
	`password` VARCHAR(50) NOT NULL,			# password
	`firstname` VARCHAR(50) NULL DEFAULT NULL,	# first name
	`lastname` VARCHAR(50) NULL DEFAULT NULL,	# last name
	`mobile` VARCHAR(50) NULL DEFAULT NULL,		# mobile number
	`role` INT NOT NULL,						# 0-admin, 1-manager, 2-participant
	`salt` VARCHAR(255) NOT NULL,				# 
	`verified` INT NOT NULL DEFAULT 0,			# 0-not verified, 1-verified
	slug VARCHAR(128) NOT NULL,					# 
	PRIMARY KEY (`user_id`),
	KEY slug (slug)
);

/*
INSERT INTO `users` VALUES(1, "kent7tnek@yahoo.com", "password", "Kent", "Sarmiento", "09273566288", 2, "salt", 0, "slug");
INSERT INTO `users` VALUES(2, "erika.santos@gmail.com", "password", "Erika", "Santos", "09265665902", 2, "salt", 0, "slug");
INSERT INTO `users` VALUES(3, "chris.rosario@yahoo.com", "password", "Chris", "Rosario", "09274610679", 2, "salt", 0, "slug");
INSERT INTO `users` VALUES(4, "efren.ver.sia@yahoo.com", "password", "Efren Ver", "Sia", "09164632369", 2, "salt", 0, "slug");
INSERT INTO `users` VALUES(5, "kent.sarmiento@gmail.com", "password", "Kent Tristan Yves", "Sarmiento", "09273566288", 2, "salt", 0, "slug");
INSERT INTO `users` VALUES(6, "sevymras@yahoo.com", "password", "Sevy", "Mras", "09273566288", 2, "salt", 0, "slug");
INSERT INTO `users` VALUES(7, "manager@yahoo.com", "password", "Manager", "One", "09987654321", 1, "salt", 1, "slug");
INSERT INTO `users` VALUES(8, "master.admin@yahoo.com", "password", "Master", "Admin", "09123456789", 0, "salt", 1, "slug");
*/

-- ---
-- Table 'courses'
-- 
-- ---

DROP TABLE IF EXISTS `courses`;
		
CREATE TABLE `courses` (
	`course_id` INT NOT NULL AUTO_INCREMENT,		# unique id
	`course_name` VARCHAR(255) NULL DEFAULT NULL,	# course name
	`description` VARCHAR(255) NULL DEFAULT NULL,	# course description
	`cost` INT NOT NULL,							# cost
	`start` DATE NOT NULL,							# start date (YYYY-MM-DD)
	`end` DATE NOT NULL,							# end date (YYYY-MM-DD)
	`venue` VARCHAR(200) NOT NULL DEFAULT 'TBA',	# venue
	`available` TINYINT NOT NULL,					# available slots
	`reserved` TINYINT NOT NULL,					# reserved slots
	`paid` TINYINT NOT NULL,						# paid slots
	PRIMARY KEY (`course_id`)
);

/*
INSERT INTO `courses` VALUES(100, "CS 10", "CS for dummies", 3000, '2013-01-01', '2014-01-01', "TBA", 16, 4, 0);
INSERT INTO `courses` VALUES(200, "CS 11", "Computer Programming I", 3000, '2013-01-01', '2014-01-01', "TBA", 16, 4, 0);
INSERT INTO `courses` VALUES(300, "CS 12", "Computer Programming II", 3000, '2013-01-01', '2014-01-01', "TBA", 19, 1, 0);
*/

-- ---
-- Table 'reserved'
-- 
-- ---

DROP TABLE IF EXISTS `reserved`;
		
CREATE TABLE `reserved` (
	`user_id` INT NOT NULL,					# user id
	`course_id` INT NOT NULL,				# course id
	`date` DATETIME NULL DEFAULT NULL,		# date and time of reservation
	PRIMARY KEY (`user_id`, `course_id`)
);

/*
INSERT INTO `reserved` VALUES(1, 100, NOW());
INSERT INTO `reserved` VALUES(1, 200, NOW());
INSERT INTO `reserved` VALUES(1, 300, NOW());
INSERT INTO `reserved` VALUES(2, 100, NOW());
INSERT INTO `reserved` VALUES(2, 200, NOW());
INSERT INTO `reserved` VALUES(3, 100, NOW());
INSERT INTO `reserved` VALUES(3, 200, NOW());
INSERT INTO `reserved` VALUES(4, 100, NOW());
INSERT INTO `reserved` VALUES(5, 200, NOW());
*/

-- ---
-- Table 'paid'
-- 
-- ---

/*
DROP TABLE IF EXISTS `paid`;
		
CREATE TABLE `paid` (
	`pid` INT NOT NULL AUTO_INCREMENT,	# unique id
	`user_id` INT NOT NULL,				# user id
	`bank_or_cash` INT NOT NULL,		# 0-bank payment, 1-cash payment
	PRIMARY KEY (`pid`)
);
-- comment: di naman kailangan ng course_id kasi isang babayaran nalang ang gagawin ni participant diba?
*/

-- ---
-- Table 'cashpayment'
-- 
-- ---

DROP TABLE IF EXISTS `cashpayment`;
		
CREATE TABLE `cashpayment` (
	`cp_id` INT NOT NULL AUTO_INCREMENT,	# unique id
	`user_id` INT NOT NULL,					# user id
	`ornumber` VARCHAR(50) NOT NULL,		# OR number
	`date` DATE NOT NULL,					# date of payment
	PRIMARY KEY (`cp_id`)
);
-- comment: di na kailangan ng amount kasi sakto lang ang babayaran sabi ni sir diba?

-- ---
-- Table 'bankpayment'
-- 
-- ---

DROP TABLE IF EXISTS `bankpayment`;
		
CREATE TABLE `bankpayment` (
	`bp_id` INT NOT NULL AUTO_INCREMENT,	# unique id
	`user_id` INT NOT NULL,					# user id
	`bankdetails` VARCHAR(250) NOT NULL,	# bank details
	`transaction_id` INT NOT NULL,			# transaction id
	`date` DATE NULL DEFAULT NULL,			# date of transaction
	PRIMARY KEY (`bp_id`)
);

-- ---
-- Table 'cancelled'
-- 
-- ---

DROP TABLE IF EXISTS `cancelled`;
		
CREATE TABLE `cancelled` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `user_id` INT NOT NULL,
  `course_id` INT NULL DEFAULT NULL,
  `date` DATETIME NOT NULL,
  `refunded` INT NOT NULL,
  PRIMARY KEY (`id`)
);

-- ---
-- Table 'completed'
-- 
-- ---

DROP TABLE IF EXISTS `completed`;
		
CREATE TABLE `completed` (
  `id` INT NOT NULL AUTO_INCREMENT DEFAULT NULL,
  `user_id` INT NOT NULL,
  `course_id` INT NOT NULL,
  `date` DATETIME NOT NULL,
  PRIMARY KEY (`id`)
);

-- ---
-- Table 'managers'
-- 
-- ---

DROP TABLE IF EXISTS `managers`;
		
CREATE TABLE `managers` (
  `id` TINYINT NULL AUTO_INCREMENT DEFAULT NULL,
  `user_id` INT NOT NULL,
  `status` INT NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`)
);

-- ---
-- Foreign Keys 
-- ---

ALTER TABLE `paid` ADD FOREIGN KEY (user_id) REFERENCES `users` (`id`);
ALTER TABLE `paid` ADD FOREIGN KEY (course_id) REFERENCES `courses` (`id`);
ALTER TABLE `reserved` ADD FOREIGN KEY (user_id) REFERENCES `users` (`id`);
ALTER TABLE `reserved` ADD FOREIGN KEY (course_id) REFERENCES `courses` (`id`);
ALTER TABLE `cancelled` ADD FOREIGN KEY (user_id) REFERENCES `users` (`id`);
ALTER TABLE `cancelled` ADD FOREIGN KEY (course_id) REFERENCES `courses` (`id`);
ALTER TABLE `cashpayment` ADD FOREIGN KEY (paid_id) REFERENCES `paid` (`id`);
ALTER TABLE `bankpayment` ADD FOREIGN KEY (paid_id) REFERENCES `paid` (`id`);
ALTER TABLE `completed` ADD FOREIGN KEY (user_id) REFERENCES `users` (`id`);
ALTER TABLE `completed` ADD FOREIGN KEY (course_id) REFERENCES `courses` (`id`);
ALTER TABLE `managers` ADD FOREIGN KEY (user_id) REFERENCES `users` (`id`);

-- ---
-- Table Properties
-- ---

-- ALTER TABLE `users` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
-- ALTER TABLE `courses` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
-- ALTER TABLE `paid` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
-- ALTER TABLE `reserved` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
-- ALTER TABLE `cancelled` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
-- ALTER TABLE `cashpayment` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
-- ALTER TABLE `bankpayment` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
-- ALTER TABLE `completed` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
-- ALTER TABLE `managers` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ---
-- Test Data
-- ---

-- INSERT INTO `users` (`id`,`username`,`password`,`firstname`,`lastname`,`role`,`salt`,`verified`) VALUES
-- ('','','','','','','','');
-- INSERT INTO `courses` (`id`,`name`,`description`,`cost`,`start`,`end`,`available`,`reserved`,`paid`,`venue`) VALUES
-- ('','','','','','','','','','');
-- INSERT INTO `paid` (`id`,`user_id`,`course_id`,`bank_or_cash`) VALUES
-- ('','','','');
-- INSERT INTO `reserved` (`id`,`user_id`,`course_id`,`date`) VALUES
-- ('','','','');
-- INSERT INTO `cancelled` (`id`,`user_id`,`course_id`,`date`,`refunded`) VALUES
-- ('','','','','');
-- INSERT INTO `cashpayment` (`id`,`amount`,`ornumber`,`paid_id`,`date`) VALUES
-- ('','','','','');
-- INSERT INTO `bankpayment` (`id`,`bankname`,`bankbranch`,`paid_id`,`date`,`transaction_id`) VALUES
-- ('','','','','','');
-- INSERT INTO `completed` (`id`,`user_id`,`course_id`,`date`) VALUES
-- ('','','','');
-- INSERT INTO `managers` (`id`,`user_id`,`status`) VALUES
-- ('','','');

*/