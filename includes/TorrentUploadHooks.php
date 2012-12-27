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
				//TODO $localFile is null, after all, this should be done before upload
			}
		}
		return true;
	}
	
	/**
	 * Save uploaded torrent to database for tracking.
	 */
	public static function onUploadComplete(&$image){
				
		if(MimeMagic::singleton()->isMatchingExtension('torrent', $image->getLocalFile()->mime)) {

			require_once dirname(__FILE__) . '/parse.php';
			//parse torrent
			$torrentInfo = array();
			$torrentInfo = ParseTorrent($image->getLocalFile()->getLocalRefPath());//TODO what'd happen if clustered, etc? does mwstore:// help here?
			$announce = $torrentInfo[0];
			$infohash = $torrentInfo[1];
			$creationdate = $torrentInfo[2];
			$internalname = $torrentInfo[3];
			$torrentsize = $torrentInfo[4];
			$filecount = $torrentInfo[5];
			$annlist = $torrentInfo[6];
			$comment = $torrentInfo[7];
			$filelist = $torrentInfo[8];
			
		}
		return true;
	}
}
?>