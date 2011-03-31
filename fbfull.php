<?php
/*
Plugin Name: Facebook WP
Plugin URI: http://bogutsky.ru/?page_id=112
Description: The plugin includes all possibilities of a social network Facebook. Плагин включает в себя все возможности социальной сети Facebook.
Author: Bogutsky Yaroslav
Version: 1.0
Author URI: http://bogutsky.ru
*/
/*  Copyright 2011  Bogutsky Yaroslav  (email: admin@bogutsky.ru)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

function fbfull_feedback()
{

	$feedback = "
	<div>
	". __('Like this plugin?','fbfull') ." ". __('Press','fbfull') ." <button id=\"fbfull_send_thank_btn\" class=\"button\">". __('Send thank','fbfull') ."</button> ". __('or','fbfull') ." <button id=\"fbfull_show_responseform\" class='button'>". __('Send message to author','fbfull') ."</button>
	<div id=\"fbfull_responseform\" style=\"display:none;\">
	<input type=\"hidden\" id=\"fbfull_send_project\" value=\"fbfull\">
	<input type=\"hidden\" id=\"fbfull_send_url\" value=\"". get_bloginfo('siteurl') ."\">
	<input type=\"hidden\" id=\"fbfull_send_email\" value=\"". get_bloginfo('admin_email')."\">
	<textarea id=\"fbfull_send_response\" cols=\"100\"></textarea><br>
	<input id=\"fbfull_send_response_btn\" class=\"button\" type=\"button\"  value=\"". __('Send message','fbfull') ."\">
	</div>
	</div>
	";
	return $feedback;
}


add_action('init', 'fbfull_textdomain');
function fbfull_textdomain() {
	load_plugin_textdomain('fbfull', false, dirname( plugin_basename( __FILE__ ) ).'/lang/');
}

if( is_admin() )
{

	/* Административная часть */
	function fbfull_admin_add_js_css()
	{
		wp_enqueue_style('fbfull-colorpicker', get_bloginfo('siteurl'). "/wp-content/plugins/" . dirname(plugin_basename( __FILE__ )) . "/css/colorpicker.css");
		wp_enqueue_style('fbfull-css', get_bloginfo('siteurl'). "/wp-content/plugins/" . dirname(plugin_basename( __FILE__ )) . "/css/fbfull.css");
	}

	function fbfull_admin_main_add_js_css()
	{
		wp_deregister_script( 'jquery' );
		wp_register_script( 'jquery', get_bloginfo('siteurl'). "/wp-content/plugins/" . dirname(plugin_basename( __FILE__ )) . "/js/jquery-1.5.1.js", false,"1.5.1" );
		wp_enqueue_script('fbfull-main', get_bloginfo('siteurl'). "/wp-content/plugins/" . dirname(plugin_basename( __FILE__ )) . "/js/fbfull_main.js", array('jquery'));

	}
	function fbfull_admin_comments_add_js_css()
	{
		wp_deregister_script( 'jquery' );
		wp_register_script( 'jquery', get_bloginfo('siteurl'). "/wp-content/plugins/" . dirname(plugin_basename( __FILE__ )) . "/js/jquery-1.5.1.js", false,"1.5.1" );
		wp_enqueue_script('fbfull-comments', get_bloginfo('siteurl'). "/wp-content/plugins/" . dirname(plugin_basename( __FILE__ )) . "/js/fbfull_comments.js", array('jquery'));
		
	}
	function fbfull_admin_like_add_js_css()
	{
		wp_deregister_script( 'jquery' );
		wp_register_script( 'jquery', get_bloginfo('siteurl'). "/wp-content/plugins/" . dirname(plugin_basename( __FILE__ )) . "/js/jquery-1.5.1.js", false,"1.5.1" );
		wp_enqueue_script('fbfull-like', get_bloginfo('siteurl'). "/wp-content/plugins/" . dirname(plugin_basename( __FILE__ )) . "/js/fbfull_like.js", array('jquery'));
	}
	function fbfull_admin_facepile_add_js_css()
	{
		wp_deregister_script( 'jquery' );
		wp_register_script( 'jquery', get_bloginfo('siteurl'). "/wp-content/plugins/" . dirname(plugin_basename( __FILE__ )) . "/js/jquery-1.5.1.js", false,"1.5.1" );
		wp_enqueue_script('fbfull-facepile', get_bloginfo('siteurl'). "/wp-content/plugins/" . dirname(plugin_basename( __FILE__ )) . "/js/fbfull_facepile.js", array('jquery'));
	}
	function fbfull_admin_help_add_js_css()
	{
		wp_deregister_script( 'jquery' );
		wp_register_script( 'jquery', get_bloginfo('siteurl'). "/wp-content/plugins/" . dirname(plugin_basename( __FILE__ )) . "/js/jquery-1.5.1.js", false,"1.5.1" );
		wp_enqueue_script('fbfull-help', get_bloginfo('siteurl'). "/wp-content/plugins/" . dirname(plugin_basename( __FILE__ )) . "/js/fbfull_help.js", array('jquery'));
	}



	add_action('admin_menu', 'fbfull_admin_menu');
	function fbfull_admin_menu(){
		$mainpage = add_menu_page('Facebook', 'Facebook', 10, __FILE__, 'fbfull_main' );
		add_submenu_page(__FILE__, 'Facebook', '', 10, __FILE__);
		$commentspage = add_submenu_page(__FILE__, __('Facebook | Comments','fbfull'), __('Comments','fbfull'), 10, 'fbfull_comments', 'fbfull_comments' );
		$likepage = add_submenu_page(__FILE__, __('Facebook | Like','fbfull'), __('Like','fbfull'), 10, 'fbfull_like', 'fbfull_like' );
		$facepilepage = add_submenu_page(__FILE__, __('Facebook | Facepile','fbfull'), __('Facepile','fbfull'), 10, 'fbfull_facepile', 'fbfull_facepile' );
		$helppage = add_submenu_page(__FILE__, __('Facebook | Help','fbfull'), __('Help','fbfull'), 10, 'fbfull_help', 'fbfull_help' );

        add_action( 'admin_init', 'fbfull_admin_add_js_css' );
        add_action('admin_print_scripts-' . $mainpage, 'fbfull_admin_main_add_js_css');
        add_action('admin_print_scripts-' . $commentspage, 'fbfull_admin_comments_add_js_css');
        add_action('admin_print_scripts-' . $likepage, 'fbfull_admin_like_add_js_css');
        add_action('admin_print_scripts-' . $facepilepage, 'fbfull_admin_facepile_add_js_css');
		add_action('admin_print_scripts-' . $helppage, 'fbfull_admin_help_add_js_css');
		
		add_action( 'admin_init', 'fbfull_register_options' );
	}
    
    
    
	function fbfull_register_options(){
		register_setting( 'fbfull_options_general_group', 'fbfull_apiid' );
		register_setting( 'fbfull_options_comments_group', 'fbfull_comments_status' );
			register_setting( 'fbfull_options_comments_group', 'fbfull_comments_numposts' );
			register_setting( 'fbfull_options_comments_group', 'fbfull_comments_width' );
			register_setting( 'fbfull_options_comments_group', 'fbfull_comments_title' );
			register_setting( 'fbfull_options_comments_group', 'fbfull_comments_simple' );
			register_setting( 'fbfull_options_comments_group', 'fbfull_comments_publish_feed' );
			register_setting( 'fbfull_options_comments_group', 'fbfull_comments_reverse' );
			register_setting( 'fbfull_options_comments_group', 'fbfull_comments_in_posts' );
			register_setting( 'fbfull_options_comments_group', 'fbfull_comments_off_wp_in_posts' );
			register_setting( 'fbfull_options_comments_group', 'fbfull_comments_in_pages' );
			register_setting( 'fbfull_options_comments_group', 'fbfull_comments_off_wp_in_pages' );

			
		register_setting( 'fbfull_options_like_group', 'fbfull_like_status' );
			register_setting( 'fbfull_options_like_group', 'fbfull_like_layout' );
			register_setting( 'fbfull_options_like_group', 'fbfull_like_show_faces' );
			register_setting( 'fbfull_options_like_group', 'fbfull_like_width' );
			register_setting( 'fbfull_options_like_group', 'fbfull_like_action' );
			register_setting( 'fbfull_options_like_group', 'fbfull_like_font' );
			register_setting( 'fbfull_options_like_group', 'fbfull_like_colorscheme' );
			register_setting( 'fbfull_options_like_group', 'fbfull_like_in_posts' );
			register_setting( 'fbfull_options_like_group', 'fbfull_like_in_pages' );
			register_setting( 'fbfull_options_like_group', 'fbfull_like_position' );

		register_setting( 'fbfull_options_facepile_group', 'fbfull_facepile_status' );
			register_setting( 'fbfull_options_facepile_group', 'fbfull_facepile_max_rows' );
			register_setting( 'fbfull_options_facepile_group', 'fbfull_facepile_width' );
			register_setting( 'fbfull_options_facepile_group', 'fbfull_facepile_in_posts' );
			register_setting( 'fbfull_options_facepile_group', 'fbfull_facepile_in_pages' );
			register_setting( 'fbfull_options_facepile_group', 'fbfull_facepile_position' );
	}

	function fbfull_main(){

	?>
		<div class="wrap">
        <h2><?php _e('Main page Facebook WP','fbfull'); ?></h2>
        <?php settings_errors(); ?>
		<form method="post" action="options.php">
        	<?php settings_fields( 'fbfull_options_general_group' ); ?>
			<?php _e('Enter your Facebook appId','fbfull'); ?>:<br>
			<input type="text" name="fbfull_apiid" size="30" maxlength="30" value="<?php if($apiid = get_option('fbfull_apiid')) if(is_numeric($apiid)) echo $apiid; ?>"><br>
            <input class="button" type="submit" name="fbfull_save" value="<?php _e('Save options','fbfull'); ?>">
		</form>
        
        </div>
        <?php _e('<a href="http://www.facebook.com/developers/" target="_blank">More information</a> about your applications.','fbfull'); ?>
        <?php echo fbfull_feedback(); ?>
	<?php
	}


	
	function fbfull_comments(){
		
	?>
		<div class="wrap">
        <h2><?php _e('Settings Facebook Comments','fbfull'); ?></h2>
        <?php settings_errors(); ?>
		<form method="post" action="options.php">
        	<?php settings_fields( 'fbfull_options_comments_group' ); ?>
            <input type="checkbox" id="fbfull_status" name="fbfull_comments_status" value="1"<?php if(get_option('fbfull_comments_status'))  echo " checked=\"checked\""; ?>> <?php _e('Use Facebook comments','fbfull'); ?><br>
            <div id="fbfull_body" style="<?php if(!get_option('fbfull_comments_status')) echo "display: none;";?>">
			<?php _e('Select limit comments','fbfull'); ?>:<br>
			<select name="fbfull_comments_numposts">
				<option value="5"<?php if(get_option('fbfull_comments_numposts') == 5) echo " selected=\"selected\""; ?>>5</option>
                <option value="10"<?php if(get_option('fbfull_comments_numposts') == 10) echo " selected=\"selected\""; ?>>10</option>
                <option value="15"<?php if(get_option('fbfull_comments_numposts') == 15) echo " selected=\"selected\""; ?>>15</option>
                <option value="20"<?php if(get_option('fbfull_comments_numposts') == 20) echo " selected=\"selected\""; ?>>20</option>
			</select><br>
            <?php _e('Width comment form','fbfull'); ?>:<br>
            <input type="text" name="fbfull_comments_width" size="10" maxlength="20" value="<?php if((get_option('fbfull_comments_width'))&&(is_numeric(get_option('fbfull_comments_width')))) echo get_option('fbfull_comments_width'); else echo "400"; ?>"><br>
            <?php _e('Title of the Feed story that gets published when a comment is made (default value is the title of the Web page containing the Comments Box)','fbfull'); ?>:<br>
            <input type="text" name="fbfull_comments_title" size="50" maxlength="50" value="<?php if(get_option('fbfull_comments_title')) echo get_option('fbfull_comments_title'); ?>"><br>
			<input type="checkbox" name="fbfull_comments_publish_feed" value="1"<?php if(get_option('fbfull_comments_publish_feed'))  echo " checked=\"checked\""; ?>> <?php _e('Indicates whether the Post comment to my Facebook profile check box is checked','fbfull'); ?><br>
            <input type="checkbox" name="fbfull_comments_simple" value="1"<?php if(get_option('fbfull_comments_simple'))  echo " checked=\"checked\""; ?>> <?php _e('Rounded box does not appear around each post on your site','fbfull'); ?><br>
            <input type="checkbox" name="fbfull_comments_reverse" value="1"<?php if(get_option('fbfull_comments_reverse'))  echo " checked=\"checked\""; ?>> <?php _e('Reverses order of comments so the most recent one appears at the bottom of the list and the composer appears at the bottom of the page','fbfull'); ?><br>
            <input type="checkbox" name="fbfull_comments_in_posts" value="1"<?php if(get_option('fbfull_comments_in_posts'))  echo " checked=\"checked\""; ?>> <?php _e('Show Facebook comment form in posts','fbfull'); ?><br>
            <input type="checkbox" name="fbfull_comments_off_wp_in_posts" value="1"<?php if(get_option('fbfull_comments_off_wp_in_posts'))  echo " checked=\"checked\""; ?>> <?php _e('Hide wordpress comment form in posts','fbfull'); ?><br>
            <input type="checkbox" name="fbfull_comments_in_pages" value="1"<?php if(get_option('fbfull_comments_in_pages'))  echo " checked=\"checked\""; ?>> <?php _e('Show Facebook comment form in pages','fbfull'); ?><br>
            <input type="checkbox" name="fbfull_comments_off_wp_in_pages" value="1"<?php if(get_option('fbfull_comments_off_wp_in_pages'))  echo " checked=\"checked\""; ?>> <?php _e('Hide wordpress comment form in pages','fbfull'); ?><br>
			<br>
            </div>
	        <input class="button" type="submit" name="fbfull_save" value="<?php _e('Save options','fbfull'); ?>">
            
        </form>

        </div>
        <?php echo fbfull_feedback(); ?>
	<?php
	}

	function fbfull_like(){
	?>
		<div class="wrap">
        <h2><?php _e('Settings Facebook Like','fbfull'); ?></h2>
        <?php settings_errors(); ?>
		<form method="post" action="options.php">
        	
        	<?php settings_fields( 'fbfull_options_like_group' ); ?>
            <input type="checkbox" id="fbfull_status" name="fbfull_like_status" value="1"<?php if(get_option('fbfull_like_status'))  echo " checked=\"checked\""; ?>> <?php _e('Use Facebook like button','fbfull'); ?><br>
            <div id="fbfull_body"<?php if(!get_option('fbfull_like_status')) echo " class=\"fbhide\"";?>>
            <b><?php _e('Attention, if you have included comments the like button is included automatically','fbfull'); ?></b><br>
			<?php _e('Layout style','fbfull'); ?>:<br>
			<select id="fbfull_like_layout" name="fbfull_like_layout">
				<option value="standart"<?php if(get_option('fbfull_like_layout') == 'standart') echo " selected=\"selected\""; ?>>standart</option>
                <option value="button_count"<?php if(get_option('fbfull_like_layout') == 'button_count') echo " selected=\"selected\""; ?>>button_count</option>
                <option value="box_count"<?php if(get_option('fbfull_like_layout') == 'box_count') echo " selected=\"selected\""; ?>>box_count</option>
			</select>
            <span id="fbfull_like_layout_standart" class="fbfull_like_layout_item<?php if(get_option('fbfull_like_layout') != 'standart') echo " fbhide";?>">displays social text to the right of the button and friends' profile photos below. Minimum width: 225 pixels. Default width: 450 pixels. Height: 35 pixels (without photos) or 80 pixels (with photos).</span>
            <span id="fbfull_like_layout_button_count" class="fbfull_like_layout_item<?php if(get_option('fbfull_like_layout') != 'button_count') echo " fbhide";?>">displays the total number of likes to the right of the button. Minimum width: 90 pixels. Default width: 90 pixels. Height: 20 pixels.</span>
            <span id="fbfull_like_layout_box_count" class="fbfull_like_layout_item<?php if(get_option('fbfull_like_layout') != 'box_count') echo " fbhide";?>">displays the total number of likes above the button. Minimum width: 55 pixels. Default width: 55 pixels. Height: 65 pixels</span><br>
            <div id="wrap_fbfull_like_show_faces"<?php if(get_option('fbfull_like_layout') != 'standart') echo " class=\"fbhide\""; ?>><input type="checkbox" name="fbfull_like_show_faces" value="1"<?php if(get_option('fbfull_like_show_faces'))  echo " checked=\"checked\""; ?>> <?php _e('Show faces','fbfull'); ?></div>
            <?php _e('Width','fbfull'); ?>:<br>
            <input type="text" name="fbfull_like_width" size="10" maxlength="20" value="<?php if((get_option('fbfull_like_width'))&&(is_numeric(get_option('fbfull_like_width')))) echo get_option('fbfull_like_width'); else echo "350"; ?>"><br>
            <?php _e('Verb to display','fbfull'); ?>:<br>
			<select name="fbfull_like_action">
				<option value="like"<?php if(get_option('fbfull_like_action') == 'like') echo " selected=\"selected\""; ?>>like</option>
                <option value="recommend"<?php if(get_option('fbfull_like_action') == 'recommend') echo " selected=\"selected\""; ?>>recommend</option>
			</select><br>
            <?php _e('Font','fbfull'); ?>:<br>
			<select name="fbfull_like_font">
				<option value="arial"<?php if(get_option('fbfull_like_font') == 'arial') echo " selected=\"selected\""; ?>>arial</option>
                <option value="lucida grande"<?php if(get_option('fbfull_like_font') == 'lucida grande') echo " selected=\"selected\""; ?>>lucida grande</option>
				<option value="segoe ui"<?php if(get_option('fbfull_like_font') == 'segoe ui') echo " selected=\"selected\""; ?>>segoe ui</option>
                <option value="tahoma"<?php if(get_option('fbfull_like_font') == 'tahoma') echo " selected=\"selected\""; ?>>tahoma</option>
				<option value="trebuchet ms"<?php if(get_option('fbfull_like_font') == 'trebuchet ms') echo " selected=\"selected\""; ?>>trebuchet ms</option>
                <option value="verdana"<?php if(get_option('fbfull_like_font') == 'verdana') echo " selected=\"selected\""; ?>>verdana</option>
			</select><br>
            <?php _e('Color scheme','fbfull'); ?>:<br>
			<select name="fbfull_like_colorscheme">
				<option value="light"<?php if(get_option('fbfull_like_colorscheme') == 'light') echo " selected=\"selected\""; ?>><?php _e('light','fbfull'); ?></option>
                <option value="dark"<?php if(get_option('fbfull_like_colorscheme') == 'dark') echo " selected=\"selected\""; ?>><?php _e('dark','fbfull'); ?></option>
			</select><br>

            <?php _e('Select button position','fbfull'); ?>:<br>
			<select name="fbfull_like_position">
				<option value="top"<?php if(get_option('fbfull_like_position') == 'top') echo " selected=\"selected\""; ?>><?php _e('top','fbfull'); ?></option>
                <option value="bottom"<?php if(get_option('fbfull_like_position') == 'bottom') echo " selected=\"selected\""; ?>><?php _e('bottom','fbfull'); ?></option>
			</select><br>
            <input type="checkbox" name="fbfull_like_in_posts" value="1"<?php if(get_option('fbfull_like_in_posts'))  echo " checked=\"checked\""; ?>> <?php _e('Show like button in posts','fbfull'); ?><br>
            <input type="checkbox" name="fbfull_like_in_pages" value="1"<?php if(get_option('fbfull_like_in_pages'))  echo " checked=\"checked\""; ?>> <?php _e('Show like button in pages','fbfull'); ?><br>
			<br>
            </div>
	       <input class="button" type="submit" name="fbfull_save" value="<?php _e('Save options','fbfull'); ?>">
        </form>
        </div>
        <?php echo fbfull_feedback(); ?>
	<?php
	}

	function fbfull_facepile(){
	?>
		<div class="wrap">
        <h2><?php _e('Settings Facebook Facepile','fbfull'); ?></h2>
        <?php settings_errors(); ?>
		<form method="post" action="options.php">
        	<?php settings_fields( 'fbfull_options_facepile_group' ); ?>
            <input type="checkbox" id="fbfull_status" name="fbfull_facepile_status" value="1"<?php if(get_option('fbfull_facepile_status'))  echo " checked=\"checked\""; ?>> <?php _e('Use Facepile','fbfull'); ?><br>
            <div id="fbfull_body"<?php if(!get_option('fbfull_facepile_status')) echo "class=\"fbhide\"";?>>
	            <?php _e('Width in pixels (default width: 200px)','fbfull'); ?>:<br>
    	        <input type="text" name="fbfull_facepile_width" size="10" maxlength="20" value="<?php if((get_option('fbfull_facepile_width'))&&(is_numeric(get_option('fbfull_facepile_width')))) echo get_option('fbfull_facepile_width'); else echo "200"; ?>"><br>
	            <?php _e('The maximum number of rows of faces to display','fbfull'); ?>:<br>
    	        <input type="text" name="fbfull_facepile_max_rows" size="10" maxlength="20" value="<?php if((get_option('fbfull_facepile_max_rows'))&&(is_numeric(get_option('fbfull_facepile_max_rows')))) echo get_option('fbfull_facepile_max_rows'); else echo "1"; ?>"><br>
                <?php _e('Select facepile position','fbfull'); ?>:<br>
				<select name="fbfull_facepile_position">
					<option value="top"<?php if(get_option('fbfull_facepile_position') == 'top') echo " selected=\"selected\""; ?>><?php _e('top','fbfull'); ?></option>
	                <option value="bottom"<?php if(get_option('fbfull_facepile_position') == 'bottom') echo " selected=\"selected\""; ?>><?php _e('bottom','fbfull'); ?></option>
				</select><br>
	            <input type="checkbox" name="fbfull_facepile_in_posts" value="1"<?php if(get_option('fbfull_facepile_in_posts'))  echo " checked=\"checked\""; ?>> <?php _e('Show facepile button in posts','fbfull'); ?><br>
	            <input type="checkbox" name="fbfull_facepile_in_pages" value="1"<?php if(get_option('fbfull_facepile_in_pages'))  echo " checked=\"checked\""; ?>> <?php _e('Show facepile button in pages','fbfull'); ?><br>
				
            </div>
            <input class="button" type="submit" name="fbfull_save" value="<?php _e('Save options','fbfull'); ?>">
        </form>
        </div>
        <?php echo fbfull_feedback(); ?>
	<?php
	}



	function fbfull_help(){

	?>
		<div class="wrap">
        <h2><?php _e('Help Facebook WP','fbfull'); ?></h2>
        <?php _e('<b>Facebook Comments</b><br>Comments Box is a social plugin that enables user commenting on your site. <a target="_blank" href="http://developers.facebook.com/docs/reference/plugins/comments/">More information</a>.','fbfull'); ?><br>
        <?php _e('<b>Facebook Like Button</b><br>The Like button lets users share pages from your site back to their Facebook profile with one click. <a target="_blank" href="http://developers.facebook.com/docs/reference/plugins/like/">More information</a>.','fbfull'); ?><br>
        <?php _e('<b>Facebook Facepile</b><br>The Facepile plugin displays the Facebook profile pictures of users who have liked your page or have signed up for your site. <a target="_blank" href="http://developers.facebook.com/docs/reference/plugins/facepile/">More information</a>.','fbfull'); ?><br>
        <?php _e('<b>Facebook Activity Feed</b><br>The Activity Feed plugin shows users what their friends are doing on your site through likes and comments. <a target="_blank" href="http://developers.facebook.com/docs/reference/plugins/activity/">More information</a>.','fbfull'); ?><br>
        <?php _e('<b>Facebook Recommendations</b><br>The Recommendations plugin gives users personalized suggestions for pages on your site they might like. <a target="_blank" href="http://developers.facebook.com/docs/reference/plugins/recommendations/">More information</a>.','fbfull'); ?><br>
        <?php _e('<b>Facebook Like Box</b><br>The Like Box enables users to like your Facebook Page and view its stream directly from your website. <a target="_blank" href="http://developers.facebook.com/docs/reference/plugins/like-box/">More information</a>.','fbfull'); ?><br>
        <?php _e('<b>Facebook Live Stream</b><br>The Live Stream plugin lets your users share activity and comments in real-time as they interact during a live event. If you want include Live Stream in post or page you need include string "[fbls xid=\'yourxid\' width=\'yourwidth\' height=\'yourheight\' via_url=\'yourvia_url\']". All parameters optional, but we recommended use parameter xid. <a target="_blank" href="http://developers.facebook.com/docs/reference/plugins/live-stream/">More information</a>.','fbfull'); ?><br>
        <?php _e('<b>Facebook Login Button</b><br>The Login Button shows profile pictures of the user\'s friends who have already signed up for your site in addition to a login button. <a target="_blank" href="http://developers.facebook.com/docs/reference/plugins/login/">More information</a>.','fbfull'); ?><br><br>
        <?php _e('<b>Attention</b>, that widgets correctly worked, right after moved it in sidebar you need click button "Save".','fbfull'); ?>
        </div>
        <?php echo fbfull_feedback(); ?>
	<?php
	}
	
	function fbfull_delete_options($args)
	{
		$num = count($args);
		if ($num == 1) {
			delete_option($args[0]);
		}
		elseif (count($args) > 1)
		{
			foreach ($args as $option) {
				delete_option($option);
			}
		}
	}

	function fbfull_deactivation () {
		$options = array(
		'fbfull_comments_status',
		'fbfull_comments_numposts',
		'fbfull_comments_width',
		'fbfull_comments_title',
		'fbfull_comments_simple',
		'fbfull_comments_publish_feed',
		'fbfull_comments_reverse',
		'fbfull_comments_in_posts',
		'fbfull_comments_off_wp_in_posts',
		'fbfull_comments_in_pages',
		'fbfull_comments_off_wp_in_pages',
			
		'fbfull_like_status',
		'fbfull_like_layout',
		'fbfull_like_show_faces',
		'fbfull_like_width',
		'fbfull_like_action',
		'fbfull_like_font',
		'fbfull_like_colorscheme',
		'fbfull_like_in_posts',
		'fbfull_like_in_pages',
		'fbfull_like_position',

		'fbfull_facepile_status',
		'fbfull_facepile_max_rows',
		'fbfull_facepile_width',
		'fbfull_facepile_in_posts',
		'fbfull_facepile_in_pages',
		'fbfull_facepile_position'
		);
		fbfull_delete_options($options);
	}
	register_deactivation_hook(__FILE__,'fbfull_deactivation');

	function fbfull_add_options($args)
	{
		foreach ($args as $name => $value) {
			add_option($name,$value,'','no');
		}
	}
	
	function fbfull_activation () {
		$options = array(
		'fbfull_comments_status' => '1',
		'fbfull_comments_numposts' => '5',
		'fbfull_comments_width' => '400',
		'fbfull_comments_title' => '',
		'fbfull_comments_simple' => '',
		'fbfull_comments_publish_feed' => '1',
		'fbfull_comments_reverse' => '',
		'fbfull_comments_in_posts' => '1',
		'fbfull_comments_off_wp_in_posts' => '',
		'fbfull_comments_in_pages' => '1',
		'fbfull_comments_off_wp_in_pages' => '',
			
		'fbfull_like_status' => '0',
		'fbfull_like_layout' => 'standart',
		'fbfull_like_show_faces' => '1',
		'fbfull_like_width' => '350',
		'fbfull_like_action' => 'like',
		'fbfull_like_font' => 'arial',
		'fbfull_like_colorscheme' => 'light',
		'fbfull_like_in_posts' => '1',
		'fbfull_like_in_pages' => '1',
		'fbfull_like_position' => 'top',

		'fbfull_facepile_status' => '0',
		'fbfull_facepile_max_rows' => '1',
		'fbfull_facepile_width' => '200',
		'fbfull_facepile_in_posts' => '1',
		'fbfull_facepile_in_pages' => '1',
		'fbfull_facepile_position' => 'bottom'
		);
		fbfull_add_options($options);
		
	}
	register_activation_hook(__FILE__,'fbfull_activation');


}
else
{
	/* Публичная часть */

	function fbfull_comments_get_form($post)
	{
	
		if((get_option('fbfull_comments_width')) && (is_numeric(get_option('fbfull_comments_width'))) && (get_option('fbfull_comments_width') > 0))
		
			$width = get_option('fbfull_comments_width');
		else
			$width = 400;
		if((get_option('fbfull_comments_numposts')) && (is_numeric(get_option('fbfull_comments_numposts'))))
			$numposts = get_option('fbfull_comments_numposts');
		else
			$numposts = 5;
		if(get_option('fbfull_comments_publish_feed'))
			$publish_feed = '1';
		else
			$publish_feed = '0';
		if(get_option('fbfull_comments_title'))
			$title = get_option('fbfull_comments_title');
		else
			$title = NULL;
		if(get_option('fbfull_comments_simple'))
			$simple = '1';
		else
			$simple = '0';
		if(get_option('fbfull_comments_reverse'))
			$reverse = '1';
		else
			$reverse = '0';
		
		
		$form = "<div>
			<fb:comments
				xid='".$post->ID."'
				url='".$post->guid."'
				numposts='".$numposts."' 
				width='".$width."'
				publish_feed='".$publish_feed."'
				title='".$title."'
				simple='".$simple."'
				reverse='".$reverse."'
			></fb:comments>
			</div>
		";
	return $form;
	}



	function fbfull_comments_add($content) {
		$fbform = NULL;
		if(get_option('fbfull_comments_status'))
		{

			global $post;
			if(get_option('fbfull_comments_in_posts'))
				if(is_single())
				{
					if($post->comment_status != 'closed')
					{
						$fbform = fbfull_comments_get_form($post);
					}
				}
			if(get_option('fbfull_comments_off_wp_in_posts'))
				$post->comment_status = "closed";

			if(get_option('fbfull_comments_in_pages'))
				if(get_post_type() == 'page')
				{
					if($post->comment_status != 'closed')
					{
						$fbform = fbfull_comments_get_form($post);
					}
				}
			if(get_option('fbfull_comments_off_wp_in_pages'))
				$post->comment_status = "closed";

		}
		$content .=	$fbform;
		return $content;
	}

	function fbfull_like_get_button($post)
	{
		if(get_option('fbfull_like_show_faces'))
			$show_faces = "true";
		else
			$show_faces = "false";
			
		if(get_option('fbfull_like_width'))
			if(is_numeric(get_option('fbfull_like_width')))
				if(get_option('fbfull_like_width'))
					$width = get_option('fbfull_like_width');
				else $width = 450;
			else $width = 450;
		else $width = 450;
		$return =  "
		<div>
		<fb:like 
		href=\"".$post->guid."\" 
		layout=\"".get_option('fbfull_like_layout')."\" 
		show_faces=\"".$show_faces."\" 
		width=\"".$width."\" 
		action=\"".get_option('fbfull_like_action')."\" 
		font=\"".get_option('fbfull_like_font')."\" 
		colorscheme=\"".get_option('fbfull_like_colorscheme')."\">
		</fb:like>
		</div>
		";
		return $return;
	}


	function fbfull_facepile_get($post)
	{
		if(get_option('fbfull_facepile_width'))
			if(is_numeric(get_option('fbfull_facepile_width')))
				if(get_option('fbfull_facepile_width') > 0)
					$width = get_option('fbfull_facepile_width');
				else
					$width = 200;
			else
				$width = 200;
		else
			$width = 200;


		if(get_option('fbfull_facepile_max_rows'))
			if(is_numeric(get_option('fbfull_facepile_max_rows')))
				if(get_option('fbfull_facepile_max_rows') > 0)
					$max_rows = get_option('fbfull_facepile_max_rows');
				else
					$max_rows = 1;
			else
				$max_rows = 1;
		else
			$max_rows = 1;

		$return =  "<div>
		<fb:facepile href=\"".$post->guid."\" width=\"".$width."\" max_rows=\"".$max_rows."\"></fb:facepile>
		</div>
		";
		return $return;
	}


	function fbfull_like_facepile_add($content)
	{
		global $post;
		$facepile = NULL;
		$like = NULL;
		
		if(get_option('fbfull_like_status'))
		{	
			if(get_option('fbfull_like_in_posts'))
				if(is_single())
				{
					$like = fbfull_like_get_button($post);
				}
			if(get_option('fbfull_like_in_pages'))
				if(get_post_type() == 'page')
				{
					$like = fbfull_like_get_button($post);
				}
		}
		
		if(get_option('fbfull_facepile_status'))
		{
			if(get_option('fbfull_facepile_in_posts'))
				if(is_single())
				{
					$facepile = fbfull_facepile_get($post);
				}
			if(get_option('fbfull_facepile_in_pages'))
				if(get_post_type() == 'page')
				{
					$facepile = fbfull_facepile_get($post);
				}
		}

		$top = NULL;
		$bottom = NULL;
		if(get_option('fbfull_like_position') == 'top')
			$top .= $like;
		if(get_option('fbfull_facepile_position') == 'top')
			$top .= $facepile;
		if(get_option('fbfull_like_position') == 'bottom')
			$bottom .= $like;
		if(get_option('fbfull_facepile_position') == 'bottom')
			$bottom .= $facepile;
		
		$content =	$top.$content;
		$content .=	$bottom;
		
		return $content;
	}
	function fbfull_livestream_get_param($form,$param) {
		$b = strpos($form,$param);
		if($b)
		{
			$b = $b+strlen($param)+2;
			$e = strpos($form,"'",$b);
			$c = $e - $b;
			return substr($form,$b,$c);
		}
		else
			return NULL;
	}
	function fbfull_livestream_add($content) {
		$b = strpos($content,"[fbls");
		if(!$b)
			return $content;
		$e = strpos($content,"]",$b);
		$c = $e - $b + 1;
		$form = substr($content,$b,$c);
		$xid = fbfull_livestream_get_param($form,'xid');
		$width = fbfull_livestream_get_param($form,'width');
		$height = fbfull_livestream_get_param($form,'height');
		$via_url = fbfull_livestream_get_param($form,'via_url');
		$allow_post_to_friends = fbfull_livestream_get_param($form,'allow_post_to_friends');
		
		$width = (int) $width;
		if(($width)&&(is_numeric($width))&&($width>0))
		{}
		else
			$width = 300;

		$height = (int) $height;
		if(($height)&&(is_numeric($height))&&($height>0))
		{}
		else
			$height = 300;

		if($allow_post_to_friends)
		{
			if(($allow_post_to_friends = '0')||($allow_post_to_friends = '1'))
			{}
			else
				$allow_post_to_friends = '0';
		}
		else
			$allow_post_to_friends = '0';
		
		$fbform = "<fb:live-stream event_app_id=\"".get_option('fbfull_apiid')."\" width=\"".$width."\" height=\"".$height."\" xid=\"".$xid."\"";
		if($via_url) 
			$fbform .= " via_url=\"".$via_url."\"";
		$fbform .= " always_post_to_friends=\"".$allow_post_to_friends."\"></fb:live-stream>";
		if((get_post_type() == 'page')||(is_single()))
			$content = str_replace($form,$fbform,$content);
		else
			$content = str_replace($form,'',$content);
		return $content;
	}


	function fbfull_add_fb_js() {
       echo "
   			<div id='fb-root'></div>
			<script src='http://connect.facebook.net/".get_locale()."/all.js' type='text/javascript'></script>
			<script type='text/javascript'>
		    	FB.init({
		    		appId: '".get_option('fbfull_apiid')."',
	    			status: true,
	    			cookie: true,
		    		xfbml: true
			   	});
			</script>\n
	    ";
	}

	if((get_option('fbfull_apiid')) && (is_numeric(get_option('fbfull_apiid'))))
	{
		add_action('wp_head','fbfull_add_fb_js');
		add_filter('the_content','fbfull_like_facepile_add');
		add_filter('the_content','fbfull_comments_add');
		add_filter('the_content','fbfull_livestream_add');
	}

}

