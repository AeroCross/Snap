jQuery(document).ready(function() {

	// initialize alerts
	jQuery('.alert').alert();
	
	// submit login form when clicked
	jQuery('.submit').on('click', function(e) {
		e.preventDefault();
		jQuery(this).parents('form').submit();
	});
	
	// admin search form
	search		= jQuery('#search');
	search.on('change', function() {
		// value field
		value		= search.val();

		// fields
		fieldDepartment = jQuery('#department');
		fieldStatus		= jQuery('#status');
		fieldValue		= jQuery('#value');

		switch(value) {
			case 'id':
			case 'subject':
				fieldDepartment
					.hide()
					.val('')
					.attr('disabled', 'disabled');

				fieldStatus
					.hide()
					.val('')
					.attr('disabled', 'disabled');

				fieldValue
					.show()
					.removeAttr('disabled');
			break;

			case 'department':
				fieldValue
					.hide()
					.val('')
					.attr('disabled', 'disabled');

				fieldStatus
					.hide()
					.val('')
					.attr('disabled', 'disabled');

				fieldDepartment
					.show()
					.removeAttr('disabled');
			break;

			case 'status':
				fieldValue
					.hide()
					.val('')
					.attr('disabled', 'disabled');

				fieldDepartment
					.hide()
					.val('')
					.attr('disabled', 'disabled');

				fieldStatus
					.show()
					.removeAttr('disabled');
			break;
		}
	});

});