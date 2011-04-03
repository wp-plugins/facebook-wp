jQuery(document).ready(function($) {

	$('#fbfull_post_action').click(function() {
		var data = {
			action: 'change_visible_comments',
			page_id: $(this).attr('page_id'),
			show: $(this).attr('show')
		};
		$.post('/wp-admin/admin-ajax.php', data, function(response) {
			response = response.substr(0,response.length-1);
			response = $.parseJSON(response);
			$('#fbfull_post_action').html(response.img);
			if(response.show=='1')
				$('#fbfull_post_action').attr('show','0');
			else
				$('#fbfull_post_action').attr('show','1');

		});
		
	});
});