add_action( 'widgets_init', 'fbfull_register_widgets' );
function fbfull_register_widgets() {
	register_widget('fbfull_activityfeed_widget');
	register_widget('fbfull_recommendations_widget');
	register_widget('fbfull_likebox_widget');
	register_widget('fbfull_livestream_widget');
	register_widget('fbfull_login_widget');
}



class fbfull_activityfeed_widget extends WP_Widget {
	function fbfull_activityfeed_widget() {
		$this->WP_Widget( 'fbfull_activityfeed_widget', __('Facebook Activity Feed', 'fbfull'),array('description' => __('Display Activity Feed', 'fbfull')));
	}

	function widget($args, $instance) {
		if($instance['fbfull_activityfeed_site'])
			$site = $instance['fbfull_activityfeed_site'];
		else
			$site = get_bloginfo('siteurl');
		if($instance['fbfull_activityfeed_width'])
			$width = $instance['fbfull_activityfeed_width'];
		else
			$width = '300';
        if($instance['fbfull_activityfeed_height'])
			$height = $instance['fbfull_activityfeed_height'];
		else
			$height = '300';
		if($instance['fbfull_activityfeed_header'])
			$header = '1';
		else
			$header = '0';
		if($instance['fbfull_activityfeed_colorscheme'])
			$colorscheme = $instance['fbfull_activityfeed_colorscheme'];
		else
			$colorscheme = 'light';
		if($instance['fbfull_activityfeed_font'])
			$font = $instance['fbfull_activityfeed_font'];
		else
			$font = 'arial';
		if($instance['fbfull_activityfeed_border_color'])
			$color = $instance['fbfull_activityfeed_border_color'];
		else
			$color = '000000';
		if($instance['fbfull_activityfeed_recommendations'])
			$recommendations = '1';
		else
			$recommendations = '0';
	?>
		<fb:activity 
        site="<?php echo $site; ?>" 
        width="<?php echo $width; ?>" 
        height="<?php echo $height; ?>" 
        header="<?php echo $header; ?>" 
        colorscheme="<?php echo $colorscheme; ?>" 
        font="<?php echo $font; ?>" 
        border_color="#<?php echo $color; ?>" 
        recommendations="<?php echo $recommendations; ?>"
        ></fb:activity>    
	<?php
	}

