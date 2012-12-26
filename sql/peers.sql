CREATE TABLE IF NOT EXISTS `traffic_peers`
(
	`id` int(10) unsigned NOT NULL auto_increment,
	`torrent` int(10) unsigned NOT NULL default '0',
	`peer_id` varchar(40) NOT NULL default '',
	`ip` varchar(64) NOT NULL default '',
	`port` smallint(5) unsigned NOT NULL default '0',
	`uploaded` bigint(20) unsigned NOT NULL default '0',
	`downloaded` bigint(20) unsigned NOT NULL default '0',
	`to_go` bigint(20) unsigned NOT NULL default '0',
	`seeder` enum('yes','no') NOT NULL default 'no',
	`started` datetime NOT NULL default '0000-00-00 00:00:00',
	`last_action` datetime NOT NULL default '0000-00-00 00:00:00',
	`connectable` enum('yes','no') NOT NULL default 'yes',
	`client` varchar(60) NOT NULL default '',
	`userid` varchar(32) NOT NULL default '',
	`passkey` varchar(32) NOT NULL default '',
	PRIMARY KEY  (`id`),
	UNIQUE KEY `torrent_peer_id` (`torrent`,`peer_id`),
	KEY `torrent` (`torrent`),
	KEY `torrent_seeder` (`torrent`,`seeder`),
	KEY `last_action` (`last_action`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT = 1;