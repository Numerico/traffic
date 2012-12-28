<?php
require_once dirname(__FILE__) . '/ApiFormatPlain.php';

class TorrentAnnounce extends ApiBase{
	
	/**
	 * Overwrite format module
	 * not to have to return an array
	 * but just a string.
	 */
	public function getCustomPrinter() {
		return new ApiFormatPlain($this->getMain(),'plain');
	}
	
	/**
	 * Main function
	 * TODO lacks validations eg. infohash exists, has data in torrent_announce, etc.
	 */
	public function execute() {
		//TODO
		return true;
	}
	
	/**
	 * Version
	 */
	public function getVersion() {
            return __CLASS__ . ': $Id$';
    }
	
	/**
	 * Description TODO
	 */
	public function getDescription() {
            return 'Torrent Announce';
    }
	
	/**
	 * Params TODO
	 */
	public function getAllowedParams() {
            return array(
                    'infohash' => array (
                            ApiBase::PARAM_TYPE => 'string',
                            ApiBase::PARAM_REQUIRED => true
                    ),
            );
    }
	
	/**
	 * Describe the parameter TODO
	 */
    public function getParamDescription() {
            return array( 'infohash' => "infohash dude..");
    }
	
	/**
	 * Examples TODO
	 */
	public function getExamples() {
    	return array(
            'this is a valid torrent'=>'api.php?action=scrape&infohash=5c8f40d95f27a2fff7e763c1126f1872f7df8ed3' 
		);
    }	
}
?>