	function update($new_instance, $old_instance) {
        $instance['fbfull_activityfeed_site'] = $new_instance['fbfull_activityfeed_site'];
		if(($new_instance['fbfull_activityfeed_width'])&&(is_numeric($new_instance['fbfull_activityfeed_width']))&&($new_instance['fbfull_activityfeed_width']>0))
			$instance['fbfull_activityfeed_width'] = (int) $new_instance['fbfull_activityfeed_width'];
		else
			$instance['fbfull_activityfeed_width'] = 300;
		
		if(($new_instance['fbfull_activityfeed_height'])&&(is_numeric($new_instance['fbfull_activityfeed_height']))&&($new_instance['fbfull_activityfeed_height']>0))
			$instance['fbfull_activityfeed_height'] = (int) $new_instance['fbfull_activityfeed_height'];
		else
			$instance['fbfull_activityfeed_height'] = 300;
		
		$instance['fbfull_activityfeed_header'] = $new_instance['fbfull_activityfeed_header'];
		$instance['fbfull_activityfeed_colorscheme'] = $new_instance['fbfull_activityfeed_colorscheme'];
		$instance['fbfull_activityfeed_font'] = $new_instance['fbfull_activityfeed_font'];
		$instance['fbfull_activityfeed_recommendations'] = $new_instance['fbfull_activityfeed_recommendations'];
		$instance['fbfull_activityfeed_border_color'] = $new_instance['fbfull_activityfeed_border_color'];
		return $instance;
	}

