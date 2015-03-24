<?php
//custom post type - classes
function theme_classes_init()
{
	global $themename;
	global $blog_id;
	global $wpdb;
	$labels = array(
		'name' => _x('Classes', 'post type general name', $themename),
		'singular_name' => _x('Class', 'post type singular name', $themename),
		'add_new' => _x('Add New', 'classes', $themename),
		'add_new_item' => __('Add New Class', $themename),
		'edit_item' => __('Edit Class', $themename),
		'new_item' => __('New Class', $themename),
		'all_items' => __('All Classes', $themename),
		'view_item' => __('View Class', $themename),
		'search_items' => __('Search Class', $themename),
		'not_found' =>  __('No classes found', $themename),
		'not_found_in_trash' => __('No classes found in Trash', $themename), 
		'parent_item_colon' => '',
		'menu_name' => __("Classes", $themename)
	);
	$args = array(  
		"labels" => $labels, 
		"public" => true,  
		"show_ui" => true,  
		"capability_type" => "post",  
		"menu_position" => 20,
		"hierarchical" => false,  
		"rewrite" => true,  
		"supports" => array("title", "editor", "excerpt", "thumbnail", "page-attributes")  
	);
	register_post_type("classes", $args);  
	
	if(!get_option($themename . "_class_hours_table_installed"))
	{
		//create custom db table
		$query = "CREATE TABLE IF NOT EXISTS `wp_" . $blog_id . "_class_hours` (
			`class_hours_id` BIGINT( 20 ) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY ,
			`class_id` BIGINT( 20 ) NOT NULL ,
			`weekday_id` BIGINT( 20 ) NOT NULL ,
			`start` TIME NOT NULL ,
			`end` TIME NOT NULL,
			INDEX ( `class_id` ),
			INDEX ( `weekday_id` )
		) ENGINE = MYISAM ;";
		$wpdb->query($query);
		//insert sample data
		$query = "INSERT INTO `wp_" . $blog_id . "_class_hours` (`class_hours_id`, `class_id`, `weekday_id`, `start`, `end`) VALUES
			(1, 33, 43, '06:00:00', '07:00:00'),
			(2, 33, 42, '06:00:00', '07:00:00'),
			(58, 34, 44, '16:00:00', '17:30:00'),
			(57, 34, 38, '11:00:00', '12:00:00'),
			(5, 33, 39, '17:00:00', '18:00:00'),
			(6, 33, 38, '17:00:00', '18:00:00'),
			(7, 34, 43, '16:00:00', '17:30:00'),
			(8, 34, 42, '16:00:00', '17:30:00'),
			(9, 34, 40, '16:00:00', '17:30:00'),
			(10, 34, 39, '08:00:00', '09:30:00'),
			(11, 34, 38, '08:00:00', '09:30:00'),
			(71, 33, 38, '10:00:00', '11:00:00'),
			(70, 33, 39, '10:00:00', '11:00:00'),
			(69, 63, 44, '18:00:00', '20:00:00'),
			(68, 33, 39, '12:00:00', '13:00:00'),
			(67, 33, 38, '12:00:00', '13:00:00'),
			(66, 33, 40, '12:00:00', '13:00:00'),
			(65, 33, 41, '12:00:00', '13:00:00'),
			(19, 61, 43, '07:00:00', '08:00:00'),
			(20, 61, 42, '07:00:00', '08:00:00'),
			(21, 61, 40, '10:00:00', '11:30:00'),
			(22, 61, 44, '10:00:00', '11:30:00'),
			(23, 61, 39, '14:00:00', '16:00:00'),
			(24, 61, 38, '14:00:00', '16:00:00'),
			(27, 33, 43, '14:00:00', '16:15:00'),
			(28, 33, 42, '14:00:00', '16:15:00'),
			(29, 33, 44, '17:30:00', '20:00:00'),
			(30, 34, 43, '09:00:00', '11:25:00'),
			(31, 34, 42, '09:00:00', '11:25:00'),
			(32, 34, 39, '11:00:00', '12:00:00'),
			(44, 63, 39, '12:00:00', '15:45:00'),
			(41, 63, 43, '05:00:00', '06:00:00'),
			(43, 63, 44, '12:00:00', '15:45:00'),
			(40, 63, 43, '18:00:00', '19:00:00'),
			(42, 63, 42, '05:00:00', '06:00:00'),
			(45, 63, 42, '18:00:00', '19:00:00'),
			(46, 63, 41, '18:00:00', '20:00:00'),
			(47, 63, 40, '18:00:00', '20:00:00'),
			(52, 33, 41, '06:00:00', '08:30:00'),
			(56, 34, 44, '09:00:00', '10:00:00'),
			(55, 34, 40, '09:00:00', '10:00:00'),
			(53, 33, 40, '06:00:00', '08:30:00'),
			(54, 33, 44, '06:00:00', '08:30:00'),
			(59, 55, 43, '18:30:00', '20:00:00'),
			(60, 55, 42, '18:30:00', '20:00:00'),
			(61, 55, 41, '18:30:00', '20:00:00'),
			(62, 55, 40, '18:30:00', '20:00:00'),
			(63, 55, 39, '19:00:00', '20:30:00'),
			(64, 55, 38, '19:00:00', '20:30:00'),
			(75, 61, 40, '06:00:00', '08:30:00'),
			(74, 61, 41, '06:00:00', '08:30:00'),
			(76, 61, 44, '06:00:00', '08:30:00');";
		$wpdb->query($query);
		add_option($themename . "_class_hours_table_installed", 1);
	}
}  
add_action("init", "theme_classes_init"); 

