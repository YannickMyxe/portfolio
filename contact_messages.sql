
CREATE TABLE `messages` (
  `id` int(11) NOT NULL auto_increment,
  `sender` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `added_on` datetime NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARACTER SET utf8mb4 DEFAULT COLLATE utf8mb4_unicode_ci AUTO_INCREMENT = 1;
