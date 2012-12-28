<?php
class TorrentScrape extends ApiBase{
	
	/**
	 * Overwrite format module
	 * not to have to return an array
	 * but just a string.
	 */
	public function getCustomPrinter() {
		return new ApiFormatPlain($this->getMain(),'plain');
	}
	
	/**
	 * Utility: convert hexadecimal to binary
	 */
	function hex2bin($hexdata) {
	  $bindata = "";
	  for ($i=0;$i<strlen($hexdata);$i+=2) {
	    $bindata.=chr(hexdec(substr($hexdata,$i,2)));
	  }
	
	  return $bindata;
	}
	
	/**
	 * Main function
	 * TODO lacks validations eg. infohash exists, has data in torrent_announce, etc.
	 */
	public function execute() {
		
		$result="d5:filesd";
		
			$params = $this->extractRequestParams();
			
			//TODO assuming a torrent can have only one infohash, while trader uses a loop...
			$infohash = $params['infohash'];
			$dbw = wfGetDB(DB_SLAVE);
			$query = $dbw->select(
				array("trr"=>"traffic_torrents","annc"=>"traffic_announce"),
				array("trr.id","trr.filename","annc.seeders","annc.leechers","annc.times_completed"),
				array("trr.info_hash='".$infohash."'","trr.id=annc.torrent")
			);
			$obj=$query->fetchObject();
			$seeders=$obj->seeders;
			$leechers=$obj->leechers;
			$times_completed=$obj->times_completed;
			$filename=$obj->filename;
			
			$hash = hex2bin($infohash);
		    $result.="20:".$hash."d";
		    $result.="8:completei".$seeders."e";
		    $result.="10:downloadedi".$times_completed."e";
		    $result.="10:incompletei".$leechers."e";
		    $result.="4:name".strlen($filename).":".$filename."e";
		    $result.="e";
			
		$result.="ee";
		
		$this->getResult()->addValue(null,null,$result);//call only once
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
            return 'Torrent Scrape';
    }
	
	/**
	 * Params
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

/**
 * Custom Printer to override API Result as a simple string
 * As such, it will only read the first value added to the result
 * So it has to be set only once.
 */
class ApiFormatPlain extends ApiFormatBase {
	
	public function __construct( $main, $format ) {
		parent::__construct( $main, $format );
	}

	public function getMimeType() {
		return 'text/html';
	}

	/**
	 * Returns array's first pair's value.
	 */
	public function execute() {
		$data = $this->getResultData();
		$this->printText($data[0]);
	}

	public function getDescription() {
		return 'Output data as a single plain string' . parent::getDescription();
	}

	public function getVersion() {
		return __CLASS__ . ': $Id$';
	}
}
?>