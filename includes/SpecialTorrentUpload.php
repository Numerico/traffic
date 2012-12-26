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
		$html = '<form action="'.dirname(dirname($_SERVER['PHP_SELF'])).'/api.php" enctype="multipart/form-data" method="post" name="torrent_upload">';
		$html .= Xml::buildForm(
			array(
				'file'=>Xml::input("file", false, false, array("type"=>"file")),
				'filename'=>Xml::input("filename"),
				'comment' => Xml::input('comment'),
			),
			'torrentupload'
		);
		$html .= '<input type="hidden" name="token" value="1a807d44801c37fa049928bc6b51cb8d+\"/>'
				.'<input type="hidden" name="action" value="upload">'
				.'<input type="hidden" name="format" value="json">';
		$html .= '</form>';
        $output->addHTML($html);
	}
}
?>