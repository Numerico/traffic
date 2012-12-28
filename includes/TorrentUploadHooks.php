<?php
class TorrentUploadHooks{
	
	/**
	 * Extra validation & intelligence for torrent uploads.
	 * http://www.mediawiki.org/wiki/Manual:Hooks/UploadVerifyFile
	 */
	public static function onUploadVerifyFile($upload,$mime,&$error){
		if (!MimeMagic::singleton()->isMatchingExtension('torrent', $mime)) {
			return wfMessage('invalidtorrentext')->plain(); // not a torrent, abort
		}
		else{
			if($upload->getTitle()==null){
				//just take file's name
				$localFile = $upload->getLocalFile();
				//TODO $localFile is null, after all this should be done BEFORE upload
			}
		}
		return true;
	}
	
	/**
	 * Save uploaded torrent to database for tracking.
	 */
	public static function onUploadComplete(&$image){
		
		global $wgUser;
				
		if(MimeMagic::singleton()->isMatchingExtension('torrent', $image->getLocalFile()->mime)) {

			require_once dirname(__FILE__) . '/parse.php';
			
			//parse torrent
			$torrentInfo = array();
			$torrentInfo = ParseTorrent($image->getLocalFile()->getLocalRefPath());//TODO what'd happen if clustered, etc? does mwstore:// help here?
			$announce = $torrentInfo[0];
			$infohash = $torrentInfo[1];
			$creationdate = $torrentInfo[2];//TODO not used
			$name = $torrentInfo[3];
			$torrentsize = $torrentInfo[4];
			$filecount = $torrentInfo[5];
			$annlist = $torrentInfo[6];
			$comment = $torrentInfo[7];//TODO not used
			$filelist = $torrentInfo[8];
			
			//arrange
			$name = str_replace(".torrent","",$name);
			$name = str_replace("_", " ", $name);
			$fname = $image->getTitle()->getBaseText();

			//data
			$upload_torrent = array(
				//'post_id' => ''.$upload_torrent_post_id.'',
				//'attachment_id' => ''.$upload_torrent_image_post_id.'',
				'info_hash' => $infohash,
				'name' => $name,
				'filename' => $fname,//TODO what for?
				//'save_as' => ''.$fname.'',
				//'category' => ''.$catid.'',
				'size' => $torrentsize,
				//'type' => ''.$type.'',
				'numfiles' => $filecount,
				'owner' => $wgUser->getId(),//TODO assuming torrent is current user's
				//'nfo' => ''.$nfo.'',
				'announce' => $announce,
				//'torrentlang' => ''.$langid.''//TODO mmm
			);
			
			//save torrent
			$dbw = wfGetDB(DB_MASTER);
			$dbw->insert('traffic_torrents',$upload_torrent);

			//get inserted id
			$result = $dbw->select("traffic_torrents","id","info_hash='".$infohash."'");
			$last_id = $result->fetchObject()->id;

			//save announce urls
			if (!count($annlist)) {
				$annlist = array(array($announce));
			}
			foreach ($annlist as $anns) {
				foreach ($anns as $val) {
					if (strtolower(substr($val, 0, 4)) != "udp:"){//TODO why not?
						$sql =  "'".mysql_real_escape_string($val)."'";
						$upload_torrent_announce = array( 'url' => $sql, 'torrent' => $last_id );
						$dbw->insert('traffic_announce',$upload_torrent_announce);
					}
				}
			}			
		}
		return true;
	}
}
?>