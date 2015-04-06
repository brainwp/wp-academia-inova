<?php
class twitter_widget extends WP_Widget 
{
	/** constructor */
    function twitter_widget() 
	{
		global $themename;
		$widget_options = array(
			'classname' => 'twitter_widget',
			'description' => 'Displays Twitter Feed'
		);
        parent::WP_Widget('gymbase_twitter', __('Twitter Feed', $themename), $widget_options);
    }
	
	/** @see WP_Widget::widget */
    function widget($args, $instance) 
	{
        extract($args);

		//these are our widget options
		$title = $instance['title'];
		$login = $instance['login'];
		$count = $instance['count'];

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
				<a href="#" id="latest_tweets_prev" class="scrolling_list_control_left icon_small_arrow left_black"></a>
				<a href="#" id="latest_tweets_next" class="scrolling_list_control_right icon_small_arrow right_black"></a>
			</div>
		</div>
		<div class="scrolling_list_wrapper">
			<ul class="scrolling_list latest_tweets">
			</ul>
		</div>
		<script type="text/javascript">
		jQuery(document).ready(function($){
			//tweets
			$.getJSON('http://twitter.com/statuses/user_timeline.json?screen_name=<?php echo $login; ?>&count=<?php echo $count; ?>&callback=?', function(data) 
			{
				if(data.length)
				{
					var list=$(".latest_tweets");
					var date;
					$(data).each(function(index,value)
					{
						date = new Date(value.created_at);
						list.append($('<li class="icon_small_arrow right_black">').append($('<p>').html(linkify(value.text)+'<abbr class="timeago" title="'+date.toISOString()+'">'+date.toISOString()+'</abbr>')));
					});

					$('.latest_tweets a').attr('target','_blank');

					list.carouFredSel({
						direction: "up",
						items: {
							visible: 3
						},
						scroll: {
							items: 1,
							easing: "swing",
							pauseOnHover: true,
							height: "variable"
						},
						prev: '#latest_tweets_prev',
						next: '#latest_tweets_next',
						auto: {
							play: false
						}
					});	
					$("abbr.timeago").timeago();
				}
			});
		});
		</script>
		<?php
        echo $after_widget;
    }
	
	/** @see WP_Widget::update */
    function update($new_instance, $old_instance) 
	{
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['login'] = strip_tags($new_instance['login']);
		$instance['count'] = strip_tags($new_instance['count']);
		return $instance;
    }
	
	 /** @see WP_Widget::form */
	function form($instance) 
	{	
		global $themename;
		$title = esc_attr($instance['title']);
		$login = esc_attr($instance['login']);
		$count = esc_attr($instance['count']);
		?>
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title', $themename); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('login'); ?>"><?php _e('Login', $themename); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('login'); ?>" name="<?php echo $this->get_field_name('login'); ?>" type="text" value="<?php echo $login; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('count'); ?>"><?php _e('Count', $themename); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('count'); ?>" name="<?php echo $this->get_field_name('count'); ?>" type="text" value="<?php echo $count; ?>" />
		</p>
		<?php
	}
}
//register widget
add_action('widgets_init', create_function('', 'return register_widget("twitter_widget");'));
?>