<?php
	// make sure the title is set for completion
	if(!isset($title)) {
		$title = NULL;	
	}
?>

<!-- toast notification -->
<script>
	
	jQuery(document).ready(function() {
		toastr.options = {
			positionClass: 'toast-top-right',
			fadeIn: 500,
			fadeOut: 200,
			timeOut: 5000,
		};

		toastr.<?php echo $type; ?>('<?php echo $message; ?>'<?php echo $title; ?>);
	});

</script>