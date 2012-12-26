CREATE TABLE IF NOT EXISTS `traffic_completed` 
(
	`id` int(10) unsigned NOT NULL auto_increment,
	`userid` int(10) NOT NULL default '0',
	`torrentid` int(10) NOT NULL default '0',
	`date` datetime NOT NULL default '0000-00-00 00:00:00',
	PRIMARY KEY  (`id`),
	UNIQUE `userid_torrentid` (`userid`, `torrentid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;