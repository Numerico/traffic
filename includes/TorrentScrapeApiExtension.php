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
	 * Main function
	 */
	public function execute() {
		$this->getResult()->addValue(null,null,'example');//call only once
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
	 * Params TODO
	 */
	public function getAllowedParams() {
            return array(
                    'param1' => array (
                            ApiBase::PARAM_TYPE => 'string',
                            ApiBase::PARAM_REQUIRED => false
                    ),
            );
    }
	
	/**
	 * Describe the parameter TODO
	 */
    public function getParamDescription() {
            return array( 'param1' => "nuthin\' dude..");
    }
	
	/**
	 * Examples TODO
	 */
	public function getExamples() {
    	return array(
            'Get a sideways look (and the usual predictions)'=>' api.php?action=scrape&face=O_o&format=xml' 
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