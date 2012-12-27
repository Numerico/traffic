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

				if($localFile==NULL) return "null";
				else return "...";
			}
		}
		return true;
	}
	
	/**
	 * Save uploaded torrent to database.
	 */
	function torrentSave(){
		
	}
}
?>