<?php

/**
* Selects the correct name for a file extension.
*
* @param	string	- the file extension
* @return	string	- the complete file type
*/
function extension_name($extension) {
	// has a dot, remove it
	if (strpos($extension, '.') === 0) {
		$extension = substr($extension, 1);
	}

	switch ($extension) {
		case 'pdf': 	$name = 'Documento PDF';					break;
		case 'zip':		$name = 'Archivo ZIP';						break;
		case 'tar':		$name = 'Tarball';							break;
		case 'gz':		$name = 'Tarball Comprimida (GZip)';		break;
		case 'bz':		$name = 'Tarball Comprimida (BZip)';		break;
		case 'rar':		$name = 'Archivo RAR';						break;
		case 'mov':		$name = 'Película';							break;
		case 'doc':		$name = 'Documento de Word 2003';			break;
		case 'docx':	$name = 'Documento de Word';				break;
		case 'xls':		$name = 'Documento de Excel 2003';			break;
		case 'xlsx':	$name = 'Documento de Excel';				break;
		case 'ppt':		$name = 'Presentación de PowerPoint 2003';	break;
		case 'pptx':	$name = 'Presentación de PowerPoint';		break;
		case 'html':	$name = 'Documento HTML';					break;
		case 'css':		$name = 'Hoja de Estilos en Cascada';		break;
		case 'js':		$name = 'Archivo JavaScript';				break;
		case 'csv':		$name = 'Archivo Separado por Comas';		break;
		case 'bmp':		$name = 'Mapa de Bits';						break;
		case 'jpg':		$name = 'Imagen JPG';						break;
		case 'jpeg':	$name = 'Imagen JPEG';						break;
		case 'png':		$name = 'Imagen PNG';						break;
		case 'gif':		$name = 'Imagen GIF';						break;
		case 'txt':		$name = 'Archivo de Texto';					break;
		case 'psd':		$name = 'Documento de Photoshop';			break;
		case 'ai':		$name = 'Documento de Illustrator';			break;
		case 'fla':		$name = 'Película Flash';					break;
		case 'mp3':		$name = 'Archivo MP3';						break;
		case 'mp4':		$name = 'Archivo MP4';						break;
		case 'mov':		$name = 'Película';							break;
		default:		$name = 'Archivo';							break;
	}

	return $name;
}

/* End of file extension_helper.php */
/* Location: ./application/helpers/extension_helper.php */