	function form($instance) {
		$defaults = array( 'fbfull_activityfeed_site' => get_bloginfo('siteurl'),'fbfull_activityfeed_width' => '300','fbfull_activityfeed_height' => '300','fbfull_activityfeed_header' => '1','fbfull_activityfeed_colorscheme' => 'light','fbfull_activityfeed_font' => 'arial','fbfull_activityfeed_border_color' => '000000','fbfull_activityfeed_recommendations' => '0');
		$instance = wp_parse_args( (array) $instance, $defaults );
	?>
		<script type="text/javascript" src="<?php echo get_bloginfo('siteurl'). "/wp-content/plugins/" . dirname(plugin_basename( __FILE__ )) . "/js/colorpicker.js"; ?>"></script>
        <script type="text/javascript" src="<?php echo get_bloginfo('siteurl'). "/wp-content/plugins/" . dirname(plugin_basename( __FILE__ )) . "/js/fbfull_colorpicker.js"; ?>"></script>		<?php _e('URL (your url=','fbfull'); echo get_bloginfo('siteurl'); ?>):<br>
		<input type="text" name="<?php echo $this->get_field_name( 'fbfull_activityfeed_site' ); ?>" size="30" value="<?php echo $instance['fbfull_activityfeed_site']; ?>"><br>
		<?php _e('Width','fbfull'); ?>:<br>
		<input type="text" name="<?php echo $this->get_field_name( 'fbfull_activityfeed_width' ); ?>" size="30" value="<?php echo $instance['fbfull_activityfeed_width']; ?>"><br>
		<?php _e('Height','fbfull'); ?>:<br>
		<input type="text" name="<?php echo $this->get_field_name( 'fbfull_activityfeed_height' ); ?>" size="30" value="<?php echo $instance['fbfull_activityfeed_height']; ?>"><br>
        <input type="checkbox" name="<?php echo $this->get_field_name( 'fbfull_activityfeed_header' ); ?>" value="1"<?php if($instance['fbfull_activityfeed_header']) echo " checked=\"checked\""; ?>> <?php _e('Show header','fbfull'); ?><br>
        <?php _e('Color scheme','fbfull'); ?>:<br>
		<select name="<?php echo $this->get_field_name( 'fbfull_activityfeed_colorscheme' ); ?>">
			<option value="light"<?php if($instance['fbfull_activityfeed_colorscheme'] == 'light') echo " selected=\"selected\""; ?>><?php _e('light','fbfull'); ?></option>
            <option value="dark"<?php if($instance['fbfull_activityfeed_colorscheme'] == 'dark') echo " selected=\"selected\""; ?>><?php _e('dark','fbfull'); ?></option>
		</select><br>
        <?php _e('Font','fbfull'); ?>:<br>
		<select name="<?php echo $this->get_field_name( 'fbfull_activityfeed_font' ); ?>">
			<option value="arial"<?php if($instance['fbfull_activityfeed_font'] == 'arial') echo " selected=\"selected\""; ?>>arial</option>
            <option value="lucida grande"<?php if($instance['fbfull_activityfeed_font'] == 'lucida grande') echo " selected=\"selected\""; ?>>lucida grande</option>
            <option value="segoe ui"<?php if($instance['fbfull_activityfeed_font'] == 'segoe ui') echo " selected=\"selected\""; ?>>segoe ui</option>
            <option value="tahoma"<?php if($instance['fbfull_activityfeed_font'] == 'tahoma') echo " selected=\"selected\""; ?>>tahoma</option>
            <option value="trebuchet ms"<?php if($instance['fbfull_activityfeed_font'] == 'trebuchet ms') echo " selected=\"selected\""; ?>>trebuchet ms</option>
            <option value="verdana"<?php if($instance['fbfull_activityfeed_font'] == 'verdana') echo " selected=\"selected\""; ?>>verdana</option>
		</select><br>
		<input type="checkbox" name="<?php echo $this->get_field_name( 'fbfull_activityfeed_recommendations' ); ?>" value="1"<?php if($instance['fbfull_activityfeed_recommendations']) echo " checked=\"checked\""; ?>> <?php _e('Show recommendations','fbfull'); ?><br>
   		<?php _e('Border color','fbfull'); ?>:<br>
		<input type="text" name="<?php echo $this->get_field_name( 'fbfull_activityfeed_border_color' ); ?>" class="colorfield" size="30" readonly="readonly" value="<?php echo $instance['fbfull_activityfeed_border_color']; ?>"><br>
	<?php
	}
}

