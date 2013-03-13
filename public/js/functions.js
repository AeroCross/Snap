jQuery(document).ready(function() {
	// enable alerts
	jQuery('.alert').alert();

	// disable dead links
	jQuery('a[href$="#"]').on('click', function(e) {
		e.preventDefault();
	});

	// start Select2 with an empty placeholder as a default
	jQuery('select').select2({placeholder: ''});
});