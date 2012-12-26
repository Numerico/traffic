<?php
class SpecialTorrentUpload extends SpecialPage {
	/**
	 * Inherited constructor
	 */
	function __construct() {
		parent::__construct( 'SpecialTorrentUpload' );
	}	
	
	/**
	 * Main function
	 * $par is the subpage
	 * http://www.mediawiki.org/wiki/Manual:Special_pages
	 */
	function execute($par){
		$request = $this->getRequest();
        $output = $this->getOutput();
        $this->setHeaders();
        # Get request data from, e.g.
        $param = $request->getText( 'param' );
        # Do stuff
        # ...
        $wikitext = 'Hello world!';
        $output->addWikiText( $wikitext );
	}
}
?>