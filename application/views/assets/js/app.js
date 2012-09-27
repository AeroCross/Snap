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

	if (jQuery('body').attr('data-controller') === '' || jQuery('body').attr('data-controller') == 'site') {
		jQuery('#more-info').modal({
			show: false
		});
	}

	// sortable tables
	jQuery('.sortable').tablesorter();
	jQuery('.sortable thead tr th').each(function() {
		var html = jQuery(this).html();
		jQuery(this).html(html + ' <i class="icon-sort pull-right"></i>');
	});
	
	// ---------------------------
	// admin/views/all -----------
	// ---------------------------
	if (jQuery('body').attr('data-uri') == 'login') {

		var center = function centerVertically() {
			var form	= jQuery('.login-form');
			var height	= jQuery(window).outerHeight();
	
			form.css({position: 'absolute', top: (height / 2) + 'px', marginTop: '-' + (form.outerHeight() / 2) + 'px'});
		};

		// set vertically on page load
		center();

		// vertical centering of login form
		jQuery(window).on('resize', function() {
			center();
		});
	}

	// ---------------------------
	// admin/views/all -----------
	// ---------------------------
	if (jQuery('body').attr('data-uri') == 'admin/tickets/all') {
		// show correct inputs when selecting what type of search
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

		// remove the session results when pressing "clear"
		jQuery('#clear').on('click', function() {
			jQuery(this).parents('form').append('<input type="hidden" name="clear" value="clear" />').submit();
		});
	}
});