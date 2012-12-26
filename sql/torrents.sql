CREATE TABLE IF NOT EXISTS `traffic_torrents`
(
	`id` int(10) unsigned NOT NULL auto_increment,
	`post_id` bigint(20) unsigned NOT NULL default '0',
	`attachment_id` bigint(20) unsigned NOT NULL default '0',
	`info_hash` varchar(40) default NULL,
	`name` varchar(255) NOT NULL default '',
	`filename` varchar(255) NOT NULL default '',
	`save_as` varchar(255) NOT NULL default '',
	`category` int(10) unsigned NOT NULL default '0',
	`size` bigint(20) unsigned NOT NULL default '0',
	`type` enum('single','multi') NOT NULL default 'single',
	`numfiles` int(10) unsigned NOT NULL default '0',
	`banned` enum('yes','no') NOT NULL default 'no',
	`owner` int(10) unsigned NOT NULL default '0',
	`nfo` enum('yes','no') NOT NULL default 'no',
	`announce` varchar(255) NOT NULL default '',
	`torrentlang` int(10) unsigned NOT NULL default '1',
	PRIMARY KEY  (`id`),
	UNIQUE KEY `info_hash` (`info_hash`(20)),
	KEY `owner` (`owner`),
	FULLTEXT KEY `name` (`name`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;