<?php
class SpecialTorrentUpload extends SpecialPage {
	/**
	 * Inherited constructor
	 */
	function __construct() {
		parent::__construct( 'SpecialTorrentUpload' );
	}	
	
	/**
	 * Main function ($par is the subpage)
	 * http://www.mediawiki.org/wiki/Manual:Special_pages
	 * Draws Torrent Upload Form
	 */
	function execute($par){
		$this->setHeaders();
        $output = $this->getOutput();

        $html = '<form action="algo.php" enctype="multipart/form-data" method="post" name="torrent_upload">';
		$html .= Xml::buildForm(
			array(
				'torrent'=>Xml::input("torrent", false, false, array("type"=>"file")),
				'torrentname'=>Xml::input("name")
			),
			'upload'
		);
		$html .= '</form>';
		
        $output->addHTML($html);
	}
}
?>