//Adds a box to the right column and to the main column on the Classes edit screens
function theme_add_classes_custom_box() 
{
	global $themename;
    add_meta_box( 
        "class_hours",
        __("Class hours", $themename),
        "theme_inner_classes_custom_box_side",
        "classes",
		"side"
    );
	add_meta_box( 
        "class_config",
        __("Options", $themename),
        "theme_inner_classes_custom_box_main",
        "classes",
		"normal",
		"high"
    );
}
add_action("add_meta_boxes", "theme_add_classes_custom_box");
//backwards compatible (before WP 3.0)
//add_action("admin_init", "theme_add_custom_box", 1);

// Prints the box content
function theme_inner_classes_custom_box_side($post) 
{
	global $themename;
	global $blog_id;
	global $wpdb;
	//Use nonce for verification
	wp_nonce_field(plugin_basename( __FILE__ ), $themename . "_classes_noncename");

	//The actual fields for data entry
	$query = "SELECT * FROM `wp_" . $blog_id . "_class_hours` AS t1 LEFT JOIN {$wpdb->posts} AS t2 ON t1.weekday_id=t2.ID WHERE t1.class_id='" . $post->ID . "' ORDER BY FIELD(t2.menu_order,2,3,4,5,6,7,1), t1.start, t1.end";
	$class_hours = $wpdb->get_results($query);
	$class_hours_count = count($class_hours);
	
	//get weekdays
	$query = "SELECT ID, post_title FROM {$wpdb->posts}
			WHERE 
			post_type='" . $themename . "_weekdays'
			ORDER BY FIELD(menu_order,2,3,4,5,6,7,1)";
	$weekdays = $wpdb->get_results($query);
	echo '
	<ul id="class_hours_list"' . (!$class_hours_count ? ' style="display: none;"' : '') . '>';
		for($i=0; $i<$class_hours_count; $i++)
		{
			//get day by id
			$current_day = get_post($class_hours[$i]->weekday_id);
			echo '<li id="class_hours_' . $class_hours[$i]->class_hours_id . '">' . $current_day->post_title . ' ' . date("H:i", strtotime($class_hours[$i]->start)) . '-' . date("H:i", strtotime($class_hours[$i]->end)) . '<img class="delete_button" src="' . get_template_directory_uri() . '/images/delete.png" alt="del" /></li>';
		}
	echo '
	</ul>
	<table id="class_hours">
		<tr>
			<td>
				<label for="weekday_id">' . __('Day', $themename) . ':</label>
			</td>
			<td>
				<select name="weekday_id" id="weekday_id">';
				foreach($weekdays as $weekday)
					echo '<option value="' . $weekday->ID . '">' . $weekday->post_title . '</option>';
	echo '		</select>
			</td>
		</tr>
		<tr>
			<td>
				<label for="start_hour">' . __('Start hour', $themename) . ':</label>
			</td>
			<td>
				<input size="5" maxlength="5" type="text" id="start_hour" name="start_hour" value="" />
				<span class="description">hh:mm</span>
			</td>
		</tr>
		<tr>
			<td>
				<label for="end_hour">' . __('End hour', $themename) . ':</label>
			</td>
			<td>
				<input size="5" maxlength="5" type="text" id="end_hour" name="end_hour" value="" />
				<span class="description">hh:mm</span>
			</td>
		</tr>
		<tr>
			<td colspan="2" style="text-align: right;">
				<input id="add_class_hours" type="button" class="button" value="' . __("Add", $themename) . '" />
			</td>
		</tr>
	</table>
	';
	//Reset Query
	wp_reset_query();
}

