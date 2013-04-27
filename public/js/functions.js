jQuery(document).ready(function() {
	// enable alerts
	jQuery('.alert').alert();

	// enable tootips
	jQuery('a[title], button[title]').tooltip({container: 'body'}); // issue #5687

	// disable dead links
	jQuery('a[href$="#"]').on('click', function(e) {
		e.preventDefault();
	});

	// start Select2 with an empty placeholder as a default
	jQuery('select').select2({placeholder: ''});

	// markdown editor
	if (typeof Markdown != 'undefined') {
		var converter	= Markdown.getSanitizingConverter();
		var editor		= new Markdown.Editor(converter);
		editor.run();
	}
});