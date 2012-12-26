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
 * TODO Probably will have to add many of this later on...
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
?>