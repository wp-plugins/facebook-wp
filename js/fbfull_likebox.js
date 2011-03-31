jQuery(document).ready(function() {
	jQuery('.fbfull_likebox_height_auto').click(function() {
		if(this.checked)
		{
			jQuery('.fbfull_wrap_likebox_height').hide('500');
		}
		else
		{
			jQuery('.fbfull_wrap_likebox_height').show('500');
		}
	});
	
});
