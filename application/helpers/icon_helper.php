<?php

/**
* Inserts a Font Awesome icon.
*
* @param	string - the name of the icon
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