class fbfull_recommendations_widget extends WP_Widget {
	function fbfull_recommendations_widget() {
		$this->WP_Widget( 'fbfull_recommendations_widget', __('Facebook Recommendations', 'fbfull'),array('description' => __('Display Recommendations', 'fbfull')));
	}

	function widget($args, $instance) {
		if($instance['fbfull_recommendations_site'])
			$site = $instance['fbfull_recommendations_site'];
		else
			$site = get_bloginfo('siteurl');
		if($instance['fbfull_recommendations_width'])
			$width = $instance['fbfull_recommendations_width'];
		else
			$width = '300';
        if($instance['fbfull_recommendations_height'])
			$height = $instance['fbfull_recommendations_height'];
		else
			$height = '300';
		if($instance['fbfull_recommendations_header'])
			$header = '1';
		else
			$header = '0';
		if($instance['fbfull_recommendations_colorscheme'])
			$colorscheme = $instance['fbfull_recommendations_colorscheme'];
		else
			$colorscheme = 'light';
		if($instance['fbfull_recommendations_font'])
			$font = $instance['fbfull_recommendations_font'];
		else
			$font = 'arial';
		if($instance['fbfull_recommendations_border_color'])
			$color = $instance['fbfull_recommendations_border_color'];
		else
			$color = '000000';
	?>
		<fb:recommendations
        site="<?php echo $site; ?>" 
        width="<?php echo $width; ?>" 
        height="<?php echo $height; ?>" 
        header="<?php echo $header; ?>" 
        colorscheme="<?php echo $colorscheme; ?>" 
        font="<?php echo $font; ?>" 
        border_color="#<?php echo $color; ?>" 
        ></fb:recommendations>
	<?php
	}

