<?php
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