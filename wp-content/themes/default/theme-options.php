<?php
//admin menu
function theme_admin_menu() 
{
	global $themename;
	add_submenu_page("themes.php", ucfirst($themename), "Opções do Tema", "edit_theme_options", "ThemeOptions", $themename . "_options");
}
add_action("admin_menu", "theme_admin_menu");

function theme_stripslashes_deep($value)
{
	$value = is_array($value) ?
				array_map('stripslashes_deep', $value) :
				stripslashes($value);

	return $value;
}

function gymbase_options() 
{
	global $themename;
	if($_POST["action"]==$themename . "_save")
	{
		$theme_options = (array)get_option($themename . "_options");
		if($_POST[$themename . "_submit"]=="Save Main Options")
		{
			$theme_options_main = array(
				"logo_url" => $_POST["logo_url"],
				"logo_first_part_text" => $_POST["logo_first_part_text"],
				"logo_second_part_text" => $_POST["logo_second_part_text"],
				"footer_text_left" => $_POST["footer_text_left"],
				"footer_text_right" => $_POST["footer_text_right"],
				"home_page_top_hint" => $_POST["home_page_top_hint"],
				"responsive" => (int)$_POST["responsive"]
			);
			update_option($themename . "_options", array_merge($theme_options, $theme_options_main));
			$selected_tab = 0;
		}
		else if($_POST[$themename . "_submit"]=="Save Slider Options")
		{
			$theme_options_backgrounds = array(
				"slider_image_url" => array_filter($_POST["slider_image_url"]),
				"slider_image_title" => array_filter($_POST["slider_image_title"]),
				"slider_image_subtitle" => array_filter($_POST["slider_image_subtitle"]),
				"slider_image_link" => array_filter($_POST["slider_image_link"]),
				"slider_autoplay" => $_POST["slider_autoplay"],
				"slide_interval" => (int)$_POST["slide_interval"],
				"slider_effect" => $_POST["slider_effect"],
				"slider_transition" => $_POST["slider_transition"],
				"slider_transition_speed" => (int)$_POST["slider_transition_speed"]
			);
			update_option($themename . "_options", array_merge($theme_options, $theme_options_backgrounds));
			$selected_tab = 1;
		}
		else if($_POST[$themename . "_submit"]=="Save Contact Form Options")
		{
			$theme_options_contact_form = array(
				"cf_admin_name" => $_POST["cf_admin_name"],
				"cf_admin_email" => $_POST["cf_admin_email"],
				"cf_smtp_host" => $_POST["cf_smtp_host"],
				"cf_smtp_username" => $_POST["cf_smtp_username"],
				"cf_smtp_password" => $_POST["cf_smtp_password"],
				"cf_smtp_port" => $_POST["cf_smtp_port"],
				"cf_smtp_secure" => $_POST["cf_smtp_secure"],
				"cf_email_subject" => $_POST["cf_email_subject"],
				"cf_template" => $_POST["cf_template"]
			);
			update_option($themename . "_options", array_merge($theme_options, $theme_options_contact_form));
			$selected_tab = 2;
		}
		else if($_POST[$themename . "_submit"]=="Save Contact Details Options")
		{
			$theme_options_contact_details = array(
				"contact_logo_first_part_text" => $_POST["contact_logo_first_part_text"],
				"contact_logo_second_part_text" => $_POST["contact_logo_second_part_text"],
				"contact_phone" => $_POST["contact_phone"],
				"contact_fax" => $_POST["contact_fax"],
				"contact_email" => $_POST["contact_email"]
			);
			update_option($themename . "_options", array_merge($theme_options, $theme_options_contact_details));
			$selected_tab = 3;
		}
		else if($_POST[$themename . "_submit"]=="Save Colors Options")
		{
			$theme_options_colors = array(
				"header_background_color" => $_POST["header_background_color"],
				"body_background_color" => $_POST["body_background_color"],
				"footer_background_color" => $_POST["footer_background_color"],
				"link_color" => $_POST["link_color"],
				"link_hover_color" => $_POST["link_hover_color"],
				"body_headers_color" => $_POST["body_headers_color"],
				"body_headers_border_color" => $_POST["body_headers_border_color"],
				"body_text_color" => $_POST["body_text_color"],
				"body_text2_color" => $_POST["body_text2_color"],
				"footer_headers_color" => $_POST["footer_headers_color"],
				"footer_headers_border_color" => $_POST["footer_headers_border_color"],
				"footer_text_color" => $_POST["footer_text_color"],
				"timeago_label_color" => $_POST["timeago_label_color"],
				"sentence_color" => $_POST["sentence_color"],
				"logo_first_part_text_color" => $_POST["logo_first_part_text_color"],
				"logo_second_part_text_color" => $_POST["logo_second_part_text_color"],
				"body_button_color" => $_POST["body_button_color"],
				"body_button_hover_color" => $_POST["body_button_hover_color"],
				"body_button_border_color" => $_POST["body_button_border_color"],
				"body_button_border_hover_color" => $_POST["body_button_border_hover_color"],
				"footer_button_color" => $_POST["footer_button_color"],
				"footer_button_hover_color" => $_POST["footer_button_hover_color"],
				"footer_button_border_color" => $_POST["footer_button_border_color"],
				"footer_button_border_hover_color" => $_POST["footer_button_border_hover_color"],
				"menu_link_color" => $_POST["menu_link_color"],
				"menu_link_border_color" => $_POST["menu_link_border_color"],
				"menu_active_color" => $_POST["menu_active_color"],
				"menu_active_border_color" => $_POST["menu_active_border_color"],
				"menu_hover_color" => $_POST["menu_hover_color"],
				"menu_hover_border_color" => $_POST["menu_hover_border_color"],
				"submenu_background_color" => $_POST["submenu_background_color"],
				"submenu_hover_background_color" => $_POST["submenu_hover_background_color"],
				"submenu_color" => $_POST["submenu_color"],
				"submenu_hover_color" => $_POST["submenu_hover_color"],
				"form_hint_color" => $_POST["form_hint_color"],
				"form_field_text_color" => $_POST["form_field_text_color"],
				"form_field_border_color" => $_POST["form_field_border_color"],
				"form_field_active_border_color" => $_POST["form_field_active_border_color"],
				"date_box_color" => $_POST["date_box_color"],
				"gallery_box_color" => $_POST["gallery_box_color"],
				"gallery_box_hover_color" => $_POST["gallery_box_hover_color"],
				"timetable_box_color" => $_POST["timetable_box_color"],
				"timetable_box_hover_color" => $_POST["timetable_box_hover_color"],
				"gallery_details_box_border_color" => $_POST["gallery_details_box_border_color"],
				"bread_crumb_border_color" => $_POST["bread_crumb_border_color"],
				"accordion_item_border_color" => $_POST["accordion_item_border_color"],
				"accordion_item_border_hover_color" => $_POST["accordion_item_border_hover_color"],
				"accordion_item_border_active_color" => $_POST["accordion_item_border_active_color"],
				"copyright_area_border_color" => $_POST["copyright_area_border_color"],
				"top_hint_background_color" => $_POST["top_hint_background_color"],
				"top_hint_text_color" => $_POST["top_hint_text_color"],
				"comment_reply_button_color" => $_POST["comment_reply_button_color"],
				"contact_details_box_background_color" => $_POST["contact_details_box_background_color"]
			);
			update_option($themename . "_options", array_merge($theme_options, $theme_options_colors));
			$selected_tab = 4;
		}
		else if($_POST[$themename . "_submit"]=="Save Fonts Options")
		{
			$theme_options_fonts = array(
				"header_font" => $_POST["header_font"],
				"subheader_font" => $_POST["subheader_font"]
			);
			update_option($themename . "_options", array_merge($theme_options, $theme_options_fonts));
			$selected_tab = 5;
		}
		else
		{
			$theme_options = array(
				"logo_url" => $_POST["logo_url"],
				"logo_first_part_text" => $_POST["logo_first_part_text"],
				"logo_second_part_text" => $_POST["logo_second_part_text"],
				"footer_text_left" => $_POST["footer_text_left"],
				"footer_text_right" => $_POST["footer_text_right"],
				"home_page_top_hint" => $_POST["home_page_top_hint"],
				"responsive" => (int)$_POST["responsive"],
				"slider_image_url" => array_filter($_POST["slider_image_url"]),
				"slider_image_title" => array_filter($_POST["slider_image_title"]),
				"slider_image_subtitle" => array_filter($_POST["slider_image_subtitle"]),
				"slider_image_link" => array_filter($_POST["slider_image_link"]),
				"slider_autoplay" => $_POST["slider_autoplay"],
				"slide_interval" => (int)$_POST["slide_interval"],
				"slider_effect" => $_POST["slider_effect"],
				"slider_transition" => $_POST["slider_transition"],
				"slider_transition_speed" => (int)$_POST["slider_transition_speed"],
				"footer_text_left" => $_POST["footer_text_left"],
				"footer_text_right" => $_POST["footer_text_right"],
				"cf_admin_name" => $_POST["cf_admin_name"],
				"cf_admin_email" => $_POST["cf_admin_email"],
				"cf_smtp_host" => $_POST["cf_smtp_host"],
				"cf_smtp_username" => $_POST["cf_smtp_username"],
				"cf_smtp_password" => $_POST["cf_smtp_password"],
				"cf_smtp_port" => $_POST["cf_smtp_port"],
				"cf_smtp_secure" => $_POST["cf_smtp_secure"],
				"cf_email_subject" => $_POST["cf_email_subject"],
				"cf_template" => $_POST["cf_template"],
				"contact_logo_first_part_text" => $_POST["contact_logo_first_part_text"],
				"contact_logo_second_part_text" => $_POST["contact_logo_second_part_text"],
				"contact_phone" => $_POST["contact_phone"],
				"contact_fax" => $_POST["contact_fax"],
				"contact_email" => $_POST["contact_email"],
				"header_background_color" => $_POST["header_background_color"],
				"body_background_color" => $_POST["body_background_color"],
				"footer_background_color" => $_POST["footer_background_color"],
				"link_color" => $_POST["link_color"],
				"link_hover_color" => $_POST["link_hover_color"],
				"body_headers_color" => $_POST["body_headers_color"],
				"body_headers_border_color" => $_POST["body_headers_border_color"],
				"body_text_color" => $_POST["body_text_color"],
				"body_text2_color" => $_POST["body_text2_color"],
				"footer_headers_color" => $_POST["footer_headers_color"],
				"footer_headers_border_color" => $_POST["footer_headers_border_color"],
				"footer_text_color" => $_POST["footer_text_color"],
				"timeago_label_color" => $_POST["timeago_label_color"],
				"sentence_color" => $_POST["sentence_color"],
				"logo_first_part_text_color" => $_POST["logo_first_part_text_color"],
				"logo_second_part_text_color" => $_POST["logo_second_part_text_color"],
				"body_button_color" => $_POST["body_button_color"],
				"body_button_hover_color" => $_POST["body_button_hover_color"],
				"body_button_border_color" => $_POST["body_button_border_color"],
				"body_button_border_hover_color" => $_POST["body_button_border_hover_color"],
				"footer_button_color" => $_POST["footer_button_color"],
				"footer_button_hover_color" => $_POST["footer_button_hover_color"],
				"footer_button_border_color" => $_POST["footer_button_border_color"],
				"footer_button_border_hover_color" => $_POST["footer_button_border_hover_color"],
				"menu_link_color" => $_POST["menu_link_color"],
				"menu_link_border_color" => $_POST["menu_link_border_color"],
				"menu_active_color" => $_POST["menu_active_color"],
				"menu_active_border_color" => $_POST["menu_active_border_color"],
				"menu_hover_color" => $_POST["menu_hover_color"],
				"menu_hover_border_color" => $_POST["menu_hover_border_color"],
				"submenu_background_color" => $_POST["submenu_background_color"],
				"submenu_hover_background_color" => $_POST["submenu_hover_background_color"],
				"submenu_color" => $_POST["submenu_color"],
				"submenu_hover_color" => $_POST["submenu_hover_color"],
				"form_hint_color" => $_POST["form_hint_color"],
				"form_field_text_color" => $_POST["form_field_text_color"],
				"form_field_border_color" => $_POST["form_field_border_color"],
				"form_field_active_border_color" => $_POST["form_field_active_border_color"],
				"date_box_color" => $_POST["date_box_color"],
				"gallery_box_color" => $_POST["gallery_box_color"],
				"gallery_box_hover_color" => $_POST["gallery_box_hover_color"],
				"timetable_box_color" => $_POST["timetable_box_color"],
				"timetable_box_hover_color" => $_POST["timetable_box_hover_color"],
				"gallery_details_box_border_color" => $_POST["gallery_details_box_border_color"],
				"bread_crumb_border_color" => $_POST["bread_crumb_border_color"],
				"accordion_item_border_color" => $_POST["accordion_item_border_color"],
				"accordion_item_border_hover_color" => $_POST["accordion_item_border_hover_color"],
				"accordion_item_border_active_color" => $_POST["accordion_item_border_active_color"],
				"copyright_area_border_color" => $_POST["copyright_area_border_color"],
				"top_hint_background_color" => $_POST["top_hint_background_color"],
				"top_hint_text_color" => $_POST["top_hint_text_color"],
				"comment_reply_button_color" => $_POST["comment_reply_button_color"],
				"contact_details_box_background_color" => $_POST["contact_details_box_background_color"],
				"header_font" => $_POST["header_font"],
				"subheader_font" => $_POST["subheader_font"]
			);
			update_option($themename . "_options", $theme_options);
			$selected_tab = 0;
		}
	}
	$theme_options = theme_stripslashes_deep(get_option($themename . "_options"));
?>
	<div class="wrap">
		<div class="icon32" id="icon-options-general"><br></div>
		<h2><?php echo ucfirst($themename);?> Options</h2>
	</div>
	<?php 
	if($_POST["action"]==$themename . "_save")
	{
	?>
	<div class="updated"> 
		<p>
			<strong>
				<?php _e('Options saved', $themename); ?>
			</strong>
		</p>
	</div>
	<?php
	}
	//get google fonts
	/* HIDE ERROR
	$fontsJson = file_get_contents('https://www.googleapis.com/webfonts/v1/webfonts?key=AIzaSyB4_VClnbxilxqjZd7NbysoHwAXX1ZGdKQ');
	$fontsArray = json_decode($fontsJson);
	*/
	//print_r($fontsArray->items);
	?>
	<form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post" id="<?php echo $themename; ?>-options-tabs">
		<ul class="nav-tabs">
			<li class="nav-tab">
				<a href="#tab-main">
					<?php _e('Main', $themename); ?>
				</a>
			</li>
			<li class="nav-tab">
				<a href="#tab-slider">
					<?php _e('Slider', $themename); ?>
				</a>
			</li>
			<li class="nav-tab">
				<a href="#tab-contact-form">
					<?php _e('Contact Form', $themename); ?>
				</a>
			</li>
			<li class="nav-tab">
				<a href="#tab-contact-details">
					<?php _e('Contact Details', $themename); ?>
				</a>
			</li>
			<li class="nav-tab">
				<a href="#tab-colors">
					<?php _e('Colors', $themename); ?>
				</a>
			</li>
			<li class="nav-tab">
				<a href="#tab-fonts">
					<?php _e('Fonts', $themename); ?>
				</a>
			</li>
		</ul>
		<div id="tab-main">
			<table class="form-table">
				<tbody>
					<tr valign="top">
						<th colspan="2" scope="row" style="font-weight: bold;">
							<?php _e('Main', $themename); ?>
						</th>
					</tr>
					<tr valign="top">
						<th scope="row">
							<label for="logo_url"><?php _e('Logo url', $themename); ?></label>
						</th>
						<td>
							<input type="text" class="regular-text" value="<?php echo esc_attr($theme_options["logo_url"]); ?>" id="logo_url" name="logo_url">
							<input type="button" class="button" name="<?php echo $themename;?>_upload_button" id="logo_url_upload_button" value="<?php _e('Insert logo', $themename); ?>" />
						</td>
					</tr>
					<tr valign="top">
						<th scope="row">
							<label for="logo_first_part_text"><?php _e('Logo first part text', $themename); ?></label>
						</th>
						<td>
							<input type="text" class="regular-text" value="<?php echo esc_attr($theme_options["logo_first_part_text"]); ?>" id="logo_first_part_text" name="logo_first_part_text">
						</td>
					</tr>
					<tr valign="top">
						<th scope="row">
							<label for="logo_second_part_text"><?php _e('Logo second part text', $themename); ?></label>
						</th>
						<td>
							<input type="text" class="regular-text" value="<?php echo esc_attr($theme_options["logo_second_part_text"]); ?>" id="logo_second_part_text" name="logo_second_part_text">
						</td>
					</tr>
					<tr valign="top">
						<th scope="row">
							<label for="footer_text_left"><?php _e('Footer text left', $themename); ?></label>
						</th>
						<td>
							<input type="text" class="regular-text" value="<?php echo esc_attr($theme_options["footer_text_left"]); ?>" id="footer_text_left" name="footer_text_left">
							<span class="description"><?php _e('Can be text or any html', $themename); ?>.</span>
						</td>
					</tr>
					<tr valign="top">
						<th scope="row">
							<label for="footer_text_right"><?php _e('Footer text right', $themename); ?></label>
						</th>
						<td>
							<input type="text" class="regular-text" value="<?php echo esc_attr($theme_options["footer_text_right"]); ?>" id="footer_text_right" name="footer_text_right">
							<span class="description"><?php _e('Can be text or any html', $themename); ?>.</span>
						</td>
					</tr>
					<tr valign="top">
						<th scope="row">
							<label for="home_page_top_hint"><?php _e('Home page top hint', $themename); ?></label>
						</th>
						<td>
							<input type="text" class="regular-text" value="<?php echo esc_attr($theme_options["home_page_top_hint"]); ?>" id="home_page_top_hint" name="home_page_top_hint">
							<span class="description"><?php _e('Can be text or any html', $themename); ?>.</span>
						</td>
					</tr>
					<tr valign="top">
						<th scope="row">
							<label for="responsive"><?php _e('Responsive', $themename); ?></label>
						</th>
						<td>
							<select id="responsive" name="responsive">
								<option value="1"<?php echo ((int)$theme_options["responsive"]==1 ? " selected='selected'" : "") ?>><?php _e('yes', $themename); ?></option>
								<option value="0"<?php echo ((int)$theme_options["responsive"]==0 ? " selected='selected'" : "") ?>><?php _e('no', $themename); ?></option>
							</select>
						</td>
					</tr>
				</tbody>
			</table>
			<p>
				<input type="submit" value="<?php _e('Save Main Options', $themename); ?>" class="button-primary" name="<?php echo $themename; ?>_submit">
			</p>
		</div>
		<div id="tab-slider">
			<table class="form-table">
				<tbody>
					<tr valign="top">
						<th colspan="2" scope="row" style="font-weight: bold;">
							<?php _e('Slider', $themename); ?>
						</th>
					</tr>
					<?php
					$slides_count = count($theme_options["slider_image_url"]);
					if($slides_count==0)
						$slides_count = 3;
					for($i=0; $i<$slides_count; $i++)
					{
					?>
					<tr class="slider_image_url_row">
						<td>
							<label><?php _e('Slider image url', $themename); echo " " . ($i+1); ?></label>
						</td>
						<td>
							<input class="regular-text" type="text" id="<?php echo $themename;?>_slider_image_url_<?php echo ($i+1); ?>" name="slider_image_url[]" value="<?php echo esc_attr($theme_options["slider_image_url"][$i]); ?>" />
							<input type="button" class="button" name="<?php echo $themename;?>_upload_button" id="<?php echo $themename;?>_slider_image_url_button_<?php echo ($i+1); ?>" value="<?php _e('Browse', $themename); ?>" />
						</td>
					</tr>
					<tr class="slider_image_title_row">
						<td>
							<label><?php _e('Slider image title', $themename); echo " " . ($i+1); ?></label>
						</td>
						<td>
							<input class="regular-text" type="text" id="<?php echo $themename;?>_slider_image_title_<?php echo ($i+1); ?>" name="slider_image_title[]" value="<?php echo esc_attr($theme_options["slider_image_title"][$i]); ?>" />
						</td>
					</tr>
					<tr class="slider_image_subtitle_row">
						<td>
							<label><?php _e('Slider image subtitle', $themename); echo " " . ($i+1); ?></label>
						</td>
						<td>
							<input class="regular-text" type="text" id="<?php echo $themename;?>_slider_image_subtitle_<?php echo ($i+1); ?>" name="slider_image_subtitle[]" value="<?php echo esc_attr($theme_options["slider_image_subtitle"][$i]); ?>" />
						</td>
					</tr>
					<tr class="slider_image_link_row">
						<td>
							<label><?php _e('Slider image link', $themename); echo " " . ($i+1); ?></label>
						</td>
						<td>
							<input class="regular-text" type="text" id="<?php echo $themename;?>_slider_image_link_<?php echo ($i+1); ?>" name="slider_image_link[]" value="<?php echo esc_attr($theme_options["slider_image_link"][$i]); ?>" />
						</td>
					</tr>
					<?php
					}
					?>
					<tr>
						<td></td>
						<td>
							<input type="button" class="button" name="<?php echo $themename;?>_add_new_button" id="<?php echo $themename;?>_add_new_button" value="<?php _e('Add slider image', $themename); ?>" />
						</td>
					</tr>
					<tr>
						<td>
							<label><?php _e('Autoplay', $themename); ?></label>
						</td>
						<td>
							<select id="slider_autoplay" name="slider_autoplay">
								<option value="true"<?php echo ($theme_options["slider_autoplay"]=="true" ? " selected='selected'" : "") ?>><?php _e('yes', $themename); ?></option>
								<option value="false"<?php echo ($theme_options["slider_autoplay"]=="false" ? " selected='selected'" : "") ?>><?php _e('no', $themename); ?></option>
							</select>
						</td>
					</tr>
					<tr>
						<td>
							<label for="slide_interval"><?php _e('Slide interval:', $themename); ?></label>
						</td>
						<td>
							<input type="text" class="regular-text" id="slide_interval" name="slide_interval" value="<?php echo (int)esc_attr($theme_options["slide_interval"]); ?>" />
						</td>
					</tr>
					<tr>
						<td>
							<label for="slider_effect"><?php _e('Effect:', $themename); ?></label>
						</td>
						<td>
							<select id="slider_effect" name="slider_effect">
								<option value="scroll"<?php echo ($theme_options["slider_effect"]=="scroll" ? " selected='selected'" : "") ?>><?php _e('scroll', $themename); ?></option>
								<option value="none"<?php echo ($theme_options["slider_effect"]=="none" ? " selected='selected'" : "") ?>><?php _e('none', $themename); ?></option>
								<option value="directscroll"<?php echo ($theme_options["slider_effect"]=="directscroll" ? " selected='selected'" : "") ?>><?php _e('directscroll', $themename); ?></option>
								<option value="fade"<?php echo ($theme_options["slider_effect"]=="fade" ? " selected='selected'" : "") ?>><?php _e('fade', $themename); ?></option>
								<option value="crossfade"<?php echo ($theme_options["slider_effect"]=="crossfade" ? " selected='selected'" : "") ?>><?php _e('crossfade', $themename); ?></option>
								<option value="cover"<?php echo ($theme_options["slider_effect"]=="cover" ? " selected='selected'" : "") ?>><?php _e('cover', $themename); ?></option>
								<option value="uncover"<?php echo ($theme_options["slider_effect"]=="uncover" ? " selected='selected'" : "") ?>><?php _e('uncover', $themename); ?></option>
							</select>
						</td>
					</tr>
					<tr>
						<td>
							<label for="slider_transition"><?php _e('Transition:', $themename); ?></label>
						</td>
						<td>
							<select id="slider_transition" name="slider_transition">
								<option value="swing"<?php echo ($theme_options["slider_transition"]=="swing" ? " selected='selected'" : "") ?>><?php _e('swing', $themename); ?></option>
								<option value="linear"<?php echo ($theme_options["slider_transition"]=="linear" ? " selected='selected'" : "") ?>><?php _e('linear', $themename); ?></option>
								<option value="easeInQuad"<?php echo ($theme_options["slider_transition"]=="easeInQuad" ? " selected='selected'" : "") ?>><?php _e('easeInQuad', $themename); ?></option>
								<option value="easeOutQuad"<?php echo ($theme_options["slider_transition"]=="easeOutQuad" ? " selected='selected'" : "") ?>><?php _e('easeOutQuad', $themename); ?></option>
								<option value="easeInOutQuad"<?php echo ($theme_options["slider_transition"]=="easeInOutQuad" ? " selected='selected'" : "") ?>><?php _e('easeInOutQuad', $themename); ?></option>
								<option value="easeInCubic"<?php echo ($theme_options["slider_transition"]=="easeInCubic" ? " selected='selected'" : "") ?>><?php _e('easeInCubic', $themename); ?></option>
								<option value="easeOutCubic"<?php echo ($theme_options["slider_transition"]=="easeOutCubic" ? " selected='selected'" : "") ?>><?php _e('easeOutCubic', $themename); ?></option>
								<option value="easeInOutCubic"<?php echo ($theme_options["slider_transition"]=="easeInOutCubic" ? " selected='selected'" : "") ?>><?php _e('easeInOutCubic', $themename); ?></option>
								<option value="easeInOutCubic"<?php echo ($theme_options["slider_transition"]=="easeInOutCubic" ? " selected='selected'" : "") ?>><?php _e('easeInOutCubic', $themename); ?></option>
								<option value="easeInQuart"<?php echo ($theme_options["slider_transition"]=="easeInQuart" ? " selected='selected'" : "") ?>><?php _e('easeInQuart', $themename); ?></option>
								<option value="easeOutQuart"<?php echo ($theme_options["slider_transition"]=="easeOutQuart" ? " selected='selected'" : "") ?>><?php _e('easeOutQuart', $themename); ?></option>
								<option value="easeInOutQuart"<?php echo ($theme_options["slider_transition"]=="easeInOutQuart" ? " selected='selected'" : "") ?>><?php _e('easeInOutQuart', $themename); ?></option>
								<option value="easeInSine"<?php echo ($theme_options["slider_transition"]=="easeInSine" ? " selected='selected'" : "") ?>><?php _e('easeInSine', $themename); ?></option>
								<option value="easeOutSine"<?php echo ($theme_options["slider_transition"]=="easeOutSine" ? " selected='selected'" : "") ?>><?php _e('easeOutSine', $themename); ?></option>
								<option value="easeInOutSine"<?php echo ($theme_options["slider_transition"]=="easeInOutSine" ? " selected='selected'" : "") ?>><?php _e('easeInOutSine', $themename); ?></option>
								<option value="easeInExpo"<?php echo ($theme_options["slider_transition"]=="easeInExpo" ? " selected='selected'" : "") ?>><?php _e('easeInExpo', $themename); ?></option>
								<option value="easeOutExpo"<?php echo ($theme_options["slider_transition"]=="easeOutExpo" ? " selected='selected'" : "") ?>><?php _e('easeOutExpo', $themename); ?></option>
								<option value="easeInOutExpo"<?php echo ($theme_options["slider_transition"]=="easeInOutExpo" ? " selected='selected'" : "") ?>><?php _e('easeInOutExpo', $themename); ?></option>
								<option value="easeInQuint"<?php echo ($theme_options["slider_transition"]=="easeInQuint" ? " selected='selected'" : "") ?>><?php _e('easeInQuint', $themename); ?></option>
								<option value="easeOutQuint"<?php echo ($theme_options["slider_transition"]=="easeOutQuint" ? " selected='selected'" : "") ?>><?php _e('easeOutQuint', $themename); ?></option>
								<option value="easeInOutQuint"<?php echo ($theme_options["slider_transition"]=="easeInOutQuint" ? " selected='selected'" : "") ?>><?php _e('easeInOutQuint', $themename); ?></option>
								<option value="easeInCirc"<?php echo ($theme_options["slider_transition"]=="easeInCirc" ? " selected='selected'" : "") ?>><?php _e('easeInCirc', $themename); ?></option>
								<option value="easeOutCirc"<?php echo ($theme_options["slider_transition"]=="easeOutCirc" ? " selected='selected'" : "") ?>><?php _e('easeOutCirc', $themename); ?></option>
								<option value="easeInOutCirc"<?php echo ($theme_options["slider_transition"]=="easeInOutCirc" ? " selected='selected'" : "") ?>><?php _e('easeInOutCirc', $themename); ?></option>
								<option value="easeInElastic"<?php echo ($theme_options["slider_transition"]=="easeInElastic" ? " selected='selected'" : "") ?>><?php _e('easeInElastic', $themename); ?></option>
								<option value="easeOutElastic"<?php echo ($theme_options["slider_transition"]=="easeOutElastic" ? " selected='selected'" : "") ?>><?php _e('easeOutElastic', $themename); ?></option>
								<option value="easeInOutElastic"<?php echo ($theme_options["slider_transition"]=="easeInOutElastic" ? " selected='selected'" : "") ?>><?php _e('easeInOutElastic', $themename); ?></option>
								<option value="easeInBack"<?php echo ($theme_options["slider_transition"]=="easeInBack" ? " selected='selected'" : "") ?>><?php _e('easeInBack', $themename); ?></option>
								<option value="easeOutBack"<?php echo ($theme_options["slider_transition"]=="easeOutBack" ? " selected='selected'" : "") ?>><?php _e('easeOutBack', $themename); ?></option>
								<option value="easeInOutBack"<?php echo ($theme_options["slider_transition"]=="easeOutCirc" ? " selected='selected'" : "") ?>><?php _e('easeInOutBack', $themename); ?></option>
								<option value="easeInBounce"<?php echo ($theme_options["slider_transition"]=="easeInBounce" ? " selected='selected'" : "") ?>><?php _e('easeInBounce', $themename); ?></option>
								<option value="easeOutBounce"<?php echo ($theme_options["slider_transition"]=="easeOutBounce" ? " selected='selected'" : "") ?>><?php _e('easeOutBounce', $themename); ?></option>
								<option value="easeInOutBounce"<?php echo ($theme_options["slider_transition"]=="easeInOutBounce" ? " selected='selected'" : "") ?>><?php _e('easeInOutBounce', $themename); ?></option>
							</select>
						</td>
					</tr>
					<tr>
						<td>
							<label for="slider_transition_speed"><?php _e('Transition speed:', $themename); ?></label>
						</td>
						<td>
							<input type="text" class="regular-text" id="slider_transition_speed" name="slider_transition_speed" value="<?php echo (int)esc_attr($theme_options["slider_transition_speed"]); ?>" />
						</td>
					</tr>
				</tbody>
			</table>
			<p>
				<input type="submit" value="<?php _e('Save Slider Options', $themename); ?>" class="button-primary" name="<?php echo $themename; ?>_submit">
			</p>
		</div>
		<div id="tab-contact-form">
			<table class="form-table">
				<tbody>
					<tr valign="top">
						<th colspan="2" scope="row" style="font-weight: bold;">
							<?php
							_e('Admin email config', $themename);
							?>
						</th>
					</tr>
					<tr valign="top">
						<th scope="row">
							<label for="cf_admin_name"><?php _e('Name', $themename); ?></label>
						</th>
						<td>
							<input type="text" class="regular-text" value="<?php echo esc_attr($theme_options["cf_admin_name"]); ?>" id="cf_admin_name" name="cf_admin_name">
						</td>
					</tr>
					<tr valign="top">
						<th scope="row">
							<label for="cf_admin_email"><?php _e('Email', $themename); ?></label>
						</th>
						<td>
							<input type="text" class="regular-text" value="<?php echo esc_attr($theme_options["cf_admin_email"]); ?>" id="cf_admin_email" name="cf_admin_email">
						</td>
					</tr>
					<tr valign="top">
						<th colspan="2" scope="row" style="font-weight: bold;">
							<br />
						</th>
					</tr>
					<tr valign="top">
						<th colspan="2" scope="row" style="font-weight: bold;">
							<?php
							_e('Admin SMTP config (optional)', $themename);
							?>
						</th>
					</tr>
					<tr valign="top">
						<th scope="row">
							<label for="cf_smtp_host"><?php _e('Host', $themename); ?></label>
						</th>
						<td>
							<input type="text" class="regular-text" value="<?php echo esc_attr($theme_options["cf_smtp_host"]); ?>" id="cf_smtp_host" name="cf_smtp_host">
						</td>
					</tr>
					<tr valign="top">
						<th scope="row">
							<label for="cf_smtp_username"><?php _e('Username', $themename); ?></label>
						</th>
						<td>
							<input type="text" class="regular-text" value="<?php echo esc_attr($theme_options["cf_smtp_username"]); ?>" id="cf_smtp_username" name="cf_smtp_username">
						</td>
					</tr>
					<tr valign="top">
						<th scope="row">
							<label for="cf_smtp_password"><?php _e('Password', $themename); ?></label>
						</th>
						<td>
							<input type="password" class="regular-text" value="<?php echo esc_attr($theme_options["cf_smtp_password"]); ?>" id="cf_smtp_password" name="cf_smtp_password">
						</td>
					</tr>
					<tr valign="top">
						<th scope="row">
							<label for="cf_smtp_port"><?php _e('Port', $themename); ?></label>
						</th>
						<td>
							<input type="text" class="regular-text" value="<?php echo esc_attr($theme_options["cf_smtp_port"]); ?>" id="cf_smtp_port" name="cf_smtp_port">
						</td>
					</tr>
					<tr valign="top">
						<th scope="row">
							<label for="cf_smtp_secure"><?php _e('SMTP Secure', $themename); ?></label>
						</th>
						<td>
							<select id="cf_smtp_secure" name="cf_smtp_secure">
								<option value=""<?php echo ($theme_options["cf_smtp_secure"]=="" ? " selected='selected'" : "") ?>>-</option>
								<option value="ssl"<?php echo ($theme_options["cf_smtp_secure"]=="ssl" ? " selected='selected'" : "") ?>><?php _e('ssl', $themename); ?></option>
								<option value="tls"<?php echo ($theme_options["cf_smtp_secure"]=="tls" ? " selected='selected'" : "") ?>><?php _e('tls', $themename); ?></option>
							</select>
						</td>
					</tr>
					<tr valign="top">
						<th colspan="2" scope="row" style="font-weight: bold;">
							<br />
						</th>
					</tr>
					<tr valign="top">
						<th colspan="2" scope="row" style="font-weight: bold;">
							<?php _e('Email config', $themename); ?>
						</th>
					</tr>
					<tr valign="top">
						<th scope="row">
							<label for="cf_email_subject"><?php _e('Email subject', $themename); ?></label>
						</th>
						<td>
							<input type="text" class="regular-text" value="<?php echo esc_attr($theme_options["cf_email_subject"]); ?>" id="cf_email_subject" name="cf_email_subject">
						</td>
					</tr>
					<tr valign="top">
						<th scope="row">
							<label for="cf_template"><?php _e('Template', $themename); ?></label>
						</th>
						<td></td>
					</tr>
					<tr valign="top">
						<td colspan="2">
							<?php the_editor($theme_options["cf_template"], "cf_template");?>
						</td>
					</tr>
				</tbody>
			</table>
			<p>
				<input type="submit" value="<?php _e('Save Contact Form Options', $themename); ?>" class="button-primary" name="<?php echo $themename; ?>_submit">
			</p>
		</div>
		<div id="tab-contact-details">
			<table class="form-table">
				<tbody>
					<tr valign="top">
						<th colspan="2" scope="row" style="font-weight: bold;">
							<?php
							_e('Contact Details', $themename);
							?>
						</th>
					</tr>
					<tr valign="top">
						<th scope="row">
							<label for="contact_logo_first_part_text"><?php _e('Contact logo first part text', $themename); ?></label>
						</th>
						<td>
							<input type="text" class="regular-text" value="<?php echo esc_attr($theme_options["contact_logo_first_part_text"]); ?>" id="contact_logo_first_part_text" name="contact_logo_first_part_text">
						</td>
					</tr>
					<tr valign="top">
						<th scope="row">
							<label for="contact_logo_second_part_text"><?php _e('Contact logo second part text', $themename); ?></label>
						</th>
						<td>
							<input type="text" class="regular-text" value="<?php echo esc_attr($theme_options["contact_logo_second_part_text"]); ?>" id="contact_logo_second_part_text" name="contact_logo_second_part_text">
						</td>
					</tr>
					<tr valign="top">
						<th scope="row">
							<label for="contact_phone"><?php _e('Contact phone', $themename); ?></label>
						</th>
						<td>
							<input type="text" class="regular-text" value="<?php echo esc_attr($theme_options["contact_phone"]); ?>" id="contact_phone" name="contact_phone">
						</td>
					</tr>
					<tr valign="top">
						<th scope="row">
							<label for="contact_fax"><?php _e('Contact fax', $themename); ?></label>
						</th>
						<td>
							<input type="text" class="regular-text" value="<?php echo esc_attr($theme_options["contact_fax"]); ?>" id="contact_fax" name="contact_fax">
						</td>
					</tr>
					<tr valign="top">
						<th scope="row">
							<label for="contact_email"><?php _e('Contact email', $themename); ?></label>
						</th>
						<td>
							<input type="text" class="regular-text" value="<?php echo esc_attr($theme_options["contact_email"]); ?>" id="contact_phone" name="contact_email">
						</td>
					</tr>
				</tbody>
			</table>
			<p>
				<input type="submit" value="<?php _e('Save Contact Details Options', $themename); ?>" class="button-primary" name="<?php echo $themename; ?>_submit">
			</p>
		</div>
		<div id="tab-colors">
			<table class="form-table">
				<tbody>
					<tr valign="top">
						<th colspan="2" scope="row" style="font-weight: bold;">
							<?php
							_e('General', $themename);
							?>
						</th>
					</tr>
					<tr valign="top">
						<th scope="row">
							<label for="header_background_color"><?php _e('Header background color', $themename); ?></label>
						</th>
						<td>
							<input type="text" class="regular-text color" value="<?php echo esc_attr($theme_options["header_background_color"]); ?>" id="header_background_color" name="header_background_color">
						</td>
					</tr>
					<tr valign="top">
						<th scope="row">
							<label for="body_background_color"><?php _e('Body background color', $themename); ?></label>
						</th>
						<td>
							<input type="text" class="regular-text color" value="<?php echo esc_attr($theme_options["body_background_color"]); ?>" id="body_background_color" name="body_background_color">
						</td>
					</tr>
					<tr valign="top">
						<th scope="row">
							<label for="footer_background_color"><?php _e('Footer background color', $themename); ?></label>
						</th>
						<td>
							<input type="text" class="regular-text color" value="<?php echo esc_attr($theme_options["footer_background_color"]); ?>" id="footer_background_color" name="footer_background_color">
						</td>
					</tr>
					<tr valign="top">
						<th scope="row">
							<label for="link_color"><?php _e('Link color', $themename); ?></label>
						</th>
						<td>
							<input type="text" class="regular-text color" value="<?php echo esc_attr($theme_options["link_color"]); ?>" id="link_color" name="link_color">
						</td>
					</tr>
					<tr valign="top">
						<th scope="row">
							<label for="link_hover_color"><?php _e('Link hover color', $themename); ?></label>
						</th>
						<td>
							<input type="text" class="regular-text color" value="<?php echo esc_attr($theme_options["link_hover_color"]); ?>" id="link_hover_color" name="link_hover_color">
						</td>
					</tr>
					<tr>
						<td style="padding: 0;">
							<p>
								<input type="submit" value="<?php _e('Save Colors Options', $themename); ?>" class="button-primary" name="<?php echo $themename; ?>_submit">
							</p>
						</td>
					</tr>
					<tr valign="top">
						<th colspan="2" scope="row" style="font-weight: bold;">
							<?php
							_e('Text', $themename);
							?>
						</th>
					</tr>
					<tr valign="top">
						<th scope="row">
							<label for="body_headers_color"><?php _e('Body headers color', $themename); ?></label>
						</th>
						<td>
							<input type="text" class="regular-text color" value="<?php echo esc_attr($theme_options["body_headers_color"]); ?>" id="body_headers_color" name="body_headers_color">
						</td>
					</tr>
					<tr valign="top">
						<th scope="row">
							<label for="body_headers_border_color"><?php _e('Body headers border color', $themename); ?></label>
						</th>
						<td>
							<input type="text" class="regular-text color" value="<?php echo esc_attr($theme_options["body_headers_border_color"]); ?>" id="body_headers_border_color" name="body_headers_border_color">
							<span class="description"><?php _e('Enter \'none\' for no border', $themename); ?></span>
						</td>
					</tr>
					<tr valign="top">
						<th scope="row">
							<label for="body_text_color"><?php _e('Body text color', $themename); ?></label>
						</th>
						<td>
							<input type="text" class="regular-text color" value="<?php echo esc_attr($theme_options["body_text_color"]); ?>" id="body_text_color" name="body_text_color">
						</td>
					</tr>
					<tr valign="top">
						<th scope="row">
							<label for="body_text2_color"><?php _e('Body text 2 color', $themename); ?></label>
						</th>
						<td>
							<input type="text" class="regular-text color" value="<?php echo esc_attr($theme_options["body_text2_color"]); ?>" id="body_text2_color" name="body_text2_color">
						</td>
					</tr>
					<tr valign="top">
						<th scope="row">
							<label for="footer_headers_color"><?php _e('Footer headers color', $themename); ?></label>
						</th>
						<td>
							<input type="text" class="regular-text color" value="<?php echo esc_attr($theme_options["footer_headers_color"]); ?>" id="footer_headers_color" name="footer_headers_color">
						</td>
					</tr>
					<tr valign="top">
						<th scope="row">
							<label for="footer_headers_border_color"><?php _e('Footer headers border color', $themename); ?></label>
						</th>
						<td>
							<input type="text" class="regular-text color" value="<?php echo esc_attr($theme_options["footer_headers_border_color"]); ?>" id="footer_headers_border_color" name="footer_headers_border_color">
							<span class="description"><?php _e('Enter \'none\' for no border', $themename); ?></span>
						</td>
					</tr>
					<tr valign="top">
						<th scope="row">
							<label for="footer_text_color"><?php _e('Footer text color', $themename); ?></label>
						</th>
						<td>
							<input type="text" class="regular-text color" value="<?php echo esc_attr($theme_options["footer_text_color"]); ?>" id="footer_text_color" name="footer_text_color">
						</td>
					</tr>
					<tr valign="top">
						<th scope="row">
							<label for="timeago_label_color"><?php _e('Timeago label color', $themename); ?></label>
						</th>
						<td>
							<input type="text" class="regular-text color" value="<?php echo esc_attr($theme_options["timeago_label_color"]); ?>" id="timeago_label_color" name="timeago_label_color">
						</td>
					</tr>
					<tr valign="top">
						<th scope="row">
							<label for="sentence_color"><?php _e('Sentence color', $themename); ?></label>
						</th>
						<td>
							<input type="text" class="regular-text color" value="<?php echo esc_attr($theme_options["sentence_color"]); ?>" id="sentence_color" name="sentence_color">
						</td>
					</tr>
					<tr valign="top">
						<th scope="row">
							<label for="logo_first_part_text_color"><?php _e('Logo first part text color', $themename); ?></label>
						</th>
						<td>
							<input type="text" class="regular-text color" value="<?php echo esc_attr($theme_options["logo_first_part_text_color"]); ?>" id="logo_first_part_text_color" name="logo_first_part_text_color">
						</td>
					</tr>
					<tr valign="top">
						<th scope="row">
							<label for="logo_second_part_text_color"><?php _e('Logo second part text color', $themename); ?></label>
						</th>
						<td>
							<input type="text" class="regular-text color" value="<?php echo esc_attr($theme_options["logo_second_part_text_color"]); ?>" id="logo_second_part_text_color" name="logo_second_part_text_color">
						</td>
					</tr>
					<tr>
						<td style="padding: 0;">
							<p>
								<input type="submit" value="<?php _e('Save Colors Options', $themename); ?>" class="button-primary" name="<?php echo $themename; ?>_submit">
							</p>
						</td>
					</tr>
					<tr valign="top">
						<th colspan="2" scope="row" style="font-weight: bold;">
							<?php
							_e('Buttons', $themename);
							?>
						</th>
					</tr>
					<tr valign="top">
						<th scope="row">
							<label for="body_button_color"><?php _e('Body button text color', $themename); ?></label>
						</th>
						<td>
							<input type="text" class="regular-text color" value="<?php echo esc_attr($theme_options["body_button_color"]); ?>" id="body_button_color" name="body_button_color">
						</td>
					</tr>
					<tr valign="top">
						<th scope="row">
							<label for="body_button_hover_color"><?php _e('Body button text hover color', $themename); ?></label>
						</th>
						<td>
							<input type="text" class="regular-text color" value="<?php echo esc_attr($theme_options["body_button_hover_color"]); ?>" id="body_button_hover_color" name="body_button_hover_color">
						</td>
					</tr>
					<tr valign="top">
						<th scope="row">
							<label for="body_button_border_color"><?php _e('Body button border color', $themename); ?></label>
						</th>
						<td>
							<input type="text" class="regular-text color" value="<?php echo esc_attr($theme_options["body_button_border_color"]); ?>" id="body_button_border_color" name="body_button_border_color">
						</td>
					</tr>
					<tr valign="top">
						<th scope="row">
							<label for="body_button_border_hover_color"><?php _e('Body button border hover color', $themename); ?></label>
						</th>
						<td>
							<input type="text" class="regular-text color" value="<?php echo esc_attr($theme_options["body_button_border_hover_color"]); ?>" id="body_button_border_hover_color" name="body_button_border_hover_color">
						</td>
					</tr>
					<tr valign="top">
						<th scope="row">
							<label for="footer_button_color"><?php _e('Footer button text color', $themename); ?></label>
						</th>
						<td>
							<input type="text" class="regular-text color" value="<?php echo esc_attr($theme_options["footer_button_color"]); ?>" id="footer_button_color" name="footer_button_color">
						</td>
					</tr>
					<tr valign="top">
						<th scope="row">
							<label for="footer_button_hover_color"><?php _e('Footer button text hover color', $themename); ?></label>
						</th>
						<td>
							<input type="text" class="regular-text color" value="<?php echo esc_attr($theme_options["footer_button_hover_color"]); ?>" id="footer_button_hover_color" name="footer_button_hover_color">
						</td>
					</tr>
					<tr valign="top">
						<th scope="row">
							<label for="footer_button_border_color"><?php _e('Footer button border color', $themename); ?></label>
						</th>
						<td>
							<input type="text" class="regular-text color" value="<?php echo esc_attr($theme_options["footer_button_border_color"]); ?>" id="footer_button_border_color" name="footer_button_border_color">
						</td>
					</tr>
					<tr valign="top">
						<th scope="row">
							<label for="footer_button_border_hover_color"><?php _e('Footer button border hover color', $themename); ?></label>
						</th>
						<td>
							<input type="text" class="regular-text color" value="<?php echo esc_attr($theme_options["footer_button_border_hover_color"]); ?>" id="footer_button_border_hover_color" name="footer_button_border_hover_color">
						</td>
					</tr>
					<tr>
						<td style="padding: 0;">
							<p>
								<input type="submit" value="<?php _e('Save Colors Options', $themename); ?>" class="button-primary" name="<?php echo $themename; ?>_submit">
							</p>
						</td>
					</tr>
					<tr valign="top">
						<th colspan="2" scope="row" style="font-weight: bold;">
							<?php
							_e('Menu', $themename);
							?>
						</th>
					</tr>
					<tr valign="top">
						<th scope="row">
							<label for="menu_link_color"><?php _e('Link color', $themename); ?></label>
						</th>
						<td>
							<input type="text" class="regular-text color" value="<?php echo esc_attr($theme_options["menu_link_color"]); ?>" id="menu_link_color" name="menu_link_color">
						</td>
					</tr>
					<tr valign="top">
						<th scope="row">
							<label for="menu_link_border_color"><?php _e('Link border color', $themename); ?></label>
						</th>
						<td>
							<input type="text" class="regular-text color" value="<?php echo esc_attr($theme_options["menu_link_border_color"]); ?>" id="menu_link_border_color" name="menu_link_border_color">
							<span class="description"><?php _e('Enter \'none\' for no border', $themename); ?></span>
						</td>
					</tr>
					<tr valign="top">
						<th scope="row">
							<label for="menu_active_color"><?php _e('Active color', $themename); ?></label>
						</th>
						<td>
							<input type="text" class="regular-text color" value="<?php echo esc_attr($theme_options["menu_active_color"]); ?>" id="menu_active_color" name="menu_active_color">
						</td>
					</tr>
					<tr valign="top">
						<th scope="row">
							<label for="menu_active_border_color"><?php _e('Active border color', $themename); ?></label>
						</th>
						<td>
							<input type="text" class="regular-text color" value="<?php echo esc_attr($theme_options["menu_active_border_color"]); ?>" id="menu_active_border_color" name="menu_active_border_color">
							<span class="description"><?php _e('Enter \'none\' for no border', $themename); ?></span>
						</td>
					</tr>
					<tr valign="top">
						<th scope="row">
							<label for="menu_hover_color"><?php _e('Hover color', $themename); ?></label>
						</th>
						<td>
							<input type="text" class="regular-text color" value="<?php echo esc_attr($theme_options["menu_hover_color"]); ?>" id="menu_hover_color" name="menu_hover_color">
						</td>
					</tr>
					<tr valign="top">
						<th scope="row">
							<label for="menu_hover_border_color"><?php _e('Hover border color', $themename); ?></label>
						</th>
						<td>
							<input type="text" class="regular-text color" value="<?php echo esc_attr($theme_options["menu_hover_border_color"]); ?>" id="menu_hover_border_color" name="menu_hover_border_color">
							<span class="description"><?php _e('Enter \'none\' for no border', $themename); ?></span>
						</td>
					</tr>
					<tr valign="top">
						<th scope="row">
							<label for="submenu_background_color"><?php _e('Submenu background color', $themename); ?></label>
						</th>
						<td>
							<input type="text" class="regular-text color" value="<?php echo esc_attr($theme_options["submenu_background_color"]); ?>" id="submenu_background_color" name="submenu_background_color">
						</td>
					</tr>
					<tr valign="top">
						<th scope="row">
							<label for="submenu_hover_background_color"><?php _e('Submenu hover background color', $themename); ?></label>
						</th>
						<td>
							<input type="text" class="regular-text color" value="<?php echo esc_attr($theme_options["submenu_hover_background_color"]); ?>" id="submenu_hover_background_color" name="submenu_hover_background_color">
						</td>
					</tr>
					<tr valign="top">
						<th scope="row">
							<label for="submenu_color"><?php _e('Submenu link color', $themename); ?></label>
						</th>
						<td>
							<input type="text" class="regular-text color" value="<?php echo esc_attr($theme_options["submenu_color"]); ?>" id="submenu_color" name="submenu_color">
						</td>
					</tr>
					<tr valign="top">
						<th scope="row">
							<label for="submenu_hover_color"><?php _e('Submenu hover link color', $themename); ?></label>
						</th>
						<td>
							<input type="text" class="regular-text color" value="<?php echo esc_attr($theme_options["submenu_hover_color"]); ?>" id="submenu_color" name="submenu_hover_color">
						</td>
					</tr>
					<tr>
						<td style="padding: 0;">
							<p>
								<input type="submit" value="<?php _e('Save Colors Options', $themename); ?>" class="button-primary" name="<?php echo $themename; ?>_submit">
							</p>
						</td>
					</tr>
					<tr valign="top">
						<th colspan="2" scope="row" style="font-weight: bold;">
							<?php
							_e('Forms', $themename);
							?>
						</th>
					</tr>
					<tr valign="top">
						<th scope="row">
							<label for="form_hint_color"><?php _e('Form hint color', $themename); ?></label>
						</th>
						<td>
							<input type="text" class="regular-text color" value="<?php echo esc_attr($theme_options["form_hint_color"]); ?>" id="form_hint_color" name="form_hint_color">
						</td>
					</tr>
					<tr valign="top">
						<th scope="row">
							<label for="form_field_text_color"><?php _e('Form field text color', $themename); ?></label>
						</th>
						<td>
							<input type="text" class="regular-text color" value="<?php echo esc_attr($theme_options["form_field_text_color"]); ?>" id="form_field_text_color" name="form_field_text_color">
						</td>
					</tr>
					<tr valign="top">
						<th scope="row">
							<label for="form_field_border_color"><?php _e('Form field border color', $themename); ?></label>
						</th>
						<td>
							<input type="text" class="regular-text color" value="<?php echo esc_attr($theme_options["form_field_border_color"]); ?>" id="form_field_border_color" name="form_field_border_color">
							<span class="description"><?php _e('Enter \'none\' for no border', $themename); ?></span>
						</td>
					</tr>
					<tr valign="top">
						<th scope="row">
							<label for="form_field_active_border_color"><?php _e('Form field active border color', $themename); ?></label>
						</th>
						<td>
							<input type="text" class="regular-text color" value="<?php echo esc_attr($theme_options["form_field_active_border_color"]); ?>" id="form_field_active_border_color" name="form_field_active_border_color">
							<span class="description"><?php _e('Enter \'none\' for no border', $themename); ?></span>
						</td>
					</tr>
					<tr valign="top">
						<th colspan="2" scope="row" style="font-weight: bold;">
							<?php
							_e('Miscellaneous', $themename);
							?>
						</th>
					</tr>
					<tr valign="top">
						<th scope="row">
							<label for="date_box_color"><?php _e('Date box color', $themename); ?></label>
						</th>
						<td>
							<input type="text" class="regular-text color" value="<?php echo esc_attr($theme_options["date_box_color"]); ?>" id="date_box_color" name="date_box_color">
						</td>
					</tr>
					<tr valign="top">
						<th scope="row">
							<label for="gallery_box_color"><?php _e('Gallery box color', $themename); ?></label>
						</th>
						<td>
							<input type="text" class="regular-text color" value="<?php echo esc_attr($theme_options["gallery_box_color"]); ?>" id="gallery_box_color" name="gallery_box_color">
						</td>
					</tr>
					<tr valign="top">
						<th scope="row">
							<label for="gallery_box_hover_color"><?php _e('Gallery box hover color', $themename); ?></label>
						</th>
						<td>
							<input type="text" class="regular-text color" value="<?php echo esc_attr($theme_options["gallery_box_hover_color"]); ?>" id="gallery_box_hover_color" name="gallery_box_hover_color">
						</td>
					</tr>
					<tr valign="top">
						<th scope="row">
							<label for="timetable_box_color"><?php _e('Timetable box color', $themename); ?></label>
						</th>
						<td>
							<input type="text" class="regular-text color" value="<?php echo esc_attr($theme_options["timetable_box_color"]); ?>" id="timetable_box_color" name="timetable_box_color">
						</td>
					</tr>
					<tr valign="top">
						<th scope="row">
							<label for="timetable_box_hover_color"><?php _e('Timetable box hover color', $themename); ?></label>
						</th>
						<td>
							<input type="text" class="regular-text color" value="<?php echo esc_attr($theme_options["timetable_box_hover_color"]); ?>" id="timetable_box_hover_color" name="timetable_box_hover_color">
						</td>
					</tr>
					<tr valign="top">
						<th scope="row">
							<label for="gallery_details_box_border_color"><?php _e('Gallery details box border color', $themename); ?></label>
						</th>
						<td>
							<input type="text" class="regular-text color" value="<?php echo esc_attr($theme_options["gallery_details_box_border_color"]); ?>" id="gallery_details_box_border_color" name="gallery_details_box_border_color">
							<span class="description"><?php _e('Enter \'none\' for no border', $themename); ?></span>
						</td>
					</tr>
					<tr valign="top">
						<th scope="row">
							<label for="bread_crumb_border_color"><?php _e('Bread crumb border color', $themename); ?></label>
						</th>
						<td>
							<input type="text" class="regular-text color" value="<?php echo esc_attr($theme_options["bread_crumb_border_color"]); ?>" id="bread_crumb_border_color" name="bread_crumb_border_color">
							<span class="description"><?php _e('Enter \'none\' for no border', $themename); ?></span>
						</td>
					</tr>
					<tr valign="top">
						<th scope="row">
							<label for="accordion_item_border_color"><?php _e('Accordion item border color', $themename); ?></label>
						</th>
						<td>
							<input type="text" class="regular-text color" value="<?php echo esc_attr($theme_options["accordion_item_border_color"]); ?>" id="accordion_item_border_color" name="accordion_item_border_color">
							<span class="description"><?php _e('Enter \'none\' for no border', $themename); ?></span>
						</td>
					</tr>
					<tr valign="top">
						<th scope="row">
							<label for="accordion_item_border_hover_color"><?php _e('Accordion item border hover color', $themename); ?></label>
						</th>
						<td>
							<input type="text" class="regular-text color" value="<?php echo esc_attr($theme_options["accordion_item_border_hover_color"]); ?>" id="accordion_item_border_hover_color" name="accordion_item_border_hover_color">
							<span class="description"><?php _e('Enter \'none\' for no border', $themename); ?></span>
						</td>
					</tr>
					<tr valign="top">
						<th scope="row">
							<label for="accordion_item_border_active_color"><?php _e('Accordion item border active color', $themename); ?></label>
						</th>
						<td>
							<input type="text" class="regular-text color" value="<?php echo esc_attr($theme_options["accordion_item_border_active_color"]); ?>" id="accordion_item_border_active_color" name="accordion_item_border_active_color">
							<span class="description"><?php _e('Enter \'none\' for no border', $themename); ?></span>
						</td>
					</tr>
					<tr valign="top">
						<th scope="row">
							<label for="copyright_area_border_color"><?php _e('Copyright area border color', $themename); ?></label>
						</th>
						<td>
							<input type="text" class="regular-text color" value="<?php echo esc_attr($theme_options["copyright_area_border_color"]); ?>" id="copyright_area_border_color" name="copyright_area_border_color">
							<span class="description"><?php _e('Enter \'none\' for no border', $themename); ?></span>
						</td>
					</tr>
					<tr valign="top">
						<th scope="row">
							<label for="top_hint_background_color"><?php _e('Top hint background color', $themename); ?></label>
						</th>
						<td>
							<input type="text" class="regular-text color" value="<?php echo esc_attr($theme_options["top_hint_background_color"]); ?>" id="top_hint_background_color" name="top_hint_background_color">
						</td>
					</tr>
					<tr valign="top">
						<th scope="row">
							<label for="top_hint_text_color"><?php _e('Top hint text color', $themename); ?></label>
						</th>
						<td>
							<input type="text" class="regular-text color" value="<?php echo esc_attr($theme_options["top_hint_text_color"]); ?>" id="top_hint_text_color" name="top_hint_text_color">
						</td>
					</tr>
					<tr valign="top">
						<th scope="row">
							<label for="comment_reply_button_color"><?php _e('Comment reply button color', $themename); ?></label>
						</th>
						<td>
							<input type="text" class="regular-text color" value="<?php echo esc_attr($theme_options["comment_reply_button_color"]); ?>" id="comment_reply_button_color" name="comment_reply_button_color">
						</td>
					</tr>
					<tr valign="top">
						<th scope="row">
							<label for="contact_details_box_background_color"><?php _e('Contact details box background color', $themename); ?></label>
						</th>
						<td>
							<input type="text" class="regular-text color" value="<?php echo esc_attr($theme_options["contact_details_box_background_color"]); ?>" id="contact_details_box_background_color" name="contact_details_box_background_color">
						</td>
					</tr>
				</tbody>
			</table>
			<p>
				<input type="submit" value="<?php _e('Save Colors Options', $themename); ?>" class="button-primary" name="<?php echo $themename; ?>_submit">
			</p>
		</div>
		<div id="tab-fonts">
			<table class="form-table">
				<tbody>
					<tr valign="top">
						<th colspan="2" scope="row" style="font-weight: bold;">
							<?php
							_e('Fonts', $themename);
							?>
						</th>
					</tr>
					<tr valign="top">
						<th scope="row">
							<label for="header_font"><?php _e('Header font', $themename); ?></label>
						</th>
						<td>
							<select id="header_font" name="header_font">
								<option<?php echo ($theme_options["header_font"]=="" ? " selected='selected'" : ""); ?>  value=""><?php _e("Default", $themename); ?></option>
								<?php
								$fontsCount = count($fontsArray->items);
								for($i=0; $i<$fontsCount; $i++)
								{
								?>
									
									<?php
									$variantsCount = count($fontsArray->items[$i]->variants);
									if($variantsCount>1)
									{
										for($j=0; $j<$variantsCount; $j++)
										{
										?>
											<option<?php echo ($theme_options["header_font"]==$fontsArray->items[$i]->family . ":" . $fontsArray->items[$i]->variants[$j] ? " selected='selected'" : ""); ?> value="<?php echo $fontsArray->items[$i]->family . ":" . $fontsArray->items[$i]->variants[$j]; ?>"><?php echo $fontsArray->items[$i]->family . ":" . $fontsArray->items[$i]->variants[$j]; ?></option>
										<?php
										}
									}
									else
									{
									?>
									<option<?php echo ($theme_options["header_font"]==$fontsArray->items[$i]->family ? " selected='selected'" : ""); ?> value="<?php echo $fontsArray->items[$i]->family; ?>"><?php echo $fontsArray->items[$i]->family; ?></option>
									<?php
									}
								}
								?>
							</select>
						</td>
					</tr>
					<tr valign="top">
						<th scope="row">
							<label for="subheader_font"><?php _e('Subheader font', $themename); ?></label>
						</th>
						<td>
							<select id="subheader_font" name="subheader_font">
								<option<?php echo ($theme_options["subheader_font"]=="" ? " selected='selected'" : ""); ?>  value=""><?php _e("Default", $themename); ?></option>
								<?php
								$fontsCount = count($fontsArray->items);
								for($i=0; $i<$fontsCount; $i++)
								{
								?>
									
									<?php
									$variantsCount = count($fontsArray->items[$i]->variants);
									if($variantsCount>1)
									{
										for($j=0; $j<$variantsCount; $j++)
										{
										?>
											<option<?php echo ($theme_options["subheader_font"]==$fontsArray->items[$i]->family . ":" . $fontsArray->items[$i]->variants[$j] ? " selected='selected'" : ""); ?> value="<?php echo $fontsArray->items[$i]->family . ":" . $fontsArray->items[$i]->variants[$j]; ?>"><?php echo $fontsArray->items[$i]->family . ":" . $fontsArray->items[$i]->variants[$j]; ?></option>
										<?php
										}
									}
									else
									{
									?>
									<option<?php echo ($theme_options["subheader_font"]==$fontsArray->items[$i]->family ? " selected='selected'" : ""); ?> value="<?php echo $fontsArray->items[$i]->family; ?>"><?php echo $fontsArray->items[$i]->family; ?></option>
									<?php
									}
								}
								?>
							</select>
						</td>
					</tr>
				</tbody>
			</table>
			<p>
				<input type="submit" value="<?php _e('Save Fonts Options', $themename); ?>" class="button-primary" name="<?php echo $themename; ?>_submit">
			</p>
		</div>
		<p>
			<input type="hidden" name="action" value="<?php echo $themename; ?>_save" />
			<input type="submit" value="<?php _e('Save All Options', $themename); ?>" class="button-primary" name="<?php echo $themename; ?>_submit">
		</p>
		<input type="hidden" id="<?php echo $themename; ?>-selected-tab" value="<?php echo $selected_tab;?>" />
	</form>
<?php
}
?>