	function update($new_instance, $old_instance) {
        $instance['fbfull_recommendations_site'] = $new_instance['fbfull_recommendations_site'];
		if(($new_instance['fbfull_recommendations_width'])&&(is_numeric($new_instance['fbfull_recommendations_width']))&&($new_instance['fbfull_recommendations_width']>0))
			$instance['fbfull_recommendations_width'] = (int) $new_instance['fbfull_recommendations_width'];
		else
			$instance['fbfull_recommendations_width'] = 300;
		
		if(($new_instance['fbfull_recommendations_height'])&&(is_numeric($new_instance['fbfull_recommendations_height']))&&($new_instance['fbfull_recommendations_height']>0))
			$instance['fbfull_recommendations_height'] = (int) $new_instance['fbfull_recommendations_height'];
		else
			$instance['fbfull_recommendations_height'] = 300;
		
		$instance['fbfull_recommendations_header'] = $new_instance['fbfull_recommendations_header'];
		$instance['fbfull_recommendations_colorscheme'] = $new_instance['fbfull_recommendations_colorscheme'];
		$instance['fbfull_recommendations_font'] = $new_instance['fbfull_recommendations_font'];
		$instance['fbfull_recommendations_border_color'] = $new_instance['fbfull_recommendations_border_color'];
		return $instance;
	}

