CREATE TABLE IF NOT EXISTS `traffic_torrent_languages` 
	(
	`id` int(10) unsigned NOT NULL auto_increment,
	`name` varchar(30) NOT NULL default '',
	`image` varchar(255) NOT NULL default '',
	`sort_index` int(10) unsigned NOT NULL default '0',
	PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8;