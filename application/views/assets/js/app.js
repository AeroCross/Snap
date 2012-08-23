jQuery(document).ready(function() {

	// initialize alerts
	jQUery('.alert').alert();
	
	// submit login form when clicked
	jQuery('#login-submit').on('click', function() {
		jQuery(this).parent('form').submit();
	});
	
});