	function form($instance) {
		$defaults = array( 'fbfull_recommendations_site' => get_bloginfo('siteurl'),'fbfull_recommendations_width' => '300','fbfull_recommendations_height' => '300','fbfull_recommendations_header' => '1','fbfull_recommendations_colorscheme' => 'light','fbfull_recommendations_font' => 'arial','fbfull_recommendations_border_color' => '000000');
		$instance = wp_parse_args( (array) $instance, $defaults );


	?>
		<script type="text/javascript" src="<?php echo get_bloginfo('siteurl'). "/wp-content/plugins/" . dirname(plugin_basename( __FILE__ )) . "/js/colorpicker.js"; ?>"></script>
        <script type="text/javascript" src="<?php echo get_bloginfo('siteurl'). "/wp-content/plugins/" . dirname(plugin_basename( __FILE__ )) . "/js/fbfull_colorpicker.js"; ?>"></script>		<?php _e('URL (your url=','fbfull'); echo get_bloginfo('siteurl'); ?>):<br>
		<input type="text" name="<?php echo $this->get_field_name( 'fbfull_recommendations_site' ); ?>" size="30" value="<?php echo $instance['fbfull_recommendations_site']; ?>"><br>
		<?php _e('Width','fbfull'); ?>:<br>
		<input type="text" name="<?php echo $this->get_field_name( 'fbfull_recommendations_width' ); ?>" size="30" value="<?php echo $instance['fbfull_recommendations_width']; ?>"><br>
		<?php _e('Height','fbfull'); ?>:<br>
		<input type="text" name="<?php echo $this->get_field_name( 'fbfull_recommendations_height' ); ?>" size="30" value="<?php echo $instance['fbfull_recommendations_height']; ?>"><br>
        <input type="checkbox" name="<?php echo $this->get_field_name( 'fbfull_recommendations_header' ); ?>" value="1"<?php if($instance['fbfull_recommendations_header']) echo " checked=\"checked\""; ?>> <?php _e('Show header','fbfull'); ?><br>
        <?php _e('Color scheme','fbfull'); ?>:<br>
		<select name="<?php echo $this->get_field_name( 'fbfull_recommendations_colorscheme' ); ?>">
			<option value="light"<?php if($instance['fbfull_recommendations_colorscheme'] == 'light') echo " selected=\"selected\""; ?>><?php _e('light','fbfull'); ?></option>
            <option value="dark"<?php if($instance['fbfull_recommendations_colorscheme'] == 'dark') echo " selected=\"selected\""; ?>><?php _e('dark','fbfull'); ?></option>
		</select><br>
        <?php _e('Font','fbfull'); ?>:<br>
		<select name="<?php echo $this->get_field_name( 'fbfull_recommendations_font' ); ?>">
			<option value="arial"<?php if($instance['fbfull_recommendations_font'] == 'arial') echo " selected=\"selected\""; ?>>arial</option>
            <option value="lucida grande"<?php if($instance['fbfull_recommendations_font'] == 'lucida grande') echo " selected=\"selected\""; ?>>lucida grande</option>
            <option value="segoe ui"<?php if($instance['fbfull_recommendations_font'] == 'segoe ui') echo " selected=\"selected\""; ?>>segoe ui</option>
            <option value="tahoma"<?php if($instance['fbfull_recommendations_font'] == 'tahoma') echo " selected=\"selected\""; ?>>tahoma</option>
            <option value="trebuchet ms"<?php if($instance['fbfull_recommendations_font'] == 'trebuchet ms') echo " selected=\"selected\""; ?>>trebuchet ms</option>
            <option value="verdana"<?php if($instance['fbfull_recommendations_font'] == 'verdana') echo " selected=\"selected\""; ?>>verdana</option>
		</select><br>
   		<?php _e('Border color','fbfull'); ?>:<br>
		<input type="text" name="<?php echo $this->get_field_name( 'fbfull_recommendations_border_color' ); ?>" class="colorfield" size="30" readonly="readonly" value="<?php echo $instance['fbfull_recommendations_border_color']; ?>"><br>
	<?php
	}
}




class fbfull_likebox_widget extends WP_Widget {
	protected $href = 'http://www.facebook.com/pages/FB-plugin-for-WordPress/114146691997541';
	function fbfull_likebox_widget() {
		$this->WP_Widget( 'fbfull_likebox_widget', __('Facebook Like Box', 'fbfull'),array('description' => __('Display Like Box', 'fbfull')));
	}

	function widget($args, $instance) {
		if($instance['fbfull_likebox_href'])
			$href = $instance['fbfull_likebox_href'];
		else
			$href = $this->href;
		if($instance['fbfull_likebox_width'])
			$width = $instance['fbfull_likebox_width'];
		else
			$width = '300';
		if(!$instance['fbfull_likebox_height_auto'])
	        if($instance['fbfull_likebox_height'])
				$height = $instance['fbfull_likebox_height'];
			else
				$height = '300';
		if($instance['fbfull_likebox_header'])
			$header = '1';
		else
			$header = '0';
		if($instance['fbfull_likebox_colorscheme'])
			$colorscheme = $instance['fbfull_likebox_colorscheme'];
		else
			$colorscheme = 'light';
		if($instance['fbfull_likebox_show_faces'])
			$show_faces = '1';
		else
			$show_faces = '0';
		if($instance['fbfull_likebox_stream'])
			$stream = '1';
		else
			$stream = '0';
	?>
		<fb:like-box
        href="<?php echo $href; ?>" 
        width="<?php echo $width; ?>" 
        <?php if(!$instance['fbfull_likebox_height_auto']) echo "height=\"".$height."\""; ?>
        header="<?php echo $header; ?>" 
        colorscheme="<?php echo $colorscheme; ?>" 
        show_faces="<?php echo $show_faces; ?>" 
        stream="<?php echo $stream; ?>"
        ></fb:like-box>
        
	<?php
	}

	function update($new_instance, $old_instance) {
		if($new_instance['fbfull_likebox_href'])
	        $instance['fbfull_likebox_href'] = $new_instance['fbfull_likebox_href'];
		else
			$instance['fbfull_likebox_href'] = $this->href;
		if(($new_instance['fbfull_likebox_width'])&&(is_numeric($new_instance['fbfull_likebox_width']))&&($new_instance['fbfull_likebox_width']>0))
			$instance['fbfull_likebox_width'] = (int) $new_instance['fbfull_likebox_width'];
		else
			$instance['fbfull_likebox_width'] = 300;
		$instance['fbfull_likebox_height_auto'] = $new_instance['fbfull_likebox_height_auto'];
		if(($new_instance['fbfull_likebox_height'])&&(is_numeric($new_instance['fbfull_likebox_height']))&&($new_instance['fbfull_likebox_height']>0))
			$instance['fbfull_likebox_height'] = (int) $new_instance['fbfull_likebox_height'];
		else
			$instance['fbfull_likebox_height'] = 300;
		
		$instance['fbfull_likebox_header'] = $new_instance['fbfull_likebox_header'];
		$instance['fbfull_likebox_colorscheme'] = $new_instance['fbfull_likebox_colorscheme'];
		$instance['fbfull_likebox_stream'] = $new_instance['fbfull_likebox_stream'];
		$instance['fbfull_likebox_show_faces'] = $new_instance['fbfull_likebox_show_faces'];
		return $instance;
	}

	function form($instance) {
		$defaults = array( 'fbfull_likebox_href' => $this->href,'fbfull_likebox_width' => '300','fbfull_likebox_height_auto' => '1','fbfull_likebox_height' => '300','fbfull_likebox_header' => '1','fbfull_likebox_colorscheme' => 'light','fbfull_likebox_show_faces' => '1','fbfull_likebox_stream' => '1');
		$instance = wp_parse_args( (array) $instance, $defaults );
	?>
		<?php _e('Facebook Page URL ','fbfull'); ?>:<br>
		<input type="text" name="<?php echo $this->get_field_name( 'fbfull_likebox_href' ); ?>" size="30" value="<?php echo $instance['fbfull_likebox_href']; ?>"><br>
		<?php _e('Width','fbfull'); ?>:<br>
		<input type="text" name="<?php echo $this->get_field_name( 'fbfull_likebox_width' ); ?>" size="30" value="<?php echo $instance['fbfull_likebox_width']; ?>"><br>
        <input type="checkbox" class="fbfull_likebox_height_auto" name="<?php echo $this->get_field_name( 'fbfull_likebox_height_auto' ); ?>" value="1"<?php if($instance['fbfull_likebox_height_auto']) echo " checked=\"checked\""; ?>> <?php _e('Auto-height','fbfull'); ?><br>
        <div class="fbfull_wrap_likebox_height<?php if($instance['fbfull_likebox_height_auto']) echo " fbhide"; ?>">
			<?php _e('Height','fbfull'); ?>:<br>
			<input type="text" name="<?php echo $this->get_field_name( 'fbfull_likebox_height' ); ?>" size="30" value="<?php echo $instance['fbfull_likebox_height']; ?>"><br>
        </div>
        <input type="checkbox" name="<?php echo $this->get_field_name( 'fbfull_likebox_header' ); ?>" value="1"<?php if($instance['fbfull_likebox_header']) echo " checked=\"checked\""; ?>> <?php _e('Show header','fbfull'); ?><br>
        <?php _e('Color scheme','fbfull'); ?>:<br>
		<select name="<?php echo $this->get_field_name( 'fbfull_likebox_colorscheme' ); ?>">
			<option value="light"<?php if($instance['fbfull_likebox_colorscheme'] == 'light') echo " selected=\"selected\""; ?>><?php _e('light','fbfull'); ?></option>
            <option value="dark"<?php if($instance['fbfull_likebox_colorscheme'] == 'dark') echo " selected=\"selected\""; ?>><?php _e('dark','fbfull'); ?></option>
		</select><br>
		<input type="checkbox" name="<?php echo $this->get_field_name( 'fbfull_likebox_show_faces' ); ?>" value="1"<?php if($instance['fbfull_likebox_show_faces']) echo " checked=\"checked\""; ?>> <?php _e('Show faces','fbfull'); ?><br>
        <input type="checkbox" name="<?php echo $this->get_field_name( 'fbfull_likebox_stream' ); ?>" value="1"<?php if($instance['fbfull_likebox_stream']) echo " checked=\"checked\""; ?>> <?php _e('Show stream','fbfull'); ?><br>
        <script type="text/javascript" src="<?php echo get_bloginfo('siteurl'). "/wp-content/plugins/" . dirname(plugin_basename( __FILE__ )) . "/js/fbfull_likebox.js"; ?>"></script>
	<?php
	}
}



