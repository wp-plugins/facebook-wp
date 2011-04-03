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

				jQuery('#fbfull_like_layout').change(function() {
					jQuery('.fbfull_like_layout_item').hide();
					switch(jQuery('#fbfull_like_layout').val())
					{
						case 'standart':
							jQuery('#fbfull_like_layout_standart').show();
							jQuery('#wrap_fbfull_like_show_faces').show('500');
						break;
						case 'button_count':
							jQuery('#fbfull_like_layout_button_count').show();
							jQuery('#wrap_fbfull_like_show_faces').hide('500');
						break;
						case 'box_count':
							jQuery('#fbfull_like_layout_box_count').show();
							jQuery('#wrap_fbfull_like_show_faces').hide('500');
						break;
					}
						

				});
				
				

			});