function theme_inner_classes_custom_box_main($post)
{
	global $themename;
	//Use nonce for verification
	wp_nonce_field(plugin_basename( __FILE__ ), $themename . "_classes_noncename");
	
	//The actual fields for data entry
	$trainers = get_post_meta($post->ID, $themename . "_trainers", true);
	
	echo '
	<table>
		<tr>
			<td>
				<label for="subtitle">' . __('Subtitle', $themename) . ':</label>
			</td>
			<td>
				<input class="regular-text" type="text" id="subtitle" name="subtitle" value="' . esc_attr(get_post_meta($post->ID, $themename . "_subtitle", true)) . '" />
			</td>
		</tr>
		</tr>';
		if(wp_count_posts("trainers"))
		{
			echo '
		<tr>
			<td>
				<label for="trainers">' . __('Trainers', $themename) . ':</label>
			</td>
			<td>
				<select id="trainers" name="trainers[]" multiple="multiple">';
					query_posts(array( 
						'post_type' => 'trainers',
						'posts_per_page' => '-1',
						'post_status' => 'publish',
						'orderby' => 'post_title', 
						'order' => 'DESC'
					));
					while(have_posts()): the_post();
						echo '<option value="' . get_the_ID() . '"' . (in_array(get_the_ID(), (array)$trainers) ? ' selected="selected"' : '') . '>' . get_the_title() . '</option>';
					endwhile;
			echo '
				</select>
			</td>
		</tr>';
		}
		echo '
	</table>';
}

//When the post is saved, saves our custom data
function theme_save_classes_postdata($post_id) 
{
	global $themename;
	global $blog_id;
	global $wpdb;
	//verify if this is an auto save routine. 
	//if it is our form has not been submitted, so we dont want to do anything
	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) 
		return;

	//verify this came from the our screen and with proper authorization,
	//because save_post can be triggered at other times
	if (!wp_verify_nonce($_POST[$themename . '_classes_noncename'], plugin_basename( __FILE__ )))
		return;


	//Check permissions
	if(!current_user_can('edit_post', $post_id))
		return;

	//OK, we're authenticated: we need to find and save the data
	$hours_count = count($_POST["weekday_ids"]);
	for($i=0; $i<$hours_count; $i++)
	{
		$query = "INSERT INTO `wp_" . $blog_id . "_class_hours` VALUES(
			NULL,
			'" . $post_id . "',
			'" . $_POST["weekday_ids"][$i] . "',
			'" . $_POST["start_hours"][$i] . "',
			'" . $_POST["end_hours"][$i] . "'
		);";
		$wpdb->query($query);
	}
	//removing data if needed
	$delete_class_hours_ids_count = count($_POST["delete_class_hours_ids"]);
	if($delete_class_hours_ids_count)
		$wpdb->query("DELETE FROM `wp_" . $blog_id . "_class_hours` WHERE class_hours_id IN(" . implode(",", $_POST["delete_class_hours_ids"]) . ");");
	//post meta
	update_post_meta($post_id, $themename . "_subtitle", $_POST["subtitle"]);
	update_post_meta($post_id, $themename . "_trainers", $_POST["trainers"]);
}
add_action("save_post", "theme_save_classes_postdata");