class fbfull_livestream_widget extends WP_Widget {
	
	function fbfull_livestream_widget() {
		$this->WP_Widget( 'fbfull_livestream_widget', __('Facebook Live Stream', 'fbfull'),array('description' => __('Display Live Stream', 'fbfull')));
	}

	function widget($args, $instance) {
		if($instance['fbfull_livestream_width'])
			$width = $instance['fbfull_livestream_width'];
		else
			$width = '300';
        if($instance['fbfull_livestream_height'])
			$height = $instance['fbfull_livestream_height'];
		else
			$height = '300';
		if($instance['fbfull_livestream_xid'])
			$xid = $instance['fbfull_livestream_xid'];
		else
			$xid = 'sidebar';
		if($instance['fbfull_livestream_via_url'])
			$via_url = $instance['fbfull_livestream_via_url'];
		else
			$via_url = NULL;
		if($instance['fbfull_livestream_always_post_to_friends'])
			$always_post_to_friends = '1';
		else
			$always_post_to_friends = '0';
	?>
	<fb:live-stream 
    event_app_id="<?php echo get_option('fbfull_apiid'); ?>" 
    width="<?php echo $width; ?>" 
    height="<?php echo $height; ?>" 
    xid="<?php echo $xid; ?>" 
    <?php if($via_url) echo "via_url=\"".$via_url."\" "; ?>
    always_post_to_friends="<?php echo $always_post_to_friends; ?>"
    ></fb:live-stream>       
	<?php
	}

	function update($new_instance, $old_instance) {
		if(($new_instance['fbfull_livestream_width'])&&(is_numeric($new_instance['fbfull_livestream_width']))&&($new_instance['fbfull_livestream_width']>0))
			$instance['fbfull_livestream_width'] = (int) $new_instance['fbfull_livestream_width'];
		else
			$instance['fbfull_livestream_width'] = 300;
		if(($new_instance['fbfull_livestream_height'])&&(is_numeric($new_instance['fbfull_livestream_height']))&&($new_instance['fbfull_livestream_height']>0))
			$instance['fbfull_livestream_height'] = (int) $new_instance['fbfull_livestream_height'];
		else
			$instance['fbfull_livestream_height'] = 300;
		if($new_instance['fbfull_livestream_xid'])
			$instance['fbfull_livestream_xid'] = $new_instance['fbfull_livestream_xid'];
		else
			$instance['fbfull_livestream_xid'] = "sidebar";
		$instance['fbfull_livestream_via_url'] = $new_instance['fbfull_livestream_via_url'];
		$instance['fbfull_livestream_always_post_to_friends'] = $new_instance['fbfull_livestream_always_post_to_friends'];
		return $instance;
	}

	function form($instance) {
		$defaults = array( 'fbfull_livestream_width' => '300','fbfull_livestream_height' => '300','fbfull_livestream_xid' => 'sidebar','fbfull_livestream_via_url' => NULL,'fbfull_livestream_always_post_to_friends' => '1');
		$instance = wp_parse_args( (array) $instance, $defaults );
	?>
		<?php _e('Width','fbfull'); ?>:<br>
		<input type="text" name="<?php echo $this->get_field_name( 'fbfull_livestream_width' ); ?>" size="30" value="<?php echo $instance['fbfull_livestream_width']; ?>"><br>
		<?php _e('Height','fbfull'); ?>:<br>
		<input type="text" name="<?php echo $this->get_field_name( 'fbfull_livestream_height' ); ?>" size="30" value="<?php echo $instance['fbfull_livestream_height']; ?>"><br>
		<?php _e('XID ','fbfull'); ?>:<br>
		<input type="text" name="<?php echo $this->get_field_name( 'fbfull_livestream_xid' ); ?>" size="30" value="<?php echo $instance['fbfull_livestream_xid']; ?>"><br>
		<?php _e('Via Attribution URL','fbfull'); ?>:<br>
		<input type="text" name="<?php echo $this->get_field_name( 'fbfull_livestream_via_url' ); ?>" size="30" value="<?php echo $instance['fbfull_livestream_via_url']; ?>"><br>
		<input type="checkbox" name="<?php echo $this->get_field_name( 'fbfull_livestream_always_post_to_friends' ); ?>" value="1"<?php if($instance['fbfull_livestream_always_post_to_friends']) echo " checked=\"checked\""; ?>> <?php _e('Always post to friends','fbfull'); ?><br>
        <script type="text/javascript" src="<?php echo get_bloginfo('siteurl'). "/wp-content/plugins/" . dirname(plugin_basename( __FILE__ )) . "/js/fbfull_livestream.js"; ?>"></script>
	<?php
	}
}


class fbfull_login_widget extends WP_Widget {
	
	function fbfull_login_widget() {
		$this->WP_Widget( 'fbfull_login_widget', __('Facebook Login Button', 'fbfull'),array('description' => __('Display Login Button', 'fbfull')));
	}

	function widget($args, $instance) {
		if($instance['fbfull_login_width'])
			$width = $instance['fbfull_login_width'];
		else
			$width = '300';
        if($instance['fbfull_login_max_rows'])
			$max_rows = $instance['fbfull_login_max_rows'];
		else
			$max_rows = '1';
		if($instance['fbfull_login_show_faces'])
			$show_faces = 'true';
		else
			$show_faces = 'false';
		if($instance['fbfull_login_text'])
			$text = $instance['fbfull_login_text'];
		else
			$text = NULL;

	?>
    <fb:login-button show-faces="<?php echo $show_faces;?>" width="<?php echo $width;?>" max-rows="<?php echo $max_rows;?>"><?php echo $text; ?></fb:login-button>
	<?php
	}

	function update($new_instance, $old_instance) {
		if(($new_instance['fbfull_login_width'])&&(is_numeric($new_instance['fbfull_login_width']))&&($new_instance['fbfull_login_width']>0))
			$instance['fbfull_login_width'] = (int) $new_instance['fbfull_login_width'];
		else
			$instance['fbfull_login_width'] = 300;
		if(($new_instance['fbfull_login_max_rows'])&&(is_numeric($new_instance['fbfull_login_max_rows']))&&($new_instance['fbfull_login_max_rows']>0))
			$instance['fbfull_login_max_rows'] = (int) $new_instance['fbfull_login_max_rows'];
		else
			$instance['fbfull_login_max_rows'] = 1;
		$instance['fbfull_login_show_faces'] = $new_instance['fbfull_login_show_faces'];
		$instance['fbfull_login_text'] = $new_instance['fbfull_login_text'];
		return $instance;
	}

	function form($instance) {
		$defaults = array( 'fbfull_login_width' => '300','fbfull_login_max_rows' => '1','fbfull_login_show_faces' => '1','fbfull_login_text' => '');
		$instance = wp_parse_args( (array) $instance, $defaults );
	?>
		<?php _e('Button text','fbfull'); ?>:<br>
		<input type="text" name="<?php echo $this->get_field_name( 'fbfull_login_text' ); ?>" size="30" value="<?php echo $instance['fbfull_login_text']; ?>"><br>
    	<input type="checkbox" name="<?php echo $this->get_field_name( 'fbfull_login_show_faces' ); ?>" value="1"<?php if($instance['fbfull_login_show_faces']) echo " checked=\"checked\""; ?>> <?php _e('Show faces','fbfull'); ?><br>
		<?php _e('Width','fbfull'); ?>:<br>
		<input type="text" name="<?php echo $this->get_field_name( 'fbfull_login_width' ); ?>" size="30" value="<?php echo $instance['fbfull_login_width']; ?>"><br>
		<?php _e('Max rows','fbfull'); ?>:<br>
		<input type="text" name="<?php echo $this->get_field_name( 'fbfull_login_max_rows' ); ?>" size="30" value="<?php echo $instance['fbfull_login_max_rows']; ?>"><br>
	<?php
	}
}


?>
