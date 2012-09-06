jQuery(document).ready(function() {

	// initialize alerts
	jQuery('.alert').alert();
	
	// submit login form when clicked
	jQuery('.submit').on('click', function(e) {
		e.preventDefault();
		jQuery(this).parents('form').submit();
	});
	
	// admin search form
	jQuery('#search').on('change', function() {
		// search fields
		search		= jQuery('#search');
		value		= search.val();
			
		// fields
		fieldDepartment = jQuery('#department');
		fieldStatus		= jQuery('#status');
		fieldValue		= jQuery('#value');

		switch(value) {
			case 'id':
			case 'subject':
				fieldDepartment.hide().val('');
				fieldStatus.hide().val('');
				fieldValue.show();
			break;

			case 'department':
				fieldValue.hide().children('input').val('');
				fieldStatus.hide().val('');
				fieldDepartment.show();
			break;

			case 'status':
				fieldValue.hide().children('input').val('');
				fieldDepartment.hide().val('');
				fieldStatus.show();
			break;
		}
	});

});