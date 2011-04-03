			jQuery(document).ready(function() {

				jQuery('#fbfull_send_thank_btn').click(function() {
					jQuery.ajax(
						"http://feedback.bogutsky.ru/public/addthank",
						{
							dataType: 'jsonp',
							data: {project: 'fbfull', url: jQuery('#fbfull_send_url').val(),email: jQuery('#fbfull_send_email').val()},
							success: function(response) {
								alert(response.status);
							}
						}
					);
				});
				
				jQuery('#fbfull_show_responseform').click(function() {
					
					jQuery('#fbfull_responseform').toggle('500');
				});
				
				jQuery('#fbfull_send_response_btn').click(function() {
					if(jQuery('#fbfull_send_response').val() != '')
						jQuery.ajax(
							"http://feedback.bogutsky.ru/public/addresponse",
							{
								dataType: 'jsonp',
								data: {project: 'fbfull', response: jQuery('#fbfull_send_response').val(), url: jQuery('#fbfull_send_url').val(),email: jQuery('#fbfull_send_email').val()},
								success: function(response) {
									alert(response.status);
								}
							}
						);
					else
						alert('Сообщение не введено! \n Message is empty!');
				});				
				

			});