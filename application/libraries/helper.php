<?php

/**
* Various helper methods
*
* @package		SAAV
* @subpackage	Libraries
* @author		Mario Cuba <mario@mariocuba.net>
*/
class Helper {

    // for safe base64
    public static $unallowedChars      =  array('+', '/');
    public static $replacementChars    =  array('_', '-');

    /**
    * Creates the markup for an icon
    *
    * @param	string	- the name of the icon
    * @return	string	- the markup of the icon
    * @access	public
    */
    public static function icon($icon) {
    	return '<i class="icon-' . $icon . '"></i>';
    }

    /**
    * Parses a ticket status
    *
    * @param    string  - the status
    * @return   string  - a formatted HTML string
    * @access   public
    */
    public static function status($status, $type = 'text') {
        switch ($type) {
            case 'text':
                switch($status) {
                    case 'open':           $status = 'Abierta';     $type = 'warning';  break;
                    case 'closed':         $status = 'Cerrada';     $type = 'success';  break;
                    case 'hold':           $status = 'En espera';   $type = 'info';     break;
                    case 'in-progress':    $status = 'En proceso';  $type = 'default';  break;
                }

                return '<span class="highlight highlight-' . $type . '">' . $status . '</span>';
            break;
        }
    }

    /**
    * Turns a unix timestamp into an SQL-standard date, time, or both
    *
    * @param    int     - unix time()
    * @param    string  - the time of string needed: 
    **/
    public static function sqltime($timestamp, $type = 'date') {
        switch ($type) {
            case 'date':    return date('Y-m-d', $timestamp);       break;
            case 'time':    return date('H:i:s', $timestamp);       break;
            default:        return date('Y-m-d H:i:s', $timestamp); break;
        }
    }

    /**
    * Calculates the required icon for a file extension
    *
    * @param    string  - the file extension
    * @return   string  - the path to the file extension icon
    * @access   public
    */
    public static function fileicon($ext) {
        $types = array (
            'doc'   => 'document',
            'docx'  => 'document',
            'png'   => 'image',
            'jpg'   => 'image',
            'jpeg'  => 'image',
            'gif'   => 'image',
            'sql'   => 'code',
            'js'    => 'code',
            'css'   => 'code',
            'html'  => 'web',
            'php'   => 'php',
            'pdf'   => 'pdf',
            'mp3'   => 'audio',
            'ogg'   => 'audio',
            'm4a'   => 'audio',
            'wma'   => 'audio',
            'wmv'   => 'video',
            'avi'   => 'video',
            'mov'   => 'video',
            'm4v'   => 'video',
            'tar'   => 'compressed',
            'gz'    => 'compressed',
            'b2'    => 'compriessed',
            'zip'   => 'compressed',
            'rar'   => 'compressed',
            '7z'    => 'compressed',
            'psd'   => 'ps',
            'ppt'   => 'slide',
            'pptx'  => 'slide',
            'xls'   => 'excel',
            'xlsx'  => 'excel',
            'csv'   => 'excel',
            'tsv'   => 'excel',
            'flv'   => 'flash',
            'fla'   => 'flash',
        );

        if (!isset($types[$ext])) {
            return URL::to('img/files/' . 'file.png');
        } else {
            return URL::to('img/files/' . $types[$ext] . '.png');
        }
    }

    /**
    * Calculates the file type string according to the extension
    *
    * @param    string  - the file extension
    * @return   string  - the file type
    * @access   public
    */
    public static function filetype($ext) {
        $types = array (
            'doc'  => 'Documento de Microsoft Word 98-2003',
            'docx' => 'Documento de Microsoft Word',
            'png'  => 'Imagen PNG',
            'jpg'  => 'Imagen JPG',
            'jpeg' => 'Imagen JPEG',
            'gif'  => 'Imagen GIF',
            'sql'  => 'Archivo de Consultas SQL',
            'js'   => 'Código de JavaScript',
            'css'  => 'Hoja de Estilo CSS',
            'html' => 'Documento HTML',
            'php'  => 'Código PHP',
            'pdf'  => 'Documento PDF',
            'mp3'  => 'Audio MP3',
            'ogg'  => 'Audio OGG',
            'm4a'  => 'Audio M4A',
            'wma'  => 'Windows Media Audio',
            'wmv'  => 'Windows Media Video',
            'avi'  => 'Película AVI',
            'mov'  => 'Película MOV',
            'm4v'  => 'Película M4V',
            'tar'  => 'Tarball',
            'gz'   => 'Tarball Comprimido con GZ',
            'b2'   => 'Tarball Comprimido con B2',
            'zip'  => 'Archivo Comprimido ZIP',
            'rar'  => 'Archivo Comprimido RAR',
            '7z'   => 'Archivo Comprimido 7Z',
            'psd'   => 'Archivo de Adobe Photoshop',
            'ppt'   => 'Presentación de PowerPoint 98-2003',
            'pptx'  => 'Presentación de PowerPoint',
            'xls'   => 'Hoja de Cálculo de Excel 98-2003',
            'xlsx'  => 'Hoja de Cálculo de Excel',
            'csv'   => 'Archivo Separado por Comas',
            'tsv'   => 'Archivo Separado por Tabulaciones',
            'flv'   => 'Película de Flash',
            'fla'   => 'Documento de Adobe Flash',
        );

        if (!isset($types[$ext])) {
            return 'Archivo';
        } else {
            return $types[$ext];
        }
    }

    /**
    * Makes base64 strings url-safe
    *
    * @param    string  - base64 string
    * @return   string  - the base64 string with replacements
    */
    public static function encode_safe_base64($string) {
        return str_replace(self::$unallowedChars, self::$replacementChars, base64_encode($string));
    }

    /**
    * Reverts an URL-safe string back to its original state
    *
    * @param    string  - safe base64 string
    * @return   string  - the original base64 string
    */
    public static function decode_safe_base64($string) {
        return base64_decode(str_replace(self::$replacementChars, self::$unallowedChars, $string));
    }
}