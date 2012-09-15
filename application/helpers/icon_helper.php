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
function extension($filename, $size = '16') {
	$match	= array();
	$search = preg_match('/\.[\w]{2,4}$/', $filename, $match);
	$icon	= 'extensions/' . $size . '/file_extension_' . substr($match[0], 1) . '.png';
	$path	= VIEWPATH . 'assets/img/' . $icon; 

	if (file_exists($path)) {
		return $icon;
	} else {
		return NULL;
	}
}

/* End of file icon.php */
/* Location: ./application/helpers/icon.php */