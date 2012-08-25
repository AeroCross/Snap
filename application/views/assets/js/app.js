jQuery(document).ready(function() {

	// initialize alerts
	jQuery('.alert').alert();
	
	// submit login form when clicked
	jQuery('.submit').on('click', function(e) {
		e.preventDefault();
		jQuery(this).parents('form').submit();
	});
	
});