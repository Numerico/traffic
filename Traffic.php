<?php
/**
 * COMMON CONFIGURATION FILE FOR TORRENT EXTENSIONS
 */

/**
 * Alert the user that this is not a valid entry point to MediaWiki if they try to access the special pages file directly
 */
if(!defined('MEDIAWIKI')){
	//TODO echo <<< EOT
	exit(1);
}

/**
 * Adds info to the Special:Version page
 * http://www.mediawiki.org/wiki/Manual:$wgExtensionCredits
 */
$wgExtensionCredits['specialpage'][] = array(
	'path' => __FILE__,
	'name' => 'TorrentUpload',
	'author' =>'numerico', 
	'url' => 'https://joyeria.numerica.cl', 
	'description' => 'Torrent tracker functionality',
	'version'  => 0.1,
);

/**
 * Autoloading
 * http://www.mediawiki.org/wiki/Manual:Developing_extensions
 */
//internationalization messages
$wgExtensionMessagesFiles[ 'Traffic' ] = __DIR__ . '/Traffic.i18n.php';
//includes directory
$wgMyExtensionIncludes = dirname(__FILE__) . '/includes';
//Torrent Upload
$wgAutoloadClasses['SpecialTorrentUpload'] = $wgMyExtensionIncludes . '/SpecialTorrentUpload.php'; //auto-load class
$wgExtensionMessagesFiles['TrafficAlias'] = $wgMyExtensionIncludes . '/SpecialTorrentUpload.alias.php'; //page name internationalization
$wgSpecialPages['SpecialTorrentUpload'] = 'SpecialTorrentUpload'; //Tell MediaWiki about the new special page and its class name
$wgSpecialPageGroups['SpecialTorrentUpload'] = 'media'; //List under media category

/**
 * Database update
 */
$wgHooks['LoadExtensionSchemaUpdates'][] = 'fnTraffic';
function fnTraffic(DatabaseUpdater $updater){
	$wgMyExtensionDB = dirname(__FILE__) . '/sql';
	$updater->addExtensionUpdate(array('addTable','traffic_announce', $wgMyExtensionDB . '/announce.sql',true));
	$updater->addExtensionUpdate(array('addTable','traffic_completed', $wgMyExtensionDB . '/completed.sql',true));
	$updater->addExtensionUpdate(array('addTable','traffic_peers', $wgMyExtensionDB . '/peers.sql',true));
	$updater->addExtensionUpdate(array('addTable','traffic_torrents', $wgMyExtensionDB . '/torrents.sql',true));
	$updater->addExtensionUpdate(array('addTable','traffic_torrent_languages', $wgMyExtensionDB . '/languages.sql',true));
	return true;
	//TODO <= 1.16 http://www.mediawiki.org/wiki/Manual:Hooks/LoadExtensionSchemaUpdates
}
 
?>