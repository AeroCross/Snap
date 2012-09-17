<?php

/**
* Inserts an icon.
*
* This works with Glyphicons (bundled with Bootstrap) and Font Awesome icons.
*
* @param	string	- the name of the icon
* @param	int		- size of the icon (only for Font Awesome)
* @param	array	- attributes for the icon
* @return	string - the markup for the icon
*/
function icon($name, $size = NULL, $attributes = array()) {
	$attr	= '';
	$class 	= 'icon-' . $name;
	if ($size != NULL) {
		$size = ' style="font-size: ' . $size . 'px"';
	}

	if (is_array($attributes) AND !empty($attributes)) {
		foreach ($attributes as $key => $attribute) {
			if ($key === 'class') {
				$class .= ' ' . $attribute;
			} else {
				$attr = $attr . $key . '="' . $attribute . '"';	
			}
		}
	}

	return '<i class="' . $class . '" ' . $attr . $size . '></i>';
}

/**
* Returns the img of a file extension.
*
* @param	string	- the filename or the extension (with prepended .)
* @param	int		- the size of the image
* @return	string	- the path to the icon
*/
function extension($filename, $size = '32') {
	$match	= array();
	$search = preg_match('/\.[^.]+$/', $filename, $match);

	if (empty($match)) {
		$ext = 'gen';
	} else {
		$ext = substr($match[0], 1);
	}

	$icon	= 'extensions/' . $size . '/file_extension_' . $ext . '.png';
	$path	= VIEWPATH . 'assets/img/' . $icon; 

	if (file_exists($path)) {
		return $icon;
	} else {
		$ext	= 'gen';
		$icon	= 'extensions/' . $size . '/file_extension_' . $ext . '.png';
		$path	= VIEWPATH . 'assets/img/' . $icon; 
		return $icon;
	}
}

/* End of file icon_helper.php */
/* Location: ./application/helpers/icon_helper.php */