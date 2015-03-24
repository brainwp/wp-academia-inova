<?php
class upcoming_classes_widget extends WP_Widget 
{
	/** constructor */
    function upcoming_classes_widget() 
	{
		global $themename;
		$widget_options = array(
			'classname' => 'upcoming_classes_widget',
			'description' => 'Displays upcoming classes scrolling list'
		);
        parent::WP_Widget('gymbase_upcoming_classes', __('Upcoming Classes', $themename), $widget_options);
    }
	
	/** @see WP_Widget::widget */
    function widget($args, $instance) 
	{
		global $themename;
		global $blog_id;
		global $wpdb;
		extract($args);

		//these are our widget options
		$title = $instance['title'];
		$title_color = $instance['title_color'];
		$subtitle = $instance['subtitle'];
		$subtitle_color = $instance['subtitle_color'];
		$count = $instance['count'];
		$background_color = $instance['background_color'];
		$text_color = $instance['text_color'];
		$item_border_color = $instance['item_border_color'];

		echo $before_widget;
		
		$query = "SELECT TIME_FORMAT(t1.start, '%H:%i') AS start, TIME_FORMAT(t1.end, '%H:%i') AS end, t2.post_title FROM wp_" . $blog_id . "_class_hours AS t1 
			LEFT JOIN {$wpdb->posts} AS t2 ON t1.class_id=t2.ID 
			LEFT JOIN {$wpdb->posts} AS t3 ON t1.weekday_id=t3.ID 
			WHERE 
			t2.post_type='classes' 
			AND 
			t3.post_type='" . $themename . "_weekdays' 
			AND 
			t3.menu_order=DAYOFWEEK(CURDATE()) 
			AND 
			SUBTIME(t1.start, CURRENT_TIME())>0
			ORDER BY t1.start, t1.end";
		if( (int)$count>0 )
			$query .= " LIMIT " . $count;
		$class_hours = $wpdb->get_results($query);
		$class_hours_count = count($class_hours);
		
		if ( $class_hours_count != '') {
			$output .= '<li class="home_box white"' . ($background_color!='' ? ' style="background-color: #' . $background_color . ';"' : '') . '>
				<div class="clearfix">
					<div class="header_left">';
						if($title) 
						{
							if($title_color!="")
								$before_title = str_replace(">", " style='color: #" . $title_color . ";'>",$before_title);
							$output .= $before_title . $title . $after_title;
						}
			$output .= '<h3' . ($subtitle_color!="" ? ' style="color: #' . $subtitle_color . ';"' : '') . '>' . $subtitle . '</h3>
					</div>
					<div class="header_right">
						<a href="#" id="upcoming_class_prev" class="icon_small_arrow left_black"></a>
						<a href="#" id="upcoming_class_next" class="icon_small_arrow right_black"></a>
					</div>
				</div>
				<div class="upcoming_classes_wrapper">
					[items_list class="upcoming_classes clearfix"]';
					for($i=0; $i<$class_hours_count; $i++)
						$output .= '[item' . ($text_color!='' ? ' value_color="' . $text_color . '"' : '') . ($item_border_color!='' ? ' border_color="' . $item_border_color . '"' : '') . ' value="' .  $class_hours[$i]->start . ' - ' .  $class_hours[$i]->end . '"]<a href="#" title="' . $class_hours[$i]->post_title . '">' . $class_hours[$i]->post_title . '</a>[/item]';
			$output .= '[/items_list]
				</div>
			</li>';
			echo do_shortcode($output);
		}
		else {
			$output .= '<li class="home_box white"' . ($background_color!='' ? ' style="background-color: #' . $background_color . ';"' : '') . '>
				<div class="clearfix">
					<div class="header_left">';
						if($title) 
						{
							if($title_color!="")
								$before_title = str_replace(">", " style='color: #" . $title_color . ";'>",$before_title);
							$output .= $before_title . $title . $after_title;
						}
			$output .= '<h3' . ($subtitle_color!="" ? ' style="color: #' . $subtitle_color . ';"' : '') . '>' . $subtitle . '</h3>
					</div>
					<div class="header_right">
						<a href="#" id="upcoming_class_prev" class="icon_small_arrow left_black"></a>
						<a href="#" id="upcoming_class_next" class="icon_small_arrow right_black"></a>
					</div>
				</div>
				<div class="upcoming_classes_wrapper">
					[items_list class="upcoming_classes clearfix"]';
					 $output .= '[item' . ($text_color!='' ? ' value_color="' . $text_color . '"' : '') . ($item_border_color!='' ? ' border_color="' . $item_border_color . '"' : '') . ' value=""]Aulas encerradas por hoje[/item]';
			$output .= '[/items_list]
				</div>
			</li>';

			echo do_shortcode($output);
		}
        echo $after_widget;


    }
	
