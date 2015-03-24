<?php
class scrolling_most_viewed_widget extends WP_Widget 
{
	/** constructor */
    function scrolling_most_viewed_widget() 
	{
		global $themename;
		$widget_options = array(
			'classname' => 'scrolling_most_viewed_widget',
			'description' => 'Displays scrolling most viewed posts list'
		);
        parent::WP_Widget('gymbase_scrolling_most_viewed', __('Scrolling Most Viewed Posts', $themename), $widget_options);
    }
	
	/** @see WP_Widget::widget */
    function widget($args, $instance) 
	{
        extract($args);

		//these are our widget options
		$title = $instance['title'];
		$count = $instance['count'];

		//get recent posts
		query_posts(array( 
			'post_type' => 'post',
			'post_status' => 'publish',
			'posts_per_page' => $count,
			'meta_key' => 'post_views_count',
			'orderby' => 'meta_value_num', 
			'order' => 'DESC'
		));
		
		echo $before_widget;
		?>
		<div class="clearfix">
			<div class="header_left">
				<?php
				if($title) 
				{
					echo $before_title . $title . $after_title;
				}
				?>
			</div>
			<div class="header_right">
				<a href="#" id="most_viewed_prev" class="scrolling_list_control_left icon_small_arrow left_black"></a>
				<a href="#" id="most_viewed_next" class="scrolling_list_control_right icon_small_arrow right_black"></a>
			</div>
		</div>
		<div class="scrolling_list_wrapper">
			<ul class="scrolling_list most_viewed">
				<?php
				if(have_posts()) : while (have_posts()) : the_post();
				?>
				<li class="icon_small_arrow right_white">
					<a href="<?php the_permalink(); ?>" class="clearfix" title="<?php the_title(); ?>">
						<span class="left">
							<?php the_title(); ?>
						</span>
						<span class="number">
							<?php echo getPostViews(get_the_ID()); ?>
						</span>
					</a>
					<abbr title="<?php the_time('c'); ?>" class="timeago"><?php the_time('c'); ?></abbr>
				</li>
				<?php
				endwhile; endif;
				?>
			</ul>
		</div>
		<?php
        echo $after_widget;
    }
	
	/** @see WP_Widget::update */
    function update($new_instance, $old_instance) 
	{
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['count'] = strip_tags($new_instance['count']);
		return $instance;
    }
	
	 /** @see WP_Widget::form */
	function form($instance) 
	{	
		global $themename;
		$title = esc_attr($instance['title']);
		$count = esc_attr($instance['count']);
		?>
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title', $themename); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('count'); ?>"><?php _e('Count', $themename); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('count'); ?>" name="<?php echo $this->get_field_name('count'); ?>" type="text" value="<?php echo $count; ?>" />
		</p>
		<?php
	}
}
//register widget
add_action('widgets_init', create_function('', 'return register_widget("scrolling_most_viewed_widget");'));
?>