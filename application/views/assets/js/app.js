jQuery(document).ready(function() {

	// initialize alerts
	jQuery('.alert').alert();
	
	// submit login form when clicked
	jQuery('.submit').on('click', function(e) {
		e.preventDefault();
		jQuery(this).parents('form').submit();
	});

	// disable all broken links
	jQuery('a[href$=#]').on('click', function(e) {
		e.preventDefault();
	});
	
	// on admin
	if (jQuery('body').attr('data-uri') == 'admin/tickets/all') {
		search = jQuery('#search');
		search.on('change', function() {
			
			value = search.val();
			jQuery('#search-box select, #search-box input').each(function(){
				inputs = jQuery(this);

				if (inputs.attr('id') != 'search') {
					inputs.hide().attr('disabled', 'disabled').val('');
				}
			});

			switch (value) {
				case 'id':
				case 'subject':
					value = 'value';
				break;
			}

			jQuery('#' + value).show().removeAttr('disabled');
		});
	}
});