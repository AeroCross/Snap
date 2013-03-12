jQuery(document).ready(function() {
	// enable alerts
	jQuery('.alert').alert();

	// disable dead links
	jQuery('a[href$="#"]').on('click', function(e) {
		e.preventDefault();
	});

	jQuery('select').select2();
});