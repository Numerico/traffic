traffic
=======

media wiki torrent tracker extension

to install add the following in LocalSettings.php
require_once( "$IP/extensions/Traffic/Traffic.php" );
$wgFileExtensions[] = 'torrent';

besides, you'll have to add torrent mime-type in includes/mime.types
application/x-bittorrent torrent
and it's media type in includes/mime.info
application/x-bittorrent [EXECUTABLE]
