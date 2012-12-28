<?php
/**
 * Common i18n file for the whole extension
 */
$messages = array();

//TORRENT UPLOAD

/** Spanish
 * @author numerico
 */
$messages['es'] = array(//TODO codigo español
        'specialtorrentupload' => "Subir Torrent", // Important! This is the string that appears on Special:SpecialPages
        'specialtorrentupload-desc' => "Formulario para subir un archivo .torrent",
        //upload form
        'torrent' => "Archivo .torrent",
        'torrentname' => "Nombre del torrent",
        'torrentdesc' => "Comentario",
        'torrentupload' => "Difundir",
        'invalidtorrentext' => '¡El archivo no es un .torrent!',
        //upload hook
        'uploadhookdesc' => 'guarda los torrents subidos para rastrearlos',
);

/** English
 * @author numerico
 */
$messages[ 'en' ] = array(
        'specialtorrentupload' => "Torrent Upload", // Important! This is the string that appears on Special:SpecialPages
        'specialtorrentupload-desc' => "Torrent files upload form",
        //upload form
        'torrent' => "Torrent file",
        'torrentname' => "Torrent's name",
        'torrentdesc' => "Comment",
        'torrentupload' => "Upload",
        'invalidtorrentext' => "¡Not a .torrent file!",
        //upload hook
        'uploadhookdesc' => 'save uploaded torrents for tracking',
);

/** Message documentation TODO
 * @author numerico
$messages[ 'qqq' ] = array(
        'myextension' => "The name of the extension's entry in Special:SpecialPages",
        'myextension-desc' => "{{desc}}",
);
*/
?>