	/** @see WP_Widget::update */
    function update($new_instance, $old_instance) 
	{
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['title_color'] = strip_tags($new_instance['title_color']);
		$instance['subtitle'] = strip_tags($new_instance['subtitle']);
		$instance['subtitle_color'] = strip_tags($new_instance['subtitle_color']);
		$instance['count'] = strip_tags($new_instance['count']);
		$instance['background_color'] = strip_tags($new_instance['background_color']);
		$instance['text_color'] = strip_tags($new_instance['text_color']);
		$instance['item_border_color'] = strip_tags($new_instance['item_border_color']);
		return $instance;
    }
	
	 /** @see WP_Widget::form */
	function form($instance) 
	{	
		global $themename;
		$title = esc_attr($instance['title']);
		$title_color = esc_attr($instance['title_color']);
		$subtitle = esc_attr($instance['subtitle']);
		$subtitle_color = esc_attr($instance['subtitle_color']);
		$count = esc_attr($instance['count']);
		$background_color = esc_attr($instance['background_color']);
		$text_color = esc_attr($instance['text_color']);
		$item_border_color = esc_attr($instance['item_border_color']);
		?>
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title', $themename); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('title_color'); ?>"><?php _e('Title color', $themename); ?></label>
			<input class="widefat color" id="<?php echo $this->get_field_id('title_color'); ?>" name="<?php echo $this->get_field_name('title_color'); ?>" type="text" value="<?php echo $title_color; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('subtitle'); ?>"><?php _e('Subtitle', $themename); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('subtitle'); ?>" name="<?php echo $this->get_field_name('subtitle'); ?>" type="text" value="<?php echo $subtitle; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('subtitle_color'); ?>"><?php _e('Subtitle color', $themename); ?></label>
			<input class="widefat color" id="<?php echo $this->get_field_id('subtitle_color'); ?>" name="<?php echo $this->get_field_name('subtitle_color'); ?>" type="text" value="<?php echo $subtitle_color; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('count'); ?>"><?php _e('Count', $themename); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('count'); ?>" name="<?php echo $this->get_field_name('count'); ?>" type="text" value="<?php echo $count; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('background_color'); ?>"><?php _e('Background color', $themename); ?></label>
			<input class="widefat color" id="<?php echo $this->get_field_id('background_color'); ?>" name="<?php echo $this->get_field_name('background_color'); ?>" type="text" value="<?php echo $background_color; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('text_color'); ?>"><?php _e('Text color', $themename); ?></label>
			<input class="widefat color" id="<?php echo $this->get_field_id('text_color'); ?>" name="<?php echo $this->get_field_name('text_color'); ?>" type="text" value="<?php echo $text_color; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('item_border_color'); ?>"><?php _e('Item border color', $themename); ?></label>
			<input class="widefat color" id="<?php echo $this->get_field_id('item_border_color'); ?>" name="<?php echo $this->get_field_name('item_border_color'); ?>" type="text" value="<?php echo $item_border_color; ?>" />
		</p>
		<?php
	}
}
//register widget
add_action('widgets_init', create_function('', 'return register_widget("upcoming_classes_widget");'));
?>