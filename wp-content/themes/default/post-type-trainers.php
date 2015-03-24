<?php
//custom post type - trainers
function theme_trainers_init()
{
	global $themename;
	$labels = array(
		'name' => _x('Trainers', 'post type general name', $themename),
		'singular_name' => _x('Trainer', 'post type singular name', $themename),
		'add_new' => _x('Add New', 'trainers', $themename),
		'add_new_item' => __('Add New Trainer', $themename),
		'edit_item' => __('Edit Trainer', $themename),
		'new_item' => __('New Trainer', $themename),
		'all_items' => __('All Trainers', $themename),
		'view_item' => __('View Trainer', $themename),
		'search_items' => __('Search Trainer', $themename),
		'not_found' =>  __('No trainers found', $themename),
		'not_found_in_trash' => __('No trainers found in Trash', $themename), 
		'parent_item_colon' => '',
		'menu_name' => __("Trainers", $themename)
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
	register_post_type("trainers", $args);
}  
add_action("init", "theme_trainers_init"); 

//Adds a box to the right column and to the main column on the Trainers edit screens
function theme_add_trainers_custom_box() 
{
	global $themename;
	add_meta_box( 
        "trainers_config",
        __("Options", $themename),
        "theme_inner_trainers_custom_box_main",
        "trainers",
		"normal",
		"high"
    );
}
add_action("add_meta_boxes", "theme_add_trainers_custom_box");
//backwards compatible (before WP 3.0)
//add_action("admin_init", "theme_add_custom_box", 1);

function theme_inner_trainers_custom_box_main($post)
{
	global $themename;
	//Use nonce for verification
	wp_nonce_field(plugin_basename( __FILE__ ), $themename . "_trainers_noncename");
	
	echo '
	<table>
		<tr>
			<td>
				<label for="trainer_subtitle">' . __('Subtitle', $themename) . ':</label>
			</td>
			<td>
				<input class="regular-text" type="text" id="trainer_subtitle" name="trainer_subtitle" value="' . esc_attr(get_post_meta($post->ID, "subtitle", true)) . '" />
			</td>
		</tr>
	</table>';
}

//When the post is saved, saves our custom data
function theme_save_trainers_postdata($post_id) 
{
	global $themename;
	//verify if this is an auto save routine. 
	//if it is our form has not been submitted, so we dont want to do anything
	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) 
		return;

	//verify this came from the our screen and with proper authorization,
	//because save_post can be triggered at other times
	if (!wp_verify_nonce($_POST[$themename . '_trainers_noncename'], plugin_basename( __FILE__ )))
		return;


	//Check permissions
	if(!current_user_can('edit_post', $post_id))
		return;

	//OK, we're authenticated: we need to find and save the data
	update_post_meta($post_id, "subtitle", $_POST["trainer_subtitle"]);
}
add_action("save_post", "theme_save_trainers_postdata");

function theme_trainers_shortcode($atts)
{
	global $themename;
	
	query_posts(array( 
		'post_type' => 'trainers',
		'posts_per_page' => '-1',
		'post_status' => 'publish',
		'orderby' => 'menu_order', 
		'order' => 'ASC'
	));
	
	$output = "";
	if(have_posts())
	{
		$output .= '<ul class="gallery_item_details_list clearfix page_margin_top">';
		while(have_posts()): the_post();
		$output .= '<li id="gallery-details-' . get_the_ID() . '" class="gallery_item_details clearfix">
				<div class="image_box">';
					if(has_post_thumbnail())
						$output .= get_the_post_thumbnail(get_the_ID(), $themename . "-gallery-image", array("alt" => get_the_title(), "title" => ""));
				$output .= '<ul class="controls">
						<li>
							<a href="#gallery-details-close" class="close"></a>
						</li>
						<li>
							<a href="#" class="prev"></a>
						</li>
						<li>
							<a href="#" class="next"></a>
						</li>
					</ul>
				</div>
				<div class="details_box">
					<h2>' . get_the_title() . '</h2>
					<h3 class="subheader">' . get_the_excerpt() . '</h3>
					' . do_shortcode(apply_filters('the_content', get_the_content())) . '
				</div>
			</li>';
		endwhile;
		$output .= '</ul>
		<ul class="gallery">';
		while(have_posts()): the_post();
		$output .= '<li id="gallery-item-' . get_the_ID() . '">
				<div class="gallery_box">';
				if(has_post_thumbnail())
					$output .= get_the_post_thumbnail(get_the_ID(), $themename . "-gallery-thumb", array("alt" => get_the_title(), "title" => ""));
			$output .= '
					<div class="description icon_small_arrow top_white">
						<h3>' . get_the_title() . '</h3>
						<h5>' . get_post_meta(get_the_ID(), "subtitle", true) . '</h5>
					</div>
					<ul class="controls">
						<li>
							<a href="#gallery-details-' . get_the_ID() . '" class="open_details"></a>
						</li>
						<li>';
							$attachment_image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), "large");
							$large_image_url = $attachment_image[0];
				$output .= '<a href="' . $large_image_url . '" rel="gallery" class="fancybox open_lightbox"></a>
						</li>	
					</ul>
				</div>
			</li>';
		endwhile;
		$output .= '</ul>';
	}
	//Reset Query
	wp_reset_query();
	return $output;
}
add_shortcode("trainers", "theme_trainers_shortcode");
?>