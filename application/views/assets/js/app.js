jQuery(document).ready(function() {

	// submit login form when clicked
	jQuery('#login-submit').on('click', function() {
		jQuery(this).parent('form').submit();
	});
	
});