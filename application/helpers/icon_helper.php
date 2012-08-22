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
function icon($name, $size = 24, $attributes = array()) {
	$attr	= '';
	$class 	= 'icon icon-' . $name;

	if (is_array($attributes) AND !empty($attributes)) {
		foreach ($attributes as $key => $attribute) {
			if ($key === 'class') {
				$class .= ' ' . $attribute;
			} else {
				$attr = $attr . $key . '="' . $attribute . '"';	
			}
		}
	}

	return '<i class="' . $class . '" ' . $attr . ' style="font-size: ' . $size . 'px"></i>';
}

/* End of file icon.php */
/* Location: ./application/helpers/icon.php */