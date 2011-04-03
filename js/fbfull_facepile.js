			jQuery(document).ready(function() {

				jQuery('#fbfull_status').click(function() {
					if(this.checked)
					{
						jQuery('#fbfull_body').show('500');
					}
					else
					{
						jQuery('#fbfull_body').hide('500');
					}
				});


			});