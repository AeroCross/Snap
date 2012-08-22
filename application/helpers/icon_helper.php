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

/* End of file icon.php */
/* Location: ./application/helpers/icon.php */