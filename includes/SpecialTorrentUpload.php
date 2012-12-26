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
		global $wgUser;
		$this->setHeaders();
		$output = $this->getOutput();
		$html = '<form action="'.dirname(dirname($_SERVER['PHP_SELF'])).'/api.php" enctype="multipart/form-data" method="post">';//double dirname strips index.php or wiki/ dir
		$html .= Xml::buildForm(
			array(
				'torrent'=>Xml::input("file", false, false, array("type"=>"file")),
				'torrentname'=>Xml::input("filename"),
				'torrentdesc' => Xml::textarea('comment',"")
			),
			'torrentupload'
		);
		$html .= Html::hidden('token',$wgUser->getEditToken()) 
				.Html::hidden('action','upload');
		$html .= '</form>';
        $output->addHTML($html);
	}
}
?>