//classes sidebar
function theme_classes_sidebar($atts, $content)
{
	global $themename;
	
	extract(shortcode_atts(array(
		"order" => "ASC",
		"classes_url" => get_home_url() . "/classes",
		"timetable_url" => get_home_url() . "/horarios"
	), $atts));
	
	query_posts(array( 
		'post_type' => 'classes',
		'posts_per_page' => '-1',
		'post_status' => 'publish',
		'orderby' => 'menu_order', 
		'order' => $order
	));
	
	$output = '';
	if(have_posts()):
		$output .= '<ul class="accordion">';
		while(have_posts()): the_post();
			global $post;
			$output .= '<li>
				<div id="accordion-' . $post->post_name . '">
					<h3>' . get_the_title() . '</h3>
					<h5>' . esc_attr(get_post_meta($post->ID, "subtitle", true)) . '</h5>
				</div>
				<div class="clearfix">
					<div class="item_content clearfix">';
						if(has_post_thumbnail())
							$output .= '<a class="thumb_image" href="' . $classes_url . '/#' . $post->post_name . '" title="' . get_the_title() . '">
								' . get_the_post_thumbnail(get_the_ID(), $themename . "-small-thumb", array("alt" => get_the_title(), "title" => "")) . '
							</a>';
			$output .= '<div class="text">
							' . get_the_excerpt() . '
						</div>
					</div>
					<div class="item_footer clearfix">
						<a class="more icon_small_arrow margin_right_white" href="' . $classes_url . '/#' . $post->post_name . '" title="' . __("Details", $themename) . '">' . __("Details", $themename) . '</a>
						<a class="more icon_small_arrow margin_right_white" href="' . $timetable_url . '/#' . $post->post_name . '" title="' . __("Timetable", $themename) . '">' . __("Timetable", $themename) . '</a>
					</div>
				</div>
			</li>';
		endwhile;
		$output .= '</ul>';
	endif;
	
	return $output;
}
add_shortcode("classes_sidebar", "theme_classes_sidebar");

//classes sidebar
function theme_classes($atts, $content)
{
	global $themename;
	
	extract(shortcode_atts(array(
		"order" => "ASC",
		"timetable_url" => get_home_url() . "/horarios"
	), $atts));
	
	query_posts(array( 
		'post_type' => 'classes',
		'posts_per_page' => '-1',
		'post_status' => 'publish',
		'orderby' => 'menu_order', 
		'order' => $order
	));
	
	$output = '';
	if(have_posts()):
		$output .= '<ul class="accordion wide">';
		while(have_posts()): the_post();
			global $post;
			$trainers = get_post_meta(get_the_ID(), $themename . "_trainers", true);
			$output .= '<li>
				<div id="accordion-' . $post->post_name . '">
					<h3>' . get_the_title() . '</h3>
					<h5>' . esc_attr(get_post_meta(get_the_ID(), $themename . "_subtitle", true)) . '</h5>
				</div>
				<div class="clearfix tabs">
					<ul>
						<li>
							<a href="#' . $post->post_name . '-about" title="' . __("About", $themename) . '">' . __("About", $themename) . '</a>
						</li>';
						if(count($trainers)):
						$output .= '
						<li>
							<a href="#' . $post->post_name . '-trainers" title="' . __("Trainers", $themename) . '">' . __("Trainers", $themename) . '</a>
						</li>';
						endif;
						$output .= '
						<li>
							<a class="no-tab" href="' . $timetable_url . '/#' . $post->post_name . '" title="' . __("Timetable", $themename) . '">' . __("Timetable", $themename) . '</a>
						</li>
					</ul>
					<div id="' . $post->post_name . '-about">';
						if(has_post_thumbnail())
							$output .= get_the_post_thumbnail(get_the_ID(), "blog-post-thumb", array("alt" => get_the_title(), "title" => "", "class" => "about_img"));
				$output .= do_shortcode(apply_filters('the_content', get_the_content())) . '
					</div>';
				if(count($trainers)):
					$trainers_list = get_posts(array(
						'include' => implode(",", (array)$trainers),
						'post_type' => 'trainers',
						'numberposts' => -1,
						'orderby' => 'post_title', 
						'order' => 'DESC'
					));
				$output .= '
					<div id="' . $post->post_name . '-trainers">
						<ul>';
						$i = 0;
						foreach($trainers_list as $post):
							setup_postdata($post);
						$output .= '<li' . ($i>0 ? ' class="page_margin_top"' : '') . '>';
							if(has_post_thumbnail())
								$output .= get_the_post_thumbnail(get_the_ID(), "blog-post-thumb", array("alt" => get_the_title(), "title" => "", "class" => "about_img"));
						$output .= '
							<h2>' . get_the_title() . '</h2>
							<h4 class="sentence">'. get_the_excerpt() . '</h4>
							' . do_shortcode(apply_filters('the_content', get_the_content()))
							. '</li>';
							$i++;
						endforeach;
				$output .= '
						</ul>
					</div>';
				endif;
				$output .= '
				</div>
			</li>';
		endwhile;
		$output .= '</ul>';
	endif;
	
	//Reset Query
	wp_reset_query();
	return $output;
}
add_shortcode("classes", "theme_classes");
?>